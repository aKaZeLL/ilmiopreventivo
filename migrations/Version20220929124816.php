<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929124816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE preventivo (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_A52D7F6BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE preventivo ADD CONSTRAINT FK_A52D7F6BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lavori ADD preventivo_id INT NOT NULL');
        $this->addSql('ALTER TABLE lavori ADD CONSTRAINT FK_4E1E81AACFBBD818 FOREIGN KEY (preventivo_id) REFERENCES preventivo (id)');
        $this->addSql('CREATE INDEX IDX_4E1E81AACFBBD818 ON lavori (preventivo_id)');
        $this->addSql('ALTER TABLE materiali_arredi ADD preventivo_id INT NOT NULL');
        $this->addSql('ALTER TABLE materiali_arredi ADD CONSTRAINT FK_40A6BEA6CFBBD818 FOREIGN KEY (preventivo_id) REFERENCES preventivo (id)');
        $this->addSql('CREATE INDEX IDX_40A6BEA6CFBBD818 ON materiali_arredi (preventivo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lavori DROP FOREIGN KEY FK_4E1E81AACFBBD818');
        $this->addSql('ALTER TABLE materiali_arredi DROP FOREIGN KEY FK_40A6BEA6CFBBD818');
        $this->addSql('ALTER TABLE preventivo DROP FOREIGN KEY FK_A52D7F6BA76ED395');
        $this->addSql('DROP TABLE preventivo');
        $this->addSql('DROP INDEX IDX_4E1E81AACFBBD818 ON lavori');
        $this->addSql('ALTER TABLE lavori DROP preventivo_id');
        $this->addSql('DROP INDEX IDX_40A6BEA6CFBBD818 ON materiali_arredi');
        $this->addSql('ALTER TABLE materiali_arredi DROP preventivo_id');
    }
}
