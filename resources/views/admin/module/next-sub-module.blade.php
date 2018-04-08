@if(!empty($val['self_join']))
	<ul class="collapsible" data-collapsible="accordion">
		<li> @include('admin.module.create',['parent'=>$val['id'], 'title'=>$val['name'].' sub module'])</li>
		@foreach($val['self_join'] as $val)
		 <li>
	    	<div class="collapsible-header">{{ $val['name'] }}</div>
	    	<div class="collapsible-body">@include('admin.module.next-sub-module',$val) </div>
	    </li>
	    @endforeach
	</ul>
@endif