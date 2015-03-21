<?php


namespace NDC\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact 
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $from;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     */
    private $message;

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
} 