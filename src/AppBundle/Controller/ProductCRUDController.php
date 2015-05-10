<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 22/03/15
 * Time: 13:10
 */

namespace AppBundle\Controller;

//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;


class ProductCRUDController extends CRUDController
{
    public function trademarkBarcodeAction(Request $request)
    {
        $trademark_id = $request->request->get('trademark_id');
        $em = $this->getDoctrine();
        $barcodes = $em->getRepository('AppBundle:Barcode')->findByTrademarkId($trademark_id);
        return new JsonResponse($barcodes);
    }
}