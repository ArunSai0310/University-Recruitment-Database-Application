-- -----------------------------------------------------
-- Schema futureniner
-- -----------------------------------------------------
DROP Database if exists futureniner;
CREATE DATABASE futureniner;
Use futureniner;

-- -----------------------------------------------------

CREATE TABLE users (
  UserID int(11) NOT NULL AUTO_INCREMENT,
  Username varchar(50) NOT NULL,
  Password varchar(20) NOT NULL,
  PhoneNumber varchar(20) DEFAULT NULL,
  Email varchar(50) NOT NULL,
  Gender char(1) NOT NULL,
  fName varchar(20) NOT NULL,
  lName varchar(20) NOT NULL,
  mName varchar(20) DEFAULT NULL,
  DOB date NOT NULL,
  AddressLine1 varchar(20) NOT NULL,
  AddressLine2 varchar(20) DEFAULT NULL,
  City varchar(10) NOT NULL,
  State varchar(10) NOT NULL,
  ZIP int(5) NOT NULL,
  Country varchar(20) NOT NULL,
  PRIMARY KEY (UserID),
  UNIQUE KEY Username (Username)
);

-- -----------------------------------------------------

CREATE TABLE department (
  DeptID char(5) NOT NULL,
  DeptHead char(50) DEFAULT NULL,
  DeptName char(50) DEFAULT NULL,
  Contact varchar(20) DEFAULT NULL,
  PRIMARY KEY (DeptID)
);

-- -----------------------------------------------------

CREATE TABLE companies (
  CompID char(5) NOT NULL DEFAULT '',
  CompanyName char(50) DEFAULT NULL,
  PRIMARY KEY (CompID)
);
-- -----------------------------------------------------

CREATE TABLE scholarship (
  ScholarshipID char(5) NOT NULL,
  ScholarshipDesc varchar(40) DEFAULT NULL,
  Amount float(7,2) DEFAULT NULL,
  Semester_Year varchar(20) DEFAULT NULL,
  Description varchar(200) DEFAULT NULL,
  PRIMARY KEY (ScholarshipID)
);

-- -----------------------------------------------------

CREATE TABLE student (
  SID int(11) NOT NULL AUTO_INCREMENT,
  UserID int(11) NOT NULL,
  PRIMARY KEY (SID),
  KEY student_ibfk_1 (UserID),
  CONSTRAINT student_ibfk_1 FOREIGN KEY (UserID) REFERENCES users (UserID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------

CREATE TABLE recruiter (
  RecID int(11) NOT NULL AUTO_INCREMENT,
  UserID int(11) NOT NULL,
  PRIMARY KEY (RecID),
  KEY recruiter_ibfk_1 (UserID),
  CONSTRAINT recruiter_ibfk_1 FOREIGN KEY (UserID) REFERENCES users (UserID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------

CREATE TABLE program (
  ProgID char(5) NOT NULL,
  DeptID char(5) DEFAULT NULL,
  ProgName varchar(45) DEFAULT NULL,
  Amount_Instate float(7,2) DEFAULT NULL,
  Amount_Outstate float(7,2) DEFAULT NULL,
  CreditHours int(11) DEFAULT NULL,
  Description varchar(600) DEFAULT NULL,
  PRIMARY KEY (ProgID),
  KEY DeptID (DeptID),
  CONSTRAINT program_ibfk_1 FOREIGN KEY (DeptID) REFERENCES department (DeptID)
);

-- -----------------------------------------------------

CREATE TABLE schoolevents (
  EventID char(5) NOT NULL,
  DeptID char(5) DEFAULT NULL,
  EventDesc varchar(30) DEFAULT NULL,
  EventDATE date DEFAULT NULL,
  PRIMARY KEY (EventID),
  KEY DeptID (DeptID),
  CONSTRAINT schoolevents_ibfk_1 FOREIGN KEY (DeptID) REFERENCES department (DeptID)
) ;
 
-- -----------------------------------------------------

CREATE TABLE courses (
  CourseID char(5) NOT NULL,
  DeptID char(5) DEFAULT NULL,
  COURSE_TITLE varchar(50) DEFAULT NULL,
  CREDIT_HOURS int(11) DEFAULT NULL,
  DESCRIPTION varchar(100) DEFAULT NULL,
  PRIMARY KEY (CourseID),
  KEY DeptID (DeptID),
  CONSTRAINT courses_ibfk_1 FOREIGN KEY (DeptID) REFERENCES department (DeptID)
);

-- -----------------------------------------------------

CREATE TABLE professor (
  ProfID char(5) NOT NULL,
  DeptID char(5) NOT NULL,
  fName varchar(50) DEFAULT NULL,
  mName varchar(50) DEFAULT NULL,
  lName varchar(50) DEFAULT NULL,
  Email varchar(50) DEFAULT NULL,
  Address varchar(50) DEFAULT NULL,
  Description varchar(200) DEFAULT NULL,
  PRIMARY KEY (ProfID),
  KEY DeptID (DeptID),
  CONSTRAINT professor_ibfk_1 FOREIGN KEY (DeptID) REFERENCES department (DeptID)
);

-- -----------------------------------------------------

CREATE TABLE facilities (
  LabID char(5) NOT NULL,
  DeptID char(5) DEFAULT NULL,
  LabName varchar(50) DEFAULT NULL,
  Location varchar(20) DEFAULT NULL,
  PRIMARY KEY (LabID),
  KEY DeptID (DeptID),
  CONSTRAINT facilities_ibfk_1 FOREIGN KEY (DeptID) REFERENCES department (DeptID)
) ;

-- -----------------------------------------------------

CREATE TABLE deptrecruitscompanies (
  CompID char(5) NOT NULL,
  DeptID char(5) NOT NULL,
  NoOfStudentsRec int(11) NOT NULL,
  RecruitedYear int(11) NOT NULL,
  PRIMARY KEY (CompID,DeptID,RecruitedYear),
  KEY DeptID (DeptID),
  CONSTRAINT deptrecruitscompanies_ibfk_1 FOREIGN KEY (CompID) REFERENCES companies (CompID),
  CONSTRAINT deptrecruitscompanies_ibfk_2 FOREIGN KEY (DeptID) REFERENCES department (DeptID)
);


-- -----------------------------------------------------

CREATE TABLE application (
  ApplicationId int(11) NOT NULL AUTO_INCREMENT,
  ApplicationDATE date NOT NULL,
  Status enum('Not Submitted','Submitted','Admitted','Rejected') DEFAULT 'Not Submitted',
  HighSchoolGPA float(3,2) DEFAULT NULL,
  SATScore int(11) DEFAULT NULL,
  UndergradGPA float(3,2) NOT NULL,
  GREscore smallint(3) NOT NULL,
  GREverbalScore smallint(3) NOT NULL,
  GREquantitativeScore smallint(3) NOT NULL,
  GREanalyticalWritingScore float(2,1) NOT NULL,
  TOEFLscore smallint(3) NOT NULL,
  TOEFLreading tinyint(2) NOT NULL,
  TOEFLlistening tinyint(2) NOT NULL,
  TOEFLspeaking tinyint(2) NOT NULL,
  TOEFLwriting tinyint(2) NOT NULL,
  IELTSscore float(2,1) DEFAULT NULL,
  RecID int(11) DEFAULT NULL,
  PRIMARY KEY (ApplicationId),
  KEY RecID (RecID),
  CONSTRAINT application_ibfk_1 FOREIGN KEY (RecID) REFERENCES recruiter (RecID)
);

-- -----------------------------------------------------

CREATE TABLE recommendations (
  ApplicationID int(11) NOT NULL DEFAULT '0',
  fName varchar(20) DEFAULT NULL,
  lName varchar(20) DEFAULT NULL,
  AddressLine1 varchar(45) DEFAULT NULL,
  AddressLine2 varchar(45) DEFAULT NULL,
  City varchar(20) DEFAULT NULL,
  State varchar(30) DEFAULT NULL,
  Country varchar(20) DEFAULT NULL,
  Email varchar(45) DEFAULT NULL,
  recommendation_id int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (recommendation_id,ApplicationID),
  KEY recommendations_ibfk_1 (ApplicationID),
  CONSTRAINT recommendations_ibfk_1 FOREIGN KEY (ApplicationID) REFERENCES application (ApplicationId) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------

CREATE TABLE workexperience (
  ApplicationID int(11) NOT NULL,
  CompanyName varchar(45) DEFAULT NULL,
  Location varchar(45) DEFAULT NULL,
  StartDATE date DEFAULT NULL,
  EndDATE date DEFAULT NULL,
  workexperienceid int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (workexperienceid,ApplicationID),
  KEY workexperience_ibfk_1 (ApplicationID),
  CONSTRAINT workexperience_ibfk_1 FOREIGN KEY (ApplicationID) REFERENCES application (ApplicationId) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------

CREATE TABLE offers_eligible (
  ProgID char(5) NOT NULL,
  ScholarshipID char(5) NOT NULL,
  PRIMARY KEY (ProgID,ScholarshipID),
  KEY ScholarshipID (ScholarshipID),
  CONSTRAINT offers_eligible_ibfk_1 FOREIGN KEY (ProgID) REFERENCES program (ProgID),
  CONSTRAINT offers_eligible_ibfk_2 FOREIGN KEY (ScholarshipID) REFERENCES scholarship (ScholarshipID)
);

-- --------------------------------------

CREATE TABLE research (
  ResearchID char(5) NOT NULL,
  ProfID char(5) DEFAULT NULL,
  Specialization varchar(100) NOT NULL,
  Field varchar(100) NOT NULL,
  Duration int(11) DEFAULT NULL,
  PRIMARY KEY (ResearchID),
  KEY ProfID (ProfID),
  CONSTRAINT research_ibfk_1 FOREIGN KEY (ProfID) REFERENCES professor (ProfID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------

CREATE TABLE offersassistantship (
  AsstID char(5) NOT NULL,
  ProfID char(5) NOT NULL,
  Asstship_Name varchar(100) NOT NULL,
  Asstship_Type varchar(100) DEFAULT NULL,
  Duration int(11) DEFAULT NULL,
  PRIMARY KEY (AsstID,ProfID),
  KEY ProfID (ProfID),
  CONSTRAINT offersassistantship_ibfk_1 FOREIGN KEY (ProfID) REFERENCES professor (ProfID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------

CREATE TABLE applies (
  ProgID char(5) NOT NULL,
  ApplicationID int(11) NOT NULL,
  SID int(11) NOT NULL,
  LastUpDATEd date DEFAULT NULL,
  PRIMARY KEY (ApplicationID),
  KEY applies_ibfk_2_idx (ProgID),
  KEY applies_ibfk_3 (SID),
  CONSTRAINT applies_ibfk_1 FOREIGN KEY (ApplicationID) REFERENCES application (ApplicationId) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT applies_ibfk_2 FOREIGN KEY (ProgID) REFERENCES program (ProgID) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT applies_ibfk_3 FOREIGN KEY (SID) REFERENCES student (SID) ON DELETE NO ACTION ON UPDATE NO ACTION
);


-- ------------------------------------------------------------------

INSERT INTO Users()
	values 
    (1, 'AllanAlda',     'abcd', '111-111-1111', 'Allan.Alda@alpha.com',  'M',   'Allen', 'Alda', 'A',     '1990/1/1', '1 Alda Lane', '',      'Allan',     'NC', 28262,'USA'),
    (2, 'Barbara',   'efgh', '222-222-2222', 'Barbara.Bean@bbb.com',  'F', 'Barbara', 'Bean', 'B',   '1990/2/2', '2 Bean Blvd', 'Apt B', 'Babs',      'NC', 28262,'USA'),
    (3, 'CarlCapp',      'jklm', '333-333-3333', 'Carl.Capp@ccc.com',     'M',   'Carl', 'Capp', '',       '1990/3/3', '3 Capp Ct.', '',       'Capp',      'ON',28262, 'Canada'),
    (4, 'DarleneDavis',  'nopq', '444-444-4444', 'Darlene.Davis@ddd.com', 'F', 'Darlene', 'Davis', 'D',  '1990/4/4', '4 Davis Dr.', 'Apt D', 'Darla',     'NY',28262, 'USA'),
    (5, 'EddyEdgar',     'rstu', '555-555-5555', 'Eddy.Edgar.EEE.com',    'M',   'Eddy', 'Edgar', 'E',     '1991/5/5', '5 Eddy Rd.', '',       'Edgar',      '', 28262, 'France'),
    (6, 'FranFrankel',   'vwxy', '666-666-6666', 'Fran.Frankel.fff.com',  'F', 'Fran', 'Frankel', 'Fay', '1991/6/6', '6 Frankel Fort', '',   'Fran',      'NC', 28262,'USA'),
    (7, 'sam',     'sam', '777-777-7777', 'sam@samx.com',    'M',   'Sam', 'Peter', 'K',     '1991/09/25', '7 Gee Road', '',       'George',    '',  28262, 'USA'),
    (8, 'HannahHark',    'defg', '888-888-8888', 'Hannah.Hark.hhh.com',   'F', 'Hannah', 'Hark', '',     '1992/8/8', '8 Harkonnen Rd.', '',  'Hardy',     'NC', 28262,'USA'),
    (9, 'IanIota',       'hijk', '999-999-9999', 'Ian.Iota.iii.com',      'M',   'Ian', 'Iota', 'I',       '1992/9/9', '9 Iona Isle', 'Apt I', 'Iota',      '',  28262, 'China'),
    (10, 'JeanneJones',   'hijk', '100-100-1000', 'Jasper.Jones.jjj.com',  'F', 'Jeanne', 'Jones', '',   '1993/10/1', '10 Jones Drive', '',  'Jaspar',    '',   28262,'South Africa'),
    (11, 'KevinKarp',     'lmno', '101-101-1001', 'Kevin.Karp@kkk.com',    'M',   'Kevin', 'Karp', '',     '1985/1/1', '11 Kevin Ct', 'Apt K', 'Karp',      'NC', 28262,'USA'),
    (12, 'LilaLing',      'pqrs', '202-202-2002', 'Lila.Ling@lll.com',     'F', 'Lila', 'Ling', 'L',     '1986/1/1', '12 Ling Lane', '',     'Lipp',      'SC', 28262,'USA'),
    (13, 'MikeMyers',     'tuvw', '303-303-3003', 'Mike.Myers@mmm.com',    'M',   'Mike', 'Myers', '',     '1987/1/1', '13 Mike Rd.', 'Apt. M','Marsh',     'NC',28262, 'USA'),
    (14, 'NancyNee',      'xyza', '404-404-4004', 'Nancy.Nee@nnn.com',     'F', 'Nancy', 'Nee', '',      '1988/1/1', '14 Nee Dr.', '',       'Narp',      'NC', 28262,'USA'),
    (15, 'OlsonOrk',      'bcde', '505-505-5005', 'Olson.Ork@ooo.com',     'M',   'Olson', 'Ork', '',      '1989/1/1', '15 Ork Ln', '',        'Orkland',   'NC',28262, 'USA'),
    (16, 'PatPark',       'fghi', '606-606-6006', 'Pat.Park@ppp.com',      'F', 'Pat', 'Park', 'P',      '1989/2/2', '16 Park Place', '',    'Parkland',  'NC', 28262,'USA'),
    (17, 'QuentinQuay',   'jklm', '707-707-7007', 'Quentin.Quay@qqq.com',  'M',   'Quentin', 'Quay',  'Q', '1990/3/3', '17 Quay Quay', '',     'Queenland', 'NC',28262, 'USA'), 
    (18, 'RobinRay',      'nopq', '808-808-8008', 'Robin.Ray@rrr.com',     'F', 'Robin', 'Ray',  '',     '1990/4/4', '18 Ray Road', '',      'Robinland', 'NC', 28262,'USA'),
    (19, 'ThomasTutt',    'rstu', '909-909-9009', 'Thomas.Tutt@tutt.com',  'M',   'Thomas', 'Tutt', '',    '1985/5/5', '19 Tutt Way', '',      'Tomville',  'NC', 28262,'USA'),
    (20, 'UlrikaUrbin',   'vwxy', '110-110-1010', 'Ulrika.Urbin@uuu.com',  'F', 'Ulrika', 'Urbin', '',   '1986/6/6', '20 Universe Way', 'Box U',     'Uton',      'NC',28262, 'USA');

INSERT INTO Department()
	values
('1', 'Tom Riddle', 'Electrical Engineering', 'ee@uncc.edu'),
('2', 'Albus Dumbeldore', 'Computer Science Engineering', 'cse@uncc.edu'),
('3', 'Sirius Black', 'Information Technology', 'it@uncc.edu'),
('4', 'Aurther Weasley', 'Mechanical Engineering', 'mech@uncc.edu'),
('5', 'Remus Lupin', 'Art', 'art@uncc.edu'),
('6', 'Rubius Hagrid', 'Humanities', 'humanities@uncc.edu'),
('7', 'Luna Lovegood', 'Law', 'law@uncc.edu'),
('8', 'Nevile Longbottom', 'Bio-Technology', 'bio@uncc.edu'),
('9', 'Hermoine Granger', 'Electronics and communication Engineering', 'ece@uncc.edu'),
('10', 'Severus Snape', 'Civil Engineering', 'civil@uncc.edu');


INSERT INTO Companies ()
	values
    (1, 'Alpha, Inc.'),
    (2, 'Beta Corp.'),
    (3, 'Gamma Co.'),
    (4, 'Delta Inc.'),
    (5, 'Epsilon'),
    (6, 'Zeta Comp.'),
    (7, 'Eta Industr'),
    (8, 'Iota Inc.'),
    (9, 'Kappa Co.'),
    (10,'Lambda Inc.');
    
INSERT INTO Scholarship(ScholarshipID, ScholarshipDesc, Amount, Semester_Year,Description)
	values
    (1, 'A. K. Sutton Scholarship',10000, 'Spring 2015',''),
    (2, 'Abigail Elizabeth Gudeman Scholarship', 5000, 'Fall 2015',''),
    (3, 'Brycie Baber Scholarship', 2500, 'Fall 2015',''),
    (4, 'Carl J. McEwen Scholarship', 1000, 'Fall 2015',''), 
    (5, 'Danielson Scholarship for Merit', 25000, 'Fall 2015',''),
    (6, 'Fiechtner Scholarship', 1000, 'Spring 2016',''),
    (7, 'Henry Forrest Scholarship', 5000, 'Spring 2016',''),
    (8, 'J. Murrey Atkins Scholarship for Merit', 7500, 'Spring 2016',''),
    (9, 'North Carolina Ports Scholarship',10000, 'Spring 2016',''),
    (10,'Robert K. Hall Scholarship', 5000, 'Spring 2016','');
    
Insert INTo Program()
	values
	('1', '1',  'UnderGraduation', 440.25,2086.75,72,'The Electrical Engineering Department offers programs leading to bachelors, masters and Ph.D. degrees. Our students acquire a breadth of knowledge in the field of electrical engineering, and a depth of knowledge in a chosen research specialty.'),
	('2', '1',  'Masters', 501.00,2037.00,30,'The Electrical Engineering Department offers programs leading to bachelors, masters and Ph.D. degrees. Our students acquire a breadth of knowledge in the field of electrical engineering, and a depth of knowledge in a chosen research specialty.'),
	('3', '1',  'Doctorate', 1001.50,4038.7,12,'The Electrical Engineering Department offers programs leading to bachelors, masters and Ph.D. degrees. Our students acquire a breadth of knowledge in the field of electrical engineering, and a depth of knowledge in a chosen research specialty.'),
    
	('4', '2',  'UnderGraduation', 440.25,2086.75,72,'Computer Science is the cornerstone of modern information technology.  It has revolutionized how we learn, communicate, entertain, conduct business, perform research, and practice medicine.  This information revolution is just beginning and is providing computer scientists with nearly limitless opportunities to make satisfying and enriching contributions to society.'),
	('5', '2',  'Masters', 501.00,2037.00,30,'Computer Science is the cornerstone of modern information technology.  It has revolutionized how we learn, communicate, entertain, conduct business, perform research, and practice medicine.  This information revolution is just beginning and is providing computer scientists with nearly limitless opportunities to make satisfying and enriching contributions to society.'),
	('6', '2',  'Doctorate', 1001.50,4038.7,12,'Computer Science is the cornerstone of modern information technology.  It has revolutionized how we learn, communicate, entertain, conduct business, perform research, and practice medicine.  This information revolution is just beginning and is providing computer scientists with nearly limitless opportunities to make satisfying and enriching contributions to society.'),	
    
    ('7', '3',  'UnderGraduation', 440.25,2086.75,72,'The Department of Information Technology is primarily focused on (a) the study of technologies and methodologies for information system architecture, design, implementation, integration, and management with particular emphasis on system security and (b) the modeling and analysis of natural and human-generated systems such as weather, biological systems, markets, and supply chain.'),
	('8', '3',  'Masters', 501.00,2037.00,30,'The Department of Information Technology is primarily focused on (a) the study of technologies and methodologies for information system architecture, design, implementation, integration, and management with particular emphasis on system security and (b) the modeling and analysis of natural and human-generated systems such as weather, biological systems, markets, and supply chain.'),
	('9', '3',  'Doctorate', 1001.50,4038.7,12,'The Department of Information Technology is primarily focused on (a) the study of technologies and methodologies for information system architecture, design, implementation, integration, and management with particular emphasis on system security and (b) the modeling and analysis of natural and human-generated systems such as weather, biological systems, markets, and supply chain.'),
	
    ('10', '4',  'UnderGraduation', 440.25,2086.75,72,'Department of Mechanical engineering is the discipline that applies the principles of engineering, physics, and materials science for the design, analysis, manufacturing, and maintenance of mechanical systems. It is the branch of engineering that involves the design, production, and operation of machinery.It is one of the oldest and broadest of the engineering disciplines.'),
	('11', '4',  'Masters', 501.00,2037.00,30,'Department of Mechanical engineering is the discipline that applies the principles of engineering, physics, and materials science for the design, analysis, manufacturing, and maintenance of mechanical systems. It is the branch of engineering that involves the design, production, and operation of machinery.It is one of the oldest and broadest of the engineering disciplines.'),
	('12', '4',  'Doctorate', 1001.50,4038.7,12,'Department of Mechanical engineering is the discipline that applies the principles of engineering, physics, and materials science for the design, analysis, manufacturing, and maintenance of mechanical systems. It is the branch of engineering that involves the design, production, and operation of machinery.It is one of the oldest and broadest of the engineering disciplines.'),
	
    ('13', '5',  'UnderGraduation', 440.25,2086.75,72,'The Department of Art aims to foster innovative and thoughtful artistic practice, scholarship, and education.'),
	('14', '5',  'Masters', 501.00,2037.00,30,'The Department of Art aims to foster innovative and thoughtful artistic practice, scholarship, and education.'),
	('15', '5',  'Doctorate', 1001.50,4038.7,12,'The Department of Art aims to foster innovative and thoughtful artistic practice, scholarship, and education.'),
	
    ('16', '6',  'UnderGraduation', 440.25,2086.75,72,'The humanities are academic disciplines that study human culture. The humanities use methods that are primarily critical, or speculative, and have a significant historical element as distinguished from the mainly empirical approaches of the natural sciences.'),
	('17', '6',  'Masters', 501.00,2037.00,30,'The humanities are academic disciplines that study human culture. The humanities use methods that are primarily critical, or speculative, and have a significant historical element as distinguished from the mainly empirical approaches of the natural sciences.'),
	('18', '6',  'Doctorate', 1001.50,4038.7,12,'The humanities are academic disciplines that study human culture. The humanities use methods that are primarily critical, or speculative, and have a significant historical element as distinguished from the mainly empirical approaches of the natural sciences.'),
	
    ('19', '7',  'UnderGraduation', 440.25,2086.75,72,'The practice of law has become more entwined with the business world, and tomorrowâ€™s leaders will require a deep understanding of both environments. This program provides an opportunity for our students to broaden their perspectives through access to one of the leading programs in the country.'),
	('20', '7',  'Masters', 501.00,2037.00,30,'The practice of law has become more entwined with the business world, and tomorrowâ€™s leaders will require a deep understanding of both environments. This program provides an opportunity for our students to broaden their perspectives through access to one of the leading programs in the country.'),
	('21', '7',  'Doctorate', 1001.50,4038.7,12,'The practice of law has become more entwined with the business world, and tomorrowâ€™s leaders will require a deep understanding of both environments. This program provides an opportunity for our students to broaden their perspectives through access to one of the leading programs in the country.'),
	
    ('22', '8',  'UnderGraduation', 440.25,2086.75,72,'Biotechnology is the application of scientific and engineering principles to the processing of materials by biological agents to provide goods and services. From its inception, biotechnology has maintained a close relationship with society.'),
	('23', '8',  'Masters', 501.00,2037.00,30,'Biotechnology is the application of scientific and engineering principles to the processing of materials by biological agents to provide goods and services. From its inception, biotechnology has maintained a close relationship with society.'),
	('24', '8',  'Doctorate', 1001.50,4038.7,12,'Biotechnology is the application of scientific and engineering principles to the processing of materials by biological agents to provide goods and services. From its inception, biotechnology has maintained a close relationship with society.'),
	
    ('25', '9',  'UnderGraduation', 440.25,2086.75,72,'Electronics and Communications Engineering, is an engineering discipline which utilizes non-linear and active electrical components to design electronic circuits, devices and systems. The discipline typically also designs passive electrical components, usually based on printed circuit boards.'),
	('26', '9',  'Masters', 501.00,2037.00,30,'Electronics and Communications Engineering, is an engineering discipline which utilizes non-linear and active electrical components to design electronic circuits, devices and systems. The discipline typically also designs passive electrical components, usually based on printed circuit boards.'),
	('27', '9',  'Doctorate', 1001.50,4038.7,12,'Electronics and Communications Engineering, is an engineering discipline which utilizes non-linear and active electrical components to design electronic circuits, devices and systems. The discipline typically also designs passive electrical components, usually based on printed circuit boards.'),
	
    ('28', '10',  'UnderGraduation', 440.25,2086.75,72,'Our mission is to deliver bachelors, masters, and doctoral programs in a research intensive environment
that provides students with the opportunity to develop state-of-the-art technical skills, a practice-ready
orientation, and extraordinary character.'),
	('29', '10',  'Masters', 501.00,2037.00,30,'Our mission is to deliver bachelors, masters, and doctoral programs in a research intensive environment
that provides students with the opportunity to develop state-of-the-art technical skills, a practice-ready
orientation, and extraordinary character.'),
	('30', '10',  'Doctorate', 1001.50,4038.7,12,'Our mission is to deliver bachelors, masters, and doctoral programs in a research intensive environment
that provides students with the opportunity to develop state-of-the-art technical skills, a practice-ready
orientation, and extraordinary character.');



INSERT INTO Recruiter ()
	values
    (1, 11),
    (2, 12), 
    (3, 13),
    (4, 14),
    (5, 15),
    (6, 16),
    (7, 17),
    (8, 18),
    (9, 19),
    (10, 20);



INSERT INTO Student()
	values
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4), 
    (5, 5), 
    (6, 6), 
    (7, 7),
    (8, 8),
    (9, 9),
    (10, 10);
    
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('1','2',10,2010);
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('10','2',19,2001);
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('2','2',34,2012);
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('3','3',1,2014);
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('4','2',123,2013);
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('5','3',23,2012);
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('6','3',54,2013);
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('7','4',65,2011);
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('8','3',76,2010);
INSERT INTO deptrecruitscompanies (CompID,DeptID,NoOfStudentsRec,RecruitedYear) VALUES ('9','5',23,2009);

    
INSERT INTO SchoolEvents ()
	values
    (1, 2, 'Meet our Professor', '2015/1/1'),
    (2, 2, 'Panel Discussion', '2015/2/2'),
    (3, 3, 'Department Orientation', '2015/3/3'),
    (4, 3, 'Advising Sessions', '2015/4/4'),
    (5, 1, 'Open House - May 2015', '2015/5/5'),
    (6, 1, 'Open House - June 2015', '2015/6/6'),
    (7, 1, 'Open House - July 2015', '2015/7/7'),
    (8, 1, 'Open House - Aug 2015', '2015/8/8'),
    (9, 1, 'Open House - Sept 2015', '2015/9/9'),
    (10,1, 'Open House - Oct 2015', '2015/10/10');

INSERT INTO Professor(ProfID, DeptID, fName, mName, lName, Email,Address,Description)
     values
     (1, 1, 'Ann', 'Alice', 'Arbor',    'ann.arbor@univ.edu', 'Charlotte, NC - 28262','M.S., PHD'),
     (2, 2, 'Bob', '',      'Barker',   'bob.barker@univ.edu','Charlotte, NC - 28245','M.S., PHD'),
     (3, 3, 'Carla', '',    'Carlson',  'carla.carlson@univ.edu','Charlotte, NC - 34262','M.S., PHD'),
     (4, 5, 'Dave', 'Derrick', 'Davis', 'dave.davis@univ.edu','Charlotte, NC - 28245','M.S., PHD'),
     (5, 4, 'Ella', 'Edna', 'Earwig',   'ella.earwig@univ.edu','Charlotte, NC - 28352','M.S., PHD'),
     (6, 6, 'Frank', 'F.', 'Ford',      'frank.ford@univ.edu','Charlotte, NC - 28265','M.S., PHD'),
     (7, 7, 'Gina', '', 'Gaga',         'gina.gaga@univ.edu','Charlotte, NC - 28765','PHD'),
     (8, 8, 'Henry', 'Harris', 'Hope',  'henry.hope@univ.edu','Charlotte, NC - 23452','M.S.'),
     (9, 9, 'Jen', 'June', 'Jones',     'jen.jones@univ.edu','Charlotte, NC - 23453','M.S., PHD'),
     (10,10, 'Karl', 'K', 'Jones',        'karl.Jones@univ.edu','Charlotte, NC - 28262','M.S., PHD'),
     (11,1, 'Jones', 'K', 'Karp',        'Jones.karp@univ.edu','Charlotte, NC - 28262','M.S., PHD'),
     (12,2, 'Karl', 'K', 'Jones',        'karl.Jones2@univ.edu','Charlotte, NC - 28262','M.S., PHD'),
     (13,2, 'Earwig', 'K', 'Karp',        'Earwig.karp@univ.edu','Charlotte, NC - 28262','M.S., PHD'),
     (14,1, 'Karl', 'K', 'Earwig',        'karl.Earwig@univ.edu','Charlotte, NC - 28262','M.S.');
     
INSERT INTO OffersAssistantship()
     values
     (1,2, 'Lab Rat Summer 2015',     'Lab Assistant', 3),
     (1,3, 'Lab Rat Fall 2015',       'Lab Assistant', 4),
     (1,1, 'Teaching Assistant 6166', 'Teaching Asst', 4),
     (1,5, 'Teaching Assistant 9999', 'Teaching Asst', 4),
     (2, 6,'LA - Fall classes',       'Lab Assistant', 4),
     (2,7, 'Head LA',                    'Lab Assistant', 12),
     (2,8, 'LA - Spring classes',     'Lab Assistant', 4),
     (3, 10,'Teaching Asst 6001',      'Teaching Asst', 4),
     (3, 3,'Teaching Asst 6002',      'Teaching Asst', 4),
     (3, 7,'Teaching Asst 6003',      'Teaching Asst', 4);
     

INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('1','8','Evaluating blood testing techniques','Bioanalysis',12);
INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('10','10','Sinkholes in construction material','Construction Engineering',9);
INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('2','13','Data Mining','Database Technology',12);
INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('3','12','XML Applications','Database Technology',18);
INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('4','9','Thermo-acoustics','Acoustics',6);
INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('5','2','Real Time Simulation','Computer Engineering',3);
INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('6','3','How to hack any system','Network Security',12);
INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('7','8','Effect of fat content on quality of ice cream','Health',36);
INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('8','1','The effects of changing daylight on object','Art Science',3);
INSERT INTO research (ResearchID,ProfID,Specialization,Field,Duration) VALUES ('9','1','How to stop spam mail','Computer Science',12);

     
INSERT INTO Facilities()
	values
    (1, 2, 'Computer Lab 1', 'Andrews Hall'),
    (2, 2, 'Computer Lab 2', 'Buffin Hall'), 
    (3, 2, 'Computer Lab 3', 'Cathode Hall'),
    (4, 3, 'Engineer Lab 1', 'Davis Hall'),
    (5, 3, 'Engineer Lab 2', 'Evans Hall'),
    (6, 4, 'Math Lab 1',     'Fall Hall'),
    (7, 4, 'Math Lab 2',     'Gangis Hall'),
    (8, 4, 'Math Lab 3',     'Hall Hall'),
    (9, 5, 'Art Studio 1',   'Ingles Hall'),
    (10,5, 'Art Studio 2',   'Justice Hall');
    
INSERT INTO Offers_Eligible ()
	values
	(1, 1),
	(1, 2),
	(4, 2),
	(4, 1),
	(4, 7),
	(5, 6),
	(6, 7),
	(8, 8),
	(9, 1),
	(9, 2);
    
Insert INTo Application()
	values 
	(1,  '2015-01-01',  'Submitted',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 1),
	(2,  '2015-01-01',  'Not Submitted',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 2),
	(3,  '2015-01-01',  'Not Submitted',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 3),
	(4,  '2015-01-01',  'Not Submitted',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 4),
	(5,  '2015-01-01',  'Not Submitted',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 1),
	(6,  '2015-01-01',  'Admitted',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 2),
	(7,  '2015-01-01',  'Rejected',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 3),
	(8,  '2015-01-01',  'Not Submitted',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 2),
	(9,  '2015-01-01',  'Submitted',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 2),
	(10,  '2015-01-01',  'Admitted',     3.5, 1250, 3.75, 300, 150, 150, 4.5,  80, 20, 20, 20, 20, 6, 4);

Insert INTo WorkExperience()
	values
    (1, 'Alpha Company',   'CHARlotte, NC',  '2010-01-01', '2010-06-30',1),
    (1, 'Beta, Inc.',      'Monroe, NC',     '2010-07-01', '2010-12-31',2),
    (4, 'GammaRay',        'CHARlotte, NC',  '2011-02-01', '2011-08-31',3),
    (5, 'Delta Dynamics',  'New York, NY',   '2011-09-01', '2013-12-31',4),
    (6, 'Epsilon Industries', 'Waxhaw, NC',  '2009-03-15', '2014-10-24',5),
    (8, 'Zeta Warehousing', 'Gastonia, NC',  '2010-01-01', '2012-01-01',6),
    (8, 'Eta Enterprises', 'Indianapolis, IA','2012-03-04','2014-04-05',7),
    (8, 'Theta Lines',     'Denver, NC',     '2014-05-01', '2014-06-01',8),
    (9, 'Iota Industries', 'Blacksburg, VA', '2010-01-01', '2015-01-01',9),
    (10,'Kappa Corp.',     'CHARlotte, NC',  '2011-02-23', '2012-08-15',10);
    
INSERT INTO Recommendations (ApplicationID,fName,lName,AddressLine1,AddressLine2,City,State,Country,Email,
recommendation_id)
	values
    (1,  'Mary',    'Michaels', '1 Madison Ave',   'Apt 1',  'Madison',  'WI', 'USA',    'mary.michaels@mmm.com',1),
    (2,  'Nick',    'Nolte',    '2 Nobb Hill',     '',       'New York', 'NY', 'USA',    'nick.nolte@nnn.com',2),
    (3,  'Oprah',   'Winfree',  '3 Osprey Road',   '',       'Oakridge', 'OR', 'USA',    'Oprah.Winfree@ooo.com',3),
    (4,  'Parth',   'Patel',    '4 Punjab Road',   'Apt P',  'Punjab',   '',   'INDIA',  'Parth.Patel@ppp.com',4),
    (5,  'Queenie', 'Quartz',   '5 Quarrel Way',   '',       'Quebec',   'QC', 'CANADA', 'queenie.quartz@qqq.com',5),
    (6,  'Rakeesh', 'Rao',      '6 Rajkot Road',   '',       'Rajkot',    '',  'INDIA',  'Rakeesh.Rao@rrr.com',6),
    (7,  'Susan',   'Syun',     '7 Shantou St.',   'Apt S',  'Shantou',  '',   'CHINA',  'susan.Syun@sss.com',7),
    (8,  'Ted',     'Thomas',   '8 Turtle Tpk',    '',       'Tallahassee', 'TN', 'USA', 'ted.thomas@ttt.com',8),
    (9,  'Violet',  'Vipp',     '9 Vale St.',      'Apt V',  'Vespers',  'VA', 'USA',    'violet.vipp@vvv.com',9),
    (10, 'Will',    'Waters',   '10 Wing Way',     'Apt W',  'Walla',    'WA', 'USA',    'will.waters@www.com',10);

INSERT INTO Recommendations (ApplicationID,fName,lName,AddressLine1,AddressLine2,City,State,Country,Email,
recommendation_id)
	values
    (10,  'Mary',    'Michaels', '1 Madison Ave',   'Apt 1',  'Madison',  'WI', 'USA',    'mary.michaels@mmm.com',11),
    (9,  'Nick',    'Nolte',    '2 Nobb Hill',     '',       'New York', 'NY', 'USA',    'nick.nolte@nnn.com',12),
    (8,  'Oprah',   'Winfree',  '3 Osprey Road',   '',       'Oakridge', 'OR', 'USA',    'Oprah.Winfree@ooo.com',13),
    (7,  'Parth',   'Patel',    '4 Punjab Road',   'Apt P',  'Punjab',   '',   'INDIA',  'Parth.Patel@ppp.com',14),
    (6,  'Queenie', 'Quartz',   '5 Quarrel Way',   '',       'Quebec',   'QC', 'CANADA', 'queenie.quartz@qqq.com',15),
    (5,  'Rakeesh', 'Rao',      '6 Rajkot Road',   '',       'Rajkot',    '',  'INDIA',  'Rakeesh.Rao@rrr.com',16),
    (4,  'Susan',   'Syun',     '7 Shantou St.',   'Apt S',  'Shantou',  '',   'CHINA',  'susan.Syun@sss.com',17),
    (3,  'Ted',     'Thomas',   '8 Turtle Tpk',    '',       'Tallahassee', 'TN', 'USA', 'ted.thomas@ttt.com',18),
    (2,  'Violet',  'Vipp',     '9 Vale St.',      'Apt V',  'Vespers',  'VA', 'USA',    'violet.vipp@vvv.com',19),
    (1, 'Will',    'Waters',   '10 Wing Way',     'Apt W',  'Walla',    'WA', 'USA',    'will.waters@www.com',20);
    
    
    
INSERT INTO Applies ()
	values
	(1, 1, 1, '2015-02-01'),
	(2, 2, 1, '2015-02-02'),
	(3, 3, 2, '2015-02-03'),
	(4, 4, 3, '2015-02-04'),
	(5, 5, 4, '2015-02-05'),
	(6, 6, 5, '2015-02-06'),
	(6, 7, 1, '2015-02-07'),
    (7, 8, 1, '2015-02-08'),
    (7, 9, 1, '2015-02-09'),
    (7, 10, 3, '2015-02-10');
    
    
insert into Courses()
	values
		(100, 1, 'Electrical Engineering 1',3,'Learn the basics of electrical engineering.'),
		(101, 1, 'Electrical Engineering 2',3,'Intermediate topics in electrical engineering for majors.'),
		(110, 2, 'Programming 1',3,'Introduction to programming with C++'),
		(111, 2, 'Data Structures',4,'Analysis of different data structures used in computing'),
		(120, 3, 'Web Development 1',3,'Introduction to web design concepts with HTML'),
		(121, 3, 'Information Technology Infrastructure',3,'Overview of the concepts that make up the Internet'),
		(130, 4, 'Mechanical Engineering 1', 3, 'Learn the basics of mechanical engineering'),
		(131, 4, 'Mechanical Engineering 2', 3, 'Learn intermediate topics in mechanical engineering for majors'),
		(140, 5, 'Painting 1',3,'Basic painting techniques on canvas'),
		(141, 5, 'Drawing 1',3,'Basic drawing techniques on paper'),
		(150, 6, 'Humanities 1',3,'Even we do not know what this course is'),
		(151, 6, 'Humanities 2',4,'Oh, you are still here? Uh, have an extra credit hour for sticking with it'),
		(160, 7, 'Intro to Law',3,'Basic law concepts'),
		(161, 7, 'US Law History',3,'Major historical cases and developments in United States Law'),
		(170, 8, 'Biology 1',3,'Introduction to biology for future bio-tech students'),
		(171, 8, 'Biology 2',3,'Intermediate biology topics intended for majors'),
		(180, 9, 'Communication Technology',3,'An overview of communication technology'),
		(181, 9, 'Communication Engineering 1',3,'ABasic concepts in electronic communication engineering'),
		(190,10, 'Civil Engineering 1',3,'Introduction to the concepts that make up civil engineering'),
		(191,10, 'Civil Engineering 2',3,'Intermediate concepts intended for civil engineering majors');

CREATE INDEX idx_users ON users(username) USING BTREE;
CREATE INDEX idx_department ON department(DeptName, DeptID) USING BTREE;
CREATE INDEX idx_program ON program(ProgID) USING BTREE;
CREATE INDEX idx_application ON application(ApplicationID) USING BTREE;
CREATE INDEX idx_applies ON applies(ProgID,ApplicationID) USING BTREE;