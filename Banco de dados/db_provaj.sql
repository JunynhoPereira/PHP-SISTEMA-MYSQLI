create database db_provaj;
use db_provaj;

create table estado (
idestado int(5) auto_increment not null primary key,
nomeestado varchar (50) not null);


create table cliente (
idcli int(5) auto_increment not null primary key,
nomecli varchar(100) not null,
endereco varchar(100) not null,
cidade varchar(100) not null,
estadoid int(5) not null,
constraint fk_estado_cli foreign key (estadoid) references estado (idestado));

