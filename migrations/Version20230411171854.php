<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230411171854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_details DROP FOREIGN KEY FK_15B3B00F193171E9');
        $this->addSql('DROP TABLE reservation_details');
        $this->addSql('ALTER TABLE reservation ADD name VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD phone INT NOT NULL, ADD guests INT NOT NULL, ADD time TIME NOT NULL, ADD allergy VARCHAR(255) NOT NULL, CHANGE created_at date DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_details (id INT AUTO_INCREMENT NOT NULL, my_reservation_id INT NOT NULL, date DATETIME NOT NULL, hour DATETIME NOT NULL, num_people INT NOT NULL, allergy VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_15B3B00F193171E9 (my_reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservation_details ADD CONSTRAINT FK_15B3B00F193171E9 FOREIGN KEY (my_reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE reservation DROP name, DROP email, DROP phone, DROP guests, DROP time, DROP allergy, CHANGE date created_at DATETIME NOT NULL');
    }
}
