<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207134041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messages (id SERIAL NOT NULL, fk_user1_id INT NOT NULL, fk_user2_id INT NOT NULL, content_text VARCHAR(500) DEFAULT NULL, content_multimedia TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DB021E9664866755 ON messages (fk_user1_id)');
        $this->addSql('CREATE INDEX IDX_DB021E967633C8BB ON messages (fk_user2_id)');
        $this->addSql('COMMENT ON COLUMN messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E9664866755 FOREIGN KEY (fk_user1_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E967633C8BB FOREIGN KEY (fk_user2_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE messages DROP CONSTRAINT FK_DB021E9664866755');
        $this->addSql('ALTER TABLE messages DROP CONSTRAINT FK_DB021E967633C8BB');
        $this->addSql('DROP TABLE messages');
    }
}
