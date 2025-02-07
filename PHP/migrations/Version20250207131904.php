<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207131904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id SERIAL NOT NULL, fk_user_id INT NOT NULL, fk_post_id INT DEFAULT NULL, content_text VARCHAR(280) DEFAULT NULL, content_multimedia TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F9E962A5741EEB9 ON comments (fk_user_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962ABBA63E00 ON comments (fk_post_id)');
        $this->addSql('COMMENT ON COLUMN comments.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A5741EEB9 FOREIGN KEY (fk_user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962ABBA63E00 FOREIGN KEY (fk_post_id) REFERENCES posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962A5741EEB9');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962ABBA63E00');
        $this->addSql('DROP TABLE comments');
    }
}
