<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622071145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_user_category (post_id INT NOT NULL, user_category_id INT NOT NULL, INDEX IDX_F9B043D24B89032C (post_id), INDEX IDX_F9B043D2BB5D5477 (user_category_id), PRIMARY KEY(post_id, user_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_user_category (recipe_id INT NOT NULL, user_category_id INT NOT NULL, INDEX IDX_7634EB0759D8A214 (recipe_id), INDEX IDX_7634EB07BB5D5477 (user_category_id), PRIMARY KEY(recipe_id, user_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_user_category ADD CONSTRAINT FK_F9B043D24B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_user_category ADD CONSTRAINT FK_F9B043D2BB5D5477 FOREIGN KEY (user_category_id) REFERENCES user_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_user_category ADD CONSTRAINT FK_7634EB0759D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_user_category ADD CONSTRAINT FK_7634EB07BB5D5477 FOREIGN KEY (user_category_id) REFERENCES user_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe ADD updated DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE post_user_category');
        $this->addSql('DROP TABLE recipe_user_category');
        $this->addSql('ALTER TABLE recipe DROP updated');
    }
}
