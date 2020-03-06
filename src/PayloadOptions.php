<?php

namespace papalapa\jwt;

/**
 * Class ValidatorOptions
 *
 * @package papalapa\jwt
 */
final class PayloadOptions
{
    /**
     * @var string
     */
    private $algArgument = 'alg';

    /**
     * @var string
     */
    private $audArgument = 'aud';

    /**
     * @var string
     */
    private $expArgument = 'exp';

    /**
     * @var string
     */
    private $issArgument = 'iss';

    /**
     * @var string
     */
    private $jtiArgument = 'jti';

    /**
     * @var string
     */
    private $nbfArgument = 'nbf';

    /**
     * @var string
     */
    private $subArgument = 'sub';

    /**
     * OptionBuilder constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (isset($config['alg'])) {
            $this->algArgument = $config['alg'];
        }
        if (isset($config['aud'])) {
            $this->audArgument = $config['aud'];
        }
        if (isset($config['exp'])) {
            $this->expArgument = $config['exp'];
        }
        if (isset($config['iss'])) {
            $this->issArgument = $config['iss'];
        }
        if (isset($config['jti'])) {
            $this->jtiArgument = $config['jti'];
        }
        if (isset($config['nbf'])) {
            $this->nbfArgument = $config['nbf'];
        }
        if (isset($config['sub'])) {
            $this->subArgument = $config['sub'];
        }
    }

    /**
     * @return string
     */
    public function getAlgArgument() : string
    {
        return $this->algArgument;
    }

    /**
     * @param string $algArgument
     *
     * @return $this
     */
    public function setAlgArgument(string $algArgument) : self
    {
        $this->algArgument = $algArgument;

        return $this;
    }

    /**
     * @return string
     */
    public function getAudArgument() : string
    {
        return $this->audArgument;
    }

    /**
     * @param string $audArgument
     *
     * @return $this
     */
    public function setAudArgument(string $audArgument) : self
    {
        $this->audArgument = $audArgument;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpArgument() : string
    {
        return $this->expArgument;
    }

    /**
     * @param string $expArgument
     *
     * @return $this
     */
    public function setExpArgument(string $expArgument) : self
    {
        $this->expArgument = $expArgument;

        return $this;
    }

    /**
     * @return string
     */
    public function getIssArgument() : string
    {
        return $this->issArgument;
    }

    /**
     * @param string $issArgument
     *
     * @return $this
     */
    public function setIssArgument(string $issArgument) : self
    {
        $this->issArgument = $issArgument;

        return $this;
    }

    /**
     * @return string
     */
    public function getJtiArgument() : string
    {
        return $this->jtiArgument;
    }

    /**
     * @param string $jtiArgument
     *
     * @return $this
     */
    public function setJtiArgument(string $jtiArgument) : self
    {
        $this->jtiArgument = $jtiArgument;

        return $this;
    }

    /**
     * @return string
     */
    public function getNbfArgument() : string
    {
        return $this->nbfArgument;
    }

    /**
     * @param string $nbfArgument
     *
     * @return $this
     */
    public function setNbfArgument(string $nbfArgument) : self
    {
        $this->nbfArgument = $nbfArgument;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubArgument() : string
    {
        return $this->subArgument;
    }

    /**
     * @param string $subArgument
     *
     * @return $this
     */
    public function setSubArgument(string $subArgument) : self
    {
        $this->subArgument = $subArgument;

        return $this;
    }
}
