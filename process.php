<?php
session_start();
include("config.php");

// PROCESS START ------------------------
if (isset($_POST["insertTask"])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];

    if (empty($due_date)) {
        $_SESSION['status'] = "Date is blank!";
        $_SESSION['status_code'] = "error";
        header("Location: create_task.php");
        exit();
    } elseif (!strtotime($due_date)) {
        $_SESSION['status'] = "Invalid Date!";
        $_SESSION['status_code'] = "error";
        header("Location: create_task.php");
        exit();
    }

    $check_task_duplicate_query = "SELECT * FROM `tasks` WHERE `title` = '$title' AND `description` = '$description' AND `priority` = '$priority' AND `due_date` = '$due_date'";
    $task_duplicate_result = mysqli_query($con, $check_task_duplicate_query);
    $task_duplicate_count = mysqli_num_rows($task_duplicate_result);

    if ($task_duplicate_count > 0) {
        $_SESSION['status'] = "Task Already Exists! Please try again.";
        $_SESSION['status_code'] = "error";
        header("Location: create_task.php");
        exit();
    }

    $query = "INSERT INTO `tasks`(`title`, `description`, `priority`, `due_date`) VALUES ('$title','$description','$priority','$due_date')";
    $query_result = mysqli_query($con, $query);

    if ($query_result) {
        $_SESSION['status'] = "Task Added!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['status'] = "Something went wrong! Please try again.";
        $_SESSION['status_code'] = "error";
        header("Location: create_task.php");
        exit();
    }

}

if (isset($_POST["updateTask"])) {

    $id = $_POST['id'];

    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];

    $query = "UPDATE `tasks` SET `title`='$title',`description`='$description',`priority`='$priority',`due_date`='$due_date' WHERE id='$id'";
    $query_result = mysqli_query($con, $query);

    if ($query_result) {
        $_SESSION['status'] = "Task Updated!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['status'] = "Something went wrong! Please try again.";
        $_SESSION['status_code'] = "error";
        header("Location: edit_task.php");
        exit();
    }

}

?>