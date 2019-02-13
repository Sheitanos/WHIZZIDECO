<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Production
 *
 * @ORM\Table(name="production")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductionRepository")
 */
class Production
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="text_before", type="text")
     */
    private $textBefore;

    /**
     * @var string
     *
     * @ORM\Column(name="text_after", type="text")
     */
    private $textAfter;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProductionPicture", mappedBy="beforeProduction")
     * @ORM\JoinColumn(name="beforePictures", nullable=true)
     *
     */
    private $beforePictures;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProductionPicture", mappedBy="afterProduction")
     * @ORM\JoinColumn(name="afterPictures", nullable=true)
     *
     */
    private $afterPictures;


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
     * Set title.
     *
     * @param string $title
     *
     * @return Production
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Production
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Set textBefore.
     *
     * @param string $textBefore
     *
     * @return Production
     */
    public function setTextBefore($textBefore)
    {
        $this->textBefore = $textBefore;

        return $this;
    }

    /**
     * Get textBefore.
     *
     * @return string
     */
    public function getTextBefore()
    {
        return $this->textBefore;
    }

    /**
     * Set textAfter.
     *
     * @param string $textAfter
     *
     * @return Production
     */
    public function setTextAfter($textAfter)
    {
        $this->textAfter = $textAfter;

        return $this;
    }

    /**
     * Get textAfter.
     *
     * @return string
     */
    public function getTextAfter()
    {
        return $this->textAfter;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->beforePictures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->afterPictures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add beforePicture.
     *
     * @param \AppBundle\Entity\ProductionPicture $beforePicture
     *
     * @return Production
     */
    public function addBeforePicture(\AppBundle\Entity\ProductionPicture $beforePicture)
    {
        $this->beforePictures[] = $beforePicture;

        return $this;
    }

    /**
     * Remove beforePicture.
     *
     * @param \AppBundle\Entity\ProductionPicture $beforePicture
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBeforePicture(\AppBundle\Entity\ProductionPicture $beforePicture)
    {
        return $this->beforePictures->removeElement($beforePicture);
    }

    /**
     * Get beforePictures.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBeforePictures()
    {
        return $this->beforePictures;
    }

    /**
     * Add afterPicture.
     *
     * @param \AppBundle\Entity\ProductionPicture $afterPicture
     *
     * @return Production
     */
    public function addAfterPicture(\AppBundle\Entity\ProductionPicture $afterPicture)
    {
        $this->afterPictures[] = $afterPicture;

        return $this;
    }

    /**
     * Remove afterPicture.
     *
     * @param \AppBundle\Entity\ProductionPicture $afterPicture
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAfterPicture(\AppBundle\Entity\ProductionPicture $afterPicture)
    {
        return $this->afterPictures->removeElement($afterPicture);
    }

    /**
     * Get afterPictures.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAfterPictures()
    {
        return $this->afterPictures;
    }

    public function __toString() {
        return $this->title;
    }
}
