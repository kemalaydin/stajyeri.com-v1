function startTimer()
{
  var DSTAdjust = 0;
  oneMinute = 1000 * 60;
  var oneDay = oneMinute * 60 * 24;
  var expired = 0;
  time = new Date();
  if (time.getTime() > timerEnd.getTime())
  {
    expired = 1;
  }
  else
  {
    DSTAdjust = (timerEnd.getTimezoneOffset( ) - time.getTimezoneOffset( )) * oneMinute;
    var diff = Math.abs(timerEnd.getTime( ) - time.getTime( )) - DSTAdjust;

    var days = Math.floor(diff/oneDay);
    var hours = Math.floor(diff/(60*oneMinute)) % 24;
    var minutes = Math.floor(diff/oneMinute) % 60;
    var seconds = Math.floor(diff/1000) % 60;

  }
  if (expired)
  {
    document.getElementById('timer').innerHTML = "<tr><td><big>ÖDÜL TÖRENİ BAŞLADI !</big></td></tr>";
  }
  else
  {
 
    document.getElementById('days0').innerHTML = days % 10; 

    document.getElementById('hours1').innerHTML = Math.floor(hours/10);
    document.getElementById('hours0').innerHTML = hours % 10;

    document.getElementById('mins1').innerHTML = Math.floor(minutes/10);
    document.getElementById('mins0').innerHTML = minutes % 10;

    document.getElementById('secs1').innerHTML = Math.floor(seconds/10);
    document.getElementById('secs0').innerHTML = seconds % 10;
  

    setTimeout('startTimer()', 100);
  }
}

document.write("<table id='timer' align='center' class='timer' cellpadding='0' cellspacing='0'>"+
      "<tr><td id='days2'>0</td><td id='days1'></td><td id='days0'></td><td>&nbsp;</td><td id='hours1'>0</td><td id='hours0'>0</td><td>&nbsp;</td><td id='mins1'>0</td><td id='mins0'>0</td><td>&nbsp;</td><td id='secs1'>0</td><td id='secs0'>0</td><td>&nbsp;</td></tr>"+
      "<tr class='labels'><td colspan='3' align='center'>GÜN</td><td>&nbsp;</td><td colspan='2' align='center'>SAAT</td><td>&nbsp;</td><td colspan='2' align='center'>DAKİKA</td><td>&nbsp;</td><td colspan='2' align='center'>SANİYE</td></tr></table>");

window.onload=startTimer;
