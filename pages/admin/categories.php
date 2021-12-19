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
                                <i class="fa fa-plus-circle"></i> Add New Category
                               
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                <?php
                                 $name = $Description  = "";
                                 if (isset($_POST['submit'])) {
                                   $name=trim($_POST['name']);
                                   $Description=trim($_POST['Description']);
                                   $errors=array();
                                   if (is_numeric($name)) {
                                      $errors['name']="NAME MAST BE STRING.";
                                   }
                                   if (empty($errors)&& !empty($_POST['name'])) {
                                    $sql="INSERT INTO `caregories`( name, Description)  VALUES (? , ?) ";
                                    $stm=$con->prepare($sql);
                                    $stm->execute(array($name,$Description));
                                    if($stm->rowCount() > 0)
                                    {
                                        echo "<div class='alert alert-success'> row inserted </div>";
                                    }
                                    else
                                    {
                                    echo "<div class='alert alert-danger'> row no inserted </div>";
                                    }
                                    
                                   }
                                }
                                ?>
                                    <div class="col-md-12">
                                        <form role="form" method="post">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" placeholder="Please Enter your Name " name="name" required
                                                value="<?php echo $name;?>"class="form-control" />
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
                                                    cols="30" rows="3"><?php echo $Description;?></textarea>
                                            </div>

                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary" name="submit">Add
                                                     Category</button>
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
                                <i class="fa fa-tasks"></i> Categories
                            </div>

                             <?php 
                             if (isset($_GET['action'],$_GET['id'])) {
                                   $id=$_GET['id'];                    
                                 switch ($_GET['action']) {
                                     case 'delete':
                                       
                                        $sql="delete from caregories where id=:perid ";
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
                                    <table class="table table-striped table-bordered table-hover "
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                    $sql="select* from caregories";
                                    $stm=$con->prepare($sql);
                                    $stm->execute();
                                   if ($stm->rowCount())
                                   {
                                     foreach($stm->fetchall() as $row)
                                      {
                                          $id=$row['id'];
                                          $name=$row['name'];
                                          $Description=$row['Description'];

                                    ?>   

                                            <tr class="odd gradeX">
                                                <td><?php  echo $id ?></td>
                                                <td><?php  echo $name?></td>
                                                <td><?php  echo $Description?></td>
                                                <td>
                                                <a href="editcategories.php?action=edit&id=<?php echo $id ?>"
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
   <?php include('footer.php'); ?>
   <?php
   }else {
            echo "<div claas='alert alert-danger text-center' > <a href='../login.php'>please login in </a>  </div>";
          }
          ?> 
   <script>
  $('#delete').click(function(){
    return confirm('ARE YOU SURE DELETION CLIECK OK');
});
   </script>