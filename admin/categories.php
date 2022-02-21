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
                            Welcome Admin
                            <small>Author!</small>
                        </h1>
                        <div class="col-sm-6">
                            
                        <?php
                        //INSERT QUERY
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
                        ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form> <!-- Add Category Form -->

                        <?php 
                            if(isset($_GET['edit'])){
                                $cat_id = $_GET['edit'];
                                include "includes/update_categories.php";
                            }
                        ?>

                        </div> 

                        <div class="col-sm-6">
                            <table class="table table-striped table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th colspan="2" class="text-center">Modify</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <?php
                                        //FIND ALL CATEGORIES QUERY
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
                                        ?>

                                        <?php
                                        //DELETE QUERY
                                        if(isset($_GET['delete'])) {
                                            $deleting_cat_id = $_GET['delete'];

                                            $query = "DELETE FROM categories WHERE cat_id = {$deleting_cat_id} ";
                                            $delete_query = mysqli_query($connection, $query);
                                            header("Location: categories.php");
                                        }
                                        ?>

                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- Category Table -->

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>