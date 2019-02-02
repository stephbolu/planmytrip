<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Journey controller.
 *
 * @Route("/dashboard")
 */
final class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_index")
     * @return Response
     */
	public function indexAction(): Response
	{
        return $this->render('base.html.twig', []);
    }
}