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
 * Entity class for "customer" table
 */
#[Entity]
#[Table(name: "customer")]
class Customer extends AbstractEntity
{
    public static array $propertyNames = [
        'CustomerID' => 'customerId',
        'Nama' => 'nama',
        'Nomor_Telepon' => 'nomorTelepon',
        'Contact_Person' => 'contactPerson',
    ];

    #[Id]
    #[Column(name: "CustomerID", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $customerId;

    #[Column(name: "Nama", type: "string")]
    private string $nama;

    #[Column(name: "Nomor_Telepon", type: "string")]
    private string $nomorTelepon;

    #[Column(name: "Contact_Person", type: "string")]
    private string $contactPerson;

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $value): static
    {
        $this->customerId = $value;
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

    public function getNomorTelepon(): string
    {
        return HtmlDecode($this->nomorTelepon);
    }

    public function setNomorTelepon(string $value): static
    {
        $this->nomorTelepon = RemoveXss($value);
        return $this;
    }

    public function getContactPerson(): string
    {
        return HtmlDecode($this->contactPerson);
    }

    public function setContactPerson(string $value): static
    {
        $this->contactPerson = RemoveXss($value);
        return $this;
    }
}
