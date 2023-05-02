<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230419174152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergies ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE allergies ADD CONSTRAINT FK_8D19BF1BB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_8D19BF1BB83297E7 ON allergies (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergies DROP FOREIGN KEY FK_8D19BF1BB83297E7');
        $this->addSql('DROP INDEX IDX_8D19BF1BB83297E7 ON allergies');
        $this->addSql('ALTER TABLE allergies DROP reservation_id');
    }
}
