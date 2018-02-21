<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Home
 *
 * @ORM\Table(name="home")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HomeRepository")
 */
class Home
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
     * @ORM\Column(name="history_text", type="text")
     */
    private $historyText;

    /**
     * @var string
     *
     * @ORM\Column(name="history_img", type="string", length=255)
     */
    private $historyImg;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set historyText
     *
     * @param string $historyText
     *
     * @return Home
     */
    public function setHistoryText($historyText)
    {
        $this->historyText = $historyText;

        return $this;
    }

    /**
     * Get historyText
     *
     * @return string
     */
    public function getHistoryText()
    {
        return $this->historyText;
    }

    /**
     * Set historyImg
     *
     * @param string $historyImg
     *
     * @return Home
     */
    public function setHistoryImg($historyImg)
    {
        $this->historyImg = $historyImg;

        return $this;
    }

    /**
     * Get historyImg
     *
     * @return string
     */
    public function getHistoryImg()
    {
        return $this->historyImg;
    }
}
