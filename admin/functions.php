<?php

function confirmQuery($result) {
    global $connection;
    if(!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function insertNewCategory() {
    global $connection;
    if(isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
            $add_new_category = mysqli_query($connection, $query);

            if(!$add_new_category) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
        }
    }
}

function deleteCategory() {
    global $connection;
    if(isset($_GET['delete'])) {
        $deleting_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$deleting_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }

}

function findAllCategories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $get_all_categories_query = mysqli_query($connection, $query);
    
    while ($row = mysqli_fetch_assoc($get_all_categories_query)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
        }
}


?>