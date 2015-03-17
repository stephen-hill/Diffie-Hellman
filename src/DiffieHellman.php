<?php

namespace StephenHill;

class DiffieHellman
{
    /**
     * Prime number
     * @var resource|GMP
     */
    protected $prime;
    
    /**
     * Base number
     * @var resource|GMP
     */
    protected $base;
    
    /**
     * Secret number
     * @var resource|GMP
     */
    protected $secret;
    
    /**
     * Public number
     * @var resource|GMP
     */
    protected $public;
    
    public function __construct($prime, $base, $secret)
    {
        $this->prime = gmp_init($prime);
        $this->base = gmp_init($base);
        $this->secret = gmp_init($secret);
    }
    
    public function getPublic()
    {
        $this->public = gmp_powm(
            $this->base,
            $this->secret,
            $this->prime
        );
        return gmp_strval($this->public);
    }
    
    public function getSharedSecret($public)
    {
        $public = gmp_init($public);
        $sharedSecret = gmp_powm(
            $public,
            $this->secret,
            $this->prime
        );
        
        return gmp_strval($sharedSecret);
    }
}