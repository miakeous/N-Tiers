create schema archi;
use archi;

create table evenement(
  idEvent   INT NOT NULL AUTO_INCREMENT,
  NOM VARCHAR(255) NOT NULL,
  date VARCHAR(255),
  adress VARCHAR(255),
  PRIMARY KEY (idEvent)
);

create table personne(
   ID   INT NOT NULL AUTO_INCREMENT,
   NOM VARCHAR(255) NOT NULL,
   PRENOM VARCHAR(255),
	uid VARCHAR(255) NOT NULL,
   EMAIL VARCHAR(255) NOT NULL,
   DATEN VARCHAR(255),
    PRIMARY KEY (ID)
    );
create table liaison(
    ID   INT NOT NULL AUTO_INCREMENT,
    idEvent int,
    idPersonne int,
    quantite int,
    primary key(ID)
    );

drop table personne;
drop table liaison ;    
drop table personne;
//add me for ldap connection
insert into archi.personne (NOM,PRENOM,uid,EMAIL,DATEN) values ("tardiveau","pierre","pierre.tardiveau","pierre.tardiveau@yahoo.fr","14/02/1995");
