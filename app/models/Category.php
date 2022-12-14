<?php
namespace app\models;

class Category extends \app\core\Model{

	public function getAll(){
		$SQL = "SELECT * FROM category";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Category');
		return $STMT->fetchAll();
	}
}