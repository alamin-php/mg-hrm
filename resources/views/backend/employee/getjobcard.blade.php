@extends('layouts.backend.app')
@section('title', 'Section')
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
                Job Card
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active"><i class="fa fa-users"></i> Job Card</a></li>
            </ol>
        </section>

        <!-- Main content -->

        <section class="content">
            <div class="row">
                <div class="col-md-10 col-sm-offset-1">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Search Job Card</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <form action="{{ route('search.jobcard') }}" method="POST">
                                    @csrf
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="upload">Select Employee</label>
                                            <select name="empid" id="" class="form-control input-sm">
                                                @php
                                                    $empname = DB::table('employees')
                                                        ->select('empid', 'name')
                                                        ->where('status', true)
                                                        ->get();
                                                @endphp
                                                <option value="">Select One</option>
                                                @foreach ($empname as $row)
                                                    <option value="{{ $row->empid }}" required>
                                                        {{ $row->empid }}-{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="upload">From date</label>
                                            <input type="date" name="frm_date" placeholder="Enter id no"
                                                class="form-control input-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="upload">To date</label>
                                            <input type="date" name="to_date" placeholder="Enter id no"
                                                class="form-control input-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="upload">Status</label>
                                                <select name="" id="" class="form-control input-sm">
                                                    <option value="">==Select One==</option>
                                                    <option value="">Present</option>
                                                    <option value="">Absent</option>
                                                    <option value="">Late</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i>
                                Search Job Card</button>
                            </form>
                        </div>
                        <div class="box-footer">
                            <div class="employee-details" style="margin-bottom: 20px">
                                <span>Mamun Group</span>
                                <p><b>Job Card</b></p>
                                <p>Date is between <?php echo $_POST['frm_date']?> and <?php echo $_POST['to_date']?>, Employee is {{ $employee->emp_name }}</p>
                            </div>
                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-md-6">
                                    <strong>Employee Name: {{ $employee->emp_name }}</strong><br>
                                    <span>Department: {{ $employee->section_name }}</span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Designation: {{ $employee->desig_name }}</strong><br>
                                    <span>Section / Unit: {{ $employee->unit_name }}</span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Employee Code: {{ $employee->empid }}</strong><br>
                                    <span>
                                        Status: @if ($employee->status == true)
                                            Active
                                        @else
                                        Inactive
                                        @endif

                                    </span>
                                </div>
                            </div>
                            <div class="job-card">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="40px">SL No</th>
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>In Time</th>
                                            <th>Out Time</th>
                                            <th>Late</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($search as $row)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{ \Carbon\Carbon::parse($row->date)->format('d-M-Y') }}</td>
                                            <td>
                                                {{date('l', strtotime($row->date))}}
                                            </td>
                                            <td>
                                                @if (!$row->intime)
                                                    0.0
                                                @else
                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->intime)->format('h:i a') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$row->outtime)
                                                    0.0
                                                @else
                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->outtime)->format('h:i a') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$row->late)
                                                    0.0
                                                @else
                                                    <strong class="text-danger">L</strong>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$row->intime && !$row->outtime)
                                                    <strong class="text-danger">A</strong>
                                                @else
                                                    <strong class="text-success">P</strong>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="margin-top: 10px">
                                            <th colspan="7">
                                                <p>Summary</p>
                                                <table>
                                                    @php
                                                        $day = $search->count('date');
                                                        $late = $search->count('late');
                                                    @endphp
                                                    <tr style="border: 1px solid #ddd; padding: 3px">
                                                        <th>Total Days: {{$day}}</th>
                                                        <th>Total Absent: 2</th>
                                                        <th>Total Late: {{$late}}</th>
                                                        <th>Total Erlyout: 0.0</th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                        </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- /.content -->
    </div>
@endsection

@push('js')
@endpush
