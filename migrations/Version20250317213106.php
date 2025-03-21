<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317213106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__ts_produits AS SELECT id, denomination, code, date_creation, actif, descriptif FROM ts_produits');
        $this->addSql('DROP TABLE ts_produits');
        $this->addSql('CREATE TABLE ts_produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_manuel INTEGER DEFAULT NULL, denomination VARCHAR(255) NOT NULL, code VARCHAR(30) NOT NULL --code barre
        , date_creation DATETIME NOT NULL, actif BOOLEAN DEFAULT 0 NOT NULL, descriptif CLOB NOT NULL, CONSTRAINT FK_4EE620445280CE2D FOREIGN KEY (id_manuel) REFERENCES ts_produits (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ts_produits (id, denomination, code, date_creation, actif, descriptif) SELECT id, denomination, code, date_creation, actif, descriptif FROM __temp__ts_produits');
        $this->addSql('DROP TABLE __temp__ts_produits');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4EE620445280CE2D ON ts_produits (id_manuel)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__ts_produits AS SELECT id, denomination, code, date_creation, actif, descriptif FROM ts_produits');
        $this->addSql('DROP TABLE ts_produits');
        $this->addSql('CREATE TABLE ts_produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, denomination VARCHAR(255) NOT NULL, code VARCHAR(30) NOT NULL --code barre
        , date_creation DATETIME NOT NULL, actif BOOLEAN DEFAULT 0 NOT NULL, descriptif CLOB NOT NULL)');
        $this->addSql('INSERT INTO ts_produits (id, denomination, code, date_creation, actif, descriptif) SELECT id, denomination, code, date_creation, actif, descriptif FROM __temp__ts_produits');
        $this->addSql('DROP TABLE __temp__ts_produits');
    }
}
