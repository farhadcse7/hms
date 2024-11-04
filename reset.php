<?php require_once('header.php'); ?>

<?php
$q = $pdo->prepare("SELECT * FROM customer WHERE cust_email=? AND cust_hash=?");
$q->execute([$_REQUEST['email'], $_REQUEST['hash']]);
$tot = $q->rowCount();
if (!$tot) {
    header('location: index.php');
    exit;
}
?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE customer SET 
        cust_password=?, 
        cust_hash=?
        WHERE cust_email=?
      ");
    $q->execute([
        md5($_POST['cust_password']),
        '',
        $_REQUEST['email']
    ]);

    header('location: reset_success.php');
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
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Reset Password</li>
                        </ol>
                        <h1>Reset Password</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">


        <!-- Contact form -->
        <section id="contact-form" class="mt50">
            <div class="col-md-7">

                <?php
                if ($error_message) {
                ?><script>
                        alert('<?php echo $error_message; ?>');
                    </script><?php
                            }

                            if ($success_message) {
                                ?><script>
                        alert('<?php echo $success_message; ?>');
                    </script><?php
                            }
                                ?>

                <form class="clearfix mt50" method="post" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><span class="required">*</span> New Password</label>
                                <input name="cust_password" type="text" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="name"><span class="required">*</span> Retype New Password</label>
                                <input name="cust_re_password" type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn  btn-lg btn-primary" name="form1">Submit</button>
                </form>


            </div>
        </section>
    </div>
</div>


<?php require_once('footer.php'); ?>