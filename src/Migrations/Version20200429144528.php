<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429144528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipments DROP FOREIGN KEY FK_6F6C25445D83CC1');
        $this->addSql('DROP INDEX IDX_6F6C25445D83CC1 ON equipments');
        $this->addSql('ALTER TABLE equipments DROP state_id');
        $this->addSql('ALTER TABLE type_equipments DROP FOREIGN KEY FK_726FF361B17973F');
        $this->addSql('DROP INDEX IDX_726FF361B17973F ON type_equipments');
        $this->addSql('ALTER TABLE type_equipments DROP states_id');
        $this->addSql('ALTER TABLE states ADD equipment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE states ADD CONSTRAINT FK_31C2774D517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipments (id)');
        $this->addSql('CREATE INDEX IDX_31C2774D517FE9FE ON states (equipment_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipments ADD state_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipments ADD CONSTRAINT FK_6F6C25445D83CC1 FOREIGN KEY (state_id) REFERENCES states (id)');
        $this->addSql('CREATE INDEX IDX_6F6C25445D83CC1 ON equipments (state_id)');
        $this->addSql('ALTER TABLE states DROP FOREIGN KEY FK_31C2774D517FE9FE');
        $this->addSql('DROP INDEX IDX_31C2774D517FE9FE ON states');
        $this->addSql('ALTER TABLE states DROP equipment_id');
        $this->addSql('ALTER TABLE type_equipments ADD states_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_equipments ADD CONSTRAINT FK_726FF361B17973F FOREIGN KEY (states_id) REFERENCES states (id)');
        $this->addSql('CREATE INDEX IDX_726FF361B17973F ON type_equipments (states_id)');
    }
}
