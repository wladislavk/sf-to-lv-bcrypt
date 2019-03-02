<?php

namespace VKR\SymfonyLaravelBCryptBridge;

class BcryptHasher
{
    private const SALT = '';

    /** @var SymfonyEncoderWrapper */
    private $symfonyEncoderWrapper;

    public function __construct(SymfonyEncoderWrapper $symfonyEncoderWrapper)
    {
        $this->symfonyEncoderWrapper = $symfonyEncoderWrapper;
    }

    /**
     * @param string $value
     * @param array $options
     * @return string
     */
    public function make($value, array $options = [])
    {
        $optionsBag = new OptionsBag($options);
        $encoder = $this->symfonyEncoderWrapper->getEncoder($optionsBag);
        $hash = $encoder->encodePassword($value, self::SALT);
        if ($hash === false) {
            throw new \RuntimeException('BCrypt is not supported on this server');
        }
        return $hash;
    }

    /**
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        $optionsBag = new OptionsBag($options);
        $encoder = $this->symfonyEncoderWrapper->getEncoder($optionsBag);
        $result = $encoder->isPasswordValid($hashedValue, $value, self::SALT);
        return $result;
    }

    /**
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        $optionsBag = new OptionsBag($options);
        $needsRehash = password_needs_rehash($hashedValue, PASSWORD_BCRYPT, $optionsBag->toArray());
        return $needsRehash;
    }

    /**
     * @param string $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        return password_get_info($hashedValue);
    }
}
