<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form_login']))
{

  if($_POST['cust_email'] == '' || $_POST['cust_password'] == '' )
  {
    $error_message = 'Please give the correct email and password';
  }
  else
  {
    $q = $pdo->prepare("
          SELECT * 
          FROM customer 
          WHERE cust_email=?
        ");
    $q->execute([$_POST['cust_email']]);
    $res = $q->fetchAll();
    $total = $q->rowCount();

    if($total)
    {
      foreach($res as $row)
      {
        $stored_password = $row['cust_password'];
      }

      if( md5($_POST['cust_password']) == $stored_password )
      {
        // Everything is fine!
        $_SESSION['customer'] = $row;

        header('location: c-dashboard.php');
        exit;

      }
      else
      {
        $error_message = 'Please give the correct email and password';
      }

    }
    else
    {
      $error_message = 'Please give the correct email and password';
    }
    
  }


}
?>

<!-- Parallax Effect -->
<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>

<section class="parallax-effect">
  <div id="parallax-pagetitle" style="background-image: url(images/parallax/parallax-01.jpg);">
    <div class="color-overlay"> 
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="index.html">Home</a></li>
              <li class="active">Login</li>
            </ol>
            <h1>Login</h1>
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
        if($error_message) {
          ?><script>alert('<?php echo $error_message; ?>');</script><?php
        }

        if($success_message) {
          ?><script>alert('<?php echo $success_message; ?>');</script><?php
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
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name"><span class="required">*</span> Password</label>
                <input name="cust_password" type="password" class="form-control" value="">
              </div>
            </div>
          </div>
          <button type="submit" class="btn  btn-lg btn-primary" name="form_login">Login</button>
          <a href="forget.php">Forget Password?</a>
        </form>


      </div>
    </section>
  </div>
</div>


<?php require_once('footer.php'); ?>