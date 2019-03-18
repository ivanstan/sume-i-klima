<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190318133846 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_instance ADD timezone VARCHAR(255) NOT NULL, CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE course_node_assigment CHANGE explanation content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz_answer ADD content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz_question ADD content LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_instance DROP timezone, CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE course_node_assigment CHANGE content explanation LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE quiz_answer DROP content');
        $this->addSql('ALTER TABLE quiz_question DROP content');
    }
}
