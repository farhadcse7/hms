<?php require_once('header.php'); ?>

<?php
if (!isset($_SESSION['customer'])) {
    header('location: login.php');
    exit;
}
?>

<!-- Parallax Effect -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#parallax-pagetitle').parallax("50%", -0.55);
    });
</script>

<section class="parallax-effect">
    <div id="parallax-pagetitle" style="background-image: url(images/parallax/parallax-01.jpg);">
        <div class="color-overlay">
            <!-- Page title -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Home</a></li>
                            <li class="active">Payment History</li>
                        </ol>
                        <h1>Payment History</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">

        <section class="contact-details">
            <div class="col-md-3">
                <h2 class="lined-heading  mt50"></h2>
                <!-- Panel -->
                <div class="panel panel-default text-center">
                    <div class="panel-body">
                        <?php require_once('c-sidebar.php'); ?>
                    </div>
                </div>
            </div>
        </section>


        <section id="contact-form" class="mt50">
            <div class="col-md-9">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Payment Date</th>
                            <th>Payment Method</th>
                            <th>Paid Amount</th>
                            <th>Payment Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $q = $pdo->prepare("SELECT * FROM payment WHERE cust_id=? ORDER BY p_id ASC");
                        $q->execute([$_SESSION['customer']['cust_id']]);
                        $res = $q->fetchAll();
                        foreach ($res as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['payment_date']; ?></td>
                                <td><?php echo $row['payment_method']; ?></td>
                                <td>$<?php echo $row['paid_amount']; ?></td>
                                <td><?php echo $row['payment_status']; ?></td>
                                <td>
                                    <a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">Details</a>
                                </td>
                                <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Detail Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <b>Payment Method:</b> <?php echo $row['payment_method']; ?> <br>
                                                <b>Total Paid:</b> $<?php echo $row['paid_amount']; ?> <br>

                                                <br><b>ROOM DETAILS: </b><br>
                                                <br>
                                                <?php
                                                $r = $pdo->prepare("SELECT * 
                                                        FROM payment_detail t1
                                                        JOIN room t2
                                                        ON t1.room_id = t2.room_id
                                                        WHERE t1.payment_id=?");
                                                $r->execute([$row['payment_id']]);
                                                $res1 = $r->fetchAll();
                                                foreach ($res1 as $row1) {
                                                ?>
                                                    <b>Room Name: </b> <?php echo $row1['room_name']; ?> <br>
                                                    <b>Checkin Date: </b> <?php echo $row1['checkin_date']; ?> <br>
                                                    <b>Checkout Date: </b> <?php echo $row1['checkout_date']; ?> <br>
                                                    <b>Room Price: </b> $<?php echo $row1['room_price']; ?> <br>
                                                    <b>Quantity: </b> <?php echo $row1['qty']; ?> <br><br>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<?php require_once('footer.php'); ?>