-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 07 oct. 2021 à 15:09
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdfilmsjoaniekaven`
--
CREATE DATABASE IF NOT EXISTS `bdfilmsjoaniekaven` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bdfilmsjoaniekaven`;

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `idMembre` int(11) NOT NULL,
  `courriel` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `motDePasse` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `statut` int(11) NOT NULL,
  `role` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`idMembre`, `courriel`, `motDePasse`, `statut`, `role`) VALUES
(1, 'admin@gmail.com', 'Admin-12', 1, 'A'),
(2, 'asd@gmail.com', 'Test_123', 1, 'M');

-- --------------------------------------------------------

--
-- Structure de la table `filmgenre`
--

CREATE TABLE `filmgenre` (
  `idFilm` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `filmgenre`
--

INSERT INTO `filmgenre` (`idFilm`, `idGenre`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 3),
(3, 4),
(4, 6),
(4, 1),
(5, 4),
(5, 7),
(5, 8),
(6, 9),
(6, 1),
(6, 10),
(7, 3),
(7, 4),
(8, 11),
(8, 8),
(9, 12),
(9, 1),
(9, 4),
(10, 6),
(10, 10),
(10, 2),
(11, 13),
(11, 6),
(11, 4),
(12, 3),
(12, 4),
(13, 3),
(13, 4),
(13, 8),
(14, 9),
(14, 6),
(14, 1),
(15, 13),
(15, 3),
(15, 4),
(16, 9),
(16, 4),
(16, 10),
(17, 14),
(17, 11),
(17, 8),
(18, 6),
(18, 4),
(18, 15),
(19, 3),
(19, 4),
(20, 12),
(20, 4),
(20, 5),
(21, 4),
(21, 8),
(22, 13),
(22, 6),
(22, 16),
(23, 4),
(23, 17),
(24, 1),
(24, 4),
(24, 15),
(25, 4),
(25, 18),
(26, 3),
(26, 4),
(26, 8),
(27, 4),
(27, 15),
(28, 1),
(28, 3),
(29, 3),
(29, 4),
(29, 8),
(30, 3),
(30, 4),
(31, 1),
(31, 3),
(32, 3),
(32, 4),
(32, 11),
(33, 11),
(33, 8),
(34, 4),
(34, 2),
(34, 17),
(35, 11),
(35, 8),
(36, 3),
(36, 4),
(36, 8),
(37, 4),
(37, 19),
(38, 1),
(38, 2),
(38, 15),
(39, 4),
(39, 20),
(39, 15),
(40, 3),
(40, 4),
(40, 11),
(41, 12),
(41, 4),
(41, 21),
(42, 1),
(43, 4),
(44, 4),
(45, 9),
(45, 1),
(45, 4),
(46, 4),
(46, 8),
(47, 4),
(48, 4),
(49, 1),
(49, 4),
(49, 16),
(50, 1),
(50, 4),
(50, 15),
(51, 1),
(51, 4),
(52, 6),
(52, 2),
(53, 4),
(53, 15),
(54, 4),
(54, 15),
(55, 4),
(56, 4),
(56, 15),
(56, 8),
(57, 19),
(57, 11),
(57, 8),
(58, 13),
(58, 6),
(58, 3),
(59, 9),
(59, 13),
(59, 6),
(60, 9),
(60, 6),
(60, 1),
(61, 12),
(61, 4),
(61, 7),
(62, 9),
(62, 6),
(62, 1),
(63, 9),
(63, 6),
(63, 1),
(64, 1),
(64, 3),
(65, 12),
(65, 4),
(66, 12),
(66, 4),
(66, 17),
(67, 6),
(67, 12),
(67, 4),
(68, 4),
(68, 15),
(68, 17),
(69, 12),
(69, 3),
(69, 4),
(70, 12),
(70, 3),
(70, 4),
(71, 3),
(71, 4),
(72, 12),
(72, 3),
(72, 4),
(73, 13),
(73, 6),
(73, 2),
(74, 3),
(74, 4),
(74, 8),
(75, 4),
(75, 11),
(75, 8),
(76, 4),
(76, 15),
(77, 13),
(77, 6),
(77, 8),
(78, 9),
(78, 6),
(78, 10),
(79, 12),
(79, 1),
(79, 3),
(80, 13),
(80, 6),
(80, 2),
(81, 4),
(81, 14),
(81, 15),
(82, 1),
(83, 6),
(83, 1),
(83, 3),
(84, 6),
(84, 1),
(84, 16),
(85, 3),
(85, 4),
(86, 13),
(86, 6),
(86, 11),
(87, 13),
(87, 4),
(87, 8),
(88, 4),
(88, 16),
(88, 8),
(89, 1),
(89, 4),
(89, 15),
(90, 6),
(90, 10),
(90, 2),
(91, 12),
(91, 4),
(92, 13),
(92, 6),
(92, 16),
(93, 1),
(93, 3),
(93, 11),
(94, 4),
(94, 11),
(94, 15),
(95, 4),
(95, 16),
(96, 4),
(96, 8),
(97, 4),
(97, 17),
(98, 4),
(98, 15),
(98, 17),
(99, 12),
(99, 4),
(100, 12),
(100, 4),
(100, 15),
(101, 4),
(101, 15),
(102, 1),
(102, 4),
(103, 13),
(103, 4),
(103, 7),
(104, 4),
(104, 11),
(104, 8),
(105, 1),
(105, 4),
(106, 4),
(106, 15),
(107, 9),
(107, 6),
(107, 10),
(108, 4),
(108, 15),
(109, 4),
(110, 3),
(110, 4),
(111, 12),
(111, 4),
(111, 8),
(112, 6),
(112, 4),
(112, 16),
(113, 1),
(113, 3),
(113, 8),
(114, 6),
(114, 4),
(114, 8),
(115, 9),
(115, 6),
(115, 1),
(116, 3),
(116, 8),
(117, 6),
(117, 1),
(117, 4),
(118, 9),
(118, 6),
(118, 1),
(119, 13),
(119, 1),
(119, 3),
(120, 4),
(120, 11),
(120, 15),
(121, 9),
(121, 6),
(121, 1),
(122, 4),
(122, 15),
(123, 9),
(123, 6),
(123, 1),
(124, 6),
(125, 6),
(125, 2),
(126, 4),
(126, 15),
(127, 9),
(127, 6),
(127, 1),
(128, 13),
(128, 6),
(128, 4),
(129, 4),
(129, 11),
(129, 16),
(130, 12),
(130, 4),
(130, 15),
(131, 6),
(131, 4),
(131, 7),
(132, 12),
(132, 3),
(132, 4),
(133, 11),
(133, 15),
(133, 8),
(134, 4),
(134, 5),
(135, 4),
(135, 8),
(136, 4),
(136, 7),
(136, 17),
(137, 6),
(137, 4),
(137, 16),
(138, 3),
(138, 4),
(139, 3),
(139, 4),
(139, 11),
(140, 4),
(140, 11),
(141, 12),
(141, 1),
(141, 4),
(142, 1),
(142, 2),
(143, 4),
(143, 7),
(144, 4),
(145, 1);

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `idFilm` int(11) NOT NULL,
  `titre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `realisateurs` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `acteurs` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`idFilm`, `titre`, `annee`, `duree`, `realisateurs`, `acteurs`, `description`, `image`, `prix`) VALUES
(1, 'Beetlejuice', 1988, 92, 'Tim Burton', 'Alec Baldwin, Geena Davis, Annie McEnroe, Maurice Page', 'A couple of recently deceased ghosts contract the services of a \"bio-exorcist\" in order to remove the obnoxious new owners of their house.', 'Beetlejuice.jpg', 19.99),
(2, 'The Cotton Club', 1984, 127, 'Francis Ford Coppola', 'Richard Gere, Gregory Hines, Diane Lane, Lonette McKee', 'The Cotton Club was a famous night club in Harlem. The story follows the people that visited the club, those that ran it, and is peppered with the Jazz music that made it so famous.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTU5ODAyNzA4OV5BMl5BanBnXkFtZTcwNzYwNTIzNA@@._V1_SX300.jpg', 4.99),
(3, 'The Shawshank Redemption', 1994, 142, 'Frank Darabont', 'Tim Robbins, Morgan Freeman, Bob Gunton, William Sadler', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 'ShawshankRedemptionMoviePoster.jpg', 19.99),
(4, 'Crocodile Dundee', 1986, 97, 'Peter Faiman', 'Paul Hogan, Linda Kozlowski, John Meillon, David Gulpilil', 'An American reporter goes to the Australian outback to meet an eccentric crocodile poacher and invites him to New York City.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTg0MTU1MTg4NF5BMl5BanBnXkFtZTgwMDgzNzYxMTE@._V1_SX300.jpg', 4.99),
(5, 'Valkyrie', 2008, 121, 'Bryan Singer', 'Tom Cruise, Kenneth Branagh, Bill Nighy, Tom Wilkinson', 'A dramatization of the 20 July assassination and political coup plot by desperate renegade German Army officers against Hitler during World War II.', 'https://ia.media-imdb.com/images/M/MV5BMTg3Njc2ODEyN15BMl5BanBnXkFtZTcwNTAwMzc3NA@@._V1_SX300.jpg', 19.99),
(6, 'Ratatouille', 2007, 111, 'Brad Bird, Jan Pinkava', 'Patton Oswalt, Ian Holm, Lou Romano, Brian Dennehy', 'A rat who can cook makes an unusual alliance with a young kitchen worker at a famous restaurant.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTMzODU0NTkxMF5BMl5BanBnXkFtZTcwMjQ4MzMzMw@@._V1_SX300.jpg', 19.99),
(7, 'City of God', 2002, 130, 'Fernando Meirelles, KÃ¡tia Lund', 'Alexandre Rodrigues, Leandro Firmino, Phellipe Haagensen, Douglas Silva', 'Two boys growing up in a violent neighborhood of Rio de Janeiro take different paths: one becomes a photographer, the other a drug dealer.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjA4ODQ3ODkzNV5BMl5BanBnXkFtZTYwOTc4NDI3._V1_SX300.jpg', 19.99),
(8, 'Memento', 2000, 113, 'Christopher Nolan', 'Guy Pearce, Carrie-Anne Moss, Joe Pantoliano, Mark Boone Junior', 'A man juggles searching for his wife\'s murderer and keeping his short-term memory loss from being an obstacle.', 'Memento_poster.jpg', 19.99),
(9, 'The Intouchables', 2011, 112, 'Olivier Nakache, Eric Toledano', 'FranÃ§ois Cluzet, Omar Sy, Anne Le Ny, Audrey Fleurot', 'After he becomes a quadriplegic from a paragliding accident, an aristocrat hires a young man from the projects to be his caregiver.', 'https://ia.media-imdb.com/images/M/MV5BMTYxNDA3MDQwNl5BMl5BanBnXkFtZTcwNTU4Mzc1Nw@@._V1_SX300.jpg', 14.99),
(10, 'Stardust', 2007, 127, 'Matthew Vaughn', 'Ian McKellen, Bimbo Hart, Alastair MacIntosh, David Kelly', 'In a countryside town bordering on a magical land, a young man makes a promise to his beloved that he\'ll retrieve a fallen star by venturing into the magical realm.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjkyMTE1OTYwNF5BMl5BanBnXkFtZTcwMDIxODYzMw@@._V1_SX300.jpg', 14.99),
(11, 'Apocalypto', 2006, 139, 'Mel Gibson', 'Rudy Youngblood, Dalia HernÃ¡ndez, Jonathan Brewer, Morris Birdyellowhead', 'As the Mayan kingdom faces its decline, the rulers insist the key to prosperity is to build more temples and offer human sacrifices. Jaguar Paw, a young man captured for sacrifice, flees to avoid his fate.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNTM1NjYyNTY5OV5BMl5BanBnXkFtZTcwMjgwNTMzMQ@@._V1_SX300.jpg', 19.99),
(12, 'Taxi Driver', 1976, 113, 'Martin Scorsese', 'Diahnne Abbott, Frank Adu, Victor Argo, Gino Ardito', 'A mentally unstable Vietnam War veteran works as a night-time taxi driver in New York City where the perceived decadence and sleaze feeds his urge for violent action, attempting to save a preadolescent prostitute in the process.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNGQxNDgzZWQtZTNjNi00M2RkLWExZmEtNmE1NjEyZDEwMzA5XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 4.99),
(13, 'No Country for Old Men', 2007, 122, 'Ethan Coen, Joel Coen', 'Tommy Lee Jones, Javier Bardem, Josh Brolin, Woody Harrelson', 'Violence and mayhem ensue after a hunter stumbles upon a drug deal gone wrong and more than two million dollars in cash near the Rio Grande.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjA5Njk3MjM4OV5BMl5BanBnXkFtZTcwMTc5MTE1MQ@@._V1_SX300.jpg', 14.99),
(14, 'Planet 51', 2009, 91, 'Jorge Blanco, Javier Abad, Marcos MartÃ­nez', 'Jessica Biel, John Cleese, Gary Oldman, Dwayne Johnson', 'An alien civilization is invaded by Astronaut Chuck Baker, who believes that the planet was uninhabited. Wanted by the military, Baker must get back to his ship before it goes into orbit without him.', 'https://ia.media-imdb.com/images/M/MV5BMTUyOTAyNTA5Ml5BMl5BanBnXkFtZTcwODU2OTM0Mg@@._V1_SX300.jpg', 9.99),
(15, 'Looper', 2012, 119, 'Rian Johnson', 'Joseph Gordon-Levitt, Bruce Willis, Emily Blunt, Paul Dano', 'In 2074, when the mob wants to get rid of someone, the target is sent into the past, where a hired gun awaits - someone like Joe - who one day learns the mob wants to \'close the loop\' by sending back Joe\'s future self for assassination.', 'https://ia.media-imdb.com/images/M/MV5BMTY3NTY0MjEwNV5BMl5BanBnXkFtZTcwNTE3NDA1OA@@._V1_SX300.jpg', 9.99),
(16, 'Corpse Bride', 2005, 77, 'Tim Burton, Mike Johnson', 'Johnny Depp, Helena Bonham Carter, Emily Watson, Tracey Ullman', 'When a shy groom practices his wedding vows in the inadvertent presence of a deceased young woman, she rises from the grave assuming he has married her.', 'https://ia.media-imdb.com/images/M/MV5BMTk1MTY1NjU4MF5BMl5BanBnXkFtZTcwNjIzMTEzMw@@._V1_SX300.jpg', 4.99),
(17, 'The Third Man', 1949, 93, 'Carol Reed', 'Joseph Cotten, Alida Valli, Orson Welles, Trevor Howard', 'Pulp novelist Holly Martins travels to shadowy, postwar Vienna, only to find himself investigating the mysterious death of an old friend, Harry Lime.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjMwNzMzMTQ0Ml5BMl5BanBnXkFtZTgwNjExMzUwNjE@._V1_SX300.jpg', 14.99),
(18, 'The Beach', 2000, 119, 'Danny Boyle', 'Leonardo DiCaprio, Daniel York, Patcharawan Patarakijjanon, Virginie Ledoyen', 'Twenty-something Richard travels to Thailand and finds himself in possession of a strange map. Rumours state that it leads to a solitary beach paradise, a tropical bliss - excited and intrigued, he sets out to find it.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BN2ViYTFiZmUtOTIxZi00YzIxLWEyMzUtYjQwZGNjMjNhY2IwXkEyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_SX300.jpg', 4.99),
(19, 'Scarface', 1983, 170, 'Brian De Palma', 'Al Pacino, Steven Bauer, Michelle Pfeiffer, Mary Elizabeth Mastrantonio', 'In Miami in 1980, a determined Cuban immigrant takes over a drug cartel and succumbs to greed.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjAzOTM4MzEwNl5BMl5BanBnXkFtZTgwMzU1OTc1MDE@._V1_SX300.jpg', 4.99),
(20, 'Sid and Nancy', 1986, 112, 'Alex Cox', 'Gary Oldman, Chloe Webb, David Hayman, Debby Bishop', 'Morbid biographical story of Sid Vicious, bassist with British punk group the Sex Pistols, and his girlfriend Nancy Spungen. When the Sex Pistols break up after their fateful US tour, ...', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjExNjA5NzY4M15BMl5BanBnXkFtZTcwNjQ2NzI5NA@@._V1_SX300.jpg', 4.99),
(21, 'Black Swan', 2010, 108, 'Darren Aronofsky', 'Natalie Portman, Mila Kunis, Vincent Cassel, Barbara Hershey', 'A committed dancer wins the lead role in a production of Tchaikovsky\'s \"Swan Lake\" only to find herself struggling to maintain her sanity.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNzY2NzI4OTE5MF5BMl5BanBnXkFtZTcwMjMyNDY4Mw@@._V1_SX300.jpg', 9.99),
(22, 'Inception', 2010, 148, 'Christopher Nolan', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page, Tom Hardy', 'A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SX300.jpg', 19.99),
(23, 'The Deer Hunter', 1978, 183, 'Michael Cimino', 'Robert De Niro, John Cazale, John Savage, Christopher Walken', 'An in-depth examination of the ways in which the U.S. Vietnam War impacts and disrupts the lives of people in a small industrial town in Pennsylvania.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTYzYmRmZTQtYjk2NS00MDdlLTkxMDAtMTE2YTM2ZmNlMTBkXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 9.99),
(24, 'Chasing Amy', 1997, 113, 'Kevin Smith', 'Ethan Suplee, Ben Affleck, Scott Mosier, Jason Lee', 'Holden and Banky are comic book artists. Everything\'s going good for them until they meet Alyssa, also a comic book artist. Holden falls for her, but his hopes are crushed when he finds out she\'s gay.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BZDM3MTg2MGUtZDM0MC00NzMwLWE5NjItOWFjNjA2M2I4YzgxXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 4.99),
(25, 'Django Unchained', 2012, 165, 'Quentin Tarantino', 'Jamie Foxx, Christoph Waltz, Leonardo DiCaprio, Kerry Washington', 'With the help of a German bounty hunter, a freed slave sets out to rescue his wife from a brutal Mississippi plantation owner.', 'https://ia.media-imdb.com/images/M/MV5BMjIyNTQ5NjQ1OV5BMl5BanBnXkFtZTcwODg1MDU4OA@@._V1_SX300.jpg', 19.99),
(26, 'The Silence of the Lambs', 1991, 118, 'Jonathan Demme', 'Jodie Foster, Lawrence A. Bonney, Kasi Lemmons, Lawrence T. Wrentz', 'A young F.B.I. cadet must confide in an incarcerated and manipulative killer to receive his help on catching another serial killer who skins his victims.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQ2NzkzMDI4OF5BMl5BanBnXkFtZTcwMDA0NzE1NA@@._V1_SX300.jpg', 14.99),
(27, 'American Beauty', 1999, 122, 'Sam Mendes', 'Kevin Spacey, Annette Bening, Thora Birch, Wes Bentley', 'A sexually frustrated suburban father has a mid-life crisis after becoming infatuated with his daughter\'s best friend.', 'American_Beauty_1999_film_poster.jpg', 19.99),
(28, 'Snatch', 2000, 102, 'Guy Ritchie', 'Benicio Del Toro, Dennis Farina, Vinnie Jones, Brad Pitt', 'Unscrupulous boxing promoters, violent bookmakers, a Russian gangster, incompetent amateur robbers, and supposedly Jewish jewelers fight to track down a priceless stolen diamond.', 'https://ia.media-imdb.com/images/M/MV5BMTA2NDYxOGYtYjU1Mi00Y2QzLTgxMTQtMWI1MGI0ZGQ5MmU4XkEyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_SX300.jpg', 14.99),
(29, 'Midnight Express', 1978, 121, 'Alan Parker', 'Brad Davis, Irene Miracle, Bo Hopkins, Paolo Bonacelli', 'Billy Hayes, an American college student, is caught smuggling drugs out of Turkey and thrown into prison.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQyMDA5MzkyOF5BMl5BanBnXkFtZTgwOTYwNTcxMTE@._V1_SX300.jpg', 14.99),
(30, 'Pulp Fiction', 1994, 154, 'Quentin Tarantino', 'Tim Roth, Amanda Plummer, Laura Lovelace, John Travolta', 'The lives of two mob hit men, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTkxMTA5OTAzMl5BMl5BanBnXkFtZTgwNjA5MDc3NjE@._V1_SX300.jpg', 4.99),
(31, 'Lock, Stock and Two Smoking Barrels', 1998, 107, 'Guy Ritchie', 'Jason Flemyng, Dexter Fletcher, Nick Moran, Jason Statham', 'A botched card game in London triggers four friends, thugs, weed-growers, hard gangsters, loan sharks and debt collectors to collide with each other in a series of unexpected events, all for the sake of weed, cash and two antique shotguns.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTAyN2JmZmEtNjAyMy00NzYwLThmY2MtYWQ3OGNhNjExMmM4XkEyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_SX300.jpg', 4.99),
(32, 'Lucky Number Slevin', 2006, 110, 'Paul McGuigan', 'Josh Hartnett, Bruce Willis, Lucy Liu, Morgan Freeman', 'A case of mistaken identity lands Slevin into the middle of a war being plotted by two of the city\'s most rival crime bosses: The Rabbi and The Boss. Slevin is under constant surveillance by relentless Detective Brikowski as well as the infamous assassin Goodkat and finds himself having to hatch his own ingenious plot to get them before they get him.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMzc1OTEwMTk4OF5BMl5BanBnXkFtZTcwMTEzMDQzMQ@@._V1_SX300.jpg', 19.99),
(33, 'Rear Window', 1954, 112, 'Alfred Hitchcock', 'James Stewart, Grace Kelly, Wendell Corey, Thelma Ritter', 'A wheelchair-bound photographer spies on his neighbours from his apartment window and becomes convinced one of them has committed murder.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNGUxYWM3M2MtMGM3Mi00ZmRiLWE0NGQtZjE5ODI2OTJhNTU0XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 4.99),
(34, 'Pan\'s Labyrinth', 2006, 118, 'Guillermo del Toro', 'Ivana Baquero, Sergi LÃ³pez, Maribel VerdÃº, Doug Jones', 'In the falangist Spain of 1944, the bookish young stepdaughter of a sadistic army officer escapes into an eerie but captivating fantasy world.', 'Pan\'s_Labyrinth.jpg', 4.99),
(35, 'Shutter Island', 2010, 138, 'Martin Scorsese', 'Leonardo DiCaprio, Mark Ruffalo, Ben Kingsley, Max von Sydow', 'In 1954, a U.S. marshal investigates the disappearance of a murderess who escaped from a hospital for the criminally insane.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTMxMTIyNzMxMV5BMl5BanBnXkFtZTcwOTc4OTI3Mg@@._V1_SX300.jpg', 19.99),
(36, 'Reservoir Dogs', 1992, 99, 'Quentin Tarantino', 'Harvey Keitel, Tim Roth, Michael Madsen, Chris Penn', 'After a simple jewelry heist goes terribly wrong, the surviving criminals begin to suspect that one of them is a police informant.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNjE5ZDJiZTQtOGE2YS00ZTc5LTk0OGUtOTg2NjdjZmVlYzE2XkEyXkFqcGdeQXVyMzM4MjM0Nzg@._V1_SX300.jpg', 9.99),
(37, 'The Shining', 1980, 146, 'Stanley Kubrick', 'Jack Nicholson, Shelley Duvall, Danny Lloyd, Scatman Crothers', 'A family heads to an isolated hotel for the winter where an evil and spiritual presence influences the father into violence, while his psychic son sees horrific forebodings from the past and of the future.', 'https://ia.media-imdb.com/images/M/MV5BODMxMjE3NTA4Ml5BMl5BanBnXkFtZTgwNDc0NTIxMDE@._V1_SX300.jpg', 19.99),
(38, 'Midnight in Paris', 2011, 94, 'Woody Allen', 'Owen Wilson, Rachel McAdams, Kurt Fuller, Mimi Kennedy', 'While on a trip to Paris with his fiancÃ©e\'s family, a nostalgic screenwriter finds himself mysteriously going back to the 1920s everyday at midnight.', 'https://ia.media-imdb.com/images/M/MV5BMTM4NjY1MDQwMl5BMl5BanBnXkFtZTcwNTI3Njg3NA@@._V1_SX300.jpg', 4.99),
(39, 'Les MisÃ©rables', 2012, 158, 'Tom Hooper', 'Hugh Jackman, Russell Crowe, Anne Hathaway, Amanda Seyfried', 'In 19th-century France, Jean Valjean, who for decades has been hunted by the ruthless policeman Javert after breaking parole, agrees to care for a factory worker\'s daughter. The decision changes their lives forever.', 'https://ia.media-imdb.com/images/M/MV5BMTQ4NDI3NDg4M15BMl5BanBnXkFtZTcwMjY5OTI1OA@@._V1_SX300.jpg', 19.99),
(40, 'L.A. Confidential', 1997, 138, 'Curtis Hanson', 'Kevin Spacey, Russell Crowe, Guy Pearce, James Cromwell', 'As corruption grows in 1950s LA, three policemen - one strait-laced, one brutal, and one sleazy - investigate a series of murders with their own brand of justice.', 'L.A._Confidential.jpg', 19.99),
(41, 'Moneyball', 2011, 133, 'Bennett Miller', 'Brad Pitt, Jonah Hill, Philip Seymour Hoffman, Robin Wright', 'Oakland A\'s general manager Billy Beane\'s successful attempt to assemble a baseball team on a lean budget by employing computer-generated analysis to acquire new players.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjAxOTU3Mzc1M15BMl5BanBnXkFtZTcwMzk1ODUzNg@@._V1_SX300.jpg', 4.99),
(42, 'The Hangover', 2009, 100, 'Todd Phillips', 'Bradley Cooper, Ed Helms, Zach Galifianakis, Justin Bartha', 'Three buddies wake up from a bachelor party in Las Vegas, with no memory of the previous night and the bachelor missing. They make their way around the city in order to find their friend before his wedding.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTU1MDA1MTYwMF5BMl5BanBnXkFtZTcwMDcxMzA1Mg@@._V1_SX300.jpg', 19.99),
(43, 'The Great Beauty', 2013, 141, 'Paolo Sorrentino', 'Toni Servillo, Carlo Verdone, Sabrina Ferilli, Carlo Buccirosso', 'Jep Gambardella has seduced his way through the lavish nightlife of Rome for decades, but after his 65th birthday and a shock from the past, Jep looks past the nightclubs and parties to find a timeless landscape of absurd, exquisite beauty.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQ0ODg1OTQ2Nl5BMl5BanBnXkFtZTgwNTc2MDY1MDE@._V1_SX300.jpg', 9.99),
(44, 'Gran Torino', 2008, 116, 'Clint Eastwood', 'Clint Eastwood, Christopher Carley, Bee Vang, Ahney Her', 'Disgruntled Korean War veteran Walt Kowalski sets out to reform his neighbor, a Hmong teenager who tried to steal Kowalski\'s prized possession: a 1972 Gran Torino.', 'Gran_Torino.jpg', 4.99),
(45, 'Mary and Max', 2009, 92, 'Adam Elliot', 'Toni Collette, Philip Seymour Hoffman, Barry Humphries, Eric Bana', 'A tale of friendship between two unlikely pen pals: Mary, a lonely, eight-year-old girl living in the suburbs of Melbourne, and Max, a forty-four-year old, severely obese man living in New York.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQ1NDIyNTA1Nl5BMl5BanBnXkFtZTcwMjc2Njk3OA@@._V1_SX300.jpg', 19.99),
(46, 'Flight', 2012, 138, 'Robert Zemeckis', 'Nadine Velazquez, Denzel Washington, Carter Cabassa, Adam C. Edwards', 'An airline pilot saves almost all his passengers on his malfunctioning airliner which eventually crashed, but an investigation into the accident reveals something troubling.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTUxMjI1OTMxNl5BMl5BanBnXkFtZTcwNjc3NTY1OA@@._V1_SX300.jpg', 9.99),
(47, 'One Flew Over the Cuckoo\'s Nest', 1975, 133, 'Milos Forman', 'Michael Berryman, Peter Brocco, Dean R. Brooks, Alonzo Brown', 'A criminal pleads insanity after getting into trouble again and once in the mental institution rebels against the oppressive nurse and rallies up the scared patients.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BYmJkODkwOTItZThjZC00MTE0LWIxNzQtYTM3MmQwMGI1OWFiXkEyXkFqcGdeQXVyNjUwNzk3NDc@._V1_SX300.jpg', 4.99),
(48, 'Requiem for a Dream', 2000, 102, 'Darren Aronofsky', 'Ellen Burstyn, Jared Leto, Jennifer Connelly, Marlon Wayans', 'The drug-induced utopias of four Coney Island people are shattered when their addictions run deep.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTkzODMzODYwOF5BMl5BanBnXkFtZTcwODM2NjA2NQ@@._V1_SX300.jpg', 9.99),
(49, 'The Truman Show', 1998, 103, 'Peter Weir', 'Jim Carrey, Laura Linney, Noah Emmerich, Natascha McElhone', 'An insurance salesman/adjuster discovers his entire life is actually a television show.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMDIzODcyY2EtMmY2MC00ZWVlLTgwMzAtMjQwOWUyNmJjNTYyXkEyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_SX300.jpg', 14.99),
(50, 'The Artist', 2011, 100, 'Michel Hazanavicius', 'Jean Dujardin, BÃ©rÃ©nice Bejo, John Goodman, James Cromwell', 'A silent movie star meets a young dancer, but the arrival of talking pictures sends their careers in opposite directions.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMzk0NzQxMTM0OV5BMl5BanBnXkFtZTcwMzU4MDYyNQ@@._V1_SX300.jpg', 4.99),
(51, 'Forrest Gump', 1994, 142, 'Robert Zemeckis', 'Tom Hanks, Rebecca Williams, Sally Field, Michael Conner Humphreys', 'Forrest Gump, while not intelligent, has accidentally been present at many historic moments, but his true love, Jenny Curran, eludes him.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BYThjM2MwZGMtMzg3Ny00NGRkLWE4M2EtYTBiNWMzOTY0YTI4XkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SX300.jpg', 9.99),
(52, 'The Hobbit: The Desolation of Smaug', 2013, 161, 'Peter Jackson', 'Ian McKellen, Martin Freeman, Richard Armitage, Ken Stott', 'The dwarves, along with Bilbo Baggins and Gandalf the Grey, continue their quest to reclaim Erebor, their homeland, from Smaug. Bilbo Baggins is in possession of a mysterious and magical ring.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMzU0NDY0NDEzNV5BMl5BanBnXkFtZTgwOTIxNDU1MDE@._V1_SX300.jpg', 19.99),
(53, 'Vicky Cristina Barcelona', 2008, 96, 'Woody Allen', 'Rebecca Hall, Scarlett Johansson, Christopher Evan Welch, Chris Messina', 'Two girlfriends on a summer holiday in Spain become enamored with the same painter, unaware that his ex-wife, with whom he has a tempestuous relationship, is about to re-enter the picture.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTU2NDQ4MTg2MV5BMl5BanBnXkFtZTcwNDUzNjU3MQ@@._V1_SX300.jpg', 4.99),
(54, 'Slumdog Millionaire', 2008, 120, 'Danny Boyle, Loveleen Tandan', 'Dev Patel, Saurabh Shukla, Anil Kapoor, Rajendranath Zutshi', 'A Mumbai teen reflects on his upbringing in the slums when he is accused of cheating on the Indian Version of \"Who Wants to be a Millionaire?\"', 'https://ia.media-imdb.com/images/M/MV5BMTU2NTA5NzI0N15BMl5BanBnXkFtZTcwMjUxMjYxMg@@._V1_SX300.jpg', 9.99),
(55, 'Lost in Translation', 2003, 101, 'Sofia Coppola', 'Scarlett Johansson, Bill Murray, Akiko Takeshita, Kazuyoshi Minamimagoe', 'A faded movie star and a neglected young woman form an unlikely bond after crossing paths in Tokyo.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTI2NDI5ODk4N15BMl5BanBnXkFtZTYwMTI3NTE3._V1_SX300.jpg', 19.99),
(56, 'Match Point', 2005, 119, 'Woody Allen', 'Jonathan Rhys Meyers, Alexander Armstrong, Paul Kaye, Matthew Goode', 'At a turning point in his life, a former tennis pro falls for an actress who happens to be dating his friend and soon-to-be brother-in-law.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTMzNzY4MzE5NF5BMl5BanBnXkFtZTcwMzQ1MDMzMQ@@._V1_SX300.jpg', 19.99),
(57, 'Psycho', 1960, 109, 'Alfred Hitchcock', 'Anthony Perkins, Vera Miles, John Gavin, Janet Leigh', 'A Phoenix secretary embezzles $40,000 from her employer\'s client, goes on the run, and checks into a remote motel run by a young man under the domination of his mother.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMDI3OWRmOTEtOWJhYi00N2JkLTgwNGItMjdkN2U0NjFiZTYwXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 9.99),
(58, 'North by Northwest', 1959, 136, 'Alfred Hitchcock', 'Cary Grant, Eva Marie Saint, James Mason, Jessie Royce Landis', 'A hapless New York advertising executive is mistaken for a government agent by a group of foreign spies, and is pursued across the country while he looks for a way to survive.', 'https://ia.media-imdb.com/images/M/MV5BMjQwMTQ0MzgwNl5BMl5BanBnXkFtZTgwNjc4ODE4MzE@._V1_SX300.jpg', 4.99),
(59, 'Madagascar: Escape 2 Africa', 2008, 89, 'Eric Darnell, Tom McGrath', 'Ben Stiller, Chris Rock, David Schwimmer, Jada Pinkett Smith', 'The animals try to fly back to New York City, but crash-land on an African wildlife refuge, where Alex is reunited with his parents.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjExMDA4NDcwMl5BMl5BanBnXkFtZTcwODAxNTQ3MQ@@._V1_SX300.jpg', 4.99),
(60, 'Despicable Me 2', 2013, 98, 'Pierre Coffin, Chris Renaud', 'Steve Carell, Kristen Wiig, Benjamin Bratt, Miranda Cosgrove', 'When Gru, the world\'s most super-bad turned super-dad has been recruited by a team of officials to stop lethal muscle and a host of Gru\'s own, He has to fight back with new gadgetry, cars, and more minion madness.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjExNjAyNTcyMF5BMl5BanBnXkFtZTgwODQzMjQ3MDE@._V1_SX300.jpg', 19.99),
(61, 'Downfall', 2004, 156, 'Oliver Hirschbiegel', 'Bruno Ganz, Alexandra Maria Lara, Corinna Harfouch, Ulrich Matthes', 'Traudl Junge, the final secretary for Adolf Hitler, tells of the Nazi dictator\'s final days in his Berlin bunker at the end of WWII.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTM1OTI1MjE2Nl5BMl5BanBnXkFtZTcwMTEwMzc4NA@@._V1_SX300.jpg', 19.99),
(62, 'Madagascar', 2005, 86, 'Eric Darnell, Tom McGrath', 'Ben Stiller, Chris Rock, David Schwimmer, Jada Pinkett Smith', 'Spoiled by their upbringing with no idea what wild life is really like, four animals from New York Central Zoo escape, unwittingly assisted by four absconding penguins, and find themselves in Madagascar, among a bunch of merry lemurs', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTY4NDUwMzQxMF5BMl5BanBnXkFtZTcwMDgwNjgyMQ@@._V1_SX300.jpg', 14.99),
(63, 'Madagascar 3: Europe\'s Most Wanted', 2012, 93, 'Eric Darnell, Tom McGrath, Conrad Vernon', 'Ben Stiller, Chris Rock, David Schwimmer, Jada Pinkett Smith', 'Alex, Marty, Gloria and Melman are still fighting to get home to their beloved Big Apple. Their journey takes them through Europe where they find the perfect cover: a traveling circus, which they reinvent - Madagascar style.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTM2MTIzNzk2MF5BMl5BanBnXkFtZTcwMDcwMzQxNw@@._V1_SX300.jpg', 4.99),
(64, 'God Bless America', 2011, 105, 'Bobcat Goldthwait', 'Joel Murray, Tara Lynne Barr, Melinda Page Hamilton, Mackenzie Brooke Smith', 'On a mission to rid society of its most repellent citizens, terminally ill Frank makes an unlikely accomplice in 16-year-old Roxy.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQwMTc1MzA4NF5BMl5BanBnXkFtZTcwNzQwMTgzNw@@._V1_SX300.jpg', 4.99),
(65, 'The Social Network', 2010, 120, 'David Fincher', 'Jesse Eisenberg, Rooney Mara, Bryan Barter, Dustin Fitzsimons', 'Harvard student Mark Zuckerberg creates the social networking site that would become known as Facebook, but is later sued by two brothers who claimed he stole their idea, and the co-founder who was later squeezed out of the business.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTM2ODk0NDAwMF5BMl5BanBnXkFtZTcwNTM1MDc2Mw@@._V1_SX300.jpg', 14.99),
(66, 'The Pianist', 2002, 150, 'Roman Polanski', 'Adrien Brody, Emilia Fox, Michal Zebrowski, Ed Stoppard', 'A Polish Jewish musician struggles to survive the destruction of the Warsaw ghetto of World War II.', 'https://ia.media-imdb.com/images/M/MV5BMTc4OTkyOTA3OF5BMl5BanBnXkFtZTYwMDIxNjk5._V1_SX300.jpg', 14.99),
(67, 'Alive', 1993, 120, 'Frank Marshall', 'Ethan Hawke, Vincent Spano, Josh Hamilton, Bruce Ramsay', 'Uruguayan rugby team stranded in the snow swept Andes are forced to use desperate measures to survive after a plane crash.', '', 4.99),
(68, 'Casablanca', 1942, 102, 'Michael Curtiz', 'Humphrey Bogart, Ingrid Bergman, Paul Henreid, Claude Rains', 'In Casablanca, Morocco in December 1941, a cynical American expatriate meets a former lover, with unforeseen complications.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjQwNDYyNTk2N15BMl5BanBnXkFtZTgwMjQ0OTMyMjE@._V1_SX300.jpg', 4.99),
(69, 'American Gangster', 2007, 157, 'Ridley Scott', 'Denzel Washington, Russell Crowe, Chiwetel Ejiofor, Josh Brolin', 'In 1970s America, a detective works to bring down the drug empire of Frank Lucas, a heroin kingpin from Manhattan, who is smuggling the drug into the country from the Far East.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTkyNzY5MDA5MV5BMl5BanBnXkFtZTcwMjg4MzI3MQ@@._V1_SX300.jpg', 9.99),
(70, 'Catch Me If You Can', 2002, 141, 'Steven Spielberg', 'Leonardo DiCaprio, Tom Hanks, Christopher Walken, Martin Sheen', 'The true story of Frank Abagnale Jr. who, before his 19th birthday, successfully conned millions of dollars\' worth of checks as a Pan Am pilot, doctor, and legal prosecutor.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTY5MzYzNjc5NV5BMl5BanBnXkFtZTYwNTUyNTc2._V1_SX300.jpg', 9.99),
(71, 'American History X', 1998, 119, 'Tony Kaye', 'Edward Norton, Edward Furlong, Beverly D\'Angelo, Jennifer Lien', 'A former neo-nazi skinhead tries to prevent his younger brother from going down the same wrong path that he did.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BZjA0MTM4MTQtNzY5MC00NzY3LWI1ZTgtYzcxMjkyMzU4MDZiXkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SX300.jpg', 19.99),
(72, 'Casino', 1995, 178, 'Martin Scorsese', 'Robert De Niro, Sharon Stone, Joe Pesci, James Woods', 'Greed, deception, money, power, and murder occur between two best friends, a mafia underboss and a casino owner, for a trophy wife over a gambling empire.', 'https://ia.media-imdb.com/images/M/MV5BMTcxOWYzNDYtYmM4YS00N2NkLTk0NTAtNjg1ODgwZjAxYzI3XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_SX300.jpg', 14.99),
(73, 'Pirates of the Caribbean: At World\'s End', 2007, 169, 'Gore Verbinski', 'Johnny Depp, Geoffrey Rush, Orlando Bloom, Keira Knightley', 'Captain Barbossa, Will Turner and Elizabeth Swann must sail off the edge of the map, navigate treachery and betrayal, find Jack Sparrow, and make their final alliances for one last decisive battle.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjIyNjkxNzEyMl5BMl5BanBnXkFtZTYwMjc3MDE3._V1_SX300.jpg', 9.99),
(74, 'Crash', 2004, 112, 'Paul Haggis', 'Karina Arroyave, Dato Bakhtadze, Sandra Bullock, Don Cheadle', 'Los Angeles citizens with vastly separate lives collide in interweaving stories of race, loss and redemption.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BOTk1OTA1MjIyNV5BMl5BanBnXkFtZTcwODQxMTkyMQ@@._V1_SX300.jpg', 4.99),
(75, 'Oldboy', 2003, 120, 'Chan-wook Park', 'Min-sik Choi, Ji-tae Yu, Hye-jeong Kang, Dae-han Ji', 'After being kidnapped and imprisoned for 15 years, Oh Dae-Su is released, only to find that he must find his captor in 5 days.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTI3NTQyMzU5M15BMl5BanBnXkFtZTcwMTM2MjgyMQ@@._V1_SX300.jpg', 19.99),
(76, 'Chocolat', 2000, 121, 'Lasse HallstrÃ¶m', 'Alfred Molina, Carrie-Anne Moss, Aurelien Parent Koenig, Antonio Gil', 'A woman and her daughter open a chocolate shop in a small French village that shakes up the rigid morality of the community.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjA4MDI3NTQwMV5BMl5BanBnXkFtZTcwNjIzNDcyMQ@@._V1_SX300.jpg', 9.99),
(77, 'Casino Royale', 2006, 144, 'Martin Campbell', 'Daniel Craig, Eva Green, Mads Mikkelsen, Judi Dench', 'Armed with a licence to kill, Secret Agent James Bond sets out on his first mission as 007 and must defeat a weapons dealer in a high stakes game of poker at Casino Royale, but things are not what they seem.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTM5MjI4NDExNF5BMl5BanBnXkFtZTcwMDM1MjMzMQ@@._V1_SX300.jpg', 19.99),
(78, 'WALLÂ·E', 2008, 98, 'Andrew Stanton', 'Ben Burtt, Elissa Knight, Jeff Garlin, Fred Willard', 'In the distant future, a small waste-collecting robot inadvertently embarks on a space journey that will ultimately decide the fate of mankind.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTczOTA3MzY2N15BMl5BanBnXkFtZTcwOTYwNjE2MQ@@._V1_SX300.jpg', 9.99),
(79, 'The Wolf of Wall Street', 2013, 180, 'Martin Scorsese', 'Leonardo DiCaprio, Jonah Hill, Margot Robbie, Matthew McConaughey', 'Based on the true story of Jordan Belfort, from his rise to a wealthy stock-broker living the high life to his fall involving crime, corruption and the federal government.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjIxMjgxNTk0MF5BMl5BanBnXkFtZTgwNjIyOTg2MDE@._V1_SX300.jpg', 4.99),
(80, 'Hellboy II: The Golden Army', 2008, 120, 'Guillermo del Toro', 'Ron Perlman, Selma Blair, Doug Jones, John Alexander', 'The mythical world starts a rebellion against humanity in order to rule the Earth, so Hellboy and his team must save the world from the rebellious creatures.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjA5NzgyMjc2Nl5BMl5BanBnXkFtZTcwOTU3MDI3MQ@@._V1_SX300.jpg', 14.99),
(81, 'Sunset Boulevard', 1950, 110, 'Billy Wilder', 'William Holden, Gloria Swanson, Erich von Stroheim, Nancy Olson', 'A hack screenwriter writes a screenplay for a former silent-film star who has faded into Hollywood obscurity.', 'https://ia.media-imdb.com/images/M/MV5BMTc3NDYzODAwNV5BMl5BanBnXkFtZTgwODg1MTczMTE@._V1_SX300.jpg', 9.99),
(82, 'I-See-You.Com', 2006, 92, 'Eric Steven Stahl', 'Beau Bridges, Rosanna Arquette, Mathew Botuchis, Shiri Appleby', 'A 17-year-old boy buys mini-cameras and displays the footage online at I-see-you.com. The cash rolls in as the site becomes a major hit. Everyone seems to have fun until it all comes crashing down....', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTYwMDUzNzA5Nl5BMl5BanBnXkFtZTcwMjQ2Njk3MQ@@._V1_SX300.jpg', 9.99),
(83, 'The Grand Budapest Hotel', 2014, 99, 'Wes Anderson', 'Ralph Fiennes, F. Murray Abraham, Mathieu Amalric, Adrien Brody', 'The adventures of Gustave H, a legendary concierge at a famous hotel from the fictional Republic of Zubrowka between the first and second World Wars, and Zero Moustafa, the lobby boy who becomes his most trusted friend.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMzM5NjUxOTEyMl5BMl5BanBnXkFtZTgwNjEyMDM0MDE@._V1_SX300.jpg', 9.99),
(84, 'The Hitchhiker\'s Guide to the Galaxy', 2005, 109, 'Garth Jennings', 'Bill Bailey, Anna Chancellor, Warwick Davis, Yasiin Bey', 'Mere seconds before the Earth is to be demolished by an alien construction crew, journeyman Arthur Dent is swept off the planet by his friend Ford Prefect, a researcher penning a new edition of \"The Hitchhiker\'s Guide to the Galaxy.\"', 'https://ia.media-imdb.com/images/M/MV5BMjEwOTk4NjU2MF5BMl5BanBnXkFtZTYwMDA3NzI3._V1_SX300.jpg', 19.99),
(85, 'Once Upon a Time in America', 1984, 229, 'Sergio Leone', 'Robert De Niro, James Woods, Elizabeth McGovern, Joe Pesci', 'A former Prohibition-era Jewish gangster returns to the Lower East Side of Manhattan over thirty years later, where he once again must confront the ghosts and regrets of his old life.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMGFkNWI4MTMtNGQ0OC00MWVmLTk3MTktOGYxN2Y2YWVkZWE2XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 9.99),
(86, 'Oblivion', 2013, 124, 'Joseph Kosinski', 'Tom Cruise, Morgan Freeman, Olga Kurylenko, Andrea Riseborough', 'A veteran assigned to extract Earth\'s remaining resources begins to question what he knows about his mission and himself.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQwMDY0MTA4MF5BMl5BanBnXkFtZTcwNzI3MDgxOQ@@._V1_SX300.jpg', 14.99),
(87, 'V for Vendetta', 2005, 132, 'James McTeigue', 'Natalie Portman, Hugo Weaving, Stephen Rea, Stephen Fry', 'In a future British tyranny, a shadowy freedom fighter, known only by the alias of \"V\", plots to overthrow it with the help of a young woman.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BOTI5ODc3NzExNV5BMl5BanBnXkFtZTcwNzYxNzQzMw@@._V1_SX300.jpg', 4.99),
(88, 'Gattaca', 1997, 106, 'Andrew Niccol', 'Ethan Hawke, Uma Thurman, Gore Vidal, Xander Berkeley', 'A genetically inferior man assumes the identity of a superior one in order to pursue his lifelong dream of space travel.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNDQxOTc0MzMtZmRlOS00OWQ5LWI2ZDctOTAwNmMwOTYxYzlhXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 4.99),
(89, 'Silver Linings Playbook', 2012, 122, 'David O. Russell', 'Bradley Cooper, Jennifer Lawrence, Robert De Niro, Jacki Weaver', 'After a stint in a mental institution, former teacher Pat Solitano moves back in with his parents and tries to reconcile with his ex-wife. Things get more challenging when Pat meets Tiffany, a mysterious girl with problems of her own.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTM2MTI5NzA3MF5BMl5BanBnXkFtZTcwODExNTc0OA@@._V1_SX300.jpg', 4.99),
(90, 'Alice in Wonderland', 2010, 108, 'Tim Burton', 'Johnny Depp, Mia Wasikowska, Helena Bonham Carter, Anne Hathaway', 'Nineteen-year-old Alice returns to the magical world from her childhood adventure, where she reunites with her old friends and learns of her true destiny: to end the Red Queen\'s reign of terror.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTMwNjAxMTc0Nl5BMl5BanBnXkFtZTcwODc3ODk5Mg@@._V1_SX300.jpg', 19.99),
(91, 'Gandhi', 1982, 191, 'Richard Attenborough', 'Ben Kingsley, Candice Bergen, Edward Fox, John Gielgud', 'Gandhi\'s character is fully explained as a man of nonviolence. Through his patience, he is able to drive the British out of the subcontinent. And the stubborn nature of Jinnah and his commitment towards Pakistan is portrayed.', 'https://ia.media-imdb.com/images/M/MV5BMzJiZDRmOWUtYjE2MS00Mjc1LTg1ZDYtNTQxYWJkZTg1OTM4XkEyXkFqcGdeQXVyNjUwNzk3NDc@._V1_SX300.jpg', 9.99),
(92, 'Pacific Rim', 2013, 131, 'Guillermo del Toro', 'Charlie Hunnam, Diego Klattenhoff, Idris Elba, Rinko Kikuchi', 'As a war between humankind and monstrous sea creatures wages on, a former pilot and a trainee are paired up to drive a seemingly obsolete special weapon in a desperate effort to save the world from the apocalypse.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTY3MTI5NjQ4Nl5BMl5BanBnXkFtZTcwOTU1OTU0OQ@@._V1_SX300.jpg', 14.99),
(93, 'Kiss Kiss Bang Bang', 2005, 103, 'Shane Black', 'Robert Downey Jr., Val Kilmer, Michelle Monaghan, Corbin Bernsen', 'A murder mystery brings together a private eye, a struggling actress, and a thief masquerading as an actor.', 'https://ia.media-imdb.com/images/M/MV5BMTY5NDExMDA3M15BMl5BanBnXkFtZTYwNTc2MzA3._V1_SX300.jpg', 14.99),
(94, 'The Quiet American', 2002, 101, 'Phillip Noyce', 'Michael Caine, Brendan Fraser, Do Thi Hai Yen, Rade Serbedzija', 'An older British reporter vies with a young U.S. doctor for the affections of a beautiful Vietnamese woman.', 'https://ia.media-imdb.com/images/M/MV5BMjE2NTUxNTE3Nl5BMl5BanBnXkFtZTYwNTczMTg5._V1_SX300.jpg', 4.99),
(95, 'Cloud Atlas', 2012, 172, 'Tom Tykwer, Lana Wachowski, Lilly Wachowski', 'Tom Hanks, Halle Berry, Jim Broadbent, Hugo Weaving', 'An exploration of how the actions of individual lives impact one another in the past, present and future, as one soul is shaped from a killer into a hero, and an act of kindness ripples across centuries to inspire a revolution.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTczMTgxMjc4NF5BMl5BanBnXkFtZTcwNjM5MTA2OA@@._V1_SX300.jpg', 14.99),
(96, 'The Impossible', 2012, 114, 'J.A. Bayona', 'Naomi Watts, Ewan McGregor, Tom Holland, Samuel Joslin', 'The story of a tourist family in Thailand caught in the destruction and chaotic aftermath of the 2004 Indian Ocean tsunami.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjA5NTA3NzQ5Nl5BMl5BanBnXkFtZTcwOTYxNjY0OA@@._V1_SX300.jpg', 14.99),
(97, 'All Quiet on the Western Front', 1930, 136, 'Lewis Milestone', 'Louis Wolheim, Lew Ayres, John Wray, Arnold Lucy', 'A young soldier faces profound disillusionment in the soul-destroying horror of World War I.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNTM5OTg2NDY1NF5BMl5BanBnXkFtZTcwNTQ4MTMwNw@@._V1_SX300.jpg', 4.99),
(98, 'The English Patient', 1996, 162, 'Anthony Minghella', 'Ralph Fiennes, Juliette Binoche, Willem Dafoe, Kristin Scott Thomas', 'At the close of WWII, a young nurse tends to a badly-burned plane crash victim. His past is shown in flashbacks, revealing an involvement in a fateful love affair.', 'The_English_Patient.jpg', 9.99),
(99, 'Dallas Buyers Club', 2013, 117, 'Jean-Marc VallÃ©e', 'Matthew McConaughey, Jennifer Garner, Jared Leto, Denis O\'Hare', 'In 1985 Dallas, electrician and hustler Ron Woodroof works around the system to help AIDS patients get the medication they need after he is diagnosed with the disease.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTYwMTA4MzgyNF5BMl5BanBnXkFtZTgwMjEyMjE0MDE@._V1_SX300.jpg', 4.99),
(100, 'Frida', 2002, 123, 'Julie Taymor', 'Salma Hayek, MÃ­a Maestro, Alfred Molina, Antonio Banderas', 'A biography of artist Frida Kahlo, who channeled the pain of a crippling injury and her tempestuous marriage into her work.', 'https://ia.media-imdb.com/images/M/MV5BMTMyODUyMDY1OV5BMl5BanBnXkFtZTYwMDA2OTU3._V1_SX300.jpg', 9.99),
(101, 'Before Sunrise', 1995, 105, 'Richard Linklater', 'Ethan Hawke, Julie Delpy, Andrea Eckert, Hanno PÃ¶schl', 'A young man and woman meet on a train in Europe, and wind up spending one evening together in Vienna. Unfortunately, both know that this will probably be their only night together.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQyMTM3MTQxMl5BMl5BanBnXkFtZTcwMDAzNjQ4Mg@@._V1_SX300.jpg', 9.99),
(102, 'The Rum Diary', 2011, 120, 'Bruce Robinson', 'Johnny Depp, Aaron Eckhart, Michael Rispoli, Amber Heard', 'American journalist Paul Kemp takes on a freelance job in Puerto Rico for a local newspaper during the 1960s and struggles to find a balance between island culture and the expatriates who live there.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTM5ODA4MjYxM15BMl5BanBnXkFtZTcwMTM3NTE5Ng@@._V1_SX300.jpg', 14.99),
(103, 'The Last Samurai', 2003, 154, 'Edward Zwick', 'Ken Watanabe, Tom Cruise, William Atherton, Chad Lindberg', 'An American military advisor embraces the Samurai culture he was hired to destroy after he is captured in battle.', 'https://ia.media-imdb.com/images/M/MV5BMzkyNzQ1Mzc0NV5BMl5BanBnXkFtZTcwODg3MzUzMw@@._V1_SX300.jpg', 14.99),
(104, 'Chinatown', 1974, 130, 'Roman Polanski', 'Jack Nicholson, Faye Dunaway, John Huston, Perry Lopez', 'A private detective hired to expose an adulterer finds himself caught up in a web of deceit, corruption and murder.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BN2YyNDE5NzItMjAwNC00MGQxLTllNjktZGIzMWFkZjA3OWQ0XkEyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_SX300.jpg', 9.99),
(105, 'Calvary', 2014, 102, 'John Michael McDonagh', 'Brendan Gleeson, Chris O\'Dowd, Kelly Reilly, Aidan Gillen', 'After he is threatened during a confession, a good-natured priest must battle the dark forces closing in around him.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTc3MjQ1MjE2M15BMl5BanBnXkFtZTgwNTMzNjE4MTE@._V1_SX300.jpg', 4.99),
(106, 'Before Sunset', 2004, 80, 'Richard Linklater', 'Ethan Hawke, Julie Delpy, Vernon Dobtcheff, Louise Lemoine TorrÃ¨s', 'Nine years after Jesse and Celine first met, they encounter each other again on the French leg of Jesse\'s book tour.', 'https://ia.media-imdb.com/images/M/MV5BMTQ1MjAwNTM5Ml5BMl5BanBnXkFtZTYwNDM0MTc3._V1_SX300.jpg', 14.99),
(107, 'Spirited Away', 2001, 125, 'Hayao Miyazaki', 'Rumi Hiiragi, Miyu Irino, Mari Natsuki, Takashi NaitÃ´', 'During her family\'s move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches, and spirits, and where humans are changed into beasts.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjYxMDcyMzIzNl5BMl5BanBnXkFtZTYwNDg2MDU3._V1_SX300.jpg', 19.99),
(108, 'Indochine', 1992, 159, 'RÃ©gis Wargnier', 'Catherine Deneuve, Vincent Perez, Linh Dan Pham, Jean Yanne', 'This story is set in 1930, at the time when French colonial rule in Indochina is ending. A widowed French woman who works in the rubber fields, raises a Vietnamese princess as if she was ...', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTM1MTkzNzA3NF5BMl5BanBnXkFtZTYwNTI2MzU5._V1_SX300.jpg', 4.99),
(109, 'Boyhood', 2014, 165, 'Richard Linklater', 'Ellar Coltrane, Patricia Arquette, Elijah Smith, Lorelei Linklater', 'The life of Mason, from early childhood to his arrival at college.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTYzNDc2MDc0N15BMl5BanBnXkFtZTgwOTcwMDQ5MTE@._V1_SX300.jpg', 9.99),
(110, '12 Angry Men', 1957, 96, 'Sidney Lumet', 'Martin Balsam, John Fiedler, Lee J. Cobb, E.G. Marshall', 'A jury holdout attempts to prevent a miscarriage of justice by forcing his colleagues to reconsider the evidence.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BODQwOTc5MDM2N15BMl5BanBnXkFtZTcwODQxNTEzNA@@._V1_SX300.jpg', 14.99),
(111, 'The Imitation Game', 2014, 114, 'Morten Tyldum', 'Benedict Cumberbatch, Keira Knightley, Matthew Goode, Rory Kinnear', 'During World War II, mathematician Alan Turing tries to crack the enigma code with help from fellow mathematicians.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNDkwNTEyMzkzNl5BMl5BanBnXkFtZTgwNTAwNzk3MjE@._V1_SX300.jpg', 19.99),
(112, 'Interstellar', 2014, 169, 'Christopher Nolan', 'Ellen Burstyn, Matthew McConaughey, Mackenzie Foy, John Lithgow', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjIxNTU4MzY4MF5BMl5BanBnXkFtZTgwMzM4ODI3MjE@._V1_SX300.jpg', 14.99),
(113, 'Big Nothing', 2006, 86, 'Jean-Baptiste Andrea', 'David Schwimmer, Simon Pegg, Alice Eve, Natascha McElhone', 'A frustrated, unemployed teacher joining forces with a scammer and his girlfriend in a blackmailing scheme.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTY5NTc2NjYwOV5BMl5BanBnXkFtZTcwMzk5OTY0MQ@@._V1_SX300.jpg', 19.99),
(114, 'Das Boot', 1981, 149, 'Wolfgang Petersen', 'JÃ¼rgen Prochnow, Herbert GrÃ¶nemeyer, Klaus Wennemann, Hubertus Bengsch', 'The claustrophobic world of a WWII German U-boat; boredom, filth, and sheer terror.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjE5Mzk5OTQ0Nl5BMl5BanBnXkFtZTYwNzUwMTQ5._V1_SX300.jpg', 14.99),
(115, 'Shrek 2', 2004, 93, 'Andrew Adamson, Kelly Asbury, Conrad Vernon', 'Mike Myers, Eddie Murphy, Cameron Diaz, Julie Andrews', 'Princess Fiona\'s parents invite her and Shrek to dinner to celebrate her marriage. If only they knew the newlyweds were both ogres.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTk4MTMwNjI4M15BMl5BanBnXkFtZTcwMjExMzUyMQ@@._V1_SX300.jpg', 4.99),
(116, 'Sin City', 2005, 124, 'Frank Miller, Robert Rodriguez, Quentin Tarantino', 'Jessica Alba, Devon Aoki, Alexis Bledel, Powers Boothe', 'A film that explores the dark and miserable town, Basin City, and tells the story of three different people, all caught up in violent corruption.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BODZmYjMwNzEtNzVhNC00ZTRmLTk2M2UtNzE1MTQ2ZDAxNjc2XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 14.99),
(117, 'Nebraska', 2013, 115, 'Alexander Payne', 'Bruce Dern, Will Forte, June Squibb, Bob Odenkirk', 'An aging, booze-addled father makes the trip from Montana to Nebraska with his estranged son in order to claim a million-dollar Mega Sweepstakes Marketing prize.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTU2Mjk2NDkyMl5BMl5BanBnXkFtZTgwNTk0NzcyMDE@._V1_SX300.jpg', 9.99),
(118, 'Shrek', 2001, 90, 'Andrew Adamson, Vicky Jenson', 'Mike Myers, Eddie Murphy, Cameron Diaz, John Lithgow', 'After his swamp is filled with magical creatures, an ogre agrees to rescue a princess for a villainous lord in order to get his land back.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTk2NTE1NTE0M15BMl5BanBnXkFtZTgwNjY4NTYxMTE@._V1_SX300.jpg', 19.99),
(119, 'Mr. & Mrs. Smith', 2005, 120, 'Doug Liman', 'Brad Pitt, Angelina Jolie, Vince Vaughn, Adam Brody', 'A bored married couple is surprised to learn that they are both assassins hired by competing agencies to kill each other.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTUxMzcxNzQzOF5BMl5BanBnXkFtZTcwMzQxNjUyMw@@._V1_SX300.jpg', 19.99),
(120, 'Original Sin', 2001, 116, 'Michael Cristofer', 'Antonio Banderas, Angelina Jolie, Thomas Jane, Jack Thompson', 'A woman along with her lover, plan to con a rich man by marrying him and on earning his trust running away with all his money. Everything goes as planned until she actually begins to fall in love with him.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BODg3Mjg0MDY4M15BMl5BanBnXkFtZTcwNjY5MDQ2NA@@._V1_SX300.jpg', 19.99),
(121, 'Shrek Forever After', 2010, 93, 'Mike Mitchell', 'Mike Myers, Eddie Murphy, Cameron Diaz, Antonio Banderas', 'Rumpelstiltskin tricks a mid-life crisis burdened Shrek into allowing himself to be erased from existence and cast in a dark alternate timeline where Rumpel rules supreme.', 'https://ia.media-imdb.com/images/M/MV5BMTY0OTU1NzkxMl5BMl5BanBnXkFtZTcwMzI2NDUzMw@@._V1_SX300.jpg', 9.99),
(122, 'Before Midnight', 2013, 109, 'Richard Linklater', 'Ethan Hawke, Julie Delpy, Seamus Davey-Fitzpatrick, Jennifer Prior', 'We meet Jesse and Celine nine years on in Greece. Almost two decades have passed since their first meeting on that train bound for Vienna.', 'https://ia.media-imdb.com/images/M/MV5BMjA5NzgxODE2NF5BMl5BanBnXkFtZTcwNTI1NTI0OQ@@._V1_SX300.jpg', 9.99),
(123, 'Despicable Me', 2010, 95, 'Pierre Coffin, Chris Renaud', 'Steve Carell, Jason Segel, Russell Brand, Julie Andrews', 'When a criminal mastermind uses a trio of orphan girls as pawns for a grand scheme, he finds their love is profoundly changing him for the better.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTY3NjY0MTQ0Nl5BMl5BanBnXkFtZTcwMzQ2MTc0Mw@@._V1_SX300.jpg', 14.99),
(124, 'Troy', 2004, 163, 'Wolfgang Petersen', 'Julian Glover, Brian Cox, Nathan Jones, Adoni Maropis', 'An adaptation of Homer\'s great epic, the film follows the assault on Troy by the united Greek forces and chronicles the fates of the men involved.', 'https://ia.media-imdb.com/images/M/MV5BMTk5MzU1MDMwMF5BMl5BanBnXkFtZTcwNjczODMzMw@@._V1_SX300.jpg', 9.99),
(125, 'The Hobbit: An Unexpected Journey', 2012, 169, 'Peter Jackson', 'Ian McKellen, Martin Freeman, Richard Armitage, Ken Stott', 'A reluctant hobbit, Bilbo Baggins, sets out to the Lonely Mountain with a spirited group of dwarves to reclaim their mountain home - and the gold within it - from the dragon Smaug.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTcwNTE4MTUxMl5BMl5BanBnXkFtZTcwMDIyODM4OA@@._V1_SX300.jpg', 19.99),
(126, 'The Great Gatsby', 2013, 143, 'Baz Luhrmann', 'Lisa Adam, Frank Aldridge, Amitabh Bachchan, Steve Bisley', 'A writer and wall street trader, Nick, finds himself drawn to the past and lifestyle of his millionaire neighbor, Jay Gatsby.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTkxNTk1ODcxNl5BMl5BanBnXkFtZTcwMDI1OTMzOQ@@._V1_SX300.jpg', 4.99);
INSERT INTO `films` (`idFilm`, `titre`, `annee`, `duree`, `realisateurs`, `acteurs`, `description`, `image`, `prix`) VALUES
(127, 'Ice Age', 2002, 81, 'Chris Wedge, Carlos Saldanha', 'Ray Romano, John Leguizamo, Denis Leary, Goran Visnjic', 'Set during the Ice Age, a sabertooth tiger, a sloth, and a wooly mammoth find a lost human infant, and they try to return him to his tribe.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjEyNzI1ODA0MF5BMl5BanBnXkFtZTYwODIxODY3._V1_SX300.jpg', 4.99),
(128, 'The Lord of the Rings: The Two Towers', 2002, 179, 'Peter Jackson', 'Bruce Allpress, Sean Astin, John Bach, Sala Baker', 'While Frodo and Sam edge closer to Mordor with the help of the shifty Gollum, the divided fellowship makes a stand against Sauron\'s new ally, Saruman, and his hordes of Isengard.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTAyNDU0NjY4NTheQTJeQWpwZ15BbWU2MDk4MTY2Nw@@._V1_SX300.jpg', 9.99),
(129, 'Ex Machina', 2015, 108, 'Alex Garland', 'Domhnall Gleeson, Corey Johnson, Oscar Isaac, Alicia Vikander', 'A young programmer is selected to participate in a ground-breaking experiment in synthetic intelligence by evaluating the human qualities of a breath-taking humanoid A.I.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTUxNzc0OTIxMV5BMl5BanBnXkFtZTgwNDI3NzU2NDE@._V1_SX300.jpg', 14.99),
(130, 'The Theory of Everything', 2014, 123, 'James Marsh', 'Eddie Redmayne, Felicity Jones, Tom Prior, Sophie Perry', 'A look at the relationship between the famous physicist Stephen Hawking and his wife.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTAwMTU4MDA3NDNeQTJeQWpwZ15BbWU4MDk4NTMxNTIx._V1_SX300.jpg', 14.99),
(131, 'Shogun', 1980, 60, 'N/A', 'Richard Chamberlain, ToshirÃ´ Mifune, YÃ´ko Shimada, FurankÃ® Sakai', 'A English navigator becomes both a player and pawn in the complex political games in feudal Japan.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTY1ODI4NzYxMl5BMl5BanBnXkFtZTcwNDA4MzUxMQ@@._V1_SX300.jpg', 14.99),
(132, 'Spotlight', 2015, 128, 'Tom McCarthy', 'Mark Ruffalo, Michael Keaton, Rachel McAdams, Liev Schreiber', 'The true story of how the Boston Globe uncovered the massive scandal of child molestation and cover-up within the local Catholic Archdiocese, shaking the entire Catholic Church to its core.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjIyOTM5OTIzNV5BMl5BanBnXkFtZTgwMDkzODE2NjE@._V1_SX300.jpg', 4.99),
(133, 'Vertigo', 1958, 128, 'Alfred Hitchcock', 'James Stewart, Kim Novak, Barbara Bel Geddes, Tom Helmore', 'A San Francisco detective suffering from acrophobia investigates the strange activities of an old friend\'s wife, all the while becoming dangerously obsessed with her.', 'https://ia.media-imdb.com/images/M/MV5BNzY0NzQyNzQzOF5BMl5BanBnXkFtZTcwMTgwNTk4OQ@@._V1_SX300.jpg', 4.99),
(134, 'Whiplash', 2014, 107, 'Damien Chazelle', 'Miles Teller, J.K. Simmons, Paul Reiser, Melissa Benoist', 'A promising young drummer enrolls at a cut-throat music conservatory where his dreams of greatness are mentored by an instructor who will stop at nothing to realize a student\'s potential.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTU4OTQ3MDUyMV5BMl5BanBnXkFtZTgwOTA2MjU0MjE@._V1_SX300.jpg', 19.99),
(135, 'The Lives of Others', 2006, 137, 'Florian Henckel von Donnersmarck', 'Martina Gedeck, Ulrich MÃ¼he, Sebastian Koch, Ulrich Tukur', 'In 1984 East Berlin, an agent of the secret police, conducting surveillance on a writer and his lover, finds himself becoming increasingly absorbed by their lives.', 'https://ia.media-imdb.com/images/M/MV5BNDUzNjYwNDYyNl5BMl5BanBnXkFtZTcwNjU3ODQ0MQ@@._V1_SX300.jpg', 4.99),
(136, 'Hotel Rwanda', 2004, 121, 'Terry George', 'Xolani Mali, Don Cheadle, Desmond Dube, Hakeem Kae-Kazim', 'Paul Rusesabagina was a hotel manager who housed over a thousand Tutsi refugees during their struggle against the Hutu militia in Rwanda.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTI2MzQyNTc1M15BMl5BanBnXkFtZTYwMjExNjc3._V1_SX300.jpg', 9.99),
(137, 'The Martian', 2015, 144, 'Ridley Scott', 'Matt Damon, Jessica Chastain, Kristen Wiig, Jeff Daniels', 'An astronaut becomes stranded on Mars after his team assume him dead, and must rely on his ingenuity to find a way to signal to Earth that he is alive.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTc2MTQ3MDA1Nl5BMl5BanBnXkFtZTgwODA3OTI4NjE@._V1_SX300.jpg', 14.99),
(138, 'To Kill a Mockingbird', 1962, 129, 'Robert Mulligan', 'Gregory Peck, John Megna, Frank Overton, Rosemary Murphy', 'Atticus Finch, a lawyer in the Depression-era South, defends a black man against an undeserved rape charge, and his kids against prejudice.', 'https://ia.media-imdb.com/images/M/MV5BMjA4MzI1NDY2Nl5BMl5BanBnXkFtZTcwMTcyODc5Mw@@._V1_SX300.jpg', 19.99),
(139, 'The Hateful Eight', 2015, 187, 'Quentin Tarantino', 'Samuel L. Jackson, Kurt Russell, Jennifer Jason Leigh, Walton Goggins', 'In the dead of a Wyoming winter, a bounty hunter and his prisoner find shelter in a cabin currently inhabited by a collection of nefarious characters.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjA1MTc1NTg5NV5BMl5BanBnXkFtZTgwOTM2MDEzNzE@._V1_SX300.jpg', 4.99),
(140, 'A Separation', 2011, 123, 'Asghar Farhadi', 'Peyman Moaadi, Leila Hatami, Sareh Bayat, Shahab Hosseini', 'A married couple are faced with a difficult decision - to improve the life of their child by moving to another country or to stay in Iran and look after a deteriorating parent who has Alzheimer\'s disease.', 'https://ia.media-imdb.com/images/M/MV5BMTYzMzU4NDUwOF5BMl5BanBnXkFtZTcwMTM5MjA5Ng@@._V1_SX300.jpg', 19.99),
(141, 'The Big Short', 2015, 130, 'Adam McKay', 'Ryan Gosling, Rudy Eisenzopf, Casey Groves, Charlie Talbert', 'Four denizens in the world of high-finance predict the credit and housing bubble collapse of the mid-2000s, and decide to take on the big banks for their greed and lack of foresight.', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNDc4MThhN2EtZjMzNC00ZDJmLThiZTgtNThlY2UxZWMzNjdkXkEyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_SX300.jpg', 19.99),
(142, 'test', 200, 159, 'moi', 'moi', 'Petithhh', 'default.png', 8.99),
(143, 'test123', 2008, 167, 'Alex Garland', 'Joe Blow', 'un chien perdu', 'default.png', 8.99),
(144, 'AAA', 2019, 500, 'Alex Garland', 'Joe Blow', 'Un film plate', 'default.png', 8.99),
(145, 'dsf', 234, 245, 'fdsf', 'sdf', 'aGD', 'default.png', 1.99);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `idGenre` int(11) NOT NULL,
  `nomGenre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`idGenre`, `nomGenre`) VALUES
(1, 'Comedy'),
(2, 'Fantasy'),
(3, 'Crime'),
(4, 'Drama'),
(5, 'Music'),
(6, 'Adventure'),
(7, 'History'),
(8, 'Thriller'),
(9, 'Animation'),
(10, 'Family'),
(11, 'Mystery'),
(12, 'Biography'),
(13, 'Action'),
(14, 'Film-Noir'),
(15, 'Romance'),
(16, 'Sci-Fi'),
(17, 'War'),
(18, 'Western'),
(19, 'Horror'),
(20, 'Musical'),
(21, 'Sport');

-- --------------------------------------------------------

--
-- Structure de la table `historiquelocation`
--

CREATE TABLE `historiquelocation` (
  `idFilm` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `dateAchat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `idFilm` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `dateAchat` date NOT NULL,
  `dureeLocation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `idMembre` int(11) NOT NULL,
  `prenom` varchar(20) COLLATE utf32_unicode_ci NOT NULL,
  `nom` varchar(20) COLLATE utf32_unicode_ci NOT NULL,
  `courriel` varchar(256) COLLATE utf32_unicode_ci NOT NULL,
  `sexe` varchar(11) COLLATE utf32_unicode_ci NOT NULL,
  `dateDeNaissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`idMembre`, `prenom`, `nom`, `courriel`, `sexe`, `dateDeNaissance`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'M', '2000-09-01'),
(2, 'asd', 'asdasd', 'asd@gmail.com', 'M', '2021-10-13');

-- --------------------------------------------------------

--
-- Structure de la table `paiment`
--

CREATE TABLE `paiment` (
  `idPaiment` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL,
  `datePaiment` date NOT NULL,
  `prixFilm` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD UNIQUE KEY `idMembre` (`idMembre`);

--
-- Index pour la table `filmgenre`
--
ALTER TABLE `filmgenre`
  ADD KEY `idFilm` (`idFilm`),
  ADD KEY `idGenre` (`idGenre`);

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`idFilm`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`idGenre`);

--
-- Index pour la table `historiquelocation`
--
ALTER TABLE `historiquelocation`
  ADD KEY `idFilm` (`idFilm`),
  ADD KEY `idMembre` (`idMembre`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD KEY `idFilm` (`idFilm`),
  ADD KEY `idMembre` (`idMembre`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`idMembre`);

--
-- Index pour la table `paiment`
--
ALTER TABLE `paiment`
  ADD PRIMARY KEY (`idPaiment`),
  ADD KEY `idMembre` (`idMembre`),
  ADD KEY `idFilm` (`idFilm`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `connexion`
--
ALTER TABLE `connexion`
  MODIFY `idMembre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `idFilm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `idGenre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `idMembre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `paiment`
--
ALTER TABLE `paiment`
  MODIFY `idPaiment` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historiquelocation`
--
ALTER TABLE `historiquelocation`
  ADD CONSTRAINT `idFilmFK` FOREIGN KEY (`idFilm`) REFERENCES `films` (`idFilm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idMembre` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`idMembre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FkIdFilm` FOREIGN KEY (`idFilm`) REFERENCES `films` (`idFilm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FkIdMembre` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`idMembre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiment`
--
ALTER TABLE `paiment`
  ADD CONSTRAINT `FkIdFilmP` FOREIGN KEY (`idFilm`) REFERENCES `films` (`idFilm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FkIdMembreP` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`idMembre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
