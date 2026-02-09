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
        // $data['products'] = $this->commonmodel->getAllRecord('tbl_product',['status'=>1, 'is_front'=>1]);
        // echo "<pre>"; print_r($data['products']); exit;
        // return view('home', $data);
        return view('welcome_message');
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
