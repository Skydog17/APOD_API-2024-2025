CREATE SCHEMA APOD;
use APOD;

CREATE TABLE Utente(
    Id INT AUTO_INCREMENT,
    Username  VARCHAR(45) NOT NULL,
    Password  CHAR(255) NOT NULL,
    PRIMARY KEY( Id )
);

CREATE TABLE Preferito(
    Id  INT AUTO_INCREMENT,
    Utente_Id  INT NOT NULL,
    Giorno  INT NOT NULL,
    Mese  INT NOT NULL,
    Anno  INT NOT NULL,
    PRIMARY KEY(Id,Utente_Id ),
    FOREIGN KEY (Utente_Id)
    REFERENCES  Utente(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE Cronologia(
    Id  INT AUTO_INCREMENT,
    Utente_Id  INT NOT NULL,
    Giorno  INT NOT NULL,
    Mese  INT NOT NULL,
    Anno  INT NOT NULL,
    PRIMARY KEY( Id ,  Utente_Id ),
    FOREIGN KEY ( Utente_Id )
    REFERENCES  Utente ( Id )
    ON DELETE CASCADE
    ON UPDATE CASCADE
);