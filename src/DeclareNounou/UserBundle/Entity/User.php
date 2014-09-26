<?php

namespace DeclareNounou\UserBundle\Entity;

use DeclareNounou\GestNounouBundle\Entity\Enfant;
use DeclareNounou\GestNounouBundle\Entity\Nounou;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\OneToOne(targetEntity="Invitation", mappedBy="user")
     * @ORM\JoinColumn(referencedColumnName="code")
     * @Assert\NotNull(message="Veuillez vérifier votre code d'invitation", groups={"Registration"})
     */
    protected $invitation;

    /**
     * Add enfants
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Enfant $enfants
     * @return User
     */
    public function addEnfant(Enfant $enfants)
    {
        $this->enfants[] = $enfants;

        return $this;
    }

    /**
     * Remove enfants
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Enfant $enfants
     */
    public function removeEnfant(Enfant $enfants)
    {
        $this->enfants->removeElement($enfants);
    }

    /**
     * Get enfants
     *
     * @return \DeclareNounou\GestNounouBundle\Entity\Enfant[]
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
    public function addNounous(Nounou $nounous)
    {
        $this->nounous[] = $nounous;

        return $this;
    }

    /**
     * Remove nounous
     *
     * @param \DeclareNounou\GestNounouBundle\Entity\Nounou $nounous
     */
    public function removeNounous(Nounou $nounous)
    {
        $this->nounous->removeElement($nounous);
    }

    /**
     * Get nounous
     *
     * @return \DeclareNounou\GestNounouBundle\Entity\Nounou[]
     */
    public function getNounous()
    {
        return $this->nounous;
    }

    public function setInvitation(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function getInvitation()
    {
        return $this->invitation;
    }
}
