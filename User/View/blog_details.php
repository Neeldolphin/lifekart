<?php include 'header.php';?>

<nav class="navbar navbar-expand-lg bg-light navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class=" navbar-collapse" id="navbarNav">
  <a class="navbar-brand" href="http://localhost/lifekart/User/View/index.php"><img src="../images/logo1.png" class="logo" alt="logo"/></a>
  <?php
  if(!isset($_SESSION['username'])){
    ?>
      <ul class="nav navbar-nav ml-auto">
      <li class="nav-item account">
      <a class="nav-link" href="http://localhost/lifekart/User/View/login.php">Login</a>
      </li>
      <li class="nav-item account">
      <a class="nav-link" href="http://localhost/lifekart/User/View/signUp.php">Sign Up</a>
      </li>
          </ul>
   <?php }else
          {?> 
<ul class="nav navbar-nav ml-auto">
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i width="100" height="100" class="rounded-circle fas fa-user"></i> 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="http://localhost/lifekart/User/View/dashbord.php">Dashbord</a>
        <a class="dropdown-item" href="http://localhost/lifekart/User/View/blog.php">Blog</a>
          <a class="dropdown-item" href="http://localhost/lifekart/User/View/profile.php">Profile</a>
          <a class="dropdown-item" href="http://localhost/lifekart/User/View/logout.php">Logout</a>
        </div>
      </li>   
    </ul>
    <a  class="nav-link" href="view_cart.php?id=<?php echo $_SESSION['id']?>" >Cart <?php if(isset($_SESSION['cart'])){ echo count($_SESSION['cart']);} ?><i class="fas fa-shopping-cart"></i></a>
    </ul>
<?php } ?>
  </div>  
</nav>

<div class="container">
<div class="row blogtitle">
<?php
        $id=$_GET['postid'];
        $cate=new Blog_info();
        $rows=$cate->post_info($id);
        foreach($rows as $res){
           ?>
            <h2><?php echo $res[1];?></h2> 
           <?php } ?>
</div>
<div class="row">
        <div class="col-md-3">
            <div class="writer_info">
                <div class="">
                            <?php $id=$res[5]; 
                            $result=$cate->writer_info($id); ?>
                    <img class="writerimg" src="http://localhost/lifekart/User/images/<?php echo $result[0][1];?>">
                    <h5 class="mt-2 mb-2"><?php echo $result[0][2];?></h5>
                    <p class="m-3"><?php echo $result[0][3];?></p>
                    <div class="row social_links ml-4 mb-2">
                        <div class="col-md-3">
                        <a href="<?php echo $result[0][4];?>"><i class="fab fa-twitter-square"></i></a>
                        </div>
                        <div class="col-md-3">
                        <a href="<?php echo $result[0][5];?>"><i class="fab fa-facebook"></i></i></a>
                        </div>
                        <div class="col-md-3">
                        <a href="<?php echo $result[0][6];?>"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="RECENT_COMMENTS p-3">
                <h6>RECENT COMMENTS</h6>
            </div>
        </div>

        <div class="col-md-6">
            <?php 
                    $id=$_GET['postid'];
                    $cate=new Blog_info();
                    $rows=$cate->post_info($id);
                            foreach($rows as $res){
                                ?>                                
                        <div class="Blog_Posts">
                            <div>
                                <div>
                                     <img class="blogpostimg" src="http://localhost/lifekart/User/images/<?php echo $res[2];?>">
                                </div>
                                <div class="p-4">
                                <?php
                                $id=$res[4];
                                $rows=$cate->posts_tags($id);
                                 foreach($rows as $tag){
                                        ?>
                                  <a class="btn btn_tag" href="http://localhost/lifekart/User/View/blogTag.php?blogTagId=<?php echo $tag['id'];?>"><?php echo $tag['tags']; ?></a>
                                    <?php } ?>
                                </div>
                                <div class="ml-4 mr-4">
                                    
                                    <div class="mt-3 mb-3 blog_description">
                                            <?php echo $res[3];?>
                                    </div>
                                    <?php echo $cate->time_elapsed_string($res[7]);?>
                                        <div class="row mt-4">
                                            <div class="col-md-3">
                                            <?php 
                                                $value=$res[6];
                                                $rows=$cate->Posted_in($value);
                                                foreach($rows as $category){
                                                ?>
                                            <h6>Posted in : <a href="http://localhost/lifekart/User/View/blogCategory.php?blogCategoryId=<?php echo $category[0];?>"><?php echo $category[2];?></a></h6>
                                                <?php }?>
                                            </div>
                                            <div class="col-md-3">
                                                <?php 
                                                     $value=$res[5];
                                                     $rows=$cate->Posted_By($value);
                                                     foreach($rows as $category){
                                                ?>
                                            <h6><i class="fas fa-user-alt"></i>  By : <a href="http://localhost/lifekart/User/View/blogWriter.php?blogAuthorId=<?php echo $category[0];?>"><?php echo $category[2];?></a></a></h6>
                                            <?php }?>
                                            </div>
                                            <div class="col-md-3">
                                            <h6><a href="http://localhost/lifekart/User/View/blog_details.php?postid=<?php echo $res[0];?>#comments"><i class="fas fa-comments"></i>  comment</a></h6>     
                                            </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                            <?php } ?>

                            <div class="comments mt-5 p-3" id="comments">
                                <div class="comment_head m-3">Leave your comment</div>
                                <div class="comment_info">
                                    <div class="customer row">
                                            <div class="col-md-6">
                                                <input type="text" name="name" placeholder="Your name" id="name_field" class="m-1" value="">
                                            </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="email" id="email_field" placeholder="Your e-mail" class="m-1" value="">
                                                </div>
                                            </div>
                                            <?php $user_id = $_SESSION['id'];
                                                  $blog_id = $_GET['postid'] ?>
                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
                                            <input type="hidden" name="blog_id" id="blog_id" value="<?php echo $blog_id ;?>">
                                    <textarea name="comment" class="mr-5 ml-1 mt-1" id="message_field" rows="3" placeholder="Text your comment..."></textarea>
                                    <button class="btn btn-info" id="submit_comment" title="Post comment">Post comment</button>
                                    <p id="success" class="error"></p>
                                                     </div>
                    </div>
        </div>

        <div class="col-md-3">
        <div class="CATEGORIES p-3">
                <h6>CATEGORIES</h6>
                    <div>
                        <ul>
                        <?php
                            $cate=new Blog_info();
                            $rows=$cate->blog_category();
                            foreach($rows as $category){
                                ?>
                            <li><a href="http://localhost/lifekart/User/View/blogCategory.php?blogCategoryId=<?php echo $category[0];?>"><?php echo $category[2];?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
            </div>
            <div class="SEARCH_THE_BLOG p-3">
                <h6>SEARCH THE BLOG</h6>
                    <div class="mt-4 mb-2 ">
                    <input type="text" placeholder="Find some..." class="searchblog" id="search-blog" name="search-blog" value="" maxlength="50">
                    </div>
                    <button class="btn btn-primary" title="Search" id="blogsearchbtn" type="submit">Search</button>
            </div>
            <div class="TAGS p-3">
                <h6>TAGS</h6>
                    <div>
                        <ul>
                        <?php
                            $cate=new Blog_info();
                            $rows=$cate->blog_tags();
                            foreach($rows as $tag){
                                ?>
                            <li><a href="http://localhost/lifekart/User/View/blogTag.php?blogTagId=<?php echo $tag[0];?>"><?php echo $tag[1];?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
            </div>
            <div class="RECENT_POSTS p-3">
                <h6>RECENT POSTS</h6>
                <div>
                <?php
                            $i=0;
                            $rows=$cate->blog_post();
                            foreach($rows as $res){
                                if ($i<=2) {
                                ?>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-3">
                                     <img class="recentpostimg" src="http://localhost/lifekart/User/images/<?php echo $res[2];?>">
                                </div>
                                <div class="col-md-9">
                                <span><a href="http://localhost/lifekart/User/View/blog_details.php?postid=<?php echo $res[0];?>"><?php echo $res[1];?></a></span><br>
                                <?php echo $cate->time_elapsed_string($res[7]);?>
                                </div>
                                
                            </div>
                            <?php  $i++; }else{ break; } } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'blogfooter.php' ?>