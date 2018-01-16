function CreateFlag(){
    var companySelect = CreateElement('div', 'flag', 'modal');
    var selectContent = CreateElement('div', '', 'modal-content');
    var search_div = CreateElement('div');
    var search_bar = CreateElement('input', 'search_company', 'input');
    var search_img = CreateElement('img', '', 'search_icon');
	var result_div = CreateElement('div', 'result_company');
    var css = '.search_icon:hover{cursor: pointer}';
    var style = document.createElement('style');

    companySelect.style.display = 'flex';
    selectContent.style.display = 'flex';
    selectContent.style.textAlign = "center";  
    selectContent.style.flexDirection = 'column';
    selectContent.style.backgroundColor = 'red';
    search_div.style.display = 'flex';
    search_img.setAttribute('src', '../IMG/search_icon_white.png');
    search_img.style.marginTop = '0.5vh';

    search_img.onclick = function(){
        if (search_bar.value !== ""){
            AJAX_select('POST', 'select_companies.php', 'pattern', search_bar.value, show_companies);
        }
    }

    if (style.styleSheet) {
        style.styleSheet.cssText = css;
    } 
    else {
        style.appendChild(document.createTextNode(css));
    }
    GetElement('head').appendChild(style);
    search_div.appendChild(search_bar);
    search_div.appendChild(search_img);
    selectContent.appendChild(search_div);
	selectContent.appendChild(result_div);
    companySelect.appendChild(selectContent);
    GetElement('body').appendChild(companySelect); 
}


