<?php

 include "header.php"; 
 require('admin/dbconnect.php');
 ?>
  <br>
  <br>
  <br>
  <?php 

                         $name = $email = "";
                        if (isset($_POST['submit'])) {
                                   $name=trim($_POST['name']);
                                   $email=trim($_POST['email']);
                                   $password=trim($_POST['password']);
                                   $address=trim($_POST['address']);
                                   $date=trim($_POST['date']);
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
                                   if (empty($password)){
                                      $errors['password']="THIS FIELD IS REQUIRED.";
                                   }
                                   if (is_numeric($address)) {
                                    $errors['address']="NAME MAST BE STRING.";
                                 }else
                                 {
                                  if (empty($address)){
                                      $errors['address']="THIS FIELD IS REQUIRED.";
                                   }
                                 }
                                 
                                  if (empty($date)){
                                      $errors['date']="THIS FIELD IS REQUIRED.";
                                   }
                                 
                                   if (empty($errors)&& !empty($_POST['name']&& $_POST['email']&&$_POST['password'])) {
                                    $password=sha1($_POST['password']);
                                    $sql="INSERT INTO `users`( name,email, password,address,date ) VALUES (?,?,?,?,?) ";
                                    $stm=$con->prepare($sql);
                                    $stm->execute(array($name,$email,$password,$address,$date));
                                    if($stm->rowCount())
                                    {
                                       
                                       
                                        echo "<script>
                                                alert('تم التسجيل');
                                                window.open('indexu.php','_self' );
                                                </script>";
                                    
                                   }else{
                                    echo "<script>
                                    alert(' أنت مسجل من قبل يرجى تسجبل الدخول');
                                    window.open('login.php','_self' );
                                    </script>";         
                                       }
                                  }
                                 }
                                ?>
 <form method="post"
      style="  direction: ltr;"    class=" shadow m-4 p-4 mx-auto  col-md-6  ">
        <h4 class="text-center"> التسجيل بالموقع</h4>
        <div class="form-group">
            <label for="name">name:</label>
            <input type="text" class="form-control"  value="<?php echo $name;?>" placeholder="Enter name"
                   name="name" >
                   <i style="color:red">
                                                        <?php 
                                                        if (isset($errors['name']))
                                                        {
                                                            echo $errors['name'];
                                                        }
                                                    
                                                        ?>
                                                    </i>
            
            
        </div>
        <div class="form-group  ">
            <label for="emil">email: </label>
            <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
            <i style="color:red">
                                                        <?php 
                                                        if (isset($errors['email']))
                                                        {
                                                            echo $errors['email'];
                                                        }
                                                    
                                                        ?>
                                                    </i>
            
        </div>

        <div class="form-group  ">
            <label for="password"> password: </label>
            <input type="password" class="form-control "   name="password" >
            <i style="color:red">
                                                        <?php 
                                                        if (isset($errors['password']))
                                                        {
                                                            echo $errors['password'];
                                                        }
                                                    
                                                        ?>
                                                    </i>
          
        </div>
        <div class="form-group  ">
            <label for="address"> address: </label>
            <input type="address" class="form-control "   name="address" >
            <i style="color:red">
                                                        <?php 
                                                        if (isset($errors['address']))
                                                        {
                                                            echo $errors['address'];
                                                        }
                                                    
                                                        ?>
                                                    </i>
          
        </div>
        <div class="form-group  ">
            <label for="date"> date: </label>
            <input type="date" class="form-control "   name="date" >
            <i style="color:red">
                                                        <?php 
                                                        if (isset($errors['date']))
                                                        {
                                                            echo $errors['date'];
                                                        }
                                                    
                                                        ?>
                                                    </i>
          
        </div>


        <button type="submit" name="submit" class="btn btn-primary m-4"> دخول</button>
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php include "footer.php"; ?>