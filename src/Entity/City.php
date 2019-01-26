<?php 
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table()
 */
class City {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @ORM\Column(type="decimal")
     */
    public $longitude;

    /**
    * @ORM\Column(type="decimal")
    */
    public $latitude;

    /**
    * @ORM\ManyToOne(targetEntity="Country")
    * @ORM\JoinColumn(name="idCountry", referencedColumnName="id")
    */
    public $country;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return (float) $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
    
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): self
    {
        $this->country = $country;

        return $this;
    }
    
}