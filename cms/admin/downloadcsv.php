<?php
session_start();
include('include/config.php');
$query = mysqli_query($con, "select tblcomplaints.*,users.fullName as name from tblcomplaints join users on users.id=tblcomplaints.userId where tblcomplaints.regDateshow>0");
date_default_timezone_set('Asia/Kolkata');// change according timezone
$list = array();
$i = 0;
while ($row = mysqli_fetch_array($query)) {
    $list[$i]['User-Name'] = $row['name'];
    $list[$i]['complaintType'] = $row['complaintType'];
    $list[$i]['state'] = $row['state'];
    $list[$i]['complaintDetails'] = $row['complaintDetails'];
    $list[$i]['noc'] = $row['noc'];
    $list[$i]['status'] = $row['status'];
    $list[$i]['category'] = getCategory($row['category'], $con)['categoryName'];
    $list[$i]['categoryDetails'] = getCategory($row['category'], $con)['categoryDescription'];
    $list[$i]['subcategory'] = $row['subcategory'];
    $list[$i]['regDateshow'] = getcurrenttimme($row['regDateshow']); 
    $list[$i]['File']='https://ascenttechsolution.com/cms/users/complaintdocs/'.$row['complaintFile'];
}
//print_r($list);




function array2csv(array &$array)
{
    if (count($array) == 0) {
        return null;
    }
    ob_start();
    $df = fopen("php://output", 'w');
    fputcsv($df, array_keys(reset($array)));
    foreach ($array as $row) {
        fputcsv($df, $row);
    }
    fclose($df);
    return ob_get_clean();
}

function getCategory($ID, $con)
{

    $query = mysqli_query($con, "SELECT categoryName,categoryDescription  FROM category where id=" . $ID);
    $row = mysqli_fetch_array($query);
    return $row;
}



function download_send_headers($filename)
{
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}


download_send_headers("data_export_" . date("Y_m_d_h_i_a") . ".csv");
echo array2csv($list);
die();
