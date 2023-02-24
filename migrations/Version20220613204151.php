<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613204151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B631E61B789');
        $this->addSql('DROP INDEX IDX_C1765B631E61B789 ON departement');
        $this->addSql('ALTER TABLE departement DROP repertoire_id');
        $this->addSql('ALTER TABLE repertoire ADD departements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE repertoire ADD CONSTRAINT FK_3C3678761DB279A6 FOREIGN KEY (departements_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_3C3678761DB279A6 ON repertoire (departements_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departement ADD repertoire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B631E61B789 FOREIGN KEY (repertoire_id) REFERENCES repertoire (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C1765B631E61B789 ON departement (repertoire_id)');
        $this->addSql('ALTER TABLE repertoire DROP FOREIGN KEY FK_3C3678761DB279A6');
        $this->addSql('DROP INDEX IDX_3C3678761DB279A6 ON repertoire');
        $this->addSql('ALTER TABLE repertoire DROP departements_id');
    }
}
