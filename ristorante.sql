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
  `numeroCoperti` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  foreign key (numeroTavolo) references tavoli(numero)
);

insert into ordini values (1, 1, '2020-01-01 12:00:00', 4);

CREATE TABLE `prodotti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `prezzo` decimal(10,2) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

insert into prodotti values (1, 'Spaghetti al pomodoro', 7.50, 'Primo');
insert into prodotti values (2, 'Spaghetti alla carbonara', 8.50, 'Primo');
insert into prodotti values (3, 'Pizza Margherita', 6.50, 'Secondo');


CREATE TABLE `righeOrdine` (
  `idOrdine` int(11) NOT NULL,
  `idProdotto` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  `modifiche` varchar(255) NOT NULL,
  PRIMARY KEY (`idOrdine`, `idProdotto`),
  foreign key (idOrdine) references ordini(id),
  foreign key (idProdotto) references prodotti(id)
);

insert into righeOrdine values (1, 1, 2, 'senza aglio');
insert into righeOrdine values (1, 3, 1, '');
