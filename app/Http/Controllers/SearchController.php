<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Topic;
use DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->content;
        $id= $request->id;

        $forum = Topic::find($id); 
        $search_thread = $forum->threads()->where('subject', 'LIKE', "%$query%")
                    ->get();

        return $search_thread;
    }  


    // public function searchThreads(Request $request)
    // {
    //     return Thread::where('subject', 'LIKE', '%'.$request->q.'%')->get();
    // }
     

    // public function search() {
    //     return view('forum');
    // }   

    // public function ajax(Request $request){

    //     $query = $request->get('query','');        

    //     $threads = Thread::where('subject','LIKE','%'.$query.'%')->get();        

    //     return response()->json($threads);

    // }


    // public function search(){
    //     return view ('/forum');
    // }

    public function search(Request $request) {
        if($request->ajax())
        {
            $output = "";
            $search = $request->search;
            $threads= DB::table('threads')->where('subject', 'LIKE', "%$search%")
                                ->orWhere('content', 'LIKE', "%$search%")->get();
                                    // ->get();

            if ($threads) {
                foreach ($threads as $thread) {
                //     return $thread;
            
                $output = '<tr>'.
                            '<td>'.
                                '<h5><strong><a href="/threads/{name}/{id}/'.$thread->subject.'/'.$thread->id.'">'.$thread->subject.'</a></strong></h5>'.
                                '<p><em>'.$thread->content.'</em></p>'.
                                '<p>'.$thread->created_at.'</p>'.               
                            '</td>'.
                            '<tr>';

                }

                return Response($output);
            } 
        }   

    }

}
