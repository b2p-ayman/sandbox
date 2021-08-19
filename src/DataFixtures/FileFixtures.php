<?php

namespace App\DataFixtures;

use App\Entity\File;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FileFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*for ($i = 1; $i <= 10; ++$i) {
            $file = new File();
            $file->setTitre('File numéro : '.$i);
            $file->setDescription('Desciption Fil numéro : '.$i);
            $file->setUser($this->getReference(UserFixtures::USER_1_REFERENCE));
            $manager->persist($file);
        }

        $manager->flush();
        */
    }
}
