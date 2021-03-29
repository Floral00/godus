create table user (
		USER_ID 		bigint 			not null auto_increment primary key,
        MAIL 	varchar(255)	not null unique,
        LOGIN 	varchar(255) 	not null unique,
        MDP 		varchar(255) 	not null,
        PRENOM	varchar(255)	not null,
        NOM		varchar(255) 	not null,
        TEL		varchar(255)	not null,
        ADMIN		boolean		not null,
        ADRESSE varchar(255) not null,	
        DH_CREATION	date
);

create table oeuvre (
		OEUVRE_ID		bigint not null auto_increment primary key,
        OEUVRE_TYPE 	varchar(255) not null,
        OEUVRE_PRIX		bigint not null,
        OEUVRE_AUTEUR	varchar(255) not null,
        OEUVRE_TAILLE	varchar(255) not null
);

create table commande (
		COM_ID 	bigint not null auto_increment primary key,
        USER_ID		bigint not null, 
        COM_ADRESSE varchar(255) not null,
        COM_LIVRAISON varchar(255) not null,
        COM_PAIEMENT varchar(255) not null,
       COM_TYPE_LIVRAISON varchar(255) not null
)
;

create table oeuvre_commande (
		OECOM_ID	bigint not null auto_increment primary key,
        OECOM_PRIX 	bigint not null,
        OECOM_DIM_IMPR varchar(255) not null,
        OECOM_TYP_IMPR varchar(255) not null,
        COM_ID bigint not null
        
);