<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220122093631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sto_product ADD image_id INT NOT NULL');
        $this->addSql('ALTER TABLE sto_product ADD CONSTRAINT FK_B21FD4303DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B21FD4303DA5256D ON sto_product (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sto_product DROP FOREIGN KEY FK_B21FD4303DA5256D');
        $this->addSql('DROP INDEX UNIQ_B21FD4303DA5256D ON sto_product');
        $this->addSql('ALTER TABLE sto_product DROP image_id');
    }
}
