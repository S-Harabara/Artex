<!doctype html>
<html>
<head>
    <title>Here We With Sandbox Go</title>
    <style>
        table {
            border-collapse: collapse;

        }
        html, body {
            padding: 0;
            /*margin: 0;*/
            font-family: sans-serif;
            font-size: 12px;
        }

        .order-info {
            width: 100%;
        }
        .order-info__table{
            width: 100%;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
        }

        .order-info__table td {
            padding: 5px 0;
        }
        .order-info__table td:nth-child(2){
            text-align: right;
        }
        .order-info__title {
            text-align: right;
            font-size: 22px;
            width: 100%;
        }

        .header {
            vertical-align: top;
        }

        .header td{
            /*border: 1px solid red;*/
        }

        .header td td {
            border: none;
        }

        .header__left {
            width: 48%;
        }
        .header__center {
            width: 17%;
        }
        .header__right {
            width: 35%;
        }
        .logo-table {
            vertical-align: top;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .product-header {
            border-bottom: 1px solid #000;
            width: 100%;
            margin-top: 80px;
        }
        /*.logo-table td {*/
        /*    border: 1px solid red;*/
        /*}*/
        /*.hl {*/
        /*    border: 1px solid red;*/
        /*}*/

        .online-quote {
            width: 100%;
            table-layout: fixed;
            font-size: 22px;
        }

        .product {
            width: 100%;
            margin-top: 80px;
            margin-bottom: 80px;
        }

        .product__col-title {
            width: 40%;
            text-align: center;
        }
        .product__col-photo {
            width: 35%;
        }
        .product__col-price {
            width: 15%;
            text-align: right;
            font-size: 18px;
            vertical-align: bottom;
        }

        .product__title {
            font-size: 28px;
        }
        .props {

        }

        .props__td {
            font-size: 22px;
        }
    </style>
</head>
<body>

<?php

$name =  isset($_POST['name'] ) ? $_POST['name']  : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$image = isset($_POST['image']) ? $_POST['image'] : '';
$options = isset($_POST['options']) ? $_POST['options'] : [];

?>

<table class="online-quote">
    <tr>
        <td class="hl" style="text-align: right">
            ONLINE <b>QUOTE</b>
        </td>
    </tr>
</table>
<table class="header">
    <tr>
        <td class="header__left">
            <table class="logo-table" cellpadding="0" style="font-size: 14px">
                <tr>
                    <td style="width: 60%; padding-right: 10px">
                        <img src="../img/logo.png" >
                    </td>
                    <td style="width: 40%; padding-top: 10px">
                        <div>
                            <b>Artex Manufacturing</b>
                        </div>
                        <div>
                            36419 US Hwy 71
                        </div>
                        <div>
                            PO Box 88
                        </div>
                        <div>
                            Redwood Falls, MN 56283
                        </div>
                        <div>
                            (507) 644-2893
                        </div>
                        <div>
                            (507) 644-7000 (Fax)
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td class="header__center">

        </td>
        <td class="header__right">
            <div class="order-info hl">
                <table class="order-info__table">
                    <tr>
                        <td style="padding-top: 10px">
                            Sales Quote Number
                        </td>
                        <td style="padding-top: 10px">
                            <?php echo isset($salesQuoteNumber) ? $salesQuoteNumber: ''; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Sales Quote Date
                        </td>
                        <td>
                            <?php echo date("m.d.y"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 80px">
                            P.O. Number
                        </td>
                        <td style="padding-bottom: 80px">
                            <?php echo time(); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>

<table class="product-header">
    <tr>
        <td style="text-align: center">
            Trailer & Accessories
        </td>
        <td style="text-align: right">
            Price Estimate
        </td>
    </tr>
</table>

<table class="product">
    <tr>
        <td class="product__col-title">
            <div class="product__title">
                <?php echo strip_tags($name); ?>
            </div>

            <?php if(count($options) > 0): ?>
            <table class="props">
                <?php foreach ($options as $option): ?>
                <tr>
                    <td class="props__td">
                        <?php echo strip_tags($option); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </td>
        <td class="product__col-photo">
            <img src="<?php echo $image; ?>" alt="product-photo">
        </td>
        <td class="product__col-price">
            <?php echo strip_tags($price); ?>
        </td>
    </tr>
</table>


<table style="margin-top: 80px">
    <tr>
        <td style="width: 75%; font-size: 10px">
            THIS QUOTE is not a final price. It is only an estimation. Final prices may be cheaper or more expensive. Please
            contact the sales department for final pricing.
        </td>
        <td>

        </td>
    </tr>
</table>
</body>
</html>