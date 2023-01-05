@extends('layouts.auth.app')
@section('title', 'Register')
@section('content')
<div class="login-box">
    <div class="login-logo">
      <span><b>{{__("User Register")}}</b></span>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">{{__("Sign in to start your session")}}</p>

      <form id="register_from" method="POST" action="{{ route('register') }}">
          @csrf
          <div class="form-group has-feedback">
              <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required placeholder="Full Name">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @error('name')
                  <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <div class="form-group has-feedback">
              <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required placeholder="E-mail">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @error('email')
                  <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
        <div class="form-group has-feedback">
          <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @error('password')
              <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="password-confirm" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" placeholder="Re-type Password" required autocomplete="new-password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @error('password')
              <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button id="btnRegister" type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> {{__("Register")}}</button>
          </div>
          <!-- /.col -->
        </div><br>
        <a href="{{ route('login') }}" class="text-center">{{__("I already have a membership")}}</a>
      </form>
    </div>
  </div>
@endsection
@push('js')
  {{-- <script>
    $(document).ready(function(){
        $('#register_from').submit(function(e){
            e.preventDefault();
            let spinner = '<span><i class="fa fa-spin fa-refresh"></i> Please wait! Thank you for registration</span>';
            let url = $(this).attr('action');
            let request = $(this).serialize();
            $('#btnRegister').html(spinner);
            $.ajax({
                url: url,
                type: 'post',
                cache: false,
                data: request,
                success: function(data){
                    window.location = "home";
                }
            });
        })
    });
  </script> --}}
@endpush

