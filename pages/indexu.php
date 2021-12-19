<?php
session_start();
$page="home";
 include "header.php"; 
 require('admin/dbconnect.php');
 ?>
 <?php
                                    $sql="select* from users";
                                    $stm=$con->prepare($sql);
                                    $stm->execute();
                                   if ($stm->rowCount())
                                   {
                                     foreach($stm->fetchall() as $row)
                                      {
                                        $id=$row['id'];
                                        $name=$row['name'];
                                        $email=$row['email'];
                                        $password=$row['password'];
                                        $address=$row['address'];
                                    }                                            
                                }
                                    ?>

<br>

<ul class="breadcrumb "  style="direction:rtl;">

<li class="breadcrumb-item active"> <a href="logout.php" class="btn btn-dark ml-auto ">Logout</a></li>
<li>____ <a href="min.php?action=edit&id=<?php echo $id ?>" class="btn btn-dark ml-auto ">تعديل</a></li>

</ul>

                         
<div class="container">


<div id="demo" class="carousel slide" data-ride="carousel">

<!-- Indicators -->
<ul class="carousel-indicators">
<li data-target="#demo" data-slide-to="0" class="active"></li>
<li data-target="#demo" data-slide-to="1"></li>
<li data-target="#demo" data-slide-to="2"></li>


</ul>

<!-- The slideshow -->
<div class="carousel-inner">
<div class="carousel-item active">
  <img src="../imges/cars/coursole4.jpg" alt="Los Angeles" width="1100" height="500">
</div>
<div class="carousel-item">
  <img src="../imges/cars/coursole2.jpg" alt="Chicago" width="1100" height="500">
</div>

<div class="carousel-item">
<img src="../imges/cars/coursole1.jpg" alt="New York" width="1100" height="500">
</div>




<!-- Left and right controls -->
<a class="carousel-control-prev" href="#demo" data-slide="prev">
<span class="carousel-control-prev-icon"> </span>
</a>
<a class="carousel-control-next" href="#demo" data-slide="next">
<span class="carousel-control-next-icon"></span>
</a>


</div>


    <h1 class="text-light text-center bg-dark rounded-top  " style="margin: 40px;height: auto; font-size: 4vw;">أنواع
        السيارات الحديثة</h1>
    <div class="row">
    <?php
                                        $sql="select * from product " ;
                                        $stm = $con->prepare($sql);
                                        $stm->execute();

                                        if($stm->rowCount())
                                        {
                                            foreach ($stm->fetchAll() as $row) {
                                              
                                                $name=$row['name'];
                                                $image=$row['image'];
                                                $number_model=$row['number_model'];
                                                $Description=$row['Description'];
                                                ?>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
            <div class="card">
                
                <img src="admin/upload/<?php echo $image ?>" class="img-thumbnail my-img-thumbnail" alt="">
                <div class="card-body">
                    <div class="card-title"> <?php echo $name  ?> </div>
                    <div class="card-text "><?php echo $Description ."<br>" .$number_model ?></div>
                </div>
                <div class="body-footer">
                    <button class="btn btn-warning"> السعر </button>
                </div>
            </div>
        </div>

        <?php
     }
                                                                                        
      }
          ?>

    </div>
</div>

<br>
<?php include "footer.php"; ?>