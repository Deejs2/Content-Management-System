<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>UserName</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Role</th>
            <th colspan="4" style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row["user_id"];
            $username = $row["username"];
            $user_firstname = $row["user_firstname"];
            $user_lastname = $row["user_lastname"];
            $user_email = $row["user_email"];
            $user_role = $row["user_role"];

            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";


            // $sql1="SELECT * FROM categories WHERE cat_id='{$comment_category_id}'";
            // $result1 = mysqli_query($conn, $sql1);
            // while ($row = mysqli_fetch_assoc($result1)) {
            //     $cat_title=$row["cat_title"];
            //     echo "<td>{$cat_title}</td>";
            // }



            // $sql1 = "SELECT * FROM posts WHERE post_id=$comment_post_id";
            // $result1 = mysqli_query($conn, $sql1);

            // while ($row = mysqli_fetch_assoc($result1)) {
            //     $post_title=$row['post_title'];
            //     $post_id=$row['post_id'];
            // echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
            // }

            
            echo "<td><a href='users.php?make_admin={$user_id}'>Make Admin</a></td>";
            echo "<td><a href='users.php?make_subscriber={$user_id}'>Make Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php

if (isset($_GET["make_admin"])) {
    $user_id = $_GET["make_admin"];
    $sql = "UPDATE users SET user_role='Admin' WHERE user_id='{$user_id}'";
    $result = mysqli_query($conn, $sql);
    confirmQuery($result);
    header("Location: users.php");
}

if (isset($_GET["make_subscriber"])) {
    $user_id = $_GET["make_subscriber"];
    $sql = "UPDATE users SET user_role='Subscriber' WHERE user_id='{$user_id}'";
    $result = mysqli_query($conn, $sql);
    confirmQuery($result);
    header("Location: users.php");
}

if (isset($_GET["delete"])) {
    $user_id = $_GET["delete"];
    $sql = "DELETE FROM users WHERE user_id='{$user_id}'";
    $result = mysqli_query($conn, $sql);
    confirmQuery($result);
    header("Location: users.php");
}


?>