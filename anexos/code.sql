SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `encurtador`;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `encurtador` (
    `id` INTEGER(11) NOT NULL,
    `codigo` VARCHAR(6) NOT NULL,
    `titulo_codigo` VARCHAR(255) NOT NULL,
    `desc_codigo` TEXT NOT NULL,
    `url` TEXT NOT NULL,
    `acessos` INTEGER(11) NOT NULL,
    `created` DATETIME NOT NULL,
    `modified` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`id`, `codigo`)
);
