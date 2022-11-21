@extends('backend.master')

@section('custom_style')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/jsgrid.css">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12 col-md-12 col-xl-12">
            <form class="card" action="{{route('backend.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header pb-0">
                    <h4 class="card-title mb-0">Add Product</h4>
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
                                <select class="form-control btn-square" name="subcategory_id" id="subcategory_id" required>
                                    <option value="1">-- Select a category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="price">Price</label>
                                <input class="form-control" type="number" id="price" name="price" placeholder="Price $" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="quantity">Quantity</label>
                                <input class="form-control" type="number" id="quantity" name="quantity" placeholder="Quantity" required>
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
        alert($('#category_id').val());
    });
</script>

@endsection