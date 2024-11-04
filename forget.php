<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

  $valid = 1;

  if ($_POST['cust_email'] == '') {
    $valid = 0;
    $error_message .= 'Email can not be empty.\n';
  } else {
    if (!filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL)) {
      $valid = 0;
      $error_message .= 'Email must be valid.\n';
    } else {

      $q = $pdo->prepare("SELECT * FROM customer WHERE cust_email=?");
      $q->execute([$_POST['cust_email']]);
      $tot = $q->rowCount();
      if (!$tot) {
        $valid = 0;
        $error_message .= 'Email is not found on our system.\n';
      } else {
        // Everything is okay

        $hash = md5(time());

        $q = $pdo->prepare("UPDATE customer SET 
              cust_hash=?        
              WHERE cust_email=?
            ");
        $q->execute([
          $hash,
          $_POST['cust_email']
        ]);

        require_once('mail/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        try {

          // $mail->SMTPSecure = "ssl";
          // $mail->IsSMTP();
          // $mail->SMTPAuth   = true;
          // $mail->Host       = 'business32.web-hosting.com';
          // $mail->Port       = '465';
          // $mail->Username   = 'usa@commercialcleaningjanitorialserviceslosangeles.com';
          // $mail->Password   = '63@n6#3)W.G%';
          // $mail->addReplyTo('noreply@yourwebsite.com');
          // $mail->setFrom('usa@commercialcleaningjanitorialserviceslosangeles.com');
          // $mail->addAddress($_POST['cust_email']);

          // SMTP configuration
          $mail->isSMTP();
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'miafm6@gmail.com';
          $mail->Password   = 'upakmuzjkyztaytz';
          $mail->SMTPSecure = "tls";
          $mail->Port       = 587;
          // Email headers and addresses
          $mail->setFrom('miafm6@gmail.com', 'HMS');
          $mail->addReplyTo('noreply@yourwebsite.com');
          $mail->addAddress($_POST['cust_email']);

          $mail->isHTML(true);
          $mail->Subject = 'Reset Password';

          // $verify_link = '<a href="http://localhost/php/project/reset.php?email='.$_POST['cust_email'].'&hash='.$hash.'">http://localhost/php/project/reset.php?email='.$_POST['cust_email'].'&hash='.$hash.'</a>';
          // $mail->Body = 'Please click on the link below to reset password:'.$verify_link;
          $mail->Body    = '<h2>Verify your account <a href="localhost/hms/reset.php?email=' . $_POST['cust_email'] . '&hash=' . $hash . '">click here for reset</a> </h2>';
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          $mail->send();

          $success_message = 'Your registration is completed. Please check your email address to follow the process to confirm your registration.';
        } catch (Exception $e) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
        }


        $success_message = 'We have sent an email to you. Please check that email and follow instruction in there.';
      }
    }
  }
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
              <li class="active">Forget Password</li>
            </ol>
            <h1>Forget Password</h1>
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
                <label for="name"><span class="required">*</span> Email Address</label>
                <input name="cust_email" type="text" class="form-control" value="">
              </div>
            </div>
          </div>
          <button type="submit" class="btn  btn-lg btn-primary" name="form1">Submit</button>
          <a href="login.php">back to login page</a>
        </form>


      </div>
    </section>
  </div>
</div>


<?php require_once('footer.php'); ?>