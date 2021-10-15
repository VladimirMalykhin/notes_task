<?php
namespace App\DataFixtures;

use App\Entity\Notes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $note = new Notes();
            $note->setName('note '.$i);
            $note->setDescription('description '.$i);
            $note->setIsDeleted(false);
            $manager->persist($note);
        }

        $manager->flush();
    }
}