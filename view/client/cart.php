<!-- Start breadcrumb Area -->
<div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner text-center">
                    <h2 class="title">Giỏ hàng</h2>
                    <ul class="page-list">
                        <li class="rbt-breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li>
                            <div class="icon-right"><i class="feather-chevron-right"></i></div>
                        </li>
                        <li class="rbt-breadcrumb-item active">Giỏ hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb Area -->

<div class="rbt-cart-area bg-color-white rbt-section-gap">
    <div class="cart_area">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8 col-12">
                    <form class="cart-summary" action="#">
                        <div class="cart-summary-wrap">
                            <div class="cart-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Ảnh bìa</th>
                                            <th class="pro-title">Tên</th>
                                            <th class="pro-price">Giá</th>
                                            <th class="pro-remove">Xoá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($cart) : ?>
                                            <?php foreach ($cart as $item) : ?>
                                                <?php
                                                $course = (new Course)->where("status", "=", 0)->where('id', '=', $item)->first();
                                                ?>
                                                <tr>
                                                    <td class="pro-thumbnail"><a href="#"><img src="<?= $course['thumbnails'] ?>" alt="Product"></a></td>
                                                    <td class="pro-title"><a href="#"><?= $course['name'] ?></a></td>
                                                    <td class="pro-price"><span><?= number_format($course['price']) ?> vnđ</span></td>
                                                    <td class="pro-remove"><a href="?" onclick="delete_cart(<?= $course['id'] ?>)"><i class="feather-x"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4">
                                                    Chưa có sản phẩm nào.
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Cart Table -->

                    </form>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="cart-summary sticky-top" style="top: 100px">
                        <div class="cart-summary-wrap">
                            <div class="section-title text-start">
                                <h4 class="title mb--30">Tổng Quan</h4>
                            </div>
                            <p>Tạm tính <span><?= number_format($subtotal) ?> vnđ</span></p>
                            <p>Phí ship <span>0</span></p>
                            <h2>Tổng cộng <span><?= number_format($subtotal) ?> vnđ</span></h2>
                        </div>

                        <div class="cart-submit-btn-group">
                            <a href="/checkout" class="single-button w-100">
                                <button class="rbt-btn btn-gradient rbt-switch-btn rbt-switch-y w-100">
                                    <span data-text="THANH TOÁN">THANH TOÁN</span>
                                </button>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="rbt-separator-mid">
    <div class="container">
        <hr class="rbt-separator m-0">
    </div>
</div>