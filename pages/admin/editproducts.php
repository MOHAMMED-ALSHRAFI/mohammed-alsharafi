<?php
session_start();
if (isset($_SESSION['user_info'])) {
include('header.php');
require('dbconnect.php');
?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-items"></i>Products</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr/>
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> edit Porduct
                    </div>
                    
                        
                        <?php 
                        if (isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit' )
                        {
                            $id=$_GET['id'];
                            $sql="select * from product where id=:proid" ;
                            $stm = $con->prepare($sql);
                            $stm->execute(array("proid"=>$id));

                            if($stm->rowCount())
                            {
                                foreach ($stm->fetchAll() as $row) {
                                    $id=$row['id'];
                                    $name=$row['name'];
                                    $number_model=$row['number_model'];
                                    $Description=$row['Description'];
                                 
                     
                                         if (isset($_POST['submitProduct'])) {
                                            $id=$_POST['id'];
                                           $name=trim($_POST['name']);
                                           $image = $_FILES['file'];
                                           $model=trim($_POST['model']);
                                           $cat_id =$_POST['cat_id'];
                                           $description=trim($_POST['description']);
                                           $image_name= $image['name'];
                                           $image_type= $image['type'];
                                           $image_tmp= $image['tmp_name'];
                                           $errors=array();
                    
                                           $extensions=array('jpg','gif','png');
                                           $file_explode=explode('.',$image_name);
                                           $file_extension=strtolower(end($file_explode));
                                            if(!in_array($file_extension,$extensions))
                                            {
                                              $errors['image_error'] = "<div style='color:red'>file extensions is Not Vaild</div>";
                                            }
                                            
                                           if (is_numeric($name)) {
                                              $errors['name']="NAME MAST BE STRING.";
                                           }
                                           if (!isset($model)) {
                                            $errors['model']="THIS FIELD IS REQUIRED.";
                                         }
                                           if(empty($errors)){
                                            if (move_uploaded_file($image_tmp, "upload/".$image_name)) {
                                                $password=sha1($_POST['password']);
                                                $sql="UPDATE  product SET name=?,image=?, number_model=?,Description=?,cat_id=? where id=? " ;
                                                $stm = $con->prepare($sql);
                                                $stm->execute(array($name ,$image_name ,$model, $description ,$cat_id ,$id));
                                                if ($stm->rowCount()) {

                                                    echo "<script>
                                                 alert('one row Update');
                                                 window.open('products.php','_self' );
                                                 </script>";
                                                } else {
                                                    echo "<div class='alert alert-danger'>Row Not Update</div>" ;
                                                }
                                            }
                                            else 
                                            {
                                                echo "<div class='alert alert-danger'>Not upload file</div>";
                                            }
                                        
                                        }
                    
                                  
                                    }
                                        
                                        
                                           

                        ?>


                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" role="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Please Enter your Name "
                                        value="<?php echo $name ?>"  class="form-control" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['name'] )) echo  $errors['name']  ?>
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label>images</label>
                                        <input type="file" class="form-control" name="file" >
                                        <i style="color: red;">
                                            <?php if(isset( $errors['image_error'] )) echo  $errors['image_error']  ?>
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label>Nmber Model</label>
                                        <input type="tel" name="model" placeholder="Please Enter Nmber Model "
                                        value="<?php echo $number_model ?>" class="form-control" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['model'] )) echo  $errors['model']  ?>
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label>description</label>
                                        <textarea placeholder="Please Enter Description" name="description"
                                            class="form-control" cols="30" rows="3"><?php echo $Description?></textarea>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label>product Type</label>
                                        <select class="form-control" name="cat_id">
                                            <?php    
                                        $sql="select * from caregories " ;
                                        $stm = $con->prepare($sql);
                                        $stm->execute();
                                        foreach ($stm->fetchAll() as $row) {
                                            ?>
                                            <option value=<?php echo $row['id'] ?>><?php echo  $row['name'] ?></option>
                                            <?php
                                        } ?>
                                        </select>
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" name="submitProduct" class="btn btn-primary">
                                            edit Product</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>
                            <?php 
                            } 
                           } 
                          }
                            
                          ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr />


        
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
</div>

<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- MORRIS CHART SCRIPTS -->
<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/morris/morris.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>


</body>

</html>
<?php
}else {
            echo "<div claas='alert alert-danger text-center' > <a href='../login.php'>please login in </a>  </div>";
          }
          ?>