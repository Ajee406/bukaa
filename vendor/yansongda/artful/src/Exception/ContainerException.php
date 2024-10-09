<?php

declare(strict_types=1);

namespace Yansongda\Artful\Exception;

use Psr\Container\ContainerExceptionInterface;
use Throwable;

class ContainerException extends Exception implements ContainerExceptionInterface
{
    public function __construct(string $message = '容器异常', int $code = self::CONTAINER_ERROR, mixed $extra = null, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $extra, $previous);
    }
}
