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
                <h2><i class="fa fa-users"></i> Users</h2>


            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> edit User
                        
                    </div>
                    <div class="panel-body">
                        <div class="row">

                                <?php
                                   if (isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit')
                                   {
                                    $id=$_GET['id'];
                                    $sql="select* from users where id=:usrid";
                                    $stm=$con->prepare($sql);
                                    $stm->execute(array("usrid"=>$id));
                                   if ($stm->rowCount())
                                   {
                                     foreach($stm->fetchall() as $row)
                                      {
                                        $id=$row['id'];
                                        $name=$row['name'];
                                        $email=$row['email'];
                                        $password=$row['password'];
                                        $address=$row['address'];
//-------------------------------
                                        if (isset($_POST['edit_user'])) {
                                            $id=$_POST['id'];
                                            $name=trim($_POST['name']);
                                            $email=trim($_POST['email']);
                                            $password=trim($_POST['password']);
                                            $address=trim($_POST['address']);
                                            $errors=array();
                                            if (is_numeric($name)) {
                                               $errors['name']="NAME MAST BE STRING.";
                                            }else
                                            {
                                             if (empty($name)){
                                                 $errors['name']="THIS FIELD IS REQUIRED.";
                                              }
                                            }
                                            if (is_numeric($email)) {
                                               $errors['email']="EMAIL MAST START BE STRING.";
                                            }else
                                            {
                                             if (empty($email)){
                                                 $errors['email']="THIS FIELD IS REQUIRED.";
                                              }
                                            }
                                            if (empty($password)){
                                               $errors['password']="THIS FIELD IS REQUIRED.";
                                            }
                                            if (empty($errors)&& !empty($_POST['name']&& $_POST['email']&&$_POST['password'])) {
                                                $password=sha1($_POST['password']);
                                             $sql=" UPDATE users SET name =?,email=?, password=?,address=? WHERE id=? ";
                                             $stm=$con->prepare($sql);
                                             $stm->execute(array($name,$email,$password,$address,$id));
                                             if($stm->rowCount() > 0)
                                             {
                                                echo "<script>
                                                alert('one row update');
                                                window.open('users.php','_self' );
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
                                <form role="form" method="post" >
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Please Enter your Name " 
                                        class="form-control" name="name" value="<?php echo $name ?>" />
                                        <i style="color:red">
                                                        <?php 
                                                        if (isset($errors['name']))
                                                        {
                                                            echo $errors['name'];
                                                        }
                                                    
                                                        ?>
                                                    </i>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="<?php echo $email ?>" 
                                        placeholder="PLease Enter Eamil" name="email"  />
                                        <i style="color:red">
                                                        <?php 
                                                        if (isset($errors['email']))
                                                        {
                                                            echo $errors['email'];
                                                        }
                                                        ?>
                                                    </i>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control"value="<?php echo $password ?>"
                                         placeholder="Please Enter password" name="password" >
                                        <i style="color:red">
                                                        <?php 
                                                        if (isset($errors['password']))
                                                        {
                                                            echo $errors['password'];
                                                        } 
                                                        
                                                        ?>
                                                    </i>
                                    </div>
                                    <div class="form-group">
                                        <label>Enter your address</label>
                                        <input type="text" class="form-control" name="address"value="<?php echo $address ?>"
                                            placeholder="Please Enter your address">
                                    </div>
                                    <div class="form-group">
                                        <label>User Type</label>
                                        <select class="form-control" name="pri"  >

                                        <?php 
                                        $sql="select* from privaliges";
                                        $stm=$con->prepare($sql);
                                        $stm->execute();
                                       if($stm->rowCount())
                                       {
                                        foreach($stm->fetchall() as $row)
                                         {?>
                                           <option value=<?php echo $row['id'] ?> ><?php echo $row['name'] ?></option>
                                           <?php
                                         }


                                       }
                                        ?>
                                        
                                        </select>
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" class="btn btn-primary" name="edit_user">Add User</button>
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

<?php include('footer.php');
}else {
    echo "<div claas='alert alert-danger text-center' > <a href='../login.php'>please login in </a>  </div>";
  }
?>
