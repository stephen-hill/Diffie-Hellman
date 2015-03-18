<?php

use StephenHill\DiffieHellman;

class Group5Test extends PHPUnit_Framework_TestCase
{
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