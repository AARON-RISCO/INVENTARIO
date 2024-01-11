/*
Navicat MySQL Data Transfer

Source Server         : cnn
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bd_inventario

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-01-10 18:46:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `caja`
-- ----------------------------
DROP TABLE IF EXISTS `caja`;
CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `fecha_caja` date DEFAULT NULL,
  `apertura` float DEFAULT NULL,
  `ingresos` float DEFAULT NULL,
  `egresos` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id_caja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of caja
-- ----------------------------

-- ----------------------------
-- Table structure for `categoria`
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cat` varchar(30) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id_cat`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES ('1', 'GALLETAS', '0');
INSERT INTO `categoria` VALUES ('2', 'SNACKS', '0');
INSERT INTO `categoria` VALUES ('3', 'DULCES', '0');
INSERT INTO `categoria` VALUES ('4', 'BEBIDAS', '0');

-- ----------------------------
-- Table structure for `cliente`
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `dni_cli` char(8) NOT NULL,
  `ape_cli` varchar(30) DEFAULT NULL,
  `nom_cli` varchar(30) DEFAULT NULL,
  `tel_cli` char(9) DEFAULT NULL,
  PRIMARY KEY (`dni_cli`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of cliente
-- ----------------------------

-- ----------------------------
-- Table structure for `compra`
-- ----------------------------
DROP TABLE IF EXISTS `compra`;
CREATE TABLE `compra` (
  `cod_compra` int(11) NOT NULL,
  `dni_per` char(8) DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `total_general` float DEFAULT NULL,
  PRIMARY KEY (`cod_compra`) USING BTREE,
  KEY `com_per` (`dni_per`),
  CONSTRAINT `com_per` FOREIGN KEY (`dni_per`) REFERENCES `personal` (`dni_per`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of compra
-- ----------------------------

-- ----------------------------
-- Table structure for `detalle_caja`
-- ----------------------------
DROP TABLE IF EXISTS `detalle_caja`;
CREATE TABLE `detalle_caja` (
  `id_caja` int(11) DEFAULT NULL,
  `dni_per` char(8) DEFAULT NULL,
  `ingresos` float DEFAULT NULL,
  `egresos` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  KEY `det_caja` (`id_caja`),
  KEY `det_per` (`dni_per`),
  CONSTRAINT `det_caja` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`),
  CONSTRAINT `det_per` FOREIGN KEY (`dni_per`) REFERENCES `personal` (`dni_per`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of detalle_caja
-- ----------------------------

-- ----------------------------
-- Table structure for `detalle_compra`
-- ----------------------------
DROP TABLE IF EXISTS `detalle_compra`;
CREATE TABLE `detalle_compra` (
  `cod_compra` int(11) DEFAULT NULL,
  `id_pro` int(11) DEFAULT NULL,
  `pre_compra` float DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  KEY `compra_detalle` (`cod_compra`) USING BTREE,
  KEY `det_pro` (`id_pro`),
  CONSTRAINT `det_com` FOREIGN KEY (`cod_compra`) REFERENCES `compra` (`cod_compra`),
  CONSTRAINT `det_pro` FOREIGN KEY (`id_pro`) REFERENCES `producto` (`id_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of detalle_compra
-- ----------------------------

-- ----------------------------
-- Table structure for `detalle_venta`
-- ----------------------------
DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE `detalle_venta` (
  `id_venta` int(11) DEFAULT NULL,
  `id_pro` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `total_venta` float DEFAULT NULL,
  KEY `det_ven` (`id_venta`) USING BTREE,
  KEY `det_ven_pro` (`id_pro`),
  CONSTRAINT `det_ven` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`),
  CONSTRAINT `det_ven_pro` FOREIGN KEY (`id_pro`) REFERENCES `producto` (`id_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of detalle_venta
-- ----------------------------

-- ----------------------------
-- Table structure for `deudores`
-- ----------------------------
DROP TABLE IF EXISTS `deudores`;
CREATE TABLE `deudores` (
  `id_deudor` int(11) NOT NULL,
  `nom_deudor` varchar(25) DEFAULT NULL,
  `apellidos_deudor` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_deudor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of deudores
-- ----------------------------

-- ----------------------------
-- Table structure for `personal`
-- ----------------------------
DROP TABLE IF EXISTS `personal`;
CREATE TABLE `personal` (
  `dni_per` char(8) NOT NULL,
  `ape_per` varchar(30) DEFAULT NULL,
  `nom_per` varchar(30) DEFAULT NULL,
  `estado_per` varchar(15) DEFAULT '',
  `tipo_per` varchar(20) DEFAULT NULL,
  `clave_per` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`dni_per`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of personal
-- ----------------------------
INSERT INTO `personal` VALUES ('10101010', 'GENERAL', 'PERSOONAL', 'ACTIVO', 'ADMINISTRADOR', '123');
INSERT INTO `personal` VALUES ('75735300', 'RISCO', 'JHONATAN', 'ACTIVO', 'ADMINISTRADOR', 'Risco2003');

-- ----------------------------
-- Table structure for `producto`
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `id_pro` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pro` varchar(50) DEFAULT NULL,
  `sabores` varchar(20) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `id_uni` int(11) DEFAULT NULL,
  `pre_uni` float DEFAULT NULL,
  `stock_min` int(11) DEFAULT NULL,
  `stock_actual` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id_pro`) USING BTREE,
  KEY `pro_cat` (`id_cat`) USING BTREE,
  KEY `pro_uni` (`id_uni`),
  CONSTRAINT `pro_cat` FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id_cat`),
  CONSTRAINT `pro_uni` FOREIGN KEY (`id_uni`) REFERENCES `unidad_medida` (`id_uni`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES ('53', 'RELLENITAS', 'CHOCOLATE', '1', '1', '0.8', '10', '50', '0');

-- ----------------------------
-- Table structure for `unidad_medida`
-- ----------------------------
DROP TABLE IF EXISTS `unidad_medida`;
CREATE TABLE `unidad_medida` (
  `id_uni` int(11) NOT NULL,
  `tipo_uni` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_uni`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of unidad_medida
-- ----------------------------
INSERT INTO `unidad_medida` VALUES ('1', 'UNIDAD');

-- ----------------------------
-- Table structure for `venta`
-- ----------------------------
DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `fecha_venta` date DEFAULT NULL,
  `dni_cli` char(8) DEFAULT NULL,
  `dni_per` char(8) DEFAULT NULL,
  `id_deudor` int(11) DEFAULT NULL,
  `neto` float DEFAULT NULL,
  PRIMARY KEY (`id_venta`) USING BTREE,
  KEY `venta_per` (`dni_per`) USING BTREE,
  KEY `venta_cli` (`dni_cli`) USING BTREE,
  KEY `ven_deu` (`id_deudor`),
  CONSTRAINT `ven_cli` FOREIGN KEY (`dni_cli`) REFERENCES `cliente` (`dni_cli`),
  CONSTRAINT `ven_deu` FOREIGN KEY (`id_deudor`) REFERENCES `deudores` (`id_deudor`),
  CONSTRAINT `ven_per` FOREIGN KEY (`dni_per`) REFERENCES `personal` (`dni_per`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of venta
-- ----------------------------

-- ----------------------------
-- Procedure structure for `filtrar por categorias`
-- ----------------------------
DROP PROCEDURE IF EXISTS `filtrar por categorias`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `filtrar por categorias`()
BEGIN
	SELECT t1.*, t2.nom_cat, t3.tipo_uni
    FROM producto t1, categoria t2, unidad_medida t3
    WHERE t1.id_cat = 1 AND
    t1.estado=0 AND t1.id_cat=t2.id_cat AND t1.id_uni=t3.id_uni;

END
;;
DELIMITER ;
