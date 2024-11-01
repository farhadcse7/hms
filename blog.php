<?php require_once('header.php'); ?>

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
              <li class="active">Blog</li>
            </ol>
            <h1>Blog</h1>
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
        $per_page = 5;
        $q = $pdo->prepare("SELECT * FROM post");
        $q->execute();
        $total = $q->rowCount();
        //total page calculate
        if ($total % $per_page == 0) {
          $total_pages = $total / $per_page;
        } else {
          $total_pages = ceil($total / $per_page);
        }
        //start page calculate
        if (!isset($_REQUEST['p'])) {
          $start = 1;
        } else {
          $start = $per_page * ($_REQUEST['p'] - 1) + 1;
        }
        //data filter by per page numbers
        $j = 0;
        $k = 0;
        $arr1 = array();
        $res = $q->fetchAll();
        foreach ($res as $row) {
          $j++;
          if ($j >= $start) {
            $k++;
            if ($k > $per_page) {
              break;
            }
            $arr1[] = $row['post_id'];
          }
        }
        ?>

        <?php
        $q = $pdo->prepare("
              SELECT * 
              FROM post t1
              JOIN user t2
              ON t1.user_id = t2.user_id
              ORDER BY t1.post_id DESC
            ");
        $q->execute();
        $res = $q->fetchAll();
        foreach ($res as $row) {
          if (!in_array($row['post_id'], $arr1)) {
            continue;
          }

        ?>
          <article> <a href="blog-detail.php?id=<?php echo $row['post_id']; ?>" class="mask"><img src="uploads/<?php echo $row['post_photo']; ?>" alt="image" class="img-responsive zoom-img"></a>
            <div class="row">
              <div class="col-sm-1 col-xs-2 meta">
                <div class="meta-date"><span><?php echo month_number_to_detail($row['post_month']); ?></span><?php echo $row['post_day']; ?></div>
              </div>
              <div class="col-sm-11 col-xs-10 meta">
                <h2><a href="blog-detail.php?id=<?php echo $row['post_id']; ?>"><?php echo $row['post_title']; ?></a></h2>
                <span class="meta-author"><i class="fa fa-user"></i><a href="author.php?id=<?php echo $row['user_id']; ?>"><?php echo $row['user_full_name']; ?></a></span>

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
                    $row['post_id']
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
                <p class="intro">
                  <?php echo $row['post_short_description']; ?>
                </p>
                <a href="blog-detail.php?id=<?php echo $row['post_id']; ?>" class="btn btn-primary pull-right">Read More</a>
              </div>
            </div>
          </article>
        <?php
        }
        ?>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
          <div class="text-center mt50">
            <ul class="pagination clearfix">

              <?php
              //previous button rule set
              if (!isset($_REQUEST['p'])) {
                echo '<li class="disabled"><a href="javascript:void;">«</a></li>';
              } else {
                if ($_REQUEST['p'] == 1) {
                  echo '<li class="disabled"><a href="javascript:void;">«</a></li>';
                } else {
                  echo '<li><a href="http://localhost/hms/blog.php?p=' . ($_REQUEST['p'] - 1) . '">«</a></li>';
                }
              }
              ?>

              <?php
              //main pagination show calculate button
              for ($i = 1; $i <= $total_pages; $i++) {
                if (isset($_REQUEST['p'])) {
                  if ($i == $_REQUEST['p']) {
                    $active = 'active';
                  } else {
                    $active = '';
                  }
                } else {
                  if ($i == 1) {
                    $active = 'active';
                  } else {
                    $active = '';
                  }
                }
                echo '<li class="' . $active . '"><a href="http://localhost/hms/blog.php?p=' . $i . '">' . $i . '</a></li>';
              }
              ?>

              <?php
              //next button rule set
              if (!isset($_REQUEST['p'])) {
                echo '<li><a href="http://localhost/hms/blog.php?p=2">»</a></li>';
              } else {
                if ($_REQUEST['p'] == $total_pages) {
                  echo '<li class="disabled"><a href="javascript:void;">»</a></li>';
                } else {
                  echo '<li><a href="http://localhost/hms/blog.php?p=' . ($_REQUEST['p'] + 1) . '">»</a></li>';
                }
              }
              ?>

            </ul>
          </div>
        <?php endif; ?>

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

<?php require_once('footer.php'); ?>