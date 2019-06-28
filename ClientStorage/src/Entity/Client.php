<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text", length=25)
     */
    public $Firstname;
    /**
     * @ORM\Column(type="text", length=25)
     */
    public $Lastname;
    /**
     * @ORM\Column(type="date")
     */
    public $Birth;
    /**
     * @ORM\Column(type="text")
     */
    public $Email;
    /**
     * @ORM\Column(type="text", length=25)
     */
    public $Phone;

    //get methods
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFirstName(){
        return $this->Firstname;
    }
    public function getLastName(){
        return $this->Lastname;
    }
    public function getBirthDate(){
        return $this->Birth;
    }
    public function getEmail(){
        return $this->Email;
    }
    public function getPhone(){
        return $this->Phone;
    }
    //set methods

    public function setFirstName($FirstName){
        $this->Firstname = $FirstName;
    }
    public function setLastName($LastName){
        $this->Lastname = $LastName;
    }
    public function setEmail($Email){
        $this->Email = $Email;
    }
    public function setPhone($Phone){
        $this->Phone = $Phone;
    }
}
