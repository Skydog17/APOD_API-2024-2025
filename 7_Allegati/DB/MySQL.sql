
CREATE TABLE utente(
  Id INT AUTO_INCREMENT,
  Username VARCHAR(45),
  Password VARCHAR(255),
  PRIMARY KEY (Id)
  );

CREATE TABLE preferito (
  Data DATE,
  Utente_Id INT,
  url VARCHAR(255),
  Titolo VARCHAR(255) ,
  Descrizione VARCHAR(255) ,
  PRIMARY KEY (Data, Utente_Id),
  FOREIGN KEY (Utente_Id)
  REFERENCES Utente(Id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
  );


CREATE TABLE cronologia (
  Id INT AUTO_INCREMENT,
  Utente_Id INT,
  Data DATE ,
  url VARCHAR(255) ,
  Titolo VARCHAR(255) ,
  Descrizione VARCHAR(255) ,
  PRIMARY KEY (Id, Utente_Id),
  FOREIGN KEY (Utente_Id)
  REFERENCES Utente (Id)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
);