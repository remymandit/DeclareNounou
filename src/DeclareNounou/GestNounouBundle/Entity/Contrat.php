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
 * @Assert\Callback(methods={"datesValide"})
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
     * @ORM\Column(name="datedebut", type="date")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date")
     */
    private $datefin;

    /**
     * @var integer
     * 
     * @ORM\Column(name="heuresmensuels", type="integer")
     * @Assert\Range(min="0",max="999")
     */
    private $heuresmensuels;

    /**
     * @var float
     *
     * @ORM\Column(name="tarifhoraire", type="decimal", precision=4, scale=2)
     * @Assert\Range(min="0",max="20")
     */
    private $tarifhoraire;

    /**
     * @var float
     *
     * @ORM\Column(name="tarifrepas", type="decimal", precision=3, scale=2)
     * @Assert\Range(min="0",max="9")
     */
    private $tarifrepas;

    /**
     * @var float
     *
     * @ORM\Column(name="tarifindemnite", type="decimal", precision=3, scale=2)
     * @Assert\Range(min="0",max="10")
     */
    private $tarifindemnite;


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
     * Set datedebut
     *
     * @param \DateTime $datedebut
     * @return Contrat
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    
        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime 
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     * @return Contrat
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    
        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set heuresmensuels
     *
     * @param \DateTime $heuresmensuels
     * @return Contrat
     */
    public function setHeuresmensuels($heuresmensuels)
    {
        $this->heuresmensuels = $heuresmensuels;
    
        return $this;
    }

    /**
     * Get heuresmensuels
     *
     * @return \DateTime 
     */
    public function getHeuresmensuels()
    {
        return $this->heuresmensuels;
    }

    /**
     * Set tarifhoraire
     *
     * @param float $tarifhoraire
     * @return Contrat
     */
    public function setTarifhoraire($tarifhoraire)
    {
        $this->tarifhoraire = $tarifhoraire;
    
        return $this;
    }

    /**
     * Get tarifhoraire
     *
     * @return float 
     */
    public function getTarifhoraire()
    {
        return $this->tarifhoraire;
    }

    /**
     * Set tarifrepas
     *
     * @param float $tarifrepas
     * @return Contrat
     */
    public function setTarifrepas($tarifrepas)
    {
        $this->tarifrepas = $tarifrepas;
    
        return $this;
    }

    /**
     * Get tarifrepas
     *
     * @return float 
     */
    public function getTarifrepas()
    {
        return $this->tarifrepas;
    }

    /**
     * Set tarifindemnite
     *
     * @param float $tarifindemnite
     * @return Contrat
     */
    public function setTarifindemnite($tarifindemnite)
    {
        $this->tarifindemnite = $tarifindemnite;
    
        return $this;
    }

    /**
     * Get tarifindemnite
     *
     * @return float 
     */
    public function getTarifindemnite()
    {
        return $this->tarifindemnite;
    }

    /**
     * Set enfant
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Enfant $enfant
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
     * @param \DeclareNounou\GestNounouBundle\Entity\Nounou $nounou
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
    public function datesValide(ExecutionContextInterface $context)
    {
        //comparaison des dates début et fin
        if($this->getDatedebut() >= $this->getDatefin())
        {
            //la règle est violée
            //1er argument : l'argument concerné, ici "dateDebut"
            //2ème argument : le message d'erreur
            $context->addViolationAt('datedebut', 'La date de début doit être inférieure à la date de fin.', array(),null);
        }
    }
}
