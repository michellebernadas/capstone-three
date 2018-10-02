<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
Use App\Thread;
use App\Comment;
use App\Report;
use Auth;
use App\Like;


class UserController extends Controller
{
    function index() {

        $comments= Auth::user()->comments;
        $threads= Thread::all();
        $thread_user = Auth::user()->threads;
        $all_comments = Comment::all();
        $reports = Report::all();
        $users= User::all();
        $deactive_users = User::onlyTrashed()->get();
  
    	return view('profile', compact( 'comments', 'threads', 'thread_user', 'all_comments', 'reports', 'likes', 'users', 'deactive_users'));
    }

    function update(Request $request, $id) {
    	$user = User::find($id);
    	$user->first_name= $request->first_name;
    	$user->last_name= $request->last_name;
    	$user->email= $request->email;
    	$user->username= $request->username;
    	$user->save();

        return $user;
    }

    function updateImage(Request $request, $id) {
    	$user = User::find($id);

    	 if ($request->file('image')) {

            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();
            $fileName= uniqid('update', true) . "." . $extension;
            $file->move('uploads/images/',$fileName);

            $user->update(['image'=>"uploads/images/{$fileName}"]);

            $user->save();
        }

        return redirect('/user');

    }
    
    function regular(Request $request, $id) {
        $user = User::find($id);
        $user->role_id= 2;
        $user->save();

        return redirect('/user');
    }

    function admin(Request $request, $id) {
        $user = User::find($id);
        $user->role_id= 1;
        $user->save();

        return redirect('/user');
    }

    public function deactivate(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();

        return $id;
    }

    public function activate(Request $request, $id)
    {
      
        $user = User::withTrashed()->find($id)->restore();

        return redirect('/user');

        return $id;
    }
}
