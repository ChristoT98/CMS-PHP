<?php

if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    //$post_comment_count = 4;
    
    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
    $create_new_post = mysqli_query($connection, $query);

    confirmQuery($create_new_post);

    $last_post_id = mysqli_insert_id($connection);

    echo "<h3 class='bg-success'>New Post Created. <a href='../post.php?p_id={$last_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></h3>";
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title </label>
        <input type="text" class="form-control" placeholder="Enter Post Title" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
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
        <input type="text" class="form-control" placeholder="Enter Post Author" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status </label>
        <select name="post_status" id="" class="form-control">
            <option value="Draft">Select Options</option>
            <option value="Draft">Draft</option>
            <option value="Published">Publish</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image </label>
        <input type="file" class="form-control" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags </label>
        <input type="text" class="form-control" placeholder="Enter Post Tags" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content </label>
        <textarea class="form-control" name="post_content" placeholder="Enter Post Content" id="editor" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>