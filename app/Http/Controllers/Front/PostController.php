<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Comment;
use App\Models\Reply;
use Carbon\Carbon;
use App\Mail\Websitemail;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('rPostCategory')->paginate(15);
        return view('front.blog', compact('posts'));
    }

    public function detail($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $latest_posts = Post::orderBy('id', 'desc')->limit(5)->get();
        $post_categories = PostCategory::orderBy('name', 'asc')->get();
        $post_date = Carbon::parse($post->created_at)->format('j F, Y');
        $post_tags = explode(',', $post->tags);
        $tags = Post::pluck('tags')->flatMap(function ($item) {
            return explode(',', $item);
        })->unique()->values();

        $total_comments = Comment::where('status', 'Active')->where('post_id',$post->id)->count();
        $comments = Comment::orderBy('id','asc')->where('status','Active')->where('post_id',$post->id)->get();

        return view('front.post', compact('post', 'latest_posts', 'post_categories', 'post_date', 'tags', 'post_tags', 'comments', 'total_comments'));
    }

    public function category($slug)
    {
        $post_category = PostCategory::where('slug', $slug)->first();
        $posts = Post::where('post_category_id', $post_category->id)->paginate(15);
        return view('front.category', compact('posts', 'post_category'));
    }

    public function tag($name)
    {
        $posts = Post::whereRaw("FIND_IN_SET(?, tags)", [$name])->paginate(15);
        $tag_name = $name;
        return view('front.tag', compact('posts', 'tag_name'));
    }

    public function comment_submit(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->status = 'Pending';
        $comment->save();

        // Send Email to Admin
        $subject = 'New Comment Submitted';
        $message = 'A new comment has been submitted on your blog post. Please login to your admin panel to approve it.<br>';
        $message .= '<a href="'.route('admin_comment').'">Click Here</a>';

        $admin_email = Admin::where('id',1)->first()->email;

        Mail::to($admin_email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Comment submitted successfully');
    }

    public function reply_submit(Request $request)
    {
        $request->validate([
            'reply' => 'required',
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $comment = new Reply();
        $comment->comment_id = $request->comment_id;
        $comment->reply = $request->reply;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->user_type = 'Visitor';
        $comment->status = 'Pending';
        $comment->save();

        // Send Email to Admin
        $subject = 'New Reply Submitted';
        $message = 'A new reply has been submitted on your blog post. Please login to your admin panel to approve it.<br>';
        $message .= '<a href="'.route('admin_reply').'">Click Here</a>';

        $admin_email = Admin::where('id',1)->first()->email;

        Mail::to($admin_email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Reply submitted successfully');
    }
}
