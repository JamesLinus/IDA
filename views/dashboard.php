<div class='container'>
	<div class="col-md-7 col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Welcome <? echo $firstname;?> <?echo $lastname; ?> to the PBMS Dashboard</div>			
			<div class="panel-body">
				<?php
					IF (isset($_GET["page"]))
						$page = $_GET["page"];
					else
						$page = "main";
						
					$con = mysqli_connect($dbhost, $dbuser, $dbpass);
					mysqli_select_db($con,  $dbsel);
					
					// Select all entries from the menu table
					$result=mysqli_query($con, "SELECT * FROM dashboard WHERE permission <= '" . $access_level . "' AND page = '". $page ."'ORDER BY sort ");
					// Create a multidimensional array to contain a list of items and parents
					$menu = array(
						'items' => array(),
						'parents' => array()
					);
					// Builds the array lists with data from the menu table
					while ($items = mysqli_fetch_assoc($result))
					{
						// Creates entry into items array with current menu item id ie. $menu['items'][1]
						$menu['items'][$items['dash_id']] = $items;
						// Creates entry into parents array. Parents array contains a list of all items with children
						$menu['parents'][$items['parent']][] = $items['dash_id'];
					}

					echo buildDash(0, $menu);
				?>	
			</div>
		</div>
	</div>
	<div class="col-md-4 col-md-offset-1 visible-md visible-lg">
		<div class="panel panel-primary">
			<div class="panel-heading" style="text-align:center"><span class="glyphicon glyphicon-user"></span> User Info</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<!--<dt>User ID:</dt>
							<dd><?php echo $userid?></dd>-->
					<dt>Current Fiscal Year:</dt>
						<dd><?echo $fy ?></dd>
					<dt>Role:</dt> 
						<dd><? echo $user_role?></dd>
					<!--<dt><span class="subtitle">Role ID:</dt> 
						<dd><? echo $rolelvl?></dd>-->
					<dt>Username:</dt>
						<dd><?echo $username?></dd>
					<dt>First name:</dt> 
						<dd><?echo $firstname?></dd>
					<dt>Last name:</dt> 
						<dd><?echo $lastname?></dd>
					<dt>Assigned Branch:</dt> 
						<dd><?echo $assignedbranch?></dd>	
					<dt>Branch Head:</dt> 
						<dd></dd>
					<dt>Branch Phone:</dt> 
						<dd></dd>
				</dl>
			</div><!--End Panel Body-->
		</div><!--End contentright-->
	</div>
</div>