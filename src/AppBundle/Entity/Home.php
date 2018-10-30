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
     * @var string
     *
     * @ORM\Column(name="career_text", type="text")
     */
    private $careerText;

    /**
     * @var string
     *
     * @ORM\Column(name="univers_text", type="text")
     */
    private $universText;

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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Assert\File(
     *     maxSize="1M",
     *     maxSizeMessage="Le fichier ne doit pas faire plus de 1Mo",
     *     mimeTypes={"image/png", "image/jpeg"},
     *     mimeTypesMessage="Veuillez mettre un format .jpeg ou .png"
     *)
     *
     * @Vich\UploadableField(mapping="history_inspiration_image", fileNameProperty="inspirationImageName")
     *
     *
     * @var File
     */
    private $inspirationImageFile;

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
     * @Vich\UploadableField(mapping="history_favorite_material_image", fileNameProperty="favoriteMaterialImageName")
     *
     *
     * @var File
     */
    private $favoriteMaterialImageFile;


    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $inspirationImageName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $favoriteMaterialImageName;

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

    /**
     * @return string
     */
    public function getCareerText()
    {
        return $this->careerText;
    }

    /**
     * @param string $careerText
     * @return Home
     */
    public function setCareerText($careerText)
    {
        $this->careerText = $careerText;
        return $this;
    }

    /**
     * @return string
     */
    public function getUniversText()
    {
        return $this->universText;
    }

    /**
     * @param string $universText
     * @return Home
     */
    public function setUniversText($universText)
    {
        $this->universText = $universText;
        return $this;
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
     * @return File|null
     */
    public function getInspirationImageFile()
    {
        return $this->inspirationImageFile;
    }

    public function setInspirationImageFile(File $image = null)
    {
        $this->inspirationImageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFavoriteMaterialImageFile()
    {
        return $this->favoriteMaterialImageFile;
    }

    public function setFavoriteMaterialImageFile(File $image = null)
    {
        $this->favoriteMaterialImageFile = $image;

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
     * Get imageName
     *
     * @return string
     */
    public function getInspirationImageName()
    {
        return $this->inspirationImageName;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Home
     */
    public function setInspirationImageName($imageName)
    {
        $this->inspirationImageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getFavoriteMaterialImageName()
    {
        return $this->favoriteMaterialImageName;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Home
     */
    public function setFavoriteMaterialImageName($imageName)
    {
        $this->favoriteMaterialImageName = $imageName;

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
