<?php

use StephenHill\DiffieHellman;

class WikipediaExampleTest extends PHPUnit_Framework_TestCase
{
    /**
     * http://en.wikipedia.org/wiki/Diffie–Hellman_key_exchange#Cryptographic_explanation
     */
    public function testAliceBob()
    {
        $prime = "23";
        $base = "5";
        
        $alice = new DiffieHellman($prime, $base, 6);
        $bob = new DiffieHellman($prime, $base, 15);
        
        $alicePublic = $alice->getPublic();
        $bobPublic = $bob->getPublic();
        
        $this->assertSame("8", $alicePublic);
        $this->assertSame("19", $bobPublic);
        
        $aliceSharedSecret = $alice->getSharedSecret($bobPublic);
        $bobSharedSecret = $bob->getSharedSecret($alicePublic);
        
        $this->assertSame("2", $aliceSharedSecret);
        $this->assertSame("2", $bobSharedSecret);
    }
}