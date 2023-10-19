<?php
if (isset($_POST["create_user"])) {
    $user_firstname = $_POST["user_firstname"];
    $user_lastname = $_POST["user_lastname"];
    $user_role = $_POST["user_role"];
    $username = $_POST["username"];

    // $post_image = $_FILES["image"]["name"];
    // $post_image_temp = $_FILES["image"]["tmp_name"];
    //move_uploaded_file($post_image_temp, "../images/$post_image");

    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];
    //$user_date=date("y-m-d");

    

    if(empty($user_email) && empty($user_password) && empty($username)){
        echo "Please Fill Up The Required Field!";
    }else{
        $sql = "INSERT INTO users (user_firstname,user_lastname,user_role,username,user_email,user_password)";
        $sql .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}')";

        $result = mysqli_query($conn, $sql);
        confirmQuery($result);
    }
}
?>

<form action="users.php?source=add_user" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="">User Role</label><br>
        <select name="user_role" class="form-control">
        <option value="subscriber">Select Option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">UserName <sup style="color: red;">*</sup></label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Email <sup style="color: red;">*</sup></label>
        <input type="text" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Password <sup style="color: red;">*</sup></label>
        <input type="password" name="user_password" class="form-control">
    </div>
    
    <div class="form-group">
        <input type="submit" name="create_user" value="Add User" class="btn btn-primary">
    </div>
</form>