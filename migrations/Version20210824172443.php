<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824172443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercises DROP CONSTRAINT fk_fa14991c54c8c93');
        $this->addSql('DROP INDEX idx_fa14991c54c8c93');
        $this->addSql('ALTER TABLE exercises DROP type_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE exercises ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE exercises ADD CONSTRAINT fk_fa14991c54c8c93 FOREIGN KEY (type_id) REFERENCES exercises_type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_fa14991c54c8c93 ON exercises (type_id)');
    }
}
