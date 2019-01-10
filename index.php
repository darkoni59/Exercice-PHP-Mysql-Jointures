<?php
/**
 * Created by PhpStorm.
 * User: sstienface
 * Date: 04/12/2018
 * Time: 11:25
 */

// Premiere ligne

$username='root';
$servername='localhost';
$password='';
$dbname='eleves_information';


$conn=new mysqli($servername,$username,$password);

if ($conn->connect_error){
    die("connection failed:".$conn->connect_error);

}else{
    $conn->select_db($dbname);
}


function afficheelv(){
    global $conn;
    $sql='SELECT * FROM eleves,eleves_information where eleves_information.eleves_id=eleves.id ';
    $result=$conn->query($sql);
    while ($row=$result->fetch_assoc()){

        echo $row['nom']." ".$row['prenom']." ".$row['age'].$row['ville'].$row['avatar'].'<br>'."<hr>";

    }
}
 afficheelv();
?>
<!DOCTYPE html>
<html>
<head>
    <script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
    <script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script></head>
<body>
<div id='myChart'></div>
</body>
</html>
<script>
    var myConfig = {
        "type": "radar",
        "plot": {
            "aspect": "area"
        },
        "scale-v": {
            "values": "0:100:25",
            "labels": ["", "", "", "", ""],
            "ref-line": {
                "line-color": "none"
            },
            "guide": {
                "line-style": "solid"
            }
        },
        "scale-k": {
            "values": "0:330:30",
            "format": "%v°",
            "aspect": "circle", //To set the chart shape to circular.
            "guide": {
                "line-style": "solid"
            }
        },
        "series": [{
            "values": [59, 30, 65, 34, 40, 33, 31, 90, 81, 70, 100, 28]
        }, {
            "values": [30, 100, 90, 99, 59, 34, 5, 3, 12, 15, 16, 75, 34]
        }, {
            "values": [34, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30, 100]
        }]
    };

    zingchart.render({
        id : 'myChart',
        data : myConfig,
        height: '100%',
        width: '100%'
    });

</script>
