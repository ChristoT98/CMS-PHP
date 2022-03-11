<table class="table table-striped table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>User Image</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <!-- <th>Date</th> -->
                <th>Change Role</th>
                <th colspan="2" class="text-center">Modify</th>
            </tr>
        </thead>
        <tbody>

        <?php
            
            $query = "SELECT * FROM users";
            $get_all_users_query = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($get_all_users_query)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_image = $row['user_image'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];
                //$user_created_date = $row['user_created_date'];

                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td><img width='64' src='../images/{$user_image}' alt='user image'/></td>";
                echo "<td>{$user_firstname}</td>";

                // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                // $get_post_comment_id = mysqli_query($connection, $query);

                // while ($row = mysqli_fetch_assoc($get_post_comment_id)){
                //     $post_id = $row['post_id'];
                //     $post_title = $row['post_title'];
                //     echo "<td>{$post_title}</td>";
                // }

                echo "<td>{$user_lastname}</td>";
                echo "<td>{$user_email}</td>";

                // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                // $get_commented_post_query = mysqli_query($connection, $query);
                // while ($row = mysqli_fetch_assoc($get_commented_post_query)){
                //     $post_id = $row['post_id'];
                //     $post_title = $row['post_title'];
                //     echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
                // }

                echo "<td>{$user_role}</td>";
                // echo "<td>{$user_created_date}</td>";
                if($user_role == 'Admin'){
                    echo "<td><a href='users.php?change_to_subscriber={$user_id}'>To Subscriber</a></td>";
                }else {
                    echo "<td><a href='users.php?change_to_admin={$user_id}'>To Admin</a></td>";
                }
                echo "<td><a href='users.php?edit={$user_id}'>Edit</a></td>";
                echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>

    </tbody>
</table>

<?php

if (isset($_GET['change_to_admin'])) {
    $user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $user_id ";
    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if (isset($_GET['change_to_subscriber'])) {
    $user_id = $_GET['change_to_subscriber'];

    $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $user_id ";
    $change_to_subscriber_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = {$user_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

?>