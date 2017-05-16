<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ProductBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ProductList
 * @ORM\Table(name="product_list")
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"name"},
 *     message="Product List with same name exists."
 * ) 
 */
class ProductList
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", unique=true, length=255, nullable=false)
     */
    private $name;
    
     /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_at", type="datetime", nullable=true)
     */
    private $modifiedAt;
    
    
   /**
    * @ORM\ManyToMany(targetEntity="Product")
    * @ORM\JoinTable(name="productlist_product",
    *      joinColumns={@ORM\JoinColumn(name="product_list_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
    *      )
    */
    private $products;


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * Get productListId
     *
     * @return integer 
     */
    public function getProductListId()
    {
        return $this->productListId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ProductList
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    
    /**
     * Set description
     *
     * @param string $description
     * @return ProductList
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ProductList
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     * @return ProductList
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime 
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }
    
    
    /**
     * 
     * Get Products
     * @return type
     */
    public function getProducts()
    {
        return $this->products;
    }
    
    /**
    * @param Product $product
    * @return bool
    */
    public function hasProduct(Product $product)
    {
        return $this->getProducts()->contains($product);
    }
}
