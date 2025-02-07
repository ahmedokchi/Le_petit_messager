<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207132512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE posts_reports (id SERIAL NOT NULL, fk_post_id INT NOT NULL, fk_user_id INT NOT NULL, content VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E7FBE2EBBA63E00 ON posts_reports (fk_post_id)');
        $this->addSql('CREATE INDEX IDX_5E7FBE2E5741EEB9 ON posts_reports (fk_user_id)');
        $this->addSql('COMMENT ON COLUMN posts_reports.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE posts_reports ADD CONSTRAINT FK_5E7FBE2EBBA63E00 FOREIGN KEY (fk_post_id) REFERENCES posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posts_reports ADD CONSTRAINT FK_5E7FBE2E5741EEB9 FOREIGN KEY (fk_user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE posts_reports DROP CONSTRAINT FK_5E7FBE2EBBA63E00');
        $this->addSql('ALTER TABLE posts_reports DROP CONSTRAINT FK_5E7FBE2E5741EEB9');
        $this->addSql('DROP TABLE posts_reports');
    }
}
