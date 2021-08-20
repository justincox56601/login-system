<?php
/**
 * Pages Controller
 * This is the default controller
 */


 class Pages extends Controller{
	private $data = [];

	function __construct(){
		$this->userModel = $this->Model('Page');
		
	}

	//default method
	public function index($params=[]){
		$page = $params? $params : SITE_HOME;
		$this->data = $this->userModel->getPages($page);
		$this->view('pages/index', $this->data);
	}

	public function home($params=[]){
		$page = $params? $params : SITE_HOME;
		$this->data = $this->userModel->getPages($page);
		$this->view('pages/home', $this->data);
	}

	public function weather($params=[]){
		$page = $params? $params : SITE_HOME;
		$this->data = $this->userModel->getPages($page);
		$this->view('pages/weather', $this->data);
	}
 }