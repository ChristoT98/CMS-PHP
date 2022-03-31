<?php

if (isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $checkBoxValue) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'Published': 
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
                $update_to_published_status = mysqli_query($connection, $query);

                confirmQuery($update_to_published_status);
                break;

            case 'Draft': 
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
                $update_to_draft_status = mysqli_query($connection, $query);

                confirmQuery($update_to_draft_status);
                break;

            case 'Deleted': 
                $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
                $update_to_delete_status = mysqli_query($connection, $query);

                confirmQuery($update_to_delete_status);
                break;

        }

    }
}

?>

<form action="" method="POST">
<table class="table table-striped table-bordered table-hover table-responsive">

<div id="bulkOptionContainer" class="col-sm-4" style="padding: 0px; margin-bottom: 10px;">
    <select name="bulk_options" id="" class="form-control">
        <option value="">Select Option</option>
        <option value="Published">Publish</option>
        <option value="Draft">Draft</option>
        <option value="Deleted">Delete</option>
    </select>
</div>

<div class="col-sm-4" style="margin-bottom: 10px;">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
</div>

        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllCheckBoxes"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th colspan="2" class="text-center">Modify</th>
            </tr>
        </thead>
        <tbody>

        <?php
            
            $query = "SELECT * FROM posts";
            $get_all_posts_query = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($get_all_posts_query)){
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];

                echo "<tr>";

                ?>

                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

                <?php
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
                $get_selected_category_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($get_selected_category_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<td>{$cat_title}</td>";
                }

                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/{$post_image}' alt='image'/></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>

    </tbody>
</table>
</form>

<?php

if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}

?>