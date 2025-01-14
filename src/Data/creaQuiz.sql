DROP TABLE IF EXISTS PARTICIPE;
DROP TABLE IF EXISTS QUESTION;
DROP TABLE IF EXISTS QUIZ;
DROP TABLE IF EXISTS UTILISATEUR;

CREATE TABLE QUIZ
(
    id_Quiz INT NOT NULL,
    name_Q  VARCHAR(42),
    theme   VARCHAR(42),
    PRIMARY KEY (id_Quiz)
);

CREATE TABLE QUESTION
(
    id_Q    INT NOT NULL,
    id_Quiz INT NOT NULL,
    type_Q  VARCHAR(42),
    label   VARCHAR(42),
    choices VARCHAR(42),
    correct VARCHAR(42),
    PRIMARY KEY (id_Q, id_Quiz),
    FOREIGN KEY (id_Quiz) REFERENCES QUIZ (id_Quiz)
);

CREATE TABLE UTILISATEUR
(
    uuid   INT NOT NULL,
    nom_U  VARCHAR(42) UNIQUE,
    mdp    VARCHAR(42),
    type_U VARCHAR(42),
    PRIMARY KEY (uuid)
);

CREATE TABLE PARTICIPE
(
    id_Quiz INT NOT NULL,
    uuid    INT NOT NULL,
    score   FLOAT,
    date    DATE DEFAULT (CURRENT_DATE),
    PRIMARY KEY (id_Quiz, uuid, date),
    FOREIGN KEY (id_Quiz) REFERENCES QUIZ (id_Quiz),
    FOREIGN KEY (uuid) REFERENCES UTILISATEUR (uuid)
);


insert into QUIZ values (1, 'Quiz1', 'Math');
insert into QUIZ values (2, 'Quiz2', 'Math');
insert into QUIZ values (3, 'Quiz3', 'Math');

insert into QUESTION values (1, 1, 'text', 'Question1', 'A;B;C;D', 'A');
insert into QUESTION values (2, 1, 'text', 'Question2', 'A;B;C;D', 'B');
insert into QUESTION values (3, 1, 'text', 'Question3', 'A;B;C;D', 'C');
insert into QUESTION values (1, 2, 'text', 'Question1', 'A;B;C;D', 'A');
insert into QUESTION values (2, 2, 'text', 'Question2', 'A;B;C;D', 'B');
insert into QUESTION values (3, 2, 'text', 'Question3', 'A;B;C;D', 'C');