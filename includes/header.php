<?php
$message=null;
$message2=null;
include('includes/classes/init.php');

if($session->is_signed_in()!==true){
    redirect('register.php');
}

if(isset($session->user_id)){
    $results=$user->find_item_by_id($session->user_id);
    while($row=mysqli_fetch_assoc($results)){
        $user->first_name=$row['first_name'];
        $user->lastname=$row['last_name'];
        $user->username=$row['username'];
        $user->email=$row['email'];
        $user->signup_date=$row['signup_date'];
        $user->photo_filename=$row['photo_filename'];
        $user->num_posts=$row['num_posts'];
        $user->num_likes=$row['num_likes'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RNET</title>

    <link rel="icon" href="assets/images/logo/rnet-favi-icon.png">

    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/file_inputs.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/file_inputs.js"></script>
    <script src="assets/js/rnet.js"></script>
   

    
</head>

<body>




    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">RNET</a>

      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon">Menu</span>
      </button>


      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

        
         <li class="nav-item">
           
            <form action="" class="form-inline nav-link">
              <div class="input-group">
              <input type="text" class="form-control" placeholder="search">
              <button class="btn btn-outline-light"><i class="far fa-search"></i></button>
              </div>
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php?user=<?php echo $user->username; ?>"><?php echo $user->first_name; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="far fa-home fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="far fa-envelope fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="far fa-bell fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="far fa-users fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="far fa-cog fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="includes/handlers/logout.php"><i class="far fa-sign-out fa-lg"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation End -->




  

