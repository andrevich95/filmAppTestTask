<div class="table-responsive">
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<td>Id</td>
			<td>Actor</td>
			<td>Films</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
<?php

foreach ($data as $value) {
	echo '<tr id="'.$value['id'].'">
	<td>'.$value['id'].'</td>
	<td>'.$value['full_name'].'</td>
	<td>'.$value['films'].'</td>
	<td><button class="btn btn-primary remove_actor"><span class="glyphicon glyphicon-remove"></span></button></td>
	</tr>';
}
?>
	</tbody>
</table>
</div>