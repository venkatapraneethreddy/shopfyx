<?php
session_start();

require_once("php/createdb.php");
require_once("php/createdb1.php");
require_once("php/createdb2.php");
require_once("php/createdb3.php");
require_once("php/createdb4.php");
require_once("php/createdb5.php");
require_once("php/component.php");

// Instantiate database objects for both databases
$db1 = new createdb('productdb','producttb');
$db2 = new createdb1('productdb1','producttb1');
$db3 = new createdb2('productdb2','producttb2');
$db4 = new createdb3('productdb3','producttb3');
$db5 = new createdb4('productdb4','producttb4');
$db6 = new createdb5('productdb5','producttb5');

if(isset($_POST['remove'])){
    if($_GET['action']=='remove'){
        foreach($_SESSION['cart'] as $key=>$value){
            if($value['product_id']==$_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been removed')</script>";
                header("Location: cart.php"); // Redirect back to the cart page
                exit();
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class='bg-light'>
    <?php
    require_once('php/header.php');
    ?>
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>My Cart</h6>
                    <hr>
                    <?php
                    $total = 0;
                    if(isset($_SESSION['cart'])) {
                        $product_id = array_column($_SESSION['cart'],'product_id');

                        // Fetch data from the first database
                        $result1 = $db1->getData();
                        while ($row = mysqli_fetch_assoc($result1)) {
                            if (in_array($row['id'], $product_id)) {
                                cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                                $total += (int)$row['product_price'];
                            }
                        }

                        // Fetch data from the second database
                        $result2 = $db2->getData();
                        while ($row = mysqli_fetch_assoc($result2)) {
                            if (in_array($row['id'], $product_id)) {
                                cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                                $total += (int)$row['product_price'];
                            }
                        }

                         $result3= $db3->getData();
                        while ($row = mysqli_fetch_assoc($result3)) {
                            if (in_array($row['id'], $product_id)) {
                                cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                                $total += (int)$row['product_price'];
                            }
                        }

                        $result4= $db4->getData();
                        while ($row = mysqli_fetch_assoc($result4)) {
                            if (in_array($row['id'], $product_id)) {
                                cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                                $total += (int)$row['product_price'];
                            }
                        }

                        $result5= $db5->getData();
                        while ($row = mysqli_fetch_assoc($result5)) {
                            if (in_array($row['id'], $product_id)) {
                                cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                                $total += (int)$row['product_price'];
                            }
                        }

                        $result6= $db6->getData();
                        while ($row = mysqli_fetch_assoc($result6)) {
                            if (in_array($row['id'], $product_id)) {
                                cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                                $total += (int)$row['product_price'];
                            }
                        }

                    } else {
                        echo "<h5>Cart is Empty</h5>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if(isset($_SESSION['cart'])){
                                $count = count($_SESSION['cart']);
                                echo "<h6>Price($count items)</h6>";
                            } else {
                                echo "<h6>Price(0 items)</h6>";
                            }
                            ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>$<?php echo $total;?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6>$<?php echo $total; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <!-- JavaScript libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>
