@extends('layouts.auth.app')
@section('title', 'Login')
@section('content')
<div class="login-box">
    <div class="login-logo">
      <span><b>{{__("User Login")}}</b></span>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">{{__("Sign in to start your session")}}</p>

      <form id="login_form" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group has-feedback">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @error('email')
                  <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @error('password')
              <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button id="btnLogin" type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> {{__("Sign In")}}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
@endsection
@push('js')
  {{-- <script>
    $(document).ready(function(){
        $('#login_form').submit(function(e){
            e.preventDefault();
            let spinner = '<span><i class="fa fa-spin fa-refresh"></i> Please wait! for login to dashboard</span>';
            let url = $(this).attr('action');
            let request = $(this).serialize();
            $('#btnLogin').html(spinner);
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
