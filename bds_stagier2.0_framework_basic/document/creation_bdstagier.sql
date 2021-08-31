--
-- Base de données: bdstagier
--
create database if not exists bdstagier default character set utf8 collate utf8_general_ci;
use bdstagier;
-- --------------------------------------------------------
-- Création des tables

set foreign_key_checks =0;

-- Table stagier
drop table if exists stagier;
create table stagier (
    sta_id int not null auto_increment primary key,
    sta_nom  varchar(100) not null,
    sta_prenom  varchar(100) not null,
    sta_ville  varchar(100) not null,
    sta_code  varchar(100) not null,
    sta_promo varchar(100) not null
)engine=innodb;
set foreign_key_checks =1;
