@extends('layouts.backend.app')
@section('title', 'Dashboard')
@push('css')

@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__("Dashboard")}}
        <small>{{__("Application Version 1.0")}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> {{__("Home")}}</a></li>
        <li class="active">{{__("Dashboard")}}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <a href="{{ route('attendance.today') }}"><span class="info-box-text">{{__("Today Present")}}</span></a>
              @php
              $today = date('Y-m-d');
                  $today_attn = DB::table('employees')
                  ->leftJoin('attendances', 'employees.empid', 'attendances.empid')
                  ->select('employees.*', 'attendances.*')
                  ->where('employees.status', true)
                  ->where('attendances.date', $today)->whereNotNull('attendances.intime')->count();
              @endphp
              <span class="info-box-number">{{ $today_attn }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__("Today Absent")}}</span>
              @php
              $today = date('Y-m-d');
                  $today_absent = DB::table('employees')
                  ->leftJoin('attendances', 'employees.empid', 'attendances.empid')
                  ->select('employees.*', 'attendances.*')
                  ->where('attendances.date', $today)->whereNull('attendances.intime')->count();
              @endphp
              <span class="info-box-number">{{ $today_absent }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                @php
                    $empname = DB::table('employees')->select('empid','name')->where('status', true)->count();
                @endphp
              <span class="info-box-text">{{__("Active Employee")}}</span>
              <span class="info-box-number">{{$empname}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__("Total Suppliers")}}</span>
              <span class="info-box-number">32</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-hourglass"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__("Current Stock")}}</span>
              <span class="info-box-number">12</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-tag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__("Category")}}</span>
              <span class="info-box-number">14</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-bus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__("Vhicale")}}</span>
              <span class="info-box-number">21</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-ship"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__("Monthly Shipment")}}</span>
              <span class="info-box-number">32</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@push('js')

@endpush
