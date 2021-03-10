<?php
include_once 'koneksi.php';
$filefound = '3';
$filenya = "C:/lock/lock.lock";
if(!$sock = @fsockopen('www.google.com', 80))
{
    echo 'Dissconnect'."<br>";
    $tgl = date("Y-m-d");
    
    if (!file_exists($filenya)) { 
        $filefound = '0'; //g ada file dan buat file dan posisi diskonek
        $fp = fopen("C:/lock/lock.lock","wb");
        fclose($fp); 
    }
     else
    {
        $filefound = '1'; //filenya udah ada dan posisi diskonek
    }
       
}
else
{
echo 'Connected'."<br>";
$filefound = '3'; //konek dan file sudah di hapus
mysqli_query($conn,"UPDATE room SET players=1");
if (file_exists($filenya)) {
    unlink($filenya);
    }
    
}

echo "tandanya ".$filefound."<br>";

if ($filefound='1'){
    $files    = glob("C:/lock/*");
    foreach ($files as $file) {
        $lastModifiedTime    =filemtime($file);
        $currentTime        =time();
        $timeDiff            =abs($currentTime - $lastModifiedTime)/(60*60); // in hours
        echo $timeDiff;
        if(is_file($file) && $timeDiff > 0.03) // 240 hitungan jam jadi 10 hari
            mysqli_query($conn,"UPDATE room SET players=0");
            echo 'updated -'."<br>";  
    }
}
else
if ($filefound='3'){
    mysqli_query($conn,"UPDATE room SET players=1");
    echo 'updated +'."<br>";  
}

?>