<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170729041340 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emergency DROP FOREIGN KEY FK_26DD111D77320B3B');
        $this->addSql('ALTER TABLE emergency ADD lat VARCHAR(255) DEFAULT NULL, ADD lon VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE emergency ADD CONSTRAINT FK_26DD111D77320B3B FOREIGN KEY (emergency_type_id) REFERENCES emergency_type (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emergency DROP FOREIGN KEY FK_26DD111D77320B3B');
        $this->addSql('ALTER TABLE emergency DROP lat, DROP lon');
        $this->addSql('ALTER TABLE emergency ADD CONSTRAINT FK_26DD111D77320B3B FOREIGN KEY (emergency_type_id) REFERENCES skill (id)');
    }
}
