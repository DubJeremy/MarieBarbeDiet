<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622071953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD user_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBB5D5477 FOREIGN KEY (user_category_id) REFERENCES user_category (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DBB5D5477 ON post (user_category_id)');
        $this->addSql('ALTER TABLE recipe ADD user_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137BB5D5477 FOREIGN KEY (user_category_id) REFERENCES user_category (id)');
        $this->addSql('CREATE INDEX IDX_DA88B137BB5D5477 ON recipe (user_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DBB5D5477');
        $this->addSql('DROP INDEX IDX_5A8A6C8DBB5D5477 ON post');
        $this->addSql('ALTER TABLE post DROP user_category_id');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137BB5D5477');
        $this->addSql('DROP INDEX IDX_DA88B137BB5D5477 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP user_category_id');
    }
}
