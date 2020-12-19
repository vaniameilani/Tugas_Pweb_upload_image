<?php session_start();
include "koneksi.php";

// if(isset($_SESSION['idUser'])){
//     include "koneksi.php";
//     $sql = mysqli_query($koneksi, "select * from user");
// }

// echo "Selamat datang : ".$_SESSION['idUser'];
// echo "<br><br>";

// include "koneksi.php";
$base64_string = $_POST['image'];
$username = $_POST['idUser'];
$password = $_POST["password"];
// $tanggal = date("Y-m-d");
// $sql = mysqli_query($koneksi, "select * from user");
// $query = mysqli_fetch_assoc($sql);;
$query = mysqli_query($koneksi, "select * from user where idUser ='$username' and password ='$password'");
$cek = mysqli_num_rows($query);
$user = mysqli_fetch_assoc($query);
$image_name = "C:\\xampp\\htdocs\\PWEB\\onFace\\admin";

if ($cek > 0){
    if (!file_exists($image_name)) {
        if (!mkdir($image_name)) {
            $m=array('msg' => "REJECTED, can't create folder");
            echo json_encode($m);
            return;
        }
    }
}
else {
    echo "wrong password or username!";
    exit;
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
// echo "Tanggal Sekarang : ".$tanggal;

echo json_encode($m);
$uname = $user['idUser'];
// $_SESSION['timestamp'] = date('Y-m-d');
// $time = $_SESSION['timestamp'];
// print_r($_SESSION);
// echo ".$time";
$sql = mysqli_query($koneksi, "INSERT INTO images ( username ) VALUES ('$uname')");
?>
