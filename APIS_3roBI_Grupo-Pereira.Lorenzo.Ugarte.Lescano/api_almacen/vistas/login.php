<div class="main-container">

	<form class="box login" action="" method="POST" autocomplete="off">
		<h5 class="title is-5 has-text-centered is-uppercase">Sistema de inventario</h5>

		<div class="field">
			<label class="label">Usuario</label>
			<div class="control">
			    <input class="input" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required >
			</div>
		</div>

		<div class="field">
		  	<label class="label">Clave</label>
		  	<div class="control">
				<!-- Pattern significa los tipos de caracteres que se permiten en el input, y lo que le sigue
                es de la cantidad que se permiten (de la "a" a "z", "A" a "Z", "0" a "9", "$", "@", "." y "-")
                luego, se permiten de 7 a 100 caracteres ("maxlength='100'" es lo mismo que "{7,*100*}"), la
                unica diferencia es que maxlenght te frena el texto.-->
		    	<input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
		  	</div>
		</div>

		<p class="has-text-centered mb-4 mt-3">
			<button type="submit" class="button is-info is-rounded">Iniciar sesion</button>
		</p>

		<?php
			if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
				require_once "./php/main.php";
				require_once "./php/iniciar_sesion.php";
			}
		?>
	</form>


</div>

