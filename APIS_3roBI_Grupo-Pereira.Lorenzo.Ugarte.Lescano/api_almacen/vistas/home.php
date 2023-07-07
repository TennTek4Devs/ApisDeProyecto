<div class="container is-fluid">
    <h1 class="title">Home</h1>
	<?php	
	if(($_SESSION['apellido'])=="admin"){
		$apellido_display="";
	}else{
		$apellido_display=($_SESSION['apellido']);
	}
	if(isset($_SESSION['id'])){
		echo'<div class="card">
				<div class="card-content">
				<div class="media">
				<div class="media-left">
					<figure class="image is-48x48">
						<img src="./img/profile.jpg" alt="Placeholder image">
					</figure>
				</div>
				<div class="media-content">
					<p class="title is-4">'.
					$_SESSION['nombre'].' '.$apellido_display.' 
					</p>
					<p class="subtitle is-6">@'.$_SESSION['usuario'].'</p>
				</div>
			</div>';
		echo '<h2 class="subtitle">¡Bienvenido!</h2>';
	}else{
		include "./vistas/logout.php";
	}
	?>
</div>

<br>

<!-- <nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">

	<a class="pagination-previous" href="#">Anterior</a>

	<ul class="pagination-list">
		<li><a class="pagination-link" href="#">1</a></li>
		<li><span class="pagination-ellipsis">&hellip;</span></li>
		<li><a class="pagination-link is-current" href="#">2</a></li>
		<li><a class="pagination-link" href="#">3</a></li>
		<li><span class="pagination-ellipsis">&hellip;</span></li>
		<li><a class="pagination-link" href="#">3</a></li>
	</ul>

	<a class="pagination-next" href="#">Siguiente</a>

</nav> -->