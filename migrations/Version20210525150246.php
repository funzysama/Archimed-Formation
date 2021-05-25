<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525150246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE i3p_profils (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(4) NOT NULL, famille VARCHAR(2) NOT NULL, energie VARCHAR(50) NOT NULL, energie_letter VARCHAR(1) NOT NULL, information VARCHAR(50) NOT NULL, information_letter VARCHAR(1) NOT NULL, descision VARCHAR(50) NOT NULL, descision_letter VARCHAR(1) NOT NULL, organisation VARCHAR(50) NOT NULL, organisation_letter VARCHAR(1) NOT NULL, dominant VARCHAR(50) NOT NULL, auxiliaire VARCHAR(50) NOT NULL, tertiaire VARCHAR(50) NOT NULL, infeur VARCHAR(50) NOT NULL, profil_perso LONGTEXT NOT NULL, profil_pro LONGTEXT NOT NULL, valeurs VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE i3p_profils');
    }
}
