<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\TempImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest('id')->with('product_images');
        if ($request->get('keyword') != "") {
            $products = $products->where('title', 'like', '%' . $request->keyword . '%');
        }
        $products = $products->paginate(10);
        $data['products'] = $products;
        return view('admin.product.index', $data);
    }

    public function create()
    {
        $data = [];
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        return view('admin.product.create', $data);

    }

    public function store(Request $request)
    {
        // dd($request->image_array);
        // exit();
        $rules = [
            'title' => 'required|unique:products',
            'slug' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:yes,no',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:yes,no',
        ];
        if (!empty($request->track_qty) && $request->track_qty == 'yes') {

            $rules['qty'] = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $product = new Product;
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->size = $request->size;
            $product->color = $request->color;
            $product->shipping_returns = $request->shipping_returns;
            $product->related_products = (!empty($request->related_products)) ? implode(',', $request->related_products) : '';
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->save();

            // save gallery img
            if (!empty($request->image_array)) {
                foreach ($request->image_array as $key => $temp_image_id) {

                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.', $tempImageInfo->name);
                    $ext = last($extArray); //like, jpg, gif, png

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();

                    $imageName = $product->id . '-' . $productImage->id . '-' . time() . '.' . $ext;
                    //product_id => 4; product_image_id => 1
                    // 4-1-1234413.jpg
                    $productImage->image = $imageName;
                    $productImage->save();

                    //generate product thumbnails

                    //large img
                    $sourcePath = public_path() . '/temp/' . $tempImageInfo->name;
                    $destPath = public_path() . '/uploads/product/large/' . $imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sourcePath);
                    $image->cover(900, 1400);
                    $image->save($destPath);

                    //small
                    $destPath = public_path() . '/uploads/product/small/' . $imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sourcePath);
                    $image->cover(300, 300);
                    $image->save($destPath);
                }
            }

            $request->session()->flash('success', 'New Product added successfully.');

            return response()->json([
                'status' => true,
                'message' => 'New Product added successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        ;
    }

    public function edit(Request $request, string $id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            $request->session()->flash('error', 'Product not found.');
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        // fetch images
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();

        $relatedProducts = [];
        // fetch related products
        if($product->related_products != ''){
            $productArray = explode(',', $product->related_products);
            $relatedProducts = Product::whereIn('id', $productArray)->get();
        }

        $data = [];
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['product'] = $product;
        $data['subCategories'] = $subCategories;
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['productImages'] = $productImages;
        $data['relatedProducts'] = $relatedProducts;
        return view('admin.product.edit', $data);

    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        $rules = [
            'title' => 'required|unique:products,title,' . $product->id . ',id',
            'slug' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku,' . $product->id . ',id',
            'track_qty' => 'required|in:yes,no',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:yes,no',
        ];
        if (!empty($request->track_qty) && $request->track_qty == 'yes') {

            $rules['qty'] = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->size = $request->size;
            $product->color = $request->color;
            $product->shipping_returns = $request->shipping_returns;
            $product->related_products = (!empty($request->related_products)) ? implode(',', $request->related_products) : '';
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->save();

            // save gallery img


            $request->session()->flash('success', 'Product updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        ;
    }

    public function destroy(Request $request, string $id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            $request->session()->flash('error', 'Product not found.');
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $productImages = ProductImage::where('product_id', $id)->get();

        if (!empty($productImages)) {
            foreach ($productImages as $productImage) {
                File::delete(public_path('uploads/product/large/' . $productImage->image));
                File::delete(public_path('uploads/product/small/' . $productImage->image));
            }

            ProductImage::where('product_id', $id)->delete();

        }
        $product->delete();

        $request->session()->flash('success', 'Product deleted successfuly.');

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully.'
        ]);

    }

    public function getProducts(Request $request){
        $tempProduct = [];
        if($request->term != ''){
            $products = Product::where('title', 'like', '%' . $request->term . '%')->get();

            if($products != null){
                foreach($products as $product){
                    $tempProduct[] = array('id' => $product->id, 'text' => $product->title);
                }
            }
        }

        // print_r($tempProduct);
        return response()->json([
            'tags' => $tempProduct,
            'status' => true
        ]); 
    }
}
