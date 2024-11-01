<?php
function image_handler($source_image, $destination, $tn_w = 100, $tn_h = 100, $quality = 80)
{

    $info = getimagesize($source_image);
    $imgtype = image_type_to_mime_type($info[2]);

    switch ($imgtype) {
        case 'image/jpeg':
            $source = imagecreatefromjpeg($source_image);
            break;
        case 'image/gif':
            $source = imagecreatefromgif($source_image);
            break;
        case 'image/png':
            $source = imagecreatefrompng($source_image);
            break;
        default:
            die('Invalid image type.');
    }

    $src_w = imagesx($source);
    $src_h = imagesy($source);
    $src_ratio = $src_w / $src_h;

    if ($tn_w / $tn_h > $src_ratio) {
        $new_h = $tn_w / $src_ratio;
        $new_w = $tn_w;
    } else {
        $new_w = $tn_h * $src_ratio;
        $new_h = $tn_h;
    }
    $x_mid = $new_w / 2;
    $y_mid = $new_h / 2;

    $newpic = imagecreatetruecolor(round($new_w), round($new_h));
    imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
    $final = imagecreatetruecolor($tn_w, $tn_h);
    imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
    if (Imagejpeg($final, $destination, $quality)) {
        return true;
    }
    return false;
}


// for frontend blog 
function month_number_to_detail($month)
{
    if($month == '01') {$final_month = 'Jan';}
    elseif($month == '02') {$final_month = 'Feb';}
    elseif($month == '03') {$final_month = 'Mar';}
    elseif($month == '04') {$final_month = 'Apr';}
    elseif($month == '05') {$final_month = 'May';}
    elseif($month == '06') {$final_month = 'Jun';}
    elseif($month == '07') {$final_month = 'Jul';}
    elseif($month == '08') {$final_month = 'Aug';}
    elseif($month == '09') {$final_month = 'Sep';}
    elseif($month == '10') {$final_month = 'Oct';}
    elseif($month == '11') {$final_month = 'Nov';}
    elseif($month == '12') {$final_month = 'Dec';}

    return $final_month;
}