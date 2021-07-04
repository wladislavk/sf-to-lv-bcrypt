<?php

namespace VKR\SymfonyLaravelBCryptBridge;

use RuntimeException;

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
    public function make(string $value, array $options = []): string
    {
        $optionsBag = new OptionsBag($options);
        $encoder = $this->symfonyEncoderWrapper->getEncoder($optionsBag);
        $hash = $encoder->encodePassword($value, self::SALT);
        if (!$hash) {
            throw new RuntimeException('BCrypt is not supported on this server');
        }
        return $hash;
    }

    /**
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function check(string $value, string $hashedValue, array $options = []): bool
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
    public function needsRehash(string $hashedValue, array $options = []): bool
    {
        $optionsBag = new OptionsBag($options);
        $needsRehash = password_needs_rehash($hashedValue, PASSWORD_BCRYPT, $optionsBag->toArray());
        return $needsRehash;
    }

    /**
     * @param string $hashedValue
     * @return array
     */
    public function info(string $hashedValue): array
    {
        return password_get_info($hashedValue);
    }
}
