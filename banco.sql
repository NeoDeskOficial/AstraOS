CREATE TABLE cargos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome_cargo VARCHAR(100) NOT NULL,

    salario_padrao DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    salario_base DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    teto_salarial DECIMAL(10,2) NOT NULL DEFAULT 0.00,

    situacao ENUM('ativo','inativo') DEFAULT 'ativo',

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO cargos
(nome_cargo,salario_padrao,salario_base,teto_salarial)
VALUES

('CEO/Técnico',0.00,0.00,0.00),

('Técnico',0.00,0.00,0.00),

('Recepcionista',0.00,0.00,0.00);

CREATE TABLE permissoes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100) NOT NULL,

    descricao TEXT,

    situacao ENUM('ativo','inativo') DEFAULT 'ativo',

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO permissoes
(nome,descricao)
VALUES

('Administrador Master','Acesso total ao AstraOS'),

('Administrador','Gerenciamento completo'),

('Gerente','Gerenciamento de setores'),

('Financeiro','Controle financeiro'),

('Comercial','CRM'),

('Suporte','Help Desk'),

('Técnico','Ordens de Serviço'),

('Recepção','Atendimento'),

('Cliente','Portal do Cliente');

CREATE TABLE funcionarios (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(150) NOT NULL,

    cpf VARCHAR(20) UNIQUE,

    rg VARCHAR(30),

    telefone VARCHAR(20),

    celular VARCHAR(20),

    cargo_id INT NOT NULL,

    salario DECIMAL(10,2) DEFAULT 0.00,

    email VARCHAR(150) UNIQUE NOT NULL,

    senha VARCHAR(255) NOT NULL,

    permissao_id INT NOT NULL,

    expira_em DATE,

    situacao ENUM(
        'ativo',
        'inativo',
        'bloqueado',
        'desligado'
    ) DEFAULT 'ativo',

    acesso_sistema ENUM(
        'sim',
        'nao'
    ) DEFAULT 'sim',

    data_contratacao DATE,

    cep VARCHAR(10),

    rua VARCHAR(150),

    numero VARCHAR(20),

    complemento VARCHAR(100),

    bairro VARCHAR(100),

    cidade VARCHAR(100),

    estado CHAR(2),

    ultimo_login DATETIME,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_funcionario_cargo
        FOREIGN KEY (cargo_id)
        REFERENCES cargos(id),

    CONSTRAINT fk_funcionario_permissao
        FOREIGN KEY (permissao_id)
        REFERENCES permissoes(id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO funcionarios (

nome,
cargo_id,
salario,
email,
senha,
permissao_id,
situacao,
acesso_sistema,
data_contratacao

)

VALUES (

'Ian',

1,

0.00,

'ian.maralhas@neodeskinformatica.com.br',

'$2a$10$4NZE0Ev2tFJAMpobswEhAu73MS6jQfUWCYfQMZ6y1bxvzHLZOAYbS',

1,

'ativo',

'sim',

CURDATE()

);