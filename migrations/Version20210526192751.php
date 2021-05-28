<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526192751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE i3_presultat DROP FOREIGN KEY FK_45E32170275ED078');
        $this->addSql('DROP INDEX IDX_45E32170275ED078 ON i3_presultat');
        $this->addSql('ALTER TABLE i3_presultat DROP profil_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE i3_presultat ADD profil_id INT NOT NULL');
        $this->addSql('ALTER TABLE i3_presultat ADD CONSTRAINT FK_45E32170275ED078 FOREIGN KEY (profil_id) REFERENCES i3p_profils (id)');
        $this->addSql('CREATE INDEX IDX_45E32170275ED078 ON i3_presultat (profil_id)');
    }
}
