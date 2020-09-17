<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200917123617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment_runes (equipment_id INTEGER NOT NULL, runes_id INTEGER NOT NULL, PRIMARY KEY(equipment_id, runes_id), CONSTRAINT FK_63476CB6517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_63476CB6B6A1334F FOREIGN KEY (runes_id) REFERENCES runes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_63476CB6517FE9FE ON equipment_runes (equipment_id)');
        $this->addSql('CREATE INDEX IDX_63476CB6B6A1334F ON equipment_runes (runes_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__runes AS SELECT id, name FROM runes');
        $this->addSql('DROP TABLE runes');
        $this->addSql('CREATE TABLE runes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO runes (id, name) SELECT id, name FROM __temp__runes');
        $this->addSql('DROP TABLE __temp__runes');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE equipment_runes');
        $this->addSql('ALTER TABLE runes ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE runes ADD COLUMN updated_at DATETIME DEFAULT NULL');
    }
}
