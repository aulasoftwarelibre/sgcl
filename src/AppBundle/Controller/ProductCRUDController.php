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

    public function productListAction(Request $request)
    {
        $code = $request->get('code');
        $em = $this->getDoctrine();
        //$barcode = $em->getRepository('AppBundle:Barcode')->findByCode($code);
        $barcode = $em->getRepository('AppBundle:Barcode')->buscarrrr($code);
        //$barcode = $em->getRepository('AppBundle:Barcode')->findBy(array('code' => $code));


        if($barcode)
        {
            $barcode_id = $barcode[0]['id'];


            //$products = $em->getRepository('AppBundle:Product')->findBy(array('barcodeCU' => $barcode_id), array('barcodeSU' => $barcode_id));
            $products = $em->getRepository('AppBundle:Product')->findByCodeId($barcode_id);

            if($products)
            {
                $text = '';
                foreach($products as $product)
                {
                    $text = $text . " - " . $product->getCode() . " -> " . $product->getName() . " - " . "<br>";
                }
            }
            else{
                $text = 'ESTE CÓDIGO (' . $code . ') NO ESTÁ ACTUALMENTE ASOCIADO A NINGÚN PRODUCTO.' . "<br>"
                ;
            }
        }
        else{
            $text = 'EL CÓDIDGO NO ESTÁ EN LA BASE DE DATOS';
        }

        $headers = array(
            'Content-Type'     => 'text/html',
            //'Content-Disposition' => 'inline; filename="'.$product->getCode().'"');
            'Content-Disposition' => 'inline; filename=""');
        return new Response($text, 200, $headers);
    }
}