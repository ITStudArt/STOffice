<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824210141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_exercises (user_id INT NOT NULL, exercise_id INT NOT NULL, PRIMARY KEY(user_id, exercise_id))');
        $this->addSql('CREATE INDEX IDX_69DC3370A76ED395 ON users_exercises (user_id)');
        $this->addSql('CREATE INDEX IDX_69DC3370E934951A ON users_exercises (exercise_id)');
        $this->addSql('ALTER TABLE users_exercises ADD CONSTRAINT FK_69DC3370A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_exercises ADD CONSTRAINT FK_69DC3370E934951A FOREIGN KEY (exercise_id) REFERENCES exercises (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE user_exercises');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE user_exercises (user_id INT NOT NULL, exercises_id INT NOT NULL, PRIMARY KEY(user_id, exercises_id))');
        $this->addSql('CREATE INDEX idx_f41c475a76ed395 ON user_exercises (user_id)');
        $this->addSql('CREATE INDEX idx_f41c4751afa70ca ON user_exercises (exercises_id)');
        $this->addSql('ALTER TABLE user_exercises ADD CONSTRAINT fk_f41c475a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_exercises ADD CONSTRAINT fk_f41c4751afa70ca FOREIGN KEY (exercises_id) REFERENCES exercises (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE users_exercises');
    }
}
