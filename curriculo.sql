use curriculo;

create table if not exists dados (
	id int auto_increment primary key,
    nome varchar(255) not null,
    descricao varchar(2000),
    data_nasc date not null,
    cargo varchar(100),
    foto varchar(1000)
);

create table if not exists contatos(
	id int auto_increment primary key,
    uid int not null,
    email varchar(255) not null,
    telefone varchar(15) not null,
    endereco varchar(255),
    constraint fk_user foreign key (uid) references dados(id)
);

create table if not exists experiencias (
	id_experiencia int auto_increment primary key,
    uid int not null,
	empresa varchar (255),
    cargo_empresa varchar(255),
    data_admissao date,
    data_demissao date,
    constraint fk_experiencias foreign key (uid) references dados(id)
);

create table if not exists formacao(
	id int auto_increment primary key,
    uid int not null,
	grau_escolaridade varchar(100) not null,
    unidade_ensino varchar(255) not null,
    situacao varchar(20) not null,
    tipo_curso varchar(100),
    data_entrada varchar(8) not null,
    data_conclusao varchar(8) not null,
    constraint fk_formacao foreign key (uid) references dados(id)
);

insert into dados values(default,'Derick Condolo Lima','vai cortinas','2009-01-08',null,null);
select * from dados;

insert into contatos values (default,1,'condoloderick@gmail.com','(11) 95117-6832','Rua Eucalipto, 700 - Jardim Ipê, Mauá - SP');
select * from contatos;
drop table contatos;

insert into experiencias values (default,1,null,null,null,null);
select * from experiencias;
drop table experiencias;
truncate table experiencias;

insert into formacao values(default,1,'Ensino Médio','E.E. Profº Antonio Lapate Netto','Cursando',null,'Jan/2020','Dez/2026');
insert into formacao values (default,1,'Ensino Técnico','SENAI Armando de Arruda Pereira','Cursando','Desenvolvimento de Sistemas','Jul/2025','Jul/2027');
select * from formacao;
drop table formacao;