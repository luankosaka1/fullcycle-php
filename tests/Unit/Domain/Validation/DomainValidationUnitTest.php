<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * @covers
 */
class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            DomainValidation::notNull('');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testNotNullCustomMessageException()
    {
        $exceptMessage = 'custom message error';

        try {
            DomainValidation::notNull('', $exceptMessage);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, $exceptMessage);
        }
    }

    public function testStrMaxlength()
    {
        $exceptMessage = 'custom message error';

        try {
            DomainValidation::strMaxLength('max length', 5, $exceptMessage);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, $exceptMessage);
        }
    }

    public function testStrMinlength()
    {
        $exceptMessage = 'custom message error';

        try {
            DomainValidation::strMinLength('m', 2, $exceptMessage);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, $exceptMessage);
        }
    }
}