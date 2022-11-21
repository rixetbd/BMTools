@extends('backend.master')

@section('custom_style')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/jsgrid.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/datatables.css">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Product Categories</h5>
                    <span>Add Category</span>
                </div>
                <div class="card-body">
                    <form class="theme-form" id="ajaxForm" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="CategoryName">Category Name</label>
                            <input class="form-control" id="CategoryName" type="text" name="name"
                                placeholder="Category Name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Categories List</h5>
                    <span>All Category Information</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableStyle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                                {{-- <tr>
                                    <td colspan="4">
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr> --}}
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
                    <button class="btn btn-primary" type="button" type="submit" id="CategoryUpdate" data-bs-dismiss="modal">Category Update</button>
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

    function auto_categories() {
        let urlData = `{{route('autocategories')}}`;
        $.ajax({
            type: 'POST',
            url: `${urlData}`,
            success: function (data) {
                if (data.data == '') {
                    $("#table_data").html('<tr><td class="text-center" colspan="5">No Data Added Yet.</td></tr>');
                }else{
                    let html = "";
                    $.each(data.data, function (i, value) {
                        html += `<tr>` +
                            `<td>` + (i + 1) + `</td><td>` + value.name + `</td><td>` + value.slug +
                            `</td>` +
                            `<td class="text-center">
                                <button class="border-0 btn-sm btn-info me-2" onclick="cat_edit('` + value.id + `','` + value.name + `')"><i class="fa fa-edit"></i></button>` +
                            `<button class="border-0 btn-sm btn-danger" onclick="cat_distroy('` + value
                            .id + `')"><i class="fa fa-trash"></i></button></td>` +
                            `</tr>`;
                    });
                    $("#table_data").html(html);
                    $('#dataTableStyle').DataTable();
                }
            },error: function (request, status, error) {
                $("#table_data").html('<tr><td class="text-center" colspan="4">500 Internal Server Error</td></tr>');
                notyf.error('500 Internal Server Error');
            }
        });
    }
    auto_categories();

    $('#ajaxForm').on('submit', function () {
        let formUrlData = `{{route('backend.categories.store')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                name: $('#CategoryName').val(),
            },
            success: function (data) {
                auto_categories();
                $('#CategoryName').val('');
                notyf.success("Category Saved Successfully!");
            },error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
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
                auto_categories();
                $('#CategoryEditModal').modal('hide');
                notyf.success("Category Update Successfully!");
            },error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });

    function cat_distroy(id) {
        let formUrlData = `{{route('backend.categories.destroy')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                "id": id,
            },
            success: function (data) {
                auto_categories();
                notyf.success("Category Delete Successfully!");
            },error: function (request, status, error) {
                notyf.error('Category Delete Unsuccessfully!');
            }
        });
    }

</script>

@endsection
