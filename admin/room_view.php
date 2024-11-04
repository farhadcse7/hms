<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Rooms</h1>
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
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Manage Photos</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $q = $pdo->prepare("SELECT * 
                                            FROM room t1
                                            JOIN room_type t2
                                            ON t1.room_type_id = t2.room_type_id
                                            ORDER BY t1.room_id ASC");
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
                                    <img src="../uploads/<?php echo $row['room_featured_photo']; ?>" style="width:200px;">
                                </td>
                                <td><?php echo $row['room_name']; ?></td>
                                <td><?php echo $row['room_type_name']; ?></td>
                                <td>$<?php echo $row['room_price']; ?></td>
                                <td>
                                    <a href="room_photo.php?id=<?php echo $row['room_id']; ?>" class="btn btn-primary btn-xs">Manage Photos</a>
                                </td>
                                <td>
                                    <a href="" class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">View Details</a>
                                    <a href="room_edit.php?id=<?php echo $row['room_id']; ?>" class="btn btn-xs btn-warning">Edit</a>
                                    <a href="room_delete.php?id=<?php echo $row['room_id']; ?>" class="btn btn-xs btn-danger" onClick="return confirm('Are you sure?');">Delete</a>


                                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Detailed Information</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <b>Name:</b><br> <?php echo $row['room_name']; ?><br><br>
                                                    <b>Description:</b> <br><?php echo $row['room_description']; ?><br>

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