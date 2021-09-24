<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Adresse;
use PHPUnit\Framework\TestCase;

class AdresseTest extends TestCase
{
    private Adresse $adresse;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adresse = new Adresse();
    }

    public function testGetNumero(): void
    {
        $this->assertInstanceOf(Adresse::class, $this->adresse->setNumero(2));
        $this->assertEquals(2, $this->adresse->getNumero());
    }

    public function testGetRue(): void
    {
        $this->assertInstanceOf(Adresse::class, $this->adresse->setRue('Banaudon'));
        $this->assertEquals('Banaudon', $this->adresse->getRue());
    }

    public function testGetCodePostal(): void
    {
        $this->assertInstanceOf(Adresse::class, $this->adresse->setCodePostal('69009'));
        $this->assertEquals('69009', $this->adresse->getCodePostal());
    }

    public function testGetVille(): void
    {
        $this->assertInstanceOf(Adresse::class, $this->adresse->setVille('Lyon'));
        $this->assertEquals('Lyon', $this->adresse->getVille());
    }

    public function testGetPays(): void
    {
        $this->assertInstanceOf(Adresse::class, $this->adresse->setPays('France'));
        $this->assertEquals('France', $this->adresse->getPays());
    }

}
