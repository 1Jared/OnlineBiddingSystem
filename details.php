<?php
	session_start();
	require("functions.php");
	require("db.php");
	require("htmls.php");
	require("timekuni.php");
	headhtml();
	$duedate = "2011-10-11 00:00:00";
?>

  <div id="main_content"> 
    <div id="menu_tab">
      <div class="left_menu_corner"></div>
      <ul class="menu">
        <li><a href="home.php" class="nav2">Home</a></li>
        <li class="divider" ></li>
        <li><a href="prodcateg.php" class="nav1">Products</a></li>
        <li class="divider"></li>
        <li><a href="contact.php" class="nav2">About Us</a></li>
        <li class="divider"></li>
		<?php account(); ?>
<script type='text/javascript'>
	jQuery(document).ready( function() {
		jQuery('.nav3').hide();
		jQuery('.nav4').click( function() {
			jQuery('.nav3').toggle('fade');
		});
	});
	
</script>
		
      </ul>
      <div class="right_menu_corner"></div>
    </div>
    <!-- end of menu tab -->
    <div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
   	<div class="left_content"> 
      <div class="title_box">Categories</div>
      <ul class="left_menu"> 
     <?php
		categories();
		logform(); 
	?>
      <div class="title_box">Announcements</div>
      <div class="border_box">
        <input type="text" name="newsletter" class="newsletter_input" value="your email"/>
        <a href="http://all-free-download.com/free-website-templates/" class="join">join</a> </div>
      <div class="banner_adds"> <a href="#"><img src="images/bann2.jpg" alt="" border="0" /></a> </div>
    </div>
    <!-- end of left content -->
    <?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(E_ALL);
		$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
		$id = $_GET['id'];
		$query = mysqli_query($con,"SELECT * FROM products WHERE productid = '$id'") or die (mysqli_error());
		$row = mysqli_fetch_array($query);
	?>
    <div class="center_content">
      <div class="center_title_bar">Product Details</div>
      <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
           <div class="product_img_big">
				<a title='header=[Click to Bid] body=[&nbsp;] fade=[on]'><img src='administrator/images/products/<?php echo $row['prodimage'];?>' width='169' height='155' alt='' border='0' /></a>
				<div class='bid_border_box'>
					<div class='bid'>Click to Bid Now</div>
				</div>
				<div class='bid_border_box'>
					<div class='details'>Click to View Details</div>
				</div>
			</div>
			<script type='text/javascript'>
			jQuery(document).ready( function() {
		
				jQuery('.bid_box').hide();
				jQuery('.details').hide();
				
				jQuery('.details').click( function() {
					jQuery('.proddet').toggle('fade');
					jQuery('.bid').toggle('fade');
					jQuery('.bid_box').hide()
					jQuery('.details').hide();
				});
				jQuery('.bid').click( function() {
					jQuery('.details').toggle('fade');
					jQuery('.bid_box').toggle('fade');
					jQuery('.bid').hide();
					jQuery('.proddet').hide();
				});
			});
			</script>
			
			
			<div class="details_big_box">
				<div class='proddet'>
					<div class="product_title_big"><?php echo $row['prodname'];?></div><br />
					<div class="specificationss"> Description: <span class="blue"><?php echo $row['prodescription'];?></span><br /><br />
						Date Added: <span class="blue"><?php echo $row['dateposted'];?></span><br /><br />
						Item number: <span class="blue"><?php echo '0998'.$row['productid'].'';?></span><br /><br />
						Available to: <span class="blue">All</span><br /><br />
						Category: <span class="blue">
						<?php
							ini_set('display_errors',1);
							ini_set('display_startup_errors',1);
							error_reporting(E_ALL);
							$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
							$categid = $row['categoryid'];
							$categ = mysqli_query($con,"SELECT * FROM pcategories WHERE categoryid = '$categid'")or die(mysqli_error());
							$catega = mysqli_fetch_array($categ);
							echo $catega['categoryname'];
						?></span><br /><br />
					
					</div>
				</div>
				<div class='bid_box'>
				<?php
					ini_set('display_errors',1);
					ini_set('display_startup_errors',1);
					error_reporting(E_ALL);
					$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
							$id = $_GET['id'];
							$_SESSION['prodid'] = $id;
							$query = mysqli_query($con,"SELECT * FROM products WHERE productid = '$id'") or die (mysqli_error());
							$row = mysqli_fetch_array($query);
							$prodid = $row['productid'];
							$prodsbid = $row['startingbid'];
							$seller = $row['sellername'];
							
							//for displaying highest bid and no of bidders
							$query2 = mysqli_query($con,"SELECT * FROM bidreport WHERE productid = '$prodid'") or die (mysqli_error());
							$noofbidders = mysqli_num_rows($query2);
							
							$highbid = $prodsbid;
							while($highonthis = mysqli_fetch_array($query2)){
								$checkthis = $highonthis['bidamount'];
								if($checkthis > $highbid){
									$highbid = $checkthis;
								}
							}
							
							$highestbidder = mysqli_query($con,"SELECT * FROM bidreport WHERE bidamount = '$highbid'")or die(mysqli_error());
							$highestbiddera = mysqli_fetch_array($highestbidder);
							$hibidder = isset($highestbiddera['bidder']);
							
							if($_SESSION['logged']=='notactive'||$_SESSION['logged']=='guest'){
								echo"<span class='blue'><p> Only those who have an activated account can access to this and participate. Please Log-In or Register</p></br><h2>To Activate Account, Open the Database, Go to Member Table, Look for your 'userid' row and check 'Verification' row. Set the value from 'no' to 'yes'</h2></span>";
							}else{
							
							echo"</span>
								<br />
								&nbsp&nbsp Bids: <span class='blue'>";?><?php echo $noofbidders;?><?php echo"</span><br /><br />
								&nbsp&nbsp Highest Bid: <span class='blue'>Ksh";?><?php echo $highbid;?><?php echo"</span><br /><br />
								&nbsp&nbsp Highest Bidder: <span class='blue'>";?>
								<?php 
									ini_set('display_errors',1);
									ini_set('display_startup_errors',1);
									error_reporting(E_ALL);
									$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
								$name = mysqli_query($con,"SELECT * FROM member WHERE memberid = '$hibidder'")or die(mysqli_error());
								$namea = mysqli_fetch_array($name);
								echo isset($namea['userid']);?>
								<?php echo"</span><br /><br />
								&nbsp&nbsp Time Left to Bid: <span class='blue'>";?>
								<?php
								
								$duedate = $row['duedate'];
								$closedate = date_format(date_create($duedate), 'm/d/Y H:i:s');
								?>

								<script language="JavaScript">
								TargetDate = "<?php echo $closedate ?>";
								BackColor = "";
								ForeColor = "navy";
								CountActive = true;
								CountStepper = -1;
								LeadingZero = true;
								DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
								FinishMessage = "Bidding closed!";
								</script>
								<script language="JavaScript" src="js/countdown.js"></script>
								<?php echo'</span><br /><br />
									<form method = "post" action="bidconfirm.php?id='.$prodid.'" id="logins-form" class="logins-form">
										<input type = "hidden" value="'.$highbid.'" name="high">
										&nbsp&nbsp <strong>Ksh</strong><input type="text" name="bidamount">
										<input type="submit" value="Place Bid" name="submit">
									</form>
								&nbsp&nbsp <span class="blue"><strong>';
								echo "<span class='blue'>(Enter Price higher than Ksh".$highbid.")</span>";
								echo "<br />&nbsp&nbsp&nbsp&nbsp<span class='blue'> click <a rel='facebox' href='bidlog.php?id=".$prodid."'>here</a> to view Bidding Log</span>";
							}
					?>
				</div>
				
			</div>
			
        <div class="bottom_prod_box_big"></div>
      </div>
	  </div>
      
    </div>
    <!-- end of center content -->
    <!-- end of right content -->
  </div>
  <!-- end of main content -->
  <?php foothtml(); ?>
