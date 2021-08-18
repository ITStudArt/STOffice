<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818180019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP name');
        $this->addSql('ALTER TABLE patient DROP surname');
        $this->addSql('ALTER TABLE patient DROP email');
        $this->addSql('ALTER TABLE patient DROP password');
        $this->addSql('ALTER TABLE patient DROP phone');
        $this->addSql('ALTER TABLE patient DROP photo');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBBF396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE therapist DROP name');
        $this->addSql('ALTER TABLE therapist DROP surname');
        $this->addSql('ALTER TABLE therapist DROP email');
        $this->addSql('ALTER TABLE therapist DROP password');
        $this->addSql('ALTER TABLE therapist DROP phone');
        $this->addSql('ALTER TABLE therapist DROP photo');
        $this->addSql('ALTER TABLE therapist ADD CONSTRAINT FK_C3D632FBF396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EBBF396750');
        $this->addSql('ALTER TABLE patient ADD name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD surname VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD phone VARCHAR(9) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE therapist DROP CONSTRAINT FK_C3D632FBF396750');
        $this->addSql('ALTER TABLE therapist ADD name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE therapist ADD surname VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE therapist ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE therapist ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE therapist ADD phone VARCHAR(9) NOT NULL');
        $this->addSql('ALTER TABLE therapist ADD photo VARCHAR(255) DEFAULT NULL');
    }
}
