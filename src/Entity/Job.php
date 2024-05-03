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
 * Entity class for "job" table
 */
#[Entity]
#[Table(name: "job")]
class Job extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "Tanggal", type: "date")]
    private DateTime $tanggal;

    #[Column(name: "Nomor", type: "string")]
    private string $nomor;

    #[Column(name: "Tanggal_Muat", type: "date")]
    private DateTime $tanggalMuat;

    #[Column(name: "Customer", type: "integer")]
    private int $customer;

    #[Column(name: "Shipper", type: "integer")]
    private int $shipper;

    #[Column(name: "Lokasi", type: "integer")]
    private int $lokasi;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
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

    public function getNomor(): string
    {
        return HtmlDecode($this->nomor);
    }

    public function setNomor(string $value): static
    {
        $this->nomor = RemoveXss($value);
        return $this;
    }

    public function getTanggalMuat(): DateTime
    {
        return $this->tanggalMuat;
    }

    public function setTanggalMuat(DateTime $value): static
    {
        $this->tanggalMuat = $value;
        return $this;
    }

    public function getCustomer(): int
    {
        return $this->customer;
    }

    public function setCustomer(int $value): static
    {
        $this->customer = $value;
        return $this;
    }

    public function getShipper(): int
    {
        return $this->shipper;
    }

    public function setShipper(int $value): static
    {
        $this->shipper = $value;
        return $this;
    }

    public function getLokasi(): int
    {
        return $this->lokasi;
    }

    public function setLokasi(int $value): static
    {
        $this->lokasi = $value;
        return $this;
    }
}
