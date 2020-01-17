<?php

namespace App\Controller;

use App\Entity\Roles;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }

    /**
     * @Route("/admin/reservations-en-cours", name="bookings")
     */
    public function bookings()
    {
        return $this->render('admin/bookings.html.twig', [

        ]);
    }

    /**
     * @Route("/admin/ajouter-location", name="addRentings")
     */
    public function addRentings()
    {
        return $this->render('admin/addRentings.html.twig', [

        ]);
    }

    /**
     * @Route("/admin/locations", name="showRentings")
     */
    public function showRentings()
    {
        return $this->render('admin/showRentings.html.twig', [

        ]);
    }
}
