<?php 
session_start();
if (isset($_SESSION['user_info'])) {
include('header.php') ;
require('dbconnect.php');
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-tasks"></i> Categories</h2>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Edit Category
                               
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                <?php 
                                if (isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit' )
                                {
                                    $id=$_GET['id'];
                                $sql="select* from caregories where id=:catid";
                                    $stm=$con->prepare($sql);
                                    $stm->execute(array("catid"=>$id));
                                   if ($stm->rowCount())
                                   {
                                     foreach($stm->fetchall() as $row)
                                      {
                                          $id=$row['id'];
                                          $name=$row['name'];
                                          $Description=$row['Description'];


                                          if (isset($_POST['submit'])) {
                                              $id=$_POST['id'];
                                            $name=trim($_POST['name']);
                                            $Description=trim($_POST['Description']);
                                            $errors=array();
                                            if (is_numeric($name)) {
                                               $errors['name']="NAME MAST BE STRING.";
                                            }
                                            if (empty($errors)&& !empty($_POST['name'])) {
                                                $password=sha1($_POST['password']);
                                             $sql="update caregories set name=?, Description=? where id=? ";
                                             $stm=$con->prepare($sql);
                                             $stm->execute(array($name,$Description,$id));
                                             if($stm->rowCount())
                                             {
                                                 echo "<script>
                                                 alert('one row update');
                                                 window.open('categories.php','_self' );
                                                 </script>";
                                             }
                                             else
                                             {
                                             echo "<div class='alert alert-danger'> row no update </div>";
                                             }
                                             
                                            }
                                         }
 
                                          ?>
                                    <div class="col-md-12">
                                        <form role="form" method="post">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                            
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" placeholder="Please Enter your Name " name="name" required
                                                    class="form-control" value="<?php echo $name ?>" />
                                                    <i style="color:red">
                                                        <?php 
                                                        if (isset($errors['name'])) echo $errors['name'];
                                                    
                                                        ?>
                                                    </i>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>

                                                <textarea placeholder="Please Enter Description" name="Description"
                                                 class="form-control"
                                                    cols="30" rows="3"><?php echo $Description ?></textarea>
                                            </div>

                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary" name="submit">Edit Category</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>
                                <?php } } } ?>
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
   <?php include('footer.php'); ?> 
   <?php
   }else {
            echo "<div claas='alert alert-danger text-center' > <a href='../login.php'>please login in </a>  </div>";
          }
          ?>
  