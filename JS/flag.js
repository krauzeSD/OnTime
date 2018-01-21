function CreateFlag(mode, content){
    var flag = GetByID('flag');
    //Creates a FullCalendar script to display in the flag.
    if (mode == 'calendar'){
         var calendarSetup = CreateElement('script');
         var flagContent = CreateElement('div', '', 'modal-content');
         var name = CreateElement('h2');
         var calendar = CreateElement('div', 'calendar');
         
         calendarSetup.innerHTML = `
                $('#calendar').fullCalendar({
                    header: {
                    center: 'month,agendaWeek,agendaDay'
                },
                allDaySlot: false,
                selectable: false,
                eventBackgroundColor: 'red',
                eventBorderColor: 'black',
                eventLimit: true,
                events: {
                    url: 'get_events.php?BusinessName=${content}',
                    type: 'GET',
                    error: function(){
                        alert('There was an error fetching events.');
                    }
                },
                dayClick: function(date){
                   var vista = $('#calendar').fullCalendar('getView').name;
        
                   if (vista == 'month'){
                       $('#calendar').fullCalendar('gotoDate', date);
                       $('#calendar').fullCalendar('changeView', 'agendaDay');
                   }
                   else {
                       if (vista == 'agendaDay'){
                           var form = CreateElement('form');
                           form.method = 'post';
                           form.action = 'makeAppoint.php';
                           form.style.display = 'none';
                           var start = CreateElement('input');
                           start.name = 'start';
                           start.value = date.format();
                            var end = CreateElement('input');
                            end.name = 'end';
                            end.value = date.add('1', 'hour').format();
                        
                           var companyName = CreateElement('input');
                            companyName.name = 'companyName';
                            companyName.value = '${content}';
                            form.appendChild(companyName);
                           form.appendChild(start);
                           form.appendChild(end);
                           GetElement('body').appendChild(form);
                           form.submit();
                       }
                   }
                },
                aspectRatio: 3 
            });`
     }
    //Check if flags exist. If so, it erases it.
    if (flag){
        EraseElement(flag);
    }
    //Creation of elements
    flag = CreateElement('div', 'flag', 'modal');
    name.innerHTML = content;
    //Style of elements
    flag.style.display = 'flex';
    flagContent.style.display = 'flex'; 
    flagContent.style.backgroundColor = '#EEEEEE';
    flagContent.style.height = '79vh';
    flagContent.style.flexDirection = 'column';
    flagContent.style.justifyContent = 'flex-start';
    //Appending of elements
    flagContent.appendChild(name);
    flagContent.appendChild(calendar);
    flag.appendChild(flagContent);
    GetElement('body').appendChild(flag); 
    GetElement('head').appendChild(calendarSetup);
}


