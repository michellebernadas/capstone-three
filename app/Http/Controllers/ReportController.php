<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Auth;


class ReportController extends Controller
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
        $report = new Report;
        $report->content = $request->content;
        $report->thread_id = $request->id;
        $report->user_id = Auth::id();
        $report->comment_id = 0;
        $report->save();

        // return view('threads/show_list')
    }

    public function comment_store(Request $request)
    {
        $report = new Report;
        $report->content = $request->content;
        $report->thread_id = $request->thread_id;
        $report->user_id = Auth::id();
        $report->comment_id = $request->comment_id;
        $report->save();

        return $report->comment_id; 
    }

    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
