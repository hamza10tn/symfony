<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231016182241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD cin_auth INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331744F2872 FOREIGN KEY (cin_auth) REFERENCES author (cin)');
        $this->addSql('CREATE INDEX IDX_CBE5A331744F2872 ON book (cin_auth)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331744F2872');
        $this->addSql('DROP INDEX IDX_CBE5A331744F2872 ON book');
        $this->addSql('ALTER TABLE book DROP cin_auth');
    }
}
