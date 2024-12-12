/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 5.7.24 : Database - uts_certificados
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`uts_certificados` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;

/*Table structure for table `barrio` */

DROP TABLE IF EXISTS `barrio`;

CREATE TABLE `barrio` (
  `codigo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_comuna` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_comuna_barrio` (`codigo_comuna`),
  CONSTRAINT `fk_comuna_barrio` FOREIGN KEY (`codigo_comuna`) REFERENCES `comuna` (`codigo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `barrio` */

insert  into `barrio`(`codigo`,`nombre`,`codigo_comuna`) values 
('0','SIN INFORMACIÓN','0'),
('10001','BRISAS DE PROVENZA','10'),
('10002','CRISTAL ALTO','10'),
('10003','CRISTAL BAJO','10'),
('10004','DIAMANTE II','10'),
('10005','FONTANA ','10'),
('10006','GRANJAS DE PROVENZA','10'),
('10007','NUEVA FONTANA','10'),
('10008','PROVENZA','10'),
('10009','SAN LUIS','10'),
('1001','ALTOS DEL PROGRESO','1'),
('10010','VIVEROS DE PROVENZA','10'),
('100101','BRISAS DE SURATA','1'),
('100102','CAMINOS DE PAZ I','1'),
('100103','CAMINOS DE PAZ II','1'),
('100104','CERVUNION','1'),
('100105','DELICIAS NORTE','1'),
('100106','BARRIO NUEVO','1'),
('100107','DIVINO NIÑO I','1'),
('100108','DIVINO NIÑO II','1'),
('100109','LUZ DE ESPERANZA','1'),
('10011','LUZ DE SALVACION I','10'),
('100110','PORTAL DE LOS ANGELES (ASOVIPORAN)','1'),
('100111','RIO DE ORO','1'),
('100112','PUENTE DE NARIÑO','1'),
('1002','ALTOS DEL KENNEDY','1'),
('1003','BALCONES DEL KENNEDY (SECTOR HAMACAS LA CURVA)','1'),
('1004','BETANIA','1'),
('1005','CAFE MADRID','1'),
('1006','CAMPESTRE NORTE (GETSEMANI, LOS CERROS, LA FORTUNA)','1'),
('1007','CLAVERIANO','1'),
('1008','COLORADOS','1'),
('1009','COLSEGUROS NORTE','1'),
('1010','EL PABLON','1'),
('1011','EL ROSAL','1'),
('1012','KENNEDY','1'),
('1013','LAS HAMACAS','1'),
('1014','MINUTO DE DIOS','1'),
('1015','MIRADORES DEL KENNEDY','1'),
('1016','MARIA PAZ','1'),
('1017','MIRAMAR','1'),
('1018','OLAS ALTAS','1'),
('1019','OLAS BAJAS','1'),
('1020','OMAGA 1','1'),
('1021','OMAGA 2','1'),
('1022','PAISAJES DEL NORTE','1'),
('1023','ROSALTA','1'),
('1024','SAN VALENTIN','1'),
('1025','TEJAR NORTE','1'),
('1026','TEJARCITOS','1'),
('1027','VILLA ROSA','1'),
('1028','VILLA ALEGRIA I','1'),
('1029','VILLA ALEGRIA II','1'),
('1030','VILLA MARIA I','1'),
('1031','VILLA MARIA II','1'),
('1032','VILLA MARIA III','1'),
('1033','VILLAS DE SAN IGNACIO (SECTORES BAVARIA I, II, BETANIA I, II, INGESER)','1'),
('1034','ALTOS DE BETANIA','1'),
('1035','CAMPO MADRID','1'),
('1036','NORTE CLUB','1'),
('11001','BALCONES DEL SUR','11'),
('11001001','LA FLORESTA - SAN JOSE (PARTE BAJA CIUDAD VENECIA)','11'),
('11001002','PORVENIR (SECTOR LA TRANSVERSAL)','11'),
('11002','BRISAS DEL PALMAR','11'),
('11003','BRISAD DEL PARAISO','11'),
('11004','CANDADO','11'),
('11005','CIUDAD VENECIA','11'),
('11006','CONDADO DE GIBRALTAR','11'),
('11007','DANGOND','11'),
('11008','DELICIAS BAJAS','11'),
('11009','DELICIAS BAJAS','11'),
('11010','EL PORVENIR','11'),
('11011','EL ROCIO ','11'),
('11012','GRANJAS DE JULIO RINCON ','11'),
('11013','GRANJAS DE REAGAN','11'),
('11014','IGSALBELAR','11'),
('11015','JARDINES DE COAVICONSA','11'),
('11016','LOS CONQUISTADORES','11'),
('11017','MALPASO','11'),
('11018','MANUELA BELTRAN I Y II','11'),
('11019','PUNTA PARAISO','11'),
('11020','ROBLES','11'),
('11021','SANTA MARIA','11'),
('11022','TOLEDO PLATA ','11'),
('11023','VILLA ALICIA ','11'),
('11024','VILLA DEL NOGAL ','11'),
('11025','VILLA FLOR','11'),
('11026','VILLA REAL DEL SUR','11'),
('11027','VILLA SATA','11'),
('11028','LUZ DE SALVACION II','11'),
('12001','ALTOS DEL JARDIN','12'),
('12002','BOLARQUI','12'),
('12003','CABECERA DEL LLANO','12'),
('12004','ANTIGUO CAMPESTRE','12'),
('12005','CONUCOS','12'),
('12006','EL JARDIN','12'),
('12007','LOS CEDROS','12'),
('12008','MERCEDES','12'),
('12009','NUEVO SOTOMAYOR','12'),
('12010','PAN DE AZUCAR','12'),
('12011','PUERTA DEL SOL','12'),
('12012','SOTOMAYOR','12'),
('12013','TERRAZAS','12'),
('12014','LA FLORESTA','12'),
('13001','ALVAREZ LAS AMERICAS','13'),
('13002','ANTONIA SANTOS CENTRO','13'),
('13003','BOLIVAR','13'),
('13004','EL PRADO','13'),
('13005','GALAN','13'),
('13006','LA AURORA','13'),
('13007','LOS PINOS','13'),
('13008','MEJORAS PUBLICAS','13'),
('13009','SAN ALONSO','13'),
('13010','QUINTA DANIA','13'),
('14001','ALBANIA','14'),
('14002','BUENAVISTA','14'),
('14003','BUENOS AIRES','14'),
('14004','EL DIVISO','14'),
('14005','MIRAFLORES','14'),
('14006','LIMONCITO','14'),
('14007','QUINTA BRIGADA','14'),
('14008','MORRORICO','14'),
('14009','SAUCES ','14'),
('14010','VEGAS DE MORRORICO','14'),
('14011','VENADO DE ORO','14'),
('15001','CENTRO','15'),
('15002','GARCIA ROVIRA','15'),
('16001','ALTOS DEL CACIQUE','16'),
('16002','ALTOS DEL LAGO','16'),
('16003','BALCON DEL LAGO','16'),
('16004','BOSQUES DEL CACIQUE','16'),
('16005','EL TEJAR','16'),
('16006','GUAYACANES','16'),
('16007','HACIENDA SAN JUAN ','16'),
('16008','LAGOS DEL CACIQUE ','16'),
('16009','SAN EXPEDITO','16'),
('17001','BALCONCITOS','17'),
('17002','BRISAS DEL MUTIS','17'),
('17003','ESTORAQUES I Y II','17'),
('17004','LOS HEROES','17'),
('17005','MANZANARES','17'),
('17006','MONTERREDONDO','17'),
('17007','LA GRAN LADERA','17'),
('17008','MUTIS','17'),
('17009','PRADOS DEL MUTIS','17'),
('17010','QUEBRADA LA IGLESIA I','17'),
('2001','13 DE JUNIO','2'),
('2001001','NUEVO HORIZONTE DE LA MANO DE DIOS ','2'),
('2001002','MONEQUE','2'),
('2001003','MIRADOR NORTE','2'),
('2002','BOSCONIA','2'),
('2003','BOSQUE NORTE','2'),
('2004','EL PLAN','2'),
('2005','ESPERANZA I','2'),
('2006','ESPERANZA II','2'),
('2007','ESPERANZA III','2'),
('2008','LA INDEPENDENCIA','2'),
('2009','LA JUVENTUD','2'),
('2010','LIZCANO I','2'),
('2011','LIZCANO II','2'),
('2012','LOS ANGELES','2'),
('2013','NUEVA COLOMBIA','2'),
('2014','OLAS II','2'),
('2015','REGADERO NORTE','2'),
('2016','SAN CRISTOBAL ','2'),
('2017','TRANSICION','2'),
('2018','VILLA HELENA I','2'),
('2019','VILLA HELENA II','2'),
('2020','VILLA MERCEDES','2'),
('3001','ALARCON','3'),
('3002','CHAPINERO','3'),
('3003','CINAL','3'),
('3004','COMUNEROS','3'),
('3005','MODELO','3'),
('3006','MUTIALIDAD ','3'),
('3007','NORTE BAJO ','3'),
('3008','SAN FRANCISCO','3'),
('3009','SAN RAFAEL ','3'),
('3010','PUERTO RICO','3'),
('3011','UNIVERSIDAD','3'),
('3012','MRADORES DE LA UIS','3'),
('4001','12 DE OCTUBRE','4'),
('4001001','VILLAS DE GIRARDOT','4'),
('4001002','CAMILO TORRES','4'),
('4001003','CIUDAD PERDIDA','4'),
('4001004','CUYANITA','4'),
('4001005','MARIA AUXILIADORA','4'),
('4001006','MILAGRO DE DIOS','4'),
('4001007','PANTANO SANTANDER','4'),
('4001008','ZARABANDA','4'),
('4002','23 DE JUNIO','4'),
('4003','DON BOSCO','4'),
('4004','GAITAN ','4'),
('4005','GIRARDOT','4'),
('4006','GRANADA','4'),
('4007','LA FERIA','4'),
('4008','LA GLORIA ','4'),
('4009','NAPOLES','4'),
('4010','NARIÑO','4'),
('4011','PIO XII','4'),
('4012','SANTANDER ','4'),
('4013','RIO DE ORO I','4'),
('4014','LA INMACULADA','4'),
('5001','1 DE MAYO','5'),
('5001001','5 DE ENERO','5'),
('5001002','CARLOS PIZARRO','5'),
('5001003','GALLINERAL','5'),
('5001004','JOSE ANTONIO GAITAN','5'),
('5002','ALFONSO LOPEZ','5'),
('5003','CAMPO HERMOSO','5'),
('5004','CHARTA','5'),
('5005','CHORRERAS DE DON JUAN','5'),
('5006','LA ESTRELLA ','5'),
('5007','LA JOYA','5'),
('5008','QUINTA ESTRELLA ','5'),
('5009','PANTANO I','5'),
('5010','PANTANO II','5'),
('5011','PANTANO III','5'),
('5012','RINCON DE LA PAZ (17 DE ENERO Y 12 DE FEBRERO)','5'),
('5013','RIO DE ORO II','5'),
('6001','CANDILES','6'),
('6002','GOMEZ NIÑO','6'),
('6003','LA CEIBA','6'),
('6004','LA CONCORDIA','6'),
('6005','LA SALLE ','6'),
('6006','LA VICTORIA ','6'),
('6007','RICAURTE','6'),
('6008','SAN MIGUEL','6'),
('7001','CIUDADELA REAL DE MINAS','7'),
('8001','20 DE JULIO','8'),
('8001001','LA GUACAMAYA','8'),
('8001002','EL FONCE ','8'),
('8001003','LAURELES I','8'),
('8001004','MANZANA 10','8'),
('8001005','SAN GERARDO I','8'),
('8001006','SAN GERARDO II','8'),
('8001007','LA ISLITA','8'),
('8002','AFRICA','8'),
('8003','ANTIGUA COLOMBIA','8'),
('8004','BUCARAMANGA','8'),
('8005','CANELOS','8'),
('8006','CORDONCILLO I','8'),
('8007','CORDONCILLO II','8'),
('8008','JUAN XXIII','8'),
('8009','LOS LAURELES','8'),
('8010','PABLO VI','8'),
('8011','SAN GERARDO ','8'),
('8012','QUEBRADA LA IGLESIA II','8'),
('9001','ANTONIA SANTOS SUR','9'),
('9002','ASTURIAS','9'),
('9003','DIAMANTE I','9'),
('9004','LA LIBERTAD','9'),
('9005','LA PEDREGOSA','9'),
('9006','LAS CASITAS','9'),
('9007','NUEVA GRANADA ','9'),
('9008','PORTO FINO','9'),
('9009','QUEBRADA LA IGLESIA','9'),
('9010','SAN MARTIN','9'),
('9011','SAN PEDRO CLAVER','9'),
('9012','VILLA DIAMANTE','9'),
('9013','VILLA INES','9'),
('99','OTRO','1');

/*Table structure for table `certificados` */

DROP TABLE IF EXISTS `certificados`;

CREATE TABLE `certificados` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo_certificado` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `valor` int(10) DEFAULT NULL,
  `mensaje` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL COMMENT 'se muestra=1,no se muestra=0',
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_certi_user` (`user_id`),
  CONSTRAINT `fk_certi_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Data for the table `certificados` */

insert  into `certificados`(`id`,`tipo_certificado`,`valor`,`mensaje`,`estado`,`user_id`,`created_at`,`updated_at`) values 
(4,'Admitido',13000,'a',1,19,'2024-03-01 01:01:01','2024-03-01 01:01:01'),
(5,'Buena Conducta',13000,'b',1,19,'2024-03-01 01:01:01','2024-03-01 01:01:01'),
(6,'Matrícula o Estudios (Matrícula Vigente)',13000,'c',1,19,'2024-03-01 01:01:01','2024-03-01 01:01:01'),
(7,'Matrícula o Estudios (Matrícula No Vigente)',13000,'d',1,19,'2024-03-01 01:01:01','2024-03-01 01:01:01'),
(8,'No Matrícula para Trámite Interno',0,'e',1,19,'2024-03-01 01:01:01','2024-03-01 01:01:01'),
(9,'No Matrícula para Trámite Externo',13000,'f',1,19,'2024-03-01 01:01:01','2024-03-01 01:01:01');

/*Table structure for table `comuna` */

DROP TABLE IF EXISTS `comuna`;

CREATE TABLE `comuna` (
  `codigo` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `comuna` */

insert  into `comuna`(`codigo`,`nombre`) values 
('0','SIN INFORMACIÓN'),
('1','NORTE'),
('10','PROVENZA'),
('11','SUR'),
('12','CABECERA DEL LLANO'),
('13','ORIENTAL'),
('14','MORRORICO'),
('15','CENTRO'),
('16','LAGOS DEL CACIQUE'),
('17','MUTIS'),
('2','NORORIENTAL'),
('3','SAN FRANCISCO'),
('4','OCCIDENTAL'),
('5','GARCIA ROVIRA'),
('6','LA CONCORDIA'),
('7','CIUDADELA '),
('8','SUBOCCIDENTE'),
('9','LA PEDREGOSA');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2014_10_12_100000_create_password_resets_table',2);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `solicitud` */

DROP TABLE IF EXISTS `solicitud`;

CREATE TABLE `solicitud` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `documento` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre_completo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `observacion_uts` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `egresado` tinyint(1) DEFAULT NULL COMMENT '1=si, 0=no',
  `adj_documento` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `adj_estampilla` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `adj_pago` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'pendiente,finalizado, en curso, cerrado',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sol_user` (`user_id`),
  CONSTRAINT `fk_sol_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Data for the table `solicitud` */

/*Table structure for table `solicitud_certificado` */

DROP TABLE IF EXISTS `solicitud_certificado`;

CREATE TABLE `solicitud_certificado` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `certificado_id` bigint(20) NOT NULL,
  `solicitud_id` bigint(20) NOT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sol_cer_id` (`certificado_id`),
  KEY `fk_cer_sol_id` (`solicitud_id`),
  KEY `fk_sol_cer_user` (`user_id`),
  CONSTRAINT `fk_cer_sol_id` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_sol_cer_id` FOREIGN KEY (`certificado_id`) REFERENCES `certificados` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_sol_cer_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Data for the table `solicitud_certificado` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documento` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '1=activo,0=inactivo',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `uq_documento` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`tipo_documento`,`documento`,`name`,`telefono`,`email`,`email_verified_at`,`password`,`estado`,`remember_token`,`created_at`,`updated_at`,`is_admin`) values 
(19,'CC','99999999','administrador del sistema',NULL,'admin','2024-03-10 21:32:57','$2y$12$11FShVPBy0wKcrxx95yY4uPJ/sK.mPqr9qrR/BDaV.nXESBrb.YMO',1,'DWZfWv1KOALZSl2gvPq6CCPxQ21GONH0PlFz6aXy8mghhPYK2nyP4xy4sNHw','2024-03-10 17:04:12','2024-03-10 21:32:57',1),
(22,'CC','1098643625','estudiante 1','3125178877','fabian.hernandez.murcia@gmail.com','2024-11-13 20:18:13','$2y$12$k2imkf9WEy9xCWo.fV2Qk.x9lqpPyJjkVGjkkgEYCLl0xCAGss1eG',1,NULL,'2024-11-13 20:17:38','2024-12-12 01:06:38',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
