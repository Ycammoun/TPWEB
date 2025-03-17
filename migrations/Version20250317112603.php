<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317112603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__rel_habitants AS SELECT id, id_permis, nom FROM rel_habitants');
        $this->addSql('DROP TABLE rel_habitants');
        $this->addSql('CREATE TABLE rel_habitants (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_permis INTEGER DEFAULT NULL, id_ville INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, CONSTRAINT FK_F00A619F310F21BE FOREIGN KEY (id_permis) REFERENCES rel_permis (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F00A619FAD4698F3 FOREIGN KEY (id_ville) REFERENCES rel_villes (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO rel_habitants (id, id_permis, nom) SELECT id, id_permis, nom FROM __temp__rel_habitants');
        $this->addSql('DROP TABLE __temp__rel_habitants');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F00A619F310F21BE ON rel_habitants (id_permis)');
        $this->addSql('CREATE INDEX IDX_F00A619FAD4698F3 ON rel_habitants (id_ville)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__rel_habitants AS SELECT id, id_permis, nom FROM rel_habitants');
        $this->addSql('DROP TABLE rel_habitants');
        $this->addSql('CREATE TABLE rel_habitants (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_permis INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, CONSTRAINT FK_F00A619F310F21BE FOREIGN KEY (id_permis) REFERENCES rel_permis (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO rel_habitants (id, id_permis, nom) SELECT id, id_permis, nom FROM __temp__rel_habitants');
        $this->addSql('DROP TABLE __temp__rel_habitants');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F00A619F310F21BE ON rel_habitants (id_permis)');
    }
}
