<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Topic;
use App\Thread; 
use App\Comment;
use App\User;
use Carbon\Carbon;
use Session;

class ForumController extends Controller
{
    function index() {

    	$categories = Category::all();
    	$topics = Topic::all();
        $threads = Thread::all();
        $users = User::all();
        // $users_desc = $users->threads()->orderBy('id', 'desc')->get();
        $comments = Comment::all();
        $first_thread = Thread::orderBy('id', 'DESC')->get()->first();
        $desc_thread = Thread::orderBy('id', 'DESC')->skip(0)->take(5)->get();
        $time= $first_thread->created_at->diffForHumans(null, null, false, 1, Carbon::ONE_DAY_WORDS);

        $today_threads  = Thread::whereDate('created_at', Carbon::today())->count();
        $today_comments  = Comment::whereDate('created_at', Carbon::today())->count();
        $today_users  = User::whereDate('id', Carbon::today())->get();

        $latest_user = User::orderBy('id', 'desc')->first();

        // dd($users_desc);

    	return view('/forum', compact('categories', 'topics', 'threads', 'first_thread', 'time', 'today_threads', 'comments', 'users', 'today_users', 'today_comments', 'desc_thread', 'latest_user'));
    }

    function add(Request $request) {
    	$new_category = new Category;
    	$new_category->title = $request->title;
    	$new_category->save();


    	Session::flash('success_message','Category Added Succesfully');
    	return redirect('/forum');

    }

    function store(Request $request) {
    	$new_topic = new Topic;
    	$new_topic->name = $request->name;
    	$new_topic->category_id = $request->category_id;
    	$new_topic->save();

    	Session::flash('success_message','Topic Added Succesfully');
    	return redirect('/forum');
    }

    function show($name, $id) {

        $name = $name;
        $id = $id;

        $threads = Thread::all();
        $first_thread = Thread::orderBy('id', 'DESC')->get()->first();

        // dd($threads[2]->comments[0]->user);
        // $comments = Comment::all();
        // $comments = $threads->comments()->with('user')->get();

        return view('threads.show_thread', compact('name', 'id', 'threads', 'first_thread'));

    }


    function post_thread($name, $id) {
        $name = $name;
        $id= $id;

        return view('threads.post_thread', compact('name','id'));
    }
}
