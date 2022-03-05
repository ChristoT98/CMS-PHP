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
        <img width="100" src="../images/<?php echo $post_image; ?>">
        
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
        <input type="submit" class="btn btn-primary" name="create_post" value="Update Post">
    </div>
</form>