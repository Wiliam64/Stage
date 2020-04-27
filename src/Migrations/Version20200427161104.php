<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200427161104 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E91EDE0F55');
        $this->addSql('DROP TABLE users_projects');
        $this->addSql('DROP INDEX IDX_1483A5E91EDE0F55 ON users');
        $this->addSql('ALTER TABLE users DROP projects_id, DROP company');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users_projects (id INT AUTO_INCREMENT NOT NULL, projects_id INT DEFAULT NULL, INDEX IDX_27D2987E1EDE0F55 (projects_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users_projects ADD CONSTRAINT FK_27D2987E1EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id)');
        $this->addSql('ALTER TABLE users ADD projects_id INT DEFAULT NULL, ADD company VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E91EDE0F55 FOREIGN KEY (projects_id) REFERENCES users_projects (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E91EDE0F55 ON users (projects_id)');
    }
}
