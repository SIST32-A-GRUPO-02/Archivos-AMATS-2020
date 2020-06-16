/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.4.11-MariaDB : Database - dawproyecto
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dawproyecto` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `dawproyecto`;

/*Table structure for table `convocatoria` */

DROP TABLE IF EXISTS `convocatoria`;

CREATE TABLE `convocatoria` (
  `idConvocatoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombreConvocatoria` varchar(100) NOT NULL,
  `fechaInicio` date NOT NULL,
  `idSede` int(10) NOT NULL,
  `fechaFin` date NOT NULL,
  `identificador` varchar(100) NOT NULL,
  `responsable` varchar(200) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`idConvocatoria`),
  KEY `convocatoria_ibfk_1` (`idSede`),
  CONSTRAINT `convocatoria_ibfk_1` FOREIGN KEY (`idSede`) REFERENCES `sede` (`idSede`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `convocatoria` */

/*Table structure for table `curso` */

DROP TABLE IF EXISTS `curso`;

CREATE TABLE `curso` (
  `idCurso` int(10) NOT NULL AUTO_INCREMENT,
  `nombreCurso` varchar(150) NOT NULL,
  `identificador` varchar(10) NOT NULL,
  `responsable` varchar(100) NOT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `curso` */

/*Table structure for table `docente` */

DROP TABLE IF EXISTS `docente`;

CREATE TABLE `docente` (
  `idDocente` int(10) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `idEspecialidad` int(10) NOT NULL,
  PRIMARY KEY (`idDocente`),
  KEY `docente_ibfk_1` (`idEspecialidad`),
  CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidad` (`idEspecialidad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `docente` */

insert  into `docente`(`idDocente`,`nombres`,`apellidos`,`fechaNacimiento`,`sexo`,`dui`,`nit`,`direccion`,`idEspecialidad`) values (1,'Ulises','Samayoa','0000-00-00','Hombre','09080706-9','0909-090909-090-0','Santa Ana',1);

/*Table structure for table `especialidad` */

DROP TABLE IF EXISTS `especialidad`;

CREATE TABLE `especialidad` (
  `idEspecialidad` int(10) NOT NULL AUTO_INCREMENT,
  `nombreEspecialidad` varchar(100) NOT NULL,
  PRIMARY KEY (`idEspecialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `especialidad` */

insert  into `especialidad`(`idEspecialidad`,`nombreEspecialidad`) values (1,'Programación');

/*Table structure for table `evaluaciones` */

DROP TABLE IF EXISTS `evaluaciones`;

CREATE TABLE `evaluaciones` (
  `idEvaluaciones` int(10) NOT NULL AUTO_INCREMENT,
  `nombreEvaluacion` varchar(40) NOT NULL,
  `porcentaje` varchar(10) NOT NULL,
  `idModulo` int(10) NOT NULL,
  PRIMARY KEY (`idEvaluaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `evaluaciones` */

/*Table structure for table `modulo` */

DROP TABLE IF EXISTS `modulo`;

CREATE TABLE `modulo` (
  `idModulo` int(10) NOT NULL AUTO_INCREMENT,
  `nombreModulo` varchar(100) NOT NULL,
  `descripcionModulo` varchar(100) NOT NULL,
  `horasModulo` int(10) NOT NULL,
  `idDocente` int(10) NOT NULL,
  `idCurso` int(10) NOT NULL,
  PRIMARY KEY (`idModulo`),
  KEY `idCurso` (`idCurso`),
  KEY `idDocente` (`idDocente`),
  CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `modulo_ibfk_2` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `modulo` */

/*Table structure for table `nota` */

DROP TABLE IF EXISTS `nota`;

CREATE TABLE `nota` (
  `idNota` int(10) NOT NULL AUTO_INCREMENT,
  `nota` varchar(10) NOT NULL,
  `idModulo` int(10) NOT NULL,
  `idEvaluaciones` int(10) NOT NULL,
  `idParticipanteCurso` int(10) NOT NULL,
  PRIMARY KEY (`idNota`),
  KEY `nota_ibfk_1` (`idModulo`),
  KEY `nota_ibfk_2` (`idEvaluaciones`),
  KEY `nota_ibfk_3` (`idParticipanteCurso`),
  CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`idModulo`) REFERENCES `modulo` (`idModulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`idEvaluaciones`) REFERENCES `evaluaciones` (`idEvaluaciones`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nota_ibfk_3` FOREIGN KEY (`idParticipanteCurso`) REFERENCES `participantecurso` (`idParticipanteCurso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `nota` */

/*Table structure for table `participante` */

DROP TABLE IF EXISTS `participante`;

CREATE TABLE `participante` (
  `idParticipante` int(10) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `idConvocatoria` int(10) NOT NULL,
  PRIMARY KEY (`idParticipante`),
  KEY `participante_ibfk_1` (`idConvocatoria`),
  CONSTRAINT `participante_ibfk_1` FOREIGN KEY (`idConvocatoria`) REFERENCES `convocatoria` (`idConvocatoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `participante` */

/*Table structure for table `participantecurso` */

DROP TABLE IF EXISTS `participantecurso`;

CREATE TABLE `participantecurso` (
  `idParticipanteCurso` int(10) NOT NULL AUTO_INCREMENT,
  `idParticipante` int(10) NOT NULL,
  `idCurso` int(10) NOT NULL,
  PRIMARY KEY (`idParticipanteCurso`),
  KEY `participantecurso_ibfk_1` (`idParticipante`),
  KEY `participantecurso_ibfk_2` (`idCurso`),
  CONSTRAINT `participantecurso_ibfk_1` FOREIGN KEY (`idParticipante`) REFERENCES `participante` (`idParticipante`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `participantecurso_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `participantecurso` */

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `idRol` int(10) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(100) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `rol` */

insert  into `rol`(`idRol`,`nombreRol`) values (1,'Docente'),(2,'Participante'),(3,'Administrador');

/*Table structure for table `sede` */

DROP TABLE IF EXISTS `sede`;

CREATE TABLE `sede` (
  `idSede` int(10) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `responsable` varchar(200) NOT NULL,
  PRIMARY KEY (`idSede`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sede` */

insert  into `sede`(`idSede`,`departamento`,`direccion`,`responsable`) values (1,'Santa Ana','9° Calle, Avn Independencia','Ulises Samayoa'),(2,'San Salvador','45° Calle, San Salvador','Carlos Martinez'),(3,'Ahuachapan','Ahuachapan','Marcial Reyes'),(4,'Sonsonate','Agape','Mauricio Escapini');

/*Table structure for table `telefono` */

DROP TABLE IF EXISTS `telefono`;

CREATE TABLE `telefono` (
  `idTelefono` int(10) NOT NULL AUTO_INCREMENT,
  `tipoTelefono` varchar(100) NOT NULL,
  PRIMARY KEY (`idTelefono`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `telefono` */

insert  into `telefono`(`idTelefono`,`tipoTelefono`) values (1,'Fijo'),(2,'Personal');

/*Table structure for table `telefonoparticipante` */

DROP TABLE IF EXISTS `telefonoparticipante`;

CREATE TABLE `telefonoparticipante` (
  `idTelefonoParticipante` int(10) NOT NULL AUTO_INCREMENT,
  `numeroTelefono` varchar(10) NOT NULL,
  `idTelefono` int(10) NOT NULL,
  `idParticipante` int(10) NOT NULL,
  PRIMARY KEY (`idTelefonoParticipante`),
  KEY `telefonoparticipante_ibfk_1` (`idParticipante`),
  KEY `telefonoparticipante_ibfk_2` (`idTelefono`),
  CONSTRAINT `telefonoparticipante_ibfk_1` FOREIGN KEY (`idParticipante`) REFERENCES `participante` (`idParticipante`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `telefonoparticipante_ibfk_2` FOREIGN KEY (`idTelefono`) REFERENCES `telefono` (`idTelefono`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `telefonoparticipante` */

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) NOT NULL,
  `contra` varchar(20) NOT NULL,
  `idRol` int(10) NOT NULL,
  `idParticipante` int(10) DEFAULT NULL,
  `idDocente` int(10) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `usuarios_ibfk_1` (`idRol`),
  KEY `usuarios_ibfk_3` (`idParticipante`),
  KEY `usuarios_ibfk_4` (`idDocente`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`idParticipante`) REFERENCES `participante` (`idParticipante`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idUsuario`,`usuario`,`contra`,`idRol`,`idParticipante`,`idDocente`) values (1,'Ulises','Ulises',3,NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
