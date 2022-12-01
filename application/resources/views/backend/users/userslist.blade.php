@extends('backend.master')

@section('custom_style')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/jsgrid.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/datatables.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/lightbox.min.css">

@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Users List <span class="float-end"><button class="btn btn-primary" id="add_employee"> <i
                                    class="fa fa-plus"></i> Add User</button></span></h5>
                    <span>All Users Information</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableStyle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Employee Info</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form class="" action="{{route('backend.users.store')}}" method="POST" enctype="multipart/form-data"
                    id="userAdd">
                    @csrf
                    <div class="col-12 d-flex justify-content-center pb-4">
                        <div class="img_box_100" id="img_box_100">
                            <img id="user_pic" class="img-fluid rounded-circle"
                                src="{{asset('application/uploads/users/default.png')}}" alt="">
                                <div class="img_box_overly">Upload</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <input id="employeeID" type="hidden" name="id" value="">
                            <label class="col-form-label pt-0" for="name">Name</label>
                            <input class="form-control" id="name" type="text" name="name" placeholder="User Name" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="email">Email</label>
                            <input class="form-control" id="email" type="text" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="password">Password</label>
                            <input class="form-control" id="password" type="text" name="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="confirm_password">Confirm Password</label>
                            <input class="form-control" id="confirm_password" type="text" name="confirm_password" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="role">NID No.</label>
                            <select name="role" id="role" class="form-select">
                                {{-- <option value="super_admin">Super Admin</option> --}}
                                <option value="admin">Admin</option>
                                <option value="editor">Editor</option>
                                <option value="employee">Employee</option>
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="picture">Picture</label>
                            <input class="form-control" type="file" name="picture" id="picture"
                                onchange="document.getElementById('user_pic').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="reset" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>

    $('#img_box_100').click(() => {
        $('#picture').click();
    });


    $('#add_employee').click(() => {
        $('#user_pic').attr('src', 'application/uploads/users/default.png');
        $('input').val('');
        $('#CategoryEditModal').modal('show');
    });

    // function cat_edit(id, name) {
    //     $('#CategoryEditModal').modal('show');
    //     $('#CategoryID').val(id);
    //     $('#CategoryNameEdit').val(name);
    // }

</script>


<script>
    $('#dataTableStyle').DataTable({
        ajax: {
            url: `{{route('backend.user.autoallusers')}}`,
            dataSrc: ''
        },
        columns: [{
                data: null,
                className: "text-center",
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                "data": function (data, type) {
                    return `<a href="../application/uploads/users/` + data.avatar + `" data-lightbox="roadtrip"><img class="img-thumbnail w-50" src="../application/uploads/users/` + data.avatar + `" itemprop="thumbnail" alt="Image description"></a>`;
                }
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'role'
            },
            {
                "data": null, // (data, type, row)
                className: "text-center",
                render: function (data) {
                    return `<button class="border-0 btn-sm btn-info me-2" onclick="cat_edit('` +
                        data.id + `','` + data.name + `')"><i class="fa fa-edit"></i></button>` +
                        `<button class="border-0 btn-sm btn-danger me-2" onclick="cat_distroy('` +
                        data.id + `')"><i class="fa fa-trash"></i></button>`;
                },
            },
        ],
        error: function (request, status, error) {
            notyf.error('No data available in table');
        }
    });


    // $('#CategoryUpdate').on('click', function () {
    //     let formUrlData = `{{route('backend.categories.update')}}`;
    //     $.ajax({
    //         type: "POST",
    //         url: `${formUrlData}`,
    //         data: {
    //             id: $('#CategoryID').val(),
    //             name: $('#CategoryNameEdit').val(),
    //         },
    //         success: function (data) {
    //             $('#dataTableStyle').DataTable().ajax.reload();
    //             $('#CategoryEditModal').modal('hide');
    //             notyf.success("Category Update Successfully!");
    //         },
    //         error: function (request, status, error) {
    //             notyf.error(request.responseJSON.message);
    //         }
    //     });
    // });

    function cat_edit(id) {
        $.ajax({
            type: "POST",
            url: `{{route('backend.employee.edit')}}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#userAdd input').val( );

                $('#user_pic').attr('src', `./application/uploads/employee/${data.employee.picture}`);
                $('#employeeID').val(data.employee.id);
                $('#name').val(data.employee.name);
                $('#email').val(data.employee.email);
                $('#phone').val(data.employee.phone);
                $('#salary').val(data.employee.salary);
                $('#city').val(data.employee.city);
                $('#experience').val(data.employee.experience);
                $('#nid_no').val(data.employee.nid_no);
                $('#vacation').val(data.employee.vacation);
                $('#address').val(data.employee.address);
            },
            error: function (request, status, error) {
                notyf.error('Employee Delete Unsuccessfully!');
            }
        });
        $('#CategoryEditModal').modal('show');
    }

    function cat_distroy(id) {
        let formUrlData = `{{route('backend.users.destroy')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#dataTableStyle').DataTable().ajax.reload();
                notyf.success("User Delete Successfully!");
            },
            error: function (request, status, error) {
                notyf.error('User Delete Unsuccessfully!');
            }
        });
    }



</script>

<script>
    $('#userAdd').on('submit', function (e) {
        e.preventDefault();
        // alert('Ho');
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            dataType: 'json',
            processData: false,
            contentType: false,
            // beforeSend: function () {
            //     $('#percentComplete').html('0');
            // },
            // xhr: function() {
            //     var xhr = new window.XMLHttpRequest();
            //     xhr.upload.addEventListener("progress", function(evt) {
            //         if (evt.lengthComputable) {
            //             var percentComplete = ((evt.loaded / evt.total) * 100);
            //             $('#percentComplete').width(percentComplete + '%');
            //             $('#percentComplete').html(percentComplete+'%');
            //         }
            //     }, false);
            //     return xhr;
            // },
            success: function (data) {
                $('input[type=text]').val('');
                $('input[type=search]').val('');
                $('#dataTableStyle').DataTable().ajax.reload();
                $('#CategoryEditModal').modal('hide');
                notyf.success("User Add Successfully!");
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });

</script>

@endsection
