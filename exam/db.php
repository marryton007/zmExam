<?php

	use Simplon\Mysql\Mysql;
	use Simplon\Mysql\MysqlException;
	use Simplon\Mysql\Manager\SqlManager;
	use Simplon\Mysql\Manager\SqlQueryBuilder;


	class ExamDB{
		protected $dbConn;
		protected $sqlManager;
		protected $sqlBuilder;

		public function __construct(){
			$config = array(
					'host' => SAE_MYSQL_HOST_M,
					'user' => SAE_MYSQL_USER,
					'passwd' => SAE_MYSQL_PASS,
					'db' => SAE_MYSQL_DB,
					);
            $options = array(
                    	'port' => SAE_MYSQL_PORT,
                    );
			$this->dbConn = new Mysql($config['host'], $config['user'], $config['passwd'], $config['db'], $fetchMode = \PDO::FETCH_ASSOC,
  $charset = 'utf8', $options);
			$this->sqlManager = new SqlManager($this->dbConn);
			$this->sqlBuilder = new SqlQueryBuilder();
		}

		public function getAllQuestion(){
			$this->sqlBuilder->setQuery('select * from question');
			return $this->sqlManager->fetchRowMany($this->sqlBuilder);
		}

		public function getAllUser(){
			$this->sqlBuilder->setQuery('select * from user');
			return $this->sqlManager->fetchRowMany($this->sqlBuilder);
		}

		public function getUserCount(){
			$this->sqlBuilder->setQuery('select count(*) from user');
			return $this->sqlManager->fetchColumn($this->sqlBuilder);
		}

		public function getTopUser($cnt){
			$this->sqlBuilder->setQuery("SELECT *,TIME_TO_SEC(TIMEDIFF(endtime, starttime)) cost FROM user order by score desc, cost asc LIMIT 0 , 200");
			return $this->sqlManager->fetchRowMany($this->sqlBuilder);
		}

		public function getAdminInfo(){
			$this->sqlBuilder->setQuery('select * from admin')->setConditions(array('u_name' => 'admin'));
			return $this->sqlManager->fetchRow($this->sqlBuilder);
		}

		public function insertUser($data){
				$this->sqlBuilder->setTablename('user')->setData($data);
				return  $this->sqlManager->insert($this->sqlBuilder);
		}

		/*
		   * array unique_rand( int $min, int $max, int $num )
		   * 生成一定数量的不重复随机数
		   * $min 和 $max: 指定随机数的范围
		   * $num: 指定生成数量
		   * site www.jbxue.com
		   */
		private function unique_rand($min, $max, $num) {
			$count = 0;
			$return = array();
			while ($count < $num) {
				$return[] = mt_rand($min, $max);
				$return = array_flip(array_flip($return));
				$count = count($return);
			}
			shuffle($return);
			return $return;
		}

		public function selRandRows($cnt, $tname){
			$this->sqlBuilder->setQuery("select max(id), min(id) from $tname");
			$yi = $this->sqlManager->fetchRow($this->sqlBuilder);
			$idmax = intval($yi['max(id)']);
			$idmin = intval($yi['min(id)']);

			if($idmax > 0){
				$arr = $this->unique_rand($idmin, $idmax, $cnt);
				$idlist = join(",", $arr);

				$idlist2 = "id,".$idlist;
				$sql = "select * from $tname where id in ($idlist) order by field($idlist2) limit 0, $cnt";
				$this->sqlBuilder->setQuery($sql);
				return $this->sqlManager->fetchRowMany($this->sqlBuilder);
			}
		}


	};

 ?>
