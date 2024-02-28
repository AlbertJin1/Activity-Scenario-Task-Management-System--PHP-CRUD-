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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="container-fluid mt-4">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Task Management System</h5>

                            <a href="create_task.php" style="float: right;" class="btn task" id="mgaButtons">Add a
                                Task</a>

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

                                                <td class="text-center vstack gap-3 mx-auto">

                                                    <a type="button" class="btn btn-primary" id="customFont-Button"
                                                        href="view_tasks.php?id=<?= $row['id']; ?>">VIEW</a>
                                                    <a type="button" class="btn btn-warning" id="customFont-Button"
                                                        href="edit_task.php?id=<?= $row['id']; ?>">UPDATE</a>
                                                    <a type="button" class="btn btn-danger" id="customFont-Button"
                                                        href="delete_task.php?id=<?= $row['id']; ?>">DELETE</a>

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
                            <footer>
                                <p>Task Management System | Regualos & Sarmiento @ 2024</p>
                            </footer>
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