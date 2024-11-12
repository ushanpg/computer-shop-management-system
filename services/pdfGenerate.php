<?php
require_once '../vendor/tcpdf/tcpdf.php';

class PDF
{
    private $pdf;

    function __construct($html)
    {
        $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->pdf->setPrintHeader(true);
        $this->pdf->setPrintFooter(true);

        $this->pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 20, PDF_MARGIN_RIGHT - 10);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $this->pdf->AddPage();
        $this->pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        $this->pdf->Output(time() . '.pdf', 'I');
    }
}
