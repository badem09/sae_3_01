create table users(
    id_user int primary key auto_increment,
	
    login varchar(32) not null unique,
    mdp varchar(255) not null check(length(mdp)>31),
    type_user varchar(32) default 'user' check (type_user in ('admin','user','gestion'))
);

create table activiteModule(
	id_activite int primary key auto_increment,
	
	id_module int not null,
    login varchar(32) not null unique,
    date_horaire_utilis timestamp not null
);

create table activiteConnexion(
    id_connexion int primary key auto_increment,
	
    login varchar(32) unique,
    reussite varchar(5) not null check(reussite in ('true','false')),
    mdp_tente varchar(32) not null,
    log_tente varchar(255) not null,
    date_horaire_tent timestamp not null,
    adr_ip varchar not null
);