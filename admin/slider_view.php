<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Sliders</h1>
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
                            <th>Subtitle</th>
                            <th>Button Text</th>
                            <th>Button URL</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q = $pdo->prepare("SELECT * FROM slider ORDER BY slider_id ASC");
                        $q->execute();
                        $res = $q->fetchAll();
                        foreach ($res as $row) 
                        {
                            ?>
                            <tr>
                                <td><?php echo $row['slider_id']; ?></td>
                                <td>
                                    <img src="../uploads/<?php echo $row['slider_photo']; ?>" style="width:200px;">
                                </td>
                                <td><?php echo $row['slider_title']; ?></td>
                                <td><?php echo $row['slider_subtitle']; ?></td>
                                <td><?php echo $row['slider_button_text']; ?></td>
                                <td><?php echo $row['slider_button_url']; ?></td>
                                <td>
                                    <a href="slider_edit.php?id=<?php echo $row['slider_id']; ?>" class="btn btn-xs btn-warning">Edit</a>
                                    <a href="slider_delete.php?id=<?php echo $row['slider_id']; ?>" class="btn btn-xs btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
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