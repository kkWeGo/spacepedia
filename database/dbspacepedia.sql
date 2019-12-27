CREATE TABLE tgalassie (

	ID_galassia BIGINT NOT NULL AUTO_INCREMENT,

	Nome VARCHAR(30),
	
	Classificazio ENUM('Galassia irregolare', 'Galassie ellittiche', 'Galassia lenticolare', 'Galassie spirali', 'Galassia a spirale barrata', 'Galassia a spirale intermedia'),

	Classe VARCHAR(10),
        
	Massa BIGINT, 
        
	Dimensioni	INT,

	MagnitudineAssoluta INT,
        
	Etàstimata INT,

	PRIMARY KEY(ID_galassia)

) ENGINE = InnoDB;

CREATE TABLE tcostellazioni (

	ID_costellazione BIGINT NOT NULL AUTO_INCREMENT,

	Nome VARCHAR(30),
	
	Testo varchar(260),

    Foto varchar(260),

	NomeLatino varchar(50),

	Genitivo varchar(50),

    Abbreviazione varchar(50),

    AscensioneRetta INT,

    Declinazione INT,

    AreaTotale INT,

	PRIMARY KEY(ID_costellazione)

) ENGINE = InnoDB;

CREATE TABLE tsistemiplanetari (

	ID_sistemaplanetario BIGINT NOT NULL AUTO_INCREMENT,

	Nome VARCHAR(30),

	FK_Galassia BIGINT NOT NULL,
	
	Testo varchar(260),

    Foto varchar(260),

	FOREIGN KEY(FK_Galassia) REFERENCES tgalassie(ID_galassia)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	PRIMARY KEY(ID_sistemaplanetario)

) ENGINE = InnoDB;

CREATE TABLE tstelle (

	ID_stella BIGINT NOT NULL AUTO_INCREMENT,

	Nome VARCHAR(30),

    Testo varchar(260),

    Foto varchar(260),

    FK_SistemaPlanetario BIGINT,

    FK_Costellazione BIGINT,

	IsPrincipaleSP BIT,

	IsPrincipaleC BIT,
    
    Classificazione	ENUM('Supergigante', 'Gigante rossa', 'Nane rosse', 'Nane Bianche', 'Nane brune', 'Stella di neutroni'),
    
    ClasseSpettrale VARCHAR(10),

    SemiasseMaggiore INT,

    PeriodoOrbitale DATETIME,
    
    VelocitàOrbitaleMedia INT,

    DiametroMedio INT,

    Superficie BIGINT,

    Volume BIGINT,

    Massa BIGINT,

    DensitàMedia INT,

    AccelerazioneInSuperficie INT,

    VelocitàDiFuga INT,

    VelocitàDiRotazione INT,

    Declinazione INT,

    TemperaturaSuperficiale INT,

    Luminosità  BIGINT,

    Radianza INT,

    EtàStimata INT,

    FOREIGN KEY(FK_SistemaPlanetario) REFERENCES tsistemiplanetari(ID_SistemaPlanetario)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

    FOREIGN KEY(FK_Costellazione) REFERENCES tcostellazioni(ID_Costellazione)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

    PRIMARY KEY(ID_stella)
        
) ENGINE = InnoDB;

CREATE TABLE tpianeti (

    ID_pianeta BIGINT NOT NULL AUTO_INCREMENT,

	Nome VARCHAR(30),
	
	FK_StellaMadre BIGINT NOT NULL,
	
	Classificazione	ENUM('Pianeti immaginari', 'Pianeti ipotetici', 'Pianeti interstellari', 'Pianeti extrasolari', 'Pianetini', 'Pianeti nani', 'Pianeti giganti', 'Pianeti terrestri'),
 
 	Testo varchar(260),

    Foto varchar(260),

	SemiasseMaggiore INT,
    
	Perielio INT,
    
	Afelio INT,
    
	CirconferenzaOrbitale INT,

    PeriodoOrbitale INT,

    Anelli INT,

    Eccentricità INT,

    DiametroMedio INT,

    Superficie BIGINT,

	Volume BIGINT,

	Massa BIGINT,

	DensitàMedia INT,

    PeriodoDiRotazione INT,

    TemperaturaSuperficiale INT,

    PressioneAtmosferica INT,

    Albedo INT,

	FOREIGN KEY(FK_StellaMadre) REFERENCES tstelle(ID_stella)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	PRIMARY KEY(ID_pianeta)

) ENGINE = InnoDB;

CREATE TABLE tsatelliti (

	ID_satellite BIGINT NOT NULL AUTO_INCREMENT,

	Nome VARCHAR(30),
  	
	FK_Pianeta BIGINT NOT NULL,
	 
 	Testo varchar(260),

    Foto varchar(260),

	SemiasseMaggiore INT,
        
	Perigeo INT,
    
	Apogeo INT,
    
	CirconferenzaOrbitale INT,

    PeriodoOrbitale INT,
    
    Eccentricità INT,

	DiametroMedio INT,

    Superficie BIGINT,

	Volume BIGINT,

	Massa BIGINT,

	DensitàMedia INT,

    TemperaturaSuperficiale INT,

    PressioneAtmosferica INT,

    Albedo INT,

	FOREIGN KEY(FK_Pianeta) REFERENCES tpianeti(ID_pianeta)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	PRIMARY KEY(ID_satellite)

) ENGINE = InnoDB;

CREATE TABLE tutenti (

	ID_utente BIGINT NOT NULL AUTO_INCREMENT,

	Email VARCHAR(50) UNIQUE,
	
	Password CHAR(64),
	
	Tipo ENUM('U', 'A')	DEFAULT 'U',

	PRIMARY KEY(ID_utente)

) ENGINE = InnoDB;