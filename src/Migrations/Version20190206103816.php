<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190206103816 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE upisi DROP FOREIGN KEY upisi_ibfk_1');
        $this->addSql('ALTER TABLE upisi DROP FOREIGN KEY upisi_ibfk_2');
        $this->addSql('ALTER TABLE upisi CHANGE student_id student_id INT DEFAULT NULL, CHANGE predmet_id predmet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upisi ADD CONSTRAINT FK_EB553B58CB944F1A FOREIGN KEY (student_id) REFERENCES korisnici (id)');
        $this->addSql('ALTER TABLE upisi ADD CONSTRAINT FK_EB553B58B4810FC4 FOREIGN KEY (predmet_id) REFERENCES predmeti (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE upisi DROP FOREIGN KEY FK_EB553B58CB944F1A');
        $this->addSql('ALTER TABLE upisi DROP FOREIGN KEY FK_EB553B58B4810FC4');
        $this->addSql('ALTER TABLE upisi CHANGE student_id student_id INT NOT NULL, CHANGE predmet_id predmet_id INT NOT NULL');
        $this->addSql('ALTER TABLE upisi ADD CONSTRAINT upisi_ibfk_1 FOREIGN KEY (student_id) REFERENCES korisnici (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE upisi ADD CONSTRAINT upisi_ibfk_2 FOREIGN KEY (predmet_id) REFERENCES predmeti (id) ON DELETE CASCADE');
    }
}
