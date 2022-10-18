<?php

namespace Core\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function __construct(
        protected string $value
    ) {
        $this->ensureisValid($value);
    }

    public static function random(): self
    {
        $uuid = RamseyUuid::uuid4()->toString();
        return new self($uuid);
    }

    private function ensureisValid(string $id)
    {
        if (!RamseyUuid::isValid($id)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $id)
            );
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}