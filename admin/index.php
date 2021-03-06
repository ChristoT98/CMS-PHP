<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome <small>
                            <?php echo $_SESSION['firstname'] ?>
                        </small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php 
                                $query = "SELECT * FROM posts";
                                $get_all_posts = mysqli_query($connection, $query);
                                $post_count = mysqli_num_rows($get_all_posts);
                                ?>

                                    <div class='huge'>
                                        <?php if(isset($post_count)){ echo $post_count;} ?>
                                    </div>
                                    <div>All Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php 
                                $query = "SELECT * FROM comments";
                                $get_all_comments = mysqli_query($connection, $query);
                                $comment_count = mysqli_num_rows($get_all_comments);
                                ?>

                                    <div class='huge'>
                                        <?php if(isset($comment_count)){ echo $comment_count;} ?>
                                    </div>
                                    <div>All Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php 
                                $query = "SELECT * FROM users";
                                $get_all_users = mysqli_query($connection, $query);
                                $user_count = mysqli_num_rows($get_all_users);
                                ?>

                                    <div class='huge'>
                                        <?php if(isset($user_count)){ echo $user_count;} ?>
                                    </div>
                                    <div>All Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php 
                                $query = "SELECT * FROM categories";
                                $get_all_categories = mysqli_query($connection, $query);
                                $category_count = mysqli_num_rows($get_all_categories);
                                ?>

                                    <div class='huge'>
                                        <?php if(isset($category_count)){ echo $category_count;} ?>
                                    </div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php

            $query = "SELECT * FROM posts WHERE post_status = 'Published'";
            $get_all_published_posts = mysqli_query($connection, $query);
            $published_post_count = mysqli_num_rows($get_all_published_posts);
            
            $query = "SELECT * FROM posts WHERE post_status = 'Draft'";
            $get_all_draft_posts = mysqli_query($connection, $query);
            $draft_post_count = mysqli_num_rows($get_all_draft_posts);

            $query = "SELECT * FROM comments WHERE comment_status = 'Approved'";
            $get_all_approved_comments = mysqli_query($connection, $query);
            $approved_comment_count = mysqli_num_rows($get_all_approved_comments);

            $query = "SELECT * FROM comments WHERE comment_status = 'Disapproved'";
            $get_all_disapproved_comments = mysqli_query($connection, $query);
            $disapproved_comment_count = mysqli_num_rows($get_all_disapproved_comments);

            $query = "SELECT * FROM comments WHERE comment_status = '----'";
            $get_all_unapproved_comments = mysqli_query($connection, $query);
            $unapproved_comment_count = mysqli_num_rows($get_all_unapproved_comments);

            $query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
            $get_all_subscribers = mysqli_query($connection, $query);
            $subscriber_count = mysqli_num_rows($get_all_subscribers);


            ?>

            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', { 'packages': ['bar'] });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

          <?php
          
          $chart_text = ['Published Posts', 'Draft Posts' , 'Approved Comments', 'Disapproved Comments', 'Unapproved Comments', 'Subscribers'];
                        $chart_count = [$published_post_count, $draft_post_count, $approved_comment_count, $disapproved_comment_count, $unapproved_comment_count, $subscriber_count];

                        for ($i = 0; $i < 6; $i++) {
              echo "['{$chart_text[$i]}'". ",". "{$chart_count[$i]}],";
                        }
          
          ?>

        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>