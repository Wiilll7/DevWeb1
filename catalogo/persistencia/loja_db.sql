
CREATE TABLE produto (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nome                 TEXT NOT NULL,
    categoria            TEXT,
    descricao            TEXT,
    preco                FLOAT(10,2) NOT NULL,
    imagem               TEXT
);

CREATE TABLE avaliacao_produto (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    produto_id           INTEGER NOT NULL,
    nome_usuario         TEXT NOT NULL,
    nota                 INTEGER NOT NULL,
    comentario           TEXT,
    data_avaliacao       DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY ( produto_id ) REFERENCES produto ( id )
);

CREATE TABLE duvida_produto (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    produto_id           INTEGER NOT NULL,
    nome_usuario         TEXT NOT NULL,
    pergunta             TEXT NOT NULL,
    resposta             TEXT,
    data_duvida          DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY ( produto_id ) REFERENCES produto ( id )
);

CREATE TABLE artigo (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    titulo               TEXT NOT NULL,
    resumo               TEXT,
    conteudo             TEXT NOT NULL,
    imagem               TEXT,
    data_publicacao      DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comentario_artigo (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    artigo_id            INTEGER NOT NULL,
    nome_usuario         TEXT NOT NULL,
    comentario           TEXT NOT NULL,
    data_comentario      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY ( artigo_id ) REFERENCES artigo ( id )
);

-- dados iniciais para a loja nao iniciar vazia

INSERT INTO produto (nome, categoria, descricao, preco, imagem) VALUES
('Fone de Ouvido Bluetooth', 'Eletrônicos', 'Fone sem fio com cancelamento de ruído e 30h de bateria.', 189.90, ''),
('Camiseta Básica Algodão', 'Vestuário', 'Camiseta 100% algodão, corte reto, diversas cores.', 49.90, ''),
('Garrafa Térmica 1L', 'Casa', 'Mantém a temperatura por até 12 horas. Aço inoxidável.', 79.90, ''),
('Teclado Mecânico RGB', 'Eletrônicos', 'Teclado mecânico com switches azuis e iluminação RGB.', 259.00, ''),
('Tênis Casual Confort', 'Calçados', 'Tênis leve para uso diário, solado em EVA.', 219.90, '');

INSERT INTO artigo (titulo, resumo, conteudo, imagem) VALUES
('Como escolher o fone de ouvido ideal', 'Guia rápido para acertar na escolha do seu próximo fone.', 'Na hora de escolher um fone de ouvido, é importante considerar fatores como autonomia da bateria, conforto, qualidade do som e se o modelo possui cancelamento de ruído. Fones intra-auriculares são mais portáteis, enquanto os over-ear costumam entregar mais conforto em uso prolongado.

Outro ponto relevante é a conectividade: modelos Bluetooth mais recentes oferecem menor latência e maior estabilidade de conexão, o que é essencial para quem assiste vídeos ou joga.', ''),
('Tendências de moda para esta estação', 'As principais apostas do momento no vestuário.', 'As peças básicas e atemporais seguem em alta, combinadas com acessórios que dão personalidade ao look. Cores neutras aliadas a um item de destaque são a fórmula preferida de quem busca versatilidade no dia a dia.

Investir em tecidos de qualidade também é uma tendência crescente, já que aumenta a durabilidade das peças e reduz o impacto ambiental do consumo.', '');
