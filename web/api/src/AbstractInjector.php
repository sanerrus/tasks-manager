<?php

namespace App;

abstract class AbstractInjector
{
    public function __construct()
    {
        $this->run();
    }

    /**
     * Получаем имя класса к которому обратились.
     */
    final protected function getNameOfClass(): string
    {
        return static::class;
    }

    private function run(): void
    {
        $ref = new \ReflectionClass($this->getNameOfClass());

        $pattern = "/@Inject ([^\s]+)/";
        foreach ($ref->getProperties() as $refChild) {
            $comment = $refChild->getDocComment();
            preg_match($pattern, $comment, $matches);
            if ($matches) {
                $variable = $refChild->getName();
                $this->$variable = Kernel::getInstance()->getContainer()->get($matches[1]);
            }
        }

        $methods = $ref->getMethods();
        foreach ($methods as $refChild) {
            var_dump($refChild->getParameters());
        }
    }
}
