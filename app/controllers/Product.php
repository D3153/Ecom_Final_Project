<?php
namespace app\controllers;

class Product extends \app\core\Controller{
	public function shopAll(){
		$product = new \app\models\Product();
			$products[] = array();
			$products['Breads'] = $product->getCategoryByName('Breads');
			$products['Cookies'] = $product->getCategoryByName('Cookies');
			$products['Pies'] = $product->getCategoryByName('Pies');
			$products['Pastries'] = $product->getCategoryByName('Pastries');
			$products['Cakes'] = $product->getCategoryByName('Cakes');
			$products['New_Arrivals'] = $product->getCategoryByName('New_Arrivals');
			$this->view('Product/shopAll', $products);
	}

	public function search(){
        $product = new \app\models\Product();
       	$products[] = array();
		$products['Breads'] = $product->search($_GET['search_term'],'1');
		$products['Cookies'] = $product->search($_GET['search_term'],'2');
		$products['Pies'] = $product->search($_GET['search_term'],'3');
		$products['Pastries'] = $product->search($_GET['search_term'],'4');
		$products['Cakes'] = $product->search($_GET['search_term'],'5');
		$products['New_Arrivals'] = $product->search($_GET['search_term'],'6');
        $this->view('Product/shopAll', $products);
    }

    public function searchBread(){
        $product = new \app\models\Product();
       	$products[] = array();
		$products['Breads'] = $product->search($_GET['search_term'],'1');
        $this->view('Product/Bread', $products);
    }

    public function searchCookies(){
        $product = new \app\models\Product();
       	$products[] = array();
		$products['Cookies'] = $product->search($_GET['search_term'],'2');
        $this->view('Product/Cookies', $products);
    }

    public function searchPies(){
        $product = new \app\models\Product();
       	$products[] = array();
		$products['Pies'] = $product->search($_GET['search_term'],'3');
        $this->view('Product/Pies', $products);
    }

    public function searchPastries(){
        $product = new \app\models\Product();
       	$products[] = array();
		$products['Pastries'] = $product->search($_GET['search_term'],'4');
        $this->view('Product/Pastries', $products);
    }

    public function searchCakes(){
        $product = new \app\models\Product();
       	$products[] = array();
		$products['Cakes'] = $product->search($_GET['search_term'],'5');
        $this->view('Product/Cakes', $products);
    }

	public function customizeCake(){
		if(isset($_POST['action'])){
			$customCake = new \app\models\customizeCake();
			$customCake->description = $_POST['description'];
			$customCake->layer = $_POST['layer'];
			$customCake->serving = $_POST['serving'];
			$customCake->flavor = $_POST['flavor'];
			$filename = $this->saveFile($_FILES['image']);
			$customCake->image = $filename;
			$price = $_POST['layer']*40 +$_POST['serving']*4.99;
			$customCake->price = $price;
			$customCake->insert();
			header('location:/Product/shopAll');
		}else{
			$this->view('Product/customizeCake');
		}
	}

	public function Bread(){
		$product = new \app\models\Product();
		$products[] = array();
		$products['Breads'] = $product->getCategoryByName('Breads');
		$this->view('Product/Bread',$products);
	}

	public function Cakes(){
		$product = new \app\models\Product();
		$products[] = array();
		$products['Cakes'] = $product->getCategoryByName('Cakes');
		$this->view('Product/Cakes',$products);
	}

	public function Cookies(){
		$product = new \app\models\Product();
		$products[] = array();
		$products['Cookies'] = $product->getCategoryByName('Cookies');
		$this->view('Product/Cookies',$products);
	}

	public function Pastries(){
		$product = new \app\models\Product();
		$products[] = array();
		$products['Pastries'] = $product->getCategoryByName('Pastries');

		$this->view('Product/Pastries',$products);
	}

	public function Pies(){
		$product = new \app\models\Product();
		$products[] = array();
		$products['Pies'] = $product->getCategoryByName('Pies');
		$this->view('Product/Pies',$products);
	}

	public function addCartProduct($product_id)
	{
		//user_id, product_id, custom_cake_id, quantity, total_price, shipping_id, status) VALUES (:user_id, :product_id, :custom_cake_id, :quantity, :total_price, :shipping_id, :status
		$cart = new \app\models\Cart();
		$product = new \app\models\Product();
		$product = $product->get($product_id);

		$cart->user_id = $_SESSION['user_id'];
		$cart->product_id = $product_id;
		$cart->quantity = 1;
		$cart->total_price = $product->price;
		$cart->custom_cake_id = null;
		$cart->shipping_id = null;
		$cart->insertIntoCart();
		var_dump($cart);
		header('location:/Product/shopAll');


		
	}

}