<?php include("/var/www/html/sankshepv2.0/inc/connect.inc.php");

$path = "/var/www/html/sankshepv2.0/videos/clips/";

if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if ('.' === $file) continue;
        if ('..' === $file) continue;

        //$title = substr($file, 0, -17);
        $title = "";
        $url = "/videos/clips/".$file;
        $arr1 = explode(".", $file);
        $arr2 = explode("-", $arr1[0]);
        $parent_id = $arr2[1];
        $description_url = "videos/clips-text/".$file.".flac.txt";
        mysqli_query($con,"INSERT INTO videos (title, url, view_count, parent_id, is_clip, description_url) VALUES ('$title','$url','0','$parent_id','1','$description_url')");
    }
    closedir($handle);
}
?>