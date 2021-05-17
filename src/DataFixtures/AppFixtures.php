<?php

namespace App\DataFixtures;

use App\Entity\Editor;
use App\Entity\Game;
use App\Entity\Genre;
use App\Entity\Hardware;
use App\Entity\Hardwaremaker;
use App\Entity\User;
use App\Repository\EditorRepository;
use App\Repository\GameRepository;
use App\Repository\GenreRepository;
use App\Repository\HardwaremakerRepository;
use App\Repository\HardwareRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $tabHardware = [];
        $tabGenres = ["horreur","plateforme","aventure","sport","fps","tps","rpg","crpg","puzzle game"];
        $tabObjGenre = [];
        $compteur = 0;

/*        $gameRepo = new GameRepository();
        $hardwareRepo = new HardwareRepository();
        $hardwareMaker = new HardwaremakerRepository();
        $genreRepo = new GenreRepository();
        $userRepo = new UserRepository();
        $editorRepo = new EditorRepository();*/

        foreach ($tabGenres as $genre ){
            $g = new Genre();
            $g->setName($genre);
            $manager->persist($g);
            $tabObjGenre[$compteur] = $g;
            $compteur++;
        }


        $hm1 = new Hardwaremaker();
        $hm1->setName("nintendo");
        $manager->persist($hm1);
        $hm2 = new Hardwaremaker();
        $hm2->setName("sega");
        $manager->persist($hm2);
        $hm3 = new Hardwaremaker();
        $hm3->setName("sony");
        $manager->persist($hm3);
        $hm4 = new Hardwaremaker();
        $hm4->setName("microsoft");
        $manager->persist($hm4);
        $hm5 = new Hardwaremaker();
        $hm5->setName("nec");
        $manager->persist($hm5);
        $manager->flush();

        $h1 = new Hardware();
        $h1->setName("nintendo entertienment system");
        $h1->setYear(1983);
        $h1->setHardwareMaker($hm1);
        $h2 = new Hardware();
        $h2->setName("megadrive");
        $h2->setYear(1989);
        $h2->setHardwareMaker($hm2);
        $h3 = new Hardware();
        $h3->setName("playstation");
        $h3->setYear(1994);
        $h3->setHardwareMaker($hm1);
        $h4 = new Hardware();
        $h4->setName("xbox");
        $h4->setYear(2001);
        $h4->setHardwareMaker($hm1);
        $h5 = new Hardware();
        $h5->setName("pc engine");
        $h5->setYear(1988);
        $h5->setHardwareMaker($hm1);
        $manager->persist($h1);
        $manager->persist($h2);
        $manager->persist($h3);
        $manager->persist($h4);
        $manager->persist($h5);

        $e = new Editor();
        $e->setName("konami");
        $e->setYear(1973);
        $e2 = new Editor();
        $e2->setName("capcom");
        $e2->setYear(1983);
        $e3 = new Editor();
        $e3->setName("nintendo");
        $e3->setYear(1890);
        $e4 = new Editor();
        $e4->setName("sega");
        $e4->setYear(1960);
        $e5 = new Editor();
        $e5->setName("squaresoft");
        $e5->setYear(1986);
        $manager->persist($e);
        $manager->persist($e2);
        $manager->persist($e3);
        $manager->persist($e4);
        $manager->persist($e5);

        $g1 = new Game();
        $g1->setName("super mario bros");
        $g1->setYear(1983);
        $g1->setEditor($e3);
        $g1->setGenre($tabObjGenre[1]);
        $g1->setHardware($h1);
        $manager->persist($g1);

        $g2 = new Game();
        $g2->setName("sonic the hedgehog");
        $g2->setYear(1990);
        $g2->setEditor($e4);
        $g2->setGenre($tabObjGenre[1]);
        $g2->setHardware($h2);
        $manager->persist($g2);

        $g3 = new Game();
        $g3->setName("final fantasy 7");
        $g3->setYear(1997);
        $g3->setEditor($e5);
        $g3->setGenre($tabObjGenre[6]);
        $g3->setHardware($h3);
        $manager->persist($g3);

        $g4 = new Game();
        $g4->setName("biohazard");
        $g4->setYear(1997);
        $g4->setEditor($e2);
        $g4->setGenre($tabObjGenre[0]);
        $g4->setHardware($h3);
        $manager->persist($g4);


        $user = new User();
        $user->setEmail("bla@gmail.Com");
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->encoder->encodePassword($user, 'california'));
        $user->addGame($g1);
        $user->addGame($g2);
        $user->addGame($g3);
        $user->addHardware($h5);
        $manager->persist($user);
        $manager->flush();




    }
}
