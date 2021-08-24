<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819161626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE therapist ADD therapist_patients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE therapist ADD CONSTRAINT FK_C3D632F48D401FD FOREIGN KEY (therapist_patients_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C3D632F48D401FD ON therapist (therapist_patients_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE therapist DROP CONSTRAINT FK_C3D632F48D401FD');
        $this->addSql('DROP INDEX IDX_C3D632F48D401FD');
        $this->addSql('ALTER TABLE therapist DROP therapist_patients_id');
    }
}
