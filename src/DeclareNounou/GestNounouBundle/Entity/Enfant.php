<?php

namespace DeclareNounou\GestNounouBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DeclareNounou\GestNounouBundle\Entity\AbstractPersonne;

/**
 * Enfant
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DeclareNounou\GestNounouBundle\Entity\EnfantRepository")
 */
class Enfant extends AbstractPersonne
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
     * @ORM\OneToMany(targetEntity="DeclareNounou\GestNounouBundle\Entity\Contrat", mappedBy="enfant")
     */
    private $contrats;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="DeclareNounou\UserBundle\Entity\User", inversedBy="enfants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
     * Set nom
     *
     * @param  string $nom
     * @return Enfant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Set prenom
     *
     * @param  string $prenom
     * @return Enfant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Set dateNaissance
     *
     * @param  \DateTime $dateNaissance
     * @return Enfant
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contrats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contrats
     *
     * @param  \DeclareNounou\GestNounouBundle\Entity\Contrat $contrats
     * @return Enfant
     */
    public function addContrat(\DeclareNounou\GestNounouBundle\Entity\Contrat $contrats)
    {
        $this->contrats[] = $contrats;

        return $this;
    }

    /**
     * Remove contrats
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Contrat $contrats
     */
    public function removeContrat(\DeclareNounou\GestNounouBundle\Entity\Contrat $contrats)
    {
        $this->contrats->removeElement($contrats);
    }

    /**
     * Get contrats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContrats()
    {
        return $this->contrats;
    }

    /**
     * Set user
     *
     * @param \DeclareNounou\UserBundle\Entity\User $user
     * @return Enfant
     */
    public function setUser(\DeclareNounou\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \DeclareNounou\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
