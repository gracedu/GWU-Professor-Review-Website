<div class="col-sm-6">
	<h2 style="text-align:left">Sign Up</h2>	
	<form class="form-ajax-post"
	    data-action="./main/control.php?act=user_register"
	    data-url="index.php">
		<div class="form-group">
			<label>GWid:</label>
			<input name="studentID" type="text" class="form-control"/>
		</div>
		<div class="form-group">
			<label>Username:</label>
			<input name="name" type="text" class="form-control"/>
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input name="pwd" type="password" class="form-control"/>
		</div>
		<div class="form-group">
			<label>Confirm Password:</label>
			<input name="pwd_a" type="password" class="form-control"/>
		</div>
	    <div class="form-group">
	        <label>Email:</label>
	        <input name="email" type="text" class="form-control"/>
	    </div>
		<div class="form-group tT010 ">
			<button class="form-ajax-btn" type="submit">Register</button>
		</div>
	</form>
</div>