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
function nivelv(){
    global $conn;
    $sql='SELECT * FROM competences,eleves_competences where eleves_competences.competences_id=competences.id';
  $connexion=$conn->query($sql);


$string ="";
while($row =$connexion->fetch_assoc()) {
    echo $row['niveau']."<br>".$row['niveau_ae']."<br>";

    $niveau = $row['niveau'];
    if ($string!= '') {
        $string.= ",";
    }
    $string.= $niveau;
    global $string;

}


}
nivelv();
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
        type : 'radar',
        plot : {
            aspect : 'area',
            animation: {
                effect:3,
                sequence:1,
                speed:700
            }
        },
        scaleV : {
            visible : false
        },
        scaleK : {
            values : '0:10:0',
            labels : ['sebastien html','sebastien css', 'sebastien JS','dede html','dede css','dede JS','sophie html','sophie css','sophie JS','romain html','romain css','romain JS'],

            item : {
                fontColor : '#000',
                backgroundColor : "white",
                borderColor : "#aeaeae",
                borderWidth : 1,
                padding : '5 10',
                borderRadius : 10
            },
            refLine : {
                lineColor : '#c10000'
            },
            tick : {
                lineColor : '#000',
                lineWidth : 2,
                lineStyle : 'dotted',
                size : 20
            },
            guide : {
                lineColor : "#0000",
                lineStyle : 'solid',
                alpha : 0.3,
                backgroundColor : "#c5c5c5 #718eb4"
            }
        },
        series : [
            {
                values : [<?php echo $string ?>],
                text:'farm'

            },

        ]
    };

    zingchart.render({
        id : 'myChart',
        data : myConfig,
        height: '100%',
        width: '100%'
    });

</script>
