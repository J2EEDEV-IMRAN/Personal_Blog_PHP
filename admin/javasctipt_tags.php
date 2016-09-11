<?  ob_start();session_start(); ?>   <!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
      <?php
     
      if($_SESSION['name']!='admin')
      {
        header('location: login.php');
      }
      require_once('../config.php');
?>

<?
require_once('../config.php');
if(isset($_POST['tag'])){
	$tag=trim(preg_replace('#[^a-z]#i', '', $_POST['tag']));
	$num=0;
		
			try{
					$statement=$db->prepare("SELECT tag_name FROM tbl_tag WHERE tag_name LIKE '%".$tag."%'") or die('there is an error');
					$statement->execute(array($tag));
                     $num=$statement->rowCount();
                     if(strlen($tag)<4)
                     {
                       echo '4-15 character please';
                       exit();
                     }
                     if(is_numeric($tag[0]))
                     {
                        echo 'First character must be  leter';
                        exit();
                     }
                     if($num>0)
                     {
                     	echo $tag.' is alrady taken.';
                     	exit();
                     }
                     else
                     {
                     	echo $tag.' is OK.';
                     	exit();
                     }
			}
			catch(Exception $e)
			{
			   $error_message=$e->getMessage();
			}
		}
?>