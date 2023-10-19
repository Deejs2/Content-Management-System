<?php
if (isset($_POST["create_post"])) {
    $post_title = $_POST["title"];
    $post_category_id = $_POST["post_category"];
    $post_author = $_POST["author"];
    $post_status = $_POST["status"];

    $post_image = $_FILES["image"]["name"];
    $post_image_temp = $_FILES["image"]["tmp_name"];

    $post_tags = $_POST["tags"];
    $post_content = $_POST["content"];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $sql = "INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status)";
    $sql .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

    $result = mysqli_query($conn, $sql);
    if(confirmQuery($result)){
        echo "New Post Added Successfully!";
    }
}
?>

<form action="posts.php?source=add_post" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Post Title <sup style="color: red;">*</sup></label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Category Id</label><br>
        <select name="post_category" class="form-control">
            <?php 
                $sql="SELECT * FROM categories";
                $result=mysqli_query($conn,$sql);
                while ($row=mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Post Author <sup style="color: red;">*</sup></label>
        <input type="text" name="author" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Status</label>
        <input type="text" name="status" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Image <sup style="color: red;">*</sup></label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Tags <sup style="color: red;">*</sup></label>
        <input type="text" name="tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Content <sup style="color: red;">*</sup></label>
        <textarea name="content" id="" cols="20" rows="10" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="create_post" value="Publish Post" class="btn btn-primary">
    </div>
</form>