-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/11/2023 às 02:43
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_educatech`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `raAluno` varchar(7) NOT NULL,
  `nomeAluno` varchar(50) NOT NULL,
  `dataNascimento` date NOT NULL,
  `idTurma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`raAluno`, `nomeAluno`, `dataNascimento`, `idTurma`) VALUES
('0988977', 'Caio Felipe Silva', '2017-11-02', 14),
('1234569', 'Henry Smith ', '2017-04-07', 3),
('1343233', 'Eduarda Alecrim', '2006-07-01', 16),
('1645434', 'Bianca Batista', '2006-10-25', 16),
('1775342', 'Mateus Leite', '2005-05-08', 16),
('2023014', 'Amanda Saturno', '2017-04-06', 3),
('2356433', 'Ana Julia', '2007-04-02', 18),
('4343675', 'Mateus Henrique', '2017-11-19', 18),
('4565534', 'David Vasconcelos', '2017-12-08', 14),
('5321231', 'Gustavo Anjo', '2010-03-07', 18),
('6787898', 'Aline Dantas ', '2017-09-03', 14),
('7232445', 'Alice Kelly', '2006-10-25', 18),
('7415269', 'Samy Alecrim ', '2017-08-10', 3),
('9696348', 'Patrick Leite', '2017-01-25', 3),
('9764231', 'Jaqueline Sampaio ', '2006-08-26', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aula`
--

CREATE TABLE `aula` (
  `idAula` int(11) NOT NULL,
  `resumoAula` text DEFAULT NULL,
  `dataAula` date DEFAULT NULL,
  `idTurma` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idDIsciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `aula`
--

INSERT INTO `aula` (`idAula`, `resumoAula`, `dataAula`, `idTurma`, `idUsuario`, `idDIsciplina`) VALUES
(24, 'Reconhecimento das letras do alfabeto.\r\nAprendizado das letras maiúsculas e minúsculas.\r\nDesenvolvimento da habilidade de leitura e escrita.', '2023-11-06', 3, 28, 1),
(25, ' Desenvolvimento de habilidades motoras básicas, como correr, pular e dançar.', '2023-11-06', 3, 22, 4),
(27, ' Aulas de resolução de problemas envolvendo adição, subtração, multiplicação e divisão.\r\n', '2023-11-06', 16, 11, 1),
(28, ' Produção textual\r\nLiteratura infantil e juvenil', '2023-11-07', 3, 28, 1),
(29, ' Introduzir os alunos ao atletismo, destacando a importância do desenvolvimento da velocidade e da coordenação motora.', '2023-11-07', 3, 22, 4),
(30, ' Conteúdo da Aula: Números Pares e Ímpares\r\n\r\nNúmeros pares são aqueles que podem ser divididos igualmente por 2, resultando em um quociente inteiro, enquanto números ímpares não podem ser divididos igualmente por 2.', '2023-11-08', 16, 11, 1),
(31, ' Introdução ao alfabeto, pronúncia e saudações básicas.', '2023-10-04', 3, 13, 8),
(32, 'Expressões de cortesia, como \"por favor\", \"obrigado\" e \"desculpe\".', '2023-10-11', 3, 13, 8),
(33, ' Números, cores e dias da semana.', '2023-10-18', 3, 13, 8),
(34, ' Palavras e frases relacionadas à família.', '2023-10-25', 3, 13, 8),
(35, ' Vocabulário de alimentos e restaurantes.', '2023-11-01', 3, 13, 8),
(37, ' preparação de conteudo ', '2023-09-27', 3, 13, 8),
(38, '  Desenho livre para expressar emoções.', '2023-10-02', 3, 18, 2),
(39, ' Introdução às técnicas básicas de pintura. Demonstração prática: aquarela.', '2023-10-06', 3, 18, 2),
(40, ' Arte com Materiais Recicláveis: Conscientização ambiental através da arte.', '2023-10-09', 3, 18, 2),
(41, ' Demonstração prática: criação de esculturas com materiais recicláveis.', '2023-10-12', 3, 18, 2),
(42, ' APRESENTAÇÃO dos trabalhos: Arte com Materiais Recicláveis', '2023-10-16', 3, 18, 2),
(43, ' DESENHO LIVRE ', '2023-10-19', 3, 18, 2),
(44, '  Introdução à Educação Física e Atividades de Aquecimento', '2023-10-03', 3, 22, 4),
(45, ' Introdução aos jogos cooperativos; Demonstração prática de jogos em equipe.', '2023-10-17', 3, 22, 4),
(46, ' Participação ativa em jogos cooperativos: QUEIMADA E FUTEBOL. ', '2023-10-24', 3, 22, 4),
(47, ' AULA DE VÔLEI NA QUADRA', '2023-11-20', 3, 22, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cardapio`
--

CREATE TABLE `cardapio` (
  `idCardapio` int(11) NOT NULL,
  `imgCardapio` varchar(255) NOT NULL,
  `idEscola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cardapio`
--

INSERT INTO `cardapio` (`idCardapio`, `imgCardapio`, `idEscola`) VALUES
(2, '10c226c94408a6e604b28922600e3681.jpg', 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario_aula`
--

CREATE TABLE `comentario_aula` (
  `idComentario` int(11) NOT NULL,
  `nomeContato` varchar(70) NOT NULL,
  `dataComentario` datetime NOT NULL,
  `comentario` text NOT NULL,
  `idTurma` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `idDisciplina` int(11) NOT NULL,
  `nomeDisciplina` varchar(35) NOT NULL,
  `fundamental1` tinyint(1) NOT NULL,
  `fundamental2` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `disciplina`
--

INSERT INTO `disciplina` (`idDisciplina`, `nomeDisciplina`, `fundamental1`, `fundamental2`) VALUES
(1, 'Educação básica (Fundamental I)', 1, 0),
(2, 'Artes', 1, 1),
(3, 'Ciências', 0, 1),
(4, 'Educação Fisica', 1, 1),
(5, 'Geografia', 0, 1),
(6, 'História', 0, 1),
(7, 'Língua portuguesa', 0, 1),
(8, 'Língua inglesa', 1, 1),
(9, 'Matemática', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `docente_disciplina`
--

CREATE TABLE `docente_disciplina` (
  `codigo` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idDisciplina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `docente_disciplina`
--

INSERT INTO `docente_disciplina` (`codigo`, `idUsuario`, `idDisciplina`) VALUES
(1, 11, 1),
(2, 11, 7),
(3, 11, 8),
(4, 14, 3),
(5, 14, 5),
(6, 15, 7),
(7, 15, 8),
(9, 19, 5),
(10, 19, 9),
(11, 20, 3),
(12, 20, 6),
(13, 21, 1),
(14, 18, 2),
(15, 18, 3),
(16, 18, 6),
(17, 16, 4),
(18, 16, 5),
(19, 17, 5),
(20, 17, 9),
(21, 28, 1),
(22, 22, 4),
(23, 22, 6),
(24, 13, 2),
(25, 13, 8),
(26, 32, 1),
(27, 33, 4),
(28, 34, 2),
(29, 34, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `escola`
--

CREATE TABLE `escola` (
  `idEscola` int(11) NOT NULL,
  `nomeEscola` varchar(50) NOT NULL,
  `enderecoEscola` varchar(255) NOT NULL,
  `telefoneEscola` varchar(15) NOT NULL,
  `statusConta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `escola`
--

INSERT INTO `escola` (`idEscola`, `nomeEscola`, `enderecoEscola`, `telefoneEscola`, `statusConta`) VALUES
(13, 'E.E Luz e Paz ', 'Jandira - SP / Rua Dos Fantasmas  Nº: 96 / Bairro da Alegria', '(11) 4002-8922', 1),
(16, 'E.E Alessandro Cruz', 'Jandira - SP / Rua das Laranjeiras Nº: 456 / Centro', '(11) 2309-0965', 1),
(18, 'EMEB Agostinho Carra', 'Barueri - SP / Rua Armelinda Abreu  Nº: 514 / Jardim Santo Amaro', '(19) 4002-8922', 1),
(19, 'E.E Lucinda Pires', 'Jandira - SP / Rua Lucinda Pires Nº: 38 / Centro', '(11) 4000-8741', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `media_aluno`
--

CREATE TABLE `media_aluno` (
  `idMedia` int(11) NOT NULL,
  `cicloBoletim` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `anoMedia` year(4) NOT NULL,
  `raAluno` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `media_aluno`
--

INSERT INTO `media_aluno` (`idMedia`, `cicloBoletim`, `nota`, `anoMedia`, `raAluno`, `idDisciplina`, `idUsuario`, `idTurma`) VALUES
(48, 1, 6, '2023', '2023014', 3, 11, 3),
(49, 1, 7, '2023', '1234569', 3, 11, 3),
(50, 1, 8, '2023', '9696348', 3, 11, 3),
(51, 1, 9, '2023', '7415269', 3, 11, 3),
(56, 2, 10, '2023', '2023014', 3, 11, 3),
(57, 2, 9, '2023', '1234569', 3, 11, 3),
(58, 2, 8, '2023', '9696348', 3, 11, 3),
(59, 2, 7, '2023', '7415269', 3, 11, 3),
(60, 3, 7, '2023', '2023014', 3, 11, 3),
(61, 3, 8, '2023', '1234569', 3, 11, 3),
(62, 3, 10, '2023', '9696348', 3, 11, 3),
(63, 3, 5, '2023', '7415269', 3, 11, 3),
(64, 1, 10, '2023', '2023014', 5, 11, 3),
(65, 1, 10, '2023', '1234569', 5, 11, 3),
(66, 1, 10, '2023', '9696348', 5, 11, 3),
(67, 1, 10, '2023', '7415269', 5, 11, 3),
(68, 2, 5, '2023', '2023014', 5, 11, 3),
(69, 2, 5, '2023', '1234569', 5, 11, 3),
(70, 2, 5, '2023', '9696348', 5, 11, 3),
(71, 2, 5, '2023', '7415269', 5, 11, 3),
(72, 3, 4, '2023', '2023014', 5, 11, 3),
(73, 3, 7, '2023', '1234569', 5, 11, 3),
(74, 3, 8, '2023', '9696348', 5, 11, 3),
(75, 3, 10, '2023', '7415269', 5, 11, 3),
(76, 1, 8, '2023', '2023014', 6, 11, 3),
(77, 1, 8, '2023', '1234569', 6, 11, 3),
(78, 1, 8, '2023', '9696348', 6, 11, 3),
(79, 1, 8, '2023', '7415269', 6, 11, 3),
(80, 2, 6, '2023', '2023014', 6, 11, 3),
(81, 2, 6, '2023', '1234569', 6, 11, 3),
(82, 2, 6, '2023', '9696348', 6, 11, 3),
(83, 2, 6, '2023', '7415269', 6, 11, 3),
(84, 3, 8, '2023', '2023014', 6, 11, 3),
(85, 3, 7, '2023', '1234569', 6, 11, 3),
(86, 3, 10, '2023', '9696348', 6, 11, 3),
(87, 3, 10, '2023', '7415269', 6, 11, 3),
(88, 1, 9, '2023', '2023014', 7, 11, 3),
(89, 1, 9, '2023', '1234569', 7, 11, 3),
(90, 1, 9, '2023', '9696348', 7, 11, 3),
(91, 1, 9, '2023', '7415269', 7, 11, 3),
(92, 2, 8, '2023', '2023014', 7, 11, 3),
(93, 2, 10, '2023', '1234569', 7, 11, 3),
(94, 2, 10, '2023', '9696348', 7, 11, 3),
(95, 2, 6, '2023', '7415269', 7, 11, 3),
(96, 3, 7, '2023', '2023014', 7, 11, 3),
(97, 3, 7, '2023', '1234569', 7, 11, 3),
(98, 3, 7, '2023', '9696348', 7, 11, 3),
(99, 3, 7, '2023', '7415269', 7, 11, 3),
(100, 1, 10, '2023', '2023014', 9, 11, 3),
(101, 1, 10, '2023', '1234569', 9, 11, 3),
(102, 1, 10, '2023', '9696348', 9, 11, 3),
(103, 1, 10, '2023', '7415269', 9, 11, 3),
(104, 2, 8, '2023', '2023014', 9, 11, 3),
(105, 2, 8, '2023', '1234569', 9, 11, 3),
(106, 2, 8, '2023', '9696348', 9, 11, 3),
(107, 2, 8, '2023', '7415269', 9, 11, 3),
(108, 3, 10, '2023', '2023014', 9, 11, 3),
(109, 3, 10, '2023', '1234569', 9, 11, 3),
(110, 3, 10, '2023', '9696348', 9, 11, 3),
(111, 3, 10, '2023', '7415269', 9, 11, 3),
(112, 1, 10, '2023', '2023014', 8, 13, 3),
(113, 1, 10, '2023', '1234569', 8, 13, 3),
(114, 1, 10, '2023', '9696348', 8, 13, 3),
(115, 1, 10, '2023', '7415269', 8, 13, 3),
(116, 2, 8, '2023', '2023014', 8, 13, 3),
(117, 2, 8, '2023', '1234569', 8, 13, 3),
(118, 2, 8, '2023', '9696348', 8, 13, 3),
(119, 2, 8, '2023', '7415269', 8, 13, 3),
(120, 3, 9, '2023', '2023014', 8, 13, 3),
(121, 3, 9, '2023', '1234569', 8, 13, 3),
(122, 3, 9, '2023', '9696348', 8, 13, 3),
(123, 3, 9, '2023', '7415269', 8, 13, 3),
(124, 1, 7, '2023', '2023014', 2, 18, 3),
(125, 1, 7, '2023', '1234569', 2, 18, 3),
(126, 1, 7, '2023', '9696348', 2, 18, 3),
(127, 1, 7, '2023', '7415269', 2, 18, 3),
(128, 2, 9, '2023', '2023014', 2, 18, 3),
(129, 2, 9, '2023', '1234569', 2, 18, 3),
(130, 2, 9, '2023', '9696348', 2, 18, 3),
(131, 2, 9, '2023', '7415269', 2, 18, 3),
(132, 3, 10, '2023', '2023014', 2, 18, 3),
(133, 3, 10, '2023', '1234569', 2, 18, 3),
(134, 3, 10, '2023', '9696348', 2, 18, 3),
(135, 3, 10, '2023', '7415269', 2, 18, 3),
(136, 1, 6, '2023', '2023014', 4, 22, 3),
(137, 1, 6, '2023', '1234569', 4, 22, 3),
(138, 1, 6, '2023', '9696348', 4, 22, 3),
(139, 1, 6, '2023', '7415269', 4, 22, 3),
(140, 2, 8, '2023', '2023014', 4, 22, 3),
(141, 2, 8, '2023', '1234569', 4, 22, 3),
(142, 2, 8, '2023', '9696348', 4, 22, 3),
(143, 2, 9, '2023', '7415269', 4, 22, 3),
(144, 3, 6, '2023', '2023014', 4, 22, 3),
(145, 3, 8, '2023', '1234569', 4, 22, 3),
(146, 3, 9, '2023', '9696348', 4, 22, 3),
(147, 3, 7, '2023', '7415269', 4, 22, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia`
--

CREATE TABLE `noticia` (
  `idNoticia` int(11) NOT NULL,
  `dataNoticia` date NOT NULL,
  `tituloNoticia` varchar(80) NOT NULL,
  `descNoticia` text NOT NULL,
  `idEscola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `noticia`
--

INSERT INTO `noticia` (`idNoticia`, `dataNoticia`, `tituloNoticia`, `descNoticia`, `idEscola`) VALUES
(2, '2023-11-08', 'SEXTA-FEIRA FELIZ', ' NESSA SEXTA-FEIRA DIA 10/11 TERÁ CINEMA, CACHORRO QUENTE E MÚSICA NA HORA DO INTERVALO.', 13),
(3, '2023-11-08', 'EXCURSÃO ESCOLAR HOPI HARI', 'EXCURSÃO ESCOLAR PARA O HOPI HARI, POR GENTILEZA OLHE O CADERNO DOS ALUNOS E VERIFIQUE O RECADO QUE FOI DEIXADO COM AS ORIENTAÇÕES DA EXCURSÃO. Dúvidas procure a diretoria. ', 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `presenca_aula`
--

CREATE TABLE `presenca_aula` (
  `idAula` int(11) NOT NULL,
  `raAluno` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `presenca_aula`
--

INSERT INTO `presenca_aula` (`idAula`, `raAluno`) VALUES
(24, '2023014'),
(24, '1234569'),
(24, '9696348'),
(24, '7415269'),
(25, '1234569'),
(25, '9696348'),
(25, '7415269'),
(28, '2023014'),
(28, '1234569'),
(28, '9696348'),
(28, '7415269'),
(29, '2023014'),
(29, '1234569'),
(29, '9696348'),
(29, '7415269'),
(30, '1645434'),
(30, '1343233'),
(30, '1775342'),
(31, '2023014'),
(31, '1234569'),
(31, '9696348'),
(31, '7415269'),
(32, '2023014'),
(32, '1234569'),
(32, '9696348'),
(32, '7415269'),
(33, '2023014'),
(33, '9696348'),
(33, '7415269'),
(35, '2023014'),
(35, '1234569'),
(35, '9696348'),
(35, '7415269'),
(38, '2023014'),
(38, '1234569'),
(38, '9696348'),
(38, '7415269'),
(39, '2023014'),
(39, '9696348'),
(40, '9696348'),
(40, '7415269'),
(41, '2023014'),
(41, '1234569'),
(41, '9696348'),
(41, '7415269'),
(42, '2023014'),
(42, '1234569'),
(44, '2023014'),
(44, '1234569'),
(44, '9696348'),
(44, '7415269'),
(45, '2023014'),
(45, '9696348'),
(45, '7415269'),
(46, '2023014'),
(46, '1234569'),
(46, '9696348'),
(46, '7415269'),
(47, '2023014'),
(47, '1234569'),
(47, '9696348'),
(47, '7415269');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefa_aula`
--

CREATE TABLE `tarefa_aula` (
  `idTarefa` int(11) NOT NULL,
  `idAula` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL,
  `descTarefa` text NOT NULL,
  `dataTarefa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tarefa_aula`
--

INSERT INTO `tarefa_aula` (`idTarefa`, `idAula`, `idTurma`, `descTarefa`, `dataTarefa`) VALUES
(21, 24, 3, ' Formação de frases simples.', '2023-11-09'),
(24, 29, 3, ' Peça aos alunos para escreverem um pequeno relatório sobre a aula de atletismo, abordando os seguintes pontos:\r\n\r\nO que aprenderam sobre corrida de velocidade e revezamento?\r\nQual foi a parte mais divertida da aula?\r\nComo o trabalho em equipe foi importante durante a aula?', '2023-11-09'),
(25, 30, 16, ' Liste os números de 1 a 20.\r\n\r\nIdentifique quais deles são números pares e quais são números ímpares.', '2023-11-13'),
(26, 31, 3, ' TAREFA 1: Escreva um pequeno diálogo de apresentação entre duas pessoas.', '2023-10-11'),
(27, 33, 3, 'TAREFA 2: Liste os dias da semana e faça anotações sobre atividades típicas para cada dia.', '2023-10-25'),
(28, 35, 3, 'TAREFA 3: Crie um menu fictício de um restaurante em inglês.', '2023-11-08'),
(29, 39, 3, ' Criar uma pintura inspirada em um tema da natureza.', '2023-10-09'),
(30, 40, 3, 'Criar uma escultura utilizando materiais recicláveis em casa.', '2023-10-16'),
(31, 44, 3, ' Praticar alongamentos em casa e relatar a experiência.', '2023-10-10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL,
  `idEscola` int(11) NOT NULL,
  `ciclo` varchar(2) NOT NULL,
  `turma` varchar(1) NOT NULL,
  `periodo` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `idEscola`, `ciclo`, `turma`, `periodo`) VALUES
(3, 13, '1', 'A', 'MANHÃ'),
(8, 13, '1', 'B', 'MANHÃ'),
(9, 13, '1', 'C', 'TARDE'),
(13, 13, '4', 'A', 'MANHÃ'),
(14, 13, '3', 'A', 'MANHÃ'),
(15, 13, '3', 'C', 'TARDE'),
(16, 13, '2', 'A', 'MANHÃ'),
(18, 13, '6', 'A', 'MANHÃ'),
(19, 13, '7', 'A', 'MANHÃ'),
(20, 13, '8', 'A', 'MANHÃ'),
(21, 13, '9', 'A', 'MANHÃ'),
(22, 18, '1', 'A', 'MANHÃ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma_disciplina`
--

CREATE TABLE `turma_disciplina` (
  `idTurma` int(11) DEFAULT NULL,
  `aula` int(11) NOT NULL,
  `diaSemana` varchar(8) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `turma_disciplina`
--

INSERT INTO `turma_disciplina` (`idTurma`, `aula`, `diaSemana`, `idDisciplina`, `idUsuario`) VALUES
(3, 1, 'segunda', 7, 28),
(3, 2, 'segunda', 7, 28),
(3, 3, 'segunda', 7, 28),
(3, 4, 'segunda', 2, 18),
(3, 5, 'segunda', 2, 18),
(3, 1, 'terca', 9, 28),
(3, 2, 'terca', 9, 28),
(3, 3, 'terca', 9, 28),
(3, 4, 'terca', 4, 22),
(3, 5, 'terca', 4, 22),
(3, 1, 'quarta', 3, 28),
(3, 2, 'quarta', 3, 28),
(3, 3, 'quarta', 3, 28),
(3, 4, 'quarta', 8, 13),
(3, 5, 'quarta', 8, 13),
(3, 1, 'quinta', 5, 28),
(3, 2, 'quinta', 5, 28),
(3, 3, 'quinta', 5, 28),
(3, 4, 'quinta', 2, 18),
(3, 5, 'quinta', 2, 18),
(3, 1, 'sexta', 7, 28),
(3, 2, 'sexta', 7, 28),
(3, 3, 'sexta', 4, 22),
(3, 4, 'sexta', 6, 28),
(3, 5, 'sexta', 6, 28),
(18, 1, 'segunda', 2, 18),
(18, 2, 'segunda', 2, 18),
(18, 3, 'segunda', 7, 15),
(18, 4, 'segunda', 7, 15),
(18, 5, 'segunda', 7, 15),
(18, 1, 'terca', 9, 17),
(18, 2, 'terca', 9, 17),
(18, 3, 'terca', 9, 17),
(18, 4, 'terca', 4, 22),
(18, 5, 'terca', 4, 22),
(18, 1, 'quarta', 3, 20),
(18, 2, 'quarta', 3, 20),
(18, 3, 'quarta', 3, 20),
(18, 4, 'quarta', 8, 13),
(18, 5, 'quarta', 8, 13),
(18, 1, 'quinta', 6, 18),
(18, 2, 'quinta', 6, 18),
(18, 3, 'quinta', 5, 19),
(18, 4, 'quinta', 5, 19),
(18, 5, 'quinta', 4, 22),
(18, 1, 'sexta', 9, 17),
(18, 2, 'sexta', 9, 17),
(18, 3, 'sexta', 2, 18),
(18, 4, 'sexta', 7, 15),
(18, 5, 'sexta', 7, 15),
(22, 1, 'segunda', 7, 32),
(22, 2, 'segunda', 7, 32),
(22, 3, 'segunda', 3, 32),
(22, 4, 'segunda', 3, 32),
(22, 5, 'segunda', 3, 32),
(22, 1, 'terca', 5, 32),
(22, 2, 'terca', 5, 32),
(22, 3, 'terca', 5, 32),
(22, 4, 'terca', 4, 33),
(22, 5, 'terca', 4, 33),
(22, 1, 'quarta', 9, 32),
(22, 2, 'quarta', 9, 32),
(22, 3, 'quarta', 6, 32),
(22, 4, 'quarta', 6, 32),
(22, 5, 'quarta', 6, 32),
(22, 1, 'quinta', 2, 34),
(22, 2, 'quinta', 2, 34),
(22, 3, 'quinta', 2, 34),
(22, 4, 'quinta', 7, 32),
(22, 5, 'quinta', 7, 32),
(22, 1, 'sexta', 9, 32),
(22, 2, 'sexta', 9, 32),
(22, 3, 'sexta', 9, 32),
(22, 4, 'sexta', 8, 34),
(22, 5, 'sexta', 8, 34),
(16, 1, 'segunda', 5, 11),
(16, 2, 'segunda', 5, 11),
(16, 3, 'segunda', 7, 11),
(16, 4, 'segunda', 7, 11),
(16, 5, 'segunda', 7, 11),
(16, 1, 'terca', 2, 18),
(16, 2, 'terca', 2, 18),
(16, 3, 'terca', 3, 11),
(16, 4, 'terca', 3, 11),
(16, 5, 'terca', 4, 16),
(16, 1, 'quarta', 9, 11),
(16, 2, 'quarta', 9, 11),
(16, 3, 'quarta', 9, 11),
(16, 4, 'quarta', 8, 13),
(16, 5, 'quarta', 8, 13),
(16, 1, 'quinta', 6, 11),
(16, 2, 'quinta', 6, 11),
(16, 3, 'quinta', 7, 11),
(16, 4, 'quinta', 7, 11),
(16, 5, 'quinta', 2, 18),
(16, 1, 'sexta', 9, 11),
(16, 2, 'sexta', 9, 11),
(16, 3, 'sexta', 3, 11),
(16, 4, 'sexta', 3, 11),
(16, 5, 'sexta', 4, 16);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma_fund1_responsavel`
--

CREATE TABLE `turma_fund1_responsavel` (
  `idTurma` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `turma_fund1_responsavel`
--

INSERT INTO `turma_fund1_responsavel` (`idTurma`, `idUsuario`) VALUES
(3, 28),
(22, 32),
(16, 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idEscola` int(11) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `cpfUsuario` varchar(11) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `loginUsuario` varchar(20) NOT NULL,
  `senhaUsuario` varchar(20) NOT NULL,
  `tipoUsuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `idEscola`, `nomeUsuario`, `cpfUsuario`, `emailUsuario`, `loginUsuario`, `senhaUsuario`, `tipoUsuario`) VALUES
(2, 13, 'Vanessa Silva', '11122233344', 'vanessa.silva@email.com', 'vanessa.silva', 'Fatec@2023!', 'admin-nivel-3'),
(6, 13, 'Felipe Mendes', '77744400032', 'felipe@email.com', 'felipe.mendes', 'Fatec@2023!', 'admin-nivel-2'),
(7, 13, 'Ana Trindade', '55544477778', 'ana@email.com', 'ana.trindade', 'Fatec@2023!', 'admin-nivel-1'),
(11, 13, 'Maria Isabel da Silva', '48411120209', 'mariaisa123@outlook.com', 'maria.silva', 'Fatec@2023!', 'docente'),
(13, 13, 'Terezinha de Jesus ', '01023319703', 'terezinha2000@outlook.com', 'terezinha.jesus', 'Fatec@2023!', 'docente'),
(14, 13, 'Marcelo Gomes Pereira ', '46195414111', 'marcelogm@gmail.com', 'marcelo.pereira', 'Fatec@2023!', 'docente'),
(15, 13, 'Lisandra Pires Silva', '46198080324', 'lisandra_123@gmail.com', 'lisandra.silva', 'Fatec@2023!', 'docente'),
(16, 13, 'Gustavo Silva', '91293461922', 'gustavosilva@hotmail.com', 'gustavo.silva', 'Fatec@2023', 'docente'),
(17, 13, 'Cícera Gonçalves ', '50070061235', 'cicera_gonc@gmail.com', 'cicera.gonçalves', 'Fatec@2023!', 'docente'),
(18, 13, 'Bianca Braund ', '30230299912', 'bianca_braund@email.com', 'bianca.braund', 'Fatec@2023!', 'docente'),
(19, 13, 'Bruno Martins', '99944455500', 'brunoma@hotmail.com', 'bruno.martins', 'Fatec@2023!', 'docente'),
(20, 13, 'Adilson Guilherme Souza', '99896526514', 'adilsongui@outlook.com', 'adilson.souza', 'Fatec@2023!', 'docente'),
(21, 13, 'Luciana Pereira ', '10298943136', 'luciana123@yahoo.com', 'luciana.pereira', 'Fatec@2023!', 'docente'),
(22, 13, 'Camila Oliveira Santos', '30010026988', 'camila_santos@email.com', 'camila.santos', 'Fatec@2023!', 'docente'),
(26, 16, 'Cadu Santos', '98453423009', 'cadu@email.com', 'cadu.santos', 'Fatec123', 'admin-nivel-3'),
(28, 13, 'Amanda Souza', '08732403454', 'amanda_souza@email.com', 'amanda.souza', 'Fatec@2023!', 'docente'),
(29, 13, 'Ricardo Meireles', '57673424234', 'ricardo_m@email.com', 'ricardo.meireles', 'Fatec@2023!', 'admin-nivel-3'),
(30, 18, 'Guilherme Seichas', '78956235132', 'guilherme_tech@email.com', 'guilherme.seichas', 'Fatec@2023!', 'admin-nivel-3'),
(31, 18, 'Marcela Silva', '75542321312', 'marcela@email.com', 'marcela.silva', 'Fatec@2023!', 'admin-nivel-1'),
(32, 18, 'Beatriz Leite ', '21326756865', 'beatriz@email.com', 'beatriz.leiet', 'Fatec@2023!', 'docente'),
(33, 18, 'Arly Santos', '45324234324', 'arly@email.com', 'arly.santos', 'Fatec@2023!', 'docente'),
(34, 18, 'Cristina Rocha', '35542302470', 'cris@email.com', 'cristina.rocha', 'Fatec@2023!', 'docente'),
(35, 19, 'Marcela Santos', '48455590845', 'marcela.s@email.com', 'marcela.santos', 'senha123', 'admin-nivel-3');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD UNIQUE KEY `raAluno` (`raAluno`),
  ADD KEY `idTurma` (`idTurma`);

--
-- Índices de tabela `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`idAula`),
  ADD KEY `idTurma` (`idTurma`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idDIsciplina` (`idDIsciplina`);

--
-- Índices de tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`idCardapio`);

--
-- Índices de tabela `comentario_aula`
--
ALTER TABLE `comentario_aula`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idTurma` (`idTurma`),
  ADD KEY `idDisciplina` (`idDisciplina`);

--
-- Índices de tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`idDisciplina`);

--
-- Índices de tabela `docente_disciplina`
--
ALTER TABLE `docente_disciplina`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_idUsuario` (`idUsuario`),
  ADD KEY `fk_idDisciplina` (`idDisciplina`);

--
-- Índices de tabela `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`idEscola`);

--
-- Índices de tabela `media_aluno`
--
ALTER TABLE `media_aluno`
  ADD PRIMARY KEY (`idMedia`),
  ADD KEY `fk_raAluno` (`raAluno`),
  ADD KEY `fk_idDisc` (`idDisciplina`),
  ADD KEY `fk_idUser` (`idUsuario`),
  ADD KEY `fk_idTurm` (`idTurma`);

--
-- Índices de tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`idNoticia`),
  ADD KEY `idEscola` (`idEscola`);

--
-- Índices de tabela `presenca_aula`
--
ALTER TABLE `presenca_aula`
  ADD KEY `idAula` (`idAula`),
  ADD KEY `raAluno` (`raAluno`);

--
-- Índices de tabela `tarefa_aula`
--
ALTER TABLE `tarefa_aula`
  ADD PRIMARY KEY (`idTarefa`),
  ADD KEY `idAula` (`idAula`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idTurma`),
  ADD KEY `idEscola` (`idEscola`);

--
-- Índices de tabela `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  ADD KEY `idTurma` (`idTurma`),
  ADD KEY `fk_idUsuario_disciplina` (`idUsuario`),
  ADD KEY `fk_docente_idDisciplina` (`idDisciplina`);

--
-- Índices de tabela `turma_fund1_responsavel`
--
ALTER TABLE `turma_fund1_responsavel`
  ADD KEY `idTurma` (`idTurma`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `cpfUsuario` (`cpfUsuario`),
  ADD KEY `fk_idEscola` (`idEscola`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aula`
--
ALTER TABLE `aula`
  MODIFY `idAula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `idCardapio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `comentario_aula`
--
ALTER TABLE `comentario_aula`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `docente_disciplina`
--
ALTER TABLE `docente_disciplina`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `escola`
--
ALTER TABLE `escola`
  MODIFY `idEscola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `media_aluno`
--
ALTER TABLE `media_aluno`
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tarefa_aula`
--
ALTER TABLE `tarefa_aula`
  MODIFY `idTarefa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE;

--
-- Restrições para tabelas `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `aula_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE,
  ADD CONSTRAINT `aula_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `aula_ibfk_3` FOREIGN KEY (`idDIsciplina`) REFERENCES `disciplina` (`idDisciplina`);

--
-- Restrições para tabelas `comentario_aula`
--
ALTER TABLE `comentario_aula`
  ADD CONSTRAINT `comentario_aula_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`),
  ADD CONSTRAINT `comentario_aula_ibfk_2` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`);

--
-- Restrições para tabelas `docente_disciplina`
--
ALTER TABLE `docente_disciplina`
  ADD CONSTRAINT `fk_idDisciplina` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `media_aluno`
--
ALTER TABLE `media_aluno`
  ADD CONSTRAINT `fk_idDisc` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`),
  ADD CONSTRAINT `fk_idTurm` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`),
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `fk_raAluno` FOREIGN KEY (`raAluno`) REFERENCES `aluno` (`raAluno`);

--
-- Restrições para tabelas `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`idEscola`) REFERENCES `escola` (`idEscola`) ON DELETE CASCADE;

--
-- Restrições para tabelas `presenca_aula`
--
ALTER TABLE `presenca_aula`
  ADD CONSTRAINT `presenca_aula_ibfk_1` FOREIGN KEY (`idAula`) REFERENCES `aula` (`idAula`) ON DELETE CASCADE,
  ADD CONSTRAINT `presenca_aula_ibfk_2` FOREIGN KEY (`raAluno`) REFERENCES `aluno` (`raAluno`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tarefa_aula`
--
ALTER TABLE `tarefa_aula`
  ADD CONSTRAINT `tarefa_aula_ibfk_1` FOREIGN KEY (`idAula`) REFERENCES `aula` (`idAula`) ON DELETE CASCADE;

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`idEscola`) REFERENCES `escola` (`idEscola`) ON DELETE CASCADE;

--
-- Restrições para tabelas `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  ADD CONSTRAINT `fk_docente_idDisciplina` FOREIGN KEY (`idDisciplina`) REFERENCES `docente_disciplina` (`idDisciplina`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_idUsuario_disciplina` FOREIGN KEY (`idUsuario`) REFERENCES `docente_disciplina` (`idUsuario`);

--
-- Restrições para tabelas `turma_fund1_responsavel`
--
ALTER TABLE `turma_fund1_responsavel`
  ADD CONSTRAINT `turma_fund1_responsavel_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`),
  ADD CONSTRAINT `turma_fund1_responsavel_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_idEscola` FOREIGN KEY (`idEscola`) REFERENCES `escola` (`idEscola`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
