<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 10/05/15
 * Time: 12:07
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ProductController
 * @package AppBundle\Controller\Api
 *
 * @Route("/product")
 */
class ProductController extends FOSRestController
{
    /**
     * @param $code
     * @return Response
     */
    public function getProductsAction($code)
    {
        $em = $this->getDoctrine();
        $barcode = $em->getRepository('AppBundle:Barcode')->findOneBy(array('code' => $code));

        if($barcode)
        {
            /** @var ArrayCollection $products */
            $products = $em->getRepository('AppBundle:Product')->findByCodeId($barcode->getId());

            $view = $this->view($products, 200);
            $view->setFormat('json');

            return $this->handleView($view);
        }

        $view = $this->view([], 404);
        $view->setFormat('json');
        return $this->handleView($view);
    }
}