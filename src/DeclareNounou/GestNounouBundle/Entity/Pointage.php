<?php

namespace DeclareNounou\GestNounouBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Pointage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DeclareNounou\GestNounouBundle\Entity\PointageRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Assert\Callback(methods={"heuresValides"})
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
     * @ORM\ManyToOne(targetEntity="DeclareNounou\GestNounouBundle\Entity\Contrat", inversedBy="pointages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contrat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_pointage", type="date")
     */
    private $datePointage;

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
     * @param  \DateTime $datePointage
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
     * Set heureDebut
     *
     * @param  \DateTime $heureDebut
     * @return Pointage
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
     * @param  \DateTime $heureFin
     * @return Pointage
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
     * Set heuresRealisees
     *
     * @param  float    $heuresRealiseesPointage
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
     * @param  float    $heuresComplementaires
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
     * @param  float    $heuresNormales
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
     * @param  boolean  $repas
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
     * Set contrat
     *
     * @param  \DeclareNounou\GestNounouBundle\Entity\Contrat $contrat
     * @return Pointage
     */
    public function setContrat(\DeclareNounou\GestNounouBundle\Entity\Contrat $contrat)
    {
        $this->contrat = $contrat;

        return $this;
    }

    /**
     * Get contrat
     *
     * @return \DeclareNounou\GestNounouBundle\Entity\Contrat
     */
    public function getContrat()
    {
        return $this->contrat;
    }
}
