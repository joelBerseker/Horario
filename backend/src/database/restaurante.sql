/*hpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2022 a las 04:28:18
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.17

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
  `AccName` varchar(140) NOT NULL,
  `AccEstReg` int(11) NOT NULL,
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
  `ProEstReg` int(11) NOT NULL,
  `ProFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource`
--

CREATE TABLE `resource` (
  `ResID` int(11) NOT NULL,
  `ResName` varchar(100) NOT NULL,
  `ResEstReg` int(11) NOT NULL,
  `ResFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `TicHeadFecAct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `TypeProEstReg` int(11) NOT NULL,
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
  ADD KEY `FK_User_TicketHeader` (`TicHeadUserID`);

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
  MODIFY `ResID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `FK_User_TicketHeader` FOREIGN KEY (`TicHeadUserID`) REFERENCES `user` (`UserID`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_Role_User` FOREIGN KEY (`UserRoleID`) REFERENCES `role` (`RoleID`);
COMMIT;
*/

