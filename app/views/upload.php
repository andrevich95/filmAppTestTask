<form action=<?php echo '"'.URL.'film/upload"';?> class="form-inline" enctype="multipart/form-data" method="post">
	<div class="form-group">
		<label for="file_films">File</label>
		<input type="file" class="form-control" name="file_films" id="file_films" required >
	</div>
	<button type="submit" class="btn btn-success">Upload file</button>
</form>