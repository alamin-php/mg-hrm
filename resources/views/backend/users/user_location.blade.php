@extends('layouts.backend.app')
@section('title', 'Users')
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
                Users
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active"><i class="fa fa-users"></i> User</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All users</h3>
                    <a href="" class="btn btn-primary btn-sm pull-right" data-toggle="modal"
                        data-target="#addModal"><i class="fa fa-plus"></i> Create</a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-sm ytable text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <form id="deleted_form" action="" method="delete">
                        @csrf @method('DELETE')
                    </form>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit user data</h4>
                </div>
                <div class="modal-body">
                    <div id="edit_user_model_body"></div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script src="{{ asset('public/backend') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('public/backend') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    @endpush
