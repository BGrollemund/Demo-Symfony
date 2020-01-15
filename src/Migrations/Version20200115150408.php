<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115150408 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bookings ADD renting_id INT NOT NULL, ADD guest_id INT NOT NULL');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35EC8CFBAF FOREIGN KEY (renting_id) REFERENCES rentings (id)');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C359A4AA658 FOREIGN KEY (guest_id) REFERENCES guests (id)');
        $this->addSql('CREATE INDEX IDX_7A853C35EC8CFBAF ON bookings (renting_id)');
        $this->addSql('CREATE INDEX IDX_7A853C359A4AA658 ON bookings (guest_id)');
        $this->addSql('ALTER TABLE media ADD rentings_id INT DEFAULT NULL, ADD renting_types_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CA1F48FA7 FOREIGN KEY (rentings_id) REFERENCES rentings (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C3AD67CCB FOREIGN KEY (renting_types_id) REFERENCES renting_types (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CA1F48FA7 ON media (rentings_id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C3AD67CCB ON media (renting_types_id)');
        $this->addSql('ALTER TABLE pdfs_booking ADD booking_id INT NOT NULL');
        $this->addSql('ALTER TABLE pdfs_booking ADD CONSTRAINT FK_5B23FACC3301C60 FOREIGN KEY (booking_id) REFERENCES bookings (id)');
        $this->addSql('CREATE INDEX IDX_5B23FACC3301C60 ON pdfs_booking (booking_id)');
        $this->addSql('ALTER TABLE pdfs_renter ADD renter_id INT NOT NULL');
        $this->addSql('ALTER TABLE pdfs_renter ADD CONSTRAINT FK_AC2A2BAFE289A545 FOREIGN KEY (renter_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_AC2A2BAFE289A545 ON pdfs_renter (renter_id)');
        $this->addSql('ALTER TABLE rentings ADD renting_type_id INT NOT NULL, ADD renter_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE rentings ADD CONSTRAINT FK_8BA281A6AABD276F FOREIGN KEY (renting_type_id) REFERENCES renting_types (id)');
        $this->addSql('ALTER TABLE rentings ADD CONSTRAINT FK_8BA281A67B436FE5 FOREIGN KEY (renter_type_id) REFERENCES renter_types (id)');
        $this->addSql('CREATE INDEX IDX_8BA281A6AABD276F ON rentings (renting_type_id)');
        $this->addSql('CREATE INDEX IDX_8BA281A67B436FE5 ON rentings (renter_type_id)');
        $this->addSql('ALTER TABLE users ADD role_id INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9D60322AC ON users (role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C35EC8CFBAF');
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C359A4AA658');
        $this->addSql('DROP INDEX IDX_7A853C35EC8CFBAF ON bookings');
        $this->addSql('DROP INDEX IDX_7A853C359A4AA658 ON bookings');
        $this->addSql('ALTER TABLE bookings DROP renting_id, DROP guest_id');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CA1F48FA7');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C3AD67CCB');
        $this->addSql('DROP INDEX IDX_6A2CA10CA1F48FA7 ON media');
        $this->addSql('DROP INDEX IDX_6A2CA10C3AD67CCB ON media');
        $this->addSql('ALTER TABLE media DROP rentings_id, DROP renting_types_id');
        $this->addSql('ALTER TABLE pdfs_booking DROP FOREIGN KEY FK_5B23FACC3301C60');
        $this->addSql('DROP INDEX IDX_5B23FACC3301C60 ON pdfs_booking');
        $this->addSql('ALTER TABLE pdfs_booking DROP booking_id');
        $this->addSql('ALTER TABLE pdfs_renter DROP FOREIGN KEY FK_AC2A2BAFE289A545');
        $this->addSql('DROP INDEX IDX_AC2A2BAFE289A545 ON pdfs_renter');
        $this->addSql('ALTER TABLE pdfs_renter DROP renter_id');
        $this->addSql('ALTER TABLE rentings DROP FOREIGN KEY FK_8BA281A6AABD276F');
        $this->addSql('ALTER TABLE rentings DROP FOREIGN KEY FK_8BA281A67B436FE5');
        $this->addSql('DROP INDEX IDX_8BA281A6AABD276F ON rentings');
        $this->addSql('DROP INDEX IDX_8BA281A67B436FE5 ON rentings');
        $this->addSql('ALTER TABLE rentings DROP renting_type_id, DROP renter_type_id');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9D60322AC');
        $this->addSql('DROP INDEX IDX_1483A5E9D60322AC ON users');
        $this->addSql('ALTER TABLE users DROP role_id');
    }
}
