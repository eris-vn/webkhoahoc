    <!-- Start breadcrumb Area -->
    <div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner text-center">
                        <h2 class="title">Thanh toán</h2>
                        <ul class="page-list">
                            <li class="rbt-breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                            <li>
                                <div class="icon-right"><i class="feather-chevron-right"></i></div>
                            </li>
                            <li class="rbt-breadcrumb-item active">Thanh toán</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area -->

    <div class="checkout_area bg-color-white rbt-section-gap">
        <div class="container">
            <div class="row g-5 checkout-form">

                <div class="col-lg-7">
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

                    <div class="cart-summary sticky-top" style="top: 100px">
                        <div class="cart-summary-wrap">
                            <div class="section-title text-start">
                                <h4 class="title mb--30">Tổng Quan</h4>
                            </div>
                            <p>Tạm tính <span><?= number_format($subtotal) ?> vnđ</span></p>
                            <p>Phí ship <span>0</span></p>
                            <h2>Tổng cộng <span><?= number_format($subtotal) ?> vnđ</span></h2>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="row pl--50 pl_md--0 pl_sm--0">

                        <!-- Payment Method -->
                        <div class="col-12 mb--60">
                            <div class="checkout-payment-method">
                                <h4 class="checkout-title">Phương Thức Thanh Toán</h4>

                                <div class="single-method">
                                    <input type="radio" id="payment_check" name="payment-method" value="vnpay">
                                    <label for="payment_check">VNPAY</label>
                                </div>

                                <div class="single-method">
                                    <input type="radio" id="payment_bank" name="payment-method" value="bank">
                                    <label for="payment_bank">Momo</label>
                                    <p data-method="bank">Vui lòng kiểm tra kỹ thông tin trước khi chuyển khoản.</p>
                                </div>

                                <div class="single-method">
                                    <input type="radio" id="payment_cash" name="payment-method" value="cash">
                                    <label for="payment_cash">Ngân hàng</label>
                                    <p data-method="cash">Vui lòng kiểm tra kỹ thông tin trước khi chuyển khoản.</p>
                                </div>

                                <div class="single-method">
                                    <input type="checkbox" id="accept_terms">
                                    <label for="accept_terms">Tôi đã đọc và chấp nhận <a href="#">Điều khoản & Sử dụng</a></label>
                                </div>

                                <div class="plceholder-button mt--50">
                                    <button class="rbt-btn btn-gradient hover-icon-reverse w-100" onclick="on_payment()">
                                        <span class="icon-reverse-wrapper">
                                            <span class="btn-text">THANH TOÁN</span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </span>
                                    </button>
                                </div>
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


    <script>
        function on_payment() {
            let payment_method = $("input[name='payment-method']:checked").val();
            let accept_terms = $('#accept_terms').is(':checked');

            if (!accept_terms) {
                return Toastify({
                    text: "Vui lòng chấp điều khoản để tiếp tục",
                    duration: 3000,
                    style: {
                        background: "linear-gradient(to right, #F64C18, #EE9539)",
                    },
                }).showToast();
            }

            if (!payment_method) {
                return Toastify({
                    text: "Vui lòng chọn phương thức thanh toán",
                    duration: 3000,
                    style: {
                        background: "linear-gradient(to right, #F64C18, #EE9539)",
                    },
                }).showToast();
            }

            $.ajax({
                method: "POST",
                url: "/api/checkout",
                data: {
                    payment_method,
                    accept_terms
                },
            }).done(function(data) {
                if (data.status == 200) {
                    let timerInterval;
                    Swal.fire({
                        title: "THÀNH CÔNG!",
                        icon: 'success',
                        html: "Thanh toán thành công, tự chuyển hướng sau <b></b>s.",
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                                // Chuyển đổi từ mili-giây sang giây và làm tròn xuống
                                const seconds = Math.floor(Swal.getTimerLeft() / 1000);
                                timer.textContent = `${seconds}`;
                            }, 1000);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then((result) => {
                        window.location.href = '/user/enrolled-courses';
                    });
                } else if (data.status == 201) {
                    window.location.href = data.url;
                } else {
                    Toastify({
                        text: data.msg,
                        duration: 3000,
                        style: {
                            background: "linear-gradient(to right, #F64C18, #EE9539)",
                        },
                    }).showToast();
                }
            });
        }
    </script>