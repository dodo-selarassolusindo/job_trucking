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
 * Entity class for "depo" table
 */
#[Entity]
#[Table(name: "depo")]
class Depo extends AbstractEntity
{
    public static array $propertyNames = [
        'DepoID' => 'depoId',
        'Nama' => 'nama',
    ];

    #[Id]
    #[Column(name: "DepoID", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $depoId;

    #[Column(name: "Nama", type: "string")]
    private string $nama;

    public function getDepoId(): int
    {
        return $this->depoId;
    }

    public function setDepoId(int $value): static
    {
        $this->depoId = $value;
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
}
