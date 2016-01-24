<?php

namespace BiBoUser\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TmCommon\Common\CommonEntity;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface ;

/**
 * OdiDiary
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class BiBoUser extends CommonEntity implements InputFilterAwareInterface
{

    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email_address", type="string", length=255, nullable=true)
     */
    protected $emailAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255,  nullable=true)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255,  nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255,  nullable=true)
     */
    protected $lastName;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted_flag", type="integer",  nullable=true)
     */
    protected $deletedFlag;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime",  nullable=true)
     */
    protected $createdAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="updated_at", type="datetime",  nullable=true)
     */
    protected $updatedAt;

    // ...
    /**
     * @ORM\OneToMany(targetEntity="\BiBoBlog\Entity\BiBoBlog", mappedBy="user")
     */
    protected $blogs;
    // ...

    public function __construct() {
        parent::__construct() ;
        $this->blogs = new ArrayCollection();
    }




    protected $inputFilter;

    /**
     * @return mixed
     */
    public function getBlogs()
    {
        return $this->blogs;
    }

    /**
     * @param mixed $blogs
     */
    public function setBlogs($blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return int
     */
    public function getDeletedFlag()
    {
        return $this->deletedFlag;
    }

    /**
     * @param int $deletedFlag
     */
    public function setDeletedFlag($deletedFlag)
    {
        $this->deletedFlag = $deletedFlag;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'email_address',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
