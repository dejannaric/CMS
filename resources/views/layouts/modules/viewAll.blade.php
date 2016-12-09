@extends('layouts.template')

@section("content2")
<div class="panel-heading">VIEW ALL PAGES</div>
<div class="panel-body">
<ul class="list-group">
	@foreach($data as $page)
		
		
		<li class="list-group-item"><a href="{{ route('edit', $page->id) }}">{{$page->title}}</a>

	 		<a href="{{ route('edit', $page->id) }}">
	    		<span class="glyphicon glyphicon-edit"></span>
			</a>
			<a href="{{ route('delete', $page->id) }}">
	    		<span style="float: right;" class="glyphicon glyphicon-remove"></span>
			</a>
  		</li>

	@endforeach
</ul>

  
</div>


@endsection

