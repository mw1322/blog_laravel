<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\ErrorHandler\Debug;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'comment_body' => 'required|string'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with("message", "Comment body required");
            }
            $post = Post::where('slug', $request->post_slug)->where('status', '0')->first();
            if ($post) {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'comment_body' => $request->comment_body
                ]);
                return redirect()->back()->with("message", "Commented Successfully");
            } else {
                return redirect()->back()->with("message", "Post Not Available");
            }
        } else {
            return redirect('login')->with("message", "You are not Authorized");
        }
    }
    public function destroy(Request $request) // Delete The Comment
    {
        if (Auth::check()) {
            $comment = Comment::where('id', $request->comment_id)
                ->where('user_id', Auth::user()->id)
                ->first();


            if ($comment) { // for handling if user change the id through inspect
                $comment->delete();

                return response()->json([
                    'status' => 200,
                    'message' => "Comment Deleted Successfully"
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong"
                ]);
            }
        } else {
            return response()->json([
                'status' =>  401,
                'message' => "You Are Not Authorized",
            ]);
        }
    }
    public function update(Request $request)
    {

        // Debugbar::info($request->comment_id);

        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'comment_body' => 'required|string'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with("message", "Comment body required");
            }
            $comment = Comment::where('id', $request->comment_id)->first();
            if ($comment) {
                // Debugbar::info($request->comment_body);
                $comment->comment_body = $request->comment_body;
                $comment->update();

                return response()->json([
                    'status' => 200,
                    'commentBody' => $comment->comment_body,
                    'message' => "Comment Updated Successfully" // Corrected message
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong"
                ]);
            }
        } else {
            return response()->json([
                'status' =>  401,
                'message' => "You Are Not Authorized",
            ]);
        }
    }
}
