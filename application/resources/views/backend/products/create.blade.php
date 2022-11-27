@extends('backend.master')

@section('custom_style')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/jsgrid.css">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12 col-md-12 col-xl-12">
            <form class="card" action="{{route('backend.products.store')}}" method="POST" enctype="multipart/form-data" id="productAdd">
                @csrf
                <div class="card-header pb-0">
                    <h4 class="card-title mb-0">Add Product
                        <span class="float-end">
                            <a class="btn btn-primary" href="{{route('backend.products.index')}}">Check Products List
                            </a>
                        </span>
                    </h4>
                    <span>Add a new product</span>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="title">Title</label>
                                <input class="form-control" type="text" id="title" name="title" placeholder="Title" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label pt-0" for="category_id">Category Name</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">-- Select a category</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="subcategory_id">Sub Category</label>
                                <select class="form-select" name="subcategory_id" id="subcategory_id" required>
                                    <option value="1">-- Select a sub category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label pt-0" for="supplier_id">Product Supplier</label>
                                <select class="form-select" id="supplier_id" name="supplier_id" required>
                                    <option value="">-- Select a supplier</option>
                                    @foreach ($supplier as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="product_code">Product Code</label>
                                <input class="form-control" type="text" id="product_code" name="product_code" placeholder="Product Code" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="buying_price">Buying Price</label>
                                <input class="form-control" type="number" id="buying_price" name="buying_price" placeholder="Buying Price" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="selling_price">Selling Price</label>
                                <input class="form-control" type="number" id="selling_price" name="selling_price" placeholder="Selling Price" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="quantity">Quantity</label>
                                <input class="form-control" type="number" id="quantity" name="quantity" placeholder="Quantity" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="buy_date">Buying Date</label>
                                <input class="form-control" type="date" id="buy_date" name="buy_date" placeholder="Buying Date" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label class="form-label" for="description">Description</label>
                                <textarea class="form-control" placeholder="Enter Description" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="mb-3">
                                <label class="form-label">Upload Photo</label>
                                <input class="form-control" type="file" name="picture">
                                <div class="progress mt-2">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" id="percentComplete" style="width:0%;">0%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                    {{-- <button type="reset" class="btn btn-danger">Reset</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('custom_script')
<!-- Plugins JS start-->
<script src="{{asset('assets/backend')}}/js/jsgrid/jsgrid.min.js"></script>
<script src="{{asset('assets/backend')}}/js/jsgrid/griddata.js"></script>
<script src="{{asset('assets/backend')}}/js/jsgrid/jsgrid.js"></script>

<script>
    $('#category_id').on('change', function(){

        $.ajax({
            type: "POST",
            url: `{{route('backend.get_subcategory_auto')}}`,
            data: {
                category_id: $('#category_id').val(),
            },
            success: function (data) {

                let html = '<option value="">-- Select a sub category</option>';

                $.each(data.data, function (i, value) {
                    html += `<option value="${value.id}">${value.name}</option>`;
                });

                $('#subcategory_id').html(html);
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });
</script>

<script>
$('#productAdd').on('submit', function (e) {
    e.preventDefault();
    // alert('Ho');
        var form = this;
        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data:new FormData(form),
            dataType:'json',
            processData:false,
            contentType:false,
            beforeSend: function () {
                $('#percentComplete').html('0');
            },
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $('#percentComplete').width(percentComplete + '%');
                        $('#percentComplete').html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            success: function (data) {
                $('input').val('');
                $('select').val('');
                $('textarea').val('');
                notyf.success("Product Saved Successfully!");
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
    });
});
</script>

@endsection


