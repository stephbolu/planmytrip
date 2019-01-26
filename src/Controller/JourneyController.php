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
    public function getJourneyAction(int $id)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $repository = $this->getDoctrine()->getRepository(Journey::class);
        $journey = $repository->find($id);
        
        $data = $serializer->serialize($journey, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
        
    }

    /**
     * Lists all Journies.
     * @FOSRest\Get("/journies")
     *
     * @return Response
     */
    public function getJourniesAction()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $repository = $this->getDoctrine()->getRepository(Journey::class);
        $journies = $repository->findall();
        
        $data = $serializer->serialize($journies, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Create Article.
     * @FOSRest\Post("/journey")
     *
     * @return Response
     */

    public function createJourneyAction(Request $request, UtilsService $utilsService)
    {

        $journey = new Journey();
        $journey->setDescription($request->get('description'));
        $journey->setTitle($request->get('title'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($journey);
        $em->flush();

        //$data =  $this->get('jms_serializer')->serialize($journey, 'json');

        $serializer = $utilsService->getSerializer();
        $data = $serializer->serialize($journey, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
        
    }
}