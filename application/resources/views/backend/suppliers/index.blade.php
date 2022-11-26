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
                    <h5>Suppliers List <span class="float-end"><button class="btn btn-primary" id="add_customer"> <i
                                    class="fa fa-plus"></i> Add Supplier</button></span></h5>
                    <span>All Supplier Information</span>
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
                                    <th scope="col">Phone</th>
                                    <th scope="col">Shopname</th>
                                    <th scope="col">AC Holder</th>
                                    <th scope="col">AC Number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">City</th>
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
                <h5 class="modal-title">Supplier Info</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form class="" action="{{route('backend.suppliers.store')}}" method="POST" enctype="multipart/form-data"
                    id="customerAdd">
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
                            <input id="customerID" type="hidden" name="id" value="">
                            <label class="col-form-label pt-0" for="name">Name</label>
                            <input class="form-control" id="name" type="text" name="name" placeholder="Supplier Name" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="email">Email</label>
                            <input class="form-control" id="email" type="text" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="phone">Phone</label>
                            <input class="form-control" id="phone" type="text" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="shopname">Shop Name</label>
                            <input class="form-control" id="shopname" type="shopname" name="shopname" placeholder="Shopname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="account_holder">Account Holder</label>
                            <input class="form-control" id="account_holder" type="text" name="account_holder"
                                placeholder="Account Holder">
                        </div>
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="account_number">Account Number</label>
                            <input class="form-control" id="account_number" type="number" name="account_number" placeholder="Account Number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="bank_name">Bank Name</label>
                            <input class="form-control" id="bank_name" type="text" name="bank_name" placeholder="Bank Name">
                        </div>
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="bank_branch">Bank Branch</label>
                            <input class="form-control" id="bank_branch" type="text" name="bank_branch" placeholder="Bank Branch" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="city">City</label>
                            <input class="form-control" id="city" type="text" name="city" placeholder="City">
                        </div>
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="type">Supplier Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">-- Select a category</option>
                                <option value="1">Distributors</option>
                                <option value="2">Wholesaler</option>
                                <option value="3">Broker</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="col-form-label pt-0" for="address">Address</label>
                            <input class="form-control" id="address" type="text" name="address" placeholder="Address" required>
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

    $('#add_customer').click(() => {
        $('#user_pic').attr('src', 'application/uploads/users/default.png');
        $('input[type=text]').val('');
        $('#CategoryEditModal').modal('show');
    });

</script>

<script>
    $('#dataTableStyle').DataTable({
        ajax: {
            url: `{{route('autosuppliers')}}`,
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
                    return `<a href="application/uploads/suppliers/` + data.picture + `" data-lightbox="roadtrip"><img class="img-thumbnail w-50" src="application/uploads/suppliers/` + data.picture + `" itemprop="thumbnail" alt="Image description"></a>`;
                }
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'phone'
            },
            {
                data: 'shopname'
            },
            {
                className: "text-center",
                data: 'account_holder'
            },
            {
                data: 'account_number'
            },
            {
                data: 'address'
            },
            {
                data: 'city'
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

    function cat_edit(id) {
        $.ajax({
            type: "POST",
            url: `{{route('backend.suppliers.edit')}}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#customerAdd input').val( );

                $('#user_pic').attr('src', `./application/uploads/suppliers/${data.suppliers.picture}`);
                $('#customerID').val(data.suppliers.id);
                $('#name').val(data.suppliers.name);
                $('#email').val(data.suppliers.email);
                $('#phone').val(data.suppliers.phone);
                $('#shopname').val(data.suppliers.shopname);
                $('#account_holder').val(data.suppliers.account_holder);
                $('#account_number').val(data.suppliers.account_number);
                $('#bank_name').val(data.suppliers.bank_name);
                $('#bank_branch').val(data.suppliers.bank_branch);
                $('#address').val(data.suppliers.address);
                $('#city').val(data.suppliers.city);

                $('#type option').each(function(i){
                    if ($(this).val() == data.suppliers.type) {
                        $(this).attr('selected', '');
                    }
                });

            },
            error: function (request, status, error) {
                notyf.error('Supplier Delete Unsuccessfully!');
            }
        });
        $('#CategoryEditModal').modal('show');
    }

    function cat_distroy(id) {
        let formUrlData = `{{route('backend.suppliers.destroy')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#dataTableStyle').DataTable().ajax.reload();
                notyf.success("Supplier Delete Successfully!");
            },
            error: function (request, status, error) {
                notyf.error('Supplier Delete Unsuccessfully!');
            }
        });
    }



</script>

<script>
    $('#customerAdd').on('submit', function (e) {
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
                $('#dataTableStyle').DataTable().ajax.reload();
                $('#CategoryEditModal').modal('hide');
                notyf.success("Action Successful");
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });

</script>

@endsection
