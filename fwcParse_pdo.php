<?php
    function db_get_pdo() {
        $host = 'localhost';
        $port = '3306';
        $dbname = 'pdt';
        $charset = 'utf8';
        $username = 'root';
        $pw = 'roott';
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
        $pdo = new PDO($dsn, $username, $pw);
        return $pdo;
    }
    $pdo = db_get_pdo();

    if($pdo) {
        echo "접속 완료";
    } else {
        echo "접속 에러";
    }
    
    $feelwoo = "필우커머스";

    $fwcxml = simplexml_load_file('fwc.xml','SimpleXMLElement',LIBXML_NOCDATA);

    $wholeCode = "FWC";
        
    for($i=0;$i<sizeof($fwcxml->product);$i++) {
        $pdtCode = $fwcxml->product[$i]['code'];
        $pdtName = $fwcxml->product[$i]->prdtname;
        $pdtImg = $fwcxml->product[$i]->listimg['url1'];
        $pdtPrice = $fwcxml->product[$i]->price['buyprice'];
        $pdtDetail = $fwcxml->product[$i]->content;
        $pdtStatus = $fwcxml->product[$i]->option['runout'];
        $entCode = $wholeCode."_".$pdtCode;
        
        $stmt = $pdo->prepare("INSERT INTO pdt VALUES(?,?,?,?,?,?,?,?,now()");

        /*$stmt = $pdo->prepare("INSERT INTO pdt
                                VALUES ('{$entCode}',
                                        '{$wholeCode}',
                                        '{$pdtCode}',
                                        '{$pdtName}',
                                        '{$pdtImg}',
                                        '{$pdtPrice}',
                                        '{$pdtDetail}',
                                        '{$pdtStatus}',
                                        now())");*/
        
        $result = $stmt->execute(['{$entCode}','{$wholeCode}','{$pdtCode}','{$pdtName}','{$pdtImg}','{$pdtPrice}','{$pdtDetail}','{$pdtStatus}']);
        echo $pdtCode;
        if($result) {
            echo "ss";
        } else {
            echo "ff";
        }

    }