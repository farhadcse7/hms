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
              <th>Room Name</th>
              <th>Checkin Date</th>
              <th>Checkout Date</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Total</th>
              <th>Payment Id</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            $q = $pdo->prepare("SELECT * 
                          FROM payment_detail t1
                          JOIN room t2
                          ON t1.room_id = t2.room_id
                          WHERE t1.cust_id=? ORDER BY t1.payment_detail_id ASC");
            $q->execute([$_SESSION['customer']['cust_id']]);
            $res = $q->fetchAll();
            foreach ($res as $row) {
              $i++;
              if ($row['checkout_date_value'] < strtotime(date('Y-m-d'))) {
                continue;
              }
            ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['room_name']; ?></td>
                <td><?php echo $row['checkin_date']; ?></td>
                <td><?php echo $row['checkout_date']; ?></td>
                <td>$<?php echo $row['room_price']; ?></td>
                <td><?php echo $row['qty']; ?></td>
                <td>$<?php echo $row['room_price'] * $row['qty']; ?></td>
                <td><?php echo $row['payment_id']; ?></td>
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