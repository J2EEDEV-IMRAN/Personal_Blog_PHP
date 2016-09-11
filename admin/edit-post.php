<?  ob_start();session_start(); ?> <!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
<?php
  
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

         if(isset($_POST['form1']))
         {

            try
            {
               
              if(empty($_POST['post_title']))
              {
                throw new Exception('Post title can not be empty !');
                
              }
              if(empty($_POST['post_description']))
              {
                throw new Exception('Post description can not be empty !');
                
              }
              if(empty($_POST['cat_id']))
              {
                throw new Exception('Category name can not be empty !');
                
              }
              if(empty($_POST['tag_id']))
              {
                throw new Exception('Tag name can not be empty !');  
              }


              $tag_id=$_POST['tag_id'];
              $i=0;
              if (is_array($tag_id)) 
              {
                foreach ($tag_id as $key => $val) 
                {
                  $arr[$i]=$val;
                  $i++;
                }
              }
              $tag_ids=implode(',', $arr);

                  //echo $_POST['post_title'];
                  // echo $_POST['post_description'];
                   //echo $_POST['cat_id'].'<br>';
                   //echo $_POST['tag_id'];
                  //echo $tag_ids;

              //checking image is selected or not if not selected update  the tbl_post without the updating the image, if selected update the table with image name ane remove the previous one

              if(empty($_FILES['post_image']['name']))
              {
                
              $statement=$db->prepare('UPDATE tbl_post SET post_title=?,post_description=?,cat_id=?,tag_id=? WHERE post_id=?');
              $statement->execute(array($_POST['post_title'],$_POST['post_description'],$_POST['cat_id'],$tag_ids,$id));

              }
              else
              {
                   // using that value to make a name of that image
              $up_file_name=$_FILES['post_image']['name'];
              $file_basename=substr($up_file_name, 0,stripos( $up_file_name,'.'));
              $file_extention=strtolower(substr($up_file_name, stripos($up_file_name, '.')));
              $file=$id.$file_extention;
               if($file_extention!='.jpg' && $file_extention!='.png' && $file_extention!='.gif')
              {
                throw new Exception("only .jpg .jpeg .png .gif formet images are allowed to upload");
              }
                  //delting image from directory with same name and replacing with new one
              $statement=$db->prepare('SELECT * FROM tbl_post WHERE post_id=?');
              $statement->execute(array($id));
              $result=$statement->fetchAll(PDO::FETCH_ASSOC);
              foreach ($result as $row) 
              {
                $real_path='../upload/'.$row['post_image'];
                unlink($real_path);
              }
               move_uploaded_file($_FILES['post_image']['tmp_name'],'../upload/'.$file);

                  $statement=$db->prepare('UPDATE tbl_post SET post_title=?,post_description=?,post_image=?,cat_id=?,tag_id=? WHERE post_id=?');
                 $statement->execute(array($_POST['post_title'],$_POST['post_description'],$file,$_POST['cat_id'],$tag_ids,$id));
              }

              $success_message='Post is updated succesfully.';

            }
            catch(Exception $e)
            {
                 $error_message=$e->getMessage();
            }
         }

        ?>


        <?
         $statement=$db->prepare('SELECT * FROM tbl_post WHERE post_id=?');
          $statement->execute(array($id));
          $result=$statement->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $row)  
          {
            $post_id=$row['post_id'];
            $post_title=$row['post_title'];
             $post_description=$row['post_description'];
             $post_image=$row['post_image'];
             $cat_id=$row['cat_id'];
             $tag_id=$row['tag_id'];
          }
      ?>
       <? include 'header.php' ?>
            <form action="" method="post" enctype="multipart/form-data">           <!--eikhane (action="edit-post?id=<?//echo $id;?>")  ermadhome o amra id er man request e patha te pari -->
                                              <input type="hidden" name="id" value="<? echo $post_id; ?>"> <!--important er madhome post id pathano hoche page jokhon update korbo tokhon jodi post id na pathai tahole post id man pabe na -->
                <h2>Edit Post</h2>
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
                
                <table class="tbl1">
                    <tr>
                        <td><b>Title :</b><td>
                    </tr>

                    <tr>
                        <td><input class="long" type="text" name="post_title" value="<?echo $post_title;?>"></td>
                    </tr>

                    <tr>
                        <td><b>Description :</b></td>
                    </tr>

                           <tr>
                              <td>
                                <textarea name="post_description" rows="10" cols="60">
                                 <?
                                    echo $post_description;
                                 ?>
                                </textarea>

                                <script type="text/javascript">
                                    if ( typeof CKEDITOR == 'undefined' )
                                    {
                                      document.write(
                                        '<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
                                        'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
                                        'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
                                        'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
                                        'value (line 32).' ) ;
                                    }
                                    else
                                    {
                                      var editor = CKEDITOR.replace( 'post_description' );
                                      //editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' );
                                    }
                                </script>

                              </td>
                          </tr>

                              <tr style="margin-bottom:10px;">
                            <td><b>Preview Image :</b></td>
                          </tr>

                    </tr>


                        <tr style="margin-bottom:10px;">
                      <td ><img style="width:550px;" src="../upload/<? echo $post_image; ?>" alt="" ></td>

                    </tr>

                    <tr>
                      <td><b>Image :</b></td>
                    </tr>

                    </tr>
                        <tr style="margin-bottom:10px;">
                      <td><input type="file" name="post_image"></td>
                    </tr>

                    <tr>
                      <td><b>Preview Catecory :</b></td>
                    </tr>

                    </tr>
                        <tr style="margin-bottom:10px;">
                      <td style="color:#3d9ccd;">
              <?
              $statement1=$db->prepare('SELECT * FROM tbl_category WHERE cat_id=?');
              $statement1->execute(array($cat_id));
              $result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
              foreach ($result1 as $row) {
                echo $row['cat_name'];
              }
                        ?>
                      </td>
                    </tr>

                    <tr style="margin-bottom:10px;">
                      <td><b>Select a Category :</b></td>
                    </tr>

                     <tr>
                      <td>
                        <select name="cat_id">
                          <option value=""></option>
                          <?
                            $statement=$db->prepare('SELECT * FROM tbl_category ORDER BY cat_name ASC');
                            $statement->execute();
                            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) 
                            {
                              if($row['cat_id']==$cat_id)
                              {
                          ?>
                                <option value="<? echo $row['cat_id'];?>" selected><?echo $row['cat_name'];?></option>
                          <?
                              }
                            ?>
                            <option value="<? echo $row['cat_id'];?>"><?echo $row['cat_name'];?></option>
                          <?  
                            }
                          ?>
                        </select>
                      </td>
                    </tr>

                          <tr>
                      <td><b>Preview Tags :</b></td>
                    </tr>

                    </tr>
                        <tr>
                      <td style="color:#3d9ccd;">
             <?
             $k=0;
              $arr1=explode(',', $tag_id);
              $arr_count=count($arr1);
              for($j=0;$j<$arr_count;$j++)
              {
                $statement1=$db->prepare('SELECT * FROM tbl_tag WHERE tag_id=?');
                $statement1->execute(array($arr1[$j]));
                $result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result1 as $row1) {
                  $arr1[$k]=$row1['tag_name'];
                }
                $k++;
              }
              $tag_names=implode(', ', $arr1);
              echo $tag_names;
             ?>
                      </td>
                    </tr>

                      <tr>
                      <td style="padding-top:10px;">Select a Tag :</td>
                    </tr>

                     <tr>
                      <td>
                        <?
                          $statement=$db->prepare('SELECT * FROM tbl_tag ORDER BY tag_name ASC');
                            $statement->execute();
                            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach($result as $row) 
                            { 
                              $arr=explode(',', $tag_id);
                              $arr_count=count($arr);
                              $is_there=0;
                              for($i=0;$i<$arr_count;$i++)
                              {
                                if($arr[$i]==$row['tag_id'])
                                {
                                  $is_there=1;
                                  break;
                                }

                                }

                                if($is_there==1)
                                {
                                  ?>
                                  <input type="checkbox" name="tag_id[]" value="<?echo $row['tag_id'];?>" checked>&nbsp;<?echo $row['tag_name'];?><br>
                                  <?
                                }
                                else
                                {
                                  ?>
                                  <input type="checkbox" name="tag_id[]" value="<?echo $row['tag_id'];?>">&nbsp;<?echo $row['tag_name'];?><br>
                                  <?
                                }
                              }
                        ?>
                      </td>
                    </tr>

                       <tr>
                      <td><input type="submit" value="Update" name="form1"></td>
                    </tr>

                </table>

           </form>

        
      <? include 'footer.php'?>