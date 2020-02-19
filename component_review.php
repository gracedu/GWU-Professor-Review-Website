<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel">review professor form</h4>
            </div>
            <div class="modal-body">
			
				<!-- modal body -->
				<p>review this professor</p>
				<form class="form-ajax-post"  data-action="./main/control.php?act=review"
					data-url="./professor.php?id=<?php echo $_GET['id'] ?>"
				    >
					<input name="profID" value="<?php echo $_GET['id']?>" class="hidden"/>
					<input name="studentID" value="<?php echo $_SESSION['ID']?>" class="hidden"/>
					<div class="form-group">
						<label>comment:</label><br>
						<textarea name="comment"  class="form-control" type="text"></textarea>
					</div>
					<div class="form-group">
						<label>course:</label><br>
						<input name="className" class="form-control" type="text"/>
					</div>

					<div class="form-group">
						<label>rating:</label>
						<input id="input-21b" name="rating" value="0" type="number" class="rating form-control" min="0" max="5" step="1" data-size="xs" style="display: none;">
					</div>
					<div class="form-group">
						<label>homework:</label>
						<input id="input-21b" name="homework" value="0" type="number" class="rating form-control" min="0" max="5" step="1" data-size="xs" style="display: none;">
					</div>
					<div class="form-group">
						<label>test:</label>
						<input id="input-21b" name="test" value="0" type="number" class="rating form-control" min="0" max="5" step="1" data-size="xs" style="display: none;">
					</div>
					<div class="form-group">
						<label>helpful:</label>
						<input id="input-21b" name="helpful" value="0" type="number" class="rating form-control" min="0" max="5" step="1" data-size="xs" style="display: none;">
					</div>
					<div class="form-group ">
						<button class="form-ajax-btn" >submit</button>
					</div>
				</form>
        	</div>
        </div>
    </div>
</div>	
