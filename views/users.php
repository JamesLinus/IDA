<div class="panel panel-primary">            
	<div align="center" class="panel-heading" style="font-size:24px;font-weight:bold">Users</div>
	<div id="loading" ></div>
	<table id='user_table' class='users table table-hover' cellspacing="0" width="100%">				
		<thead>
      <th>Username</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Branch</th>
      <th>Role</th>
      <th>Last Login</th>
      <th>Actions</th>
    </thead>
      <tbody id='user_table_body'>
        <!--populated ny javascript-->
      </tbody>
	</table>
	<div class="panel-footer">				
			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addUserModal">Add New User</button>
	</div><!--./panel-footer-->
</div>
  	
	
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add User</h4>
          </div>
          <div class="modal-body">
            <form id='addUser' name='addUser' class='addUser'>
                <div class='form-group'>
                    <label for='username'>Username:</label>
                    <input type='text' class='form-control' id='username' name='username'>
                </div>
                <div class='form-group'>
                    <label for='password'>Password:</label>
                    <input type='password' class='form-control' id='password' name='password'>
                </div>
                <div class='form-group'>
                    <label for='firstname'>First name:</label>
                    <input type='text' class='form-control' id='firstname' name='firstname'>
                </div>
                <div class='form-group'>
                    <label for='lastname'>Last name:</label>
                    <input type='text' class='form-control' id='lastname' name='lastname'>
                </div>
                <div class='form-group'>
                    <label for='email'>Email:</label>
                    <input type='email' class='form-control' id='email' name='email'>
                </div>
                <div class='form-group'>
                    <label for='branch'>Branch:</label>
                    <?php user_branch_dropdown($dbhost, $dbuser, $dbpass, 0) ?>
                </div>
                <div class='form-group'>
                    <label for='role'>Permission Level:</label>
                    <select class='form-control' name='role' id='role' name='role'/>
                        <option value=3>Branch</option>
                        <option value=2>Headquarters</option>
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
	
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete User</h4>
      </div>
      <div class="modal-body">
        Are you Sure you want to delete this user?
      </div>
      <div class="modal-footer">
  			<div class='btn-group'>
  				<button type="button" class="btn btn-default" data-dismiss="modal">I've Changed My Mind</button>
  				<button class="btn btn-danger" id='delete-User-Modal' data-userid='' data-table='users'>Delete</button>
  			</div>
      </div>
    </div>
  </div>
</div><!--./modal-->

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editUserModalLabel">Delete User</h4>
      </div>
      <div class="modal-body">
        <form id='edit-user-form'>
        </form>
      </div>
      <div class="modal-footer">
        <div class='btn-group'>
          <button type="button" class="btn btn-default" data-dismiss="modal">I've Changed My Mind</button>
          <button class="btn btn-danger" id='edit-User-Modal' data-userid='' data-table='users'>Save Changes</button>
        </div>
      </div>
    </div>
  </div>
</div><!--./modal-->