<?ob_start();session_start(); ?>   <!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
      <?php
     
      if($_SESSION['name']!='admin')
      {
        header('location: login.php');
      }
      require_once('../config.php');
?>


<?

if(isset($_POST['category'])){
	$category=trim(preg_replace('#[^a-z]#i', '', $_POST['category']));
	$num=0;
		
			try{
					$statement=$db->prepare("SELECT cat_name FROM tbl_category WHERE cat_name LIKE '%".$category."%'") or die('there is an error');
					$statement->execute(array($category));
                     $num=$statement->rowCount();
                     if(strlen($category)<4)
                     {
                       echo '4-15 character please';
                       exit();
                     }
                     if(is_numeric($category[0]))
                     {
                        echo 'First character must be  leter';
                        exit();
                     }
                     if($num>0)
                     {
                     	echo $category.' is alrady taken.';
                     	exit();
                     }
                     else
                     {
                     	echo $category.' is OK.';
                     	exit();
                     }
			}
			catch(Exception $e)
			{
			   $error_message=$e->getMessage();
			}
		}
?>