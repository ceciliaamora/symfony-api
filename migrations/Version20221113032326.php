<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221113032326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE start_date_time start_date_time DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE end_date_time end_date_time DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE lecture CHANGE date date DATE DEFAULT NULL, CHANGE start_time start_time TIME DEFAULT NULL, CHANGE end_time end_time TIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE start_date_time start_date_time DATETIME DEFAULT NULL, CHANGE end_date_time end_date_time DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE lecture CHANGE date date DATE NOT NULL, CHANGE start_time start_time TIME NOT NULL, CHANGE end_time end_time TIME NOT NULL');
    }
}
