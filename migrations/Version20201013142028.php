<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013142028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, book_id INT NOT NULL, author_id INT NOT NULL, text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6970EB0F16A2B381 (book_id), INDEX IDX_6970EB0FF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0F16A2B381 FOREIGN KEY (book_id) REFERENCES books (id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reviews');
    }
}
