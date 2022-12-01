<?php
namespace app\controllers;

class User extends \app\core\Controller{
	public function register(){
		if(isset($_POST['action'])){
            if($_POST['password'] == $_POST['password_confirm']){
                $user = new \app\models\User();
                $check = $user->get($_POST['username']);
                if(!$check){
                    $user->username = $_POST['username'];
                    $user->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $user->insert();
                    // $profile = new \app\models\Profile();
                    // $profile->user_id= $user->user_id;
                    // $profile->insert();
                    header('location:/User/index');
                }else{
                    header('location:/User/register?error=The username "'.$_POST['username'].'" is already in use. Select another.');
                }
            }else{
                header('location:/User/register?error=Passwords do not match.');
            }
        }else{
            $this->view('User/register');
        }

	}

	public function index(){//login
		if(isset($_POST['action'])){
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);
			if(password_verify($_POST['password'], $user->password_hash)){
				$_SESSION['user_id'] = $user->user_id;
				$_SESSION['username'] = $user->username;
				$_SESSION['role'] = $user->role;
				if($_SESSION['role']=="user"){
					header('location:/User/home');		
				}else{
					header('location:/User/index?error=Invalid User info!');
				}
			}else{
				header('location:/User/index?error=Wrong username/password combination!');
			}
		}else{
			$this->view('User/index');
		}
	}

	public function home(){
		$this->view("User/home");
	}

	public function myAccount(){
		// $userContact = new \app\models\ContactUs();
		// $userContact = $userContact->get($contact_us_id);
		// $this->view("Seller/response",['userContact'=>$userContact]);
		$this->view('User/myAccount');
	}

	public function contactUs(){
		if(isset($_POST['action'])){
			$contact = new \app\models\ContactUs();
			$contact->user_id = $_SESSION['user_id'];
			$contact->name = $_POST['name'];
			$contact->email = $_POST['email'];
			$contact->message = $_POST['message'];
			$t=time();
			$contact->send_date = date("Y-m-d",$t);
			$contact->insert();
			header('location:/User/home');		
		}else{
			$this->view('User/contactUs');
		}
	}

	public function messages(){
		$contact = new \app\models\MessageCenter();
		$contacts = $contact->getAll($_SESSION['user_id']);
		$this->view('User/messages',$contacts);
	}



}