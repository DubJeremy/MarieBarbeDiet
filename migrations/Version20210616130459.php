<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210616130459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE difficulty (id INT AUTO_INCREMENT NOT NULL, difficulty VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, creted_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_user_category (post_id INT NOT NULL, user_category_id INT NOT NULL, INDEX IDX_F9B043D24B89032C (post_id), INDEX IDX_F9B043D2BB5D5477 (user_category_id), PRIMARY KEY(post_id, user_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, difficulty_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, recipe LONGTEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, preparation_time DATETIME DEFAULT NULL, ingredient LONGTEXT DEFAULT NULL, INDEX IDX_DA88B137FCFA9DAE (difficulty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_user_category (recipe_id INT NOT NULL, user_category_id INT NOT NULL, INDEX IDX_7634EB0759D8A214 (recipe_id), INDEX IDX_7634EB07BB5D5477 (user_category_id), PRIMARY KEY(recipe_id, user_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_794381C6F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_category (id INT AUTO_INCREMENT NOT NULL, user_category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_user_category ADD CONSTRAINT FK_F9B043D24B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_user_category ADD CONSTRAINT FK_F9B043D2BB5D5477 FOREIGN KEY (user_category_id) REFERENCES user_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE recipe_user_category ADD CONSTRAINT FK_7634EB0759D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_user_category ADD CONSTRAINT FK_7634EB07BB5D5477 FOREIGN KEY (user_category_id) REFERENCES user_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137FCFA9DAE');
        $this->addSql('ALTER TABLE post_user_category DROP FOREIGN KEY FK_F9B043D24B89032C');
        $this->addSql('ALTER TABLE recipe_user_category DROP FOREIGN KEY FK_7634EB0759D8A214');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6F675F31B');
        $this->addSql('ALTER TABLE post_user_category DROP FOREIGN KEY FK_F9B043D2BB5D5477');
        $this->addSql('ALTER TABLE recipe_user_category DROP FOREIGN KEY FK_7634EB07BB5D5477');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_user_category');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_user_category');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_category');
    }
}
