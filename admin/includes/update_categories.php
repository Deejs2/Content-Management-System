<?php
if (isset($_POST["update_submit"])) {
    $edit_cat_id = $_GET["edit"];
    $edit_cat_title = $_POST["cat_title"];
    $sql = "UPDATE categories SET cat_title='$edit_cat_title' WHERE cat_id='$edit_cat_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: categories.php");
    } else {
        die("QUERY FAILED : " . mysqli_error($conn));
    }
}


if (isset($_GET["edit"])) {
    $edit_cat_id = $_GET["edit"];

    $sql = "SELECT * FROM categories WHERE cat_id='$edit_cat_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Edit Category</label>
                <input type="text" class="form-control" value="<?php echo $row["cat_title"]; ?>" name="cat_title">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="update_submit" value="Update Category">
            </div>
        </form>
<?php
    }
}
?>