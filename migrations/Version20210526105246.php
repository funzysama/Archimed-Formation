<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526105246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE i3_presultat ADD CONSTRAINT FK_45E32170275ED078 FOREIGN KEY (profil_id) REFERENCES i3p_profils (id)');
        $this->addSql('CREATE INDEX IDX_45E32170275ED078 ON i3_presultat (profil_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ressource');
        $this->addSql('ALTER TABLE i3_presultat DROP FOREIGN KEY FK_45E32170275ED078');
        $this->addSql('DROP INDEX IDX_45E32170275ED078 ON i3_presultat');
    }
}
