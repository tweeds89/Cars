<?php

namespace CarBundle\Controller;

use CarBundle\Entity\Car;
use CarBundle\Form\CarsFilterType;
use CarBundle\Form\CarType;
use CarBundle\Models\CarsFilterModel;
use PhpOffice\PhpSpreadsheet\Writer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class CarController
 * @package CarBundle\Controller
 */
class CarController extends Controller
{
    /**
     * @param Request $request
     * @param SessionInterface $session
     * @return RedirectResponse|Response
     */
    public function indexAction(Request $request, SessionInterface $session): Response
    {
        $form = $this->createForm(CarsFilterType::class, new CarsFilterModel(), ['method' => 'POST']);
        $form->handleRequest($request);

        $cars =  $this->get('car_repository')->findAll();
        $session->set('cars', $cars);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $cars = $this->get('car_repository')->findCars(
                $form->getData()->getCarBrand(),
                $form->getData()->getCarModel(),
                $form->getData()->getProductionYear(),
                $form->getData()->getFuelType()
            );

            $session->set('cars', $cars);

            return $this->render('@Car/car/index.html.twig', [
                'form' => $form->createView(),
                'cars' => $cars
            ]);
        }

        return $this->render('@Car/car/index.html.twig', [
            'form' => $form->createView(),
            'cars' => $cars
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addCarAction(Request $request): Response
    {
        $form = $this->createForm(CarType::class, new Car(), ['method' => 'POST']);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Samochód został dodany');
            return $this->redirectToRoute('car_list');
        }

        return $this->render('@Car/car/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @ParamConverter(name="car", class="CarBundle\Entity\Car", options={"id" = "car"})
     * @param Request $request
     * @param Car $car
     * @return RedirectResponse|Response
     */
    public function editCarAction(Request $request, Car $car): Response
    {
        $form = $this->createForm(CarType::class, $car, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Samochód został wyedytowany');
            return $this->redirectToRoute('car_list');
        }

        return $this->render('@Car/car/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @ParamConverter(name="car", class="CarBundle\Entity\Car", options={"id" = "car"})
     * @param Car $car
     * @return JsonResponse
     */
    public function deleteCarAction(Car $car): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($car);
        $em->flush();

        $response = new JsonResponse();
        $response->setData(['ok']);
        return $response;
    }

    /**
     * @param SessionInterface $session
     * @return Response
     * @throws \Exception
     */
    public function exportCarsAction(SessionInterface $session): Response
    {
        $cars = $session->get('cars');
        $spreadsheet = $this->get('cars_export_manager')->createSpreadsheet($cars);
        $writer = new Writer\Xlsx($spreadsheet);
        $response = new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            }
        );

        $date = new \DateTime();
        $fileName = 'Cars-import_' . $date->format('Y-m-d_H:i:s');
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');
        return $response;
    }
}
