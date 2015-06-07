<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 22/03/15
 * Time: 13:10
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Controller\CRUDController;

/**
 * Class ProductCRUDController
 * @package AppBundle\Controller
 */
class ProductCRUDController extends CRUDController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function trademarkBarcodeAction(Request $request)
    {
        $trademark_id = $request->request->get('trademark_id');
        $em = $this->getDoctrine();
        $barcodes = $em->getRepository('AppBundle:Barcode')->findByTrademarkId($trademark_id);
        return new JsonResponse($barcodes);
    }
}