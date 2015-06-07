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
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BarcodeCRUDController
 * @package AppBundle\Controller
 */
class BarcodeCRUDController extends CRUDController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function trademarkTableLogisticVariablesAction(Request $request)
    {
        $trademark_id = $request->request->get('trademark_id');
        $em = $this->getDoctrine();
        $tablelogisticvariabless = $em->getRepository('AppBundle:TableLogisticVariables')->findByTrademarkId($trademark_id);

        return new JsonResponse($tablelogisticvariabless);
    }

    /**
     * @param Request $request
     * @return Response
     */
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

    /**
     * @param Request $request
     * @return Response
     */
    public function printPDFBarcodeAction(Request $request)
    {
        $barcode_id = $request->get('barcode_id');
        $em = $this->getDoctrine();
        $barcode = $em->getRepository('AppBundle:Barcode')->find($barcode_id);
        $pdf = $barcode->getPDFBarcode();

        $headers = array(
            'Content-Type'     => 'image/png',
            'Content-Disposition' => 'inline; filename="'.$barcode->getCode().'"');
        return new Response($pdf, 200, $headers);
    }
}
