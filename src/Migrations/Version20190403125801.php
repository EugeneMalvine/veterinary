<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403125801 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP email, DROP phone, DROP name, DROP surname, CHANGE login login VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10 ON user');
        $this->addSql('ALTER TABLE user ADD email LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD phone LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD name LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD surname LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, DROP roles, CHANGE login login LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE password password LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
