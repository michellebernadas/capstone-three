<div class="post_container mt-2">

		{{-- <form class="mx-auto" method="post" action="/threads/{{$name}}/{{$id}}"> --}}
			{{ csrf_field() }}
			{{ method_field('PATCH')}}
		  <div class="form-group">
		    <input type="text" class="form-control" id="edit_subject" name="subject" value="{{$thread->subject}}">

		  </div>
			<textarea id="thread" class="contents form-control" name="thread_content" value="{{$thread->content}}">
				{!!$thread->content!!}
			</textarea>

		{{-- </form> --}}

	</div>