-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: database-1.cuik0pe63vnh.us-east-2.rds.amazonaws.com
-- Tiempo de generación: 17-12-2023 a las 03:55:40
-- Versión del servidor: 8.0.33
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bitacorasMantenimientoOP2`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`admin`@`%` PROCEDURE `InsertarDatosCargador` (IN `nombre_maquina` VARCHAR(255), IN `nombreUsuario` VARCHAR(255), IN `turno` VARCHAR(255), IN `estadoEsqueleto` VARCHAR(255), IN `estadoAceiteMotor` VARCHAR(255), IN `estadoAceiteHidraulico` VARCHAR(255), IN `estadoAnticongelante` VARCHAR(255), IN `estadoBaterias` VARCHAR(255), IN `estadoLuces` VARCHAR(255), IN `estadoNeumáticosPresión` VARCHAR(255), IN `estadoBandaAlternadorVentilador` VARCHAR(255), IN `estadoAceiteTransmision` VARCHAR(255), IN `estadoFugasMT` VARCHAR(255), IN `estadoFrenos` VARCHAR(255), IN `estadoPresionMotor` VARCHAR(255), IN `estadoTemperaturaMotor` VARCHAR(255), IN `estadoAceiteMotorTransmision` VARCHAR(255), IN `estadoFugasME` VARCHAR(255), IN `estadoFrenosMT` VARCHAR(255), IN `estadoPresionMotorMT` VARCHAR(255), IN `estadoTemperaturaMotorMT` VARCHAR(255), IN `horometroInicial` INT, IN `horometroFinal` INT, IN `observacionesEsqueleto` VARCHAR(255), IN `observacionesAceiteMotor` VARCHAR(255), IN `observacionesAceiteHidraulico` VARCHAR(255), IN `observacionesAnticongelante` VARCHAR(255), IN `observacionesBaterias` VARCHAR(255), IN `observacionesLuces` VARCHAR(255), IN `observacionesNeumáticosPresión` VARCHAR(255), IN `observacionesBandaAlternadorVentilador` VARCHAR(255), IN `observacionesAceiteTransmision` VARCHAR(255), IN `observacionesFugasMT` VARCHAR(255), IN `observacionesFrenos` VARCHAR(255), IN `observacionesPresionMotor` VARCHAR(255), IN `observacionesTemperaturaMotor` VARCHAR(255), IN `observacionesAceiteTransmisionME` VARCHAR(255), IN `observacionesFugasME` VARCHAR(255), IN `observacionesFrenosMT` VARCHAR(255), IN `observacionesPresionMotorMT` VARCHAR(255), IN `observacionesTemperaturaMotorMT` VARCHAR(255), IN `observacionesHorometroInicial` VARCHAR(255), IN `observacionesHorometroFinal` VARCHAR(255), IN `CambiarFiltros` VARCHAR(255), IN `RevisarMangueras` VARCHAR(255), IN `EngrasarTazas_Pernos_Gatos` VARCHAR(255), IN `RevisarSistemaElectrico_Marcha` VARCHAR(255), IN `RevisarSistema_Avance` VARCHAR(255), IN `RevisarNivelesFluidoGeneral` VARCHAR(255), IN `observacionesCambiarFiltros` VARCHAR(255), IN `observacionesRevisarMangueras` VARCHAR(255), IN `observacionesEngrasarTazas_Pernos_Gatos` VARCHAR(255), IN `observacionesRevisarSistemaElectrico_Marcha` VARCHAR(255), IN `observacionesRevisarSistema_Avance` VARCHAR(255), IN `observacionesRevisarNivelesFluidoGeneral` VARCHAR(255), IN `AveriasMomentoSistema` VARCHAR(255), IN `fechaActual` DATE, IN `maquina_id` INT)   BEGIN
    INSERT INTO Cargador (
        nombre_maquina,
        revisado_por,
        turno,
        Estado_Esqueleto,
        Nivel_Aceite_Motor,
        Nivel_Aceite_Hidraulico,
        Nivel_Anticongelante,
        Baterias,
        Luces,
        Neumaticos_Presion_75LB,
        Banda_Alternador_Ventilador,
        Nivel_Aceite_Transmision,
        Fugas_Maquina_Trabajando,
        Frenos,
        Presion_Motor_50_PSI,
        Temperatura_Motor_100_180,
        Nivel_Aceite_Transmision_Maquina_Encendida,
        Fugas_Maquina_Encendida,
        Frenos_Maquina_Trabajando,
        Presion_Motor_50_PSI_Maquina_Trabajando,
        Horometro_Inicial,
        Horometro_Final,
        Temperatura_Motor_100_180_Maquina_Trabajando,
        Observaciones_Estado_Esqueleto,
        Observaciones_Nivel_Aceite_Motor,
        Observaciones_Nivel_Aceite_Hidraulico,
        Observaciones_Nivel_Anticongelante,
        Observaciones_Baterias,
        Observaciones_Luces,
        Observaciones_Neumaticos_Presion_75LB,
        Observaciones_Banda_Alternador_Ventilador,
        Observaciones_Nivel_Aceite_Transmision,
        Observaciones_Fugas_Maquina_Trabajando,
        Observaciones_Frenos,
        Observaciones_Presion_Motor_50_PSI,
        Observaciones_Temperatura_Motor_100_180,
        Observaciones_Nivel_Aceite_Maquina_Encendida,
        Observaciones_Fugas_Maquina_Encendida,
        Observaciones_Frenos_Maquina_Trabajando,
        Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando,
        Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando,
       Observaciones_Horometro_Inicial,
        Observaciones_Horometro_Final,
        Cambiar_Filtros,
        Revisar_Mangueras,
        Engrasar_Tazas_Pernos_Gatos,
        Revisar_Sistema_Electrico,
        Revisar_Sistema_Avance,
        Revisar_Niveles_Fluido_General,
        Observaciones_Cambiar_Filtros,
        Observaciones_Revisar_Mangueras,
        Observaciones_Engrasar_Tazas_Pernos_Gatos,
        Observaciones_Revisar_Sistema_Electrico,
        Observaciones_Revisar_Sistema_Avance,
        Observaciones_Revisar_Niveles_Fluido_General,
        Averias_Encontradas_Momento_Servicio,
        Fecha_Reporte,
        Maquina_ID
    ) 
    VALUES (
       nombre_maquina,
		  nombreUsuario, 
		  turno,
		   estadoEsqueleto, 
			estadoAceiteMotor, 
			estadoAceiteHidraulico,
			 estadoAnticongelante, 
			 estadoBaterias, 
			 estadoLuces, 
			 estadoNeumáticosPresión, 
			 estadoBandaAlternadorVentilador,		  estadoAceiteTransmision,			   estadoFugasMT, 			estadoFrenos, 			estadoPresionMotor, 			estadoTemperaturaMotor, 
				estadoAceiteMotorTransmision, 
				estadoFugasME, 
				estadoFrenosMT, 
				estadoPresionMotorMT, 			 
				horometroInicial, 
				horometroFinal, 
estadoTemperaturaMotorMT,			observacionesEsqueleto,
				observacionesAceiteMotor,
				 observacionesAceiteHidraulico,
				  observacionesAnticongelante,
				   observacionesBaterias, 
					observacionesLuces,
					 observacionesNeumáticosPresión,
					  observacionesBandaAlternadorVentilador, 
					  observacionesAceiteTransmision,
					   observacionesFugasMT,
						 observacionesFrenos,
						  observacionesPresionMotor,
						   observacionesTemperaturaMotor, 
							observacionesAceiteTransmisionME,
							 observacionesFugasME,
							 observacionesFrenosMT, 
							 observacionesPresionMotorMT, 
							 observacionesTemperaturaMotorMT, 
							 observacionesHorometroInicial,
							  observacionesHorometroFinal, 
							  CambiarFiltros, RevisarMangueras, 
							  EngrasarTazas_Pernos_Gatos, 
							  RevisarSistemaElectrico_Marcha, 
							  RevisarSistema_Avance, 
							  RevisarNivelesFluidoGeneral,
							   observacionesCambiarFiltros, 
								observacionesRevisarMangueras, 
								observacionesEngrasarTazas_Pernos_Gatos,
								 observacionesRevisarSistemaElectrico_Marcha, 
								 observacionesRevisarSistema_Avance,
								  observacionesRevisarNivelesFluidoGeneral,
								   AveriasMomentoSistema,
		 fechaActual,
		 maquina_id


		 );
    
END$$

CREATE DEFINER=`admin`@`%` PROCEDURE `InsertarDatosMatutinos` (IN `maquina_id` INT, IN `nombreUsuario` VARCHAR(255), IN `fecha_param` DATE, IN `fechaActual` ENUM('Matutino','Vespertino'))   BEGIN
    -- Insertar un nuevo registro en la tabla Reportes
    INSERT INTO Reportes (maquina_id, Revisado_Por, fecha, Turno)
    VALUES (maquina_id, nombreUsuario, fecha_param, fechaActual);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cargador`
--

CREATE TABLE `Cargador` (
  `Nombre_Maquina` enum('Cargador frontal 988B1','Cargador frontal 988B3','Cargador frontal 988F','Cargador frontal 980C') NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL DEFAULT '',
  `Turno` enum('Matutino','Vespertino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Estado_Esqueleto` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Motor` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Hidraulico` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Anticongelante` enum('Bueno','Malo') DEFAULT NULL,
  `Baterias` enum('Bueno','Malo') DEFAULT NULL,
  `Luces` enum('Bueno','Malo') DEFAULT NULL,
  `Neumaticos_Presion_75LB` enum('Bueno','Malo') DEFAULT NULL,
  `Banda_Alternador_Ventilador` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Transmision` enum('Bueno','Malo') DEFAULT NULL,
  `Fugas_Maquina_Trabajando` enum('Bueno','Malo') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Frenos` enum('Bueno','Malo') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Presion_Motor_50_PSI` enum('Bueno','Malo') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Temperatura_Motor_100_180` enum('Bueno','Malo') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Nivel_Aceite_Transmision_Maquina_Encendida` enum('Bueno','Malo') DEFAULT NULL,
  `Fugas_Maquina_Encendida` enum('Bueno','Malo') DEFAULT NULL,
  `Frenos_Maquina_Trabajando` enum('Bueno','Malo') DEFAULT NULL,
  `Presion_Motor_50_PSI_Maquina_Trabajando` enum('Bueno','Malo') DEFAULT NULL,
  `Temperatura_Motor_100_180_Maquina_Trabajando` enum('Bueno','Malo') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Observaciones_Estado_Esqueleto` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Motor` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Hidraulico` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Anticongelante` varchar(255) DEFAULT NULL,
  `Observaciones_Baterias` varchar(255) DEFAULT NULL,
  `Observaciones_Luces` varchar(255) DEFAULT NULL,
  `Observaciones_Neumaticos_Presion_75LB` varchar(255) DEFAULT NULL,
  `Observaciones_Banda_Alternador_Ventilador` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Transmision` varchar(255) DEFAULT NULL,
  `Observaciones_Fugas_Maquina_Trabajando` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Observaciones_Frenos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Observaciones_Presion_Motor_50_PSI` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Observaciones_Temperatura_Motor_100_180` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Maquina_Encendida` varchar(255) DEFAULT NULL,
  `Observaciones_Fugas_Maquina_Encendida` varchar(255) DEFAULT NULL,
  `Observaciones_Frenos_Maquina_Trabajando` varchar(255) DEFAULT NULL,
  `Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando` varchar(255) DEFAULT NULL,
  `Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `Cambiar_Filtros` enum('Si','No') DEFAULT NULL,
  `Revisar_Mangueras` enum('Si','No') DEFAULT NULL,
  `Engrasar_Tazas_Pernos_Gatos` enum('Si','No') DEFAULT NULL,
  `Revisar_Sistema_Electrico` enum('Si','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Revisar_Sistema_Avance` enum('Si','No') DEFAULT NULL,
  `Revisar_Niveles_Fluido_General` enum('Si','No') DEFAULT NULL,
  `Observaciones_Cambiar_Filtros` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Mangueras` varchar(255) DEFAULT NULL,
  `Observaciones_Engrasar_Tazas_Pernos_Gatos` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Sistema_Electrico` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Observaciones_Revisar_Sistema_Avance` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Niveles_Fluido_General` varchar(255) DEFAULT NULL,
  `Averias_Encontradas_Momento_Servicio` varchar(255) DEFAULT NULL,
  `Fecha_Reporte` date DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `id_reporte` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Cargador`
--

INSERT INTO `Cargador` (`Nombre_Maquina`, `Revisado_Por`, `Turno`, `Estado_Esqueleto`, `Nivel_Aceite_Motor`, `Nivel_Aceite_Hidraulico`, `Nivel_Anticongelante`, `Baterias`, `Luces`, `Neumaticos_Presion_75LB`, `Banda_Alternador_Ventilador`, `Nivel_Aceite_Transmision`, `Fugas_Maquina_Trabajando`, `Frenos`, `Presion_Motor_50_PSI`, `Temperatura_Motor_100_180`, `Nivel_Aceite_Transmision_Maquina_Encendida`, `Fugas_Maquina_Encendida`, `Frenos_Maquina_Trabajando`, `Presion_Motor_50_PSI_Maquina_Trabajando`, `Temperatura_Motor_100_180_Maquina_Trabajando`, `Horometro_Inicial`, `Horometro_Final`, `Observaciones_Estado_Esqueleto`, `Observaciones_Nivel_Aceite_Motor`, `Observaciones_Nivel_Aceite_Hidraulico`, `Observaciones_Nivel_Anticongelante`, `Observaciones_Baterias`, `Observaciones_Luces`, `Observaciones_Neumaticos_Presion_75LB`, `Observaciones_Banda_Alternador_Ventilador`, `Observaciones_Nivel_Aceite_Transmision`, `Observaciones_Fugas_Maquina_Trabajando`, `Observaciones_Frenos`, `Observaciones_Presion_Motor_50_PSI`, `Observaciones_Temperatura_Motor_100_180`, `Observaciones_Nivel_Aceite_Maquina_Encendida`, `Observaciones_Fugas_Maquina_Encendida`, `Observaciones_Frenos_Maquina_Trabajando`, `Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando`, `Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando`, `Observaciones_Horometro_Inicial`, `Observaciones_Horometro_Final`, `Cambiar_Filtros`, `Revisar_Mangueras`, `Engrasar_Tazas_Pernos_Gatos`, `Revisar_Sistema_Electrico`, `Revisar_Sistema_Avance`, `Revisar_Niveles_Fluido_General`, `Observaciones_Cambiar_Filtros`, `Observaciones_Revisar_Mangueras`, `Observaciones_Engrasar_Tazas_Pernos_Gatos`, `Observaciones_Revisar_Sistema_Electrico`, `Observaciones_Revisar_Sistema_Avance`, `Observaciones_Revisar_Niveles_Fluido_General`, `Averias_Encontradas_Momento_Servicio`, `Fecha_Reporte`, `Maquina_ID`, `id_reporte`) VALUES
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Ya funciona GG', '2023-12-16', 0, 47),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Pero no jala las observaciones en el nuevo reporte', '2023-12-16', 0, 48),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 85, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Ya las jala ahora si\r\n:)', '2023-12-16', 0, 49),
('Cargador frontal 988B1', 'Mario Arroyo', 'Vespertino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 98, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Prueba #1 Vespertino', '2023-12-16', 0, 50),
('Cargador frontal 988B1', 'Mario Arroyo', 'Vespertino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 100, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Prueba #2 Vespertino', '2023-12-16', 0, 51),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', 'Malo', 'Malo', 'Malo', 'Malo', 'Bueno', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Bueno', 'Malo', 'Malo', 'Bueno', '', 0, 123, '', '', '', 'eso tilin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', 'Si', 'Si', '', '', '', '', '', '', '', '', '', 'saw', '2023-12-15', 0, 52),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', 'Malo', 'Malo', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Bueno', 'Malo', '', 0, 12, 'E', 'S', 'O', '', 'T', 'I', 'L', 'I', 'N', '', '', '', '', '', '', '', '', '', '', '', 'Si', '', '', '', '', '', '', '', '', '', '', '', '', '2023-12-16', 0, 53),
('Cargador frontal 980C', 'Mario Arroyo', 'Vespertino', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', '', 0, 122, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'No', 'No', 'No', 'No', 'No', 'No', '', '', '', '', '', '', 'EPA', '2023-12-16', 3, 54),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Malo', '', 0, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', '', '', '', '', '', '', '', '', '', '', '', '', '2023-12-16', 0, 55),
('Cargador frontal 980C', 'Mario Arroyo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 123, 'Estado del Esqueleto', 'Nivel Aceite de Motor', 'Nivel Aceite Hidráulico', 'Nivel de Anticongelante', 'Baterías', 'Luces', 'Neumáticos Presión 70LB', 'Banda de Alternador y Ventilador', 'Nivel Aceite Transmisión	mal', 'Fugas Maquina Trabajando mal', 'Frenos mal', 'Presión de Motor 50 PSI	mal', 'Temperatura de Motor 100-180°C	mal', '', 'Fugas', '', 'Presión de Motor 50 PSI', 'Temperatura de Motor 100-180°C', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', 'Revisar Mangueras', 'Engrasar Tazas, Pernos, Gatos', 'Revisar Sistema Eléctrico (Marcha)', 'Revisar Sistema de Avance', 'Revisar Niveles de Fluido en General', 'Averías Encontradas al Momento del Servicio', '2023-12-16', 3, 56),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 'Bueno', 'Bueno', 'Bueno', 4, 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, NULL),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 2, 3, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '', '15', '', '17', '18', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '21', '22', '23', '24', '25', '26', '27', NULL, 0, NULL),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Malo', '', 0, 2, 'sas', 'asas', 'aasa', 'ss', 'asa', 'asas', 'sa', 'aa', 'a', 'ass', 'asa', 'sasas', 'asas', '', 'asasas', '', 'sa', 'sas', '', '', 'Si', 'No', 'Si', 'No', 'Si', 'No', '', 'as', 'sa', 'as', 'asas', 'aa', 'sas', '2023-12-16', 0, 57),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '', '', '', '', '', '', '2023-12-17', 0, 58),
('Cargador frontal 988B3', 'Mario Arroyo', 'Matutino', 'Bueno', 'Malo', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', '', 0, 3, '', '', '', '', 'no son duracel', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', 'No', '', '', '', '', '', '', '', '', '', '', '', '2023-12-16', 1, 59),
('Cargador frontal 988B1', 'Mario Arroyo', 'Vespertino', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Malo', 'Bueno', 'Malo', 'Bueno', 'Bueno', 'Malo', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 1550, 'Estado del Esqueleto', 'Nivel Aceite de Motor', 'Nivel Aceite de Motor', 'Nivel de Anticongelante', 'Baterías', 'Luces', 'Neumáticos Presión 70LB', 'Banda de Alternador y Ventilador', 'Nivel Aceite Transmisión', 'Fugas Maquina Trabajando', 'Frenos', 'Presión de Motor 50 PSI', 'Temperatura de Motor 100-180°C', 'Nivel Aceite Transmision', 'Fugas', '', 'Presión de Motor 50 PSI', 'Temperatura de Motor 100-180°C', '', '', 'Si', 'No', 'No', 'No', 'No', 'Si', '', 'Revisar Mangueras', 'Engrasar Tazas, Pernos, Gatos', 'Revisar Sistema Eléctrico (Marcha)', 'Revisar Sistema de Avance', 'Revisar Niveles de Fluido en General', 'Averías Encontradas al Momento del Servicio', '2023-12-16', 0, 60),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '', '', '', '', '', '', '2023-12-16', 0, 61),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Malo', 'Bueno', 'Malo', 'Malo', 'Bueno', 'Malo', 'Bueno', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 25, '', '', '', 'Culito', '', '', '', '', '', '', '', '', '', '', 'Hoal', '', '', '', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '', '', '', '', '', '', '2023-12-16', 0, 62),
('Cargador frontal 988B1', 'Omar trejo', 'Vespertino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 2, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '12', '14', '15', '', '17', '18', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '22', '23', '24', '25', '26', '29', '2023-12-16', 0, 63),
('Cargador frontal 988B1', 'Omar trejo', 'Vespertino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '', '', '', '', '', '', '2023-12-16', 0, 64),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si caon', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '', '', '', '', '', '', '2023-12-17', 0, 65),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Bueno', 'Malo', 'Bueno', 'Malo', 'Bueno', 'Malo', 'Bueno', 'Malo', 'Bueno', 'Malo', 'Bueno', 'Bueno', 'Malo', '', 0, 25, 'Ay pai', 'Saca la rosca', 'Te presto', 'Sacas', 'La leche', 'Ponte pa que te heche', 'A ti y a tu tía meche', 'Con mi tía no te metas cabron, por qué al chile si ando dando en tu puta madre', 'Jajajajajajaja', 'De k te ries', 'De lo feo que te ves', 'Mamadas caon', 'Compas?', '', 'Sawwww', '', 'Tengo hambre', 'Als la pata y lambe', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '2', '3', '4', '5', '6', '9', '2023-12-17', 0, 66),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 0, 1, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '', '17', '18', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '2', '3', '4', '5', '6', '9', '2023-12-17', 0, 67),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 0, 1, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '', '17', '18', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '22', '23', '24', '25', '26', '29', '2023-12-17', 0, 68),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 0, 1, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '2', '3', '4', '5', '6', '9', '2023-12-17', 0, 69),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Malo', 'Malo', 'Malo', 'Malo', 'Bueno', 'Malo', 'Malo', 'Bueno', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', 'Malo', '', 0, 123, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', 'No', 'No', 'Si', 'No', 'Si', '', '', '', '', '', '', 'Si', '2023-12-17', 0, 70),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '', '', '', '', '', '', '2023-12-17', 0, 71),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Malo', 0, 1, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '22', '23', '24', '25', '26', '29', '2023-12-17', 0, 72),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2023-12-17', 0, 73),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', '', '', '', '', '', 'Verija', '', '', '', '', '', '', '2023-12-17', 0, 74),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 12, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '1', '2', '3', '4', '5', '6', '10', '2023-12-17', 0, 75),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2023-12-17', 0, 76),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 2, '1', '2', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '1', '2', '3', '4', '5', '6', '10', '2023-12-17', 0, 77),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 100, '', '', '', '', '', '', '', '', '', '', '', '', 'A ver si jala', '', '', '', '', 'A ver si jala', 'Inicial', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2023-12-17', 0, 78),
('Cargador frontal 988B1', 'Mario Arroyo', 'Matutino', 'Bueno', '', '', '', '', '', '', '', '', '', '', '', 'Malo', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'sawmal', '', '', '', '', 'saw', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2023-12-17', 0, 79),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', 'Si', '', '', '', '', 'Jala', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2023-12-17', 0, 80),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 12, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '18', '14', '15', '16', '17', '13', '19', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '21', '22', '23', '24', '25', '26', '29', '2023-12-17', 0, 81),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', '', 0, 12, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '18', '14', '15', '16', '17', '13', '19', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '21', '22', '23', '24', '25', '26', 'Saaaaaaw', '2023-12-17', 0, 82),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', '', '', '', '', '', '', '', '', '', '', '', 'Malo', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2023-12-17', 0, 83),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 0, 0, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '21', '22', '23', '24', '25', '26', '29', '2023-12-17', 0, 84),
('Cargador frontal 988B1', 'Omar trejo', 'Matutino', 'Bueno', '', '', '', '', '', '', '', '', '', '', '', '', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 'Bueno', 1, 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Jala', '1', '', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', '', '', '', '', '', '', '', '2023-12-17', 0, 85);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Compresor`
--

CREATE TABLE `Compresor` (
  `Nombre_Maquina` enum('Compresor 186','Compresor 175','Compresor 96') NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL,
  `Semana` int DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Turno` enum('Matutino','Vespertino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Estado_Equipo` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Motor` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Anticongelante` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Unidad_Compresion` enum('Bueno','Malo') DEFAULT NULL,
  `Fugas` enum('Bueno','Malo') DEFAULT NULL,
  `Ruidos_Extranos` enum('Bueno','Malo') DEFAULT NULL,
  `Bateria` enum('Bueno','Malo') DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Observaciones_Estado_Equipo` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Motor` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Anticongelante` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Unidad_Compresion` varchar(255) DEFAULT NULL,
  `Observaciones_Fugas` varchar(255) DEFAULT NULL,
  `Observaciones_Ruidos_Extranos` varchar(255) DEFAULT NULL,
  `Observaciones_Bateria` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `Cambiar_Filtros` enum('Si','No') DEFAULT NULL,
  `Revisar_Mangueras` enum('Si','No') DEFAULT NULL,
  `Revisar_Sistema_Electrico_Marcha` enum('Si','No') DEFAULT NULL,
  `Revisar_Niveles_Fluido_General` enum('Si','No') DEFAULT NULL,
  `Observaciones_Cambiar_Filtros` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Mangueras` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Sistema_Electrico_Marcha` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Niveles_Fluido_General` varchar(255) DEFAULT NULL,
  `Averias_Encontradas_Momento_Servicio` varchar(255) DEFAULT NULL,
  `hora_registro_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `Compresor`
--
DELIMITER $$
CREATE TRIGGER `after_insert_compresores` AFTER INSERT ON `Compresor` FOR EACH ROW BEGIN

   INSERT INTO Reportes (maquina_id,revisado_por,Semana,fecha)
    VALUES ( NEW.maquina_id, NEW.Revisado_Por,WEEKOFYEAR(CURDATE()), CURRENT_DATE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cuadreador`
--

CREATE TABLE `Cuadreador` (
  `Nombre_Maquina` enum('Cuadreador 1','Cuadreador 2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL,
  `Semana` int DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Turno` enum('Matutino','Vespertino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Riel_Ruedas_Poleas_Tren` enum('Bueno','Malo') DEFAULT NULL,
  `Ruidos_Extranos_Motor` enum('Bueno','Malo') DEFAULT NULL,
  `Control_Botones` enum('Bueno','Malo') DEFAULT NULL,
  `Limpieza_Clavijas` enum('Sí','No') DEFAULT NULL,
  `Limpieza_Motor` enum('Sí','No') DEFAULT NULL,
  `Limpieza_Riel` enum('Sí','No') DEFAULT NULL,
  `Inspeccion_General_Equipo` enum('Bueno','Malo') DEFAULT NULL,
  `Estado_Conexiones_Quitar` enum('Bueno','Malo') DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Observaciones_Riel_Ruedas_Poleas_Tren` varchar(255) DEFAULT NULL,
  `Observaciones_Ruidos_Extranos_Motor` varchar(255) DEFAULT NULL,
  `Observaciones_Control_Botones` varchar(255) DEFAULT NULL,
  `Observaciones_Inspeccion_General_Equipo` varchar(255) DEFAULT NULL,
  `Observaciones_Estado_Conexiones_Quitar` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `hora_registro_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `Cuadreador`
--
DELIMITER $$
CREATE TRIGGER `after_insert_cuadreadores` AFTER INSERT ON `Cuadreador` FOR EACH ROW BEGIN

   INSERT INTO Reportes (maquina_id,revisado_por,Semana,fecha)
    VALUES ( NEW.maquina_id, NEW.Revisado_Por,WEEKOFYEAR(CURDATE()), CURRENT_DATE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Espada`
--

CREATE TABLE `Espada` (
  `id_reporte` int NOT NULL,
  `Nombre_Maquina` enum('Espada Dazzini','Espada Fantini') NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL,
  `Semana` int DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Turno` enum('Matutino','Vespertino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Estado_Equipo` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Centralina` enum('Bueno','Malo') DEFAULT NULL,
  `Revisar_Conexiones` enum('Bueno','Malo') DEFAULT NULL,
  `Arranque_Motor_Centralina` enum('Bueno','Malo') DEFAULT NULL,
  `Revision_Bomba_Trabajando` enum('Bueno','Malo') DEFAULT NULL,
  `Revision_Movimientos` enum('Bueno','Malo') DEFAULT NULL,
  `Fugas` enum('Bueno','Malo') DEFAULT NULL,
  `Ruidos_Extranos` enum('Bueno','Malo') DEFAULT NULL,
  `Inspeccion_General_Equipo` enum('Bueno','Malo') DEFAULT NULL,
  `Movimiento_Motor_Regreso` enum('Bueno','Malo') DEFAULT NULL,
  `Estado_Conexiones_Quitar` enum('Bueno','Malo') DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Observaciones_Estado_Equipo` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Centralina` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Conexiones` varchar(255) DEFAULT NULL,
  `Observaciones_Arranque_Motor_Centralina` varchar(255) DEFAULT NULL,
  `Observaciones_Revision_Bomba_Trabajando` varchar(255) DEFAULT NULL,
  `Observaciones_Revision_Movimientos` varchar(255) DEFAULT NULL,
  `Observaciones_Fugas` varchar(255) DEFAULT NULL,
  `Observaciones_Ruidos_Extranos` varchar(255) DEFAULT NULL,
  `Observaciones_Inspeccion_General_Equipo` varchar(255) DEFAULT NULL,
  `Observaciones_Movimiento_Motor_Regreso` varchar(255) DEFAULT NULL,
  `Observaciones_Estado_Conexiones_Quitar` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `hora_registro_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `Espada`
--
DELIMITER $$
CREATE TRIGGER `after_insert_espadas` AFTER INSERT ON `Espada` FOR EACH ROW BEGIN

   INSERT INTO Reportes (maquina_id,revisado_por,Semana,fecha)
    VALUES ( NEW.maquina_id, NEW.Revisado_Por,WEEKOFYEAR(CURDATE()), CURRENT_DATE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Excavadora`
--

CREATE TABLE `Excavadora` (
  `id_reporte` int NOT NULL,
  `Nombre_Maquina` enum('Excavadora 345CL','Excavadora 375','Excavadora 790D') NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL,
  `Semana` int DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Turno` enum('Matutino','Vespertino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Estado_Esqueleto` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Motor` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Hidraulico` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Anticongelante` enum('Bueno','Malo') DEFAULT NULL,
  `Baterias` enum('Bueno','Malo') DEFAULT NULL,
  `Luces` enum('Bueno','Malo') DEFAULT NULL,
  `Cadena_Avance` enum('Bueno','Malo') DEFAULT NULL,
  `Banda_Alternador_Ventilador` enum('Bueno','Malo') DEFAULT NULL,
  `Fugas_Maquina_Encendida` enum('Bueno','Malo') DEFAULT NULL,
  `Movimientos_Velocidad_Maquina_Trabajando` enum('Bueno','Malo') DEFAULT NULL,
  `Presion_Motor_50_PSI_Maquina_Trabajando` enum('Bueno','Malo') DEFAULT NULL,
  `Temperatura_Motor_100_180_Maquina_Trabajando` enum('Bueno','Malo') DEFAULT NULL,
  `Observaciones_Estado_Esqueleto` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Motor` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Hidraulico` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Anticongelante` varchar(255) DEFAULT NULL,
  `Observaciones_Baterias` varchar(255) DEFAULT NULL,
  `Observaciones_Luces` varchar(255) DEFAULT NULL,
  `Observaciones_Cadena_Avance` varchar(255) DEFAULT NULL,
  `Observaciones_Banda_Alternador_Ventilador` varchar(255) DEFAULT NULL,
  `Observaciones_Fugas_Maquina_Encendida` varchar(255) DEFAULT NULL,
  `Observaciones_Movimientos_Velocidad_Maquina_Trabajando` varchar(255) DEFAULT NULL,
  `Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando` varchar(255) DEFAULT NULL,
  `Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando` varchar(255) DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `Cambiar_Filtros` enum('Si','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Revisar_Mangueras` enum('Si','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Engrasar_Tazas_Pernos_Gatos` enum('Si','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Revisar_Sistema_Electrico_Marcha` enum('Si','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Revisar_Sistema_de_Avance` enum('Si','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Revisar_Niveles_de_Fluido_en_General` enum('Si','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Revisar_Sistema_de_Movimientos_de_Bote` enum('Si','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Observaciones_Revisar_Mangueras` varchar(255) DEFAULT NULL,
  `Observaciones_Engrasar_Tazas_Pernos_Gatos` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Sistema_Electrico_Marcha` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Sistema_de_Avance` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Niveles_de_Fluido_en_General` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Sistema_de_Movimientos_de_Bote` varchar(255) DEFAULT NULL,
  `hora_registro_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `Excavadora`
--
DELIMITER $$
CREATE TRIGGER `after_insert_excavadoras` AFTER INSERT ON `Excavadora` FOR EACH ROW BEGIN

   INSERT INTO Reportes (maquina_id,revisado_por,Semana,fecha)
    VALUES ( NEW.maquina_id, NEW.Revisado_Por,WEEKOFYEAR(CURDATE()), CURRENT_DATE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Generador`
--

CREATE TABLE `Generador` (
  `id_reporte` int NOT NULL,
  `Nombre_Maquina` enum('Generador Cummins Blanco','Generador Cummins Verde','Generador Cummins Nucleo') NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL,
  `Semana` int DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Turno` enum('Matutino','Vespertino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Estado_Equipo` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Motor` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Anticongelante` enum('Bueno','Malo') DEFAULT NULL,
  `Baterias` enum('Bueno','Malo') DEFAULT NULL,
  `Ruidos_Extranos` enum('Bueno','Malo') DEFAULT NULL,
  `Fugas` enum('Bueno','Malo') DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Observaciones_Estado_Equipo` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Motor` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Anticongelante` varchar(255) DEFAULT NULL,
  `Observaciones_Baterias` varchar(255) DEFAULT NULL,
  `Observaciones_Ruidos_Extranos` varchar(255) DEFAULT NULL,
  `Observaciones_Fugas` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `Cambiar_Filtros` enum('Si','No') DEFAULT NULL,
  `Revisar_Mangueras` enum('Si','No') DEFAULT NULL,
  `Revisar_Sistema_Electrico_Marcha` enum('Si','No') DEFAULT NULL,
  `Revisar_Niveles_de_Fluido_en_General` enum('Si','No') DEFAULT NULL,
  `Observaciones_Cambiar_Filtros` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Mangueras` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Sistema_Electrico_Marcha` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Niveles_de_Fluido_en_General` varchar(255) DEFAULT NULL,
  `hora_registro_reporte` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `Generador`
--
DELIMITER $$
CREATE TRIGGER `after_insert_generadores` AFTER INSERT ON `Generador` FOR EACH ROW BEGIN

   INSERT INTO Reportes (maquina_id,revisado_por,Semana,fecha)
    VALUES ( NEW.maquina_id, NEW.Revisado_Por,WEEKOFYEAR(CURDATE()), CURRENT_DATE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Hilo`
--

CREATE TABLE `Hilo` (
  `id_reporte` int NOT NULL,
  `Nombre_Maquina` enum('Hilo 1','Hilo 2','Hilo 3','Hilo 4') NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL,
  `Semana` int DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Turno` enum('Matutino','Vespertino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Control_Botones` enum('Bueno','Malo') DEFAULT NULL,
  `Revision_Movimientos_Avance` enum('Bueno','Malo') DEFAULT NULL,
  `Revisar_Movimientos_Polea` enum('Bueno','Malo') DEFAULT NULL,
  `Revisar_Giros_Motor` enum('Bueno','Malo') DEFAULT NULL,
  `Limpieza_Clavijas` enum('Sí','No') DEFAULT NULL,
  `Interior_Exterior_Carro` enum('Sí','No') DEFAULT NULL,
  `Engrasar_Bastagos` enum('Sí','No') DEFAULT NULL,
  `Ruidos_Extranos` enum('Bueno','Malo') DEFAULT NULL,
  `Inspeccion_General_Equipo` enum('Bueno','Malo') DEFAULT NULL,
  `Estado_Conexiones_Quitar` enum('Bueno','Malo') DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Observaciones_Control_Botones` varchar(255) DEFAULT NULL,
  `Observaciones_Revision_Movimientos_Avance` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Movimientos_Polea` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Giros_Motor` varchar(255) DEFAULT NULL,
  `Observaciones_Ruidos_Extranos` varchar(255) DEFAULT NULL,
  `Observaciones_Inspeccion_General_Equipo` varchar(255) DEFAULT NULL,
  `Observaciones_Estado_Conexiones_Quitar` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `hora_registro_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `Hilo`
--
DELIMITER $$
CREATE TRIGGER `after_insert_hilos` AFTER INSERT ON `Hilo` FOR EACH ROW BEGIN

   INSERT INTO Reportes (maquina_id,revisado_por,Semana,fecha)
    VALUES ( NEW.maquina_id, NEW.Revisado_Por,WEEKOFYEAR(CURDATE()), CURRENT_DATE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Hilo_Dazzini`
--

CREATE TABLE `Hilo_Dazzini` (
  `id_reporte` int NOT NULL,
  `Nombre_Maquina` enum('Hilo Dazzini 5','Hilo Dazzini 6','Hilo Dazzini 7','Hilo Dazzini 8','Hilo Dazzini 9') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL,
  `Semana` int DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Turno` enum('Matutino','Vespertino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Control_Botones` enum('Bueno','Malo') DEFAULT NULL,
  `Revision_Movimientos_Avance` enum('Bueno','Malo') DEFAULT NULL,
  `Revisar_Movimientos_Polea` enum('Bueno','Malo') DEFAULT NULL,
  `Revisar_Giros_Motor` enum('Bueno','Malo') DEFAULT NULL,
  `Limpieza_Clavijas` enum('Sí','No') DEFAULT NULL,
  `Interior_Exterior_Carro` enum('Sí','No') DEFAULT NULL,
  `Engrasar_Bastagos` enum('Sí','No') DEFAULT NULL,
  `Ruidos_Extranos` enum('Bueno','Malo') DEFAULT NULL,
  `Inspeccion_General_Equipo` enum('Bueno','Malo') DEFAULT NULL,
  `Estado_Conexiones_Quitar` enum('Bueno','Malo') DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Observaciones_Control_Botones` varchar(255) DEFAULT NULL,
  `Observaciones_Revision_Movimientos_Avance` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Movimientos_Polea` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Giros_Motor` varchar(255) DEFAULT NULL,
  `Observaciones_Ruidos_Extranos` varchar(255) DEFAULT NULL,
  `Observaciones_Inspeccion_General_Equipo` varchar(255) DEFAULT NULL,
  `Observaciones_Estado_Conexiones_Quitar` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `hora_registro_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `Hilo_Dazzini`
--
DELIMITER $$
CREATE TRIGGER `after_insert_hilosDazzini` AFTER INSERT ON `Hilo_Dazzini` FOR EACH ROW BEGIN

   INSERT INTO Reportes (maquina_id,revisado_por,Semana,fecha)
    VALUES ( NEW.maquina_id, NEW.Revisado_Por,WEEKOFYEAR(CURDATE()), CURRENT_DATE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Maquinas`
--

CREATE TABLE `Maquinas` (
  `Maquina_ID` int NOT NULL,
  `Tipo_Maquina` varchar(255) NOT NULL,
  `Nombre_Maquina` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Maquinas`
--

INSERT INTO `Maquinas` (`Maquina_ID`, `Tipo_Maquina`, `Nombre_Maquina`) VALUES
(0, 'Cargador', 'Frontal 988B1'),
(1, 'Cargador', 'Frontal 988B3'),
(2, 'Cargador', 'Frontal 988F'),
(3, 'Cargador', 'Frontal 980C'),
(4, 'Compresor', 'Compresor 186'),
(5, 'Compresor', 'Compresor 175'),
(6, 'Compresor', 'Compresor 96'),
(7, 'Cuadreador', 'Cuadreador 1'),
(8, 'Cuadreador', 'Cuadreador 2'),
(9, 'Espada', 'Espada Dazzini'),
(10, 'Espada', 'Espada Fantini'),
(11, 'Excavadora', 'Excavadora 345CL'),
(12, 'Excavadora', 'Excavadora 375'),
(13, 'Excavadora', 'Excavadora 790D'),
(14, 'Generador', 'Generador Cummins Blanco'),
(15, 'Generador', 'Generador Cummins Verde'),
(16, 'Generador', 'Generador Cummins Nucleo'),
(17, 'Hilo', 'Hilo 1'),
(18, 'Hilo', 'Hilo 2'),
(19, 'Hilo', 'Hilo 3'),
(20, 'Hilo', 'Hilo 4'),
(21, 'Hilo_Dazzini', 'Hilo Dazzini 5'),
(22, 'Hilo_Dazzini', 'Hilo Dazzini 6'),
(23, 'Hilo_Dazzini', 'Hilo Dazzini 7'),
(24, 'Hilo_Dazzini', 'Hilo Dazzini 8'),
(25, 'Hilo_Dazzini', 'Hilo Dazzini 9'),
(26, 'Perforadora', 'Perforadora hidráulica Dazzini 1'),
(27, 'Perforadora', 'Perforadora hidráulica Dazzini 2'),
(28, 'Perforadora', 'Perforadora Aire 3'),
(29, 'Perforadora', 'Perforadora española 4'),
(30, 'Yucle', 'Yucle D400E'),
(31, 'Yucle', 'Yucle D300E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Perforadora`
--

CREATE TABLE `Perforadora` (
  `id_reporte` int NOT NULL,
  `Nombre_Maquina` enum('Perforadora hidráulica Dazzini 1','Perforadora hidráulica Dazzini 2','Perforadora Aire 3','Perforadora española 4') NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL,
  `Semana` int DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Turno` varchar(50) DEFAULT NULL,
  `Estado_Equipo` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Centralina` enum('Bueno','Malo') DEFAULT NULL,
  `Revisar_Conexiones` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Unidad_Compresion` enum('Bueno','Malo') DEFAULT NULL,
  `Fugas` enum('Bueno','Malo') DEFAULT NULL,
  `Ruidos_Extranos` enum('Bueno','Malo') DEFAULT NULL,
  `Bateria` enum('Bueno','Malo') DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Observaciones_Estado_Equipo` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Centralina` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Conexiones` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Unidad_Compresion` varchar(255) DEFAULT NULL,
  `Observaciones_Fugas` varchar(255) DEFAULT NULL,
  `Observaciones_Ruidos_Extranos` varchar(255) DEFAULT NULL,
  `Observaciones_Bateria` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `Observaciones_Arranque_Motor_Centralina_Encendida` varchar(255) DEFAULT NULL,
  `Observaciones_Revision_Bomba_Trabajando_Encendida` varchar(255) DEFAULT NULL,
  `Observaciones_Revision_de_Movimientos_Encendida` varchar(255) DEFAULT NULL,
  `Arranque_Motor_Centralina_Encendida` enum('Bueno','Malo') DEFAULT NULL,
  `Revision_Bomba_Trabajando_Encendida` enum('Bueno','Malo') DEFAULT NULL,
  `Revision_de_Movimientos_Encendida` enum('Bueno','Malo') DEFAULT NULL,
  `Observaciones_Inspeccion_General_Equipo` varchar(255) DEFAULT NULL,
  `Observaciones_Movimiento_Motor_Regreso` varchar(255) DEFAULT NULL,
  `Observaciones_Estados_De_Conexion_Al_Quitar` varchar(255) DEFAULT NULL,
  `Inspeccion_General_Equipo` enum('Bueno','Malo') DEFAULT NULL,
  `Movimiento_Motor_Regreso` enum('Bueno','Malo') DEFAULT NULL,
  `Estados_De_Conexion_Al_Quitar` enum('Bueno','Malo') DEFAULT NULL,
  `hora_registro_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Observaciones_Adicionales` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `Perforadora`
--
DELIMITER $$
CREATE TRIGGER `after_insert_perforadoras` AFTER INSERT ON `Perforadora` FOR EACH ROW BEGIN

   INSERT INTO Reportes (maquina_id,revisado_por,Semana,fecha)
    VALUES ( NEW.maquina_id, NEW.Revisado_Por,WEEKOFYEAR(CURDATE()), CURRENT_DATE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reportes`
--

CREATE TABLE `Reportes` (
  `id_reporte` int NOT NULL,
  `maquina_id` int NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL DEFAULT '',
  `Semana` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `Turno` enum('Matutino','Vespertino') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Reportes`
--

INSERT INTO `Reportes` (`id_reporte`, `maquina_id`, `Revisado_Por`, `Semana`, `fecha`, `Turno`) VALUES
(47, 0, 'Mario Arroyo', NULL, '2023-12-16', 'Matutino'),
(48, 0, 'Mario Arroyo', NULL, '2023-12-16', 'Matutino'),
(49, 0, 'Mario Arroyo', NULL, '2023-12-16', 'Matutino'),
(50, 0, 'Mario Arroyo', NULL, '2023-12-16', 'Vespertino'),
(51, 0, 'Mario Arroyo', NULL, '2023-12-16', 'Vespertino'),
(52, 0, 'Mario Arroyo', NULL, '2023-12-15', 'Matutino'),
(53, 0, 'Mario Arroyo', NULL, '2023-12-16', 'Matutino'),
(54, 3, 'Mario Arroyo', NULL, '2023-12-16', 'Vespertino'),
(55, 0, 'Mario Arroyo', NULL, '2023-12-16', 'Matutino'),
(56, 3, 'Mario Arroyo', NULL, '2023-12-16', 'Matutino'),
(57, 0, 'Mario Arroyo', NULL, '2023-12-16', 'Matutino'),
(58, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(59, 1, 'Mario Arroyo', NULL, '2023-12-16', 'Matutino'),
(60, 0, 'Mario Arroyo', NULL, '2023-12-16', 'Vespertino'),
(61, 0, 'Omar trejo', NULL, '2023-12-16', 'Matutino'),
(62, 0, 'Omar trejo', NULL, '2023-12-16', 'Matutino'),
(63, 0, 'Omar trejo', NULL, '2023-12-16', 'Vespertino'),
(64, 0, 'Omar trejo', NULL, '2023-12-16', 'Vespertino'),
(65, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(66, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(67, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(68, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(69, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(70, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(71, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(72, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(73, 0, 'Mario Arroyo', NULL, '2023-12-17', 'Matutino'),
(74, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(75, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(76, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(77, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(78, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(79, 0, 'Mario Arroyo', NULL, '2023-12-17', 'Matutino'),
(80, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(81, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(82, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(83, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(84, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino'),
(85, 0, 'Omar trejo', NULL, '2023-12-17', 'Matutino');

--
-- Disparadores `Reportes`
--
DELIMITER $$
CREATE TRIGGER `asignar_id_reporte_cargador` AFTER INSERT ON `Reportes` FOR EACH ROW BEGIN
    DECLARE ultimo_id_reporte INT;

    -- Obtener el último valor más alto de id_reporte en la tabla reportes
    SELECT MAX(id_reporte) INTO ultimo_id_reporte FROM Reportes;

    -- Actualizar el id_reporte más reciente de la tabla cargador con el valor obtenido
    UPDATE Cargador
    SET id_reporte = IFNULL(ultimo_id_reporte, 0)
    ORDER BY id_reporte ASC
    LIMIT 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contrasena`, `fecha_registro`) VALUES
(1, 'Mario Arroyo', 'mb13arroyo@gmail.com', '12345', '2023-12-08 05:35:01'),
(2, 'Joaquin', 'smmsalvadorbl@gmail.com', '4321', '2023-12-08 19:22:22'),
(3, 'Omar trejo', 'omi@gmail.com', '123', '2023-12-10 19:10:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Yucle`
--

CREATE TABLE `Yucle` (
  `Yucle_ID` int NOT NULL,
  `id_reporte` int NOT NULL,
  `Nombre_Maquina` enum('Yucle D400E','Yucle D300E') NOT NULL,
  `Revisado_Por` varchar(255) NOT NULL,
  `Semana` int DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Turno` varchar(50) DEFAULT NULL,
  `Estado_Esqueleto` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Motor` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Hidraulico` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Anticongelante` enum('Bueno','Malo') DEFAULT NULL,
  `Baterias` enum('Bueno','Malo') DEFAULT NULL,
  `Luces` enum('Bueno','Malo') DEFAULT NULL,
  `Neumaticos_Presion_70LB` enum('Bueno','Malo') DEFAULT NULL,
  `Banda_Alternador_Ventilador` enum('Bueno','Malo') DEFAULT NULL,
  `Nivel_Aceite_Transmision` enum('Bueno','Malo') DEFAULT NULL,
  `Fugas` enum('Bueno','Malo') DEFAULT NULL,
  `Frenos` enum('Bueno','Malo') DEFAULT NULL,
  `Presion_Motor_50_PSI` enum('Bueno','Malo') DEFAULT NULL,
  `Temperatura_Motor_100_180` enum('Bueno','Malo') DEFAULT NULL,
  `Observaciones_Estado_Esqueleto` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Motor` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Hidraulico` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Anticongelante` varchar(255) DEFAULT NULL,
  `Observaciones_Baterias` varchar(255) DEFAULT NULL,
  `Observaciones_Luces` varchar(255) DEFAULT NULL,
  `Observaciones_Neumaticos_Presion_70LB` varchar(255) DEFAULT NULL,
  `Observaciones_Banda_Alternador_Ventilador` varchar(255) DEFAULT NULL,
  `Observaciones_Nivel_Aceite_Transmision` varchar(255) DEFAULT NULL,
  `Observaciones_Fugas` varchar(255) DEFAULT NULL,
  `Observaciones_Frenos` varchar(255) DEFAULT NULL,
  `Observaciones_Presion_Motor_50_PSI` varchar(255) DEFAULT NULL,
  `Observaciones_Temperatura_Motor_100_180` varchar(255) DEFAULT NULL,
  `Horometro_Inicial` int DEFAULT NULL,
  `Horometro_Final` int DEFAULT NULL,
  `Maquina_ID` int DEFAULT NULL,
  `Cambiar_Filtros` enum('Si','No') DEFAULT NULL,
  `Revisar_Mangueras` enum('Si','No') DEFAULT NULL,
  `Engrasar_Tazas_Pernos_Gatos` enum('Si','No') DEFAULT NULL,
  `Revisar_Sistema_Electrico_Marcha` enum('Si','No') DEFAULT NULL,
  `Revisar_Sistema_de_Avance` enum('Si','No') DEFAULT NULL,
  `Revisar_Niveles_de_Fluido_en_General` enum('Si','No') DEFAULT NULL,
  `Observaciones_Cambiar_Filtros` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Mangueras` varchar(255) DEFAULT NULL,
  `Observaciones_Engrasar_Tazas_Pernos_Gatos` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Sistema_Electrico_Marcha` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Sistema_de_Avance` varchar(255) DEFAULT NULL,
  `Observaciones_Revisar_Niveles_de_Fluido_en_General` varchar(255) DEFAULT NULL,
  `Averias_Encontradas_Momento_Servicio` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Inicial` varchar(255) DEFAULT NULL,
  `Observaciones_Horometro_Final` varchar(255) DEFAULT NULL,
  `hora_registro_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `Yucle`
--
DELIMITER $$
CREATE TRIGGER `after_insert_yucles` AFTER INSERT ON `Yucle` FOR EACH ROW BEGIN

   INSERT INTO Reportes (maquina_id,revisado_por,Semana,fecha)
    VALUES ( NEW.maquina_id, NEW.Revisado_Por,WEEKOFYEAR(CURDATE()), CURRENT_DATE);
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Cargador`
--
ALTER TABLE `Cargador`
  ADD KEY `FK_Cargador_Maquina` (`Maquina_ID`),
  ADD KEY `FK_id_reporte` (`id_reporte`);

--
-- Indices de la tabla `Compresor`
--
ALTER TABLE `Compresor`
  ADD KEY `FK_Compresor_Maquina` (`Maquina_ID`);

--
-- Indices de la tabla `Cuadreador`
--
ALTER TABLE `Cuadreador`
  ADD KEY `FK_Cuadreador_Maquina` (`Maquina_ID`);

--
-- Indices de la tabla `Espada`
--
ALTER TABLE `Espada`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `FK_Espada_Maquina` (`Maquina_ID`);

--
-- Indices de la tabla `Excavadora`
--
ALTER TABLE `Excavadora`
  ADD KEY `FK_Excavadora_Maquina` (`Maquina_ID`),
  ADD KEY `FK_Excavadora` (`id_reporte`);

--
-- Indices de la tabla `Generador`
--
ALTER TABLE `Generador`
  ADD KEY `FK_Generador_Maquina` (`Maquina_ID`),
  ADD KEY `FK_Generador_Reporte` (`id_reporte`);

--
-- Indices de la tabla `Hilo`
--
ALTER TABLE `Hilo`
  ADD KEY `FK_Hilo_Maquina` (`Maquina_ID`),
  ADD KEY `FK_Hilo_Reporte` (`id_reporte`);

--
-- Indices de la tabla `Hilo_Dazzini`
--
ALTER TABLE `Hilo_Dazzini`
  ADD KEY `FK_Hilo_Dazzini_Maquina` (`Maquina_ID`),
  ADD KEY `FK_Hilo_Dazzini_Reporte` (`id_reporte`);

--
-- Indices de la tabla `Maquinas`
--
ALTER TABLE `Maquinas`
  ADD PRIMARY KEY (`Maquina_ID`);

--
-- Indices de la tabla `Perforadora`
--
ALTER TABLE `Perforadora`
  ADD KEY `FK_Perforadora_Maquina` (`Maquina_ID`),
  ADD KEY `FK_Perforadora_Reporte` (`id_reporte`);

--
-- Indices de la tabla `Reportes`
--
ALTER TABLE `Reportes`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `FK_Maquina_ID` (`maquina_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `Yucle`
--
ALTER TABLE `Yucle`
  ADD PRIMARY KEY (`Yucle_ID`),
  ADD KEY `FK_Yucle_Maquina` (`Maquina_ID`),
  ADD KEY `FK_Yucle_Reporte` (`id_reporte`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Reportes`
--
ALTER TABLE `Reportes`
  MODIFY `id_reporte` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Cargador`
--
ALTER TABLE `Cargador`
  ADD CONSTRAINT `FK_Cargador_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`),
  ADD CONSTRAINT `FK_id_reporte` FOREIGN KEY (`id_reporte`) REFERENCES `Reportes` (`id_reporte`);

--
-- Filtros para la tabla `Compresor`
--
ALTER TABLE `Compresor`
  ADD CONSTRAINT `FK_Compresor_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`);

--
-- Filtros para la tabla `Cuadreador`
--
ALTER TABLE `Cuadreador`
  ADD CONSTRAINT `FK_Cuadreador_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`);

--
-- Filtros para la tabla `Espada`
--
ALTER TABLE `Espada`
  ADD CONSTRAINT `FK_Espada_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`),
  ADD CONSTRAINT `FK_Espada_Reporte` FOREIGN KEY (`id_reporte`) REFERENCES `Reportes` (`id_reporte`);

--
-- Filtros para la tabla `Excavadora`
--
ALTER TABLE `Excavadora`
  ADD CONSTRAINT `FK_Excavadora_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`);

--
-- Filtros para la tabla `Generador`
--
ALTER TABLE `Generador`
  ADD CONSTRAINT `FK_Generador_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`);

--
-- Filtros para la tabla `Hilo`
--
ALTER TABLE `Hilo`
  ADD CONSTRAINT `FK_Hilo_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`);

--
-- Filtros para la tabla `Hilo_Dazzini`
--
ALTER TABLE `Hilo_Dazzini`
  ADD CONSTRAINT `FK_Hilo_Dazzini_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`),
  ADD CONSTRAINT `FK_Hilo_Dazzini_Reporte` FOREIGN KEY (`id_reporte`) REFERENCES `Reportes` (`id_reporte`);

--
-- Filtros para la tabla `Perforadora`
--
ALTER TABLE `Perforadora`
  ADD CONSTRAINT `FK_Perforadora_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`),
  ADD CONSTRAINT `FK_Perforadora_Reporte` FOREIGN KEY (`id_reporte`) REFERENCES `Reportes` (`id_reporte`);

--
-- Filtros para la tabla `Reportes`
--
ALTER TABLE `Reportes`
  ADD CONSTRAINT `FK_Maquina_ID` FOREIGN KEY (`maquina_id`) REFERENCES `Maquinas` (`Maquina_ID`);

--
-- Filtros para la tabla `Yucle`
--
ALTER TABLE `Yucle`
  ADD CONSTRAINT `FK_Yucle_Maquina` FOREIGN KEY (`Maquina_ID`) REFERENCES `Maquinas` (`Maquina_ID`),
  ADD CONSTRAINT `FK_Yucle_Reporte` FOREIGN KEY (`id_reporte`) REFERENCES `Reportes` (`id_reporte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
