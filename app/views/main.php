<div class="row">
	<div class="col-md-6 col-sm-6">
	<form action=<?php echo '"'.URL.'main/search"';?> class="form-inline" method="post" id="search_form">
			<label for="search">Search(by actor, or film)</label>
			<div class="form-group">
				
				<input list="help" type="text" name="search" class="form-control" id="search">
				<div id="help">
					
				</div>
			</div>
			<button type="submit" class="btn btn-success">Search</button>
			<button id="reset" type="reset" class="btn btn-success">Reset</button>
	</form>
	</div>
	<form class="form-inline">
	<div class="col-md-6 col-sm-6">
		<label for="sorting">Sort by</label>
		<select class="form-control" id="sorting">
			<option value="id">Id</option>
			<option value="year">Year</option>
			<option value="title">Title</option>
		</select>	
	</div>
</form>
</div>

<div id="info_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  </div>
</div>

<div class="table-responsive">
<br/>
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<td>Id</td>
			<td>Film</td>
			<td>Year</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
<?php

foreach ($data as $value) {
	echo '<tr id="'.$value['id'].'">
	<td>'.$value['id'].'</td>
	<td>'.$value['title'].'</td>
	<td>'.$value['year'].'</td>
	<td>
		<button class="btn btn-primary info" data-toggle="modal" data-target="#info_modal"><span class="glyphicon glyphicon-info-sign"></span></button>
		<button class="btn btn-primary remove"><span class="glyphicon glyphicon-remove"></span></button>
	</td>
	</tr>';
}
?>
	</tbody>
</table>
</div>
