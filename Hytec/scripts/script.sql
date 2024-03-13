DROP DATABASE IF EXISTS hytec;
CREATE DATABASE hytec CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use hytec;


CREATE TABLE cliente(
id INT(4) AUTO_INCREMENT PRIMARY KEY,
razaoSocial VARCHAR(50) NOT NULL,
nomeFantasia VARCHAR(50) NOT NULL,
dataFundacao Date NOT NULL,
cnpj VARCHAR(18) NOT NULL UNIQUE,
email VARCHAR(50) NOT NULL UNIQUE,
telefone VARCHAR(15) NOT NULL UNIQUE
);

CREATE TABLE endereco(
id INT(4) AUTO_INCREMENT PRIMARY KEY,
cep VARCHAR(9) NOT NULL,
logradouro VARCHAR(50),
bairro VARCHAR(30) NOT NULL,
estado VARCHAR(5) NOT NULL,
localidade VARCHAR(50) NOT NULL,
numero VARCHAR(10),
id_Cliente INT(4) NOT NULL,
FOREIGN KEY (id_Cliente) REFERENCES cliente(id)
);


CREATE TABLE evento(
id INT(4) AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(50) NOT NULL,
dataInicial DATETIME NOT NULL,
dataFinal DATETIME NOT NULL
);

CREATE TABLE fornecedor(
id INT(4) AUTO_INCREMENT PRIMARY KEY,
razaoSocial VARCHAR(100) NOT NULL,
cnpj VARCHAR(20) NOT NULL UNIQUE,
telefone VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE tecnico(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome VARCHAR(50) NOT NULL,
cpf VARCHAR(20) NOT NULL UNIQUE,
email VARCHAR(50) NOT NULL UNIQUE,
senha VARCHAR(50) NOT NULL
);

CREATE TABLE notaservico(
id INT NOT NULL,
ano YEAR NOT NULL,
id_Cliente INT NOT NULL,
dataNota DATE NOT NULL,
horario TIME NOT NULL,
id_Tecnico INT NOT NULL,
valorTotal DOUBLE NOT NULL,
observacoes VARCHAR(255), 
PRIMARY KEY (id,ano),
CONSTRAINT fk_Cliente_NotaServico FOREIGN KEY (id_Cliente) REFERENCES cliente(id),
CONSTRAINT fk_Tecnico_NotaServico FOREIGN KEY (id_Tecnico) REFERENCES tecnico(id)
);


CREATE TABLE peca(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome VARCHAR(50) NOT NULL,
quantidade INT NOT NULL,
precoUnitario DOUBLE NOT NULL,
id_Fornecedor INT NOT NULL,
CONSTRAINT fk_Fornecedor_Peca FOREIGN KEY (id_Fornecedor) REFERENCES fornecedor(id)
);


CREATE TABLE peca_notaservico(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
id_Peca INT NOT NULL,
id_Notaservico INT NOT NULL,
qtd INT NOT NULL,
CONSTRAINT fk_Peca_Peca_NotaServico FOREIGN KEY (id_Peca) REFERENCES peca(id),
CONSTRAINT fk_NotaServico_Peca_NotaServico FOREIGN KEY (id_Notaservico) REFERENCES notaservico(id)
);




CREATE TABLE usuario(
id INT(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
senha VARCHAR(50) NOT NULL
);


INSERT INTO usuario (nome,email,senha) VALUES ("Admin","admin@gmail.com","123456");

INSERT INTO tecnico (nome, cpf, email, senha) VALUES ('João Silva', '123.456.789-10', 'joao@example.com', 'senha123');
INSERT INTO tecnico (nome, cpf, email, senha) VALUES ('Maria Santos', '987.654.321-00', 'maria@example.com', 'senha456');
INSERT INTO tecnico (nome, cpf, email, senha) VALUES ('Pedro Oliveira', '111.222.333-44', 'pedro@example.com', 'senha789');
INSERT INTO tecnico (nome, cpf, email, senha) VALUES ('Ana Souza', '555.666.777-88', 'ana@example.com', 'senha101112');
INSERT INTO tecnico (nome, cpf, email, senha) VALUES ('Luiz Pereira', '999.888.777-66', 'luiz@example.com', 'senha131415');


INSERT INTO fornecedor (razaoSocial, cnpj, telefone) VALUES ('Peças Empilhadeira Ltda.', '12.345.678/9012-34', '(11) 1234-5678');
INSERT INTO fornecedor (razaoSocial, cnpj, telefone) VALUES ('Fornecedora de Peças e Componentes Ltda.', '98.765.432/1098-76', '(22) 2222-2222');
INSERT INTO fornecedor (razaoSocial, cnpj, telefone) VALUES ('Distribuidora de Peças para Empilhadeiras S.A.', '56.789.012/3456-78', '(33) 3333-3333');
INSERT INTO fornecedor (razaoSocial, cnpj, telefone) VALUES ('Peças Rápidas para Empilhadeiras EIRELI', '11.223.344/5566-77', '(44) 4444-4444');
INSERT INTO fornecedor (razaoSocial, cnpj, telefone) VALUES ('Comércio de Peças e Acessórios para Empilhadeiras Ltda.', '99.887.766/5544-33', '(55) 5555-5555');


INSERT INTO peca (nome, quantidade, precoUnitario, id_Fornecedor) VALUES ('Bateria', 10, 150.00, 1);
INSERT INTO peca (nome, quantidade, precoUnitario, id_Fornecedor) VALUES ('Pneu', 20, 75.00, 2);
INSERT INTO peca (nome, quantidade, precoUnitario, id_Fornecedor) VALUES ('Corrente', 15, 50.00, 3);
INSERT INTO peca (nome, quantidade, precoUnitario, id_Fornecedor) VALUES ('Rodas', 30, 100.00, 4);
INSERT INTO peca (nome, quantidade, precoUnitario, id_Fornecedor) VALUES ('Motor', 5, 500.00, 5);


INSERT INTO cliente (razaoSocial, nomeFantasia, dataFundacao, cnpj, email, telefone) VALUES ('Supermercado CompreBem Ltda.', 'CompreBem', '2010-01-15', '12345678901234', 'comprebem@example.com', '(11) 1234-5678');
INSERT INTO cliente (razaoSocial, nomeFantasia, dataFundacao, cnpj, email, telefone) VALUES ('Lojas Mega Center S.A.', 'Mega Center', '2005-05-20', '98765432109876', 'megacenter@example.com', '(22) 2222-2222');
INSERT INTO cliente (razaoSocial, nomeFantasia, dataFundacao, cnpj, email, telefone) VALUES ('Indústria e Comércio Carvalho Ltda.', 'Carvalho', '2012-11-10', '56789012345678', 'carvalho@example.com', '(33) 3333-3333');
INSERT INTO cliente (razaoSocial, nomeFantasia, dataFundacao, cnpj, email, telefone) VALUES ('Hospital São Lucas', 'São Lucas', '2000-06-25', '11223344556677', 'saolucas@example.com', '(44) 4444-4444');
INSERT INTO cliente (razaoSocial, nomeFantasia, dataFundacao, cnpj, email, telefone) VALUES ('Consultoria Empresarial Global S.A.', 'Global Consultoria', '2015-03-30', '99887766554433', 'globalconsultoria@example.com', '(55) 5555-5555');


INSERT INTO endereco (cep, logradouro, bairro, estado, localidade, numero, id_Cliente) VALUES ('12345-678', 'Rua A', 'Centro', 'SP', 'São Paulo', '100', 1);
INSERT INTO endereco (cep, logradouro, bairro, estado, localidade, numero, id_Cliente) VALUES ('98765-432', 'Avenida B', 'Jardim', 'RJ', 'Rio de Janeiro', '200', 2);
INSERT INTO endereco (cep, logradouro, bairro, estado, localidade, numero, id_Cliente) VALUES ('54321-876', 'Travessa C', 'Liberdade', 'MG', 'Belo Horizonte', '300', 3);
INSERT INTO endereco (cep, logradouro, bairro, estado, localidade, numero, id_Cliente) VALUES ('13579-246', 'Praça D', 'Centro', 'RS', 'Porto Alegre', '400', 4);
INSERT INTO endereco (cep, logradouro, bairro, estado, localidade, numero, id_Cliente) VALUES ('98765-432', 'Rua E', 'Itaim', 'SP', 'São Paulo', '500', 5);

INSERT INTO notaservico (id, ano, id_Cliente, dataNota, horario, id_Tecnico, valorTotal, observacoes) VALUES (1, 2024, 1, '2024-03-10', '09:00:00', 1, 500.00, 'Reparo de equipamento');
INSERT INTO notaservico (id, ano, id_Cliente, dataNota, horario, id_Tecnico, valorTotal, observacoes) VALUES (2, 2024, 2, '2024-03-11', '10:30:00', 2, 750.00, 'Manutenção preventiva');
INSERT INTO notaservico (id, ano, id_Cliente, dataNota, horario, id_Tecnico, valorTotal, observacoes) VALUES (3, 2024, 3, '2024-03-12', '14:00:00', 3, 600.00, 'Substituição de peças');
INSERT INTO notaservico (id, ano, id_Cliente, dataNota, horario, id_Tecnico, valorTotal, observacoes) VALUES (4, 2024, 4, '2024-03-13', '11:00:00', 4, 800.00, 'Inspeção técnica');
INSERT INTO notaservico (id, ano, id_Cliente, dataNota, horario, id_Tecnico, valorTotal, observacoes) VALUES (5, 2024, 5, '2024-03-14', '15:30:00', 5, 900.00, 'Revisão geral');

INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Conferência Anual', '2024-04-10 09:00:00', '2024-04-12 18:00:00');
INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Seminário de Tecnologia', '2024-05-15 10:30:00', '2024-05-16 16:00:00');
INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Feira de Negócios', '2024-06-20 08:00:00', '2024-06-22 20:00:00');
INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Workshop de Inovação', '2024-07-25 13:00:00', '2024-07-26 17:30:00');
INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Congresso de Educação', '2024-08-30 09:30:00', '2024-09-01 19:00:00');
INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Exposição de Arte', '2024-10-05 11:00:00', '2024-10-07 21:00:00');
INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Convenção de Saúde', '2024-11-10 08:45:00', '2024-11-12 17:15:00');
INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Festival de Música', '2024-12-15 16:30:00', '2024-12-17 23:00:00');
INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Feira de Livros', '2025-01-20 10:00:00', '2025-01-22 18:30:00');
INSERT INTO evento (nome, dataInicial, dataFinal) VALUES ('Encontro de Gastronomia', '2025-02-25 12:15:00', '2025-02-26 15:45:00');


