<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function reviewStore(Request $request){

        $product_id = $request->product_id;

        $request->validate([
            'summary' => 'required',
            'comment' => 'required',
        ]);

        $review = new Review();
        $review->product_id = $product_id;
        $review->user_id = Auth::id();
        $review->comment = $request->comment;
        $review->summary = $request->summary;
        $review->status = 0;
        $review->save();

        $notification =  array(
            'message' => 'Review Will Approve By Easy Shop',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    }

    public function pendingReview(){
        $reviews = Review::where('status', 0)->orderBy('id', 'desc')->get();

        return view('backend.review.pending_review', compact('reviews'));
    }

    public function reviewApprove($id){

        $review = Review::findOrFail($id);
        $review->status = 1;
        $review->update();

        $notification =  array(
            'message' => 'User Review Approved Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function publishedReview(){
        $reviews = Review::where('status', 1)->get();

        return view('backend.review.published_review', compact('reviews'));
    }

    public function deleteReview($id){
        $review = Review::findOrFail($id);

        $review->delete();

        $notification =  array(
            'message' => 'Review Delete Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
