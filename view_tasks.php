<div class="container-fluid mt-4">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Task Management System</h5>

                        <a href="create_task.php" style="float: right;" class="btn task" id="mgaButtons">Add a Task</a>

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
                                                    href="index.php?id=<?= $row['id']; ?>">VIEW</a>
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