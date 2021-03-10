<?php
   $servername='localhost';
   $username='root';
   $password=''; #mysql password
   $dbname = ""; #mysql database name
   $conn=mysqli_connect($servername,$username,$password,"$dbname");
   if(!$conn){
      die('Could not Connect My Sql:' .mysql_error());
   }
   else
   {
       echo "konak";
   }
?>