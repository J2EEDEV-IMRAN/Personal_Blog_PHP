<?  ob_start();session_start(); ?>   <!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
      <?php
     
      if($_SESSION['name']!='admin')
      {
        header('location: login.php');
      }
      include('../config.php');
      ?>


      <?
                //insert part of tag
       if(isset($_POST['form1']))
       {


          try
          {
               if(empty($_POST['tag_name']))
               {
                throw new Exception("Tag name can not be empty !");
               }
                $num=0;
               $statement=$db->prepare('SELECT * FROM tbl_tag WHERE tag_name=?'); 
               $statement->execute(array($_POST['tag_name']));
               $num=$statement->rowCount();

               if($num>0)
               {
                throw new Exception("Tag name already exist.");
               }

                $statement=$db->prepare('INSERT INTO  tbl_tag (tag_name) VALUE(?)');
               $statement->execute(array($_POST['tag_name']));

               $success_message='Tag name has been inserted successfully.';
          }
          catch(Exception $e)
          {
               $error_message=$e->getMessage();
          }
       }

                    //insert part of tag
       if(isset($_POST['form2']))
       {
        try
        {
                 if(empty($_POST['tag_name']))
                  {
                    throw new Exception("Category name can not be empty !");
                    
                  }

                  $statement=$db->prepare('UPDATE tbl_tag SET tag_name=? WHERE tag_id=?');
                  $statement->execute(array($_POST['tag_name'],$_POST['hdn']));

                  $success_message1='Tag name has been updated successfully';
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
          $statement=$db->prepare("DELETE FROM tbl_tag WHERE tag_id=? ") or die('there is an error');
          $statement->execute(array($id));
        $success_message2='Tag name has been deleted successfully';
        }
      ?>
       <? include 'header.php' ?>
            

                <h2>Add New Tag</h2>
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
              <form action="#" method="post">
                    <table class="tbl1">
                        <tr>
                            <td>Tag Name :<td>
                        </tr>

                        <tr>
                             <td><input class="short" type="text" name="tag_name" id="tag_name" onkeyup="check_tag_name('tag_name','e_tag');" onblur="check_tag_name_blur();"onclick="check_tag_name_click();"><span id="e_tag" ></span></td>
                        </tr>

                        <tr>
                            
                            <td><input type="submit" value="Save" name="form1"></td>
                        </tr>

                    </table>

           </form>

           <h2>View All Tags</h2>
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
            ?>
           <table class="tbl2" width="100%">

            <tr>
                <th width="3%">Serial</th>
                <th width="82%">Tag Name</th>
                <th width="15%">Action</th>
            </tr>

            <?
            $i=0;
            $statement=$db->prepare('SELECT * FROM tbl_tag ORDER BY tag_name ASC');
            $statement->execute();
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
            $i++;  
            
            ?>

            <tr>
                <td> <? echo $i; ?> </td>
                <td><?echo $row['tag_name'];?></td>
                <td><a class="fancybox" href="#inline<? echo $i; ?>">Edit</a>

                  <div id="inline<? echo $i; ?>"  style="  display: none;width: 700px; background: #d9dbd8;padding: 50px;">
                    <h2>Edit Data</h2>
                    <p style="padding-bottom: 10px;">
                        <form action="#" method="post">
                          <input type="hidden" name="hdn" value="<?echo $row['tag_id'];?>" >
                          <table>
                            <tr>
                              <td style="color:#000;">Tag Name :</td>
                            </tr>

                             <tr>
                              <td><input class="short" type="text" name="tag_name" value="<?echo $row['tag_name'];?>"></td>
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

                   <a onclick="Alert.render('Do you want to delete the data','<?echo $row['tag_id']?>','manage-tags.php');" href="#" >Delete</a></td>
            </tr>

             <?
              }
             ?> 
           </table>
      <? include 'footer.php'?>