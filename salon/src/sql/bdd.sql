DROP DATABASE IF EXISTS salon;

CREATE DATABASE salon;

CREATE TABLE contacts(
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    telephone BIGINT,
    for_act INT NOT NULL,
    for_fut VARCHAR(20) NOT NULL,
    PRIMARY KEY(id)
);

/** Créé des identifiants ISEN et mdp ISEN pour faire fonctionner le système */
