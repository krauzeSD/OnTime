//Returns the element with the specified id.
function GetByID(id){
    return document.getElementById(id);
}
//Returns elements by class, it's possible to specify a number to get a specific element. 
function GetByClass(className, number){
    if (number !== undefined){
        return document.getElementsByClassName(className)[number];
    }
    else {
        return document.getElementsByClassName(className);
    }
}
//Returns the index of an element in the list of a class.
function GetIndexInClass(className, element){
    var targetClass = GetByClass(className);
    for (var i = 0; i < targetClass.length; i++){
        if (targetClass[i] === element){
            return i;
        }
    }
}
//Returns an element by its tag (e.g. the body element).
function GetElement(element){
    return document[element];
}
//Creates an element with a tag. Id and class are optional.
function CreateElement(type, idName = "", className = ""){
    var element = document.createElement(type);
    element.setAttribute('id', idName);
    element.setAttribute('class', className); 
    return element;
}
//Removes an element from the document.
function EraseElement(element){
    element.parentNode.removeChild(element);
}
//Removes all elements inside the specified element.
function EraseChildren(parent){
    while(parent.firstChild){
        EraseElement(parent.firstChild);
    }
}
//Performs an AJAX request passing some values to a url and, with the respone from the url,
//calls the function supplied as last parameter.
function AJAX_select(type, url, parameterName, parameterValue, callback){
    var data = parameterName + "=" + parameterValue;
    var xml_http = new XMLHttpRequest();
    xml_http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if (parameterName == 'reload'){
                location.reload();
            }
            else {
                callback(this.response);
            }
            
        }
    };
    xml_http.open(type, url, true);
    xml_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    xml_http.send(data);
}
//Only for companies: Cleans the requests box and reloads the page.
function reload_requests(data){
    location.reload();
}
function writeNotifications(notificationsNumber){
    var notificationAlert = GetByID('notifications');
    notificationAlert.innerHTML = notificationsNumber;
}









































