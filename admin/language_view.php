<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Languages</h1>
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
                            <th>Language Name</th>
                            <th>Language Code</th>
                            <th>Language Default</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $q = $pdo->prepare("SELECT * FROM language ORDER BY lang_id ASC");
                        $q->execute();
                        $res = $q->fetchAll();
                        foreach ($res as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td><?php echo $row['lang_name']; ?></td>
                                <td><?php echo $row['lang_code']; ?></td>
                                <td>
                                    <?php
                                    if ($row['lang_default'] == 'default') {
                                        echo $row['lang_default'];
                                    } else {
                                        echo '<a href="language_make_default.php?id=' . $row['lang_id'] . '" class="btn btn-primary btn-xs">Make Default</a>';
                                    }
                                    ?>

                                </td>
                                <td>
                                    <?php if ($i != 1): ?>
                                        <a href="language_edit.php?id=<?php echo $row['lang_id']; ?>" class="btn btn-xs btn-warning">Edit</a>
                                        <a href="language_delete.php?id=<?php echo $row['lang_id']; ?>" class="btn btn-xs btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
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