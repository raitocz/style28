<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200525091645 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE article ALTER date_created TYPE DATE');
        $this->addSql('ALTER TABLE article ALTER date_created DROP DEFAULT');
        $this->addSql('ALTER TABLE article ALTER date_published TYPE DATE');
        $this->addSql('ALTER TABLE article ALTER date_published DROP DEFAULT');
        $this->addSql('ALTER TABLE article ALTER date_edited TYPE DATE');
        $this->addSql('ALTER TABLE article ALTER date_edited DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article ALTER date_created TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE article ALTER date_created DROP DEFAULT');
        $this->addSql('ALTER TABLE article ALTER date_published TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE article ALTER date_published DROP DEFAULT');
        $this->addSql('ALTER TABLE article ALTER date_edited TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE article ALTER date_edited DROP DEFAULT');
    }
}
