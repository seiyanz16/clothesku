<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::where('is_featured', 'yes')
            ->orderBy('id', 'desc')
            ->take(12)
            ->where('status', 1)->get();
        $data['featuredProducts'] = $products;

        // $latestproducts = Product::orderBy('id', 'ASC')
        //     ->where('status', 1)
        //     ->take(8)->get();
        // $data['latestProducts'] = $latestproducts;

        return view('front.home', $data);
    }

    public function addWishlist(Request $request)
    {
        if(Auth::check() == false) {

            session(['url.intended' => url()->previous()]);

            return response()->json([
                'status' => false
            ]);
        }

        $product = Product::where('id', $request->id)->first();

        if ($product == null) {
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-danger">Product not found.</div>'
            ]);
        }

        Wishlist::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id
            ]
        );

        session()->forget('url.intended');

        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success"><strong>'. $product->title .'</strong> added in your wishlist.</div>'
        ]);
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if($page == null) {
            abort(404);
        }
        return view('front.page',[
            'page' => $page
        ]);
    }
}
