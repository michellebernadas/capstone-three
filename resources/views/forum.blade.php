@extends('template')

@section('title', 'Forum')
	{{-- <div class="forum_image">
        <h1>FORUMS</h1>
    </div>
 --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

@section('content')


<div class="register_message"></div>
<div class="row forum">

	<div class="col-9 main-content">

@if(Session::has('success_message'))
	<div class="alert alert-success mt-5">{{Session::get('success_message')}}</div>
@endif
	
		{{-- SEARCH BAR FORUM--}}
		<div class="input-group md-form form-sm form-2 pl-0">
		    <input class="form-control" id="search_thread" type="text" placeholder="Search For Threads" name="search_thread">
		    <div class="input-group-append">
		        <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fa fa-search" aria-hidden="true"></i></span>
		    </div>
		</div>

		<table class="table table-bordered table-hover">
			<thead>
			</thead>
			<tbody>
				
			</tbody>
		</table>

		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item"><a href="/home">Home </a></li>
		</ol>
@foreach($categories as $category)

	<div class="card mt-5 ml-2" data-aos="zoom-out"  id="cat{{$category->id}}">
		

		<div class="card-header" id="head{{$category->id}}">{{$category->title}}
			<i class="fas fa-angle-double-down float-right"></i>
		</div>
			<div class="card-body">
				<div class="row">
					{{-- <div class="col-12"> --}}
					@foreach($topics as $topic)
					@if($category->id == $topic->category_id )
					
						<div class="col-md-3 mt-3 mb-4">
							<img src="{{URL::asset('images/chat.png')}}">
							<a href="/forum/{{$topic->name}}/{{$topic->id}}" class="card-title" data-id="{{$topic->id}}">{{$topic->name}}</a>
						</div>
					
						<div class="col-md-2 mt-3 mb-4">
							<p class="discussion">Topics</p>
							<small>{{count($topic->threads)}}</small>
						</div>
					
						<div class="col-md-2 mt-3 mb-4">
							<p class="discussion">Replies</p>
							<small> 
							{{count($topic->comments)}}

							</small>
						</div>

						<div class="col-md-5 mt-3 mb-4">
							<p class="activity mb-3">Latest Activity</p>
							<div class="row">
								<div class="col-3">		

									@if($first_thread->topic_id == $topic->id)
                                    
									<img class="prof_img" src="/{{$first_thread->user->image}}" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'">
								
								</div>
								<div class="col-9">
									<p>
									{{$first_thread->subject}}

									</p>
									<p> {{$first_thread->created_at->toDayDateTimeString()}} </p>
										<strong>{{$first_thread->user->username}}</strong>
									@endif
								</div>
							</div>
						</div>
					@endif
					@endforeach
				</div> {{-- end of row --}}

				<hr>
				@if(Auth::user() && Auth::user()->role_id==1) 
					<button class="btn btn-outline-danger btn-remove" data-id="{{$category->id}}">Remove</button>      		
					<button class="btn btn-outline-primary btn-edit" data-id="{{$category->id}}">Edit</button>      		
        		@endif

			</div> {{-- end of card-body --}}
	</div> {{-- end of card --}}

@endforeach
	
	</div>

	{{-- REMOVE CATEGORY --}}
	<div class="modal fade" id="remove">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Remove Category</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	        Are you sure you want to remove this from the list?
	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer">
	        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
	      	<button class="btn btn-danger remove_list">Remove</button>
	      </div>

	    </div>
	  </div>
	</div>

		{{-- EDIT CATEGORY --}}
	<div class="modal fade" id="edit_category">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Edit Category</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	        	<div class="form-group row">
				  <label for="category" class="col-4 col-form-label">Category Name</label>
				  <div class="col-8">
				    <input class="form-control" type="text" id="category">
				  </div>
				</div>
	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer">
	        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
	      	<button class="btn btn-danger edit_list">Update</button>
	      </div>

	    </div>
	  </div>
	</div>

	<div class="col-3 side-content mt-5">
		
@if(Auth::user() && Auth::user()->role_id==1) 
		<button class="btn btn-primary mb-4" data-toggle="modal" data-target="#category_modal">Add Category</button>
		<button class="btn btn-success mb-4" data-toggle="modal" data-target="#topic_modal">Add Topic</button>
@endif

		{{-- CATEGORY MODAL --}}
		<div class="modal fade" id="category_modal">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Add Category</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        <div class="form-group row mx-auto">
			        <form action="/forum/add" method="POST" class="col-12">
			        	{{ csrf_field() }}
						<label for="title" class="col-2">Title:</label>
						<input required type="text" class="col-9" id="title" name="title">
				</div>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary" id="add">Add</a>
		      </div>
			        </form>
		    </div>
		  </div>
		</div>

		{{-- ADD TOPIC MODAL --}}
		<div class="modal fade" id="topic_modal">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Add Topic</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		      	<form action="forum/store" method="POST">
		      		{{ csrf_field() }}
			      	<div class="form-group row mx-auto">
						<label for="name" class="col-2">Name:</label>
						<input required type="text" class="form-control col-8" id="name" name="name">
					</div>
			      	<div class="form-group row mx-auto">
						<label for="category_id" class="col-3">Category</label>
						<select class="form-control col-8" name="category_id" id="category_id">
							@foreach ($categories as $category) 
								<option value='{{$category->id}}'>{{$category->title}}</option>
							@endforeach
						</select>
					</div>
			   </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-info" id="submit">Submit</button>
		      </div>
			   </form>

		    </div>
		  </div>
		</div>

		

		<div class="block-container ">
		  	<h5 class="online">Community Statistics</h5>
		  	<p>Threads: {{count($threads)}}</p>
		  	<p>Comments: {{count($comments)}}</p>
		  	<p>Members: {{count($users)}}</p>
		  	<p>Threads Last 24 Hours: {{$today_threads}}</p>
		  	<p>Comments Last 24 Hours: {{$today_comments}}</p>
		  	<p>Latest Member: {{$latest_user->username}}</p>
	
		</div> 



	<div class="block-container ">
		  	<h5 class="online text-center">Latest Threads</h5>
		  	
		  	@foreach($desc_thread as $thread)
		  	<div class="row mb-3">
		  		<div class="col-3 ">
		  		    @if($thread->user)
		  			<img class="act_image" src="/{{$thread->user->image}}" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'">
		  		</div>
		  		<div class="col-9">
		  		
				  	<strong>{{$thread->subject}}</strong> <br>
				  
					Latest: {{$thread->user->username}}	<br>
				    @endif
				    
				  	{{$thread->created_at->diffForHumans()}}
				
		  		</div>
		  	</div>
		  	@endforeach
		  	
		  	<hr>
		</div> 
	</div>



</div>


@endsection
