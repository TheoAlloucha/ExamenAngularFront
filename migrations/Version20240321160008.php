<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321160008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, voyage_id INT DEFAULT NULL, src VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, INDEX IDX_C53D045F68C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, main_picture_id INT DEFAULT NULL, destination VARCHAR(255) NOT NULL, lattitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, nb_star INT NOT NULL, UNIQUE INDEX UNIQ_3F9D8955D6BDC9DC (main_picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955D6BDC9DC FOREIGN KEY (main_picture_id) REFERENCES image (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F68C9E5AF');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955D6BDC9DC');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voyage');
    }
}
