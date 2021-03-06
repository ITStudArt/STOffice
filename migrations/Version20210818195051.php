<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818195051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercises ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercises ADD CONSTRAINT FK_FA14991C54C8C93 FOREIGN KEY (type_id) REFERENCES exercises_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FA14991C54C8C93 ON exercises (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE exercises DROP CONSTRAINT FK_FA14991C54C8C93');
        $this->addSql('DROP INDEX IDX_FA14991C54C8C93');
        $this->addSql('ALTER TABLE exercises DROP type_id');
    }
}
