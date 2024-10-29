<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Photos</h1>
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
                            <th>Photo</th>
                            <th>Photo Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $q = $pdo->prepare("SELECT * 
                                            FROM photo t1
                                            JOIN photo_category t2
                                            ON t1.photo_category_id=t2.photo_category_id
                                            ORDER BY t1.photo_id ASC");
                        $q->execute();
                        $res = $q->fetchAll();
                        foreach ($res as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <img src="../uploads/<?php echo $row['photo_name']; ?>" style="width:200px;">
                                </td>
                                <td><?php echo $row['photo_category_name']; ?></td>
                                <td>
                                    <a href="photo_edit.php?id=<?php echo $row['photo_id']; ?>" class="btn btn-xs btn-warning">Edit</a>
                                    <a href="photo_delete.php?id=<?php echo $row['photo_id']; ?>" class="btn btn-xs btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
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