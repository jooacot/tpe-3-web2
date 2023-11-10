<?php
//
require_once './database/config.php';
class Model
{
  protected $db;

  function __contruct()
  {
    $this->dbVerify();
    $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
    $this->deploy();
  }
  function dbVerify()
  {
    $nombreDB = MYSQL_DB;
    $pdo = new PDO('mysql:host=' . MYSQL_HOST . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
    $query = "CREATE DATABASE IF NOT EXISTS $nombreDB";
    $pdo->exec($query);
  }
  private function deploy()
  {
    // Chequear si hay tablas
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
    if (count($tables) == 0) {
      $clave = '$2y$10$BBNqyeLxtLEn0ECdvHZp9O9cQZsM6bZSoy59CNLGXyUM.HXIPLlT6';
      $sql = <<<END
               --
         -- Estructura de tabla para la tabla `clientes`
         --
         
         CREATE TABLE `clientes` (
           `id` int(11) NOT NULL,
           `nombre` varchar(250) NOT NULL,
           `apellido` varchar(250) NOT NULL,
           `edad` int(11) NOT NULL
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
         
         --
         -- Volcado de datos para la tabla `clientes`
         --
         
         INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `edad`) VALUES
         (1, 'koko', 'Alta', 25);
         
         -- --------------------------------------------------------
         
         --
         -- Estructura de tabla para la tabla `usuarios`
         --
         
         CREATE TABLE `usuarios` (
           `id_usuario` int(11) NOT NULL,
           `username` varchar(250) NOT NULL,
           `password` varchar(250) NOT NULL
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
         
         --
         -- Volcado de datos para la tabla `usuarios`
         --
         
         INSERT INTO `usuarios` (`id_usuario`, `username`, `password`) VALUES
         (1, 'webadmin', '$clave');
         
         -- --------------------------------------------------------
         
         --
         -- Estructura de tabla para la tabla `viajes`
         --
         
         CREATE TABLE `viajes` (
           `id_viajes` int(11) NOT NULL,
           `destino` varchar(250) NOT NULL,
           `precio` int(11) NOT NULL,
           `fecha_ida` varchar(250) NOT NULL,
           `fecha_vuelta` varchar(250) NOT NULL,
           `id_usuario` int(11) NOT NULL
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
         
         --
         -- Índices para tablas volcadas
         --
         
         --
         -- Indices de la tabla `clientes`
         --
         ALTER TABLE `clientes`
           ADD PRIMARY KEY (`id`);
         
         --
         -- Indices de la tabla `usuarios`
         --
         ALTER TABLE `usuarios`
           ADD PRIMARY KEY (`id_usuario`);
         
         --
         -- Indices de la tabla `viajes`
         --
         ALTER TABLE `viajes`
           ADD PRIMARY KEY (`id_viajes`),
           ADD KEY `viajes_ibfk_1` (`id_usuario`);
         
         --
         -- AUTO_INCREMENT de las tablas volcadas
         --
         
         --
         -- AUTO_INCREMENT de la tabla `clientes`
         --
         ALTER TABLE `clientes`
           MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
         
         --
         -- AUTO_INCREMENT de la tabla `usuarios`
         --
         ALTER TABLE `usuarios`
           MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
         
         --
         -- AUTO_INCREMENT de la tabla `viajes`
         --
         ALTER TABLE `viajes`
           MODIFY `id_viajes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
         
         --
         -- Restricciones para tablas volcadas
         --
         
         --
         -- Filtros para la tabla `viajes`
         --
         ALTER TABLE `viajes`
           ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `clientes` (`id`);
         COMMIT;
         END;
      $this->db->query($sql);
    }
  }

}