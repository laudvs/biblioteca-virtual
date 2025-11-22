-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/11/2025 às 05:25
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `booklovers`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `livro_id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `comentario` text NOT NULL,
  `nota` int(11) DEFAULT NULL,
  `data` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `livro_id`, `usuario`, `comentario`, `nota`, `data`) VALUES
(1, 2, 'laurah', 'livro muito bom, me tirou da ressaca literária', 5, '2025-11-18 00:36:41'),
(2, 4, 'laurah', 'gostei dele, livro bom', 3, '2025-11-18 19:31:46'),
(3, 4, 'lulu', 'o melhor livro da minha vida!', 5, '2025-11-18 19:35:54'),
(4, 3, 'ale', 'odiei', 1, '2025-11-18 19:43:01'),
(5, 3, 'lorena', 'amei!', 5, '2025-11-18 19:44:06'),
(8, 9, 'ale', 'não gostei muito da leitura', 3, '2025-11-18 19:52:13'),
(9, 7, 'ale', 'muito emocionante e tocante', 5, '2025-11-18 19:52:44'),
(10, 10, 'rennan', 'meu ano de nascimento', 3, '2025-11-18 20:45:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `capa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `usuario_id`, `titulo`, `autor`, `descricao`, `imagem`, `capa`) VALUES
(2, 1, 'Os Primos', 'Karen M. McManus', 'Milly, Aubrey e Jonah recebem um convite inusitado: passar o verão no resort da avó que nunca viram na vida. Seus pais acreditam que é a oportunidade perfeita para fazer as pazes com a rica e excêntrica Mildred Story, que cortou relações com todos há mais de duas décadas sem maiores explicações. Mas ao chegarem lá, os primos percebem que a família guarda muitos segredos. E eles irão tentar desvendar todos.', NULL, 'https://m.media-amazon.com/images/I/A1I3LSldNDS._SL1500_.jpg'),
(3, 1, 'Coraline', 'Neil Gaiman', 'Ao abrir uma porta misteriosa na sala de casa, a menina se depara com um lugar macabro e fascinante. Ali, naquele outro mundo, seus outros pais são criaturas muito pálidas, com botões negros no lugar dos olhos, sempre dispostos a lhe dar atenção, fazer suas comidas preferidas e mostrar os brinquedos mais divertidos. Coraline enfim se sente... em casa. Mas essa sensação logo desaparece, quando ela descobre que o lugar guarda mistérios e perigos, e a menina se dá conta de que voltar para sua verdadeira casa vai ser muito mais difícil e assustador do que imaginava.', NULL, 'https://m.media-amazon.com/images/I/91DZobBc1BL._SL1500_.jpg'),
(4, 2, 'Vidas Secas', 'Graciliano Ramos', 'Vidas secas nos transporta para o sertão nordestino, mostrando a dura jornada humana na luta contra a seca e a pobreza, revelando as esperanças e os desafios enfrentados por Fabiano, Sinha Vitória e sua família.', NULL, 'https://m.media-amazon.com/images/I/81EZofhY1jL._SL1500_.jpg'),
(5, 2, 'Jorge Amado', 'Capitães de Areia', 'Verdadeiro romance de formação, o livro nos torna íntimos de suas pequenas criaturas, cada uma delas com suas carências e suas ambições: do líder Pedro Bala ao religioso Pirulito, do ressentido e cruel Sem-Pernas ao aprendiz de cafetão Gato, do sensato Professor ao rústico sertanejo Volta Seca. Com a força envolvente da sua prosa, Jorge Amado nos aproxima desses garotos e nos contagia com seu intenso desejo de liberdade.', NULL, 'https://m.media-amazon.com/images/I/81t7altQZxL._SL1500_.jpg'),
(6, 3, 'Lembra aquela vez', 'Adam Silveira ', 'Enquanto sua mãe confere folhetos do Leteo, um novo e polêmico instituto que realiza cirurgias para apagar memórias dolorosas, Aaron se reaproxima de sua devotada namorada, Genevieve, que o apoiou nos momentos difíceis, e da galera do seu bairro, que não teve a mesma atitude. Então, Aaron conhece Thomas, um garoto do conjunto habitacional vizinho.', NULL, 'https://m.media-amazon.com/images/I/813hYXQ+aVL._SL1500_.jpg'),
(7, 3, 'Aristóteles e Dante descobrem os segredos do Universo', 'Benjamin Alire Sáenz', 'Dante sabe nadar. Ari não. Dante é articulado e confiante. Ari tem dificuldade com as palavras e duvida de si mesmo. Dante é apaixonado por poesia e arte. Ari se perde em pensamentos sobre seu irmão mais velho, que está na prisão.\r\nUm garoto como Dante, com um jeito tão único de ver o mundo, deveria ser a última pessoa capaz de romper as barreiras que Ari construiu em volta de si. Mas quando os dois se conhecem, logo surge uma forte ligação.', NULL, 'https://m.media-amazon.com/images/I/91B3t9R7zTS._SL1500_.jpg'),
(8, 5, 'É assim que acaba', 'Colleen Hoover', 'É assim que acaba é uma narrativa poderosa sobre a força necessária para fazer as escolhas certas nas situações mais difíceis. Considerada a obra mais pessoal de Hoover, o livro aborda sem medo alguns tabus da sociedade para explorar a complexidade das relações tóxicas, e como o amor e o abuso muitas vezes coexistem em uma confusão de sentimentos.', NULL, 'https://m.media-amazon.com/images/I/91r5G8RxqfL._SL1500_.jpg'),
(9, 5, 'Orgulho e Preconceito', 'Jane Austen', 'Austen nos apresenta Elizabeth Bennet como heroína irresistível e seu pretendente aristocrático, o sr. Darcy. Nesse livro, aspectos diferentes são abordados: orgulho encontra preconceito, ascendência social confronta desprezo social, equívocos e julgamentos antecipados conduzem alguns personagens ao sofrimento e ao escândalo.', NULL, 'https://m.media-amazon.com/images/I/719esIW3D7L._SL1297_.jpg'),
(10, 9, '1984', 'George Orwell ', 'O trabalho de Winston, o herói de 1984, é reescrever artigos de jornais do passado, de modo que o registro histórico sempre apoie a ideologia do Partido. Grande parte do Ministério também destrói os documentos que não foram revisados, dessa forma não há como provar que o governo esteja mentindo. Winston é um trabalhador diligente e habilidoso, mas odeia secretamente o Partido e sonha com a rebelião contra o Grande Irmão.', NULL, 'https://m.media-amazon.com/images/I/61t0bwt1s3L._SL1000_.jpg'),
(11, 9, 'A Metamorfose ', 'Franz Kafka', 'O caixeiro-viajante Gregor acorda metamorfoseado em um enorme inseto e percebe que tudo mudou e não só em sua vida, mas no mundo. Ele, então, acompanha as reações de sua família ao perceberem o estranho ser em que ele se tornou. E, enquanto luta para se manter vivo, reflete sobre o comportamento de seus pais, de sua irmã e sobre a sua nova vida.', NULL, 'https://m.media-amazon.com/images/I/715JOcuqSSL._SL1021_.jpg'),
(12, 9, 'Declínio de um Homem', 'Ozamu Dazai', 'A obra sintetiza em cenas e passagens notoriamente biográficas muitas das angústias que tanto alimentavam a personalidade autodestrutiva do autor, a saber: a dificuldade de entendimento com seus familiares, sua antissociabilidade niilista, seu patológico apego ao álcool - vício do qual nunca conseguiu se livrar -, sua autoestima inexistente, enfim, sua evidente sensação de deslocamento em relação ao mundo - como se tivesse sido enviado à existência por mero descuido. ', NULL, 'https://m.media-amazon.com/images/I/81sblL-t2iL._SL1417_.jpg'),
(14, 1, 'As Quatro rainhas Mortas', 'Astrid Scholte', 'Quando Keralie Corrington, a melhor e mais hábil larápia de Toria, rouba Varin, um mensageiro eonista, um labirinto começa a se formar, conduzindo-os à cena do crime que costura toda a narrativa da história: o palácio real. Num movimento contínuo de fuga e proximidade, os dois enredam-se numa teia de conspiração ao tentarem, incansavalmente, impedir os assassinatos antes que seja tarde demais.', NULL, 'https://m.media-amazon.com/images/I/91tiPrQv-uL._SL1500_.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo` enum('user','admin') NOT NULL DEFAULT 'user',
  `primeiro_acesso` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `senha`, `data_criacao`, `tipo`, `primeiro_acesso`) VALUES
(1, 'laurah', 'laurah@gmail.com', '$2y$10$OSx1ZxHGlTPOhEm5REpmQedw4hpYYmCBT39xygDIIfQFEq.x61eWq', '2025-11-04 02:43:25', 'user', 0),
(2, 'lulu', 'lulu@gmail.com', '$2y$10$4tHEDMWp9ov3kXk1.kWzn.FHA.vGMJnly53aVLeQFwWBUwwEAdusq', '2025-11-04 18:33:59', 'user', 0),
(3, 'ale', 'ale@gmail.com', '$2y$10$uYJ2TUT10RxHVcpgFSNTf.NezNE0TbXlit1gPe/IONbcY795ilz/2', '2025-11-04 22:26:54', 'user', 0),
(4, 'rennan', 'rennan@gmail.com', '$2y$10$lGOjekKqpjQ8k.ZcXH4HI.33KCqNgev8.WtJ3UHeKsUN0Y9Y14W9y', '2025-11-04 22:59:10', 'user', 0),
(5, 'lorena', 'lorena@gmail.com', '$2y$10$jjbwzWqAPIYG7lotbmhyyOHDULbevz.y2JfTHu0wj326IjMHCZBYu', '2025-11-16 03:09:07', 'user', 0),
(7, 'admin', 'admin@gmail.com', '$2y$10$VDi6/hoM8Wb0p1hZL8LmmegpOwjQpvkKaG1fryDi0rpwYH2szitgu', '2025-11-18 03:20:08', 'admin', 0),
(8, 'admin2', 'admin2@gmail.com', '$2y$10$0w.2ucSEN/Eczy6Qm3oygODnj.riXxaxJ1AJO9oD7hYd1vGogytpG', '2025-11-18 04:33:26', 'admin', 0),
(9, 'gabriel', 'gabriel@gmail.com', '$2y$10$hIL0KKpXn83SqqYFP7qpE.snWh.CDTrZKu1cKAxjYs/NMsXzhrIKu', '2025-11-18 22:53:56', 'user', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livro_id` (`livro_id`);

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_livro` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`);

--
-- Restrições para tabelas `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `fk_usuario_livro` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
