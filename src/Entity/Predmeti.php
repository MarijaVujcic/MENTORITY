<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Predmeti
 *
 * @ORM\Table(name="predmeti", uniqueConstraints={@ORM\UniqueConstraint(name="kod", columns={"kod"})})
 * @ORM\Entity
 *@ORM\Entity(repositoryClass="App\Repository\PredmetiRepository")
 */
class Predmeti
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ime", type="string", length=255, nullable=false)
     */
    private $ime;

    /**
     * @var string
     *
     * @ORM\Column(name="kod", type="string", length=16, nullable=false)
     */
    private $kod;

    /**
     * @var string
     *
     * @ORM\Column(name="program", type="text", length=65535, nullable=false)
     */
    private $program;

    /**
     * @var int
     *
     * @ORM\Column(name="bodovi", type="integer", nullable=false)
     */
    private $bodovi;

    /**
     * @var int
     *
     * @ORM\Column(name="sem_redovni", type="integer", nullable=false)
     */
    private $semRedovni;

    /**
     * @var int
     *
     * @ORM\Column(name="sem_izvanredni", type="integer", nullable=false)
     */
    private $semIzvanredni;

    /**
     * @var string
     *
     * @ORM\Column(name="izborni", type="string", length=0, nullable=false)
     */
    private $izborni;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIme(): ?string
    {
        return $this->ime;
    }

    public function setIme(string $ime): self
    {
        $this->ime = $ime;

        return $this;
    }

    public function getKod(): ?string
    {
        return $this->kod;
    }

    public function setKod(string $kod): self
    {
        $this->kod = $kod;

        return $this;
    }

    public function getProgram(): ?string
    {
        return $this->program;
    }

    public function setProgram(string $program): self
    {
        $this->program = $program;

        return $this;
    }

    public function getBodovi(): ?int
    {
        return $this->bodovi;
    }

    public function setBodovi(int $bodovi): self
    {
        $this->bodovi = $bodovi;

        return $this;
    }

    public function getSemRedovni(): ?int
    {
        return $this->semRedovni;
    }

    public function setSemRedovni(int $semRedovni): self
    {
        $this->semRedovni = $semRedovni;

        return $this;
    }

    public function getSemIzvanredni(): ?int
    {
        return $this->semIzvanredni;
    }

    public function setSemIzvanredni(int $semIzvanredni): self
    {
        $this->semIzvanredni = $semIzvanredni;

        return $this;
    }

    public function getIzborni(): ?string
    {
        return $this->izborni;
    }

    public function setIzborni(string $izborni): self
    {
        $this->izborni = $izborni;

        return $this;
    }


}
