
<form action="{{ route('user.update', $data->id) }}" method="post" id="edit_form">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="fullName">Full name</label>
                <input type="text" class="form-control input-sm" name="name" id="fullName"
                    value="{{ $data->name }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="emailAddress">E-Mail address</label>
                <input type="text" disabled class="form-control input-sm" name="email" id="emailAddress"
                value="{{ $data->email }}" required>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Create Unit
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Edit Unit
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Delete Unit
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Create Section
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Edit Section
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Delete Section
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Create Designation
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Edit Designation
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Delete Designation
                        </label>
                    </div>
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
