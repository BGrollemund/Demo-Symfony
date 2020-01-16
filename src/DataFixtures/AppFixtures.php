<?php

namespace App\DataFixtures;

use App\Entity\Discount;
use App\Entity\PricesPool;
use App\Entity\PricesTax;
use App\Entity\RenterTypes;
use App\Entity\Rentings;
use App\Entity\RentingTypes;
use App\Entity\Roles;
use App\Entity\Seasons;
use App\Entity\Users;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder )
    {
        $this->encoder = $encoder;
    }

    public function load( ObjectManager $manager )
    {
        $this->loadDiscount($manager);
        $this->loadPricesPool($manager);
        $this->loadPricesTax($manager);
        $this->loadRenterTypes($manager);
        $this->loadRentingTypes($manager);
        $this->loadRoles($manager);
        $this->loadSeasons($manager);
        $this->loadUsers($manager);
        $this->loadRentings($manager);
    }

    public function loadDiscount( ObjectManager $manager )
    {
        $data = [
            [ 7, -5 ],
        ];
        foreach ( $data as $key => $datum ) {
            $discount = new Discount();
            $discount
                ->setNumDays($datum[0])
                ->setPercent($datum[1]);
            $manager->persist($discount);
        }
        $manager->flush();
    }

    public function loadPricesPool( ObjectManager $manager )
    {
        $data = [
            [ 'enfant', 100 ],
            [ 'adulte', 150 ],
        ];
        foreach ( $data as $key => $datum ) {
            $pool = new PricesPool();
            $pool
                ->setLabel($datum[0])
                ->setPrice($datum[1]);
            $manager->persist($pool);
        }
        $manager->flush();
    }

    public function loadPricesTax( ObjectManager $manager )
    {
        $data = [
            [ 'enfant', 35 ],
            [ 'adulte', 60 ],
        ];
        foreach ( $data as $key => $datum ) {
            $tax = new PricesTax();
            $tax
                ->setLabel($datum[0])
                ->setPrice($datum[1]);
            $manager->persist($tax);
        }
        $manager->flush();
    }

    public function loadRenterTypes( ObjectManager $manager )
    {
        $data = [
            'Camping',
            'Propriétaire'
        ];
        foreach ( $data as $key => $datum ) {
            $type = new RenterTypes();
            $type
                ->setLabel($datum);
            $this->setReference('renterTypes-'.$key, $type );
            $manager->persist($type);
        }
        $manager->flush();
    }

    public function loadRentings( ObjectManager $manager )
    {
        for( $i=1; $i<31; $i++ ) {
            $rand = rand(0,3);

            $mobil = new Rentings();
            $mobil
                ->setLabel('Mobile Home '.$i)
                ->setRenterType($this->getReference('renterTypes-1'))
                ->addRenter( $this->getReference('renter-'.$i))
                ->setRentingType($this->getReference('rentingTypes-'.$rand));
            $manager->persist($mobil);
        }

        for( $i=31; $i<51; $i++ ) {
            $rand = rand(0,3);

            $mobil = new Rentings();
            $mobil
                ->setLabel('Mobile Home '.$i)
                ->setRenterType($this->getReference('renterTypes-0'))
                ->setRentingType($this->getReference('rentingTypes-'.$rand));
            $manager->persist($mobil);
        }

        for( $i=1; $i<11; $i++ ) {
            $rand = rand(4,6);

            $caravan = new Rentings();
            $caravan
                ->setLabel('Caravane '.$i)
                ->setRenterType($this->getReference('renterTypes-0'))
                ->setRentingType($this->getReference('rentingTypes-'.$rand));
            $manager->persist($caravan);
        }

        for( $i=1; $i<31; $i++ ) {
            $rand = rand(7,8);

            $location = new Rentings();
            $location
                ->setLabel('Emplacement '.$i)
                ->setRenterType($this->getReference('renterTypes-0'))
                ->setRentingType($this->getReference('rentingTypes-'.$rand));
            $manager->persist($location);
        }

        $manager->flush();
    }

    public function loadRentingTypes( ObjectManager $manager )
    {
        $data = [
            [ 'Mobile-Home 3 personnes', 20 ],
            [ 'Mobile-Home 4 personnes', 24 ],
            [ 'Mobile-Home 5 personnes', 27 ],
            [ 'Mobile-Home 6-8 personnes', 34 ],
            [ 'Caravane 2 places', 15 ],
            [ 'Caravane 4 places', 18 ],
            [ 'Caravane 6 places', 24 ],
            [ 'Emplacement 8m²', 12 ],
            [ 'Emplacement 12m²', 14 ],
        ];
        foreach ( $data as $key => $datum ) {
            $type = new RentingTypes();
            $type
                ->setLabel($datum[0])
                ->setPrice($datum[1]);
            $this->setReference('rentingTypes-'.$key, $type );
            $manager->persist($type);
        }
        $manager->flush();
    }

    public function loadRoles( ObjectManager $manager )
    {
        $data = [
            'ADMIN',
            'RENTER',
        ];
        foreach ($data as $key => $datum) {
            $role = new Roles();
            $role->setLabel($datum);
            $this->setReference('roles-'.$key, $role );
            $manager->persist($role);
        }
        $manager->flush();
    }

    public function loadSeasons( ObjectManager $manager )
    {
        $data = [
            [ 'basse saison', new DateTime('2020/05/05'), new DateTime('2020/06/20'), 0 ],
            [ 'haute saison', new DateTime('2020/06/21'), new DateTime('2020/08/31'), 15 ],
            [ 'basse saison', new DateTime('2020/09/01'), new DateTime('2020/10/10'), 0 ],
        ];
        foreach ( $data as $key => $datum ) {
            $season = new Seasons();
            $season
                ->setLabel($datum[0])
                ->setStartDate($datum[1])
                ->setEndDate($datum[2])
                ->setPercent($datum[3]);
            $manager->persist($season);
        }
        $manager->flush();
    }

    public function loadUsers( ObjectManager $manager )
    {
        $faker = Factory::create('fr_FR');

        $admin = new Users();
        $admin
            ->setUserName('Admin')
            ->setPassword($this->encoder->encodePassword($admin, 'Camping3etoiles!'))
            ->setRole($this->getReference('roles-0'));
        $manager->persist($admin);

        for ( $i=1; $i<31; $i++ ) {
            $user = new Users();
            $user
                ->setUserName($faker->userName)
                ->setPassword($this->encoder->encodePassword($user, '123'))
                ->setRole($this->getReference('roles-1'));
            $this->setReference('renter-'.$i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
