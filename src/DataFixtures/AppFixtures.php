<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Client;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        
        $faker = Faker\Factory::create('fr_FR');

        $clients = [];

        // ================================
        // ==========Smartphones===========
        //===============================//

        $product = new Product();
        $product->setName('Xperia XZ 3')
                ->setBrand('Sony')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = null))
                ->setProperties('2Go de mémoire RAM, caméra de 15 megapixels, double SIM')
                ->setPrice(289.89)
        ;
        $manager->persist($product);

        $product = new Product();
        $product->setName('Eriksson')
                ->setBrand('Sony')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = null))
                ->setProperties('50Mo de mémoire RAM, pas de caméra, radio FM')
                ->setPrice(44.99)
        ;
        $manager->persist($product);

        $product = new Product();
        $product->setName('Lumia')
                ->setBrand('Nokia')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = null))
                ->setProperties('1.5Go de mémoire RAM, caméra de 10 megapixels, double SIM')
                ->setPrice(194.49)
        ;
        $manager->persist($product);

        $product = new Product();
        $product->setName('Galaxy G3')
                ->setBrand('Samsung')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = null))
                ->setProperties('1Go de mémoire RAM, caméra de 10 megapixels, double SIM')
                ->setPrice(289.89)
        ;
        $manager->persist($product);

        // ================================
        // ==========Customers=============
        //===============================//

        //---------Orange------------
        $client = new Client();
        $client->setName('Orange');
        $client->setEmail($faker->safeEmail);
        $client->setPassword(md5('client1'));
        $client->setRoles([Client::ROLE_ADMIN]);

        $manager->persist($client);
        $clients[] = $client;

        //--------Bouygues-----------
        $client = new Client();
        $client->setName('Bouygues');
        $client->setEmail($faker->safeEmail);
        $client->setPassword(md5('client2'));
        $client->setRoles([Client::ROLE_ADMIN]);

        $manager->persist($client);
        $clients[] = $client;

        //----------SFR--------------
        $client = new Client();
        $client->setName('SFR');
        $client->setEmail($faker->safeEmail);
        $client->setPassword(md5('client3'));
        $client->setRoles([Client::ROLE_ADMIN]);

        $manager->persist($client);
        $clients[] = $client;


        // ================================
        // ============Users===============
        //===============================//
        for($i=1; $i<=14; $i++)
        {
            $user = new User();
            $user->setUsername($faker->username);
            $user->setEmail($faker->safeEmail);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
            $user->setClient($faker->randomElement($clients));
            $user->setRoles([User::ROLE_USER]);
            $user->setDateAdd($faker->dateTimeBetween($startDate = '-8 months', $endDate = 'now', $timezone = null));

            $manager->persist($user);
        }

        $manager->flush();
    }
}