<div class="container mt-2">
		 
			<textarea id="commented_thread" class="contents form-control">
				{!!$commented->content!!}
			</textarea>

		<script>
			$('#commented_thread').richText();
		</script>
	</div>