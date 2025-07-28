<?php 
require_once("conn.php");

class SQLHelper extends Conexao {
	
	function __construct ($pBanco) {
		$this->selecionaDB($pBanco);
		$this->conexao();
	}

    private function showError($sql, $e) {
        echo $sql;
        echo '<br>erroDB: '.$e->getMessage();
    }

	public function Insere($pTabela, $pParametros) {
		$campos = "";
        $valores = "";
        
		foreach ($pParametros as $key => $value) {
			$campos .= "{$key},";

			if ($value == "DATA_ATUAL") {
				if ($this->getTipoBD() == 1) {
					$valores .= "GETDATE(),";
				} else if ($this->getTipoBD() == 4) {
					$valores .= "NOW(),";
				}
			} else {
				$valores .= "{$value},";
			}	
		}

		$campos     = substr($campos, 0, -1);
		$valores    = substr($valores, 0, -1);

		$sql = "INSERT INTO {$pTabela} ({$campos}) VALUES({$valores})";

		try {
			$count = $this->_pdo->exec($sql);
			$retorno = $this->_pdo->lastInsertId();
		} catch (PDOException $e) {
            $this->showError($sql, $e);
            $retorno = "erro";
		}

		return $retorno;
	}

	public function Atualiza($pTabela, $pParametros, $pWhere) {
        $campos = "";
        
		foreach ($pParametros as $key => $value) {
			if ($value == "DATA_ATUAL") {
				if ($this->getTipoBD() == 1) {
					$campos .=  "{$key} = GETDATE(),";
				} else if ($this->getTipoBD() == 4) {
					$campos .= "{$key} = NOW(),";
				}
			} else {
				$campos .= "{$key} = {$value},";
			}
		}

		$campos = substr($campos, 0, -1);
		$sql = "UPDATE {$pTabela} SET {$campos} WHERE {$pWhere}";
		
		try {	
			$count = $this->_pdo->exec($sql);
		} catch (PDOException $e) {
            $this->showError($sql, $e);
		}		
		
		return $count;
	}

	public function Apaga($pTabela, $pWhere) {
		if ($pTabela != "" && $pWhere != "") {
			$sql = "DELETE FROM {$pTabela} WHERE {$pWhere}";

			try {
				$count = $this->_pdo->exec($sql);
			} catch (PDOException $e) {
                $this->showError($sql, $e);
			}
		
			return $count;
		} else {
			return 0;
		}
	}

	public function PesquisaLoop($pTabela, $pCampos = "*", $pClausula = "", $pComplemento = "", $pJuncaoTabela = "") {
		if ($pTabela) {
			if ($pCampos == "") {
				$pCampos = "*";
            }
            
			if ($pClausula) {
				$pClausula = " WHERE {$pClausula}";
            }
            
			try {
				$sql = "SELECT {$pCampos} FROM {$pTabela} {$pJuncaoTabela} {$pClausula} {$pComplemento}"; 
				$result = $this->_pdo->query($sql);
				$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
                $this->showError($sql, $e);
			}

            return $rows;
		} else {
			return "pTabela";
		}
	}

	public function Pesquisa($pTabela, $pCampos = "*", $pClausula = "", $pComplemento = "", $pJuncaoTabela = "") {
		if ($pTabela) {
			if ($pCampos == "") {
				$pCampos = "*";
            }
            
			if ($pClausula) {
				$pClausula = " WHERE {$pClausula}";
            }
            
			try {
				$sql = "SELECT {$pCampos} FROM {$pTabela} {$pJuncaoTabela} {$pClausula} {$pComplemento} LIMIT 0,1"; 
				$result = $this->_pdo->query($sql);
				$row = $result->fetch();
			} catch (PDOException $e) {
				$this->showError($sql, $e);
            }
            
			return $row;
		} else {
			return "pTabela";
		}
	}
	
	function DadosUsuario($pEmail, $pSenha) {
        $sqlLogin = "SELECT usuarios.id_usuario, usuarios.id_predio, usuarios.usuario, usuarios.email, usuarios.tipo_usuario, usuarios.permissoes, usuarios.tipo, predios.nome AS nome_predio, predios.localizacao AS localizacao_predio, almoxarifados.id_almox, almoxarifados.almox FROM usuarios LEFT JOIN predios ON usuarios.id_predio = predios.id_predio LEFT JOIN almoxarifados ON usuarios.id_almox = almoxarifados.id_almox WHERE email = '{$pEmail}' AND senha = '{$pSenha}' limit 0,1";
        
        $resultLogin    = $this->_pdo->query($sqlLogin);
        $rLogin         = $resultLogin->fetch();

        if ($rLogin) {
            $dadosUsuario = (
                fId($rLogin['tipo_usuario'])."|".
                fId($rLogin['id_usuario'])."|".
                fId($rLogin['id_predio'])."|".
                fId($rLogin['usuario'])."|".
                fId($rLogin['email'])."|".
                "|".
                fId($rLogin['nome_predio'])."|".
                fId($rLogin['localizacao_predio'])."|".
                fId($rLogin['id_almox'])."|".
                fId($rLogin['almox'])."|".
                fId($rLogin['tipo'])."|".
                fId($prodsVencimento["total"])."|".
                fId($prodBaixoEst)
            );

            $confirma = true;
        } else {
            $confirma = false;
        }
				
        if ($confirma) {
            return $dadosUsuario;
        } else {
            return $confirma;
        }

        $this->fechaConexao();
	}
	
	function historico($codigo, $id, $tipoId, $etiqueta, $idUsuario, $usuario, $obs, $idExp = 0, $idMov = 0, $idAssinatura = "", $idMovEnv = 0, $envelopeMov = "", $remetenteEnv = "") {
		$fparam['codigo']		        = toString($codigo);
		$fparam['id']			        = toString($id);
		$fparam['tipo_id'] 		        = toString($tipoId);
		$fparam['etiqueta']		        = toString($etiqueta);
		$fparam['id_mov']		        = toString($idMov);
		$fparam['id_usuario']	        = toString($idUsuario);	
		$fparam['usuario']		        = toString($usuario);
		$fparam['observacao']	        = toString($obs);
		$fparam['id_exp']		        = toString($idExp);
		$fparam['assinatura'] 	        = toString($idAssinatura);
		$fparam['id_mov_envelope'] 	    = toString($idMovEnv);
		$fparam['envelope_etiqueta']    = toString($envelopeMov);
		$fparam['envelope_remetente']   = toString($remetenteEnv);				
		$fparam['dt_cadastro']	        = "DATA_ATUAL";
	
		if ($this->Insere("historico", $fparam)) {
			$retorno = 1;	
		} else {
			$retorno = 0;	
		}
		
		return $retorno;
	}

    function movimentacaoLog($idMov, $idUsu, $usuario, $msg) {
		$paramLog['id_mov'] = toString($idMov);
		$paramLog['id_usuario'] = toString($idUsu);
		$paramLog['usuario'] = toString($usuario);
		$paramLog['mensagem'] = toString($msg);
		$paramLog['dt_cadastro'] = "DATA_ATUAL";
		$paramLog['hr_cadastro'] = "DATA_ATUAL";

        $this->Insere("movimentacoes_logs", $paramLog);
    }
}
?>