CREATE TABLE anunciante (
    codigo int NOT NULL auto_increment,
    nome varchar(50),
    cpf varchar(14),
    email varchar(50),
    senha_hash varchar(255),
    telefone varchar(20),
    PRIMARY KEY (codigo)
) Engine=InnoDB;

CREATE TABLE categoria (
    codigo int NOT NULL auto_increment,
    nome varchar(50),
    descricao varchar(255),
    PRIMARY KEY (codigo)
) Engine=InnoDB;

CREATE TABLE anuncio (
    codigo int NOT NULL auto_increment,
    titulo varchar(30),
    descricao varchar(255),
    preco float,
    data_hora datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    cep varchar(9),
    bairro varchar(50),
    cidade varchar(50),
    estado varchar(2),
    codigo_categoria int,
    codigo_anunciante int,
    FOREIGN KEY (codigo_categoria) REFERENCES categoria (codigo),
    FOREIGN KEY (codigo_anunciante) REFERENCES anunciante (codigo),
    PRIMARY KEY (codigo)
) Engine=InnoDB;

CREATE TABLE interesse (
    codigo int NOT NULL auto_increment,
    mensagem varchar(50),
    data_hora datetime,
    contato varchar(50),
    codigo_anuncio int,
    FOREIGN KEY (codigo_anuncio) REFERENCES anuncio (codigo),
    PRIMARY KEY (codigo)
) Engine=InnoDB;

CREATE TABLE foto (
    codigo_anuncio int NOT NULL,
    arquivo_foto varchar(255),
    FOREIGN KEY (codigo_anuncio) REFERENCES anuncio (codigo)
) Engine=InnoDB;

CREATE TABLE enderecos_ajax (
    cep varchar(9),
    bairro varchar(50),
    cidade varchar(50),
    estado varchar(2),
) Engine=InnoDB;