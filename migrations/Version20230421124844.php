<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230421124844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628BCF5E72D');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4155D8F51');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D45200282E');
        $this->addSql('CREATE TABLE detail (id INT AUTO_INCREMENT NOT NULL, a VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE programmation DROP FOREIGN KEY FK_5E9F80E3AFC2B591');
        $this->addSql('ALTER TABLE programmation DROP FOREIGN KEY FK_5E9F80E3613FECDF');
        $this->addSql('ALTER TABLE stagiaire_session DROP FOREIGN KEY FK_D32D02D4613FECDF');
        $this->addSql('ALTER TABLE stagiaire_session DROP FOREIGN KEY FK_D32D02D4BBA93DD6');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE programmation');
        $this->addSql('DROP TABLE stagiaire');
        $this->addSql('DROP TABLE stagiaire_session');
        $this->addSql('DROP INDEX IDX_C242628BCF5E72D ON module');
        $this->addSql('ALTER TABLE module DROP nom, CHANGE categorie_id nombre_jours INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_D044D5D4155D8F51 ON session');
        $this->addSql('DROP INDEX IDX_D044D5D45200282E ON session');
        $this->addSql('ALTER TABLE session ADD details LONGTEXT NOT NULL, DROP formateur_id, DROP formation_id, DROP intitule, DROP date_debut, DROP date_fin, DROP nombre_places');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, prenom VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ville VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, telephone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE programmation (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, module_id INT NOT NULL, nombrejours INT NOT NULL, INDEX IDX_5E9F80E3AFC2B591 (module_id), INDEX IDX_5E9F80E3613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stagiaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, prenom VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, date_naissance DATE NOT NULL, ville VARCHAR(250) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, telephone VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stagiaire_session (stagiaire_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_D32D02D4613FECDF (session_id), INDEX IDX_D32D02D4BBA93DD6 (stagiaire_id), PRIMARY KEY(stagiaire_id, session_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE programmation ADD CONSTRAINT FK_5E9F80E3AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE programmation ADD CONSTRAINT FK_5E9F80E3613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE stagiaire_session ADD CONSTRAINT FK_D32D02D4613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stagiaire_session ADD CONSTRAINT FK_D32D02D4BBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaire (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE detail');
        $this->addSql('ALTER TABLE module ADD nom VARCHAR(255) NOT NULL, CHANGE nombre_jours categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_C242628BCF5E72D ON module (categorie_id)');
        $this->addSql('ALTER TABLE session ADD formateur_id INT DEFAULT NULL, ADD formation_id INT DEFAULT NULL, ADD intitule VARCHAR(255) NOT NULL, ADD date_debut DATE NOT NULL, ADD date_fin DATE NOT NULL, ADD nombre_places INT NOT NULL, DROP details');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D45200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D4155D8F51 ON session (formateur_id)');
        $this->addSql('CREATE INDEX IDX_D044D5D45200282E ON session (formation_id)');
    }
}
