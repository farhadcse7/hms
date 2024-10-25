<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Features</h1>
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
                            <th>Title</th>
                            <th>Text</th>
                            <th style="width:100px;">Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $q = $pdo->prepare("SELECT * FROM feature ORDER BY feature_id ASC");
                        $q->execute();
                        $res = $q->fetchAll();
                        foreach ($res as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td><?php echo $row['feature_title']; ?></td>
                                <td><?php echo $row['feature_text']; ?></td>
                                <td><?php echo $row['feature_icon']; ?></td>
                                <td>
                                    <a href="feature_edit.php?id=<?php echo $row['feature_id']; ?>" class="btn btn-xs btn-warning">Edit</a>
                                    <a href="feature_delete.php?id=<?php echo $row['feature_id']; ?>" class="btn btn-xs btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
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