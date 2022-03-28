<?php

if (isset($_POST['create_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    // $user_image = $_FILES['user_image']['name'];
    // $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = $_POST['user_role'];
    
    //move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users(user_firstname, user_lastname, user_email, username, user_password, user_role) ";
    $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$username}', '{$user_password}', '{$user_role}')";
    $create_new_user = mysqli_query($connection, $query);

    confirmQuery($create_new_user);

    echo "User created successfully: " . " " . "<a href='users.php'>View Users</a>";
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">First Name </label>
        <input type="text" class="form-control" placeholder="Enter First Name" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name </label>
        <input type="text" class="form-control" placeholder="Enter Last Name" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="user_email">Email </label>
        <input type="email" class="form-control" placeholder="Enter Email" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="user_role" class="form-control">
            <option value="Subscriber" selected disabled>Select User Role</option>
            <option value="Admin">Admin</option>
            <option value="Subscriber">Subscriber</option>
        </select>
    </div>
    
    <!-- <div class="form-group">
        <label for="user_image">User Image </label>
        <input type="file" class="form-control" name="user_image">
    </div> -->
    <div class="form-group">
        <label for="username">Username </label>
        <input type="text" class="form-control" placeholder="Enter Username" name="username">
    </div>
    <div class="form-group">
        <label for="user_password">Password </label>
        <input type="text" class="form-control" placeholder="Enter Password" name="user_password">
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>
</form>