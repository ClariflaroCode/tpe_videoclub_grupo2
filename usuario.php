<?php 
    /*
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbName = "tpe";
        //1. Abrimos una conexión
        $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", "$user", $password);

        
        $consulta = "SELECT * from pelicula";
        $result  = $db->prepare($consulta);
        $result->execute(); 
        $peliculas = $result->fetchAll(PDO::FETCH_OBJ)

        $consulta = "SELECT * from videojuego";
        $result  = $db->prepare($consulta);
        $result->execute(); 
        $videojuegos = $result->fetchAll(PDO::FETCH_OBJ)
    */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav>
        <ul class="nav-list">
            <li> 
                <a href="home.php">Home</a> 
            </li>
            <li> 
                <a href="about_us.php">About us</a>
            </li>
            <li>
                <a href="profile.php">Profile</a>
            </li>
            <li>
                <a href="carrito.php">Carrito</a>
            </li>
            <li>
                <input type="text" placeholder="Buscar">
            <li>
        <ul>
    </nav>
    <main>
        
        <section class="card-container">
            <?php
                /*
                    for($peliculas as $pelicula) {
                        echo "<article>";
                        echo "<figure>";
                        echo "img src='$pelicula->img' alt='imagen del pelicula $pelicula->nombre'";
                        echo "<h4> $pelicula->titulo</h4>";
                        echo "<p>$pelicula->descripcion</p>";
                        echo "<p> $pelicula->precio</p>";
                        echo "<a href="">Ver más</a>";
                        echo "</article>";
                    }
                            
                    for($videojuegos as $videojuego) {
                        echo "<article>";
                        echo "<figure>";
                        echo "img src='$videojuego->img' alt='imagen del pelicula $videojuego->nombre'";
                        echo "<h4> $videojuego->titulo</h4>";
                        echo "<p>$videojuego->descripcion</p>";
                        echo "<p> $videojuego->precio</p>";
                        echo "<a href="">Ver más</a>";
                        echo "</article>";
                    }
                */
            ?>
            <article class="card">
                <img src="" alt="">
                <h4>Mision imposible</h4>
                <p>Película de acción</p>
                <p>$500</p>
                <a href="" class="button">Ver más</a>
            </article>
            <article class="card">
                <img src="" alt="">
                <h4>Mision imposible</h4>
                <p>Película de acción</p>
                <p>$500</p>
                <a href="" class="button">Ver más</a>
            </article>
            <article class="card">
                <img src="" alt="">
                <h4>Mision imposible</h4>
                <p>Película de acción</p>
                <p>$500</p>
                <a href="" class="button">Ver más</a>
            </article>
        </section>

    </main>
</body>
</html>