<?  ob_start();session_start(); ?> <!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
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
                  //echo $_POST['post_title'];
                 //echo $_POST['post_description'];
                 //echo $_POST['cat_id'].'<br>';
                 //echo $_POST['tag_id'];

              // tag part
                    $tag_id=$_POST['tag_id'];
                    $i=0;
                    if(is_array($tag_id))
                    {
                        foreach($tag_id as $key => $val) 
                        {
                          $arr[$i]=$val;
                  //echo $arr[$i];
                         $i++;
                        }
                  }
                  $tag_ids=implode(',', $arr);
                    //echo $tag_ids;
                  //time part
                    $post_date=date('Y-m-d');
                    $year=substr($post_date, 0,4);
                    $month=substr($post_date, 5,2);
                    $post_time_stamp=strtotime($post_date);
                    //echo $post_date.'<br>';
                    //echo $post_timestamp.'<br/>';

             $statement=$db->prepare("SHOW TABLE STATUS LIKE 'tbl_post'");//here this is importent for auto increment because when we delete a post this value may create problem in upload folder 
             $statement->execute();
             $result=$statement->fetchAll();
             foreach ($result as $row)
              {
              $new_id=$row[10];
               }


              $up_file_name=$_FILES['post_image']['name'];
              $file_basename=substr($up_file_name, 0,stripos( $up_file_name,'.'));    //strip name
              $file_extention=strtolower(substr($up_file_name, stripos( $up_file_name,'.'))); //strip extention
              $file=$new_id.$file_extention;
              if($file_extention!='.jpg' && $file_extention!='.png' && $file_extention!='.gif')
              {
                throw new Exception("only .jpg .jpeg .png .gif formet images are allowed to upload");
              }
               move_uploaded_file($_FILES['post_image']['tmp_name'],'../upload/'.$file);
               $statement=$db->prepare('INSERT INTO tbl_post  (post_title,post_description,post_image,cat_id,tag_id,post_date,year,month,post_time_stamp) VALUE(?,?,?,?,?,?,?,?,?) ');
               $statement->execute(array($_POST['post_title'],$_POST['post_description'],$file,$_POST['cat_id'],$tag_ids,$post_date,$year,$month,$post_time_stamp));

               
              $success_message='Post is inserted successfully.';
            }
            catch(Exception $e)
            {
              $error_message=$e->getMessage();
            }
          }

      ?>
       <? include 'header.php' ?>
            <form action="" method="post" enctype="multipart/form-data">

                <h2>Add New Post</h2>
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
                        <td><input class="long" type="text" name="post_title" value=""></td>
                    </tr>

                    <tr>
                        <td><b>Description :</b></td>
                    </tr>

                     <tr>
                        <td>
                          <textarea name="post_description" rows="10" cols="60"></textarea>

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
                                //editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' ); //amr lekha na
                              }
                          </script>

                        </td>
                    </tr>

                      <tr>
                              <td><b>Featured Image :</b></td>
                            </tr>

                            </tr>
                                <tr>
                              <td><input type="file" name="post_image"></td>
                            </tr>

                    <tr>
                      <td style="padding-top:10px; "><b>Select a Category :</b></td>
                    </tr>
          
                     <tr>
                      <td>
                        <select name="cat_id">
                          <option value="">Select..</option>
                <?
                 $statement=$db->prepare('SELECT * FROM tbl_category ORDER BY cat_name ASC'); 
                 $statement->execute();
                 $result=$statement->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($result as $row)
                 {
                ?>
                          <option value="<?echo $row['cat_id'];?>"><? echo $row['cat_name']; ?></option>
                <?
                 }
                ?>
                        </select>
                      </td>
                    </tr>
                      <tr>
                      <td style="padding-top:10px;"><b>Select a Tag :</b></td>
                    </tr>

                     <tr>
                      <td>
                  <?
                 $statement=$db->prepare('SELECT * FROM tbl_tag ORDER BY tag_name ASC'); 
                 $statement->execute();
                 $result=$statement->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($result as $row)
                 {
                  $i++;
                  ?>
                        <input type="checkbox" name="tag_id[]" value="<?echo $row['tag_id'];?>">&nbsp;<?echo $row['tag_name'];?><br>
                  <?
                 }
                  ?>
                   
                      </td>
                    </tr>

                       <tr>
                      <td><input type="submit" value="Save" name="form1"></td>
                    </tr>

                </table>

           </form>

        
      <? include 'footer.php'?>