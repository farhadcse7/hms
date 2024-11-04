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
                            <li class="active">Rooms list view</li>
                        </ol>
                        <h1>Rooms list view</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter -->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-pills" id="filters">
                <li class="active"><a href="#" data-filter="*">All</a></li>

                <?php
                $q = $pdo->prepare("SELECT * FROM room_type ORDER BY room_type_id ASC");
                $q->execute();
                $res = $q->fetchAll();
                foreach ($res as $row) {
                ?>
                    <li><a href="#" data-filter=".ty<?php echo $row['room_type_id']; ?>"><?php echo $row['room_type_name']; ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<!-- Rooms -->
<section class="rooms mt100">
    <div class="container">
        <div class="row room-list fadeIn appear">


            <?php
            $q = $pdo->prepare("SELECT * FROM room ORDER BY room_id ASC");
            $q->execute();
            $res = $q->fetchAll();
            foreach ($res as $row) {
            ?>
                <!-- filter images here as per room types start one by one-->
                <div class="col-sm-4 ty<?php echo $row['room_type_id']; ?>">
                    <div class="room-thumb">
                        <img src="uploads/<?php echo $row['room_featured_photo']; ?>" alt="room 1" class="img-responsive">
                        <div class="mask">
                            <div class="main">
                                <h5><?php echo $row['room_name']; ?></h5>
                                <div class="price">$ <?php echo $row['room_price']; ?><span>a night</span></div>
                            </div>
                            <div class="content">
                                <p>
                                    <?php echo $row['room_short_description']; ?>
                                </p>
                                <div class="row">
                                    <!-- features side by decoration rules start here -->
                                    <?php
                                    $r = $pdo->prepare("SELECT * 
                                            FROM room_room_feature t1
                                            JOIN room_feature t2
                                            ON t1.room_feature_id = t2.room_feature_id
                                            WHERE t1.room_id=? 
                                            ORDER BY t1.room_id ASC");
                                    $r->execute([$row['room_id']]);
                                    $tot = $r->rowCount();
                                    if ($tot % 2 == 0) {
                                        $left = $tot / 2;
                                        $right = $left;
                                    } else {
                                        $left = ceil($tot / 2);
                                        $right = $left - 1;
                                    }

                                    $left_arr_name = array();
                                    $left_arr_icon = array();
                                    $right_arr_name = array();
                                    $right_arr_icon = array();

                                    $i = 0;
                                    $res1 = $r->fetchAll();
                                    foreach ($res1 as $row1) {
                                        $i++;
                                        if ($i <= $left) {
                                            $left_arr_name[] = $row1['room_feature_name'];
                                            $left_arr_icon[] = $row1['room_feature_icon'];
                                        } else {
                                            $right_arr_name[] = $row1['room_feature_name'];
                                            $right_arr_icon[] = $row1['room_feature_icon'];
                                        }
                                    }
                                    ?>

                                    <div class="col-xs-6">
                                        <ul class="list-unstyled">
                                            <?php
                                            for ($i = 0; $i < count($left_arr_name); $i++) {
                                            ?><li><i class="<?php echo $left_arr_icon[$i]; ?>"></i> <?php echo $left_arr_name[$i]; ?></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="col-xs-6">
                                        <ul class="list-unstyled">
                                            <?php
                                            for ($i = 0; $i < count($right_arr_name); $i++) {
                                            ?><li><i class="<?php echo $right_arr_icon[$i]; ?>"></i> <?php echo $right_arr_name[$i]; ?></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <!-- features side by decoration rules ends here -->
                                </div>
                                <a href="room.php?id=<?php echo $row['room_id']; ?>" class="btn btn-primary btn-block">View Details</a>
                                <a href="" class="btn btn-primary btn-block">Book Now</a>
                                <!-- <a href="room-detail.html" class="btn btn-primary btn-block">Add To Cart</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- filter images here as per room types end -->
            <?php
            }
            ?>

        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>