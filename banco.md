CREATE TABLE usuarios(
codigo int(4) AUTO_INCREMENT,
nome varchar(30) NOT NULL,
email varchar(50),
PRIMARY KEY (codigo)
);

CREATE TABLE `alt_teste`.`usuarios` (`id` INT NOT NULL AUTO_INCREMENT , `nome` VARCHAR(45) NOT NULL , `cpf` VARCHAR(11) NOT NULL , `telefone` INT(11) NOT NULL , `email` INT(45) NOT NULL , `dt_nasc` DATE NOT NULL , `funcao` VARCHAR(45) NOT NULL ,  PRIMARY KEY (`id`)) ENGINE = InnoDB;
