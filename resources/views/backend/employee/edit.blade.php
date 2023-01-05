
<form action="{{ route('employee.update', $data->id) }}" method="post" id="edit_form">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="unitName">Unit</label>
                <select name="unit_id" id="" class="form-control form-control-sm">
                    <option value="">--Select--</option>
                    @foreach ($unit as $row)
                    <option value="{{ $row->id }}" @if($row->id == $data->unit_id) selected @endif>{{ $row->unit_name }}</option>
                    @endforeach
                    <span class="text-danger error-text unit_id_error"></span>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="sectionName">Section</label>
                <select name="section_id" id="" class="form-control form-control-sm">
                    <option value="">--Select--</option>
                    @foreach ($section as $row)
                    <option value="{{ $row->id }}" @if($row->id == $data->section_id) selected @endif>{{ $row->section_name }}</option>
                    @endforeach
                    <span class="text-danger error-text section_id_error"></span>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="unitName">Designation</label>
                <select name="desig_id" id="" class="form-control form-control-sm">
                    <option value="">--Select--</option>
                    @foreach ($desig as $row)
                    <option value="{{ $row->id }}" @if($row->id == $data->desig_id) selected @endif>{{ $row->desig_name }}</option>
                    @endforeach
                    <span class="text-danger error-text desig_id_error"></span>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="empName">Employee name</label>
                <input type="text" name="name" id="empName" class="form-control form-control-sm" value="{{$data->name}}">
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm" id="btnUpdate">Update</button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#edit_form').submit(function(e) {
            e.preventDefault();
            let spinner = '<span><i class="fa fa-spin fa-refresh"></i> Updating...</span>';
            let url = $(this).attr('action');
            let request = $(this).serialize();
            $('#btnUpdate').html(spinner);
            $.ajax({
                url: url,
                type: 'post',
                data: request,
                success: function(data) {
                    toastr.success(data);
                    $('#edit_form')[0].reset();
                    $('#editModal').modal('hide');
                    $('#btnUpdate').text('Update');
                    table.ajax.reload();
                }
            })
        })
    });
</script>
