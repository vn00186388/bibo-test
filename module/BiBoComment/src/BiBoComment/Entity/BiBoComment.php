<?php

namespace BiBoComment\Entity;

use Doctrine\ORM\Mapping as ORM;
use TmCommon\Common\CommonEntity;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface ;

/**
 * OdiDiary
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity
 */
class BiBoComment extends CommonEntity implements InputFilterAwareInterface
{

    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var Blog
     *
     * @ORM\ManyToOne(targetEntity="\BiBoBlog\Entity\BiBoBlog", inversedBy="comments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="blog_id", referencedColumnName="id")
     * })
     */
    protected $blog;

    /**
     * @var text
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;

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






    protected $inputFilter;

    /**
     * @return Blog
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * @param Blog $blog
     */
    public function setBlog($blog)
    {
        $this->blog = $blog;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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
                'name'     => 'content',
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
                            'max'      => 2525,
                        ),
                    ),
                ),
            ));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
