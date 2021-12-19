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
                        <i class="fa fa-plus-circle"></i> Add New User
                        
                    </div>
                    <div class="panel-body">
                        <div class="row">
                        <?php 
                         $name = $email = $password = $address =$date = "";
                        if (isset($_POST['add_user'])) {
                                   $name=trim($_POST['name']);
                                   $email=trim($_POST['email']);
                                   $password=trim($_POST['password']);
                                   $address=trim($_POST['address']);
                                   $date=trim($_POST['date']);
                                   $prid=trim($_POST['prid']);
                                   $errors=array();
                                   if (is_numeric($name)) {
                                      $errors['name']="NAME MAST BE STRING.";
                                   }else
                                   {
                                    if (empty($name)){
                                        $errors['name']="THIS FIELD IS REQUIRED.";
                                     }
                                   }
                                   if (empty($email)){
                                    $errors['email']="THIS FIELD IS REQUIRED.";
                                   }else
                                    {
                                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                            $errors['email'] = "Invalid email format";
                                    
                                     }
                                    }
                                    if (empty($date)){
                                        $errors['date']="THIS FIELD IS REQUIRED.";
                                     }
                                   if (empty($password)){
                                      $errors['password']="THIS FIELD IS REQUIRED.";
                                   }
                                   
                                   if (empty($errors)&& !empty($_POST['name']&& $_POST['email']&&$_POST['password'])) {
                                    $password=sha1($_POST['password']);
                                    $sql="INSERT INTO `users`( name,email, password,  address,date ,id_per) VALUES (?,?,?,?,?,?) ";
                                    $stm=$con->prepare($sql);
                                    $stm->execute(array($name,$email,$password,$address,$date,$prid));
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
                                <form role="form" method="post" >
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Please Enter your Name " 
                                        class="form-control" name="name" value="<?php echo $name;?>" />
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
                                        <input type="email" class="form-control" placeholder="PLease Enter Eamil" name="email" 
                                        
                                        value="<?php echo $email;?>"/>
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
                                        <input type="password" class="form-control" placeholder="Please Enter password"
                                        value="<?php echo $password;?>" name="password" >
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
                                        <input type="text" class="form-control" name="address"
                                        value="<?php echo $address;?>"  placeholder="Please Enter your address">
                                    </div>
                                    <div class="form-group">
                                        <label>Enter date</label>
                                        <input type="date" class="form-control" name="date"
                                        value="<?php echo $date;?>"  placeholder="Please Enter date">
                                    </div>
                                    <div class="form-group">
                                        <label>User Type</label>
                                        <select class="form-control" name="prid" >
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
                                        <button type="submit" class="btn btn-primary" name="add_user">Add User</button>
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
        <?php 
                             if (isset($_GET['action'],$_GET['id'])) {
                                   $id=$_GET['id'];                    
                                 switch ($_GET['action']) {
                                     case 'delete':
                                       
                                        $sql="delete from users where id=:usrid ";
                                        $stm=$con->prepare($sql);
                                        $stm->execute(array("usrid"=>$id) ); 
                                         // طريقة اخرى
                                        // $sql="delete from users where id= ? ";
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
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Users
                    </div>
                    
                
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>address</th>
                                        <th>date</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        $date=$row['date'];
                                    ?> 
                                    <tr class="odd gradeX">
                                        <td><?php  echo $id?></td>
                                        <td><?php  echo $name?></td>
                                        <td><?php  echo $email?></td>
                                        <td><?php  echo $password?></td>
                                        <td class="center"><?php  echo $address?></td>
                                        <td><?php  echo $date?></td>

                                        <td>
                                            <a href="editusers.php?action=edit&id=<?php echo $id ?>" class='btn btn-success'>Edit</a>
                                            <a href="?action=delete&id=<?php echo $id ?>" class='btn btn-danger' id="delete">Delete</a>
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

<?php include('footer.php');
}else {
    echo "<div claas='alert alert-danger text-center' > <a href='../login.php'>please login in </a>  </div>";
  }
?>
<script>
  $('#delete').click(function(){
    return confirm('ARE YOU SURE DELETION CLIECK OK');
});
   </script>