<?php
    $host = 'localhost';
    $user = 'root';
    $pw = 'roott';
    $dbName = 'pdt';
    
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect -> set_charset("uft8");

    if(mysqli_connect_errno()){
        echo "데이터베이스 {$dbName} 접속 실패";
    }

    $feelwoo = "필우커머스";
    $xmlurl = "http://feelwoo-office.co.kr/FWC/FWCProductAPI.php?code=ZEN";
    $fwcxml = simplexml_load_file($xmlurl,'SimpleXMLElement',LIBXML_NOCDATA);

    $wholeCode = "FWC";
        
    for($i=0;$i<count($fwcxml->product);$i++) {
        $pdtCode = $fwcxml->product[$i]['code'];
        $pdtName = $fwcxml->product[$i]->prdtname;
        $pdtImg =   $fwcxml->product[$i]->listimg['url1']."|".
                    $fwcxml->product[$i]->listimg['url2']."|".
                    $fwcxml->product[$i]->listimg['url3'];
        $pdtPrice = $fwcxml->product[$i]->price['buyprice'];
        $pdtDetail = $fwcxml->product[$i]->content;
        $pdtStatus = $fwcxml->product[$i]->status['runout'];
        $entCode = $wholeCode."_".$pdtCode;
        
        if($pdtStatus=="1") {
            $pdtStatus = "0";
        }
        else {
            $pdtStatus = "1";
        }

        $pdtFilter = $fwcxml->product[$i]->listimg['url3'];
        
        //$str = stristr($pdtImg, "sp");

        $pdtName = trim($pdtName);
        $pdtDetail = addslashes($pdtDetail);
        $pdtDetail = trim($pdtDetail);
        //변수 선언

        $sql = "UPDATE pdtstatus
                SET statusold = statusnew
                WHERE entCode = '{$entCode}'";

        $res = $dbConnect->query($sql);
        if($res) {
            echo $pdtCode." 1.상태 복사   ";
        }
        
        $sql = "UPDATE pdtstatus
                SET statusnew = '{$pdtStatus}'
                WHERE entCode = '{$entCode}'";

        $res = $dbConnect->query($sql);
        if($res) {
            echo $pdtCode." 2.상태 변경   ";
        }
        
        $sql = "UPDATE pdtstatus
                SET revdate = IF(statusold != statusnew, now(), revdate),
                    statusbool = IF(statusold != statusnew, '1', NULL)
                WHERE entCode = '{$entCode}'";
        
        $res = $dbConnect->query($sql);
        if($res) {
            echo $pdtCode." 3.상태 변경 기록<br>";
        }
        // 상태 정보 pdtstatus
            
        $sql = "UPDATE pdt
                SET Nm = IF(pdtName != '{$pdtName}', '1', NULL),
                    Im = IF(pdtImg != '{$pdtImg}', '1', NULL),
                    Pr = IF(pdtPrice != '{$pdtPrice}', '1', NULL),
                    Dt = IF(pdtDetail != '{$pdtDetail}', '1', NULL)
                WHERE entCode = '{$entCode}'";
        
        $res = $dbConnect->query($sql);
        if($res) {
            echo $pdtCode." 1.상품정보 변경조회   ";
        }

        $sql = "UPDATE pdt
                SET pdtName = '{$pdtName}',
                    pdtImg = '{$pdtImg}',
                    pdtPrice = '{$pdtPrice}',
                    pdtDetail = '{$pdtDetail}'
                WHERE entCode = '{$entCode}'";
        
        $res = $dbConnect->query($sql);
        if($res) {
            echo $pdtCode." 2.상품정보 갱신<br>";
        }
        // 상품 정보 pdt

        // 신상품 업로드        
        if($pdtName == "적립금") continue;
        if($pdtStatus != "0") continue;
        if($pdtFilter == NULL) continue;

        $sql = "INSERT IGNORE INTO
                pdt (
                    entCode,
                    wholeCode,
                    pdtCode,
                    pdtName,
                    pdtImg,
                    pdtPrice,
                    pdtDetail,
                    regDate
                )
                VALUES (
                    '{$entCode}',
                    '{$wholeCode}',
                    '{$pdtCode}',
                    '{$pdtName}',
                    '{$pdtImg}',
                    '{$pdtPrice}',
                    '{$pdtDetail}',
                    NOW()
                );";

        $res = $dbConnect->query($sql);
        if($res) {
            echo $pdtCode." 1.신상품 업로드 완료   ";
        }       

        $sql = "INSERT IGNORE INTO
                pdtStatus (
                    entCode,
                    statusnew
                )
                VALUES (
                    '{$entCode}',
                    '{$pdtStatus}'
                );";
       
       $res = $dbConnect->query($sql);
        if($res) {
           echo $pdtCode." 2.상태정보 테이블<br>";
       }
    }
    //for문 끝

    $sql = "INSERT INTO
                logstatus (
                    entCode,
                    statusold,
                    statusnew,
                    revdate)
                SELECT
                    entCode,
                    statusold,
                    statusnew,
                    revdate
                FROM pdtstatus
                WHERE statusbool = '1';";
         
        $res = $dbConnect->query($sql);
        if($res) {
            echo " -- status 로그 기록<br>";
        }
    // 상태 로그 logstatus

    $sql = "INSERT INTO
                logpdt (
                    entCode,
                    pdtNameNew,
                    revDate)
                SELECT
                    entCode,
                    pdtName,
                    now()
                FROM pdt
                WHERE Nm = '1';";

        $res = $dbConnect->query($sql);
        if($res) {
            echo " 상품명 로그 기록<br>";
        }

    $sql = "INSERT INTO
                logpdt (
                    entCode,
                    pdtImgNew,
                    revDate)
                SELECT
                    entCode,
                    pdtImg,
                    now()
                FROM pdt
                WHERE Im = '1';";

        $res = $dbConnect->query($sql);
        if($res) {
            echo " 이미지 로그 기록<br>";
        }

    $sql = "INSERT INTO
                logpdt (
                    entCode,
                    pdtPriceNew,
                    revDate)
                SELECT
                    entCode,
                    pdtPrice,
                    now()
                FROM pdt
                WHERE Pr = '1';";

        $res = $dbConnect->query($sql);
        if($res) {
            echo " 가격 기록<br>";
        }

    $sql = "INSERT INTO
                logpdt (
                    entCode,
                    pdtDetailNew,
                    revDate)
                SELECT
                    entCode,
                    pdtDetail,
                    now()
                FROM pdt
                WHERE Dt = '1';";

        $res = $dbConnect->query($sql);
        if($res) {
            echo " 상세페이지 로그 기록<br>";
        }
    // 상품 정보 로그 logpdt



?>