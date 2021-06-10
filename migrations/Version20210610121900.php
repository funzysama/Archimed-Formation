<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210610121900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE i3_presultat DROP FOREIGN KEY FK_45E32170FB88E14F');
        $this->addSql('DROP INDEX IDX_45E32170FB88E14F ON i3_presultat');
        $this->addSql('ALTER TABLE i3_presultat DROP utilisateur_id');
        $this->addSql('ALTER TABLE irmr_resultat DROP FOREIGN KEY FK_88D0BE9FB88E14F');
        $this->addSql('DROP INDEX IDX_88D0BE9FB88E14F ON irmr_resultat');
        $this->addSql('ALTER TABLE irmr_resultat DROP utilisateur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE i3_presultat ADD utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE i3_presultat ADD CONSTRAINT FK_45E32170FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_45E32170FB88E14F ON i3_presultat (utilisateur_id)');
        $this->addSql('ALTER TABLE irmr_resultat ADD utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE irmr_resultat ADD CONSTRAINT FK_88D0BE9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_88D0BE9FB88E14F ON irmr_resultat (utilisateur_id)');
    }
}
