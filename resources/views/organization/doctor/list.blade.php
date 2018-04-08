@extends('layouts.org')
@section('content')

@include('organization.doctor.create')
	
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $key => $val )
				<tr>
					<td>{{ $val->name  }}</td>
					<td> {{ $val->status  }}</td>
					<td> <a href=""> Edit</a> | <a href="{{ url('admin/doctor/delete') }}/{{ $val['id'] }}"> Delete </a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
<script type="text/javascript">
	
		$(document).ready(function(){
			
		})

</script>
@endsection


