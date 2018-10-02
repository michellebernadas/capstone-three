<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_comment = new Comment;
        $new_comment->content= $request->reply_thread;
        $new_comment->user_id=Auth::id();
        $new_comment->thread_id= $request->thread_id;
        $new_comment->save();
      
        $username = Auth::user()->username;
        $image = Auth::user()->image;

        $array= ['id'=>$new_comment->id, 'username'=>$username,'image'=>$image, 'content' => $new_comment->content, 
        'date_created' => $new_comment->created_at->diffForHumans()
        ];

        return $array;

        // return view('threads.show_list', compact('new_comment'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $commented = Comment::find($request->id);
        
        return view('partials.commented_thread', compact('commented'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->save();

        $array= [ 'content' => $comment->content, 'updated' => $comment->updated_at->diffForHumans() ];

        return $array;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, $id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return $id;
    }
}
