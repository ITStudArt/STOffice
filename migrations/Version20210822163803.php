<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210822163803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercises DROP CONSTRAINT FK_FA14991C54C8C93');
        $this->addSql('ALTER TABLE exercises ADD CONSTRAINT FK_FA14991C54C8C93 FOREIGN KEY (type_id) REFERENCES exercises_type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_exercises DROP CONSTRAINT FK_69DC3370A76ED395');
        $this->addSql('ALTER TABLE users_exercises DROP CONSTRAINT FK_69DC3370E934951A');
        $this->addSql('ALTER TABLE users_exercises ADD CONSTRAINT FK_69DC3370A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_exercises ADD CONSTRAINT FK_69DC3370E934951A FOREIGN KEY (exercise_id) REFERENCES exercises (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE exercises DROP CONSTRAINT fk_fa14991c54c8c93');
        $this->addSql('ALTER TABLE exercises ADD CONSTRAINT fk_fa14991c54c8c93 FOREIGN KEY (type_id) REFERENCES exercises_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_exercises DROP CONSTRAINT fk_69dc3370a76ed395');
        $this->addSql('ALTER TABLE users_exercises DROP CONSTRAINT fk_69dc3370e934951a');
        $this->addSql('ALTER TABLE users_exercises ADD CONSTRAINT fk_69dc3370a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_exercises ADD CONSTRAINT fk_69dc3370e934951a FOREIGN KEY (exercise_id) REFERENCES exercises (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
