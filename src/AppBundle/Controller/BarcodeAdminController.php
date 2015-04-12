<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 12/04/15
 * Time: 10:45
 */

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Barcode;
use AppBundle\Entity;

class BarcodeAdminController extends Controller{
    public function getTrademarkOptionsFromBarcodeAction($trademarkId)
    {
        $html = ""; // HTML as response
        $trade = $this->getDoctrine()
            ->getRepository('Barcode')
            ->find($trademarkId);

        $categories = $trade->getTrademark();

        foreach($categories as $cat){
            $html .= '<option value="'.$cat->getId().'" >'.$cat->getName().'</option>';
        }

        return new Response($html, 200);
    }
}
