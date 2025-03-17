<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317161754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rel_asso_habitant_nationalite (id_habitant INTEGER NOT NULL, id_nationalite INTEGER NOT NULL, PRIMARY KEY(id_habitant, id_nationalite), CONSTRAINT FK_2D5719DBCB76111E FOREIGN KEY (id_habitant) REFERENCES rel_habitants (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2D5719DB86D61AC8 FOREIGN KEY (id_nationalite) REFERENCES rel_nationalites (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2D5719DBCB76111E ON rel_asso_habitant_nationalite (id_habitant)');
        $this->addSql('CREATE INDEX IDX_2D5719DB86D61AC8 ON rel_asso_habitant_nationalite (id_nationalite)');
        $this->addSql('CREATE TABLE rel_nationalites (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rel_asso_habitant_nationalite');
        $this->addSql('DROP TABLE rel_nationalites');
    }
}
