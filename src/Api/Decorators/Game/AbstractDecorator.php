<?php
declare(strict_types=1);

namespace Api\Decorators\Game;

abstract class AbstractDecorator implements Decorator
{
    protected Decorator $decorator;

    public function __construct(Decorator $decorator)
    {
        $this->decorator = $decorator;
    }
}
