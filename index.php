<?php
    
    require('includes/header.php');

   //creating a post
   if(isset($_POST['post'])){

   

        $post->set_file($_FILES['file']);
        $post->photo_filename;

    if(isset($post->photo_filename)){

        if(empty($_POST['post_text']) || !isset($_POST['post_text'])&&empty($post->errors)){
            $message2=$user->first_name.' make sure you\'ve written the post before you click the button';
        }elseif(!empty($_POST['post_text']) || isset($_POST['post_text'])){
          
            $post->body=$_POST['post_text'];
            $post->added_by=$user->username;
            $post->user_to='none';
            $post->date_added=mktime();
            $post->user_closed='no';
            $post->deleted='no';
            $post->likes=0;

            

            if($post->save()){
              $message="The new post was created successfully";
              $post->body=null;
              $post->photo_filename=null;
            }else{
              $message2=join("<br>",$post->errors);
            }
          }
      
   }else{

      if(empty($_POST['post_text']) || !isset($_POST['post_text'])&&empty($post->errors)){
            $message2=$user->first_name.' make sure you\'ve written the post before you click the button';
        }elseif(!empty($_POST['post_text']) || isset($_POST['post_text'])){
          
      $post->body=$_POST['post_text'];
      $post->added_by=$user->username;
      $post->user_to='none';
      $post->date_added=mktime();
      $post->user_closed='no';
      $post->deleted='no';
      $post->likes=0;
      $post->photo_filename='none';
      $post->submit_post();
      $message="The new post was created successfully";

      $post->body=null;
      $_POST['post_text']=null;
   }
  
    }
  }
  

?>

<div class="header-carousel mb-2">
   <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/images/backgrounds/header_1.jpg" class="d-block w-100" alt="...">

        <div class="carousel-caption d-none d-md-block">
          <p>CONNECT</p>
        </div>

      </div>
      <div class="carousel-item">
        <img src="assets/images/backgrounds/header_2.jpg" class="d-block w-100" alt="...">

        <div class="carousel-caption d-none d-md-block">
          <p>NETWORK</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/images/backgrounds/header_3.jpg" class="d-block w-100" alt="...">

        <div class="carousel-caption d-none d-md-block">
          <p>INTERACT</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/images/backgrounds/header_4.jpg" class="d-block w-100" alt="...">

        <div class="carousel-caption d-none d-md-block">
          <p>LEARN</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/images/backgrounds/header_5.jpg" class="d-block w-100" alt="...">

        <div class="carousel-caption d-none d-md-block">
          <p>EXPLORE</p>
        </div>
     </div>

     



      </div>
       </div>
   </div>

</div>

   

<main class="container p-3">





     <!-- Messages -->
     <p class="text-success messages mb-3">
            <?php echo $message; ?>
    </p>
 
    <p class="text-danger messages mb-3">
            <?php echo $message2; ?>
    </p>
    <!-- Messages End -->
  <div class="wrapper row">




    <div class="user_details col-xs-12 col-md-5 col-lg-4  mb-2">
    
      <div class="column">
        <div class="row">
                <div class="col-6 text-center">
                <a href="profile.php?user=<?php echo $user->username; ?>"><img src="<?php echo $user->photo_filename; ?>" alt="RNET profile"></a>
                </div>
                <div class="col-6 pt-4">
                  <a href="profile.php?user=<?php echo $user->username; ?>">Name: <?php echo $user->first_name." ".$user->last_name; ?></a><br>
                  <p>Username: @<?php echo $user->username; ?></p><br>
                  <p>Posts: <?php echo $user->num_posts; ?></p><br>
                  <p>Likes: <?php echo $user->num_likes; ?></p><br>
                </div>
        </div>
      </div>






   <div class="left-column">

      <div class="column mt-3 who-to-follow">
        <h5>who to follow?</h5>
        <hr>


            <div class="row">
                  <div class="col-4 who-to-follow-img">
                      <img src="assets/images/profile_pics/reece_kenney_122c9660b9d1eedcaf99c04ab974cab44n.jpeg" alt="">
                  </div>
                    <div class="col-4 ml-5">
                        <p>Ryan Mwakio</p><br>
                          <a href="#" class="btn btn-primary">follow</a>
                    </div>
              </div>
              <hr>


              <div class="row">
                    <div class="col-4 who-to-follow-img">
                        <img src="assets/images/profile_pics/captain_america42ec2eed5d26bc70eacc842160a47a71n.jpeg" alt="">
                    </div>
                      <div class="col-4 ml-5">
                          <p>Ryan Mwakio</p><br>
                            <a href="#" class="btn btn-primary">follow</a>
                      </div>
                </div>
                <hr>

                <div class="row">
                      <div class="col-4 who-to-follow-img">
                          <img src="assets/images/profile_pics/bart_simpson37e241c20f54539e5304221e3cdb301an.jpeg" alt="">
                      </div>
                        <div class="col-4 ml-5">
                            <p>Ryan Mwakio</p><br>
                              <a href="#" class="btn btn-primary">follow</a>
                        </div>
                  </div>
                  <hr>


      </div>


      <div class="trending-topics column mt-3">
        
            <h5>Trending topics</h5>
            <hr>


            <div class="row">
              <div class="col-5 text-right">
                <p class="far fa-bullhorn"></p>
              </div>
              <div class="col-5">
                <p>Technology</p>
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-5 text-right">
                <p class="far fa-bullhorn"></p>
              </div>
              <div class="col-5">
                <p>Medicine</p>
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-5 text-right">
                <p class="far fa-bullhorn"></p>
              </div>
              <div class="col-5">
                <p>Football</p>
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-5 text-right">
                <p class="far fa-bullhorn"></p>
              </div>
              <div class="col-5">
                <p>Covid 2019</p>
              </div>
            </div>
            <hr>
      
  </div>



       <div class="developer-details column mt-3">
        
            <h5>Developer Details</h5>
            <hr>
          <div class="container row">
            <div class="col-2">
            <a href="mailto:ryanmwakio@yahoo.com"><i class="fas fa-envelope"></i></a>
           </div>

           <div class="col-2">
            <a href="https://twitter.com/ryanmwakio" target="_blank"><i class="fab fa-twitter"></i></a>
           </div>

           <div class="col-2">
            <a href="https://github.com/ryanmwakio" target="_blank"><i class="fab fa-github"></i></a>
           </div>

           <div class="col-2">
            <a href="https://www.instagram.com/ryanmwakio/" target="_blank"><i class="fab fa-instagram"></i></a>
          </div>

         

         </div>
            <hr>
      
      </div>


      <div class="column mt-3">
        <hr>
        <div class="text-center">
          &copy;
          <script>
            var now=new Date();
            document.write(now.getFullYear());
          </script>
          Ryan Mwakio (RNET)
          </div>
        <hr>
      </div>





  </div>
 </div>










    <!--The right column on the index page-->
   <div class="col-xs-12 col-md-6 col-lg-7 ml-md-3">

    <div class="column">
     
        <form action="index.php" method="POST" enctype="multipart/form-data">
         <div class="form-group">
          <textarea class="form-control" name="post_text" id="post_text" placeholder="Got something to say..."></textarea>
         </div>


          <!--input for post images will go in here-->
            <div class="container1"> 
            <label for="file-input" class="bg-primary">Select your files<i class="far fa-upload m-1"></i></label>
            <input id="file-input" type="file" name="file" class="bg-primary"/>
            </div>
          <!--input for post images will end in here-->

          <input type="submit" value="Post" name="post" id="post_button" class="btn btn-primary">
        </form>


        <hr>

      

        <div class="bg-light mt-3 p-3">
        <p>
        This is a simple web app developed by Ryan Mwakio to create your own network of connections. You run your own content and interact freely with your data and privacy not shared or run by huge corporation. The app is focused on you as the user with changes made depending on the user demands. Thank you and continue using RNET.
        </p>
        </div>

      </div><!--closes the white column-->

      <div class="mt-3 column">


      <!--first post-->
        <div class="post">

          <div class="post-profile-icon m-3">
              <img src="assets/images/profile_pics/bart_simpson37e241c20f54539e5304221e3cdb301an.jpeg" alt="">
              <p>Posted by <a href="profile.php?user=<?php echo $post->added_by; ?>">Ryan Mwakio</a></p>
          </div>

          <img src="assets/images/posts/xps-Gi3iUJ1FwxI-unsplash.jpg" alt="post image"><br>
          <span class="mt-1 ml-2">2hrs ago</span><br>
          <p class="mt-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque harum soluta praesentium hic necessitatibus vero dignissimos, numquam labore nulla modi quod laboriosam nam eligendi? Maiores quisquam doloribus quidem cumque sed.</p>

          <div class="post-react-dash mt-2 mb-2">
            <div class="container">
              <ul class="list-unstyled list-inline">
                <li class="list-inline-item"><i class="far fa-heart active" title="like"></i></li>
                <li class="list-inline-item" title="unlike"><i class="far fa-thumbs-down"></i></li>
                <li class="list-inline-item"><i class="far fa-retweet active" title="repost"></i></li>
                <li class="list-inline-item"><i class="far fa-comment" title="comment"></i></li>
              </ul>
            </div>
          </div>
        </div>
        <hr>



        <!--second post-->
        <div class="post mt-2">

        <div class="post-profile-icon m-3">
              <img src="assets/images/profile_pics/captain_america42ec2eed5d26bc70eacc842160a47a71n.jpeg" alt="">
              <p>Posted by Ryan Mwakio</p>
          </div>

          <img src="assets/images/posts/lukenn-sabellano-cTht9kbFV0o-unsplash.jpg" alt="post image">
          <br>
          <span class="mt-1 ml-2">2hrs ago</span><br>
          <p class="mt-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque harum soluta praesentium hic necessitatibus vero dignissimos, numquam labore nulla modi quod laboriosam nam eligendi? Maiores quisquam doloribus quidem cumque sed.</p>

          <div class="post-react-dash mt-2 mb-2">
            <div class="container">
              <ul class="list-unstyled list-inline">
                <li class="list-inline-item"><i class="far fa-heart active"></i></li>
                <li class="list-inline-item"><i class="far fa-thumbs-down"></i></li>
                <li class="list-inline-item"><i class="far fa-retweet"></i></li>
                <li class="list-inline-item"><i class="far fa-comment"></i></li>
              </ul>
            </div>
          </div>
        </div>
        <hr>




        <!--third post-->
        <div class="post mt-2">
        <div class="post-profile-icon m-3">
              <img src="assets/images/profile_pics/goofy_mouse9ddceb032f4c9ad008be1aa646a18e94n.jpeg" alt="">
              <p>Posted by Ryan Mwakio</p>
          </div>
        <br>
          <span class="mt-1 ml-2">3hrs ago</span><br>
          <p class="mt-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque harum soluta praesentium hic necessitatibus vero dignissimos, numquam labore nulla modi quod laboriosam nam eligendi? Maiores quisquam doloribus quidem cumque sed.</p>

          <div class="post-react-dash mt-2 mb-2">
            <div class="container">
              <ul class="list-unstyled list-inline">
                <li class="list-inline-item"><i class="far fa-heart active"></i></li>
                <li class="list-inline-item"><i class="far fa-thumbs-down"></i></li>
                <li class="list-inline-item"><i class="far fa-retweet"></i></li>
                <li class="list-inline-item"><i class="far fa-comment"></i></li>
              </ul>
            </div>
          </div>
        </div>
        <hr>



        <!--fourth post-->
        <div class="post mt-2">

        <div class="post-profile-icon m-3">
              <img src="assets/images/profile_pics/homer_simpson96b166fee6674f498f207fdf9b7089c0n.jpeg" alt="">
              <p>Posted by Ryan Mwakio</p>
          </div>

          <img src="assets/images/posts/molly-mears-AX-7NFFrOZo-unsplash.jpg" alt="post image">
          <br>
          <span class="mt-1 ml-2">4hrs ago</span><br>
          <p class="mt-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque harum soluta praesentium hic necessitatibus vero dignissimos, numquam labore nulla modi quod laboriosam nam eligendi? Maiores quisquam doloribus quidem cumque sed.</p>

          <div class="post-react-dash mt-2 mb-2">
            <div class="container">
              <ul class="list-unstyled list-inline">
                <li class="list-inline-item"><i class="far fa-heart active"></i></li>
                <li class="list-inline-item"><i class="far fa-thumbs-down"></i></li>
                <li class="list-inline-item"><i class="far fa-retweet active"></i></li>
                <li class="list-inline-item"><i class="far fa-comment"></i></li>
              </ul>
            </div>
          </div>
        </div>
        <hr>

        <!--fifth post-->
            <!-- <div class="post mt-2">
             <div class="post-profile-icon m-3">
                  <img src="assets/images/profile_pics/bart_simpson37e241c20f54539e5304221e3cdb301an.jpeg" alt="">
                  <p>Posted by Ryan Mwakio</p>
              </div>
              <img src="assets/images/posts/brdnk-vision-RB-mwU3gjsk-unsplash.jpg" alt="post image">
              <br>
              <span class="mt-1 ml-2">4hrs ago</span><br>
              <p class="mt-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque harum soluta praesentium hic necessitatibus vero dignissimos, numquam labore nulla modi quod laboriosam nam eligendi? Maiores quisquam doloribus quidem cumque sed.</p>

              <div class="post-react-dash mt-2 mb-2">
                <div class="container">
                  <ul class="list-unstyled list-inline">
                    <li class="list-inline-item"><i class="far fa-heart active"></i></li>
                    <li class="list-inline-item"><i class="far fa-thumbs-down"></i></li>
                    <li class="list-inline-item"><i class="far fa-retweet"></i></li>
                    <li class="list-inline-item"><i class="far fa-comment"></i></li>
                  </ul>
                </div>
               </div>
               </div>
                 <hr>
               </div> -->

        <?php
        //reading the posts
            $post->limit=1000;
            $results=$post->read();
        while($row=mysqli_fetch_assoc($results)){
            $id=$row['id'];
            $body=$row['body'];
            $added_by=$row['added_by'];
            $user_to=$row['user_to'];
            $date_added=$row['date_added'];
            $user_closed=$row['user_closed'];
            $deleted=$row['deleted'];
            $likes=$row['likes'];

        //check if the user who posted have their accounts closed
              if($user->isClosed($added_by)){
                continue;
              }

              $user->where='username';
              $user->variable=$added_by;
              $user->limit=10;
              $results=$user->read_where();
              
              while($row=mysqli_fetch_assoc($results)){

                $row['username'];
                $row['photo_filename'];
                $row['first_name'];
                $row['last_name'];
              }
        }
        ?>



     </div>
  </div>
</main>
</body>
</html>