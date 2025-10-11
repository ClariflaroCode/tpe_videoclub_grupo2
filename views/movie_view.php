<?php

class movie_view {

    function showMovies($movies) {
        require 'templates/header.phtml';

        echo '<section class="peliculas-listado">';
        foreach ($movies as $movie) {
            echo "<article class='pelicula-card'>";
            echo "<h4>" . $movie->titulo . "</h4>";
            echo "<img src='" . $movie->imagen . "' alt='Imagen de " . $movie->titulo . "'>";
            echo "<p>" . $movie->descripcion . "</p>";
            echo "<p class='precio'>Precio: $" . $movie->precio . "</p>";
            echo "<p class='director'>Director: " . $movie->nombre_director . "</p>";
            echo "<p class='categoria'>Género: " . $movie->genero . "</p>"; // Género agregado
            echo "<a href='" . BASE_URL . "peliculas/{$movie->id}'>Ver más</a>";
            echo "</article>";
        }
        echo '</section>';

        require 'templates/footer.phtml';
    }

    function showMovieById($movie) {
        require 'templates/header.phtml';

        if ($movie) {
            echo "<section class='pelicula-detalle'>";
            echo "<img src='" . $movie->imagen . "' alt='Imagen de " . $movie->titulo . "'>";
            echo "<div class='pelicula-detalle-info'>";
            echo "<h2>" . $movie->titulo . "</h2>";
            echo "<p>" . $movie->descripcion . "</p>";
            echo "<p class='precio'>Precio: $" . $movie->precio . "</p>";
            echo "<p class='director'>Director: " . $movie->nombre_director . "</p>";
            echo "<p class='categoria'>Género: " . $movie->genero . "</p>";
            echo "<a href='" . BASE_URL . "peliculas'>Volver</a>";
            echo "</div>";
            echo "</section>";
        } else {
            $this->showError();
        }

        require 'templates/footer.phtml';
    }

    function showError() {
        echo "<h2>Error 404</h2>";
        echo "<p>Página no encontrada.</p>";
        echo "<a href='" . BASE_URL . "peliculas'>Volver</a>";
    }

  function showLogin($error = '') {
    require 'templates/header.phtml';

    echo "<section class='pelicula-detalle'>";
    echo "<div class='pelicula-detalle-info login-form'>";
    echo "<h2>Inicio de sesión</h2>";

    if($error) {
        echo "<p class='login-error'>$error</p>";
    }

    echo "<form method='POST' action='" . BASE_URL . "login'>";
    echo "<div class='form-group'>";
    echo "<label>Usuario</label>";
    echo "<input type='text' name='usuario' class='input' placeholder='Ingrese su usuario' required>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label>Contraseña</label>";
    echo "<input type='password' name='password' class='input' placeholder='Ingrese su contraseña' required>";
    echo "</div>";
    echo "<button type='submit' class='button'>Ingresar</button>";
    echo "</form>";

    echo "</div>";
    echo "</section>";

    require 'templates/footer.phtml';
}

function showAdminMovies($movies) {
    require 'templates/header.phtml';
    echo "<section class='admin-page'>";
    echo "<h2>Listado de Películas</h2>";
    echo "<table class='admin-table'>";
    echo "<thead>
            <tr>
                <th>Título</th>
                <th>Director</th>
                <th>Género</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
          </thead>";
    echo "<tbody>";
    foreach($movies as $movie) {
        echo "<tr>";
        echo "<td>{$movie->titulo}</td>";
        echo "<td>{$movie->nombre_director}</td>";
        echo "<td>{$movie->genero}</td>";
        echo "<td>$ {$movie->precio}</td>";
        echo "<td>
                <a class='button' href='" . BASE_URL . "admin/edit/{$movie->id}'>Editar</a>
                <a class='button' href='" . BASE_URL . "admin/delete/{$movie->id}'>Eliminar</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<a class='button' href='" . BASE_URL . "admin/add'>Agregar Película</a>";
    echo "</section>";
    require 'templates/footer.phtml';
}


function showMovieForm($movie = null, $directors, $error = '') {
    require 'templates/header.phtml';
    echo "<section class='admin-page'>";
    $accion = $movie ? 'edit' : 'add';
    $tituloForm = $movie ? 'Editar Película' : 'Agregar Película';
    $buttonText = $movie ? 'Guardar Cambios' : 'Agregar';

    echo "<h2>$tituloForm</h2>";

    if ($error) echo "<p class='login-error'>$error</p>";

    echo "<form method='POST' action='" . BASE_URL . "admin/$accion' class='admin-form'>";
    if ($movie) echo "<input type='hidden' name='id' value='{$movie->id}'>";

    $valTitulo = $movie->titulo ?? '';
    $valDescripcion = $movie->descripcion ?? '';
    $valPrecio = $movie->precio ?? '';
    $valGenero = $movie->genero ?? '';
    $valDirectorId = $movie->director_id ?? '';

    echo "<label>Título</label>";
    echo "<input type='text' name='titulo' class='input' value='$valTitulo' required>";

    echo "<label>Descripción</label>";
    echo "<textarea name='descripcion' class='input' required>$valDescripcion</textarea>";

    echo "<label>Precio</label>";
    echo "<input type='number' name='precio' class='input' value='$valPrecio' required>";

    echo "<label>Género</label>";
    echo "<select name='genero' class='input' required>";
    $generos = ['Acción','Comedia','Drama','Terror','Romance','Suspenso'];
    foreach($generos as $g){
        $selected = ($valGenero == $g) ? 'selected' : '';
        echo "<option value='$g' $selected>$g</option>";
    }
    echo "</select>";

    echo "<label>Director</label>";
    echo "<select name='director_id' class='input' required>";
    foreach ($directors as $d) {
        $selected = ($valDirectorId == $d->id) ? 'selected' : '';
        echo "<option value='{$d->id}' $selected>{$d->nombre}</option>";
    }
    echo "</select>";

    echo "<button type='submit' class='button'>$buttonText</button>";
    echo "</form>";
    echo "</section>";
    require 'templates/footer.phtml';
}

}