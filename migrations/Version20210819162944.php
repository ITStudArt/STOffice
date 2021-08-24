<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819162944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient ADD therapist_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBD64F11AD FOREIGN KEY (therapist_id_id) REFERENCES therapist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1ADAD7EBD64F11AD ON patient (therapist_id_id)');
        $this->addSql('ALTER TABLE therapist DROP CONSTRAINT fk_c3d632f48d401fd');
        $this->addSql('DROP INDEX idx_c3d632f48d401fd');
        $this->addSql('ALTER TABLE therapist DROP therapist_patients_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EBD64F11AD');
        $this->addSql('DROP INDEX IDX_1ADAD7EBD64F11AD');
        $this->addSql('ALTER TABLE patient DROP therapist_id_id');
        $this->addSql('ALTER TABLE therapist ADD therapist_patients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE therapist ADD CONSTRAINT fk_c3d632f48d401fd FOREIGN KEY (therapist_patients_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c3d632f48d401fd ON therapist (therapist_patients_id)');
    }
}
