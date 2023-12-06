<?php
function db_get_pdo()
{
    $host = 'svc.sel4.cloudtype.app:30689';
    $port = '3306';
    $dbname = '20301wiki';
    $charset = 'utf8';
    $username = '20301wiki';
    $db_pw = "1234";
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $username, $db_pw);
    return $pdo;
}

function db_select($query, $param=array()){
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $st->execute($param);
        $result =$st->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $result;
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}

function db_insert($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $result = $st->execute($param);
        if ($result) {
            $last_id = $pdo->lastInsertId();
            return $last_id;
        } else {
            // 쿼리 실행에 실패한 경우, 오류 정보를 출력
            print_r($st->errorInfo());
            return false;
        }
    } catch (PDOException $ex) {
        echo "PDOException: " . $ex->getMessage();
        return false;
    } finally {
        $pdo = null;
    }
}


function db_update_delete($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $result = $st->execute($param);
        $pdo = null;
        return $result;
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}
