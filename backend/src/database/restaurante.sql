-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2022 a las 02:48:29
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `access`
--

CREATE TABLE `access` (
  `AccID` int(11) NOT NULL,
  `AccRoleID` int(11) NOT NULL,
  `AccResID` int(11) NOT NULL,
  `AccPer` int(11) NOT NULL,
  `AccEstReg` int(11) NOT NULL DEFAULT 0,
  `AccFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `ProID` int(11) NOT NULL,
  `ProName` varchar(70) NOT NULL,
  `ProDes` varchar(255) NOT NULL,
  `ProTypeProID` int(11) NOT NULL,
  `ProImg` varchar(100) NOT NULL,
  `ProPre` decimal(7,0) NOT NULL,
  `ProProm` int(11) NOT NULL,
  `ProEstReg` int(11) NOT NULL DEFAULT 1,
  `ProFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `product_table`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `product_table` (
`ProID` int(11)
,`ProName` varchar(70)
,`ProDes` varchar(255)
,`ProTypeProID` int(11)
,`ProImg` varchar(100)
,`ProPre` decimal(7,0)
,`ProProm` int(11)
,`ProEstReg` int(11)
,`ProFecAct` timestamp
,`TypeProName` varchar(70)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource`
--

CREATE TABLE `resource` (
  `ResID` int(11) NOT NULL,
  `ResName` varchar(100) NOT NULL,
  `ResEstReg` int(11) NOT NULL DEFAULT 1,
  `ResFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `resource`
--

INSERT INTO `resource` (`ResID`, `ResName`, `ResEstReg`, `ResFecAct`) VALUES
(1, 'Usuarios', 1, '2022-04-14 17:33:34'),
(2, 'Roles', 1, '2022-04-14 17:33:34'),
(3, 'Productos', 1, '2022-04-14 17:34:24'),
(4, 'Tipo Productos', 1, '2022-04-14 17:34:36'),
(5, 'Access', 1, '2022-04-14 17:35:07'),
(6, 'Mesas', 1, '2022-04-14 17:35:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(70) NOT NULL,
  `RoleEstReg` int(11) NOT NULL,
  `RoleFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabl`
--

CREATE TABLE `tabl` (
  `TabID` int(11) NOT NULL,
  `TabFec` time NOT NULL,
  `TabEst` int(11) NOT NULL,
  `TabEstReg` int(11) NOT NULL,
  `TabFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticketdetail`
--

CREATE TABLE `ticketdetail` (
  `TicDetID` int(11) NOT NULL,
  `TicDetTicHeadID` int(11) NOT NULL,
  `TicDetProID` int(11) NOT NULL,
  `TicDetDes` varchar(255) NOT NULL,
  `TicDetCant` int(11) NOT NULL,
  `TicDetEstReg` int(11) NOT NULL,
  `TicDetFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticketheader`
--

CREATE TABLE `ticketheader` (
  `TicHeadID` int(11) NOT NULL,
  `TicHeadUserID` int(11) NOT NULL,
  `TicHeadFec` time NOT NULL,
  `TicHeadRUC` varchar(70) NOT NULL,
  `TicHeadLocName` varchar(100) NOT NULL,
  `TicHeadPorDesc` decimal(3,0) NOT NULL,
  `TicHeadEstReg` int(11) NOT NULL,
  `TicHeadFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TicHeadTabID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typeproduct`
--

CREATE TABLE `typeproduct` (
  `TypeProID` int(11) NOT NULL,
  `TypeProName` varchar(70) NOT NULL,
  `TypeProDes` varchar(255) NOT NULL,
  `TypeProImg` varchar(100) NOT NULL,
  `TypeProEstReg` int(11) NOT NULL DEFAULT 1,
  `TypeProFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserRoleID` int(11) NOT NULL,
  `UserName` varchar(70) NOT NULL,
  `UserNickName` varchar(70) NOT NULL,
  `UserPass` varchar(70) NOT NULL,
  `UserEstReg` int(11) NOT NULL,
  `UserFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `user_table`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `user_table` (
`UserID` int(11)
,`UserRoleID` int(11)
,`UserName` varchar(70)
,`UserNickName` varchar(70)
,`UserPass` varchar(70)
,`UserEstReg` int(11)
,`UserFecAct` timestamp
,`RoleName` varchar(70)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `product_table`
--
DROP TABLE IF EXISTS `product_table`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_table`  AS SELECT `p`.`ProID` AS `ProID`, `p`.`ProName` AS `ProName`, `p`.`ProDes` AS `ProDes`, `p`.`ProTypeProID` AS `ProTypeProID`, `p`.`ProImg` AS `ProImg`, `p`.`ProPre` AS `ProPre`, `p`.`ProProm` AS `ProProm`, `p`.`ProEstReg` AS `ProEstReg`, `p`.`ProFecAct` AS `ProFecAct`, `tp`.`TypeProName` AS `TypeProName` FROM (`product` `p` join `typeproduct` `tp` on(`p`.`ProTypeProID` = `tp`.`TypeProID`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `user_table`
--
DROP TABLE IF EXISTS `user_table`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_table`  AS SELECT `u`.`UserID` AS `UserID`, `u`.`UserRoleID` AS `UserRoleID`, `u`.`UserName` AS `UserName`, `u`.`UserNickName` AS `UserNickName`, `u`.`UserPass` AS `UserPass`, `u`.`UserEstReg` AS `UserEstReg`, `u`.`UserFecAct` AS `UserFecAct`, `r`.`RoleName` AS `RoleName` FROM (`user` `u` join `role` `r` on(`u`.`UserRoleID` = `r`.`RoleID`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`AccID`),
  ADD KEY `FK_Role_Access` (`AccRoleID`),
  ADD KEY `FK_Res_Access` (`AccResID`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProID`),
  ADD KEY `FK_TypePro_Pro` (`ProTypeProID`);

--
-- Indices de la tabla `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`ResID`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indices de la tabla `tabl`
--
ALTER TABLE `tabl`
  ADD PRIMARY KEY (`TabID`);

--
-- Indices de la tabla `ticketdetail`
--
ALTER TABLE `ticketdetail`
  ADD PRIMARY KEY (`TicDetID`),
  ADD KEY `FK_TicketHeader_TicketDetail` (`TicDetTicHeadID`),
  ADD KEY `FK_Product_TicketDetail` (`TicDetProID`);

--
-- Indices de la tabla `ticketheader`
--
ALTER TABLE `ticketheader`
  ADD PRIMARY KEY (`TicHeadID`),
  ADD KEY `FK_User_TicketHeader` (`TicHeadUserID`),
  ADD KEY `FK_Tabl_TicketHeader` (`TicHeadTabID`);

--
-- Indices de la tabla `typeproduct`
--
ALTER TABLE `typeproduct`
  ADD PRIMARY KEY (`TypeProID`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `FK_Role_User` (`UserRoleID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `access`
--
ALTER TABLE `access`
  MODIFY `AccID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `ProID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resource`
--
ALTER TABLE `resource`
  MODIFY `ResID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tabl`
--
ALTER TABLE `tabl`
  MODIFY `TabID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticketdetail`
--
ALTER TABLE `ticketdetail`
  MODIFY `TicDetID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticketheader`
--
ALTER TABLE `ticketheader`
  MODIFY `TicHeadID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `typeproduct`
--
ALTER TABLE `typeproduct`
  MODIFY `TypeProID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `FK_Res_Access` FOREIGN KEY (`AccResID`) REFERENCES `resource` (`ResID`),
  ADD CONSTRAINT `FK_Role_Access` FOREIGN KEY (`AccRoleID`) REFERENCES `role` (`RoleID`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_TypePro_Pro` FOREIGN KEY (`ProTypeProID`) REFERENCES `typeproduct` (`TypeProID`);

--
-- Filtros para la tabla `ticketdetail`
--
ALTER TABLE `ticketdetail`
  ADD CONSTRAINT `FK_Product_TicketDetail` FOREIGN KEY (`TicDetProID`) REFERENCES `product` (`ProID`),
  ADD CONSTRAINT `FK_TicketHeader_TicketDetail` FOREIGN KEY (`TicDetTicHeadID`) REFERENCES `ticketheader` (`TicHeadID`);

--
-- Filtros para la tabla `ticketheader`
--
ALTER TABLE `ticketheader`
  ADD CONSTRAINT `FK_Tabl_TicketHeader` FOREIGN KEY (`TicHeadTabID`) REFERENCES `tabl` (`TabID`),
  ADD CONSTRAINT `FK_User_TicketHeader` FOREIGN KEY (`TicHeadUserID`) REFERENCES `user` (`UserID`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_Role_User` FOREIGN KEY (`UserRoleID`) REFERENCES `role` (`RoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
