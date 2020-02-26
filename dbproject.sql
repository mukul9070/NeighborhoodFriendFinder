-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2019 at 10:28 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvalrequests`
--

create DATABASE dbproject;

CREATE TABLE `approvalrequests` (
  `username` varchar(31) NOT NULL,
  `approverid` varchar(31) NOT NULL,
  `blockid` varchar(31) NOT NULL,
  `response` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approvalrequests`
--

INSERT INTO `approvalrequests` (`username`, `approverid`, `blockid`, `response`) VALUES
('u1', 'u2', 'b2', 'yes'),
('u2', 'u3', 'b3', 'no'),
('u4', 'u2', 'b2', 'yes'),
('u4', 'u3', 'b5', 'no'),
('u4', 'u6', 'b6', 'yes'),
('u5', 'u6', 'b6', 'no'),
('vyd@abc.com', 'u3', 'b7', 'yes');

--
-- Triggers `approvalrequests`
--
DELIMITER $$
CREATE TRIGGER `t2` AFTER INSERT ON `approvalrequests` FOR EACH ROW BEGIN
if (new.response="yes")
THEN
UPDATE userapproval ua
set ua.approvecount=ua.approvecount+1
WHERE ua.username=new.username and ua.blockid=new.blockid;
end IF;
SELECT approvecount into @a from userapproval ua WHERE ua.username=new.username and ua.blockid=new.blockid;
IF(@a>2)
then
UPDATE userapproval ua
SET ua.permission=1
WHERE ua.username=new.username and ua.blockid=new.blockid;
end if;

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `blockid` varchar(31) NOT NULL,
  `blockname` varchar(50) NOT NULL,
  `hoodid` varchar(31) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`blockid`, `blockname`, `hoodid`, `latitude`, `longitude`) VALUES
('b1', 'downtownblock1', 'h1', 0, 0),
('b2', 'downtownblock2', 'h1', 0, 0),
('b3', 'downtownblock3', 'h1', 0, 0),
('b4', 'bayridgeblock1', 'h2', 0, 0),
('b5', 'bayridgeblock2', 'h2', 0, 0),
('b6', 'bayridgeblock3', 'h2', 0, 0),
('b7', 'sunsetblock1', 'h3', 42, -74),
('b8', 'sunsetblock2', 'h3', 43, -76),
('b9', 'sunsetblock3', 'h3', 40, -74);

-- --------------------------------------------------------

--
-- Table structure for table `blockapplyrequests`
--

CREATE TABLE `blockapplyrequests` (
  `username` varchar(31) NOT NULL,
  `blockid` varchar(31) NOT NULL,
  `applytimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blockapplyrequests`
--

INSERT INTO `blockapplyrequests` (`username`, `blockid`, `applytimestamp`) VALUES
('u1', 'b2', '2019-12-18 22:08:22'),
('u2', 'b3', '2019-12-18 22:08:22'),
('u4', 'b2', '2019-12-18 22:08:22'),
('u4', 'b5', '2019-12-18 22:08:22'),
('u4', 'b6', '2019-12-18 22:08:22'),
('u5', 'b6', '2019-12-18 22:08:22'),
('vyd@abc.com', 'b1', '2019-12-19 20:50:28'),
('vyd@abc.com', 'b7', '2019-12-19 07:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `username1` varchar(31) NOT NULL,
  `username2` varchar(31) NOT NULL,
  `acceptflag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`username1`, `username2`, `acceptflag`) VALUES
('u1', 'u2', 1),
('u1', 'u3', 0),
('u1', 'u4', 0),
('u2', 'u3', 1),
('u2', 'u4', 1),
('u3', 'u4', 0),
('u5', 'u6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hood`
--

CREATE TABLE `hood` (
  `hoodid` varchar(31) NOT NULL,
  `hoodname` varchar(50) NOT NULL,
  `postalcode` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hood`
--

INSERT INTO `hood` (`hoodid`, `hoodname`, `postalcode`) VALUES
('h1', 'Downtown', 11201),
('h2', 'Bayridge', 11209),
('h3', 'Sunsetpark', 11220);

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `logindetailsid` int(10) NOT NULL,
  `username` varchar(31) NOT NULL,
  `password` varchar(256) NOT NULL,
  `lastlogout` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`logindetailsid`, `username`, `password`, `lastlogout`) VALUES
(1, 'u1', '5f4dcc3b5aa765d61d8327deb882cf99', '2019-12-18 22:08:21'),
(2, 'u2', '5f4dcc3b5aa765d61d8327deb882cf99', '2019-12-18 22:08:21'),
(3, 'u3', '5f4dcc3b5aa765d61d8327deb882cf99', '2019-12-18 22:08:21'),
(4, 'u4', '5f4dcc3b5aa765d61d8327deb882cf99', '2019-12-18 22:08:21'),
(5, 'u5', '5f4dcc3b5aa765d61d8327deb882cf99', '2019-12-18 22:08:21'),
(6, 'u6', '5f4dcc3b5aa765d61d8327deb882cf99', '2019-12-18 22:08:21'),
(7, 'vyd@abc.com', '4124bc0a9335c27f086f24ba207a4912', '2019-12-19 20:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `neighbors`
--

CREATE TABLE `neighbors` (
  `username1` varchar(31) NOT NULL,
  `username2` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `neighbors`
--

INSERT INTO `neighbors` (`username1`, `username2`) VALUES
('u1', 'u2'),
('u1', 'u3'),
('u1', 'u4'),
('u2', 'u3'),
('u2', 'u4'),
('u3', 'u4'),
('u5', 'u6');

-- --------------------------------------------------------

--
-- Table structure for table `newblock`
--

CREATE TABLE `newblock` (
  `username` varchar(31) NOT NULL,
  `blockid1` varchar(45) NOT NULL,
  `newhoodid` varchar(31) NOT NULL,
  `blockid2` varchar(45) NOT NULL,
  `movetimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `changeid` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newblock`
--

INSERT INTO `newblock` (`username`, `blockid1`, `newhoodid`, `blockid2`, `movetimestamp`, `changeid`) VALUES
('u2', 'b1', 'h1', 'b3', '2019-12-18 22:08:21', 'h1b1h1b3'),
('u5', 'b5', 'h3', 'b9', '2019-12-18 22:08:21', 'h2b5h3b9'),
('u4', 'b7', 'h2', 'b5', '2019-12-18 22:08:21', 'h3b7h2b5');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `username` varchar(31) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `body` varchar(300) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `threadid` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`username`, `subject`, `timestamp`, `body`, `latitude`, `longitude`, `threadid`) VALUES
('u1', 'firstthread', '2019-12-18 22:08:21', 'this is my first thread bruh', '40.65000200', '-73.94999700', 'thread1'),
('u3', 'secondthread', '2019-12-18 22:08:21', 'this is my second thread bruh', '40.64553100', '-74.01238300', 'thread2'),
('u5', 'thirdthread', '2019-12-18 22:08:21', 'this is my third thread bruh', '40.62616380', '-74.03294990', 'thread3');

-- --------------------------------------------------------

--
-- Table structure for table `threadmessages`
--

CREATE TABLE `threadmessages` (
  `replierid` varchar(31) NOT NULL,
  `replytimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `body` varchar(300) NOT NULL,
  `threadid` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threadmessages`
--

INSERT INTO `threadmessages` (`replierid`, `replytimestamp`, `body`, `threadid`) VALUES
('u3', '2019-12-18 22:08:22', 'User 3 replies to thread 1 created by user 1', 'thread1'),
('u4', '2019-12-18 22:08:22', 'User 4 replies to thread 1 created by user 1', 'thread1'),
('u5', '2019-12-18 22:08:22', 'User 5 replies to thread 2 created by user 3', 'thread2'),
('u6', '2019-12-18 22:08:22', 'User 6 replies to thread 1 created by user 1', 'thread1'),
('u6', '2019-12-18 22:08:22', 'User 6 replies to thread 3 created by user 5', 'thread3');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(31) NOT NULL,
  `ufirstname` varchar(45) NOT NULL,
  `ulastname` varchar(45) NOT NULL,
  `street` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `postalcode` int(6) NOT NULL,
  `introduction` varchar(200) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `ufirstname`, `ulastname`, `street`, `city`, `postalcode`, `introduction`, `photo`, `latitude`, `longitude`) VALUES
('u1', 'Firstone', 'Lastone', 'streetone', 'Brooklyn', 11201, 'Hello, My name is Firstone Lastone', 'www.one.com', 0, 0),
('u2', 'Firsttwo', 'Lasttwo', 'streettwo', 'Brooklyn', 11201, 'Hello, My name is Firsttwo Lasttwo', 'www.two.com', 0, 0),
('u3', 'Firstthree', 'Lastthree', 'streetthree', 'Brooklyn', 11201, 'Hello, My name is Firstthree Lastthree', 'www.three.com', 0, 0),
('u4', 'Firstfour', 'Lastfour', 'streetfour', 'Brooklyn', 11201, 'Hello, My name is Firstfour Lastfour', 'www.four.com', 0, 0),
('u5', 'Firstfive', 'Lastfive', 'streetfive', 'Brooklyn', 11209, 'Hello, My name is Firstfive Lastfive', 'www.five.com', 0, 0),
('u6', 'Firstsix', 'Lastsix', 'streetsix', 'Brooklyn', 11209, 'Hello, My name is Firstsix Lastsix', 'www.six.com', 0, 0),
('vyd@abc.com', 'Varun', 'Dhuldhoya', 'Downtown Brooklyn', 'Brooklyn', 11201, 'aa', NULL, 40.6947123, -73.9868012);

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `t1` AFTER INSERT ON `user` FOR EACH ROW BEGIN
create TEMPORARY table t1
SELECT b.blockid as bid, MIN(111.111 *
    DEGREES(ACOS(LEAST(1.0, COS(RADIANS(new.latitude))
         * COS(RADIANS(b.latitude))
         * COS(RADIANS(new.longitude - b.longitude))
         + SIN(RADIANS(new.latitude))
         * SIN(RADIANS(b.latitude))))))as distance from block b join hood h on b.hoodid=h.hoodid where h.postalcode=new.postalcode; 
         SELECT bid into @bid from t1;
         INSERT into blockapplyrequests values(new.username,@bid,now());
INSERT into userapproval values(new.username,@bid,0,0);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `t3` AFTER UPDATE ON `user` FOR EACH ROW BEGIN
create TEMPORARY table t1
SELECT b.blockid as bid, MIN(111.111 *
    DEGREES(ACOS(LEAST(1.0, COS(RADIANS(new.latitude))
         * COS(RADIANS(b.latitude))
         * COS(RADIANS(new.longitude - b.longitude))
         + SIN(RADIANS(new.latitude))
         * SIN(RADIANS(b.latitude))))))as distance from block b join hood h on b.hoodid=h.hoodid where h.postalcode=new.postalcode; 
         SELECT bid into @bid from t1;
         INSERT into blockapplyrequests values(old.username,@bid,now());
INSERT into userapproval values(old.username,@bid,0,0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `userapproval`
--

CREATE TABLE `userapproval` (
  `username` varchar(31) NOT NULL,
  `blockid` varchar(31) NOT NULL,
  `approvecount` int(50) NOT NULL,
  `permission` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userapproval`
--

INSERT INTO `userapproval` (`username`, `blockid`, `approvecount`, `permission`) VALUES
('u1', 'b1', 1, 0),
('u2', 'b2', 3, 1),
('u3', 'b3', 3, 1),
('u4', 'b4', 2, 0),
('u5', 'b5', 0, 0),
('u6', 'b6', 3, 1),
('vyd@abc.com', 'b1', 0, 0),
('vyd@abc.com', 'b7', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userjoinedthread`
--

CREATE TABLE `userjoinedthread` (
  `username` varchar(31) NOT NULL,
  `threadid` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userjoinedthread`
--

INSERT INTO `userjoinedthread` (`username`, `threadid`) VALUES
('u1', 'thread2'),
('u3', 'thread1'),
('u4', 'thread1'),
('u5', 'thread2'),
('u6', 'thread3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvalrequests`
--
ALTER TABLE `approvalrequests`
  ADD PRIMARY KEY (`username`,`blockid`,`approverid`),
  ADD KEY `blockid` (`blockid`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`blockid`),
  ADD KEY `hoodid` (`hoodid`);

--
-- Indexes for table `blockapplyrequests`
--
ALTER TABLE `blockapplyrequests`
  ADD PRIMARY KEY (`username`,`blockid`,`applytimestamp`),
  ADD KEY `blockid` (`blockid`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`username1`,`username2`),
  ADD KEY `username2` (`username2`);

--
-- Indexes for table `hood`
--
ALTER TABLE `hood`
  ADD PRIMARY KEY (`hoodid`,`postalcode`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`logindetailsid`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `neighbors`
--
ALTER TABLE `neighbors`
  ADD PRIMARY KEY (`username1`,`username2`),
  ADD KEY `username2` (`username2`);

--
-- Indexes for table `newblock`
--
ALTER TABLE `newblock`
  ADD PRIMARY KEY (`changeid`),
  ADD KEY `newhoodid` (`newhoodid`),
  ADD KEY `username` (`username`),
  ADD KEY `blockid1` (`blockid1`),
  ADD KEY `blockid2` (`blockid2`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`threadid`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `threadmessages`
--
ALTER TABLE `threadmessages`
  ADD PRIMARY KEY (`replierid`,`replytimestamp`,`threadid`),
  ADD KEY `threadid` (`threadid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `userapproval`
--
ALTER TABLE `userapproval`
  ADD PRIMARY KEY (`username`,`blockid`),
  ADD KEY `blockid` (`blockid`);

--
-- Indexes for table `userjoinedthread`
--
ALTER TABLE `userjoinedthread`
  ADD PRIMARY KEY (`username`,`threadid`),
  ADD KEY `threadid` (`threadid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvalrequests`
--
ALTER TABLE `approvalrequests`
  ADD CONSTRAINT `approvalrequests_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `approvalrequests_ibfk_2` FOREIGN KEY (`blockid`) REFERENCES `block` (`blockid`);

--
-- Constraints for table `block`
--
ALTER TABLE `block`
  ADD CONSTRAINT `block_ibfk_1` FOREIGN KEY (`hoodid`) REFERENCES `hood` (`hoodid`);

--
-- Constraints for table `blockapplyrequests`
--
ALTER TABLE `blockapplyrequests`
  ADD CONSTRAINT `blockapplyrequests_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `blockapplyrequests_ibfk_2` FOREIGN KEY (`blockid`) REFERENCES `block` (`blockid`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`username1`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`username2`) REFERENCES `user` (`username`);

--
-- Constraints for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD CONSTRAINT `logindetails_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `neighbors`
--
ALTER TABLE `neighbors`
  ADD CONSTRAINT `neighbors_ibfk_1` FOREIGN KEY (`username1`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `neighbors_ibfk_2` FOREIGN KEY (`username2`) REFERENCES `user` (`username`);

--
-- Constraints for table `newblock`
--
ALTER TABLE `newblock`
  ADD CONSTRAINT `newblock_ibfk_1` FOREIGN KEY (`newhoodid`) REFERENCES `hood` (`hoodid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `newblock_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `newblock_ibfk_3` FOREIGN KEY (`blockid1`) REFERENCES `block` (`blockid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `newblock_ibfk_4` FOREIGN KEY (`blockid2`) REFERENCES `block` (`blockid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `threadmessages`
--
ALTER TABLE `threadmessages`
  ADD CONSTRAINT `threadmessages_ibfk_1` FOREIGN KEY (`threadid`) REFERENCES `thread` (`threadid`),
  ADD CONSTRAINT `threadmessages_ibfk_2` FOREIGN KEY (`replierid`) REFERENCES `user` (`username`);

--
-- Constraints for table `userapproval`
--
ALTER TABLE `userapproval`
  ADD CONSTRAINT `userapproval_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `userapproval_ibfk_2` FOREIGN KEY (`blockid`) REFERENCES `block` (`blockid`);

--
-- Constraints for table `userjoinedthread`
--
ALTER TABLE `userjoinedthread`
  ADD CONSTRAINT `userjoinedthread_ibfk_2` FOREIGN KEY (`threadid`) REFERENCES `thread` (`threadid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
