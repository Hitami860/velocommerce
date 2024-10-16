<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241016133540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actualite (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, image LONGTEXT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, identifiant_id INT NOT NULL, reference VARCHAR(255) DEFAULT NULL, INDEX IDX_35D4282C1016936D (identifiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes_details (id INT AUTO_INCREMENT NOT NULL, commandes_id INT NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_B48B83DA8BF5C2E6 (commandes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes_details_produits (commandes_details_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_C73A3C198C9BE442 (commandes_details_id), INDEX IDX_C73A3C19CD11A2CF (produits_id), PRIMARY KEY(commandes_details_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identifiant (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, rowguid VARCHAR(255) NOT NULL, telephone BIGINT NOT NULL, adresse LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, image LONGTEXT NOT NULL, INDEX IDX_BE2DDF8CBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C1016936D FOREIGN KEY (identifiant_id) REFERENCES identifiant (id)');
        $this->addSql('ALTER TABLE commandes_details ADD CONSTRAINT FK_B48B83DA8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE commandes_details_produits ADD CONSTRAINT FK_C73A3C198C9BE442 FOREIGN KEY (commandes_details_id) REFERENCES commandes_details (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes_details_produits ADD CONSTRAINT FK_C73A3C19CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C1016936D');
        $this->addSql('ALTER TABLE commandes_details DROP FOREIGN KEY FK_B48B83DA8BF5C2E6');
        $this->addSql('ALTER TABLE commandes_details_produits DROP FOREIGN KEY FK_C73A3C198C9BE442');
        $this->addSql('ALTER TABLE commandes_details_produits DROP FOREIGN KEY FK_C73A3C19CD11A2CF');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CBCF5E72D');
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE commandes_details');
        $this->addSql('DROP TABLE commandes_details_produits');
        $this->addSql('DROP TABLE identifiant');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
