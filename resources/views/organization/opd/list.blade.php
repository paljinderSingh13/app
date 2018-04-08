@extends('layouts.org')
@section('content')

@include('organization.opd.create')
	
	<table>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<tbody>
			@foreach($data as $key => $val )
				<tr>
					<td>{{ $val->name  }}</td>
					<td> {{ $val->status  }}</td>
					<td> <a href="{{ route('opd',['id'=>$val->id]) }}"> Edit</a> | <a href="{{ url('admin/opd/delete') }}/{{ $val['id'] }}"> Delete </a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
<script type="text/javascript">
	
		
</script>
@endsection


