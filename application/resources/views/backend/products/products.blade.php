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
                    <h5>Products List
                            <span class="float-end">
                            <a class="btn btn-primary" href="{{route('backend.products.create')}}">
                                <i class="fa fa-plus"></i> Add Product
                            </a>
                        </span>
                    </h5>
                    <span>All Products Information</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableStyle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Sub Category</th>
                                    <th scope="col">Buying Price</th>
                                    <th scope="col">Selling Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Picture</th>
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

$('.gallery a').simpleLightbox();

    function cat_edit(id, name, category) {
        $('#CategoryEditModal').modal('show');
        $('#SubCategoryID').val(id);
        $(`#MCategoryID option[value=${category}]`).attr('selected', 'selected');
        $('#CategoryNameEdit').val(name);
    }

</script>

<script>
    $('#dataTableStyle').DataTable({
        ajax: {
            type: "POST",
            url: `{{route('autoproducts')}}`,
            dataSrc: ''
        },
        columns: [{
                data: null,
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: 'title'
            },
            {
                data: 'category_name'
            },
            {
                data: 'subcategory_name'
            },
            {
                data: 'buying_price'
            },
            {
                data: 'selling_price'
            },
            {
                className: "text-center",
                data: 'quantity'
            },
            {
                "data": function (data, type) {
                    return `<a href="../application/uploads/products/` + data.picture + `" data-lightbox="roadtrip"><img class="img-thumbnail w-50" src="../application/uploads/products/` + data.picture + `" itemprop="thumbnail" alt="Image description"></a>`;
                }
            },
            // {
            //     "data": function (data, type) {
            //         return `<a class="pswp" href="../application/upload/products/` + data.picture + `" itemprop="contentUrl" data-size="1600x950">
            //             <img class="img-thumbnail" src="../application/upload/products/` + data.picture +
            //             `" itemprop="thumbnail" alt="Image description"></a>`;
            //     }
            // },
            {
                "data": null, // (data, type, row)
                className: "text-center",
                render: function (data) {
                    return `<button class="border-0 btn-sm btn-info me-2" onclick="cat_edit('` +
                        data.id + `','` + data.name + `','` + data.category_id +
                        `')"><i class="fa fa-edit"></i></button>` +
                        `<button class="border-0 btn-sm btn-danger me-2" onclick="cat_distroy('` +
                        data.id + `')"><i class="fa fa-trash"></i></button>`;
                },
            },
        ]
    });

    $('#CategoryUpdate').on('click', function () {
        let formUrlData = `{{route('backend.subcategories.update')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                category_id: $('#MCategoryID').val(),
                id: $('#SubCategoryID').val(),
                name: $('#CategoryNameEdit').val(),
            },
            success: function (data) {
                $('#dataTableStyle').DataTable().ajax.reload();
                $('#CategoryEditModal').modal('hide');
            }
        });
    });

    function cat_distroy(id) {
        let formUrlData = `{{route('backend.products.destroy')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#dataTableStyle').DataTable().ajax.reload();
                notyf.success("Product Delete Successfully!");
            },
            error: function (request, status, error) {
                notyf.error('Product Delete Unsuccessfully!');
            }
        });
    }

</script>

@endsection
