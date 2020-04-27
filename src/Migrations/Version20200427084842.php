<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200427084842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users_projects (id INT AUTO_INCREMENT NOT NULL, projects_id INT DEFAULT NULL, INDEX IDX_27D2987E1EDE0F55 (projects_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_projects ADD CONSTRAINT FK_27D2987E1EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id)');
        $this->addSql('DROP TABLE projects_users');
        $this->addSql('ALTER TABLE users ADD projects_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E91EDE0F55 FOREIGN KEY (projects_id) REFERENCES users_projects (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E91EDE0F55 ON users (projects_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E91EDE0F55');
        $this->addSql('CREATE TABLE projects_users (projects_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_8102F1D71EDE0F55 (projects_id), INDEX IDX_8102F1D767B3B43D (users_id), PRIMARY KEY(projects_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE projects_users ADD CONSTRAINT FK_8102F1D71EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_users ADD CONSTRAINT FK_8102F1D767B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE users_projects');
        $this->addSql('DROP INDEX IDX_1483A5E91EDE0F55 ON users');
        $this->addSql('ALTER TABLE users DROP projects_id');
    }
}
