<?php include "includes/admin_header.php"; ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Your Admin
                            <small>AuthorName</small>
                        </h1>

                        <div class="col-xs-10">
                            <?php
                            if (isset($_GET["source"])) {
                                $source = $_GET["source"];
                            } else {
                                $source = '';
                            }
                            switch ($source) {
                                case 'add_post':
                                    include "includes/add_post.php";
                                    break;
                                case 'edit_post':
                                    include "includes/edit_post.php";
                                    break;
                                case '22':
                                    echo "Twenty Two";
                                    break;
                                case '100':
                                    echo "Hundred";
                                    break;

                                default:
                                    include "includes/view_all_comments.php";
                                    break;
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/admin_footer.php"; ?>