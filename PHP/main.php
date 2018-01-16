<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="../fullcalendar-3.8.0/fullcalendar.min.css">
   <link href="../fullcalendar-3.8.0/fullcalendar.print.min.css" rel="stylesheet" media="print">
   <script src="../fullcalendar-3.8.0/lib/moment.min.js"></script>
   <script src="../fullcalendar-3.8.0/lib/jquery.min.js"></script>
   <script src="../fullcalendar-3.8.0/fullcalendar.js"></script>
   <script src="../fullcalendar-3.8.0/locale-all.js"></script>
    <?php 
    session_start();
    include('header.php');
    ?>
    <script>
        function show_companies(parameter){
            var result = [];
            var first = parameter.split(",");
            for (var x in first){
                var second = first[x].split("_");
                result.push(second);
            }
           
            for (var z in result){
                var company = CreateElement('div', '', '');
                company.innerHTML = result[z][0];
                company.style.color = 'black';
                company.style.backgroundColor = 'white';
                company.onclick = function(){
                    alert('Tus horas son: ');
                }
                
                GetByClass('modal-content', 0).appendChild(company);
            }
        }
        $(document).ready(function(){
           $('#calendar').fullCalendar({
               timeFormat: 'H(:mm)',
               header: {
                    center: 'month,agendaWeek,agendaDay'
               },
               allDaySlot: false,
               selectable: false,
               dayClick: function(){
                   var vista = $('#calendar').fullCalendar('getView').name;
                   if (vista == 'month'){
                       $('#calendar').fullCalendar('changeView', 'agendaDay');
                       
                        $('#calendar').fullCalendar('option', {selectable:true, aspectRatio:2});
                   }
                   else {
                       //EVENTO
                   }
                   
               },
               select: function(start, end){  
                   
                    var companySelect = CreateElement('div', 'flag', 'modal');
                    var selectContent = CreateElement('div', '', 'modal-content');
                    companySelect.appendChild(selectContent);
                    companySelect.style.display = 'flex';
                   companySelect.style.backgroundColor = 'blue';
                    selectContent.style.display = 'flex';
                    selectContent.style.textAlign = "center";  
                    selectContent.style.flexDirection = 'column';
                selectContent.style.backgroundColor = 'red';
                   var active = GetByClass('fc-state-active', 0);
                   active.setAttribute('class', active.getAttribute('class').substr(0, active.getAttribute('class').length - 15));

                   var search_div = CreateElement('div');
                   search_div.style.display = 'flex';

                   var search_bar = CreateElement('input', 'search_company', 'input');
                   var search_img = CreateElement('img', '', 'search_icon');
                   search_img.setAttribute('src', '../IMG/search_icon_white.png');
                   search_img.style.marginTop = '0.5vh';

                    var css = '.search_icon:hover{cursor: pointer}';
                    var style = document.createElement('style');
                    if (style.styleSheet) {
                        style.styleSheet.cssText = css;
                    } else {
                        style.appendChild(document.createTextNode(css));
                    }
                    GetElement('head').appendChild(style);
                    search_img.onclick = function(){
                        if (search_bar.value !== ""){
                            AJAX_select('POST', 'select_companies.php', 'pattern', search_bar.value, show_companies);
                        }
                    }


                   search_div.appendChild(search_bar);
                   search_div.appendChild(search_img);
                   selectContent.appendChild(search_div);



                   GetElement('body').appendChild(companySelect);
                   var flag = document.getElementById('flag');
                   window.onclick = function(event) {
                        if (event.target == flag) {
                            alert('yeah');
                        flag.style.display = "none";
                    }
                    }
               },
               
               aspectRatio: 2
            
               
               
           }) 
        });
    </script>
</head>
<body>
   <div class="main_container">
    <div id="sidebar" class="box">
        <img style="width:10vw" src="../IMG/ontime_logo.png">
        <h3>
            <?php
                echo $_SESSION['IndividualName'] . " " . $_SESSION['IndividualSurname'];
            ?>
            
        </h3>
        <div style="display:flex;flex-direction:column">
            <a class="menu_tabs" href="agenda.php">My appointments</a>
            <a class="menu_tabs" href="">Make an appointment</a>
            <a class="menu_tabs" href="">Settings</a>
        </div>
    </div>

   <div id="calendar" style="width:60vw;margin-right:auto;margin-top:5vh">
    
   </div>
   
    </div>

</body>
</html>