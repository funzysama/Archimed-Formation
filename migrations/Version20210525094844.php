<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525094844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE i3_presultat (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, extraversion INT NOT NULL, introversion INT NOT NULL, sensation INT NOT NULL, intuition INT NOT NULL, thinking INT NOT NULL, feeling INT NOT NULL, rightness INT NOT NULL, opening INT NOT NULL, profile VARCHAR(4) NOT NULL, famille VARCHAR(2) NOT NULL, date_de_creation DATETIME NOT NULL, INDEX IDX_45E32170FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE i3_presultat ADD CONSTRAINT FK_45E32170FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE i3_presultat');
    }
}
