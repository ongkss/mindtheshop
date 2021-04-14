<?php
    $feelwoo = "필우커머스";
    $fwcxml = simplexml_load_file('fwc.xml','SimpleXMLElement',LIBXML_NOCDATA);
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
                <td><?php echo $product['name'][$i];?><br><input type="text" size ="50"><br><input type="text" size ="50"><br><input type="text" size ="50"><br></td>
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