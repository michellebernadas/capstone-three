@extends('template')

@section('title', 'Profile')
	{{-- <div class="profile_image">

        <h1>WELCOME {{Auth::user()->first_name}}</h1>
    </div> --}}
@section('content')
	
	<div class="margin-container">	
		<div class="card profile mt-5">
			<div class="row pt-5">
				<div class="col-4 ml-5">
					<div class="prof_holder">

	            		<img class="prof_image" src="{{Auth::user()->image}}" data-toggle="modal" data-target="#image" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'">	
					</div>

					<div class="row">
		                <div class="col-6 offset-2 mt-3 mb-5">
		                    <h2 id="prof_username">{{Auth::user()->username}}</h2>
		                </div>
		        	</div>
				</div> {{-- ebd of col-4 --}}

				<div class="col-7">

					<ul class="nav nav-tabs" role="tablist">
					  <li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#about" role="tab">About</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#edit" role="tab">Edit</a>
					  </li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="about" role="tabpanel">
							<div class="row mt-4">
									<p>Full Name: </p>
									<span id="first_name" class="pl-2"> {{Auth::user()->first_name}}</span>
									<span id="last_name" class="pl-1"> {{Auth::user()->last_name}}</span>
							</div>
							<div class="row">
									<p>Email: </p>
									<span id="email" class="pl-2">{{Auth::user()->email}}</span>
							</div>
							<div class="row">
									<p>Joined: </p>
									<span class="pl-2">{{Auth::user()->created_at}}</span>
							</div>

						</div> {{-- end of tab-pane about --}}

						<div class="tab-pane fade" id="edit" role="tabpanel"><div class="success_message"></div>			
		                    <form role="form">
		                    	{{ csrf_field() }}
		                        <div class="form-group row mt-3">
		                            <label class="col-lg-3 col-form-label form-control-label">First name</label>
		                            <div class="col-lg-9">
		                                <input class="form-control" type="text" id="first_name" value="{{Auth::user()->first_name}}">
		                            </div>
		                        </div>
		                        <div class="form-group row">
		                            <label class="col-lg-3 col-form-label form-control-label">Last name</label>
		                            <div class="col-lg-9">
		                                <input class="form-control" type="text" id="last_name" value="{{Auth::user()->last_name}}">
		                            </div>
		                        </div>
		                        <div class="form-group row">
		                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
		                            <div class="col-lg-9">
		                                <input class="form-control" type="email" id="email" value="{{Auth::user()->email}}">
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label class="col-lg-3 col-form-label form-control-label">Username</label>
		                            <div class="col-lg-9">
		                                <input class="form-control" type="text" id="username" value="{{Auth::user()->username}}">
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <div class="offset-4 mt-4">
		                                <button type="button" class="btn btn-primary" id="update" data-id="{{Auth::user()->id}}">Save Changes</button>
		                            </div>
		                        </div>
		                    </form>

						</div> {{-- end of tab-pane edit --}}
							
					</div> {{-- end of tab-content --}}



				</div> {{-- end of col-8 --}}

				
			</div> {{-- end of row --}}
			
		</div> {{-- end of card --}}
	</div>

	{{-- CHANGE IMAGE MODAL --}}
	<div class="modal fade" id="image">
			  <div class="modal-dialog">
			    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Change Picture</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		      	<form method="POST" enctype="multipart/form-data" action="/user/{{Auth::user()->id}}">
		      		{{ csrf_field() }}
		      		{{ method_field('PATCH')}}
			        <div class="form-group-row image-holder mx-auto">
			        	<div class="center_image">
				        	@if ("{{Auth::user()->image}}")
        						<img class="user_img" src="{{Auth::user()->image}}">
        					@endif
    					</div>
			        </div>
				        <div class="form-group-row mt-4">
	                            <label for="image" class="col-md-4 col-form-label text-md-right"></label>
	                            <input id="image" type="file" name="image" >
	                    </div>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button class="btn btn-success">Change</button>
		      </div>

	        	</form>
	    </div>
	  </div>
	</div>



	{{-- USER ACTIVITY --}}
		<ul class="nav nav-tabs" role="tablist">
		  <li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#activity" role="tab">Latest Activity</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#alerts" role="tab">Alerts</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#postings" role="tab">Postings</a>
		  </li>
		  @if(Auth::user()->role_id==1)
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#reports" role="tab">Reports</a>
		  </li>	
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#users" role="tab">Users</a>
		  </li>	
		  @endif					 							  
		</ul>

	<!-- Tab panes -->
		<div class="tab-content">
		  <div class="tab-pane active" id="activity" role="tabpanel"> 	
			<table class="table table-hover table-striped">
                <tbody class="activity">
      
                	@foreach($comments as $comment)
                	@foreach($threads as $thread)
                	@if($thread->id == $comment->thread_id)
                	
                    <tr>
                        <td class="activity">
                        	<div class="row">
                        	<div class="col-1">
							<img class="prof_img" src="/{{Auth::user()->image}}" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'">
							</div>
							<div class="col-10">
                            <strong>{{Auth::user()->username}}</strong><span> commented </span> on <strong>{{$thread->subject}}</strong>
                            <span>{!! $comment->content !!}</span>
                            <p>{{$comment->created_at->format('F j, Y g:i:s a')}}</p>
                            </div>
							</div>
                        </td>
                    </tr>
                    
                    @endif
            {{-- {{ $threads->links() }} --}}
                    @endforeach
                    @endforeach
                </tbody>
            {{-- {{ $comments->links() }} --}}
            </table>	

		 </div> {{-- end of tab-pane activity  --}}

		  <div class="tab-pane" id="alerts" role="tabpanel"> 

            <table class="table table-hover table-striped">
                <tbody class="activity">
      
                	@foreach($thread_user as $thread)
                	@foreach($all_comments as $comment)
                    @if($comment->thread_id == $thread->id)
                	
                    <tr>
						<td class="activity">
                        	<div class="row">
                        	<div class="col-1">
                        		@if(isset($comment))
							<img class="prof_img" src="/{{$comment->user->image}}" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'">
							</div>
							<div class="col-10">
                            <strong>{{$comment->user->username}}</strong><span> replied to your thread  </span> <strong>{{$thread->subject}}</strong>
                            <span>{!! $comment->content !!}</span>
                            <p>{{$comment->created_at->format('F j, Y g:i:s a')}}</p>
                            	@endif
                            </div>
							</div>
                        </td>
                    </tr>
                    
                    @endif
                    @endforeach
                    @endforeach
                </tbody>
            </table>	
		  </div> {{-- end of tab-pane alerts --}}
		 
		  <div class="tab-pane" id="postings" role="tabpanel"> 

		  	 <table class="table table-hover table-striped">
                <tbody class="activity">
      
                	@foreach($threads as $thread)
		  			@if($thread->user_id== Auth::id())
                	
                    <tr>
						<td class="activity">
                        	<div class="row">
                        	<div class="col-1">
							<img class="prof_img" src="/{{Auth::user()->image}}" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'">
							</div>
							<div class="col-10">
                            <strong>{{$thread->subject}}</strong>
                            <span>{!! $thread->content !!}</span>
                            <p>{{$thread->created_at->format('F j, Y g:i:s a')}}</p>
                            </div>
							</div>
                        </td>
                    </tr>
                    
                    @endif
                    @endforeach
                </tbody>
            </table>	
		  </div> {{-- end of tab-pane posting --}}
		  
		  
		   {{-- DELETING REPORTED THREAD --}}
		<div class="modal fade" id="reported_flagthread">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header delete">
		        <h4 class="modal-title">Delete Thread</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        Are you sure you want to permanently delete the thread?
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-danger report_thread">Delete</button>
		      </div>

		    </div>
		  </div>
		</div>
		

		   <div class="tab-pane" id="reports" role="tabpanel">


			<table class="table table-hover table-striped">
                <tbody class="activity">
      
                	@foreach($reports as $report)
                	

                    <tr>
						<td class="activity">
                        	<div class="row">
	                        	<div class="col-1">
	                        	    @if($report->user)
								<img class="prof_img" src="/{{$report->user->image}}" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'">
								</div>
								<div class="col-10">
	                            <strong>{{$report->user->username}}  <strong>
	                            <p>{{$report->content}}</p>
	                            <p>{{$report->created_at->format('F j, Y g:i:s a')}}</p>
	                            	<div class="box">
	                             		<strong>{!!$report->thread['subject']!!}  </strong>
	                            	
	                             		<strong>{!!$report->thread['content']!!}  </strong>

	                            	</div>
	                            	@endif
	                            </div>
							</div>
                        </td>
                    </tr>
                 
                    @endforeach
                </tbody>
            </table>	

		   </div> {{-- end of tab-pane reports --}}

         <div class="tab-pane" id="users" role="tabpanel">

		   	{{-- NAVTABS FOR ACTIVE/DEACT USERS --}}
		   	<ul class="nav nav-tabs" role="tablist">
			  <li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#active" role="tab">Active Users</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#deactive" role="tab">Deactivated Users</a>
			  </li>
			</ul>

		<div class="tab-content">
		  <div class="tab-pane active" id="active" role="tabpanel">

		  		<div class="row user">

		   	@foreach($users as $user)
		   	{{--ACTIVE MEMBER USERS --}}
		   
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p>
                                    <img class="img-fluid" src="/{{$user->image}}" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'" alt="User Image">
                                    </p>
                                    <h4 class="card-title">{{$user->first_name}} {{$user->last_name}}</h4>
                                    <p class="card-text">Username: {{$user->username}}</p>
                                    <p class="card-text">Joined: {{$user->created_at->format('F j, Y ')}}</p>
                                    <p class="card-text">Status: {{$user->role->name}}</p>

                                </div>
                            </div>
                        </div>
                        <div class="backside">

                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <h4 class="card-title">{{$user->username}}</h4>
                                    <p class="card-text">
                                    	@if($user->role_id == 1)
                                    	<a href="/users/regular/{{$user->id}}" class="btn btn-outline-primary regular">Make Regular</a>
                                    	@else
                                    	<a href="/users/admin/{{$user->id}}" class="btn btn-outline-danger admin">Make Admin</a>
                                    	@endif

                                    	<button class="btn btn-primary deactivate" data-id="{{$user->id}}">Deactivate User</button>
                                    </p>
                                    <ul class="list-inline">
		                                <li class="list-inline-item">
		                                    <a class="social-icon text-xs-center" target="_blank" 
		                                    href="https://www.facebook.com/">
		                                        <i class="fa fa-facebook"></i>
		                                    </a>
		                                </li>
		                                <li class="list-inline-item">
		                                    <a class="social-icon text-xs-center" target="_blank" href="https://twitter.com/?lang=en">
		                                        <i class="fa fa-twitter"></i>
		                                    </a>
		                                </li>
		                                <li class="list-inline-item">
		                                    <a class="social-icon text-xs-center" target="_blank" 
		                                    href="https://www.skype.com/en/">
		                                        <i class="fa fa-skype"></i>
		                                    </a>
		                                </li>
		                                <li class="list-inline-item">
		                                    <a class="social-icon text-xs-center" target="_blank" 
		                                    href="https://plus.google.com/">
		                                        <i class="fa fa-google"></i>
		                                    </a>
		                                </li>
		                            </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
		   		
		   	</div>

		   	</div> {{-- end of tab-pane active --}}

		   	<div class="tab-pane active" id="deactive" role="tabpanel">
		  	
		   	<div class="row user">

		   	@foreach($deactive_users as $user)
		   	
		   	{{--DEACTIVE MEMBER USERS --}}
		   
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p>
                                    <img class="img-fluid" src="/{{$user->image}}" onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'" alt="User Image">
                                    </p>
                                    <h4 class="card-title">{{$user->first_name}} {{$user->last_name}}</h4>
                                    <p class="card-text">Username: {{$user->username}}</p>
                                    <p class="card-text">Joined: {{$user->created_at->format('F j, Y ')}}</p>
                                    <p class="card-text">Status: {{$user->role->name}}</p>

                                </div>
                            </div>
                        </div>
                        <div class="backside">

                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <h4 class="card-title">{{$user->username}}</h4>
                                    <p class="card-text">
                                    	@if($user->role_id == 1)
                                    	<a href="/users/regular/{{$user->id}}" class="btn btn-outline-primary regular">Make Regular</a>
                                    	@else
                                    	<a href="/users/admin/{{$user->id}}" class="btn btn-outline-danger admin">Make Admin</a>
                                    	@endif

                                    	<a href="/user/activate/{{$user->id}}" class="btn btn-primary activate" data-id="{{$user->id}}">Activate User</a>
                                    </p>
                                    <ul class="list-inline">
		                                <li class="list-inline-item">
		                                    <a class="social-icon text-xs-center" target="_blank" 
		                                    href="https://www.facebook.com/">
		                                        <i class="fa fa-facebook"></i>
		                                    </a>
		                                </li>
		                                <li class="list-inline-item">
		                                    <a class="social-icon text-xs-center" target="_blank" href="https://twitter.com/?lang=en">
		                                        <i class="fa fa-twitter"></i>
		                                    </a>
		                                </li>
		                                <li class="list-inline-item">
		                                    <a class="social-icon text-xs-center" target="_blank" 
		                                    href="https://www.skype.com/en/">
		                                        <i class="fa fa-skype"></i>
		                                    </a>
		                                </li>
		                                <li class="list-inline-item">
		                                    <a class="social-icon text-xs-center" target="_blank" 
		                                    href="https://plus.google.com/">
		                                        <i class="fa fa-google"></i>
		                                    </a>
		                                </li>
		                            </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @endforeach
		   		
		   	</div>

		   </div> {{-- end of tab-pane deactive users --}}
		   

		</div> {{-- end of tab-content --}}

    
@endsection