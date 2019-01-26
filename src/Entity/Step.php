<?php 
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Journey;
use App\Entity\City;


/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Step {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    public $comment;

    /**
    * @ORM\Column(type="integer", nullable=false)
    */
    public $rank;

    /**
    * @ORM\Column(type="integer", nullable=false)
    */
    public $duration;

    /**
    * @ORM\ManyToOne(targetEntity="Journey")
    * @ORM\JoinColumn(name="idJourney", referencedColumnName="id")
    */
    public $journey;

    /**
    * @ORM\ManyToOne(targetEntity="City")
    * @ORM\JoinColumn(name="idCity", referencedColumnName="id")
    */
    // il s'agit ici de la ville de l'hébergement le soir. une ville max par étape
    public $city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
    
    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getJourney(): ?Journey
    {
        return $this->journey;
    }

    public function setJourney(Journey $journey): self
    {
        $this->journey = $journey;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(City $city): self
    {
        $this->city = $city;

        return $this;
    }
}