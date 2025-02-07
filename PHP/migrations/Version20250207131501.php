<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207131501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE follows (id SERIAL NOT NULL, fk_follower_id INT NOT NULL, fk_following_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B638A73C5D25467 ON follows (fk_follower_id)');
        $this->addSql('CREATE INDEX IDX_4B638A7339CBE1BA ON follows (fk_following_id)');
        $this->addSql('COMMENT ON COLUMN follows.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE follows ADD CONSTRAINT FK_4B638A73C5D25467 FOREIGN KEY (fk_follower_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE follows ADD CONSTRAINT FK_4B638A7339CBE1BA FOREIGN KEY (fk_following_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE follows DROP CONSTRAINT FK_4B638A73C5D25467');
        $this->addSql('ALTER TABLE follows DROP CONSTRAINT FK_4B638A7339CBE1BA');
        $this->addSql('DROP TABLE follows');
    }
}
