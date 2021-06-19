<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210327104632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, img LONGTEXT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bac (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE field_activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE field_study (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, domain VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, department INT NOT NULL, city VARCHAR(255) NOT NULL, salary INT DEFAULT NULL, description LONGTEXT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone INT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salary (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, bac INT NOT NULL, type VARCHAR(255) NOT NULL, alternance TINYINT(1) NOT NULL, department INT NOT NULL, city VARCHAR(255) NOT NULL, domain VARCHAR(255) NOT NULL, INDEX IDX_D5128A8FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, bac_id INT DEFAULT NULL, salary_id INT DEFAULT NULL, field_activity_id INT DEFAULT NULL, field_study_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, promo INT DEFAULT NULL, is_educ TINYINT(1) NOT NULL, linkedin LONGTEXT DEFAULT NULL, instagram LONGTEXT DEFAULT NULL, portfolio LONGTEXT DEFAULT NULL, facebook LONGTEXT DEFAULT NULL, job VARCHAR(255) DEFAULT NULL, zone_activity VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, behance LONGTEXT DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, best_degree VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649E03F15C0 (bac_id), INDEX IDX_8D93D649B0FDF16E (salary_id), INDEX IDX_8D93D6494477D341 (field_activity_id), INDEX IDX_8D93D64931888424 (field_study_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E03F15C0 FOREIGN KEY (bac_id) REFERENCES bac (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B0FDF16E FOREIGN KEY (salary_id) REFERENCES salary (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494477D341 FOREIGN KEY (field_activity_id) REFERENCES field_activity (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64931888424 FOREIGN KEY (field_study_id) REFERENCES field_study (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E03F15C0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494477D341');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64931888424');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B0FDF16E');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8FA76ED395');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE bac');
        $this->addSql('DROP TABLE field_activity');
        $this->addSql('DROP TABLE field_study');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE salary');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
    }
}
