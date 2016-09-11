<?  ob_start();session_start(); ?><!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
<?php

if($_SESSION['name']!='admin')
{
header('location: login.php');
}
include('../config.php');
?>
<?
if(isset($_POST['form1']))
{
	try
	{
       if(empty($_POST['footer_text']))
       {
       	throw new Exception("Footer text can not be empty !");
       }
         $statement=$db->prepare('UPDATE tbl_footer SET description=? WHERE id=1');
         $statement->execute(array($_POST['footer_text']));

         $success_message='Footer text is updated successfuly.';
	}
	catch(Exception $e)
	{
      $errr_message=$e->getMessage();
	}
}
?>

	<?
         $statement=$db->prepare('SELECT * FROM tbl_footer');
         $statement->execute();
         $result=$statement->fetchAll(PDO::FETCH_ASSOC);
         foreach ($result as $row) 
         {
               $description=$_POST['description'];
         }
    	?>
       <? include 'header.php' ?>
            <form action="" method="post">

		        <h2>Change Footer Text</h2>
		        <P>&nbsp;</P>
		        <?
		         if(isset($error_message))
                  {
                    echo '<div class="error">'.$error_message.'</div>';
                  }
                 if(isset($success_message))
                  {
                    echo '<div class="success">'.$success_message.'</div>';
                  }
		        ?>
		        
		        <table class="tbl1">
		        
		        	<tr>
		        		<td>Footer Text :<td>
		        	</tr>
    	

		        	<tr>
		        		<td><input class="medium" type="text" name="footer_text" value="<? echo $row['description']; ?>"></td>
		        	</tr>


		        	<tr>
		        		
		        		<td><input type="submit" value="Save" name="form1"></td>
		        	</tr>

		        </table>
           </form>
      <? include 'footer.php'?>