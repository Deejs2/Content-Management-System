<?php
include "includes/database.php";
include "includes/header.php"; ?>

<body>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                if(isset($_GET["p_id"])){
                    $p_id=$_GET["p_id"];
                    $sql = "SELECT * FROM posts WHERE post_id='{$p_id}'";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_image = $row["post_image"];
                        $post_content = $row["post_content"];
                ?>

                
                



                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>





                <?php
                    }
                }
                ?>

                <?php 
                    if(isset($_POST["create_comment"])){
                        $comment_post_id=$_GET["p_id"];
                        $comment_author=$_POST["comment_author"];
                        $comment_email=$_POST["comment_email"];
                        $comment_content=$_POST["comment_content"];
                        $comment_date=date('y-m-d');

                        $sql="INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES('{$comment_post_id}','{$comment_author}','{$comment_email}','{$comment_content}','UnApproved',now())";
                        $result=mysqli_query($conn,$sql);

                        confirmQuery($result);

                        $sql1="UPDATE posts SET post_comment_count=post_comment_count+1 WHERE post_id='{$comment_post_id}'";
                        $result1=mysqli_query($conn,$sql1);
                        confirmQuery($result1);
                    }
                ?>

<!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label>Author</label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="comment_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="5"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php  
                    $p_id=$_GET["p_id"];
                    $sql="SELECT * FROM comments WHERE comment_post_id='{$p_id}' AND comment_status='Approved' ORDER BY comment_id DESC";
                    $result=mysqli_query($conn,$sql);
                    confirmQuery($result);

                    while($row=mysqli_fetch_assoc($result)) {
                        $comment_author=$row["comment_author"];
                        $comment_content=$row["comment_content"];
                        $comment_date=$row["comment_date"];


                     ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                

                <?php
            
        }
    ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"; ?>