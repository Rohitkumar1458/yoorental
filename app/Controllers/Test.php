<?php

namespace App\Controllers;
use App\Libraries\Cart;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Test extends BaseController
{
    public $commonmodel;
    public function __construct()
    {
        $this->commonmodel = model('App\Models\CommonModel', false);
    }
    public function index(): string
    {
        // $data['products'] = $this->commonmodel->getAllRecord('tbl_product',['status'=>1, 'is_front'=>1]);
        // echo "<pre>"; print_r($data['products']); exit;
        // return view('home', $data);
        return view('welcome_message');
    }
    public function test_pdf(){
        $mpdf = new Mpdf();

        $data['cust_info'] = [
            'company' => 'Yoorental Pvt Ltd',
            'add' => 'Arrah, Bihar',
            'phone' => '8999999999',
            'invoice_no' => 'INV54321',

        ];
        $data['bill_info'] = [
            'billing_name' => 'Brajesh Kumar',
            'billing_add' => 'Delhi, India',
            'billing_phone' => '9999999999',
        ];


        $html = view('pdf_template/invoice', $data);
        // $html = '<h1>Hello World</h1>';

        $mpdf->WriteHTML($html);

        // for preview only 
        // return $this->response
        //     ->setHeader('Content-Type', 'application/pdf')
        //     ->setBody($mpdf->Output('', 'S'));

        // for file save
        $filename = 'pdf_'.time().'.pdf';
        $filePath = './assets/pdf/'.$filename;
        $mpdf->Output($filePath, 'F');
        echo "PDF saved successfully!";
    }
    

    public function exportExcel()
    {
        $products = $this->commonmodel->getAllRecord('tbl_product',['status'=>1]);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Sl.No');
        // $sheet->mergeCells('A1:D1');

        $sheet->setCellValue('B1', 'Product Name');
        $sheet->setCellValue('C1', 'Price');
        $sheet->setCellValue('D1', 'Unit');
        $sheet->setCellValue('E1', 'Measure');

        // Dummy data
        // $sheet->setCellValue('A4', 'Bike Rent');
        // $sheet->setCellValue('B4', 2);
        // $sheet->setCellValue('C4', 500);
        // $sheet->setCellValue('D4', 1000);

        // $sheet->setCellValue('A5', 'Helmet');
        // $sheet->setCellValue('B5', 2);
        // $sheet->setCellValue('C5', 100);
        // $sheet->setCellValue('D5', 200);

        // // Total
        // $sheet->setCellValue('C7', 'Grand Total');
        // $sheet->setCellValue('D7', 1200);

        // // Bold header
        // $sheet->getStyle('A3:D3')->getFont()->setBold(true);

        // // Auto column width
        // foreach(range('A','D') as $col){
        //     $sheet->getColumnDimension($col)->setAutoSize(true);
        // }
        if(!empty($products)){
            $row = 2;
            $slNo = 1;
            foreach($products as $list){
                $sheet->setCellValue('A'.$row, $slNo);
                $sheet->setCellValue('B'.$row, $list->product_name);
                $sheet->setCellValue('C'.$row, $list->price);
                $sheet->setCellValue('D'.$row, $list->unit);
                $sheet->setCellValue('E'.$row, $list->measur);

                $row++;
                $slNo++;
            }
        }

        $writer = new Xlsx($spreadsheet);

        // File name
        $fileName = 'ProductDetails'.time().'.xlsx';

        // Download
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header("Content-Disposition: attachment;filename=\"$fileName\"");
        // header('Cache-Control: max-age=0');

        // $writer->save('php://output');
        $filePath = './assets/excelFile/'.$fileName;
        $writer->save($filePath);

        echo 'Excel file save successfully';
        
    }
    
}
