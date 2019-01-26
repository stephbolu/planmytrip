<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\Step;
use App\Entity\Journey;
use App\Entity\City;

// Services
use App\Service\UtilsService;


/**
 * Step controller.
 *
 * @Route("/api")
 */
class StepController extends AbstractController
{

    /**
     * Get step by id.
     * @FOSRest\Get("/step/{idStep}")
     * 
     * @return Response
     */
    public function getStepAction(int $idStep, UtilsService $utilsService){

        $repository = $this->getDoctrine()->getRepository(Step::class);
        $step = $repository->find($idStep);

        return $utilsService->formatResponse($step);
    }

    /**
     * Lists all step of a journey.
     * @FOSRest\Get("/steps/{idJourney}")
     *
     * @return Response
     */
    public function getStepsbyJourneyAction(int $idJourney, UtilsService $utilsService){

        $repository = $this->getDoctrine()->getRepository(Step::class);
        $steps = $repository->findby(array('journey' => $idJourney));
        
        return $utilsService->formatResponse($steps);
    }

    /**
     * Create a step
     * @FOSRest\Post("/step")
     *
     * @return Response
     */
    public function createStepAction(Request $request, UtilsService $utilsService){

        // Retrieving asociated entities
        $journeyRepository = $this->getDoctrine()->getRepository(Journey::class);
        $journey = $journeyRepository->find($request->get('idJourney'));

        $cityRepository = $this->getDoctrine()->getRepository(City::class);
        $city = $cityRepository->find($request->get('idCity'));

        // Creating the new step
        $step = new Step();
        $step->setComment($request->get('comment'));
        $step->setRank($request->get('rank'));
        $step->setDuration($request->get('duration'));
        $step->setJourney($journey);
        $step->setCity($city);
        $em = $this->getDoctrine()->getManager();
        $em->persist($step);
        $em->flush();

        return $utilsService->formatResponse($step);
    }
}