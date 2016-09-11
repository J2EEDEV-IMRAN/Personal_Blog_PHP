<?ob_start();
session_start();
if($_SESSION['name']!='admin')
{
	header('location: login.php');
}
include('../config.php');
?>
<?
 if(!isset($_REQUEST['id']))
 {
 	header('location: view-post.php');
  }
  else
  {
  	$id=$_REQUEST['id'];
  }
?>
<?
$statement=$db->prepare('SELECT * FROM tbl_post WHERE post_id=?');
$statement->execute(array($id));
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
     $post_image_path= '../upload/'.$row['post_image'];
     unlink($post_image_path);	
}
$statement=$db->prepare('DELETE FROM tbl_post WHERE post_id=?');
$statement->execute(array($id));

header('location: view-post.php');


?>