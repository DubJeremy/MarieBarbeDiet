<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210720085625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application_choice (id INT AUTO_INCREMENT NOT NULL, choice VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, booking_type_id INT NOT NULL, application_choice_id INT NOT NULL, background_color VARCHAR(255) NOT NULL, border_color VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, INDEX IDX_E00CEDDEF675F31B (author_id), INDEX IDX_E00CEDDE9FF2C9B3 (booking_type_id), INDEX IDX_E00CEDDE1D871CD0 (application_choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_type (id INT AUTO_INCREMENT NOT NULL, booking_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE difficulty (id INT AUTO_INCREMENT NOT NULL, difficulty VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_post (id INT AUTO_INCREMENT NOT NULL, difficulty_id INT DEFAULT NULL, user_category_id INT NOT NULL, title_r VARCHAR(255) DEFAULT NULL, recipe LONGTEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, updated DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, preparation_time DATETIME DEFAULT NULL, ingredient LONGTEXT DEFAULT NULL, INDEX IDX_25913652FCFA9DAE (difficulty_id), INDEX IDX_25913652BB5D5477 (user_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_794381C6F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE time_slot (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description VARCHAR(255) DEFAULT NULL, background_color VARCHAR(255) DEFAULT NULL, border_color VARCHAR(255) DEFAULT NULL, text_color VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_category_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, joined_on DATETIME NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, age DATETIME NOT NULL, height VARCHAR(255) NOT NULL, weight VARCHAR(255) NOT NULL, number_phone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649BB5D5477 (user_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_category (id INT AUTO_INCREMENT NOT NULL, user_category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9FF2C9B3 FOREIGN KEY (booking_type_id) REFERENCES booking_type (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE1D871CD0 FOREIGN KEY (application_choice_id) REFERENCES application_choice (id)');
        $this->addSql('ALTER TABLE recipe_post ADD CONSTRAINT FK_25913652FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE recipe_post ADD CONSTRAINT FK_25913652BB5D5477 FOREIGN KEY (user_category_id) REFERENCES user_category (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BB5D5477 FOREIGN KEY (user_category_id) REFERENCES user_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE1D871CD0');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9FF2C9B3');
        $this->addSql('ALTER TABLE recipe_post DROP FOREIGN KEY FK_25913652FCFA9DAE');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEF675F31B');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6F675F31B');
        $this->addSql('ALTER TABLE recipe_post DROP FOREIGN KEY FK_25913652BB5D5477');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BB5D5477');
        $this->addSql('DROP TABLE application_choice');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_type');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP TABLE recipe_post');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE time_slot');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_category');
    }
}
