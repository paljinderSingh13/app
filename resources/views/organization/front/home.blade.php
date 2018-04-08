@extends('layouts.front')

@section('content')

@foreach($data['opds'] as $opd_key => $opd_val)
      <div class="row">
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">{{ $opd_val['name'] }}</span>
              <p>{{ $opd_val['doctor_detail']['name'] }} I am a very simple card. I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="{{ route('opd.detail',['id'=>$opd_val['id']]) }}">This is a link</a>
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>
      </div>
@endforeach
          
@endsection
