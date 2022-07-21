-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Jul-2022 às 17:25
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `brutally_honest`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `movie_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `comment_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Animation'),
(4, 'Comedy'),
(5, 'Crime'),
(6, 'Documentary'),
(7, 'Drama'),
(8, 'Family'),
(9, 'Fantasy'),
(10, 'History'),
(11, 'Horror'),
(12, 'Music'),
(13, 'Mystery'),
(14, 'Romance'),
(15, 'Science Fiction'),
(16, 'TV Movie'),
(17, 'Thriller'),
(18, 'War'),
(19, 'Western');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movies`
--

CREATE TABLE `movies` (
  `id` int(10) UNSIGNED NOT NULL,
  `backdrop_path` varchar(240) NOT NULL,
  `title` varchar(64) NOT NULL,
  `overview` text NOT NULL,
  `poster_path` varchar(240) NOT NULL,
  `release_date` date NOT NULL,
  `duration` smallint(5) UNSIGNED NOT NULL,
  `trailer_link` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `movies`
--

INSERT INTO `movies` (`id`, `backdrop_path`, `title`, `overview`, `poster_path`, `release_date`, `duration`, `trailer_link`) VALUES
(1, '/nmGWzTLMXy9x7mKd8NKPLmHtWGa.jpg', 'Minions: The Rise of Gru', 'A fanboy of a supervillain supergroup known as the Vicious 6, Gru hatches a plan to become evil enough to join them, with the backup of his followers, the Minions.', '/wKiOkZTN9lUUUNZLmtnwubZYONg.jpg', '2022-06-29', 0, ''),
(2, '/393mh1AJ0GYWVD7Hsq5KkFaTAoT.jpg', 'Jurassic World Dominion', 'Four years after Isla Nublar was destroyed, dinosaurs now live—and hunt—alongside humans all over the world. This fragile balance will reshape the future and determine, once and for all, whether human beings are to remain the apex predators on a planet they now share with history’s most fearsome creatures.', '/kAVRgw7GgK1CfYEJq8ME6EvRIgU.jpg', '2022-06-01', 0, ''),
(3, '/7JytVNKaAQOFR2dFVpIIUsdwS15.jpg', 'Lightyear', 'Legendary Space Ranger Buzz Lightyear embarks on an intergalactic adventure alongside a group of ambitious recruits and his robot companion Sox.', '/vpILbP9eOQEtdQgl4vgjZUNY07r.jpg', '2022-06-15', 0, ''),
(4, '/odJ4hx6g6vBt4lBWKFD1tI8WS4x.jpg', 'Top Gun: Maverick', 'After more than thirty years of service as one of the Navy’s top aviators, and dodging the advancement in rank that would ground him, Pete “Maverick” Mitchell finds himself training a detachment of TOP GUN graduates for a specialized mission the likes of which no living pilot has ever seen.', '/62HCnUTziyWcpDaBO2i1DX17ljH.jpg', '2022-05-24', 0, ''),
(5, '/wcKFYIiVDvRURrzglV9kGu7fpfY.jpg', 'Doctor Strange in the Multiverse of Madness', 'Doctor Strange, with the help of mystical allies both old and new, traverses the mind-bending and dangerous alternate realities of the Multiverse to confront a mysterious new adversary.', '/9Gtg2DzBhmYamXBS1hKAhiwbBKS.jpg', '2022-05-04', 0, ''),
(6, '/tsC3DRGAQvkoA88lQQfbQ40byFS.jpg', 'The Black Phone', 'Finney Shaw, a shy but clever 13-year-old boy, is abducted by a sadistic killer and trapped in a soundproof basement where screaming is of little use. When a disconnected phone on the wall begins to ring, Finney discovers that he can hear the voices of the killer’s previous victims. And they are dead set on making sure that what happened to them doesn’t happen to Finney.', '/bxHZpV02OOu9vq3sb3MsOudEnYc.jpg', '2022-02-04', 0, ''),
(7, '/p1F51Lvj3sMopG948F5HsBbl43C.jpg', 'Thor: Love and Thunder', 'After his retirement is interrupted by Gorr the God Butcher, a galactic killer who seeks the extinction of the gods, Thor enlists the help of King Valkyrie, Korg, and ex-girlfriend Jane Foster, who now inexplicably wields Mjolnir as the Mighty Thor. Together they embark upon a harrowing cosmic adventure to uncover the mystery of the God Butcher’s vengeance and stop him before it’s too late.', '/pIkRyD18kl4FhoCNQuWxWu5cBLM.jpg', '2022-07-06', 0, ''),
(8, '/5PnypKiSj2efSPqThNjTXz8jwOg.jpg', 'The Princess', 'A beautiful, strong-willed young royal refuses to wed the cruel sociopath to whom she is betrothed and is kidnapped and locked in a remote tower of her father’s castle. With her scorned, vindictive suitor intent on taking her father’s throne, the princess must protect her family and save the kingdom.', '/gt9s8TtZZ36TXF1CE1y19rSpOZu.jpg', '2022-06-16', 0, ''),
(9, '/jazlkwXfw4KdF6fVTRsolOvRCmu.jpg', 'The Ledge', 'A rock climbing adventure between two friends turns into a terrifying nightmare. After Kelly captures the murder of her best friend on camera, she becomes the next target of a tight-knit group of friends who will stop at nothing to destroy the evidence and anyone in their way. Desperate for her safety, she begins a treacherous climb up a mountain cliff and her survival instincts are put to the test when she becomes trapped with the killers just 20 feet away.', '/mKFT6Q7PjrRLYuPLfmH4WLCXOiD.jpg', '2022-02-18', 0, ''),
(10, '/egoyMDLqCxzjnSrWOz50uLlJWmD.jpg', 'Sonic the Hedgehog 2', 'After settling in Green Hills, Sonic is eager to prove he has what it takes to be a true hero. His test comes when Dr. Robotnik returns, this time with a new partner, Knuckles, in search for an emerald that has the power to destroy civilizations. Sonic teams up with his own sidekick, Tails, and together they embark on a globe-trotting journey to find the emerald before it falls into the wrong hands.', '/6DrHO1jr3qVrViUO6s6kFiAGM7.jpg', '2022-03-30', 0, ''),
(11, '/zGLHX92Gk96O1DJvLil7ObJTbaL.jpg', 'Fantastic Beasts: The Secrets of Dumbledore', 'Professor Albus Dumbledore knows the powerful, dark wizard Gellert Grindelwald is moving to seize control of the wizarding world. Unable to stop him alone, he entrusts magizoologist Newt Scamander to lead an intrepid team of wizards and witches. They soon encounter an array of old and new beasts as they clash with Grindelwald\'s growing legion of followers.', '/8ZbybiGYe8XM4WGmGlhF0ec5R7u.jpg', '2022-04-06', 0, ''),
(12, '/t9K8ycUBCplWiICDOKRNRYcEH9e.jpg', 'Jujutsu Kaisen 0', 'Yuta Okkotsu is a nervous high school student who is suffering from a serious problem—his childhood friend Rika has turned into a curse and won\'t leave him alone. Since Rika is no ordinary curse, his plight is noticed by Satoru Gojo, a teacher at Jujutsu High, a school where fledgling exorcists learn how to combat curses. Gojo convinces Yuta to enroll, but can he learn enough in time to confront the curse that haunts him?', '/3pTwMUEavTzVOh6yLN0aEwR7uSy.jpg', '2021-12-24', 0, ''),
(13, '/t0mwKhUDa62hdhdKSsN4xMfhY5Z.jpg', 'Dog', 'An army ranger and his dog embark on a road trip along the Pacific Coast Highway to attend a friend\'s funeral.', '/rkpLvPDe0ZE62buUS32exdNr7zD.jpg', '2022-02-17', 0, ''),
(14, '/ocUp7DJBIc8VJgLEw1prcyK1dYv.jpg', 'Spider-Man: No Way Home', 'Peter Parker is unmasked and no longer able to separate his normal life from the high-stakes of being a super-hero. When he asks for help from Doctor Strange the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man.', '/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg', '2021-12-15', 0, ''),
(15, '/1Ds7xy7ILo8u2WWxdnkJth1jQVT.jpg', 'The Lost City', 'A reclusive romance novelist was sure nothing could be worse than getting stuck on a book tour with her cover model until a kidnapping attempt sweeps them both into a cutthroat jungle adventure, proving life can be so much stranger, and more romantic, than any of her paperback fictions.', '/neMZH82Stu91d3iqvLdNQfqPPyl.jpg', '2022-03-24', 0, ''),
(16, '/vjnLXptqdxnpNJer5fWgj2OIGhL.jpg', 'Memory', 'Alex, an assassin-for-hire, finds that he\'s become a target after he refuses to complete a job for a dangerous criminal organization. With the crime syndicate and FBI in hot pursuit, Alex has the skills to stay ahead, except for one thing: he is struggling with severe memory loss, affecting his every move. Alex must question his every action and whom he can ultimately trust.', '/4Q1n3TwieoULnuaztu9aFjqHDTI.jpg', '2022-04-28', 0, ''),
(17, '/gG9fTyDL03fiKnOpf2tr01sncnt.jpg', 'Morbius', 'Dangerously ill with a rare blood disorder, and determined to save others suffering his same fate, Dr. Michael Morbius attempts a desperate gamble. What at first appears to be a radical success soon reveals itself to be a remedy potentially worse than the disease.', '/6JjfSchsU6daXk2AKX8EEBjO3Fm.jpg', '2022-03-30', 0, ''),
(18, '/g3pG27i0v6eKWDKLf4GQsKZxmZX.jpg', 'Hot Seat', 'An ex-hacker is forced to break into high-level banking institutions, another man must try to penetrate the booby-trapped building to get the young man off the hot seat.', '/TUmSO5EPIZAfRSOEjmbrgbTw8i.jpg', '2022-07-01', 0, ''),
(19, '/qBu6blwnOA75Hz61QHrNe8unUNw.jpg', 'Collision', 'Over the course of one fateful day, a corrupt businessman and his socialite wife race to save their daughter from a notorious crime lord.', '/4zsihgkxMZ7MrflNCjkD3ySFJtc.jpg', '2022-06-16', 0, ''),
(20, '/mTupUmnuwwAyA0CNqpwaZn5mqjk.jpg', 'WarHunt', '1945. A U.S. military cargo plane loses control and violently crashes behind enemy lines in the middle of the German black forest. Major Johnson sends a squad of his bravest soldiers on a rescue mission to retrieve the top-secret material the plane was carrying, led by Sergeants Brewer and Walsh. They soon discover hanged Nazi soldiers and other dead bodies bearing ancient, magical symbols. Suddenly their compasses fail, their perceptions twist and straying from the group leads to profound horrors as they are attacked by a powerful, supernatural force.', '/9HFFwZOTBB7IPFmn9E0MXdWave3.jpg', '2022-01-21', 0, ''),
(21, '/uR0FopHrAjDlG5q6PZB07a1JOva.jpg', 'Dragon Ball Super: Super Hero', 'The Red Ribbon Army, an evil organization that was once destroyed by Goku in the past, has been reformed by a group of people who have created new and mightier Androids, Gamma 1 and Gamma 2, and seek vengeance against Goku and his family.', '/rugyJdeoJm7cSJL1q4jBpTNbxyU.jpg', '2022-06-11', 0, ''),
(22, '/o31kGDH9GbAZjVLwPYno8XvQGV2.jpg', '9 Bullets', 'A former burlesque dancer turned author discovers a second chance at life and redemption when she risks everything to rescue her young neighbor after he witnesses his parents’ murder. Now on the run from the local crime boss, who happens to be her longtime ex, she makes a desperate attempt to get the boy to safety.', '/cuFPxoFopAjFUz4oIMUzpzeTA8I.jpg', '2022-04-14', 0, ''),
(23, '/fqw8nJLPRgKRyFSDC0xBsC06NGC.jpg', 'The Northman', 'Prince Amleth is on the verge of becoming a man when his father is brutally murdered by his uncle, who kidnaps the boy\'s mother. Two decades later, Amleth is now a Viking who\'s on a mission to save his mother, kill his uncle and avenge his father.', '/8p9zXB7M78nZpm215zHfqpknMeM.jpg', '2022-04-07', 0, ''),
(24, '/fOy2Jurz9k6RnJnMUMRDAgBwru2.jpg', 'Turning Red', 'Thirteen-year-old Mei is experiencing the awkwardness of being a teenager with a twist – when she gets too excited, she transforms into a giant red panda.', '/qsdjk9oAKSQMWs0Vt5Pyfh6O4GZ.jpg', '2022-03-10', 0, ''),
(25, '/iOFBH9KtjKMntbP2kheeOpMQTcC.jpg', 'The Man from Toronto', 'In a case of mistaken identity, the world’s deadliest assassin, known as the Man from Toronto, and a New York City screw-up are forced to team up after being confused for each other at an Airbnb.', '/uTCfTibqtk4f90cC59bLPMOmsfc.jpg', '2022-06-24', 0, ''),
(26, '/b1L7qevxiVpkVFq4dmdQPGFPWH0.jpg', 'The Exorcism of God', 'An American priest working in Mexico is considered a saint by many local parishioners. However, due to a botched exorcism, he carries a secret that’s eating him alive until he gets an opportunity to face his demon one final time.', '/hangTmbxpSV4gpHG7MgSlCWSSFa.jpg', '2022-03-11', 0, ''),
(27, '/l83VzRBverTuAFyh9N9dMYsPr4m.jpg', 'American Sicario', 'The story of the rise and fall of the first American-born drug lord in Mexico, this tale of power, money, greed and betrayal amongst rival members of the drug cartels finds American gangster Erik Vasquez scheming to become the top dog in the Mexican underworld, only to find himself making enemies out of both the powerful cartels and his own allies.', '/nQRPSUmHGLrFRPK6v3BI1frAM1O.jpg', '2021-12-10', 0, ''),
(28, '/IYUD7rAIXzBM91TT3Z5fILUS7n.jpg', 'The Batman', 'In his second year of fighting crime, Batman uncovers corruption in Gotham City that connects to his own family while facing a serial killer known as the Riddler.', '/74xTEgt7R36Fpooo50r9T25onhq.jpg', '2022-03-01', 0, ''),
(29, '/ulkWS7Atv0vv33KVCSAmNizAmJd.jpg', 'Spiderhead', 'A prisoner in a state-of-the-art penitentiary begins to question the purpose of the emotion-controlling drugs he\'s testing for a pharmaceutical genius.', '/5hTK0J9SGPLSTFwcbU0ELlJsnAY.jpg', '2022-06-15', 0, ''),
(30, '/jVGHRpSgtE2MQLJhC5q4lXmPNQW.jpg', 'Shark Bait', 'A group of friends enjoying a weekend steal a couple of jetskis racing them out to sea, ending up in a horrific head-on collision. They struggle to find a way home with a badly injured friend while from the waters below predators lurk.', '/mVVU9zC8snNHlcqYONY2HOsh9ob.jpg', '2022-05-13', 0, ''),
(31, '/v7hdWmLh6VLgZQgkbHDxAa17M47.jpg', 'Centauro', 'Rafa\'s hooked on the pure, fiery feelings he gets from speed racing, but when his kid\'s mom gets mixed up with drug dealers, he burns rubber to save her.', '/wOx97MJOxEoR38aoya3lopyrlYC.jpg', '2022-06-15', 0, ''),
(32, '/riyxG4iMQID7GovFPEGI3czQMYz.jpg', 'Last Seen Alive', 'After Will Spann\'s wife suddenly vanishes at a gas station, his desperate search to find her leads him down a dark path that forces him to run from authorities and take the law into his own hands.', '/qvqyDj34Uivokf4qIvK4bH0m0qF.jpg', '2022-05-19', 0, ''),
(33, '/wUwizGzbTk5CTiKBnE4Pq1MONwD.jpg', 'The Sea Beast', 'The life of a legendary sea monster hunter is turned upside down when a young girl stows away on his ship.', '/ro3uuFrRxPI8bm6x9IavCr3nbCX.jpg', '2022-06-24', 0, ''),
(34, '/aEGiJJP91HsKVTEPy1HhmN0wRLm.jpg', 'Uncharted', 'A young street-smart, Nathan Drake and his wisecracking partner Victor “Sully” Sullivan embark on a dangerous pursuit of “the greatest treasure never found” while also tracking clues that may lead to Nathan’s long-lost brother.', '/rJHC1RUORuUhtfNb4Npclx0xnOf.jpg', '2022-02-10', 0, ''),
(35, '/qp8qKiP7Q7zK4z3LItwWMHfV9kJ.jpg', 'The Desperate Hour', 'A woman desperately races to save her child after police place her hometown on lockdown due to an active shooter incident.', '/u6Pg9eTklhg6Aa7kXaxrfdE1Chi.jpg', '2021-09-12', 0, ''),
(36, '/rmhMB6KBxdSYatfiFoas60uF6Fc.jpg', 'Father Stu', 'The true-life story of boxer-turned-priest. When an injury ends his amateur boxing career, Stuart Long moves to Los Angeles to find money and fame. While scraping by as a supermarket clerk, he meets Carmen, a Sunday school teacher who seems immune to his bad-boy charm. Determined to win her over, the longtime agnostic starts going to church to impress her. However, a motorcycle accident leaves him wondering if he can use his second chance to help others, leading to the surprising realization that he\'s meant to be a Catholic priest.', '/pLAeWgqXbTeJ2gQtNvRmdIncYsk.jpg', '2022-04-13', 0, ''),
(37, '/hGr0FrLI74vqpBWTBOPloDBwOAK.jpg', 'Hustle', 'After discovering a once-in-a-lifetime player with a rocky past abroad, a down on his luck basketball scout takes it upon himself to bring the phenom to the States without his team\'s approval. Against the odds, they have one final shot to prove they have what it takes to make it in the NBA.', '/fVf4YHHkRfo1uuljpWBViEGmaUQ.jpg', '2022-06-03', 0, ''),
(38, '/tzNx4y7kYf1Xw3F3T6QxrE7PPwb.jpg', 'See for Me', 'When blind former skier Sophie cat-sits in a secluded mansion, three thieves invade for the hidden safe. Sophie\'s only defense is army veteran Kelly, who she meets on the See For Me app. Kelly helps Sophie defend herself against the invaders and survive.', '/qk1ZERG6yhwAJqTobmDgw8jRL2C.jpg', '2022-01-07', 0, ''),
(39, '/3G1Q5xF40HkUBJXxt2DQgQzKTp5.jpg', 'Encanto', 'The tale of an extraordinary family, the Madrigals, who live hidden in the mountains of Colombia, in a magical house, in a vibrant town, in a wondrous, charmed place called an Encanto. The magic of the Encanto has blessed every child in the family—every child except one, Mirabel. But when she discovers that the magic surrounding the Encanto is in danger, Mirabel decides that she, the only ordinary Madrigal, might just be her exceptional family\'s last hope.', '/4j0PNHkMr5ax3IA8tjtxcmPU3QT.jpg', '2021-11-24', 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(252) NOT NULL,
  `password` varchar(124) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'rafael', 'rafael@email.com', '123456789', 1),
(2, 'jose', 'jose@example.com', '123456789', 0),
(3, 'antonio', 'antonio@example.com', '123456789', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `votes`
--

CREATE TABLE `votes` (
  `movie_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `value` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `votes`
--

INSERT INTO `votes` (`movie_id`, `user_id`, `value`) VALUES
(1, 1, '8.0'),
(1, 2, '4.0'),
(1, 3, '10.0');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Índices para tabela `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`movie_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `FK movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
