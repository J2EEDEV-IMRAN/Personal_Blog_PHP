<?
 if(!isset($_REQUEST['id']))
 {
   header('location: index.php');
 }
 else
 {
   $id=$_REQUEST['id'];
 }
 include('config.php');
?>
<?
 if(isset($_POST['co_email']))
 {
 	try
 	{
 		if(empty($_POST['co_message']))
 		{
 			throw new Exception("Message field can not be empty !");
 			
 		}
 		if(empty($_POST['co_name']))
 		{
 			throw new Exception("Name field can not be empty !");
 			
 		}
 	    

		if(!(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['co_email']))) {
			throw new Exception("Please enter a valid email address.");
		}

		$co_date=date('Y-m-d');
         $post_id=$_POST['hdn'];
         $active=0;
           $statement=$db->prepare('INSERT INTO tbl_comment (co_name,co_email,co_url,co_message,co_date,post_id,active) VALUES(?,?,?,?,?,?,?)');
           $statement->execute(array($_POST['co_name'],$_POST['co_email'],$_POST['co_url'],$_POST['co_message'],$co_date,$post_id,$active));
		$success_message='Your comment has been sent.';

 	}
 	catch(Exception $e)
 	{
 		$error_message=$e->getMessage();
 	}
 }
?>

<?include('header.php');?>

<?
          $statement=$db->prepare('SELECT * FROM tbl_post WHERE post_id=?');
          $statement->execute(array($id));
          $result=$statement->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $row)
           {

?>

		<div class="post">
			<h2><?echo $row['post_title']?></h2>
			<div>
			<span class="date">
				<?
				$post_date =$row['post_date'];
				$day=substr($post_date,8,2);
				$month=substr($post_date,5,2);
				$year=substr($post_date,0,4);
				if($month='01'){$month='Jan';}
				if($month='02'){$month='Feb';}
				if($month='03'){$month='Mar';}
				if($month='04'){$month='Apr';}
				if($month='05'){$month='May';}
				if($month='06'){$month='Jun';}
				if($month='07'){$month='Jul';}
				if($month='08'){$month='Aug';}
				if($month='09'){$month='Sep';}
				if($month='10'){$month='Oct';}
				if($month='11'){$month='Nov';}
				if($month='12'){$month='Dec';}
				echo $day.' '.$month.' '.$year;
				?>
			</span>
			<span class="categories">
				in:&nbsp;
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
                    $tag_names=implode(', ', $arr);
                    echo $tag_names;
                 
                   ?>
			</span></div>
			<div class="description">
			          
			<p>

			   <!--fancybox-->
            <div class="gal">
            
            <a class="fancybox" rel="group" href="upload/<?echo $row['post_image'];?>" title="Exciting Title!"><img src="upload/<?echo $row['post_image'];?>" alt="" width="200" height=></a>
		
           </div>
       <!--/fancy box-->

			<div style="clear:both;"></div>
			<?php echo $row['post_description']; ?>
			</p>
			     <div style="clear:both;"></div>
				 <?echo $row['post_description'];?> 
			</div>
		  </div>


		<?

        }
          
		?>

          
		   <div id="comments">
			<img src="images/title3.gif" alt="" width="216" height="39" /><br />
			<?
               $statement=$db->prepare('SELECT * FROM tbl_comment WHERE active=1 AND post_id=? ORDER BY co_id DESC');
                $statement->execute(array($id));
                $result=$statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row)
                   {

			?>																																																																																																																																																																																																																																																															<div class="inner_copy"><a href="http://www.bestfreetemplates.org/">free templates</a><a href="http://www.bannermoz.com/">banner templates</a></div>
			<div class="comment">
				<div class="avatar">
					<?
                        if(md5($row['co_email']))
                        {
                        ?>
                         <img src="images/imran.JPG" alt="" width="80" height="80">           
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
                
					<span><?echo $row['co_name']?></span><br />
					<?
					$month=substr($row['co_date'], 5,2);
					$day=substr($row['co_date'], 8,2);
					$year=substr($row['co_date'], 0,4);
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
				<p><?echo $row['co_message']?> </p>
			</div>
			<?
		    }
			?>
			
			<div id="add">
				<img src="images/title4.gif" alt="" width="216" height="47" class="title" /><br />
				<?
           if(isset($error_message))
           {
               echo '<div class="success">'.$error_message.'</div>';
           }
           if (isset($success_message)) {
           	 echo '<div class="error">'.$success_message.'</div>';
           }
				?>
				<p>&nbsp;</>
				<div class="avatar">
					<img src="images/avatar2.gif" alt="" width="80" height="80" /><br />
					<span>Name User</span><br />
					April 12th
				</div>
				<div class="form">
					<form action="#" method="post">
						<input type="hidden" name="hdn" value="<? echo $id;?>">
						<textarea name="co_message" placeholder="Your Message..."></textarea><br/>
						<input type="text" name="co_name" value="" placeholder="Name" /><br />
						<input type="text" name="co_email" value="" placeholder="E-mail"/><br />
						<input type="text" name="co_url" value="" placeholder="URL(Optional)" /><br/>
						<input type="image" src="images/button.gif"  name="">
						
					</form>
				</div>
			</div>
		</div>
		<?include('footer.php');?>