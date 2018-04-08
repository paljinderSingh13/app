<?php
$role_id = OrgSidebar::role_id();
$side_bar = OrgSidebar::draw();

?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'main') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" type="text/javascript"></script> --}}
    <style type="text/css">
        .container{
            width:100%!important;
        }
        .m-l-15{
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Main') }}

                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        
                            
                        @if(Auth::guard('org')->check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::guard('org')->user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('admin/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    @if(Auth::guard('org')->check())

                    

                        <div class="col-md-2">

                            @if( $role_id ==1 ) 
                                @foreach($side_bar as $key => $val)
                                    
                                    <div class="panel-heading boder"><a href="{{ url($val['route']) }}">{{ $val['name'] }}</a></div>
                                    @if(isset($val['self_join']))
                                        @foreach($val['self_join'] as $child_key => $child_val)
                                            <div class="panel-heading boder  "><a class="m-l-15" href="{{ url($child_val['route']) }}">{{ $val['name'] }}</a>
                                            </div>
                                        @endforeach
                                    @endif
                                
                                @endforeach
                            @else
                            <?php
// use App\Helpers\OrgSidebar as side;
                            $role_permisson = OrgSidebar::role_permisson()->toArray();
                            dump($role_permisson);
                            ?>
                                @foreach($side_bar as $key => $val)

                                @if($role_permisson[$val['id']] ==1)
                                    
                                    <div class="panel-heading boder"><a href="{{ url($val['route']) }}">{{ $val['name'] }}</a></div>
                                    @if(isset($val['self_join']))
                                        @foreach($val['self_join'] as $child_key => $child_val)
                                            <div class="panel-heading boder  "><a class="m-l-15" href="{{ url($child_val['route']) }}">{{ $val['name'] }}</a>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                                @endforeach
                            @endif
                        </div>
                    @endif    
                    <div class="col-md-10 ">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>


    <!-- Scripts -->

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>
