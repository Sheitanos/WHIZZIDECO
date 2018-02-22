<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Home
 *
 * @ORM\Table(name="home")
 * @Vich\Uploadable()
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Assert\File(
     *     maxSize="1M",
     *     maxSizeMessage="Le fichier ne doit pas faire plus de 1Mo",
     *     mimeTypes={"image/png", "image/jpeg"},
     *     mimeTypesMessage="Veuillez mettre un format .jpeg ou .png"
     *)
     *
     * @Vich\UploadableField(mapping="history_image", fileNameProperty="imageName")
     *
     *
     * @var File
     */
    private $imageFile;

    //     * @Assert\Expression("this.getImageName()", message="Vous devez envoyer une image.")


    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

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

    /*
    * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
    *
    * @return Home
    */

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Home
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Home
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


}
