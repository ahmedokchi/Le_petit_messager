<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207134415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoris (id SERIAL NOT NULL, fk_user_id INT NOT NULL, fk_post_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8933C4325741EEB9 ON favoris (fk_user_id)');
        $this->addSql('CREATE INDEX IDX_8933C432BBA63E00 ON favoris (fk_post_id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4325741EEB9 FOREIGN KEY (fk_user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432BBA63E00 FOREIGN KEY (fk_post_id) REFERENCES posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE favoris DROP CONSTRAINT FK_8933C4325741EEB9');
        $this->addSql('ALTER TABLE favoris DROP CONSTRAINT FK_8933C432BBA63E00');
        $this->addSql('DROP TABLE favoris');
    }
}
