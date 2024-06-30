CREATE DATABASE IF NOT EXISTS padel_ranking;
USE padel_ranking;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    points FLOAT DEFAULT 0
);

CREATE TABLE matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player1_id INT,
    player2_id INT,
    player3_id INT,
    player4_id INT,
    winner_team INT,
    match_date DATETIME,
    FOREIGN KEY (player1_id) REFERENCES users(id),
    FOREIGN KEY (player2_id) REFERENCES users(id),
    FOREIGN KEY (player3_id) REFERENCES users(id),
    FOREIGN KEY (player4_id) REFERENCES users(id)
);

ALTER TABLE matches
DROP FOREIGN KEY matches_ibfk_1,
DROP FOREIGN KEY matches_ibfk_2,
DROP FOREIGN KEY matches_ibfk_3,
DROP FOREIGN KEY matches_ibfk_4;

ALTER TABLE matches
ADD CONSTRAINT matches_ibfk_1 FOREIGN KEY (player1_id) REFERENCES users(id) ON DELETE CASCADE,
ADD CONSTRAINT matches_ibfk_2 FOREIGN KEY (player2_id) REFERENCES users(id) ON DELETE CASCADE,
ADD CONSTRAINT matches_ibfk_3 FOREIGN KEY (player3_id) REFERENCES users(id) ON DELETE CASCADE,
ADD CONSTRAINT matches_ibfk_4 FOREIGN KEY (player4_id) REFERENCES users(id) ON DELETE CASCADE;

ALTER TABLE users 
ADD COLUMN matches INT DEFAULT 0;

