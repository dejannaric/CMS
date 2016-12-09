@extends('layouts.template')

@section("content2")
<div class="panel-heading">EDIT PAGE</div>
<div class="panel-body">
<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ route('update', $data[0]->id) }}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	    <label for="title" class="col-md-3 control-label">Title</label>

	    <div class="col-md-8">
	        <input type="text" class="form-control" name="title" value="{{$data[0]->title}}">

	        @if ($errors->has('title'))
	            <span class="help-block">
	                <strong>{{ $errors->first('title') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
	    <label for="keywords" class="col-md-3 control-label">Keywords</label>

	    <div class="col-md-8">
	        <input  type="text" class="form-control" name="keywords" value="{{$data[0]->keywords}}" >

	        @if ($errors->has('keywords'))
	            <span class="help-block">
	                <strong>{{ $errors->first('keywords') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	    <label for="description" class="col-md-3 control-label">Description</label>

	    <div class="col-md-8">
	        <input type="text" class="form-control" name="description" value="{{$data[0]->description}}">

	        @if ($errors->has('description'))
	            <span class="help-block">
	                <strong>{{ $errors->first('description') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
	    <label for="content" class="col-md-3 control-label">Content</label>

	    <div class="col-md-8">
	        <textarea name="content" class="form-control" cols="50" rows="10">{{$data[0]->content}}</textarea>

	        @if ($errors->has('content'))
	            <span class="help-block">
	                <strong>{{ $errors->first('content') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
		<label for="x" class="col-md-3 control-label">X os:</label>
		<div class="co-md-8">
			<input type="number" class="form-control" name="x" value="{{$imgData[0]->x}}">

	        @if ($errors->has('x'))
	            <span class="help-block">
	                <strong>{{ $errors->first('x') }}</strong>
	            </span>
	        @endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('y') ? ' has-error' : '' }}">
		<label for="y" class="col-md-3 control-label">Y os:</label>
		<div class="co-md-8">
			<input type="number" class="form-control" name="y" value="{{$imgData[0]->y}}">

	        @if ($errors->has('y'))
	            <span class="help-block">
	                <strong>{{ $errors->first('y') }}</strong>
	            </span>
	        @endif
		</div>
	</div>

	<div class="form-group">
	    <label for="img" class="col-md-3 control-label">Uploaded Image</label>
	    @if(isset($imgData[0]))
	    <span class="btn btn-danger" onClick="deleteImgFromContent({{$imgData[0]->id}})">Izbriši sliko</span><br>
	    <img class="img-responsive" id="" src="/files/{{$imgData[0]->img_name}}" style="width: 150px;height:150px;" >
	    @endif
	    <div class="col-md-8">
	        <input type="file" name="img">	        
	    </div>

	    
	</div>


	<div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Update page
            </button>

        </div>
    </div>

</form>
</div>
<script type="text/javascript">
	function deleteImgFromContent(id){
		if(confirm("Ali res želite izbrisati sliko?")){
			$.ajax({
				url: 'deleteImage/'+id,
				type: 'GET'

				
			});
			location.reload();

			
          
		}
	}
</script>
@endsection