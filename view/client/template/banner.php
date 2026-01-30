<?php
require_once __DIR__ . '/../../../database/config.php';
?>

<section class="py-3"
    style="background-image: url('<?php echo asset_url('client/images/background-pattern.jpg') ?>');background-repeat: no-repeat;background-size: cover;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="banner-blocks">

                    <div class="banner-ad large bg-info block-1">

                        <div class="swiper main-swiper">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories my-3">Trà nguyên chất</div>
                                            <h3 class="display-4">Trà Sữa Truyền Thống</h3>
                                            <p>Hương vị trà đậm đà kết hợp cùng sữa béo thơm, chuẩn vị trà sữa.</p>
                                            <a href="#"
                                                class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">
                                                Đặt Ngay
                                            </a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="<?php echo asset_url('client/images/slide-1.png') ?>"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories mb-3 pb-3">Topping đa dạng</div>
                                            <h3 class="banner-title">Trà Sữa Topping</h3>
                                            <p>Trân châu đen, trân châu trắng, pudding, thạch – chọn theo sở thích.</p>
                                            <a href="#"
                                                class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                                Xem Menu
                                            </a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="<?php echo asset_url('client/images/slide-4.png') ?>"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories mb-3 pb-3">Bán chạy nhất</div>
                                            <h3 class="banner-title">Trà Sữa Best Seller</h3>
                                            <p>Những món trà sữa được yêu thích nhất tại cửa hàng.</p>
                                            <a href="#"
                                                class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                                Mua Ngay
                                            </a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="<?php echo asset_url('client/images/slide-2.png') ?>"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-pagination"></div>

                        </div>
                    </div>

                    <div class="banner-ad bg-success-subtle block-2"
                        style="background:url('<?php echo asset_url('client/images/slide-3.png') ?>') no-repeat;background-position: right bottom">
                        <div class="row banner-content p-5">

                            <div class="content-wrapper col-md-7">
                                <div class="categories sale mb-3 pb-3">Giảm 20%</div>
                                <h3 class="banner-title">Trà Sữa Truyền Thống</h3>
                                <a href="#" class="d-flex align-items-center nav-link">
                                    Đặt Ngay
                                    <svg width="24" height="24">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="banner-ad bg-danger block-3"
                        style="background:url('<?php echo asset_url('client/images/slide-5.png') ?>') no-repeat;background-position: right bottom">
                        <div class="row banner-content p-5">

                            <div class="content-wrapper col-md-7">
                                <div class="categories sale mb-3 pb-3">Giảm 15%</div>
                                <h3 class="item-title">Trà Sữa Thêm Topping</h3>
                                <a href="#" class="d-flex align-items-center nav-link">
                                    Chọn Ngay
                                    <svg width="24" height="24">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- / Banner Blocks -->

            </div>
        </div>
    </div>
</section>