create user 'condolo'@'localhost' identified by '1234';
create database curriculo;
grant all privileges on curriculo.* to 'condolo';

use curriculo;

create table if not exists dados (
	id int auto_increment primary key,
    nome varchar(255) not null,
    nome_apr varchar(255) not null,
    descricao varchar(2000),
    data_nasc date not null,
    idade int(3) not null,
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

insert into dados values(default,'Derick Condolo Lima','Derick Condolo','Estudante em busca do primeiro emprego.','2009-01-08','17',null,null);
select * from dados;
truncate table dados;
drop table dados;

insert into contatos values (default,1,'condoloderick@gmail.com','(11) 95117-6832','Rua Eucalipto, 700 - Jardim Ipê, Mauá - SP');
select * from contatos;
truncate table contatos;
drop table contatos;

insert into experiencias values (default,1,null,null,null,null);
truncate table experiencias;
drop table experiencias;

insert into formacao values(default,1,'Ensino Médio','E.E. Profº Antonio Lapate Netto','Cursando',null,'Jan/2020','Dez/2026');
insert into formacao values (default,1,'Ensino Técnico','SENAI Armando de Arruda Pereira','Cursando','Desenvolvimento de Sistemas','Jul/2025','Jun/2027');
truncate table formacao;
drop table formacao;