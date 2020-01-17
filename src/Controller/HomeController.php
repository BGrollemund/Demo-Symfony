<?php

namespace App\Controller;

use App\Entity\PricesPool;
use App\Entity\RentingTypes;
use App\Entity\Seasons;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
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

        return $this->render('home/structures.html.twig', [
            'prices_pool' => $prices_pool
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
            $images_files[] = $renting_type->getMedium()->toArray()[0]->getFileName();
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
