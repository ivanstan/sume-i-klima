<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190315090612 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE quiz_anwser (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_course_node_instance (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, course_node_instance_id INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_81313E2DA76ED395 (user_id), UNIQUE INDEX UNIQ_81313E2DFF1EA214 (course_node_instance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_instance (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetimetz)\', INDEX IDX_EB84DC88591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_instance_user (course_instance_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6614C25B4E3F42C9 (course_instance_id), INDEX IDX_6614C25BA76ED395 (user_id), PRIMARY KEY(course_instance_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node_instance (id INT AUTO_INCREMENT NOT NULL, node_id INT NOT NULL, instance_id INT NOT NULL, available_after VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:dateinterval)\', INDEX IDX_3F10ED52460D9FD7 (node_id), INDEX IDX_3F10ED523A51721D (instance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, parent_id INT DEFAULT NULL, weight INT DEFAULT NULL, available_after VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:dateinterval)\', type VARCHAR(255) NOT NULL, INDEX IDX_4DDD3543591CC992 (course_id), INDEX IDX_4DDD3543727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node_assigment (id INT NOT NULL, file_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, explanation LONGTEXT DEFAULT NULL, INDEX IDX_9992120D93CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, destination VARCHAR(255) NOT NULL, size INT NOT NULL, mime VARCHAR(255) DEFAULT NULL, INDEX IDX_8C9F3610A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node_lesson (id INT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node_envelope (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_course_node_assignment (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_question_answer (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, answer_id INT DEFAULT NULL, correct TINYINT(1) NOT NULL, INDEX IDX_E684DF7C1E27F6BF (question_id), INDEX IDX_E684DF7CAA334807 (answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, language VARCHAR(2) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_course_node_quiz (id INT NOT NULL, result_id INT DEFAULT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_9C0275757A7B643 (result_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_node_quiz (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_question (id INT AUTO_INCREMENT NOT NULL, quiz_id INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_6033B00B853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_course_node_lesson (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_course_node_envelope (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_result (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, answer_id INT DEFAULT NULL, INDEX IDX_FE2E314A1E27F6BF (question_id), INDEX IDX_FE2E314AAA334807 (answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organization (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_course_node_instance ADD CONSTRAINT FK_81313E2DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_course_node_instance ADD CONSTRAINT FK_81313E2DFF1EA214 FOREIGN KEY (course_node_instance_id) REFERENCES course_node_instance (id)');
        $this->addSql('ALTER TABLE course_instance ADD CONSTRAINT FK_EB84DC88591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_instance_user ADD CONSTRAINT FK_6614C25B4E3F42C9 FOREIGN KEY (course_instance_id) REFERENCES course_instance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_instance_user ADD CONSTRAINT FK_6614C25BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_node_instance ADD CONSTRAINT FK_3F10ED52460D9FD7 FOREIGN KEY (node_id) REFERENCES course_node (id)');
        $this->addSql('ALTER TABLE course_node_instance ADD CONSTRAINT FK_3F10ED523A51721D FOREIGN KEY (instance_id) REFERENCES course_instance (id)');
        $this->addSql('ALTER TABLE course_node ADD CONSTRAINT FK_4DDD3543591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_node ADD CONSTRAINT FK_4DDD3543727ACA70 FOREIGN KEY (parent_id) REFERENCES course_node (id)');
        $this->addSql('ALTER TABLE course_node_assigment ADD CONSTRAINT FK_9992120D93CB796C FOREIGN KEY (file_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE course_node_assigment ADD CONSTRAINT FK_9992120DBF396750 FOREIGN KEY (id) REFERENCES course_node (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE course_node_lesson ADD CONSTRAINT FK_38085182BF396750 FOREIGN KEY (id) REFERENCES course_node (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_node_envelope ADD CONSTRAINT FK_F7B524E4BF396750 FOREIGN KEY (id) REFERENCES course_node (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_course_node_assignment ADD CONSTRAINT FK_7253AB74BF396750 FOREIGN KEY (id) REFERENCES user_course_node_instance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_question_answer ADD CONSTRAINT FK_E684DF7C1E27F6BF FOREIGN KEY (question_id) REFERENCES quiz_question (id)');
        $this->addSql('ALTER TABLE quiz_question_answer ADD CONSTRAINT FK_E684DF7CAA334807 FOREIGN KEY (answer_id) REFERENCES quiz_anwser (id)');
        $this->addSql('ALTER TABLE user_course_node_quiz ADD CONSTRAINT FK_9C0275757A7B643 FOREIGN KEY (result_id) REFERENCES quiz_result (id)');
        $this->addSql('ALTER TABLE user_course_node_quiz ADD CONSTRAINT FK_9C027575BF396750 FOREIGN KEY (id) REFERENCES user_course_node_instance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_node_quiz ADD CONSTRAINT FK_E11737A8BF396750 FOREIGN KEY (id) REFERENCES course_node (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_question ADD CONSTRAINT FK_6033B00B853CD175 FOREIGN KEY (quiz_id) REFERENCES course_node_quiz (id)');
        $this->addSql('ALTER TABLE user_course_node_lesson ADD CONSTRAINT FK_944CB779BF396750 FOREIGN KEY (id) REFERENCES user_course_node_instance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_course_node_envelope ADD CONSTRAINT FK_4994F79BBF396750 FOREIGN KEY (id) REFERENCES user_course_node_instance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_result ADD CONSTRAINT FK_FE2E314A1E27F6BF FOREIGN KEY (question_id) REFERENCES quiz_question (id)');
        $this->addSql('ALTER TABLE quiz_result ADD CONSTRAINT FK_FE2E314AAA334807 FOREIGN KEY (answer_id) REFERENCES quiz_anwser (id)');
        $this->addSql('ALTER TABLE user ADD organization_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64932C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8D93D64932C8A3DE ON user (organization_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quiz_question_answer DROP FOREIGN KEY FK_E684DF7CAA334807');
        $this->addSql('ALTER TABLE quiz_result DROP FOREIGN KEY FK_FE2E314AAA334807');
        $this->addSql('ALTER TABLE user_course_node_assignment DROP FOREIGN KEY FK_7253AB74BF396750');
        $this->addSql('ALTER TABLE user_course_node_quiz DROP FOREIGN KEY FK_9C027575BF396750');
        $this->addSql('ALTER TABLE user_course_node_lesson DROP FOREIGN KEY FK_944CB779BF396750');
        $this->addSql('ALTER TABLE user_course_node_envelope DROP FOREIGN KEY FK_4994F79BBF396750');
        $this->addSql('ALTER TABLE course_instance_user DROP FOREIGN KEY FK_6614C25B4E3F42C9');
        $this->addSql('ALTER TABLE course_node_instance DROP FOREIGN KEY FK_3F10ED523A51721D');
        $this->addSql('ALTER TABLE user_course_node_instance DROP FOREIGN KEY FK_81313E2DFF1EA214');
        $this->addSql('ALTER TABLE course_node_instance DROP FOREIGN KEY FK_3F10ED52460D9FD7');
        $this->addSql('ALTER TABLE course_node DROP FOREIGN KEY FK_4DDD3543727ACA70');
        $this->addSql('ALTER TABLE course_node_assigment DROP FOREIGN KEY FK_9992120DBF396750');
        $this->addSql('ALTER TABLE course_node_lesson DROP FOREIGN KEY FK_38085182BF396750');
        $this->addSql('ALTER TABLE course_node_envelope DROP FOREIGN KEY FK_F7B524E4BF396750');
        $this->addSql('ALTER TABLE course_node_quiz DROP FOREIGN KEY FK_E11737A8BF396750');
        $this->addSql('ALTER TABLE course_node_assigment DROP FOREIGN KEY FK_9992120D93CB796C');
        $this->addSql('ALTER TABLE course_instance DROP FOREIGN KEY FK_EB84DC88591CC992');
        $this->addSql('ALTER TABLE course_node DROP FOREIGN KEY FK_4DDD3543591CC992');
        $this->addSql('ALTER TABLE quiz_question DROP FOREIGN KEY FK_6033B00B853CD175');
        $this->addSql('ALTER TABLE quiz_question_answer DROP FOREIGN KEY FK_E684DF7C1E27F6BF');
        $this->addSql('ALTER TABLE quiz_result DROP FOREIGN KEY FK_FE2E314A1E27F6BF');
        $this->addSql('ALTER TABLE user_course_node_quiz DROP FOREIGN KEY FK_9C0275757A7B643');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64932C8A3DE');
        $this->addSql('DROP TABLE quiz_anwser');
        $this->addSql('DROP TABLE user_course_node_instance');
        $this->addSql('DROP TABLE course_instance');
        $this->addSql('DROP TABLE course_instance_user');
        $this->addSql('DROP TABLE course_node_instance');
        $this->addSql('DROP TABLE course_node');
        $this->addSql('DROP TABLE course_node_assigment');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE course_node_lesson');
        $this->addSql('DROP TABLE course_node_envelope');
        $this->addSql('DROP TABLE user_course_node_assignment');
        $this->addSql('DROP TABLE quiz_question_answer');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE user_course_node_quiz');
        $this->addSql('DROP TABLE course_node_quiz');
        $this->addSql('DROP TABLE quiz_question');
        $this->addSql('DROP TABLE user_course_node_lesson');
        $this->addSql('DROP TABLE user_course_node_envelope');
        $this->addSql('DROP TABLE quiz_result');
        $this->addSql('DROP TABLE organization');
        $this->addSql('DROP INDEX IDX_8D93D64932C8A3DE ON user');
        $this->addSql('ALTER TABLE user DROP organization_id');
    }
}
