<?php
namespace app\models;

class Product extends \app\core\Model{

	public function getAll(){
		$SQL = "SELECT * from product";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}


}