<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190314083328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE course_instance (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, INDEX IDX_EB84DC88591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_instance_user (course_instance_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6614C25B4E3F42C9 (course_instance_id), INDEX IDX_6614C25BA76ED395 (user_id), PRIMARY KEY(course_instance_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node_instance (node_id INT NOT NULL, instance_id INT NOT NULL, INDEX IDX_3F10ED52460D9FD7 (node_id), INDEX IDX_3F10ED523A51721D (instance_id), PRIMARY KEY(node_id, instance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_instance ADD CONSTRAINT FK_EB84DC88591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_instance_user ADD CONSTRAINT FK_6614C25B4E3F42C9 FOREIGN KEY (course_instance_id) REFERENCES course_instance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_instance_user ADD CONSTRAINT FK_6614C25BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_node_instance ADD CONSTRAINT FK_3F10ED52460D9FD7 FOREIGN KEY (node_id) REFERENCES course_node (id)');
        $this->addSql('ALTER TABLE course_node_instance ADD CONSTRAINT FK_3F10ED523A51721D FOREIGN KEY (instance_id) REFERENCES course_instance (id)');
        $this->addSql('ALTER TABLE course_node_envelope ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE course_node ADD weight INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_instance_user DROP FOREIGN KEY FK_6614C25B4E3F42C9');
        $this->addSql('ALTER TABLE course_node_instance DROP FOREIGN KEY FK_3F10ED523A51721D');
        $this->addSql('DROP TABLE course_instance');
        $this->addSql('DROP TABLE course_instance_user');
        $this->addSql('DROP TABLE course_node_instance');
        $this->addSql('ALTER TABLE course_node DROP weight');
        $this->addSql('ALTER TABLE course_node_envelope DROP name');
    }
}
