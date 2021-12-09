<?php


namespace app\models;

use FPDF;

class PrintPdf
{
    private string $fontFont = 'Helvetica';
    private int $fontSizeNormal = 12;
    private int $fontSizeSmaller = 9;

    private string $destination = '';
    private Customer $customer;

    private string $company_name = 'ql.de';
    private string $company_street = 'Auf der Haid 40b';
    private string $company_zip = '79114';
    private string $company_city = 'Freiburg';
    private string $company_url = 'ql.de';
    private string $company_owner = 'Inh: Mareike Riegel';
    private string $company_telephone = '0761/2169613';
    private string $company_fax = '0761/2169614';
    private string $company_email = 'info@ql.de';

    private string $invoice_date = '';
    private string $invoice_number = '';

    public function generate(string $invoice_text, string $addendum = '', string $hintergrunds_bild = '')
    {
        $pdf = new \Fpdf\Fpdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        if (!empty($hintergrunds_bild)) $pdf->Image($hintergrunds_bild, 0, 0, 207, 300);
        //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, int fill [, mixed link]]]]]]])
        $pdf->SetFont($this->fontFont, '', $this->fontSizeNormal);
        $pdf->SetY(60);
        // $address = "$company\n$addendum\n$surname $name\n$street\n$postcode $city\n$country";
        $pdf->SetX(20);
        if (!empty($this->customer->company)) $pdf->Cell(100, 6, $this->customer->company, 0, 1, 'L');
        $pdf->SetX(20);
        if (!empty($addendum)) $pdf->Cell(100, 6, "$addendum", 0, 1, 'L');
        $pdf->SetX(20);
        if (!empty($this->customer->surname) || !empty($this->customer->name)) $pdf->Cell(100, 6, $this->customer->surname . ' ' . $this->customer->name, 0, 1, 'L');
        $pdf->SetX(20);
        $pdf->Cell(100, 6, $this->customer->street, 0, 1, 'L');
        $pdf->SetX(20);
        $pdf->Cell(100, 6, $this->customer->postcode . ' ' . $this->customer->city, 0, 1, 'L');
        $pdf->SetX(20);
        $pdf->Cell(100, 6, $this->customer->country, 0, 1, 'L');

        $pdf->SetFont($this->fontFont, '', 9);
        $pdf->SetY(32);
        $pdf->SetX(-87);
        $pdf->Cell(60, 4, $this->company_name, 0, 1, 'L');
        $pdf->SetX(-87);
        $pdf->Cell(60, 4, $this->company_street, 0, 1, 'L');
        $pdf->SetX(-87);
        $pdf->Cell(60, 4, $this->company_zip . ' ' . $this->company_city, 0, 1, 'L');
        $pdf->SetX(-87);
        $pdf->Cell(60, 4, $this->company_url, 0, 1, 'L');


        $pdf->SetFont($this->fontFont, '', $this->fontSizeSmaller);
        $pdf->SetY(32);
        $pdf->SetX(-76);
        $pdf->Cell(60, 4, $this->company_owner, 0, 1, 'R');
        $pdf->SetX(-76);
        $pdf->Cell(60, 4, 'Tel: ' . $this->company_telephone, 0, 1, 'R');
        $pdf->SetX(-76);
        $pdf->Cell(60, 4, 'Fax: ' . $this->company_fax, 0, 1, 'R');
        $pdf->SetX(-76);
        $pdf->Cell(60, 4, $this->company_email, 0, 1, 'R');


        $pdf->SetFont($this->fontFont, '', $this->fontSizeSmaller);
        $pdf->SetY(52);
        $pdf->SetX(-76);
        $pdf->Cell(60, 4, 'Freiburg, der ' . date_format((new \DateTime($this->invoice_date)), 'd.m.Y'), 0, 1, 'R');
        $pdf->SetX(-76);
        $pdf->Cell(60, 4, 'Rechnungsnr. ' . $this->invoice_number, 0, 1, 'R');


        $pdf->SetFont($this->fontFont, '', $this->fontSizeSmaller);
        $pdf->SetY(100);
        $pdf->SetX(10);
        // $pdf->MultiCell(195,0,"$invoice_text",1,1,'L');
        $pdf->MultiCell(187, 5, $invoice_text, 0, 'L');
        $pdf->Output($this->destination);
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function setDestination($value)
    {
        $this->destination = $value;
    }

    public function setInvoiceDate($value)
    {
        $this->invoice_date = $value;
    }

    public function setInvoiceNumber($value)
    {
        $this->invoice_number = $value;
    }

    public function setCompanyName($value)
    {
        $this->company_name = $value;
    }

    public function setCompanyStreet($value)
    {
        $this->company_street = $value;
    }

    public function setCompanyZip($value)
    {
        $this->company_zip = $value;
    }

    public function setCompanyCity($value)
    {
        $this->company_city = $value;
    }

    public function setCompanyUrl($value)
    {
        $this->company_url = $value;
    }

    public function setCompanyOwner($value)
    {
        $this->company_owner = $value;
    }

    public function setCompanyEmail($value)
    {
        $this->company_email = $value;
    }

    public function setCompanyTelephone($value)
    {
        $this->company_telephone = $value;
    }

    public function setCompanyFax($value)
    {
        $this->company_fax = $value;
    }
}