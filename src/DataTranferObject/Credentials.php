<?php
namespace App\DataTransferObject;

use Symfony\Component\Validator\Constraints as Assert;

class Credentials
{
    /**
     * @var string|null
     * @Assert\NotBlank
     */
    private ?string $email = null;

    /**
     * @var string|null
     * @Assert\NotBlank
     */
    private ?string $password = null;

    /**
     * Undocumented function
     *
     * @param string|null $username
     */
    public function __construct(string $username = null )
    {
        $this->username = $username;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of username
     *
     * @return  string
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */ 
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }
}

