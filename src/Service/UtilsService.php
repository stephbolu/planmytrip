<?php

// src/Service/UtilsService.php
namespace App\Service;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;


class UtilsService
{

    /**
     * Function to create and return the serializer
     */
    public function getSerializer(){

        $encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());

		$serializer = new Serializer($normalizers, $encoders);

        return $serializer;
    }


    /**
     * Function that get the data to send and serialize (JSON). 
     * It then create a response and return it.
     */
    public function formatResponse($entity){

        $serializer = $this->getSerializer();

        $data = $serializer->serialize($entity, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}