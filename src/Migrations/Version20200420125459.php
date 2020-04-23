<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420125459 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipments ADD objects_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipments ADD CONSTRAINT FK_6F6C25444BEE6933 FOREIGN KEY (objects_id) REFERENCES states (id)');
        $this->addSql('CREATE INDEX IDX_6F6C25444BEE6933 ON equipments (objects_id)');
        $this->addSql('ALTER TABLE states DROP FOREIGN KEY FK_31C2774D232D562B');
        $this->addSql('DROP INDEX IDX_31C2774D232D562B ON states');
        $this->addSql('ALTER TABLE states DROP object_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipments DROP FOREIGN KEY FK_6F6C25444BEE6933');
        $this->addSql('DROP INDEX IDX_6F6C25444BEE6933 ON equipments');
        $this->addSql('ALTER TABLE equipments DROP objects_id');
        $this->addSql('ALTER TABLE states ADD object_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE states ADD CONSTRAINT FK_31C2774D232D562B FOREIGN KEY (object_id) REFERENCES equipments (id)');
        $this->addSql('CREATE INDEX IDX_31C2774D232D562B ON states (object_id)');
    }
}
