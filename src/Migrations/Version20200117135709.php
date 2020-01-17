<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200117135709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bookings (id INT AUTO_INCREMENT NOT NULL, renting_id INT NOT NULL, guest_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_7A853C35EC8CFBAF (renting_id), INDEX IDX_7A853C359A4AA658 (guest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount (id INT AUTO_INCREMENT NOT NULL, num_days INT NOT NULL, percent INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guests (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(150) NOT NULL, first_name VARCHAR(150) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, rentings_id INT DEFAULT NULL, renting_types_id INT DEFAULT NULL, file_name VARCHAR(255) NOT NULL, INDEX IDX_6A2CA10CA1F48FA7 (rentings_id), INDEX IDX_6A2CA10C3AD67CCB (renting_types_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pdfs_booking (id INT AUTO_INCREMENT NOT NULL, booking_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_5B23FACC3301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pdfs_renter (id INT AUTO_INCREMENT NOT NULL, renter_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_AC2A2BAFE289A545 (renter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prices_pool (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prices_tax (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE renter_types (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE renting_pool (id INT AUTO_INCREMENT NOT NULL, renting_id INT NOT NULL, pool_id INT NOT NULL, num_guests INT NOT NULL, INDEX IDX_C50CD82EEC8CFBAF (renting_id), INDEX IDX_C50CD82E7B3406DF (pool_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rentings (id INT AUTO_INCREMENT NOT NULL, renting_type_id INT NOT NULL, renter_type_id INT NOT NULL, label VARCHAR(100) NOT NULL, INDEX IDX_8BA281A6AABD276F (renting_type_id), INDEX IDX_8BA281A67B436FE5 (renter_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rentings_users (rentings_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_D77A074BA1F48FA7 (rentings_id), INDEX IDX_D77A074B67B3B43D (users_id), PRIMARY KEY(rentings_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE renting_tax (id INT AUTO_INCREMENT NOT NULL, renting_id INT NOT NULL, tax_id INT NOT NULL, num_guests INT NOT NULL, INDEX IDX_A3D0E067EC8CFBAF (renting_id), INDEX IDX_A3D0E067B2A824D8 (tax_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE renting_types (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seasons (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, percent INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_1483A5E9D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35EC8CFBAF FOREIGN KEY (renting_id) REFERENCES rentings (id)');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C359A4AA658 FOREIGN KEY (guest_id) REFERENCES guests (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CA1F48FA7 FOREIGN KEY (rentings_id) REFERENCES rentings (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C3AD67CCB FOREIGN KEY (renting_types_id) REFERENCES renting_types (id)');
        $this->addSql('ALTER TABLE pdfs_booking ADD CONSTRAINT FK_5B23FACC3301C60 FOREIGN KEY (booking_id) REFERENCES bookings (id)');
        $this->addSql('ALTER TABLE pdfs_renter ADD CONSTRAINT FK_AC2A2BAFE289A545 FOREIGN KEY (renter_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE renting_pool ADD CONSTRAINT FK_C50CD82EEC8CFBAF FOREIGN KEY (renting_id) REFERENCES rentings (id)');
        $this->addSql('ALTER TABLE renting_pool ADD CONSTRAINT FK_C50CD82E7B3406DF FOREIGN KEY (pool_id) REFERENCES prices_pool (id)');
        $this->addSql('ALTER TABLE rentings ADD CONSTRAINT FK_8BA281A6AABD276F FOREIGN KEY (renting_type_id) REFERENCES renting_types (id)');
        $this->addSql('ALTER TABLE rentings ADD CONSTRAINT FK_8BA281A67B436FE5 FOREIGN KEY (renter_type_id) REFERENCES renter_types (id)');
        $this->addSql('ALTER TABLE rentings_users ADD CONSTRAINT FK_D77A074BA1F48FA7 FOREIGN KEY (rentings_id) REFERENCES rentings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rentings_users ADD CONSTRAINT FK_D77A074B67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE renting_tax ADD CONSTRAINT FK_A3D0E067EC8CFBAF FOREIGN KEY (renting_id) REFERENCES rentings (id)');
        $this->addSql('ALTER TABLE renting_tax ADD CONSTRAINT FK_A3D0E067B2A824D8 FOREIGN KEY (tax_id) REFERENCES prices_tax (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pdfs_booking DROP FOREIGN KEY FK_5B23FACC3301C60');
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C359A4AA658');
        $this->addSql('ALTER TABLE renting_pool DROP FOREIGN KEY FK_C50CD82E7B3406DF');
        $this->addSql('ALTER TABLE renting_tax DROP FOREIGN KEY FK_A3D0E067B2A824D8');
        $this->addSql('ALTER TABLE rentings DROP FOREIGN KEY FK_8BA281A67B436FE5');
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C35EC8CFBAF');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CA1F48FA7');
        $this->addSql('ALTER TABLE renting_pool DROP FOREIGN KEY FK_C50CD82EEC8CFBAF');
        $this->addSql('ALTER TABLE rentings_users DROP FOREIGN KEY FK_D77A074BA1F48FA7');
        $this->addSql('ALTER TABLE renting_tax DROP FOREIGN KEY FK_A3D0E067EC8CFBAF');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C3AD67CCB');
        $this->addSql('ALTER TABLE rentings DROP FOREIGN KEY FK_8BA281A6AABD276F');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9D60322AC');
        $this->addSql('ALTER TABLE pdfs_renter DROP FOREIGN KEY FK_AC2A2BAFE289A545');
        $this->addSql('ALTER TABLE rentings_users DROP FOREIGN KEY FK_D77A074B67B3B43D');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE guests');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE pdfs_booking');
        $this->addSql('DROP TABLE pdfs_renter');
        $this->addSql('DROP TABLE prices_pool');
        $this->addSql('DROP TABLE prices_tax');
        $this->addSql('DROP TABLE renter_types');
        $this->addSql('DROP TABLE renting_pool');
        $this->addSql('DROP TABLE rentings');
        $this->addSql('DROP TABLE rentings_users');
        $this->addSql('DROP TABLE renting_tax');
        $this->addSql('DROP TABLE renting_types');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE seasons');
        $this->addSql('DROP TABLE users');
    }
}
