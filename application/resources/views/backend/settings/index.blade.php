@extends('backend.master')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>User Profile</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">

    <div class="user-profile">
        <div class="row">
            <div class="col-xl-3 col-lg-12 col-md-4 xl-35">
                <div class="default-according style-1 faq-accordion job-accordion">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="p-0">
                                        <button class="btn btn-link ps-0" data-bs-toggle="collapse"
                                            data-bs-target="#collapseicon2" aria-expanded="true"
                                            aria-controls="collapseicon2">About Company</button>
                                    </h5>
                                </div>
                                <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2"
                                    data-parent="#accordion">
                                    <div class="card-body post-about">
                                        <ul>
                                            <li>
                                                <div class="icon"><i class="fa fa-user text-success"></i></div>
                                                <div>
                                                    <h6>Company Name</h6>
                                                    <h5 class="company_name">Multi-National Company</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="fa fa-user text-success"></i></div>
                                                <div>
                                                    <h6>Company Email</h6>
                                                    <h5 class="company_email">example@company.com</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="fa fa-user text-success"></i></div>
                                                <div>
                                                    <h6>Company Phone</h6>
                                                    <h5 class="company_phone">914-815-7338</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="fa fa-user text-success"></i></div>
                                                <div>
                                                    <h6>Company Address</h6>
                                                    <h5 class="company_address">607 Deans Lane</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="fa fa-user text-success"></i></div>
                                                <div>
                                                    <h6>Company City</h6>
                                                    <h5 class="company_city">New York</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="fa fa-user text-success"></i></div>
                                                <div>
                                                    <h6>Company Country</h6>
                                                    <h5 class="company_country">United States</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="fa fa-user text-success"></i></div>
                                                <div>
                                                    <h6>Website</h6>
                                                    <h5><a class="company_website" target="_blank" href="https://www.example.com/">https://www.example.com/</a></h5>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Company Profile</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <form class="" action="{{route('backend.settings.update')}}" method="POST"
                            enctype="multipart/form-data" id="settingUpdate">
                            @csrf
                            <input type="hidden" name="id" value="{{($settings != ''?$settings->id:'N/A')}}">
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media">
                                        @if ($settings)
                                        <div class="img_box_100" id="img_box_100">
                                            <img id="user_pic" class="img-fluid"
                                                src="{{asset('application/uploads/company')}}/{{($settings->company_logo != ''?$settings->company_logo:'default.png')}}"
                                                alt="">
                                                <div class="img_box_overly">Upload</div>
                                        </div>
                                        @else
                                        <div class="img_box_100" id="img_box_100">
                                            <img id="user_pic" class="img-fluid"
                                                src="{{asset('application/uploads/company/default.png')}}" alt="">
                                                <div class="img_box_overly">Upload</div>
                                        </div>
                                        @endif

                                        <div class="media-body p-4">
                                            @if ($settings)
                                            <h3 class="mb-1 f-20 txt-primary">{{($settings->company_name)}}</h3>
                                            @else
                                            <h3 class="mb-1 f-20 txt-primary">N/A</h3>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input class="form-control" type="text" name="company_name" id="company_name" value="{{($settings != ''?$settings->company_name:'N/A')}}"
                                        placeholder="Company Name">
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label class="form-label">Company Email</label>
                                    <input class="form-control" type="text" name="company_email" id="company_email" value="{{($settings != ''?$settings->company_email:'N/A')}}"
                                        placeholder="Company Email">
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label class="form-label">Company Phone</label>
                                    <input class="form-control" type="text" name="company_phone" id="company_phone" value="{{($settings != ''?$settings->company_phone:'N/A')}}"
                                        placeholder="Company Phone">
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label class="form-label">Company Address</label>
                                    <input class="form-control" type="text" name="company_address" id="company_address" value="{{($settings != ''?$settings->company_address:'N/A')}}"
                                        placeholder="Company Address">
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label class="form-label">Company City</label>
                                    <input class="form-control" type="text" name="company_city" id="company_city" value="{{($settings != ''?$settings->company_city:'N/A')}}"
                                        placeholder="Company City">
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label class="form-label">Country</label>
                                    <input class="form-control" type="text" name="company_country" id="company_country" value="{{($settings != ''?$settings->company_country:'N/A')}}"
                                        placeholder="Country">
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label class="form-label">Company Website</label>
                                    <input class="form-control" type="text" name="company_website" id="company_website" value="{{($settings != ''?$settings->company_website:'N/A')}}"
                                        placeholder="Company Website">
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label class="form-label">Company Logo</label>
                                    <input class="form-control" type="file" name="company_logo" id="picture"
                                        onchange="document.getElementById('user_pic').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary btn-block" type="submit">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- user profile fifth-style end-->
        </div>
    </div>

</div>
<!-- Container-fluid Ends-->

@endsection


@section('custom_script')

<script>

    $('#img_box_100').click(() => {
        $('#picture').click();
    });

</script>

<script>
    $('#settingUpdate').on('submit', function (e) {
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
                autoSettings();
                notyf.success("Setting Action Successfully!");
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });

    function autoSettings()
    {
        $.ajax({
            type: "GET",
            url: `{{route('backend.settings.autoSettings')}}`,
            data: {
                'id':'null',
            },
            success: function (data) {
                $('.company_name').html(data.company_name);
                $('.company_email').html(data.company_email);
                $('.company_phone').html(data.company_phone);
                $('.company_address').html(data.company_address);
                $('.company_city').html(data.company_city);
                $('.company_country').html(data.company_country);
                $('.company_website').html((data.company_website ? data.company_website : 'N/A'));
                $('.company_website').attr( 'href' , data.company_website);

                if (data != '') {
                    $('#user_pic').attr('src', `../application/uploads/company/${data.company_logo}`);
                } else {
                    $('#user_pic').attr('src', `../application/uploads/company/default.png`);
                }
            }
        });
    }

    autoSettings();

</script>

@endsection


@section('custom_style')

@endsection
