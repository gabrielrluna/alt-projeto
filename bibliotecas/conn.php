<?php
$servidor = "localhost"; // Endereço do servidor
$usuario = "root"; // Nome de usuário do banco de dados
$senha = ""; // Senha do banco de dados
$dbname = "alt_teste"; // Nome do banco de dados

// Cria a conexão
$conn = new mysqli($servidor, $usuario, $senha, $dbname);

abstract class Conexao{
	private $_servidor;
	private $_porta;
	private $_dbUser;
	private $_dbPass;
	private $_database;
	private $_tipoDB; //1 mssql, 4 mysql

	public $_pdo;

	protected function selecionaDB($pBanco){
		if($pBanco == 4) {
			$this->_servidor = "localhost";
			$this->_porta = "3306";
			$this->_dbUser = "root";
			$this->_dbPass = "";	
			$this->_database = "alt";
            
			$this->_tipoDB = $pBanco;
        }
        
	}

	protected function conexao(){
		try{
		    $this->_pdo = new PDO('mysql:host='.$this->_servidor.';dbname='.$this->_database, $this->_dbUser, $this->_dbPass);
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		    //$this->_pdo->exec("set names utf8");
		}catch (PDOException $e){
		    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
		}
	}

	public function fechaConexao(){
		$this->_pdo = null;
	}

	protected function getTipoBD(){
		return $this->_tipoDB;
	}

}
?>