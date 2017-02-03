<?php
$passsha512 = ""; //Run echo hash("sha512", "yourpasshere") on your password and paste it here.
$uploaddir = '/var/www/uploads/';
$domain = ""; //Example: https://s.ave.zone/

//Don't change anything below.

if (hash("sha512", $_GET['apikey']) == $passsha512)
{
$filename = basename($_FILES['f']['name']);
$uploadfile = $uploaddir . basename($_FILES['f']['name']);
$randlength = 3;

if (isset($_GET['rand'])) {
$path = $_FILES['f']['name'];
$ext = "." . pathinfo($path, PATHINFO_EXTENSION);
$filename = substr(md5(rand()), 0, $randlength) . $ext;
$uploadfile = $uploaddir . $filename;
$trycount = 0;
while (file_exists($uploadfile)){
$filename = substr(md5(rand()), 0, $randlength) . $ext;
$uploadfile = $uploaddir . $filename;
$trycount = $trycount + 1;
if ($trycount == 100)
{
$randlength = $randlength + 1;
}
}
}

if (move_uploaded_file($_FILES['f']['tmp_name'], $uploadfile)) {
    echo $domain.$filename;
} else {
    echo "possible attack blocked";
}
}
else
{
print "wrong key";
}
?>

