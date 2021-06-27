<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210627105608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application_choice (id INT AUTO_INCREMENT NOT NULL, choice VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, booking_type_id INT NOT NULL, application_choice_id INT NOT NULL, background_color VARCHAR(255) NOT NULL, border_color VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, INDEX IDX_E00CEDDEF675F31B (author_id), INDEX IDX_E00CEDDE9FF2C9B3 (booking_type_id), INDEX IDX_E00CEDDE1D871CD0 (application_choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_type (id INT AUTO_INCREMENT NOT NULL, booking_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9FF2C9B3 FOREIGN KEY (booking_type_id) REFERENCES booking_type (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE1D871CD0 FOREIGN KEY (application_choice_id) REFERENCES application_choice (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE1D871CD0');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9FF2C9B3');
        $this->addSql('DROP TABLE application_choice');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_type');
    }
}
