<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115153455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rentings_users (rentings_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_D77A074BA1F48FA7 (rentings_id), INDEX IDX_D77A074B67B3B43D (users_id), PRIMARY KEY(rentings_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rentings_users ADD CONSTRAINT FK_D77A074BA1F48FA7 FOREIGN KEY (rentings_id) REFERENCES rentings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rentings_users ADD CONSTRAINT FK_D77A074B67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rentings_users');
    }
}
