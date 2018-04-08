@extends('layouts.org')
@section('content')
@php
extract($data);
dump($data);
@endphp
<style type="">
	
	.input-field label {
  pointer-events: auto;
}
</style>
<div>

	{{ Form::open(['route'=>'permisson.save']) }}
	{{ Form::text('role_id',$role_id) }}
	
    <ul class="collapsible" data-collapsible="accordion">
        @foreach($module as $key => $val )
        	<li>
		    
			    <div class="collapsible-header">
			    	@if(isset($role_module[$val['id']]) && $role_module[$val['id']]==1 )
			    		<input type="checkbox"  checked='checked' class=" browser-default" id="{{ $val['id'] }}"   name="module_id[]" value="{{ $val['id'] }}" />
			    	@else
			    		<input type="checkbox" class=" browser-default" id="{{ $val['id'] }}"   name="module_id[]" value="{{ $val['id'] }}" />
			    	@endif
				      <label for="{{ $val['id']}}">{{ $val['name'] }}</label>
				</div>

		    	<div class="collapsible-body">
			    
			    	@if($val->self_join->isNotEmpty())
			    		@include('organization.permisson.sub-module', $val)
			    	@else
			    		<input type="checkbox" class="browser-default offset-s3" id="test5" />
			    		<p> <input type="checkbox" id="test5" /> </p>
			    		
			    	@endif

		    	</div>
		    	
		    </li>
        @endforeach
    </ul>

    
    {{ Form::submit()}}
    {{ Form::close() }}

</div>

@endsection