<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Adresse;
use App\Entity\Site;
use PHPUnit\Framework\TestCase;

class SiteTest extends TestCase
{
    private Site $site;

    protected function setUp(): void
    {
        parent::setUp();
        $this->site = new Site();
    }

    public function testGetType(): void
    {
        $this->assertInstanceOf(Site::class, $this->site->setType('test Type'));
        $this->assertEquals('test Type', $this->site->getType());
    }

    public function testGetCoordGPS(): void
    {
        $this->assertInstanceOf(Site::class, $this->site->setCoordGPS('1113333'));
        $this->assertEquals('1113333', $this->site->getCoordGPS());
    }

    public function testGetAdressePrincipale(): void
    {
        $adress = new Adresse();
        $this->assertInstanceOf(Site::class, $this->site->setAdressePrincipale($adress));
        $this->assertEquals($adress, $this->site->getAdressePrincipale());
    }

    public function testGetAdresseAccesConducteur(): void
    {
        $adress = new Adresse();
        $this->assertInstanceOf(Site::class, $this->site->setAdresseAccesConducteur($adress));
        $this->assertEquals($adress, $this->site->getAdresseAccesConducteur());
    }

    public function testGetName(): void
    {
        $this->assertInstanceOf(Site::class, $this->site->setName('Site chargeur 1'));
        $this->assertEquals('Site chargeur 1', $this->site->getName());
    }
}
