-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Mar-2021 às 15:17
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `porevent`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth`
--

CREATE TABLE `auth` (
  `Uniqcode` varchar(15) NOT NULL,
  `CodUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `concelho`
--

CREATE TABLE `concelho` (
  `CodConcelho` int(11) NOT NULL,
  `Concelho` text NOT NULL,
  `CodDistrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `concelho`
--

INSERT INTO `concelho` (`CodConcelho`, `Concelho`, `CodDistrito`) VALUES
(1, 'Águeda', 1),
(2, 'Albergaria-a-Velha', 1),
(3, 'Anadia', 1),
(4, 'Arouca', 1),
(5, 'Aveiro', 1),
(6, 'Castelo de Paiva', 1),
(7, 'Espinho', 1),
(8, 'Estarreja', 1),
(9, 'Ílhavo', 1),
(10, 'Mealhada', 1),
(11, 'Murtosa', 1),
(12, 'Oliveira de Azeméis', 1),
(13, 'Oliveira do Bairro', 1),
(14, 'Ovar', 1),
(15, 'Santa Maria da Feira', 1),
(16, 'São João da Madeira', 1),
(17, 'Sever de Vouga', 1),
(18, 'Vagos', 1),
(19, 'Vale de Cambra', 1),
(20, 'Aljustrel', 2),
(21, 'Almodôvar', 2),
(22, 'Alvito', 2),
(23, 'Barrancos', 2),
(24, 'Beja', 2),
(25, 'Castro Verde', 2),
(26, 'Cuba', 2),
(27, 'Ferreira do Alentejo', 2),
(28, 'Mértola', 2),
(29, 'Moura', 2),
(30, 'Odemira', 2),
(31, 'Ourique', 2),
(32, 'Serpa', 2),
(33, 'Vidigueira', 2),
(34, 'Cuba', 2),
(35, 'Ferreira do Alentejo', 2),
(36, 'Mértola', 2),
(37, 'Moura', 2),
(38, 'Odemira', 2),
(39, 'Ourique', 2),
(40, 'Serpa', 2),
(41, 'Vidigueira', 2),
(42, 'Amares', 3),
(43, 'Barcelos', 3),
(44, 'Braga', 3),
(45, 'Cabeceiras de Bastos', 3),
(46, 'Celorico de Basto', 3),
(47, 'Esposende', 3),
(48, 'Fafe', 3),
(49, 'Guimarães', 3),
(50, 'Póvoa de Lanhoso', 3),
(51, 'Terras de Bouro', 3),
(52, 'Vieira do Minho', 3),
(53, 'Vila Nova de Famalicão', 3),
(54, 'Vila Verde', 3),
(55, 'Vizela', 3),
(56, 'Alfândega da Fé', 4),
(57, 'Bragança', 4),
(58, 'Carrazeda de Ansiães', 4),
(59, 'Freixo de Espada à Cinta', 4),
(60, 'Macedo de Cavaleiros', 4),
(61, 'Miranda do Douro', 4),
(62, 'Mirandela', 4),
(63, 'Mogadouro', 4),
(64, 'Torre de Moncorvo', 4),
(65, 'Vila Flor', 4),
(66, 'Vimioso', 4),
(67, 'Vinhais', 4),
(68, 'Belmonte', 5),
(69, 'Castelo Branco', 5),
(70, 'Covilhã', 5),
(71, 'Fundão', 5),
(72, 'Idanha-a-Nova', 5),
(73, 'Oleiros', 5),
(74, 'Penamacor', 5),
(75, 'Proença-a-Nova', 5),
(76, 'Sertã', 5),
(77, 'Vila de Rei', 5),
(78, 'Vila Velha de Rodão', 5),
(79, 'Arganil', 6),
(80, 'Cantanhede', 6),
(81, 'Coimbra', 6),
(82, 'Condeixa-a-Nova', 6),
(83, 'Figueira da Foz', 6),
(84, 'Góis', 6),
(85, 'Lousã', 6),
(86, 'Mira', 6),
(87, 'Miranda do Corvo', 6),
(88, 'Montemor-o-Velho', 6),
(89, 'Oliveira do Hospital', 6),
(90, 'Pampilhosa da Serra', 6),
(91, 'Penacova', 6),
(92, 'Penela', 6),
(93, 'Soure', 6),
(94, 'Tábua', 6),
(95, 'Vila Nova de Poiares', 6),
(96, 'Alandroal', 7),
(97, 'Arraiolos', 7),
(98, 'Borba', 7),
(99, 'Estremoz', 7),
(100, 'Évora', 7),
(101, 'Montemor-o-Novo', 7),
(102, 'Mora', 7),
(103, 'Mourão', 7),
(104, 'Portel', 7),
(105, 'Redondo', 7),
(106, 'Reguengos de Monsaraz', 7),
(107, 'Vendas Novas', 7),
(108, 'Viana do Alentejo', 7),
(109, 'Vila Viçosa', 7),
(110, 'Albufeira', 8),
(111, 'Alcoutim', 8),
(112, 'Aljezur', 8),
(113, 'Castro Marim', 8),
(114, 'Faro', 8),
(115, 'Lagoa (Algarve)', 8),
(116, 'Lagos', 8),
(117, 'Loulé', 8),
(118, 'Monchique', 8),
(119, 'Olhão', 8),
(120, 'Portimão', 8),
(121, 'São Brás de Alportel', 8),
(122, 'Silves', 8),
(123, 'Tavira', 8),
(124, 'Vila do Bispo', 8),
(125, 'Vila Real de Santo António', 8),
(126, 'Aguiar da Beira', 9),
(127, 'Almeida', 9),
(128, 'Celorico da Beira', 9),
(129, 'Figueira de Castelo Rodrigo', 9),
(130, 'Fornos de Algodres', 9),
(131, 'Gouveia', 9),
(132, 'Guarda', 9),
(133, 'Manteigas', 9),
(134, 'Meda', 9),
(135, 'Pinhel', 9),
(136, 'Sabugal', 9),
(137, 'Seia', 9),
(138, 'Trancoso', 9),
(139, 'Vila Nova de Foz Côa', 9),
(140, 'Alcobaça', 12),
(141, 'Alvaiázere', 12),
(142, 'Ansião', 12),
(143, 'Batalha', 12),
(144, 'Bombarral', 12),
(145, 'Caldas da Rainha', 12),
(146, 'Castanheira de Pêra', 12),
(147, 'Figueiró dos Vinhos', 12),
(148, 'Leiria', 12),
(149, 'Marinha Grande', 12),
(150, 'Nazaré', 12),
(151, 'Óbidos', 12),
(152, 'Pedrógão Grande', 12),
(153, 'Peniche', 12),
(154, 'Pombal', 12),
(155, 'Porto de Mós', 12),
(156, 'Alenquer', 13),
(157, 'Amadora', 13),
(158, 'Arruda dos Vinhos', 13),
(159, 'Azambuja', 13),
(160, 'Cadaval', 13),
(161, 'Cascais', 13),
(162, 'Lisboa', 13),
(163, 'Loures', 13),
(164, 'Lourinhã', 13),
(165, 'Mafra', 13),
(166, 'Odivelas', 13),
(167, 'Oeiras', 13),
(168, 'Sintra', 13),
(169, 'Sobral de Monte Agraço', 13),
(170, 'Torres Vedras', 13),
(171, 'Vila Franca de Xira', 13),
(172, 'Alter do Chão', 14),
(173, 'Arronches', 14),
(174, 'Avis', 14),
(175, 'Campo Maior', 14),
(176, 'Castelo de Vide', 14),
(177, 'Crato', 14),
(178, 'Elvas', 14),
(179, 'Fronteira', 14),
(180, 'Gavião', 14),
(181, 'Marvão', 14),
(182, 'Monforte', 14),
(183, 'Nisa', 14),
(184, 'Ponte de Sor', 14),
(185, 'Portalegre', 14),
(186, 'Sousel', 14),
(187, 'Amarante', 15),
(188, 'Baião', 15),
(189, 'Felgueiras', 15),
(190, 'Gondomar', 15),
(191, 'Lousada', 15),
(192, 'Maia', 15),
(193, 'Marco de Canaveses', 15),
(194, 'Matosinhos', 15),
(195, 'Paços de Ferreira', 15),
(196, 'Paredes', 15),
(197, 'Penafiel', 15),
(198, 'Porto', 15),
(199, 'Póvoa de Varzim', 15),
(200, 'Santo Tirso', 15),
(201, 'Trofa', 15),
(202, 'Valongo', 15),
(203, 'Vila do Conde', 15),
(204, 'Vila Nova de Gaia', 15),
(205, 'Abrantes', 16),
(206, 'Alcanena', 16),
(207, 'Almeirim', 16),
(208, 'Alpiarça', 16),
(209, 'Benavente', 16),
(210, 'Cartaxo', 16),
(211, 'Chamusca', 16),
(212, 'Constância', 16),
(213, 'Coruche', 16),
(214, 'Entroncamento', 16),
(215, 'Ferreira do Zêzere', 16),
(216, 'Golegã', 16),
(217, 'Mação', 16),
(218, 'Ourém', 16),
(219, 'Rio Maior', 16),
(220, 'Salvaterra de Magos', 16),
(221, 'Santarém', 16),
(222, 'Sardoal', 16),
(223, 'Tomar', 16),
(224, 'Torres Novas', 16),
(225, 'Vila Nova da Barquinha', 16),
(226, 'Alcácer do Sal', 17),
(227, 'Alcochete', 17),
(228, 'Almada', 17),
(229, 'Barreiro', 17),
(230, 'Grândola', 17),
(231, 'Moita', 17),
(232, 'Montijo', 17),
(233, 'Palmela', 17),
(234, 'Santiago do Cacém', 17),
(235, 'Seixal', 17),
(236, 'Sesimbra', 17),
(237, 'Setúbal', 17),
(238, 'Sines', 17),
(239, 'Arcos de Valdevez', 18),
(240, 'Caminha', 18),
(241, 'Melgaço', 18),
(242, 'Monção', 18),
(243, 'Paredes de Coura', 18),
(244, 'Ponte da Barca', 18),
(245, 'Ponte de Lima', 18),
(246, 'Valença', 18),
(247, 'Viana do Castelo', 18),
(248, 'Vila Nova de Cerveira', 18),
(249, 'Alijó', 19),
(250, 'Boticas', 19),
(251, 'Chaves', 19),
(252, 'Mesão Frio', 19),
(253, 'Mondim de Basto', 19),
(254, 'Montalegre', 19),
(255, 'Murça', 19),
(256, 'Peso da Régua', 19),
(257, 'Ribeira de Pena', 19),
(258, 'Sabrosa', 19),
(259, 'Santa Marta de Penaguião', 19),
(260, 'Valpaços', 19),
(261, 'Vila Pouca de Aguiar', 19),
(262, 'Vila Real', 19),
(263, 'Armamar', 20),
(264, 'Carregal do Sal', 20),
(265, 'Castro Daire', 20),
(266, 'Cinfães', 20),
(267, 'Lamego', 20),
(268, 'Mangualde', 20),
(269, 'Moimenta da Beira', 20),
(270, 'Mortágua', 20),
(271, 'Nelas', 20),
(272, 'Oliveira de Frades', 20),
(273, 'Penalva do Castelo', 20),
(274, 'Penedono', 20),
(275, 'Resende', 20),
(276, 'Santa Comba Dão', 20),
(277, 'São João da Pesqueira', 20),
(278, 'São Pedro do Sul', 20),
(279, 'Sátão', 20),
(280, 'Sernancelhe', 20),
(281, 'Tabuaço', 20),
(282, 'Tarouca', 20),
(283, 'Tondela', 20),
(284, 'Vila Nova de Paiva', 20),
(285, 'Viseu', 20),
(286, 'Vouzela', 20),
(287, 'Todo o Açores', 11),
(288, 'Toda a Madeira', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `distrito`
--

CREATE TABLE `distrito` (
  `Distrito` text NOT NULL,
  `CodDistrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `distrito`
--

INSERT INTO `distrito` (`Distrito`, `CodDistrito`) VALUES
('Aveiro', 1),
('Beja', 2),
('Braga', 3),
('Bragança', 4),
('Castelo Branco', 5),
('Coimbra', 6),
('Évora', 7),
('Faro', 8),
('Guarda', 9),
('Madeira', 10),
('Açores', 11),
('Leiria', 12),
('Lisboa', 13),
('Portalegre', 14),
('Porto', 15),
('Santarém', 16),
('Setubal', 17),
('Viana do Castelo', 18),
('Vila Real', 19),
('Viseu', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `CodEvento` int(11) NOT NULL,
  `CodTipo` int(11) DEFAULT NULL,
  `CodConcelho` int(11) DEFAULT NULL,
  `Nome` tinytext NOT NULL,
  `Descricao` text DEFAULT NULL,
  `Reserva` int(1) NOT NULL,
  `Valor` double NOT NULL,
  `CodUser` int(11) DEFAULT NULL,
  `Dataini` date NOT NULL,
  `Datafim` date NOT NULL,
  `Horaini` time NOT NULL,
  `Horafim` time NOT NULL,
  `Data_add` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `CodFav` int(11) NOT NULL,
  `CodUser` int(11) DEFAULT NULL,
  `CodEvento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `media`
--

CREATE TABLE `media` (
  `CodMedia` int(11) NOT NULL,
  `CodEvento` int(11) DEFAULT NULL,
  `Media` tinytext DEFAULT NULL,
  `srcdir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoeventos`
--

CREATE TABLE `tipoeventos` (
  `CodTipo` int(11) NOT NULL,
  `TipoEvento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipoeventos`
--

INSERT INTO `tipoeventos` (`CodTipo`, `TipoEvento`) VALUES
(1, 'Moda e Beleza'),
(2, 'Formação'),
(3, 'Mercados e Feiras'),
(4, 'Passeios e Visitas'),
(5, 'Teatro e Dança'),
(6, 'Exposições'),
(7, 'Bem Estar'),
(8, 'Comedia'),
(9, 'Terapias e Holística'),
(10, 'Clubbing'),
(11, 'Literatura'),
(12, 'Infantil'),
(13, 'Tradição'),
(14, 'Natureza'),
(15, 'Conferências'),
(16, 'Gastronomia'),
(17, 'Académicos'),
(18, 'Desporto'),
(19, 'Encontros'),
(20, 'Concertos'),
(21, 'Cinema e Video'),
(22, 'Festivais'),
(23, 'Outras'),
(24, 'Danças');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `CodUser` int(11) NOT NULL,
  `Nome` tinytext NOT NULL,
  `DataNascimento` date DEFAULT NULL,
  `Email` tinytext NOT NULL,
  `Sexo` tinytext DEFAULT NULL,
  `Contacto` tinytext DEFAULT NULL,
  `PASSWORD` text NOT NULL,
  `Verficado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`Uniqcode`),
  ADD KEY `CodUser` (`CodUser`);

--
-- Índices para tabela `concelho`
--
ALTER TABLE `concelho`
  ADD PRIMARY KEY (`CodConcelho`),
  ADD KEY `CodDistrito` (`CodDistrito`);

--
-- Índices para tabela `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`CodDistrito`);

--
-- Índices para tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`CodEvento`),
  ADD KEY `CodTipo` (`CodTipo`),
  ADD KEY `CodConcelho` (`CodConcelho`),
  ADD KEY `CodUser` (`CodUser`);

--
-- Índices para tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`CodFav`),
  ADD KEY `CodUser` (`CodUser`),
  ADD KEY `CodEvento` (`CodEvento`);

--
-- Índices para tabela `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`CodMedia`),
  ADD KEY `CodEvento` (`CodEvento`);

--
-- Índices para tabela `tipoeventos`
--
ALTER TABLE `tipoeventos`
  ADD PRIMARY KEY (`CodTipo`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`CodUser`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `concelho`
--
ALTER TABLE `concelho`
  MODIFY `CodConcelho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `CodEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `CodFav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `media`
--
ALTER TABLE `media`
  MODIFY `CodMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tipoeventos`
--
ALTER TABLE `tipoeventos`
  MODIFY `CodTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `CodUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `auth_ibfk_1` FOREIGN KEY (`CodUser`) REFERENCES `utilizadores` (`CodUser`);

--
-- Limitadores para a tabela `concelho`
--
ALTER TABLE `concelho`
  ADD CONSTRAINT `concelho_ibfk_1` FOREIGN KEY (`CodDistrito`) REFERENCES `distrito` (`CodDistrito`);

--
-- Limitadores para a tabela `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`CodTipo`) REFERENCES `tipoeventos` (`CodTipo`),
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`CodConcelho`) REFERENCES `concelho` (`CodConcelho`),
  ADD CONSTRAINT `evento_ibfk_3` FOREIGN KEY (`CodUser`) REFERENCES `utilizadores` (`CodUser`);

--
-- Limitadores para a tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`CodUser`) REFERENCES `utilizadores` (`CodUser`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`CodEvento`) REFERENCES `evento` (`CodEvento`);

--
-- Limitadores para a tabela `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`CodEvento`) REFERENCES `evento` (`CodEvento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
