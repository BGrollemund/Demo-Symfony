<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115154400 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE renting_pool (id INT AUTO_INCREMENT NOT NULL, renting_id INT NOT NULL, pool_id INT NOT NULL, num_guests INT NOT NULL, INDEX IDX_C50CD82EEC8CFBAF (renting_id), INDEX IDX_C50CD82E7B3406DF (pool_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE renting_tax (id INT AUTO_INCREMENT NOT NULL, renting_id INT NOT NULL, tax_id INT NOT NULL, num_guests INT NOT NULL, INDEX IDX_A3D0E067EC8CFBAF (renting_id), INDEX IDX_A3D0E067B2A824D8 (tax_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE renting_pool ADD CONSTRAINT FK_C50CD82EEC8CFBAF FOREIGN KEY (renting_id) REFERENCES rentings (id)');
        $this->addSql('ALTER TABLE renting_pool ADD CONSTRAINT FK_C50CD82E7B3406DF FOREIGN KEY (pool_id) REFERENCES prices_pool (id)');
        $this->addSql('ALTER TABLE renting_tax ADD CONSTRAINT FK_A3D0E067EC8CFBAF FOREIGN KEY (renting_id) REFERENCES rentings (id)');
        $this->addSql('ALTER TABLE renting_tax ADD CONSTRAINT FK_A3D0E067B2A824D8 FOREIGN KEY (tax_id) REFERENCES prices_tax (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE renting_pool');
        $this->addSql('DROP TABLE renting_tax');
    }
}
