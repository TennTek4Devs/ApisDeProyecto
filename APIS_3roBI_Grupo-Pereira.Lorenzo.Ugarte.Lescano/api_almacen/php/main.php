<?php
    #Ejemplo de insercion de datos a la base de datos (F5 para testear, phpmyadmin para confirmar (ver que funca))
    #$pdo->query("INSERT INTO categoria(categoria_nombre, categoria_ubicacion) VALUES('prueba','texto ubicacion')");

    function conexion(){
        #Ultimas '' vacias porque es de contraseña, no esta definida en xampp
        $pdo = new PDO('mysql:host=localhost;dbname=api_bd','root','');
        return $pdo;
    }
	
	//////////////////////////////////////
	//									//
	//	Si se importa por (rapido)		//
	//	cambiar "api_bd" por nombre		//
	//	de nueva base de datos.			//
	//									//
	//////////////////////////////////////
    

    // VERIFICAR DATOS //
    function verificar_datos($filtro,$cadena){
        #En el pregmatch, el ^ significa inicio de la cadena y el $ final de la cadena, te pone como parametro
        #lo que esta entre /^ y $/
        if(preg_match("/^".$filtro."$/i",$cadena)){
            return false;
        }else{
            return true;
        }
    }

    // LIMPIAR CADENA DE TEXTO //
    function limpiar_cadena($cadena){
        #limpiar espacios en blanco en la cadena (si te escribe "carlos  ", te devuelve "carlos")
        $cadena=trim($cadena);
        #limpiar las barras "\" de la cadena de texto
        $cadena=stripslashes($cadena);
        #version insensible a mayus y minus de str_replace. reemplaza busqueda por texto asignado.
        #en este caso reemplaza posible script js por texto vacio en $cadena (para evitar salida de
        #codigo js accidental)
        $cadena=str_ireplace("<script>","",$cadena);
        #de aca para abajo es codigo que evita que se muestre codigo en vez de cadena de texto "regular"
        $cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
        #mismo codigo que pusimos al inicio, evitar espacios vacios y "\"
        $cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
    }

    // RENOMBRAR FOTOS //
	function renombrar_fotos($nombre){
		$nombre=str_ireplace(" ", "_", $nombre);
		$nombre=str_ireplace("/", "_", $nombre);
		$nombre=str_ireplace("#", "_", $nombre);
		$nombre=str_ireplace("-", "_", $nombre);
		$nombre=str_ireplace("$", "_", $nombre);
		$nombre=str_ireplace(".", "_", $nombre);
		$nombre=str_ireplace(",", "_", $nombre);
        #rand selecciona un numero aleatorio entre 0 y 100.
        #
		$nombre=$nombre."_".rand(0,100);
		return $nombre;
	}

    // FUNCION PARA PAGINAR LAS TABLAS // ___REPASAR___
    function paginador_tablas($pagina,$Npaginas,$url,$botones){
		$tabla='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

        # Para no poner "anterior" si estas en la 1
		if($pagina<=1){
			$tabla.='
			<a class="pagination-previous is-disabled" disabled >Anterior</a>
			<ul class="pagination-list">';
		}else{
			$tabla.='
			<a class="pagination-previous" href="'.$url.($pagina-1).'" >Anterior</a>
			<ul class="pagination-list">
                <li><a class="pagination-link" href="'.$url.'1">1</a></li>
				<li><span class="pagination-ellipsis">&hellip;</span></li>
			';
		}

		$ci=0;
		for($i=$pagina; $i<=$Npaginas; $i++){
			if($ci>=$botones){
				break;
			}
			if($pagina==$i){
				$tabla.='<li><a class="pagination-link is-current" href="'.$url.$i.'">'.$i.'</a></li>';
			}else{
				$tabla.='<li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>';
			}
			$ci++;
		}

		if($pagina==$Npaginas){
			$tabla.='
			</ul>
			<a class="pagination-next is-disabled" disabled >Siguiente</a>
			';
		}else{
			$tabla.='
				<li><span class="pagination-ellipsis">&hellip;</span></li>
				<li><a class="pagination-link" href="'.$url.$Npaginas.'">'.$Npaginas.'</a></li>
			</ul>
			<a class="pagination-next" href="'.$url.($pagina+1).'" >Siguiente</a>
			';
		}

		$tabla.='</nav>';
		return $tabla;
	}
?>