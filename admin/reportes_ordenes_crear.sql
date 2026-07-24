-- MySQL database export
START TRANSACTION;

CREATE TABLE IF NOT EXISTS `mecanicos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_mecanico` INT NOT NULL,
    `nombre` VARCHAR(255) NOT NULL,
    `eliminado` INT NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `orden` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_autobus` INT NOT NULL,
    `id_razon` INT NOT NULL,
    `id_supervisor` INT NOT NULL,
    `fecha_apertura` DATETIME NOT NULL,
    `fecha_liberacion` DATETIME,
    `fecha_cierre` DATETIME,
    `estado` INT NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `empresa` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(255) NOT NULL UNIQUE,
    `eliminado` INT NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `supervisor_razon` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_supervisor` INT NOT NULL,
    `id_razon` INT NOT NULL,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `catalogo_razones` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `descripcion` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `supervisor` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_supervisor` INT NOT NULL,
    `supervisor` VARCHAR(255) NOT NULL,
    `chat_id` VARCHAR(20) NOT NULL,
    `eliminado` INT NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `autobus` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `unidad` VARCHAR(500) NOT NULL UNIQUE,
    `id_empresa` INT NOT NULL,
    `eliminado` INT NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `reparacion` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_orden` INT NOT NULL,
    `id_mecanico` INT,
    `descripcion` VARCHAR(255) NOT NULL,
    `fecha_inicio` DATETIME,
    `fecha_fin` DATETIME,
    `estado` INT NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `reparacion_historial` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_reparacion` INT NOT NULL,
    `id_mecanico` INT NOT NULL,
    `fecha_inicio` DATETIME NOT NULL,
    `fecha_fin` DATETIME,
    `estado` INT NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`)
);


-- Foreign key constraints
ALTER TABLE `orden` ADD CONSTRAINT `fk_orden_id_autobus` FOREIGN KEY(`id_autobus`) REFERENCES `autobus`(`id`);
ALTER TABLE `supervisor_razon` ADD CONSTRAINT `fk_supervisor_razon_id_razon` FOREIGN KEY(`id_razon`) REFERENCES `catalogo_razones`(`id`);
ALTER TABLE `orden` ADD CONSTRAINT `fk_orden_id_razon` FOREIGN KEY(`id_razon`) REFERENCES `catalogo_razones`(`id`);
ALTER TABLE `autobus` ADD CONSTRAINT `fk_autobus_id_empresa` FOREIGN KEY(`id_empresa`) REFERENCES `empresa`(`id`);
ALTER TABLE `reparacion` ADD CONSTRAINT `fk_reparacion_id_mecanico` FOREIGN KEY(`id_mecanico`) REFERENCES `mecanicos`(`id`);
ALTER TABLE `reparacion` ADD CONSTRAINT `fk_reparacion_id_orden` FOREIGN KEY(`id_orden`) REFERENCES `orden`(`id`);
ALTER TABLE `orden` ADD CONSTRAINT `fk_orden_id_supervisor` FOREIGN KEY(`id_supervisor`) REFERENCES `supervisor`(`id`);
ALTER TABLE `supervisor_razon` ADD CONSTRAINT `fk_supervisor_razon_id_supervisor` FOREIGN KEY(`id_supervisor`) REFERENCES `supervisor`(`id`);
ALTER TABLE `reparacion_historial` ADD CONSTRAINT `fk_reparacion_historial_id_reparacion` FOREIGN KEY(`id_reparacion`) REFERENCES `reparacion`(`id`);
ALTER TABLE `reparacion_historial` ADD CONSTRAINT `fk_reparacion_historial_id_mecanico` FOREIGN KEY(`id_mecanico`) REFERENCES `mecanicos`(`id`);

COMMIT;
