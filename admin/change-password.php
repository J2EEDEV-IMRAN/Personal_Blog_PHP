<?ob_start();session_start(); ?><!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
<?php
if($_SESSION['name']!='admin')
{
header('location: login.php');
}
include('../config.php');
?>
      <?           //insert part of category

          if(isset($_POST['form1']))
          {
              try{
                if(empty($_POST['old']))
                  {
                    throw new Exception("Old password field can not be empty !");
                    
                  }
                   if(empty($_POST['new1']))
                  {
                    throw new Exception("New password field can not be empty !");
                    
                  }
                   if(empty($_POST['new2']))
                  {
                    throw new Exception("Confirm password field can not be empty !");
                    
                  }

                $statement=$db->prepare('SELECT * FROM tbl_login WHERE id=1 ');
                $statement->execute();
                $result=$statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) 
                {
                  $old=md5($_POST['old']);

                  if($old!=$row['password'])
                  {
                        throw new Exception("Old password is wrong !");
                        
                  }
               
                }
                if($_POST['new1']!=$_POST['new2'])
                {
                  throw new Exception("New password & confirm password does not match");
                  
                }
                $final_password=md5($_POST['new1']);

                $statement=$db->prepare('UPDATE tbl_login SET password=? WHERE id=1');
                $statement->execute(array($final_password));

                $success_message='Password has been updated successfully.';

              }
              catch(Exception $e)
              {
                $error_message=$e->getMessage();
              }
          }
  ?>


       <? include 'header.php' ?>
            

                <h2>Add New Category</h2>
                <p>&nbsp;</p>
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
                
             <form action="" method="post">
                
                <table class="tbl1">
                    <tr>
                        <td>Old Password :<td>
                    </tr>

                    <tr>
                        <td><input class="short" type="password" name="old" id="old"></td>
                    </tr>
                     <tr>
                        <td style="padding-top:10px;">New Password :<td>
                    </tr>

                    <tr>
                        <td><input class="short" type="password" name="new1" id="new1"></td>
                    </tr>
                     <tr>
                        <td style="padding-top:10px;">Confirm Password :<td>
                    </tr>

                    <tr>
                        <td><input class="short" type="password" name="new2" id="new2"></td>
                    </tr>

                    <tr>
                        
                        <td><input type="submit" value="Save" name="form1" ></td><!--id="form1"-->
                    </tr>

                </table>

           </form>
           <div id="mess"></div>
      <? include 'footer.php'?>