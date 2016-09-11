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
                if(empty($_POST['cat_name']))
                  {
                    throw new Exception("Category name can not be empty !");
                    
                  }

                $statement=$db->prepare('SELECT * FROM tbl_category WHERE cat_name=? ');
                $statement->execute(array($_POST['cat_name']));

                $num=$statement->rowCount();
                if($num>0)
                  {
                    throw new Exception("Category name already exist.");
                    
                  }

                $statement=$db->prepare('INSERT INTO tbl_category  (cat_name) VALUE(?) ');
                $statement->execute(array($_POST['cat_name']));

                $success_message='Category name has been inserted successfully.';

              }
              catch(Exception $e)
              {
                $error_message=$e->getMessage();
              }
          }


                    //update part of category from table edit button


           if(isset($_POST['form2']))
          {
              try{
                if(empty($_POST['cat_name']))
                  {
                    throw new Exception("Category name can not be empty !");
                    
                  }

                $statement=$db->prepare('UPDATE tbl_category  SET cat_name=? WHERE cat_id=?');
                $statement->execute(array($_POST['cat_name'],$_POST['hdn']));

                $success_message1='Category name has been Updated successfully.';

              }
              catch(Exception $e)
              {
                $error_message1=$e->getMessage();
              }
          }

          //delete part of category from table edit button 

         if(isset($_REQUEST['id']))
         {
          $id=trim(preg_replace('#[^0-9]#i', '', $_REQUEST['id']));
          $statement=$db->prepare("DELETE FROM tbl_category WHERE cat_id=? ") or die('there is an error');
          $statement->execute(array($id));
        $success_message2='Category name hasbeen deleted successfully';
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
                        <td>Category Name :<td>
                    </tr>

                    <tr>
                        <td><input class="short" type="text" name="cat_name" id="cat_name" onkeyup="check_category_name('cat_name','e_category');" onblur="check_category_name_blur();"onclick="check_category_name_click();"><span id="e_category" ></span></td>
                    </tr>

                    <tr>
                        
                        <td><input type="submit" value="Save" name="form1" ></td><!--id="form1"-->
                    </tr>

                </table>

           </form>

           <h2>View All Categories</h2>
           <p>&nbsp;</p>
               <?
                  if(isset($error_message1))
                  {
                    echo '<div class="error">'.$error_message1.'</div>';
                  }
                    if(isset($success_message1))
                  {
                    echo '<div class="success">'.$success_message1.'</div>';
                  }
                       if(isset($success_message2))
                  {
                    echo '<div class="success">'.$success_message2.'</div>';
                  }
                ?>

           <table class="tbl2" width="100%">

            <tr>
                <th width="3%">Serial</th>
                <th width="82%">Category Name</th>
                <th width="15%">Action</th>
            </tr>

            <?
            $i=0;
             $statement=$db->prepare('SELECT * FROM tbl_category ORDER BY cat_name ASC');
             $statement->execute();
             $result=$statement->fetchAll(PDO::FETCH_ASSOC);
             
             foreach ($result as $row) {
                  $i++;
            ?>

            <tr>
                <td> <? echo $i; ?></td>
                <td> <? echo $row['cat_name']; ?> </td>
                <td><a class="fancybox" href="#inline<? echo $i; ?>" >Edit</a>

                  <div id="inline<? echo $i; ?>" style="  display: none;width: 700px; background: #d9dbd8;padding: 50px;">
                    <h2>Edit Data</h2>
                    <p style="padding-bottom: 10px;">
                        <form action="#" method="post">
                          <input type="hidden" name="hdn" value="<? echo $row['cat_id'];?>">
                          <table>
                            <tr>
                              <td style="color:#000;">Category Name :</td>
                            </tr>

                             <tr>
                              <td><input class="short" type="text" name="cat_name" value="<? echo $row['cat_name']; ?>"></td>
                            </tr>

                             <tr>
                              <td><input  type="submit" value="Update" name="form2"></td>
                            </tr>
                            </table>
                        </form>
                      </p>
                  </div>

                  &nbsp;|&nbsp;

                  <!--html for confirm dialog box (start)-->
                      <div id="dialogoverlay"></div>
                    <div id="dialogbox">
                      <div id="dialogheader"></div>
                      <div id="dialogbody"></div>
                      <div id="dialogfooter"></div> 
                    </div>
                 <!--html for confirm dialog box (end)-->

                  <a onclick="Alert.render('Do you want to delete the data','<?echo $row['cat_id']?>','manage-category.php');" href="#" >Delete</a></td>
                  </tr>
              <? 

               }

              ?>

       
           </table>
           <div id="mess"></div>
      <? include 'footer.php'?>