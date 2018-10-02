@extends('template')

@section('title', 'Threads')
	{{-- <div class="forum_image">
        <h1>THREADS</h1>
    </div> --}}

@section('content')

	<div class="container thread mt-5">

<div class="margin">

	<ol class="breadcrumb mt-5">
	  <li class="breadcrumb-item"><a href="/home">Home</a></li>
	  <li class="breadcrumb-item"><a href="/forum">Forum</a></li>
	@if(isset($thread))
	  <li class="breadcrumb-item"><a href="/forum/{{$thread->topic->name}}/{{$thread->topic->id}}">{{$thread->topic->name}}</a></li>
	</ol>
</div>
		<h2 id="topic_subject" ">{{ $thread->subject }}</h2>
		<hr>
		
		<div class="flag_message"></div>

		<ul class="list-unstyled thread mb-5" id="{{ $thread->id }}">
		  <li class="media">
		  	@if(isset($thread->user))
		    <img class="mr-3 thread_image" src="/{{$thread->user->image}}" alt="User Image" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'">
		    <div class="media-body col-9 mt-3">
		      <h5 class="mt-0 mb-4">{{$thread->user->username }}</h5>
		    @endif
		      <div class="content mb-4" id="content">
		      		{!! $thread->content !!}	
		      </div>
		    </div>
		    <div class="media-body col-3 mt-3 text-right">
		    	
		    	<p class="thread_time">{{$thread->updated_at->diffForHumans()}}</p>
		    </div>
		  </li>
		  <hr>

		  <div class="row">
		    @if(Auth::user())

		    @if(!Auth::user()->likes->contains($thread))
		    	<a href="/{{$thread->id}}/like"><i class="col-md-6 far fa-heart" id="like" data-id="{{$thread->id}}"></i></a>
			@else
				<a href="/{{$thread->id}}/unlike"><i class="col-md-6 far fa-heart" id="unlike" data-id="{{$thread->id}}"></i></a>
			@endif


			@if(count($thread->likes)>0)
				<span class="float-left"> {{count($thread->likes)}}</span>
			@endif
			

		    <div class="col-md-6 text-right pr-4">
		    	{{-- <i id="comment_image" data-id="{{$thread->id}}" class="fas fa-comment-dots mr-2"></i> --}}
		    	@if(Auth::id()==$thread->user_id)
		    		<i id="edit_image" data-id="{{ $thread->id }}" class="fas fa-edit mr-2"></i>
		    		<i class="fas fa-trash mr-2"  data-toggle="modal" data-target="#delete"></i>
		    	@endif

		    	<i id="thread_flag" class="fas fa-flag" data-id="{{ $thread->id }}"></i>
		    </div>
		    @endif
		  </div>
		</ul>

		{{-- EDIT MODAL THREAD --}}
		<div class="modal fade" id="edit">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Edit Thread</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        @include('partials.edit_thread')
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="update_thread" data-id="{{ $thread->id }}">Update</button>
		      </div>

		    </div>
		  </div>
		</div>


		{{-- DELETE MODAL THREAD --}}
		<div class="modal fade" id="delete">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Delete Thread</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        Are you sure you want to delete your Thread?
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" id="thread_delete" class="btn btn-danger" data-id="{{ $thread->id }}">Delete</button>
		      </div>

		    </div>
		  </div>
		</div>

		{{-- FLAG MODAL THREAD --}}
		<div class="modal fade" id="report">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Report Thread</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		      	<div class="row">
		        	<textarea id="report_thread" class="form-control mx-4" rows="7" placeholder="Report Content"></textarea>
		        </div>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="report_thread" data-id="{{ $thread->id }}">Report</button>
		      </div>

		    </div>
		  </div>
		</div>

	<div class="comment_report"></div>


	<div class="comment-container">
		@foreach($thread->comments as $comment)
		{{-- @if($thread->id == $comment->thread_id) --}}

			<ul class="list-unstyled replies" id="{{ $comment->id }}">

				<li class="media">
				    <img class="mr-3 thread_image" src="/{{$comment->user->image}}" alt="User Image" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'">
				    <div class="media-body col-9 mt-3">
				      <h5 class="mt-0 mb-4">{{$comment->user->username }}</h5>
				      <div class="comment_content mb-4" id="comment{{ $comment->id }}">
				      		{!! $comment->content !!}	
				      </div>
				    </div>
				    <div class="media-body col-3 mt-3 text-right">
				    	
				    	<p class="comment_time" id="time{{ $comment->id }}">{{$comment->updated_at->diffForHumans()}}</p>
				    </div>
				 </li>
				 <hr>

				  <div class="row">
				    
				 
				    {{-- <i class="col-md-6 far fa-heart"></i> --}}
				    <div class="col-md-12 text-right pr-4 mb-5">
				    	{{-- <i id="comment_image" data-id="{{$comment->id}}" class="fas fa-comment-dots mr-2"></i> --}}
				    	@if(Auth::id()==$comment->user_id)
				    		<i data-id="{{ $comment->id }}" class="fas fa-edit mr-2 comment_edit_image"></i>
				    		<i class="fas fa-trash mr-2 trash" data-id="{{ $comment->id }}"></i>
				    	@endif
				    		<i class="fas fa-flag flag" data-id="{{ $comment->id }}" id="flag{{ $comment->id }}"></i>
				    </div>
				   
				  </div>
			</ul>
		{{-- @endif --}}
		@endforeach
	</div> {{-- end of comment container --}}
		
			<div class="deleted_thread"></div>


		@if(Auth::user())
		<div class="reply_container">
			<textarea id="thread_content" class="contents"></textarea>
			<button class="btn btn-info" id="reply_thread" data-index="{{ $thread->id }}">POST REPLY</button>
		</div>
		@else
		<div class="alert alert-primary" role="alert">
			You Must Sign In or Register To Reply To This  Thread
		</div>
		@endif
    </div>


{{-- 
    @if(isset($comment)) --}}
    	{{-- EDIT MODAL COMMENT --}}
		<div class="modal fade" id="comment_edit">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Edit Comment</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
				<div class="container mt-2">
						<textarea id="commented_thread" class="contents form-control">
							
						</textarea>
				</div>

		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		      	{{-- @if(isset($comment)) --}}
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary comment_update" data-id="">Update</button>
		        {{-- @endif --}}
		      </div>

		    </div>
		</div>
	</div>

	{{-- DELETE MODAL COMMENT --}}
		<div class="modal fade" id="comment_delete">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header delete">
		        <h4 class="modal-title">Delete Comment</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        Are you sure you want to delete your Comment?
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-danger comment_delete">Delete</button>
		      </div>

		    </div>
		  </div>
		</div>

		{{-- REPORT FLAG MODAL COMMENT --}}
		<div class="modal fade" id="report_comment">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header comment_flag">
		        <h4 class="modal-title">Report Comment</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        <div class="row">
		        	<textarea class="form-control mx-4" rows="7" id="commentflag_content" placeholder="Report Content"></textarea>
		        </div>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-danger comment_flag" data-id="{{ $thread->id }}">Report</button>
		      </div>

		    </div>
		  </div>
		</div>
	{{-- @endif --}}

    @endif

@endsection