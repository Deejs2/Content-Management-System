<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th colspan="3" style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM comments";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $comment_id = $row["comment_id"];
            $comment_post_id = $row["comment_post_id"];
            $comment_author = $row["comment_author"];
            $comment_content = $row["comment_content"];
            $comment_email = $row["comment_email"];
            $comment_status = $row["comment_status"];
            $comment_date = $row["comment_date"];

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";


            // $sql1="SELECT * FROM categories WHERE cat_id='{$comment_category_id}'";
            // $result1 = mysqli_query($conn, $sql1);
            // while ($row = mysqli_fetch_assoc($result1)) {
            //     $cat_title=$row["cat_title"];
            //     echo "<td>{$cat_title}</td>";
            // }

            echo "<td>{$comment_status}</td>";

            $sql1 = "SELECT * FROM posts WHERE post_id=$comment_post_id";
            $result1 = mysqli_query($conn, $sql1);

            while ($row = mysqli_fetch_assoc($result1)) {
                $post_title=$row['post_title'];
                $post_id=$row['post_id'];
            echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
            }

            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approved={$comment_id}'>Aproved</a></td>";
            echo "<td><a href='comments.php?unapproved={$comment_id}'>UnAproved</a></td>";
            echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php

if (isset($_GET["approved"])) {
    $comment_id = $_GET["approved"];
    $sql = "UPDATE comments SET comment_status='Approved' WHERE comment_id='{$comment_id}'";
    $result = mysqli_query($conn, $sql);
    confirmQuery($result);
    header("Location: comments.php");
}

if (isset($_GET["unapproved"])) {
    $comment_id = $_GET["unapproved"];
    $sql = "UPDATE comments SET comment_status='UnApproved' WHERE comment_id='{$comment_id}'";
    $result = mysqli_query($conn, $sql);
    confirmQuery($result);
    header("Location: comments.php");
}

if (isset($_GET["delete"])) {
    $comment_id = $_GET["delete"];
    $sql = "DELETE FROM comments WHERE comment_id='{$comment_id}'";
    $result = mysqli_query($conn, $sql);
    confirmQuery($result);
    header("Location: comments.php");
}


?>