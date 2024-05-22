<?php

namespace PHPMaker2024\prj_job_trucking\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2024\prj_job_trucking\AbstractEntity;
use PHPMaker2024\prj_job_trucking\AdvancedSecurity;
use PHPMaker2024\prj_job_trucking\UserProfile;
use function PHPMaker2024\prj_job_trucking\Config;
use function PHPMaker2024\prj_job_trucking\EntityManager;
use function PHPMaker2024\prj_job_trucking\RemoveXss;
use function PHPMaker2024\prj_job_trucking\HtmlDecode;
use function PHPMaker2024\prj_job_trucking\EncryptPassword;

/**
 * Entity class for "taken_by" table
 */
#[Entity]
#[Table(name: "taken_by")]
class TakenBy extends AbstractEntity
{
    #[Id]
    #[Column(name: "TakenByID", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $takenById;

    #[Column(name: "Nama", type: "string")]
    private string $nama;

    #[Column(name: "NomorHP", type: "string")]
    private string $nomorHp;

    public function getTakenById(): int
    {
        return $this->takenById;
    }

    public function setTakenById(int $value): static
    {
        $this->takenById = $value;
        return $this;
    }

    public function getNama(): string
    {
        return HtmlDecode($this->nama);
    }

    public function setNama(string $value): static
    {
        $this->nama = RemoveXss($value);
        return $this;
    }

    public function getNomorHp(): string
    {
        return HtmlDecode($this->nomorHp);
    }

    public function setNomorHp(string $value): static
    {
        $this->nomorHp = RemoveXss($value);
        return $this;
    }
}
