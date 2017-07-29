<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170729020933 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE emergency (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emergency_skill (emergency_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_DE33FC8AD904784C (emergency_id), INDEX IDX_DE33FC8A5585C142 (skill_id), PRIMARY KEY(emergency_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5E3DE4775E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE volunteer (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE volunteer_enrolment (id INT AUTO_INCREMENT NOT NULL, emergency_id INT DEFAULT NULL, volunteer_id INT DEFAULT NULL, created DATETIME NOT NULL, INDEX IDX_5ADA3EF2D904784C (emergency_id), INDEX IDX_5ADA3EF28EFAB6B1 (volunteer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emergency_skill ADD CONSTRAINT FK_DE33FC8AD904784C FOREIGN KEY (emergency_id) REFERENCES emergency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emergency_skill ADD CONSTRAINT FK_DE33FC8A5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE volunteer_enrolment ADD CONSTRAINT FK_5ADA3EF2D904784C FOREIGN KEY (emergency_id) REFERENCES emergency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE volunteer_enrolment ADD CONSTRAINT FK_5ADA3EF28EFAB6B1 FOREIGN KEY (volunteer_id) REFERENCES volunteer (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emergency_skill DROP FOREIGN KEY FK_DE33FC8AD904784C');
        $this->addSql('ALTER TABLE volunteer_enrolment DROP FOREIGN KEY FK_5ADA3EF2D904784C');
        $this->addSql('ALTER TABLE emergency_skill DROP FOREIGN KEY FK_DE33FC8A5585C142');
        $this->addSql('ALTER TABLE volunteer_enrolment DROP FOREIGN KEY FK_5ADA3EF28EFAB6B1');
        $this->addSql('DROP TABLE emergency');
        $this->addSql('DROP TABLE emergency_skill');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE volunteer');
        $this->addSql('DROP TABLE volunteer_enrolment');
    }
}
