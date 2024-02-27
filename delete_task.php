<?php
session_start();
include("config.php");

if (isset($_GET['id'])) {
    
    $id = $_GET['id'];

    $delete_query = "DELETE FROM tasks WHERE id = '$id'";
    $delete_query_result = mysqli_query($con, $delete_query);

    if ($delete_query_result) {
        $_SESSION['status'] = "Task Deleted!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['status'] = "Something went wrong! Please try again.";
        $_SESSION['status_code'] = "error";
        header("Location: index.php");
        exit();
    }
}
?>