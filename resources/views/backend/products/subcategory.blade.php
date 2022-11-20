@extends('backend.master')

@section('custom_style')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/jsgrid.css">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Product Sub Categories</h5>
                    <span>Add Sub Category</span>
                </div>
                <div class="card-body">
                    <form class="needs-validation" id="ajaxForm" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="CategoryID">Category Name</label>
                            <select class="form-select" id="category_id" name="CategoryID" required>
                                <option value="">-- Select a category</option>
                                @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="CategoryName">Sub Category Name</label>
                            <input class="form-control" id="CategoryName" type="text" name="name"
                                placeholder="Sub Category Name" required>
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
                    <h5>Sub Categories List</h5>
                    <span>All Sub Category Information</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Parent Category</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                                <tr>
                                    <td colspan="5">
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
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
                        <input class="form-control" id="CategoryID" type="hidden" name="id" required>

                        <label class="col-form-label pt-0" for="CategoryID">Category Name</label>
                        <select class="form-select" id="MCategoryID" name="MCategoryID" required>
                            <option value="">-- Select a category</option>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="CategoryName">Sub Category Name</label>
                        <input class="form-control" id="CategoryNameEdit" type="text" name="name"
                            placeholder="Category Name" required>
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

<script>
    function cat_edit(id, name, category) {
        $('#CategoryEditModal').modal('show');
        $('#CategoryID').val(id);
        $(`#MCategoryID option[value=${category}]`).attr('selected','selected');
        $('#CategoryNameEdit').val(name);
    }
</script>

<script>
    function auto_subcategories() {
        let urlData = `{{route('autosubcategories')}}`;
        $.ajax({
            type: 'POST',
            url: `${urlData}`,
            success: function (data) {
                $("#table_data").html(data.data);
            },error: function (request, status, error) {
                $("#table_data").html('<tr><td class="text-center" colspan="5">500 Internal Server Error</td></tr>');
            }
        });
    }
    auto_subcategories();

    $('#ajaxForm').on('submit', function () {
        let formUrlData = `{{route('backend.subcategories.store')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                category_id: $('#category_id').val(),
                name: $('#CategoryName').val(),
            },
            success: function (data) {
                auto_subcategories();
                $("#category_id").val("");
                $('#CategoryName').val('');
                notyf.success("Sub Category Saved Successfully!");
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
                auto_subcategories();
                $('#CategoryEditModal').modal('hide');
            }
        });
    });

    function cat_distroy(id) {
        let formUrlData = `{{route('backend.subcategories.destroy')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                "id": id,
            },
            success: function (data) {
                auto_subcategories();
                notyf.success("Category Delete Successfully!");
            },error: function (request, status, error) {
                notyf.error('Category Delete Unsuccessfully!');
            }
        });
    }

</script>

@endsection
