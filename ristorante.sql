DROP DATABASE IF EXISTS ristorante;
CREATE DATABASE ristorante;

USE ristorante;

CREATE TABLE `tavoli` (
  `numero` int(11),
  `nome` varchar(255) NOT NULL,
  `numeroPosti` int(11) NOT NULL,
  PRIMARY KEY (`numero`)
);

insert into tavoli values (1, 'Tavolo 1', 4);
insert into tavoli values (2, 'Tavolo 2', 4);
insert into tavoli values (3, 'Tavolo 3', 4); 

CREATE TABLE `ordini` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numeroTavolo` int(11) NOT NULL,
  `dataOra` timestamp NOT NULL DEFAULT NOW(),
  `numeroCoperti` int(11) NOT NULL DEFAULT(0),
  PRIMARY KEY (`id`),
  foreign key (numeroTavolo) references tavoli(numero)
);

