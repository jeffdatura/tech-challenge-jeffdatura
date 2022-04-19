<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405131735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, proprio_id INT NOT NULL, chenille_id INT NOT NULL, nom VARCHAR(255) NOT NULL, race VARCHAR(255) NOT NULL, INDEX IDX_6AAB231F6B82600 (proprio_id), INDEX IDX_6AAB231F1B36347B (chenille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chenille (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprio (id INT AUTO_INCREMENT NOT NULL, chenille_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_79F4F3861B36347B (chenille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F6B82600 FOREIGN KEY (proprio_id) REFERENCES proprio (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F1B36347B FOREIGN KEY (chenille_id) REFERENCES chenille (id)');
        $this->addSql('ALTER TABLE proprio ADD CONSTRAINT FK_79F4F3861B36347B FOREIGN KEY (chenille_id) REFERENCES chenille (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F1B36347B');
        $this->addSql('ALTER TABLE proprio DROP FOREIGN KEY FK_79F4F3861B36347B');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F6B82600');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE chenille');
        $this->addSql('DROP TABLE proprio');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
