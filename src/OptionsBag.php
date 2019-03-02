<?php

namespace VKR\SymfonyLaravelBCryptBridge;

class OptionsBag
{
    private const DEFAULT_ROUNDS = 10;

    /** @var int */
    private $rounds = self::DEFAULT_ROUNDS;

    /**
     * OptionsBag constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (isset($options['rounds'])) {
            $this->rounds = $options['rounds'];
        }
    }

    /**
     * @param int $rounds
     */
    public function setRounds(int $rounds): void
    {
        $this->rounds = $rounds;
    }

    /**
     * @return int
     */
    public function getRounds(): int
    {
        return $this->rounds;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return ['cost' => $this->rounds];
    }
}
