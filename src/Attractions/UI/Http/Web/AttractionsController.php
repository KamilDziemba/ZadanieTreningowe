<?php

declare(strict_types=1);

namespace App\Attractions\UI\Http\Web;

use App\Attractions\UI\Repository\AttractionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttractionsController extends AbstractController
{
    /**
     * @Route(path="/", methods={"GET"}, name="get_attractions")
     *
     * @param AttractionRepository $attractionRepository
     * @param string|null $city
     * @param string|null $street
     * @param int|null $year
     * @return Response
     */
    public function getAttractionsList(
        AttractionRepository $attractionRepository,
        ?string $city,
        ?string $street,
        ?int $year
    ): Response
    {
        return $this->render(
            'attractions.html.twig',
            ['attractions' => $attractionRepository->getAttractionsWithFilters($city, $street, $year)]
        );
    }
}