<?  ob_start();session_start(); ?> <!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
      <?php 
   
      if($_SESSION['name']!='admin')
      {
        header('location: login.php');
      }
      include('../config.php');
      ?>
       <? include 'header.php' ?>
       

           <h2>View All Post</h2>

           <table class="tbl2" width="100%">

            <tr>
                <th width="3%">Serial</th>
                <th width="72%">Title</th>
                <th width="25%">Action</th>
            </tr>


         <?
         $i=0;
         $statement=$db->prepare('SELECT * FROM tbl_post ORDER BY post_id DESC');
         $statement->execute(array());
         $result=$statement->fetchAll(PDO::FETCH_ASSOC);
         foreach($result as $row) 
         {  
         $i++;
         ?>

            <tr>
                <td><?echo $i;?></td>
                <td><?echo $row['post_title'];?></td>
                <td><a class="fancybox" href="#inline<?echo $i;?>">View</a>

                  <div id="inline<?echo $i;?>" style="  display: none;width: 700px; background: #d9dbd8;padding: 50px;" >
                    <h2>Edit Data</h2>
                    <p id="post" style="padding-bottom: 10px;">
                        <form action="#" method="post">
                          <table id="tbl3">
                            <tr>
                              <td><b>Title</b></td>
                            </tr>

                             <tr>
                              <td><?echo $row['post_title'];?></td>
                            </tr>
                               <tr>
                              <td><b>Description</b></td>
                            </tr>
                          
                              <tr>
                              <td>
                                <?echo $row['post_description'];?>
                              </td>
                              </tr>

                            <tr>
                              <td><b>Featured Image</b></td>
                            </tr>

                            
                                <tr> 
                              <td><img style="width:550px;" src="../upload/<?echo $row['post_image'];?>" alt=""></td>
                            </tr>

                           

                                <tr>
                              <td><b>Category</b></td>
                            </tr>

                             <tr>
                              <td><?
                               $statement1=$db->prepare('SELECT * FROM tbl_category WHERE cat_id=?');
                               $statement1->execute(array($row['cat_id']));
                               $result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
                               foreach ($result1 as $row1) 
                               {
                                 echo $row1['cat_name'];
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
                                   $arr=explode(',', $row['tag_id']);
                                   $arr_count=count(explode(',', $row['tag_id']));
                                   for($j=0;$j<$arr_count;$j++)
                                       {
                                        $statement1=$db->prepare('SELECT * FROM tbl_tag WHERE tag_id=?');
                                        $statement1->execute(array($arr[$j]));
                                        $result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1)
                                           {
                                            $arr[$k]=$row1['tag_name'];
                                           }
                                         $k++;
                                        
                                       }
                                    $tag_names=implode(',', $arr);
                                    echo $tag_names;
                                ?>
                            </td>
                            </tr>

                           
                              <tr>
                              <td><input  type="submit" value="Update"></td>
                            </tr>
                         

                          </table>
                        </form>
                  </p>
                  </div>
                   &nbsp;|&nbsp;
                  
                    <a href="edit-post.php?id=<?echo $row['post_id']?>" onclick="">Edit</a>

                  &nbsp;|&nbsp;

                  <!--html for confirm dialog box (start)-->
                      <div id="dialogoverlay"></div>
                      <div id="dialogbox">
                      <div id="dialogheader"></div>
                      <div id="dialogbody"></div>
                      <div id="dialogfooter"></div> 
                    </div>
                 <!--html for confirm dialog box (end)-->

                  <a href="#" onclick="Alert.render('Do you want to delete the data','<?echo $row['post_id']?>','javascript-post-delete.php');" >Delete</a></td>
            </tr>  
            <?
            }
            ?> 
           </table>
      <? include 'footer.php'?>