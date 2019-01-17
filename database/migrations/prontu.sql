-- -----------------------------------------------------
-- Schema prontuario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prontuario` DEFAULT CHARACTER SET utf8 ;
USE `prontuario` ;

-- -----------------------------------------------------
-- Table `prontuario`.`tb_linha_teorica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prontuario`.`tb_linha_teorica` (
  `id_linha_teorica` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tx_nome` VARCHAR(70) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `tx_desc` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `status` ENUM('A', 'I') COLLATE 'utf8mb4_unicode_ci' NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_linha_teorica`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `prontuario`.`tb_supervisor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prontuario`.`tb_supervisor` (
  `id_supervisor` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tx_nome` VARCHAR(100) NOT NULL,
  `nu_matricula` VARCHAR(15) NOT NULL,
  `nu_crp` VARCHAR(7) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `nu_telefone` VARCHAR(15) NULL,
  `nu_celular` VARCHAR(15) NULL,
  `tx_email` VARCHAR(100) NOT NULL,
  `id_linha_teorica` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_supervisor`),
  INDEX `tb_supervisor_id_linha_teorica_foreign` (`id_linha_teorica` ASC),
  CONSTRAINT `tb_supervisor_id_linha_teorica_foreign`
    FOREIGN KEY (`id_linha_teorica`)
    REFERENCES `prontuario`.`tb_linha_teorica` (`id_linha_teorica`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `prontuario`.`tb_aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prontuario`.`tb_aluno` (
  `id_aluno` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tx_nome` VARCHAR(100) NOT NULL,
  `nu_semestre` VARCHAR(2) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `nu_matricula` VARCHAR(15) NOT NULL,
  `nu_telefone` VARCHAR(15) NULL,
  `nu_celular` VARCHAR(15) NULL,
  `tx_email` VARCHAR(100) NOT NULL,
  `id_supervisor` INT(10) NOT NULL,
  PRIMARY KEY (`id_aluno`),
  INDEX `tb_aluno_id_supervisor_foreign` (`id_supervisor` ASC),
  CONSTRAINT `tb_aluno_id_supervisor_foreign`
    FOREIGN KEY (`id_supervisor`)
    REFERENCES `prontuario`.`tb_supervisor` (`id_supervisor`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `prontuario`.`tb_acesso_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prontuario`.`tb_acesso_usuario` (
  `id_acesso_usuario` INT NOT NULL AUTO_INCREMENT,
  `nu_matricula` VARCHAR(100) NULL,
  `status` ENUM('A', 'I') NOT NULL DEFAULT 'A',
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_acesso_usuario`))
ENGINE = InnoDB;
