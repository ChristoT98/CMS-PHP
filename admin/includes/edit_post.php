<?php

if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts";
            $get_posts_by_id = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($get_posts_by_id)){
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_content = $row['post_content'];
                $post_date = $row['post_date'];
            }
            
            if (isset($_POST['update_post'])) {
                $post_title = $_POST['post_title'];
                $post_author = $_POST['post_author'];
                $post_category_id = $_POST['post_category'];
                $post_status = $_POST['post_status'];
                $post_image = $_FILES['post_image']['name'];
                $post_image_temp = $_FILES['post_image']['tmp_name'];
                $post_tags = $_POST['post_tags'];
                $post_content = $_POST['post_content'];

                move_uploaded_file($post_image_temp, "../images/$post_image");

                if(empty($post_image)) { 
                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $get_image = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($get_image)) { 
                        $post_image = $row['post_image'];
                    }
                }

                $query = "UPDATE posts SET post_category_id = '{$post_category_id}', post_title = '{$post_title}', post_author = '{$post_author}', post_date = now(), post_image = '{$post_image}', post_content = '{$post_content}', post_tags = '{$post_tags}', post_comment_count = '{$post_comment_count}', post_status = '{$post_status}' WHERE post_id = '{$post_id}' ";
                $update_post_query = mysqli_query($connection, $query);

                confirmQuery($update_post_query);
            }

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title </label>
        <input type="text" value="<?php if(isset($post_title)){ echo $post_title;} ?>" class="form-control" placeholder="Enter Post Title" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category Id </label>
        <select name="post_category" id="post_category" class="form-control">
            <?php
                $query = "SELECT * FROM categories";
                $get_all_categories = mysqli_query($connection, $query);

                confirmQuery($get_all_categories);

                while ($row = mysqli_fetch_assoc($get_all_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author </label>
        <input type="text" value="<?php if(isset($post_author)){ echo $post_author;} ?>" class="form-control" placeholder="Enter Post Author" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status </label>
        <input type="text" value="<?php if(isset($post_status)){ echo $post_status;} ?>" class="form-control" placeholder="Enter Post Status" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image </label>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <br><br>
        <input  type="file" name="post_image">
        
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags </label>
        <input type="text" value="<?php if(isset($post_tags)){ echo $post_tags;} ?>" class="form-control" placeholder="Enter Post Tags" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content </label>
        <textarea class="form-control" name="post_content" placeholder="Enter Post Content" name="post_content" id="" cols="30" rows="10"><?php if(isset($post_content)){ echo $post_content;} ?></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>