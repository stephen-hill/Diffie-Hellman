<?php

use StephenHill\DiffieHellman;

class WikipediaExampleTest extends PHPUnit_Framework_TestCase
{
    /**
     * http://en.wikipedia.org/wiki/Diffie–Hellman_key_exchange#Cryptographic_explanation
     */
    public function testAliceBob()
    {
        $prime = '23';
        $base = '5';

        $alice = new DiffieHellman($prime, $base, 6);
        $bob = new DiffieHellman($prime, $base, 15);

        $alicePublic = $alice->getPublic();
        $bobPublic = $bob->getPublic();

        $this->assertSame('8', $alicePublic);
        $this->assertSame('19', $bobPublic);

        $aliceSharedSecret = $alice->getSharedSecret($bobPublic);
        $bobSharedSecret = $bob->getSharedSecret($alicePublic);

        $this->assertSame('2', $aliceSharedSecret);
        $this->assertSame('2', $bobSharedSecret);
    }

    public function testAliceBobWithRandomSecret()
    {
        $prime = '23';
        $base = '5';

        $aliceSecret = mt_rand(1, mt_getrandmax());
        $bobSecret = mt_rand(1, mt_getrandmax());

        $alice = new DiffieHellman($prime, $base, $aliceSecret);
        $bob = new DiffieHellman($prime, $base, $bobSecret);

        $alicePublic = $alice->getPublic();
        $bobPublic = $bob->getPublic();

        $aliceSharedSecret = $alice->getSharedSecret($bobPublic);
        $bobSharedSecret = $bob->getSharedSecret($alicePublic);

        $this->assertSame($aliceSharedSecret, $bobSharedSecret);
    }

    public function test1536bitMODPGroup5()
    {
        $prime = '0xFFFFFFFFFFFFFFFFC90FDAA22168C234C4C6628B80DC1CD129024E088A67CC74020BBEA63B139B22514A08798E3404DDEF9519B3CD3A431B302B0A6DF25F14374FE1356D6D51C245E485B576625E7EC6F44C42E9A637ED6B0BFF5CB6F406B7EDEE386BFB5A899FA5AE9F24117C4B1FE649286651ECE45B3DC2007CB8A163BF0598DA48361C55D39A69163FA8FD24CF5F83655D23DCA3AD961C62F356208552BB9ED529077096966D670C354E4ABC9804F1746C08CA237327FFFFFFFFFFFFFFFF';
        $base = '2';

        $aliceSecret = mt_rand(1, mt_getrandmax());
        $bobSecret = mt_rand(1, mt_getrandmax());

        $alice = new DiffieHellman($prime, $base, $aliceSecret);
        $bob = new DiffieHellman($prime, $base, $bobSecret);

        $alicePublic = $alice->getPublic();
        $bobPublic = $bob->getPublic();

        $aliceSharedSecret = $alice->getSharedSecret($bobPublic);
        $bobSharedSecret = $bob->getSharedSecret($alicePublic);

        $this->assertSame($aliceSharedSecret, $bobSharedSecret);
    }

    public function test1536bitMODPGroup5with4096Secret()
    {
        $prime = '0xFFFFFFFFFFFFFFFFC90FDAA22168C234C4C6628B80DC1CD129024E088A67CC74020BBEA63B139B22514A08798E3404DDEF9519B3CD3A431B302B0A6DF25F14374FE1356D6D51C245E485B576625E7EC6F44C42E9A637ED6B0BFF5CB6F406B7EDEE386BFB5A899FA5AE9F24117C4B1FE649286651ECE45B3DC2007CB8A163BF0598DA48361C55D39A69163FA8FD24CF5F83655D23DCA3AD961C62F356208552BB9ED529077096966D670C354E4ABC9804F1746C08CA237327FFFFFFFFFFFFFFFF';
        $base = '2';

        $aliceSecret = '0x'. bin2hex(openssl_random_pseudo_bytes(4096));
        $bobSecret = '0x'. bin2hex(openssl_random_pseudo_bytes(4096));

        $alice = new DiffieHellman($prime, $base, $aliceSecret);
        $bob = new DiffieHellman($prime, $base, $bobSecret);

        $alicePublic = $alice->getPublic();
        $bobPublic = $bob->getPublic();

        $aliceSharedSecret = $alice->getSharedSecret($bobPublic);
        $bobSharedSecret = $bob->getSharedSecret($alicePublic);

        $this->assertSame($aliceSharedSecret, $bobSharedSecret);
    }
}