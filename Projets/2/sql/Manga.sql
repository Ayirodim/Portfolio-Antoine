
DROP TABLE IF EXISTS `Manga`;

CREATE TABLE IF NOT EXISTS `Manga` (
  `idM` int(255)  PRIMARY KEY NOT NULL ,
  `nom` varchar(100) NOT NULL,
  `date_sortie` date NOT NULL, 
  `auteur` varchar(100) NOT NULL,
  `theme` varchar(100) NOT NULL,
  `histoire` varchar(10000) NOT NULL
);




INSERT INTO `Manga` (`idM`, `nom`, `date_sortie`, `theme`, `auteur`, `histoire`) VALUES
(1, 'Onepiece', '1997-12-24','Shonen','Eiichirō Oda',"Dans One Piece, nous suivons l histoire d'un jeune pirate, Monkey D. Luffy, dont le rêve est de prendre la mer pour devenir le Seigneur des pirates. Lui et son équipage de pirates voguent sur les océans à la recherche du trésor le plus convoité de l histoire de la piraterie : le One Piece."),
(2, 'Naruto', '2000-03-03','Shonen','Masashi Kishimoto',"Dans l univers de la série, Naruto est un jeune ninja du village de Konoha. Hôte du démon renard à neuf queues, une créature qui a attaqué le village par le passé, il est rejeté par les autres villageois. Son ambition est de devenir Hokage, le chef du village, afin de gagner le respect des habitants."),
(3, 'HunterXHunter', '1998-03-16','Shonen','Yoshihiro Togashi',"Abandonné par son père qui est un Hunter, à la fois un aventurier et un chasseur de primes, Gon décide à l âge de 12 ans de partir pour devenir un Hunter. Cela ne sera pas chose aisée, il devra passer une suite de tests et examens en compagnie de milliers d autres prétendants au titre de Hunter.");

