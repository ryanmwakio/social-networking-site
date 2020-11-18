<?php
require('includes/classes/init.php');
require('includes/form_handlers/register_handler.php');
require('includes/form_handlers/login_handler.php');

if($session->is_signed_in()){
    redirect("index.php");
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome to RNET</title>

    <link rel="icon" href="assets/images/logo/rnet-favi-icon.png">

    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">


    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/js/rnet.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

</head>



<body>
    <?php
    if(isset($_POST['register_button'])){
    echo
    "<script>
        $(function(){
            $('#first').hide();
            $('#second').show();
        });
    </script>";
    } 
    ?>

  <div class="wrapper">
    <div class="login_box">
        <div class="login_header">
       
            <div class="text-center">
            
            <h1>RNET</h1>
            Login or signup below
           </div>
        </div>
   
        <?php if(isset($message)){ ?>
                <div>
                <p class="alert alert-danger">
                <button class="close" type="button" data-dismiss="alert">
                        <span>&times;</span>
                </button>
                    <?php echo $message; ?>
                </p>
                </div>
                <?php } ?>


                <?php 

                if(isset($message2)){ ?>
                <div>
                <p class="alert alert-success alert-dismissable" id="signin">
                    <button class="close" type="button" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <?php echo $message2; ?>.&nbsp;Go ahead and&nbsp;<a href="#">Login</a>
                </p>
                </div>
                <?php } ?>

                
        <div id="first">
        <form action="register.php" method="POST">
        <input type="email" name="log_username" placeholder="Enter your email" value="<?php echo $log_email; ?>" required>


          <div class="form-group">
                <input type="password" id="password"  value="<?php echo $log_password; ?>" placeholder="Password" required name="log_password">
                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
            </div>


        
        
        <br>
        <input  type="submit" name="login_button" value="Login"><br>
        <a href="#" id="signup" class="signup">Need an account? Register here.</a>
        </form>
        </div>

        <div id="second">
        <form action="register.php" method="POST">
            <input type="text" name="reg_fname" placeholder="First Name" value="<?php echo $fname; ?>" required>
            <input  type="text" name="reg_lname" placeholder="Last Name" value="<?php echo $lname; ?>" required>
            <input  type="email" name="reg_email" placeholder="Email" value="<?php echo $email; ?>" required>
            <input  type="email" name="reg_email2" placeholder="Confirm Email" value="<?php echo $email2; ?>" required>


            
            <div class="form-group">
                <input type="password" id="password"  value="<?php echo $password; ?>" placeholder="Password" required name="reg_password">
                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
            </div>
         


            <div class="form-group">
                <input type="password" id="password"  value="<?php echo $password2; ?>" placeholder="Confirm Password" required name="reg_password2">
                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
            </div> <br>



            <input  type="submit" name="register_button" value="Register"><br>
            <a href="#" id="signin" class="signin">Already have an account? sign in here.</a>
        </form>
        </div>



                
        </div>

    </div>
    


    
 </div>

</body>

</html>