<?php
// 取得目前的年月（或從 URL 參數取得）
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$month = isset($_GET['month']) ? intval($_GET['month']) : date('m');

// 處理前一月與下一月
$prevMonth = $month-1;
$nextMonth = $month+1;
$prevYear = $year;
$nextYear = $year;

if($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}
if($nextMonth > 12) {
   $nextMonth = 1;
   $nextYear++; 
}

$today = date("$year-$month-d");
$firstDay = date("$year-$month-01");
$firstDayWeek = date("w", strtotime($firstDay));// w: 0（星期天）到 6（星期六）
$theDaysOfMonth=date("t", strtotime($firstDay));// t: 指定月份的天数	28 到 31

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上日曆</title>
    <style>
        body{
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
            margin:0;
            padding:0;
            background-image:url('./bg_img.jpg');            
            background-attachment:fixed;
            background-repeat:no-repeat;
            background-position:center;
        }

        h2{
            text-align:center;
            color:white;             
            text-shadow:1px 1px 3px rgba(0,0,0,0.5);/* <x-offset> <y-offset> <blur-radius> <color>; */
            margin-top:20px;
        }
              
        .container{
            max-width:900px;      
            height:600px;         
            display:flex;
            margin:0 auto;
            justify-content:space-around;
            align-items:top;
        }

        .left-image{
            width:275;
            height:600px;                     
            background-color:#f0f0f0;            
            margin-top: 0;
            margin-right: auto;
            margin-bottom: 50px;
            margin-left: auto;
            padding:10px;
            border-radius:10px;                        
        }

        .left-image img{
            width:100%;            
            height:600px;         
            display:block;      
            object-fit:cover;             
        }

        .right-column{                        
            width:680px;
            height:600px;         
            display:flex;            
            flex-direction:row;            
            align-items:left;   
            flex-wrap:wrap;                       
            background-color:rgba(255,255,255,0.9);
            border-radius:10px;
            box-shadow:0px 0px 20px rgba(0,0,0,0.5);
            margin-top: 0;
            margin-right: auto;
            margin-bottom: 50px;
            margin-left: auto;
            padding:10px;
        }

        .th-item{
            width:73px;            
            height:32px;   
            line-height:25px;                        
            color:white;            
            font-size:20px;         
            font-weight:bold;
            text-align:center;                                    
            background-color:#2c3e50;
            border-radius:5px;
            margin:2px;  
            padding-top:3px;      
        }

        .item{
            width:65px;
            height:80px;
            background-color:#ecf0f1;
            text-align:center;
            margin:2px;
            padding:4px;
            border-radius:5px;
            box-shadow:0 2px 5px rgba(0,0,0,0.2);
            transition:transform 0.2s;
        }

        .day-num,
        .noworkday-num
        {        
            font-size:20px;
            font-weight:bold;   
            height:45px;                     
        }

        .day-num{
            color:#2c3e50;            
        }

        .noworkday-num{            
            color:#c0392b;            
        }

        .holiday{            
            color:#e74c33c;
            font-size:16px;
            font-weight:bold;            
            height:15px;
            margin:auto;
        }

        .todo{            
            color:red;
            font-size:14px;
            height:10px;
            margin: 3px;;
        }

        .pass-date{
            font-size:20px;
            font-weight:bold;            
            color:lightgray;
        }

       .nav-links {
        margin-left:30px;
       }

       .form-container{
            max-width:100%;      
            height:100px;         
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:20px;
       }

       .link_btn{
          text-decoration: none;          
          width:80px;          
          height:30px;
          text-align:center;  
          font-size:20px;
          font-weight: bold;
          background-color:rgb(184, 79, 140);
          color:white;
          border: 2px solid black;          
          cursor:pointer;
          margin:auto;           
          padding:5px;      
          border-radius:5px;
          box-shadow:1 px 1px 5px #eee; 
        }

        .nav-links a:hover {
            color: lightblue;
        }

        .month-search{
           font-size:20px;
           text-align:center;
           color:white;           
           margin-bottom:0px;           
        }

        .month-search input[type="number"]{
         width:65px;
         padding:5px;
         font-size:20px;
         text-align:center;
         margin-right:5px;
        }

        .month-search input[type="submit"]{
          padding:5px 10px;
          font-size:20px;
          font-weight: bold;
          background-color: white;
          color: #001f3f;
          border: 2px solid #001f3f;          
          cursor:pointer;
          margin-left:15px;
        }

        .month-search input[type="submit"]:hover{
        background-color:#cce0ff;
        }

    </style>
</head>
<body>
<!-- <h2 ><?= $year ?> 年 <?= $month ?> 月 </h2> -->
<div class="form-container">
  <div class="month-search">
   <form method="get" action="">    
    <input type="number" id="year" name="year" value="<?=$year?>" min="1900" max="2100">
    <label for="year">年</label>    
    <input type="number" id="month" name="month" value="<?=$month?>" min="1" max="12">
    <label for="month">月</label>
           <input type="submit" value="查詢">
    </form>
  </div>
  <div class="nav-links">
    <a href="?year=<?= $year-1 ?>&month=<?= $month ?>" class="link_btn">上一年</a>
    <a href="?year=<?= $year+1 ?>&month=<?= $month ?>" class="link_btn">下一年</a>    
    <a href="?year=<?= $prevYear ?>&month=<?= $prevMonth ?>" class="link_btn">上個月</a>   
    <a href="?year=<?= $nextYear ?>&month=<?= $nextMonth ?>" class="link_btn">下個月</a>
    <a href="?year=<?= date("Y") ?>&month=<?= date("m") ?>" class="link_btn">今天</a>
  </div>
</div>
       
 <?php
   $spDate=[
       '2020-01-01'=>'元旦（國慶日）',
       '2020-01-23'=>'春節前夕',
       '2020-01-24'=>'春節',
       '2020-01-25'=>'春節',
       '2020-01-26'=>'春節',
       '2020-01-27'=>'春節',
       '2020-01-28'=>'春節',
       '2020-01-29'=>'春節',
       '2020-02-28'=>'和平紀念日',
       '2020-04-02'=>'兒童節',
       '2020-04-03'=>'清明節',
       '2020-05-01'=>'勞動節',
       '2020-06-25'=>'端午節',
       '2020-10-01'=>'中秋節',
       '2020-10-09'=>'國慶日',
       '2020-10-10'=>'國慶日',
       '2021-01-01'=>'元旦（國慶日）',
       '2021-02-11'=>'春節前夕',
       '2021-02-12'=>'春節',
       '2021-02-13'=>'春節',
       '2021-02-14'=>'春節',
       '2021-02-15'=>'春節',
       '2021-02-16'=>'春節',
       '2021-02-17'=>'春節',
       '2021-02-28'=>'和平紀念日',
       '2021-04-04'=>'兒童節',
       '2021-04-05'=>'清明節',
       '2021-05-01'=>'勞動節',
       '2021-06-14'=>'端午節',
       '2021-09-21'=>'中秋節',
       '2021-10-10'=>'國慶日',
       '2022-01-01'=>'元旦（國慶日）',
       '2022-02-01'=>'春節前夕',
       '2022-02-02'=>'春節',
       '2022-02-03'=>'春節',
       '2022-02-04'=>'春節',
       '2022-02-05'=>'春節',
       '2022-02-06'=>'春節',
       '2022-02-07'=>'春節',
       '2022-02-28'=>'和平紀念日',
       '2022-04-04'=>'兒童節',
       '2022-04-05'=>'清明節',
       '2022-05-01'=>'勞動節',
       '2022-06-03'=>'端午節',
       '2022-09-10'=>'中秋節',
       '2022-10-10'=>'國慶日',
       '2023-01-01'=>'元旦（國慶日）',
       '2023-01-20'=>'春節前夕',
       '2023-01-21'=>'春節', 
       '2023-01-22'=>'春節',
       '2023-01-23'=>'春節',
       '2023-01-24'=>'春節',
       '2023-01-25'=>'春節',
       '2023-01-26'=>'春節',
       '2023-02-28'=>'和平紀念日',
       '2023-04-04'=>'兒童節',
       '2023-04-05'=>'清明節',
       '2023-05-01'=>'勞動節',
       '2023-06-22'=>'端午節',
       '2023-09-29'=>'中秋節',
       '2023-10-10'=>'國慶日',
       '2024-01-01'=>'元旦（,國慶日）',
       '2024-02-09'=>'春節前夕',
       '2024-02-10'=>'春節',
       '2024-02-11'=>'春節',
       '2024-02-12'=>'春節',
       '2024-02-13'=>'春節',
       '2024-02-14'=>'春節',
       '2024-02-15'=>'春節',
       '2024-02-28'=>'和平紀念日',
       '2024-04-04'=>'兒童節',
       '2024-04-05'=>'清明節',
       '2024-05-01'=>'勞動節',
       '2024-06-10'=>'端午節',
       '2024-09-17'=>'中秋節',
       '2024-10-10'=>'國慶日',
       '2025-01-01'=>'元旦（國慶日）',
       '2025-01-29'=>'春節前夕',
       '2025-01-30'=>'春節',
       '2025-01-31'=>'春節',
       '2025-02-01'=>'春節',
       '2025-02-02'=>'春節',
       '2025-02-03'=>'春節',
       '2025-02-04'=>'春節',
       '2025-02-28'=>'和平紀念日',
       '2025-04-04'=>'兒童節',
       '2025-04-05'=>'清明節',
       '2025-05-01'=>'勞動節',
       '2025-06-05'=>'端午節',
       '2025-09-08'=>'中秋節',
       '2025-10-10'=>'國慶日',
       '2026-01-01'=>'元旦（,國慶日）',
       '2026-02-16'=>'春節前夕',
       '2026-02-17'=>'春節',
       '2026-02-18'=>'春節',
       '2026-02-19'=>'春節',
       '2026-02-20'=>'春節',
       '2026-02-21'=>'春節',
       '2026-02-28'=>'和平紀念日',
       '2026-03-03'=>'元宵節',
       '2026-04-04'=>'兒童節',
       '2026-04-05'=>'清明節',
       '2026-05-01'=>'勞動節',
       '2026-06-19'=>'端午節',
       '2026-09-25'=>'中秋節',
       '2026-10-10'=>'國慶日',
       '2026-10-18'=>'重陽節',
       '2027-01-01'=>'元旦（國慶日）',
       '2027-02-05'=>'春節前夕',
       '2027-02-06'=>'春節',
       '2027-02-07'=>'春節',
       '2027-02-08'=>'春節',
       '2027-02-09'=>'春節',
       '2027-02-10'=>'春節',
       '2027-02-28'=>'和平紀念日',
       '2027-03-01'=>'和平紀念日（補假）',
       '2027-04-04'=>'兒童節',
       '2027-04-05'=>'清明節',
       '2027-05-01'=>'勞動節',
       '2027-06-09'=>'端午節',
       '2027-09-15'=>'中秋節',
       '2027-10-10'=>'國慶日',
       '2027-10-11'=>'國慶日（補假）',
       '2028-01-01'=>'元旦（,國慶日）',
       '2028-01-24'=>'春節前夕',
       '2028-01-25'=>'春節',
       '2028-01-26'=>'春節',
       '2028-01-27'=>'春節',
       '2028-01-28'=>'春節',
       '2028-01-29'=>'春節',
       '2028-02-28'=>'和平紀念日',
       '2028-04-04'=>'兒童節',
       '2028-04-05'=>'清明節',
       '2028-05-01'=>'勞動節',
       '2028-06-01'=>'端午節',
       '2028-09-20'=>'中秋節',
       '2028-10-10'=>'國慶日',
       '2028-10-25'=>'台灣光復節',
       '2029-01-01'=>'元旦（國慶日）',
       '2029-02-10'=>'春節前夕',
       '2029-02-11'=>'春節',
       '2029-02-12'=>'春節',
       '2029-02-13'=>'春節',
       '2029-02-14'=>'春節',
       '2029-02-15'=>'春節',
       '2029-02-28'=>'和平紀念日',
       '2029-04-04'=>'兒童節',
       '2029-04-05'=>'清明節',
       '2029-05-01'=>'勞動節',
       '2029-06-13'=>'端午節',
       '2029-09-13'=>'中秋節',
       '2029-10-10'=>'國慶日',
       '2029-10-10'=>'國慶日（補假）',
       '2030-01-01'=>'元旦（國慶日）',
       '2030-01-30'=>'春節前夕',
       '2030-01-31'=>'春節',
       '2030-02-01'=>'春節',
       '2030-02-02'=>'春節',
       '2030-02-03'=>'春節',
       '2030-02-04'=>'春節',
       '2030-02-28'=>'和平紀念日',
       '2030-04-04'=>'兒童節',
       '2030-04-05'=>'清明節',
       '2030-05-01'=>'勞動節',
       '2030-06-06'=>'端午節',
       '2030-09-12'=>'中秋節',
       '2030-10-10'=>'國慶日',
       '2030-10-10'=>'國慶日補假）'
       ];
       
 $todoList=[
       '2020-06-14'=>'生日',
       '2021-06-14'=>'生日',
       '2022-06-14'=>'生日',
       '2023-06-14'=>'生日',
       '2024-06-14'=>'生日',
       '2025-06-14'=>'生日',
       '2026-06-14'=>'生日',
       '2027-06-14'=>'生日',
       '2028-06-14'=>'生日',
       '2029-06-14'=>'生日',
       '2030-06-14'=>'生日'
       ]; 
     
 $monthDays=[];
       
// d: 月份中的第幾天01-31
// W: 示例：42（當年的第42周）
// w: 0（星期天）到 6（星期六）
// N: 1（星期一）到 7（星期天）
// z: 一年中的第幾天(0-365)
//--------------------------------       
//填入空白日期
// for($i=0;$i<$firstDayWeek;$i++){
//     $monthDays[]=[];
// }

//1.填入前月日期
 for($i=0;$i<$firstDayWeek;$i++){
      $j=$i-$firstDayWeek;
      $prev_timestamp = strtotime(" $j days", strtotime($firstDay));       
        $holiday="";
        foreach($spDate as $d=>$value){
            if($d==date("Y-m-d", $prev_timestamp)){
                $holiday=$value;
            }
        }

        $todo='';
        foreach($todoList as $d=>$value){
            if($d==date("Y-m-d", $prev_timestamp)){
                $todo=$value;
            }
        }

        $monthDays[]=[
            "day"=>date("d", $prev_timestamp),
            "fullDate"=>date("Y-m-d", $prev_timestamp),
            "week"=>date("w", $prev_timestamp),
            "workday"=>date("N", $prev_timestamp)<6?true:false,            
            "holiday"=>$holiday,
            "todo"=>$todo            
        ];
}

//----------------
//2.填入當月日期
for($i=0;$i<$theDaysOfMonth;$i++){
        $timestamp = strtotime(" $i days", strtotime($firstDay));        
        $holiday="";
        foreach($spDate as $d=>$value){
            if($d==date("Y-m-d", $timestamp)){
                $holiday=$value;
            }
        }

        $todo='';
        foreach($todoList as $d=>$value){
            if($d==date("Y-m-d", $timestamp)){
                $todo=$value;
            }
        }

        $monthDays[]=[
            "day"=>date("d", $timestamp),
            "fullDate"=>date("Y-m-d", $timestamp),
            "week"=>date("w", $timestamp),
            "workday"=>date("N", $timestamp)<6?true:false,            
            "holiday"=>$holiday,
            "todo"=>$todo
        ];
}

//-----------------
//3.填入下月日期  
 $lastDay=date('Y-m-t', strtotime($firstDay));
 $lastdayofweek = date("w", strtotime($lastDay));  
 for($i=0;$i<6-$lastdayofweek;$i++){
      $j=$i+1;
      $next_timestamp = strtotime(" $j days", strtotime($lastDay));       
        $holiday="";
        foreach($spDate as $d=>$value){
            if($d==date("Y-m-d", $next_timestamp)){
                $holiday=$value;
            }
        }

        $todo='';
        foreach($todoList as $d=>$value){
            if($d==date("Y-m-d", $next_timestamp)){
                $todo=$value;
            }
        }

        $monthDays[]=[
            "day"=>date("d", $next_timestamp),
            "fullDate"=>date("Y-m-d", $next_timestamp),
            "week"=>date("w", $next_timestamp),
            "workday"=>date("N", $next_timestamp)<6?true:false,            
            "holiday"=>$holiday,
            "todo"=>$todo
        ];
} 
//--------------------


//container ***begin***
echo "<div class='container'>";
 echo "<div class='left-image'><img src='./img01.jpg' alt='圖片'> </div>";
//建立外框及標題
//right-column ***begin***
  echo "<div class='right-column'>";
    //th-item       
    echo "<div class='th-item'>日</div>";
    echo "<div class='th-item'>一</div>";
    echo "<div class='th-item'>二</div>";
    echo "<div class='th-item'>三</div>";
    echo "<div class='th-item'>四</div>";
    echo "<div class='th-item'>五</div>";
    echo "<div class='th-item'>六</div>";     

//使用foreach迴圈,印出日期   
 foreach($monthDays as $day){ 
  //item ***begin***
  echo "<div class='item'>";

     //day-info ***begin***    
     echo "<div class='day-info'>";

      //daynum ***begin***     
          if(isset($day['day'])){
            if(strtotime($day['fullDate'])<strtotime($firstDay) || strtotime($day['fullDate'])>strtotime($lastDay)){
             echo "<div class='pass-date'>";
            }else if($day['workday']){               
             echo "<div class='day-num'>";                             
            }else{
              echo "<div class='noworkday-num'>";                             
            }           
            echo $day["day"];             
         }else{
             echo "<div class='day-num'>";                          
             echo "&nbsp;";
         } 
       echo "</div>";
      //daynum ***end***     

     echo "</div>";
     //day-info ***end***
     
     //holiday-info ***begin***    
     echo "<div class='holiday-info'>";
     if(isset($day['holiday'])){
         echo "<div class='holiday'>";
         echo $day['holiday'];
         echo "</div>";
     }else{
         echo "&nbsp;";
     }
     echo "</div>";
     //holiday-info ***end***      
    
     //todo-info ***begin***    
     echo "<div class='todo-info'>";
     if(isset($day['todo']) && !empty($day['todo'])){        
          echo "<div class='todo'>";
          echo $day['todo'];
          echo "</div>";        
     }else{
          echo "&nbsp;";
     }
     echo "</div>";
     //todo-info ***end***    

   echo "</div>";
   //item ***end***
}

 echo "</div>";
 //right-column ***end***
echo"</div>";
//-container ***end***
?>

</body>
</html>