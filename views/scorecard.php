<?php
	if($assignedbranch == 'IDA National' || $rolelvl == 1)
		$type = 'national';
	else
		$type = 'branch';

?>
<div class='row well'>
	<div class='col-md-4 col-sm-4'>
		<form method="post" action="<?php $_PHP_SELF ?>">
			<input type="hidden" value="<? echo $user_role;?>" name="role">
				<table width="400" border="1" cellspacing="1" cellpadding="2">
					<?php if ($access_level >= 2){ ?>
						<tr>
							<td>
								<div class='formgroup'>
									<label for='branch'>Branch</label>
									<?php	 branch_dropdown($dbhost, $dbuser, $dbpass);
									?>
								</div>
							</td>
						</tr>
					<?php }else{
						echo "<input type='hidden' value='".$branchID."' name='branch' id='branch'>";}
					?>
				<tr>
					<td>
						<div class='formgroup'>
							<label for='focarea'>Focus Area</label>
                       		<?php focarea_dropdown($dbhost, $dbuser, $dbpass, $type); ?>
                       	</div>
                    </td>
				</tr>				
			</table>
		</form>
	</div>
	<button class='pull-right btn btn-primary disabled' title='feature coming soon'>Printer Friendly</button>
</div>			
<div class ="container-fluid">
	<span class='spinner' style = 'width:100%; text-align:center; display:none'><img src='images/loading.gif'/></span>
	<div class ="container-fluid" id="txtHint"><b></b>
	<h1>Select a Focus Area from the Drop down</h1>
	</div>
</div>