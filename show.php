<?php 

$arr = [];
$d = date('Y-m-d');
if(isset($_GET['d'])){
    $d=$_GET['d'];
}
$file = 'log/'.$d.'clicklog.txt';
// $handle = fopen($file, 'r');
// while (!feof($handle)) {
    
//     $line = fgets($handle);
//     $content = explode('|',$line);
//     if(empty($content[2]))
//         continue;
//     $arr[]=array(
//         'time'=>$content[0],
//         'ip'=>$content[1],
//         'url'=>$content[2]
//         ); 
// }

// 检查文件是否存在
if (file_exists($file)) {
    $handle = fopen($file, 'r');
    
    $arr = []; // 初始化数组
    while (!feof($handle)) {
        $line = fgets($handle);
        $content = explode('|', $line);
        if (empty($content[2])) {
            continue;
        }
        $arr[] = array(
            'time' => $content[0],
            'ip' => $content[1],
            'url' => $content[2]
        );
    }

    fclose($handle); // 关闭文件句柄
} else {
    echo "文件不存在: $file";
}


//var_dump($arr);

$group = array_group_by($arr,'url');
//var_dump($group);

foreach ($arr as $ar){
   // echo '<u><ul>'.$ar['url'].;
}

arsort($group); 
function array_group_by(array $array, $key) {
$result = array();
foreach ($array as $element) {
    if (!isset($result[$element[$key]])) {
    $result[$element[$key]] = 1;
    }
    $result[$element[$key]] +=1;
}
return $result;
}


?>


<style>

.table {
display: table;
border: 1px solid #333333;
background-color: #f2f2f2;
font-size: 16px;
}
.table td {
display: table-cell;
border: 1px solid #333333;
padding: 0px;
text-align: left;
}
</style>

<table class="table" id='table'>
<tr><td>链接</td><td>数量</td></tr>
<?php 


foreach ($group as $key =>$value){
    
    echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
    
}




?>
</table>