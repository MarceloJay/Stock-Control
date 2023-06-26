@extends('auth.layouts.auth')

@section('body_class','login')

@section('content')


<style>
    #mainlogin {
        margin:auto;
        margin-top:5%;
        width:350px;
    }

</style>

<div class="animate form login_content">

    <div id="mainlogin">

        {{ Form::open(['route' => 'login']) }}
            <h1>{{ __('views.auth.login.header') }}</h1>

            <div>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                       placeholder="{{ __('views.auth.login.input_0') }}" required autofocus>
            </div>
            <div>
                <input id="password" type="password" class="form-control" name="password"
                       placeholder="{{ __('views.auth.login.input_1') }}" required>
            </div>
            <div style="width:350px;padding-bottom:10px;">
                <div style="display:inline-table;width:270px;text-align:left;">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('views.auth.login.input_2') }}
                </div>
                <button id="buttonposition" class="btn btn-success" type="submit">{{ __('views.auth.login.action_0') }}</button>
            </div>
            <a id ="resetposition" style="text-align:right;" href="{{ route('password.request') }}">{{ __('views.auth.login.action_1') }}</a>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (!$errors->isEmpty())
                <div class="alert alert-danger" role="alert">
                    {!! $errors->first() !!}
                </div>
            @endif

            <div style="text-align:left;">
            		<div style="display:inline-table;width:200px;padding-left:10px;">
                    <!-- <a href="{{ route('password.request') }}">{{ __('views.auth.login.action_1') }}</a> -->
                </div>
            </div>

            <div class="clearfix"></div>



            <!-- <div class="separator">
                <span>{{ __('views.auth.login.message_0') }}</span>
                <div>
                    <a href="{{ route('social.redirect', ['google']) }}" class="btn btn-success btn-google-plus">
                        <i class="fa fa-google-plus"></i>
                        Google+
                    </a>
                    <a href="{{ route('social.redirect', ['facebook']) }}" class="btn btn-success btn-facebook">
                        <i class="fa fa-facebook"></i>
                        Facebook
                    </a>
                    <a href="{{ route('social.redirect', ['twitter']) }}" class="btn btn-success btn-twitter">
                        <i class="fa fa-twitter"></i>
                        Twitter
                    </a>
                </div>
            </div> -->

            @if(config('auth.users.registration'))
                <!-- <div class="separator">  -->
                		<!-- 
                    <p class="change_link">{{ __('views.auth.login.message_1') }}
                        <a href="{{ route('register') }}" class="to_register"> {{ __('views.auth.login.action_2') }} </a>
                    </p>
                    -->

                    <div class="clearfix"></div>
                    <br/>

                <!--
                    <div>
                        <div class="h1">{{ config('app.name') }}</div>
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('views.auth.login.copyright') }}</p>
                    </div>
                -->
                <!-- </div> -->
            @endif
        {{ Form::close() }}

    </div>



</div>

<style>
    #footerlogo {
        position: relative;
        width: 100%;
        left: -10px;
    }

    .forget_pass{
        margin-top: -0x;
        margin-right: 100px;
        margin-bottom: 0px;
        margin-left: 0px;
    }
    #tablelogo {
        width: 100%;
    }
    #tdslogo {
        width: 50%;
    }

    #resetposition {
        margin-right: 211px;
        text-align: right;
    }

    #buttonposition {
        margin-top: 0x;
        margin-right: 0px;
        margin-bottom: 0px;
        margin-left: 12px; 
    }
</style>

<div id="footerlogo">
    <table id="tablelogo">
        <tr>
            <td class="tdslogo"><img src="kds_lines.png" style="height:70px;"/></td>
            <td class="tdslogo"> <img src="kds_logo.png" style="width:170px;"/> <td>
        </tr>
    </table>
</div>


@endsection



@section('styles')
    @parent

    {{ Html::style(mix('assets/auth/css/login.css')) }}
@endsection
