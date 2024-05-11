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
 * Entity class for "size" table
 */
#[Entity]
#[Table(name: "size")]
class Size extends AbstractEntity
{
    public static array $propertyNames = [
        'SizeID' => 'sizeId',
        'Ukuran' => 'ukuran',
    ];

    #[Id]
    #[Column(name: "SizeID", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $sizeId;

    #[Column(name: "Ukuran", type: "string")]
    private string $ukuran;

    public function getSizeId(): int
    {
        return $this->sizeId;
    }

    public function setSizeId(int $value): static
    {
        $this->sizeId = $value;
        return $this;
    }

    public function getUkuran(): string
    {
        return HtmlDecode($this->ukuran);
    }

    public function setUkuran(string $value): static
    {
        $this->ukuran = RemoveXss($value);
        return $this;
    }
}
