<?php

namespace App;

use App\Trait\TimeZoneTrait;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
    use TimeZoneTrait;
    
    public function __construct(string $appEnv, bool $appDebug)
    {
        $this->changeTimeZone("Europe/Paris");
        parent::__construct($appEnv, $appDebug);
    }
}
