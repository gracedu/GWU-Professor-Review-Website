<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel">Add a Professor</h4>
            </div>
            <div class="modal-body"
			
			<!-- modal body -->
			<form class="form-ajax-post"
			    data-action="./main/control.php?act=add_professor"
			    data-url="./index.php">
				<div class="form-group">
					<label>Name:</label>
					<input name="name" type="text" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Department:</label>
					<input name="department" type="text" class="form-control"/>
				</div>
				<div class="form-group tT010 ">
					<button class="form-ajax-btn" type="submit">Submit</button>
				</div>
			</form>
        	</div>
        </div>
    </div>	
</div>