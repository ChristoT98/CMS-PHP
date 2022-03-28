<?php include "includes/admin_header.php"; ?>

<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}'";

    $get_user_for_profile = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($get_user_for_profile)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_image = $row['user_image'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }
}

?>


<?php

    if (isset($_POST['update_profile'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        // $user_image = $_FILES['user_image']['name'];
        // $user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_role = $_POST['user_role'];

        //move_uploaded_file($user_image_temp, "../images/$user_image");

        // if(empty($user_image)) { 
        //     $query = "SELECT * FROM users WHERE user_id = $user_id";
        //     $get_image = mysqli_query($connection, $query);

        //     while($row = mysqli_fetch_array($get_image)) { 
        //         $user_image = $row['user_image'];
        //     }
        // }

        $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', username = '{$username}', user_password = '{$user_password}', user_role = '{$user_role}' WHERE username = '{$username}' ";
        $update_user_query = mysqli_query($connection, $query);

        confirmQuery($update_user_query);
    }

?>

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
                        <small>Christo!</small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_firstname">First Name</label>
                            <input type="text" value="<?php if(isset($user_firstname)){ echo $user_firstname;} ?>"
                                class="form-control" placeholder="Enter First Name" name="user_firstname">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname">Last Name </label>
                            <input type="text" value="<?php if(isset($user_lastname)){ echo $user_lastname;} ?>"
                                class="form-control" placeholder="Enter Last Name" name="user_lastname">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email </label>
                            <input type="text" value="<?php if(isset($user_email)){ echo $user_email;} ?>"
                                class="form-control" placeholder="Enter Email" name="user_email">
                        </div>
                        <div class="form-group">
                            <label for="user_role">User Role</label>
                            <select name="user_role" id="user_role" class="form-control">
                                <option value="<?php echo $user_role; ?>">
                                    <?php echo $user_role; ?>
                                </option>
                                <?php
                if($user_role == 'Admin') {
                    echo "<option value='Subscriber'>Subscriber</option>";
                } else {
                    echo "<option value='Admin'>Admin</option>";
                }
            ?>
                            </select>
                        </div>
                        <!-- <div class="form-group">
        <label for="user_image">User Image </label>
        <img width="64" src="../images/<?php /*echo $user_image;*/ ?>" alt="">
        <br><br>
        <input  type="file" name="user_image">
        
    </div> -->
                        <div class="form-group">
                            <label for="username">Username </label>
                            <input type="text" value="<?php if(isset($username)){ echo $username;} ?>"
                                class="form-control" placeholder="Enter Username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password </label>
                            <input type="password" value="<?php if(isset($user_password)){ echo $user_password;} ?>"
                                class="form-control" name="user_password" placeholder="Enter New Password"
                                name="user_password">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>