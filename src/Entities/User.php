<?php
namespace Entities;
/**
 * @Table(name="user")
 * @Entity
 **/
class User
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
    protected $username;

    /**
     * @Column(type="string")
     **/
    protected $password;

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
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @Column(type="string")
     **/



}