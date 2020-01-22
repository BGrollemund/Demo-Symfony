<?php

namespace App\Controller;


use App\Entity\Bookings;
use App\Entity\Guests;
use App\Entity\Presentation;
use App\Entity\PricesPool;
use App\Entity\Rentings;
use App\Entity\RentingTypes;
use App\Entity\Seasons;
use App\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * @Route("/nos-locations/reserver/{id}", name="book")
     * @param RentingTypes $renting_type
     * @param Request $request
     * @return Response
     */
    public function book(RentingTypes $renting_type, Request $request): Response
    {
        $images_files = $renting_type->getMedia()->toArray()[0];

        $seasons = $this
            ->getDoctrine()
            ->getRepository(Seasons::class)
            ->findAll();

        $booking = new Bookings();

        $form = $this->createForm(BookType::class, $booking);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {
            $renting = $this
                            ->getDoctrine()
                            ->getRepository(Rentings::class)
                            ->findOneBy(['renting_type' => $renting_type->getId()]);

            $guest = new Guests();
            $guest
                ->setLastName($form->getData()->getGuest()->getLastName())
                ->setFirstName($form->getData()->getGuest()->getFirstName())
                ->setEmail($form->getData()->getGuest()->getEmail())
                ->setPhoneNumber($form->getData()->getGuest()->getPhoneNumber());
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();

            $booking
                ->setStartDate($form->getData()->getStartDate())
                ->setEndDate($form->getData()->getEndDate())
                ->setRenting($renting)
                ->setGuest($guest);

            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('confirmBook');
        }

        return $this->render('home/book.html.twig', [
            'booking' => $booking,
            'renting_type' => $renting_type,
            'images_files' => $images_files,
            'seasons' => $seasons,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/nos-locations/confirmation-reservation", name="confirmBook")
     * @return Response
     */
    public function confirmBook(): Response
    {
        return $this->render('home/confirmBook.html.twig', [

        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $presentation = $this
                        ->getDoctrine()
                        ->getRepository(Presentation::class)
                        ->findAll();

        $image = $presentation[0]->getMedia()->toArray()[0];

        return $this->render('home/index.html.twig', [
            'presentation' => $presentation[0],
            'image' => $image
        ]);
    }

    /**
     * @Route("/nos-structures", name="structures")
     */
    public function structures()
    {
        $prices_pool = $this
                        ->getDoctrine()
                        ->getRepository(PricesPool::class)
                        ->findAll();

        $presentation = $this
            ->getDoctrine()
            ->getRepository(Presentation::class)
            ->find(1);

        $images = $presentation->getMedia()->toArray();

        return $this->render('home/structures.html.twig', [
            'prices_pool' => $prices_pool,
            'presentation' => $presentation,
            'images' => $images
        ]);
    }

    /**
     * @Route("/nos-locations", name="renting_types")
     */
    public function rentings()
    {
        $renting_types = $this
                            ->getDoctrine()
                            ->getRepository(RentingTypes::class)
                            ->findAll();

        $images_files = [];
        foreach( $renting_types as $key => $renting_type ) {
            $images_files[] = $renting_type->getMedia()->toArray()[0];
        }

        $seasons = $this
                        ->getDoctrine()
                        ->getRepository(Seasons::class)
                        ->findAll();

        return $this->render('home/renting_types.html.twig', [
            'renting_types' => $renting_types,
            'images_files' => $images_files,
            'seasons' => $seasons
        ]);
    }

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login( AuthenticationUtils $authenticationUtils ) {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render("home/login.html.twig", [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

}
