<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205160340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__album AS SELECT id, artiste_id, title, date FROM album');
        $this->addSql('DROP TABLE album');
        $this->addSql('CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, artiste_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, CONSTRAINT FK_39986E4321D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO album (id, artiste_id, title, date) SELECT id, artiste_id, title, date FROM __temp__album');
        $this->addSql('DROP TABLE __temp__album');
        $this->addSql('CREATE INDEX IDX_39986E4321D25844 ON album (artiste_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__song AS SELECT id, album_id, title, length FROM song');
        $this->addSql('DROP TABLE song');
        $this->addSql('CREATE TABLE song (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, album_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, length INTEGER NOT NULL, CONSTRAINT FK_33EDEEA11137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO song (id, album_id, title, length) SELECT id, album_id, title, length FROM __temp__song');
        $this->addSql('DROP TABLE __temp__song');
        $this->addSql('CREATE INDEX IDX_33EDEEA11137ABCF ON song (album_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__album AS SELECT id, artiste_id, title, date FROM album');
        $this->addSql('DROP TABLE album');
        $this->addSql('CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, artiste_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, CONSTRAINT FK_39986E4321D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO album (id, artiste_id, title, date) SELECT id, artiste_id, title, date FROM __temp__album');
        $this->addSql('DROP TABLE __temp__album');
        $this->addSql('CREATE INDEX IDX_39986E4321D25844 ON album (artiste_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__song AS SELECT id, album_id, title, length FROM song');
        $this->addSql('DROP TABLE song');
        $this->addSql('CREATE TABLE song (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, album_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, length INTEGER NOT NULL, CONSTRAINT FK_33EDEEA11137ABCF FOREIGN KEY (album_id) REFERENCES album (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO song (id, album_id, title, length) SELECT id, album_id, title, length FROM __temp__song');
        $this->addSql('DROP TABLE __temp__song');
        $this->addSql('CREATE INDEX IDX_33EDEEA11137ABCF ON song (album_id)');
    }
}
