<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221113035221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C16779483E5F2F7B');
        $this->addSql('DROP INDEX IDX_C16779483E5F2F7B ON lecture');
        $this->addSql('ALTER TABLE lecture CHANGE event_id_id event_id INT NOT NULL');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C167794871F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_C167794871F7E88B ON lecture (event_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C167794871F7E88B');
        $this->addSql('DROP INDEX IDX_C167794871F7E88B ON lecture');
        $this->addSql('ALTER TABLE lecture CHANGE event_id event_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C16779483E5F2F7B FOREIGN KEY (event_id_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_C16779483E5F2F7B ON lecture (event_id_id)');
    }
}
