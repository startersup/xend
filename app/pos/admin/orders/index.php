<?php

$temp = $_SERVER['DOCUMENT_ROOT'];
include($temp . "/connection/connection.php");
$sql_query_order = "SELECT `sno`, `id`, `mobile`, `mail`, `name`, `address`, `pay_type`, `pay_status`, `order_total`, `delivery_total`, `total`, `item_count`,( SELECT  dd.`optionText` FROM `dropDowns` as dd WHERE dd.`id` = 1 and dd.`optionValue` = od.`status` and `status` = 0 ) as Status, `tiktok` FROM `orders` as od WHERE od.status not in (4,5)";
$result_order =  mysqli_query($conn, $sql_query_order);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Xend PoS | Orders</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" href="../assets/images/xd-logo.png" type="image/svg" sizes="16x16"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/assets/css/animation.css?3">
    <link rel="stylesheet" href="/assets/css/dash.min.css?3">
    <link rel="canonical" href="https://xendworks.com/" />
</head>

<body>
    <nav class="xd-app-nav">
        <span class="xd-title-left">XEND POS</span>
        <div class="xd-user-wrapper">
            <span class="xd-user-name xd-flex">
                <div class="shortname"></div>
                <div class="name" class="name" title="" data-id="Santhosh">Santhosh</div>
            </span>
            <div class="xd-action-dropdown">
                <ul>
                    <li>Log out</li>
                    <li>View Sales</li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="xd-orders">
            <div class="xd-flex xd-sticky">
                <h3>Orders <span class="label label-success" id="orderCount"></span></h3>
                <input class="form-control xd-searchbar" id="searchfilter" placeholder="Search for Orders">
            </div>
            <ul class="xd-orders-list" id="results">
                <?php

                while ($row_order = mysqli_fetch_array($result_order, MYSQLI_ASSOC)) {

                ?>
                    <li>
                        <div class="xd-order-card">
                            <div class="xd-orderId xd-space">
                                <h5>Id</h5>
                                <p><?php echo ($row_order["id"]); ?></p>
                            </div>
                            <div class="xd-orderName xd-space">
                                <h5>Customer Name</h5>
                                <p><?php echo ($row_order["name"]); ?></p>
                            </div>
                            <div class="xd-orderNumber xd-space">
                                <h5>Contact Number</h5>
                                <p><?php echo ($row_order["mobile"]); ?></p>
                            </div>
                            <div class="xd-orderItem xd-space">
                                <h5>Items Ordered</h5>
                                <p><?php echo ($row_order["item_count"]); ?></p>
                            </div>
                            <div class="xd-orderPayType xd-space">
                                <h5>Pay Mode</h5>
                                <p><?php echo ($row_order["pay_type"]); ?></p>
                                <input type="hidden" id="<?php echo ("input_" . $row_order["id"]); ?>" value="<?php echo json_encode($row_order); ?>">
                            </div>
                            <div class="xd-orderId xd-space">
                                <h5>Action</h5>
                                <a inp-id="<?php echo ("input_" . $row_order["id"]); ?>" class="order-items-show">Edit</a>
                                <a style="display:none" class="xd-process-order" data-toggle="modal" data-target="#myModal">Edit</a>
                            </div>
                        </div>
                    </li>

                <?php
                }

                ?>

            </ul>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal bg xd-orderpopup" id="myModal" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">✕</button>
                    <h4 class="modal-title xd-poptitle order-title">Order Id: VSP67382</h4>
                </div>
                <div class="modal-body xd-popup-body">
                    <h3>Order Items</h3>
                    <ul class="xd-order-items order-item-list">
                        <li class="products">Maida Maavu 1kg <input class="xd-rate-box" placeholder="Enter Rate"><a class="item-cross"> ❌ </a> <a class="item-tick">✔️</a></li>

                    </ul>
                    <div class="xd-grand-total">
                        <ul class="xd-order-items">
                            <li class="products">Grand Total<input id="grand_total" class="xd-rate-box" disabled value="" placeholder=""></li>
                        </ul>
                    </div>

                    <div class="xd-grand-total">
                        <ul class="xd-order-items">
                            <li class="products"> Payment type <select class="xd-rate-box">
                                    <option value="online"> Online </option>
                                    <option value="cash on delivery"> Cash On Delivery </option>
                                </select></li>
                        </ul>
                    </div>

                    <div class="xd-grand-total">
                        <ul class="xd-order-items">
                            <li class="products"> Payment status <select class="xd-rate-box">
                                    <option value="pending"> Pending </option>
                                    <option value="paid"> Paid </option>
                                </select></li>
                        </ul>
                    </div>
                    <div class="xd-grand-total">
                        <ul class="xd-order-items">
                            <li class="products"> Order status <select dropdown="1" class="xd-rate-box">
                                    <option value=''>--SELECT--</option>
                                    <?php
                                    $sql_query_drop = " SELECT  `optionValue`, `optionText` FROM `dropDowns` WHERE `status` = 0 and `id` = 1 ";
                                    $result_drop =  mysqli_query($conn, $sql_query_drop);

                                    while ($row_drop = mysqli_fetch_array($result_drop, MYSQLI_ASSOC)) {

                                    ?>
                                        <option value='<?php echo ($row_drop['optionValue'])  ?>'><?php echo ($row_drop['optionText'])  ?></option>
                                    <?php  } ?>
                                </select></li>
                        </ul>
                    </div>

                </div>
                <div class="modal-footer pD20">
                    <a class="xd-cancel order-cancel">Cancel Order</a>
                    <a class="xd-proceed order-update">Update Order</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var version = Math.floor(Math.random() * 100);
    // document.write('<script src="https://urbanxperts.in/assets/js/common.js?dev=' +version + '"\><\/script>');
    document.write('<script src="/assets/js/global.js?dev=' + version + '"\><\/script>');
    document.write('<script src="/assets/js/serverCall.js?dev=' + version + '"\><\/script>');
    document.write('<script src="/assets/js/mainSite.js?dev=' + version + '"\><\/script>');
    document.write('<script src="/assets/js/login.js?dev=' + version + '"\><\/script>');
    // document.write('<link rel="stylesheet" href="/assets/css/animation.css?dev=' + version + '">');
    // document.write('<link rel="stylesheet" href="/assets/css/dash.min.css?dev=' + version + '">');
</script>
<script>
    $("#searchfilter").keyup(function() {
        var filter = $(this).val(),
            count = 0;
        $('#results .xd-order-card').each(function() {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show();
                count++;
            }
        });

    });
</script>
<script>
    $('.name').each(function() {
        var $name = $(this);
        var str = $name.attr('data-id');
        var matches = str.match(/\b(\w)/g);
        var acronym = matches.join('');
        $name.prev('.shortname').prepend('<div class="my-circle">' + acronym + '</div>');
    });

    var $orderCount = $('#results').find(".xd-order-card:visible").length;
    $('#orderCount').html($orderCount);
</script>


</html>