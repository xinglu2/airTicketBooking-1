function showTime(time){
  var d = new Date(time);
  var year = doubleNum(d.getFullYear());
  var month = doubleNum(d.getMonth()+1);//0-11
  var date = doubleNum(d.getDate());
  var week = d.getDay();//0-6
  week = numOfChinesse(week);
  var hour = doubleNum(d.getHours());
  var min = doubleNum(d.getMinutes());
  var sec = doubleNum(d.getSeconds());
  var str = year+"年"+month+"月"+date+"日 星期"+week+" "+hour+":"+min+":"+sec;
  return str;
}

//数字转成中文
function numOfChinesse(num){
  var arr = ["日","一","二","三","四","五","六"];
  return arr[num];
}

function doubleNum(n){
  if(n<10){
    return "0" + n;
  }else{
    return n;
  }
}