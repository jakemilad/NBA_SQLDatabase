drop table Guards;
drop table Centers;
drop table Forwards;
drop table Contract;
drop table LiveHometown;
drop table Sponsor;
drop table Coach;
drop table Location;
drop table Endorsements;

drop table Player;
drop table Team;
drop table TeamOwner;
drop table Game;
drop table University;

COMMIT;

CREATE TABLE University(
                           uniID	Integer ,
                           uni_name		varchar(40),
                           championships	Integer,
                           PRIMARY KEY(uniID)
);

CREATE TABLE TeamOwner(
                          oID				Integer,
                          full_name		char(30),
                          PRIMARY KEY(oID)
);

CREATE TABLE Game (
                      gID			Integer,
                      winner			char(20),
                      PRIMARY KEY (gID)
);

CREATE TABLE Team(
                     tID				Integer,
                     championships  	Integer,
                     team_name		varchar(30),
                     gID				Integer,
                     oID				Integer 	NOT NULL,
                     PRIMARY KEY (tID),
                     FOREIGN KEY (gID) REFERENCES Game ON DELETE CASCADE,
                     FOREIGN KEY (oID) REFERENCES TeamOwner ON DELETE CASCADE
);

CREATE TABLE Player(
                       pID	Integer,
                       full_name varchar(30),
                       jersey_num Integer,
                       height Integer,
                       uniID	Integer,
                       tID	Integer,
                       PRIMARY KEY(pID),
                       FOREIGN KEY(uniID) REFERENCES University ON DELETE CASCADE,
                       FOREIGN KEY(tID) REFERENCES Team ON DELETE CASCADE
);


CREATE TABLE Guards(
                       pID				Integer,
                       p_name			varchar(30),
                       free_throw_per	Integer,
                       PRIMARY KEY(pID),
                       FOREIGN KEY(pID) REFERENCES Player ON DELETE CASCADE
);


CREATE TABLE Centers(
                        pID				Integer,
                        p_name			varchar(30),
                        blocks			Integer,
                        PRIMARY KEY(pID),
                        FOREIGN KEY(pID) REFERENCES Player ON DELETE CASCADE
);


CREATE TABLE Forwards(
                         pID				Integer,
                         p_name			varchar(30),
                         assists			Integer,
                         PRIMARY KEY(pID),
                         FOREIGN KEY(pID) REFERENCES Player ON DELETE CASCADE
);


CREATE TABLE Contract(
                         conID			Integer,
                         pID				Integer,
                         length			Integer,
                         con_value			float(20),
                         PRIMARY KEY(conID),
                         FOREIGN KEY(pID) REFERENCES Player
);


CREATE TABLE LiveHometown(
                             pID				Integer,
                             state			char(20),
                             city			char(20),
                             country			char(20),
                             PRIMARY KEY(pID, state, city),
                             FOREIGN KEY(pID) REFERENCES Player
);

CREATE TABLE Endorsements(
                             eID				Integer,
                             brand			varchar(30),
                             PRIMARY KEY(eID)
);

CREATE TABLE Sponsor(
                        pID			Integer,
                        eID			Integer,
                        PRIMARY KEY(pID, eID),
                        FOREIGN KEY(pID) REFERENCES Player ON DELETE CASCADE,
                        FOREIGN KEY(eID) REFERENCES Endorsements ON DELETE CASCADE
);


CREATE TABLE Location (
                          aID					Integer,
                          arena_name			varchar(30),
                          city				char(20),
                          state_province	 	char(20),
                          country	 			char(20),
                          gID			Integer		UNIQUE NOT NULL,
                          PRIMARY KEY (aID),
                          FOREIGN KEY (gID) REFERENCES Game ON DELETE CASCADE
);

CREATE TABLE Coach (
                       cID		Integer,
                       tID		Integer Unique,
                       full_name	char(20),
                       PRIMARY KEY (cID),
                       FOREIGN KEY (tID) REFERENCES Team ON DELETE CASCADE
);

INSERT INTO University VALUES(11,'UT Austin', 2);
INSERT INTO University VALUES(12,'Davidson', 3);
INSERT INTO University VALUES(13,'Duke', 8);
INSERT INTO University VALUES(14,'Wake Forest', 2);
INSERT INTO University VALUES(15,'Arizona State', 4);

INSERT INTO TeamOwner VALUES(50,'Buss Family Trust');
INSERT INTO TeamOwner VALUES(51,'Peter Guber');
INSERT INTO TeamOwner VALUES(52,'Anthony Ressler');
INSERT INTO TeamOwner VALUES(53,'Boston Basketball Partners');
INSERT INTO TeamOwner VALUES(54,'Jay Z');

INSERT INTO Game VALUES(70,'loser');
INSERT INTO Game VALUES(71,'winner');
INSERT INTO Game VALUES(72,'loser');
INSERT INTO Game VALUES(73,'winner');
INSERT INTO Game VALUES(74,'winner');

INSERT INTO Endorsements VALUES(90, 'Nike');
INSERT INTO Endorsements VALUES(91, 'Adidas');
INSERT INTO Endorsements VALUES(92, 'Under Armor');
INSERT INTO Endorsements VALUES(93, 'Gatorade');
INSERT INTO Endorsements VALUES(94, 'Beats by Dre');


INSERT INTO Team VALUES(20,13,'LA Lakers',70,50);
INSERT INTO Team VALUES(21,7,'Golden State Warriors',71,51);
INSERT INTO Team VALUES(22,12,'Atlanta Hawks',72,52);
INSERT INTO Team VALUES(23,9,'Boston Celtics',73,53);
INSERT INTO Team VALUES(24,3,'Brooklyn Nets',74,54);
INSERT INTO Team VALUES(25,15,'Vancouver Go',73,53);
INSERT INTO Team VALUES(26,3,'Toronto Go',74,54);

INSERT INTO Player VALUES(1,'Lebron James',6,210,11,20);
INSERT INTO Player VALUES(2,'Kevin Durant',35,220,11,24);
INSERT INTO Player VALUES(3,'Stephen Curry',30,195,12,21);
INSERT INTO Player VALUES(4,'Luka Doncic',77,210,13,20);
INSERT INTO Player VALUES(5,'Jayson Tatum',0,203,14,23);
INSERT INTO Player VALUES(6,'Giannis Antetokounmpo',27,211,15,20);
INSERT INTO Player VALUES(7,'Chris Paul',3,183,13,20);
INSERT INTO Player VALUES(8,'Joel Embid',21,223,13,21);
INSERT INTO Player VALUES(9,'Jimmy Butler',22,197,13,21);
INSERT INTO Player VALUES(100,'Klay Thompson',23,201,14,21);
INSERT INTO Player VALUES(101,'Kawhi Leonard',2,201,14,22);
INSERT INTO Player VALUES(102,'Trae Young',11,186,14,22);
INSERT INTO Player VALUES(103,'Anthony Davis',3,218,12,23);
INSERT INTO Player VALUES(104,'Bam Adebayo',13,217,12,24);

INSERT INTO Guards VALUES(5,'Jayson Tatum',73);
INSERT INTO Guards VALUES(8,'Joel Embid',90);
INSERT INTO Guards VALUES(102,'Trae Young',82);
INSERT INTO Guards VALUES(7,'Chris Paul',75);
INSERT INTO Guards VALUES(3,'Stephen Curry',98);

INSERT INTO Centers VALUES(103,'Anthony Davis',64);
INSERT INTO Centers VALUES(104,'Bam Adebayo',78);
INSERT INTO Centers VALUES(9,'Jimmy Butler',80);
INSERT INTO Centers VALUES(6,'Giannis Antetokounmpo',98);
INSERT INTO Centers VALUES(100,'Klay Thompson',23);

INSERT INTO Forwards VALUES(1,'Lebron James',14);
INSERT INTO Forwards VALUES(4,'Luka Doncic',8);
INSERT INTO Forwards VALUES(2,'Kevin Durant',13);
INSERT INTO Forwards VALUES(101,'Kawhi Leonard',7);

INSERT INTO Contract VALUES(80,6,3,13.5);
INSERT INTO Contract VALUES(81,5,5,20.2);
INSERT INTO Contract VALUES(82,3,3,12.3);
INSERT INTO Contract VALUES(83,8,2,20.5);
INSERT INTO Contract VALUES(84,4,1,4.2);

INSERT INTO LiveHometown VALUES(1,'Akron','Ohio','US');
INSERT INTO LiveHometown VALUES(3,'Akron','Ohio','US');
INSERT INTO LiveHometown VALUES(5,'St. Louis','Mouissouri','US');
INSERT INTO LiveHometown VALUES(6,'Athens','Mouissouri','US');
INSERT INTO LiveHometown VALUES(9,'Lubbock','Texas','US');

INSERT INTO Sponsor VALUES(6, 90);
INSERT INTO Sponsor VALUES(6, 91);
INSERT INTO Sponsor VALUES(6, 92);
INSERT INTO Sponsor VALUES(6, 93);
INSERT INTO Sponsor VALUES(6, 94);
INSERT INTO Sponsor VALUES(2, 90);
INSERT INTO Sponsor VALUES(2, 91);
INSERT INTO Sponsor VALUES(2, 92);
INSERT INTO Sponsor VALUES(2, 93);
INSERT INTO Sponsor VALUES(2, 94);
INSERT INTO Sponsor VALUES(100, 93);
INSERT INTO Sponsor VALUES(3, 92);
INSERT INTO Sponsor VALUES(7, 94);
INSERT INTO Sponsor VALUES(104, 91);
INSERT INTO Sponsor VALUES(5, 92);
INSERT INTO Sponsor VALUES(7, 91);
INSERT INTO Sponsor VALUES(9, 92);
INSERT INTO Sponsor VALUES(103, 94);
INSERT INTO Sponsor VALUES(100, 91);

INSERT INTO Location VALUES(40,'crypto.com Stadium','Los Angeles','California','US',70);
INSERT INTO Location VALUES(41,'Oracle Arena','Oakland','California','US',71);
INSERT INTO Location VALUES(42,'State Farm Arena','Atlanta','Georgia','US',72);
INSERT INTO Location VALUES(43,'TD Garden','Boston','Massachussets','US',73);
INSERT INTO Location VALUES(44,'Barclays Center','New York City','New York','US',74);

INSERT INTO Coach VALUES(60,20,'David Ham');
INSERT INTO Coach VALUES(61,21,'Steve Kerr');
INSERT INTO Coach VALUES(62,22,'Nate McMillan');
INSERT INTO Coach VALUES(63,23,'Ime Udoka');
INSERT INTO Coach VALUES(64,24,'Steve Nash');

COMMIT;
