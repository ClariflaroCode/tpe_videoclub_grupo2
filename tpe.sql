-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2025 at 06:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tpe`
--

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `sexo` char(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `reputacion` int(11) DEFAULT NULL,
  `pais_origen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`id`, `nombre`, `sexo`, `fecha_nacimiento`, `reputacion`, `pais_origen`) VALUES
(1, 'shawn levy', 'm', '1968-07-23', 3, 'canada'),
(2, 'andrew adamson', 'm', '1966-12-01', 4, 'nueva zelanda'),
(3, 'james cameron', 'm', '1954-08-16', 5, 'canada'),
(4, 'steven spielberg', 'm', '1946-12-18', 5, 'estados unidos');

-- --------------------------------------------------------

--
-- Table structure for table `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `duracion` int(3) NOT NULL,
  `imagen` text NOT NULL,
  `precio` float(6,2) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `atp` tinyint(1) NOT NULL,
  `director_id` int(11) NOT NULL,
  `genero` varchar(30) NOT NULL,
  `distribuidora` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pelicula`
--

INSERT INTO `pelicula` (`id`, `titulo`, `duracion`, `imagen`, `precio`, `descripcion`, `fecha_lanzamiento`, `atp`, `director_id`, `genero`, `distribuidora`) VALUES
(1, 'tiburon', 120, 'url', 120.00, 'Tiburón (en inglés: Jaws)[nota 1]​ es una película estadounidense de terror, suspense y aventuras de 1975, dirigida por Steven Spielberg y basada en la novela homónima de Peter Benchley. En la historia, un enorme tiburón blanco devorador de hombres ataca a los bañistas en las playas de Amity Island, lo cual lleva al jefe de la policía local a emprender la caza del escualo junto a un biólogo marino y un marinero profesional. El actor Roy Scheider interpreta al jefe de policía Martin Brody, Richard Dreyfuss al oceanógrafo Matt Hooper, Robert Shaw al marinero Quint, Murray Hamilton al alcalde de Amity Island y Lorraine Gary a Ellen, esposa de Brody. El guion está acreditado tanto al propio Benchley, que elaboró los borradores iniciales, como al actor y guionista Carl Gottlieb, que lo reescribió durante el rodaje. ', '1975-06-20', 0, 4, 'terror', 'universal pictures'),
(2, 'jurassic park', 120, 'url', 200.00, 'Parque Jurásico (cuyo título original en inglés es Jurassic Park) es una película de ciencia ficción y aventuras dirigida por el cineasta estadounidense Steven Spielberg y estrenada en 1993. Su trama está basada en el libro homónimo de Michael Crichton,[5]​ y relata las vivencias de un grupo de personas en un parque de diversiones con dinosaurios clonados, creado por un filántropo multimillonario y un equipo de científicos genetistas. Durante una visita de evaluación antes de su apertura al público en general, los dinosaurios escapan y ponen en riesgo la vida de quienes se encuentran en el parque.', '1993-06-11', 1, 4, 'terror', 'universal pictures'),
(3, 'e.t. el extraterrestre', 120, 'url', 180.00, ' filme comienza en Crescent City, California, con un grupo de botánicos extraterrestres provenientes de una lejana galaxia situada a 3 millones de años luz de la Vía Láctea, que reúnen muestras de la vegetación de la Tierra. Agentes del gobierno de Estados Unidos aparecen y los extraterrestres huyen en su nave espacial, dejando atrás a uno de los suyos en sus prisas. La escena cambia a un hogar en los suburbios de California, donde un niño llamado Elliott (Henry Thomas) hace de sirviente de su hermano mayor, Michael (Robert MacNaughton), y sus amigos (K. C. Martel, Sean Frye y C. Thomas Howell). Cuando él va por la pizza, Elliott descubre al extraterrestre abandonado, quien huye con prontitud. A pesar de la incredulidad de su familia, Elliott deja dulces de Reeses Pieces en el bosque para atraerlo a su dormitorio. Antes de que se vaya a la cama, Elliott le advierte al extraterrestre imitando sus movimientos. ', '1982-06-11', 1, 4, 'ciencia ficcion', 'universal pictures'),
(5, 'terminator', 108, 'url', 600.00, 'En la madrugada del 12 de mayo de 1984 en Los Ángeles,[6]​ aparecen dos hombres desnudos enviados desde el futuro: Cerca al Observatorio Griffith emerge el Terminator T-800 (modelo Cyber Dyne 101), programado para asesinar a una mujer llamada Sarah Connor. Con la misión de protegerla, aparece Kyle Reese en un callejón en el centro de la ciudad. El Terminator asesina a unos punks para robarles sus ropas mientras que Kyle, tras llevarse los pantalones de un vagabundo, es perseguido por la policía y roba ropa de una tienda, así como una escopeta de un auto patrulla estacionado.\r\n\r\nA la mañana siguiente, el Terminator consigue armamento en una tienda de armas y asesina a su dueño, usa la guía telefónica para dar con la dirección de tres mujeres llamadas Sarah Connor y mata a las dos primeras. Esa noche, al enterarse del segundo asesinato, la verdadera Sarah teme que será la siguiente víctima y, sospechando de la presencia de Kyle, se refugia dentro de la discoteca Tech Noir, desde donde deja un mensaje en el contestador de su compañera de cuarto, Ginger. Posteriormente, contacta con el teniente Ed Traxler, que le dice que le enviará una patrulla para recogerla. El Terminator llega al apartamento de Sarah y asesina brutalmente a Ginger y su novio Matt. Al oír el mensaje de Sarah, el Terminator la identifica y se dirige a la discoteca. Antes de que el Terminator pueda asesinarla, Kyle le dispara varias veces con la escopeta y rescata a Sarah. Los dos roban un carro y escapan del Terminator, que sale a perseguirlos con una patrulla robada.', '1984-10-26', 1, 3, 'ciencia ficcion', 'orion pictures');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'julieta', 'jwatts@alumnos.exa.unicen.edu.ar', '1234'),
(2, 'luciano', 'lsancheztome@alumnos.exa.unicen.edu.ar', '1234'),
(3, 'franco', 'fstramana@profes.exa.unicen.edu.ar', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelicula_director` (`director_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `pelicula_director` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
