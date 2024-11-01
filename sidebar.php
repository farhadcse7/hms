<div class="widget clearfix">
  <h3>Popular Posts</h3>
  <ul class="list-unstyled">

    <?php
    $q = $pdo->prepare("
          SELECT * 
          FROM post
          ORDER BY total_view DESC
          LIMIT 5
        ");
    $q->execute();
    $res = $q->fetchAll();
    foreach ($res as $row) {
    ?>
      <li>
        <article>
          <div class="news-thumb"> <a href="blog-detail.php?id=<?php echo $row['post_id']; ?>"><img src="uploads/<?php echo $row['post_photo']; ?>" alt="Popular news" style="width:100px;"></a> </div>
          <div class="news-content clearfix">
            <h4><a href="blog-detail.php?id=<?php echo $row['post_id']; ?>"><?php echo $row['post_title']; ?></a></h4>
            <span><?php echo month_number_to_detail($row['post_month']); ?> <?php echo $row['post_day']; ?>, <?php echo $row['post_year']; ?></a>
          </div>
        </article>
      </li>
    <?php
    }
    ?>

  </ul>
</div>

<!-- Widget: Categories -->
<div class="widget">
  <h3>Category</h3>
  <ul class="list-unstyled arrow">

    <?php
    $q = $pdo->prepare("
          SELECT * 
          FROM category
          ORDER BY category_name ASC
        ");
    $q->execute();
    $res = $q->fetchAll();
    foreach ($res as $row) {

      $r = $pdo->prepare("
              SELECT * 
              FROM post_category 
              WHERE category_id=?
            ");
      $r->execute([
        $row['category_id']
      ]);
      $res1 = $r->fetchAll();
      $tot = $r->rowCount();
      if ($tot == 0) {
        continue;
      }
    ?>
      <li><a href="category.php?id=<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?> <span class="badge pull-right"><?php echo $tot; ?></span></a></li>
    <?php
    }
    ?>
  </ul>
</div>

<!-- Widget: Tags -->
<div class="widget">
  <h3>Tags</h3>
  <div class="tags">

    <?php
    $q = $pdo->prepare("
          SELECT DISTINCT tag_name
          FROM post_tag
        ");
    $q->execute();
    $res = $q->fetchAll();
    foreach ($res as $row) {
    ?>
      <a href="tag.php?name=<?php echo $row['tag_name']; ?>"><?php echo $row['tag_name']; ?></a>
    <?php
    }
    ?>
  </div>
</div>

<!-- Widget: Archive -->
<div class="widget">
  <h3>Archive</h3>
  <ul class="list-unstyled arrow">

    <?php
    $q = $pdo->prepare("SELECT MIN(post_year) AS min_year FROM post");
    $q->execute();
    $res = $q->fetchAll();
    foreach ($res as $row) {
      $min_year = $row['min_year'];
    }

    $q = $pdo->prepare("SELECT MAX(post_year) AS max_year FROM post");
    $q->execute();
    $res = $q->fetchAll();
    foreach ($res as $row) {
      $max_year = $row['max_year'];
    }

    for ($i = $max_year; $i >= $min_year; $i--) {

      for ($j = 12; $j >= 1; $j--) {
        if (strlen($j) == 1) {
          $j = '0' . $j;
        }
        $q = $pdo->prepare("SELECT * FROM post WHERE post_year=? AND post_month=?");
        $q->execute([$i, $j]);
        $res = $q->fetchAll();
        $tot = $q->rowCount();
        if ($tot != 0) {
    ?>
          <li><a href="archive.php?month=<?php echo $j; ?>&year=<?php echo $i; ?>"><?php echo month_number_to_detail($j); ?> <?php echo $i; ?> <span class="badge pull-right"><?php echo $tot; ?></span></a></li>
    <?php
        }
      }
    }

    ?>
  </ul>

</div>