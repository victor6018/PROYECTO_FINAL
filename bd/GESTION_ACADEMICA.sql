-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema gestion_academica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gestion_academica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestion_academica` DEFAULT CHARACTER SET utf8 ;
USE `gestion_academica` ;

-- -----------------------------------------------------
-- Table `gestion_academica`.`instituto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`instituto` (
  `cod_modular` CHAR(7) NULL,
  `nombre` VARCHAR(150) NULL,
  `direccion` VARCHAR(100) NULL,
  `denominacion` VARCHAR(5) NULL,
  `gestion` VARCHAR(7) NULL,
  `resolucion_creacion` VARCHAR(13) NULL,
  `director` VARCHAR(80) NULL,
  `nombramiento_director` VARCHAR(13) NULL,
  `provincia` VARCHAR(40) NULL,
  `distrito` VARCHAR(40) NULL,
  `dre` VARCHAR(45) NULL,
  `ugel` VARCHAR(45) NULL,
  `semestre_inicio` DATE NULL,
  `semestre_final` DATE NULL,
  `ciclo_actual` VARCHAR(6) NULL,
  PRIMARY KEY (`cod_modular`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`administradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`administradores` (
  `idadministradores` INT(11) NULL AUTO_INCREMENT,
  `nombres` VARCHAR(45) NULL,
  `apellidos` VARCHAR(50) NULL,
  `cargo` VARCHAR(45) NULL,
  `instituto_cod_modular1` CHAR(7) NULL,
  `codigo` VARCHAR(11) NULL,
  `contrasenia` VARCHAR(50) NULL,
  `foto` MEDIUMBLOB NULL,
  PRIMARY KEY (`idadministradores`, `instituto_cod_modular1`),
  CONSTRAINT `fk_administradores_instituto1`
    FOREIGN KEY (`instituto_cod_modular1`)
    REFERENCES `gestion_academica`.`instituto` (`cod_modular`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`carrera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`carrera` (
  `id_carrera` VARCHAR(11) NULL,
  `nombre_carrera` VARCHAR(200) NULL,
  `resolucion` VARCHAR(13) NULL,
  `instituto_cod_modular` CHAR(7) NULL,
  PRIMARY KEY (`id_carrera`, `instituto_cod_modular`),
  CONSTRAINT `fk_carrera_instituto1`
    FOREIGN KEY (`instituto_cod_modular`)
    REFERENCES `gestion_academica`.`instituto` (`cod_modular`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`docente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`docente` (
  `codigo_d` INT(11) NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NULL,
  `apellidos` VARCHAR(45) NULL,
  `correo` VARCHAR(50) NULL,
  `telefono` VARCHAR(9) NULL,
  `foto` MEDIUMBLOB NULL,
  `contrasenia` VARCHAR(100) NULL,
  `apellidom` VARCHAR(30) NULL,
  `dni` CHAR(8) NULL,
  `tipo` CHAR(1) NULL,
  `id_docente` VARCHAR(11) NULL,
  PRIMARY KEY (`codigo_d`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`dia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`dia` (
  `id_Dia` INT(11) NULL,
  `Dia` VARCHAR(9) NULL,
  PRIMARY KEY (`id_Dia`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`horario` (
  `id_horario` INT(11) NULL AUTO_INCREMENT,
  `horainicio` TIME NULL,
  `horafinal` TIME NULL,
  `aula` VARCHAR(3) NULL,
  `periodo` VARCHAR(7) NULL,
  `Dia_id_Dia` INT(11) NULL,
  PRIMARY KEY (`id_horario`),
  CONSTRAINT `fk_horario_Dia1`
    FOREIGN KEY (`Dia_id_Dia`)
    REFERENCES `gestion_academica`.`dia` (`id_Dia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`curso` (
  `id_curso` VARCHAR(10) NULL,
  `Nombre_curso` VARCHAR(50) NULL,
  `ciclo_curso` VARCHAR(3) NULL,
  `creditos` TINYINT(1) NULL,
  `silabo` TEXT NULL,
  `horario_id_horario` INT(11) NULL,
  `docente_id_docente` INT(11) NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_curso`, `docente_id_docente`),
  CONSTRAINT `fk_curso_docente1`
    FOREIGN KEY (`docente_id_docente`)
    REFERENCES `gestion_academica`.`docente` (`codigo_d`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_horario1`
    FOREIGN KEY (`horario_id_horario`)
    REFERENCES `gestion_academica`.`horario` (`id_horario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`carrera_has_curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`carrera_has_curso` (
  `carrera_id_carrera` VARCHAR(11) NULL,
  `carrera_instituto_cod_modular` CHAR(7) NULL,
  `curso_id_curso` VARCHAR(10) NULL,
  `curso_docente_id_docente` INT(11) NULL,
  PRIMARY KEY (`carrera_id_carrera`, `carrera_instituto_cod_modular`, `curso_id_curso`, `curso_docente_id_docente`),
  CONSTRAINT `fk_carrera_has_curso_carrera1`
    FOREIGN KEY (`carrera_id_carrera` , `carrera_instituto_cod_modular`)
    REFERENCES `gestion_academica`.`carrera` (`id_carrera` , `instituto_cod_modular`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrera_has_curso_curso1`
    FOREIGN KEY (`curso_id_curso` , `curso_docente_id_docente`)
    REFERENCES `gestion_academica`.`curso` (`id_curso` , `docente_id_docente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`estudiantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`estudiantes` (
  `id_estudiante` INT(10) NULL AUTO_INCREMENT,
  `DNI` CHAR(8) NULL,
  `nombres` VARCHAR(40) NULL,
  `ap_paterno` VARCHAR(45) NULL,
  `ap_materno` VARCHAR(40) NULL,
  `fecha_nacimiento` DATE NULL,
  `correo` VARCHAR(60) NULL,
  `telefono` CHAR(9) NULL,
  `foto` MEDIUMBLOB NULL,
  `codigoe` VARCHAR(11) NULL,
  `password` VARCHAR(45) NULL,
  `semestre_ingreso` CHAR(6) NULL,
  `sexo` CHAR(1) NULL,
  `dirección` VARCHAR(60) NULL,
  `ciudad` VARCHAR(60) NULL,
  `provincia` VARCHAR(60) NULL,
  `distrito` VARCHAR(60) NULL,
  `colegio` VARCHAR(60) NULL,
  `tipo_colegio` VARCHAR(30) NULL,
  `idioma_materno` VARCHAR(40) NULL,
  `carrera_alumno` VARCHAR(45) NULL,
  `ciclo` VARCHAR(4) NULL,
  PRIMARY KEY (`id_estudiante`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`tipopago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`tipopago` (
  `id_tipoPago` INT(11) NULL AUTO_INCREMENT,
  `tipo` VARCHAR(8) NULL,
  PRIMARY KEY (`id_tipoPago`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`estado_pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`estado_pago` (
  `id_pago` INT(11) NULL AUTO_INCREMENT,
  `monto` DECIMAL(3,2) NULL,
  `pagado` CHAR(2) NULL,
  `tipoPago_id_tipoPago` INT(11) NULL,
  `estudiantes_id_estudiante` INT(10) NULL,
  PRIMARY KEY (`id_pago`, `estudiantes_id_estudiante`),
  CONSTRAINT `fk_estado_Pago_estudiantes1`
    FOREIGN KEY (`estudiantes_id_estudiante`)
    REFERENCES `gestion_academica`.`estudiantes` (`id_estudiante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estado_Pago_tipoPago1`
    FOREIGN KEY (`tipoPago_id_tipoPago`)
    REFERENCES `gestion_academica`.`tipopago` (`id_tipoPago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`matricula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`matricula` (
  `id_matricula` INT(11) NULL AUTO_INCREMENT,
  `periodo` VARCHAR(7) NULL,
  `observacion` VARCHAR(11) NULL,
  `curso_id_curso` VARCHAR(10) NULL,
  `estudiantes_id_estudiante` INT(10) NULL,
  PRIMARY KEY (`id_matricula`, `curso_id_curso`, `estudiantes_id_estudiante`),
  CONSTRAINT `fk_matricula_curso1`
    FOREIGN KEY (`curso_id_curso`)
    REFERENCES `gestion_academica`.`curso` (`id_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_estudiantes1`
    FOREIGN KEY (`estudiantes_id_estudiante`)
    REFERENCES `gestion_academica`.`estudiantes` (`id_estudiante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `gestion_academica`.`nota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_academica`.`nota` (
  `id_nota` INT(11) NULL AUTO_INCREMENT,
  `promedio1` FLOAT NULL,
  `promedio2` FLOAT NULL,
  `promedio3` FLOAT NULL,
  `conceptual1` FLOAT NULL,
  `conceptual2` FLOAT NULL,
  `conceptual3` FLOAT NULL,
  `Actitudinal1` FLOAT NULL,
  `Actitudinal2` FLOAT NULL,
  `Actitudinal3` FLOAT NULL,
  `practica1` FLOAT NULL,
  `practica2` FLOAT NULL,
  `practica3` FLOAT NULL,
  `promedio_final` FLOAT NULL,
  `matricula_id_matricula` INT(11) NULL,
  `matricula_curso_id_curso` VARCHAR(10) NULL,
  `matricula_estudiantes_id_estudiante` INT(10) NULL,
  PRIMARY KEY (`id_nota`, `matricula_id_matricula`, `matricula_curso_id_curso`, `matricula_estudiantes_id_estudiante`),
  CONSTRAINT `fk_Nota_matricula1`
    FOREIGN KEY (`matricula_id_matricula` , `matricula_curso_id_curso` , `matricula_estudiantes_id_estudiante`)
    REFERENCES `gestion_academica`.`matricula` (`id_matricula` , `curso_id_curso` , `estudiantes_id_estudiante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

INSERT INTO `instituto` (`cod_modular`, `nombre`, `direccion`, `denominacion`, `gestion`, `resolucion_creacion`, `director`, `nombramiento_director`, `provincia`, `distrito`, `dre`, `ugel`, `semestre_inicio`, `semestre_final`, `ciclo_actual`) VALUES ('1328236', 'Instituto de educación superior tecnológico privado ISTEPSA', 'Jr. Ramon Castilla 322 Andahuaylas', 'iesp', 'Privado', '026-2006-ED', 'Maria Flores Rivas', '123-2016-ED', 'Andahuaylas', 'Andahuaylas', 'DIRECCIÓN REGIÓN DE APURIMA', 'UGEL Andahuaylas', '2020-08-03', '2020-12-18', '2020-2');
INSERT INTO `administradores` (`idadministradores`, `nombres`, `apellidos`, `cargo`, `instituto_cod_modular1`, `codigo`, `contrasenia`, `foto`) VALUES ('1020301', 'Richard', 'Gonzales Alarcon ', 'a', '1328236', '10202010', '12345', NULL);
INSERT INTO `administradores` (`idadministradores`, `nombres`, `apellidos`, `cargo`, `instituto_cod_modular1`, `codigo`, `contrasenia`, `foto`) VALUES ('1020302', 'Juan', 'Perez Navarro', 'a', '1328236', '10202011', '123', NULL);
INSERT INTO `carrera` (`id_carrera`, `nombre_carrera`, `resolucion`, `instituto_cod_modular`) VALUES ('1001', 'Administración de Empresas Turísticas y Hoteleras', '128-2006-ED', '1328236');
INSERT INTO `carrera` (`id_carrera`, `nombre_carrera`, `resolucion`, `instituto_cod_modular`) VALUES ('1002', 'Administración de negocios internacionales', '127-2006-ED', '1328236');
INSERT INTO `carrera` (`id_carrera`, `nombre_carrera`, `resolucion`, `instituto_cod_modular`) VALUES ('1003', 'Computación e informática', '126-2006-ED', '1328236');
INSERT INTO `carrera` (`id_carrera`, `nombre_carrera`, `resolucion`, `instituto_cod_modular`) VALUES ('1004', 'Contabilidad', '124-2006-ED', '1328236');
INSERT INTO `docente` (`codigo_d`, `nombre`, `apellidos`, `correo`, `telefono`, `foto`, `contrasenia`, `apellidom`, `dni`, `tipo`, `id_docente`) VALUES ('123101', ' Bladimir', 'Agüero LLacctas', NULL, '954764572', NULL, '123123', NULL, '71353401', 'D', '9010201');
INSERT INTO `docente` (`codigo_d`, `nombre`, `apellidos`, `correo`, `telefono`, `foto`, `contrasenia`, `apellidom`, `dni`, `tipo`, `id_docente`) VALUES ('123102', 'Jackeline ', 'RIMACHE ZAMORA', NULL, '945876124', NULL, '1231232', NULL, '72021352', 'D', '9010102');
INSERT INTO `docente` (`codigo_d`, `nombre`, `apellidos`, `correo`, `telefono`, `foto`, `contrasenia`, `apellidom`, `dni`, `tipo`, `id_docente`) VALUES ('1231003', 'Jenny ', 'Morales', NULL, '947546645', NULL, '1231233', NULL, '72013254', 'D', '9010103');
INSERT INTO `docente` (`codigo_d`, `nombre`, `apellidos`, `correo`, `telefono`, `foto`, `contrasenia`, `apellidom`, `dni`, `tipo`, `id_docente`) VALUES ('1231004', 'Smith ', 'Jacho Flores', NULL, '945782414', NULL, '1231234', NULL, '72546121', 'D', '9010104');
INSERT INTO `docente` (`codigo_d`, `nombre`, `apellidos`, `correo`, `telefono`, `foto`, `contrasenia`, `apellidom`, `dni`, `tipo`, `id_docente`) VALUES ('1231005', 'Carmen ', 'JACHO FLORES', NULL, '979451653', NULL, '1231235', NULL, '70546213', 'D', '9010105');
INSERT INTO `dia` (`id_Dia`, `Dia`) VALUES ('0001', 'LUNES');
INSERT INTO `dia` (`id_Dia`, `Dia`) VALUES ('0002', 'MARTES');
INSERT INTO `dia` (`id_Dia`, `Dia`) VALUES ('0003', 'MIERCOES');
INSERT INTO `dia` (`id_Dia`, `Dia`) VALUES ('0004', 'JUEVES');
INSERT INTO `dia` (`id_Dia`, `Dia`) VALUES ('0005', 'VIERNES');
INSERT INTO `dia` (`id_Dia`, `Dia`) VALUES ('0006', 'SABADO');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01011', '07:00:00', '09:00:00', '105', '2020-2', '1');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01012', '09:00:00', '11:00:00', '105', '2020-2', '1');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01013', '11:00:00', '13:00:00', '105', '2020-2', '1');

INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01021', '07:00:00', '09:00:00', '105', '2020-2', '2');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01022', '09:00:00', '11:00:00', '105', '2020-2', '2');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01023', '11:00:00', '13:00:00', '105', '2020-2', '2');

INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01031', '07:00:00', '09:00:00', '105', '2020-2', '3');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01032', '09:00:00', '11:00:00', '105', '2020-2', '3');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01033', '11:00:00', '13:00:00', '105', '2020-2', '3');

INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01041', '07:00:00', '09:00:00', '105', '2020-2', '4');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01042', '09:00:00', '11:00:00', '105', '2020-2', '4');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01043', '11:00:00', '13:00:00', '105', '2020-2', '4');

INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01051', '07:00:00', '09:00:00', '105', '2020-2', '5');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01052', '09:00:00', '11:00:00', '105', '2020-2', '5');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01053', '11:00:00', '13:00:00', '105', '2020-2', '5');

INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01061', '07:00:00', '09:00:00', '105', '2020-2', '6');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01062', '09:00:00', '11:00:00', '105', '2020-2', '6');
INSERT INTO `horario` (`id_horario`, `horainicio`, `horafinal`, `aula`, `periodo`, `Dia_id_Dia`) VALUES ('01063', '11:00:00', '13:00:00', '105', '2020-2', '6');

INSERT INTO `curso` (`id_curso`, `Nombre_curso`, `ciclo_curso`, `creditos`, `silabo`, `horario_id_horario`, `docente_id_docente`, `estado`) VALUES ('OF-CONT1', 'OFIMÁTICA ', 'I', '3', 'SILABO/', '1011', '123101', 'AB');
INSERT INTO `curso` (`id_curso`, `Nombre_curso`, `ciclo_curso`, `creditos`, `silabo`, `horario_id_horario`, `docente_id_docente`, `estado`) VALUES ('ING-CONT1', 'INGLES', 'I', '2', 'SILABO/', '1012', '123102', 'AB');
INSERT INTO `curso` (`id_curso`, `Nombre_curso`, `ciclo_curso`, `creditos`, `silabo`, `horario_id_horario`, `docente_id_docente`, `estado`) VALUES ('TECR-CONT1', 'TÉCNICAS DE COMUNICACIÓN Y REDACCIÓN', 'I', '4', 'SILABO/', '1013', '1231003', 'AB');

INSERT INTO `curso` (`id_curso`, `Nombre_curso`, `ciclo_curso`, `creditos`, `silabo`, `horario_id_horario`, `docente_id_docente`, `estado`) VALUES ('MAT-CONT1', 'MATEMÁTICAS BÁSICAS', 'I', '4', 'SILABO/', '1021', '1231004', 'AB');
INSERT INTO `curso` (`id_curso`, `Nombre_curso`, `ciclo_curso`, `creditos`, `silabo`, `horario_id_horario`, `docente_id_docente`, `estado`) VALUES ('LGC-CONT1', 'LEGISLACIÓN COMERCIAL', 'I', '3', 'SILABO/', '1022', '1231005', 'AB');
INSERT INTO `curso` (`id_curso`, `Nombre_curso`, `ciclo_curso`, `creditos`, `silabo`, `horario_id_horario`, `docente_id_docente`, `estado`) VALUES ('DC-CONT1', 'DOCUMENTACIÓN COMERCIAL Y CONTABLE', 'I', '3', 'SILABO/', '1023', '1231006', 'AB');

INSERT INTO `curso` (`id_curso`, `Nombre_curso`, `ciclo_curso`, `creditos`, `silabo`, `horario_id_horario`, `docente_id_docente`, `estado`) VALUES ('NORP-CONT1', 'NORMAS Y PRINCIPIOS CONTABLES', 'I', '4', 'SILABO/', '1031', '1231007', 'AB');
INSERT INTO `curso` (`id_curso`, `Nombre_curso`, `ciclo_curso`, `creditos`, `silabo`, `horario_id_horario`, `docente_id_docente`, `estado`) VALUES ('GNR-CONT1', 'CONTABILIDAD GENERAL', 'I', '4', 'SILABO/', '1032', '1231007', 'AB');

INSERT INTO `carrera_has_curso` (`carrera_id_carrera`, `carrera_instituto_cod_modular`, `curso_id_curso`, `curso_docente_id_docente`) VALUES ('1004', '1328236', 'ING-CONT1', '123102');
INSERT INTO `estudiantes` (`id_estudiante`, `DNI`, `nombres`, `ap_paterno`, `ap_materno`, `fecha_nacimiento`, `correo`, `telefono`, `foto`, `codigoe`, `password`, `semestre_ingreso`, `sexo`, `dirección`, `ciudad`, `provincia`, `distrito`, `colegio`, `tipo_colegio`, `idioma_materno`, `carrera_alumno`, `ciclo`) VALUES ('1006620172', '70666628', 'Victor Raul', 'Oscco', 'Mallma', '1999-07-18', 'josccolaura@gmail.com', '935235784', NULL, '1006620172', '123', '2017-2', 'M', 'av.amargura S/N', 'Andahuaylas', 'Andahuaylas', 'San Jeronimo', 'Belen de Osma y Pardo', 'estatal ', 'castellano', 'contabilidad', 'I');

INSERT INTO `matricula` (`id_matricula`, `periodo`, `observacion`, `curso_id_curso`, `estudiantes_id_estudiante`) VALUES ('11001', '2020-2', 'NORMAL', 'DC-CONT1', '1006620172');
INSERT INTO `matricula` (`id_matricula`, `periodo`, `observacion`, `curso_id_curso`, `estudiantes_id_estudiante`) VALUES ('11002', '2020-2', 'NORMAL', 'GNR-CONT1', '1006620172');
INSERT INTO `matricula` (`id_matricula`, `periodo`, `observacion`, `curso_id_curso`, `estudiantes_id_estudiante`) VALUES ('11003', '2020-2', 'NORMAL', 'ING-CONT1', '1006620172'), ('11004', '2020-2', 'NORMAL', 'LGC-CONT1', '1006620172');
INSERT INTO `matricula` (`id_matricula`, `periodo`, `observacion`, `curso_id_curso`, `estudiantes_id_estudiante`) VALUES ('11005', '2020-2', 'NORMAL', 'MAT-CONT1', '1006620172'), ('11006', '2020-2', 'NORMAL', 'NORP-CONT1', '1006620172');
INSERT INTO `matricula` (`id_matricula`, `periodo`, `observacion`, `curso_id_curso`, `estudiantes_id_estudiante`) VALUES ('11007', '2020-2', 'NORMAL', 'OF-CONT1', '1006620172'), ('11008', '2020-2', 'NORMAL', 'TECR-CONT1', '1006620172');

INSERT INTO `nota` (`id_nota`, `promedio1`, `promedio2`, `promedio3`, `conceptual1`, `conceptual2`, `conceptual3`, `Actitudinal1`, `Actitudinal2`, `Actitudinal3`, `practica1`, `practica2`, `practica3`, `promedio_final`, `matricula_id_matricula`, `matricula_curso_id_curso`, `matricula_estudiantes_id_estudiante`) VALUES ('11011', '15', '12', '15', '12', '05', '19', '19', '14', '14', '05', '18', '15', NULL, '11001', 'DC-CONT1', '1006620172');
INSERT INTO `nota` (`id_nota`, `promedio1`, `promedio2`, `promedio3`, `conceptual1`, `conceptual2`, `conceptual3`, `Actitudinal1`, `Actitudinal2`, `Actitudinal3`, `practica1`, `practica2`, `practica3`, `promedio_final`, `matricula_id_matricula`, `matricula_curso_id_curso`, `matricula_estudiantes_id_estudiante`) VALUES ('11012', '15', '14', '11', '17', '18', '14', '19', '14', '15', '14', '08', '09', NULL, '11002', 'GNR-CONT1', '1006620172');
INSERT INTO `nota` (`id_nota`, `promedio1`, `promedio2`, `promedio3`, `conceptual1`, `conceptual2`, `conceptual3`, `Actitudinal1`, `Actitudinal2`, `Actitudinal3`, `practica1`, `practica2`, `practica3`, `promedio_final`, `matricula_id_matricula`, `matricula_curso_id_curso`, `matricula_estudiantes_id_estudiante`) VALUES ('11013', '15', '11', '15', '12', '18', '18', '19', '14', '11', '15', '17', '11', NULL, '11003', 'ING-CONT1', '1006620172');
INSERT INTO `nota` (`id_nota`, `promedio1`, `promedio2`, `promedio3`, `conceptual1`, `conceptual2`, `conceptual3`, `Actitudinal1`, `Actitudinal2`, `Actitudinal3`, `practica1`, `practica2`, `practica3`, `promedio_final`, `matricula_id_matricula`, `matricula_curso_id_curso`, `matricula_estudiantes_id_estudiante`) VALUES ('11014', '15', '11', '12', '11', '11', '04', '05', '11', '18', '18', '11', '11', NULL, '11004', 'LGC-CONT1', '1006620172');
INSERT INTO `nota` (`id_nota`, `promedio1`, `promedio2`, `promedio3`, `conceptual1`, `conceptual2`, `conceptual3`, `Actitudinal1`, `Actitudinal2`, `Actitudinal3`, `practica1`, `practica2`, `practica3`, `promedio_final`, `matricula_id_matricula`, `matricula_curso_id_curso`, `matricula_estudiantes_id_estudiante`) VALUES ('11015', '05', '11', '15', '11', '11', '11', '15', '14', '14', '11', '14', '17', NULL, '11005', 'MAT-CONT1', '1006620172');
INSERT INTO `nota` (`id_nota`, `promedio1`, `promedio2`, `promedio3`, `conceptual1`, `conceptual2`, `conceptual3`, `Actitudinal1`, `Actitudinal2`, `Actitudinal3`, `practica1`, `practica2`, `practica3`, `promedio_final`, `matricula_id_matricula`, `matricula_curso_id_curso`, `matricula_estudiantes_id_estudiante`) VALUES ('11016', '05', '14', '15', '14', '11', '12', '13', '11', '17', '18', '11', '14', NULL, '11006', 'NORP-CONT1', '1006620172');
INSERT INTO `nota` (`id_nota`, `promedio1`, `promedio2`, `promedio3`, `conceptual1`, `conceptual2`, `conceptual3`, `Actitudinal1`, `Actitudinal2`, `Actitudinal3`, `practica1`, `practica2`, `practica3`, `promedio_final`, `matricula_id_matricula`, `matricula_curso_id_curso`, `matricula_estudiantes_id_estudiante`) VALUES ('11017', '15', '14', '11', '14', '05', '12', '05', '14', '19', '18', '11', '17', NULL, '11007', 'OF-CONT1', '1006620172');
INSERT INTO `nota` (`id_nota`, `promedio1`, `promedio2`, `promedio3`, `conceptual1`, `conceptual2`, `conceptual3`, `Actitudinal1`, `Actitudinal2`, `Actitudinal3`, `practica1`, `practica2`, `practica3`, `promedio_final`, `matricula_id_matricula`, `matricula_curso_id_curso`, `matricula_estudiantes_id_estudiante`) VALUES ('11018', '15', '11', '15', '11', '05', '11', '05', '11', '14', '18', '11', '14', NULL, '11008', 'TECR-CONT1', '1006620172');

INSERT INTO `tipopago` (`id_tipoPago`, `tipo`) VALUES ('4011', 'cuota');
INSERT INTO `tipopago` (`id_tipoPago`, `tipo`) VALUES ('4012', 'unico');
INSERT INTO `estado_pago` (`id_pago`, `monto`, `pagado`, `tipoPago_id_tipoPago`, `estudiantes_id_estudiante`) VALUES ('1121', '3', 'SI', '4011', '1006620172');




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
