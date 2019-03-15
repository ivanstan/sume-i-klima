<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190315124013 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_node DROP FOREIGN KEY FK_4DDD3543727ACA70');
        $this->addSql('ALTER TABLE course_node ADD CONSTRAINT FK_4DDD3543727ACA70 FOREIGN KEY (parent_id) REFERENCES course_node (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_node DROP FOREIGN KEY FK_4DDD3543727ACA70');
        $this->addSql('ALTER TABLE course_node ADD CONSTRAINT FK_4DDD3543727ACA70 FOREIGN KEY (parent_id) REFERENCES course_node (id)');
    }
}
