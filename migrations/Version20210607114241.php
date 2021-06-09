<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607114241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metier_pe DROP FOREIGN KEY FK_11163AECC5E5594');
        $this->addSql('ALTER TABLE domaine_pro DROP FOREIGN KEY FK_60924245DD337111');
        $this->addSql('DROP TABLE domaine_pro');
        $this->addSql('DROP TABLE grand_domaine_pro');
        $this->addSql('DROP TABLE metier_pe');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE domaine_pro (id INT AUTO_INCREMENT NOT NULL, grand_domaine_pro_id INT NOT NULL, code VARCHAR(3) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_60924245DD337111 (grand_domaine_pro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE grand_domaine_pro (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(1) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE metier_pe (id INT AUTO_INCREMENT NOT NULL, domaine_pro_id INT NOT NULL, code VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, riasec_majeur VARCHAR(1) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, riasec_mineur VARCHAR(1) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, code_isco VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, particulier TINYINT(1) NOT NULL, INDEX IDX_11163AECC5E5594 (domaine_pro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE domaine_pro ADD CONSTRAINT FK_60924245DD337111 FOREIGN KEY (grand_domaine_pro_id) REFERENCES grand_domaine_pro (id)');
        $this->addSql('ALTER TABLE metier_pe ADD CONSTRAINT FK_11163AECC5E5594 FOREIGN KEY (domaine_pro_id) REFERENCES domaine_pro (id)');
    }
}
