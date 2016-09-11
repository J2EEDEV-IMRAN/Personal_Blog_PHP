<?
 $dbhost='localhost';
 $dbname='project';
 $dbuser='root';
 $dbpassword='';
 try
 {
    $db=new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }
 catch( PDOException $e)
 {
   echo 'Connection error :'.$e->getMessage();
 }
?>