<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317073604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rel_habitants (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, permis_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, CONSTRAINT FK_F00A619F3594A24E FOREIGN KEY (permis_id) REFERENCES rel_permis (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F00A619F3594A24E ON rel_habitants (permis_id)');
        $this->addSql('CREATE TABLE rel_permis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prefecture VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rel_habitants');
        $this->addSql('DROP TABLE rel_permis');
    }
}
