<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Roles</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">

                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $q = $pdo->prepare("SELECT * FROM role ORDER BY role_id ASC");
                        $q->execute();
                        $res = $q->fetchAll();
                        foreach ($res as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td><?php echo $row['role_name']; ?></td>
                                <td>
                                    <?php if ($row['role_id'] != 1 && $row['role_id'] != 2): ?>
                                        <a href="role_setup_access.php?id=<?php echo $row['role_id']; ?>" class="btn btn-xs btn-info">Setup Access</a>
                                        <a href="role_edit.php?id=<?php echo $row['role_id']; ?>" class="btn btn-xs btn-warning">Edit</a>
                                        <a href="role_delete.php?id=<?php echo $row['role_id']; ?>" class="btn btn-xs btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
                                    <?php endif; ?>
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