<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190408174609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users_permissons (user_id INT NOT NULL, permission_id VARCHAR(255) NOT NULL, INDEX IDX_49B21C14A76ED395 (user_id), INDEX IDX_49B21C14FED90CCA (permission_id), PRIMARY KEY(user_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_permissons ADD CONSTRAINT FK_49B21C14A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE users_permissons ADD CONSTRAINT FK_49B21C14FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id)');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(255) NOT NULL, CHANGE surname surname VARCHAR(255) NOT NULL, CHANGE phone phone VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_permissons DROP FOREIGN KEY FK_49B21C14FED90CCA');
        $this->addSql('DROP TABLE users_permissons');
        $this->addSql('DROP TABLE permission');
        $this->addSql('ALTER TABLE user CHANGE name name LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE surname surname LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE phone phone LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
