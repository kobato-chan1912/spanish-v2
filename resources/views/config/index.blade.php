<!DOCTYPE html>
<html lang="en">
@php
    $titleHead = "Chỉnh sửa chung";

@endphp
@include("layouts.head", ["title" => env("WEB_NAME"). " - $titleHead"])
<body>
<!-- Loader starts-->
<div class="loader-wrapper">
    <div class="theme-loader">
        <div class="loader-p"></div>
    </div>
</div>
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    @include("layouts.header")
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Start-->
        @include("layouts.sidebar")
        <!-- Page Sidebar Ends-->
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>Chỉnh sửa cài đặt chung</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="https://cdn.apkgosu.com">Home</a></li>
                                <li class="breadcrumb-item active"> Cài đặt</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>Cài đặt</h5>
                            </div>
                            <form class="form theme-form" method="post" action="">
                                @csrf
                                <div class="card-body">
                                    @foreach($configs as $config)
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">{{$config->config_name}}</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="{{$config->config_name}}" value="{{$config->config_value}}">
                                            </div>
                                        </div>

                                    @endforeach



                                    <div class="card-footer text-end">
                                        <button class="btn btn-primary" type="submit">Lưu</button>

                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include("layouts.footer")
    </div>
</div>
<!-- latest jquery-->
@include("layouts.jsloading")
@if(session()->get("message"))
    <script>

        swal({
            icon: 'success',
            title: 'Thành công!',
            text: '{{session()->get("message")}}',

        })


    </script>
@endif
</body>
</html>
