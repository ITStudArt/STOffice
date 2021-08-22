<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210822163921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EBBF396750');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EBD64F11AD');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBBF396750 FOREIGN KEY (id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBD64F11AD FOREIGN KEY (therapist_id_id) REFERENCES therapist (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE therapist DROP CONSTRAINT FK_C3D632FBF396750');
        $this->addSql('ALTER TABLE therapist ADD CONSTRAINT FK_C3D632FBF396750 FOREIGN KEY (id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE therapist DROP CONSTRAINT fk_c3d632fbf396750');
        $this->addSql('ALTER TABLE therapist ADD CONSTRAINT fk_c3d632fbf396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT fk_1adad7ebbf396750');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT fk_1adad7ebd64f11ad');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT fk_1adad7ebbf396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT fk_1adad7ebd64f11ad FOREIGN KEY (therapist_id_id) REFERENCES therapist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
