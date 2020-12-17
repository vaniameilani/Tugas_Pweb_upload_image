<?php

include "koneksi.php";
$base64_string = $_POST['image'];
$username = $_POST['idUser'];
// $password = $_POST["password"];
// $tanggal = date("Y-m-d");
$sql = mysqli_query($koneksi, "select * from user where username='$username' and password='$password");

$image_name = "C:\\xampp\\htdocs\\PWEB\\onFace\\admin".$username;

if (!file_exists($image_name)) {
 if (!mkdir($image_name)) {
    $m=array('msg' => "REJECTED, can't create folder");
    echo json_encode($m);
    return;}
}

$fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi)+1;
$data = explode(',', $base64_string);
$fullName = $image_name."\\X__".$fileCount."_". date("YmdHis") .".png";
$ifp = fopen($fullName, "wb");
fwrite($ifp, base64_decode($data[1]));
fclose($ifp);
if (!$ifp){
    $m=array('msg' => "REJECTED, ".$fullName."not saved");
    echo json_encode($m);
    return;}

// $command = escapeshellcmd("python checkFace.py ".$fullName);
// $output = shell_exec($command);

$fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi);
$m = array('msg' => "Berhasil Mengirim"." total(".$fileCount.")");
echo "Tanggal Sekarang : ".$tanggal;
echo json_encode($m);

?>
