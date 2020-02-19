<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body"
			
			<!-- modal body -->
			<form class="form-ajax-post"
			    data-action="./main/control.php?act=change_password"
			    data-url="./account_settings.php">
				<div class="form-group">
					<label>Old Password:</label>
					<input name="oldPassword" type="password" class="form-control"/>
				</div>
				<div class="form-group">
					<label>New Passsword:</label>
					<input name="newPassword1" type="password" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Confirm New Passsword:</label>
					<input name="newPassword2" type="password" class="form-control"/>
				</div>
				<div class="form-group tT010 ">
					<button class="form-ajax-btn" type="submit">Confirm</button>
				</div>
			</form>
        	</div>
        </div>
    </div>
</div>