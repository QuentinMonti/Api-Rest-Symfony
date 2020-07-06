<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200706102349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, created_at, first_name, job_title, last_name, city, note, email, competences, course FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, first_name VARCHAR(255) NOT NULL COLLATE BINARY, job_title CLOB NOT NULL COLLATE BINARY, last_name VARCHAR(255) NOT NULL COLLATE BINARY, city CLOB NOT NULL COLLATE BINARY, note INTEGER DEFAULT NULL, email VARCHAR(255) DEFAULT NULL COLLATE BINARY, course CLOB DEFAULT NULL COLLATE BINARY, competences CLOB DEFAULT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO post (id, created_at, first_name, job_title, last_name, city, note, email, competences, course) SELECT id, created_at, first_name, job_title, last_name, city, note, email, competences, course FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, note, first_name, last_name, job_title, city, competences, course, email, created_at FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, note INTEGER DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, job_title CLOB NOT NULL, city CLOB NOT NULL, course CLOB DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, competences CLOB DEFAULT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO post (id, note, first_name, last_name, job_title, city, competences, course, email, created_at) SELECT id, note, first_name, last_name, job_title, city, competences, course, email, created_at FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
    }
}
