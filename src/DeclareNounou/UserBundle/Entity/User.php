<?php

namespace DeclareNounou\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="DeclareNounou\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="DeclareNounou\GestNounouBundle\Entity\Enfant", mappedBy="user")
     */
    private $enfants;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="DeclareNounou\GestNounouBundle\Entity\Nounou", mappedBy="user")
     */
    private $nounous;

    /**
     *
     * @var type
     * @ORM\ManyToMany(targetEntity="DeclareNounou\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     * joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * Add enfants
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Enfant $enfants
     * @return User
     */
    public function addEnfant(\DeclareNounou\GestNounouBundle\Entity\Enfant $enfants)
    {
        $this->enfants[] = $enfants;

        return $this;
    }

    /**
     * Remove enfants
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Enfant $enfants
     */
    public function removeEnfant(\DeclareNounou\GestNounouBundle\Entity\Enfant $enfants)
    {
        $this->enfants->removeElement($enfants);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnfants()
    {
        return $this->enfants;
    }
    
    /**
     * Add nounous
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Nounou $nounous
     * @return User
     */
    public function addNounous(\DeclareNounou\GestNounouBundle\Entity\Nounou $nounous)
    {
        $this->nounous[] = $nounous;

        return $this;
    }

    /**
     * Remove nounous
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Nounou $nounous
     */
    public function removeNounous(\DeclareNounou\GestNounouBundle\Entity\Nounou $nounous)
    {
        $this->nounous->removeElement($nounous);
    }

    /**
     * Get nounous
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNounous()
    {
        return $this->nounous;
    }
}
