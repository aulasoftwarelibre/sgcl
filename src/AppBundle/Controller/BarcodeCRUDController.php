<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 22/03/15
 * Time: 13:10
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;

class BarcodeCRUDController extends CRUDController
{
    public function trademarkTableLogisticVariablesAction(Request $request)
    {
        $trademark_id = $request->request->get('trademark_id');
        $em = $this->getDoctrine();
        $tablelogisticvariabless = $em->getRepository('AppBundle:TableLogisticVariables')->findByTrademarkId($trademark_id);

        return new JsonResponse($tablelogisticvariabless);
    }

    public function renderCodebarAction(Request $request)
    {
        $barcode_id = $request->get('barcode_id');
        $em = $this->getDoctrine();
        $barcode = $em->getRepository('AppBundle:Barcode')->find($barcode_id);
        $image = $barcode->getImage();

        $headers = array(
            'Content-Type'     => 'image/png',
            'Content-Disposition' => 'inline; filename="'.$barcode->getCode().'"');
        return new Response($image, 200, $headers);
    }
}
