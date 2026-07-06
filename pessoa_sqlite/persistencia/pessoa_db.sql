CREATE TABLE estado ( 
	id                   INTEGER NOT NULL  PRIMARY KEY AUTOINCREMENT ,
	nome                 TEXT NOT NULL    ,
	sigla                TEXT NOT NULL    
 );

CREATE TABLE cidade ( 
	id                   INTEGER NOT NULL  PRIMARY KEY AUTOINCREMENT ,
	nome                 TEXT NOT NULL    ,
	estado_id            INTEGER NOT NULL    ,
	FOREIGN KEY ( estado_id ) REFERENCES estado( id )  
 );

CREATE TABLE pessoa ( 
	id                   INTEGER NOT NULL  PRIMARY KEY AUTOINCREMENT ,
	nome                 TEXT     ,
	idade                INTEGER     ,
	peso                 FLOAT(8,2)     ,
	altura               FLOAT(8,2)     ,
	cidade_id            INTEGER     ,
	FOREIGN KEY ( cidade_id ) REFERENCES cidade( id )  
 );

CREATE TABLE livro (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    descricao TEXT
);

CREATE TABLE emprestimo_livro ( 
	id                   INTEGER NOT NULL  PRIMARY KEY AUTOINCREMENT ,
	pessoa_id            INTEGER NOT NULL    ,
	livro_id             INTEGER NOT NULL    ,
	prazo                DATE     ,
	data_emprestimo             DATE     ,
	FOREIGN KEY ( livro_id ) REFERENCES livro( id )  ,
	FOREIGN KEY ( pessoa_id ) REFERENCES pessoa( id )  
);