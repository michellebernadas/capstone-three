<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Comment;
use Illuminate\Http\Request;
use Auth;

class ThreadController extends Controller
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
    public function store(Request $request, $name, $id)
    {
         $detail=$request->thread_content;
 
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
 
        // $images = $dom->getelementsbytagname('img');
 
        // foreach($images as $k => $img){
        //     $data = $img->getattribute('src');
 
        //     list($type, $data) = explode(';', $data);
        //     list(, $data)      = explode(',', $data);
 
        //     $data = base64_decode($data);
        //     $image_name= time().$k.'.png';
        //     $path = public_path() .'/'. $image_name;
 
        //     file_put_contents($path, $data);
 
        //     $img->removeattribute('src');
        //     $img->setattribute('src', $image_name);
        // }
 
        $detail = $dom->savehtml();
        $thread = new Thread;
        $thread->subject = $request->subject;
        $thread->content = $detail;
        $thread->user_id = Auth::id();
        $thread->topic_id = $id;
        $thread->save();


        // return view('threads/{$name}/{$id}/{$thread_id}',compact('thread'));
        return redirect("/threads/$name/$id/$thread->subject/$thread->id");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread, $name, $id, $subject, $thread_id)
    {
        $thread = Thread::find($thread_id);
       // dd($threads);
        return view('/threads.show_list',compact('thread'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $thread = Thread::find($request->id);
        // print_r($thread);
        return view('/partials.edit_thread', compact('thread'));
    }

    
    public function update(Request $request,$id)
    {
        $thread = Thread::find($id);
        $thread->subject = $request->title;
        $thread->content = $request->content;
        $thread->save();

        $array= ['subject'=> $thread->subject, 'content' => $thread->content, 'updated' => $thread->updated_at->diffForHumans() 
        ];

        return $array;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread, $id)
    {   
        $thread = Thread::find($id);
        $thread->delete();

        return $id;

    }
}
