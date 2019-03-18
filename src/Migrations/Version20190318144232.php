<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190318144232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_node ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE course_node_assigment DROP name');
        $this->addSql('ALTER TABLE course_node_lesson DROP name, CHANGE url url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE course_node_envelope DROP name');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_node DROP name');
        $this->addSql('ALTER TABLE course_node_assigment ADD name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE course_node_envelope ADD name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE course_node_lesson ADD name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE url url VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
