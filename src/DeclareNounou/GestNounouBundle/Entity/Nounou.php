<?php

namespace DeclareNounou\GestNounouBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nounou.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DeclareNounou\GestNounouBundle\Entity\NounouRepository")
 */
class Nounou extends AbstractPersonne
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
     * @ORM\OneToMany(targetEntity="DeclareNounou\GestNounouBundle\Entity\Contrat", mappedBy="nounou")
     */
    private $contrats;

    /**
     * @ORM\ManyToOne(targetEntity="DeclareNounou\UserBundle\Entity\User", inversedBy="nounous")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

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
     * Set nom.
     *
     * @param string $nom
     *
     * @return Nounou
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Nounou
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Set dateNaissance.
     *
     * @param \DateTime $dateNaissance
     *
     * @return Nounou
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Set adresse.
     *
     * @param string $adresse
     *
     * @return Nounou
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse.
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal.
     *
     * @param int $codePostal
     *
     * @return Nounou
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal.
     *
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville.
     *
     * @param string $ville
     *
     * @return Nounou
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->contrats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contrats.
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Contrat $contrats
     *
     * @return Nounou
     */
    public function addContrat(\DeclareNounou\GestNounouBundle\Entity\Contrat $contrats)
    {
        $this->contrats[] = $contrats;

        return $this;
    }

    /**
     * Remove contrats.
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Contrat $contrats
     */
    public function removeContrat(\DeclareNounou\GestNounouBundle\Entity\Contrat $contrats)
    {
        $this->contrats->removeElement($contrats);
    }

    /**
     * Get contrats.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContrats()
    {
        return $this->contrats;
    }

    /**
     * Set user.
     *
     * @param \DeclareNounou\UserBundle\Entity\User $user
     *
     * @return Nounou
     */
    public function setUser(\DeclareNounou\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \DeclareNounou\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
