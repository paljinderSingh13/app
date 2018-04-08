@if($val->self_join->isNotEmpty())
	<ul class="collapsible" data-collapsible="accordion">
		@foreach($val['self_join'] as $val)
		 <li>
	    	<div class="collapsible-header">
	    		@if(isset($role_module[$val->id]) && $role_module[$val->id]==1 )
	    		<input type="checkbox" checked="checked" class=" browser-default" id="{{ $val->id }}"   name="module_id[]" value="{{ $val['id'] }}" />
	    		@else
	    		<input type="checkbox" class=" browser-default" id="{{ $val->id }}"   name="module_id[]" value="{{ $val['id'] }}" />

	    		@endif
			      <label for="{{ $val->id}}">{{ $val['name'] }}</label></div>
	    	<div class="collapsible-body">@include('organization.permisson.sub-module',$val) </div>
	    </li>
	    @endforeach
	</ul>
@endif