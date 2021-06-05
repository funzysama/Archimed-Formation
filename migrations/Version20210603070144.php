<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210603070144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE irmr_resultat (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, realiste INT NOT NULL, investigateur INT NOT NULL, artiste INT NOT NULL, social INT NOT NULL, entrepreneur INT NOT NULL, conventionnel INT NOT NULL, realiste_etalonne INT NOT NULL, investigateur_etalonne INT NOT NULL, artiste_etalonne INT NOT NULL, social_etalonne INT NOT NULL, entrepreneur_etalonne INT NOT NULL, conventionnel_etalonne INT NOT NULL, differenciation DOUBLE PRECISION NOT NULL, date_de_creation DATETIME NOT NULL, INDEX IDX_88D0BE9FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE irmr_resultat ADD CONSTRAINT FK_88D0BE9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD qualification VARCHAR(25) DEFAULT NULL, ADD situation VARCHAR(50) DEFAULT NULL, ADD tranche_dage VARCHAR(25) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE irmr_resultat');
        $this->addSql('ALTER TABLE utilisateur DROP qualification, DROP situation, DROP tranche_dage');
    }
}
