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
            <!-- user profile header start-->
            <div class="col-sm-12">
                <div class="card profile-header"><img class="img-fluid bg-img-cover"
                        src="{{asset('assets/backend')}}/images/user-profile/bg-profile.jpg" alt="">
                    <div class="profile-img-wrrap"><img class="img-fluid bg-img-cover"
                            src="{{asset('assets/backend')}}/images/user-profile/bg-profile.jpg" alt=""></div>
                    <div class="userpro-box">
                        <div class="img-wrraper">
                            <div class="avatar"><img class="img-fluid" alt="" src="{{asset('assets/backend')}}/images/user/7.jpg"></div><a
                                class="icon-wrapper" href="edit-profile.html"><i
                                    class="icofont icofont-pencil-alt-5"></i></a>
                        </div>
                        <div class="user-designation">
                            <div class="title"><a target="_blank" href="">
                                    <h4>Emay Walter</h4>
                                    <h6>designer</h6>
                                </a></div>
                            <div class="social-media">
                                <ul class="user-list-social">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                </ul>
                            </div>
                            <div class="follow">
                                <ul class="follow-list">
                                    <li>
                                        <div class="follow-num counter">325</div><span>Follower</span>
                                    </li>
                                    <li>
                                        <div class="follow-num counter">450</div><span>Following</span>
                                    </li>
                                    <li>
                                        <div class="follow-num counter">500</div><span>Likes</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- user profile header end-->
            <div class="col-xl-3 col-lg-12 col-md-5 xl-35">
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
            <div class="col-xl-9 col-lg-12 col-md-7 xl-65">
                <div class="row">
                    <!-- profile post start-->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="profile-post">
                                <div class="post-header">
                                    <div class="media"><img class="img-thumbnail rounded-circle me-3"
                                            src="{{asset('assets/backend')}}/images/user/7.jpg" alt="Generic placeholder image">
                                        <div class="media-body align-self-center"><a href="social-app.html">
                                                <h5 class="user-name">Emay Walter</h5>
                                            </a>
                                            <h6>22 Hours ago</h6>
                                        </div>
                                    </div>
                                    <div class="post-setting"><i class="fa fa-ellipsis-h"></i></div>
                                </div>
                                <div class="post-body">
                                    <div class="post-react">
                                        <ul>
                                            <li><img class="rounded-circle" src="{{asset('assets/backend')}}/images/user/3.jpg" alt="">
                                            </li>
                                            <li><img class="rounded-circle" src="{{asset('assets/backend')}}/images/user/5.jpg" alt="">
                                            </li>
                                            <li><img class="rounded-circle" src="{{asset('assets/backend')}}/images/user/1.jpg" alt="">
                                            </li>
                                        </ul>
                                        <h6>+5 people react this post</h6>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                        culpa qui officia deserunt mollit anim id est laborum. </p>
                                    <ul class="post-comment">
                                        <li>
                                            <label><a href="#"><i data-feather="heart"></i>&nbsp;&nbsp;Like<span
                                                        class="counter">50</span></a></label>
                                        </li>
                                        <li>
                                            <label><a href="#"><i
                                                        data-feather="message-square"></i>&nbsp;&nbsp;Comment<span
                                                        class="counter">70</span></a></label>
                                        </li>
                                        <li>
                                            <label><a href="#"><i data-feather="share"></i>&nbsp;&nbsp;share<span
                                                        class="counter">20</span></a></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- profile post end-->
                </div>
            </div>
            <!-- user profile fifth-style end-->
        </div>
    </div>

</div>
<!-- Container-fluid Ends-->

@endsection
