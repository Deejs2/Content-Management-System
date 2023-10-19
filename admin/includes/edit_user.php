<?php
if (isset($_GET["u_id"])) {
    $user_id=$_GET["u_id"];
}
    if(isset($_POST["update_user"])){
        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_role = $_POST["user_role"];
        $username = $_POST["username"];
        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];
    
        $sql="UPDATE users SET 
        user_firstname='{$user_firstname}',
        user_lastname='{$user_lastname}',
        user_role='{$user_role}',
        username='{$username}',
        user_email='{$user_email}',
        user_password='{$user_password}'
        WHERE user_id = '{$user_id}'
        ";
        
        $result = mysqli_query($conn, $sql);
        confirmQuery($result);
    }

if (isset($_GET["u_id"])) {
    $user_id=$_GET["u_id"];

    $sql = "SELECT * FROM users WHERE user_id='{$user_id}'";

    $result = mysqli_query($conn, $sql);
    confirmQuery($result);
    while ($row=mysqli_fetch_assoc($result)) {
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_role = $row["user_role"];
        $username = $row["username"];
        $user_email = $row["user_email"];
        $user_password = $row["user_password"];
    
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" value="<?php echo $user_firstname; ?>" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" value="<?php echo $user_lastname; ?>" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="">User Role</label><br>
        <select name="user_role" class="form-control">
            <option><?php echo $user_role; ?></option>
            <?php 
                if ($user_role=='Admin') {
                    echo "<option value='Subscriber'>Subscriber</option>";
                } else {
                    echo "<option value='Admin'>Admin</option>";
                }
                
            ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="">UserName <sup style="color: red;">*</sup></label>
        <input type="text" value="<?php echo $username; ?>" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Email <sup style="color: red;">*</sup></label>
        <input type="text" value="<?php echo $user_email; ?>" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Password <sup style="color: red;">*</sup></label>
        <input type="text" value="<?php echo $user_password; ?>" name="user_password" class="form-control">
    </div>
    
    <div class="form-group">
        <input type="submit" name="update_user" value="Update User" class="btn btn-primary">
    </div>
</form>

<?php 
    }
}
?>