<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207130930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reposts (id SERIAL NOT NULL, fk_user_id INT NOT NULL, fk_post_id INT NOT NULL, content_text VARCHAR(1000) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F0DDCD725741EEB9 ON reposts (fk_user_id)');
        $this->addSql('CREATE INDEX IDX_F0DDCD72BBA63E00 ON reposts (fk_post_id)');
        $this->addSql('COMMENT ON COLUMN reposts.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reposts ADD CONSTRAINT FK_F0DDCD725741EEB9 FOREIGN KEY (fk_user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reposts ADD CONSTRAINT FK_F0DDCD72BBA63E00 FOREIGN KEY (fk_post_id) REFERENCES posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE reposts DROP CONSTRAINT FK_F0DDCD725741EEB9');
        $this->addSql('ALTER TABLE reposts DROP CONSTRAINT FK_F0DDCD72BBA63E00');
        $this->addSql('DROP TABLE reposts');
    }
}
