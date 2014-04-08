<?php

namespace DeclareNounou\GestNounouBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pointage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DeclareNounou\GestNounouBundle\Entity\PointageRepository")
 */
class Pointage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="DeclareNounou\GestNounouBundle\Entity\Periode", mappedBy="pointage", cascade={"persist"})
     * 
     */
    private $periodes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_pointage", type="date")
     */
    private $datePointage;

    /**
     * @var float
     *
     * @ORM\Column(name="heures_realisees_pointage", type="decimal", precision=4, scale=2)
     */
    private $heuresRealiseesPointage;

    /**
     * @var float
     *
     * @ORM\Column(name="heures_complementaires", type="decimal", precision=4, scale=2)
     */
    private $heuresComplementaires;

    /**
     * @var float
     *
     * @ORM\Column(name="heures_normales", type="decimal", precision=4, scale=2)
     */
    private $heuresNormales;

    /**
     * @var boolean
     *
     * @ORM\Column(name="repas", type="boolean", options={"default"=0})
     */
    private $repas;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datePointage
     *
     * @param \DateTime $datePointage
     * @return Pointage
     */
    public function setDatePointage($datePointage)
    {
        $this->datePointage = $datePointage;

        return $this;
    }

    /**
     * Get datePointage
     *
     * @return \DateTime 
     */
    public function getDatePointage()
    {
        return $this->datePointage;
    }

    /**
     * Set heuresRealisees
     *
     * @param float $heuresRealiseesPointage
     * @return Pointage
     */
    public function setHeuresRealiseesPointage($heuresRealiseesPointage)
    {
        $this->heuresRealiseesPointage = $heuresRealiseesPointage;

        return $this;
    }

    /**
     * Get heuresRealiseesPointage
     *
     * @return float 
     */
    public function getHeuresRealiseesPointage()
    {
        return $this->heuresRealiseesPointage;
    }

    /**
     * Set heuresComplementaires
     *
     * @param float $heuresComplementaires
     * @return Pointage
     */
    public function setHeuresComplementaires($heuresComplementaires)
    {
        $this->heuresComplementaires = $heuresComplementaires;

        return $this;
    }

    /**
     * Get heuresComplementaires
     *
     * @return float 
     */
    public function getHeuresComplementaires()
    {
        return $this->heuresComplementaires;
    }

    /**
     * Set heuresNormales
     *
     * @param float $heuresNormales
     * @return Pointage
     */
    public function setHeuresNormales($heuresNormales)
    {
        $this->heuresNormales = $heuresNormales;

        return $this;
    }

    /**
     * Get heuresNormales
     *
     * @return float 
     */
    public function getHeuresNormales()
    {
        return $this->heuresNormales;
    }

    /**
     * Set repas
     *
     * @param boolean $repas
     * @return Pointage
     */
    public function setRepas($repas)
    {
        $this->repas = $repas;

        return $this;
    }

    /**
     * Get repas
     *
     * @return boolean 
     */
    public function getRepas()
    {
        return $this->repas;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->periodes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add periodes
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Periode $periodes
     * @return Pointage
     */
    public function addPeriode(\DeclareNounou\GestNounouBundle\Entity\Periode $periodes)
    {
        $this->periodes[] = $periodes;

        return $this;
    }

    /**
     * Remove periodes
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Periode $periodes
     */
    public function removePeriode(\DeclareNounou\GestNounouBundle\Entity\Periode $periodes)
    {
        $this->periodes->removeElement($periodes);
    }

    /**
     * Get periodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPeriodes()
    {
        return $this->periodes;
    }
}
