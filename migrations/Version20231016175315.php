<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231016175315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON author');
        $this->addSql('ALTER TABLE author ADD cin INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE author ADD PRIMARY KEY (cin)');
        $this->addSql('ALTER TABLE book MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON book');
        $this->addSql('ALTER TABLE book ADD reference INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE book ADD PRIMARY KEY (reference)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author ADD id INT AUTO_INCREMENT NOT NULL, DROP cin, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE book ADD id INT AUTO_INCREMENT NOT NULL, DROP reference, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
