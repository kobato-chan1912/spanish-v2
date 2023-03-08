<!DOCTYPE html>
<html lang="en">
@include("layouts.head", ["title" => env("WEB_NAME"). " - Advertisement Management"])
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
    @include("layouts.header_search")
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
                            <div class="page-header-left">
                                <h3>Quản lý ads</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route("dashboard")}}">Home</a></li>
                                    {{--                                    <li class="breadcrumb-item">Pages    </li>--}}
                                    {{--                                    <li class="breadcrumb-item">Ecommerce</li>--}}
                                    <li class="breadcrumb-item active">Ads list</li>
                                </ol>
                            </div>
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

                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ads_modal"
                                        data-whatever="@mdo" onclick='$("#ads").trigger("reset"); $("#ads").attr("method", "post"); $("#ads").attr("action", "");'>
                                    <i class="fa fa-google" style="padding-right: 4px;"></i>
                                    Thêm ads
                                </button>


                                <div class="modal fade" id="ads_modal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Quản lý ads</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="" id="ads">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label class="col-form-label"
                                                               for="recipient-name">Tên ads:</label>
                                                        <input class="form-control" type="text" id="ads_name" name="ads_name"
                                                               required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="col-form-label"
                                                               for="category_meta_title">Ads Script:</label>
                                                        <textarea class="form-control" type="text" id="ads_script" name="ads_script" rows="8" required></textarea>
                                                    </div>




                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" type="submit">Lưu</button>
                                                    <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">
                                                        Thoát
                                                    </button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="order-history table-responsive wishlist">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th># ID</th>
                                                <th>Tên ads</th>
                                                <th>Đặt ads trang chủ</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ads as $ad)
                                                <tr>
                                                    <td> {{$ad->id}}</td>
                                                    <td>
                                                        <div class="product-name"><a href="javscript:void(0)">
                                                                <h6>{{$ad->name}}</h6></a></div>
                                                    </td>

                                                    <td>
                                                        @if($ad->home_ads == 1)
                                                        <i data-feather="check-circle" style="stroke: green"></i>
                                                            @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route("adsHome", $ad->id)}}"><i
                                                                data-feather="home"></i></a>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                           data-bs-target="#ads_modal" data-whatever="@mdo"
                                                           onclick="updateAds($(this))" data-id="{{$ad->id}}"
                                                           data-name="{{$ad->name}}" data-script="{{$ad->script}}"><i
                                                                data-feather="edit"></i></a>
                                                        <a href="javascript:void(0)" data-id="{{$ad->id}}"
                                                           onclick="deleteAds($(this))">
                                                            <i data-feather="x-circle"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    <style>
                                        .pagination {
                                            padding-top: 20px;
                                            margin-left: -0.5rem !important;
                                            margin-right: -0.5rem !important;
                                            justify-content: center;
                                        }
                                        .page-item.active .page-link{
                                            background-color: #158fea; border-color: #cbd1da00;
                                        }

                                    </style>
                                    {{--                                    {{ $categories->appends(request()->input())->links() }}--}}

                                </div>


                            </div>
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
@include("layouts.jsloading")
<script src="/assets/js/touchspin/vendors.min.js"></script>
<script src="/assets/js/touchspin/touchspin.js"></script>
<script src="/assets/js/touchspin/input-groups.min.js"></script>
<script src="/assets/js/slug.js"></script>
@if(session()->get("message"))
    <script>

        swal({
            icon: 'success',
            title: 'Thành công!',
            text: '{{session()->get("message")}}',

        })


    </script>
@endif
<script>

    function updateAds(ele) {
        $("#ads_name").val(ele.data("name"))
        $("#ads_script").val(ele.data("script"));
        $("#ads").attr("method", "post");
        $("#ads").attr("action", '{{env("APP_URL")}}'+'/ads/' + ele.data('id'));
    }

    function deleteAds(ele)
    {
        let id = (ele.data("id"));

        swal({
            title: "Thao tác không hoàn tác được!",
            text: "Bên nên chỉnh sửa thay vì xóa ads!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{env("APP_URL"). "/ads/"}}" + id,
                        type: "delete",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response) {
                                swal('Đang xóa Ads!', '', 'success')
                                location.reload();
                            }
                        },
                    });
                } else {
                    // null
                }

            });
    }

    function searching(val){
        let url = "{{env("APP_URL")}}" +  "/categories?search=" + val;
        window.location.href = url;
    }

    $("#searching_input").on("keydown",function search(e) {
        if(e.keyCode == 13) {
            searching($(this).val());
        }
    });


</script>



</body>
</html>
