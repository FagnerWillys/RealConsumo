drop DATABASE  realconsumo;

create DATABASE  realconsumo;

USE realconsumo;

CREATE TABLE clientes (
  CNPJ bigint(14) NOT NULL,
  Email varchar(100) NOT NULL,
  DataReg date NOT NULL,
  PRIMARY KEY (CNPJ)
); 

CREATE TABLE endereco (
  CNPJ bigint(14) NOT NULL,
  CEP int(8) NOT NULL,
  N_Predio int(11) NOT NULL,
  Complemento varchar(50) DEFAULT NULL,
  Endereco varchar(50) DEFAULT NULL,
  Bairro varchar(50) NOT NULL,
  Municipio varchar(50) NOT NULL,
  UF varchar(2) NOT NULL,
  PRIMARY KEY (CEP, CNPJ)
);


CREATE TABLE login(
  LOGIN varchar(32) NOT NULL,
  SENHA varchar(32) NOT NULL,
  p_status boolean NOT NULL,
  PRIMARY KEY (LOGIN, SENHA)
);

CREATE TABLE conta(
DATACONTA DATE NOT NULL,
CNPJ BIGINT(14) NOT NULL,
CEP int(8) NOT NULL,
LANT INT(10) NOT NULL,
LATU INT(10) NOT NULL,
tpResidencia ENUM('Comercial','Residencial','Misto') not null,
Tarifa decimal(10,3) not null,
Economias decimal(10,3) not null,
V_AGUA decimal(10,3) not null,
RECURSO_HIDROM decimal(10,3) not null,
TX_ANUAL decimal(10,3) not null,
V_ESGOTO decimal(10,3) not null,
ValorConta decimal(10,3) not null,
primary key(DATACONTA, CNPJ, CEP)
);

ALTER TABLE endereco ADD CONSTRAINT CNPJ_constraint
FOREIGN KEY(CNPJ) REFERENCES realconsumo.clientes(CNPJ)
on delete cascade on update cascade;

ALTER TABLE conta ADD CONSTRAINT CNPJ_constraint1
FOREIGN KEY(CNPJ) REFERENCES realconsumo.clientes(CNPJ)
on delete cascade on update cascade;

ALTER TABLE conta ADD CONSTRAINT CEP_constraint2
FOREIGN KEY(CEP) REFERENCES realconsumo.endereco(CEP)
on delete cascade on update cascade;


INSERT INTO login (LOGIN, SENHA, p_status) VALUES 
(MD5('FagnerWillys'), MD5('290197'),true),
(MD5('Katia'), MD5('1234'),true);
