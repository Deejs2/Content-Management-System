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
                if (isset($_POST["submit"])) {
                    $search = $_POST["search"];

                    $sql = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("QUERY FAILED! " . mysqli_error_list($conn));
                    }

                    $count = mysqli_num_rows($result);
                    if ($count == 0) {
                        echo "No search found!";
                    } else {

                        while ($row = mysqli_fetch_assoc($result)) {
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
                                <a href="#"><?php echo $post_title; ?></a>
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
                }
                ?>




            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"; ?>