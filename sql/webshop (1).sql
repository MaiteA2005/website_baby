-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 dec 2024 om 17:40
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(3,0) NOT NULL,
  `total_price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `total_price`) VALUES
(34, 0, 5, 1, 10.16),
(35, 0, 40, 1, 14.48),
(36, 0, 1, 1, 36.95);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Speelgoed'),
(2, 'Kleren'),
(3, 'Eten en drinken'),
(4, 'Slaaphulpjes');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `order_items_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(7,2) NOT NULL,
  `quantity` decimal(3,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(300) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `categorie_id` int(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `is_favorite` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `categorie_id`, `color`, `image`, `is_favorite`) VALUES
(1, 'Opbergzak/speeldeken', 'Opruimen wordt kinderspel met de opbergzak van Play & Go! Op het zachte speeltapijt beleeft je kindje eindeloos plezier. Genoeg gespeeld? Trek aan de koordjes en verander de speelmat in een opbergzak. Opgeruimd staat netjes!', 36.95, 1, 'regenboog', 'images/producten_speelgoed/product_1_wit.jpg', 0),
(2, 'Opbergzak/speeldeken', 'Opruimen wordt kinderspel met de opbergzak van Play & Go! Op het zachte speeltapijt beleeft je kindje eindeloos plezier. Genoeg gespeeld? Trek aan de koordjes en verander de speelmat in een opbergzak. Opgeruimd staat netjes!', 36.95, 1, 'geel', 'images/producten_speelgoed/product_1_geel.jpg', 0),
(3, 'Opbergzak/speeldeken', 'Opruimen wordt kinderspel met de opbergzak van Play & Go! Op het zachte speeltapijt beleeft je kindje eindeloos plezier. Genoeg gespeeld? Trek aan de koordjes en verander de speelmat in een opbergzak. Opgeruimd staat netjes!', 36.95, 1, 'blauw', 'images/producten_speelgoed/product_1_blauw.jpg', 0),
(4, 'Opbergzak/speeldeken', 'Opruimen wordt kinderspel met de opbergzak van Play & Go! Op het zachte speeltapijt beleeft je kindje eindeloos plezier. Genoeg gespeeld? Trek aan de koordjes en verander de speelmat in een opbergzak. Opgeruimd staat netjes!', 36.95, 1, 'Dieren en alfabet', 'images/producten_speelgoed/product_1_print.jpg', 0),
(5, 'Doudou konijn', 'Konijntje Richie doet niets liever dan knuffels uitdelen! Voor een lach of een traan: Richie staat altijd voor je baby klaar.', 10.16, 1, 'blauw', 'images/producten_speelgoed/product_2_blauw.jpg', 0),
(6, 'Doudou konijn', 'Konijntje Richie doet niets liever dan knuffels uitdelen! Voor een lach of een traan: Richie staat altijd voor je baby klaar.', 10.16, 1, 'grijs', 'images/producten_speelgoed/product_2_grijs.jpg', 0),
(7, 'Doudou konijn', 'Konijntje Richie doet niets liever dan knuffels uitdelen! Voor een lach of een traan: Richie staat altijd voor je baby klaar.', 10.16, 1, 'rood', 'images/producten_speelgoed/product_2_rood.jpg', 0),
(8, 'Doudou konijn', 'Konijntje Richie doet niets liever dan knuffels uitdelen! Voor een lach of een traan: Richie staat altijd voor je baby klaar.', 10.16, 1, 'groen', 'images/producten_speelgoed/product_2_groen.jpg', 0),
(9, 'Regenrammelaar ', 'Wat is er rustgevender dan het geluid van de regen? Draai de regenrammelaar en luister naar de balletjes die van de ene kant naar de andere rollen. De gekleurde balletjes vallen door kleine openingen in de buis en laten de propeller draaien, wat het leuke geluid veroorzaakt. Speciaal ontworpen voor ', 8.46, 1, 'roos', 'images/producten_speelgoed/product_3_roos.jpg', 0),
(10, 'Regenrammelaar ', 'Wat is er rustgevender dan het geluid van de regen? Draai de regenrammelaar en luister naar de balletjes die van de ene kant naar de andere rollen. De gekleurde balletjes vallen door kleine openingen in de buis en laten de propeller draaien, wat het leuke geluid veroorzaakt. Speciaal ontworpen voor ', 8.46, 1, 'blauw', 'images/producten_speelgoed/product_3_blauw.jpg', 0),
(11, 'Regenrammelaar ', 'Wat is er rustgevender dan het geluid van de regen? Draai de regenrammelaar en luister naar de balletjes die van de ene kant naar de andere rollen. De gekleurde balletjes vallen door kleine openingen in de buis en laten de propeller draaien, wat het leuke geluid veroorzaakt. Speciaal ontworpen voor ', 8.46, 1, 'groen', 'images/producten_speelgoed/product_3_groen.jpg', 0),
(12, 'Activiteitentafel ', 'Puzzel, tandwielen, houten stukken om te verplaatsen... De activiteitentafel van Little Farm biedt 5 geweldige activiteiten om te ontdekken!', 59.95, 1, NULL, 'images/producten_speelgoed/product_4.jpg', 0),
(13, 'Stapelpotjes', 'Stapelen helpt bij de ontwikkeling van de zintuigen en de hersenen. Deze stapelpotjes van Mushie beloven alvast tonnen speelplezier!', 14.95, 1, 'original', 'images/producten_speelgoed/product_5_original.jpg', 0),
(14, 'Loopfiets', 'De 3-in-1 loopfiets van Scoot and Ride heeft superveel functies. Ook ideaal om je baby te leren lopen! 3 verschillende manieren om te spelen: gebruik als loophulpje zonder wielen, daarna als loopwagen en nadien als grondsurfer.', 79.95, 1, 'roos', 'images/producten_speelgoed/product_6.jpg', 0),
(15, 'Badspeelgoed', 'Deze set bestaat uit 7 kleurrijke zeedieren die volledig afgesloten zijn om schimmel te voorkomen en volkomen veilig voor je baby om op te kauwen.', 14.95, 1, NULL, 'images/producten_speelgoed/product_7.jpg', 0),
(16, 'Activiteitenkubus', 'Deze mooie houten activiteitenkubus van Janod is perfect om je kapoen urenlang uit te dagen met verschillende stimulerende activiteiten, waaronder spiegels, een doolhof, vormsorteerder, telraam en nog veel meer!', 79.95, 0, NULL, 'images/producten_speelgoed/product_8.jpg', 0),
(17, 'Watertafel', 'Splash! Duiken, zwemmen, drijven... Met de figuurtjes en accessoires op deze watertafel van Step2 kan je kindje de gekste verhalen verzinnen. Uren speelplezier verzekerd!', 80.00, 1, NULL, 'images/producten_speelgoed/product_9.jpg', 0),
(19, '5 pack - Body - korte mouwen ', '', 17.00, 2, 'wit', 'images/producten_kleren/product_1_wit.jpg', 0),
(22, '5 pack - Body - lange mouwen ', '', 24.00, 2, 'wit', 'images/producten_kleren/product_2_wit.jpg', 0),
(24, 'Teddy jumpsuit', '', 49.99, 2, 'beige/brown', 'images/producten_kleren/product_5.jpg', 0),
(25, 'Pyjama', '', 34.99, 2, 'groen', 'images/producten_kleren/product_4_groen.jpg', 0),
(29, 'Sokken - 2 stuks', '', 10.95, 2, 'roos', 'images/producten_kleren/product_3_roos.jpg', 0),
(32, 'Antikrabwantjes\r\n', '', 2.95, 2, '', 'images/producten_kleren/product_6.jpg', 0),
(33, 'Mutsje\r\n', '', 4.95, 2, 'wit', 'images/producten_kleren/product_7_wit.jpg', 0),
(36, 'Nijntje pyjama', '', 16.00, 2, '', 'images/producten_kleren/product_8.jpg', 0),
(38, 'Jumpsuit', '', 22.50, 2, '', 'images/producten_kleren/product_9.jpg', 0),
(39, 'Denimjurk', '', 19.00, 2, '', 'images/producten_kleren/product_10.jpg', 0),
(40, 'Slab Waterproof met mouw', 'Deze slab met mouwen is geweldig. Het is een soort schortje en beschermt de kleertjes van jouw baby of dreumes extra goed door die mouwtjes.', 14.48, 3, 'Teddy beer', 'images/producten_eten&drinken/product_1_teddy.jpg', 0),
(41, 'Slab Waterproof met mouw', 'Deze slab met mouwen is geweldig. Het is een soort schortje en beschermt de kleertjes van jouw baby of dreumes extra goed door die mouwtjes.', 14.48, 3, 'Dieren', 'images/producten_eten&drinken/product_1_dieren.jpg', 0),
(42, 'Slab Waterproof met mouw', 'Deze slab met mouwen is geweldig. Het is een soort schortje en beschermt de kleertjes van jouw baby of dreumes extra goed door die mouwtjes.', 14.48, 3, 'Nijntje', 'images/producten_eten&drinken/product_1_nijntje.jpg', 0),
(43, 'Mixer voor poedermelk ', 'Mix het water en melkpoeder rechtstreeks in de zuigfles van je baby met deze poedermelkmixer.', 10.50, 3, '', 'images/producten_eten&drinken/product_2.jpg', 0),
(44, 'Philips AVENT Starterset ', 'Met deze starterset ben je klaar om je baby vanaf de geboorte te voeden. De Natural 2.0-zuigflessen van Philips AVENT imiteren de moederborst en zorgen dat borst- en flesvoeding gemakkelijk kunnen worden gecombineerd.', 44.95, 3, '', 'images/producten_eten&drinken/product_3.jpg', 0),
(45, 'Doseerdoos voor poedermelk', 'Deze doseerdoos voor poedermelk is ideaal voor ouders die vaak onderweg zijn. Met zijn modulaire, milieuvriendelijke ontwerp is het eenvoudig om de flesjes van je baby klaar te maken.', 9.95, 3, '', 'images/producten_eten&drinken/product_4.jpg', 0),
(46, 'Philips AVENT Droogrek ', 'Droog tot 8 flessen, spenen en een borstkolf tegelijk met dit droogrek van Philips AVENT.', 25.95, 3, '', 'images/producten_eten&drinken/product_5.jpg', 0),
(47, '3-delige eetset', 'Met deze mooie eetset zal je kleintje leren eten en drinken zoals de groten! De eetset bestaat uit een bord, een lekvrije beker en een lepel.  ', 22.95, 3, 'roos', 'images/producten_eten&drinken/product_6_roos.jpg', 0),
(48, '3-delige eetset', 'Met deze mooie eetset zal je kleintje leren eten en drinken zoals de groten! De eetset bestaat uit een bord, een lekvrije beker en een lepel.  ', 22.95, 3, 'blauw', 'images/producten_eten&drinken/product_6_blauw.jpg', 0),
(49, 'Oefenbeker Essentials 150 ml', 'Leren drinken zoals mama en papa? Dat kan je kleintje ook! Met deze mooie drinkbeker leert je kindje flink - en zonder morsen - zelfstandig drinken.', 4.95, 3, 'roos', 'images/producten_eten&drinken/product_7_roos.jpg', 0),
(50, 'Oefenbeker Essentials 150 ml', 'Leren drinken zoals mama en papa? Dat kan je kleintje ook! Met deze mooie drinkbeker leert je kindje flink - en zonder morsen - zelfstandig drinken.', 4.95, 3, 'blauw', 'images/producten_eten&drinken/product_7_blauw.jpg', 0),
(51, 'Oefenbeker Essentials 150 ml', 'Leren drinken zoals mama en papa? Dat kan je kleintje ook! Met deze mooie drinkbeker leert je kindje flink - en zonder morsen - zelfstandig drinken.', 4.95, 3, 'wit', 'images/producten_eten&drinken/product_7_wit.jpg', 0),
(52, 'Bijtringen - 3 stuks', 'Geef je kindje wat verkoeling met deze 3 bijtringen wanneer zijn of haar eerste tandjes beginnen te groeien.', 7.95, 3, '', 'images/producten_eten&drinken/product_8.jpg', 0),
(53, 'Sterilisator voor microgolf', 'Steriliseer tot 4 AVENT-flessen van 330 ml in 4 minuten tijd in je microgolf met deze Express II-stoomsterilisator van Philips AVENT.', 37.95, 3, '', 'images/producten_eten&drinken/product_9.jpg', 0),
(54, 'Elektrische Flessenwarmer', 'Verwarm voeding binnen enkele minuten met een flessenwarmer die de temperatuur voor je regelt. De slimme temperatuurregeling voorkomt dat melk en babyvoeding oververhit raken en past het verwarmingspatroon aan voor een snelle opwarming.', 46.99, 3, '', 'images/producten_eten&drinken/product_10.jpg', 0),
(55, 'Muziekdoosje', 'Is je baby ontroostbaar? Het draagbare muziekdoosje, stelt je kleintje gerust! Gebruik het toestel thuis in het wiegje of bed, of kalmeer je baby tijdens jullie uitstapjes in de kinderwagen.', 21.95, 4, '', 'images/producten_slaap/product_1.jpg', 0),
(56, 'Babynestje', 'Met het babynestje creëer je een eigen plaatsje voor je kleine spruit. Net zo knus als in mama\'s buik!', 79.95, 4, 'grijs', 'images/producten_slaap/product_2_grijs.jpg', 0),
(57, 'Babynestje', 'Met het babynestje creëer je een eigen plaatsje voor je kleine spruit. Net zo knus als in mama\'s buik!', 79.95, 4, 'groen', 'images/producten_slaap/product_2_groen.jpg', 0),
(58, 'Babynestje', 'Met het babynestje creëer je een eigen plaatsje voor je kleine spruit. Net zo knus als in mama\'s buik!', 79.95, 4, 'roos', 'images/producten_slaap/product_2_roos.jpg', 0),
(59, 'Hartslagknuffel Liva de Gans ', 'Liva de Gans zorgt ervoor dat je kindje rustig in slaap valt. Kies voor hartslag, white noise of 2 andere rustgevende melodieën. Met timerfunctie: stel in wanneer de knuffel stopt met spelen.\r\nMet huildetectie: gaat automatisch aan wanneer je baby huilt.\r\n', 39.95, 4, '', 'images/producten_slaap/product_3.jpg', 0),
(60, 'Fopspeen + 0 maanden', 'De fopspenen van FRIGG zijn erg comfortabel voor je kindje dankzij hun ronde vorm en luchtgaatjes die irritatie voorkomen. In de vorm van een bloemetje: superleuk!', 10.95, 4, 'Blush/Cream', 'images/producten_slaap/product_4.jpg', 0),
(61, 'Fopspeen + 0 maanden', 'De fopspenen van FRIGG zijn erg comfortabel voor je kindje dankzij hun ronde vorm en luchtgaatjes die irritatie voorkomen. In de vorm van een bloemetje: superleuk!', 10.95, 4, 'Groen/Blauw', 'images/producten_slaap/product_5.jpg', 0),
(62, 'Fopspeen 0 - 6 maanden', 'De fopspenen van het Deense merk Bibs bestaan uit 100 % natuurlijk rubber, zijn BPA-vrij en bieden je kleintje alle comfort. De ronde vorm met 3 ventilatiegaatjes is zacht voor je baby\'s huid.', 11.95, 4, 'Petrol/Blue', 'images/producten_slaap/product_6.jpg', 0),
(63, 'Fopspeen 0 - 6 maanden', 'De fopspenen van het Deense merk Bibs bestaan uit 100 % natuurlijk rubber, zijn BPA-vrij en bieden je kleintje alle comfort. De ronde vorm met 3 ventilatiegaatjes is zacht voor je baby\'s huid.', 11.95, 4, 'Vanilla/Blush ', 'images/producten_slaap/product_7.jpg', 0),
(64, 'Fopspeen 0 - 6 maanden', 'De fopspenen van het Deense merk Bibs bestaan uit 100 % natuurlijk rubber, zijn BPA-vrij en bieden je kleintje alle comfort. De ronde vorm met 3 ventilatiegaatjes is zacht voor je baby\'s huid.', 11.95, 4, 'Ivory/Sage ', 'images/producten_slaap/product_8.jpg', 0),
(65, 'Slaapzak 6-12 maanden', 'Moeilijk slapertje in huis? De Cocoon helpt je baby rustig worden en makkelijker in te slapen. Is het tijd om af te bouwen? Dan gebruik je de Cocoon gewoon als slaapzak. ', 64.95, 4, 'groen', 'images/producten_slaap/product_9_groen.jpg', 0),
(66, 'Slaapzak 6-12 maanden', 'Moeilijk slapertje in huis? De Cocoon helpt je baby rustig worden en makkelijker in te slapen. Is het tijd om af te bouwen? Dan gebruik je de Cocoon gewoon als slaapzak. ', 64.95, 4, 'roos', 'images/producten_slaap/product_9_roos.jpg', 0),
(67, 'Slaapzak 6-12 maanden', 'Moeilijk slapertje in huis? De Cocoon helpt je baby rustig worden en makkelijker in te slapen. Is het tijd om af te bouwen? Dan gebruik je de Cocoon gewoon als slaapzak. ', 64.95, 4, 'wit', 'images/producten_slaap/product_9_wit.jpg', 0),
(68, 'Knuffel Teddy Bear ', 'Dit lieve teddybeertje is je baby\'s allereerste vriendje. Een knuffel, lach of traan, met Teddy deelt je kindje het allemaal. ', 17.95, 4, 'wit', 'images/producten_slaap/product_10_wit.jpg', 0),
(69, 'Knuffel Teddy Bear ', 'Dit lieve teddybeertje is je baby\'s allereerste vriendje. Een knuffel, lach of traan, met Teddy deelt je kindje het allemaal. ', 17.95, 4, 'bruin', 'images/producten_slaap/product_10_bruin.jpg', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(5) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`) VALUES
(1, 2, 1, 4, 'Top product'),
(2, 2, 1, 5, 'Fantastisch product, heel praktisch.'),
(3, 2, 2, 5, 'Fantastisch product, heel praktisch.'),
(13, 0, 1, 0, 'd');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `typeOfUser` varchar(10) NOT NULL DEFAULT 'user',
  `street_name` varchar(300) NOT NULL,
  `house_number` varchar(5) NOT NULL,
  `postal_code` int(6) NOT NULL,
  `city` varchar(300) NOT NULL,
  `country` varchar(300) NOT NULL,
  `credits` float NOT NULL DEFAULT 1000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `typeOfUser`, `street_name`, `house_number`, `postal_code`, `city`, `country`, `credits`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '$2y$12$ya3XNC2T91JN/7kQ6iHM0uz5XdMZdKGVEJEFtPJnZz3gPxqbQEVCi', 'admin', 'admin', 'admin', 1850, 'admin', 'admin', 1000),
(2, 'user', 'user', 'user@user.com', '$2y$12$/JayUgp.iqFMXaITkH90d.IKkXfL1MslhaPfqij61hi.w6qCy3ONq', 'user', 'user', 'user', 2800, 'user', 'user', 1000);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
