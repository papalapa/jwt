<?php

namespace App\Tests;

use papalapa\jwt\Decoder;
use papalapa\jwt\KeyStorage;
use papalapa\jwt\Signers\HS256;
use PHPUnit\Framework\TestCase;

class ValidatorSignersTest extends TestCase
{
    public function testSignerAddingThenGetting()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $validator = new Decoder('TEST', $keyStorage);

        $algo = 'FAKE256';
        $signer = new HS256();
        $validator->addSigner($algo, $signer);
        $this->assertEquals($signer, $validator->getSigner($algo));
    }

    public function testSignerRemovingThenGetting()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $validator = new Decoder('TEST', $keyStorage);

        $validator->removeSigner(HS256::TYPE);
        $this->assertNull($validator->getSigner(HS256::TYPE));
    }

    public function testSignersSettingThenGetting()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $validator = new Decoder('TEST', $keyStorage);

        $signers = [HS256::TYPE => new HS256()];
        $validator->setSigners($signers);
        $this->assertEquals($signers, $validator->getSigners());
    }

    public function testSignersRemovingThenGetting()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $validator = new Decoder('TEST', $keyStorage);

        $validator->removeSigners();
        $this->assertEquals([], $validator->getSigners());
    }
}
