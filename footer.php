<?php
$q = $pdo->prepare("SELECT * FROM settings WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
  $footer_address = $row['footer_address'];
  $footer_phone = $row['footer_phone'];
  $footer_email = $row['footer_email'];
  $footer_website = $row['footer_website'];
  $footer_copyright = $row['footer_copyright'];
  $footer_how_many_post = $row['footer_how_many_post'];
}
?>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3">
        <h4>About Starhotel</h4>
        <p>Suspendisse sed sollicitudin nisl, at dignissim libero. Sed porta tincidunt ipsum, vel volutpat. <br>
          <br>
          Nunc ut fringilla urna. Cras vel adipiscing ipsum. Integer dignissim nisl eu lacus interdum facilisis. Aliquam erat volutpat. Nulla semper vitae felis vitae dapibus.
        </p>
      </div>
      <div class="col-md-3 col-sm-3">
        <h4>Recieve our newsletter</h4>
        <p>Suspendisse sed sollicitudin nisl, at dignissim libero. Sed porta tincidunt ipsum, vel volutpa!</p>
        <form role="form">
          <div class="form-group">
            <input name="newsletter" type="text" id="newsletter" value="" class="form-control" placeholder="Please enter your E-mailaddress">
          </div>
          <button type="submit" class="btn btn-lg btn-black btn-block">Submit</button>
        </form>
      </div>
      <div class="col-md-3 col-sm-3">
        <h4>From our blog</h4>
        <ul>

          <?php
          $i = 0;
          $q = $pdo->prepare("SELECT * FROM post ORDER BY post_id DESC");
          $q->execute();
          $res = $q->fetchAll();
          foreach ($res as $row) {
            $i++;
            if ($i > $footer_how_many_post) {
              break;
            }
          ?>
            <li>
              <article>
                <a href="blog-detail.php?id=<?php echo $row['post_id']; ?>"><?php echo $row['post_title']; ?><br><?php echo $row['post_day'] . '-' . $row['post_month'] . '-' . $row['post_year']; ?></a>
              </article>
            </li>
          <?php
          }
          ?>



        </ul>
      </div>
      <div class="col-md-3 col-sm-3">
        <h4>Address</h4>
        <address>
          <?php echo nl2br($footer_address); ?><br>
          <abbr title="Phone">P:</abbr> <?php echo $footer_phone; ?><br>
          <abbr title="Email">E:</abbr> <?php echo $footer_email; ?><br>
          <abbr title="Website">W:</abbr> <?php echo $footer_website; ?><br>
        </address>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-6"> <?php echo $footer_copyright; ?> </div>
        <div class="col-xs-6 text-right">
          <ul>
            <li><a href="contact-01.html">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Go-top Button -->
<div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>

<!-- Stripe js  -->
<script>
  $(document).on('submit', '#stripe_form', function() {
    $('#submit-button').prop("disabled", true);
    $("#msg-container").hide();
    Stripe.card.createToken({
      number: $('.card-number').val(),
      cvc: $('.card-cvc').val(),
      exp_month: $('.card-expiry-month').val(),
      exp_year: $('.card-expiry-year').val()
      // name: $('.card-holder-name').val()
    }, stripeResponseHandler);
    return false;
  });
  Stripe.setPublishableKey('pk_test_0SwMWadgu8DwmEcPdUPRsZ7b'); //public key
  function stripeResponseHandler(status, response) {
    if (response.error) {
      $('#submit-button').prop("disabled", false);
      $("#msg-container").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
      $("#msg-container").show();
    } else {
      var form$ = $("#stripe_form");
      var token = response['id'];
      form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
      form$.get(0).submit();
    }
  }
</script>

</body>

</html>