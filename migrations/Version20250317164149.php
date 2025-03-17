<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317164149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rel_asso_habitants_etablissements (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_habitant INTEGER NOT NULL, id_etablissement INTEGER NOT NULL, annee INTEGER NOT NULL, CONSTRAINT FK_8FBAFD41CB76111E FOREIGN KEY (id_habitant) REFERENCES rel_habitants (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8FBAFD419ED58849 FOREIGN KEY (id_etablissement) REFERENCES rel_etablissements (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8FBAFD41CB76111E ON rel_asso_habitants_etablissements (id_habitant)');
        $this->addSql('CREATE INDEX IDX_8FBAFD419ED58849 ON rel_asso_habitants_etablissements (id_etablissement)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8FBAFD41CB76111E9ED58849DE92C5CF ON rel_asso_habitants_etablissements (id_habitant, id_etablissement, annee)');
        $this->addSql('CREATE TABLE rel_etablissements (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rel_asso_habitants_etablissements');
        $this->addSql('DROP TABLE rel_etablissements');
    }
}
