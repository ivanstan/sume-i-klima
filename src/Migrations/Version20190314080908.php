<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190314080908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE course_node_envelope (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node_lesson (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, parent_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_4DDD3543591CC992 (course_id), INDEX IDX_4DDD3543727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, language VARCHAR(2) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node_assigment (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organization (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node_quiz (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_node_envelope ADD CONSTRAINT FK_F7B524E4BF396750 FOREIGN KEY (id) REFERENCES course_node (id)');
        $this->addSql('ALTER TABLE course_node_lesson ADD CONSTRAINT FK_38085182BF396750 FOREIGN KEY (id) REFERENCES course_node (id)');
        $this->addSql('ALTER TABLE course_node ADD CONSTRAINT FK_4DDD3543591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_node ADD CONSTRAINT FK_4DDD3543727ACA70 FOREIGN KEY (parent_id) REFERENCES course_node (id)');
        $this->addSql('ALTER TABLE course_node_assigment ADD CONSTRAINT FK_9992120DBF396750 FOREIGN KEY (id) REFERENCES course_node (id)');
        $this->addSql('ALTER TABLE course_node_quiz ADD CONSTRAINT FK_E11737A8BF396750 FOREIGN KEY (id) REFERENCES course_node (id)');
        $this->addSql('ALTER TABLE user ADD organization_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64932C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8D93D64932C8A3DE ON user (organization_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_node_envelope DROP FOREIGN KEY FK_F7B524E4BF396750');
        $this->addSql('ALTER TABLE course_node_lesson DROP FOREIGN KEY FK_38085182BF396750');
        $this->addSql('ALTER TABLE course_node DROP FOREIGN KEY FK_4DDD3543727ACA70');
        $this->addSql('ALTER TABLE course_node_assigment DROP FOREIGN KEY FK_9992120DBF396750');
        $this->addSql('ALTER TABLE course_node_quiz DROP FOREIGN KEY FK_E11737A8BF396750');
        $this->addSql('ALTER TABLE course_node DROP FOREIGN KEY FK_4DDD3543591CC992');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64932C8A3DE');
        $this->addSql('DROP TABLE course_node_envelope');
        $this->addSql('DROP TABLE course_node_lesson');
        $this->addSql('DROP TABLE course_node');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_node_assigment');
        $this->addSql('DROP TABLE organization');
        $this->addSql('DROP TABLE course_node_quiz');
        $this->addSql('DROP INDEX IDX_8D93D64932C8A3DE ON user');
        $this->addSql('ALTER TABLE user DROP organization_id');
    }
}
