

CREATE TABLE `activiteconnexion` (
  `id_connexion` int(11) NOT NULL,
  `reussite` varchar(5) NOT NULL DEFAULT 'False',
  `mdp_tente` varchar(32) NOT NULL,
  `login` varchar(255) NOT NULL,
  `date_horaire_tent` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `adr_ip` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `activitemodule` (
  `id_activite` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `login` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `historique_module2` (
  `id_historique` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `bool_chiffrement` tinyint(1) NOT NULL DEFAULT 0,
  `bool_dechiffrement` tinyint(1) NOT NULL DEFAULT 0,
  `message` varchar(255) NOT NULL,
  `cle` varchar(255) NOT NULL,
  `resultat` varchar(255) NOT NULL,
  `bool_rc4` tinyint(1) NOT NULL DEFAULT 0,
  `bool_wpe` tinyint(1) NOT NULL DEFAULT 0

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `mdp` varchar(255) NOT NULL CHECK (octet_length(`mdp`) > 31),
  `type_user` varchar(32) DEFAULT 'user' CHECK (`type_user` in ('admin','user','gestion')),
  `nb_visites` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `activiteconnexion`
  ADD PRIMARY KEY (`id_connexion`);


ALTER TABLE `activitemodule`
  ADD PRIMARY KEY (`id_activite`);


ALTER TABLE `historique_module2`
  ADD PRIMARY KEY (`id_historique`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);


ALTER TABLE `activiteconnexion`
  MODIFY `id_connexion` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `activitemodule`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `historique_module2`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

