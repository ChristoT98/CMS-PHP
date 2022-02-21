<form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Edit Category</label>
                                
                                <?php
                                        //EDIT QUERY
                                        if(isset($_GET['edit'])) {
                                            $editing_cat_id = $_GET['edit'];

                                            $query = "SELECT * FROM categories WHERE cat_id = $editing_cat_id ";
                                            $get_editing_id = mysqli_query($connection, $query);

                                            while ($row = mysqli_fetch_assoc($get_editing_id)){
                                                $cat_id = $row['cat_id'];
                                                $cat_title = $row['cat_title'];
                                                }
                                    ?>
                                            <input value="<?php if(isset($cat_title)){ echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">
                                    <?php } ?>

                                    <?php
                                    //UPDATE QUERY
                                    if(isset($_POST['update_category'])) {
                                        $editing_cat_title = $_POST['cat_title'];

                                        $query = "UPDATE categories SET cat_title = '{$editing_cat_title}' WHERE cat_id = {$cat_id} ";
                                        $update_query = mysqli_query($connection, $query);
                                        header("Location: categories.php");
                                        if(!$update_query) {
                                            die("QUERY FAILED" . mysqli_error($connection));
                                        }
                                    }
                                    ?>

                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                            </div>
                        </form> <!-- Edit Category Form -->