<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230423183845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE session_stagiaire (session_id INT NOT NULL, stagiaire_id INT NOT NULL, INDEX IDX_C80B23B613FECDF (session_id), INDEX IDX_C80B23BBBA93DD6 (stagiaire_id), PRIMARY KEY(session_id, stagiaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE session_stagiaire ADD CONSTRAINT FK_C80B23B613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_stagiaire ADD CONSTRAINT FK_C80B23BBBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stagiaire_session DROP FOREIGN KEY FK_D32D02D4613FECDF');
        $this->addSql('ALTER TABLE stagiaire_session DROP FOREIGN KEY FK_D32D02D4BBA93DD6');
        $this->addSql('DROP TABLE stagiaire_session');
        $this->addSql('ALTER TABLE formateur CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE module ADD many_to_one VARCHAR(255) NOT NULL, ADD nombre_jours INT NOT NULL, CHANGE details details VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE programmation CHANGE session_id session_id INT DEFAULT NULL, CHANGE module_id module_id INT DEFAULT NULL, CHANGE nombrejours nombre_jours INT NOT NULL');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4155D8F51');
        $this->addSql('DROP INDEX IDX_D044D5D4155D8F51 ON session');
        $this->addSql('ALTER TABLE session DROP formateur_id, CHANGE formation_id formation_id INT NOT NULL');
        $this->addSql('ALTER TABLE stagiaire CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stagiaire_session (stagiaire_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_D32D02D4BBA93DD6 (stagiaire_id), INDEX IDX_D32D02D4613FECDF (session_id), PRIMARY KEY(stagiaire_id, session_id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE stagiaire_session ADD CONSTRAINT FK_D32D02D4613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stagiaire_session ADD CONSTRAINT FK_D32D02D4BBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaire (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_stagiaire DROP FOREIGN KEY FK_C80B23B613FECDF');
        $this->addSql('ALTER TABLE session_stagiaire DROP FOREIGN KEY FK_C80B23BBBA93DD6');
        $this->addSql('DROP TABLE session_stagiaire');
        $this->addSql('ALTER TABLE formateur CHANGE nom nom VARCHAR(100) NOT NULL, CHANGE prenom prenom VARCHAR(100) NOT NULL, CHANGE telephone telephone VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE programmation CHANGE module_id module_id INT NOT NULL, CHANGE session_id session_id INT NOT NULL, CHANGE nombre_jours nombrejours INT NOT NULL');
        $this->addSql('ALTER TABLE module DROP many_to_one, DROP nombre_jours, CHANGE details details LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE session ADD formateur_id INT DEFAULT NULL, CHANGE formation_id formation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D044D5D4155D8F51 ON session (formateur_id)');
        $this->addSql('ALTER TABLE stagiaire CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL, CHANGE ville ville VARCHAR(250) NOT NULL, CHANGE telephone telephone VARCHAR(100) NOT NULL');
    }
}
