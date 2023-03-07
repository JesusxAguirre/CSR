-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2023 a las 19:36:30
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `casa_sobre_la_roca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_usuario`
--

CREATE TABLE `bitacora_usuario` (
  `id` int(11) NOT NULL,
  `cedula_usuario` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `hora_registro` time NOT NULL,
  `accion_realizada` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora_usuario`
--

INSERT INTO `bitacora_usuario` (`id`, `cedula_usuario`, `id_modulo`, `fecha_registro`, `hora_registro`, `accion_realizada`) VALUES
(1, 27666555, 6, '2023-03-07', '14:34:09', 'Listar celula de Consolidacion'),
(2, 27666555, 2, '2023-03-07', '14:34:13', 'Listar casas sobre la roca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casas_la_roca`
--

CREATE TABLE `casas_la_roca` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `cedula_lider` int(11) NOT NULL,
  `nombre_anfitrion` varchar(20) NOT NULL,
  `telefono_anfitrion` varchar(20) DEFAULT NULL,
  `cantidad_personas_hogar` int(11) NOT NULL,
  `dia_visita` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_pautada` time NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celula_consolidacion`
--

CREATE TABLE `celula_consolidacion` (
  `id` int(11) NOT NULL,
  `codigo_celula_consolidacion` varchar(20) NOT NULL,
  `cedula_lider` int(11) NOT NULL,
  `cedula_anfitrion` int(11) NOT NULL,
  `cedula_asistente` int(11) NOT NULL,
  `dia_reunion` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celula_discipulado`
--

CREATE TABLE `celula_discipulado` (
  `id` int(11) NOT NULL,
  `codigo_celula_discipulado` varchar(20) NOT NULL,
  `cedula_lider` int(11) NOT NULL,
  `cedula_anfitrion` int(11) NOT NULL,
  `cedula_asistente` int(11) NOT NULL,
  `dia_reunion` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chatroom_prueba`
--

CREATE TABLE `chatroom_prueba` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `msg` varchar(10000) NOT NULL,
  `hora_msg` varchar(10) NOT NULL,
  `fecha_agregada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discipulos`
--

CREATE TABLE `discipulos` (
  `id` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_discipulado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `inicio` date NOT NULL,
  `final` date DEFAULT NULL,
  `oculto` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `graduados_ecam`
--

CREATE TABLE `graduados_ecam` (
  `cedulaGraduado` int(11) NOT NULL COMMENT 'Cedula de los graduados',
  `fecha_graduado` date NOT NULL COMMENT 'Fecha de graduacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermediaria`
--

CREATE TABLE `intermediaria` (
  `id_rol` int(11) NOT NULL,
  `id_permisos` int(11) NOT NULL,
  `id_modulos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `intermediaria`
--

INSERT INTO `intermediaria` (`id_rol`, `id_permisos`, `id_modulos`) VALUES
(4, 1, 3),
(4, 1, 12),
(4, 1, 14),
(3, 1, 14),
(2, 1, 3),
(2, 2, 3),
(2, 3, 3),
(2, 4, 3),
(2, 1, 5),
(2, 2, 5),
(2, 3, 5),
(2, 1, 6),
(2, 2, 6),
(2, 3, 6),
(2, 1, 12),
(2, 1, 14),
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 1, 2),
(1, 2, 2),
(1, 3, 2),
(1, 4, 2),
(1, 1, 3),
(1, 2, 3),
(1, 3, 3),
(1, 4, 3),
(1, 1, 4),
(1, 2, 4),
(1, 3, 4),
(1, 4, 4),
(1, 1, 5),
(1, 2, 5),
(1, 3, 5),
(1, 4, 5),
(1, 1, 6),
(1, 2, 6),
(1, 3, 6),
(1, 4, 6),
(1, 1, 7),
(1, 1, 8),
(1, 1, 10),
(1, 1, 11),
(1, 1, 12),
(1, 1, 13),
(1, 2, 13),
(1, 3, 13),
(1, 4, 13),
(1, 1, 14),
(1, 2, 14),
(1, 3, 14),
(1, 4, 14),
(1, 1, 15),
(1, 2, 15),
(1, 3, 15),
(1, 4, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(10) NOT NULL COMMENT 'ID de la materia',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la materia',
  `nivelAcademico` varchar(15) NOT NULL COMMENT 'Nivel de doctrina que pertenece',
  `fecha_creacion` date NOT NULL COMMENT 'Fecha de creacion de la materia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`) VALUES
(1, 'gestionar_usuario'),
(2, 'casa_sobre_la_roca'),
(3, 'ecam'),
(4, 'gestionar_roles'),
(5, 'celula_discipulado'),
(6, 'celula_consolidacion'),
(7, 'reporte_estadistico_ecam'),
(8, 'reporte_estadistico_celulas'),
(10, 'bitacora_usuario'),
(11, 'envio_correo'),
(12, 'notificaciones'),
(13, 'seguridad'),
(14, 'agenda'),
(15, 'agenda_oculta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notafinal_estudiantes`
--

CREATE TABLE `notafinal_estudiantes` (
  `id_seccion` int(11) NOT NULL,
  `cedulaEstudiante` int(10) NOT NULL,
  `notaFinal` double NOT NULL,
  `nivelAcademico` tinyint(11) NOT NULL,
  `fecha_agregada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notamateria_estudiantes`
--

CREATE TABLE `notamateria_estudiantes` (
  `id_seccion` int(20) NOT NULL COMMENT 'Seccion del estudiante',
  `id_materia` int(10) NOT NULL COMMENT 'Materia ',
  `cedula` int(11) NOT NULL COMMENT 'Cedula del estudiante',
  `nota` tinyint(2) NOT NULL COMMENT 'Nota final de la materia',
  `fecha_agregado` date DEFAULT NULL COMMENT 'Fecha de cuando se agrego la nota'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones_estudiantes`
--

CREATE TABLE `notificaciones_estudiantes` (
  `id_seccion` int(11) DEFAULT NULL,
  `cedula_estudiante` int(11) DEFAULT NULL,
  `accion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora_registro` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones_profesores`
--

CREATE TABLE `notificaciones_profesores` (
  `cedula_profesor` int(11) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `hora_registro` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes_consolidacion`
--

CREATE TABLE `participantes_consolidacion` (
  `id` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_consolidacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(1, 'listar'),
(2, 'crear'),
(3, 'actualizar'),
(4, 'eliminar'),
(6, 'reporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores-materias`
--

CREATE TABLE `profesores-materias` (
  `cedula_profesor` int(10) NOT NULL COMMENT 'Cedula del profesor',
  `id_materia` int(10) NOT NULL COMMENT 'ID de la materia del profesor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para vincular las materias con los profesores';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_casas`
--

CREATE TABLE `reportes_casas` (
  `id` int(11) NOT NULL,
  `id_casa` int(11) NOT NULL,
  `cantidad_h` int(11) NOT NULL,
  `cantidad_m` int(11) NOT NULL,
  `cantidad_n` int(11) NOT NULL,
  `confesiones` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_celula_consolidacion`
--

CREATE TABLE `reporte_celula_consolidacion` (
  `id` int(11) NOT NULL,
  `id_consolidacion` int(11) NOT NULL,
  `cedula_participante` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_celula_discipulado`
--

CREATE TABLE `reporte_celula_discipulado` (
  `id` int(11) NOT NULL,
  `id_discipulado` int(11) NOT NULL,
  `cedula_participante` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Super-Usuario', 'Gestión total del sistema'),
(2, 'Administrador', 'Permisos estándar'),
(3, 'Invitado', NULL),
(4, 'Estudiante', 'Estudiantes de la ECAM, fase de iniciacion en la CSR'),
(6, 'Analista', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_seccion` int(20) NOT NULL COMMENT 'ID de la seccion',
  `nombre` varchar(200) NOT NULL,
  `nivel_academico` tinyint(3) NOT NULL COMMENT 'Nivel de doctrina de la seccion',
  `status_seccion` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Status para cerrar la seccion y no perder datos',
  `fecha_creacion` date DEFAULT NULL COMMENT 'fecha de creacion de la seccion',
  `fecha_cierre` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id_seccion`, `nombre`, `nivel_academico`, `status_seccion`, `fecha_creacion`, `fecha_cierre`) VALUES
(14, 'Real Madrid', 1, 1, '2022-11-07', '2023-03-23'),
(21, 'Prueba', 1, 0, NULL, '2023-03-23'),
(23, 'Los Desarrolladores', 1, 1, '2023-03-07', '2023-03-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones-cerradas-estudiantes`
--

CREATE TABLE `secciones-cerradas-estudiantes` (
  `id_seccion` int(11) NOT NULL COMMENT 'ID de seccion cerrada',
  `cedula_estudiante` int(11) NOT NULL COMMENT 'Cedula de los estudiantes que estuvieron',
  `nota_final` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones-materias-profesores`
--

CREATE TABLE `secciones-materias-profesores` (
  `id_seccion` int(20) NOT NULL COMMENT 'ID de la seccion',
  `id_materia` int(10) NOT NULL COMMENT 'ID de las materias que tiene',
  `cedulaProf` int(11) NOT NULL COMMENT 'Cedula del profesor ',
  `contenido` mediumtext DEFAULT NULL COMMENT 'contenido de la materia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `nacionalidad` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status_profesor` tinyint(1) NOT NULL DEFAULT 0,
  `id_seccion` int(11) DEFAULT NULL,
  `ruta_imagen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `id_rol`, `codigo`, `nombre`, `apellido`, `edad`, `sexo`, `estado_civil`, `nacionalidad`, `estado`, `usuario`, `telefono`, `password`, `status_profesor`, `id_seccion`, `ruta_imagen`) VALUES
(1938492, 2, '1938492-N1-VE-LA-H-S-CC1', 'Julian', 'Montoya', 31, 'hombre', 'soltero', 'Venezolana', 'Lara', 'example14@gmail.com', '04128483939', '$2y$10$UUgCsGzKrWuDNl8tVh6PauMbG7doa/Iu4B7jQmAiW4FqU4YlL1NNS', 0, 23, ''),
(2344664, 2, '2344664-N2-VE-LA-H-S', 'Mario', 'vergolini', 23, 'hombre', 'soltero', 'venezolana', 'lara', 'ejemplo3@gmail.com', '04124356323', '$2y$10$e0el0JChw98unbRo4CaCt.ieMHHY.lWsKCldNjRasgE/gPBKm/JRS', 1, NULL, ''),
(2345698, 4, '2345698-N1-VE-LA-H-S', 'Elmo', 'Yeja', 24, 'hombre', 'soltero', 'Venezolana', 'Lara', 'elmo@gmail.com', '04147813456', '$2y$10$I25elHPoKYpEr9oy3etrbehgk/W4/fUay9HG/qz1GanfTPZ9cPtwW', 0, NULL, ''),
(16634134, 2, '16634134-N2-VE-LA-M-M', 'Adriana', 'Rey', 29, 'mujer', 'matrimonio', 'venezolana', 'lara', 'example3@gmail.com', '04169439282', '$2y$10$zH.1RfUaj8819b1BciGSKOZ2EN3rEBb2Ssm09MmNHdSbrB7xrVz1e', 0, NULL, ''),
(17462321, 2, '17462321-N2-VE-YA-H-S', 'Alejandro', 'Abondano', 32, 'hombre', 'soltero', 'venezolana', 'yaracuy', 'example4@gmail.com', '04249842019', '$2y$10$Nn9TGobsq9/xW8Wk/tUlJuY4A6R0tZIuwkpWn8T3enQED69JZNYUu', 0, NULL, ''),
(17940293, 2, '17940293-N1-VE-CS-H-S', 'Sebastian', 'Romero', 31, 'hombre', 'soltero', 'venezolana', 'css', 'example12@gmail.com', '04124848393', '$2y$10$nA3E3/ykFzqu6GwC0Ub7WOrcrbJBBOEgVqoVPefH65QbeeXU3U7HK', 0, 23, ''),
(19482134, 2, '19482134-N2-VE-YA-M-S', 'Adriana', 'Hernadez', 31, 'mujer', 'soltera', 'venezolana', 'yaracuy', 'example2@gmail.com', '04124849329', '$2y$10$H51s0jFmLFcL2BZ0kN4fkumgP1fwVivYuUrmJyk6OVdnARaHUfAEa', 1, NULL, ''),
(19839293, 2, '19839293-N1-VE-LA-M-S', 'Ivonne', 'Barrera', 34, 'mujer', 'soltera', 'venezolana', 'lara', 'example8@gmail.com', '04168483929', '$2y$10$0XCs0BYg8Qwhf9Q0hH18qOaJ3hR7XQ0DaIZ0ra4K.oqOV.zNjIqi.', 0, 23, ''),
(23098543, 2, '23098543-N1-VE-LA-H-M', 'Elva', 'Ritzto', 72, 'hombre', 'matrimonio', 'Venezolana', 'Lara', 'elva@gmail.com', '04123864589', '$2y$10$zS8ff//FbjzhzC6rpnJIL.TKz1xy94pSl5nAT8ap2n07Sxr2K4X6e', 0, 23, NULL),
(24453432, 2, '24453432-N1-VE-CS-M-S', 'Laura', 'Puerto', 22, 'mujer', 'soltera', 'Venezolana', 'Css', 'example17@gmail.com', '04127473824', '$2y$10$/Z54Ap0lkXl6ptsCeFSxfulJWzezTaR/wPkjGrDJybbtw1FvR7EkC', 0, 23, ''),
(24566423, 2, '24566423-N1-VE-LA-H-M', 'Luis', 'Marchan', 34, 'hombre', 'matrimonio', 'Venezolana', 'Lara', 'example16@gmail.com', '04128473823', '$2y$10$XkDLO0ua5y7ULpwKXQ7e7.rObAE9Y4uLkvl8KxSQyznz2AoB04JP2', 0, 23, ''),
(24939239, 2, '24939239-N1-VE-LA-H-M', 'Leonardo', 'Garcia', 25, 'hombre', 'matrimonio', 'venezolana', 'lara', 'example13@gmail.com', '04128483948', '$2y$10$2bKJOTW7nUl7uezHdHW1V.RiFfgvTut7i6xRDs60oC0LoAEbVA5nG', 0, 23, ''),
(25463123, 2, '25463123-N1-VE-CS-H-M', 'Luis', 'Marl', 33, 'hombre', 'matrimonio', 'venezolana', 'css', 'example@gmail.com', '04123454431', '$2y$10$urAWtdIlACN.PDVHGPm8vefJJDV5KFDeGOv.1Dixez34gwe6y9dya', 0, 23, ''),
(25838291, 2, '25838291-N1-VE-CS-M-M', 'Andrea', 'Acero', 25, 'mujer', 'matrimonio', 'venezolana', 'css', 'example6@gmail.com', '04123948502', '$2y$10$JaCOBVrU9cbJO4RW9tZUL.L3vZN6B/HaCfFtyJPCCRjieFS4FQjn6', 0, 23, ''),
(26423422, 2, '26423422-N1-VE-LA-H-M', 'Angel', 'Raftal', 26, 'hombre', 'matrimonio', 'venezolana', 'lara', 'example15@gmail.com', '04124858393', '$2y$10$.QWbpdV8J.BVVwrXtxQ38uAvlMAjAXZUUm2PLzjt/HWyG5WoVw7ku', 0, 23, ''),
(26584892, 2, '26584892-N1-VE-LA-H-S', 'Ivan', 'Coral', 24, 'hombre', 'soltero', 'venezolana', 'lara', 'example7@gmail.com', '04149382929', '$2y$10$pkHsYyoXBVChhWd/xmijS.HStNFxqEQ.Id.5UDs3a9aqZjNq6lKoy', 0, 23, ''),
(27199177, 2, '27199177-N2-VE-LA-H-S', 'Jesus', 'Canelon', 22, 'hombre', 'soltero', 'Venezolana', 'Lara', 'can3lon3000@gmail.com', '04143545920', '$2y$10$iCZ1q05zgvRrvgvoameQT.AhN.JWf.4KADChqKK35.jC9rgIcHK3.', 0, NULL, ''),
(27666555, 1, '27666555-N2-VE-LA-H-S', 'Jesus', 'Aguirre', 23, 'hombre', 'Soltero', 'Venezolano', 'Lara', 'quijess6@gmail.com', '04244444444', '$2y$10$JiFhT/xRJTwwxlyfbK2qtumDfEjWlbx2Z7ih5.1Tqm4bFMuRDm0.6', 1, NULL, 'resources/imagenes-usuarios/IMG_20220408_125402.jpg'),
(28732728, 2, '28732728-N1-VE-CS-H-S', 'Jorge', 'Orozco', 25, 'hombre', 'soltero', 'venezolana', 'css', 'example10@gmail.com', '04169402021', '$2y$10$J6kDasP4XqUnjtcFn61vjORJy.rjFLckOBhKffvordwt9c6ydRdAu', 0, 23, ''),
(29432394, 2, '29432394-N1-VE-CS-M-S', 'Jenny', 'Sanchez', 28, 'mujer', 'soltera', 'venezolana', 'css', 'example9@gmail.com', '04129403913', '$2y$10$pnuNl5FXvamdHBmodURa9eRwzV9uUyur16A3GAeknKk7scNNG.Jbi', 0, 23, ''),
(30948394, 2, '30948394-N1-VE-CS-H-S', 'Alexander', 'Carvajal', 15, 'hombre', 'soltero', 'venezolana', 'css', 'example5@gmail.com', '04268493029', '$2y$10$EIfxHpIw91qjiM4.Y9hQeeL6wOcRjU8HEtkfAnphVNSaBElo9OREW', 0, 23, ''),
(32328382, 2, '32328382-N1-VE-CS-H-S', 'Juan', 'Ortega', 14, 'hombre', 'soltero', 'venezolana', 'css', 'example11@gmail.com', '04128384943', '$2y$10$lqpfJt0Jg.R6VnDUsbfBOOOzpN4sAM/.PUuTo0gZO8oLYqmD3RwKG', 0, 23, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora_usuario`
--
ALTER TABLE `bitacora_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula_usuario` (`cedula_usuario`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `casas_la_roca`
--
ALTER TABLE `casas_la_roca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula_lider` (`cedula_lider`);

--
-- Indices de la tabla `celula_consolidacion`
--
ALTER TABLE `celula_consolidacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula_lider` (`cedula_lider`),
  ADD KEY `cedula_anfitrion` (`cedula_anfitrion`),
  ADD KEY `cedula_asistente` (`cedula_asistente`);

--
-- Indices de la tabla `celula_discipulado`
--
ALTER TABLE `celula_discipulado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula_lider` (`cedula_lider`),
  ADD KEY `cedula_anfitrion` (`cedula_anfitrion`),
  ADD KEY `cedula_asistente` (`cedula_asistente`);

--
-- Indices de la tabla `chatroom_prueba`
--
ALTER TABLE `chatroom_prueba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `discipulos`
--
ALTER TABLE `discipulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_discipulado` (`id_discipulado`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `intermediaria`
--
ALTER TABLE `intermediaria`
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_permisos` (`id_permisos`),
  ADD KEY `id_modulos` (`id_modulos`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notafinal_estudiantes`
--
ALTER TABLE `notafinal_estudiantes`
  ADD KEY `idSeccionFinal` (`id_seccion`),
  ADD KEY `cedulaEstudianteFinal` (`cedulaEstudiante`);

--
-- Indices de la tabla `notamateria_estudiantes`
--
ALTER TABLE `notamateria_estudiantes`
  ADD KEY `cedulaEstudiante` (`cedula`),
  ADD KEY `seccionEstudiante` (`id_seccion`),
  ADD KEY `materiaEstudiante` (`id_materia`);

--
-- Indices de la tabla `notificaciones_estudiantes`
--
ALTER TABLE `notificaciones_estudiantes`
  ADD KEY `seccionNotificacion` (`id_seccion`),
  ADD KEY `cedulaEst_notificacion` (`cedula_estudiante`);

--
-- Indices de la tabla `notificaciones_profesores`
--
ALTER TABLE `notificaciones_profesores`
  ADD KEY `cedulaProf_notificacion` (`cedula_profesor`);

--
-- Indices de la tabla `participantes_consolidacion`
--
ALTER TABLE `participantes_consolidacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_consolidacion` (`id_consolidacion`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesores-materias`
--
ALTER TABLE `profesores-materias`
  ADD KEY `cedulaProfesor` (`cedula_profesor`),
  ADD KEY `materiaProfesor` (`id_materia`);

--
-- Indices de la tabla `reportes_casas`
--
ALTER TABLE `reportes_casas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_casa` (`id_casa`);

--
-- Indices de la tabla `reporte_celula_consolidacion`
--
ALTER TABLE `reporte_celula_consolidacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_consolidacion` (`id_consolidacion`),
  ADD KEY `cedula_participante` (`cedula_participante`);

--
-- Indices de la tabla `reporte_celula_discipulado`
--
ALTER TABLE `reporte_celula_discipulado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_discipulado` (`id_discipulado`),
  ADD KEY `cedula_participante` (`cedula_participante`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `secciones-cerradas-estudiantes`
--
ALTER TABLE `secciones-cerradas-estudiantes`
  ADD KEY `idSeccion_cerrada` (`id_seccion`),
  ADD KEY `cedulaEst_pasado` (`cedula_estudiante`);

--
-- Indices de la tabla `secciones-materias-profesores`
--
ALTER TABLE `secciones-materias-profesores`
  ADD KEY `cedulaProf` (`cedulaProf`),
  ADD KEY `seccion` (`id_seccion`),
  ADD KEY `materia` (`id_materia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `usuarios_idSeccion` (`id_seccion`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora_usuario`
--
ALTER TABLE `bitacora_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `casas_la_roca`
--
ALTER TABLE `casas_la_roca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `celula_consolidacion`
--
ALTER TABLE `celula_consolidacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `celula_discipulado`
--
ALTER TABLE `celula_discipulado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chatroom_prueba`
--
ALTER TABLE `chatroom_prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `discipulos`
--
ALTER TABLE `discipulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID de la materia';

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `participantes_consolidacion`
--
ALTER TABLE `participantes_consolidacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reportes_casas`
--
ALTER TABLE `reportes_casas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reporte_celula_consolidacion`
--
ALTER TABLE `reporte_celula_consolidacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reporte_celula_discipulado`
--
ALTER TABLE `reporte_celula_discipulado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_seccion` int(20) NOT NULL AUTO_INCREMENT COMMENT 'ID de la seccion', AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora_usuario`
--
ALTER TABLE `bitacora_usuario`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bitacora_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `casas_la_roca`
--
ALTER TABLE `casas_la_roca`
  ADD CONSTRAINT `casas_ibfk_1` FOREIGN KEY (`cedula_lider`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `celula_consolidacion`
--
ALTER TABLE `celula_consolidacion`
  ADD CONSTRAINT `celulac_ibfk_1` FOREIGN KEY (`cedula_lider`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `celulac_ibfk_2` FOREIGN KEY (`cedula_anfitrion`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `celulac_ibfk_3` FOREIGN KEY (`cedula_asistente`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `celula_discipulado`
--
ALTER TABLE `celula_discipulado`
  ADD CONSTRAINT `celulad_ibfk_1` FOREIGN KEY (`cedula_lider`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `celulad_ibfk_2` FOREIGN KEY (`cedula_anfitrion`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `celulad_ibfk_3` FOREIGN KEY (`cedula_asistente`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `chatroom_prueba`
--
ALTER TABLE `chatroom_prueba`
  ADD CONSTRAINT `cedula_usuario` FOREIGN KEY (`user`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `discipulos`
--
ALTER TABLE `discipulos`
  ADD CONSTRAINT `discipulos_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `discipulos_ibfk_2` FOREIGN KEY (`id_discipulado`) REFERENCES `celula_discipulado` (`id`);

--
-- Filtros para la tabla `intermediaria`
--
ALTER TABLE `intermediaria`
  ADD CONSTRAINT `intermediaria_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `intermediaria_ibfk_2` FOREIGN KEY (`id_permisos`) REFERENCES `permisos` (`id`),
  ADD CONSTRAINT `intermediaria_ibfk_3` FOREIGN KEY (`id_modulos`) REFERENCES `modulos` (`id`);

--
-- Filtros para la tabla `notafinal_estudiantes`
--
ALTER TABLE `notafinal_estudiantes`
  ADD CONSTRAINT `cedulaEstudianteFinal` FOREIGN KEY (`cedulaEstudiante`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSeccionFinal` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notamateria_estudiantes`
--
ALTER TABLE `notamateria_estudiantes`
  ADD CONSTRAINT `cedulaEstudiante` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materiaEstudiante` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seccionEstudiante` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones_estudiantes`
--
ALTER TABLE `notificaciones_estudiantes`
  ADD CONSTRAINT `cedulaEst_notificacion` FOREIGN KEY (`cedula_estudiante`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seccionNotificacion` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones_profesores`
--
ALTER TABLE `notificaciones_profesores`
  ADD CONSTRAINT `cedulaProf_notificacion` FOREIGN KEY (`cedula_profesor`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participantes_consolidacion`
--
ALTER TABLE `participantes_consolidacion`
  ADD CONSTRAINT `participantes_consolidacion_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `participantes_consolidacion_ibfk_2` FOREIGN KEY (`id_consolidacion`) REFERENCES `celula_consolidacion` (`id`);

--
-- Filtros para la tabla `profesores-materias`
--
ALTER TABLE `profesores-materias`
  ADD CONSTRAINT `cedulaProfesor` FOREIGN KEY (`cedula_profesor`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materiaProfesor` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reportes_casas`
--
ALTER TABLE `reportes_casas`
  ADD CONSTRAINT `reportesc_ibfk_1` FOREIGN KEY (`id_casa`) REFERENCES `casas_la_roca` (`id`);

--
-- Filtros para la tabla `reporte_celula_consolidacion`
--
ALTER TABLE `reporte_celula_consolidacion`
  ADD CONSTRAINT `rcelulaf_ibfk_1` FOREIGN KEY (`id_consolidacion`) REFERENCES `celula_consolidacion` (`id`),
  ADD CONSTRAINT `rceulaf_ibfk_2` FOREIGN KEY (`cedula_participante`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporte_celula_discipulado`
--
ALTER TABLE `reporte_celula_discipulado`
  ADD CONSTRAINT `rcelulad_ibfk_1` FOREIGN KEY (`id_discipulado`) REFERENCES `celula_discipulado` (`id`),
  ADD CONSTRAINT `rceulad_ibfk_2` FOREIGN KEY (`cedula_participante`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `secciones-cerradas-estudiantes`
--
ALTER TABLE `secciones-cerradas-estudiantes`
  ADD CONSTRAINT `cedulaEst_pasado` FOREIGN KEY (`cedula_estudiante`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSeccion_cerrada` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `secciones-materias-profesores`
--
ALTER TABLE `secciones-materias-profesores`
  ADD CONSTRAINT `cedulaProf` FOREIGN KEY (`cedulaProf`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materia` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seccion` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_idSeccion` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_idrool` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
