<?php

namespace VKR\SymfonyLaravelBCryptBridge\Tests;

use PHPUnit\Framework\TestCase;
use VKR\SymfonyLaravelBCryptBridge\BcryptHasher;
use VKR\SymfonyLaravelBCryptBridge\SymfonyEncoderWrapper;

class BcryptHasherTest extends TestCase
{
    private const RIGHT_PASSWORD = 'foobar';
    private const WRONG_PASSWORD = 'barfoo';
    private const RIGHT_COST = 10;
    private const WRONG_COST = 20;

    /** @var BcryptHasher */
    private $bcryptHasher;

    public function setUp()
    {
        $symfonyEncoderWrapper = new SymfonyEncoderWrapper();
        $this->bcryptHasher = new BcryptHasher($symfonyEncoderWrapper);
    }

    public function testWithRightCost()
    {
        $hash = $this->bcryptHasher->make(self::RIGHT_PASSWORD);
        $needsRehash = $this->bcryptHasher->needsRehash($hash);
        $this->assertFalse($needsRehash);
        $isHashCorrect = $this->bcryptHasher->check(self::RIGHT_PASSWORD, $hash);
        $this->assertTrue($isHashCorrect);
    }

    public function testWithWrongCost()
    {
        $options = ['rounds' => self::RIGHT_COST];
        $newOptions = ['rounds' => self::WRONG_COST];
        $hash = $this->bcryptHasher->make(self::RIGHT_PASSWORD, $options);
        $needsRehash = $this->bcryptHasher->needsRehash($hash, $newOptions);
        $this->assertTrue($needsRehash);
        $isHashCorrect = $this->bcryptHasher->check(self::WRONG_PASSWORD, $hash, $newOptions);
        $this->assertFalse($isHashCorrect);
    }

    public function testWithWrongPassword()
    {
        $hash = $this->bcryptHasher->make(self::RIGHT_PASSWORD);
        $isHashCorrect = $this->bcryptHasher->check(self::WRONG_PASSWORD, $hash);
        $this->assertFalse($isHashCorrect);
    }
}
