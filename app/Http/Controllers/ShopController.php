<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
    {
        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];

        $categories = Category::orderBy('name', 'ASC')->with('sub_category')->where('status', 1)->get();
        $brands = Brand::orderBy('name', 'ASC')->where('status', 1)->get();

        $products = Product::where('status', 1);

        // apply filter
        if (!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id', $category->id);
            $categorySelected = $category->id;

        }

        if (!empty($subCategorySlug)) {
            $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
            $products = $products->where('sub_category_id', $subCategory->id);
            $subCategorySelected = $subCategory->id;
        }

        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('brand_id', $brandsArray);
        }

        if ($request->get('price_max') != '' && $request->get('price_min') != '') {
            if ($request->get('price_max') == 1000) {
                $products = $products->whereBetween('price', [intval($request->get('price_min')), 1000000]);
            } else {
                $products = $products->whereBetween('price', [intval($request->get('price_min')), intval($request->get('price_max'))]);

            }
        }

        if (!empty($request->get('search'))) {
            $products = $products->where('title', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->get('sort')) {
            if ($request->get('sort') == 'latest') {
                $products = $products->orderBy('id', 'DESC');
            } else if ($request->get('sort') == 'low') {
                $products = $products->orderBy('price', 'ASC');
            } else {
                $products = $products->orderBy('price', 'DESC');
            }
        } else {
            $products = $products->orderBy('id', 'DESC');
        }

        $products = $products->paginate(9);

        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['brandsArray'] = $brandsArray;
        $data['sort'] = $request->get('sort');
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));

        return view('front.shop', $data);
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)
            ->withCount('product_ratings')
            ->withSum('product_ratings', 'rating')
            ->with(['product_images', 'product_ratings'])->first();

        // dd($product);
        if ($product == null) {
            abort(404);
        }

        $relatedProducts = [];
        // fetch related products
        if ($product->related_products != '') {
            $productArray = explode(',', $product->related_products);
            $relatedProducts = Product::whereIn('id', $productArray)->with('product_images')->where('status', 1)->get();
        }

        $data['product'] = $product;
        $data['relatedProducts'] = $relatedProducts;

        // itung rating
        // cba dd, ini hasilnya 'product_ratings_count' => 2
        // 'product_ratings_sum_rating' => 9.0

        $avgRating = '0.00';
        $avgRatingPer = 0;
        if ($product->product_ratings_count > 0) {
            $avgRating = number_format(($product->product_ratings_sum_rating / $product->product_ratings_count), 2);
            $avgRatingPer = ($avgRating * 100) / 5;
        }

        $data['avgRating'] = $avgRating;
        $data['avgRatingPer'] = $avgRatingPer;

        return view('front.product', $data);

    }

    public function saveRating(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|min:5',
            'rating' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // cek apa user udah beli apa belom
        $hasPurchased = Order::whereHas('items', function ($query) use ($id) {
            $query->where('product_id', $id);
        })->where('user_id', Auth::id())->exists();

        if (!$hasPurchased) {
            session()->flash('error', 'You can only rate products you have purchased.');
            return response()->json([
                'status' => false,
                'message' => 'You can only rate products you have purchased.'
            ]);
        }

        // cek user udah pernah review apa blom
        $exists = ProductRating::where('email', Auth::user()->email)->where('product_id', $id)->exists();
        if ($exists) {
            session()->flash('error', 'You already rated this product.');
            return response()->json([
                'status' => true,
            ]);
        }
        $productRating = new ProductRating;
        $productRating->product_id = $id;
        $productRating->username = Auth::user()->name;
        $productRating->email = Auth::user()->email;
        $productRating->comment = $request->comment;
        $productRating->rating = $request->rating;
        $productRating->save();

        session()->flash('success', 'Thanks for your rating!');

        return response()->json([
            'status' => true,
            'message' => 'Thanks for your rating!'
        ]);
    }
}
