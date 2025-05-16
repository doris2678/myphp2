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

$today = date("Y-$month-d");
$firstDay = date("Y-$month-01");
// w: 0（星期天）到 6（星期六）
// t: 指定月份的天数	28 到 31
$firstDayWeek = date("w", strtotime($firstDay));
$theDaysOfMonth=date("t", strtotime($firstDay));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上日曆</title>
    <style>
        h1{
            text-align:center;
            color:blue;
        }
        h2{
          text-align:center;  
        }        
        .today{
            background-color:yellow;
            font-weight:bold;
        }
        .other-month{
            background-color:gray;
            color:#aaa;
        }
        .holiday{
            background-color:pink;
            color:white;
            font-size:12px;

        }
        .pass-date{
            /* background-color:lightgray; */
            color:#aaa;
        }
        .date-num{
            font-size:14px;
            text-align:left;
        }
        .date-event{
            
            height:40px;
        }
        .box,.th-box{
            width:60px;
            height:80px;
            background-color:lightblue;
            display:inline-block;
            border:1px solid blue;
            box-sizing:border-box;
            margin-left:-1px;
            margin-top:-1px;
            vertical-align:top;
        }
        .box-container{
            width:420px;
            margin:0 auto;
            box-sizing:border-box;
            padding-left:1px;    
            padding-top:1px;    
        }
        .th-box{
            height:25px;
            text-align:center;
        }
        .day-num,.day-week{
            display:inline-block;
            width:50%;

        }
        .day-num{
            color:#999;
            font-size:14px;
        }
        .day-week{
            color:#aaa;
            font-size:12px;
            text-align:right;
        }

        .nav-links{
           text-align:center;
           margin-bottom:10px;
           font-size:18px;
        }
        .month-search{
           text-align:center;
           margin-bottom:20px;
        }
        .month-search input[type="number"]{
         width:80px;
         padding:5px;
         font-size:16px;
        }
        .month-search input[type="submit"]{
          padding:5px 10px;
          font-size:16px;
          background-color:blue;
          color:white;
          border:none;
          cursor:pointer;
        }
        .month-search input[type="submit"]:hover{
        background-color:darkblue;
        }

    </style>
</head>
<body>
<h1>線上日曆</h1>  
<h2 ><?= $year ?> 年 <?= $month ?> 月</h2>
<div class="nav-links">
    <a href="?year=<?= $prevYear ?>&month=<?= $prevMonth ?>">上一月</a> &nbsp;&nbsp;
    <a href="?year=<?= $nextYear ?>&month=<?= $nextMonth ?>">下一月</a>
</div>

<div class="month-search">
   <form method="get" action="">
    <label for="year">年：</label>
    <input type="number" id="year" name="year" value="<?=$year?>" min="1900" max="2100">
    <label for="month">月：</label>
    <input type="number" id="month" name="month" value="<?=$month?>" min="1" max="12">
    <input type="submit" value="查詢">
   </form>
</div>

<?php
$spDate=[
    '2025-04-04'=>'兒童節',
    '2025-04-05'=>'清明節',
    '2025-05-11'=>'母親節',
    '2025-05-01'=>'勞動節',
    '2025-05-30'=>'端午節',
    '2025-06-06'=>"生日"
];

$todoList=[ '2025-05-01'=>'開會'];

$monthDays=[];

//填入空白日期
for($i=0;$i<$firstDayWeek;$i++){
    $monthDays[]=[];
}

//填入當日日期
for($i=0;$i<$theDaysOfMonth;$i++){
        $timestamp = strtotime(" $i days", strtotime($firstDay));
        //$date=date("d", $timestamp);

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

// d: 月份中的第几天，有补零的两位数字	01 到 31
// W: 示例：42（当年的第 42 周）
// w: 0（星期天）到 6（星期六）
// N: 1（星期一）到 7（星期天）
// z: 一年中的第几天（从 0 开始）	0 到 365          
        $monthDays[]=[
            "day"=>date("d", $timestamp),
            "fullDate"=>date("Y-m-d", $timestamp),
            "weekOfYear"=>date("W", $timestamp),
            "week"=>date("w", $timestamp),
            "workday"=>date("N", $timestamp)<6?true:false,            
            "daysOfYear"=>date("z", $timestamp),
            "holiday"=>$holiday,
            "todo"=>$todo
        ];
}

/* echo "<pre>";
print_r($monthDays);
echo "</pre>"; */


//建立外框及標題
//box-container ***begin***
echo "<div class='box-container'>";
  //th-box     
  echo "<div class='th-box'>日</div>";
  echo "<div class='th-box'>一</div>";
  echo "<div class='th-box'>二</div>";
  echo "<div class='th-box'>三</div>";
  echo "<div class='th-box'>四</div>";
  echo "<div class='th-box'>五</div>";
  echo "<div class='th-box'>六</div>";     

//使用foreach迴圈,印出日期   
 foreach($monthDays as $day){ 
  //box ***begin***
  echo "<div class='box'>";

     //day-info ***begin***    
     echo "<div class='day-info'>";

       //daynum ***begin***     
       echo "<div class='day-num'>";
        if(isset($day['day'])){
            echo $day["day"];
        }else{
            echo "&nbsp;";
        }
       echo "</div>";
       //daynum ***end***     

       //day-week ***begin***     
       echo "<div class='day-week'>";
        if(isset($day['weekOfYear'])){
            echo $day["weekOfYear"];
        }else{
            echo "&nbsp;";
        }
       echo "</div>";
      //day-week ***end***     

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
   //box ***end***
}

echo "</div>";
//box-container ***end***

?>

</body>
</html>