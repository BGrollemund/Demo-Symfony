<?php

namespace App\Controller;

use App\Entity\Bookings;
use App\Entity\Media;
use App\Entity\Rentings;
use App\Entity\Users;
use App\Form\MediaType;
use App\Form\RentingsType;
use App\Form\UsersType;
use DateTime;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function bookings( PaginatorInterface $paginator, Request $request ): Response
    {
        $bookings = $paginator->paginate(
                    $this
                        ->getDoctrine()
                        ->getRepository(Bookings::class)
                        ->findAllQuery(),
                    $request
                        ->query->getInt('page', 1),
                    5
        );

        $guests = [];
        $rentings = [];
        foreach( $bookings as $key => $booking ) {
            $guests[] = $booking->getGuest();
            $rentings[] = $booking->getRenting();
        }

        $renting_types = [];
        $images_files = [];
        foreach( $rentings as $key => $renting ) {
            $renting_types[] = $renting->getRentingType();
            $images_files[] = $renting->getMedia()->toArray()[0];
        }

        return $this->render('admin/bookings.html.twig', [
            'bookings' => $bookings,
            'guests' => $guests,
            'rentings' => $rentings,
            'renting_types' => $renting_types,
            'images_files' => $images_files
        ]);
    }

    /**
     * @Route("/admin/ajouter-utilisateur", name="addUser")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function addUser( Request $request, UserPasswordEncoderInterface $encoder ): Response
    {
        $user = new Users();

        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $form->getData()->setPassword($encoder->encodePassword($form->getData(), $form->getData()->getPassword()));

            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('success_user', 'Un nouvel utilisateur a été ajouté');

            return $this->redirectToRoute('showUsers');
        }

        return $this->render('admin/addUser.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/modifier-utilisateur/{id}", name="editUser")
     * @param Users $user
     * @param Request $request
     * @return Response
     */
    public function editUser(Users $user, Request $request): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('success_user', 'L\'utilisateur '.$user->getUsername().' a été modifié');

            return $this->redirectToRoute('showUsers');
        }

        return $this->render('admin/addUser.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/utilisateurs", name="showUsers")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function showUsers( PaginatorInterface $paginator, Request $request ): Response
    {
        $users = $paginator->paginate(
            $this
                ->getDoctrine()
                ->getRepository(Users::class)
                ->findAllQuery(),
            $request
                ->query->getInt('page', 1),
            25
        );

        $roles = [];
        foreach( $users as $key => $user ) {
            $roles[] = $user->getRole()->getProperLabel();
        }

        return $this->render('admin/showUsers.html.twig', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * @Route("/admin/ajouter-location", name="addRenting")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function addRentings( Request $request ): Response
    {
        $renting = new Rentings();

        $form = $this->createForm(RentingsType::class, $renting);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());

            $media = new Media();
            $media
                ->setFileName('rentings/no-image.png')
                ->setUpdatedAt(new DateTime('now'))
                ->setRenting($renting);
            $em->persist($media);

            $em->flush();
            $this->addFlash('success', 'Une nouvelle location a été ajouté');

            return $this->redirectToRoute('showRentings');
        }

        return $this->render('admin/addRenting.html.twig', [
            'renting' => $renting,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/modifier-location/{id}", name="editRenting")
     * @param Rentings $renting
     * @param Request $request
     * @return Response
     */
    public function editRenting(Rentings $renting, Request $request): Response
    {
        $form = $this->createForm(RentingsType::class, $renting);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('success', 'La location '.$renting->getLabel().' a été modifié');

            return $this->redirectToRoute('showRentings');
        }

        return $this->render('admin/addRenting.html.twig', [
            'renting' => $renting,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/modifier-photo/{id}", name="editMedium")
     * @param Media $medium
     * @param Request $request
     * @return Response
     */
    public function editMedium(Media $medium, Request $request): Response
    {
        $form = $this->createForm(MediaType::class, $medium);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('success', 'La photo a été modifié');

            return $this->redirectToRoute('showRentings');
        }

        return $this->render('admin/editMedium.html.twig', [
            'medium' => $medium,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/supprimer-location/{id}", name="deleteRenting")
     * @param Rentings $renting
     * @param Request $request
     * @return Response
     */
    public function deleteRenting(Rentings $renting, Request $request): Response
    {
        if( $this->isCsrfTokenValid( 'delete'.$renting->getId(), $request->get('_token') ) ) {
            $em = $this->getDoctrine()->getManager();
            $media = $renting->getMedia();
            foreach( $media as $medium ) {
                $renting->removeMedium($medium);
            }
            $em->remove($renting);
            $em->flush();
            $this->addFlash('success', 'La location '.$renting->getLabel().' a été supprimé');

            return $this->redirectToRoute('showRentings');
        }
    }

    /**
     * @Route("/admin/locations", name="showRentings")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function showRentings( PaginatorInterface $paginator, Request $request ): Response
    {
        $rentings = $paginator->paginate(
            $this
                ->getDoctrine()
                ->getRepository(Rentings::class)
                ->findAllQuery(),
            $request
                ->query->getInt('page', 1),
            5
        );

        $renting_types = [];
        $images_files = [];
        foreach( $rentings as $key => $renting ) {
            $renting_types[] = $renting->getRentingType();
            $images_files[] = $renting->getMedia()->toArray()[0];
        }

        return $this->render('admin/showRentings.html.twig', [
            'rentings' => $rentings,
            'renting_types' => $renting_types,
            'images_files' => $images_files
        ]);
    }
}
