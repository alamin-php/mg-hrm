@extends('layouts.backend.app')
@section('title', 'Attn. Import')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/pace/pace.min.css">
    <link rel="stylesheet"
        href="{{ asset('public/backend') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Attendance Import
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active"><i class="fa fa-users"></i> Upload</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload</h3>
                    <a href="" class="btn btn-primary btn-sm pull-right addModal" data-toggle="modal"
                        data-target="#addModal"><i class="fa fa-plus"></i> Create</a>
                </div>
                <div class="box-body">
                    <form action="{{ route('excel.import') }}" method="post" id="upload_form" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Select Date</label>
                                <input type="date" name="select_date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="designationName">Upload File</label>
                                <input type="file" class="form-control form-control-sm" name="file" id="designationName">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" id="btnUpload"><i class="fa fa-upload"></i></button>
                </div>
                </form>

                </div>
    </div>

    </section>
    <!-- /.content -->
    </div>
@endsection

@push('js')

@endpush
