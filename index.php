<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>으악</title>
    <link rel = "stylesheet" href="style.css">
    <script src = "index.js"></script>
    <script src = "jquery-3.6.0..js"></script>

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
?>

</head>


<body>
    <header>
        <table class ="partnerTable">      
            <tr>
                <td id = "partnerAll">
                    <input
                        type = "checkbox"
                        id = "selectAllWholesale"
                        onclick = "selectAll(this, 'wholesale')">
                    <b><label for = "selectAllWholesale"> 전체선택</label></b>
                    <br>
                    <input
                        type = "button"
                        id = "selectReverse"
                        value = "선택반전"
                        onclick = "reverseSelect('selectAllWholesale', 'wholesale')">
                </td>
                <td id = "partner"><input type = "checkbox" name = "wholesale" value = "FWC" onclick="checkClear('selectAllWholesale', 'wholesale')" checked="checked"> 필우커머스</td>
                <td id = "partner"><input type = "checkbox" name = "wholesale" value = "CNW" onclick="checkClear('selectAllWholesale', 'wholesale')"> 셀러프렌드</td>
                <td id = "partner"><input type = "checkbox" name = "wholesale" value = "ZEN" onclick="checkClear('selectAllWholesale', 'wholesale')"> 젠트레이드</td>
                <td id = "partner"><input type = "checkbox" name = "wholesale" value = "SNW" onclick="checkClear('selectAllWholesale', 'wholesale')"> 신우B2B</td>
                <td id = "partner"><input type = "checkbox" name = "wholesale" value = "3MR" onclick="checkClear('selectAllWholesale', 'wholesale')"> 3MRO</td>
                <td id = "partner"><input type = "checkbox" name = "wholesale" value = "79D" onclick="checkClear('selectAllWholesale', 'wholesale')"> 친구도매</td>
                <td id = "partnerempty"></td>               
            </tr>
        </table>

        <table class = "optionTable">
            <tr>
                <td id = "optionTitle" rowspan="3"><b>검색옵션</b></td>
                
                <td id = "option1">
                    <select name = "searchDate">
                        <option value="regDate" selected>등 록 일
                        <option value="modDate">수 정 일
                </td>
                <td id = "option2"><input type = "date">  ~  <input type = "date"></td>
                <td id = "option3">가공여부
                    <input
                        type = "checkbox"
                        name = "allProcess"
                        id = "allProcess">
                <td id = "option4"></td>
            </tr>      

            
            <tr>
                <td id = "option1">
                    <select name = "searchprice">
                        <option value="price" selected>공급가 검색
                        <option value="addoption">옵션가 포함
                </td>  
                <td id = "option2"><input type = "text">  ~  <input type = "text"></td>
                <td class = "option3">
                    <input type = "checkbox" name = "process" value = "1st"> 1차  
                    <input type = "checkbox" name = "process" value = "2nd"> 2차
                    <input type = "checkbox" name = "process" value = "3rd"> 3차
                </td>
                <td class = "option4">
                    <select name = "multiCat">
                        <option value = "ESM"><input type = "checkbox" name = "mulCat" value = "ESM">ESM
            </tr>
            
            
            <tr>
                <td class="option1">
                <select name = "combineSearch">
                        <option value="dummy">통합검색
                        <option value="productCode">상품코드
                        <option value="productName">상품명</td>
                <td class="option2"><input type = "text" size="48"></td>
                <td class="option3">숨기기
                    <input type = "checkbox" name = "processHidden" value = "1st"> 1차  
                    <input type = "checkbox" name = "processHidden" value = "2nd"> 2차
                    <input type = "checkbox" name = "processHidden" value = "3rd"> 3차
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </header>

    <nav>
    
        <table class = "catTable">
            <tr><td class = "article">ESM<td></tr>
            <tr><td><input type = "text" size = "25"><td></tr>
            <tr><td class = "article">옥션<td></tr>
            <tr><td><input type = "text" size = "25"><td></tr>
            <tr><td class = "article">G마켓<td></tr>
            <tr><td><input type = "text" size = "25"><td></tr>
            <tr><td class = "article">11번가<td></tr>
            <tr><td><input type = "text" size = "25"><td></tr>
            <tr><td class = "article">스마트스토어<td></tr>
            <tr><td><input type = "text" size = "25"><td></tr>
            <tr><td class = "article">인터파크<td></tr>
            <tr><td><input type = "text" size = "25"><td></tr>
            <tr><td class = "article">이셀러스<td></tr>
            <tr><td><input type = "text" size = "25"><td></tr>
        </table>
    </nav>
    
    <section>
        <table class = "mainTable">
            <tr class = "gridRow">
                <th><label for = "selectAllProduct">전체선택</label><br>
                    <input
                        type = "checkbox"
                        id = "selectAllProduct"
                        onclick = "selectAll(this, 'product')"></th>
                <th>도매사이트<br>상품코드<br><br>(자체코드)</th>
                <th>이미지</th>
                <th>상품명<button type="button" onclick="sortTable()">정렬</button></th>
                <th>공급가</th>
                <th>카테고리</th>
                <th>옵션명<br>(옵션갯수)</th>
                <th>옵션항목</th>
                <th>상세페이지</th>
                <th>등록일 /<br>수정일</br></th>
                <th>상태</th>
                <th>정보</th>
            </tr>

        <?php
            $sql = "SELECT * FROM testpdt 
                    LEFT JOIN testpdtstatus
                    ON testpdt.entCode = testpdtstatus.entCode;";

            $res = $dbConnect->query($sql);

            while($row = mysqli_fetch_array($res)){?>
            <tr class = "productRow">
                <td>
                    <input
                        type = "checkbox"
                        name = "product"
                        value = "<?php echo $row[0]?>">
                </td>
                <td><?php   //사이트 / 코드
                    switch($row[1]) {
                        case 'FWC':
                            echo '필우커머스<br>';
                            break;
                        case 'CNW':
                            echo '셀러프렌드<br>';
                            break;
                        case 'ZEN':
                            echo '젠트레이드<br>';
                            break;
                        case 'SNW':
                            echo '신우B2B<br>';
                    }
                    echo $row[2]."<br><br>";
                    echo "("; echo $row[3]; echo ")"?>
                </td>
                <td><?php   //이미지
                    $row[6] = explode("|", $row[6]);?>
                    <a class = "preview"><img src = "<?php echo $row[6][0]?>" width = "100px" height = "100px"></a>
                <script>
                    this.thumbnailPreview = function() {
                    xOffset = 10;
                    yOffset = 30;

                    $("a.preview").hover(function(e) {
                        $("section").append("<p id = 'preview'><img src = 'http://gi.esmplus.com/youandmer1/FWC/SP1081/SUM1.jpg' width = '400px'/></p>");
                        
                    });

                $(document).ready(function(){
                    thumbnailPreview();
                });
</script>

                </td>
                <td id = "pdtName">&emsp;&emsp;<?php   //상품명
                    echo $row[4];?><br>
                    <form name = "productName" method = "post" action = "javascript">
                        1.&nbsp;&nbsp;<input type= "text"> <input type = "submit" name = "save" value = "저장"><br>
                        2.&nbsp;&nbsp;<input type= "text"> <input type = "submit" name = "save" value = "저장"><br>
                        3.&nbsp;&nbsp;<input type= "text"> <input type = "submit" name = "save" value = "저장">
                    
                    </form>
                    <script>
                      
                    </script>
                </td>
                <td><?php   //공급가
                    echo $row[8];?>
                </td>
                <td>카테고리</td>
                <td><?php   //옵션명
                    if($row[15] == 1) {
                        echo "<font color = 'blue'>단일상품";}
                    else
                        echo $row[13]."<br>( ".$row[15]." )";?>
                </td>
                <td><?php   //옵션항목
                    $row[17] = str_replace("|","<br>", $row[17]);
                    if(strpos($row[17], "(품)(절)")) {
                        $row[17] = str_replace("(품)(절)", "",$row[17])."<font color = 'red'> (품절)";
                    }
                    else
                        $row[17] = $row[17];
                    echo $row[17];?>
                </td>
                <td>상세페이지</td>
                <td><?php   //등록일
                    $row[12] = str_replace(" ","<br>", $row[12]);
                    $row[46] = str_replace(" ","<br>", $row[46]);
                    echo $row[12]." /<br>".$row[46];?>
                </td>
                <td><?php   //상태
                    if($row[35] == 0) {
                        echo "<font color = 'blue'>판매중";}
                    else
                        echo "<font color = 'red'>품절";?>
                </td>
                <td></td>

                    

            
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