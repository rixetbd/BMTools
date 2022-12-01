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
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">My Profile <span class="edit edit_bio"><i
                                    class="fa fa-edit"></i></span></h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <form class="" action="{{route('backend.user.update')}}" method="POST"
                            enctype="multipart/form-data" id="userUpdate">
                            @csrf
                            {{-- <input type="hidden" name="id" value="{{$user->id}}"> --}}
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media">
                                        @if ($user)
                                        <div class="img_box_100" id="img_box_100">
                                            <img id="user_pic" class="img-fluid"
                                                src="{{asset('application/uploads/users')}}/{{($user->avatar != ''?$user->avatar:'default.png')}}"
                                                alt="">
                                        </div>
                                        @endif

                                        <div class="media-body p-4">
                                            @if ($user)
                                            <h3 class="mb-1 f-20 txt-primary">{{$user->name}}</h3>
                                            <p class="f-12">Author</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h6 class="form-label">Bio</h6>
                                <textarea class="form-control" rows="5" id="user_bio" name="user_bio"
                                    placeholder="Describe Yourself"
                                    disabled>I’m a Full Stack Developer who is passionate about making error-free websites with Laravel and React.js Framework. A self-taught fast-learner full-stack developer from Dhaka.</textarea>
                            </div>

                            @if (Auth::user())
                            <div class="mb-3">
                                <label class="form-label">Picture</label>
                                <input class="form-control" type="file" name="picture" id="picture"
                                    onchange="document.getElementById('user_pic').src = window.URL.createObjectURL(this.files[0])">

                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary btn-block" type="submit">Save</button>
                            </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-12 col-md-4 xl-35">
                <div class="default-according style-1 faq-accordion job-accordion">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="p-0">
                                        <button class="btn btn-link ps-0" data-bs-toggle="collapse"
                                            data-bs-target="#collapseicon2" aria-expanded="true"
                                            aria-controls="collapseicon2">About Me</button>
                                    </h5>
                                </div>
                                <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2"
                                    data-parent="#accordion">
                                    <div class="card-body post-about">
                                        <ul>
                                            <li>
                                                <div class="icon"><i data-feather="briefcase"></i></div>
                                                <div>
                                                    <h5>UX desginer at Pixelstrap</h5>
                                                    <p>banglore - 2021</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i data-feather="book"></i></div>
                                                <div>
                                                    <h5>studied computer science</h5>
                                                    <p>at london univercity - 2015</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i data-feather="heart"></i></div>
                                                <div>
                                                    <h5>relationship status</h5>
                                                    <p>single</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i data-feather="map-pin"></i></div>
                                                <div>
                                                    <h5>lived in london</h5>
                                                    <p>last 5 year</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i data-feather="droplet"></i></div>
                                                <div>
                                                    <h5>blood group</h5>
                                                    <p>O+ positive</p>
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
            <!-- user profile fifth-style end-->
        </div>
    </div>

</div>
<!-- Container-fluid Ends-->

@endsection


@section('custom_script')

<script>
    $('.edit_bio').click(function () {
        if ($('.edit_bio i').hasClass('fa-edit')) {
            $('#user_bio').removeAttr('disabled');
            $('.edit_bio').html('<i class="fa fa-floppy-o"></i>');
        } else {
            $('#user_bio').attr('disabled', '');
            $('.edit_bio').html('<i class="fa fa-edit"></i>');
        }
    });

    $('#img_box_100').click(() => {
        $('#picture').click();
    });

</script>

<script>
    $('#userUpdate').on('submit', function (e) {
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
                $('#picture').val('');
                if ($('.edit_bio i').hasClass('fa-floppy-o')) {
                    $('#user_bio').attr('disabled', '');
                    $('.edit_bio').html('<i class="fa fa-edit"></i>');
                }
                setTimeout(
                    function () {
                        //do something special
                        autoauth();
                    }, 1500);
                notyf.success("Employee Update Successfully!");
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });

</script>

@endsection


@section('custom_style')

@endsection
