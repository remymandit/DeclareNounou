<?php

namespace DeclareNounou\GestNounouBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Contrat.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DeclareNounou\GestNounouBundle\Entity\ContratRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Assert\Callback(methods={"datesValides"})
 */
class Contrat
{
    /**
     * @var int
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
     * @ORM\OneToMany(targetEntity="DeclareNounou\GestNounouBundle\Entity\Pointage", mappedBy="contrat")
     */
    private $pointages;

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
     * @var int
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
     * @ORM\Column(name="tarif_repas", type="decimal", precision=3, scale=2, nullable=true)
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateDebut.
     *
     * @param \DateTime $dateDebut
     *
     * @return Contrat
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut.
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin.
     *
     * @param \DateTime $dateFin
     *
     * @return Contrat
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin.
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set heuresMensuelles.
     *
     * @param int $heuresMensuelles
     *
     * @return Contrat
     */
    public function setHeuresMensuelles($heuresMensuelles)
    {
        $this->heuresMensuelles = $heuresMensuelles;

        return $this;
    }

    /**
     * Get heuresMensuelles.
     *
     * @return int
     */
    public function getHeuresMensuelles()
    {
        return $this->heuresMensuelles;
    }

    /**
     * Set tarifHoraire.
     *
     * @param float $tarifHoraire
     *
     * @return Contrat
     */
    public function setTarifHoraire($tarifHoraire)
    {
        $this->tarifHoraire = $tarifHoraire;

        return $this;
    }

    /**
     * Get tarifHoraire.
     *
     * @return float
     */
    public function getTarifHoraire()
    {
        return $this->tarifHoraire;
    }

    /**
     * Set tarifRepas.
     *
     * @param float $tarifRepas
     *
     * @return Contrat
     */
    public function setTarifRepas($tarifRepas)
    {
        $this->tarifRepas = $tarifRepas;

        return $this;
    }

    /**
     * Get tarifRepas.
     *
     * @return float
     */
    public function getTarifRepas()
    {
        return $this->tarifRepas;
    }

    /**
     * Set tarifIndemnite.
     *
     * @param float $tarifIndemnite
     *
     * @return Contrat
     */
    public function setTarifIndemnite($tarifIndemnite)
    {
        $this->tarifIndemnite = $tarifIndemnite;

        return $this;
    }

    /**
     * Get tarifIndemnite.
     *
     * @return float
     */
    public function getTarifIndemnite()
    {
        return $this->tarifIndemnite;
    }

    /**
     * Set enfant.
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Enfant $enfant
     *
     * @return Contrat
     */
    public function setEnfant(\DeclareNounou\GestNounouBundle\Entity\Enfant $enfant = null)
    {
        $this->enfant = $enfant;

        return $this;
    }

    /**
     * Get enfant.
     *
     * @return \DeclareNounou\GestNounouBundle\Entity\Enfant
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * Set nounou.
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Nounou $nounou
     *
     * @return Contrat
     */
    public function setNounou(\DeclareNounou\GestNounouBundle\Entity\Nounou $nounou = null)
    {
        $this->nounou = $nounou;

        return $this;
    }

    /**
     * Get nounou.
     *
     * @return \DeclareNounou\GestNounouBundle\Entity\Nounou
     */
    public function getNounou()
    {
        return $this->nounou;
    }

    /**
     * méthode vérifiant les dates début et fin.
     *
     * @param \Symfony\Component\Validator\ExecutionContextInterface $context
     */
    public function datesValides(ExecutionContextInterface $context)
    {
        //comparaison des dates début et fin
        if ($this->getDateDebut() >= $this->getDateFin()) {
            //la règle est violée
            //1er argument : le message d'erreur
            //2ème argument : l'argument concerné, ici "dateDebut"
            $context->buildViolation('La date de début doit être inférieure à la date de fin.')
                    ->atPath('dateDebut')
                    ->addViolation();
        }
    }
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->pointages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pointages.
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Pointage $pointages
     *
     * @return Contrat
     */
    public function addPointage(\DeclareNounou\GestNounouBundle\Entity\Pointage $pointages)
    {
        $this->pointages[] = $pointages;

        return $this;
    }

    /**
     * Remove pointages.
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Pointage $pointages
     */
    public function removePointage(\DeclareNounou\GestNounouBundle\Entity\Pointage $pointages)
    {
        $this->pointages->removeElement($pointages);
    }

    /**
     * Get pointages.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPointages()
    {
        return $this->pointages;
    }

    /**
     * méthode retournant une chaîne de caractères
     * constituée de la date de début.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s: %s / %s', strftime('%b %y', $this->getDateDebut()->getTimestamp()), $this->getEnfant()->getPrenom(), $this->getNounou());
    }
}
