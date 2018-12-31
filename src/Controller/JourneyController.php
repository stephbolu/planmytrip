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
use App\Entity\Journey;



/**
 * Journey controller.
 *
 * @Route("/api")
 */
class JourneyController extends AbstractController
{


    /**
     * Lists all Journies.
     * @FOSRest\Get("/journies")
     *
     * @return array
     */
    public function getJourneyAction()
    {
        $repository = $this->getDoctrine()->getRepository(Journey::class);
        
        $journey = $repository->findall();
        
        return View::create($journey, Response::HTTP_OK , []);
    }

    /**
     * Create Article.
     * @FOSRest\Post("/journey")
     *
     * @return array
     */

    public function createJourneyAction(Request $request)
    {

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $journey = new Journey();
        $journey->setDescription($request->get('description'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($journey);
        $em->flush();

        //$data =  $this->get('jms_serializer')->serialize($journey, 'json');

        $data = $serializer->serialize($journey, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
        
    }
}