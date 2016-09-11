<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Blog Design</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
	
</body>
</html>


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

            <tr>
              <?
                 $i=0;
                 $statement=$db->prepare('SELECT * FROM tbl_post ORDER BY post_id DESC');
                 $statement->execute(array());
                 $result=$statement->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($result as $row) {  
                 $i++;

              ?>
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
                              <td><?echo $row['post_title']?></td>
                            </tr>
                               <tr>
                              <td><b>Description</b></td>
                            </tr>
                          
                              <tr>

                              <td><?echo $row['post_title']?></td>
                            </tr>

                            <tr>
                              <td><b>Featured Image</b></td>
                            </tr>
                                <tr> 
                              <td><img src="../upload/<?echo $row['post_image']?>" alt=""></td>
                            </tr>

                                <tr>
                              <td><b>Category</b></td>
                            </tr>

                             <tr>
                              <td><?
                               $statement1=$db->prepare('SELECT * FROM tbl_categoty WHERE cat_id=?');
                               $statement1->execute(array($row['cat_id']));
                               $result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
                               foreach ($result1 as $row1) {
                                 echo $row1['cat_name'];
                               }
                              ?></td>
                            </tr>

                                <tr>
                              <td><b>Tag</b></td>
                            </tr>

                             <tr>
                              <td>Bangladesh,Computer</td>
                            </tr>

                           
                              <tr>
                              <td><input  type="submit" value="Update"></td>
                            </tr>
                         

                          </table>
                        </form>
                  </p>
                  </div>
                   &nbsp;|&nbsp;
                  
                    <a href="edit-post.php" onclick="">Edit</a>

                  &nbsp;|&nbsp;

                  <a href="#" onclick="confirmDelete();">Delete</a></td>
            </tr>
            <?
             }
            ?>

           </table>
      <? include 'footer.php'?>