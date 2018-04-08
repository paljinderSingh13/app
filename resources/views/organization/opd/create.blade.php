@php
    $days = [1=>"Monday", 2=>"Tuesday",3=>"Wednesday",4=>"Thursday", 5=>"Friday",6=>"Saturday", 7=>"Sunday"];
@endphp
<div class="panel panel-default">
    <div class="panel-heading">Add Opd</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('opd.save') }}">
            {{ csrf_field() }}        
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
          <label for="test6">Shifts</label>
          @foreach($shift as $shift_key => $shift_val)
            <p>
                <input class="shift" type="checkbox" name="shifts[]" value="{{ $shift_key }}" id="{{ $shift_key }}"  />
                <label for="{{$shift_key}}">{{$shift_val}}</label>
            </p> 
          @endforeach
    <select name="dr_id" style="display: flex;">
        <option value="" disabled selected>Choose your option</option>
        @foreach($doctor as $key => $val)
            <option value="{{ $key }}"> {{ $val }}</option>
        @endforeach
    </select>
      <table class="bordered centered responsive-table">
        <thead>
          <tr>
              <th>Select<br>.</th>
              <th>Day<br>.</th>
              @foreach($shift as $s_key => $s_val)
                 <th class="shift_hide shift_{{$s_key }}">{{$s_val}}<br>Start Time | End Time</th>
              @endforeach
            </tr>
        </thead>

        <tbody>
        @foreach($days as $key => $val)
          <tr>
            <td> 
                <div class="switch"> <label> Off <input name="day[{{$key}}]" value="{{ $key }}" type="checkbox"> <span class="lever"></span> On </label> </div>
            </td> 
            <td>{{ $val }}</td> 
            @foreach($shift as $s_key => $s_val)
                <td class="shift_hide shift_{{$s_key }}">
                    <div class="input-field col s6">
                        <input  id="start_time" name="{{$key}}[{{$s_key}}][start]" type="text" class="validate  start_time timepicker "> <label for="start_time">Start Time</label>
                    </div>
                    <div class="input-field col s6">
                        <input  id="end_time" type="text" name="{{$key}}[{{$s_key}}][end]" class="validate timepicker end_time"> <label for="end_time">End Time</label>
                    </div>
                     <div class="input-field col s6">
                        <input  id="average" type="text" name="{{$key}}[{{$s_key}}][average_patient]" class="validate"> <label for="average">Patients Average Attend</label>
                    </div>
                </td>
            @endforeach
          </tr>
        @endforeach
        </tbody>
      </table>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });

        $(".shift_hide").hide();
    });

    // $(document).on('blur','.start_time',function(e){
    //     e.preventDefault();
    //     time = $(this).val();
    //     alert(time);
    // });

    $(document).on('click','.shift',function(){
        id = $(this).val();
        $(".shift_"+id).toggle();
    });


    
</script>