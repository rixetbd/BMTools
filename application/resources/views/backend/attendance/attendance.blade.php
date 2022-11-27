@extends('backend.master')

@section('custom_style')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/jsgrid.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/datatables.css">
<style>
    .attendance_btn{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 14px;
        font-weight: 600;
        margin: 0.5rem !important;
    }
</style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Sign Attendance</h5>
                    <span>Add Attendance For {{Date('d-M-Y')}}</span>
                </div>
                <div class="card-body">
                    {{-- <form class="theme-form" id="ajaxForm" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="CategoryName">Attendance Name</label>
                            <input class="form-control" id="CategoryName" type="text" name="name"
                                placeholder="Category Name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form> --}}

                    <div class="d-flex justify-content-between">
                        <button onclick="attendance_store('Punch In')" class="btn attendance_btn btn-primary">Punch In</button>
                        <button onclick="attendance_store('Break')" class="btn attendance_btn btn-warning">Break</button>
                        <button onclick="attendance_store('Punch Out')" class="btn attendance_btn btn-danger">Punch Out</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Attendance List</h5>
                    <span>All Attendance Information</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableStyle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                                <tr>
                                    <td>1</td>
                                    <td>Name</td>
                                    <td>Slug</td>
                                    <td>Action</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modal || Start --}}
<div class="modal fade" id="CategoryEditModal" tabindex="-1" role="dialog" aria-labelledby="CategoryEditModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Edit</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="theme-form" method="post" action="javascript:void(0)">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input id="CategoryID" type="hidden" name="id">
                        <label class="col-form-label pt-0" for="CategoryName">Category Name</label>
                        <input class="form-control" id="CategoryNameEdit" type="text" name="name"
                            placeholder="Category Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="button" type="submit" id="CategoryUpdate"
                        data-bs-dismiss="modal">Category Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal || End --}}
@endsection

@section('custom_script')
<!-- Plugins JS start-->
<script src="{{asset('assets/backend')}}/js/jsgrid/jsgrid.min.js"></script>
<script src="{{asset('assets/backend')}}/js/jsgrid/griddata.js"></script>
<script src="{{asset('assets/backend')}}/js/jsgrid/jsgrid.js"></script>
<!-- Plugins JS start-->
<script src="{{asset('assets/backend')}}/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/backend')}}/js/datatable/datatables/datatable.custom.js"></script>

<script>
function cat_edit(id, name) {
    $('#CategoryEditModal').modal('show');
    $('#CategoryID').val(id);
    $('#CategoryNameEdit').val(name);
}
</script>

<script>

    $('#dataTableStyle').DataTable({
        ajax: {
            url: `{{route('autoattendances')}}`,
            dataSrc: ''
        },
        columns: [{
                data: null,
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: 'emp_id',
                defaultContent: ''
            },
            {
                data: 'att_date',
                defaultContent: ''
            },
            {
                data: 'att_year',
                defaultContent: ''
            },
            {
                data: 'time',
                defaultContent: ''
            },
            {
                data: 'status',
                defaultContent: ''
            },
            {
                "data": null, // (data, type, row)
                className: "text-center",
                render: function (data) {
                    return `<button class="border-0 btn-sm btn-danger me-2" onclick="cat_distroy('` +
                        data.id + `')"><i class="fa fa-trash"></i></button>`;
                },
                defaultContent: ''
            },
        ]
    });

    $('#CategoryUpdate').on('click', function () {
        let formUrlData = `{{route('backend.categories.update')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                id: $('#CategoryID').val(),
                name: $('#CategoryNameEdit').val(),
            },
            success: function (data) {
                $('#dataTableStyle').DataTable().ajax.reload();
                $('#CategoryEditModal').modal('hide');
                notyf.success("Attendance Update Successfully!");
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });

    function cat_distroy(id) {
        let formUrlData = `{{route('backend.attendance.destroy')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#dataTableStyle').DataTable().ajax.reload();
                notyf.success("Attendance Delete Successfully!");
            },
            error: function (request, status, error) {
                notyf.error('Attendance Delete Unsuccessfully!');
            }
        });
    }

    function attendance_store(status) {
        let formUrlData = `{{route('backend.attendance.store')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                "status": status,
            },
            success: function (data) {
                $('#dataTableStyle').DataTable().ajax.reload();
                notyf.success("Attendance Saved Successfully!");
            },
            error: function (request, status, error) {
                notyf.error('Attendance Saved Unsuccessfully!');
            }
        });
    }

</script>

@endsection
