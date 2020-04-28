<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428121630 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attributes (id INT AUTO_INCREMENT NOT NULL, states_id INT DEFAULT NULL, key_attribute VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, INDEX IDX_319B9E70B17973F (states_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipments (id INT AUTO_INCREMENT NOT NULL, state_id INT DEFAULT NULL, project_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, init VARCHAR(50) NOT NULL, INDEX IDX_6F6C25445D83CC1 (state_id), INDEX IDX_6F6C2544166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, customers_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E9C3568B40 (customers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_equipments (id INT AUTO_INCREMENT NOT NULL, states_id INT DEFAULT NULL, title VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_726FF361B17973F (states_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actions (id INT AUTO_INCREMENT NOT NULL, states_id INT DEFAULT NULL, key_action VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, INDEX IDX_548F1EFB17973F (states_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, company VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conditions (id INT AUTO_INCREMENT NOT NULL, states_id INT DEFAULT NULL, key_condition VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, INDEX IDX_F46609A9B17973F (states_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE states (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, customers_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_5C93B3A4C3568B40 (customers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attributes ADD CONSTRAINT FK_319B9E70B17973F FOREIGN KEY (states_id) REFERENCES states (id)');
        $this->addSql('ALTER TABLE equipments ADD CONSTRAINT FK_6F6C25445D83CC1 FOREIGN KEY (state_id) REFERENCES states (id)');
        $this->addSql('ALTER TABLE equipments ADD CONSTRAINT FK_6F6C2544166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE type_equipments ADD CONSTRAINT FK_726FF361B17973F FOREIGN KEY (states_id) REFERENCES states (id)');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EFB17973F FOREIGN KEY (states_id) REFERENCES states (id)');
        $this->addSql('ALTER TABLE conditions ADD CONSTRAINT FK_F46609A9B17973F FOREIGN KEY (states_id) REFERENCES states (id)');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A4C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9C3568B40');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A4C3568B40');
        $this->addSql('ALTER TABLE attributes DROP FOREIGN KEY FK_319B9E70B17973F');
        $this->addSql('ALTER TABLE equipments DROP FOREIGN KEY FK_6F6C25445D83CC1');
        $this->addSql('ALTER TABLE type_equipments DROP FOREIGN KEY FK_726FF361B17973F');
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EFB17973F');
        $this->addSql('ALTER TABLE conditions DROP FOREIGN KEY FK_F46609A9B17973F');
        $this->addSql('ALTER TABLE equipments DROP FOREIGN KEY FK_6F6C2544166D1F9C');
        $this->addSql('DROP TABLE attributes');
        $this->addSql('DROP TABLE equipments');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE type_equipments');
        $this->addSql('DROP TABLE actions');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE conditions');
        $this->addSql('DROP TABLE states');
        $this->addSql('DROP TABLE projects');
    }
}
