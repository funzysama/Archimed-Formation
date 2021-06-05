<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210603071544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE irmr_resultat ADD realiste_pourcent INT NOT NULL, ADD investigateur_pourcent INT NOT NULL, ADD artiste_pourcent INT NOT NULL, ADD social_pourcent INT NOT NULL, ADD entreprenant_pourcent INT NOT NULL, ADD conventionnel_pourcent INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE irmr_resultat DROP realiste_pourcent, DROP investigateur_pourcent, DROP artiste_pourcent, DROP social_pourcent, DROP entreprenant_pourcent, DROP conventionnel_pourcent');
    }
}
