-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 05:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `casa_sobre_la_roca`
--

-- --------------------------------------------------------

--
-- Table structure for table `bitacora_usuario`
--

CREATE TABLE `bitacora_usuario` (
  `id` int(11) NOT NULL,
  `cedula_usuario` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `hora_registro` time NOT NULL,
  `accion_realizada` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bitacora_usuario`
--

INSERT INTO `bitacora_usuario` (`id`, `cedula_usuario`, `id_modulo`, `fecha_registro`, `hora_registro`, `accion_realizada`) VALUES
(2414, 27666555, 2, '2023-03-16', '12:20:14', 'Listar lideres sin casa sobre la roca'),
(2415, 27666555, 2, '2023-03-16', '12:30:08', 'Listar lideres sin casa sobre la roca'),
(2416, 27666555, 2, '2023-03-16', '13:42:02', 'Listar lideres sin casa sobre la roca'),
(2417, 27666555, 2, '2023-03-16', '13:42:17', 'Listar lideres sin casa sobre la roca'),
(2418, 2345698, 2, '2023-03-16', '13:42:34', 'Listar lideres sin casa sobre la roca'),
(2419, 2345698, 1, '2023-03-16', '13:42:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(2420, 27666555, 2, '2023-03-16', '13:45:53', 'Listar lideres sin casa sobre la roca'),
(2421, 27666555, 2, '2023-03-16', '13:45:53', 'Listar lideres sin casa sobre la roca'),
(2422, 27666555, 2, '2023-03-16', '13:46:13', 'Listar lideres sin casa sobre la roca'),
(2423, 27666555, 2, '2023-03-16', '13:48:04', 'Listar lideres sin casa sobre la roca'),
(2424, 27666555, 2, '2023-03-16', '13:49:11', 'Listar lideres sin casa sobre la roca'),
(2425, 27666555, 2, '2023-03-16', '13:49:13', 'Listar lideres sin casa sobre la roca'),
(2426, 2345698, 2, '2023-03-16', '13:49:17', 'Listar lideres sin casa sobre la roca'),
(2427, 27666555, 2, '2023-03-16', '13:49:31', 'Listar lideres sin casa sobre la roca'),
(2428, 2345698, 2, '2023-03-16', '13:54:07', 'Listar lideres sin casa sobre la roca'),
(2429, 2345698, 1, '2023-03-16', '13:54:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(2430, 27666555, 2, '2023-03-16', '13:56:05', 'Listar lideres sin casa sobre la roca'),
(2431, 27666555, 2, '2023-03-16', '14:09:42', 'Listar lideres sin casa sobre la roca'),
(2432, 27666555, 2, '2023-03-16', '14:10:30', 'Listar lideres sin casa sobre la roca'),
(2433, 2345698, 2, '2023-03-16', '14:24:00', 'Listar lideres sin casa sobre la roca'),
(2434, 2345698, 2, '2023-03-16', '14:24:22', 'Listar lideres sin casa sobre la roca'),
(2435, 2345698, 1, '2023-03-16', '14:24:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(2436, 2345698, 2, '2023-03-16', '14:25:12', 'Listar lideres sin casa sobre la roca'),
(2437, 2345698, 1, '2023-03-16', '14:25:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(2438, 27666555, 2, '2023-03-16', '14:48:01', 'Listar lideres sin casa sobre la roca'),
(2439, 27666555, 2, '2023-03-16', '14:48:08', 'Listar lideres sin casa sobre la roca'),
(2440, 2345698, 2, '2023-03-16', '14:48:25', 'Listar lideres sin casa sobre la roca'),
(2441, 2345698, 2, '2023-03-16', '14:48:36', 'Listar lideres sin casa sobre la roca'),
(2442, 2345698, 1, '2023-03-16', '14:48:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(2443, 27666555, 3, '2023-03-16', '15:00:46', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2444, 27666555, 2, '2023-03-16', '16:49:41', 'Listar lideres sin casa sobre la roca'),
(2445, 27666555, 3, '2023-03-16', '16:49:45', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2446, 27666555, 3, '2023-03-16', '16:50:02', 'El usuario ha agregado mas estudiante a una seccion'),
(2447, 27666555, 3, '2023-03-16', '16:50:11', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(2448, 27666555, 3, '2023-03-16', '16:50:17', 'El usuario ha entrado al apartado de Agregar Materias'),
(2449, 27666555, 3, '2023-03-16', '16:50:24', 'Ha agregado una materia nueva llamada Materia'),
(2450, 27666555, 3, '2023-03-16', '16:50:28', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2451, 27666555, 3, '2023-03-16', '16:50:32', 'El usuario ha actualizado las materias y profesores de una seccion'),
(2452, 27666555, 3, '2023-03-16', '16:50:42', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(2453, 27666555, 3, '2023-03-16', '16:50:43', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2454, 27666555, 3, '2023-03-16', '16:50:47', 'Le ha agregado nota de la materia Materia a un estudiante de la seccion pruebita'),
(2455, 27666555, 3, '2023-03-16', '16:50:50', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2456, 27666555, 3, '2023-03-16', '16:58:50', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2457, 27666555, 3, '2023-03-16', '16:58:50', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2458, 27666555, 3, '2023-03-16', '16:58:51', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2459, 27666555, 3, '2023-03-16', '16:58:51', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2460, 27666555, 3, '2023-03-16', '16:58:51', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2461, 27666555, 3, '2023-03-16', '16:59:27', 'El usuario ha actualizado los datos de una seccion'),
(2462, 27666555, 3, '2023-03-16', '17:00:40', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2463, 27666555, 3, '2023-03-16', '17:02:51', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2464, 27666555, 3, '2023-03-16', '17:02:51', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2465, 27666555, 3, '2023-03-16', '17:03:06', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2466, 27666555, 3, '2023-03-16', '17:03:36', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2467, 27666555, 3, '2023-03-16', '17:04:04', 'El usuario ha actualizado los datos de una seccion'),
(2468, 27666555, 3, '2023-03-16', '17:04:12', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(2469, 27666555, 3, '2023-03-16', '17:04:13', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2470, 27666555, 3, '2023-03-16', '17:04:14', 'Ha eliminado la nota de la materia Materia a un estudiante de la seccion pruebita'),
(2471, 27666555, 3, '2023-03-16', '17:04:18', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2472, 27666555, 3, '2023-03-16', '17:04:24', 'El usuario ha actualizado los datos de una seccion'),
(2473, 27666555, 3, '2023-03-16', '17:06:49', 'El usuario ha actualizado los datos de una seccion'),
(2474, 27666555, 3, '2023-03-16', '17:06:57', 'El usuario ha actualizado los datos de una seccion'),
(2475, 27666555, 3, '2023-03-16', '17:07:07', 'El usuario ha actualizado los datos de una seccion'),
(2476, 27666555, 3, '2023-03-16', '17:07:57', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2477, 27666555, 3, '2023-03-16', '17:08:07', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2478, 27666555, 1, '2023-03-16', '19:06:43', 'Listar todos los usuarios'),
(2479, 27666555, 1, '2023-03-16', '19:07:50', 'Listar todos los usuarios'),
(2480, 27666555, 1, '2023-03-16', '19:08:25', 'Editar datos de usuario'),
(2481, 27666555, 1, '2023-03-16', '19:08:25', 'Listar todos los usuarios'),
(2482, 27666555, 1, '2023-03-16', '19:08:27', 'Listar todos los usuarios'),
(2483, 27666555, 1, '2023-03-16', '19:08:31', 'Editar datos de usuario'),
(2484, 27666555, 1, '2023-03-16', '19:08:31', 'Listar todos los usuarios'),
(2485, 27666555, 1, '2023-03-16', '19:08:33', 'Listar todos los usuarios'),
(2486, 27666555, 2, '2023-03-16', '19:14:01', 'Listar lideres sin casa sobre la roca'),
(2487, 27666555, 2, '2023-03-16', '21:04:49', 'Listar lideres sin casa sobre la roca'),
(2488, 27666555, 3, '2023-03-16', '21:04:51', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2489, 27666555, 3, '2023-03-16', '21:05:05', 'El usuario ha agregado mas estudiante a una seccion'),
(2490, 27666555, 3, '2023-03-16', '21:05:11', 'El usuario ha actualizado las materias y profesores de una seccion'),
(2491, 27666555, 3, '2023-03-16', '21:05:16', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(2492, 27666555, 3, '2023-03-16', '21:05:17', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2493, 27666555, 3, '2023-03-16', '21:05:20', 'Le ha agregado nota de la materia Materia a un estudiante de la seccion pruebita'),
(2494, 27666555, 3, '2023-03-16', '21:05:28', 'Ha actualizado la nota de la materia Materia a un estudiante de la seccion pruebita'),
(2495, 27666555, 3, '2023-03-16', '21:05:39', 'El usuario ha entrado a Control de Notas'),
(2496, 27666555, 3, '2023-03-16', '21:05:39', 'Has listado las notas finales de los estudiantes'),
(2497, 2345698, 3, '2023-03-16', '21:05:42', 'Ha agregado una nota final a un estudiante del nivel 1'),
(2498, 27666555, 3, '2023-03-16', '21:05:42', 'Has listado las notas finales de los estudiantes'),
(2499, 27666555, 3, '2023-03-16', '21:05:48', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(2500, 27666555, 3, '2023-03-16', '21:05:49', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2501, 27666555, 3, '2023-03-16', '21:06:05', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2502, 27666555, 3, '2023-03-16', '21:06:36', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2503, 27666555, 3, '2023-03-16', '21:07:23', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2504, 27666555, 3, '2023-03-16', '21:07:34', 'El usuario ha entrado a Control de Notas'),
(2505, 27666555, 3, '2023-03-16', '21:07:35', 'Has listado las notas finales de los estudiantes'),
(2506, 2345698, 3, '2023-03-16', '21:07:37', 'Se ha eliminado una nota final a un estudiante del nivel 1'),
(2507, 27666555, 3, '2023-03-16', '21:07:37', 'Has listado las notas finales de los estudiantes'),
(2508, 27666555, 3, '2023-03-16', '21:07:41', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(2509, 27666555, 3, '2023-03-16', '21:07:42', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2510, 27666555, 3, '2023-03-16', '21:07:45', 'Ha actualizado la nota de la materia Materia a un estudiante de la seccion pruebita'),
(2511, 27666555, 3, '2023-03-16', '21:07:48', 'Ha eliminado la nota de la materia Materia a un estudiante de la seccion pruebita'),
(2512, 27666555, 3, '2023-03-16', '21:57:25', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2513, 27666555, 3, '2023-03-16', '21:57:25', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2514, 27666555, 3, '2023-03-16', '21:57:29', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(2515, 27666555, 3, '2023-03-16', '21:57:38', 'El usuario ha actualizado los datos de una materia del Nivel 2'),
(2516, 27666555, 3, '2023-03-16', '21:57:48', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(2517, 27666555, 3, '2023-03-16', '21:57:49', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2518, 27666555, 3, '2023-03-16', '21:58:15', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(2519, 27666555, 3, '2023-03-16', '21:58:18', 'El usuario ha actualizado los datos de una materia del Nivel 1'),
(2520, 27666555, 3, '2023-03-16', '21:58:32', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(2521, 27666555, 3, '2023-03-16', '21:58:33', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2522, 27666555, 3, '2023-03-16', '21:58:36', 'Le ha agregado nota de la materia Materia a un estudiante de la seccion pruebita'),
(2523, 27666555, 3, '2023-03-16', '21:58:39', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(2524, 27666555, 3, '2023-03-16', '21:59:04', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(2525, 27666555, 3, '2023-03-16', '22:01:42', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(2526, 27666555, 3, '2023-03-16', '22:01:43', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(2527, 27666555, 3, '2023-03-16', '22:01:45', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(2528, 27666555, 3, '2023-03-16', '22:01:46', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(2529, 27666555, 3, '2023-03-16', '22:01:48', 'Ha eliminado la nota de la materia Materia a un estudiante de la seccion pruebita'),
(2530, 27666555, 3, '2023-03-16', '22:01:52', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(2531, 27666555, 3, '2023-03-16', '22:02:27', 'El usuario ha actualizado los datos de una materia del Nivel 2'),
(2532, 27666555, 3, '2023-03-16', '22:02:32', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2533, 27666555, 3, '2023-03-16', '22:02:39', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(2534, 27666555, 3, '2023-03-16', '22:02:43', 'El usuario ha actualizado los datos de una materia del Nivel 1'),
(2535, 27666555, 3, '2023-03-16', '22:02:50', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2536, 27666555, 3, '2023-03-16', '22:03:00', 'El usuario ha desvinculado a un estudiante de una seccion'),
(2537, 27666555, 3, '2023-03-16', '22:03:03', 'El usuario ha desvinculado a un estudiante de una seccion'),
(2538, 27666555, 3, '2023-03-16', '22:03:10', 'El usuario ha cerrado una seccion'),
(2539, 27666555, 3, '2023-03-16', '22:03:13', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(2540, 27666555, 3, '2023-03-16', '22:03:17', 'El usuario ha eliminado una seccion definitivamente'),
(2541, 27666555, 1, '2023-03-16', '22:48:57', 'Listar todos los usuarios'),
(2542, 27666555, 1, '2023-03-16', '22:49:04', 'Editar datos de usuario'),
(2543, 27666555, 1, '2023-03-16', '22:49:04', 'Listar todos los usuarios'),
(2544, 27666555, 1, '2023-03-16', '22:49:06', 'Listar todos los usuarios'),
(2545, 27666555, 1, '2023-03-16', '22:49:18', 'Listar todos los usuarios'),
(2546, 27666555, 1, '2023-03-16', '22:49:22', 'Buscar usuarios'),
(2547, 27666555, 1, '2023-03-16', '22:49:22', 'Buscar usuarios'),
(2548, 27666555, 1, '2023-03-16', '22:49:22', 'Buscar usuarios'),
(2549, 27666555, 1, '2023-03-16', '22:49:22', 'Buscar usuarios'),
(2550, 27666555, 1, '2023-03-16', '22:49:22', 'Buscar usuarios'),
(2551, 27666555, 1, '2023-03-16', '22:49:29', 'Editar datos de usuario'),
(2552, 27666555, 1, '2023-03-16', '22:49:29', 'Listar todos los usuarios'),
(2553, 27666555, 1, '2023-03-16', '22:49:31', 'Listar todos los usuarios'),
(2554, 27666555, 2, '2023-03-17', '00:12:02', 'Listar lideres sin casa sobre la roca'),
(2555, 27666555, 2, '2023-03-17', '13:59:19', 'Listar lideres sin casa sobre la roca'),
(2556, 27666555, 2, '2023-03-17', '14:13:07', 'Listar lideres sin casa sobre la roca'),
(2577, 27199177, 2, '2023-07-13', '22:01:29', 'Listar lideres sin casa sobre la roca'),
(2578, 27199177, 1, '2023-07-13', '22:01:35', 'Listar todos los usuarios'),
(2579, 27199177, 1, '2023-07-13', '22:05:20', 'Listar todos los usuarios'),
(2580, 27199177, 1, '2023-07-13', '22:48:51', 'Listar todos los usuarios'),
(2581, 27199177, 1, '2023-07-13', '22:49:39', 'Listar todos los usuarios'),
(2582, 27199177, 1, '2023-07-13', '22:49:49', 'Listar todos los usuarios'),
(2583, 27199177, 1, '2023-07-13', '22:50:37', 'Listar todos los usuarios'),
(2584, 27199177, 1, '2023-07-13', '22:51:00', 'Listar todos los usuarios'),
(2585, 27199177, 1, '2023-07-13', '22:51:00', 'Listar todos los usuarios'),
(2586, 27199177, 1, '2023-07-13', '22:51:11', 'Listar todos los usuarios'),
(2587, 27199177, 1, '2023-07-13', '22:51:13', 'Listar todos los usuarios'),
(2588, 27199177, 1, '2023-07-13', '22:51:13', 'Listar todos los usuarios'),
(2589, 27199177, 1, '2023-07-13', '22:51:14', 'Listar todos los usuarios'),
(2590, 27199177, 1, '2023-07-13', '22:51:42', 'Listar todos los usuarios'),
(2591, 27199177, 1, '2023-07-13', '22:52:44', 'Listar todos los usuarios'),
(2592, 27199177, 1, '2023-07-13', '22:54:01', 'Listar todos los usuarios'),
(2593, 27199177, 1, '2023-07-13', '22:55:10', 'Listar todos los usuarios'),
(2594, 27199177, 1, '2023-07-13', '22:55:37', 'Listar todos los usuarios'),
(2595, 27199177, 1, '2023-07-13', '22:56:31', 'Listar todos los usuarios'),
(2596, 27199177, 1, '2023-07-13', '22:56:53', 'Listar todos los usuarios'),
(2597, 27199177, 1, '2023-07-13', '22:57:03', 'Listar todos los usuarios'),
(2598, 27199177, 1, '2023-07-13', '22:57:21', 'Listar todos los usuarios'),
(2599, 27199177, 1, '2023-07-13', '22:57:41', 'Listar todos los usuarios'),
(2600, 27199177, 1, '2023-07-13', '22:58:57', 'Listar todos los usuarios'),
(2601, 27199177, 1, '2023-07-13', '23:00:17', 'Listar todos los usuarios'),
(2602, 27199177, 1, '2023-07-13', '23:00:24', 'Listar todos los usuarios'),
(2603, 27199177, 1, '2023-07-13', '23:00:24', 'Listar todos los usuarios'),
(2604, 27199177, 1, '2023-07-13', '23:00:54', 'Listar todos los usuarios'),
(2605, 27199177, 1, '2023-07-13', '23:02:17', 'Listar todos los usuarios'),
(2606, 27199177, 3, '2023-07-13', '23:30:25', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2607, 27199177, 3, '2023-07-13', '23:30:53', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2608, 27199177, 1, '2023-07-13', '23:34:59', 'Listar todos los usuarios'),
(2609, 27199177, 1, '2023-07-13', '23:35:09', 'Listar todos los usuarios'),
(2610, 27199177, 1, '2023-07-13', '23:35:35', 'Editar datos de usuario'),
(2611, 27199177, 1, '2023-07-13', '23:35:35', 'Listar todos los usuarios'),
(2612, 27199177, 1, '2023-07-13', '23:35:39', 'Listar todos los usuarios'),
(2613, 27199177, 2, '2023-07-13', '23:35:43', 'Listar lideres sin casa sobre la roca'),
(2614, 27985245, 2, '2023-07-13', '23:36:10', 'Listar lideres sin casa sobre la roca'),
(2615, 27985245, 1, '2023-07-13', '23:36:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(2616, 27985245, 3, '2023-07-13', '23:36:13', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(2617, 27985245, 2, '2023-07-13', '23:37:04', 'Listar lideres sin casa sobre la roca'),
(2618, 27199177, 2, '2023-07-13', '23:38:04', 'Listar lideres sin casa sobre la roca'),
(2619, 27199177, 1, '2023-07-13', '23:38:08', 'Listar todos los usuarios'),
(2620, 27199177, 1, '2023-07-13', '23:42:18', 'Listar todos los usuarios'),
(2621, 27199177, 1, '2023-07-13', '23:47:06', 'Listar todos los usuarios'),
(2622, 27199177, 1, '2023-07-13', '23:49:06', 'Listar todos los usuarios'),
(2623, 27199177, 1, '2023-07-13', '23:52:58', 'Listar todos los usuarios'),
(2624, 27199177, 1, '2023-07-13', '23:52:58', 'Listar todos los usuarios'),
(2625, 27199177, 1, '2023-07-13', '23:53:46', 'Listar todos los usuarios'),
(2626, 27199177, 1, '2023-07-13', '23:53:46', 'Listar todos los usuarios'),
(2627, 27199177, 1, '2023-07-13', '23:54:00', 'Listar todos los usuarios'),
(2628, 27199177, 1, '2023-07-13', '23:54:00', 'Listar todos los usuarios'),
(2629, 27199177, 3, '2023-07-14', '00:33:30', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(2630, 27199177, 2, '2023-07-14', '00:33:56', 'Listar lideres sin casa sobre la roca'),
(2631, 27199177, 3, '2023-07-14', '00:33:58', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(2632, 27199177, 3, '2023-07-14', '00:34:05', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(2633, 27199177, 3, '2023-07-14', '00:34:10', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(2634, 27199177, 3, '2023-07-14', '00:34:15', 'El usuario ha entrado a Control de Notas'),
(2635, 27199177, 3, '2023-07-14', '00:34:15', 'Has listado las notas finales de los estudiantes'),
(2636, 27199177, 3, '2023-07-14', '00:34:36', 'El usuario ha entrado a Control de Notas'),
(2637, 27199177, 3, '2023-07-14', '00:34:36', 'Has listado las notas finales de los estudiantes'),
(2638, 27199177, 1, '2023-07-14', '00:35:44', 'Listar todos los usuarios'),
(2639, 27199177, 1, '2023-07-14', '00:35:44', 'Listar todos los usuarios'),
(2640, 27199177, 1, '2023-07-14', '00:36:24', 'Listar todos los usuarios'),
(2641, 27199177, 1, '2023-07-14', '00:36:24', 'Listar todos los usuarios'),
(2642, 27199177, 1, '2023-07-14', '00:38:36', 'Listar todos los usuarios'),
(2643, 27199177, 1, '2023-07-14', '00:38:36', 'Listar todos los usuarios'),
(2644, 27199177, 1, '2023-07-14', '00:38:57', 'Listar todos los usuarios'),
(2645, 27199177, 1, '2023-07-14', '00:38:57', 'Listar todos los usuarios'),
(2646, 27199177, 1, '2023-07-14', '00:38:59', 'Listar todos los usuarios'),
(2647, 27199177, 1, '2023-07-14', '00:38:59', 'Listar todos los usuarios'),
(2648, 27199177, 1, '2023-07-14', '00:39:01', 'Listar todos los usuarios'),
(2649, 27199177, 1, '2023-07-14', '00:39:01', 'Listar todos los usuarios'),
(2650, 27199177, 1, '2023-07-14', '00:39:27', 'Listar todos los usuarios'),
(2651, 27199177, 1, '2023-07-14', '00:39:27', 'Listar todos los usuarios'),
(2652, 27199177, 1, '2023-07-14', '00:40:45', 'Listar todos los usuarios'),
(2653, 27199177, 1, '2023-07-14', '00:40:45', 'Listar todos los usuarios'),
(2654, 27199177, 1, '2023-07-14', '00:48:41', 'Listar todos los usuarios'),
(2655, 27199177, 1, '2023-07-14', '00:48:41', 'Listar todos los usuarios'),
(2656, 27199177, 1, '2023-07-14', '00:48:47', 'Listar todos los usuarios'),
(2657, 27199177, 1, '2023-07-14', '00:48:47', 'Listar todos los usuarios'),
(2658, 27199177, 1, '2023-07-14', '00:48:54', 'Listar todos los usuarios'),
(2659, 27199177, 1, '2023-07-14', '00:48:54', 'Listar todos los usuarios'),
(2660, 27199177, 1, '2023-07-14', '00:50:55', 'Listar todos los usuarios'),
(2661, 27199177, 1, '2023-07-14', '00:50:55', 'Listar todos los usuarios'),
(2662, 27199177, 1, '2023-07-14', '00:51:07', 'Listar todos los usuarios'),
(2663, 27199177, 1, '2023-07-14', '00:51:07', 'Listar todos los usuarios'),
(2664, 27199177, 1, '2023-07-14', '00:52:48', 'Listar todos los usuarios'),
(2665, 27199177, 1, '2023-07-14', '00:52:48', 'Listar todos los usuarios'),
(2666, 27199177, 1, '2023-07-14', '00:55:44', 'Listar todos los usuarios'),
(2667, 27199177, 1, '2023-07-14', '00:55:44', 'Listar todos los usuarios'),
(2668, 27199177, 1, '2023-07-14', '00:55:58', 'Listar todos los usuarios'),
(2669, 27199177, 1, '2023-07-14', '00:55:58', 'Listar todos los usuarios'),
(2670, 27199177, 1, '2023-07-14', '00:56:43', 'Listar todos los usuarios'),
(2671, 27199177, 1, '2023-07-14', '00:56:43', 'Listar todos los usuarios'),
(2672, 27199177, 1, '2023-07-14', '00:57:07', 'Listar todos los usuarios'),
(2673, 27199177, 1, '2023-07-14', '00:57:08', 'Listar todos los usuarios'),
(2674, 27199177, 1, '2023-07-14', '00:57:30', 'Listar todos los usuarios'),
(2675, 27199177, 1, '2023-07-14', '00:57:30', 'Listar todos los usuarios'),
(2676, 27199177, 1, '2023-07-14', '00:57:49', 'Listar todos los usuarios'),
(2677, 27199177, 1, '2023-07-14', '00:57:49', 'Listar todos los usuarios'),
(2678, 27199177, 1, '2023-07-14', '00:58:08', 'Listar todos los usuarios'),
(2679, 27199177, 1, '2023-07-14', '00:58:08', 'Listar todos los usuarios'),
(2680, 27199177, 1, '2023-07-14', '00:58:24', 'Listar todos los usuarios'),
(2681, 27199177, 1, '2023-07-14', '00:58:24', 'Listar todos los usuarios'),
(2682, 27199177, 1, '2023-07-14', '00:58:33', 'Listar todos los usuarios'),
(2683, 27199177, 1, '2023-07-14', '00:58:44', 'Listar todos los usuarios'),
(2684, 27199177, 1, '2023-07-14', '00:58:53', 'Listar todos los usuarios'),
(2685, 27199177, 1, '2023-07-14', '00:58:53', 'Listar todos los usuarios'),
(2686, 27199177, 1, '2023-07-14', '00:59:05', 'Listar todos los usuarios'),
(2687, 27199177, 1, '2023-07-14', '00:59:05', 'Listar todos los usuarios'),
(2688, 27199177, 1, '2023-07-14', '00:59:28', 'Listar todos los usuarios'),
(2689, 27199177, 1, '2023-07-14', '00:59:30', 'Listar todos los usuarios'),
(2690, 27199177, 1, '2023-07-14', '01:00:04', 'Listar todos los usuarios'),
(2691, 27199177, 1, '2023-07-14', '01:00:11', 'Listar todos los usuarios'),
(2692, 27199177, 1, '2023-07-14', '01:00:11', 'Listar todos los usuarios'),
(2693, 27199177, 1, '2023-07-14', '01:00:27', 'Listar todos los usuarios'),
(2694, 27199177, 1, '2023-07-14', '01:00:27', 'Listar todos los usuarios'),
(2695, 27199177, 1, '2023-07-14', '01:07:44', 'Listar todos los usuarios'),
(2696, 27199177, 1, '2023-07-14', '01:07:44', 'Listar todos los usuarios'),
(2697, 27199177, 1, '2023-07-14', '01:10:58', 'Listar todos los usuarios'),
(2698, 27199177, 1, '2023-07-14', '01:10:58', 'Listar todos los usuarios'),
(2699, 27199177, 1, '2023-07-14', '01:11:23', 'Listar todos los usuarios'),
(2700, 27199177, 1, '2023-07-14', '01:11:23', 'Listar todos los usuarios'),
(2701, 27199177, 1, '2023-07-14', '01:12:50', 'Listar todos los usuarios'),
(2702, 27199177, 1, '2023-07-14', '01:12:50', 'Listar todos los usuarios'),
(2703, 27199177, 1, '2023-07-14', '01:13:36', 'Listar todos los usuarios'),
(2704, 27199177, 1, '2023-07-14', '01:13:37', 'Listar todos los usuarios'),
(2705, 27199177, 1, '2023-07-14', '01:15:19', 'Listar todos los usuarios'),
(2706, 27199177, 1, '2023-07-14', '01:15:19', 'Listar todos los usuarios'),
(2707, 27199177, 1, '2023-07-14', '01:15:23', 'Listar todos los usuarios'),
(2708, 27199177, 1, '2023-07-14', '01:15:23', 'Listar todos los usuarios'),
(2709, 27199177, 1, '2023-07-14', '01:18:01', 'Listar todos los usuarios'),
(2710, 27199177, 1, '2023-07-14', '01:18:01', 'Listar todos los usuarios'),
(2711, 27199177, 1, '2023-07-14', '01:18:04', 'Listar todos los usuarios'),
(2712, 27199177, 1, '2023-07-14', '01:18:04', 'Listar todos los usuarios'),
(2713, 27199177, 1, '2023-07-14', '01:18:11', 'Listar todos los usuarios'),
(2714, 27199177, 1, '2023-07-14', '01:18:11', 'Listar todos los usuarios'),
(2715, 27199177, 1, '2023-07-14', '01:21:32', 'Listar todos los usuarios'),
(2716, 27199177, 1, '2023-07-14', '01:21:32', 'Listar todos los usuarios'),
(2717, 27199177, 1, '2023-07-14', '01:22:09', 'Listar todos los usuarios'),
(2718, 27199177, 1, '2023-07-14', '01:22:09', 'Listar todos los usuarios'),
(2719, 27199177, 1, '2023-07-14', '01:22:39', 'Listar todos los usuarios'),
(2720, 27199177, 1, '2023-07-14', '01:22:40', 'Listar todos los usuarios'),
(2721, 27199177, 1, '2023-07-14', '01:22:50', 'Listar todos los usuarios'),
(2722, 27199177, 1, '2023-07-14', '01:22:50', 'Listar todos los usuarios'),
(2723, 27199177, 1, '2023-07-14', '01:22:55', 'Listar todos los usuarios'),
(2724, 27199177, 1, '2023-07-14', '01:22:55', 'Listar todos los usuarios'),
(2725, 27199177, 1, '2023-07-14', '01:23:09', 'Listar todos los usuarios'),
(2726, 27199177, 1, '2023-07-14', '01:23:09', 'Listar todos los usuarios'),
(2727, 27199177, 1, '2023-07-14', '01:23:40', 'Listar todos los usuarios'),
(2728, 27199177, 1, '2023-07-14', '01:23:40', 'Listar todos los usuarios'),
(2729, 27199177, 1, '2023-07-14', '01:24:49', 'Listar todos los usuarios'),
(2730, 27199177, 1, '2023-07-14', '01:24:49', 'Listar todos los usuarios'),
(2731, 27199177, 1, '2023-07-14', '01:39:11', 'Listar todos los usuarios'),
(2732, 27199177, 1, '2023-07-14', '01:39:11', 'Listar todos los usuarios'),
(2733, 27199177, 1, '2023-07-14', '01:40:03', 'Listar todos los usuarios'),
(2734, 27199177, 1, '2023-07-14', '01:40:03', 'Listar todos los usuarios'),
(2735, 27199177, 1, '2023-07-14', '02:14:35', 'Listar todos los usuarios'),
(2736, 27199177, 1, '2023-07-14', '02:14:35', 'Listar todos los usuarios'),
(2737, 27199177, 1, '2023-07-14', '02:15:02', 'Listar todos los usuarios'),
(2738, 27199177, 1, '2023-07-14', '02:15:02', 'Listar todos los usuarios'),
(2739, 27199177, 1, '2023-07-14', '02:28:50', 'Listar todos los usuarios'),
(2740, 27199177, 1, '2023-07-14', '02:28:50', 'Listar todos los usuarios'),
(2741, 27199177, 1, '2023-07-14', '02:35:35', 'Listar todos los usuarios'),
(2742, 27199177, 1, '2023-07-14', '02:35:35', 'Listar todos los usuarios'),
(2743, 27199177, 1, '2023-07-14', '02:42:16', 'Listar todos los usuarios'),
(2744, 27199177, 1, '2023-07-14', '02:42:16', 'Listar todos los usuarios'),
(2745, 27199177, 1, '2023-07-14', '02:46:52', 'Listar todos los usuarios'),
(2746, 27199177, 1, '2023-07-14', '02:46:52', 'Listar todos los usuarios'),
(2747, 27199177, 1, '2023-07-14', '02:48:00', 'Listar todos los usuarios'),
(2748, 27199177, 1, '2023-07-14', '02:48:00', 'Listar todos los usuarios'),
(2749, 27199177, 1, '2023-07-14', '02:51:14', 'Listar todos los usuarios'),
(2750, 27199177, 1, '2023-07-14', '02:52:25', 'Listar todos los usuarios'),
(2751, 27199177, 1, '2023-07-14', '02:53:00', 'Listar todos los usuarios'),
(2752, 27199177, 1, '2023-07-14', '02:53:03', 'Listar todos los usuarios'),
(2753, 27199177, 1, '2023-07-14', '02:53:57', 'Listar todos los usuarios'),
(2754, 27199177, 1, '2023-07-14', '10:22:49', 'Listar todos los usuarios'),
(2755, 27199177, 1, '2023-07-14', '10:24:18', 'Listar todos los usuarios'),
(2756, 27199177, 1, '2023-07-14', '10:25:38', 'Listar todos los usuarios'),
(2757, 27199177, 1, '2023-07-14', '10:26:51', 'Listar todos los usuarios'),
(2758, 27199177, 1, '2023-07-14', '10:26:51', 'Listar todos los usuarios'),
(2759, 27199177, 1, '2023-07-14', '10:27:23', 'Listar todos los usuarios'),
(2760, 27199177, 1, '2023-07-14', '10:27:30', 'Listar todos los usuarios'),
(2761, 27199177, 1, '2023-07-14', '10:27:50', 'Listar todos los usuarios'),
(2762, 27199177, 1, '2023-07-14', '10:30:11', 'Listar todos los usuarios'),
(2763, 27199177, 1, '2023-07-14', '10:31:25', 'Listar todos los usuarios'),
(2764, 27199177, 1, '2023-07-14', '10:32:42', 'Listar todos los usuarios'),
(2765, 27199177, 1, '2023-07-14', '10:33:01', 'Listar todos los usuarios'),
(2766, 27199177, 1, '2023-07-14', '10:33:10', 'Listar todos los usuarios'),
(2767, 27199177, 1, '2023-07-14', '10:33:25', 'Listar todos los usuarios'),
(2768, 27199177, 1, '2023-07-14', '10:33:34', 'Listar todos los usuarios'),
(2769, 27199177, 1, '2023-07-14', '10:33:34', 'Listar todos los usuarios'),
(2770, 27199177, 1, '2023-07-14', '10:33:52', 'Listar todos los usuarios'),
(2771, 27199177, 1, '2023-07-14', '10:34:57', 'Listar todos los usuarios'),
(2772, 27199177, 1, '2023-07-14', '10:35:28', 'Listar todos los usuarios'),
(2773, 27199177, 1, '2023-07-14', '10:35:46', 'Listar todos los usuarios'),
(2774, 27199177, 1, '2023-07-14', '10:38:24', 'Listar todos los usuarios'),
(2775, 27199177, 1, '2023-07-14', '10:38:38', 'Listar todos los usuarios'),
(2776, 27199177, 1, '2023-07-14', '10:41:14', 'Listar todos los usuarios'),
(2777, 27199177, 1, '2023-07-14', '10:41:47', 'Listar todos los usuarios'),
(2778, 27199177, 1, '2023-07-14', '10:41:53', 'Listar todos los usuarios'),
(2779, 27199177, 1, '2023-07-14', '10:42:05', 'Listar todos los usuarios'),
(2780, 27199177, 1, '2023-07-14', '10:43:35', 'Listar todos los usuarios'),
(2781, 27199177, 1, '2023-07-14', '10:43:43', 'Listar todos los usuarios'),
(2782, 27199177, 1, '2023-07-14', '10:43:53', 'Listar todos los usuarios'),
(2783, 27199177, 1, '2023-07-14', '10:45:08', 'Listar todos los usuarios'),
(2784, 27199177, 1, '2023-07-14', '10:47:35', 'Listar todos los usuarios'),
(2785, 27199177, 1, '2023-07-14', '10:49:22', 'Listar todos los usuarios'),
(2786, 27199177, 1, '2023-07-14', '10:50:46', 'Listar todos los usuarios'),
(2787, 27199177, 1, '2023-07-14', '10:51:33', 'Listar todos los usuarios'),
(2788, 27199177, 1, '2023-07-14', '10:52:04', 'Listar todos los usuarios'),
(2789, 27199177, 1, '2023-07-14', '10:52:18', 'Listar todos los usuarios'),
(2790, 27199177, 1, '2023-07-14', '10:52:32', 'Listar todos los usuarios'),
(2791, 27199177, 1, '2023-07-14', '10:53:07', 'Listar todos los usuarios'),
(2792, 27199177, 1, '2023-07-14', '10:53:21', 'Listar todos los usuarios'),
(2793, 27199177, 1, '2023-07-14', '10:53:30', 'Listar todos los usuarios'),
(2794, 27199177, 1, '2023-07-14', '10:53:40', 'Listar todos los usuarios'),
(2795, 27199177, 1, '2023-07-14', '10:54:32', 'Listar todos los usuarios'),
(2796, 27199177, 2, '2023-07-14', '10:54:42', 'Listar lideres sin casa sobre la roca'),
(2797, 27199177, 2, '2023-07-14', '16:29:10', 'Listar lideres sin casa sobre la roca'),
(2798, 27199177, 1, '2023-07-14', '16:29:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(2799, 27199177, 1, '2023-07-14', '16:29:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(2800, 27199177, 1, '2023-07-14', '16:30:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(2801, 27199177, 2, '2023-07-14', '16:30:54', 'Listar lideres sin casa sobre la roca'),
(2802, 27199177, 2, '2023-07-14', '16:34:08', 'Listar lideres sin casa sobre la roca'),
(2803, 27199177, 1, '2023-07-14', '16:34:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(2804, 27199177, 1, '2023-07-14', '17:00:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(2805, 27199177, 1, '2023-07-14', '17:01:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(2806, 27199177, 1, '2023-07-14', '17:05:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(2807, 27199177, 1, '2023-07-14', '17:09:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(2808, 27199177, 1, '2023-07-14', '17:10:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(2809, 27199177, 1, '2023-07-14', '17:11:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(2810, 27199177, 1, '2023-07-14', '17:11:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(2811, 27199177, 1, '2023-07-14', '17:11:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(2812, 27199177, 1, '2023-07-14', '17:11:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(2813, 27199177, 1, '2023-07-14', '17:12:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(2814, 27199177, 1, '2023-07-14', '17:13:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(2815, 27199177, 1, '2023-07-14', '17:14:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(2816, 27199177, 1, '2023-07-14', '17:19:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(2817, 27199177, 1, '2023-07-14', '17:19:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(2818, 27199177, 1, '2023-07-14', '17:19:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(2819, 27199177, 1, '2023-07-14', '17:29:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(2820, 27199177, 1, '2023-07-14', '17:29:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(2821, 27199177, 1, '2023-07-14', '17:30:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(2822, 27199177, 1, '2023-07-14', '17:30:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(2823, 27199177, 1, '2023-07-14', '17:30:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(2824, 27199177, 1, '2023-07-14', '17:31:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(2825, 27199177, 1, '2023-07-14', '17:31:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(2826, 27199177, 1, '2023-07-14', '17:34:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(2827, 27199177, 1, '2023-07-14', '17:34:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(2828, 27199177, 1, '2023-07-14', '17:35:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(2829, 27199177, 1, '2023-07-14', '17:36:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(2830, 27199177, 1, '2023-07-14', '17:37:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(2831, 27199177, 1, '2023-07-14', '18:08:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(2832, 27199177, 1, '2023-07-14', '18:08:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(2833, 27199177, 1, '2023-07-14', '18:13:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(2834, 27199177, 1, '2023-07-14', '18:13:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(2835, 27199177, 1, '2023-07-14', '18:13:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(2836, 27199177, 1, '2023-07-14', '18:13:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(2837, 27199177, 1, '2023-07-14', '18:13:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(2838, 27199177, 1, '2023-07-14', '18:13:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(2839, 27199177, 1, '2023-07-14', '18:14:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(2840, 27199177, 1, '2023-07-14', '18:14:16', 'El usuario ha entrado a \"Mi Perfil\"'),
(2841, 27199177, 1, '2023-07-14', '18:14:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(2842, 27199177, 1, '2023-07-14', '18:14:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(2843, 27199177, 1, '2023-07-14', '18:14:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(2844, 27199177, 1, '2023-07-14', '18:14:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(2845, 27199177, 1, '2023-07-14', '18:14:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(2846, 27199177, 1, '2023-07-14', '18:14:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(2847, 27199177, 1, '2023-07-14', '20:29:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(2848, 27199177, 1, '2023-07-14', '20:29:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(2849, 27199177, 1, '2023-07-14', '20:30:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(2850, 27199177, 1, '2023-07-14', '20:30:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(2851, 27199177, 1, '2023-07-14', '20:30:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(2852, 27199177, 1, '2023-07-14', '20:30:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(2853, 27199177, 1, '2023-07-14', '20:31:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(2854, 27199177, 1, '2023-07-14', '20:31:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(2855, 27199177, 1, '2023-07-14', '20:34:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(2856, 27199177, 1, '2023-07-14', '20:34:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(2857, 27199177, 1, '2023-07-14', '20:34:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(2858, 27199177, 1, '2023-07-14', '20:34:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(2859, 27199177, 1, '2023-07-14', '20:34:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(2860, 27199177, 1, '2023-07-14', '20:34:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(2861, 27199177, 1, '2023-07-14', '20:36:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(2862, 27199177, 1, '2023-07-14', '20:36:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(2863, 27199177, 1, '2023-07-14', '20:36:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(2864, 27199177, 1, '2023-07-14', '20:36:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(2865, 27199177, 1, '2023-07-14', '20:36:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(2866, 27199177, 1, '2023-07-14', '20:36:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(2867, 27199177, 1, '2023-07-14', '20:37:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(2868, 27199177, 1, '2023-07-14', '20:37:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(2869, 27199177, 1, '2023-07-14', '20:38:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(2870, 27199177, 1, '2023-07-14', '20:38:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(2871, 27199177, 1, '2023-07-14', '20:39:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(2872, 27199177, 1, '2023-07-14', '20:39:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(2873, 27199177, 1, '2023-07-14', '20:39:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(2874, 27199177, 1, '2023-07-14', '20:39:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(2875, 27199177, 1, '2023-07-14', '20:39:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(2876, 27199177, 1, '2023-07-14', '20:39:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(2877, 27199177, 1, '2023-07-14', '20:40:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(2878, 27199177, 1, '2023-07-14', '20:40:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(2879, 27199177, 1, '2023-07-14', '20:40:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(2880, 27199177, 1, '2023-07-14', '20:40:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(2881, 27199177, 1, '2023-07-14', '20:41:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(2882, 27199177, 1, '2023-07-14', '20:41:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(2883, 27199177, 1, '2023-07-14', '20:42:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(2884, 27199177, 1, '2023-07-14', '20:42:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(2885, 27199177, 1, '2023-07-14', '20:42:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(2886, 27199177, 1, '2023-07-14', '20:42:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(2887, 27199177, 1, '2023-07-14', '20:42:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(2888, 27199177, 1, '2023-07-14', '20:42:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(2889, 27199177, 2, '2023-07-14', '20:43:42', 'Listar lideres sin casa sobre la roca'),
(2890, 27199177, 1, '2023-07-14', '20:43:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(2891, 27199177, 1, '2023-07-14', '20:43:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(2892, 27199177, 1, '2023-07-14', '20:45:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(2893, 27199177, 1, '2023-07-14', '20:45:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(2894, 27199177, 1, '2023-07-14', '20:46:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(2895, 27199177, 1, '2023-07-14', '20:46:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(2896, 27199177, 1, '2023-07-14', '21:02:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(2897, 27199177, 1, '2023-07-14', '21:02:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(2898, 27199177, 1, '2023-07-14', '21:02:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(2899, 27199177, 1, '2023-07-14', '21:02:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(2900, 27199177, 1, '2023-07-14', '21:03:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(2901, 27199177, 1, '2023-07-14', '21:03:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(2902, 27199177, 1, '2023-07-14', '21:24:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(2903, 27199177, 1, '2023-07-14', '21:24:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(2904, 27199177, 1, '2023-07-14', '21:25:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2905, 27199177, 1, '2023-07-14', '21:25:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2906, 27199177, 1, '2023-07-14', '21:30:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(2907, 27199177, 1, '2023-07-14', '21:30:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(2908, 27199177, 1, '2023-07-14', '21:31:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(2909, 27199177, 1, '2023-07-14', '21:31:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(2910, 27199177, 1, '2023-07-14', '23:23:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(2911, 27199177, 1, '2023-07-14', '23:23:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(2912, 27199177, 1, '2023-07-14', '23:24:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(2913, 27199177, 1, '2023-07-14', '23:24:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(2914, 27199177, 1, '2023-07-14', '23:24:13', 'Listar todos los usuarios'),
(2915, 27199177, 1, '2023-07-14', '23:24:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(2916, 27199177, 1, '2023-07-14', '23:24:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(2917, 27199177, 1, '2023-07-16', '12:19:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(2918, 27199177, 1, '2023-07-16', '12:19:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(2919, 27199177, 1, '2023-07-16', '12:19:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(2920, 27199177, 1, '2023-07-16', '12:19:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(2921, 27199177, 1, '2023-07-16', '13:37:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(2922, 27199177, 1, '2023-07-16', '13:37:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(2923, 27199177, 1, '2023-07-16', '13:38:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(2924, 27199177, 1, '2023-07-16', '13:38:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(2925, 27199177, 1, '2023-07-16', '13:43:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(2926, 27199177, 1, '2023-07-16', '13:43:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(2927, 27199177, 1, '2023-07-16', '13:43:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(2928, 27199177, 1, '2023-07-16', '13:43:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(2929, 27199177, 1, '2023-07-16', '13:44:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(2930, 27199177, 1, '2023-07-16', '13:44:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(2931, 27199177, 1, '2023-07-16', '13:45:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(2932, 27199177, 1, '2023-07-16', '13:45:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(2933, 27199177, 1, '2023-07-16', '13:46:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(2934, 27199177, 1, '2023-07-16', '13:46:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(2935, 27199177, 1, '2023-07-16', '13:47:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2936, 27199177, 1, '2023-07-16', '13:47:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2937, 27199177, 1, '2023-07-16', '13:47:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(2938, 27199177, 1, '2023-07-16', '13:47:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(2939, 27199177, 1, '2023-07-16', '13:48:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(2940, 27199177, 1, '2023-07-16', '13:48:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(2941, 27199177, 1, '2023-07-16', '13:48:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(2942, 27199177, 1, '2023-07-16', '13:48:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(2943, 27199177, 1, '2023-07-16', '13:48:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(2944, 27199177, 1, '2023-07-16', '13:48:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(2945, 27199177, 1, '2023-07-16', '13:48:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(2946, 27199177, 1, '2023-07-16', '13:48:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(2947, 27199177, 1, '2023-07-16', '13:49:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2948, 27199177, 1, '2023-07-16', '13:49:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2949, 27199177, 1, '2023-07-16', '13:50:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(2950, 27199177, 1, '2023-07-16', '13:50:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2951, 27199177, 1, '2023-07-16', '13:51:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(2952, 27199177, 1, '2023-07-16', '13:51:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(2953, 27199177, 1, '2023-07-16', '13:51:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(2954, 27199177, 1, '2023-07-16', '13:51:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(2955, 27199177, 1, '2023-07-16', '13:53:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(2956, 27199177, 1, '2023-07-16', '13:53:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(2957, 27199177, 1, '2023-07-16', '13:53:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(2958, 27199177, 1, '2023-07-16', '13:53:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(2959, 27199177, 1, '2023-07-16', '13:54:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(2960, 27199177, 1, '2023-07-16', '13:54:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(2961, 27199177, 1, '2023-07-16', '13:54:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(2962, 27199177, 1, '2023-07-16', '13:54:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(2963, 27199177, 1, '2023-07-16', '13:55:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(2964, 27199177, 1, '2023-07-16', '13:55:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(2965, 27199177, 1, '2023-07-16', '13:55:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(2966, 27199177, 1, '2023-07-16', '13:55:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(2967, 27199177, 1, '2023-07-16', '13:56:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(2968, 27199177, 1, '2023-07-16', '13:56:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(2969, 27199177, 1, '2023-07-16', '13:56:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(2970, 27199177, 1, '2023-07-16', '13:56:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(2971, 27199177, 1, '2023-07-16', '13:57:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(2972, 27199177, 1, '2023-07-16', '13:57:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(2973, 27199177, 1, '2023-07-16', '13:57:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(2974, 27199177, 1, '2023-07-16', '13:57:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(2975, 27199177, 1, '2023-07-16', '14:01:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(2976, 27199177, 1, '2023-07-16', '14:01:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(2977, 27199177, 1, '2023-07-16', '14:01:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(2978, 27199177, 1, '2023-07-16', '14:01:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(2979, 27199177, 1, '2023-07-16', '14:57:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2980, 27199177, 1, '2023-07-16', '14:57:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2981, 27199177, 1, '2023-07-16', '14:57:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(2982, 27199177, 1, '2023-07-16', '14:57:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(2983, 27199177, 1, '2023-07-16', '14:58:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(2984, 27199177, 1, '2023-07-16', '14:58:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(2985, 27199177, 1, '2023-07-16', '14:59:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2986, 27199177, 1, '2023-07-16', '14:59:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(2987, 27199177, 1, '2023-07-16', '15:00:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(2988, 27199177, 1, '2023-07-16', '15:00:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(2989, 27199177, 1, '2023-07-16', '15:02:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(2990, 27199177, 1, '2023-07-16', '15:02:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(2991, 27199177, 1, '2023-07-16', '15:02:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(2992, 27199177, 1, '2023-07-16', '15:02:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(2993, 27199177, 1, '2023-07-16', '15:05:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(2994, 27199177, 1, '2023-07-16', '15:05:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(2995, 27199177, 1, '2023-07-16', '15:08:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(2996, 27199177, 1, '2023-07-16', '15:08:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(2997, 27199177, 1, '2023-07-16', '15:11:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(2998, 27199177, 1, '2023-07-16', '15:11:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(2999, 27199177, 1, '2023-07-16', '15:12:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3000, 27199177, 1, '2023-07-16', '15:12:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3001, 27199177, 1, '2023-07-16', '15:12:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3002, 27199177, 1, '2023-07-16', '15:12:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3003, 27199177, 1, '2023-07-16', '15:12:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3004, 27199177, 1, '2023-07-16', '15:12:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3005, 27199177, 1, '2023-07-16', '15:12:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(3006, 27199177, 1, '2023-07-16', '15:12:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(3007, 27199177, 1, '2023-07-16', '15:13:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3008, 27199177, 1, '2023-07-16', '15:13:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3009, 27199177, 1, '2023-07-16', '15:13:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3010, 27199177, 1, '2023-07-16', '15:13:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3011, 27199177, 1, '2023-07-16', '15:13:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3012, 27199177, 1, '2023-07-16', '15:13:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3013, 27199177, 1, '2023-07-16', '15:14:10', 'El usuario ha entrado a \"Mi Perfil\"');
INSERT INTO `bitacora_usuario` (`id`, `cedula_usuario`, `id_modulo`, `fecha_registro`, `hora_registro`, `accion_realizada`) VALUES
(3014, 27199177, 1, '2023-07-16', '15:14:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3015, 27199177, 1, '2023-07-16', '15:14:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3016, 27199177, 1, '2023-07-16', '15:14:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3017, 27199177, 1, '2023-07-16', '15:14:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3018, 27199177, 1, '2023-07-16', '15:14:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3019, 27199177, 1, '2023-07-16', '15:14:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3020, 27199177, 1, '2023-07-16', '15:14:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3021, 27199177, 1, '2023-07-16', '15:15:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(3022, 27199177, 1, '2023-07-16', '15:15:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(3023, 27199177, 1, '2023-07-16', '15:17:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(3024, 27199177, 1, '2023-07-16', '15:17:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(3025, 27199177, 1, '2023-07-16', '15:18:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3026, 27199177, 1, '2023-07-16', '15:18:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3027, 27199177, 1, '2023-07-16', '15:18:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3028, 27199177, 1, '2023-07-16', '15:18:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3029, 27199177, 1, '2023-07-16', '15:18:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3030, 27199177, 1, '2023-07-16', '15:18:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3031, 27199177, 1, '2023-07-16', '15:19:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3032, 27199177, 1, '2023-07-16', '15:19:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3033, 27199177, 1, '2023-07-16', '15:19:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3034, 27199177, 1, '2023-07-16', '15:19:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3035, 27199177, 1, '2023-07-16', '15:20:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3036, 27199177, 1, '2023-07-16', '15:20:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3037, 27199177, 1, '2023-07-16', '15:20:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3038, 27199177, 1, '2023-07-16', '15:20:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3039, 27199177, 1, '2023-07-16', '15:21:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3040, 27199177, 1, '2023-07-16', '15:21:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3041, 27199177, 1, '2023-07-16', '15:21:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3042, 27199177, 1, '2023-07-16', '15:21:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3043, 27199177, 1, '2023-07-16', '15:22:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3044, 27199177, 1, '2023-07-16', '15:22:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3045, 27199177, 1, '2023-07-16', '15:23:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3046, 27199177, 1, '2023-07-16', '15:23:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3047, 27199177, 1, '2023-07-16', '15:23:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3048, 27199177, 1, '2023-07-16', '15:23:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3049, 27199177, 1, '2023-07-16', '15:24:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3050, 27199177, 1, '2023-07-16', '15:24:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3051, 27199177, 1, '2023-07-16', '15:24:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3052, 27199177, 1, '2023-07-16', '15:24:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3053, 27199177, 1, '2023-07-16', '15:24:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3054, 27199177, 1, '2023-07-16', '15:24:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3055, 27199177, 1, '2023-07-16', '15:35:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3056, 27199177, 1, '2023-07-16', '15:35:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3057, 27199177, 1, '2023-07-16', '15:36:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3058, 27199177, 1, '2023-07-16', '15:36:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3059, 27199177, 1, '2023-07-16', '15:36:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3060, 27199177, 1, '2023-07-16', '15:36:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3061, 27199177, 1, '2023-07-16', '15:37:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3062, 27199177, 1, '2023-07-16', '15:37:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3063, 27199177, 1, '2023-07-16', '15:39:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3064, 27199177, 1, '2023-07-16', '15:39:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3065, 27199177, 1, '2023-07-16', '15:40:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3066, 27199177, 1, '2023-07-16', '15:40:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3067, 27199177, 1, '2023-07-16', '15:40:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3068, 27199177, 1, '2023-07-16', '15:40:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3069, 27199177, 1, '2023-07-16', '15:41:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3070, 27199177, 1, '2023-07-16', '15:41:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3071, 27199177, 1, '2023-07-16', '15:45:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3072, 27199177, 1, '2023-07-16', '15:45:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3073, 27199177, 1, '2023-07-16', '15:46:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3074, 27199177, 1, '2023-07-16', '15:46:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3075, 27199177, 1, '2023-07-16', '15:50:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3076, 27199177, 1, '2023-07-16', '15:50:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3077, 27199177, 1, '2023-07-16', '15:54:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3078, 27199177, 1, '2023-07-16', '15:54:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3079, 27199177, 1, '2023-07-16', '15:54:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3080, 27199177, 1, '2023-07-16', '15:54:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3081, 27199177, 1, '2023-07-16', '15:55:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3082, 27199177, 1, '2023-07-16', '15:55:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3083, 27199177, 1, '2023-07-16', '15:55:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3084, 27199177, 1, '2023-07-16', '15:55:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3085, 27199177, 1, '2023-07-16', '15:57:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3086, 27199177, 1, '2023-07-16', '15:57:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3087, 27199177, 1, '2023-07-16', '15:58:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3088, 27199177, 1, '2023-07-16', '15:58:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3089, 27199177, 1, '2023-07-16', '16:00:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3090, 27199177, 1, '2023-07-16', '16:00:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3091, 27199177, 1, '2023-07-16', '16:09:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3092, 27199177, 1, '2023-07-16', '16:09:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3093, 27199177, 1, '2023-07-16', '16:11:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3094, 27199177, 1, '2023-07-16', '16:11:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3095, 27199177, 1, '2023-07-16', '16:11:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3096, 27199177, 1, '2023-07-16', '16:11:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3097, 27199177, 1, '2023-07-16', '16:44:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3098, 27199177, 1, '2023-07-16', '16:44:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3099, 27199177, 1, '2023-07-16', '16:46:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3100, 27199177, 1, '2023-07-16', '16:46:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3101, 27199177, 1, '2023-07-16', '16:46:08', 'El usuario ha entrado a \"Mi Perfil\"'),
(3102, 27199177, 1, '2023-07-16', '16:46:08', 'El usuario ha entrado a \"Mi Perfil\"'),
(3103, 27199177, 1, '2023-07-16', '16:46:16', 'El usuario ha entrado a \"Mi Perfil\"'),
(3104, 27199177, 1, '2023-07-16', '16:46:16', 'El usuario ha entrado a \"Mi Perfil\"'),
(3105, 27199177, 1, '2023-07-16', '16:46:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3106, 27199177, 1, '2023-07-16', '16:46:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3107, 27199177, 1, '2023-07-16', '17:31:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3108, 27199177, 1, '2023-07-16', '17:31:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3109, 27199177, 1, '2023-07-16', '17:31:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3110, 27199177, 1, '2023-07-16', '17:31:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3111, 27199177, 1, '2023-07-16', '17:32:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3112, 27199177, 1, '2023-07-16', '17:32:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3113, 27199177, 1, '2023-07-16', '17:33:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3114, 27199177, 1, '2023-07-16', '17:33:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3115, 27199177, 1, '2023-07-16', '17:40:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3116, 27199177, 1, '2023-07-16', '17:40:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3117, 27199177, 1, '2023-07-16', '17:40:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3118, 27199177, 1, '2023-07-16', '17:40:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3119, 27199177, 1, '2023-07-16', '17:40:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3120, 27199177, 1, '2023-07-16', '17:40:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3121, 27199177, 1, '2023-07-16', '17:41:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3122, 27199177, 1, '2023-07-16', '17:42:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3123, 27199177, 1, '2023-07-16', '17:42:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3124, 27199177, 1, '2023-07-16', '17:42:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3125, 27199177, 1, '2023-07-16', '17:43:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3126, 27199177, 1, '2023-07-16', '17:43:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3127, 27199177, 1, '2023-07-16', '17:43:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3128, 27199177, 1, '2023-07-16', '17:44:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3129, 27199177, 1, '2023-07-16', '17:44:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3130, 27199177, 1, '2023-07-16', '17:44:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3131, 27199177, 1, '2023-07-16', '17:44:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3132, 27199177, 1, '2023-07-16', '17:44:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3133, 27199177, 1, '2023-07-16', '17:44:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3134, 27199177, 1, '2023-07-16', '17:45:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3135, 27199177, 1, '2023-07-16', '17:45:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(3136, 27199177, 1, '2023-07-16', '17:45:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3137, 27199177, 1, '2023-07-16', '17:45:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3138, 27199177, 1, '2023-07-16', '17:45:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(3139, 27199177, 1, '2023-07-16', '17:45:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3140, 27199177, 1, '2023-07-16', '17:46:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3141, 27199177, 1, '2023-07-16', '17:47:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(3142, 27199177, 1, '2023-07-16', '17:47:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3143, 27199177, 1, '2023-07-16', '17:47:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3144, 27199177, 1, '2023-07-16', '17:47:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3145, 27199177, 2, '2023-07-16', '17:47:39', 'Listar lideres sin casa sobre la roca'),
(3146, 27199177, 2, '2023-07-16', '17:47:55', 'Listar lideres sin casa sobre la roca'),
(3147, 27199177, 1, '2023-07-16', '17:47:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3148, 27199177, 1, '2023-07-16', '17:47:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(3149, 27199177, 1, '2023-07-16', '17:48:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3150, 27199177, 1, '2023-07-16', '17:48:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3151, 27199177, 1, '2023-07-16', '17:48:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3152, 27199177, 1, '2023-07-16', '17:48:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3153, 27199177, 1, '2023-07-16', '17:48:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3154, 27199177, 1, '2023-07-16', '17:49:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3155, 27199177, 1, '2023-07-16', '17:49:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(3156, 27199177, 1, '2023-07-16', '17:49:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3157, 27199177, 1, '2023-07-16', '17:50:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3158, 27199177, 1, '2023-07-16', '17:51:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3159, 27199177, 1, '2023-07-16', '17:51:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(3160, 27199177, 1, '2023-07-16', '17:51:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(3161, 27199177, 1, '2023-07-16', '17:52:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3162, 27199177, 1, '2023-07-16', '17:52:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3163, 27199177, 1, '2023-07-16', '17:52:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3164, 27199177, 1, '2023-07-16', '17:52:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3165, 27199177, 1, '2023-07-16', '17:57:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3166, 27199177, 1, '2023-07-16', '17:57:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3167, 27199177, 1, '2023-07-16', '17:58:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3168, 27199177, 1, '2023-07-16', '17:58:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3169, 27199177, 1, '2023-07-16', '17:58:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3170, 27199177, 1, '2023-07-16', '17:58:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3171, 27199177, 1, '2023-07-16', '17:58:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3172, 27199177, 1, '2023-07-16', '17:58:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(3173, 27199177, 1, '2023-07-16', '17:59:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3174, 27199177, 1, '2023-07-16', '17:59:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3175, 27199177, 1, '2023-07-16', '17:59:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3176, 27199177, 1, '2023-07-16', '18:00:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(3177, 27199177, 1, '2023-07-16', '18:00:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(3178, 27199177, 1, '2023-07-16', '18:03:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(3179, 27199177, 1, '2023-07-16', '18:03:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3180, 27199177, 1, '2023-07-16', '18:03:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3181, 27199177, 1, '2023-07-16', '18:06:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3182, 27199177, 1, '2023-07-16', '18:06:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3183, 27199177, 1, '2023-07-16', '18:07:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(3184, 27199177, 1, '2023-07-16', '18:07:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3185, 27199177, 1, '2023-07-16', '18:07:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3186, 27199177, 1, '2023-07-16', '18:07:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3187, 27199177, 1, '2023-07-16', '18:08:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3188, 27199177, 1, '2023-07-16', '18:08:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3189, 27199177, 1, '2023-07-16', '18:08:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3190, 27199177, 1, '2023-07-16', '18:08:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3191, 27199177, 1, '2023-07-16', '18:08:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3192, 27199177, 1, '2023-07-16', '18:08:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3193, 27199177, 2, '2023-07-16', '18:09:06', 'Listar lideres sin casa sobre la roca'),
(3194, 27199177, 2, '2023-07-16', '18:09:21', 'Listar lideres sin casa sobre la roca'),
(3195, 27199177, 1, '2023-07-16', '18:09:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3196, 27199177, 1, '2023-07-16', '18:09:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3197, 27199177, 1, '2023-07-16', '18:12:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3198, 27199177, 1, '2023-07-16', '18:12:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3199, 27199177, 1, '2023-07-16', '18:12:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3200, 27199177, 1, '2023-07-16', '18:13:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3201, 27199177, 1, '2023-07-16', '18:13:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3202, 27199177, 1, '2023-07-16', '18:13:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3203, 27199177, 1, '2023-07-16', '18:13:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3204, 27199177, 1, '2023-07-16', '18:13:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(3205, 27199177, 1, '2023-07-16', '18:20:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(3206, 27199177, 1, '2023-07-16', '18:20:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3207, 27199177, 1, '2023-07-16', '18:20:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3208, 27199177, 1, '2023-07-16', '18:20:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3209, 27199177, 1, '2023-07-16', '18:21:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3210, 27199177, 1, '2023-07-16', '18:21:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3211, 27199177, 1, '2023-07-16', '18:21:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3212, 27199177, 1, '2023-07-16', '18:23:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3213, 27199177, 1, '2023-07-16', '18:23:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3214, 27199177, 1, '2023-07-16', '18:23:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3215, 27199177, 1, '2023-07-16', '18:25:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3216, 27199177, 1, '2023-07-16', '18:25:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3217, 27199177, 1, '2023-07-16', '18:25:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(3218, 27199177, 1, '2023-07-16', '18:29:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3219, 27199177, 1, '2023-07-16', '18:29:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3220, 27199177, 1, '2023-07-16', '18:29:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3221, 27199177, 1, '2023-07-16', '18:29:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3222, 27199177, 1, '2023-07-16', '18:29:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3223, 27199177, 1, '2023-07-16', '18:29:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3224, 27199177, 1, '2023-07-16', '18:29:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3225, 27199177, 1, '2023-07-16', '18:29:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3226, 27199177, 2, '2023-07-16', '18:29:49', 'Listar lideres sin casa sobre la roca'),
(3227, 27199177, 2, '2023-07-16', '18:30:05', 'Listar lideres sin casa sobre la roca'),
(3228, 27199177, 1, '2023-07-16', '18:30:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(3229, 27199177, 1, '2023-07-16', '18:30:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(3230, 27199177, 1, '2023-07-16', '18:30:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3231, 27199177, 1, '2023-07-16', '18:30:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3232, 27199177, 1, '2023-07-16', '18:30:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3233, 27199177, 1, '2023-07-16', '18:30:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3234, 27199177, 1, '2023-07-16', '18:30:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3235, 27199177, 2, '2023-07-16', '18:31:21', 'Listar lideres sin casa sobre la roca'),
(3236, 27199177, 2, '2023-07-16', '18:32:47', 'Listar lideres sin casa sobre la roca'),
(3237, 27199177, 1, '2023-07-16', '18:32:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3238, 27199177, 1, '2023-07-16', '18:32:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3239, 27199177, 1, '2023-07-16', '18:34:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3240, 27199177, 1, '2023-07-16', '18:34:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3241, 27199177, 1, '2023-07-16', '18:34:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3242, 27199177, 1, '2023-07-16', '18:34:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3243, 27199177, 1, '2023-07-16', '18:34:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(3244, 27199177, 1, '2023-07-16', '18:36:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3245, 27199177, 1, '2023-07-16', '18:36:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3246, 27199177, 1, '2023-07-16', '18:36:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(3247, 27199177, 1, '2023-07-16', '18:36:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3248, 27199177, 1, '2023-07-16', '18:36:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3249, 27199177, 1, '2023-07-16', '18:36:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3250, 27199177, 1, '2023-07-16', '18:36:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3251, 27199177, 2, '2023-07-16', '18:36:51', 'Listar lideres sin casa sobre la roca'),
(3252, 27199177, 2, '2023-07-16', '18:37:43', 'Listar lideres sin casa sobre la roca'),
(3253, 27199177, 1, '2023-07-16', '18:37:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(3254, 27199177, 1, '2023-07-16', '18:37:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(3255, 27199177, 1, '2023-07-16', '18:38:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3256, 27199177, 1, '2023-07-16', '18:38:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3257, 27199177, 1, '2023-07-16', '18:38:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3258, 27199177, 2, '2023-07-16', '18:38:24', 'Listar lideres sin casa sobre la roca'),
(3259, 27199177, 2, '2023-07-16', '18:38:42', 'Listar lideres sin casa sobre la roca'),
(3260, 27199177, 2, '2023-07-16', '18:38:45', 'Listar lideres sin casa sobre la roca'),
(3261, 27199177, 2, '2023-07-16', '18:39:07', 'Listar lideres sin casa sobre la roca'),
(3262, 27199177, 2, '2023-07-16', '18:39:08', 'Listar lideres sin casa sobre la roca'),
(3263, 27199177, 2, '2023-07-16', '18:39:24', 'Listar lideres sin casa sobre la roca'),
(3264, 27199177, 1, '2023-07-16', '18:39:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(3265, 27199177, 1, '2023-07-16', '18:39:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(3266, 27199177, 1, '2023-07-16', '18:39:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3267, 27199177, 1, '2023-07-16', '18:40:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3268, 27199177, 1, '2023-07-16', '18:40:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3269, 27199177, 1, '2023-07-16', '18:41:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3270, 27199177, 2, '2023-07-16', '18:41:21', 'Listar lideres sin casa sobre la roca'),
(3271, 27199177, 2, '2023-07-16', '18:41:39', 'Listar lideres sin casa sobre la roca'),
(3272, 27199177, 1, '2023-07-16', '18:41:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3273, 27199177, 1, '2023-07-16', '18:41:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3274, 27199177, 1, '2023-07-16', '18:43:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3275, 27199177, 1, '2023-07-16', '18:43:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3276, 27199177, 1, '2023-07-16', '18:43:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3277, 27199177, 1, '2023-07-16', '18:44:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3278, 27199177, 1, '2023-07-16', '18:44:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(3279, 27199177, 1, '2023-07-16', '18:45:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3280, 27199177, 1, '2023-07-16', '18:45:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3281, 27199177, 1, '2023-07-16', '18:45:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3282, 27199177, 1, '2023-07-16', '18:45:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3283, 27199177, 1, '2023-07-16', '18:45:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(3284, 27199177, 1, '2023-07-16', '18:46:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3285, 27199177, 1, '2023-07-16', '18:46:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3286, 27199177, 1, '2023-07-16', '18:56:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3287, 27199177, 1, '2023-07-16', '18:56:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3288, 27199177, 1, '2023-07-16', '18:56:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3289, 27199177, 1, '2023-07-16', '18:56:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3290, 27199177, 1, '2023-07-16', '18:57:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3291, 27199177, 1, '2023-07-16', '18:57:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3292, 27199177, 1, '2023-07-16', '18:58:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3293, 27199177, 1, '2023-07-16', '18:58:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3294, 27199177, 1, '2023-07-16', '18:59:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3295, 27199177, 1, '2023-07-16', '18:59:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3296, 27199177, 2, '2023-07-16', '19:00:21', 'Listar lideres sin casa sobre la roca'),
(3297, 27199177, 2, '2023-07-16', '19:00:39', 'Listar lideres sin casa sobre la roca'),
(3298, 27199177, 2, '2023-07-16', '19:00:41', 'Listar lideres sin casa sobre la roca'),
(3299, 27199177, 2, '2023-07-18', '17:54:39', 'Listar lideres sin casa sobre la roca'),
(3300, 27199177, 2, '2023-07-18', '17:54:41', 'Listar lideres sin casa sobre la roca'),
(3301, 27199177, 2, '2023-07-18', '17:55:02', 'Listar lideres sin casa sobre la roca'),
(3302, 27199177, 1, '2023-07-18', '17:55:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3303, 27199177, 1, '2023-07-18', '17:55:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3304, 27199177, 1, '2023-07-18', '21:53:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3305, 27199177, 1, '2023-07-18', '21:53:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(3306, 27199177, 1, '2023-07-18', '21:54:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3307, 27199177, 1, '2023-07-18', '21:54:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3308, 27199177, 1, '2023-07-18', '22:19:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3309, 27199177, 1, '2023-07-18', '22:19:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3310, 27199177, 1, '2023-07-18', '22:20:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3311, 27199177, 1, '2023-07-18', '22:21:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3312, 27199177, 1, '2023-07-18', '22:21:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3313, 27199177, 1, '2023-07-18', '22:22:08', 'El usuario ha entrado a \"Mi Perfil\"'),
(3314, 27199177, 1, '2023-07-18', '22:23:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3315, 27199177, 1, '2023-07-18', '22:23:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3316, 27199177, 1, '2023-07-18', '22:23:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3317, 27199177, 1, '2023-07-18', '22:23:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3318, 27199177, 1, '2023-07-18', '22:23:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(3319, 27199177, 1, '2023-07-18', '22:23:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3320, 27199177, 1, '2023-07-18', '22:23:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3321, 27199177, 2, '2023-07-18', '22:30:17', 'Listar lideres sin casa sobre la roca'),
(3322, 27199177, 2, '2023-07-18', '22:32:04', 'Listar lideres sin casa sobre la roca'),
(3323, 27199177, 1, '2023-07-18', '22:32:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(3324, 27199177, 1, '2023-07-18', '22:32:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(3325, 27199177, 1, '2023-07-18', '22:32:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3326, 27199177, 1, '2023-07-18', '22:32:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(3327, 27199177, 1, '2023-07-18', '22:32:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(3328, 27199177, 1, '2023-07-18', '22:34:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3329, 27199177, 1, '2023-07-18', '22:34:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3330, 27199177, 1, '2023-07-18', '22:35:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3331, 27199177, 1, '2023-07-18', '22:35:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3332, 27199177, 1, '2023-07-18', '22:37:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3333, 27199177, 1, '2023-07-18', '22:37:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3334, 27199177, 1, '2023-07-18', '22:39:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3335, 27199177, 1, '2023-07-18', '22:39:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3336, 27199177, 1, '2023-07-18', '22:41:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3337, 27199177, 1, '2023-07-18', '22:41:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3338, 27199177, 1, '2023-07-18', '22:42:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3339, 27199177, 1, '2023-07-18', '22:42:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(3340, 27199177, 1, '2023-07-18', '22:42:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3341, 27199177, 1, '2023-07-18', '22:42:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3342, 27199177, 1, '2023-07-18', '22:43:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3343, 27199177, 1, '2023-07-18', '22:43:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3344, 27199177, 1, '2023-07-18', '22:43:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3345, 27199177, 1, '2023-07-18', '22:43:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3346, 27199177, 1, '2023-07-18', '22:46:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3347, 27199177, 1, '2023-07-18', '22:46:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3348, 27199177, 2, '2023-07-18', '22:47:06', 'Listar lideres sin casa sobre la roca'),
(3349, 27199177, 1, '2023-07-18', '22:47:08', 'El usuario ha entrado a \"Mi Perfil\"'),
(3350, 27199177, 1, '2023-07-18', '22:47:08', 'El usuario ha entrado a \"Mi Perfil\"'),
(3351, 27199177, 1, '2023-07-18', '22:53:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3352, 27199177, 1, '2023-07-18', '22:53:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3353, 27199177, 1, '2023-07-18', '22:53:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3354, 27199177, 1, '2023-07-18', '22:53:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3355, 27199177, 1, '2023-07-18', '23:04:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(3356, 27199177, 1, '2023-07-18', '23:04:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(3357, 27199177, 1, '2023-07-18', '23:04:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(3358, 27199177, 1, '2023-07-18', '23:04:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3359, 27199177, 1, '2023-07-18', '23:05:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3360, 27199177, 1, '2023-07-18', '23:05:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3361, 27199177, 1, '2023-07-18', '23:05:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3362, 27199177, 1, '2023-07-18', '23:05:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3363, 27199177, 1, '2023-07-18', '23:06:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3364, 27199177, 1, '2023-07-18', '23:06:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3365, 27199177, 1, '2023-07-18', '23:16:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3366, 27199177, 1, '2023-07-18', '23:16:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3367, 27199177, 1, '2023-07-18', '23:17:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3368, 27199177, 1, '2023-07-18', '23:17:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3369, 27199177, 1, '2023-07-18', '23:18:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3370, 27199177, 1, '2023-07-18', '23:18:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3371, 27199177, 1, '2023-07-18', '23:19:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3372, 27199177, 1, '2023-07-18', '23:19:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3373, 27199177, 1, '2023-07-18', '23:19:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3374, 27199177, 1, '2023-07-18', '23:19:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3375, 27199177, 1, '2023-07-18', '23:20:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3376, 27199177, 1, '2023-07-18', '23:20:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3377, 27199177, 1, '2023-07-18', '23:27:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3378, 27199177, 1, '2023-07-18', '23:27:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3379, 27199177, 1, '2023-07-18', '23:29:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3380, 27199177, 1, '2023-07-18', '23:33:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3381, 27199177, 1, '2023-07-18', '23:33:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3382, 27199177, 1, '2023-07-18', '23:33:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3383, 27199177, 1, '2023-07-18', '23:33:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3384, 27199177, 1, '2023-07-18', '23:43:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3385, 27199177, 1, '2023-07-18', '23:43:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3386, 27199177, 1, '2023-07-18', '23:44:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(3387, 27199177, 1, '2023-07-18', '23:44:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(3388, 27199177, 1, '2023-07-18', '23:44:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3389, 27199177, 1, '2023-07-18', '23:44:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3390, 27199177, 2, '2023-07-19', '16:00:15', 'Listar lideres sin casa sobre la roca'),
(3391, 27199177, 1, '2023-07-19', '16:00:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(3392, 27199177, 1, '2023-07-19', '16:00:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(3393, 27199177, 1, '2023-07-19', '16:00:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(3394, 27199177, 1, '2023-07-19', '16:00:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(3395, 27199177, 2, '2023-07-19', '16:01:18', 'Listar lideres sin casa sobre la roca'),
(3396, 27199177, 1, '2023-07-19', '16:01:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3397, 27199177, 1, '2023-07-19', '16:01:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3398, 27199177, 1, '2023-07-19', '16:03:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3399, 27199177, 1, '2023-07-19', '16:03:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3400, 27199177, 1, '2023-07-19', '16:08:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3401, 27199177, 1, '2023-07-19', '16:08:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3402, 27199177, 1, '2023-07-19', '16:12:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3403, 27199177, 1, '2023-07-19', '16:12:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3404, 27199177, 2, '2023-07-19', '16:12:45', 'Listar lideres sin casa sobre la roca'),
(3405, 27199177, 1, '2023-07-19', '16:12:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3406, 27199177, 1, '2023-07-19', '16:12:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3407, 27199177, 1, '2023-07-19', '16:13:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3408, 27199177, 1, '2023-07-19', '16:13:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3409, 27199177, 1, '2023-07-19', '16:15:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3410, 27199177, 1, '2023-07-19', '16:15:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3411, 27199177, 1, '2023-07-19', '16:18:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(3412, 27199177, 1, '2023-07-19', '16:18:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(3413, 27199177, 1, '2023-07-19', '16:22:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3414, 27199177, 1, '2023-07-19', '16:22:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3415, 27199177, 2, '2023-07-19', '16:23:31', 'Listar lideres sin casa sobre la roca'),
(3416, 27199177, 1, '2023-07-19', '16:23:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3417, 27199177, 1, '2023-07-19', '16:23:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3418, 27199177, 1, '2023-07-19', '16:26:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3419, 27199177, 1, '2023-07-19', '16:26:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3420, 27199177, 2, '2023-07-19', '16:27:03', 'Listar lideres sin casa sobre la roca'),
(3421, 27199177, 1, '2023-07-19', '16:27:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3422, 27199177, 1, '2023-07-19', '16:27:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3423, 27199177, 1, '2023-07-19', '16:28:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3424, 27199177, 1, '2023-07-19', '16:28:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3425, 27199177, 2, '2023-07-19', '16:28:58', 'Listar lideres sin casa sobre la roca'),
(3426, 27199177, 1, '2023-07-19', '16:29:19', 'Listar todos los usuarios'),
(3427, 27199177, 1, '2023-07-19', '16:30:48', 'Listar todos los usuarios'),
(3428, 27199177, 1, '2023-07-19', '16:32:17', 'Listar todos los usuarios'),
(3429, 27199177, 1, '2023-07-19', '16:32:26', 'Listar todos los usuarios'),
(3430, 27199177, 1, '2023-07-19', '16:34:27', 'Listar todos los usuarios'),
(3431, 27199177, 1, '2023-07-19', '16:34:45', 'Listar todos los usuarios'),
(3432, 27199177, 1, '2023-07-19', '16:35:11', 'Listar todos los usuarios'),
(3433, 27199177, 1, '2023-07-19', '16:35:44', 'Listar todos los usuarios'),
(3434, 27199177, 1, '2023-07-19', '16:36:00', 'Listar todos los usuarios'),
(3435, 27199177, 1, '2023-07-19', '16:36:24', 'Listar todos los usuarios'),
(3436, 27199177, 1, '2023-07-19', '16:36:43', 'Listar todos los usuarios'),
(3437, 27199177, 1, '2023-07-19', '16:36:45', 'Listar todos los usuarios'),
(3438, 27199177, 1, '2023-07-19', '16:37:45', 'Listar todos los usuarios'),
(3439, 27199177, 1, '2023-07-19', '16:38:11', 'Listar todos los usuarios'),
(3440, 27199177, 1, '2023-07-19', '16:38:18', 'Listar todos los usuarios'),
(3441, 27199177, 1, '2023-07-19', '16:38:54', 'Listar todos los usuarios'),
(3442, 27199177, 1, '2023-07-19', '16:39:35', 'Listar todos los usuarios'),
(3443, 27199177, 1, '2023-07-19', '16:40:10', 'Listar todos los usuarios'),
(3444, 27199177, 3, '2023-07-19', '16:42:59', 'El usuario ha entrado al apartado de Agregar Materias'),
(3445, 27199177, 1, '2023-07-19', '16:44:36', 'Listar todos los usuarios'),
(3446, 27199177, 1, '2023-07-20', '12:32:59', 'Listar todos los usuarios'),
(3447, 27199177, 1, '2023-07-20', '12:38:47', 'Listar todos los usuarios'),
(3448, 27199177, 1, '2023-07-20', '12:39:08', 'Listar todos los usuarios'),
(3449, 27199177, 1, '2023-07-21', '11:20:35', 'Listar todos los usuarios'),
(3450, 27199177, 1, '2023-07-21', '11:31:08', 'Listar todos los usuarios'),
(3451, 27199177, 1, '2023-07-21', '11:32:25', 'Listar todos los usuarios'),
(3452, 27199177, 1, '2023-07-21', '11:33:56', 'Listar todos los usuarios'),
(3453, 27199177, 1, '2023-07-21', '11:35:28', 'Listar todos los usuarios'),
(3454, 27199177, 1, '2023-07-21', '11:41:13', 'Listar todos los usuarios'),
(3455, 27199177, 1, '2023-07-21', '11:42:19', 'Listar todos los usuarios'),
(3456, 27199177, 1, '2023-07-21', '11:43:54', 'Listar todos los usuarios'),
(3457, 27199177, 1, '2023-07-21', '11:43:59', 'Editar datos de usuario'),
(3458, 27199177, 1, '2023-07-21', '11:44:08', 'Listar todos los usuarios'),
(3459, 27199177, 1, '2023-07-21', '11:45:06', 'Listar todos los usuarios'),
(3460, 27199177, 1, '2023-07-21', '11:45:14', 'Editar datos de usuario'),
(3461, 27199177, 1, '2023-07-21', '11:46:30', 'Listar todos los usuarios'),
(3462, 27199177, 1, '2023-07-21', '11:46:36', 'Editar datos de usuario'),
(3463, 27199177, 1, '2023-07-21', '11:46:36', 'Listar todos los usuarios'),
(3464, 27199177, 1, '2023-07-21', '11:46:44', 'Listar todos los usuarios'),
(3465, 27199177, 1, '2023-07-21', '11:50:00', 'Listar todos los usuarios'),
(3466, 27199177, 1, '2023-07-21', '11:52:05', 'Listar todos los usuarios'),
(3467, 27199177, 1, '2023-07-21', '11:56:57', 'Listar todos los usuarios'),
(3468, 27199177, 1, '2023-07-21', '11:57:16', 'Listar todos los usuarios'),
(3469, 27199177, 1, '2023-07-21', '11:57:37', 'Listar todos los usuarios'),
(3470, 27199177, 1, '2023-07-21', '11:58:07', 'Listar todos los usuarios'),
(3471, 27199177, 2, '2023-07-21', '11:58:46', 'Listar casas sobre la roca'),
(3472, 27199177, 2, '2023-07-21', '11:58:46', 'Listar casas sobre la roca'),
(3473, 27199177, 1, '2023-07-21', '11:59:26', 'Listar todos los usuarios'),
(3474, 27199177, 6, '2023-07-21', '11:59:46', 'Listar Celula de discipulado'),
(3475, 27199177, 3, '2023-07-21', '12:00:15', 'El usuario ha entrado al apartado de Agregar Materias'),
(3476, 27199177, 3, '2023-07-21', '12:00:27', 'El usuario ha entrado al apartado de Agregar Materias'),
(3477, 27199177, 1, '2023-07-21', '12:01:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3478, 27199177, 1, '2023-07-21', '12:01:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3479, 27199177, 1, '2023-07-21', '12:02:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3480, 27199177, 1, '2023-07-21', '12:02:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3481, 27199177, 1, '2023-07-21', '12:03:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3482, 27199177, 1, '2023-07-21', '12:03:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3483, 27199177, 2, '2023-07-23', '16:28:16', 'Listar lideres sin casa sobre la roca'),
(3484, 27199177, 1, '2023-07-23', '16:28:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3485, 27199177, 1, '2023-07-23', '16:28:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3486, 27199177, 2, '2023-07-23', '16:30:16', 'Listar lideres sin casa sobre la roca'),
(3487, 27199177, 2, '2023-08-03', '17:59:25', 'Listar casas sobre la roca'),
(3488, 27199177, 2, '2023-08-03', '18:00:58', 'Listar lideres sin casa sobre la roca'),
(3489, 27199177, 2, '2023-08-03', '18:03:32', 'Listar casas sobre la roca'),
(3490, 27199177, 2, '2023-08-03', '18:03:35', 'Listar casas sobre la roca'),
(3491, 27199177, 2, '2023-08-03', '18:03:45', 'Listar casas sobre la roca'),
(3492, 27199177, 2, '2023-08-03', '18:04:32', 'Cierre casa sobre la roca'),
(3493, 27199177, 2, '2023-08-03', '18:04:32', 'Listar casas sobre la roca'),
(3494, 27199177, 2, '2023-08-03', '18:04:33', 'Listar casas sobre la roca'),
(3495, 27199177, 2, '2023-08-03', '18:04:38', 'Listar casas sobre la roca'),
(3496, 27199177, 2, '2023-08-03', '18:04:50', 'Listar casas sobre la roca'),
(3497, 27199177, 2, '2023-08-03', '18:04:59', 'Listar casas sobre la roca'),
(3498, 27199177, 2, '2023-08-03', '18:05:35', 'Listar casas sobre la roca'),
(3499, 27199177, 2, '2023-08-03', '18:05:49', 'Listar casas sobre la roca'),
(3500, 27199177, 2, '2023-08-03', '18:06:11', 'Listar casas sobre la roca'),
(3501, 27199177, 2, '2023-08-03', '18:06:24', 'Listar casas sobre la roca'),
(3502, 27199177, 2, '2023-08-03', '18:14:41', 'Listar casas sobre la roca'),
(3503, 27199177, 1, '2023-08-03', '18:25:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3504, 27199177, 1, '2023-08-03', '18:25:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3505, 27199177, 2, '2023-08-03', '18:43:49', 'Listar lideres sin casa sobre la roca'),
(3506, 27199177, 2, '2023-08-15', '10:30:34', 'Listar lideres sin casa sobre la roca'),
(3507, 27199177, 1, '2023-08-15', '11:40:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3508, 27199177, 1, '2023-08-15', '11:40:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3509, 27199177, 1, '2023-08-15', '17:02:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3510, 27199177, 1, '2023-08-15', '17:02:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3511, 27199177, 1, '2023-08-15', '17:03:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3512, 27199177, 1, '2023-08-15', '17:04:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3513, 27199177, 1, '2023-08-15', '17:06:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3514, 27199177, 1, '2023-08-15', '17:07:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3515, 27199177, 1, '2023-08-15', '17:08:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3516, 27199177, 1, '2023-08-15', '17:08:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(3517, 27199177, 1, '2023-08-15', '17:11:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(3518, 27199177, 1, '2023-08-15', '17:13:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3519, 27199177, 1, '2023-08-15', '17:16:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3520, 27199177, 1, '2023-08-15', '17:19:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3521, 27199177, 1, '2023-08-15', '17:20:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(3522, 27199177, 1, '2023-08-15', '17:22:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(3523, 27199177, 1, '2023-08-15', '17:22:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3524, 27199177, 1, '2023-08-15', '17:24:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3525, 27199177, 1, '2023-08-15', '17:25:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3526, 27199177, 1, '2023-08-15', '17:29:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(3527, 27199177, 1, '2023-08-15', '17:36:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3528, 27199177, 1, '2023-08-16', '11:51:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3529, 27199177, 1, '2023-08-16', '11:51:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3530, 27199177, 2, '2023-08-16', '11:51:47', 'Listar lideres sin casa sobre la roca'),
(3531, 27199177, 1, '2023-08-16', '12:35:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3532, 27199177, 1, '2023-08-16', '12:36:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3533, 27199177, 1, '2023-08-16', '12:36:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3534, 27199177, 1, '2023-08-16', '12:37:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(3535, 27199177, 2, '2023-08-16', '13:08:04', 'Listar lideres sin casa sobre la roca'),
(3536, 27199177, 2, '2023-08-16', '13:27:29', 'Listar lideres sin casa sobre la roca'),
(3537, 27199177, 1, '2023-08-16', '13:30:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3538, 27199177, 1, '2023-08-16', '13:31:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(3539, 27199177, 1, '2023-08-16', '13:31:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3540, 27199177, 1, '2023-08-16', '13:32:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3541, 27199177, 1, '2023-08-16', '13:32:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3542, 27199177, 1, '2023-08-16', '13:33:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3543, 27199177, 1, '2023-08-16', '13:33:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3544, 27199177, 1, '2023-08-16', '13:35:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3545, 27199177, 1, '2023-08-16', '13:38:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3546, 27199177, 1, '2023-08-16', '13:38:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3547, 27199177, 1, '2023-08-16', '14:06:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3548, 27199177, 1, '2023-08-16', '14:07:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3549, 27199177, 1, '2023-08-16', '14:07:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3550, 27199177, 2, '2023-08-16', '14:12:47', 'Listar lideres sin casa sobre la roca'),
(3551, 27199177, 1, '2023-08-16', '14:14:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3552, 27199177, 1, '2023-08-16', '14:15:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3553, 27199177, 1, '2023-08-16', '14:16:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(3554, 27199177, 1, '2023-08-16', '14:17:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3555, 27199177, 1, '2023-08-16', '14:22:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3556, 27199177, 1, '2023-08-16', '14:22:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3557, 27199177, 1, '2023-08-16', '14:22:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3558, 27199177, 1, '2023-08-16', '15:30:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3559, 27199177, 1, '2023-08-16', '15:34:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3560, 27199177, 1, '2023-08-16', '15:34:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(3561, 27199177, 1, '2023-08-16', '15:35:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(3562, 27199177, 1, '2023-08-16', '15:36:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3563, 27199177, 1, '2023-08-16', '15:36:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(3564, 27199177, 1, '2023-08-16', '15:37:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3565, 27199177, 1, '2023-08-16', '15:38:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3566, 27199177, 1, '2023-08-16', '15:46:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3567, 27199177, 1, '2023-08-16', '15:46:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3568, 27199177, 1, '2023-08-16', '15:46:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(3569, 27199177, 1, '2023-08-16', '15:47:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3570, 27199177, 1, '2023-08-16', '15:49:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3571, 27199177, 1, '2023-08-16', '15:49:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(3572, 27199177, 1, '2023-08-16', '15:51:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3573, 27199177, 1, '2023-08-16', '15:52:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3574, 27199177, 1, '2023-08-16', '15:55:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(3575, 27199177, 1, '2023-08-16', '15:55:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(3576, 27199177, 1, '2023-08-16', '15:56:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3577, 27199177, 1, '2023-08-16', '15:56:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3578, 27199177, 1, '2023-08-16', '16:04:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(3579, 27199177, 1, '2023-08-16', '16:04:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3580, 27199177, 1, '2023-08-16', '16:04:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3581, 27199177, 1, '2023-08-16', '16:06:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3582, 27199177, 1, '2023-08-16', '16:08:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(3583, 27199177, 1, '2023-08-16', '16:08:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3584, 27199177, 1, '2023-08-16', '16:08:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3585, 27199177, 1, '2023-08-16', '16:10:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3586, 27199177, 1, '2023-08-16', '16:11:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3587, 27199177, 1, '2023-08-16', '16:11:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3588, 27199177, 1, '2023-08-16', '16:12:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(3589, 27199177, 1, '2023-08-16', '16:12:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3590, 27199177, 1, '2023-08-16', '16:14:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(3591, 27199177, 1, '2023-08-16', '16:15:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3592, 27199177, 1, '2023-08-16', '16:17:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3593, 27199177, 1, '2023-08-16', '16:17:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3594, 27199177, 1, '2023-08-16', '16:19:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3595, 27199177, 1, '2023-08-16', '16:19:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3596, 27199177, 1, '2023-08-16', '16:19:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3597, 27199177, 1, '2023-08-16', '17:36:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3598, 27199177, 1, '2023-08-16', '18:48:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3599, 27199177, 1, '2023-08-16', '18:51:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3600, 27199177, 1, '2023-08-16', '18:51:09', 'El usuario ha entrado a \"Mi Perfil\"');
INSERT INTO `bitacora_usuario` (`id`, `cedula_usuario`, `id_modulo`, `fecha_registro`, `hora_registro`, `accion_realizada`) VALUES
(3601, 27199177, 1, '2023-08-16', '18:51:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3602, 27199177, 1, '2023-08-16', '18:51:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3603, 27199177, 1, '2023-08-16', '18:51:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3604, 27199177, 1, '2023-08-16', '18:51:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3605, 27199177, 1, '2023-08-16', '18:51:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3606, 27199177, 1, '2023-08-16', '18:51:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3607, 27199177, 1, '2023-08-16', '18:52:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3608, 27199177, 1, '2023-08-16', '18:53:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3609, 27199177, 1, '2023-08-16', '18:53:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3610, 27199177, 1, '2023-08-16', '18:54:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3611, 27199177, 1, '2023-08-16', '18:54:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3612, 27199177, 2, '2023-08-16', '19:05:01', 'Listar lideres sin casa sobre la roca'),
(3613, 27199177, 1, '2023-08-16', '19:57:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(3614, 27199177, 1, '2023-08-16', '20:01:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3615, 27199177, 1, '2023-08-16', '20:01:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3616, 27199177, 1, '2023-08-16', '20:02:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3617, 27199177, 1, '2023-08-16', '20:02:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(3618, 27199177, 1, '2023-08-16', '20:02:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3619, 27199177, 1, '2023-08-16', '20:02:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(3620, 27199177, 1, '2023-08-16', '20:02:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(3621, 27199177, 1, '2023-08-16', '20:02:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3622, 27199177, 1, '2023-08-16', '20:46:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3623, 27199177, 1, '2023-08-16', '20:47:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3624, 27199177, 1, '2023-08-16', '20:51:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3625, 27199177, 1, '2023-08-16', '21:03:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3626, 27199177, 1, '2023-08-16', '21:13:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3627, 27199177, 1, '2023-08-17', '09:04:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3628, 27199177, 1, '2023-08-18', '11:04:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3629, 27199177, 1, '2023-08-18', '11:10:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3630, 27199177, 1, '2023-08-18', '11:12:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3631, 27199177, 1, '2023-08-18', '11:34:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3632, 27199177, 1, '2023-08-18', '11:59:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3633, 27199177, 1, '2023-08-18', '12:01:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3634, 27199177, 1, '2023-08-18', '13:48:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3635, 27199177, 1, '2023-08-18', '13:49:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3636, 27199177, 1, '2023-08-18', '13:52:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3637, 27199177, 1, '2023-08-18', '14:27:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3638, 27199177, 1, '2023-08-18', '14:28:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3639, 27199177, 1, '2023-08-18', '14:28:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(3640, 27199177, 1, '2023-08-18', '14:31:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(3641, 27199177, 1, '2023-08-18', '14:37:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3642, 27199177, 1, '2023-08-18', '14:37:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3643, 27199177, 1, '2023-08-18', '14:39:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3644, 27199177, 1, '2023-08-18', '14:42:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3645, 27199177, 1, '2023-08-18', '14:42:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3646, 27199177, 1, '2023-08-18', '14:43:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3647, 27199177, 1, '2023-08-18', '14:44:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3648, 27199177, 1, '2023-08-18', '14:47:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3649, 27199177, 1, '2023-08-18', '15:23:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3650, 27199177, 1, '2023-08-18', '15:27:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3651, 27199177, 1, '2023-08-18', '15:42:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3652, 27199177, 1, '2023-08-18', '15:50:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3653, 27199177, 1, '2023-08-18', '16:13:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3654, 27199177, 1, '2023-08-18', '17:50:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3655, 27199177, 1, '2023-08-18', '18:00:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3656, 27199177, 1, '2023-08-18', '18:01:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3657, 27199177, 1, '2023-08-18', '18:01:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(3658, 27199177, 1, '2023-08-18', '18:10:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3659, 27199177, 1, '2023-08-18', '18:37:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3660, 27199177, 1, '2023-08-18', '18:39:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(3661, 27199177, 1, '2023-08-18', '18:39:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(3662, 27199177, 1, '2023-08-18', '18:42:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3663, 27199177, 1, '2023-08-18', '18:46:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(3664, 27199177, 1, '2023-08-18', '18:46:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3665, 27199177, 1, '2023-08-18', '18:47:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3666, 27199177, 1, '2023-08-18', '18:47:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3667, 27199177, 1, '2023-08-18', '19:15:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(3668, 27199177, 1, '2023-08-18', '22:16:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3669, 27199177, 1, '2023-08-18', '22:21:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3670, 27199177, 1, '2023-08-18', '22:41:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3671, 27199177, 1, '2023-08-18', '22:46:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3672, 27199177, 1, '2023-08-18', '22:50:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(3673, 27199177, 1, '2023-08-18', '22:52:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(3674, 27199177, 1, '2023-08-18', '22:52:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3675, 27199177, 1, '2023-08-18', '22:58:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(3676, 27199177, 1, '2023-08-18', '22:59:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3677, 27199177, 1, '2023-08-18', '22:59:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(3678, 27199177, 1, '2023-08-18', '23:00:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(3679, 27199177, 1, '2023-08-18', '23:24:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(3680, 27199177, 1, '2023-08-18', '23:27:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(3681, 27199177, 1, '2023-08-18', '23:27:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3682, 27199177, 1, '2023-08-18', '23:27:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3683, 27199177, 1, '2023-08-19', '10:44:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3684, 27199177, 1, '2023-08-19', '11:11:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3685, 27199177, 1, '2023-08-19', '11:16:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(3686, 27199177, 1, '2023-08-19', '12:18:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3687, 27199177, 2, '2023-08-19', '12:22:36', 'Listar lideres sin casa sobre la roca'),
(3688, 27199177, 2, '2023-08-19', '12:23:17', 'Listar casas sobre la roca'),
(3689, 27199177, 2, '2023-08-19', '12:56:27', 'Listar casas sobre la roca'),
(3690, 27199177, 2, '2023-08-19', '13:02:25', 'Registrar casas sobre la roca'),
(3691, 27199177, 2, '2023-08-20', '11:44:07', 'Listar casas sobre la roca'),
(3692, 27199177, 1, '2023-08-20', '11:44:37', 'Listar todos los usuarios'),
(3693, 27199177, 3, '2023-08-20', '11:44:59', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(3694, 27199177, 2, '2023-08-20', '11:45:16', 'Listar casas sobre la roca'),
(3695, 27199177, 1, '2023-08-20', '12:18:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3696, 27199177, 1, '2023-08-20', '12:21:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(3697, 27199177, 1, '2023-08-20', '12:21:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3698, 27199177, 1, '2023-08-20', '12:22:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3699, 27199177, 1, '2023-08-20', '12:24:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3700, 27199177, 1, '2023-08-20', '12:28:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3701, 27199177, 1, '2023-08-20', '12:39:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3702, 27199177, 1, '2023-08-20', '13:14:16', 'El usuario ha entrado a \"Mi Perfil\"'),
(3703, 27199177, 1, '2023-08-20', '13:22:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(3704, 27199177, 2, '2023-08-20', '13:23:13', 'Registrar casas sobre la roca'),
(3705, 27199177, 2, '2023-08-21', '09:39:56', 'Listar casas sobre la roca'),
(3706, 27199177, 1, '2023-08-21', '09:40:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3707, 27199177, 2, '2023-08-21', '09:41:01', 'Listar casas sobre la roca'),
(3708, 27199177, 2, '2023-08-21', '09:41:04', 'Listar casas sobre la roca'),
(3709, 27199177, 1, '2023-08-21', '09:43:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3710, 27199177, 2, '2023-08-21', '09:44:06', 'Registrar casas sobre la roca'),
(3711, 27199177, 2, '2023-08-21', '09:46:17', 'Listar casas sobre la roca'),
(3712, 27199177, 2, '2023-08-21', '09:46:30', 'Listar casas sobre la roca'),
(3713, 27199177, 2, '2023-08-21', '09:46:33', 'Registrar casas sobre la roca'),
(3714, 27199177, 1, '2023-08-21', '10:07:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3715, 27199177, 2, '2023-08-21', '10:08:29', 'Registrar casas sobre la roca'),
(3716, 27199177, 1, '2023-08-21', '10:08:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3717, 27199177, 1, '2023-08-21', '11:12:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3718, 27199177, 1, '2023-08-21', '11:13:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3719, 27199177, 1, '2023-08-21', '11:25:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3720, 27199177, 1, '2023-08-21', '13:18:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3721, 27199177, 1, '2023-08-21', '13:18:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3722, 27199177, 2, '2023-08-21', '13:19:16', 'Listar lideres sin casa sobre la roca'),
(3723, 27199177, 1, '2023-08-21', '13:19:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3724, 27199177, 1, '2023-08-21', '13:19:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3725, 27199177, 1, '2023-08-21', '23:03:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3726, 27199177, 2, '2023-08-21', '23:05:47', 'Registrar casas sobre la roca'),
(3727, 27199177, 2, '2023-08-21', '23:10:01', 'Registrar casas sobre la roca'),
(3728, 27199177, 1, '2023-08-21', '23:10:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3729, 27199177, 1, '2023-08-21', '23:10:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3730, 27199177, 2, '2023-08-21', '23:26:13', 'Registrar casas sobre la roca'),
(3731, 27199177, 1, '2023-08-21', '23:34:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3732, 27199177, 1, '2023-08-21', '23:35:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(3733, 27199177, 1, '2023-08-21', '23:35:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(3734, 27199177, 1, '2023-08-21', '23:35:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3735, 27199177, 1, '2023-08-21', '23:36:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(3736, 27199177, 1, '2023-08-21', '23:36:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3737, 27199177, 1, '2023-08-21', '23:36:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3738, 27199177, 1, '2023-08-21', '23:37:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(3739, 27199177, 1, '2023-08-21', '23:37:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3740, 27199177, 1, '2023-08-22', '00:04:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3741, 27199177, 1, '2023-08-22', '00:05:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3742, 27199177, 1, '2023-08-22', '00:05:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3743, 27199177, 1, '2023-08-22', '00:06:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(3744, 27199177, 1, '2023-08-22', '00:06:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3745, 27199177, 1, '2023-08-22', '00:06:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3746, 27199177, 1, '2023-08-22', '00:07:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(3747, 27199177, 1, '2023-08-22', '00:07:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3748, 27199177, 1, '2023-08-22', '00:07:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3749, 27199177, 1, '2023-08-22', '00:07:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(3750, 27199177, 1, '2023-08-22', '00:07:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(3751, 27199177, 1, '2023-08-22', '00:07:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(3752, 27199177, 1, '2023-08-22', '00:08:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(3753, 27199177, 1, '2023-08-22', '00:08:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3754, 27199177, 1, '2023-08-22', '00:09:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3755, 27199177, 1, '2023-08-22', '00:09:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3756, 27199177, 1, '2023-08-22', '00:09:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(3757, 27199177, 1, '2023-08-22', '00:09:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(3758, 27199177, 1, '2023-08-22', '00:10:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(3759, 27199177, 1, '2023-08-22', '00:10:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3760, 27199177, 1, '2023-08-22', '00:11:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3761, 27199177, 1, '2023-08-22', '00:11:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3762, 27199177, 1, '2023-08-22', '00:11:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3763, 27199177, 1, '2023-08-22', '00:11:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(3764, 27199177, 1, '2023-08-22', '00:13:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(3765, 27199177, 1, '2023-08-22', '00:13:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3766, 27199177, 1, '2023-08-22', '00:13:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3767, 27199177, 1, '2023-08-22', '00:13:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3768, 27199177, 1, '2023-08-22', '00:13:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(3769, 27199177, 1, '2023-08-22', '00:13:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3770, 27199177, 1, '2023-08-22', '00:15:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3771, 27199177, 1, '2023-08-22', '00:15:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3772, 27199177, 1, '2023-08-22', '00:16:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3773, 27199177, 1, '2023-08-22', '00:16:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3774, 27199177, 1, '2023-08-22', '00:16:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(3775, 27199177, 1, '2023-08-22', '00:16:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(3776, 27199177, 1, '2023-08-22', '00:20:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(3777, 27199177, 1, '2023-08-22', '00:20:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(3778, 27199177, 1, '2023-08-22', '00:26:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3779, 27199177, 1, '2023-08-22', '00:27:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(3780, 27199177, 1, '2023-08-22', '00:34:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3781, 27199177, 1, '2023-08-22', '00:35:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(3782, 27199177, 1, '2023-08-22', '00:36:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(3783, 27199177, 1, '2023-08-22', '00:36:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3784, 27199177, 1, '2023-08-22', '00:36:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(3785, 27199177, 1, '2023-08-22', '00:36:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3786, 27199177, 1, '2023-08-22', '00:36:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(3787, 27199177, 1, '2023-08-22', '00:37:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3788, 27199177, 1, '2023-08-22', '00:37:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3789, 27199177, 1, '2023-08-23', '15:54:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3790, 27199177, 1, '2023-08-23', '21:22:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3791, 27199177, 1, '2023-08-23', '21:43:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(3792, 27199177, 1, '2023-08-23', '21:44:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(3793, 27199177, 1, '2023-08-23', '21:51:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(3794, 27199177, 2, '2023-08-23', '21:54:12', 'Listar casas sobre la roca'),
(3795, 27199177, 2, '2023-08-23', '21:54:43', 'Listar casas sobre la roca'),
(3796, 27199177, 2, '2023-08-23', '21:55:01', 'Listar casas sobre la roca'),
(3797, 27199177, 2, '2023-08-23', '21:55:08', 'Listar casas sobre la roca'),
(3798, 27199177, 2, '2023-08-23', '21:56:49', 'Listar casas sobre la roca'),
(3799, 27199177, 2, '2023-08-24', '10:10:43', 'Listar lideres sin casa sobre la roca'),
(3800, 27199177, 2, '2023-08-24', '10:10:47', 'Listar casas sobre la roca'),
(3801, 27199177, 1, '2023-08-24', '10:24:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(3802, 27199177, 2, '2023-08-24', '10:24:31', 'Listar casas sobre la roca'),
(3803, 27199177, 2, '2023-08-24', '10:25:28', 'Listar casas sobre la roca'),
(3804, 27199177, 2, '2023-08-24', '10:26:07', 'Listar casas sobre la roca'),
(3805, 27199177, 2, '2023-08-24', '10:28:05', 'Listar casas sobre la roca'),
(3806, 27199177, 2, '2023-08-24', '10:30:55', 'Listar casas sobre la roca'),
(3807, 27199177, 2, '2023-08-24', '10:36:26', 'Listar casas sobre la roca'),
(3808, 27199177, 2, '2023-08-24', '10:39:29', 'Listar casas sobre la roca'),
(3809, 27199177, 2, '2023-08-24', '10:43:02', 'Listar casas sobre la roca'),
(3810, 27199177, 2, '2023-08-24', '10:43:10', 'Listar casas sobre la roca'),
(3811, 27199177, 2, '2023-08-24', '10:43:18', 'Listar casas sobre la roca'),
(3812, 27199177, 2, '2023-08-24', '10:43:24', 'Listar casas sobre la roca'),
(3813, 27199177, 2, '2023-08-24', '10:43:29', 'Listar casas sobre la roca'),
(3814, 27199177, 2, '2023-08-24', '10:43:36', 'Listar casas sobre la roca'),
(3815, 27199177, 2, '2023-08-24', '10:43:48', 'Listar casas sobre la roca'),
(3816, 27199177, 2, '2023-08-24', '10:43:55', 'Listar casas sobre la roca'),
(3817, 27199177, 2, '2023-08-24', '10:43:59', 'Listar casas sobre la roca'),
(3818, 27199177, 2, '2023-08-24', '10:45:14', 'Listar casas sobre la roca'),
(3819, 27199177, 2, '2023-08-24', '10:45:34', 'Listar casas sobre la roca'),
(3820, 27199177, 2, '2023-08-24', '10:46:11', 'Listar casas sobre la roca'),
(3821, 27199177, 2, '2023-08-24', '10:46:44', 'Listar casas sobre la roca'),
(3822, 27199177, 2, '2023-08-24', '10:46:46', 'Listar casas sobre la roca'),
(3823, 27199177, 2, '2023-08-24', '10:46:49', 'Listar casas sobre la roca'),
(3824, 27199177, 2, '2023-08-24', '10:46:52', 'Listar casas sobre la roca'),
(3825, 27199177, 2, '2023-08-24', '10:47:08', 'Listar casas sobre la roca'),
(3826, 27199177, 2, '2023-08-24', '10:47:24', 'Listar casas sobre la roca'),
(3827, 27199177, 2, '2023-08-24', '10:47:31', 'Listar casas sobre la roca'),
(3828, 27199177, 2, '2023-08-24', '10:47:43', 'Listar casas sobre la roca'),
(3829, 27199177, 2, '2023-08-24', '10:47:51', 'Listar casas sobre la roca'),
(3830, 27199177, 2, '2023-08-24', '10:47:59', 'Listar casas sobre la roca'),
(3831, 27199177, 2, '2023-08-24', '10:48:01', 'Listar casas sobre la roca'),
(3832, 27199177, 2, '2023-08-24', '10:48:06', 'Listar casas sobre la roca'),
(3833, 27199177, 2, '2023-08-24', '10:48:27', 'Listar casas sobre la roca'),
(3834, 27199177, 2, '2023-08-24', '10:48:39', 'Listar casas sobre la roca'),
(3835, 27199177, 2, '2023-08-24', '10:48:42', 'Listar casas sobre la roca'),
(3836, 27199177, 2, '2023-08-24', '10:48:47', 'Listar casas sobre la roca'),
(3837, 27199177, 2, '2023-08-24', '10:48:50', 'Listar casas sobre la roca'),
(3838, 27199177, 2, '2023-08-24', '10:48:57', 'Listar casas sobre la roca'),
(3839, 27199177, 1, '2023-08-24', '10:49:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3840, 27199177, 2, '2023-08-24', '10:49:39', 'Listar casas sobre la roca'),
(3841, 27199177, 2, '2023-08-24', '10:50:01', 'Listar casas sobre la roca'),
(3842, 27199177, 2, '2023-08-24', '10:50:22', 'Listar casas sobre la roca'),
(3843, 27199177, 1, '2023-08-24', '10:50:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3844, 27199177, 2, '2023-08-24', '10:50:40', 'Listar casas sobre la roca'),
(3845, 27199177, 2, '2023-08-24', '10:51:32', 'Listar casas sobre la roca'),
(3846, 27199177, 1, '2023-08-24', '10:51:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3847, 27199177, 2, '2023-08-24', '10:51:51', 'Listar casas sobre la roca'),
(3848, 27199177, 2, '2023-08-24', '10:52:35', 'Listar casas sobre la roca'),
(3849, 27199177, 2, '2023-08-24', '10:53:05', 'Listar casas sobre la roca'),
(3850, 27199177, 2, '2023-08-24', '10:53:17', 'Listar casas sobre la roca'),
(3851, 27199177, 1, '2023-08-24', '10:54:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3852, 27199177, 2, '2023-08-24', '10:54:12', 'Listar casas sobre la roca'),
(3853, 27199177, 2, '2023-08-24', '10:54:25', 'Listar casas sobre la roca'),
(3854, 27199177, 2, '2023-08-24', '10:57:05', 'Listar casas sobre la roca'),
(3855, 27199177, 1, '2023-08-24', '11:16:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3856, 27199177, 2, '2023-08-24', '11:17:44', 'Listar casas sobre la roca'),
(3857, 27199177, 2, '2023-08-24', '11:22:07', 'Listar casas sobre la roca'),
(3858, 27199177, 2, '2023-08-24', '11:22:46', 'Listar casas sobre la roca'),
(3859, 27199177, 2, '2023-08-24', '11:22:59', 'Listar casas sobre la roca'),
(3860, 27199177, 2, '2023-08-24', '11:24:00', 'Listar casas sobre la roca'),
(3861, 27199177, 2, '2023-08-24', '11:24:06', 'Listar casas sobre la roca'),
(3862, 27199177, 2, '2023-08-24', '11:24:39', 'Listar casas sobre la roca'),
(3863, 27199177, 2, '2023-08-24', '11:25:05', 'Listar casas sobre la roca'),
(3864, 27199177, 2, '2023-08-24', '11:25:10', 'Listar casas sobre la roca'),
(3865, 27199177, 2, '2023-08-24', '11:25:12', 'Listar casas sobre la roca'),
(3866, 27199177, 2, '2023-08-24', '11:25:36', 'Listar casas sobre la roca'),
(3867, 27199177, 2, '2023-08-24', '11:25:44', 'Listar casas sobre la roca'),
(3868, 27199177, 2, '2023-08-24', '11:26:19', 'Listar casas sobre la roca'),
(3869, 27199177, 2, '2023-08-24', '11:26:25', 'Listar casas sobre la roca'),
(3870, 27199177, 2, '2023-08-24', '11:26:35', 'Listar casas sobre la roca'),
(3871, 27199177, 2, '2023-08-24', '11:26:39', 'Listar casas sobre la roca'),
(3872, 27199177, 2, '2023-08-24', '11:26:48', 'Listar casas sobre la roca'),
(3873, 27199177, 2, '2023-08-24', '11:26:51', 'Listar casas sobre la roca'),
(3874, 27199177, 2, '2023-08-24', '11:28:38', 'Listar casas sobre la roca'),
(3875, 27199177, 2, '2023-08-24', '11:29:09', 'Listar casas sobre la roca'),
(3876, 27199177, 2, '2023-08-24', '11:29:21', 'Listar casas sobre la roca'),
(3877, 27199177, 2, '2023-08-24', '11:29:35', 'Listar casas sobre la roca'),
(3878, 27199177, 2, '2023-08-24', '11:29:49', 'Listar casas sobre la roca'),
(3879, 27199177, 2, '2023-08-24', '11:30:59', 'Listar casas sobre la roca'),
(3880, 27199177, 2, '2023-08-24', '11:31:06', 'Listar casas sobre la roca'),
(3881, 27199177, 2, '2023-08-24', '11:31:36', 'Listar casas sobre la roca'),
(3882, 27199177, 2, '2023-08-24', '11:31:57', 'Listar casas sobre la roca'),
(3883, 27199177, 2, '2023-08-24', '11:32:00', 'Listar casas sobre la roca'),
(3884, 27199177, 2, '2023-08-24', '11:32:26', 'Listar casas sobre la roca'),
(3885, 27199177, 2, '2023-08-24', '11:32:58', 'Listar casas sobre la roca'),
(3886, 27199177, 2, '2023-08-24', '11:33:38', 'Listar casas sobre la roca'),
(3887, 27199177, 2, '2023-08-24', '11:33:44', 'Listar casas sobre la roca'),
(3888, 27199177, 2, '2023-08-24', '11:33:53', 'Listar casas sobre la roca'),
(3889, 27199177, 2, '2023-08-24', '11:34:28', 'Listar casas sobre la roca'),
(3890, 27199177, 2, '2023-08-24', '11:34:39', 'Listar casas sobre la roca'),
(3891, 27199177, 2, '2023-08-24', '11:34:44', 'Listar casas sobre la roca'),
(3892, 27199177, 1, '2023-08-24', '11:37:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(3893, 27199177, 2, '2023-08-24', '11:37:57', 'Listar casas sobre la roca'),
(3894, 27199177, 2, '2023-08-24', '11:39:38', 'Listar casas sobre la roca'),
(3895, 27199177, 2, '2023-08-24', '11:40:09', 'Listar casas sobre la roca'),
(3896, 27199177, 2, '2023-08-24', '11:40:32', 'Listar casas sobre la roca'),
(3897, 27199177, 2, '2023-08-24', '11:41:07', 'Listar casas sobre la roca'),
(3898, 27199177, 2, '2023-08-24', '11:42:45', 'Listar casas sobre la roca'),
(3899, 27199177, 2, '2023-08-24', '11:43:08', 'Listar casas sobre la roca'),
(3900, 27199177, 2, '2023-08-24', '11:43:17', 'Listar casas sobre la roca'),
(3901, 27199177, 2, '2023-08-24', '11:43:22', 'Listar casas sobre la roca'),
(3902, 27199177, 2, '2023-08-24', '11:44:00', 'Listar casas sobre la roca'),
(3903, 27199177, 2, '2023-08-24', '11:45:29', 'Listar casas sobre la roca'),
(3904, 27199177, 2, '2023-08-24', '11:45:39', 'Listar casas sobre la roca'),
(3905, 27199177, 2, '2023-08-24', '11:45:42', 'Listar casas sobre la roca'),
(3906, 27199177, 2, '2023-08-24', '11:45:53', 'Listar casas sobre la roca'),
(3907, 27199177, 2, '2023-08-24', '11:46:01', 'Listar casas sobre la roca'),
(3908, 27199177, 2, '2023-08-24', '11:46:12', 'Listar casas sobre la roca'),
(3909, 27199177, 2, '2023-08-24', '11:46:23', 'Listar casas sobre la roca'),
(3910, 27199177, 2, '2023-08-24', '11:46:26', 'Listar casas sobre la roca'),
(3911, 27199177, 2, '2023-08-24', '11:47:07', 'Listar casas sobre la roca'),
(3912, 27199177, 2, '2023-08-24', '11:47:12', 'Listar casas sobre la roca'),
(3913, 27199177, 2, '2023-08-24', '11:47:32', 'Listar casas sobre la roca'),
(3914, 27199177, 2, '2023-08-24', '11:49:17', 'Listar casas sobre la roca'),
(3915, 27199177, 2, '2023-08-24', '11:49:32', 'Listar casas sobre la roca'),
(3916, 27199177, 1, '2023-08-24', '11:49:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(3917, 27199177, 2, '2023-08-24', '11:49:53', 'Listar casas sobre la roca'),
(3918, 27199177, 2, '2023-08-24', '12:45:18', 'Listar casas sobre la roca'),
(3919, 27199177, 2, '2023-08-24', '13:09:28', 'Listar casas sobre la roca'),
(3920, 27199177, 1, '2023-08-24', '13:09:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(3921, 27199177, 2, '2023-08-24', '13:09:59', 'Listar casas sobre la roca'),
(3922, 27199177, 2, '2023-08-24', '13:15:30', 'Listar casas sobre la roca'),
(3923, 27199177, 2, '2023-08-24', '13:15:42', 'Listar casas sobre la roca'),
(3924, 27199177, 2, '2023-08-24', '13:17:07', 'Listar casas sobre la roca'),
(3925, 27199177, 2, '2023-08-24', '13:17:26', 'Listar casas sobre la roca'),
(3926, 27199177, 1, '2023-08-24', '13:25:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(3927, 27199177, 2, '2023-08-24', '13:25:12', 'Listar casas sobre la roca'),
(3928, 27199177, 1, '2023-08-24', '13:26:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3929, 27199177, 2, '2023-08-24', '13:27:05', 'Listar casas sobre la roca'),
(3930, 27199177, 2, '2023-08-25', '11:04:20', 'Listar lideres sin casa sobre la roca'),
(3931, 27199177, 1, '2023-08-25', '11:05:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(3932, 27199177, 1, '2023-08-25', '11:05:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3933, 27199177, 1, '2023-08-25', '11:22:38', 'Listar todos los usuarios'),
(3934, 27199177, 2, '2023-08-25', '13:17:55', 'Listar lideres sin casa sobre la roca'),
(3935, 27199177, 2, '2023-08-25', '13:31:33', 'Listar lideres sin casa sobre la roca'),
(3936, 27199177, 1, '2023-08-25', '13:32:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3937, 27199177, 1, '2023-08-25', '13:32:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(3938, 27199177, 2, '2023-08-25', '16:03:08', 'Listar lideres sin casa sobre la roca'),
(3939, 27199177, 1, '2023-08-25', '16:53:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(3940, 27199177, 1, '2023-08-25', '16:53:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(3941, 27199177, 1, '2023-08-25', '19:14:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3942, 27199177, 1, '2023-08-25', '19:14:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3943, 27199177, 2, '2023-08-25', '19:16:40', 'Listar lideres sin casa sobre la roca'),
(3944, 27199177, 1, '2023-08-25', '19:16:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3945, 27199177, 1, '2023-08-25', '19:16:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(3946, 27199177, 2, '2023-08-26', '08:11:41', 'Listar lideres sin casa sobre la roca'),
(3947, 27199177, 2, '2023-08-26', '08:36:38', 'Listar lideres sin casa sobre la roca'),
(3948, 27199177, 2, '2023-08-26', '09:16:27', 'Listar lideres sin casa sobre la roca'),
(3949, 27199177, 2, '2023-08-26', '17:15:40', 'Listar lideres sin casa sobre la roca'),
(3950, 27199177, 1, '2023-08-26', '17:16:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3951, 27199177, 1, '2023-08-26', '17:16:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(3952, 27199177, 2, '2023-08-26', '17:43:05', 'Listar lideres sin casa sobre la roca'),
(3953, 27199177, 1, '2023-08-26', '17:43:09', 'Listar todos los usuarios'),
(3954, 27199177, 1, '2023-08-26', '17:50:42', 'Listar todos los usuarios'),
(3955, 27199177, 2, '2023-08-27', '14:00:46', 'Listar lideres sin casa sobre la roca'),
(3956, 27199177, 1, '2023-08-27', '14:00:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3957, 27199177, 1, '2023-08-27', '14:00:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(3958, 27199177, 1, '2023-08-27', '14:00:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(3959, 27199177, 1, '2023-08-27', '14:01:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(3960, 27199177, 1, '2023-08-27', '14:01:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(3961, 27199177, 1, '2023-08-27', '14:01:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(3962, 27199177, 2, '2023-08-27', '14:11:55', 'Listar lideres sin casa sobre la roca'),
(3963, 27199177, 2, '2023-08-27', '16:23:39', 'Listar lideres sin casa sobre la roca'),
(3964, 27199177, 1, '2023-08-27', '16:23:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3965, 27199177, 1, '2023-08-27', '16:23:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(3966, 27199177, 2, '2023-08-28', '12:35:42', 'Listar lideres sin casa sobre la roca'),
(3967, 27199177, 2, '2023-08-28', '17:34:26', 'Listar lideres sin casa sobre la roca'),
(3968, 27199177, 2, '2023-08-28', '17:35:53', 'Listar lideres sin casa sobre la roca'),
(3969, 27199177, 2, '2023-08-29', '11:31:03', 'Listar lideres sin casa sobre la roca'),
(3970, 27199177, 1, '2023-08-29', '15:32:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3971, 27199177, 1, '2023-08-29', '15:32:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(3972, 27199177, 2, '2023-08-30', '14:49:29', 'Listar lideres sin casa sobre la roca'),
(3973, 27199177, 3, '2023-08-30', '14:49:43', 'El usuario ha entrado al apartado de Agregar Materias'),
(3974, 27199177, 3, '2023-08-30', '14:49:47', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(3975, 27199177, 2, '2023-08-30', '14:50:14', 'Listar casas sobre la roca'),
(3976, 27199177, 1, '2023-08-30', '14:50:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3977, 27199177, 1, '2023-08-30', '14:50:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(3978, 27199177, 1, '2023-08-30', '14:52:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3979, 27199177, 1, '2023-08-30', '14:52:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(3980, 27199177, 2, '2023-08-30', '14:58:33', 'Listar lideres sin casa sobre la roca'),
(3981, 27199177, 2, '2023-08-30', '15:06:56', 'Listar lideres sin casa sobre la roca'),
(3982, 27199177, 2, '2023-08-30', '15:09:01', 'Listar lideres sin casa sobre la roca'),
(3983, 27199177, 1, '2023-08-30', '15:11:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3984, 27199177, 1, '2023-08-30', '15:11:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3985, 27199177, 1, '2023-08-30', '15:11:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3986, 27199177, 1, '2023-08-30', '15:11:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(3987, 27199177, 1, '2023-08-30', '15:12:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3988, 27199177, 1, '2023-08-30', '15:12:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(3989, 27199177, 2, '2023-08-30', '15:12:08', 'Listar lideres sin casa sobre la roca'),
(3990, 27199177, 2, '2023-08-30', '15:12:08', 'Listar lideres sin casa sobre la roca'),
(3991, 27199177, 1, '2023-08-30', '15:12:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(3992, 27199177, 1, '2023-08-30', '15:12:16', 'El usuario ha entrado a \"Mi Perfil\"'),
(3993, 27199177, 1, '2023-08-30', '15:12:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3994, 27199177, 1, '2023-08-30', '15:12:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(3995, 27199177, 1, '2023-08-30', '15:20:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3996, 27199177, 1, '2023-08-30', '15:20:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(3997, 27199177, 2, '2023-08-30', '15:21:21', 'Listar lideres sin casa sobre la roca'),
(3998, 27199177, 2, '2023-08-30', '15:23:17', 'Listar lideres sin casa sobre la roca'),
(3999, 27199177, 2, '2023-08-30', '15:38:37', 'Listar lideres sin casa sobre la roca'),
(4000, 27199177, 1, '2023-08-30', '15:38:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(4001, 27199177, 1, '2023-08-30', '15:38:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(4002, 27199177, 1, '2023-08-30', '15:39:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(4003, 27199177, 2, '2023-08-30', '15:41:10', 'Listar lideres sin casa sobre la roca'),
(4004, 27199177, 2, '2023-08-30', '15:41:29', 'Listar lideres sin casa sobre la roca'),
(4005, 27199177, 1, '2023-08-30', '15:41:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(4006, 27199177, 1, '2023-08-30', '15:41:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(4007, 27199177, 2, '2023-08-30', '15:41:34', 'Listar lideres sin casa sobre la roca'),
(4008, 27199177, 1, '2023-08-30', '15:41:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(4009, 27199177, 1, '2023-08-30', '15:41:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(4010, 27199177, 1, '2023-08-30', '15:41:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4011, 27199177, 2, '2023-08-30', '15:42:03', 'Listar lideres sin casa sobre la roca'),
(4012, 27199177, 2, '2023-08-30', '15:42:21', 'Listar lideres sin casa sobre la roca'),
(4013, 27199177, 1, '2023-08-30', '15:42:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(4014, 27199177, 1, '2023-08-30', '15:42:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(4015, 27199177, 1, '2023-08-30', '15:42:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(4016, 27199177, 2, '2023-08-30', '15:42:39', 'Listar lideres sin casa sobre la roca'),
(4017, 27199177, 1, '2023-08-30', '15:42:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(4018, 27199177, 1, '2023-08-30', '15:42:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(4019, 27199177, 1, '2023-08-30', '15:42:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4020, 27199177, 1, '2023-08-30', '15:42:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4021, 27199177, 1, '2023-08-30', '15:42:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4022, 27199177, 1, '2023-08-30', '15:42:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4023, 27199177, 1, '2023-08-30', '15:42:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4024, 27199177, 1, '2023-08-30', '15:42:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4025, 27199177, 1, '2023-08-30', '15:42:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4026, 27199177, 1, '2023-08-30', '15:42:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4027, 27199177, 1, '2023-08-30', '15:42:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4028, 27199177, 1, '2023-08-30', '15:42:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4029, 27199177, 1, '2023-08-30', '15:42:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4030, 27199177, 1, '2023-08-30', '15:42:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4031, 27199177, 1, '2023-08-30', '15:42:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(4032, 27199177, 2, '2023-08-30', '16:05:51', 'Listar lideres sin casa sobre la roca'),
(4033, 27199177, 2, '2023-08-30', '16:05:54', 'Listar lideres sin casa sobre la roca'),
(4034, 27199177, 2, '2023-08-30', '16:09:23', 'Listar lideres sin casa sobre la roca'),
(4035, 27199177, 2, '2023-08-30', '16:52:54', 'Listar lideres sin casa sobre la roca'),
(4036, 27199177, 2, '2023-08-30', '16:56:56', 'Listar lideres sin casa sobre la roca'),
(4037, 27199177, 2, '2023-08-30', '17:10:46', 'Listar lideres sin casa sobre la roca'),
(4038, 27199177, 2, '2023-08-31', '13:10:23', 'Listar lideres sin casa sobre la roca'),
(4039, 27199177, 1, '2023-08-31', '13:10:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(4040, 27199177, 1, '2023-08-31', '13:10:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(4041, 27199177, 2, '2023-08-31', '18:52:35', 'Listar lideres sin casa sobre la roca'),
(4042, 27199177, 8, '2023-08-31', '18:59:09', 'Generado Reporte estadistico cantidad  de celulas de discipulado'),
(4043, 27199177, 6, '2023-08-31', '19:07:57', 'Listar Celula de discipulado'),
(4044, 27199177, 6, '2023-08-31', '19:08:00', 'Listar Discipulos'),
(4045, 27199177, 6, '2023-08-31', '19:08:16', 'Listar Celula de discipulado'),
(4046, 27199177, 6, '2023-08-31', '19:08:17', 'Listar Discipulos'),
(4047, 27199177, 6, '2023-08-31', '19:08:22', 'Listar celula de Consolidacion'),
(4048, 27199177, 6, '2023-08-31', '19:08:41', 'Listar celula de Consolidacion'),
(4049, 27199177, 2, '2023-08-31', '20:01:51', 'Listar lideres sin casa sobre la roca'),
(4050, 27199177, 3, '2023-08-31', '20:02:08', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4051, 27199177, 3, '2023-08-31', '20:03:24', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4052, 27199177, 3, '2023-08-31', '20:03:50', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4053, 27199177, 3, '2023-08-31', '20:05:28', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4054, 27199177, 3, '2023-08-31', '20:06:41', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4055, 27199177, 3, '2023-08-31', '20:06:51', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4056, 27199177, 3, '2023-08-31', '20:16:27', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4057, 27199177, 3, '2023-08-31', '20:32:57', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4058, 27199177, 2, '2023-08-31', '22:05:40', 'Listar lideres sin casa sobre la roca'),
(4059, 27199177, 1, '2023-08-31', '22:06:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(4060, 27199177, 1, '2023-08-31', '22:06:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(4061, 27199177, 1, '2023-08-31', '22:07:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(4062, 27199177, 1, '2023-08-31', '22:07:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(4063, 27199177, 2, '2023-08-31', '22:09:49', 'Listar lideres sin casa sobre la roca'),
(4064, 27199177, 1, '2023-08-31', '23:40:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(4065, 27199177, 2, '2023-08-31', '23:40:21', 'Listar casas sobre la roca'),
(4066, 27199177, 1, '2023-08-31', '23:45:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(4067, 27199177, 1, '2023-08-31', '23:45:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(4068, 27199177, 1, '2023-08-31', '23:45:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(4069, 27199177, 1, '2023-09-01', '00:14:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(4070, 27199177, 1, '2023-09-01', '00:15:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(4071, 27199177, 1, '2023-09-01', '00:15:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(4072, 27199177, 1, '2023-09-01', '00:15:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(4073, 27199177, 2, '2023-09-01', '00:16:20', 'Listar casas sobre la roca'),
(4074, 27199177, 2, '2023-09-01', '00:16:37', 'Listar lideres sin casa sobre la roca'),
(4075, 27199177, 1, '2023-09-01', '00:16:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(4076, 27199177, 1, '2023-09-01', '00:16:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(4077, 27199177, 1, '2023-09-01', '00:20:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(4078, 27199177, 1, '2023-09-01', '00:20:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(4079, 27199177, 1, '2023-09-01', '00:20:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(4080, 27199177, 1, '2023-09-01', '00:21:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(4081, 27199177, 1, '2023-09-01', '00:21:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(4082, 27199177, 1, '2023-09-01', '00:21:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4083, 27199177, 1, '2023-09-01', '00:22:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(4084, 27199177, 1, '2023-09-01', '00:23:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(4085, 27199177, 1, '2023-09-01', '00:24:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(4086, 27199177, 1, '2023-09-01', '00:25:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(4087, 27199177, 1, '2023-09-01', '00:50:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(4088, 27199177, 1, '2023-09-01', '11:27:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(4089, 27199177, 1, '2023-09-01', '11:27:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(4090, 27199177, 2, '2023-09-01', '11:33:18', 'Listar casas sobre la roca'),
(4091, 27199177, 1, '2023-09-01', '15:26:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(4092, 27199177, 1, '2023-09-01', '15:30:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(4093, 27199177, 1, '2023-09-01', '15:31:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(4094, 27199177, 1, '2023-09-01', '15:34:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(4095, 27199177, 1, '2023-09-01', '15:39:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(4096, 27199177, 1, '2023-09-01', '15:40:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(4097, 27199177, 2, '2023-09-01', '15:42:19', 'Listar casas sobre la roca'),
(4098, 27199177, 1, '2023-09-01', '15:46:00', 'El usuario ha entrado a \"Mi Perfil\"'),
(4099, 27199177, 1, '2023-09-01', '16:06:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(4100, 27199177, 1, '2023-09-01', '16:08:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(4101, 27199177, 1, '2023-09-01', '16:13:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(4102, 27199177, 2, '2023-09-01', '16:13:41', 'Listar casas sobre la roca'),
(4103, 27199177, 1, '2023-09-01', '17:14:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(4104, 27199177, 2, '2023-09-01', '17:14:59', 'Listar casas sobre la roca'),
(4105, 27199177, 1, '2023-09-01', '17:15:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(4106, 27199177, 1, '2023-09-01', '17:46:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(4107, 27199177, 2, '2023-09-01', '17:49:32', 'Listar lideres sin casa sobre la roca'),
(4108, 27199177, 2, '2023-09-01', '21:35:33', 'Listar lideres sin casa sobre la roca'),
(4109, 27199177, 2, '2023-09-01', '21:36:25', 'Listar lideres sin casa sobre la roca'),
(4110, 27199177, 2, '2023-09-01', '21:38:07', 'Listar lideres sin casa sobre la roca'),
(4111, 27199177, 2, '2023-09-01', '21:38:42', 'Listar lideres sin casa sobre la roca'),
(4112, 27199177, 2, '2023-09-01', '21:39:40', 'Listar lideres sin casa sobre la roca'),
(4113, 27199177, 2, '2023-09-01', '21:55:44', 'Listar lideres sin casa sobre la roca'),
(4114, 27199177, 2, '2023-09-01', '21:56:36', 'Listar lideres sin casa sobre la roca'),
(4115, 27199177, 2, '2023-09-01', '21:56:37', 'Listar lideres sin casa sobre la roca'),
(4116, 27199177, 2, '2023-09-01', '21:56:37', 'Listar lideres sin casa sobre la roca'),
(4117, 27199177, 2, '2023-09-01', '21:59:41', 'Listar lideres sin casa sobre la roca'),
(4118, 27199177, 2, '2023-09-01', '22:08:32', 'Listar lideres sin casa sobre la roca'),
(4119, 27199177, 2, '2023-09-01', '22:08:34', 'Listar lideres sin casa sobre la roca'),
(4120, 27199177, 2, '2023-09-01', '22:08:44', 'Listar lideres sin casa sobre la roca'),
(4121, 27199177, 2, '2023-09-01', '22:08:47', 'Listar lideres sin casa sobre la roca'),
(4122, 27199177, 2, '2023-09-01', '22:09:09', 'Listar lideres sin casa sobre la roca'),
(4123, 27199177, 3, '2023-09-01', '22:22:33', 'El usuario ha entrado al apartado de Agregar Materias'),
(4124, 27199177, 3, '2023-09-01', '22:27:57', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4125, 27199177, 3, '2023-09-01', '22:28:00', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4126, 27199177, 3, '2023-09-01', '22:28:02', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4127, 27199177, 3, '2023-09-01', '22:28:09', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4128, 27199177, 3, '2023-09-01', '22:28:13', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4129, 27199177, 3, '2023-09-01', '22:28:58', 'El usuario ha agregado mas estudiante a una seccion'),
(4130, 27199177, 3, '2023-09-01', '22:29:08', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4131, 27199177, 3, '2023-09-01', '22:29:15', 'Ha desvinculado a 27666555-N2-VE-LA-H-S-CD1-CC1 Jesus Aguirre como profesor en la ECAM'),
(4132, 27199177, 3, '2023-09-01', '22:29:28', 'Ha agregado a 27666555-N2-VE-LA-H-S-CD1-CC1 Jesus Aguirre como profesor en la ECAM'),
(4133, 27199177, 3, '2023-09-01', '22:29:48', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4134, 27199177, 3, '2023-09-01', '22:29:52', 'Ha agregado a 12021047-N2-VE-LA-H- Marcos Aguilar como profesor en la ECAM'),
(4135, 27199177, 3, '2023-09-01', '22:30:01', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4136, 27199177, 3, '2023-09-01', '22:30:03', 'El usuario ha entrado al apartado de Agregar Materias'),
(4137, 27199177, 3, '2023-09-01', '22:30:14', 'Ha agregado una materia nueva llamada Prueba en excel'),
(4138, 27199177, 3, '2023-09-01', '22:30:19', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4139, 27199177, 3, '2023-09-01', '22:30:25', 'El usuario ha actualizado las materias y profesores de una seccion'),
(4140, 27199177, 2, '2023-09-01', '22:32:14', 'Listar lideres sin casa sobre la roca'),
(4141, 27199177, 3, '2023-09-01', '22:32:17', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(4142, 27199177, 3, '2023-09-01', '22:32:19', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4143, 27199177, 3, '2023-09-01', '22:32:20', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4144, 27199177, 3, '2023-09-01', '22:32:22', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4145, 27199177, 3, '2023-09-01', '22:32:23', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4146, 27199177, 3, '2023-09-01', '22:32:27', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4147, 27199177, 3, '2023-09-01', '22:32:41', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4148, 27199177, 3, '2023-09-01', '22:38:11', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4149, 27199177, 3, '2023-09-01', '22:38:19', 'El usuario ha entrado al apartado de Crear Seccion'),
(4150, 27199177, 3, '2023-09-01', '22:38:57', 'El usuario ha entrado al apartado de Crear Seccion'),
(4151, 27199177, 3, '2023-09-01', '22:41:47', 'El usuario ha entrado al apartado de Crear Seccion'),
(4152, 27199177, 3, '2023-09-01', '22:41:47', 'El usuario ha entrado al apartado de Crear Seccion'),
(4153, 27199177, 2, '2023-09-01', '22:41:50', 'Listar casas sobre la roca'),
(4154, 27199177, 2, '2023-09-01', '22:42:54', 'Listar casas sobre la roca'),
(4155, 27199177, 2, '2023-09-01', '22:43:08', 'Listar casas sobre la roca'),
(4156, 27199177, 2, '2023-09-01', '22:43:22', 'Listar casas sobre la roca'),
(4157, 27199177, 2, '2023-09-01', '22:44:01', 'Listar casas sobre la roca'),
(4158, 27199177, 2, '2023-09-01', '22:44:33', 'Listar casas sobre la roca'),
(4159, 27199177, 2, '2023-09-01', '22:44:48', 'Listar casas sobre la roca'),
(4160, 27199177, 2, '2023-09-01', '22:45:02', 'Listar casas sobre la roca'),
(4161, 27199177, 6, '2023-09-01', '22:46:47', 'Listar celula de Consolidacion'),
(4162, 27199177, 6, '2023-09-01', '22:46:51', 'Listar celula de Consolidacion'),
(4163, 27199177, 6, '2023-09-01', '22:47:04', 'Listar celula de Consolidacion'),
(4164, 27199177, 6, '2023-09-01', '22:47:29', 'Listar celula de Consolidacion'),
(4165, 27199177, 6, '2023-09-01', '22:47:33', 'Listar Celula de discipulado'),
(4166, 27199177, 6, '2023-09-01', '22:47:39', 'Listar Celula de discipulado'),
(4167, 27199177, 6, '2023-09-01', '22:48:02', 'Listar Celula de discipulado'),
(4168, 27199177, 6, '2023-09-01', '22:48:11', 'Listar Celula de discipulado'),
(4169, 27199177, 6, '2023-09-01', '22:48:13', 'Listar Celula de discipulado'),
(4170, 27199177, 6, '2023-09-01', '22:48:16', 'Listar celula de Consolidacion'),
(4171, 27199177, 6, '2023-09-01', '22:48:19', 'Listar Celula de discipulado'),
(4172, 27199177, 6, '2023-09-01', '22:48:49', 'Listar Celula de discipulado'),
(4173, 27199177, 6, '2023-09-01', '22:50:08', 'Listar Celula de discipulado'),
(4174, 27199177, 6, '2023-09-01', '22:50:58', 'Listar Celula de discipulado'),
(4175, 27199177, 6, '2023-09-01', '22:51:25', 'Listar Celula de discipulado'),
(4176, 27199177, 6, '2023-09-01', '22:51:44', 'Listar celula de Consolidacion'),
(4177, 27199177, 6, '2023-09-01', '22:52:31', 'Listar Celula de discipulado'),
(4178, 27199177, 6, '2023-09-01', '22:52:45', 'Listar Celula de discipulado'),
(4179, 27199177, 6, '2023-09-01', '22:56:37', 'Listar Celula de discipulado'),
(4180, 27199177, 6, '2023-09-01', '22:56:49', 'Listar Discipulos'),
(4181, 27199177, 6, '2023-09-01', '22:57:18', 'Listar Discipulos'),
(4182, 27199177, 6, '2023-09-01', '22:59:42', 'Listar Discipulos'),
(4183, 27199177, 6, '2023-09-01', '23:00:21', 'Listar Celula de discipulado'),
(4184, 27199177, 6, '2023-09-01', '23:00:42', 'Listar Discipulos'),
(4185, 27199177, 6, '2023-09-01', '23:02:00', 'Listar Celula de discipulado'),
(4186, 27199177, 6, '2023-09-01', '23:02:09', 'Listar Discipulos'),
(4187, 27199177, 6, '2023-09-01', '23:04:11', 'Listar Celula de discipulado'),
(4188, 27199177, 6, '2023-09-01', '23:04:12', 'Listar Discipulos'),
(4189, 27199177, 6, '2023-09-01', '23:04:52', 'Listar Celula de discipulado'),
(4190, 27199177, 6, '2023-09-01', '23:04:52', 'Listar Discipulos');
INSERT INTO `bitacora_usuario` (`id`, `cedula_usuario`, `id_modulo`, `fecha_registro`, `hora_registro`, `accion_realizada`) VALUES
(4191, 27199177, 6, '2023-09-01', '23:05:00', 'Listar Celula de discipulado'),
(4192, 27199177, 6, '2023-09-01', '23:08:35', 'Listar Celula de discipulado'),
(4193, 27199177, 6, '2023-09-01', '23:08:43', 'Listar Discipulos'),
(4194, 27199177, 6, '2023-09-01', '23:09:43', 'Listar Discipulos'),
(4195, 27199177, 6, '2023-09-01', '23:11:11', 'Listar Discipulos'),
(4196, 27199177, 6, '2023-09-01', '23:11:47', 'Listar Celula de discipulado'),
(4197, 27199177, 6, '2023-09-01', '23:11:48', 'Listar Discipulos'),
(4198, 27199177, 3, '2023-09-01', '23:13:00', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4199, 27199177, 12, '2023-09-01', '23:14:21', 'El usuario ha revisado sus notificaciones'),
(4200, 27199177, 12, '2023-09-01', '23:20:20', 'El usuario ha revisado sus notificaciones'),
(4201, 27199177, 3, '2023-09-01', '23:20:23', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4202, 27199177, 3, '2023-09-01', '23:20:45', 'El usuario eliminado una materia de la seccion'),
(4203, 27199177, 3, '2023-09-01', '23:20:51', 'El usuario ha actualizado las materias y profesores de una seccion'),
(4204, 27199177, 3, '2023-09-01', '23:22:19', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4205, 27199177, 1, '2023-09-01', '23:22:25', 'Listar todos los usuarios'),
(4206, 27199177, 1, '2023-09-01', '23:24:57', 'Listar todos los usuarios'),
(4207, 27199177, 1, '2023-09-01', '23:25:11', 'Listar todos los usuarios'),
(4208, 27199177, 1, '2023-09-01', '23:26:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(4209, 27199177, 1, '2023-09-01', '23:26:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(4210, 27199177, 3, '2023-09-01', '23:28:06', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(4211, 27199177, 3, '2023-09-01', '23:28:07', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4212, 27199177, 3, '2023-09-01', '23:28:16', 'Le ha agregado nota de la materia Prueba en excel a un estudiante de la seccion Prueba'),
(4213, 27199177, 3, '2023-09-01', '23:28:21', 'Ha actualizado la nota de la materia Prueba en excel a un estudiante de la seccion Prueba'),
(4214, 27199177, 3, '2023-09-01', '23:28:26', 'Ha actualizado la nota de la materia Prueba en excel a un estudiante de la seccion Prueba'),
(4215, 27199177, 3, '2023-09-01', '23:28:30', 'Ha actualizado la nota de la materia Prueba en excel a un estudiante de la seccion Prueba'),
(4216, 27199177, 3, '2023-09-01', '23:28:35', 'Ha eliminado la nota de la materia Prueba en excel a un estudiante de la seccion Prueba'),
(4217, 27199177, 3, '2023-09-01', '23:34:06', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4218, 27199177, 3, '2023-09-01', '23:34:07', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4219, 27199177, 3, '2023-09-01', '23:34:07', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4220, 27199177, 3, '2023-09-01', '23:34:12', 'El profesor ha agregado contenido a Prueba en excel nivel 1 en la seccion Prueba'),
(4221, 27199177, 3, '2023-09-01', '23:35:01', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4222, 27199177, 3, '2023-09-01', '23:35:07', 'El usuario ha revisado el contenido de su materia'),
(4223, 27199177, 3, '2023-09-01', '23:35:13', 'El usuario ha eliminado la informacion de la materia'),
(4224, 27199177, 3, '2023-09-01', '23:35:23', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4225, 27199177, 3, '2023-09-01', '23:35:28', 'El profesor ha agregado contenido a Prueba en excel nivel 1 en la seccion Prueba'),
(4226, 27199177, 3, '2023-09-01', '23:37:18', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4227, 27199177, 3, '2023-09-01', '23:37:20', 'El usuario ha eliminado la informacion de la materia'),
(4228, 27199177, 3, '2023-09-01', '23:37:24', 'El profesor ha agregado contenido a Prueba en excel nivel 1 en la seccion Prueba'),
(4229, 27199177, 3, '2023-09-01', '23:37:40', 'El usuario ha eliminado la informacion de la materia'),
(4230, 27199177, 3, '2023-09-01', '23:49:09', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(4231, 27199177, 3, '2023-09-01', '23:49:13', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4232, 27199177, 3, '2023-09-01', '23:49:16', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4233, 27199177, 3, '2023-09-01', '23:49:18', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(4234, 27199177, 1, '2023-09-03', '13:05:08', 'El usuario ha entrado a \"Mi Perfil\"'),
(4235, 27199177, 2, '2023-09-03', '13:06:40', 'Listar casas sobre la roca'),
(4236, 27199177, 1, '2023-09-03', '13:39:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(4237, 27199177, 1, '2023-09-03', '13:55:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(4238, 27199177, 1, '2023-09-04', '11:51:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(4239, 27199177, 1, '2023-09-04', '11:53:07', 'El usuario ha entrado a \"Mi Perfil\"'),
(4240, 27199177, 1, '2023-09-04', '11:53:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(4241, 27199177, 1, '2023-09-04', '12:01:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(4242, 27199177, 1, '2023-09-04', '12:03:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(4243, 27199177, 1, '2023-09-04', '12:04:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(4244, 27199177, 1, '2023-09-04', '12:07:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(4245, 27199177, 1, '2023-09-04', '12:08:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(4246, 27199177, 1, '2023-09-04', '12:12:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(4247, 27199177, 1, '2023-09-04', '12:14:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(4248, 27199177, 1, '2023-09-04', '12:15:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(4249, 27199177, 1, '2023-09-04', '12:20:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4250, 27199177, 2, '2023-09-04', '12:21:00', 'Listar casas sobre la roca'),
(4251, 27199177, 1, '2023-09-04', '12:21:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(4252, 27199177, 2, '2023-09-04', '12:21:42', 'Listar casas sobre la roca'),
(4253, 27199177, 1, '2023-09-04', '12:25:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(4254, 27199177, 2, '2023-09-04', '12:25:12', 'Listar casas sobre la roca'),
(4255, 27199177, 1, '2023-09-04', '17:04:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(4256, 27199177, 2, '2023-09-04', '17:04:12', 'Listar casas sobre la roca'),
(4257, 27199177, 1, '2023-09-04', '17:05:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(4258, 27199177, 1, '2023-09-04', '17:06:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(4259, 27199177, 2, '2023-09-04', '17:07:28', 'Listar casas sobre la roca'),
(4260, 27199177, 1, '2023-09-04', '19:06:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(4261, 27199177, 2, '2023-09-04', '19:07:33', 'Listar casas sobre la roca'),
(4262, 27199177, 2, '2023-09-07', '23:49:50', 'Listar lideres sin casa sobre la roca'),
(4263, 27199177, 2, '2023-09-07', '23:51:19', 'Listar lideres sin casa sobre la roca'),
(4264, 27199177, 2, '2023-09-07', '23:51:29', 'Listar lideres sin casa sobre la roca'),
(4265, 27199177, 2, '2023-09-07', '23:51:35', 'Listar lideres sin casa sobre la roca'),
(4266, 27199177, 2, '2023-09-07', '23:54:34', 'Listar lideres sin casa sobre la roca'),
(4267, 27199177, 2, '2023-09-07', '23:54:47', 'Listar lideres sin casa sobre la roca'),
(4268, 27199177, 2, '2023-09-07', '23:55:03', 'Listar lideres sin casa sobre la roca'),
(4269, 27199177, 2, '2023-09-07', '23:55:11', 'Listar lideres sin casa sobre la roca'),
(4270, 27199177, 2, '2023-09-07', '23:55:36', 'Listar lideres sin casa sobre la roca'),
(4271, 27199177, 2, '2023-09-07', '23:55:57', 'Listar lideres sin casa sobre la roca'),
(4272, 27199177, 2, '2023-09-09', '15:37:03', 'Listar lideres sin casa sobre la roca'),
(4273, 27199177, 12, '2023-09-09', '15:39:53', 'El usuario ha revisado sus notificaciones'),
(4274, 27199177, 2, '2023-09-10', '16:22:13', 'Listar lideres sin casa sobre la roca'),
(4275, 27199177, 3, '2023-09-10', '16:22:16', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4276, 27199177, 3, '2023-09-10', '16:22:27', 'El usuario ha agregado mas estudiante a una seccion'),
(4277, 27199177, 3, '2023-09-10', '16:22:31', 'El usuario ha desvinculado a un estudiante de una seccion'),
(4278, 27199177, 3, '2023-09-10', '16:22:33', 'El usuario ha desvinculado a un estudiante de una seccion'),
(4279, 27199177, 3, '2023-09-10', '16:25:58', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4280, 27199177, 3, '2023-09-10', '16:26:10', 'El usuario ha agregado mas estudiante a una seccion'),
(4281, 27199177, 3, '2023-09-10', '16:26:22', 'El usuario ha desvinculado a un estudiante de una seccion'),
(4282, 27199177, 3, '2023-09-10', '16:27:23', 'El usuario ha agregado mas estudiante a una seccion'),
(4283, 27199177, 3, '2023-09-10', '16:27:27', 'El usuario ha desvinculado a un estudiante de una seccion'),
(4284, 27199177, 3, '2023-09-10', '16:27:30', 'El usuario ha desvinculado a un estudiante de una seccion'),
(4285, 27199177, 1, '2023-09-11', '19:32:06', 'El usuario ha entrado a \"Mi Perfil\"'),
(4286, 27199177, 2, '2023-09-11', '19:32:54', 'Listar casas sobre la roca'),
(4287, 27199177, 2, '2023-09-19', '08:41:20', 'Listar lideres sin casa sobre la roca'),
(4288, 27199177, 1, '2023-09-19', '08:41:28', 'Listar todos los usuarios'),
(4289, 27199177, 1, '2023-09-19', '08:42:12', 'Listar todos los usuarios'),
(4290, 27199177, 1, '2023-09-19', '08:42:22', 'Listar todos los usuarios'),
(4291, 27199177, 2, '2023-09-19', '08:42:51', 'Listar casas sobre la roca'),
(4292, 27199177, 1, '2023-09-19', '08:42:57', 'Listar todos los usuarios'),
(4293, 27199177, 1, '2023-09-19', '08:44:23', 'Listar todos los usuarios'),
(4294, 27199177, 1, '2023-09-19', '08:44:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(4295, 27199177, 1, '2023-09-19', '08:44:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(4296, 27199177, 1, '2023-09-19', '08:48:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(4297, 27199177, 1, '2023-09-19', '08:48:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(4298, 27199177, 1, '2023-09-19', '08:48:42', 'El usuario ha entrado a \"Mi Perfil\"'),
(4299, 27199177, 2, '2023-09-19', '08:49:01', 'Listar lideres sin casa sobre la roca'),
(4300, 27199177, 1, '2023-09-19', '08:49:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(4301, 27199177, 1, '2023-09-19', '08:49:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(4302, 27199177, 1, '2023-09-19', '08:50:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(4303, 27199177, 1, '2023-09-19', '08:50:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(4304, 27199177, 1, '2023-09-30', '08:11:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(4305, 27199177, 2, '2023-09-30', '08:12:09', 'Listar casas sobre la roca'),
(4306, 27199177, 2, '2023-09-30', '09:02:03', 'Listar lideres sin casa sobre la roca'),
(4307, 27199177, 1, '2023-09-30', '09:02:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(4308, 27199177, 1, '2023-09-30', '09:22:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(4309, 27199177, 2, '2023-09-30', '09:24:44', 'Listar casas sobre la roca'),
(4310, 27199177, 2, '2023-10-02', '15:19:45', 'Listar lideres sin casa sobre la roca'),
(4311, 27199177, 1, '2023-10-02', '15:19:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(4312, 27199177, 1, '2023-10-02', '15:19:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(4313, 27199177, 1, '2023-10-02', '15:19:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(4314, 27199177, 1, '2023-10-02', '15:19:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(4315, 27199177, 1, '2023-10-02', '15:20:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(4316, 27199177, 1, '2023-10-02', '15:20:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(4317, 27199177, 1, '2023-10-02', '15:20:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(4318, 27199177, 1, '2023-10-02', '15:21:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(4319, 27199177, 1, '2023-10-02', '15:21:03', 'Editar foto de usuario'),
(4320, 27199177, 1, '2023-10-02', '15:21:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(4321, 27199177, 1, '2023-10-02', '15:21:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(4322, 27199177, 1, '2023-10-02', '15:21:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(4323, 27199177, 1, '2023-10-02', '15:22:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(4324, 27199177, 1, '2023-10-02', '15:25:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4325, 27199177, 1, '2023-10-02', '15:29:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(4326, 27199177, 1, '2023-10-02', '15:30:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(4327, 27199177, 1, '2023-10-02', '15:31:48', 'El usuario ha entrado a \"Mi Perfil\"'),
(4328, 27199177, 2, '2023-10-02', '15:32:08', 'Listar lideres sin casa sobre la roca'),
(4329, 27199177, 1, '2023-10-02', '15:32:08', 'El usuario ha entrado a \"Mi Perfil\"'),
(4330, 27199177, 2, '2023-10-02', '15:36:36', 'Listar lideres sin casa sobre la roca'),
(4331, 27199177, 2, '2023-10-02', '15:36:36', 'Listar lideres sin casa sobre la roca'),
(4332, 27199177, 1, '2023-10-02', '15:36:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4333, 27199177, 1, '2023-10-02', '15:36:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(4334, 27199177, 1, '2023-10-02', '15:36:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(4335, 27199177, 1, '2023-10-02', '15:36:53', 'El usuario ha entrado a \"Mi Perfil\"'),
(4336, 27199177, 1, '2023-10-02', '15:37:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(4337, 27199177, 3, '2023-10-02', '15:37:33', 'El usuario ha entrado a Control de Notas'),
(4338, 27199177, 1, '2023-10-02', '15:37:33', 'El usuario ha entrado a \"Mi Perfil\"'),
(4339, 27199177, 3, '2023-10-02', '15:37:33', 'Has listado las notas finales de los estudiantes'),
(4340, 27199177, 3, '2023-10-02', '15:38:13', 'El usuario ha entrado a Control de Notas'),
(4341, 27199177, 3, '2023-10-02', '15:38:13', 'Has listado las notas finales de los estudiantes'),
(4342, 27199177, 1, '2023-10-02', '15:38:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(4343, 27199177, 3, '2023-10-02', '15:38:34', 'El usuario ha entrado a Control de Notas'),
(4344, 27199177, 3, '2023-10-02', '15:38:34', 'Has listado las notas finales de los estudiantes'),
(4345, 27199177, 1, '2023-10-02', '15:38:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(4346, 27199177, 3, '2023-10-02', '15:38:45', 'El usuario ha entrado a Control de Notas'),
(4347, 27199177, 3, '2023-10-02', '15:38:45', 'Has listado las notas finales de los estudiantes'),
(4348, 27199177, 1, '2023-10-02', '15:38:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(4349, 27199177, 3, '2023-10-02', '15:39:12', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(4350, 27199177, 1, '2023-10-02', '15:39:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(4351, 27199177, 3, '2023-10-02', '15:39:20', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4352, 27199177, 1, '2023-10-02', '15:39:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(4353, 27199177, 3, '2023-10-02', '15:39:22', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4354, 27199177, 1, '2023-10-02', '15:39:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(4355, 27199177, 3, '2023-10-02', '15:39:31', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(4356, 27199177, 1, '2023-10-02', '15:39:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(4357, 27199177, 1, '2023-10-02', '15:39:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(4358, 27199177, 1, '2023-10-02', '15:39:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(4359, 27199177, 3, '2023-10-02', '15:39:57', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4360, 27199177, 1, '2023-10-02', '15:39:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(4361, 27199177, 3, '2023-10-02', '15:40:15', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(4362, 27199177, 1, '2023-10-02', '15:40:16', 'El usuario ha entrado a \"Mi Perfil\"'),
(4363, 27199177, 3, '2023-10-02', '15:41:27', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(4364, 27199177, 1, '2023-10-02', '15:41:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(4365, 27199177, 3, '2023-10-02', '15:42:14', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(4366, 27199177, 1, '2023-10-02', '15:42:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(4367, 27199177, 3, '2023-10-02', '15:42:15', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(4368, 27199177, 1, '2023-10-02', '15:42:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(4369, 27199177, 3, '2023-10-02', '15:42:30', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(4370, 27199177, 1, '2023-10-02', '15:42:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(4371, 27199177, 3, '2023-10-02', '15:42:38', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(4372, 27199177, 1, '2023-10-02', '15:42:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(4373, 27199177, 3, '2023-10-02', '15:42:52', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(4374, 27199177, 1, '2023-10-02', '15:42:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4375, 27199177, 3, '2023-10-02', '15:43:04', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4376, 27199177, 1, '2023-10-02', '15:43:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(4377, 27199177, 3, '2023-10-02', '15:43:12', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4378, 27199177, 1, '2023-10-02', '15:43:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(4379, 27199177, 3, '2023-10-02', '15:43:36', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4380, 27199177, 1, '2023-10-02', '15:43:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4381, 27199177, 3, '2023-10-02', '15:43:46', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4382, 27199177, 1, '2023-10-02', '15:43:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(4383, 27199177, 3, '2023-10-02', '15:43:49', 'El usuario ha entrado al apartado de Crear Seccion'),
(4384, 27199177, 1, '2023-10-02', '15:43:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(4385, 27199177, 12, '2023-10-02', '15:47:34', 'El usuario ha revisado sus notificaciones'),
(4386, 27199177, 1, '2023-10-02', '15:47:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(4387, 27199177, 1, '2023-10-02', '15:47:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(4388, 27199177, 3, '2023-10-02', '15:47:50', 'El usuario ha entrado al apartado de Agregar Materias'),
(4389, 27199177, 1, '2023-10-02', '15:47:51', 'El usuario ha entrado a \"Mi Perfil\"'),
(4390, 27199177, 3, '2023-10-02', '15:50:12', 'El usuario ha entrado al apartado de Agregar Materias'),
(4391, 27199177, 1, '2023-10-02', '15:50:12', 'El usuario ha entrado a \"Mi Perfil\"'),
(4392, 27199177, 3, '2023-10-02', '15:50:14', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(4393, 27199177, 1, '2023-10-02', '15:50:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(4394, 27199177, 3, '2023-10-02', '15:50:16', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4395, 27199177, 1, '2023-10-02', '15:50:16', 'El usuario ha entrado a \"Mi Perfil\"'),
(4396, 27199177, 3, '2023-10-02', '15:50:20', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4397, 27199177, 1, '2023-10-02', '15:50:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(4398, 27199177, 3, '2023-10-02', '15:50:23', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4399, 27199177, 1, '2023-10-02', '15:50:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(4400, 27199177, 3, '2023-10-02', '15:50:26', 'El usuario ha entrado al apartado de \"Listar Secciones Cerradas\" de la ECAM'),
(4401, 27199177, 1, '2023-10-02', '15:50:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(4402, 27199177, 1, '2023-10-02', '15:52:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(4403, 27199177, 1, '2023-10-02', '15:52:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(4404, 27199177, 1, '2023-10-02', '15:54:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(4405, 27199177, 3, '2023-10-02', '15:54:24', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4406, 27199177, 1, '2023-10-02', '15:54:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(4407, 27199177, 1, '2023-10-02', '15:54:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(4408, 27199177, 1, '2023-10-02', '15:55:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(4409, 27199177, 1, '2023-10-02', '15:56:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(4410, 27199177, 1, '2023-10-02', '15:57:11', 'El usuario ha entrado a \"Mi Perfil\"'),
(4411, 27199177, 1, '2023-10-02', '15:57:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(4412, 27199177, 2, '2023-10-02', '15:57:29', 'Listar casas sobre la roca'),
(4413, 27199177, 1, '2023-10-02', '15:59:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(4414, 27199177, 2, '2023-10-02', '15:59:55', 'Listar casas sobre la roca'),
(4415, 27199177, 1, '2023-10-02', '15:59:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(4416, 27199177, 1, '2023-10-02', '15:59:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(4417, 27199177, 1, '2023-10-02', '15:59:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(4418, 27199177, 1, '2023-10-02', '15:59:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(4419, 27199177, 1, '2023-10-02', '15:59:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(4420, 27199177, 2, '2023-10-02', '15:59:58', 'Listar casas sobre la roca'),
(4421, 27199177, 1, '2023-10-02', '16:02:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(4422, 27199177, 2, '2023-10-02', '16:02:23', 'Listar casas sobre la roca'),
(4423, 27199177, 1, '2023-10-02', '16:02:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(4424, 27199177, 2, '2023-10-02', '16:02:44', 'Listar casas sobre la roca'),
(4425, 27199177, 1, '2023-10-02', '16:03:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(4426, 27199177, 2, '2023-10-02', '16:03:11', 'Listar casas sobre la roca'),
(4427, 27199177, 1, '2023-10-02', '16:03:18', 'El usuario ha entrado a \"Mi Perfil\"'),
(4428, 27199177, 2, '2023-10-02', '16:03:18', 'Listar casas sobre la roca'),
(4429, 27199177, 1, '2023-10-02', '16:04:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(4430, 27199177, 2, '2023-10-02', '16:04:03', 'Listar casas sobre la roca'),
(4431, 27199177, 1, '2023-10-02', '16:04:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(4432, 27199177, 2, '2023-10-02', '16:04:42', 'Listar casas sobre la roca'),
(4433, 27199177, 1, '2023-10-02', '16:05:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(4434, 27199177, 2, '2023-10-02', '16:05:47', 'Listar casas sobre la roca'),
(4435, 27199177, 1, '2023-10-02', '16:05:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(4436, 27199177, 2, '2023-10-02', '16:05:57', 'Listar casas sobre la roca'),
(4437, 27199177, 1, '2023-10-02', '16:06:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(4438, 27199177, 2, '2023-10-02', '16:06:47', 'Listar casas sobre la roca'),
(4439, 27199177, 1, '2023-10-02', '16:07:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(4440, 27199177, 1, '2023-10-02', '16:07:25', 'El usuario ha entrado a \"Mi Perfil\"'),
(4441, 27199177, 2, '2023-10-02', '16:07:26', 'Listar casas sobre la roca'),
(4442, 27199177, 1, '2023-10-02', '16:07:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(4443, 27199177, 2, '2023-10-02', '16:07:40', 'Listar casas sobre la roca'),
(4444, 27199177, 1, '2023-10-02', '16:08:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(4445, 27199177, 2, '2023-10-02', '16:08:01', 'Listar casas sobre la roca'),
(4446, 27199177, 1, '2023-10-02', '16:08:02', 'El usuario ha entrado a \"Mi Perfil\"'),
(4447, 27199177, 2, '2023-10-02', '16:08:02', 'Listar casas sobre la roca'),
(4448, 27199177, 1, '2023-10-02', '16:09:08', 'El usuario ha entrado a \"Mi Perfil\"'),
(4449, 27199177, 2, '2023-10-02', '16:09:08', 'Listar casas sobre la roca'),
(4450, 27199177, 1, '2023-10-02', '16:09:09', 'El usuario ha entrado a \"Mi Perfil\"'),
(4451, 27199177, 2, '2023-10-02', '16:09:09', 'Listar casas sobre la roca'),
(4452, 27199177, 1, '2023-10-02', '16:09:29', 'El usuario ha entrado a \"Mi Perfil\"'),
(4453, 27199177, 2, '2023-10-02', '16:09:29', 'Listar casas sobre la roca'),
(4454, 27199177, 1, '2023-10-02', '16:10:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(4455, 27199177, 2, '2023-10-02', '16:10:21', 'Listar casas sobre la roca'),
(4456, 27199177, 1, '2023-10-02', '16:10:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(4457, 27199177, 2, '2023-10-02', '16:10:21', 'Listar casas sobre la roca'),
(4458, 27199177, 1, '2023-10-02', '16:10:35', 'El usuario ha entrado a \"Mi Perfil\"'),
(4459, 27199177, 2, '2023-10-02', '16:10:35', 'Listar casas sobre la roca'),
(4460, 27199177, 1, '2023-10-02', '16:10:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4461, 27199177, 2, '2023-10-02', '16:10:36', 'Listar casas sobre la roca'),
(4462, 27199177, 1, '2023-10-02', '16:11:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(4463, 27199177, 2, '2023-10-02', '16:11:28', 'Listar casas sobre la roca'),
(4464, 27199177, 1, '2023-10-02', '16:12:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(4465, 27199177, 2, '2023-10-02', '16:12:31', 'Listar casas sobre la roca'),
(4466, 27199177, 1, '2023-10-02', '16:12:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(4467, 27199177, 2, '2023-10-02', '16:12:49', 'Listar casas sobre la roca'),
(4468, 27199177, 1, '2023-10-02', '16:13:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(4469, 27199177, 1, '2023-10-02', '16:13:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(4470, 27199177, 2, '2023-10-02', '16:13:01', 'Listar casas sobre la roca'),
(4471, 27199177, 1, '2023-10-02', '16:13:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(4472, 27199177, 2, '2023-10-02', '16:13:05', 'Listar casas sobre la roca'),
(4473, 27199177, 1, '2023-10-02', '16:13:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(4474, 27199177, 2, '2023-10-02', '16:13:13', 'Listar casas sobre la roca'),
(4475, 27199177, 1, '2023-10-02', '16:13:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4476, 27199177, 1, '2023-10-02', '16:13:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4477, 27199177, 2, '2023-10-02', '16:13:36', 'Listar casas sobre la roca'),
(4478, 27199177, 1, '2023-10-02', '16:13:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(4479, 27199177, 1, '2023-10-02', '16:13:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(4480, 27199177, 1, '2023-10-02', '16:13:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(4481, 27199177, 2, '2023-10-02', '16:13:46', 'Listar casas sobre la roca'),
(4482, 27199177, 1, '2023-10-02', '16:14:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(4483, 27199177, 2, '2023-10-02', '16:14:57', 'Listar casas sobre la roca'),
(4484, 27199177, 1, '2023-10-02', '16:14:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(4485, 27199177, 2, '2023-10-02', '16:14:58', 'Listar casas sobre la roca'),
(4486, 27199177, 1, '2023-10-02', '16:15:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(4487, 27199177, 2, '2023-10-02', '16:15:17', 'Listar casas sobre la roca'),
(4488, 27199177, 1, '2023-10-02', '16:15:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(4489, 27199177, 1, '2023-10-02', '16:17:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(4490, 27199177, 1, '2023-10-02', '16:17:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4491, 27199177, 1, '2023-10-02', '16:17:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4492, 27199177, 1, '2023-10-02', '16:19:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(4493, 27199177, 1, '2023-10-02', '16:20:16', 'El usuario ha entrado a \"Mi Perfil\"'),
(4494, 27199177, 1, '2023-10-02', '16:20:21', 'El usuario ha entrado a \"Mi Perfil\"'),
(4495, 27199177, 1, '2023-10-02', '16:21:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(4496, 27199177, 1, '2023-10-02', '16:21:22', 'El usuario ha entrado a \"Mi Perfil\"'),
(4497, 27199177, 1, '2023-10-02', '16:22:05', 'El usuario ha entrado a \"Mi Perfil\"'),
(4498, 27199177, 1, '2023-10-02', '16:23:24', 'El usuario ha entrado a \"Mi Perfil\"'),
(4499, 27199177, 1, '2023-10-02', '16:24:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(4500, 27199177, 1, '2023-10-02', '16:24:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(4501, 27199177, 1, '2023-10-02', '16:24:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(4502, 27199177, 2, '2023-10-02', '16:57:56', 'Listar lideres sin casa sobre la roca'),
(4503, 27199177, 1, '2023-10-02', '16:57:57', 'El usuario ha entrado a \"Mi Perfil\"'),
(4504, 27199177, 3, '2023-10-02', '16:58:01', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4505, 27199177, 1, '2023-10-02', '16:58:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(4506, 27199177, 3, '2023-10-02', '16:58:43', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4507, 27199177, 1, '2023-10-02', '16:58:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(4508, 27199177, 3, '2023-10-02', '17:00:55', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4509, 27199177, 1, '2023-10-02', '17:00:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(4510, 27199177, 3, '2023-10-02', '17:01:40', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4511, 27199177, 1, '2023-10-02', '17:01:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(4512, 27199177, 3, '2023-10-02', '17:01:40', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4513, 27199177, 1, '2023-10-02', '17:01:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(4514, 27199177, 3, '2023-10-02', '17:02:03', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4515, 27199177, 1, '2023-10-02', '17:02:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(4516, 27199177, 3, '2023-10-02', '17:02:23', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4517, 27199177, 1, '2023-10-02', '17:02:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(4518, 27199177, 3, '2023-10-02', '17:02:31', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4519, 27199177, 1, '2023-10-02', '17:02:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(4520, 27199177, 3, '2023-10-02', '17:07:14', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(4521, 27199177, 1, '2023-10-02', '17:07:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(4522, 27199177, 3, '2023-10-02', '17:07:16', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4523, 27199177, 1, '2023-10-02', '17:07:16', 'El usuario ha entrado a \"Mi Perfil\"'),
(4524, 27199177, 3, '2023-10-02', '17:07:19', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4525, 27199177, 1, '2023-10-02', '17:07:20', 'El usuario ha entrado a \"Mi Perfil\"'),
(4526, 27199177, 3, '2023-10-02', '17:07:28', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4527, 27199177, 1, '2023-10-02', '17:07:28', 'El usuario ha entrado a \"Mi Perfil\"'),
(4528, 27199177, 3, '2023-10-02', '17:07:30', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4529, 27199177, 1, '2023-10-02', '17:07:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(4530, 27199177, 3, '2023-10-02', '17:19:38', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4531, 27199177, 1, '2023-10-02', '17:19:39', 'El usuario ha entrado a \"Mi Perfil\"'),
(4532, 27199177, 3, '2023-10-02', '17:19:40', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4533, 27199177, 3, '2023-10-02', '17:19:40', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4534, 27199177, 3, '2023-10-02', '17:19:41', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4535, 27199177, 1, '2023-10-02', '17:19:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(4536, 27199177, 1, '2023-10-02', '17:19:41', 'El usuario ha entrado a \"Mi Perfil\"'),
(4537, 27199177, 3, '2023-10-02', '17:19:47', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4538, 27199177, 1, '2023-10-02', '17:19:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(4539, 27199177, 3, '2023-10-02', '17:19:49', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4540, 27199177, 3, '2023-10-02', '17:19:49', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4541, 27199177, 1, '2023-10-02', '17:19:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(4542, 27199177, 3, '2023-10-02', '17:19:50', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4543, 27199177, 1, '2023-10-02', '17:19:50', 'El usuario ha entrado a \"Mi Perfil\"'),
(4544, 27199177, 3, '2023-10-02', '17:21:26', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4545, 27199177, 1, '2023-10-02', '17:21:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(4546, 27199177, 3, '2023-10-02', '17:21:26', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4547, 27199177, 3, '2023-10-02', '17:21:36', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4548, 27199177, 3, '2023-10-02', '17:21:36', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4549, 27199177, 1, '2023-10-02', '17:21:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4550, 27199177, 3, '2023-10-02', '17:21:36', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4551, 27199177, 1, '2023-10-02', '17:21:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4552, 27199177, 3, '2023-10-02', '17:21:36', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4553, 27199177, 3, '2023-10-02', '17:31:44', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4554, 27199177, 3, '2023-10-02', '17:31:44', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4555, 27199177, 1, '2023-10-02', '17:31:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(4556, 27199177, 3, '2023-10-02', '17:31:44', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4557, 27199177, 1, '2023-10-02', '17:31:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(4558, 27199177, 3, '2023-10-02', '17:31:45', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4559, 27199177, 3, '2023-10-02', '17:32:00', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4560, 27199177, 3, '2023-10-02', '17:32:00', 'El usuario ha actualizado los datos de una seccion'),
(4561, 27199177, 3, '2023-10-02', '17:32:00', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4562, 27199177, 1, '2023-10-02', '18:02:37', 'El usuario ha entrado a \"Mi Perfil\"'),
(4563, 27199177, 3, '2023-10-02', '18:03:46', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4564, 27199177, 1, '2023-10-02', '18:03:46', 'El usuario ha entrado a \"Mi Perfil\"'),
(4565, 27199177, 3, '2023-10-02', '18:03:46', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4566, 27199177, 3, '2023-10-02', '18:03:47', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4567, 27199177, 3, '2023-10-02', '18:03:54', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4568, 27199177, 3, '2023-10-02', '18:03:54', 'El usuario ha agregado mas estudiante a una seccion'),
(4569, 27199177, 3, '2023-10-02', '18:03:55', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4570, 27199177, 3, '2023-10-02', '18:03:59', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4571, 27199177, 3, '2023-10-02', '18:03:59', 'El usuario ha desvinculado a un estudiante de una seccion'),
(4572, 27199177, 3, '2023-10-02', '18:03:59', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4573, 27199177, 3, '2023-10-02', '18:04:02', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4574, 27199177, 3, '2023-10-02', '18:04:05', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4575, 27199177, 3, '2023-10-02', '18:04:05', 'El usuario ha actualizado las materias y profesores de una seccion'),
(4576, 27199177, 3, '2023-10-02', '18:04:05', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4577, 27199177, 3, '2023-10-02', '18:04:09', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4578, 27199177, 3, '2023-10-02', '18:04:09', 'El usuario eliminado una materia de la seccion'),
(4579, 27199177, 3, '2023-10-02', '18:04:09', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4580, 27199177, 3, '2023-10-02', '18:04:18', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4581, 27199177, 3, '2023-10-02', '18:04:20', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4582, 27199177, 3, '2023-10-02', '18:04:20', 'El usuario ha agregado mas estudiante a una seccion'),
(4583, 27199177, 3, '2023-10-02', '18:04:20', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4584, 27199177, 3, '2023-10-02', '18:04:23', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4585, 27199177, 3, '2023-10-02', '18:04:28', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4586, 27199177, 3, '2023-10-02', '18:04:30', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4587, 27199177, 3, '2023-10-02', '18:04:30', 'El usuario ha desvinculado a un estudiante de una seccion'),
(4588, 27199177, 3, '2023-10-02', '18:04:30', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4589, 27199177, 3, '2023-10-02', '18:20:15', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4590, 27199177, 3, '2023-10-02', '18:20:15', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4591, 27199177, 1, '2023-10-02', '18:20:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(4592, 27199177, 3, '2023-10-02', '18:20:19', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4593, 27199177, 3, '2023-10-02', '18:20:19', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4594, 27199177, 1, '2023-10-02', '18:20:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(4595, 27199177, 3, '2023-10-02', '18:20:27', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4596, 27199177, 1, '2023-10-02', '18:20:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(4597, 27199177, 3, '2023-10-02', '18:20:27', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4598, 27199177, 3, '2023-10-02', '18:20:39', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4599, 27199177, 3, '2023-10-02', '18:20:39', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4600, 27199177, 1, '2023-10-02', '18:20:40', 'El usuario ha entrado a \"Mi Perfil\"'),
(4601, 27199177, 3, '2023-10-02', '18:20:40', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4602, 27199177, 3, '2023-10-02', '18:20:43', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4603, 27199177, 3, '2023-10-02', '18:20:43', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4604, 27199177, 3, '2023-10-02', '18:20:54', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4605, 27199177, 1, '2023-10-02', '18:20:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(4606, 27199177, 3, '2023-10-02', '18:20:54', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4607, 27199177, 3, '2023-10-02', '18:20:56', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4608, 27199177, 3, '2023-10-02', '18:20:56', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4609, 27199177, 3, '2023-10-02', '18:20:58', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4610, 27199177, 1, '2023-10-02', '18:20:58', 'El usuario ha entrado a \"Mi Perfil\"'),
(4611, 27199177, 3, '2023-10-02', '18:20:58', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4612, 27199177, 3, '2023-10-02', '18:26:32', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4613, 27199177, 3, '2023-10-02', '18:26:32', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4614, 27199177, 1, '2023-10-02', '18:26:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(4615, 27199177, 3, '2023-10-02', '18:26:32', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4616, 27199177, 3, '2023-10-02', '18:26:32', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4617, 27199177, 1, '2023-10-02', '18:26:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(4618, 27199177, 3, '2023-10-02', '18:26:33', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4619, 27199177, 3, '2023-10-02', '18:26:33', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4620, 27199177, 3, '2023-10-02', '18:26:44', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4621, 27199177, 3, '2023-10-02', '18:26:45', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4622, 27199177, 1, '2023-10-02', '18:26:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(4623, 27199177, 3, '2023-10-02', '18:33:30', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4624, 27199177, 1, '2023-10-02', '18:33:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(4625, 27199177, 3, '2023-10-02', '18:33:30', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4626, 27199177, 3, '2023-10-02', '18:33:31', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4627, 27199177, 3, '2023-10-02', '18:33:31', 'El usuario ha entrado en el apartado de \"Listar Materias\" de la ECAM'),
(4628, 27199177, 3, '2023-10-02', '18:37:44', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4629, 27199177, 1, '2023-10-02', '18:37:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(4630, 27199177, 3, '2023-10-02', '18:37:44', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4631, 27199177, 3, '2023-10-02', '18:37:44', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4632, 27199177, 3, '2023-10-02', '18:37:51', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4633, 27199177, 3, '2023-10-02', '18:37:51', 'Ha desvinculado a 19482134-N2-VE-YA-M-S Adriana Hernadez como profesor en la ECAM'),
(4634, 27199177, 3, '2023-10-02', '18:37:55', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4635, 27199177, 3, '2023-10-02', '18:37:55', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4636, 27199177, 3, '2023-10-02', '18:37:55', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4637, 27199177, 1, '2023-10-02', '18:37:56', 'El usuario ha entrado a \"Mi Perfil\"'),
(4638, 27199177, 3, '2023-10-02', '18:38:18', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4639, 27199177, 1, '2023-10-02', '18:38:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(4640, 27199177, 3, '2023-10-02', '18:38:19', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4641, 27199177, 3, '2023-10-02', '18:38:19', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4642, 27199177, 3, '2023-10-02', '18:38:19', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4643, 27199177, 1, '2023-10-02', '18:38:19', 'El usuario ha entrado a \"Mi Perfil\"'),
(4644, 27199177, 3, '2023-10-02', '18:38:19', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4645, 27199177, 3, '2023-10-02', '18:38:19', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4646, 27199177, 3, '2023-10-02', '18:38:23', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4647, 27199177, 3, '2023-10-02', '18:38:23', 'Ha agregado a 19482134-N2-VE-YA-M-S Adriana Hernadez como profesor en la ECAM'),
(4648, 27199177, 3, '2023-10-02', '18:38:23', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4649, 27199177, 3, '2023-10-02', '18:38:23', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4650, 27199177, 3, '2023-10-02', '18:38:26', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4651, 27199177, 3, '2023-10-02', '18:38:26', 'Ha desvinculado a 19482134-N2-VE-YA-M-S Adriana Hernadez como profesor en la ECAM'),
(4652, 27199177, 3, '2023-10-02', '18:38:27', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4653, 27199177, 3, '2023-10-02', '18:38:27', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4654, 27199177, 3, '2023-10-02', '18:43:36', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4655, 27199177, 1, '2023-10-02', '18:43:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4656, 27199177, 3, '2023-10-02', '18:43:36', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4657, 27199177, 3, '2023-10-02', '18:43:36', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4658, 27199177, 3, '2023-10-02', '18:44:14', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4659, 27199177, 1, '2023-10-02', '18:44:14', 'El usuario ha entrado a \"Mi Perfil\"'),
(4660, 27199177, 3, '2023-10-02', '18:44:14', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4661, 27199177, 3, '2023-10-02', '18:44:14', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4662, 27199177, 3, '2023-10-02', '18:44:14', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4663, 27199177, 3, '2023-10-02', '18:44:14', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4664, 27199177, 1, '2023-10-02', '18:44:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(4665, 27199177, 3, '2023-10-02', '18:44:15', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4666, 27199177, 3, '2023-10-02', '18:44:15', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4667, 27199177, 3, '2023-10-02', '18:45:13', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4668, 27199177, 3, '2023-10-02', '18:45:13', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4669, 27199177, 1, '2023-10-02', '18:45:13', 'El usuario ha entrado a \"Mi Perfil\"'),
(4670, 27199177, 3, '2023-10-02', '18:45:13', 'El usuario ha entrado al apartado de \"Agregar Profesores\" a la ECAM'),
(4671, 27199177, 3, '2023-10-02', '18:45:15', 'El usuario ha entrado al apartado de Agregar Materias'),
(4672, 27199177, 1, '2023-10-02', '18:45:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(4673, 27199177, 3, '2023-10-02', '18:45:15', 'El usuario ha entrado al apartado de Agregar Materias'),
(4674, 27199177, 3, '2023-10-02', '18:46:55', 'El usuario ha entrado a Control de Notas'),
(4675, 27199177, 1, '2023-10-02', '18:46:55', 'El usuario ha entrado a \"Mi Perfil\"'),
(4676, 27199177, 3, '2023-10-02', '18:46:55', 'Has listado las notas finales de los estudiantes'),
(4677, 27199177, 3, '2023-10-02', '18:47:10', 'El usuario ha entrado al apartado de Crear Seccion'),
(4678, 27199177, 1, '2023-10-02', '18:47:10', 'El usuario ha entrado a \"Mi Perfil\"'),
(4679, 27199177, 1, '2023-10-02', '18:49:38', 'El usuario ha entrado a \"Mi Perfil\"'),
(4680, 27199177, 1, '2023-10-02', '18:49:45', 'El usuario ha entrado a \"Mi Perfil\"'),
(4681, 27199177, 3, '2023-10-02', '18:56:52', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4682, 27199177, 1, '2023-10-02', '18:56:52', 'El usuario ha entrado a \"Mi Perfil\"'),
(4683, 27199177, 3, '2023-10-02', '18:56:52', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4684, 27199177, 3, '2023-10-02', '18:56:53', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4685, 27199177, 3, '2023-10-02', '18:56:55', 'El usuario ha entrado al apartado de \"Listar Secciones\" de la ECAM'),
(4686, 27199177, 2, '2023-10-02', '21:05:26', 'Listar lideres sin casa sobre la roca'),
(4687, 27199177, 2, '2023-10-02', '21:05:27', 'Listar lideres sin casa sobre la roca'),
(4688, 27199177, 1, '2023-10-02', '21:05:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(4689, 27199177, 3, '2023-10-02', '21:05:30', 'El usuario ha entrado a \"Aula Virtual Profesores\"'),
(4690, 27199177, 1, '2023-10-02', '21:05:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(4691, 27199177, 3, '2023-10-02', '21:05:31', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4692, 27199177, 1, '2023-10-02', '21:05:32', 'El usuario ha entrado a \"Mi Perfil\"'),
(4693, 27199177, 3, '2023-10-02', '21:06:27', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4694, 27199177, 1, '2023-10-02', '21:06:27', 'El usuario ha entrado a \"Mi Perfil\"'),
(4695, 27199177, 3, '2023-10-02', '21:06:27', 'El usuario ha revisado sus materias en el \"Aula Virtual Estudiantes\"'),
(4696, 27199177, 3, '2023-10-02', '21:07:25', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4697, 27199177, 1, '2023-10-02', '21:07:26', 'El usuario ha entrado a \"Mi Perfil\"'),
(4698, 27199177, 3, '2023-10-02', '21:07:30', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4699, 27199177, 1, '2023-10-02', '21:07:30', 'El usuario ha entrado a \"Mi Perfil\"'),
(4700, 27199177, 3, '2023-10-02', '21:07:30', 'El usuario ha revisado sus materias en el \"Aula Virtual Estudiantes\"'),
(4701, 27199177, 3, '2023-10-02', '21:07:34', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4702, 27199177, 1, '2023-10-02', '21:07:34', 'El usuario ha entrado a \"Mi Perfil\"');
INSERT INTO `bitacora_usuario` (`id`, `cedula_usuario`, `id_modulo`, `fecha_registro`, `hora_registro`, `accion_realizada`) VALUES
(4703, 27199177, 3, '2023-10-02', '21:07:36', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4704, 27199177, 1, '2023-10-02', '21:07:36', 'El usuario ha entrado a \"Mi Perfil\"'),
(4705, 27199177, 3, '2023-10-02', '21:07:37', 'El usuario ha revisado sus materias en el \"Aula Virtual Estudiantes\"'),
(4706, 27199177, 3, '2023-10-02', '21:07:42', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4707, 27199177, 1, '2023-10-02', '21:07:43', 'El usuario ha entrado a \"Mi Perfil\"'),
(4708, 27199177, 3, '2023-10-02', '21:42:43', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4709, 27199177, 3, '2023-10-02', '21:42:44', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4710, 27199177, 1, '2023-10-02', '21:42:44', 'El usuario ha entrado a \"Mi Perfil\"'),
(4711, 27199177, 3, '2023-10-02', '21:43:04', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4712, 27199177, 1, '2023-10-02', '21:43:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(4713, 27199177, 3, '2023-10-02', '21:43:47', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4714, 27199177, 1, '2023-10-02', '21:43:47', 'El usuario ha entrado a \"Mi Perfil\"'),
(4715, 27199177, 3, '2023-10-02', '21:44:16', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4716, 27199177, 3, '2023-10-02', '21:44:16', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4717, 27199177, 3, '2023-10-02', '21:44:16', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4718, 27199177, 1, '2023-10-02', '21:44:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(4719, 27199177, 1, '2023-10-02', '21:44:17', 'El usuario ha entrado a \"Mi Perfil\"'),
(4720, 27199177, 3, '2023-10-02', '21:46:14', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4721, 27199177, 1, '2023-10-02', '21:46:15', 'El usuario ha entrado a \"Mi Perfil\"'),
(4722, 27199177, 3, '2023-10-02', '21:48:04', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4723, 27199177, 1, '2023-10-02', '21:48:04', 'El usuario ha entrado a \"Mi Perfil\"'),
(4724, 27199177, 3, '2023-10-02', '21:48:04', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4725, 27199177, 3, '2023-10-02', '21:48:22', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4726, 27199177, 1, '2023-10-02', '21:48:23', 'El usuario ha entrado a \"Mi Perfil\"'),
(4727, 27199177, 3, '2023-10-02', '21:48:23', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4728, 27199177, 3, '2023-10-02', '22:01:53', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4729, 27199177, 3, '2023-10-02', '22:01:53', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4730, 27199177, 1, '2023-10-02', '22:01:54', 'El usuario ha entrado a \"Mi Perfil\"'),
(4731, 27199177, 3, '2023-10-02', '22:01:54', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4732, 27199177, 3, '2023-10-02', '22:01:58', 'El usuario ha revisado las materias y profesores en el Aula Virtual Estudiantes'),
(4733, 27199177, 1, '2023-10-02', '22:01:59', 'El usuario ha entrado a \"Mi Perfil\"'),
(4734, 27199177, 3, '2023-10-02', '22:02:00', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4735, 27199177, 1, '2023-10-02', '22:02:01', 'El usuario ha entrado a \"Mi Perfil\"'),
(4736, 27199177, 3, '2023-10-02', '22:02:01', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4737, 27199177, 3, '2023-10-02', '22:06:03', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4738, 27199177, 1, '2023-10-02', '22:06:03', 'El usuario ha entrado a \"Mi Perfil\"'),
(4739, 27199177, 3, '2023-10-02', '22:06:03', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4740, 27199177, 3, '2023-10-02', '22:06:30', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4741, 27199177, 3, '2023-10-02', '22:06:31', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4742, 27199177, 1, '2023-10-02', '22:06:31', 'El usuario ha entrado a \"Mi Perfil\"'),
(4743, 27199177, 3, '2023-10-02', '22:06:32', 'El usuario ha entrado a revisar sus estudiantes en el  \"Aula Virtual Profesores\"'),
(4744, 27199177, 1, '2023-10-02', '22:19:34', 'El usuario ha entrado a \"Mi Perfil\"'),
(4745, 27199177, 1, '2023-10-02', '22:19:49', 'El usuario ha entrado a \"Mi Perfil\"'),
(4746, 27199177, 1, '2023-10-02', '22:22:24', 'El usuario ha entrado a \"Mi Perfil\"');

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `casas_la_roca`
--

CREATE TABLE `casas_la_roca` (
  `id` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `cedula_lider` int(11) NOT NULL,
  `nombre_anfitrion` varchar(20) NOT NULL,
  `telefono_anfitrion` varchar(20) DEFAULT NULL,
  `cantidad_personas_hogar` int(11) NOT NULL,
  `dia_visita` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_pautada` time NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `casas_la_roca`
--

INSERT INTO `casas_la_roca` (`id`, `codigo`, `cedula_lider`, `nombre_anfitrion`, `telefono_anfitrion`, `cantidad_personas_hogar`, `dia_visita`, `fecha`, `hora_pautada`, `direccion`, `status`) VALUES
(1, 'CSR1', 27666555, 'Luis vazquez', '04121234841', 4, 'Domingo', '2023-09-19', '10:00:00', 'Los crepusculos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `celula_consolidacion`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `celula_consolidacion`
--

INSERT INTO `celula_consolidacion` (`id`, `codigo_celula_consolidacion`, `cedula_lider`, `cedula_anfitrion`, `cedula_asistente`, `dia_reunion`, `fecha`, `hora`, `direccion`) VALUES
(1, 'CC1', 27666555, 1938492, 17940293, 'Sabado', '2022-10-13', '13:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `celula_discipulado`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `celula_discipulado`
--

INSERT INTO `celula_discipulado` (`id`, `codigo_celula_discipulado`, `cedula_lider`, `cedula_anfitrion`, `cedula_asistente`, `dia_reunion`, `fecha`, `hora`, `direccion`) VALUES
(2, 'CD1', 27666555, 27199177, 1938492, 'Jueves', '2022-09-20', '10:00:00', 'Los crepusculos');

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `msg` varchar(10000) NOT NULL,
  `hora_msg` varchar(10) NOT NULL,
  `fecha_agregada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`id`, `user`, `msg`, `hora_msg`, `fecha_agregada`) VALUES
(40, 27199177, 'Holaaaa', '12:9PM', '2023-07-21'),
(41, 27199177, 'jejejejje', '12:9PM', '2023-07-21');

-- --------------------------------------------------------

--
-- Table structure for table `discipulos`
--

CREATE TABLE `discipulos` (
  `id` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_discipulado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `inicio` date NOT NULL,
  `final` date DEFAULT NULL,
  `oculto` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id_evento`, `titulo`, `descripcion`, `inicio`, `final`, `oculto`) VALUES
(1, 'Prueba', NULL, '2022-10-15', NULL, 0),
(2, 'Prueba 2', NULL, '2022-10-02', '2022-10-04', 0),
(3, 'Titulo demasiado largo para el evento', NULL, '2022-10-13', NULL, 0),
(4, 'Clases de Merequetengue', NULL, '2022-10-05', '0000-00-00', 0),
(7, 'Evento oculto', NULL, '2022-10-08', '0000-00-00', 1),
(8, 'Otro evento oculto', 'descripción de evento oculto', '2022-10-27', '0000-00-00', 1),
(9, 'Ensayos de Evangelización Suprema', 'Se harán simulaciones sobre la llegada de cristo rey y la evangelización a todo no creyente a la fuerza', '2022-10-08', '0000-00-00', 0),
(11, 'Juego de futbol', 'Prueba en la BD de esta actividad', '2022-11-10', '0000-00-00', 0),
(12, 'Prueba', 'Prueba de la agenda', '2023-02-01', '0000-00-00', 1),
(13, 'jwnejkrnsjkfnwjk', 'fkmnskdfnjkwf', '2023-09-01', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `graduados_ecam`
--

CREATE TABLE `graduados_ecam` (
  `cedulaGraduado` int(11) NOT NULL COMMENT 'Cedula de los graduados',
  `fecha_graduado` date NOT NULL COMMENT 'Fecha de graduacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `intermediaria`
--

CREATE TABLE `intermediaria` (
  `id_rol` int(11) NOT NULL,
  `id_permisos` int(11) NOT NULL,
  `id_modulos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `intermediaria`
--

INSERT INTO `intermediaria` (`id_rol`, `id_permisos`, `id_modulos`) VALUES
(3, 1, 14),
(2, 1, 2),
(2, 2, 2),
(2, 3, 2),
(2, 4, 2),
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
(2, 1, 17),
(2, 2, 17),
(2, 3, 17),
(2, 4, 17),
(2, 1, 19),
(2, 2, 19),
(2, 3, 19),
(2, 1, 20),
(2, 2, 20),
(2, 3, 20),
(2, 1, 22),
(2, 2, 22),
(2, 3, 22),
(4, 1, 3),
(4, 1, 12),
(4, 1, 14),
(4, 1, 18),
(4, 2, 18),
(4, 3, 18),
(4, 4, 18),
(4, 1, 21),
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
(1, 2, 7),
(1, 3, 7),
(1, 4, 7),
(1, 1, 8),
(1, 2, 8),
(1, 3, 8),
(1, 4, 8),
(1, 1, 10),
(1, 2, 10),
(1, 3, 10),
(1, 4, 10),
(1, 1, 11),
(1, 2, 11),
(1, 3, 11),
(1, 4, 11),
(1, 1, 12),
(1, 2, 12),
(1, 3, 12),
(1, 4, 12),
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
(1, 4, 15),
(1, 1, 16),
(1, 2, 16),
(1, 3, 16),
(1, 4, 16),
(1, 1, 17),
(1, 2, 17),
(1, 3, 17),
(1, 4, 17),
(1, 1, 19),
(1, 2, 19),
(1, 3, 19),
(1, 4, 19),
(1, 1, 20),
(1, 2, 20),
(1, 3, 20),
(1, 4, 20),
(1, 1, 21),
(1, 2, 21),
(1, 3, 21),
(1, 4, 21),
(1, 1, 22),
(1, 2, 22),
(1, 3, 22),
(1, 4, 22),
(1, 1, 23),
(1, 2, 23),
(1, 3, 23),
(1, 4, 23),
(1, 1, 24),
(1, 2, 24),
(1, 3, 24),
(1, 4, 24);

-- --------------------------------------------------------

--
-- Table structure for table `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(10) NOT NULL COMMENT 'ID de la materia',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la materia',
  `nivelAcademico` varchar(15) NOT NULL COMMENT 'Nivel de doctrina que pertenece',
  `fecha_creacion` date NOT NULL COMMENT 'Fecha de creacion de la materia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materias`
--

INSERT INTO `materias` (`id_materia`, `nombre`, `nivelAcademico`, `fecha_creacion`) VALUES
(1, 'Prueba materia', '1', '2023-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modulos`
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
(15, 'agenda_oculta'),
(16, 'dashboard'),
(17, 'aula_virtual_profesores'),
(18, 'aula_virtual_estudiantes'),
(19, 'materias'),
(20, 'secciones'),
(21, 'boletin_notas'),
(22, 'control_notas'),
(23, 'profesores'),
(24, 'secciones_cerradas');

-- --------------------------------------------------------

--
-- Table structure for table `notafinal_estudiantes`
--

CREATE TABLE `notafinal_estudiantes` (
  `id_seccion` int(11) NOT NULL,
  `cedulaEstudiante` int(10) NOT NULL,
  `notaFinal` double NOT NULL,
  `nivelAcademico` tinyint(11) NOT NULL,
  `fecha_agregada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notamateria_estudiantes`
--

CREATE TABLE `notamateria_estudiantes` (
  `id_seccion` int(20) NOT NULL COMMENT 'Seccion del estudiante',
  `id_materia` int(10) NOT NULL COMMENT 'Materia ',
  `cedula` int(11) NOT NULL COMMENT 'Cedula del estudiante',
  `nota` tinyint(2) NOT NULL COMMENT 'Nota final de la materia',
  `fecha_agregado` date DEFAULT NULL COMMENT 'Fecha de cuando se agrego la nota'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notificaciones_estudiantes`
--

CREATE TABLE `notificaciones_estudiantes` (
  `id_seccion` int(11) DEFAULT NULL,
  `cedula_estudiante` int(11) DEFAULT NULL,
  `accion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora_registro` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notificaciones_profesores`
--

CREATE TABLE `notificaciones_profesores` (
  `cedula_profesor` int(11) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `hora_registro` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `participantes_consolidacion`
--

CREATE TABLE `participantes_consolidacion` (
  `id` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_consolidacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(1, 'listar'),
(2, 'crear'),
(3, 'actualizar'),
(4, 'eliminar'),
(6, 'reporte');

-- --------------------------------------------------------

--
-- Table structure for table `profesores-materias`
--

CREATE TABLE `profesores-materias` (
  `cedula_profesor` int(10) NOT NULL COMMENT 'Cedula del profesor',
  `id_materia` int(10) NOT NULL COMMENT 'ID de la materia del profesor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla para vincular las materias con los profesores';

--
-- Dumping data for table `profesores-materias`
--

INSERT INTO `profesores-materias` (`cedula_profesor`, `id_materia`) VALUES
(27666555, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reportes_casas`
--

CREATE TABLE `reportes_casas` (
  `id` int(11) NOT NULL,
  `id_casa` int(11) NOT NULL,
  `cantidad_h` int(11) NOT NULL,
  `cantidad_m` int(11) NOT NULL,
  `cantidad_n` int(11) NOT NULL,
  `confesiones` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reportes_casas`
--

INSERT INTO `reportes_casas` (`id`, `id_casa`, `cantidad_h`, `cantidad_m`, `cantidad_n`, `confesiones`, `fecha`) VALUES
(1, 1, 2, 2, 2, 4, '2022-09-19'),
(2, 1, 4, 2, 5, 1, '2022-01-01'),
(3, 1, 2, 2, 3, 2, '2022-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `reporte_celula_consolidacion`
--

CREATE TABLE `reporte_celula_consolidacion` (
  `id` int(11) NOT NULL,
  `id_consolidacion` int(11) NOT NULL,
  `cedula_participante` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reporte_celula_consolidacion`
--

INSERT INTO `reporte_celula_consolidacion` (`id`, `id_consolidacion`, `cedula_participante`, `fecha`) VALUES
(1, 1, 2345698, '2023-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `reporte_celula_discipulado`
--

CREATE TABLE `reporte_celula_discipulado` (
  `id` int(11) NOT NULL,
  `id_discipulado` int(11) NOT NULL,
  `cedula_participante` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reporte_celula_discipulado`
--

INSERT INTO `reporte_celula_discipulado` (`id`, `id_discipulado`, `cedula_participante`, `fecha`) VALUES
(1, 2, 1938492, '2023-02-28'),
(2, 2, 2344664, '2023-02-23'),
(3, 2, 1938492, '2023-02-25'),
(4, 2, 2344664, '2023-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `accion_realizada` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `ip`, `timestamp`, `accion_realizada`) VALUES
(4190, '10.0.0.4', '2023-09-04 23:07:34', NULL),
(4191, '10.0.0.4', '2023-09-04 23:07:40', NULL),
(4290, '10.0.0.2', '2023-09-11 23:32:54', NULL),
(4291, '10.0.0.2', '2023-09-11 23:34:41', NULL),
(4334, '192.168.240.233', '2023-09-30 12:12:09', NULL),
(4335, '192.168.240.233', '2023-09-30 12:21:42', NULL),
(4357, '192.168.43.36', '2023-09-30 13:24:44', NULL),
(4358, '192.168.43.36', '2023-09-30 13:27:45', NULL),
(4855, '::1', '2023-10-03 02:24:29', NULL),
(4856, '::1', '2023-10-03 02:24:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Super-Usuario', 'Gestión total del sistema'),
(2, 'Administrador', 'Permisos estándar'),
(3, 'Invitado', NULL),
(4, 'Estudiante', 'Estudiantes de la ECAM, fase de iniciacion en la CSR'),
(6, 'Analista', '');

-- --------------------------------------------------------

--
-- Table structure for table `secciones`
--

CREATE TABLE `secciones` (
  `id_seccion` int(20) NOT NULL COMMENT 'ID de la seccion',
  `nombre` varchar(200) NOT NULL,
  `nivel_academico` tinyint(3) NOT NULL COMMENT 'Nivel de doctrina de la seccion',
  `status_seccion` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Status para cerrar la seccion y no perder datos',
  `fecha_creacion` date DEFAULT NULL COMMENT 'fecha de creacion de la seccion',
  `fecha_cierre` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secciones`
--

INSERT INTO `secciones` (`id_seccion`, `nombre`, `nivel_academico`, `status_seccion`, `fecha_creacion`, `fecha_cierre`) VALUES
(22, 'sipeudeser', 1, 1, NULL, '2023-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `secciones-cerradas-estudiantes`
--

CREATE TABLE `secciones-cerradas-estudiantes` (
  `id_seccion` int(11) NOT NULL COMMENT 'ID de seccion cerrada',
  `cedula_estudiante` int(11) NOT NULL COMMENT 'Cedula de los estudiantes que estuvieron',
  `nota_final` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `secciones-materias-profesores`
--

CREATE TABLE `secciones-materias-profesores` (
  `id_seccion` int(20) NOT NULL COMMENT 'ID de la seccion',
  `id_materia` int(10) NOT NULL COMMENT 'ID de las materias que tiene',
  `cedulaProf` int(11) NOT NULL COMMENT 'Cedula del profesor ',
  `contenido` mediumtext DEFAULT NULL COMMENT 'contenido de la materia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `nacionalidad` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `password` text NOT NULL,
  `status_profesor` tinyint(1) NOT NULL DEFAULT 0,
  `id_seccion` int(11) DEFAULT NULL,
  `ruta_imagen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `id_rol`, `codigo`, `nombre`, `apellido`, `fecha_nacimiento`, `sexo`, `estado_civil`, `nacionalidad`, `estado`, `usuario`, `telefono`, `password`, `status_profesor`, `id_seccion`, `ruta_imagen`) VALUES
(1938492, 4, '1938492-N1-VE-LA-H-S-CC1', 'Julian', 'Montoya', '2002-05-18', 'hombre', 'soltero', 'venezolana', 'lara', 'example14@gmail.com', '04128483939', '$2y$10$UUgCsGzKrWuDNl8tVh6PauMbG7doa/Iu4B7jQmAiW4FqU4YlL1NNS', 0, NULL, ''),
(2344664, 2, '2344664-N2-VE-LA-H-S', 'Mario', 'vergolini', '2002-08-11', 'hombre', 'soltero', 'venezolana', 'lara', 'ejemplo3@gmail.com', '04124356323', '$2y$10$e0el0JChw98unbRo4CaCt.ieMHHY.lWsKCldNjRasgE/gPBKm/JRS', 1, NULL, ''),
(2345698, 4, '2345698-N1-VE-LA-H-S', 'Elmo', 'Yeja', '2002-11-26', 'hombre', 'soltero', 'venezolana', 'lara', 'elmo@gmail.com', '04147813456', '$2y$10$I25elHPoKYpEr9oy3etrbehgk/W4/fUay9HG/qz1GanfTPZ9cPtwW', 0, NULL, ''),
(16634134, 3, '16634134-N2-VE-LA-M-M-CSR2-CSR2', 'Adrianita', 'Rey', '2002-12-07', 'mujer', 'matrimonio', 'venezolana', 'lara', 'example3@gmail.com', '04169439282', '$2y$10$zH.1RfUaj8819b1BciGSKOZ2EN3rEBb2Ssm09MmNHdSbrB7xrVz1e', 0, NULL, ''),
(17462321, 6, '17462321-N1-VE-YA-H-S', 'Alejandro', 'Abondano', '2003-01-18', 'hombre', 'soltero', 'venezolana', 'yaracuy', 'example4@gmail.com', '04249842019', '$2y$10$Nn9TGobsq9/xW8Wk/tUlJuY4A6R0tZIuwkpWn8T3enQED69JZNYUu', 0, NULL, ''),
(17940293, 2, '17940293-N1-VE-CS-H-S-CC1', 'Sebastian', 'Romero', '2003-02-06', 'hombre', 'soltero', 'venezolana', 'css', 'example12@gmail.com', '04124848393', '$2y$10$nA3E3/ykFzqu6GwC0Ub7WOrcrbJBBOEgVqoVPefH65QbeeXU3U7HK', 0, NULL, ''),
(19482134, 2, '19482134-N2-VE-YA-M-S', 'Adriana', 'Hernadez', '2003-03-22', 'mujer', 'soltera', 'venezolana', 'yaracuy', 'example2@gmail.com', '04124849329', '$2y$10$H51s0jFmLFcL2BZ0kN4fkumgP1fwVivYuUrmJyk6OVdnARaHUfAEa', 0, NULL, ''),
(19839293, 2, '19839293-N1-VE-LA-M-S', 'Ivonne', 'Barrera', '2003-04-26', 'mujer', 'soltera', 'venezolana', 'lara', 'example8@gmail.com', '04168483929', '$2y$10$0XCs0BYg8Qwhf9Q0hH18qOaJ3hR7XQ0DaIZ0ra4K.oqOV.zNjIqi.', 0, NULL, ''),
(23098543, 2, '23098543-N1-VE-LA-H-M', 'Elva', 'Ritzto', '2003-05-11', 'hombre', 'matrimonio', 'venezolana', 'lara', 'elva@gmail.com', '04123864589', '$2y$10$zS8ff//FbjzhzC6rpnJIL.TKz1xy94pSl5nAT8ap2n07Sxr2K4X6e', 0, NULL, NULL),
(24453432, 2, '24453432-N1-VE-CS-M-S', 'Laura', 'Puerto', '2003-06-27', 'mujer', 'soltera', 'venezolana', 'css', 'example17@gmail.com', '04127473824', '$2y$10$/Z54Ap0lkXl6ptsCeFSxfulJWzezTaR/wPkjGrDJybbtw1FvR7EkC', 0, NULL, ''),
(24566423, 2, '24566423-N1-VE-LA-H-M', 'Luis', 'Marchan', '2001-10-12', 'hombre', 'matrimonio', 'venezolana', 'lara', 'example16@gmail.com', '04128473823', '$2y$10$XkDLO0ua5y7ULpwKXQ7e7.rObAE9Y4uLkvl8KxSQyznz2AoB04JP2', 0, NULL, ''),
(24939239, 2, '24939239-N1-VE-LA-H-M', 'Leonardo', 'Garcia', '2002-05-18', 'hombre', 'matrimonio', 'venezolana', 'lara', 'example13@gmail.com', '04128483948', '$2y$10$2bKJOTW7nUl7uezHdHW1V.RiFfgvTut7i6xRDs60oC0LoAEbVA5nG', 0, NULL, ''),
(25463123, 2, '25463123-N1-VE-CS-H-M', 'Luis', 'Marl', '2004-08-10', 'hombre', 'matrimonio', 'venezolana', 'css', 'example@gmail.com', '04123454431', '$2y$10$KKVmeUun.ZSXK3nyJ/r0oO2FQSH5YngjIjBthaejt/JRMrF1b6Wyu', 0, NULL, ''),
(25838291, 2, '25838291-N1-VE-CS-M-M', 'Andrea', 'Acero', '2005-08-18', 'mujer', 'matrimonio', 'venezolana', 'css', 'example6@gmail.com', '04123948502', '$2y$10$JaCOBVrU9cbJO4RW9tZUL.L3vZN6B/HaCfFtyJPCCRjieFS4FQjn6', 0, NULL, ''),
(26423422, 2, '26423422-N1-VE-LA-H-M', 'Angel', 'Raftal', '2004-05-10', 'hombre', 'matrimonio', 'venezolana', 'lara', 'example15@gmail.com', '04124858393', '$2y$10$.QWbpdV8J.BVVwrXtxQ38uAvlMAjAXZUUm2PLzjt/HWyG5WoVw7ku', 0, NULL, ''),
(26584892, 2, '26584892-N1-VE-LA-H-S', 'Ivan', 'Coral', '2005-11-07', 'hombre', 'soltero', 'venezolana', 'lara', 'example7@gmail.com', '04149382929', '$2y$10$pkHsYyoXBVChhWd/xmijS.HStNFxqEQ.Id.5UDs3a9aqZjNq6lKoy', 0, NULL, ''),
(27199177, 1, '27199177-N2-VE-LA-H-', 'Marcos', 'Aguilar', '1999-12-24', 'hombre', 'soltero', 'venezolana', 'lara', 'examplejeje@gmail.com', '04143543210', '$2y$10$CsfqPMQuWM7Z/MFnqhuyVO6SXThULg.f/VXK8fNPnBmnZj6v7D5HK', 1, NULL, 'resources/imagenes-usuarios/IMG_20230609_190944~2.jpg'),
(27666555, 1, '27666555-N2-VE-LA-H-S-CD1-CC1', 'Jesus', 'Aguirre', '1999-09-09', 'hombre', 'soltero', 'venezolana', 'lara', 'quijess6@gmail.com', '04244444444', '$2y$10$JiFhT/xRJTwwxlyfbK2qtumDfEjWlbx2Z7ih5.1Tqm4bFMuRDm0.6', 1, NULL, 'resources/imagenes-usuarios/IMG_20220408_125402.jpg'),
(27985245, 2, '27985245-N1-VE-ME-H-S', 'Payaso', 'Perezz', '2005-09-09', 'hombre', 'soltero', 'venezolana', 'merida', 'praticando@kewip.com', '04123987546', '$2y$10$IpX8ND8jT.tUOpeHJrGjWuVMn6JrNmnBrwcCkqgDlmXLCA44LpqFW', 0, NULL, NULL),
(28732728, 2, '28732728-N1-VE-CS-H-S', 'Jorge', 'Orozco', '1978-11-11', 'hombre', 'soltero', 'venezolana', 'css', 'example10@gmail.com', '04169402021', '$2y$10$J6kDasP4XqUnjtcFn61vjORJy.rjFLckOBhKffvordwt9c6ydRdAu', 0, NULL, ''),
(29432394, 2, '29432394-N1-VE-CS-M-S', 'Jenny', 'Sanchez', '1987-10-01', 'mujer', 'soltera', 'venezolana', 'css', 'example9@gmail.com', '04129403913', '$2y$10$pnuNl5FXvamdHBmodURa9eRwzV9uUyur16A3GAeknKk7scNNG.Jbi', 0, NULL, ''),
(30948394, 2, '30948394-N1-VE-CS-H-S', 'Alexander', 'Carvajal', '1993-05-06', 'hombre', 'soltero', 'venezolana', 'css', 'example5@gmail.com', '04268493029', '$2y$10$EIfxHpIw91qjiM4.Y9hQeeL6wOcRjU8HEtkfAnphVNSaBElo9OREW', 0, NULL, ''),
(32328382, 2, '32328382-N1-VE-CS-H-S', 'Juan', 'Ortega', '1996-03-21', 'hombre', 'soltero', 'venezolana', 'css', 'example11@gmail.com', '04128384943', '$2y$10$lqpfJt0Jg.R6VnDUsbfBOOOzpN4sAM/.PUuTo0gZO8oLYqmD3RwKG', 0, NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bitacora_usuario`
--
ALTER TABLE `bitacora_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula_usuario` (`cedula_usuario`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `casas_la_roca`
--
ALTER TABLE `casas_la_roca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula_lider` (`cedula_lider`);

--
-- Indexes for table `celula_consolidacion`
--
ALTER TABLE `celula_consolidacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula_lider` (`cedula_lider`),
  ADD KEY `cedula_anfitrion` (`cedula_anfitrion`),
  ADD KEY `cedula_asistente` (`cedula_asistente`);

--
-- Indexes for table `celula_discipulado`
--
ALTER TABLE `celula_discipulado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula_lider` (`cedula_lider`),
  ADD KEY `cedula_anfitrion` (`cedula_anfitrion`),
  ADD KEY `cedula_asistente` (`cedula_asistente`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discipulos`
--
ALTER TABLE `discipulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_discipulado` (`id_discipulado`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indexes for table `graduados_ecam`
--
ALTER TABLE `graduados_ecam`
  ADD KEY `cedulaGraduado` (`cedulaGraduado`);

--
-- Indexes for table `intermediaria`
--
ALTER TABLE `intermediaria`
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_permisos` (`id_permisos`),
  ADD KEY `id_modulos` (`id_modulos`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notafinal_estudiantes`
--
ALTER TABLE `notafinal_estudiantes`
  ADD KEY `idSeccionFinal` (`id_seccion`),
  ADD KEY `cedulaEstudianteFinal` (`cedulaEstudiante`);

--
-- Indexes for table `notamateria_estudiantes`
--
ALTER TABLE `notamateria_estudiantes`
  ADD KEY `cedulaEstudiante` (`cedula`),
  ADD KEY `seccionEstudiante` (`id_seccion`),
  ADD KEY `materiaEstudiante` (`id_materia`);

--
-- Indexes for table `notificaciones_estudiantes`
--
ALTER TABLE `notificaciones_estudiantes`
  ADD KEY `seccionNotificacion` (`id_seccion`),
  ADD KEY `cedulaEst_notificacion` (`cedula_estudiante`);

--
-- Indexes for table `notificaciones_profesores`
--
ALTER TABLE `notificaciones_profesores`
  ADD KEY `cedulaProf_notificacion` (`cedula_profesor`);

--
-- Indexes for table `participantes_consolidacion`
--
ALTER TABLE `participantes_consolidacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_consolidacion` (`id_consolidacion`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profesores-materias`
--
ALTER TABLE `profesores-materias`
  ADD KEY `cedulaProfesor` (`cedula_profesor`),
  ADD KEY `materiaProfesor` (`id_materia`);

--
-- Indexes for table `reportes_casas`
--
ALTER TABLE `reportes_casas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_casa` (`id_casa`);

--
-- Indexes for table `reporte_celula_consolidacion`
--
ALTER TABLE `reporte_celula_consolidacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_consolidacion` (`id_consolidacion`),
  ADD KEY `cedula_participante` (`cedula_participante`);

--
-- Indexes for table `reporte_celula_discipulado`
--
ALTER TABLE `reporte_celula_discipulado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_discipulado` (`id_discipulado`),
  ADD KEY `cedula_participante` (`cedula_participante`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indexes for table `secciones-cerradas-estudiantes`
--
ALTER TABLE `secciones-cerradas-estudiantes`
  ADD KEY `idSeccion_cerrada` (`id_seccion`),
  ADD KEY `cedulaEst_pasado` (`cedula_estudiante`);

--
-- Indexes for table `secciones-materias-profesores`
--
ALTER TABLE `secciones-materias-profesores`
  ADD KEY `cedulaProf` (`cedulaProf`),
  ADD KEY `seccion` (`id_seccion`),
  ADD KEY `materia` (`id_materia`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `usuarios_idSeccion` (`id_seccion`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bitacora_usuario`
--
ALTER TABLE `bitacora_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4747;

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `casas_la_roca`
--
ALTER TABLE `casas_la_roca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `celula_consolidacion`
--
ALTER TABLE `celula_consolidacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `celula_discipulado`
--
ALTER TABLE `celula_discipulado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `discipulos`
--
ALTER TABLE `discipulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID de la materia', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `participantes_consolidacion`
--
ALTER TABLE `participantes_consolidacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reportes_casas`
--
ALTER TABLE `reportes_casas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reporte_celula_consolidacion`
--
ALTER TABLE `reporte_celula_consolidacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reporte_celula_discipulado`
--
ALTER TABLE `reporte_celula_discipulado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4857;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_seccion` int(20) NOT NULL AUTO_INCREMENT COMMENT 'ID de la seccion', AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bitacora_usuario`
--
ALTER TABLE `bitacora_usuario`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bitacora_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `casas_la_roca`
--
ALTER TABLE `casas_la_roca`
  ADD CONSTRAINT `casas_ibfk_1` FOREIGN KEY (`cedula_lider`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Constraints for table `celula_consolidacion`
--
ALTER TABLE `celula_consolidacion`
  ADD CONSTRAINT `celulac_ibfk_1` FOREIGN KEY (`cedula_lider`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `celulac_ibfk_2` FOREIGN KEY (`cedula_anfitrion`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `celulac_ibfk_3` FOREIGN KEY (`cedula_asistente`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Constraints for table `celula_discipulado`
--
ALTER TABLE `celula_discipulado`
  ADD CONSTRAINT `celulad_ibfk_1` FOREIGN KEY (`cedula_lider`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `celulad_ibfk_2` FOREIGN KEY (`cedula_anfitrion`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `celulad_ibfk_3` FOREIGN KEY (`cedula_asistente`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Constraints for table `discipulos`
--
ALTER TABLE `discipulos`
  ADD CONSTRAINT `discipulos_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `discipulos_ibfk_2` FOREIGN KEY (`id_discipulado`) REFERENCES `celula_discipulado` (`id`);

--
-- Constraints for table `graduados_ecam`
--
ALTER TABLE `graduados_ecam`
  ADD CONSTRAINT `graduados_ecam_ibfk_1` FOREIGN KEY (`cedulaGraduado`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `intermediaria`
--
ALTER TABLE `intermediaria`
  ADD CONSTRAINT `intermediaria_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `intermediaria_ibfk_2` FOREIGN KEY (`id_permisos`) REFERENCES `permisos` (`id`),
  ADD CONSTRAINT `intermediaria_ibfk_3` FOREIGN KEY (`id_modulos`) REFERENCES `modulos` (`id`);

--
-- Constraints for table `notafinal_estudiantes`
--
ALTER TABLE `notafinal_estudiantes`
  ADD CONSTRAINT `cedulaEstudianteFinal` FOREIGN KEY (`cedulaEstudiante`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSeccionFinal` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notamateria_estudiantes`
--
ALTER TABLE `notamateria_estudiantes`
  ADD CONSTRAINT `cedulaEstudiante` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materiaEstudiante` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seccionEstudiante` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notificaciones_estudiantes`
--
ALTER TABLE `notificaciones_estudiantes`
  ADD CONSTRAINT `cedulaEst_notificacion` FOREIGN KEY (`cedula_estudiante`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seccionNotificacion` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notificaciones_profesores`
--
ALTER TABLE `notificaciones_profesores`
  ADD CONSTRAINT `cedulaProf_notificacion` FOREIGN KEY (`cedula_profesor`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participantes_consolidacion`
--
ALTER TABLE `participantes_consolidacion`
  ADD CONSTRAINT `participantes_consolidacion_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `participantes_consolidacion_ibfk_2` FOREIGN KEY (`id_consolidacion`) REFERENCES `celula_consolidacion` (`id`);

--
-- Constraints for table `profesores-materias`
--
ALTER TABLE `profesores-materias`
  ADD CONSTRAINT `cedulaProfesor` FOREIGN KEY (`cedula_profesor`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materiaProfesor` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reportes_casas`
--
ALTER TABLE `reportes_casas`
  ADD CONSTRAINT `reportesc_ibfk_1` FOREIGN KEY (`id_casa`) REFERENCES `casas_la_roca` (`id`);

--
-- Constraints for table `reporte_celula_consolidacion`
--
ALTER TABLE `reporte_celula_consolidacion`
  ADD CONSTRAINT `rcelulaf_ibfk_1` FOREIGN KEY (`id_consolidacion`) REFERENCES `celula_consolidacion` (`id`),
  ADD CONSTRAINT `rceulaf_ibfk_2` FOREIGN KEY (`cedula_participante`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Constraints for table `reporte_celula_discipulado`
--
ALTER TABLE `reporte_celula_discipulado`
  ADD CONSTRAINT `rcelulad_ibfk_1` FOREIGN KEY (`id_discipulado`) REFERENCES `celula_discipulado` (`id`),
  ADD CONSTRAINT `rceulad_ibfk_2` FOREIGN KEY (`cedula_participante`) REFERENCES `usuarios` (`cedula`) ON UPDATE CASCADE;

--
-- Constraints for table `secciones-cerradas-estudiantes`
--
ALTER TABLE `secciones-cerradas-estudiantes`
  ADD CONSTRAINT `cedulaEst_pasado` FOREIGN KEY (`cedula_estudiante`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSeccion_cerrada` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `secciones-materias-profesores`
--
ALTER TABLE `secciones-materias-profesores`
  ADD CONSTRAINT `cedulaProf` FOREIGN KEY (`cedulaProf`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materia` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seccion` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_idSeccion` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_idrool` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
