
CREATE TABLE `activiteconnexion` (
  `id_connexion` int(11) NOT NULL,
  `reussite` varchar(5) NOT NULL,
  `mdp_tente` varchar(32) NOT NULL,
  `log_tente` varchar(255) NOT NULL,
  `date_horaire_tent` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `adr_ip` varchar(32) NOT NULL
);


CREATE TABLE `activitemodule` (
  `id_activite` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `bool_utilisation` tinyint(1) NOT NULL DEFAULT 0
);



CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `mdp` varchar(255) NOT NULL CHECK (octet_length(`mdp`) > 31),
  `type_user` varchar(32) DEFAULT 'user' CHECK (`type_user` in ('admin','user','gestion')),
  `nb_visites` varchar(100) NOT NULL DEFAULT '0'
);

