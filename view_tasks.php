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
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid mt-4">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Task Management System</h5>

                            <a href="create_task.php" style="float: right;" class="btn btn-primary">Add a Task</a>
                            
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Priority</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $query = "SELECT * FROM `tasks`";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $row['title']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['description']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['priority']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['due_date']; ?>
                                                </td>

                                                <td class="text-center">

                                                    <a type="button" class="btn btn-primary"
                                                        href="view.php?id=<?= $row['id']; ?>">VIEW</a>
                                                    <a type="button" class="btn btn-warning"
                                                        href="update.php?id=<?= $row['id']; ?>">UPDATE</a>

                                                    <form action="process.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                        <button type="submit" class="btn btn-danger"
                                                            name=" ">DELETE</button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php
    if (isset($_SESSION['status']) && $_SESSION['status_code'] != '') {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
            });
        </script>
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
    }
    ?>

</body>

</html>