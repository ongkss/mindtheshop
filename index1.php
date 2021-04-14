<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>으악</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    
</head>


<body>
    <header>
        <table id = "headerTable">      
            <tr>
                <td class = "tableTitle">
                    <input type="checkbox" name="allpart" id="allpart" onclick="selAll()">
                    <b><label for = "allpart">전체선택</label></b>
                <br><br>
                    <input type="button" id="rev" value = "선택반전" onclick="rev()">
                </td>
                <td class="partner"><input type = "checkbox" name = "dome" value = "fwc" onclick="checkclear()"> 필우커머스</td>
                <td class="partner"><input type = "checkbox" name = "dome" value = "cnw" onclick="checkclear()"> 셀러프렌드</td>
                <td class="partner"><input type = "checkbox" name = "dome" value = "zen" onclick="checkclear()"> 젠트레이드</td>
                <td class="partner"><input type = "checkbox" name = "dome" value = "snw" onclick="checkclear()"> 신우B2B</td>
                <td class="partner"><input type = "checkbox" name = "dome" value = "3mr" onclick="checkclear()"> 3MRO</td>
                <td class="partner"><input type = "checkbox" name = "dome" value = "79d" onclick="checkclear()"> 친구도매</td>
                <td class="partnerempty"></td>               
            </tr>
            <tr>
                <td class="optionTitle" rowspan="3"><b>검색옵션</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>      
            <tr>
                <td colspan="3"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              
            </tr>
            <tr>
                <td colspan="3"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              
            </tr>
        </table>
    </div>
    </header>



    <section>
        <!--<table id = "catTable">
            <tr><td>ESM<td></tr>
            <tr><td><input type = "text"><td></tr>
            <tr><td>옥션<td></tr>
            <tr><td><input type = "text"><td></tr>
            <tr><td>G마켓<td></tr>
            <tr><td><input type = "text"><td></tr>
            <tr><td>11번가<td></tr>
            <tr><td><input type = "text"><td></tr>
            <tr><td>스마트스토어<td></tr>
            <tr><td><input type = "text"><td></tr>
            <tr><td>인터파크<td></tr>
            <tr><td><input type = "text"><td></tr>
            <tr><td>이셀러스<td></tr>
            <tr><td><input type = "text"><td></tr>
        </table>-->

        <table id = "mainTable">
            <tr>
                <th>전체선택<br><br><input type = "checkbox" name = "allprdt" id = "allprdt" onclick = "selAllPd()"></th>
                <th>도매사이트<br>상품코드<br>(자체코드)</th>
                <th>이미지</th>
                <th>상품명</th>
                <th>공급가</th>
                <th>카테고리</th>
                <th>옵션명<br>(옵션갯수)</th>
                <th>옵션항목</th>
                <th>상세페이지</th>
                <th>등록일/<br>수정일</br></th>
                <th>상태</th>
                <th>정보</th>
            </tr>
            
<?php
    $feelwoo = "필우커머스";
    
    $zentrade = "젠트레이드";
    
    $fwcxml = simplexml_load_file('fwc.xml','SimpleXMLElement',LIBXML_NOCDATA);
    
    $zenxml = simplexml_load_file('zen.xml','SimpleXMLElement',LIBXML_NOCDATA);
?>

<?php
       for($i=0;$i<sizeof($fwcxml->product);$i++) {
        $product['code'][$i] = $fwcxml->product[$i]['code'];
        $product['name'][$i] = $fwcxml->product[$i]->prdtname;
        $product['img'][$i] = $fwcxml->product[$i]->listimg['url1'];
        $product['price'][$i] = $fwcxml->product[$i]->price['buyprice'];
        $product['status'][$i] = $fwcxml->product[$i]->option['runout'];    
?>
            <tr>            
                <td><input type="checkbox" name="product" value=<?php echo $product['code'][$i];?>></td>
                <td><?php echo $feelwoo;?><br><?php echo $product['code'][$i];?><br><br></td>
                <td><img src ="<?php echo $product['img'][$i];?>" width=150 height=150> </th>
                <td><?php echo $product['name'][$i];?><br><input type="text"><br><input type="text"><br><input type="text"><br></td>
                <td><?php echo $product['price'][$i];?></td>
                <td>---</td>
                <td></td>
                <td>                </td>
                <td><input type = "button" name = "detail" value = "상세페이지"></td>
                <td>/<br>2021-02-17 03:12:23</td>
                <td>
                    <?php
                        if($product['status'][$i]==0) {
                                echo "<font color = blue>";
                                echo "판매중";
                        }
                        else {
                            echo "<font color = red>";
                            echo "품절";
                        }
                    ?>
                </td>
                <td>자세히</td>
            </tr>
<?php
        }
?>

<?php
    for($i=0;$i<sizeof($zenxml->product);$i++) {
        $product['code'][$i] = $zenxml->product[$i]['code'];
        $product['name'][$i] = $zenxml->product[$i]->prdtname;
        $product['img'][$i] = $zenxml->product[$i]->listimg['url1'];
        $product['price'][$i] = $zenxml->product[$i]->price['buyprice'];
        $product['optName'][$i] = $zenxml->product[$i]->option['opt1nm'];
        $product['optcnt'][$i] = $zenxml->product[$i]->option['optcnt'];
        $product['status'][$i] = $zenxml->product[$i]->option['runout'];
        $product['detail'][$i] = $zenxml->product[$i]->content;
        $product['regdate'][$i] = $zenxml->product[$i]->status['opendate'];
        $product['opt'][$i] = $zenxml->product[$i]->option;
        $product['options'][$i] = explode('↑=↑',$product['opt'][$i]);
        
        for($j=0;$j<count($product['options'][$i]);$j++) {
            $product['option'][$i] = explode('^|^',$product['options'][$i][$j]);
        }
?>            
            <tr>
                <td><input type="checkbox" name="product" value=<?php echo $product['code'][$i];?>></td>
                <td><?php echo $zentrade;?><br><?php echo $product['code'][$i];?><br><br></td>
                <td><img src ="<?php echo $product['img'][$i];?>" width=150 height=150> </th>
                <td><?php echo $product['name'][$i];?><br><input type="text"><br><input type="text"><br><input type="text"></td>
                <td><?php echo $product['price'][$i];?></td>
                <td>---</td>
                <td><?php echo $product['optName'][$i]; echo "<br>"; echo "("; echo $product['optcnt'][$i]; echo ")";?></td>
                <td>
                    <?php
                        for($j=0;$j<count($product['options'][$i]);$j++) {
                            $optitem = explode('^|^',$product['options'][$i][$j]);
                            echo $optitem[0];
                            echo "(+";
                            echo $optitem[1]-$product['price'][$i];
                            echo ") (=";
                            echo $optitem[1];
                            echo ")";
                            echo "<br>";
                        }
                    ?>
                </td>
                <td><input type = "button" name = "detail" value = "상세페이지"></td>
                <td><?php echo $product['regdate'][$i];?>/<br>2021-02-17
                    03:12:23</br></td>
                <td>
                    <?php
                        if($product['status'][$i]==0) {
                                echo "<font color = blue>";
                                echo "판매중";
                        }
                        else {
                            echo "<font color = red>";
                            echo "품절";
                        }
                    ?></td>
                <td>자세히</td>
            </tr>
<?php
    }
?>
        </table> 

    </section>

<script type="text/javascript">
    var totalProduct = <?php sizeof($zenxml->product)+sizeof($fwcxml->product)?>;
    var dataPerPage = 5;
    var pageCount = 10;



</body>

</html>