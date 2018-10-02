@extends('template')

@section('title', 'Post Thread')
	{{-- <div class="forum_image">
        <h1>FORUMS</h1>
    </div> --}}

@section('content')

<div class="post_margin"></div>
<ol class="breadcrumb mt-5">
	  <li class="breadcrumb-item"><a href="/home">Home</a></li>
	  <li class="breadcrumb-item"><a href="/forum">Forum</a></li>
	  <li class="breadcrumb-item"><a href="/forum/{{$name}}/{{$id}}">{{$name}}</a></li>
</ol>


		<div class="row mt-5">
			<h2>Post Thread</h2>
		</div>

	<div class="post_container mt-2">
		{{-- @if($id==$id && $name==$name) --}}
		{{-- @if($thread_subject) --}}
		<form class="mx-auto" method="post" action="/threads/{{$name}}/{{$id}}">
			{{ csrf_field() }}
		  <div class="form-group">
		    <input type="text" class="form-control" id="subject" name="subject" placeholder="Thread Title">
		  </div>
				
			<textarea id="thread_content" class="contents" name="thread_content">
			</textarea>

			<button type="submit" class="btn btn-primary" id="post_btn">Post Thread</button>
		</form>
		{{-- @endif --}}
	</div>
	

@endsection