<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\Journey;

// Services
use App\Service\UtilsService;


/**
 * Journey controller.
 *
 * @Route("/api")
 */
class JourneyController extends AbstractController
{

    /**
     * Get journey by id.
     * @FOSRest\Get("/journey/{id}")
     * 
     *
     * @return Response
     */
    public function getJourneyAction(int $id, UtilsService $utilsService){

        $repository = $this->getDoctrine()->getRepository(Journey::class);
        $journey = $repository->find($id);

        return $utilsService->formatResponse($journey);
    }

    /**
     * Lists all Journies.
     * @FOSRest\Get("/journies")
     *
     * @return Response
     */
    public function getJourniesAction(UtilsService $utilsService){

        $repository = $this->getDoctrine()->getRepository(Journey::class);
        $journies = $repository->findall();

        return $utilsService->formatResponse($journies);
    }

    /**
     * Create Article.
     * @FOSRest\Post("/journey")
     *
     * @return Response
     */

    public function createJourneyAction(Request $request, UtilsService $utilsService){

        $journey = new Journey();
        $journey->setDescription($request->get('description'));
        $journey->setTitle($request->get('title'));
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($journey);
        $em->flush();


        return $utilsService->formatResponse($journey);
    }
}