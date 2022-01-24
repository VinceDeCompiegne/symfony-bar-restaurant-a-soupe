<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210816211322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE description (id INT AUTO_INCREMENT NOT NULL, nom_id INT NOT NULL, description VARCHAR(1024) DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(80) NOT NULL, active INT NOT NULL, aime INT NOT NULL, UNIQUE INDEX UNIQ_6DE44026C8121CE9 (nom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(80) NOT NULL, energy INT UNSIGNED DEFAULT 0 NOT NULL, fibers INT UNSIGNED DEFAULT 0 NOT NULL, fruit_pourcentage INT UNSIGNED DEFAULT 0 NOT NULL, proteins INT UNSIGNED DEFAULT 0 NOT NULL, satured_fats INT UNSIGNED DEFAULT 0 NOT NULL, sodium INT UNSIGNED DEFAULT 0 NOT NULL, sugar INT UNSIGNED DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, email_id INT DEFAULT NULL, date DATETIME NOT NULL, chck INT NOT NULL, INDEX IDX_42C84955A832C1C9 (email_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_detail (id INT AUTO_INCREMENT NOT NULL, ref_id INT NOT NULL, recette_id INT NOT NULL, image_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_66F7360821B741A9 (ref_id), UNIQUE INDEX UNIQ_66F7360889312FE9 (recette_id), INDEX IDX_66F736083DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(30) NOT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE description ADD CONSTRAINT FK_6DE44026C8121CE9 FOREIGN KEY (nom_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A832C1C9 FOREIGN KEY (email_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation_detail ADD CONSTRAINT FK_66F7360821B741A9 FOREIGN KEY (ref_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE reservation_detail ADD CONSTRAINT FK_66F7360889312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE reservation_detail ADD CONSTRAINT FK_66F736083DA5256D FOREIGN KEY (image_id) REFERENCES description (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_detail DROP FOREIGN KEY FK_66F736083DA5256D');
        $this->addSql('ALTER TABLE description DROP FOREIGN KEY FK_6DE44026C8121CE9');
        $this->addSql('ALTER TABLE reservation_detail DROP FOREIGN KEY FK_66F7360889312FE9');
        $this->addSql('ALTER TABLE reservation_detail DROP FOREIGN KEY FK_66F7360821B741A9');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A832C1C9');
        $this->addSql('DROP TABLE description');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_detail');
        $this->addSql('DROP TABLE user');
    }
}
