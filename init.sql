-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql03.univ-lyon2.fr
-- Généré le : mar. 30 juin 2026 à 19:00
-- Version du serveur : 5.7.29
-- Version de PHP : 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php_mthomas5`
--

-- --------------------------------------------------------

--
-- Structure de la table `Administrateur`
--

CREATE TABLE `Administrateur` (
  `id_administrateur` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Administrateur`
--

INSERT INTO `Administrateur` (`id_administrateur`, `login`, `mot_de_passe`) VALUES
(1, 'admin', '$2y$10$pMdI4DiOZy/lPX0cOKVDXuPqJps5yO7R/3OqExXwKjeAUk6Skh0le');

-- --------------------------------------------------------

--
-- Structure de la table `Categorie_Produit`
--

CREATE TABLE `Categorie_Produit` (
  `id_categorie_produit` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Categorie_Produit`
--

INSERT INTO `Categorie_Produit` (`id_categorie_produit`, `nom`) VALUES
(1, 'Shonen'),
(2, 'Shojo'),
(3, 'Seinen'),
(5, 'Josei'),
(6, 'Yaoi'),
(7, 'Yuri');

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `id_commande` int(11) NOT NULL,
  `date` date NOT NULL,
  `statut` enum('En attente','Refusé','Accepté') NOT NULL DEFAULT 'En attente',
  `statut_livraison` enum('En attente','Livré','Non livré') NOT NULL DEFAULT 'En attente',
  `prix_total` decimal(10,2) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Commande`
--

INSERT INTO `Commande` (`id_commande`, `date`, `statut`, `statut_livraison`, `prix_total`, `id_utilisateur`) VALUES
(9, '2026-06-30', 'En attente', 'En attente', 23.25, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Ligne_Commande`
--

CREATE TABLE `Ligne_Commande` (
  `id_ligne` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Ligne_Commande`
--

INSERT INTO `Ligne_Commande` (`id_ligne`, `quantite`, `prix`, `id_commande`, `id_produit`) VALUES
(14, 1, 7.95, 9, 44),
(15, 1, 7.20, 9, 11),
(16, 1, 8.10, 9, 24);

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `quantite` int(11) NOT NULL,
  `description` text,
  `id_categorie_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`id_produit`, `nom`, `image`, `prix`, `quantite`, `description`, `id_categorie_produit`) VALUES
(5, 'Aime ton prochain T01', 'produit_5.jpg', 7.10, 10, 'Kazumi Ichinose est un lycéen de seize ans. Il y a six ans, sa vie a basculé dans l\'horreur lorsque Saki Mido, une camarade de classe de l\'époque, s\'est entichée de lui. Depuis, l\'adolescent vit un véritable enfer à cause de cet amour à sens unique que lui voue la jeune fille. En effet, d\'une jalousie maladive, cette dernière ne laisse derrière elle qu\'un torrent de sang et de larmes, et même un cadavre... Peut-on continuer à vivre quand on est aimé par le Mal incarné sur qui la raison et la morale n\'ont aucun effet ?', 1),
(6, 'Aime ton prochain T02', 'produit_6.jpg', 7.10, 10, 'Kazumi n\'a que seize ans, mais il est déjà meurtri dans sa chair et dans son âme. Une nouvelle fois aux prises avec Saki, et afin de sauver celle qu\'il aime, l\'adolescent va devoir accepter de subir l\'impensable. Dès lors, la haine qu\'il porte à la psychopathe prend une nouvelle tournure. Mais sera-t-il assez fort pour protéger ses proches contre la perversité de cette dernière ?', 1),
(7, 'Aime ton prochain T03', 'produit_7.jpg', 7.10, 10, '\"Je ne lasserai jamais de posséder ton amour...\"\r\n\r\nPossessive à l\'extrême, Saki ne supporte pas que Kazumi fréquente, même en tant qu\'ami, d\'autres filles qu\'elle. Aussi, elle décide de faire subir à la pauvre Shiho une séance de harcèlement psychologique dans un train bondé de monde. Malgré cela, Kazumi doit doit feindre l\'indifférence, car en secret, il commence à monter un plan pour se débarrasser de sa tortionnaire...', 1),
(8, 'Aime ton prochain T04', 'produit_8.jpg', 7.10, 10, 'Kazumi est horrifié quand il apprend que Saki n\'a pas respecté sa promesse. Sa colère explose, et dès lors, il ne souhaite qu\'une chose : tuer la tortionnaire. Mais cette dernière, plus perverse et manipulatrice que jamais, n\'entend pas se laisser faire, et va tout faire pour le « rééduquer ».', 1),
(9, 'Aime ton prochain T05', 'produit_9.jpg', 7.10, 10, 'Cette fois-ci, Kazumi a vraiment décidé d\'en finir avec Saki. Mais s\'il cherche à se débarrasser d\'elle, ce n\'est pas par esprit de vengeance ou de représailles... Non, c\'est pour protéger la femme qu\'il aime. Pourtant, en cherchant à retrouver la trace de la sociopathe, il va découvrir une terrible réalité : dans l\'ombre, elle recevait l\'aide d\'une certaine personne...', 1),
(10, 'Aime ton prochain T06', 'produit_10.jpg', 7.10, 10, 'Après six mois de silence, Mido est de retour à Tokyo, plus obsédée que jamais. Mais cette fois-ci, Kazumi pense avoir pris toutes les mesures nécessaires pour l\'emporter face à elle. Il a même conçu un stratagème sophistique avec l\'intervention d\'un agent double... Cette dernière saura-t-elle tenir son rôle et ainsi se faire pardonner pour ses nombreux errements passés ?', 1),
(11, 'Chat malgré moi T01', 'produit_11.jpg', 7.20, 9, 'La vie du jeune Nao bascule après un terrible accident de la route : quand il reprend ses esprits, il se retrouve piégé dans le corps... d\'un chat ! Pensant d\'abord que ce n\'est qu\'un mauvais rêve, il va tester tous son potentiel de félin jusqu\'à se rendre compte que la rue n\'est vraiment pas faite pour lui... Heureusement, il va croiser la route de la jolie et maladroite Chika, une lycéenne qui vit seule et décide d\'adopter ce petit chat peu ordinaire. Inconsciente de la réelle identité de son compagnon, Chika va le rebaptiser Nyao et commencer une nouvelle vie avec lui. D\'aventures en aventures, Nyao parviendra-t-il à retrouver son corps humain ?', 2),
(12, 'Chat malgré moi T02', 'produit_12.jpg', 7.20, 10, 'Après un terrible accident de la circulation, Nao Kazushiro, lycéen, se retrouve dans le corps... d\'un chat ! Un peu désorienté par cette situation, il va être recueilli par Chika, une jolie jeune fille, chez qui il va désormais vivre. Malgré son envie de trouver un moyen de redevenir humain, notre compère continue à être distrait par sa vie de chat : puces, bain, nouveau chat à la maison... Sans oublier les jolis moments comme son anniversaire surprise organisé par Chika ou les souvenirs partagés de leur première rencontre...\r\n\r\nLe voile se lève un peu sur toute cette mystérieuse histoire !', 2),
(13, 'Chat malgré moi T03', 'produit_13.jpg', 7.20, 10, 'Après un accident de la route, le lycéen Nao Kazushiro se retrouve dans le corps... d\'un chat ! Recueilli par Chika, une jolie lycéenne un peu étrange et fofolle, son quotidien va se voir transformé ! À chaque fois qu\'il essaie de chercher un moyen de retourner à son état normal, sa concentration en prend un coup. En effet, la vie de chat est trop excitante pour s\'attarder sur autre chose : entre la souplesse de son corps, l\'escalade dans les arbres, l\'ouïe fine des félins et les jeux avec Chika, le temps file ! Nyao va-t-il réussir à réintégrer son corps d\'adolescent ? La vie de félin lui manquera-t-elle ?', 2),
(14, 'Chat malgré moi T04', 'produit_14.jpg', 7.20, 10, 'Après un accident de la route, le lycéen Nao Kazushiro se retrouve dans le corps... d\'un chat ! Recueilli par Chika, une jolie lycéenne un peu étrange et fofolle, son quotidien va se voir transformé ! À chaque fois qu\'il essaie de chercher un moyen de retourner à son état normal, sa concentration en prend un coup. En effet, la vie de chat est trop excitante pour s\'attarder sur autre chose : entre la souplesse de son corps, l\'escalade dans les arbres, l\'ouïe fine des félins et les jeux avec Chika, le temps file ! Nyao va-t-il réussir à réintégrer son corps d\'adolescent ? La vie de félin lui manquera-t-elle ?', 2),
(15, 'Chat malgré moi T05', 'produit_15.jpg', 7.20, 10, 'Après un accident de la route, le lycéen Nao Kazushiro se retrouve dans le corps… d\'un chat ! Devenu Nyao, le matou poursuit calmement son quotidien d\'animal domestique auprès de la gentille Chika. Un jour, au détour d\'une promenade, il tombe nez à nez avec son ancien corps ?! Il ne reste plus qu\'à trouver le moyen de le réintégrer... Mais l\'affaire n\'est pas simple, surtout quand l\'un des deux est peu coopératif ! Entre deux réflexions intenses, Nyao continue donc d\'explorer la vie féline : dormir dans des boîtes, apprendre plein de choses à chaton, visiter un temple...\r\nLes aventures de Chika et Nyao ne sont pas prêtes de se terminer ! Et ce, pour notre plus grand plaisir !', 2),
(16, 'Chat malgré moi T06', 'produit_16.jpg', 7.20, 10, 'Après un accident de la route, le lycéen Nao Kazushiro se retrouve dans le corps... d\'un chat ! Sa nouvelle vie féline n\'est pas de tout repos, mais il peut compter sur sa maîtresse Chika pour le sortir de toutes les mauvaises passes ! À la recherche d\'un moyen de réintégrer son enveloppe humaine, Nyao va rencontrer de nouveaux amis, partir en vacances avec Chika, découvrir de nouveaux comportements typiques des chats, et provoquer toujours autant de situations comiques et attendrissantes !\r\n\r\nLa relation drôle et tendre entre la maladroite Chika et ce chat pas comme les autres continue de plus belle !', 2),
(17, 'Chat malgré moi T07', 'produit_17.jpg', 7.20, 10, 'Depuis son accident, le jeune lycéen Nao s\'est plutôt bien adapté à sa vie de chat sous les traits de Nyao. Son quotidien se résumé maintenant à se faire dorloter par la gentille mais maladroite Chika, à jouer à cache-cache, à essayer de faire un régime... Il rencontre aussi des nouveaux chats, aide des amis dans le besoin... Bref, le goût de la liberté et de la paresse commence à doucement lui plaire. Pourtant, un incident risque de tout changer ! Comment notre félin préféré va-t-il faire face à ce brusque retournement de situation ?\r\n\r\nHumour, tendresse et surprises sont toujours les maîtres-mots du quotidien de Chika et Nyao !', 2),
(18, 'Chat malgré moi T08', 'produit_18.jpg', 7.20, 10, 'Le jeune lycéen Nao était enfin de retour dans son corps d\'humain... mais en fait, non, le voilà de nouveau prisonnier du corps de ce chat... à croire qu\'il ne redeviendra jamais lui-même ! Est-ce seulement encore possible ? En attendant, il continue de profiter des avantages d\'être un chat : recevoir mille compliments, se faire offrir des cadeaux, être chouchouté... tout en essayant quand même de trouver une solution à cette malédiction ! Sans oublier de veiller aussi sur son amie Chika et ses histoires d\'amour, et même la sauver d\'un danger imminent !! Ou pas ?\r\nLa vie mouvementée et pleine de suspense de Chika et son chat suit son cours avec humour !', 2),
(19, 'Chat malgré moi T09', 'produit_19.jpg', 7.20, 10, 'Toujours coincé dans le corps d\'un chat depuis un accident, le jeune lycéen Nao continue malgré tout tranquillement sa petite vie d\'animal domestique. Entre les visites de ses amis félins ou des copines de sa maîtresse Chika, le temps passe vite ! Cherchant à s\'intégrer, Nyao va tour à tour tenter de se comporter comme un véritable chat, puis, nostalgique de sa vie d\'humain, se faufilera dans son lycée pour assister à un cours de mathématiques... Plus drôle que jamais, le quotidien mouvementé de Nyao reste plein de surprises !', 2),
(20, 'Chat malgré moi T10', 'produit_20.jpg', 7.20, 10, 'En apparence, Nyao est un chat tigré gris et blanc tout ce qu\'il y a de plus ordinaire... Sauf qu\'en réalité, à la suite d\'un accident, il abrite l\'esprit de Nao, un lycéen ! Depuis, il découvre tranquillement sa vie de chat dans le foyer de la délurée Chika. Et cette fois encore, il n\'est pas au bout de ses surprises : sa première neige, une sortie chez la famille de Chika, des questions existentielles sur sa vie de chat... Bref, plein de moments tendres et rigolos pour le meilleur et pour le rire !', 2),
(21, 'Chat malgré moi T11', 'produit_21.jpg', 7.20, 10, 'Alors qu’en apparence, Nyao est un petit chat tout ce qu’il y a de plus ordinaire, il est en réalité Nao, un lycéen coincé dans le corps d’un félin !\r\nPartageant son quotidien avec la gentille Chika, Nyao profi te de sa nouvelle vie : entre une enquête dans les rues de son quartier et quelques rencontres avec des canidés, qui aurait cru que sa vie de chat serait aussi remplie ?', 2),
(22, 'Chat malgré moi T12', 'produit_22.jpg', 7.20, 10, 'Même s\'il ressemble à un petit chat, Nao est bel et bien un lycéen coincé dans un corps de félin !\r\nAccompagné de la gentille Chika, Nyao a une vie bien remplie : il a chaud, il a froid, il défend son territoire, et il semblerait même qu\'il parvienne enfin à retrouver son corps !\r\nQui aurait cru que sa vie de chat connaîtrait autant de rebondissements ?', 2),
(23, 'Chat malgré moi T13', 'produit_23.jpg', 7.20, 10, 'Même s\'il ressemble à un petit chat, Nao est bel et bien un lycéen coincé dans un corps de félin ! Aux côtés de la gentille Ghika, Nyao mène une vie de chat bien remplie : déterminé à prouver sa valeur, il s\'entraîne au redoutable \"coup de poing félin\" et cherche des cobayes... Mais très vite, un doute l\'assaille : et s\'il était lui-même le cobaye d\'une expérience alien ? Une chose est sûre : il va falloir élucider ce mystère !', 2),
(24, 'The Strange House T01', 'produit_24.jpg', 8.10, 9, 'Un pigiste spécialisé dans le paranormal et l\'horreur reçoit un jour la visite d\'un homme qui envisage d\'acheter une maison. Cependant, les plans de cette dernière sont plus qu\'étranges, laissant supposer qu\'il y a potentiellement eu des actes de maltraitance d\'enfant à l\'intérieur...\r\n\r\nQuel est donc le secret caché derrière ces curieux agencements de pièces ?\r\n\r\nAccompagné d\'un architecte de renom, il va mener son enquête au sujet de cette drôle de bâtisse...', 3),
(25, 'The Strange House T02', 'produit_25.jpg', 8.10, 10, '\"Quel genre de personnes étaient les habitants de cette maison??\" Le plan d\'une maison de Tokyo a laissé supposer qu\'il s\'y passait des choses anormales : un enfant y aurait été séquestré pour commettre des meurtres. C\'est alors qu\'une jeune femme, Yuzuki Miyae, déclare être persuadée que son mari a été assassiné par les habitants de cette étrange maison et révèle les plans d\'une deuxième maison. L\'architecte Kurihara ne tarde pas à mettre le doigt sur un point curieux concernant cette autre maison !!', 3),
(26, 'The Strange House T03', 'produit_26.jpg', 8.10, 10, '« Dès l’instant où j’ai vu les plans, j’ai tout de suite pensé que c’était une étrange maison. »\r\n\r\nUn pigiste spécialisé dans le paranormal et l’horreur reçoit un jour la visite d’un homme qui envisage d’acheter une maison. Cependant, les plans de cette dernière sont plus qu\'étranges, laissant supposer qu’il y a potentiellement eu des actes de maltraitance d’enfant à l’intérieur… Quel est donc le secret caché derrière ces curieux agencements de pièces ? Accompagné d\'un architecte de renom, il va mener son enquête au sujet de cette drôle de bâtisse...', 3),
(27, 'The Strange House T04', 'produit_27.jpg', 8.10, 10, '« Dès l’instant où j’ai vu les plans, j’ai tout de suite pensé que c’était une étrange maison. »\r\n\r\nUn pigiste spécialisé dans le paranormal et l’horreur reçoit un jour la visite d’un homme qui envisage d’acheter une maison. Cependant, les plans de cette dernière sont plus qu\'étranges, laissant supposer qu’il y a potentiellement eu des actes de maltraitance d’enfant à l’intérieur… Quel est donc le secret caché derrière ces curieux agencements de pièces ? Accompagné d\'un architecte de renom, il va mener son enquête au sujet...', 3),
(28, 'Les Noces des Lucioles T01', 'produit_28.jpg', 7.90, 10, 'Durant l\'ère Meiji, Satoko, une jeune femme issue d\'une famille prestigieuse, est atteinte d\'une maladie au cœur. Les médecins ont estimé qu\'elle aura une faible espérance de vie. Afin qu\'elle puisse vivre heureuse, son vieux père fait tout son possible pour la marier à quelqu\'un qui prendra soin d\'elle.\r\n\r\nUn jour, Satoko est kidnappée par des bandits qui ont été engagés pour la tuer. Afin de survivre, elle propose à Gotou, un homme dérangé et assassin de légende, de se marier à lui. S\'ensuit alors une histoire d\'amour hors du commun.', 5),
(29, 'Les Noces des Lucioles T02', 'produit_29.jpg', 7.90, 10, 'Ère Meiji. Pour survivre à l\'assassin qui tentait de la tuer, la jeune Satoko lui a proposé de l\'épouser. Son mensonge s\'est toutefois retourné contre elle car Shinpei fait désormais preuve d\'un amour quasi-obsessionnel à son égard...\r\n\r\nRéfugiés sur l\'ïle de Tennyojima, tous deux prévoient de s\'échapper en faisant de Satoko une courtisane. Seulement, Shinpei refuse qu\'un autre homme la touche ! Satoko, de son côté, se sent de plus en plus coupable d\'avoir menti à Shinpei à propos de leur mariage. Alors que tout les oppose, la distance entre eux ne fait que diminuer !', 5),
(30, 'Les Noces des Lucioles T03', 'produit_30.jpg', 7.90, 10, 'Après s\'être dépêtrés d\'une situation périlleuse à la maison close, tous deux se préparent à secrètement quitter l\'île en barque. Une expédition à cœur ouvert sur laquelle plane déjà le danger...', 5),
(31, 'Les Noces des Lucioles T04', 'produit_31.jpg', 7.90, 10, 'Kotaro, le garde du corps de Satoko depuis de nombreuses années, débarque sur Tennyojima afin de la secourir ! Toutefois, elle ne parvient pas à se réjouir de cette nouvelle réconfortante. Va-t-elle devoir se séparer de Shinpei, qui lui a sauvé la vie à plusieurs reprises ? Shinpei qui, voyant comment se comporte Satoko avec Kotaro, s\'en prend directement à lui !', 5),
(32, 'Les Noces des Lucioles T05', 'produit_32.jpg', 7.90, 10, 'À la demande d\'Asagiri, une courtisane qui dirige l\'île dans l\'ombre, Satoko et Shinpei sortent faire une emplette pour elle. Ce moment passé tous les deux permet à Satoko d\'apprendre à mieux connaître Shinpei, ce qui fait germer en elle de nouveaux sentiments. Seulement, Kotaro ne voit pas ce rapprochement d\'un bon œil, tant comme garde du corps qu\'en tant qu\'homme, et tente de les séparer ! Alors que les sentiments de chacun évoluent rapidement, l\'histoire avance elle aussi à un rythme effréné !', 5),
(33, 'Les Noces des Lucioles T06', 'produit_33.jpg', 7.90, 10, 'Kotaro escalade une falaise abrupte avec Satoko dans les bras. Malheureusement pour lui, Shinpei l\'attend au sommet, le regard brûlant de haine. La bataille entre ces deux hommes, qui se disputent le cœur de la même femme, va enfin connaître une conclusion. Pendant ce temps, Satoko réalise qu\'elle est amoureuse de Shinpei. Mais avant qu\'elle puisse accepter ses sentiments, elle reçoit un nouvel ordre bouleversant !', 5),
(34, 'Les Noces des Lucioles T07', 'produit_34.jpg', 7.90, 10, 'Afin de chasser l\'homme qui tourmente Asagiri de l\'île, Satoko élabore un plan pour le moins inattendu : faire passer Shinpei pour une courtisane de sorte à ce qu\'il s\'approche au plus près de ce fameux client. Une fois l\'infiltration réussie, Shinpei se chargera de neutraliser les gardes qui l\'attaqueront, le sourire aux lèvres et couvert de sang. Du côté de Satoko, une décision lourde de sens prend toutefois peu à peu racine dans son cœur.', 5),
(35, 'Les Noces des Lucioles T08', 'produit_35.jpg', 7.90, 10, 'Jube, le père de Satoko, débarque sur Tennyojima et s\'attaque à Shinpei. Les soldats de la famille Kirigaya ouvrent le feu sur Mitsueda, venu en renfort avec ses hommes, et le criblent de balles. Alors que Satoko assiste impuissante à la scène, de nombreuses personnes sont grièvement blessées, ou pire. Profondément meurtrie par les événements, Satoko va devoir passer ses journées alitée. Mais un soutien inattendu pourrait bien se profiler à l\'horizon...', 5),
(36, 'My Number One ! T01', 'produit_36.jpg', 9.35, 10, '« Je vais faire en sorte que tu ne puisses jamais me quitter. »\r\n\r\nTakato Saijô était l\'homme le plus prisé par les femmes, il a été pendant cinq années consécutives le numéro un du top « les hommes avec lesquels les femmes ont envie de coucher ».\r\nLa personne qui lui a volé sa place en haut du top est un nouvel acteur qui a à peine trois ans de métier derrière lui, Azumaya.\r\nCe dernier répond avec bonne humeur et chaleur au mépris et à la rancœur de Takato.\r\nUn soir, amer et ivre, Takato lui dit ce qu\'il a sur le cœur sans se douter de ce qui l\'attendra à son réveil.', 6),
(37, 'My Number One ! T02', 'produit_37.jpg', 9.35, 10, 'Azumaya abandonne ses ailes d\'ange dans le tome 2 !\r\n\r\nTakato s\'est fait dérober la première place au top des hommes avec lesquels les femmes aimeraient le plus coucher ainsi que son cœur par Azumaya, un acteur débutant.\r\nTakato commence tout juste à s\'habituer à son sourire et à ses manières très directes lorsqu\'un autre acteur l\'emmène, saoul, dans un hôtel.', 6),
(38, 'My Number One ! T03', 'produit_38.jpg', 9.35, 10, '« Je sais que vous n\'aimez pas que je vous touche, alors courage. »\r\n\r\nÀ l\'époque où Azumaya n\'était pas l\'homme le plus désiré, il était un jeune acteur sans ambition, il n\'attendait rien et ne désirait rien.\r\nC\'est sa rencontre avec le talentueux et intimidant Takato qui a changé sa vie.\r\n\r\nCe préquel répond à la question « Pourquoi Azumaya est-il tombé amoureux de Takato ? »', 6),
(39, 'My Number One ! T04', 'produit_39.jpg', 9.35, 10, '« Si tu m\'aimes tant que ça, je vais te laisser coucher avec moi jusqu\'à ce que tu te lasses. »\r\n\r\nAzumaya, le nouvel acteur prodigue que l\'on surnomme « l\'ange » et Takato, acteur vétéran sérieux et respecté, sortent ensemble. Un jour que Takato se laisse enfin un peu aller à éprouver des sentiments, Azumaya et lui ont été photographiés en train de s\'embrasser par un paparazzi. Takato fait un deal avec ce dernier et rompt avec Azumaya.', 6),
(40, 'My Number One ! T05', 'produit_40.jpg', 9.35, 10, '« Tu as couché avec cette femme ? »\r\n\r\nAzumaya, un acteur qui a connu une ascension fulgurante et Saijô qui est acteur depuis son enfance, ont été pris en photo ensemble par un paparazzi. Pour protéger Azumaya, Saijô a préféré rompre, mais n\'arrive pas à s\'en remettre. C\'est alors que paraissent des photos d\'Azumaya sortant avec une belle actrice plus âgée...', 6),
(41, 'My Number One ! T06', 'produit_41.jpg', 9.35, 10, 'Est-ce que tu veux que je te séquestre ?\r\n\r\nJunta et Takato vont jouer ensemble dans une pièce d\'origine espagnole, nommée « Noces de sang ». Durant un cours de flamenco, Takato réalise la différence de niveau entre eux. Ne voulant pas se laisser distancer, il décide de partir en Andalousie, où Junta a vécu pendant son enfance, pour y apprendre la passion.', 6),
(42, 'My Number One ! T07', 'produit_42.jpg', 9.35, 10, '« Pourquoi il ne couche pas avec moi ? »\r\n\r\nLes répétitions de la pièce « les noces de sang » se passent on ne peut mieux, mais pour ce qui est de la vie de couple, c\'est autre chose. Dès que Takato fait mine de ne pas apprécier pendant qu\'ils font l\'amour, Azumaya s\'arrête tout de suite, ce qui frustre son partenaire. De son côté, Usaka retrouve Arisu, un vieux camarade de l\'université qui était sorti de sa vie depuis plusieurs années, tandis que côté travail, Takato voit débarquer sur le plateau de la série dans laquelle il joue un acteur pour le moins... atypique.', 6),
(43, 'My Number One ! T08', 'produit_43.jpg', 9.35, 10, 'Takato est enlevé par le clan Gozubara qui veut l\'utiliser comme appât pour attirer Azumaya. En effet, leur objectif est de faire prendre à ce dernier une drogue aphrodisiaque pour le pousser à coucher avec Knight. Comment Azumaya, qui semble se désintéresser du sexe, va-t-il supporter la situation ?', 6),
(44, 'Je veux t\'aimer jusqu\'à ta mort T01', 'produit_44.jpg', 7.95, 9, 'De jeunes orphelines résidant dans une école spéciale sont élevées afin de devenir de véritables armes de guerre. Elles enchaînent des cours leur apprenant à être des assassins hors pair, incapables de pleurer la mort de leurs proches. La jeune Shîna de quatorze ans qui peine à accepter ce mode de vie fait un soir la rencontre de Mimi, une fille maculée de sang... Shîna rêve d\'un monde meilleur, tandis que Mimi l\'immortelle plonge tête baissée au cœur du champ de bataille.\r\n\r\nVoici l\'histoire du désir innocent et de la rencontre de deux jeunes filles dans un monde où la mort règne en maître.', 7),
(45, 'Je veux t\'aimer jusqu\'à ta mort T02', 'produit_45.jpg', 7.95, 10, 'Shîna et Mimi s\'habituent doucement à leur cohabitation et deviennent amies. Le duo se rapproche peu à peu et devient inséparable; que ce soit en classe, pendant leurs congés ou leurs événements scolaires. De son côté, Mimi enchaîne les allers-retours entre l\'école et le champ de bataille, tandis que la mort semble toujours rôder au plus près d\'elle. Cependant, le secret qu\'elle avoue à Shîna déconcerte plus que jamais sa nouvelle amie...de bataille.', 7),
(46, 'Je veux t\'aimer jusqu\'à ta mort T03', 'produit_46.jpg', 7.95, 10, 'Shîna découvre que Mimi est envoyée se battre jusqu\'à ce que ses blessures l\'empêchent de continuer. Le souhait de ne plus voir quiconque blesser ou être blessé devient alors un vœu égoïste au reste du monde. Alors que Shîna cherche un moyen d\'agir positivement envers Mimi malgré son impuissance, Ceylan est envoyé au front aux côtés de Mimi...', 7),
(47, 'Je veux t\'aimer jusqu\'à ta mort T04', 'produit_47.jpg', 7.95, 10, 'Mimi doit faire face à la mort d\'une amie chère pour la toute première fois, et est consumée par la rage. En la voyant souffrir ainsi, Shîna se tourne vers Mme Fran afi n de savoir quoi faire. C\'est alors que la magie de Shîna se révèle, et s\'avère être la même que celle de la mère de Mimi...', 7),
(48, 'Je veux t\'aimer jusqu\'à ta mort T05', 'produit_48.jpg', 7.95, 10, 'Shîna découvre ses pouvoirs de guérison et passe ses journées à s\'entraîner pour aider Mimi. Quant à elle, Mimi repousse toujours plus les limites de son corps en temps de guerre. Lorsqu\'elles l\'apprennent, les deux jeunes filles n\'arrivent pas à accepter le choix de l\'autre et les tensions s\'installent dans leur relation...', 7),
(49, 'Je veux t\'aimer jusqu\'à ta mort T06', 'produit_49.jpg', 7.95, 10, 'Ari se confie enfin sur la douleur que lui a causé la mort de Ceylan à Esta, tandis que la dispute entre Mimi et Shîna n\'est plus qu\'un mauvais souvenir. Mais alors que la vie reprend doucement son cours, Shîna semble troublée et se rend compte que ses sentiments envers sa partenaire ne font que s\'intensifier...', 7),
(50, 'Je veux t\'aimer jusqu\'à ta mort T07', 'produit_50.jpg', 7.95, 10, 'L\'amitié que ressent Shîna envers Mimi semble évoluer, et elle ne sait pas comment le lui annoncer. C\'est alors qu\'Esta lui fait part de son tragique passé, qui lui fait comprendre que son temps auprès de Mimi lui est compté.\r\nShîna parviendra-t-elle à transmettre ses pensées les plus sincères à celle qu\'elle chérit tant ?', 7),
(51, 'Je veux t\'aimer jusqu\'à ta mort T08', 'produit_51.jpg', 7.95, 10, 'Shîna et Mimi se sont avoués leurs sentiments.\r\nElles se réveillent côte à côte, piquent-niquent ensemble, dorment dans le même lit... leur quotidien a beau rester fondamentalement le même, les deux jeunes filles nagent dans le bonheur.\r\nCependant, alors que la fin de l\'année scolaire approche à grands pas et qu\'elles commencent à songer à leur avenir, la dure réalité frappe Shîna, qui réalise que Mimi ne pourra jamais devenir adulte, ni vieillir à ses côtés.\r\nC\'est alors que Mme Fran leur propose une potion qui pourrait... la faire grandir ?', 7);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id_utilisateur`, `nom`, `prenom`, `mail`, `telephone`, `adresse`, `mot_de_passe`) VALUES
(2, 'Thomas', 'Maély', 'test@inkado.fr', NULL, NULL, '$2y$10$E.0Ru3KL1h.Od23OG60slOk6L9wVAa1pruEVs9yjgyQSHtGi43pAK');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Administrateur`
--
ALTER TABLE `Administrateur`
  ADD PRIMARY KEY (`id_administrateur`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Index pour la table `Categorie_Produit`
--
ALTER TABLE `Categorie_Produit`
  ADD PRIMARY KEY (`id_categorie_produit`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `Ligne_Commande`
--
ALTER TABLE `Ligne_Commande`
  ADD PRIMARY KEY (`id_ligne`),
  ADD KEY `id_commande` (`id_commande`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_categorie_produit` (`id_categorie_produit`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Administrateur`
--
ALTER TABLE `Administrateur`
  MODIFY `id_administrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Categorie_Produit`
--
ALTER TABLE `Categorie_Produit`
  MODIFY `id_categorie_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `Commande`
--
ALTER TABLE `Commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Ligne_Commande`
--
ALTER TABLE `Ligne_Commande`
  MODIFY `id_ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `Produit`
--
ALTER TABLE `Produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `Commande_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `Utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `Ligne_Commande`
--
ALTER TABLE `Ligne_Commande`
  ADD CONSTRAINT `Ligne_Commande_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `Commande` (`id_commande`),
  ADD CONSTRAINT `Ligne_Commande_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `Produit` (`id_produit`);

--
-- Contraintes pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD CONSTRAINT `Produit_ibfk_1` FOREIGN KEY (`id_categorie_produit`) REFERENCES `Categorie_Produit` (`id_categorie_produit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
