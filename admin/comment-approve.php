<?ob_start();session_start(); ?><!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
<?php
if($_SESSION['name']!='admin')
{
header('location: login.php');
}
include('../config.php');
?>

<?

 if (isset($_REQUEST['id'])) 
 {
   try{
         $statement=$db->prepare('UPDATE tbl_comment  SET active=1 WHERE co_id=?');
          $statement->execute(array($_REQUEST['id']));
          $success_message='Comment is approved. Thank you';
        }
        catch(Exception $e)
        {
          $error_message=$e->getMessage();
        }
 }
?>
      

       <? include 'header.php' ?>

        <h2>All Un-approved Comments</h2>
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

           <table class="tbl2" width="100%">

            <tr>
                <th width="">Serial</th>
                <th width=""> Name</th>
                 <th width="">E-mail</th>
                <th width="">URL</th>
                <th width="">Post ID</th>
                <th width="">Action</th>
            </tr>
            
           
            <?
            $i=0;
             $statement=$db->prepare('SELECT * FROM tbl_comment WHERE active=0 ORDER BY co_id DESC');
             $statement->execute();
             $result=$statement->fetchAll(PDO::FETCH_ASSOC);
             
             foreach ($result as $row) {
                  $i++;
            ?>

                   <tr>
                      <td><?echo $i;?></td>
                      <td><?echo $row['co_name'];?></td>
                      <td><?echo $row['co_email'];?></td>
                      <td><?echo $row['co_url'];?></td>
                       <td><a class="fancybox" href="#inline<?echo $i;?>"><?echo $row['post_id'];?></a>


                      <div id="inline<?echo $i;?>" style="  display: none;width: 700px; background: #d9dbd8;padding: 50px;" >
                      <h2>View Post Details</h2>
                      <p id="post" style="padding-bottom: 10px;">
                        <?
                         $statement1=$db->prepare('SELECT * FROM tbl_post WHERE post_id=?');
                         $statement1->execute(array($row['post_id']));
                         $result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
                         foreach ($result1 as $row1) 
                         {

                        ?>
                            <table id="tbl3">
                              <tr>
                                <td><b>Title</b></td>
                              </tr>

                               <tr>
                                <td><?echo $row1['post_title'];?></td>
                              </tr>
                                 <tr>
                                <td><b>Description</b></td>
                              </tr>
                            
                                <tr>
                                <td>
                                  <?echo $row1['post_description'];?>
                                </td>
                                </tr>

                              <tr>
                                <td><b>Featured Image</b></td>
                              </tr>

                              
                                  <tr> 
                                <td><img style="width:550px;" src="../upload/<?echo $row1['post_image'];?>" alt=""></td>
                              </tr>

                             

                                  <tr>
                                <td><b>Category</b></td>
                              </tr>

                               <tr>
                                <td><?
                                 $statement2=$db->prepare('SELECT * FROM tbl_category WHERE cat_id=?');
                                 $statement2->execute(array($row1['cat_id']));
                                 $result2=$statement2->fetchAll(PDO::FETCH_ASSOC);
                                 foreach ($result2 as $row2) 
                                 {
                                   echo $row2['cat_name'];
                                 }
                                ?></td>
                              </tr>

                                  <tr>
                                <td><b>Tag</b></td>
                              </tr>

                               <tr>
                                <td>
                                  <?
                                    $k=0;
                                     $arr=explode(',', $row1['tag_id']);
                                     $arr_count=count(explode(',', $row1['tag_id']));
                                     for($j=0;$j<$arr_count;$j++)
                                         {
                                          $statement2=$db->prepare('SELECT * FROM tbl_tag WHERE tag_id=?');
                                          $statement2->execute(array($arr[$j]));
                                          $result2=$statement2->fetchAll(PDO::FETCH_ASSOC);
                                          foreach ($result2 as $row2)
                                             {
                                              $arr[$k]=$row2['tag_name'];
                                             }
                                           $k++;
                                          
                                         }
                                      $tag_names=implode(',', $arr);
                                      echo $tag_names;
                                  ?>
                            </td>
                            </tr>

                            <tr>
                              <td><?
                                  $statement2=$db->prepare('SELECT * FROM tbl_comment WHERE post_id=? ORDER BY post_id DESC');
                                  $statement2->execute(array($row1['post_id']));
                                  $result2=$statement2->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($result2 as $row2) 
                                  {
                                    ?>
                                      <div class="comment">
                                    <div class="avatar">
                                      <?
                                    if(md5($row2['co_email']))
                                    {
                                    ?>
                                     <img src="../images/imran.JPG" alt="" width="80" height="80">           
                                      <!--<img src="http://www.gravater.com/<?echo $gravatarmd5; ?>" alt="" width="80" height="80"/><br/>-->

                                    <?
                                    }
                                   else
                                   {
                                    ?>
                                        <img src="http://www.gravater.com/<?echo $gravatarmd5; ?>" alt="" width="80" height="80"/>
                                    <?
                                  }
                                    ?>
                
                                  <span><?echo $row2['co_name']?></span><br />
                                  <?
                                  $month=substr($row2['co_date'], 5,2);
                                  $day=substr($row2['co_date'], 8,2);
                                  $year=substr($row2['co_date'], 0,4);
                                    if($month=='01'){$month='January';}
                                    if($month=='02'){$month='February';}
                                    if($month=='03'){$month='March';}
                                    if($month=='04'){$month='April';}
                                    if($month=='05'){$month='May';}
                                    if($month=='06'){$month='June';}
                                    if($month=='07'){$month='July';}
                                    if($month=='08'){$month='August';}
                                    if($month=='09'){$month='September';}
                                    if($month=='10'){$month='October';}
                                    if($month=='11'){$month='November';}
                                    if($month=='12'){$month='December';}
                                    echo $month.' '.$day.' '.$year;
                                  ?>
                                </div>
                                <p style="position:relative; right: 100;"><?echo $row2['co_message']?> </p>
                              </div>
                                    <?
                                  }
                                ?>
                            </td>
                          </tr>

                          </table>
                          <?

                          }

                          ?>
                      </p>
                      </div>



                       </td>
                      <td><a href="comment-approve.php?id=<? echo $row['co_id'];?>">Approve</a></td>
                  </tr>

              <? 

               }

              ?>
                     
           </table>


             <h2>All Approved Comments</h2>

           <table class="tbl2" width="100%">

            <tr>
                <th width="">Serial</th>
                <th width=""> Name</th>
                 <th width="">E-mail</th>
                <th width="">URL</th>
                <th width="">Message</th>
                <th width="">Post ID</th>
            </tr>
            
           
            <?
            $i=0;
             $statement=$db->prepare('SELECT * FROM tbl_comment WHERE active=1 ORDER BY co_id DESC');
             $statement->execute();
             $result=$statement->fetchAll(PDO::FETCH_ASSOC);
             
             foreach ($result as $row) {
                  $i++;
            ?>

                   <tr>
                      <td><?echo $i;?></td>
                      <td><?echo $row['co_name'];?></td>
                      <td><?echo $row['co_email'];?></td>
                      <td><?echo $row['co_url'];?></td>
                      <td><?echo $row['co_message'];?></td>
                       <td><a class="fancybox" href="#inline<?echo $i;?>"><?echo $row['post_id'];?></a>


                      <div id="inline<?echo $i;?>" style="  display: none;width: 700px; background: #d9dbd8;padding: 50px;" >
                      <h2>View Post Details</h2>
                      <p id="post" style="padding-bottom: 10px;">
                        <?
                         $statement1=$db->prepare('SELECT * FROM tbl_post WHERE post_id=?');
                         $statement1->execute(array($row['post_id']));
                         $result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
                         foreach ($result1 as $row1) 
                         {

                        ?>
                            <table id="tbl3">
                              <tr>
                                <td><b>Title</b></td>
                              </tr>

                               <tr>
                                <td><?echo $row1['post_title'];?></td>
                              </tr>
                                 <tr>
                                <td><b>Description</b></td>
                              </tr>
                            
                                <tr>
                                <td>
                                  <?echo $row1['post_description'];?>
                                </td>
                                </tr>

                              <tr>
                                <td><b>Featured Image</b></td>
                              </tr>

                              
                                  <tr> 
                                <td><img style="width:550px;" src="../upload/<?echo $row1['post_image'];?>" alt=""></td>
                              </tr>

                             

                                  <tr>
                                <td><b>Category</b></td>
                              </tr>

                               <tr>
                                <td><?
                                 $statement2=$db->prepare('SELECT * FROM tbl_category WHERE cat_id=?');
                                 $statement2->execute(array($row1['cat_id']));
                                 $result2=$statement2->fetchAll(PDO::FETCH_ASSOC);
                                 foreach ($result2 as $row2) 
                                 {
                                   echo $row2['cat_name'];
                                 }
                                ?></td>
                              </tr>

                                  <tr>
                                <td><b>Tag</b></td>
                              </tr>

                               <tr>
                                <td>
                                  <?
                                    $k=0;
                                     $arr=explode(',', $row1['tag_id']);
                                     $arr_count=count(explode(',', $row1['tag_id']));
                                     for($j=0;$j<$arr_count;$j++)
                                         {
                                          $statement2=$db->prepare('SELECT * FROM tbl_tag WHERE tag_id=?');
                                          $statement2->execute(array($arr[$j]));
                                          $result2=$statement2->fetchAll(PDO::FETCH_ASSOC);
                                          foreach ($result2 as $row2)
                                             {
                                              $arr[$k]=$row2['tag_name'];
                                             }
                                           $k++;
                                          
                                         }
                                      $tag_names=implode(',', $arr);
                                      echo $tag_names;
                                  ?>
                            </td>
                            </tr>

                            <tr>
                              <td><?
                                  $statement2=$db->prepare('SELECT * FROM tbl_comment WHERE post_id=? ORDER BY post_id DESC');
                                  $statement2->execute(array($row1['post_id']));
                                  $result2=$statement2->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($result2 as $row2) 
                                  {
                                    ?>
                                      <div class="comment">
                                    <div class="avatar">
                                      <?
                                    if(md5($row2['co_email']))
                                    {
                                    ?>
                                     <img src="../images/imran.JPG" alt="" width="80" height="80">           
                                      <!--<img src="http://www.gravater.com/<?echo $gravatarmd5; ?>" alt="" width="80" height="80"/><br/>-->

                                    <?
                                    }
                                   else
                                   {
                                    ?>
                                        <img src="http://www.gravater.com/<?echo $gravatarmd5; ?>" alt="" width="80" height="80"/>
                                    <?
                                  }
                                    ?>
                
                                  <span><?echo $row2['co_name']?></span><br />
                                  <?
                                  $month=substr($row2['co_date'], 5,2);
                                  $day=substr($row2['co_date'], 8,2);
                                  $year=substr($row2['co_date'], 0,4);
                                    if($month=='01'){$month='January';}
                                    if($month=='02'){$month='February';}
                                    if($month=='03'){$month='March';}
                                    if($month=='04'){$month='April';}
                                    if($month=='05'){$month='May';}
                                    if($month=='06'){$month='June';}
                                    if($month=='07'){$month='July';}
                                    if($month=='08'){$month='August';}
                                    if($month=='09'){$month='September';}
                                    if($month=='10'){$month='October';}
                                    if($month=='11'){$month='November';}
                                    if($month=='12'){$month='December';}
                                    echo $month.' '.$day.' '.$year;
                                  ?>
                                </div>
                                <p style="position:relative; right: 100;"><?echo $row2['co_message']?> </p>
                              </div>
                                    <?
                                  }
                                ?>
                            </td>
                          </tr>

                          </table>
                          <?

                          }

                          ?>
                      </p>
                      </div>



                       </td>
                     
                  </tr>

              <? 

               }

              ?>
                     
           </table>

           <div id="mess"></div>
      <? include 'footer.php'?>