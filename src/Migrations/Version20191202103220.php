<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191202103220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE year (id INT AUTO_INCREMENT NOT NULL, name INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE street (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F0EED3D88BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE object (id INT AUTO_INCREMENT NOT NULL, year_id INT DEFAULT NULL, city_id INT DEFAULT NULL, street_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_A8ADABEC40C1FEA7 (year_id), INDEX IDX_A8ADABEC8BAC62AF (city_id), INDEX IDX_A8ADABEC87CF8EB (street_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE street ADD CONSTRAINT FK_F0EED3D88BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE object ADD CONSTRAINT FK_A8ADABEC40C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE object ADD CONSTRAINT FK_A8ADABEC8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE object ADD CONSTRAINT FK_A8ADABEC87CF8EB FOREIGN KEY (street_id) REFERENCES street (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE street DROP FOREIGN KEY FK_F0EED3D88BAC62AF');
        $this->addSql('ALTER TABLE object DROP FOREIGN KEY FK_A8ADABEC8BAC62AF');
        $this->addSql('ALTER TABLE object DROP FOREIGN KEY FK_A8ADABEC40C1FEA7');
        $this->addSql('ALTER TABLE object DROP FOREIGN KEY FK_A8ADABEC87CF8EB');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE year');
        $this->addSql('DROP TABLE street');
        $this->addSql('DROP TABLE object');
    }
}
