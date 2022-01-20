<?php include 'header.php';
 include 'blogHeader.php';
 ?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
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
            <div class="RECENT_POSTS p-3">
                <h6>RECENT POSTS</h6>
                <div>
                <?php
                            $i=0;
                            $rows=$cate->blog_post();
                            foreach($rows as $res){
                                if ($i<=2) {
                                ?>
                            <div class="row mt-2 mb-2">
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

        <div class="col-md-6">
            <?php             
            $id =$_GET['blogAuthorId'];
            $valu=new Blog_info();
            $item=$valu->writer_info($id);
            foreach($item as $author){
             ?>
            <div class="mt-4 mb-4"> 
            <span><h2>Articles by <?php echo $author[2]; ?></h2></span>
            <span><?php echo $author[3] ; ?></span>
            </div>
            <?php 
                             }   
                            $rows=$cate->Writer_Blog_info($id);
                            foreach($rows as $res){
                                ?>
                        <div class="Blog_Posts mt-0">
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
                                <div class="p-3">
                                    <h4><a href="http://localhost/lifekart/User/View/blog_details.php?postid=<?php echo $res[0];?>"><?php echo $res[1];?></a></h4>
                                    <div class="mt-3 mb-3">
                                            <?php echo $res[8];?>
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
                                            <h6><i class="fas fa-user-alt"></i>  By : <a href="http://localhost/lifekart/User/View/blogWriter.php?blogAuthorId=<?php echo $category[0];?>"><?php echo $category[2];?></a></h6>
                                            <?php }?>
                                            </div>
                                            <div class="col-md-3">
                                            <h6><a href="http://localhost/lifekart/User/View/blog_details.php?postid=<?php echo $res[0];?>#comments"><i class="fas fa-comments"></i>  comment</a></h6>   
                                            </div>
                                            <div class="col-md-3">
                                            <h6><a href="http://localhost/lifekart/User/View/blog_details.php?postid=<?php echo $res[0];?>">READ MORE <i class="fas fa-arrow-right"></i></a></h6> 
                                            </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                            <?php }?>
        </div>

        <div class="col-md-3">
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
        </div>
    </div>
</div>
<?php include 'blogfooter.php' ?>