<form action=<?php echo '"'.URL.'film/new"';?> class="form-horizontal" enctype="multipart/form-data" method="post">
	<div class="form-group">
		<label for="film_image">Image</label>
		<input type="file" class="form-control" name="film_image" id="film_image" accept="image/png,image/jpeg" required>
	</div>
	<div class="form-group">
		<label for="film_title">Title</label>
		<input type="text" class="form-control" placeholder="Title" name="film_title" id="film_title" required>
	</div>
	<div class="form-group">
		<label for="film_year">Year</label>
		<input type="number" class="form-control" placeholder="Year" name="film_year" id="film_year" min="1990" max="2020" step="1" required>
	</div>
	<div class="form-group">
		<select class="form-control" name="film_format" required>
			<?php
			foreach ($data[0] as $value) {
				echo '<option value="'.$value['id'].'">'.$value['name_format'].'</option>';
			}
			?>
		</select> 
	</div>
	<div class="form-group">
		<?php
		foreach ($data[1] as $value) {
			echo '<label class="checkbox-inline"><input type="checkbox" name="actors[]" value="'.$value['id'].'">'.$value['full_name'].'</label>';
		}
		?>
	</div>

	<button type="submit" class="btn btn-success">Save film</button>
</form>