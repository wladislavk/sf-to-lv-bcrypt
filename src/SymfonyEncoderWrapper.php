<?php

namespace VKR\SymfonyLaravelBCryptBridge;

use Symfony\Component\Security\Core\Encoder\NativePasswordEncoder;

class SymfonyEncoderWrapper
{
    /**
     * @param OptionsBag $optionsBag
     * @return NativePasswordEncoder
     */
    public function getEncoder(OptionsBag $optionsBag): NativePasswordEncoder
    {
        $encoder = new NativePasswordEncoder($optionsBag->getRounds());
        return $encoder;
    }
}
