<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180706172735 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE word_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE example_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE word (id INT NOT NULL, word VARCHAR(255) NOT NULL, definition TEXT NOT NULL, speech_part VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE example (id INT NOT NULL, word_id INT NOT NULL, sentence TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6EEC9B9FE357438D ON example (word_id)');
        $this->addSql('ALTER TABLE example ADD CONSTRAINT FK_6EEC9B9FE357438D FOREIGN KEY (word_id) REFERENCES word (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE example DROP CONSTRAINT FK_6EEC9B9FE357438D');
        $this->addSql('DROP SEQUENCE word_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE example_id_seq CASCADE');
        $this->addSql('DROP TABLE word');
        $this->addSql('DROP TABLE example');
    }
}
