@extends('layouts.auth.app')
@section('title', 'Reset Password')
@section('content')
<div class="login-box">
    <div class="login-logo">
      <span><b>{{__("Reset Password")}}</b></span>
    </div>
    <div class="login-box-body">
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="form-group has-feedback">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @error('email')
                  <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-send-o"></i> {{__("Send Password Reset Link")}}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
@endsection


