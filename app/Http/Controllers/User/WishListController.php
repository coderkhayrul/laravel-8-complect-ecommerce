<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function viewWishlish(){
        return view('frontend.wishlist.view_wishlist');
    }

    public function getWishlishProduct(){

        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();

        return response()->json($wishlist);
    }

    public function removeWishlishProduct($id){

        $wishlist = Wishlist::where('user_id', Auth::id())->where('id',$id)->delete();

        return response()->json([
            'success' => 'Successfully Delete Your Wishlist'
        ]);
    }

}
