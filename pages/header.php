<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="MOHAMMED ALSHARAFI">
    <meta name="keywords" content="أفضل السيارات,هاي لوكس جديد,cars, سيارات عرطات, طقم, أنواع السيارات">
    <title>index</title>
    <!-- <link rel="stylesheet" href="../css/bootstrap-rtl/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../css/assest/bootstrap/4.3.1/css/bootstrap.css">
<script src="../css/assest/js/jquery.min.js"></script>
  <script src="../css/assest/js/popper.min.js"></script>
  <script src="../css/bootstrap-rtl/js/bootstrap.js"></script>
  <!-- <script src="../css/assest/bootstrap/4.3.1/js/bootstrap.js"></script> -->
  <link rel="stylesheet" href="../css/font-awesome-4.6.3/css/font-awesome.min.css">
    <style>
        
        #active_page
        {
         
    color: #ffffff !important;

        }

    body {
        /* background-image: url("../imges/backg.jpg"); */
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    /* Make the image fully responsive */
    .carousel-inner img {
        width: 100%;
        height: 500px;
        margin-top: 65px;
        padding: 05px 0px;
        border-radius: 50px;

    }

    .my-img-thumbnail {
        height: 200px;
    }


    footer{

	text-align:center;

	
	}
	
	footer span{
	color:#fff;
	font-size:25px;
	font-weight:bold;
	}
	footer ul li {
	  list-style:none;
	 display:inline-block;
	 margin:5px;
	}
	footer ul li img{
	 width:50px;
     height:50px;	 
	
	
	}
    </style>
</head>

<body dir="rtl">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top  ">
            <a href="#" class="navbar-brand">
               AL-SHARAFI<img class="img-fluid rounded-pill" style="width: 50px;" src="../imges/shear.jpg"
                    alt="شعار الشركة">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#collapse1">
                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse" id="collapse1">
                <ul class="navbar-nav ">
                    <li class="nav-item btn-outline-warning ">
                        <a href="index.php" id="<?php echo ($page=='home')?" active_page ":'';?>" class=" nav-link    ">الرئيسة</a>
                    </li>
                    <li class="nav-item btn-outline-warning dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">المعرض</a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">السيرات</a>
                            <a href="#" class="dropdown-item">المعدات الحفرية </a>
                            <a href="#" class="dropdown-item">المعدات الزراعية</a>
                        </div>
                    </li>
                    

                    <li class="nav-item btn-outline-warning">
                        <a href="connect with us.php"  class=" nav-link ">تواصل معنا</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="newlogin.php">التسجيل بالموقع </a>
                    </li>
                    <li class="nav-item btn-outline-warning">
                        <a  href="login.php" class="nav-link" >تسجيل الدخول</a>
                    </li>

                </ul>
                
                <div class=" mr-sm-auto ">
                    <form class="form-inline   " action="#">
                        <input class="form-control mr-sm-2" type="text" placeholder="بحث">
                        <button class="btn btn-warning form-control mr-sm-2" type="submit">بحث</button>
                    </form>
                </div>

            </div>
        </nav>

    </div>