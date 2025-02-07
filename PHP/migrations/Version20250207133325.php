<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207133325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accounts_reports (id SERIAL NOT NULL, fk_reporter_id INT NOT NULL, fk_reported_id INT NOT NULL, content VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_995CD53988394AC1 ON accounts_reports (fk_reporter_id)');
        $this->addSql('CREATE INDEX IDX_995CD539FD4B4282 ON accounts_reports (fk_reported_id)');
        $this->addSql('COMMENT ON COLUMN accounts_reports.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE accounts_reports ADD CONSTRAINT FK_995CD53988394AC1 FOREIGN KEY (fk_reporter_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE accounts_reports ADD CONSTRAINT FK_995CD539FD4B4282 FOREIGN KEY (fk_reported_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE accounts_reports DROP CONSTRAINT FK_995CD53988394AC1');
        $this->addSql('ALTER TABLE accounts_reports DROP CONSTRAINT FK_995CD539FD4B4282');
        $this->addSql('DROP TABLE accounts_reports');
    }
}
