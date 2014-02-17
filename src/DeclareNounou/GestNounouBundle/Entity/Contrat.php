<?php

namespace DeclareNounou\GestNounouBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Contrat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DeclareNounou\GestNounouBundle\Entity\ContratRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Assert\Callback(methods={"datesValides"})
 */
class Contrat
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
     * @ORM\ManyToOne(targetEntity="DeclareNounou\GestNounouBundle\Entity\Enfant", inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enfant;

    /**
     * @ORM\ManyToOne(targetEntity="DeclareNounou\GestNounouBundle\Entity\Nounou", inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nounou;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="heures_mensuelles", type="integer")
     * @Assert\Range(min="0",max="999")
     */
    private $heuresMensuelles;

    /**
     * @var float
     *
     * @ORM\Column(name="tarif_horaire", type="decimal", precision=4, scale=2)
     * @Assert\Range(min="0",max="20")
     */
    private $tarifHoraire;

    /**
     * @var float
     *
     * @ORM\Column(name="tarif_repas", type="decimal", precision=3, scale=2)
     * @Assert\Range(min="0",max="9")
     */
    private $tarifRepas;

    /**
     * @var float
     *
     * @ORM\Column(name="tarif_indemnite", type="decimal", precision=3, scale=2)
     * @Assert\Range(min="0",max="10")
     */
    private $tarifIndemnite;

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
     * Set dateDebut
     *
     * @param  \DateTime $dateDebut
     * @return Contrat
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param  \DateTime $dateFin
     * @return Contrat
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set heuresMensuelles
     *
     * @param  \DateTime $heuresMensuelles
     * @return Contrat
     */
    public function setHeuresMensuelles($heuresMensuelles)
    {
        $this->heuresMensuelles = $heuresMensuelles;

        return $this;
    }

    /**
     * Get heuresMensuelles
     *
     * @return \DateTime
     */
    public function getHeuresMensuelles()
    {
        return $this->heuresMensuelles;
    }

    /**
     * Set tarifHoraire
     *
     * @param  float   $tarifHoraire
     * @return Contrat
     */
    public function setTarifHoraire($tarifHoraire)
    {
        $this->tarifHoraire = $tarifHoraire;

        return $this;
    }

    /**
     * Get tarifHoraire
     *
     * @return float
     */
    public function getTarifHoraire()
    {
        return $this->tarifHoraire;
    }

    /**
     * Set tarifRepas
     *
     * @param  float   $tarifRepas
     * @return Contrat
     */
    public function setTarifRepas($tarifRepas)
    {
        $this->tarifRepas = $tarifRepas;

        return $this;
    }

    /**
     * Get tarifRepas
     *
     * @return float
     */
    public function getTarifRepas()
    {
        return $this->tarifRepas;
    }

    /**
     * Set tarifIndemnite
     *
     * @param  float   $tarifIndemnite
     * @return Contrat
     */
    public function setTarifIndemnite($tarifIndemnite)
    {
        $this->tarifIndemnite = $tarifIndemnite;

        return $this;
    }

    /**
     * Get tarifIndemnite
     *
     * @return float
     */
    public function getTarifIndemnite()
    {
        return $this->tarifIndemnite;
    }

    /**
     * Set enfant
     *
     * @param  \DeclareNounou\GestNounouBundle\Entity\Enfant $enfant
     * @return Contrat
     */
    public function setEnfant(\DeclareNounou\GestNounouBundle\Entity\Enfant $enfant = null)
    {
        $this->enfant = $enfant;

        return $this;
    }

    /**
     * Get enfant
     *
     * @return \DeclareNounou\GestNounouBundle\Entity\Enfant
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * Set nounou
     *
     * @param  \DeclareNounou\GestNounouBundle\Entity\Nounou $nounou
     * @return Contrat
     */
    public function setNounou(\DeclareNounou\GestNounouBundle\Entity\Nounou $nounou = null)
    {
        $this->nounou = $nounou;

        return $this;
    }

    /**
     * Get nounou
     *
     * @return \DeclareNounou\GestNounouBundle\Entity\Nounou
     */
    public function getNounou()
    {
        return $this->nounou;
    }

    /**
     * méthode vérifiant les dates début et fin
     * @param \Symfony\Component\Validator\ExecutionContextInterface $context
     */
    public function datesValides(ExecutionContextInterface $context)
    {
        //comparaison des dates début et fin
        if ($this->getDateDebut() >= $this->getDateFin()) {
            //la règle est violée
            //1er argument : l'argument concerné, ici "dateDebut"
            //2ème argument : le message d'erreur
            $context->addViolationAt('dateDebut', 'La date de début doit être inférieure à la date de fin.', array(), null);
        }
    }
}
