<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190314083848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_course_node_instance (node_id INT NOT NULL, instance_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_81313E2D460D9FD7 (node_id), INDEX IDX_81313E2D3A51721D (instance_id), INDEX IDX_81313E2DA76ED395 (user_id), PRIMARY KEY(node_id, instance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_course_node_instance ADD CONSTRAINT FK_81313E2D460D9FD7 FOREIGN KEY (node_id) REFERENCES course_node (id)');
        $this->addSql('ALTER TABLE user_course_node_instance ADD CONSTRAINT FK_81313E2D3A51721D FOREIGN KEY (instance_id) REFERENCES course_instance (id)');
        $this->addSql('ALTER TABLE user_course_node_instance ADD CONSTRAINT FK_81313E2DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_course_node_instance');
    }
}
