<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615232203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cartouche (id INT AUTO_INCREMENT NOT NULL, departement_id INT DEFAULT NULL, couleur_id INT DEFAULT NULL, fournisseur_id INT DEFAULT NULL, date DATE DEFAULT NULL, nom_personne VARCHAR(50) DEFAULT NULL, reference_cartouche VARCHAR(30) NOT NULL, qte INT NOT NULL, INDEX IDX_E90C360CCCF9E01E (departement_id), INDEX IDX_E90C360CC31BA576 (couleur_id), INDEX IDX_E90C360C670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cartouche ADD CONSTRAINT FK_E90C360CCCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE cartouche ADD CONSTRAINT FK_E90C360CC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE cartouche ADD CONSTRAINT FK_E90C360C670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartouche DROP FOREIGN KEY FK_E90C360CC31BA576');
        $this->addSql('DROP TABLE cartouche');
        $this->addSql('DROP TABLE couleur');
    }
}
