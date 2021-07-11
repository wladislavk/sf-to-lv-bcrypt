<?php

namespace VKR\SymfonyLaravelBCryptBridge;

class OptionsBag
{
    private const DEFAULT_ROUNDS = 10;
    private const DEFAULT_COST = 10;

    /** @var int */
    private $rounds = self::DEFAULT_ROUNDS;

    /** @var int */
    private $cost = self::DEFAULT_COST;

    /**
     * OptionsBag constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (isset($options['rounds'])) {
            $this->rounds = $options['rounds'];
        }
        if (isset($options['cost'])) {
            $this->cost = $options['cost'];
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
     * @param int $cost
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'cost' => $this->cost,
        ];
    }
}
