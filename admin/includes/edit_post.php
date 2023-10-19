<?php 
    if (isset($_GET["id"])) {
    $edit_post_id = $_GET["id"];
    } 


    if(isset($_POST["edit_post"])){
        $post_title = $_POST["title"];
        $post_category_id = $_POST["post_category"];
        $post_author = $_POST["author"];
        $post_status = $_POST["status"];

        $post_image = $_FILES["image"]["name"];
        $post_image_temp = $_FILES["image"]["tmp_name"];

        $post_tags = $_POST["tags"];
        $post_content = $_POST["content"];
        $post_date = date('d-m-y');
        $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){
            $sql = "SELECT * FROM posts WHERE post_id='{$edit_post_id}'";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $post_image = $row["post_image"];
            }
        }

        $sql="UPDATE posts SET 
        post_title='{$post_title}',
        post_category_id='{$post_category_id}',
        post_author='{$post_author}',
        post_status='{$post_status}',
        post_image='{$post_image}',
        post_date=now(),
        post_tags='{$post_tags}',
        post_content='{$post_content}'
        WHERE post_id='{$edit_post_id}'
        ";

        $result=mysqli_query($conn,$sql);
        confirmQuery($result);
    }

if (isset($_GET["id"])) {
        $sql = "SELECT * FROM posts WHERE post_id='{$edit_post_id}'";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $post_id = $row["post_id"];
            $post_author = $row["post_author"];
            $post_title = $row["post_title"];
            $post_category_id = $row["post_category_id"];
            $post_status = $row["post_status"];
            $post_image = $row["post_image"];
            $post_tags = $row["post_tags"];
            $post_content = $row["post_content"];

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Post Title <sup style="color: red;">*</sup></label>
        <input type="text" value="<?php echo $post_title; ?>" name="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Category</label><br>
        <select class='form-control' name='post_category'>
        <?php 
            $sql="SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);

            confirmQuery($result);
            while($row=mysqli_fetch_assoc($result)){
                echo "<option value='{$row["cat_id"]}'>{$row['cat_title']}</option>";
            }
        ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Post Author <sup style="color: red;">*</sup></label>
        <input type="text" value="<?php echo $post_author; ?>" name="author" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Status</label>
        <input type="text" value="<?php echo $post_status; ?>" name="status" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Image <sup style="color: red;">*</sup></label>
        <input type="file" name="image" class="form-control">
        <img src="../images/<?php echo $post_image; ?>" alt="images" width="100px">
    </div>
    <div class="form-group">
        <label for="">Post Tags <sup style="color: red;">*</sup></label>
        <input type="text" value="<?php echo $post_tags; ?>" name="tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Content <sup style="color: red;">*</sup></label>
        <textarea name="content" id="" cols="20" rows="10" class="form-control"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="edit_post" value="Update Post" class="btn btn-primary">
    </div>
</form>

<?php            
}
}
?>