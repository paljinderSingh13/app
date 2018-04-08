@extends('layouts.admin')
@section('content')
@php
extract($data);
$parent=0;
@endphp

@include('admin.module.create', ['parent'=>0])

<div>
    <ul class="collapsible" data-collapsible="accordion">
        @foreach($modules as $key => $val )
        	<li>
		    <div class="collapsible-header">{{ $val['name'] }}</div>
		    <div class="collapsible-body"> 
		    	@include('admin.module.next-sub-module', $val)
		    </div>
		    </li>
        @endforeach
    
    
    </ul>

</div>


<script type="text/javascript">
	
		

</script>
@endsection


