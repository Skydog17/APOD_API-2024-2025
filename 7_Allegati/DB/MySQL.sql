CREATE SCHEMA APOD;
use APOD;

CREATE TABLE Utente(
    Id INT AUTO_INCREMENT,
    Username  VARCHAR(45) NOT NULL,
    Password  CHAR(255) NOT NULL,
    PRIMARY KEY( Id )
);

CREATE TABLE Preferito(
    Data Date NOT NULL,
    Utente_Id  INT NOT NULL,
    PRIMARY KEY(Data,Utente_Id ),
    FOREIGN KEY (Utente_Id)
    REFERENCES  Utente(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE Cronologia(
    Data Date NOT NULL,
    Utente_Id  INT NOT NULL,
    PRIMARY KEY(Data,Utente_Id ),
    FOREIGN KEY (Utente_Id)
    REFERENCES  Utente(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);