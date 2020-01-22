<?php

namespace App\DataFixtures;

use App\Entity\BookingPool;
use App\Entity\Bookings;
use App\Entity\BookingTax;
use App\Entity\Discount;
use App\Entity\Guests;
use App\Entity\Media;
use App\Entity\PdfsBooking;
use App\Entity\PdfsRenter;
use App\Entity\Presentation;
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

    public function __construct( UserPasswordEncoderInterface $encoder )
    {
        $this->encoder = $encoder;
    }

    public function load( ObjectManager $manager )
    {
        $this->loadDiscount($manager);
        $this->loadPresentation($manager);
        $this->loadPricesPool($manager);
        $this->loadPricesTax($manager);
        $this->loadRenterTypes($manager);
        $this->loadRentingTypes($manager);
        $this->loadRoles($manager);
        $this->loadSeasons($manager);
        $this->loadUsers($manager);
        $this->loadRentings($manager);
        $this->loadMedia($manager);
        $this->loadGuests($manager);
        $this->loadBookings($manager);
        $this->loadPdfsBooking($manager);
        $this->loadPdfsRenter($manager);
        $this->loadBookingRelations($manager);
    }

    public function loadBookings( ObjectManager $manager )
    {
        $data = [
            [ new DateTime('2020/05/07'), new DateTime('2020/05/20'), 1 ],
            [ new DateTime('2020/06/06'), new DateTime('2020/06/12'), 1 ],
            [ new DateTime('2020/08/22'), new DateTime('2020/08/26'), 1 ],
            [ new DateTime('2020/05/12'), new DateTime('2020/05/25'), 2 ],
            [ new DateTime('2020/07/21'), new DateTime('2020/05/24'), 2 ],
            [ new DateTime('2020/09/25'), new DateTime('2020/10/08'), 2 ],
            [ new DateTime('2020/07/07'), new DateTime('2020/07/15'), 3 ],
            [ new DateTime('2020/05/25'), new DateTime('2020/06/05'), 4 ],
            [ new DateTime('2020/06/18'), new DateTime('2020/06/22'), 4 ],
            [ new DateTime('2020/09/09'), new DateTime('2020/09/12'), 4 ],
            [ new DateTime('2020/09/15'), new DateTime('2020/10/02'), 4 ],
            [ new DateTime('2020/08/11'), new DateTime('2020/08/22'), 6 ],
            [ new DateTime('2020/06/22'), new DateTime('2020/06/28'), 7 ],
            [ new DateTime('2020/07/15'), new DateTime('2020/07/27'), 7 ],
            [ new DateTime('2020/05/22'), new DateTime('2020/06/18'), 8 ],
            [ new DateTime('2020/07/12'), new DateTime('2020/07/29'), 8 ],
            [ new DateTime('2020/05/12'), new DateTime('2020/05/19'), 10 ],
            [ new DateTime('2020/08/21'), new DateTime('2020/08/29'), 10 ],
            [ new DateTime('2020/09/12'), new DateTime('2020/09/18'), 11 ],
            [ new DateTime('2020/09/19'), new DateTime('2020/05/21'), 11 ],
            [ new DateTime('2020/07/15'), new DateTime('2020/07/18'), 21 ],
            [ new DateTime('2020/08/16'), new DateTime('2020/08/28'), 21 ],
            [ new DateTime('2020/08/22'), new DateTime('2020/08/26'), 22 ],
            [ new DateTime('2020/05/27'), new DateTime('2020/06/12'), 23 ],
            [ new DateTime('2020/09/13'), new DateTime('2020/01/10'), 23 ],
            [ new DateTime('2020/06/12'), new DateTime('2020/06/14'), 23 ],
            [ new DateTime('2020/06/16'), new DateTime('2020/06/18'), 24 ],
            [ new DateTime('2020/06/21'), new DateTime('2020/07/01'), 24 ],
            [ new DateTime('2020/08/08'), new DateTime('2020/08/12'), 25 ],
            [ new DateTime('2020/06/17'), new DateTime('2020/06/24'), 25 ],
            [ new DateTime('2020/05/17'), new DateTime('2020/05/28'), 2 ],
            [ new DateTime('2020/06/13'), new DateTime('2020/06/28'), 2 ],
            [ new DateTime('2020/07/02'), new DateTime('2020/07/28'), 2 ],
            [ new DateTime('2020/07/14'), new DateTime('2020/07/24'), 4 ],
            [ new DateTime('2020/08/08'), new DateTime('2020/08/16'), 5 ],
            [ new DateTime('2020/08/17'), new DateTime('2020/08/22'), 5 ],
            [ new DateTime('2020/06/12'), new DateTime('2020/06/24'), 8 ],
            [ new DateTime('2020/07/02'), new DateTime('2020/07/04'), 8 ],
            [ new DateTime('2020/08/02'), new DateTime('2020/08/12'), 9 ],
            [ new DateTime('2020/08/17'), new DateTime('2020/08/27'), 9 ],
            [ new DateTime('2020/05/17'), new DateTime('2020/05/24'), 3 ],
            [ new DateTime('2020/05/27'), new DateTime('2020/06/03'), 3 ],
            [ new DateTime('2020/05/28'), new DateTime('2020/06/08'), 5 ],
            [ new DateTime('2020/09/12'), new DateTime('2020/09/18'), 8 ],
            [ new DateTime('2020/09/19'), new DateTime('2020/09/22'), 8 ],
            [ new DateTime('2020/09/28'), new DateTime('2020/10/02'), 8 ],
            [ new DateTime('2020/05/28'), new DateTime('2020/06/15'), 20 ],
            [ new DateTime('2020/08/07'), new DateTime('2020/08/17'), 20 ],
            [ new DateTime('2020/07/12'), new DateTime('2020/07/23'), 21 ],
            [ new DateTime('2020/07/25'), new DateTime('2020/07/29'), 21 ],
        ];

        for( $i=1; $i<31; $i++ ) {
            $booking = new Bookings();
            $booking
                ->setStartDate($data[$i-1][0])
                ->setEndDate($data[$i-1][1])
                ->setRenting($this->getReference('mobils-'.$data[$i-1][2]))
                ->setGuest($this->getReference('guest-'.$i));
            $this->setReference('booking-'.$i, $booking);
            $manager->persist($booking);
        }

        for( $i=1; $i<11; $i++ ) {
            $booking = new Bookings();
            $booking
                ->setStartDate($data[$i+29][0])
                ->setEndDate($data[$i+29][1])
                ->setRenting($this->getReference('caravans-'.$data[$i+29][2]))
                ->setGuest($this->getReference('guest-'.($i+30)));
            $this->setReference('booking-'.($i+30), $booking);
            $manager->persist($booking);
        }

        for( $i=1; $i<11; $i++ ) {
            $booking = new Bookings();
            $booking
                ->setStartDate($data[$i+39][0])
                ->setEndDate($data[$i+39][1])
                ->setRenting($this->getReference('locations-'.$data[$i+39][2]))
                ->setGuest($this->getReference('guest-'.($i+40)));
            $this->setReference('booking-'.($i+40), $booking);
            $manager->persist($booking);
        }

        $manager->flush();
    }

    public function loadBookingRelations( ObjectManager $manager )
    {
        for( $i=1; $i<51; $i++ ) {
            $rand_total = rand(1,10);
            $rand_adults = rand(1,$rand_total);
            $rand_adults_pool = rand(0,$rand_adults);
            $rand_children = $rand_total - $rand_adults;
            $rand_children_pool = rand(0,$rand_children);

            $tax = new BookingTax();
            $tax
                ->setNumGuests($rand_children)
                ->setBooking($this->getReference('booking-'.$i))
                ->setPriceTax($this->getReference('tax-0'));
            $manager->persist($tax);

            $tax = new BookingTax();
            $tax
                ->setNumGuests($rand_adults)
                ->setBooking($this->getReference('booking-'.$i))
                ->setPriceTax($this->getReference('tax-1'));
            $manager->persist($tax);

            $pool = new BookingPool();
            $pool
                ->setNumGuests($rand_children_pool)
                ->setBooking($this->getReference('booking-'.$i))
                ->setPricePool($this->getReference('pool-0'));
            $manager->persist($pool);

            $pool = new BookingPool();
            $pool
                ->setNumGuests($rand_adults_pool)
                ->setBooking($this->getReference('booking-'.$i))
                ->setPricePool($this->getReference('pool-1'));
            $manager->persist($pool);
        }

        $manager->flush();
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

    public function loadGuests( ObjectManager $manager )
    {
        $faker = Factory::create('fr_FR');

        for( $i=1; $i<51; $i++ ) {
            $guest = new Guests();
            $guest
                ->setLastName($faker->lastName)
                ->setFirstName($faker->firstName)
                ->setEmail($faker->email)
                ->setPhoneNumber($faker->phoneNumber);
            $this->setReference('guest-'.$i, $guest);
            $manager->persist($guest);
        }

        $manager->flush();
    }

    public function loadMedia( ObjectManager $manager )
    {
        $data = [
            'location-',
            'caravan-',
            'tente-',
            'location-detail-',
            'carvan-detail-',
            'tente-detail-',
            'home-01.jpg',
            'pool-01.jpg',
            'pool-02.jpg',
            'pool-03.jpg',
            'pool-04.jpg',
        ];

        for( $i=1; $i<5; $i++ ) {
            $media = new Media();
            $media
                ->setFileName($data[0].$i.'.jpg')
                ->setUpdatedAt(new DateTime('now'))
                ->setRentingType($this->getReference('rentingTypes-'.($i-1)));
            $manager->persist($media);
        }

        for( $i=4; $i<7; $i++ ) {
            $media = new Media();
            $media
                ->setFileName($data[1].($i-3).'.jpg')
                ->setUpdatedAt(new DateTime('now'))
                ->setRentingType($this->getReference('rentingTypes-'.$i));
            $manager->persist($media);
        }

        for( $i=7; $i<9; $i++ ) {
            $media = new Media();
            $media
                ->setFileName($data[2].($i-6).'.jpg')
                ->setUpdatedAt(new DateTime('now'))
                ->setRentingType($this->getReference('rentingTypes-'.$i));
            $manager->persist($media);
        }

        for( $i=1; $i<51; $i++ ) {
            $media = new Media();
            $media
                ->setFileName($data[3].$i.'.jpg')
                ->setUpdatedAt(new DateTime('now'))
                ->setRenting($this->getReference('mobils-'.$i));
            $manager->persist($media);
        }

        for( $i=1; $i<11; $i++ ) {
            $media = new Media();
            $media
                ->setFileName($data[4].$i.'.jpg')
                ->setUpdatedAt(new DateTime('now'))
                ->setRenting($this->getReference('caravans-'.$i));
            $manager->persist($media);
        }

        for( $i=1; $i<31; $i++ ) {
            $media = new Media();
            $media
                ->setFileName($data[5].$i.'.jpg')
                ->setUpdatedAt(new DateTime('now'))
                ->setRenting($this->getReference('locations-'.$i));
            $manager->persist($media);
        }

        for( $i=1; $i<6; $i++ ) {
            $media = new Media();
            $media
                ->setFileName($data[$i+5])
                ->setUpdatedAt(new DateTime('now'))
                ->setPresentation($this->getReference('presentation'));
            $manager->persist($media);
        }

        $manager->flush();
    }

    public function loadPdfsBooking( ObjectManager $manager )
    {
        for( $i=1; $i<51; $i++ ) {
            $pdf_booking = new PdfsBooking();
            $pdf_booking
                ->setFileName('pdfs/bookings/booking-'.$i.'.pdf')
                ->setCreatedAt(new DateTime('now'))
                ->setBooking($this->getReference('booking-'.$i));
            $manager->persist($pdf_booking);

            $pdf_booking_cancel = new PdfsBooking();
            $pdf_booking_cancel
                ->setFileName('pdfs/bookings/booking-'.$i.'-cancel.pdf')
                ->setCreatedAt(new DateTime('now'))
                ->setBooking($this->getReference('booking-'.$i));
            $manager->persist($pdf_booking_cancel);
        }

        $manager->flush();
    }

    public function loadPdfsRenter( ObjectManager $manager )
    {
        for( $i=1; $i<6; $i++ ) {
            $pdf_renter = new PdfsRenter();
            $pdf_renter
                ->setFileName('pdfs/renters/retribution-'.$i.'.pdf')
                ->setCreatedAt(new DateTime('now'))
                ->setUser($this->getReference('renter-'.$i));
            $manager->persist($pdf_renter);
        }

        $manager->flush();
    }

    public function loadPresentation( ObjectManager $manager )
    {
        $faker = Factory::create('fr_FR');

        $presentation = new Presentation();
        $presentation
            ->setTitle('Bienvenue !')
            ->setDescription($faker->text(5000))
            ->setInfoPool($faker->text(800));
        $this->setReference('presentation', $presentation );
        $manager->persist($presentation);


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
            $this->setReference('pool-'.$key, $pool);
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
            $this->setReference('tax-'.$key, $tax);
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
        for( $i=1; $i<21; $i++ ) {
            $rand = rand(0,3);

            $mobil = new Rentings();
            $mobil
                ->setLabel('Mobile Home '.$i)
                ->setLocation('MH-'.$i)
                ->setRenterType($this->getReference('renterTypes-0'))
                ->setRentingType($this->getReference('rentingTypes-'.$rand));
            $this->setReference('mobils-'.$i, $mobil);
            $manager->persist($mobil);
        }

        for( $i=21; $i<51; $i++ ) {
            $rand = rand(0,3);

            $mobil = new Rentings();
            $mobil
                ->setLabel('Mobile Home '.$i)
                ->setLocation('MH-'.$i)
                ->setRenterType($this->getReference('renterTypes-1'))
                ->setRentingType($this->getReference('rentingTypes-'.$rand))
                ->setUsers($this->getReference('renter-'.($i-20)));
            $this->setReference('mobils-'.$i, $mobil);
            $manager->persist($mobil);
        }

        for( $i=1; $i<11; $i++ ) {
            $rand = rand(4,6);

            $caravan = new Rentings();
            $caravan
                ->setLabel('Caravane '.$i)
                ->setLocation('C-'.$i)
                ->setRenterType($this->getReference('renterTypes-0'))
                ->setRentingType($this->getReference('rentingTypes-'.$rand));
            $this->setReference('caravans-'.$i, $caravan);
            $manager->persist($caravan);
        }

        for( $i=1; $i<31; $i++ ) {
            $rand = rand(7,8);

            $location = new Rentings();
            $location
                ->setLabel('Emplacement '.$i)
                ->setLocation('E-'.$i)
                ->setRenterType($this->getReference('renterTypes-0'))
                ->setRentingType($this->getReference('rentingTypes-'.$rand));
            $this->setReference('locations-'.$i, $location);
            $manager->persist($location);
        }

        $manager->flush();
    }

    public function loadRentingTypes( ObjectManager $manager )
    {
        $faker = Factory::create('fr_FR');

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
                ->setPrice($datum[1])
                ->setDescription($faker->text(800));
            $this->setReference('rentingTypes-'.$key, $type );
            $manager->persist($type);
        }
        $manager->flush();
    }

    public function loadRoles( ObjectManager $manager )
    {
        $data = [
            'ROLE_USER',
            'ROLE_ADMIN'
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
            ->setUsername('Admin')
            ->setPassword($this->encoder->encodePassword($admin, 'Camping3etoiles!'))
            ->setRole($this->getReference('roles-1'));
        $manager->persist($admin);

        for ( $i=1; $i<31; $i++ ) {
            $user = new Users();
            $user
                ->setUsername($faker->userName)
                ->setPassword($this->encoder->encodePassword($user, '123'))
                ->setRole($this->getReference('roles-0'));
            $this->setReference('renter-'.$i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
