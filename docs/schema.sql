CREATE DATABASE IF NOT EXISTS mvc_template_skkni;
USE mvc_template_skkni;

CREATE TABLE IF NOT EXISTS entity (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    keterangan TEXT NULL
);

CREATE TABLE IF NOT EXISTS entity_a (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS entity_b (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS relation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entity_a_id INT NOT NULL,
    entity_b_id INT NOT NULL,
    tanggal DATE NOT NULL,
    CONSTRAINT fk_relation_entity_a FOREIGN KEY (entity_a_id) REFERENCES entity_a(id) ON DELETE CASCADE,
    CONSTRAINT fk_relation_entity_b FOREIGN KEY (entity_b_id) REFERENCES entity_b(id) ON DELETE CASCADE
);
