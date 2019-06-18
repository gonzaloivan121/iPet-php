-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2019 a las 21:27:48
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ipet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `idChat` int(11) NOT NULL,
  `idU1` varchar(20) NOT NULL,
  `idU2` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`idChat`, `idU1`, `idU2`) VALUES
(33, 'xloxlolex', 'ApplePie'),
(34, 'xloxlolex', 'rjp126'),
(35, 'xloxlolex', 'usuaria'),
(36, 'xloxlolex', 'username'),
(37, 'usuarionuevo123', 'xloxlolex'),
(38, 'xloxlolex', 'worrelle'),
(40, 'usuarionuevo1', 'xloxlolex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `idEspecie` int(2) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`idEspecie`, `nombre`) VALUES
(1, 'Perro'),
(2, 'Gato'),
(3, 'Ave'),
(4, 'Tortuga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `idLike` int(11) NOT NULL,
  `idU1` varchar(20) NOT NULL,
  `idU2` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`idLike`, `idU1`, `idU2`) VALUES
(15, 'xloxlolex', 'rjp126'),
(16, 'rjp126', 'xloxlolex'),
(17, 'xloxlolex', 'usuaria'),
(18, 'usuaria', 'xloxlolex'),
(19, 'ApplePie', 'xloxlolex'),
(20, 'xloxlolex', 'ApplePie'),
(24, 'username', 'xloxlolex'),
(27, 'xloxlolex', 'username'),
(28, 'xloxlolex', 'worrelle'),
(29, 'xloxlolex', 'worrelle'),
(30, 'xloxlolex', 'thatchette8'),
(31, 'xloxlolex', 'sscaysbrook6'),
(32, 'xloxlolex', 'sscaysbrook6'),
(33, 'ApplePie', 'usuario'),
(34, 'ApplePie', 'kgillean9'),
(35, 'ApplePie', 'gonzaloivan121'),
(36, 'ApplePie', 'fsummersideh'),
(37, 'xloxlolex', 'thatchette8'),
(38, 'xloxlolex', 'smao'),
(39, 'pmarchaca', 'worrelle'),
(40, 'pmarchaca', 'usuaria'),
(41, 'pmarchaca', 'username'),
(42, 'pmarchaca', 'thatchette8'),
(43, 'pmarchaca', 'sscaysbrook6'),
(44, 'pmarchaca', 'smao'),
(45, 'pmarchaca', 'rserjeantson3'),
(46, 'pmarchaca', 'rjp126'),
(47, 'pmarchaca', 'oosipenko0'),
(48, 'pmarchaca', 'mtwatt1'),
(49, 'pmarchaca', 'lharphami'),
(50, 'pmarchaca', 'kglasbyc'),
(51, 'pmarchaca', 'jaucklanda'),
(52, 'pmarchaca', 'eholdd'),
(53, 'pmarchaca', 'ebusek5'),
(54, 'pmarchaca', 'dcaccavarif'),
(55, 'pmarchaca', 'csperry2'),
(56, 'pmarchaca', 'cbullusb'),
(57, 'pmarchaca', 'bmacaleesg'),
(58, 'pmarchaca', 'ApplePie'),
(59, 'ApplePie', 'usuario'),
(60, 'ApplePie', 'thor123'),
(61, 'ApplePie', 'tcollie4'),
(62, 'ApplePie', 'pmarchaca'),
(63, 'usuarionuevo123', 'xloxlolex'),
(64, 'usuarionuevo123', 'usuario'),
(65, 'usuarionuevo123', 'thor123'),
(66, 'usuarionuevo123', 'tcollie4'),
(67, 'usuarionuevo123', 'pmarchaca'),
(68, 'usuarionuevo123', 'mdillistonj'),
(69, 'usuarionuevo123', 'kgillean9'),
(70, 'xloxlolex', 'usuarionuevo123'),
(71, 'usuarionuevo1', 'xloxlolex'),
(72, 'usuarionuevo1', 'usuario'),
(73, 'usuarionuevo1', 'thor123'),
(74, 'xloxlolex', 'usuarionuevo1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `idMascota` int(5) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `idEspecie` int(5) NOT NULL,
  `idRaza` int(5) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`idMascota`, `nombre`, `idEspecie`, `idRaza`, `genero`, `color`, `imagen`, `usuario`) VALUES
(8, 'Ace', 1, 2, 'Macho', 'Beige', 'https://pixabay.com/get/e837b10621f5053ed1584d05fb1d4797e670e5d110b80c4090f4c870a1e9b0b0d0_1280.jpg', 'gonzaloivan121'),
(9, 'Dante', 2, 23, 'macho', 'Grisaceo', '/path/to/image', 'xloxlolex'),
(11, 'Chicho', 1, 10, 'Macho', 'Blanco y marrón', '/path/to/image', 'xloxlolex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matches`
--

CREATE TABLE `matches` (
  `idMatch` int(11) NOT NULL,
  `idU1` varchar(20) NOT NULL,
  `idU2` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `matches`
--

INSERT INTO `matches` (`idMatch`, `idU1`, `idU2`) VALUES
(1, 'gonzaloivan121', 'usuaria'),
(2, 'xloxlolex', 'usuaria'),
(3, 'smao', 'usuaria'),
(4, 'xloxlolex', 'ApplePie'),
(5, 'gonzaloivan121', 'ApplePie'),
(6, 'rjp126', 'xloxlolex'),
(33, 'xloxlolex', 'username'),
(35, 'ApplePie', 'usuario'),
(36, 'ApplePie', 'pmarchaca'),
(37, 'xloxlolex', 'worrelle'),
(38, 'xloxlolex', 'usuarionuevo123'),
(39, 'xloxlolex', 'usuarionuevo1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `idMensaje` int(11) NOT NULL,
  `idChat` int(11) NOT NULL,
  `propietario` varchar(20) NOT NULL,
  `texto` text CHARACTER SET utf8mb4 NOT NULL,
  `epoch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`idMensaje`, `idChat`, `propietario`, `texto`, `epoch`) VALUES
(123, 33, 'xloxlolex', 'Solicitud para charlar.', 2147483647),
(124, 33, 'ApplePie', 'Hola! Encantada ^^', 1560873014),
(125, 33, 'ApplePie', 'Mi nombre es Apple Pie, soy una pastora ovejera con gafas!', 1560873059),
(126, 33, 'xloxlolex', 'Qué tal??', 1560873076),
(127, 34, 'xloxlolex', 'Solicitud para charlar.', 2147483647),
(128, 35, 'xloxlolex', 'Solicitud para charlar.', 2147483647),
(129, 36, 'xloxlolex', 'Solicitud para charlar.', 2147483647),
(130, 37, 'usuarionuevo123', 'Solicitud para charlar.', 2147483647),
(131, 37, 'xloxlolex', 'Hola!', 1560873354),
(132, 38, 'xloxlolex', 'Solicitud para charlar.', 2147483647),
(135, 40, 'usuarionuevo1', 'Solicitud para charlar.', 2147483647),
(136, 40, 'usuarionuevo1', 'Hola!', 1560876553);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `idRaza` int(2) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `idEspecie` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`idRaza`, `nombre`, `idEspecie`) VALUES
(2, 'Pastor Alemán', 1),
(3, 'Bulldog', 1),
(4, 'Caniche', 1),
(5, 'Labrador', 1),
(6, 'Beagle', 1),
(7, 'Mastín', 1),
(8, 'Golden Retriever', 1),
(9, 'Chihuahua', 1),
(10, 'Carlino', 1),
(11, 'Bóxer', 1),
(12, 'Galgo', 1),
(13, 'Husky Siberiano', 1),
(14, 'Shiba Inu', 1),
(15, 'Persa', 2),
(16, 'Siamés', 2),
(17, 'Maine Coon', 2),
(18, 'Sphynx', 2),
(19, 'Ragdoll', 2),
(20, 'Munchkin', 2),
(21, 'Abisino', 2),
(22, 'Angora Turco', 2),
(23, 'Bengala', 2),
(24, 'Bosque de Noruega', 2),
(25, 'Laúd', 4),
(26, 'Carey', 4),
(27, 'Cumberland', 4),
(28, 'Mediterránea', 4),
(29, 'De Florida', 4),
(30, 'Rusa', 4),
(31, 'Periquito', 3),
(32, 'Ninfa', 3),
(33, 'Rosella', 3),
(34, 'Loro', 3),
(35, 'Jilguero', 3),
(36, 'Cacatúa', 3),
(37, 'Verderón', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(1) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contrasena` varchar(16) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `idRol` int(1) NOT NULL,
  `edad` int(2) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `email`, `contrasena`, `nombre`, `idRol`, `edad`, `genero`, `imagen`) VALUES
('admin', 'admin@admin.com', 'admin', 'Administrador', 1, NULL, NULL, 'https://www.knowmuhammad.org/img/noavatarn.png'),
('ApplePie', 'applepie123@gmail.com', 'applepie', 'Apple Pie', 2, 24, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2FApplePie%2FApplePie.jpg?alt=media'),
('bmacaleesg', 'bgrisenthwaiteg@statcounter.co', 'z3UBKJ', 'Barnabe', 1, 29, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('cbullusb', 'cduffieldb@mysql.com', 'ZNQgct0L', 'Cher', 1, 27, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('csperry2', 'cpaolillo2@comsenz.com', '1fGHGTGnruC', 'Carina', 1, 26, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('dcaccavarif', 'doferf@senate.gov', 'FcitoJ7ya4Y', 'Doris', 1, 25, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('ebusek5', 'ecribbins5@sina.com.cn', 'Z9rw8QGa3', 'Elset', 2, 25, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('eholdd', 'ebuyersd@com.com', 'RR0IbBThjisf', 'Edgardo', 1, 25, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('fsummersideh', 'ffernihoughh@sakura.ne.jp', 'YZDMJORQGt', 'Ferdinand', 2, 23, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('gonzaloivan121', 'gonzaloivan121@gmail.com', 'Rollinbaby1.', 'Gonzalo', 2, 20, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('jaucklanda', 'jfarndella@sun.com', 'U5xJNsAacs', 'Jaclyn', 2, 18, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('kgillean9', 'kmorales9@latimes.com', 'u7IBUz', 'Kipp', 1, 27, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('kglasbyc', 'kduggonc@mapquest.com', 'VK3ZFaU0', 'Kaspar', 2, 30, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('lharphami', 'lhexti@jigsy.com', '5q9lGsPcQ', 'Lyndy', 1, 21, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('lverity7', 'lbimrose7@timesonline.co.uk', 'EuDzQrx9hG', 'Lolita', 2, 27, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('mdillistonj', 'mbridywaterj@networkadvertisin', '8Rn75716GDU', 'Meagan', 1, 21, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('mtwatt1', 'mrestorick1@dailymail.co.uk', 'r94uGPRWIDqG', 'Marlee', 1, 20, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('oosipenko0', 'oclifforth0@wisc.edu', 'EITG59tyXknv', 'Odey', 2, 23, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('pmarchaca', 'pmarchaca@gmail.com', '1234', 'Claudio Chaparro', 2, 40, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fpmarchaca%2Fpmarchaca.jpg?alt=media'),
('rjp126', 'rjp126@gmail.com', 'rjp126', 'Ricarda Jimenez Pérez', 2, 22, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Frjp126%2Frjp126.jpg?alt=media'),
('rserjeantson3', 'rrallinshaw3@nba.com', 'YWc0FFZ8', 'Reinhard', 1, 22, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('smao', 'smao@smao.com', 'smao', 'Sin Miedo al Océano', 2, 20, 'femenino', 'assets/img/tmp/smao.jpeg'),
('sscaysbrook6', 'sbroadbury6@lycos.com', 'YqIjLhY', 'Shawn', 2, 18, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('tcollie4', 'tvonasek4@latimes.com', 'VqRDs7n', 'Thorin', 2, 29, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('thatchette8', 'tspreull8@bizjournals.com', 'HVnI39OB5jF8', 'Trever', 1, 25, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('thor123', 'thor123@gmail.com', 'thor123', 'Thor Mis Huevos', 2, 32, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('username', 'username@username.com', 'username', 'Paula Martínez', 2, 19, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fusername%2Fusername.jpg?alt=media'),
('usuaria', 'usuaria@usuaria.com', 'usuaria', 'Laura Jiménez Albéniz', 2, 20, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fusuaria%2Fusuaria.jpg?alt=media'),
('usuario', 'usuario@usuario.com', 'usuario', 'Usuario', 2, 20, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('usuarionuevo1', 'usuarionuevo1@gmail.com', 'usuarionuevo1', 'Usuario Nuevo', 2, 20, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fusuarionuevo1%2Fusuarionuevo1.jpg?alt=media'),
('usuarionuevo123', 'usuarionuevo123@gmail.com', 'usuarionuevo123', 'usuarionuevo123', 2, 20, 'femenino', '/path/to/image'),
('worrelle', 'wdimaggioe@theglobeandmail.com', 'Ler82YeY', 'Wrennie', 1, 29, 'femenino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fdefault%2Fdefault.jpg?alt=media'),
('xloxlolex', 'chaparro.gonzaloivan@gmail.com', 'xloxlolex', 'Gonzalo Iván Chaparro Barese', 2, 20, 'masculino', 'https://firebasestorage.googleapis.com/v0/b/ipet-php.appspot.com/o/images%2Fxloxlolex%2Fxloxlolex.jpg?alt=media');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idChat`),
  ADD KEY `idU1` (`idU1`),
  ADD KEY `idU2` (`idU2`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`idEspecie`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idLike`),
  ADD KEY `idU1` (`idU1`),
  ADD KEY `idU2` (`idU2`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`idMascota`),
  ADD KEY `fk_usuario_mascota` (`usuario`),
  ADD KEY `fk_especie_mascota` (`idEspecie`),
  ADD KEY `fk_raza_mascota` (`idRaza`);

--
-- Indices de la tabla `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`idMatch`),
  ADD KEY `idU1` (`idU1`),
  ADD KEY `idU2` (`idU2`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`idMensaje`),
  ADD KEY `idChat` (`idChat`),
  ADD KEY `propietario` (`propietario`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`idRaza`),
  ADD KEY `fk_raza_especie` (`idEspecie`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_rol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `idChat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `idEspecie` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `idLike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `idMascota` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `matches`
--
ALTER TABLE `matches`
  MODIFY `idMatch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `idMensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `idRaza` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`idU1`) REFERENCES `usuario` (`usuario`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`idU2`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`idU1`) REFERENCES `usuario` (`usuario`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`idU2`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `fk_especie_mascota` FOREIGN KEY (`idEspecie`) REFERENCES `especie` (`idEspecie`),
  ADD CONSTRAINT `fk_raza_mascota` FOREIGN KEY (`idRaza`) REFERENCES `raza` (`idRaza`),
  ADD CONSTRAINT `fk_usuario_mascota` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`idU1`) REFERENCES `usuario` (`usuario`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`idU2`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`idChat`) REFERENCES `chat` (`idChat`),
  ADD CONSTRAINT `mensaje_ibfk_2` FOREIGN KEY (`propietario`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `fk_raza_especie` FOREIGN KEY (`idEspecie`) REFERENCES `especie` (`idEspecie`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
