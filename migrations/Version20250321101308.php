<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321101308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ts_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, name VARCHAR(200) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_LOGIN ON ts_user (login)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ts_produits AS SELECT id, id_manuel, denomination, code, date_creation, actif, descriptif FROM ts_produits');
        $this->addSql('DROP TABLE ts_produits');
        $this->addSql('CREATE TABLE ts_produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_manuel INTEGER DEFAULT NULL, denomination VARCHAR(255) NOT NULL, code VARCHAR(30) NOT NULL --code barre
        , date_creation DATETIME NOT NULL, actif BOOLEAN DEFAULT 0 NOT NULL, descriptif CLOB NOT NULL, CONSTRAINT FK_4EE620445280CE2D FOREIGN KEY (id_manuel) REFERENCES ts_manuels (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ts_produits (id, id_manuel, denomination, code, date_creation, actif, descriptif) SELECT id, id_manuel, denomination, code, date_creation, actif, descriptif FROM __temp__ts_produits');
        $this->addSql('DROP TABLE __temp__ts_produits');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4EE620445280CE2D ON ts_produits (id_manuel)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ts_user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ts_produits AS SELECT id, id_manuel, denomination, code, date_creation, actif, descriptif FROM ts_produits');
        $this->addSql('DROP TABLE ts_produits');
        $this->addSql('CREATE TABLE ts_produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_manuel INTEGER DEFAULT NULL, denomination VARCHAR(255) NOT NULL, code VARCHAR(30) NOT NULL --code barre
        , date_creation DATETIME NOT NULL, actif BOOLEAN DEFAULT 0 NOT NULL, descriptif CLOB NOT NULL, CONSTRAINT FK_4EE620445280CE2D FOREIGN KEY (id_manuel) REFERENCES ts_produits (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ts_produits (id, id_manuel, denomination, code, date_creation, actif, descriptif) SELECT id, id_manuel, denomination, code, date_creation, actif, descriptif FROM __temp__ts_produits');
        $this->addSql('DROP TABLE __temp__ts_produits');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4EE620445280CE2D ON ts_produits (id_manuel)');
    }
}
