<?php

namespace App\Controllers;
use App\Libraries\Cart;

class Home extends BaseController
{
    public $commonmodel;
    public function __construct()
    {
        $this->commonmodel = model('App\Models\CommonModel', false);
    }
    public function index(): string
    {
        /*$param = '{"id":"5WD9560856804245W","status":"COMPLETED","payment_source":{"paypal":{"email_address":"test@yopmail.com","account_id":"VCJTZKSUYXXPC","account_status":"UNVERIFIED","name":{"given_name":"john","surname":"doe"},"address":{"country_code":"US"}}},"purchase_units":[{"reference_id":"19","payments":{"captures":[{"id":"9S0959050G211554V","status":"COMPLETED","amount":{"currency_code":"USD","value":"10.00"},"final_capture":true,"seller_protection":{"status":"ELIGIBLE","dispute_categories":["ITEM_NOT_RECEIVED","UNAUTHORIZED_TRANSACTION"]},"seller_receivable_breakdown":{"gross_amount":{"currency_code":"USD","value":"10.00"},"paypal_fee":{"currency_code":"USD","value":"0.84"},"net_amount":{"currency_code":"USD","value":"9.16"}},"invoice_id":"INV-1774507817","custom_id":"20","links":[{"href":"https:\/\/api.sandbox.paypal.com\/v2\/payments\/captures\/9S0959050G211554V","rel":"self","method":"GET"},{"href":"https:\/\/api.sandbox.paypal.com\/v2\/payments\/captures\/9S0959050G211554V\/refund","rel":"refund","method":"POST"},{"href":"https:\/\/api.sandbox.paypal.com\/v2\/checkout\/orders\/5WD9560856804245W","rel":"up","method":"GET"}],"create_time":"2026-03-26T06:52:41Z","update_time":"2026-03-26T06:52:41Z"}]}}],"payer":{"name":{"given_name":"john","surname":"doe"},"email_address":"test@yopmail.com","payer_id":"VCJTZKSUYXXPC","address":{"country_code":"US"}},"links":[{"href":"https:\/\/api.sandbox.paypal.com\/v2\/checkout\/orders\/5WD9560856804245W","rel":"self","method":"GET"}]}';
        $paramArr = json_decode($param);
        echo 'Ref ID :'.$paramArr->purchase_units[0]->reference_id;
        echo '<pre>'; print_r(json_decode($param)); exit;*/
        $data['products'] = $this->commonmodel->getAllRecord('tbl_product',['status'=>1, 'is_front'=>1]);
        // echo "<pre>"; print_r($data['products']); exit;
        return view('home', $data);
        // return view('welcome_message');
    }
    
    public function createOrder()
    {
        $baseURL = getenv('PAYPAL_BASE_URL');
        $token = paypalAccessToken();

        // 🔒 Secure amount (DB se lo ideally)
        $amount = "10.00";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $baseURL . "/v2/checkout/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer " . $token
        ];

        $data = json_encode([
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $amount
                ],
                'reference_id' => 19,
                'custom_id'   => 20,           // PayPal me store hota hai
                'invoice_id'  => 'INV-'.time(), // unique invoice id
                'description' => 'Payment for product'
            ]]
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        curl_close($ch);

        return $this->response->setJSON(json_decode($result));
    }

    public function captureOrder()
    {
        $baseURL = getenv('PAYPAL_BASE_URL');
        $token = paypalAccessToken();

        $orderID = $this->request->getJSON()->orderID;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $baseURL . "/v2/checkout/orders/$orderID/capture");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer " . $token
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);

        // 🔒 FINAL SECURITY CHECK
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // ✅ DB save (important)
            $this->commonmodel->updateRecord('tbl_product',['payment_details'=>json_encode($response)],['pro_id'=>1]);
            return $this->response->setJSON(['status' => 'success', 'response' => $response]);
        }

        return $this->response->setJSON(['status' => 'failed']);
    }

    public function contact(){
        $data['title'] = 'I am contact page, i am coming from controller';
        return view('contact', $data);
    }
    public function contact_save()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'fname'   => 'required|min_length[3]',
            'lname'   => 'required|min_length[3]',
            'email'   => 'required|valid_email',
            'phone'   => 'required|numeric|min_length[10]|max_length[10]',
            'message' => 'required|min_length[5]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
                'csrf_token' => csrf_hash()
            ]);
        }

        $data = [
            'fname'   => $this->request->getPost('fname'),
            'lname'   => $this->request->getPost('lname'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'message' => $this->request->getPost('message'),
            'added_at' => date('Y-m-d H:i:s')
        ];

        $this->commonmodel->insertRecord('tbl_contact', $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data saved successfully!',
            'csrf_token' => csrf_hash()
        ]);
    }
    public function product_details($url){
        $data['product'] = $this->commonmodel->getOneRecord('tbl_product',['url'=>$url]);
        echo "<pre>"; print_r($data['product']); exit;

    }
    public function add_to_cart(){
        $returndata = [];
        if($this->request->getMethod() == 'POST'){
            $pro_id = $_POST['pro_id'];
            $cart = cart();
            $product = $this->commonmodel->getOneRecord('tbl_product', ['pro_id'=>$pro_id]);
            if(!empty($product)){
                $cartData = array(
                    'id' => $pro_id,
                    'product_id' => $pro_id,
                    'qty' => 1,
                    'name' => $product->product_name,
                    'image' => $product->image,
                    'mrp' => $product->price,
                    'price' => $product->price,
                    'options' => array('url'=>$product->url)
                    
                );
                $result = $cart->insert($cartData);
                if($result){
                    $returndata['result'] = 'success';
                    $returndata['cartCount'] = $cart->totalItems();
                }else{
                    $returndata['result'] = 'fail';
                }
                // echo json_encode($returndata);

            }
        }
        echo json_encode($returndata); exit;

    }
    public function checkout(){
        $data = [];
        if($this->request->getMethod() == 'POST'){
            print_r($_POST); exit;
        }

        return view('checkout', $data);
    }
    public function test(){
        $cart = cart();
        echo "<pre>"; print_r($cart->contents());
        $cart->destroy();
    }
}
