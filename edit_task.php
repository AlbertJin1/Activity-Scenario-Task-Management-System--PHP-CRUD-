<?php session_start();
include("config.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <h1 class="text-center mt-4">Update Task Data</h1>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $task = "SELECT * FROM `tasks` WHERE `id` = '$id'";
                    $task_run = mysqli_query($con, $task);

                    if (mysqli_num_rows($task_run) > 0) {
                        foreach ($task_run as $task) {
                            ?>

                            <form action="process.php" method="POST">

                                <input type="hidden" name="id" value="<?= $task['id']; ?>">

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="<?= $task['title']; ?>">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="textarea" name="description" rows="5" cols="30"
                                            class="form-control"><?= $task['description']; ?></textarea>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="priority" class="form-label">Priority</label>
                                        <select id="priority" name="priority" class="form-control">
                                            <option value="" disabled>Select priority</option>
                                            <option value="Low" <?= ($task['priority'] == 'Low') ? 'selected' : ''; ?>>Low</option>
                                            <option value="Medium" <?= ($task['priority'] == 'Medium') ? 'selected' : ''; ?>>Medium
                                            </option>
                                            <option value="High" <?= ($task['priority'] == 'High') ? 'selected' : ''; ?>>High</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="dueDate" class="form-label">Due Date</label>
                                        <input type="date" class="form-control" id="dueDate" name="due_date"
                                            value="<?= $task['due_date']; ?>">
                                    </div>

                                    <div class="col-md-12 mb-3 text-center mt-4">
                                        <button type="button" value="Back" class="btn" onclick="history.back();" id="mgaButtons"
                                            style="float: left;">Go Back</button>
                                        <button type="submit" name="updateTask" class="btn" id="mgaButtons"
                                            style="float: right;">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                        }
                    } else {
                        ?>
                <h4>No Record Found!</h4>
                <?php
                    }
                }
                ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if (isset($_SESSION['status']) && $_SESSION['status_code'] != '') {
        ?>
        <script>
            Swal.fire({
                position: "center",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                title: "<?php echo $_SESSION['status']; ?>",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
    }
    ?>
</body>

</html>