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
                        <i class="fa fa-plus-circle"></i> Add New Porduct
                    </div>
                     <?php
                     $name=$model= $description="";
                     if (isset($_POST['submitProduct'])) {
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
                            $sql="INSERT INTO product( name,image, number_model,Description,cat_id) VALUES (?,?,?,?,?) " ;
                            $stm = $con->prepare($sql);
                            $stm->execute(array($name ,$image_name ,$model, $description ,$cat_id ));
                            if ($stm->rowCount()) {
                                echo "<div class='alert alert-success'>Row Inserted</div>" ;
                            } else {
                                echo "<div class='alert alert-danger'>Row Not Inserted</div>" ;
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
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Please Enter your Name " required
                                            class="form-control" value="<?php echo $name;?>" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['name'] )) echo  $errors['name']  ?>
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label>images</label>
                                        <input type="file" class="form-control" name="file"  >
                                        <i style="color: red;">
                                            <?php if(isset( $errors['image_error'] )) echo  $errors['image_error']  ?>
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label>Nmber Model</label>
                                        <input type="tel" name="model" placeholder="Please Enter Nmber Model "
                                            class="form-control" value="<?php echo $model;?>"  required/>
                                        <i style="color: red;">
                                            <?php if(isset( $errors['model'] )) echo  $errors['model']  ?>
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label>description</label>
                                        <textarea placeholder="Please Enter Description" name="description"  required
                                            class="form-control" cols="30" rows="3"><?php echo $description;?></textarea>
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
                                        <button type="submit" name="submitProduct" class="btn btn-primary">Add
                                            Product</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr />


        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-task">Products</i> 
                        <div class="fa fa-task " style="direction: rtl;"><a href="../indexu.php"  class=" nav-link   btn btn-success ">index</a></div>
                    </div>
                    <?php 
                             if (isset($_GET['action'],$_GET['id'])) {
                                   $id=$_GET['id'];                    
                                 switch ($_GET['action']) {
                                     case 'delete':
                                       
                                        $sql="delete from product where id=:perid ";
                                        $stm=$con->prepare($sql);
                                        $stm->execute(array("perid"=>$id) ); 
                                         // طريقة اخرى
                                        // $sql="delete from prssiming where id= ? ";
                                        // $stm=$con->prepare($sql);
                                        // $stm->execute(array($id)); 
                                        if ($stm->rowCount()==1) {
                                           echo "<div class='alert alert-success' > One Row Delete </div>";
                                        }      
                                         break;
                                     
                                     default:
                                     echo "<div class='alert alert-danger' > ERROR</div>";
                                         break;
                                 }   
                                          
                                        
                                                  
                                  }
                             ?>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>          
                                        <th>Name</th>          
                                        <th>Image</th>
                                        <th>NumberModel</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql="select * from product " ;
                                        $stm = $con->prepare($sql);
                                        $stm->execute();

                                        if($stm->rowCount())
                                        {
                                            foreach ($stm->fetchAll() as $row) {
                                                $id=$row['id'];
                                                $name=$row['name'];
                                                $image=$row['image'];
                                                $number_model=$row['number_model'];
                                                $Description=$row['Description'];
                                                ?>
                                    <tr class="odd gradeX" >
                                    <td><?php  echo $id ?></td>
                                        <td ><?php echo $name  ?></td>
                                        <td ><img src="upload/<?php echo $image ?>" width="60px"></td>
                                        <td ><?php echo   $number_model ?></td>
                                        <td><?php echo  $Description ?></td>
                                        <td><?php 
                                            $sql="select * from caregories where id=:cat_id" ;
                                            $stm = $con->prepare($sql);
                                            $stm->execute(array("cat_id"=>$row['cat_id']));
                                            foreach ($stm->fetchAll() as $catRow) {
                                               echo $catRow['name'];
                                            } 
                                            ?>
                                        </td>
                                        <td>
                                                <a href="editproducts.php?action=edit&id=<?php echo $id ?>"
                                                class='btn btn-success'>Edit</a>
                                            <a href="?action=delete&id=<?php echo $id ?>" class='btn btn-danger'
                                                id="delete">Delete</a>
                                                
                                                </td>
                                    </tr>
                                    <?php
                                                }
                                                                                        
                                                }
                                                ?>
                                </tbody>
        
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->

            </div>
            <!-- /. ROW  -->
        </div>
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

<script>
  $('#delete').click(function(){
    return confirm('ARE YOU SURE DELETION CLIECK OK');
});
   </script>
</body>

</html>
<?php
 }else {
            echo "<div claas='alert alert-danger text-center' > <a href='../login.php'>please login in </a>  </div>";
          }
          ?>