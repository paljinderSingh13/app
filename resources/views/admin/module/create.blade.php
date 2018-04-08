{{-- @extends('layouts.admin')
@section('content') --}}
<div class="panel panel-default">
    {{-- {{ dd(Session::all()) }} --}}
                <div class="panel-heading">Add {{ @$title }}</div>


                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('module.save') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="parent" value="{{ $parent }}">

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
                        <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                {{-- {{ dd($data) }} --}}
{{ Form::select('route',array_filter($route_list),null) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        

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
                $(document).ready(function() {
                    $('select').material_select();
                  });
            </script>
{{-- @endsection --}}