<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309093529 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE couverture');
        $this->addSql('DROP TABLE livaut');
        $this->addSql('DROP TABLE livcouv');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE lmsf');
        $this->addSql('ALTER TABLE prix MODIFY idprix INT NOT NULL');
        $this->addSql('ALTER TABLE prix DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE prix CHANGE categorie_prix categorie_prix VARCHAR(255) NOT NULL, CHANGE idprix id INT AUTO_INCREMENT NOT NULL, CHANGE idc idc_id INT NOT NULL');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5E42186A73 FOREIGN KEY (idc_id) REFERENCES ceremonie (id)');
        $this->addSql('CREATE INDEX IDX_F7EFEA5E42186A73 ON prix (idc_id)');
        $this->addSql('ALTER TABLE prix ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE personne MODIFY idp INT NOT NULL');
        $this->addSql('ALTER TABLE personne DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE personne CHANGE nom_p nom_p VARCHAR(255) NOT NULL, CHANGE prenom_p prenom_p VARCHAR(255) NOT NULL, CHANGE idp id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE personne ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE ceremonie MODIFY idc INT NOT NULL');
        $this->addSql('ALTER TABLE ceremonie DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ceremonie CHANGE nom_ceremonie nom_ceremonie VARCHAR(255) NOT NULL, CHANGE idc id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE ceremonie ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE gagner ADD id INT AUTO_INCREMENT NOT NULL, ADD idp_id INT NOT NULL, ADD idf_id INT NOT NULL, ADD idprix_id INT NOT NULL, DROP idp, DROP idf, DROP idprix, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE gagner ADD CONSTRAINT FK_425866DEB49202 FOREIGN KEY (idp_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE gagner ADD CONSTRAINT FK_425866DE75C69A41 FOREIGN KEY (idf_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE gagner ADD CONSTRAINT FK_425866DE4B43709C FOREIGN KEY (idprix_id) REFERENCES prix (id)');
        $this->addSql('CREATE INDEX IDX_425866DEB49202 ON gagner (idp_id)');
        $this->addSql('CREATE INDEX IDX_425866DE75C69A41 ON gagner (idf_id)');
        $this->addSql('CREATE INDEX IDX_425866DE4B43709C ON gagner (idprix_id)');
        $this->addSql('ALTER TABLE film MODIFY idf INT NOT NULL');
        $this->addSql('ALTER TABLE film DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE film CHANGE nom_f nom_f VARCHAR(255) NOT NULL, CHANGE date_sortie date_sortie DATE NOT NULL, CHANGE idf id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE film ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE auteur (aut_id INT AUTO_INCREMENT NOT NULL, aut_nom VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, aut_prenom VARCHAR(40) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(aut_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE couverture (idCouverture INT AUTO_INCREMENT NOT NULL, fichierCouverture VARCHAR(20) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, idLivre INT DEFAULT NULL, PRIMARY KEY(idCouverture)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livaut (aut_id INT NOT NULL, liv_num INT NOT NULL, PRIMARY KEY(aut_id, liv_num)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livcouv (liv_num INT NOT NULL, couv_fic VARCHAR(65) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, UNIQUE INDEX couv_fic (couv_fic), PRIMARY KEY(liv_num, couv_fic)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livre (liv_num INT NOT NULL, liv_titre VARCHAR(50) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, liv_depotlegal DATE DEFAULT NULL, PRIMARY KEY(liv_num)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lmsf (liv_num INT NOT NULL, liv_titre VARCHAR(50) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, aut_nom VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, aut_prenom VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, aut_nom2 VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, aut_prenom2 VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, couv_fichier VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, couv_icone VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, couv_url2 VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, couv_icone2 VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(liv_num)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ceremonie MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE ceremonie DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ceremonie CHANGE nom_ceremonie nom_ceremonie VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE id idc INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE ceremonie ADD PRIMARY KEY (idc)');
        $this->addSql('ALTER TABLE film MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE film DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE film CHANGE nom_f nom_f VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE date_sortie date_sortie DATETIME NOT NULL, CHANGE id idf INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE film ADD PRIMARY KEY (idf)');
        $this->addSql('ALTER TABLE gagner MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE gagner DROP FOREIGN KEY FK_425866DEB49202');
        $this->addSql('ALTER TABLE gagner DROP FOREIGN KEY FK_425866DE75C69A41');
        $this->addSql('ALTER TABLE gagner DROP FOREIGN KEY FK_425866DE4B43709C');
        $this->addSql('DROP INDEX IDX_425866DEB49202 ON gagner');
        $this->addSql('DROP INDEX IDX_425866DE75C69A41 ON gagner');
        $this->addSql('DROP INDEX IDX_425866DE4B43709C ON gagner');
        $this->addSql('ALTER TABLE gagner DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE gagner ADD idp INT NOT NULL, ADD idf INT NOT NULL, ADD idprix INT NOT NULL, DROP id, DROP idp_id, DROP idf_id, DROP idprix_id');
        $this->addSql('ALTER TABLE gagner ADD PRIMARY KEY (idp, idf, idprix, annee_prix)');
        $this->addSql('ALTER TABLE personne MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE personne DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE personne CHANGE nom_p nom_p VARCHAR(20) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE prenom_p prenom_p VARCHAR(20) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE id idp INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE personne ADD PRIMARY KEY (idp)');
        $this->addSql('ALTER TABLE prix MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5E42186A73');
        $this->addSql('DROP INDEX IDX_F7EFEA5E42186A73 ON prix');
        $this->addSql('ALTER TABLE prix DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE prix CHANGE categorie_prix categorie_prix VARCHAR(50) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE id idprix INT AUTO_INCREMENT NOT NULL, CHANGE idc_id idc INT NOT NULL');
        $this->addSql('ALTER TABLE prix ADD PRIMARY KEY (idprix)');
    }
}
