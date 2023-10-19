<?php

function confirmQuery($result){
    global $conn;
    if(!$result){
        echo "QUERY FAILED : ".mysqli_connect_error($conn);
    }
}

function insert_categories()
{
    global $conn;

    if (isset($_POST["submit"])) {
        $cat_title = $_POST["cat_title"];

        if (empty($cat_title)) {
            echo "The field should not be empty!";
        } else {
            $sql = "INSERT INTO categories(cat_title)VALUES('$cat_title')";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("QUERY FAILED : " . mysqli_error($conn));
            }
        }
    }
}


function display_categories()
{
    global $conn;
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function delete_categories()
{
    global $conn;
    if (isset($_GET["delete"])) {
        $delete_cat_id = $_GET["delete"];

        $sql = "DELETE FROM categories WHERE cat_id='$delete_cat_id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: categories.php");
        } else {
            die("QUERY FAILED : " . mysqli_error($conn));
        }
    }
}


?>