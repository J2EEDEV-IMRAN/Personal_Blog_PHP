</div>
		<div id="sidebar">
		    <div id="search">
				<input type="text" value="Search"> <a href="#"><img src="images/go.gif" alt="" width="26" height="26" /></a>																																																																																																																																																																																																																																																						<div class="inner_copy"><a href="http://www.bestfreetemplates.info/flash.php">free flash templates</a><a href="http://www.beautifullife.info/web-design/15-best-free-website-builders/">best free web builders</a></div>
			</div>
			<div class="list">
				<img src="images/title1.gif" alt="" width="186" height="36" />


				<ul>
					 <?
				      $statement=$db->prepare('SELECT * FROM tbl_category ORDER BY cat_name ASC');
				      $statement->execute(array());
				      $result=$statement->fetchAll(PDO::FETCH_ASSOC);
				      foreach ($result as $row)
				       {
				       	?>
                       <li><a href="category.php?id=<?echo $row['cat_id']?>"><?echo $row['cat_name'];?></a></li>

				       <?
				        }
				       ?>
				</ul>


				<img src="images/title2.gif" alt="" width="180" height="34" />
				

					<?
					$j=0;
                      $statement=$db->prepare('SELECT DISTINCT(post_date) FROM tbl_post ORDER BY post_date DESC');
				      $statement->execute(array());
				      $result=$statement->fetchAll(PDO::FETCH_ASSOC);
				      foreach ($result as $row)
				       {
				      	 $ym=substr($row['post_date'],0,7);
				      	 $arr_date[$j]=$ym;
				      	 $j++;
				      }
				      $unique_date=array_unique($arr_date);
				      $implod_date=implode(',', $unique_date);

				      $explode_date=explode(',', $implod_date);
				      $explode_date_count=count($explode_date);
				      ?>

                        <ul>

				      <?
				      for($i=0;$i<$explode_date_count;$i++)
				       {
                         

				      	$year=substr($explode_date[$i],0,4 );
				      	$month=substr($explode_date[$i], 5,2);

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

							?>
						     <li><a href="archive.php?date=<? echo $explode_date[$i]; ?>"><?echo $month.' '.$year; ?></a></li>
                            
							<?
							  }
					          ?>
					
			       
				</ul>
			</div>
		</div>
	</div>
	<div id="footer">
		<p>
			<?
          $statement=$db->prepare('SELECT * FROM tbl_footer WHERE id=1');
          $statement->execute(array());
          $result=$statement->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $row)
           {
          	echo $row['description'];
          }
          ?>
		</p>																																																																		<div class="inner_copy"><a href="http://www.greatdirectories.org/offer.html">buy links with high pr</a><a href="http://www.bestfreetemplates.org/">free templates</a></div>
	</div>
       <!-- Grab Google CDN's jQuery, fall back to local if offline -->
  		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  		<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

		<!-- FancyBox -->
		<script src="fancybox1/js/fancybox/jquery.fancybox.js"></script>
		<script src="fancybox1/js/fancybox/jquery.fancybox-buttons.js"></script>
		<script src="fancybox1/js/fancybox/jquery.fancybox-thumbs.js"></script>
        <script src="fancybox1/js/fancybox/jquery.easing-1.3.pack.js"></script>
		<script src="fancybox1/js/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
        
      <!--eikhane fancy box er jquery er code chilo-->
</body>
</html>
