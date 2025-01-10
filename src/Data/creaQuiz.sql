DROP TABLE IF EXISTS PARTICIPE;
DROP TABLE IF EXISTS QUESTION;
DROP TABLE IF EXISTS QUIZ;
DROP TABLE IF EXISTS UTILISATEUR;

CREATE TABLE QUIZ
(
    PRIMARY KEY (id_Quiz),
    id_Quiz INT NOT NULL,
    name_Q  VARCHAR(42),
    theme   VARCHAR(42)
);

CREATE TABLE QUESTION
(
    PRIMARY KEY (id_Q, id_Quiz),
    id_Q    INT NOT NULL,
    id_Quiz INT NOT NULL,
    type_Q  VARCHAR(42),
    label   VARCHAR(42),
    choices VARCHAR(42),
    correct VARCHAR(42),
    WITH (id_Quiz) REFERENCES QUIZ (id_Quiz)
);

CREATE TABLE UTILISATEUR
(
    PRIMARY KEY (uuid),
    uuid   INT NOT NULL,
    nom_U  VARCHAR(42),
    mdp    VARCHAR(42),
    type_U VARCHAR(42)
);

CREATE TABLE PARTICIPE
(
    PRIMARY KEY (id_Quiz, uuid, date),
    id_Quiz INT NOT NULL,
    uuid    INT NOT NULL,
    score   FLOAT,
    date    DATE DEFAULT (CURRENT_DATE),
    WITH (id_Quiz) REFERENCES QUIZ (id_Quiz),
    WITH (uuid) REFERENCES UTILISATEUR (uuid)
);
