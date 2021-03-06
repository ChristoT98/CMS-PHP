<table class="table table-striped table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In Response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Disapprove</th>
                <th>Modify</th>
            </tr>
        </thead>
        <tbody>

        <?php
            
            $query = "SELECT * FROM comments";
            $get_all_comments_query = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($get_all_comments_query)){
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";

                // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                // $get_post_comment_id = mysqli_query($connection, $query);

                // while ($row = mysqli_fetch_assoc($get_post_comment_id)){
                //     $post_id = $row['post_id'];
                //     $post_title = $row['post_title'];
                //     echo "<td>{$post_title}</td>";
                // }

                echo "<td>{$comment_email}</td>";
                echo "<td class='text-center'>{$comment_status}</td>";

                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $get_commented_post_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($get_commented_post_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
                }

                echo "<td>{$comment_date}</td>";
                echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                echo "<td><a href='comments.php?disapprove={$comment_id}'>Disapprove</a></td>";
                echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>

    </tbody>
</table>

<?php

if (isset($_GET['approve'])) {
    $comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $comment_id ";
    $approve_comment__query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_GET['disapprove'])) {
    $comment_id = $_GET['disapprove'];

    $query = "UPDATE comments SET comment_status = 'Disapproved' WHERE comment_id = $comment_id ";
    $disapprove_comment__query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

?>