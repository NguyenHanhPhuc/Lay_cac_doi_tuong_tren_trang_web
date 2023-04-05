<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Structure Page</title>
</head>
<body>
<div class="container">
<?php
    $arrFieldAttr = ['name', 'specified', 'value', 'ownerElement', 'schemaTypeInfo', 'nodeName', 'nodeValue', 'nodeType','parentNode', 'childNodes', 'firstChild', 'lastChild', 'previousSibling', 'nextSibling', 'attributes', 'ownerDocument', 'namespaceURI', 'localName', 'baseURI', 'textContent'];
    if(!isset($_GET['url']))
        echo '<div class="alert alert-danger">VUI LÒNG NHẬP THÔNG TIN ĐƯỜNG DẪN url</div>';
    else{
        $content = file_get_contents($_GET['url']);
        $domdoc = new DOMDocument();
        libxml_use_internal_errors(true);
        $domdoc->loadHTML($content);
        $tags = ['a', 'input', 'p', 'div', 'select', 'form', 'b', 'strong', 'span', 'i'];
        foreach ($tags as $tag){
            echo '<h3 class="text-center text-danger">DANH SÁCH THẺ '.$tag.'</h3>';
            $inputTagValue = $domdoc->getElementsByTagName($tag);
            $length = $inputTagValue->length;
            if(count($inputTagValue) == 0)
                echo "<div class='alert alert-info'>Không có thẻ ".$tag." nào</div>";
            else { ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="1%">TT</th>
                        <th>Attributes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i = 0; $i<$length; $i++): ?>
                        <tr>
                            <td>
                                <?=$i+1; ?>
                            </td>
                            <td>
                                <?php $lengthAttr = count($inputTagValue->item($i)->attributes); ?>
                                <?php for ($j = 0; $j < $lengthAttr; $j++): ?>
                                    <p>
                                        <code><?=$inputTagValue->item($i)->attributes[($j)]->name; ?></code>
                                        <span><?=$inputTagValue->item($i)->attributes[($j)]->value; ?></span>
                                    </p>
                                <?php endfor;  ?>
                            </td>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            <?php }
        } ?>
    <?php } ?>
</div>

</body>
</html>
