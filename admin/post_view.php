<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Posts</h1>
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
                            <th>Title</th>
                            <th>Post By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //for user data collect
                        $i = 0;
                        $q = $pdo->prepare("SELECT * 
                                            FROM post t1
                                            JOIN user t2
                                            ON t1.user_id = t2.user_id
                                            ORDER BY t1.post_id ASC");
                        $q->execute();
                        $res = $q->fetchAll();
                        foreach ($res as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <img src="../uploads/<?php echo $row['post_photo']; ?>" style="width:200px;">
                                </td>
                                <td><?php echo $row['post_title']; ?></td>
                                <td><?php echo $row['user_full_name']; ?></td>
                                <td>
                                    <a href="" class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">View Details</a>
                                    <a href="post_edit.php?id=<?php echo $row['post_id']; ?>" class="btn btn-xs btn-warning">Edit</a>
                                    <a href="post_delete.php?id=<?php echo $row['post_id']; ?>" class="btn btn-xs btn-danger" onClick="return confirm('Are you sure?');">Delete</a>

                                    <!-- modal body  -->
                                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Detailed Information</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <b>Title:</b><br> <?php echo $row['post_title']; ?><br><br>
                                                    <b>Short Description:</b> <br><?php echo $row['post_short_description']; ?><br>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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