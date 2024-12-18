<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Comments</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">

                <?php
                if (isset($_SESSION['d_msg'])) {
                    echo '<div class="alert alert-success">' . $_SESSION['d_msg'] . '</div>';
                    unset($_SESSION['d_msg']);
                }
                ?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Comment</th>
                            <th>Person Name</th>
                            <th>Person Email</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $q = $pdo->prepare("SELECT * FROM comment ORDER BY comment_id ASC");
                        $q->execute();
                        $res = $q->fetchAll();
                        foreach ($res as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td><?php echo $row['person_comment']; ?></td>
                                <td><?php echo $row['person_name']; ?></td>
                                <td><?php echo $row['person_email']; ?></td>
                                <td>
                                    <?php echo $row['comment_status']; ?>
                                </td>
                                <td>
                                    <a href="comment_change_status.php?id=<?php echo $row['comment_id']; ?>" class="btn btn-primary btn-xs">Change</a>
                                </td>
                                <td>
                                    <a href="comment_delete.php?id=<?php echo $row['comment_id']; ?>" class="btn btn-xs btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once('footer.php'); ?>