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
 * Entity class for "size_type" table
 */
#[Entity]
#[Table(name: "size_type")]
class SizeType extends AbstractEntity
{
    #[Id]
    #[Column(name: "Size_Type_ID", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $sizeTypeId;

    #[Column(name: "SizeID", type: "integer")]
    private int $sizeId;

    #[Column(name: "TypeID", type: "integer")]
    private int $typeId;

    public function getSizeTypeId(): int
    {
        return $this->sizeTypeId;
    }

    public function setSizeTypeId(int $value): static
    {
        $this->sizeTypeId = $value;
        return $this;
    }

    public function getSizeId(): int
    {
        return $this->sizeId;
    }

    public function setSizeId(int $value): static
    {
        $this->sizeId = $value;
        return $this;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $value): static
    {
        $this->typeId = $value;
        return $this;
    }
}
