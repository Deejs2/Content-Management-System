<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM posts";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $post_id = $row["post_id"];
            $post_author = $row["post_author"];
            $post_title = $row["post_title"];
            $post_category_id = $row["post_category_id"];
            $post_status = $row["post_status"];
            $post_image = $row["post_image"];
            $post_tags = $row["post_tags"];
            $post_comment_count = $row["post_comment_count"];
            $post_date = $row["post_date"];

            echo "<tr>";
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";


            $sql1="SELECT * FROM categories WHERE cat_id='{$post_category_id}'";
            $result1 = mysqli_query($conn, $sql1);
            while ($row = mysqli_fetch_assoc($result1)) {
                $cat_title=$row["cat_title"];
                echo "<td>{$cat_title}</td>";
            }

            echo "<td>{$post_status}</td>";
            echo "<td><img src='../images/{$post_image}' width=100px></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "<td><a href='posts.php?source=edit_post&id={$post_id}'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
if (isset($_GET["delete"])) {
    $post_id = $_GET["delete"];
    $sql = "DELETE FROM posts WHERE post_id='{$post_id}'";
    $result = mysqli_query($conn, $sql);
    confirmQuery($result);
    header("Location: posts.php");
}
?>