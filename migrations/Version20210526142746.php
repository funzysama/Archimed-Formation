<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526142746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur ADD consultant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B344F779A2 FOREIGN KEY (consultant_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B344F779A2 ON utilisateur (consultant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B344F779A2');
        $this->addSql('DROP INDEX IDX_1D1C63B344F779A2 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP consultant_id');
    }
}
