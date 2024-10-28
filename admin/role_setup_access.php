<?php require_once('header.php'); ?>

<?php
$q = $pdo->prepare("
            SELECT * 
            FROM role 
            WHERE role_id=?
        ");
$q->execute([
    $_REQUEST['id']
]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $role_name = $row['role_name'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Setup Roles for <?php echo $role_name; ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <?php
        if (isset($_POST['form1'])) {
            foreach ($_POST['role_access_ids'] as $val) {
                $arr1[] = $val;
            }

            foreach ($_POST['access_status_arr'] as $val) {
                $arr2[] = $val;
            }

            for ($i = 0; $i < count($arr1); $i++) {
                $q = $pdo->prepare("UPDATE role_access SET 
                            access_status=?                
                            WHERE role_access_id=?
                        ");
                $q->execute([
                    $arr2[$i],
                    $arr1[$i]
                ]);
            }
        }
        ?>

        <form action="" method="post">
            <?php
            $i = 0;
            $q = $pdo->prepare("
                    SELECT * 
                    FROM role_access t1
                    JOIN pages t2
                    ON t1.page_id = t2.page_id
                    WHERE t1.role_id=?
                ");
            $q->execute([
                $_REQUEST['id']
            ]);
            $res = $q->fetchAll();
            foreach ($res as $row) {
            ?>
                <input type="hidden" name="role_access_ids[<?php echo $i; ?>]" value="<?php echo $row['role_access_id']; ?>">
                <!-- if not checked  -->
                <input type="hidden" name="access_status_arr[<?php echo $i; ?>]" value="0">
                <!-- if checked  -->
                <input type="checkbox" name="access_status_arr[<?php echo $i; ?>]" value="1"
                    <?php if ($row['access_status'] == 1) {
                        echo 'checked';
                    } ?>>

                <?php echo $row['page_title']; ?><br>

            <?php
                $i++;
            }
            ?>
            <br>
            <input type="submit" value="Update" name="form1">
        </form>


    </div>
</div>
</div>
<?php require_once('footer.php'); ?>