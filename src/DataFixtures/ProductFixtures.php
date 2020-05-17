<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

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
                ->setDateAdd($faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now', $timezone = null))
                ->setProperties('50Mo de mémoire RAM, pas de caméra, radio FM')
                ->setPrice(44.99)
        ;
        $manager->persist($product);

        $product = new Product();
        $product->setName('Lumia')
                ->setBrand('Nokia')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now', $timezone = null))
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

        $product = new Product();
        $product->setName('Priv 32 Go Noir')
                ->setBrand('BlackBerry')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = null))
                ->setProperties('32Go de mémoire, RAM 3Go, Android 5.1.1')
                ->setPrice(259.99)
        ;
        $manager->persist($product);

        $product = new Product();
        $product->setName('G8X ThinQ Dual Screen')
                ->setBrand('LG')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = null))
                ->setProperties('128Go de mémoire, RAM 6 Go, caméra 13 Megapixels, Dual SIM')
                ->setPrice(484.90)
        ;
        $manager->persist($product);

        $product = new Product();
        $product->setName('7.2')
                ->setBrand('Nokia')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now', $timezone = null))
                ->setProperties('128Go de mémoire, RAM 6Go, 48 megapixels, Dual SIM')
                ->setPrice(349.00)
        ;
        $manager->persist($product);

        $product = new Product();
        $product->setName('P40 Pro')
                ->setBrand('Huawei')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = null))
                ->setProperties('256Go de mémoire, Réseau 5G, 50 megapixels')
                ->setPrice(949.00)
        ;
        $manager->persist($product);

        $product = new Product();
        $product->setName('Galaxy Z Flip')
                ->setBrand('Samsung')
                ->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')
                ->setDateAdd($faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = null))
                ->setProperties('256Go de mémoire, RAM 8Go, Réseau 4G, 12 megapixels, Dual SIM')
                ->setPrice(1242.00)
        ;
        $manager->persist($product);

        $manager->flush();
    }
}
