<?php

namespace CarBundle\Controller;

use CarBundle\Entity\CarBrand;
use CarBundle\Form\CarBrandType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CarBrandController
 * @package CarBundle\Controller
 */
class CarBrandController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $carBrands = $this->getDoctrine()->getRepository('CarBundle:CarBrand')->findAll();

        $form = $this->createForm(CarBrandType::class, new CarBrand(), ['method' => 'POST']);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('car_brand_list');
        }

        return $this->render('@Car/car_brand/index.html.twig', [
            'form' => $form->createView(),
            'carBrands' => $carBrands
        ]);
    }

    /**
     * @ParamConverter(name="carBrand", class="CarBundle\Entity\CarBrand", options={"id" = "carBrand"})
     * @param Request $request
     * @param CarBrand $carBrand
     * @return Response
     */
    public function editCarBrandAction(Request $request, CarBrand $carBrand): Response
    {
        $form = $this->createForm(CarBrandType::class, $carBrand, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Marka została zmieniona');
            return $this->redirectToRoute('car_brand_list');
        }

        return $this->render('@Car/car_brand/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @ParamConverter(name="carBrand", class="CarBundle\Entity\CarBrand", options={"id" = "carBrand"})
     * @param CarBrand $carBrand
     * @return JsonResponse
     */
    public function deleteCarBrandAction(CarBrand $carBrand): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($carBrand);
        $em->flush();

        $response = new JsonResponse();
        $response->setData(['ok']);
        return $response;
    }
}
