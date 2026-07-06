
CREATE TABLE estado (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nome                 TEXT NOT NULL,
    sigla                TEXT NOT NULL
);

CREATE TABLE cidade (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nome                 TEXT NOT NULL,
    estado_id            INTEGER NOT NULL,
    FOREIGN KEY ( estado_id ) REFERENCES estado ( id )
);

CREATE TABLE pessoa (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nome                 TEXT NOT NULL,
    cidade_id            INTEGER,
    peso                 FLOAT(8,2),
    altura               FLOAT(8,2),
    FOREIGN KEY ( cidade_id ) REFERENCES cidade ( id )
);

CREATE TABLE livro (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nome                 TEXT NOT NULL,
    autor                TEXT,
    genero               TEXT,
    descricao            TEXT
);

CREATE TABLE pessoa_livro (
    id                   INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    pessoa_id            INTEGER NOT NULL,
    livro_id             INTEGER NOT NULL,
    data_emprestimo      DATE,
    prazo                DATE,
    FOREIGN KEY ( pessoa_id ) REFERENCES pessoa ( id ),
    FOREIGN KEY ( livro_id )  REFERENCES livro ( id )
);
