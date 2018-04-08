@extends('layouts.front')
@section('content')
@php
	$days = [ 1=>"Monday", 2=>"Tuesday", 3=>"Wednesday", 4=>"Thursday", 5=>"Friday" , 6=>"Saturday",  7=>"Sunday"];
@endphp
@if(Session::has('error'))
    <div class="card-panel orange lighten-2">{{ Session::get('error') }}</div>
@endif
@if(Session::has('success'))

    <div class="card-panel  light-blue lighten-1">{{ Session::get('success') }}</div>
             
@endif

<div class="row">
        <div class="col s12 ">
          <div class="col s6 card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">{{ $data['name'] }}</span>
              <p>{{ $data['doctor_detail']['name'] }} I am a very simple card. I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
          <div class="col s6">
  			<ul class="collapsible popout" data-collapsible="accordion">
			    <li>
			      <div class="collapsible-header"><i class="material-icons"></i>Book Appointment</div>
			      <div class="collapsible-body">
@if(!auth::check())
			      	<div class="row">
			      <form class="form-horizontal" method="POST" action="{{ route('patient.login') }}">
			      	{{ csrf_field() }}
				        <div class="col s12">
				        	

				          <div class="input-field inline">
				            <input id="email" name="email" type="email" class="validate">
				            <label for="email" data-error="wrong" data-success="right">Email</label>
				          </div>
				        </div>
				        <div class="col s12">
				          Password:
				          <div class="input-field inline">
				           <input name="password" id="password" type="password" class="validate">
          					<label for="password">Password</label>
				          </div>
				        </div>

<input type="submit" class="waves-effect waves-light btn">
</form>


   

				      </div>
@else
{!! Form::open(['route'=>'appointment.save']) !!}
<div class="row">
	<div class="col s12">
	  <div class="input-field inline">
		<input type="text" name="date" class="datepicker">
	    <label>Date of Appointment</label>
	  </div>
	</div>
</div>
<div class="row">
	<div class="input-field col s12">
		<input type="text" name="opd_id" value="{{$data['id']}}">
				        	<input type="text" name="patient_id" value="{{Auth::id() }}">
		{!! Form::select('shift_id',$shift,null,['placeholder'=>"Choose shift"]) !!}
   
    <label>Choose Shift</label>
  </div>
</div>
{!! Form::submit() !!}

{!! Form::close() !!}

@endif



          					  
				  </div>
			    </li>
			    
			  </ul>
    <!-- Card Content -->
  		</div>
        </div>
      </div>


            

      <table>
      	<tr>
      		<th>Day</th>
      		<th>Shift</th>
      		<th>Opening Time</th>
      		<th>Closing Time</th>
      	</tr>
      	{{-- {{  dd( $data['opd_detail']->groupBy('day')->toArray()) }} --}}
      	@foreach($data['opd_detail'] as $key => $val)
      		<tr>
      			<td>{{ $days[$val['day']] }}</td>
      			<td>{{ $val['shift']['name'] }}</td>
      			<td>{{ $val['start_time'] }}</td>
      			<td>{{ $val['end_time'] }}</td>
      		</tr>
      	@endforeach
      </table>
      <script type="text/javascript">
      	$(document).ready(function() {
    		$('select').material_select();
  		});


  		 $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: 200, 
            format: 'dd-mm-yyyy'
        });
      	
// $('.datepicker').pickadate({
// selectMonths: true, // Creates a dropdown to control month
// selectYears: 15, // Creates a dropdown of 15 years to control year,
// today: 'Today',
// clear: 'Clear',
// close: 'Ok',
// closeOnSelect: false // Close upon selecting a date,
// });
        
      </script>



@endsection