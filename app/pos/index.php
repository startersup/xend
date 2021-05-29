<?php

date_default_timezone_set('Asia/Kolkata');

session_start();

if (isset($_SESSION["USER_INFO"])) {
    $name = $_SESSION['USER_INFO']['data']["name"];
    $mailId = $_SESSION['USER_INFO']['data']["mailId"];
    $mobile = $_SESSION['USER_INFO']['data']["mobile"];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Xend PoS | VSP Super Market</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/images/xd-logo.png" type="image/svg" sizes="16x16">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="/assets/css/dash.min.css">
    <!-- <script src="/assets/js/mainSite.js"></script> -->
    <link rel="canonical" href="https://xendworks.com/" />
</head>

<body>
    <nav class="xd-app-nav">
        <span class="xd-title">XEND POS</span>
    </nav>
    <div class="tab-content pD50">

        <div class="alert alert-success" style="display:none">
            <strong>Success!</strong> Indicates a successful or positive action.
        </div>
        <div class="alert alert-danger" style="display:none">
            <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
        </div>

        <div id="home" class="tab-pane fade in active">
            <section class="xd-get-details">
                <div class="container">
                    <h3>Welcome to <span>VSP</span> Online Mart 😊</span></h3>
                    <div class="xd-details basic-details">
                        <input value="<?php echo ($name); ?>" type="text" class="form-control xd-form-inputs req-inputs" id="name" required placeholder="Enter your Name *">
                        <input value="<?php echo ($mobile); ?>" type="text" class="form-control xd-form-inputs req-inputs" id="mobile" required placeholder="Enter Contact Number*">
                        <input value="<?php echo ($mailId); ?>" type="text" class="form-control xd-form-inputs req-inputs" id="mailId" placeholder="Enter Email Address ">
                    </div>
                </div>
            </section>
            <a next-href="#menu1" class="basic-details-proceed">
                <div class="xd-bt-fixed ">
                    Proceed
                </div>
            </a>

        </div>
        <div id="menu1" class="tab-pane fade">
            <a class="xd-add-products add">Add +</a>
            <section class="xd-get-details">
                <div class="container">
                    <h3>Add Products</h3>
                    <ul class="xd-product-lists">
                        <div class="xd-mid-pos">
                            <img src="/assets/images/empty-cart.svg"><br>
                        </div>
                        <li><input type="hidden" value="1" class="form-control xd-form-inputs" id="total_chq">
                            <div id="new_chq" class="product-details">

                                <?php
                                $product = '';
                                foreach ($_SESSION['USER_INFO']['product'] as $itemData) {
                                    $item = (object) $itemData;
                                    $product = $product . "<div class='xd-add-wrapper'><input type='text' class='form-control xd-form-md-inputs req-products' value = '" . $item->product . "' placeholder='eg: Maida Maavu - 1kg' > <button class='remove xd-remove-pos product-remove' > x </button></div>";
                                }

                                echo ($product);
                                if ($product !== '') {
                                    echo ("<script>   $('.add').trigger('click');  </script>");
                                }
                                ?>


                            </div>
                        </li>
                    </ul>
                </div>
            </section>
            <a next-href="#menu2" class="product-details-proceed">
                <div class="xd-bt-fixed ">
                    Proceed
                </div>
            </a>
        </div>
        <div id="menu2" class="tab-pane fade">
            <a class="xd-prev" data-toggle="tab" href="#menu1"><i class="fa fa-angle-left"></i> <span>back</span></a>
            <section class="xd-get-details">
                <div class="container">
                    <div class="xd-address">
                        <label>Add Address</label>
                        <textarea class="form-control xd-form-textarea req-book"></textarea>
                        <input type="hidden" class="req-book" id="payment"></input>
                        <label>Mode of Payment</label>
                        <div class="xd-paytype"><input type="radio" name="optradio" class="pay-check" checked> Online</div>
                        <div class="xd-paytype"> <input type="radio" name="optradio" class="pay-check"> Cash On Delivery</div>
                    </div>
                </div>
            </section>
            <a next-href="#menu3">
                <div class="xd-bt-fixed">
                    Proceed
                </div>
            </a>
        </div>


        <div id="menu3" class="tab-pane fade">
            <a class="xd-prev" data-toggle="tab" href="#menu2"><i class="fa fa-angle-left"></i> <span>back</span></a>
            <section class="xd-get-details">
                <div class="container">
                    <h3>Confirm Order</h3>
                    <ul class="xd-product-confirm">
                        <li class="products">Maida Maavu 1kg <a> ❌ </a></li>
                        <li class="products">Kadalai Paarupu 200g <a> ❌ </a></li>
                        <li class="products">Meera shampoo - 3 Nos <a> ❌ </a></li>
                    </ul>
                </div>
            </section>
            <a next-href="#menu4">
                <div class="xd-bt-fixed">
                    Confirm
                </div>
            </a>
        </div>

        <div id="menu4" class="tab-pane fade">
            <section class="xd-order-confirm">
                <div class="container">
                    <div class="xd-confirm">
                        <h3>Success !</h3>
                        <h5>Your Order has been placed Successfully 🎉 </h5>
                        <h4>Order Id: 456373</h4>
                        <p>Use this order id to track your order status, we ensure to deliver your products safely during this COVID crisis.</p>
                        <a data-toggle="tab" href="#home"> Back to Home </a>
                    </div>
                </div>
            </section>
            <a href="tel:9884489994">
                <div class="xd-bt-fixed">
                    Contact Us
                </div>
            </a>
        </div>
    </div>
</body>

<script>
    var version = Math.floor(Math.random() * 100);
    // document.write('<script src="https://urbanxperts.in/assets/js/common.js?dev=' +version + '"\><\/script>');
    document.write('<script src="/assets/js/global.js?dev=' + version + '"\><\/script>');
    document.write('<script src="/assets/js/serverCall.js?dev=' + version + '"\><\/script>');
    document.write('<script src="/assets/js/mainSite.js?dev=' + version + '"\><\/script>');
</script>

</html>