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

INSERT INTO QUIZ (id_Quiz, name_Q, theme) VALUES
(1, 'General Knowledge', 'General'),
(2, 'Science', 'Education'),
(3, 'History', 'Education');

INSERT INTO QUESTION (id_Q, id_Quiz, type_Q, label, choices, correct) VALUES
(1, 1, 'Multiple Choice', 'What is the capital of France?', 'Paris,London,Berlin,Madrid', 'Paris'),
(2, 1, 'Multiple Choice', 'What is 2 + 2?', '3,4,5,6', '4'),
(3, 2, 'Multiple Choice', 'What is the chemical symbol for water?', 'H2O,CO2,O2,N2', 'H2O');

INSERT INTO UTILISATEUR (uuid, nom_U, mdp, type_U) VALUES
(1, 'adm', '$2y$10$7YSBWl8PeZkFBEmgaMhiQe.mdtAQcm2cJvmYpvoaZ0Dne4frTf2Ge', 'ADM'),
(2, 'b', 'bz', 'USER'),
(3, 'c', 'cz', 'USER');

INSERT INTO PARTICIPE (id_Quiz, uuid, score) VALUES
(1, 1, 85.5),
(2, 2, 90.0),
(3, 3, 78.0);