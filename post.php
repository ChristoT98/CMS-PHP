<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>

    <!-- Navigation -->

    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php

            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
            }
            
            $query = "SELECT * FROM posts WHERE post_id = $post_id ";
            $get_all_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($get_all_posts)){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            
            <?php } ?>

            <!-- Blog Comments -->
            <?php

                if(isset($_POST['create_comment'])) {
                    $post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                

                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', '----', now())";
                $add_new_comment = mysqli_query($connection, $query);

                confirmQuery($add_new_comment);
            }

            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id ";
            $update_comment_count = mysqli_query($connection, $query);

            ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment_author">Name </label>
                            <input type="text" class="form-control" placeholder="Enter Name" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email </label>
                            <input type="email" class="form-control" placeholder="Enter Email" name="comment_email">
                        </div>
                        <div class="form-group">
                        <label for="comment_content">Your Comment </label>
                            <textarea class="form-control" rows="3" name="comment_content" placeholder="Enter  Your Comment"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                
                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                $query .= "AND comment_status = 'Approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $get_comments_for_specific_post = mysqli_query($connection, $query);

                confirmQuery($get_comments_for_specific_post);

                while ($row = mysqli_fetch_array($get_comments_for_specific_post)) {
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];

                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

                <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
                include "includes/sidebar.php";
            ?> 

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>        
