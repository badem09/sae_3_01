create table users(
    id_user int primary key,
	
    login char(32) not null unique,
    mdp char(255) not null check(length(mdp)>32),
    type_user char(32) default 'user' check (type_user in ('admin','user','gestion')),
);

create table activiteModule(
	id_activite int primary key,
	
	id_module int not null,
    login char(32) not null unique,
    date_debut date not null,
    date_fin date not null,
    FOREIGN KEY(login) references users(login)
);

create table activiteConnexion(
    id_connexion int primary key,
	
    login char(32) unique,
    reussite char not null check(reussite in ('true','false')),
    mdp_tente char not null,
    date_debut date not null,
    date_fin date not null,
    adr_ip char not null,
    FOREIGN KEY(login) references users(login)
);
