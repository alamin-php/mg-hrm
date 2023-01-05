@extends('layouts.backend.app')
@section('title', 'KPI')
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
                KPI
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active"><i class="fa fa-home"></i> KPI</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All KPI</h3>
                    <a href="{{ route('kpi.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Create</a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-sm ytable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Particular</th>
                                <th>Starting Times</th>
                                <th>Ending Times</th>
                                <th>Remarks</th>
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
                    <h4 class="modal-title text-center">Edit section data</h4>
                </div>
                <div class="modal-body">
                    <div id="edit_model_body"></div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script src="{{ asset('public/backend') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('public/backend') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="{{ asset('public/backend') }}/bower_components/PACE/pace.min.js"></script>
        <script>
            // Section table
            $(function Section() {
                table = $('.ytable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('kpi.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'particular',
                            name: 'particular'
                        },
                        {
                            data: 's_time',
                            name: 's_time'
                        },
                        {
                            data: 'e_time',
                            name: 'e_time'
                        },
                        {
                            data: 'remarks',
                            name: 'remarks'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            });
            // Edit data
            $('body').on('click', '.edit', function() {
                let id = $(this).data('id');
                console.log(id);
                $.get('section/edit/' + id, function(data) {
                    $("#edit_model_body").html(data);
                })
            });
            // Delete data
            $(document).ready(function() {
                $(document).on('click', '#delete_section', function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    $('#deleted_form').attr('action', url);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#deleted_form").submit();
                        }
                    })
                });
                //delete action apply
                $('#deleted_form').submit(function(e) {
                    e.preventDefault();
                    var url = $(this).attr('action');
                    var request = $(this).serialize();
                    $.ajax({
                        url: url,
                        type: 'post',
                        async: false,
                        data: request,
                        success: function(data) {
                            toastr.success(data);
                            $('#deleted_form')[0].reset();
                            table.ajax.reload();
                        }
                    });
                });
            });

            // // Data update
            // $(document).ajaxStart(function() {
            //     Pace.restart();
            // });
        </script>
    @endpush
