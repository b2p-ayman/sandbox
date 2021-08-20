<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testConstruct()
    {
        $user = new User();
        $this->assertEquals(['ROLE_USER'], $user->getRoles());
    }

    public function testGettersSetters()
    {
        $user = new User();

        $user->setUsername('Ayman');
        $this->assertEquals('Ayman', $user->getUsername());
        $user->setEmail('ayman@email.com');
        $this->assertEquals('ayman@email.com', $user->getEmail());
        $user->setRoles(['A', 'B']);
        $this->assertEquals(['A', 'B', 'ROLE_USER'], $user->getRoles());
    }
}
