-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.13-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para psepayment
CREATE DATABASE IF NOT EXISTS `psepayment` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `psepayment`;


-- Volcando estructura para tabla psepayment.pse_log
CREATE TABLE IF NOT EXISTS `pse_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_type` varchar(50) NOT NULL,
  `log_request` text NOT NULL,
  `log_response` text,
  `log_duration` float DEFAULT '0',
  `log_ipAddress` varchar(50) NOT NULL DEFAULT '0',
  `log_date` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Guarda los logs de las peticiones al webservice de pse';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla psepayment.pse_transaction
CREATE TABLE IF NOT EXISTS `pse_transaction` (
  `trn_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trn_value` float(8,2) NOT NULL DEFAULT '0.00',
  `trn_status` varchar(50) NOT NULL DEFAULT '0',
  `trn_message` varchar(100) DEFAULT NULL,
  `trn_transactionpseid` varchar(50) DEFAULT NULL,
  `trn_ip` varchar(40) DEFAULT NULL,
  `trn_date` datetime NOT NULL,
  PRIMARY KEY (`trn_id`),
  KEY `KEY_STATUS` (`trn_status`),
  KEY `KEY_DATE` (`trn_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Guarda los datos de la transacción en proceso';

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
