<?php require_once('header.php'); ?>

<?php
$error_message = '';
$success_message = '';
?>

<?php
if (!isset($_REQUEST['id'])) {
  header('location: index.php');
  exit;
}
?>

<?php

if (isset($_POST['form1'])) {

  $valid = 1;

  if ($_POST['person_name'] == '') {
    $valid = 0;
    $error_message .= 'Name can not be empty\n';
  }
  if ($_POST['person_comment'] == '') {
    $valid = 0;
    $error_message .= 'Comment can not be empty\n';
  }

  if ($valid == 1) {
    $date_and_time =  date('M d') . ', ' . date('Y') . ' at ' . date('h:i a');

    if ($_POST['hidden_data'] == '') {
      $q = $pdo->prepare("INSERT INTO comment (
          person_comment,
          person_name,
          person_email,
          date_and_time,
          comment_status,
          post_id
        ) 
        VALUES (?,?,?,?,?,?)");
      $q->execute([
        $_POST['person_comment'],
        $_POST['person_name'],
        $_POST['person_email'],
        $date_and_time,
        'Inactive',
        $_REQUEST['id']
      ]);
      $success_message = 'Comment is posted. It will be live after admin approval.';
    } else {
      $aa = explode('#reply', $_POST['hidden_data']);
      $q = $pdo->prepare("INSERT INTO reply (
          person_comment,
          person_name,
          person_email,
          date_and_time,
          reply_status,
          comment_id
        ) 
        VALUES (?,?,?,?,?,?)");
      $q->execute([
        $_POST['person_comment'],
        $_POST['person_name'],
        $_POST['person_email'],
        $date_and_time,
        'Inactive',
        $aa[1]
      ]);
      $success_message = 'Reply is posted. It will be live after admin approval.';
    }
  }
}
?>

<?php
$q = $pdo->prepare("
      SELECT * 
      FROM post t1
      JOIN user t2
      ON t1.user_id = t2.user_id
      WHERE t1.post_id=?
    ");
$q->execute([
  $_REQUEST['id']
]);
$res = $q->fetchAll();
foreach ($res as $row) {
  $post_title = $row['post_title'];
  $post_description = $row['post_description'];
  $post_photo = $row['post_photo'];
  $post_day = $row['post_day'];
  $post_month = $row['post_month'];
  $post_year = $row['post_year'];
  $total_view = $row['total_view'];
  $user_id = $row['user_id'];
  $user_full_name = $row['user_full_name'];
}

$total_view = $total_view + 1;
$q = $pdo->prepare("UPDATE post SET 
      total_view=?
      WHERE post_id=?
    ");
$q->execute([
  $total_view,
  $_REQUEST['id']
]);
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
              <li><a href="blog.html">Blog</a></li>
              <li class="active">Blog Post</li>
            </ol>
            <h1>Blog Post</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <div class="row">
    <!-- Blog -->
    <section class="blog mt50">
      <div class="col-md-9">

        <?php
        if ($error_message) {
        ?>
          <script>
            alert('<?php echo $error_message; ?>');
          </script>
        <?php
        }
        if ($success_message) {
        ?>
          <script>
            alert('<?php echo $success_message; ?>');
          </script>
        <?php
        }
        ?>
        <!-- Article -->
        <article>
          <div style="overflow: hidden;"><img src="uploads/<?php echo $post_photo; ?>" alt="image" class="img-responsive zoom-img"></div>
          <div class="row">
            <div class="col-sm-1 col-xs-2 meta">
              <div class="meta-date"><span><?php echo month_number_to_detail($post_month); ?></span><?php echo $post_day; ?></div>
            </div>
            <div class="col-sm-11 col-xs-10 meta">
              <h2><?php echo $post_title; ?></h2>

              <span class="meta-author"><i class="fa fa-user"></i><a href="author.php?id=<?php echo $user_id; ?>"><?php echo $user_full_name; ?></a></span>
              <span class="meta-category"><i class="fa fa-pencil"></i>

                <?php
                $i = 0;
                $r = $pdo->prepare("
                        SELECT * 
                        FROM post_category t1
                        JOIN category t2
                        ON t1.category_id = t2.category_id

                        WHERE t1.post_id=?
                      ");
                $r->execute([
                  $_REQUEST['id']
                ]);
                $res1 = $r->fetchAll();
                foreach ($res1 as $row1) {
                  $i++;
                  if ($i != 1) {
                    echo ', ';
                  }
                ?>
                  <a href="category.php?id=<?php echo $row1['category_id']; ?>"><?php echo $row1['category_name']; ?></a>
                <?php
                }
                ?>

              </span>

              <span class="meta-comments"><i class="fa fa-comment"></i><a href="#">3 Comments</a></span>
            </div>

            <div class="col-md-12">
              <?php echo $post_description; ?>
            </div>
            <div class="col-md-12">
              <b>Tags:</b> <br>
              <?php
              $i = 0;
              $q = $pdo->prepare("
                    SELECT * 
                    FROM post_tag 
                    WHERE post_id=?
                  ");
              $q->execute([$_REQUEST['id']]);
              $res = $q->fetchAll();
              $tot = $q->rowCount();

              if ($tot > 0):
                foreach ($res as $row) {
                  $i++;
                  if ($i != 1) {
                    echo ', ';
                  }
              ?>
                  <a href="tag.php?name=<?php echo $row['tag_name']; ?>"><?php echo $row['tag_name']; ?></a>
              <?php
                }
              else:
                echo 'No tag found.';
              endif;
              ?>
            </div>
          </div>
        </article>

        <!-- Blog: Author -->
        <section class="blog-author clearfix">
          <h3>About the author: <span><?php echo $user_full_name; ?></span></h3>
          <!-- <img src="images/blog/author-01.jpg" alt="Author"  class="img-circle"/> -->
          <p>Proin venenatis, diam in iaculis venenatis, ante lacus dictum dolor, sed laoreet nisl dui vel magna. Cras pulvinar tortor quis dolor viverra vel scelerisque magna suscipit. Maecenas nec placerat augue. Cras feugiat imperdiet nulla ut feugiat. Vestibulum nunc enim, consequat ac euismod vel, commodo eget nulla. Donec augue est, consectetur posuere dapibus non, aliquam tempor ligula. Suspendisse potenti. Cras vel vestibulum dolor L.orem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed turpis neque. In auctor, odio eget luctus lobortis!</p>
        </section>

        <?php
        //fetch comments data from db
        $q = $pdo->prepare("SELECT * FROM comment WHERE post_id=? AND comment_status=? ORDER BY comment_id ASC");
        $q->execute([$_REQUEST['id'], 'Active']);
        $total_comment = $q->rowCount();
        ?>

        <!-- Blog: Comments -->
        <section class="comments mt50">
          <div class="blog-comments">
            <h2 class="lined-heading"><span><i class="fa fa-comments"></i><?php echo $total_comment; ?> Comments</span></h2>
          </div>

          <?php
          $res = $q->fetchAll();
          foreach ($res as $row) {
          ?>
            <!-- main comment show  start-->
            <div class="comment">
              <a href="#reply<?php echo $row['comment_id']; ?>" class="take-value">
                <div class="reply-button"> Reply </div>
              </a>
              <div class="avatar">
                <?php
                $gravatar_link = 'http://www.gravatar.com/avatar/' . md5($row['person_email']) . '?s=32';
                echo '<img src="' . $gravatar_link . '" class="img-circle">';
                ?>
              </div>
              <div class="comment-text">
                <div class="author">
                  <div class="name"><?php echo $row['person_name']; ?></div>
                  <div class="date"><?php echo $row['date_and_time']; ?></div>
                </div>
                <div class="text">
                  <p>
                    <?php echo nl2br($row['person_comment']); ?>
                  </p>
                </div>
              </div>
            </div>
            <!-- main comment show  end-->

            <!-- reply show  start-->
            <?php
            $r = $pdo->prepare("SELECT * FROM reply WHERE comment_id=? AND reply_status=? ORDER BY reply_id ASC");
            $r->execute([$row['comment_id'], 'Active']);
            $res1 = $r->fetchAll();
            foreach ($res1 as $row1) {
            ?>
              <div class="reply-line"></div>
              <div class="reply">
                <div class="comment">
                  <div class="avatar">
                    <?php
                    $gravatar_link = 'http://www.gravatar.com/avatar/' . md5($row1['person_email']) . '?s=32';
                    echo '<img src="' . $gravatar_link . '" class="img-circle">';
                    ?>
                  </div>
                  <div class="comment-text">
                    <div class="author">
                      <div class="name"><?php echo $row1['person_name']; ?></div>
                      <div class="date"><?php echo $row1['date_and_time']; ?></div>
                    </div>
                    <div class="text">
                      <p><?php echo nl2br($row1['person_comment']); ?></p>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>

          <?php
          }
          ?>
          <!-- reply show  end-->

          <!-- Leave comment -->
          <div id="come_here"></div>
          <div class="mt50">
            <h3><i class="fa fa-comment"></i> Leave a comment</h3>
            <form action="" role="form" class="mt30" method="post">
              <input type="hidden" name="hidden_data" value="" id="abc">
              <div class="form-group">
                <label for="name"><span class="required">*</span> Your Name</label>
                <input type="text" class="form-control" name="person_name">
              </div>
              <div class="form-group">
                <label for="email">Your Email address</label>
                <input type="email" class="form-control" name="person_email">
              </div>
              <div class="form-group">
                <label for="comment"><span class="required">*</span> Your comment</label>
                <textarea name="person_comment" rows="9" class="form-control"></textarea>
              </div>
              <button type="submit" class="btn btn-default btn-lg" name="form1">Post comment</button>
            </form>
          </div>
        </section>
      </div>
    </section>

    <!-- Aside -->
    <aside class="mt50">
      <!-- Widget: Text -->
      <div class="col-md-3">
        <?php require_once('sidebar.php'); ?>
      </div>
    </aside>
  </div>
</div>

<script>
  (function($) {

    $('.take-value').on('click', function() {
      var temp = $(this).attr('href');
      $('#abc').val(temp);
      window.location.href = "#come_here";
    });

  })(jQuery);
</script>

<?php require_once('footer.php'); ?>