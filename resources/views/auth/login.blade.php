@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-4 col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header"> <img height="42px" class="img-responsive" style="margin-top:20px;margin-left:20px; margin-bottom: 20px;"  src="{!! asset('images/logo.png') !!}" align="center" /></div>

                <div class="card-body">
                  
                        <div class="col-md-12">
                           <h2 class="text-center"> @lang('auth.login')</h2> 
                        </div>
                       <div class="col-md-12">
                           <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-center">@lang('auth.email')</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-center">@lang('auth.password')</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                 <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('auth.forget-pass')
                                </a>
                                <div class="form-check text-center">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        @lang('auth.rememberme')
                                    </label>
                                   
                                </div>
                               
                            </div>

                        </div>

                        <div class="form-group row ">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                   @lang('auth.btn-login')
                                </button>
                                 
                               
                            </div>
                            
                        </div>
                    </form>
                       </div>
                    </div>
                     
                    
               
            </div>
        </div>
    </div>
</div>
@endsection
