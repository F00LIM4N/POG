<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227105638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game RENAME INDEX idx_232b318c801b966a TO IDX_232B318CD0C07AFF');
        $this->addSql('ALTER TABLE room ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_729F519BA76ED395 ON room (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC ON user');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD token VARCHAR(255) NOT NULL, ADD pseudo VARCHAR(255) NOT NULL, ADD description LONGTEXT DEFAULT NULL, ADD picture LONGTEXT DEFAULT NULL, DROP role_id, DROP lastname_user, DROP firstname_user, DROP email_user, DROP password_user, DROP token_user, DROP pseudo_user, DROP description_user, DROP picture_user, CHANGE date_birth_user date_birth DATE NOT NULL, CHANGE phone_user phone VARCHAR(20) DEFAULT NULL, CHANGE secu_enabled_user secu_enabled TINYINT(1) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game RENAME INDEX idx_232b318cd0c07aff TO IDX_232B318C801B966A');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BA76ED395');
        $this->addSql('DROP INDEX IDX_729F519BA76ED395 ON room');
        $this->addSql('ALTER TABLE room DROP user_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD role_id INT NOT NULL, ADD lastname_user VARCHAR(255) NOT NULL, ADD firstname_user VARCHAR(255) NOT NULL, ADD email_user VARCHAR(255) NOT NULL, ADD password_user VARCHAR(255) NOT NULL, ADD token_user VARCHAR(255) NOT NULL, ADD pseudo_user VARCHAR(255) NOT NULL, ADD description_user LONGTEXT DEFAULT NULL, ADD picture_user LONGTEXT DEFAULT NULL, DROP email, DROP roles, DROP password, DROP lastname, DROP firstname, DROP token, DROP pseudo, DROP description, DROP picture, CHANGE date_birth date_birth_user DATE NOT NULL, CHANGE phone phone_user VARCHAR(20) DEFAULT NULL, CHANGE secu_enabled secu_enabled_user TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
    }
}
