@if(session('status'))
	<div class="alert alert-success alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <strong id="res">{{ session('status') }}</strong> 
	</div>      			
@endif