<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190914221129 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, account_name VARCHAR(255) NOT NULL, account_type VARCHAR(200) NOT NULL, industry VARCHAR(200) DEFAULT NULL, annual_revenue NUMERIC(25, 2) DEFAULT NULL, phone VARCHAR(30) DEFAULT NULL, other_phone VARCHAR(30) DEFAULT NULL, email1 VARCHAR(120) DEFAULT NULL, email2 VARCHAR(120) DEFAULT NULL, website VARCHAR(160) DEFAULT NULL, fax VARCHAR(30) DEFAULT NULL, billing_street VARCHAR(255) DEFAULT NULL, billing_city VARCHAR(60) DEFAULT NULL, billing_zipcode VARCHAR(12) DEFAULT NULL, billing_country VARCHAR(60) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6389B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('CREATE INDEX IDX_4C62E6389B6B5FBA ON contact (account_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6389B6B5FBA');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP INDEX IDX_4C62E6389B6B5FBA ON contact');
        $this->addSql('ALTER TABLE contact DROP account_id');
    }
}
