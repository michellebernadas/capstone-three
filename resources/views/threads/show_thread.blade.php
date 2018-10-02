@extends('template')

@section('title', 'Thread')
{{-- 	<div class="forum_image">
        <h1>FORUMS</h1>
    </div> --}}

@section('content')

{{-- </form> --}}
<div class="search-container">


<ol class="breadcrumb mt-5">
  <li class="breadcrumb-item"><a href="/home">Home</a></li>
  <li class="breadcrumb-item"><a href="/forum">Forum</a></li>
</ol>
	@if(Auth::user())
	<a href="/forum/{{$name}}/{{$id}}/post_thread" class="btn btn-info mt-5">Post Thread</a>
	@else
	<div class="alert alert-primary">You Must Sign In or Register To Post A Thread</div>
	<a href="/login" class="btn btn-info mt-5">Login</a>
	<a href="/register" class="btn btn-info mt-5">Register</a>
	@endif
	<button class="btn btn-primary mt-5" id="show">SHOW ALL</button>
	
	{{-- <form action="/search" method="POST" role="search" class="mt-5 input-group"> --}}
	    {{ csrf_field() }}
	<div class="input-group md-form form-sm form-2 pl-0 mt-5">
	    <input class="form-control search my-0 py-1 " type="text" id="search_area" placeholder="Search" data-id="{{$id}}" aria-label="Search">
	    <div class="input-group-append">
	        <span class="input-group-text amber lighten-3" id="search_bar"><i class="fa fa-search text-grey" aria-hidden="true"></i></span>
	    </div>
	</div>

</div>

	<div class="mt-5">
			<table class=" table-hover">
			  <thead>
			    <tr>
			      <th scope="col">Topic</th>
			      <th scope="col">Users</th>
			      <th scope="col">Replies</th>
			      <th scope="col">Latest Activity</th>
			    </tr>
			  </thead>
			  {{-- {{$search_thread}} --}}
			@foreach($threads as $thread)
			@if($id == $thread->topic_id)
{{-- @if ($thread->subject == $search_thread->) --}}
			  <tbody id="{{$thread->id}}">
			    <tr class="thread" >
			      <td><a href="/threads/{{$name}}/{{$id}}/{{$thread->subject}}/{{$thread->id}}"> {{$thread->subject}} </a></td>

			      <td>{{count($thread->comments()->with('user')->get())}}</td>
			      <td>{{$first_thread->created_at->format('l \\of F, Y \\a\\t g:i:s a')}}</td>
			      <td></td>
			    </tr>
			   
			  </tbody>
			@endif
			@endforeach
{{-- @endif --}}
			</table>
		
	</div>

@endsection