<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210610123622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur ADD resultat_i3_p_id INT DEFAULT NULL, ADD resultat_riasec_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B35C62FBDA FOREIGN KEY (resultat_i3_p_id) REFERENCES i3_presultat (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3D628E802 FOREIGN KEY (resultat_riasec_id) REFERENCES irmr_resultat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B35C62FBDA ON utilisateur (resultat_i3_p_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3D628E802 ON utilisateur (resultat_riasec_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B35C62FBDA');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D628E802');
        $this->addSql('DROP INDEX UNIQ_1D1C63B35C62FBDA ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3D628E802 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP resultat_i3_p_id, DROP resultat_riasec_id');
    }
}
