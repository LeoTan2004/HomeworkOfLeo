<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Index</title>

</head>
<body>
<h1>This is My HomeWork</h1>
<table border="1px">
    <thead>
    <?php
        for($i=1;$i<10;$i++){
            echo "<tr>\n";
            for($j=1;$j<=$i;$j++){

                printf("<td style='background-color:rgb(%d,%d,%d)'\">%d*%d=%d</td>",rand(0,255),rand(0,255),rand(0,255),$i,$j,$j*$i);
            }
            echo "</tr>\n";
        }
    ?>
    </thead>
</table>
</body>
</html>
