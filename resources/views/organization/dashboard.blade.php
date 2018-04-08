@extends('layouts.org')

@section('content')



            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                
                

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            
             

       
<style type="text/css">
    .boder{border: 1px solid black;}
</style>
@endsection
