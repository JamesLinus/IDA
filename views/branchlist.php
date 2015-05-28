<div class="container-fluid">
    <div class='message'></div>
	<div class="panel panel-primary">
		<div class="panel-heading">Branch List</div>			
		<table id='branch_table' class="table table-hover">
            <thead>
				<tr>    					
					<th style='width:15%'>Branch</th>
					<th style='width:15%'>Fiscal Year Start Month</th>
                    <th style='width:30%'>Branch Head</th>
                    <th style='width:30%'>Phone</th>
					<th style='width:10%'>Actions</th>
				</tr>
			</thead>
            <tbody id='branch_table_body'>
				<!-- Populated by Javascript -->
            </tbody>
		</table>
        <div class="panel-footer">               
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addBranchModal">Add New Branch</button>
        </div><!--./panel-footer-->
   </div><!--./Panel-->
</div><!--./container--> 

<div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Branch</h4>
      </div>
      <div class="modal-body">
        <form id='addBranch' name='addBranch' class='addBranch'>
            <div class='form-group'>
                <label for='branch'>Branch:</label>
                <input type='text' class='form-control input-lg' id='branch' name='branch'>
            </div>
            <div class='form-group'>
                <label for='fy_start'>FY Start:</label>
                <input type='number' min='1' max='12' class='form-control input-lg' id='fy_start' name='fy_start'>
            </div>
            <div class='form-group'>
                <label for='branch_head'>Branch Head:</label>
                <input type='text' class='form-control input-lg' id='branch_head' name='branch_head'>
            </div>
            <div class='form-group'>
                <label for='phone'>Phone:</label>
                <input type='tel' class='form-control input-lg' id='phone' name='phone'>
            </div>                               
            <div class='form-group'>
                <label for='role'>Scorecard</label>
                <select class='form-control input-lg' name='scorecard' id='scorecard' name='scorecard'/>
                    <option value=3>National</option>
                    <option value=2>Branch</option>
                </select>
            </div>                
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input class="btn btn-primary" type="submit" value="Submit" id="submit">
      </div>
    </div>
  </div>
</div><!--./modal-->

<div class="modal fade" id="deleteBranchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Branch</h4>
            </div>
            <div class="modal-body">
                Are you Sure you want to delete this branch?
            </div>
            <div class="modal-footer">
                <div class='btn-group'>
                    <button type="button" class="btn btn-default" data-dismiss="modal">I've Changed My Mind</button>
                    <button class="btn btn-danger" id='delete-Branch-Modal' data-branchid='' data-table='branch'>Delete</button>
                </div>
            </div>
        </div>
    </div>
</div><!--./modal-->   