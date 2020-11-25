<?php

namespace App\Http\Controllers;

use App\Dataproviders\ProductAttributeDataprovider;
use App\Printer;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class PdfController extends Controller
{
    public function export($slug)
    {
        $product = Printer::findBySlug($slug, true);
        $html = view('public.products.print', [
            'product' => $product,
            'attributes' => ProductAttributeDataprovider::getComparableAttributeKeys($product->productfamily)
        ])->render();
        $header = '<table border="0" style="width: 100%"><tr><td style="width: 50%; text-align: left; border-bottom: 1px solid #ffffff">'
            .'Fotorex.hu'
            .'</td><td style="width: 50%; text-align: right; border-bottom: 1px solid #ffffff">'
            .$product->shortdisplayname
            .'</td></tr></table>';
        $pdf = new Mpdf();
        $pdf->SetHTMLHeader($header);
        $pdf->WriteHTML($html);

        $name = 'Fotorex.hu - ' . $slug.'.pdf';
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename='.$name);
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        $pdf->Output($name, 'D');
    }
}
