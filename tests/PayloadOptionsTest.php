<?php

namespace App\Tests;

use papalapa\jwt\PayloadOptions;
use PHPUnit\Framework\TestCase;

class PayloadOptionsTest extends TestCase
{
    public function testConfig()
    {
        $payloadOptions = new PayloadOptions([
            'alg' => $alg = 'alg_'.random_int(0, 99),
            'aud' => $aud = 'aud_'.random_int(0, 99),
            'exp' => $exp = 'exp_'.random_int(0, 99),
            'iss' => $iss = 'iss_'.random_int(0, 99),
            'jti' => $jti = 'jti_'.random_int(0, 99),
            'nbf' => $nbf = 'nbf_'.random_int(0, 99),
            'sub' => $sub = 'sub_'.random_int(0, 99),
        ]);

        $this->assertEquals($alg, $payloadOptions->getAlgArgument());
        $this->assertEquals($aud, $payloadOptions->getAudArgument());
        $this->assertEquals($exp, $payloadOptions->getExpArgument());
        $this->assertEquals($iss, $payloadOptions->getIssArgument());
        $this->assertEquals($jti, $payloadOptions->getJtiArgument());
        $this->assertEquals($nbf, $payloadOptions->getNbfArgument());
        $this->assertEquals($sub, $payloadOptions->getSubArgument());
    }

    public function testSetters()
    {
        $payloadOptions = new PayloadOptions();

        $payloadOptions->setAlgArgument($alg = 'alg_'.random_int(0, 99));
        $payloadOptions->setAudArgument($aud = 'aud_'.random_int(0, 99));
        $payloadOptions->setExpArgument($exp = 'exp_'.random_int(0, 99));
        $payloadOptions->setIssArgument($iss = 'iss_'.random_int(0, 99));
        $payloadOptions->setJtiArgument($jti = 'jti_'.random_int(0, 99));
        $payloadOptions->setNbfArgument($nbf = 'nbf_'.random_int(0, 99));
        $payloadOptions->setSubArgument($sub = 'sub_'.random_int(0, 99));

        $this->assertEquals($alg, $payloadOptions->getAlgArgument());
        $this->assertEquals($aud, $payloadOptions->getAudArgument());
        $this->assertEquals($exp, $payloadOptions->getExpArgument());
        $this->assertEquals($iss, $payloadOptions->getIssArgument());
        $this->assertEquals($jti, $payloadOptions->getJtiArgument());
        $this->assertEquals($nbf, $payloadOptions->getNbfArgument());
        $this->assertEquals($sub, $payloadOptions->getSubArgument());
    }
}
