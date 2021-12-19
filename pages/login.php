<?php 
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>PHP</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>

<body>

<?php

require('admin/dbconnect.php');

   if (isset($_POST['login'])) {
     $user_name=$_POST['username'];
     $password=$_POST['password'];
     $errors=array();
     if (empty($user_name) |is_numeric($user_name)) {
      $errors['username']="THIS FIELD IS REQUIRED OR most BE STRING.";
      
     }
     
   if (empty($password)  ){
    $errors['password']="THIS FIELD IS REQUIRED.";
    }else {
      $password=sha1($_POST['password']);
      $sql="SELECT* FROM users WHERE email=:email AND  password=:password ";
      $stm=$con->prepare($sql);
      $stm->execute(array("email"=> $user_name,"password"=> $password));
      if($stm->rowCount()==1){
      $_SESSION['user_info']=$stm->fetch();
     if( $_SESSION['user_info']['id_per']==1)
        {
            echo $_SESSION['user_info']['name'];
         header("location:admin/index.php");
        }else 
        {
            header("location:indexu.php");
        }
      }else {
        echo "<script>alert('email or password is wrong.');</script>";
       
      }
    }
     
   }


?>
 
    <div id="fullscreen_bg" class="fullscreen_bg">
		<form class="form-signin" method="post" style="margin: inherit;margin-top: 80px;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="panel panel-default">
							<div class="panel panel-primary">

								<h3 class="text-center">Log In</h3>

								<div class="panel-body">

									<div class="form-group">
										<div class="input-group">
                                        <span class="input-group-addon"><span	class="glyphicon glyphicon-user"></span>
											</span>
											<input type="text" class="form-control" name="username"
												placeholder="email" id="username" />
                        <i style="color: red;">
                           <?php if(isset( $errors['username'] )) echo  $errors['username'];  ?>
                        </i>
										</div>
									</div>

									
                                    <div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span
													class="glyphicon glyphicon-lock"></span></span>
                                                    <input class="form-control " type="password" id="password"
                                                     name="password" placeholder="password" >
                                            <i style="color: red;">
                                                <?php if(isset( $errors['password'] )) echo  $errors['password']  ?>
                                            </i>
										</div>
									</div>

									<input class="btn btn-lg btn-primary btn-block" type="submit" value='login'
										name='login'>
								</div>
							</div>
						</div>
					</div>
				</div>
		</form>
        <footer class='text-center'>
			<h4>CopyRight &copy; <?php  echo date('Y');  ?></h4>
		</footer>

		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
</body>

</html>