<?php

namespace Piotr\SliderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Slider
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piotr\SliderBundle\Entity\SliderRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Slider
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
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer")
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pictureName", type="string", length=255)
     */
    private $pictureName;

    /**
     * @var string
     *
     * @ORM\Column(name="picturePath", type="string", length=255)
     */
    private $picturePath;
    
    private $tempPicturePath;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Slider
     */
    public function setLink($link) {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Slider
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set pictureName
     *
     * @param string $pictureName
     * @return Slider
     */
    public function setPictureName($pictureName) {
        $this->pictureName = $pictureName;

        return $this;
    }

    /**
     * Get pictureName
     *
     * @return string 
     */
    public function getPictureName() {
        return $this->pictureName;
    }

    /**
     * Set picturepicturePath
     *
     * @param string $picturepicturePath
     * @return Slider
     */
    public function setPicturePath($picturePath) {
        $this->picturePath = $picturePath;

        return $this;
    }

    /**
     * Get picturepicturePath
     *
     * @return string 
     */
    public function getPicturePath() {
        return $this->picturePath;
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
    	$this->file = $file;
    	if(isset($this->picturePath)) {
    		$this->tempPicturePath=$this->picturePath;
    		$this->picturePath=null;
    	} else {
    		$this->picturePath = 'initialPicturePath';
    	}
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
    	return $this->file;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
    	if (null !== $this->getFile()) {
    		$filename = sha1(uniqid(mt_rand(), true));
    		$this->pictureName = $filename.'.'.$this->getFile()->guessExtension();
    		$this->picturePath = $this->getUploadRootDir();
    		//$this->setPictureName($this->getFile()->getClientOriginalName());
    		//$this->setPictureName($this->pictureName);
    		//$this->setPicturePath($this->getUploadRootDir());
    	}
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
    	if (null === $this->getFile()) {
    		return;
    	}
    	$this->getFile()->move(
    			$this->getUploadRootDir(),
    			$this->pictureName
    	);
    	$this->file = null;
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
    	if ($file = $this->getAbsolutePicturePath()) {
    		unlink($file);
    	}
    }

    public function getAbsolutePicturePath() {
    	return null === $this->picturePath
    	? null
    	: $this->getUploadRootDir().'/'.$this->pictureName;
    }
    
    public function getWebPath() {
    	return null === $this->picturePath
    	? null
    	: $this->getUploadDir().'/'.$this->picturePath;
    }
    
    protected function getUploadRootDir() {
    	return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    protected function getUploadDir() {
    	return 'uploads/sliderPictures';
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return Slider
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
