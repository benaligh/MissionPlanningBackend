<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201021202811 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission ADD livreur_id INT DEFAULT NULL, ADD moto_id INT DEFAULT NULL, ADD adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CF8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C78B8F2AC FOREIGN KEY (moto_id) REFERENCES moto (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C8486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('CREATE INDEX IDX_9067F23CF8646701 ON mission (livreur_id)');
        $this->addSql('CREATE INDEX IDX_9067F23C78B8F2AC ON mission (moto_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9067F23C8486F9AC ON mission (adress_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CF8646701');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C78B8F2AC');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C8486F9AC');
        $this->addSql('DROP INDEX IDX_9067F23CF8646701 ON mission');
        $this->addSql('DROP INDEX IDX_9067F23C78B8F2AC ON mission');
        $this->addSql('DROP INDEX UNIQ_9067F23C8486F9AC ON mission');
        $this->addSql('ALTER TABLE mission DROP livreur_id, DROP moto_id, DROP adress_id');
    }
}
