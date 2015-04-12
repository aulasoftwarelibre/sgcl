<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 22/03/15
 * Time: 13:10
 */

namespace AppBundle\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


use Sonata\AdminBundle\Controller\CRUDController;

class BarcodeCRUDController extends CRUDController
{
    public function trademarkTableLogisticVariablesAction(Request $request)
    {
        $trademark_id = $request->request->get('trademark_id');
        $em = $this->getDoctrine();
        $logisticIndicator = $em->getRepository('TableLogisticVariables')->findByTrademarkId($trademark_id);

        return new JsonResponse($logisticIndicator);
    }
}