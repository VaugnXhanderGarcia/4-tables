-- Veterinary module schema additions
CREATE TABLE IF NOT EXISTS pet_owner (
    petOwnerID INT AUTO_INCREMENT PRIMARY KEY,
    petOwnerFName VARCHAR(100) NOT NULL,
    petOwnerLName VARCHAR(100) NOT NULL,
    petOwnerBDate DATE,
    petOwnerTelNo VARCHAR(50),
    is_deleted TINYINT(1) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS veterinarian (
    vetID INT AUTO_INCREMENT PRIMARY KEY,
    vetFName VARCHAR(100) NOT NULL,
    vetLName VARCHAR(100) NOT NULL,
    vetAddress VARCHAR(255),
    vetSpecialization VARCHAR(255),
    is_deleted TINYINT(1) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS pet (
    petID INT AUTO_INCREMENT PRIMARY KEY,
    petOwnerID INT NOT NULL,
    petName VARCHAR(100) NOT NULL,
    petType VARCHAR(50),
    petBreed VARCHAR(100),
    petBDate DATE,
    is_deleted TINYINT(1) DEFAULT 0,
    FOREIGN KEY (petOwnerID) REFERENCES pet_owner(petOwnerID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS consultation (
    consultID INT AUTO_INCREMENT PRIMARY KEY,
    petID INT NOT NULL,
    vetID INT NOT NULL,
    consultDate DATETIME NOT NULL,
    diagnoses TEXT,
    prescription TEXT,
    is_deleted TINYINT(1) DEFAULT 0,
    FOREIGN KEY (petID) REFERENCES pet(petID) ON DELETE CASCADE,
    FOREIGN KEY (vetID) REFERENCES veterinarian(vetID) ON DELETE CASCADE
);

-- End of veterinary schema