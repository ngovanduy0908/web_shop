<?php
    session_start();
    require_once('database/dbhelper.php');
    require_once('utils/utility.php');
    $sql = "select * from category";
    $menuItem = executeResult($sql);
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="icon" type="image/png" href="https://gokisoft.com/uploads/2021/03/s-568-ico-web.jpg" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <style>
        .nav-item{
            margin-top: 20px; 
        }
        .navbar-nav li{
            text-transform: uppercase;
        }

        .navbar-nav li a {
            color: #28a745;
            font-weight: bold;
        }
        .carousel-inner img{
            height: 50%;
            width: 100%;
        }
        .product-item{
            margin: 5px 0;
        }

        .product-item img{
            width: 100%;
            height: 60%;
        }
        .product-item:hover{
            background-color: #ccc;
            cursor: pointer;
        }
        footer{
            background-color: #81d742 ;
        }
        footer .container{
            padding: 20px 0;
        }
        ul{
            list-style: none;
            padding: 0;
        }
        ul li{
            margin-top: 5px;
        }

        .cart_icon{
            position: fixed;
            z-index: 10;
            top: 60%;
            right: 0px;
        }

        .cart_icon img{
            width: 50px;
            height: 50px;
        }

        .cart_count{
            background: red;
            color: white;
            position: absolute;
            top: 10px;
            left: -5px;
            padding:0 5px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <!-- Menu Start -->
    <div class="container">
        <nav class="navbar navbar-expand-sm bg-light">
            <ul class="navbar-nav">
                <li><img src="https://t004.gokisoft.com/uploads/2021/07/1-s-1636-logo-web.jpg" alt="" style="height: 80px"></li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                </li>
                <?php
                    foreach($menuItem as $item){
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="category.php?id='.$item['id'].'">'.$item['name'].'</a>
                        </li>
                        ';
                    }
                ?>
                
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Liên Hệ</a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Menu Stop -->
