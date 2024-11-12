<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Subscribers</h1>
        <a href="subscriber_pending_delete.php" style="margin-bottom:10px;" class="btn btn-danger btn-sm">Delete Pending Subscribers</a>
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
                            <th>Subscriber Name</th>
                            <th>Subscriber Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $q = $pdo->prepare("SELECT * FROM subscriber WHERE s_active=? ORDER BY s_id ASC");
                        $q->execute([1]);
                        $res = $q->fetchAll();
                        foreach ($res as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td><?php echo $row['s_name']; ?></td>
                                <td><?php echo $row['s_email']; ?></td>
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