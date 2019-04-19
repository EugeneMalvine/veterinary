<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410193229 extends AbstractMigration
{
    private const ACTIONS = [
        'cfe9b56a-7265-4cc6-953a-a9f59dc112a7' => 'view_clients_for_admin',
        'a76a008d-a913-433a-be7f-844893ab7393' => 'view_pets'
    ];

    public function up(Schema $schema) : void
    {
        foreach (self::ACTIONS as $id => $namePermission) {
            $this->addSql('INSERT INTO permission (id, name) VALUES (:permission_id, :permission_name)', [
                'permission_id' => $id,
                'permission_name' => $namePermission,
            ]);
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
