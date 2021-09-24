<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210924021727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, rue VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, site_responsible_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_4C62E638217C0A1D (site_responsible_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, document_id INT DEFAULT NULL, site_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, brochure_filename VARCHAR(255) DEFAULT NULL, state_file TINYINT(1) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, version INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_8C9F3610A76ED395 (user_id), INDEX IDX_8C9F3610C33F7837 (document_id), INDEX IDX_8C9F3610F6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_consultation (id INT AUTO_INCREMENT NOT NULL, time_consultation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_consultation_file (historique_consultation_id INT NOT NULL, file_id INT NOT NULL, INDEX IDX_E9278475B9A7121D (historique_consultation_id), INDEX IDX_E927847593CB796C (file_id), PRIMARY KEY(historique_consultation_id, file_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_consultation_mobile_access (historique_consultation_id INT NOT NULL, mobile_access_id INT NOT NULL, INDEX IDX_B0C94A41B9A7121D (historique_consultation_id), INDEX IDX_B0C94A41C3F42C90 (mobile_access_id), PRIMARY KEY(historique_consultation_id, mobile_access_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_envoi (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, expediteur_id INT DEFAULT NULL, destinataire_id INT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_84FEEF15C33F7837 (document_id), INDEX IDX_84FEEF1510335F61 (expediteur_id), INDEX IDX_84FEEF15A4F84F6E (destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_object (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobile_access (id INT AUTO_INCREMENT NOT NULL, contact_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, identifiant VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, langue VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_794DC05EE7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, adresse_principale_id INT DEFAULT NULL, adresse_acces_conducteur_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, coord_gps VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_694309E4C87159FC (adresse_principale_id), UNIQUE INDEX UNIQ_694309E457D026D5 (adresse_acces_conducteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_contact (site_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_B7C604F3F6BD1646 (site_id), INDEX IDX_B7C604F3E7A1254A (contact_id), PRIMARY KEY(site_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, contact_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649E7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638217C0A1D FOREIGN KEY (site_responsible_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610C33F7837 FOREIGN KEY (document_id) REFERENCES media_object (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE historique_consultation_file ADD CONSTRAINT FK_E9278475B9A7121D FOREIGN KEY (historique_consultation_id) REFERENCES historique_consultation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique_consultation_file ADD CONSTRAINT FK_E927847593CB796C FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique_consultation_mobile_access ADD CONSTRAINT FK_B0C94A41B9A7121D FOREIGN KEY (historique_consultation_id) REFERENCES historique_consultation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique_consultation_mobile_access ADD CONSTRAINT FK_B0C94A41C3F42C90 FOREIGN KEY (mobile_access_id) REFERENCES mobile_access (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique_envoi ADD CONSTRAINT FK_84FEEF15C33F7837 FOREIGN KEY (document_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE historique_envoi ADD CONSTRAINT FK_84FEEF1510335F61 FOREIGN KEY (expediteur_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE historique_envoi ADD CONSTRAINT FK_84FEEF15A4F84F6E FOREIGN KEY (destinataire_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE mobile_access ADD CONSTRAINT FK_794DC05EE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4C87159FC FOREIGN KEY (adresse_principale_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E457D026D5 FOREIGN KEY (adresse_acces_conducteur_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE site_contact ADD CONSTRAINT FK_B7C604F3F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site_contact ADD CONSTRAINT FK_B7C604F3E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4C87159FC');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E457D026D5');
        $this->addSql('ALTER TABLE historique_envoi DROP FOREIGN KEY FK_84FEEF1510335F61');
        $this->addSql('ALTER TABLE historique_envoi DROP FOREIGN KEY FK_84FEEF15A4F84F6E');
        $this->addSql('ALTER TABLE mobile_access DROP FOREIGN KEY FK_794DC05EE7A1254A');
        $this->addSql('ALTER TABLE site_contact DROP FOREIGN KEY FK_B7C604F3E7A1254A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E7A1254A');
        $this->addSql('ALTER TABLE historique_consultation_file DROP FOREIGN KEY FK_E927847593CB796C');
        $this->addSql('ALTER TABLE historique_envoi DROP FOREIGN KEY FK_84FEEF15C33F7837');
        $this->addSql('ALTER TABLE historique_consultation_file DROP FOREIGN KEY FK_E9278475B9A7121D');
        $this->addSql('ALTER TABLE historique_consultation_mobile_access DROP FOREIGN KEY FK_B0C94A41B9A7121D');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610C33F7837');
        $this->addSql('ALTER TABLE historique_consultation_mobile_access DROP FOREIGN KEY FK_B0C94A41C3F42C90');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638217C0A1D');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610F6BD1646');
        $this->addSql('ALTER TABLE site_contact DROP FOREIGN KEY FK_B7C604F3F6BD1646');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610A76ED395');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE historique_consultation');
        $this->addSql('DROP TABLE historique_consultation_file');
        $this->addSql('DROP TABLE historique_consultation_mobile_access');
        $this->addSql('DROP TABLE historique_envoi');
        $this->addSql('DROP TABLE media_object');
        $this->addSql('DROP TABLE mobile_access');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE site_contact');
        $this->addSql('DROP TABLE user');
    }
}
