
drop table activiteConnexion;
drop table activiteModule;
drop table users;

  -- A ignorer pour l'instant :
    -- Contraintes sur type user : soit normal soit admin soit gestionnaire
    -- Contrainte : 1 seul admine, 1 seul gestionnaire :
        ---add constraint admin_gestion_unique check ( 
    -- type_user = 'admin' and 'admin' not in select 
    --)

create table users(

    id_user int ,
    login char(20) unique,
    mdp char(255) unique not null check(length(mdp)>32),
    type_user char(20) default 'user' check (type_user in ('admin','user','gestion')) ,
    primary key(id_user,login)

);



create table activiteModule(

    login char(20) unique,
    id_module int not null,
    date_debut date not null,
    date_fin date not null,
    primary key(login,date_debut,date_fin),
    FOREIGN KEY(login) references users(login)
);

create table activiteConnexion(

    id_connexion int primary key,
    login char(20) unique,
    reussite char not null check(reussite in ('true','false')) ,
    mdp_tente char not null,
    date_debut date not null,
    date_fin date not null,
    adr_ip char not null,
    FOREIGN KEY(login) references users(login)

);
