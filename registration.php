<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


 <?php 
 
 if(isset($_POST['submit'])) {
     $username = $_POST['username'];
     $firstname = $_POST['firstname'];
     $lastname = $_POST['lastname'];
     $email = $_POST['email'];
     $password = $_POST['password'];

    if(!empty($username) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {

     $username = mysqli_real_escape_string($connection, $username);
     $firstname = mysqli_real_escape_string($connection, $firstname);
     $lastname = mysqli_real_escape_string($connection, $lastname);
     $email = mysqli_real_escape_string($connection, $email);
     $password = mysqli_real_escape_string($connection, $password);

     $query = "SELECT randSalt FROM users";
     $get_randsalt = mysqli_query($connection, $query);

     if (!$get_randsalt) {
        die("QUERY FAILED" . mysqli_error($connection));
     }

    $row = mysqli_fetch_array($get_randsalt);
    $salt = $row['randSalt'];
    $password = crypt($password, $salt);
        


         $query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_password, user_role) VALUES('{$username}', '{$firstname}', '{$lastname}', '{$email}', '{$password}', 'Subscriber')";
         $register_new_user = mysqli_query($connection, $query);
         if(!$register_new_user) {
             die("Query Failed" . mysqli_error($connection) .  ' ' . mysqli_errorno($connection));
         }

         $message = "Your Registration has been submitted";

     } else {
        $message = "Fields Cannot be empty";
     }

     
 } else {
    // $message = "";
 }

 ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                    <h6 class="text-center";><?php ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">First Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Lastname">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
