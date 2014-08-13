<?php

namespace DeclareNounou\GestNounouBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Periode
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DeclareNounou\GestNounouBundle\Entity\PeriodeRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Assert\Callback(methods={"heuresValides"})
 */
class Periode
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
     *
     * @ORM\ManyToOne(targetEntity="DeclareNounou\GestNounouBundle\Entity\Pointage", inversedBy="periodes")
     */
    private $pointage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_debut", type="time")
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin", type="time")
     */
    private $heureFin;
    
    /**
     * @var float
     * 
     * @ORM\Column(name="heures_realisees_periode", type="decimal", precision=4, scale=2)
     */
    private $heuresRealiseesPeriode;


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
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     * @return Periode
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime 
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     * @return Periode
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime 
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set heuresRealiseesPeriode
     *
     * @param float $heuresRealiseesPeriode
     * @return Periode
     */
    public function setHeuresRealiseesPeriode($heuresRealiseesPeriode)
    {
        $this->heuresRealiseesPeriode = $heuresRealiseesPeriode;

        return $this;
    }

    /**
     * Get heuresRealiseesPeriode
     *
     * @return float 
     */
    public function getHeuresRealiseesPeriode()
    {
        return $this->heuresRealiseesPeriode;
    }
    
    /**
     * méthode vérifiant les heures début et fin
     * @param \Symfony\Component\Validator\ExecutionContextInterface $context
     */
    public function heuresValides(ExecutionContextInterface $context)
    {
        //comparaison des heures début et fin
        if ($this->getHeureDebut() >= $this->getHeureFin()) {
            $context->buildViolation('L\'heure de début doit être inférieure à l\'heure de fin.')
                    ->atPath('heureDebut')
                    ->addViolation();
        }
    }

    /**
     * Set pointage
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Pointage $pointage
     * @return Periode
     */
    public function setPointage(\DeclareNounou\GestNounouBundle\Entity\Pointage $pointage = null)
    {
        $this->pointage = $pointage;

        return $this;
    }

    /**
     * Get pointage
     *
     * @return \DeclareNounou\GestNounouBundle\Entity\Pointage 
     */
    public function getPointage()
    {
        return $this->pointage;
    }
}
