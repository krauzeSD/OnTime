function GetByID(id){
    return document.getElementById(id);
}

function GetByClass(className, number){
    if (number !== undefined){
        return document.getElementsByClassName(className)[number];
    }
    else {
        return document.getElementsByClassName(className);
    }
}

function GetIndexInClass(className, element){
    var targetClass = GetByClass(className);
    for (var i = 0; i < targetClass.length; i++){
        if (targetClass[i] === element){
            return i;
        }
    }
}

function GetElement(element){
    return document[element];
}

function CreateElement(type, idName = "", className = ""){
    var element = document.createElement(type);
    element.setAttribute('id', idName);
    element.setAttribute('class', className); 
    return element;
}

function EraseElement(element){
    element.parentNode.removeChild(element);
}

function EraseChildren(parent){
    while(parent.firstChild){
        EraseElement(parent.firstChild);
    }
}



function AJAX_select(type, url, parameterName, parameterValue, callback){
    var data = parameterName + "=" + parameterValue;
    var xml_http = new XMLHttpRequest();
    xml_http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            callback(this.response);
        }
    };
    xml_http.open(type, url, true);
    xml_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    xml_http.send(data);
}











































