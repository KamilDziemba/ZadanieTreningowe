<?php

declare(strict_types=1);

namespace App\Attractions\UI\Http\Web;


use App\Attractions\UI\Model\Response\City;
use App\Attractions\UI\Model\Response\Year;
use App\Attractions\UI\Repository\AttractionRepository;
use App\Attractions\UI\Repository\FilterRepository;
use App\Attractions\UI\Service\FilterService;
use App\Shared\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttractionsController extends AbstractController
{
    /**
     * @Route(path="/attractions", methods={"GET"}, name="get_attractions")
     *
     * @param string|null $city
     * @param string|null $street
     * @param int|null $year
     * @param AttractionRepository $attractionRepository
     *
     * @return Response
     * @throws InvalidArgumentException
     *
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
            ['attractions' =>
                $attractionRepository->getAttractionsWithFilters($city, $street, $year)]
        );
    }


    /**
     * @Route(path="/", methods={"GET"}, name="get_attractions_params")
     *
     * @param FilterService $filterService
     *
     * @return Response
     * @throws InvalidArgumentException
     *
     */
    public function getAttractionsParamsList(FilterService $filterService): Response
    {
        return $this->render(
            'base.html.twig',
            [
                'years' => $filterService->findAllYearDistinct(),
                'cities' => $filterService->findAllCitiesDistinct()
            ]
        );
    }

    /**
     * @Route(path="/street", methods={"GET"}, name="get_street_params")
     *
     * @param FilterService $filterService
     * @param string $city
     * @param string $year
     *
     * @return Response
     * @throws InvalidArgumentException
     *
     */
    public function getAttractionsWithCityParamsList(
        FilterService $filterService,
        string $city,
        string $year
    ): Response
    {
        return $this->render(
            'street.html.twig',
            [   'city' => $city,
                'streets' => $filterService->findAllStreetsDistinct($city),
                'year' => $year
            ]
        );
    }

}