
<form action="{{ route('desig.update', $data->id) }}" method="post" id="edit_form">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="form-group">
        <label for="desigName">Designation name</label>
        <input type="text" class="form-control form-control-sm" name="desig_name" id="desigName"
            value="{{ $data->desig_name }}" required>
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
