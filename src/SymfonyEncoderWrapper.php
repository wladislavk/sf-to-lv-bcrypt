<?php

namespace VKR\SymfonyLaravelBCryptBridge;

use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class SymfonyEncoderWrapper
{
    /**
     * @param OptionsBag $optionsBag
     * @return BCryptPasswordEncoder
     */
    public function getEncoder(OptionsBag $optionsBag): BCryptPasswordEncoder
    {
        $encoder = new BCryptPasswordEncoder($optionsBag->getRounds());
        return $encoder;
    }
}
