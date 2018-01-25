-- --------------------------------------------------------
-- Host:                         cxsrv002
-- Versión del servidor:         5.5.37-0ubuntu0.13.10.1-log - (Ubuntu)
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para psepayment
CREATE DATABASE IF NOT EXISTS `psepayment` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `psepayment`;

-- Volcando estructura para tabla psepayment.pse_log
CREATE TABLE IF NOT EXISTS `pse_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_request` text NOT NULL,
  `log_response` text,
  `log_duration` float DEFAULT '0',
  `log_ipAddres` varchar(50) NOT NULL DEFAULT '0',
  `log_date` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Guarda los logs de las peticiones al webservice de pse';

-- Volcando datos para la tabla psepayment.pse_log: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pse_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `pse_log` ENABLE KEYS */;

-- Volcando estructura para tabla psepayment.pse_transaction
CREATE TABLE IF NOT EXISTS `pse_transaction` (
  `trn_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trn_log_id` int(11) unsigned NOT NULL DEFAULT '0',
  `trn_status` varchar(50) NOT NULL DEFAULT '0',
  `trn_message` varchar(100) DEFAULT '0',
  `trn_date` datetime NOT NULL,
  PRIMARY KEY (`trn_id`),
  KEY `KEY_LOG_ID` (`trn_log_id`),
  KEY `KEY_STATUS` (`trn_status`),
  KEY `KEY_DATE` (`trn_date`),
  CONSTRAINT `FK_PSE_LOG` FOREIGN KEY (`trn_log_id`) REFERENCES `pse_log` (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Guarda los datos de la transacción en proceso';

-- Volcando datos para la tabla psepayment.pse_transaction: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pse_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `pse_transaction` ENABLE KEYS */;

-- Volcando estructura para tabla psepayment.pse_transactiondetail
CREATE TABLE IF NOT EXISTS `pse_transactiondetail` (
  `trd_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trd_trn_id` int(11) unsigned NOT NULL DEFAULT '0',
  `trd_name` varchar(50) DEFAULT '0',
  `trd_value` varchar(50) DEFAULT '0',
  PRIMARY KEY (`trd_id`),
  KEY `KEY_TRN_ID` (`trd_trn_id`),
  KEY `KEY_NAME` (`trd_name`),
  KEY `KEY_VALUE` (`trd_value`),
  CONSTRAINT `FK_TRN_ID` FOREIGN KEY (`trd_trn_id`) REFERENCES `pse_transaction` (`trn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Guarda datos necesarios de la transacción';

-- Volcando datos para la tabla psepayment.pse_transactiondetail: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pse_transactiondetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `pse_transactiondetail` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
