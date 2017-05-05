<?php
namespace Entities;
/**
* @Table(name="produits")
* @Entity
 **/
class Product
{
    /**
     * @var int
     * @Id @Column(type="integer")
     *  @GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
     * @Column(type="string")
     **/
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}