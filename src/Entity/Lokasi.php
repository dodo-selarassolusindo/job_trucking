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
 * Entity class for "lokasi" table
 */
#[Entity]
#[Table(name: "lokasi")]
class Lokasi extends AbstractEntity
{
    public static array $propertyNames = [
        'LokasiID' => 'lokasiId',
        'Nama' => 'nama',
    ];

    #[Id]
    #[Column(name: "LokasiID", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $lokasiId;

    #[Column(name: "Nama", type: "string")]
    private string $nama;

    public function getLokasiId(): int
    {
        return $this->lokasiId;
    }

    public function setLokasiId(int $value): static
    {
        $this->lokasiId = $value;
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
