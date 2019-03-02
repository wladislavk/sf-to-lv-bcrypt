<?php

use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use VKR\SymfonyLaravelBCryptBridge\BcryptHasher;

class LaravelWrapper implements HasherContract
{
    /** @var BcryptHasher */
    private $bcryptHasher;

    /**
     * LaravelWrapper constructor.
     * @param BcryptHasher $bcryptHasher
     */
    public function __construct(BcryptHasher $bcryptHasher)
    {
        $this->bcryptHasher = $bcryptHasher;
    }

    /**
     * @param string $value
     * @param array $options
     * @return string
     */
    public function make($value, array $options = [])
    {
        return $this->bcryptHasher->make($value, $options);
    }

    /**
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        return $this->bcryptHasher->check($value, $hashedValue, $options);
    }

    /**
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return $this->bcryptHasher->needsRehash($hashedValue, $options);
    }

    /**
     * @param string $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        return $this->bcryptHasher->info($hashedValue);
    }
}
