<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190408192920 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO permission (id, name) VALUES (:permission_id, :permission_name)', [
            'permission_id' => 'e7012425-63b6-4b12-a5bb-6da6cdf2bfc7',
            'permission_name' => 'create_client',
        ]);
        $this->addSql('INSERT INTO permission (id, name) VALUES (:permission_id, :permission_name)', [
            'permission_id' => '6f87c711-6822-46cd-abce-a4ba979820c5',
            'permission_name' => 'edit_client',
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
