CREATE TABLE `activiteconnexion` (
  `id_connexion` int(11) NOT NULL PRIMARY KEY,
  `mdp_tente` varchar(32) NOT NULL,
  `login` varchar(255) NOT NULL,
  `date_horaire_tent` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `adr_ip` varchar(32) NOT NULL
);

CREATE TABLE `activitemodule` (
  `id_activite` int(11) NOT NULL PRIMARY KEY,
  `id_module` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `date_util` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

CREATE TABLE `historique_module1` (
  `id_historique` int(11) NOT NULL PRIMARY KEY,
  `login` varchar(255) NOT NULL,
  `methode` varchar(255) NOT NULL,
  `esperance` int(255) NOT NULL,
  `ecart_type` int(255) NOT NULL,
  `t` int(255) NOT NULL,
  `res` float(6,5) NOT NULL
);

CREATE TABLE `historique_module2` (
  `id_historique` int(11) NOT NULL PRIMARY KEY PRIMARY KEY,
  `login` varchar(255) NOT NULL,
  `bool_chiffrement` tinyint(1) NOT NULL DEFAULT 0,
  `bool_dechiffrement` tinyint(1) NOT NULL DEFAULT 0,
  `message` varchar(255) NOT NULL,
  `cle` varchar(255) NOT NULL,
  `resultat` varchar(255) NOT NULL,
  `bool_rc4` tinyint(1) NOT NULL DEFAULT 0,
  `bool_wpe` tinyint(1) NOT NULL DEFAULT 0
);

CREATE TABLE `historique_module3`(
  `id` INT NULL PRIMARY KEY AUTO_INCREMENT,
  `login` VARCHAR(32) NOT NULL ,
  `date` DATE DEFAULT CURRENT_TIMESTAMP,
  `phrase` TEXT
);

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `mdp` varchar(255) NOT NULL CHECK (octet_length(`mdp`) > 31),
  `type_user` varchar(32) DEFAULT 'user' CHECK (`type_user` in ('admin','user','gestion')),
  `nb_visites` varchar(100) NOT NULL DEFAULT '0'
);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`);

ALTER TABLE `activiteconnexion`
  MODIFY `id_connexion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `activitemodule`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `historique_module1`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `historique_module2`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE historique_module3
    MODIFY AUTO_INCREMENT = 1;
    
INSERT INTO `users` values(1,'admin','21232f297a57a5a743894a0e4a801fc3','admin',0);

COMMIT;
