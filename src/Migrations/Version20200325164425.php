<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325164425 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, user VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D768D93D649 (user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D6495E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ceremonie CHANGE nom_ceremonie nom_ceremonie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE film CHANGE nom_f nom_f VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE gagner DROP PRIMARY KEY');
        $this->addSql('CREATE INDEX IDX_425866DEE9D3F622 ON gagner (idp)');
        $this->addSql('CREATE INDEX IDX_425866DE24201BFE ON gagner (idprix)');
        $this->addSql('CREATE INDEX IDX_425866DE1D074373 ON gagner (idf)');
        $this->addSql('ALTER TABLE gagner ADD PRIMARY KEY (idp, idprix, idf)');
        $this->addSql('ALTER TABLE personne CHANGE nom_p nom_p VARCHAR(255) NOT NULL, CHANGE prenom_p prenom_p VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE prix CHANGE categorie_prix categorie_prix VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX IDX_F7EFEA5E6D6DB7FC ON prix (idc)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE ceremonie CHANGE nom_ceremonie nom_ceremonie VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE film CHANGE nom_f nom_f VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE gagner DROP FOREIGN KEY FK_425866DEE9D3F622');
        $this->addSql('ALTER TABLE gagner DROP FOREIGN KEY FK_425866DE24201BFE');
        $this->addSql('ALTER TABLE gagner DROP FOREIGN KEY FK_425866DE1D074373');
        $this->addSql('DROP INDEX IDX_425866DEE9D3F622 ON gagner');
        $this->addSql('DROP INDEX IDX_425866DE24201BFE ON gagner');
        $this->addSql('DROP INDEX IDX_425866DE1D074373 ON gagner');
        $this->addSql('ALTER TABLE gagner DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE gagner ADD PRIMARY KEY (idp, idf, idprix, annee_prix)');
        $this->addSql('ALTER TABLE personne CHANGE nom_p nom_p VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE prenom_p prenom_p VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5E6D6DB7FC');
        $this->addSql('DROP INDEX IDX_F7EFEA5E6D6DB7FC ON prix');
        $this->addSql('ALTER TABLE prix CHANGE categorie_prix categorie_prix VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
    }
}
