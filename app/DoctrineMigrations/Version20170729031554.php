<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170729031554 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE emergency_type (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E7A161BC5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emergency ADD emergency_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emergency ADD CONSTRAINT FK_26DD111D77320B3B FOREIGN KEY (emergency_type_id) REFERENCES skill (id)');
        $this->addSql('CREATE INDEX IDX_26DD111D77320B3B ON emergency (emergency_type_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE emergency_type');
        $this->addSql('ALTER TABLE emergency DROP FOREIGN KEY FK_26DD111D77320B3B');
        $this->addSql('DROP INDEX IDX_26DD111D77320B3B ON emergency');
        $this->addSql('ALTER TABLE emergency DROP emergency_type_id');
    }
}
