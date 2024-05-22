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
 * Entity class for "job_order" table
 */
#[Entity]
#[Table(name: "job_order")]
class JobOrder extends AbstractEntity
{
    #[Id]
    #[Column(name: "JobOrderID", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $jobOrderId;

    #[Column(name: "Job2ID", type: "integer")]
    private int $job2Id;

    #[Column(name: "SizeID", type: "integer")]
    private int $sizeId;

    #[Column(name: "TypeID", type: "integer")]
    private int $typeId;

    #[Column(name: "Tanggal", type: "date")]
    private DateTime $tanggal;

    #[Column(name: "LokasiID", type: "integer")]
    private int $lokasiId;

    #[Column(name: "PelabuhanID", type: "integer")]
    private int $pelabuhanId;

    #[Column(name: "BL_Extra", type: "float")]
    private float $blExtra;

    #[Column(name: "DepoID", type: "integer")]
    private int $depoId;

    #[Column(name: "Ongkos", type: "float")]
    private float $ongkos;

    #[Column(name: "IsShow", type: "integer")]
    private int $isShow;

    #[Column(name: "IsOpen", type: "integer")]
    private int $isOpen;

    #[Column(name: "TakenByID", type: "integer")]
    private int $takenById;

    public function getJobOrderId(): int
    {
        return $this->jobOrderId;
    }

    public function setJobOrderId(int $value): static
    {
        $this->jobOrderId = $value;
        return $this;
    }

    public function getJob2Id(): int
    {
        return $this->job2Id;
    }

    public function setJob2Id(int $value): static
    {
        $this->job2Id = $value;
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

    public function getTanggal(): DateTime
    {
        return $this->tanggal;
    }

    public function setTanggal(DateTime $value): static
    {
        $this->tanggal = $value;
        return $this;
    }

    public function getLokasiId(): int
    {
        return $this->lokasiId;
    }

    public function setLokasiId(int $value): static
    {
        $this->lokasiId = $value;
        return $this;
    }

    public function getPelabuhanId(): int
    {
        return $this->pelabuhanId;
    }

    public function setPelabuhanId(int $value): static
    {
        $this->pelabuhanId = $value;
        return $this;
    }

    public function getBlExtra(): float
    {
        return $this->blExtra;
    }

    public function setBlExtra(float $value): static
    {
        $this->blExtra = $value;
        return $this;
    }

    public function getDepoId(): int
    {
        return $this->depoId;
    }

    public function setDepoId(int $value): static
    {
        $this->depoId = $value;
        return $this;
    }

    public function getOngkos(): float
    {
        return $this->ongkos;
    }

    public function setOngkos(float $value): static
    {
        $this->ongkos = $value;
        return $this;
    }

    public function getIsShow(): int
    {
        return $this->isShow;
    }

    public function setIsShow(int $value): static
    {
        $this->isShow = $value;
        return $this;
    }

    public function getIsOpen(): int
    {
        return $this->isOpen;
    }

    public function setIsOpen(int $value): static
    {
        $this->isOpen = $value;
        return $this;
    }

    public function getTakenById(): int
    {
        return $this->takenById;
    }

    public function setTakenById(int $value): static
    {
        $this->takenById = $value;
        return $this;
    }
}
