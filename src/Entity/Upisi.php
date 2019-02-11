<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Upisi
 *
 * @ORM\Table(name="upisi", uniqueConstraints={@ORM\UniqueConstraint(name="id_status", columns={"id_status"})}, indexes={@ORM\Index(name="predmet_id", columns={"predmet_id"}), @ORM\Index(name="student_id", columns={"student_id"})})
 * @ORM\Entity
 *@ORM\Entity(repositoryClass="App\Repository\UpisiRepository")
 */
class Upisi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_status", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=64, nullable=false)
     */
    private $status;

    /**
     * @var \Korisnici
     *
     * @ORM\ManyToOne(targetEntity="Korisnici")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     * })
     */
    private $student;

    /**
     * @var \Predmeti
     *
     * @ORM\ManyToOne(targetEntity="Predmeti")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="predmet_id", referencedColumnName="id")
     * })
     */
    private $predmet;

    public function getIdStatus(): ?int
    {
        return $this->idStatus;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStudent(): ?Korisnici
    {
        return $this->student;
    }

    public function setStudent(?Korisnici $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getPredmet(): ?Predmeti
    {
        return $this->predmet;
    }

    public function setPredmet(?Predmeti $predmet): self
    {
        $this->predmet = $predmet;

        return $this;
    }


}
