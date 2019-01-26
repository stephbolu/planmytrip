<?php

// src/Service/UtilsService.php
namespace App\Service;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class UtilsService
{
    public function getSerializer()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());

		$serializer = new Serializer($normalizers, $encoders);

        return $serializer;
    }
}