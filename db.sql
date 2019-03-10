CREATE DATABASE IF NOT EXISTS collection
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE collection;

CREATE TABLE IF NOT EXISTS article (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
	title VARCHAR(255) NOT NULL COMMENT 'Title',
	body TEXT NOT NULL COMMENT 'Body',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Created At',
	CONSTRAINT PRIMARY KEY (id)
);

INSERT INTO article (title, body) VALUES
  ('Article 1', 'Article Body 1'),
  ('Article 2', 'Article Body 2'),
  ('Article 3', 'Article Body 3'),
  ('Article 4', 'Article Body 4');
