<?php include 'header.php';
      include 'blogHeader.php';
?>

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
                <ul>
            <?php
                $i=0;
                $cate=new Blog_info();
                $item=$cate->blog_recent_comment();
                foreach($item as $comet){
                    if($i<=2){ ?>
                            <li class="row mt-2 mb-2 mr-1">
                                <div>
                                <?php   
                                        $id=$comet[5];
                                        $itm=$cate->post_info($id);
                                        foreach($itm as $info){
                                ?>
                                <span><a href="http://localhost/lifekart/User/View/blog_details.php?postid=<?php echo $info[0];?>#comments"><?php echo $info[1];?></a></span><br>
                                <?php } ?>
                                <div class="mt-2 mb-2"><?php echo $cate->time_elapsed_string($comet[6]);?></div>
                                <div class="comment_thesis"><?php echo $comet[4];?></div>
                                <div class="mt-2 mb-2 comment_person_name"><i class="fas fa-user-circle"></i>&nbsp; <?php echo $comet[2];?></div>
                                        </div>
                                        </li>
                    <?php $i++; }else{ break ; } } ?>
            </ul>
            </div>
        </div>

        <div class="col-md-6">
            <?php 
                    $id=$_GET['postid'];
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
                                <div class="comment_title">COMMENTS</div>
                                <?php 
                                            $id=$_GET['postid'];
                                            $item = $cate->blog_comment($id);
                                            foreach($item as $coment){
                                                 ?>
                                    <div class="comment_display">
                                        <div class="comment_area">
                                            <div class="comment_person_name"><i class="fas fa-user-circle"></i>&nbsp;  <?php echo $coment[2] ?></div>
                                            <div class="comment_date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cate->time_elapsed_string($coment[6]); ?></div>
                                        </div>
                                        <div class="comment_thesis">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coment[4] ?></div>
                                        <div class="comment_reply">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="reply_btn" data-id="<?php echo $coment[0]?>" title="reply">Reply</span>
                                            <div id="display_reply_form" data-id="<?php echo $coment[0]?>">
                                                <div class='comment_details'>
                                                    <div class='comment_head m-3'>Leave your comment</div>
                                                    <div class='comment_info'>
                                                        <div class='customer row'>
                                                            <div class='col-md-6'>
                                                                <input type='text' name='name' placeholder='Your name' id='name_field_<?php echo $coment[0]?>' class='m-1' value=''>
                                                            </div>
                                                            <div class='col-md-6'><input type='text' name='email' id='email_field_<?php echo $coment[0]?>' placeholder='Your e-mail' class='m-1' value=''>
                                                        </div>
                                                    </div>
                                                    <input type='hidden' name='blog_id' id='blog_id_<?php echo $coment[0]?>' value='<?php echo $coment[0]?>'>
                                                    <textarea name='comment' class='mr-5 ml-1 mt-1' id='message_field_<?php echo $coment[0]?>' rows='3' placeholder='Text your comment...'>
                                                    </textarea>
                                                    <button class='btn btn-info submit_reply' id='submit_reply' data-id="<?php echo $coment[0]?>" title='Post comment'>Post comment</button>
                                                    <p id='success' class='error'></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $dis=$cate->getReply($coment[0]); 
                                            ?>
                                            <button class="comment_btn btn" id="comment_btn">comments (<?php echo count($dis);?>)</button>
                                            <div id="comment_reply_form">
                                            <?php 
                                             foreach($dis as $reply){
                                            $item = $cate->blog_reply($reply[0]);
                                            foreach($item as $coment){
                                                 ?>
                                    <div class="comment_replay">
                                        <div class="comment_area">
                                            <div class="comment_person_name"><i class="fas fa-user-circle"></i>&nbsp;  <?php echo $coment[1] ?></div>
                                            <div class="comment_date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cate->time_elapsed_string($coment[5]); ?></div>
                                        </div>
                                        <div class="comment_thesis">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coment[3] ?></div>
                                    </div>
                                        <?php } } ?> 
                                            </div>
                                        </div>
                                    </div>
                                        <?php } ?> 
  
                                    <div class="comment_details">                           
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
        </div>


        <div class="col-md-3">
        <div class="CATEGORIES p-3">
                <h6>CATEGORIES</h6>
                    <div>
                        <ul>
                        <?php
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