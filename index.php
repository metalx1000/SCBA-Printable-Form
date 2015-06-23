<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SCBA Checkout</title>
	<link rel="stylesheet" href="themes/scba.min.css" />
	<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  <script>
    var log;
    $(document).ready(function(){
      //name
      if (localStorage.name) {
        $("#fullname").val(localStorage.name);
      }

      //date
      $("#fullname").change(function(){
        localStorage.name = this.value;
      });
      var day = new Date();
      day = day.getFullYear()+"-"+("0" + (day.getMonth()+1)).slice(-2)+"-"+day.getDate();
      $("#day").val(day);
      
      $("#day").change(function(){
        localStorage.sdate = $("#day").val();
      });

      //trucks
      var trucks = ["ENG20","ENG21","ENG22","ENG23","ENG24"];
      trucks.forEach(function(truck){
        $("#truck").append("<option value='"+truck+"'>"+truck+"</option>");
      });
      
      if (localStorage.truck) {
        $("#truck").val(localStorage.truck);
        $("#truck").selectmenu("refresh");
      }

      $("#truck").change(function(){
        localStorage.truck = $("#truck").val();
      });


      //bottles
      for(var i=1;i<9;i++){ 
        $("#bottlefrm").append("<label for=\"bottle"+i+"\">Bottle "+i+":</label>");  
        $("#bottlefrm").append("<input type=\"text\" name=\"bottle\""+i+"\" id=\"bottle"+i+"\" class=\"bottle\" data-clear-btn=\"true\">");
      }

      //packs
      for(var i=1;i<5;i++){ 
        $("#packsfrm").append("<label for=\"pack"+i+"\">Pack "+i+":</label>");  
        $("#packsfrm").append("<input type=\"text\" name=\"pack\""+i+"\" id=\"pack"+i+"\" class=\"pack\" data-clear-btn=\"true\">");
      }
    
      //print
      $(".selector").on('click','#print',function(event){
        event.preventDefault();
        log="{'fullname':" + "'" + $('#fullname').val() + "'";
        log+=", 'day':" + "'" + $('#day').val() + "'";
        log+=", 'truck':" + "'" + $('#truck').val() + "'";

        $('.bottle').each(function(i,e){
          var id = $(this).attr('id');
          var val = $(this).val();
          log += ", '"+id+"':'"+val+"'";
        });

        $('.pack').each(function(i,e){
          var id = $(this).attr('id');
          var val = $(this).val();
          log += ", '"+id+"':'"+val+"'";
        }); 

        log+='}';
      });  
    });
  </script>
</head>
<body>
<!--INFO-->
  <div data-role="page" data-theme="a" id="info">
    <?php include('header.php');?>
        <div data-role="header" data-position="inline">
                <h1>Info</h1>
        </div>
          <div data-role="content" data-theme="a">
            <form method="post" action="#">
              <div class="ui-field-contain">
                <label for="fullname">Full name:</label>
                <input type="text" name="fullname" id="fullname" data-clear-btn="true">       
                <label for="day">Date:</label>
                <input type="date" name="day" id="day">
                <label for="truck">truck:</label>
                  <select name="truck" id="truck">
                  </select>
              </div>
            </form>
          </div>
  </div>

<!--Bottles-->
	<div data-role="page" data-theme="a" id="bottles">
          <?php include('header.php');?>
		<div data-role="header" data-position="inline">
			<h1>Bottles</h1>
		</div>
		<div data-role="content" data-theme="a">
                    <form method="post" action="#">
                      <div class="ui-field-contain">
                        <div id="bottlefrm" id="bottlefrm"></div>
                        <div id="rit">
                          <label for="ritbottle">RIT Bottle:</label>
                          <input type="text" name="ritbottle" id="ritbottle">
                        </div>
                      </div>
                    </form>
		</div>
	</div>

<!--Packs-->
	<div data-role="page" data-theme="a" id="packs">
          <?php include('header.php');?>
		<div data-role="header" data-position="inline">
			<h1>Packs</h1>
		</div>
		<div data-role="content" data-theme="a">
                  <form method="post" action="#">
                      <div class="ui-field-contain"> 
                        <div id="packsfrm" id="packsfrm"></div>
                      <div>
                  </form>
		</div>
	</div>
</body>
</html>
