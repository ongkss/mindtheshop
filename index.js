function selectAll(self, boxname) {
    var checkbox = document.getElementsByName(boxname);
    if(self.checked == true) {
        for(i = 0; i < checkbox.length; i++)
            checkbox[i].checked = true;
    }
    if(self.checked == false) {
        for(i = 0; i < checkbox.length; i++)
            checkbox[i].checked = false;  
    }
}

function checkClear(selectAll, boxname) {
    var checkbox = document.getElementsByName(boxname);
    var entire = document.getElementById(selectAll);
    if(checkbox.length == document.querySelectorAll('input[name="wholesale"]:checked').length) {
        entire.checked = true    
    } else entire.checked = false;
}

function reverseSelect(selectAll, boxname) {
    var checkbox = document.getElementsByName(boxname);
    var entire = document.getElementById(selectAll);
    for(i = 0; i < checkbox.length; i++)
        if(checkbox[i].checked == true) {
            checkbox[i].checked = false;
        } else checkbox[i].checked = true

    if(checkbox.length == document.querySelectorAll('input[name="wholesale"]:checked').length) {
        entire.checked = true}
    else entire.checked = false;
}

function sortTable() {
    var table = document.getElementsByClass('productRow');
    var rows = table[0].rows;
    for (var i = 1; i < (rows.length - 1); i++) {
        var fCell = rows[i].cells[0];
        var sCell = rows[i + 1].cells[0];
        if (fCell.innerHTML.toLowerCase() > sCell.innerHTML.toLowerCase()) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        }
    }
}
function sort(sort) {
	var fm = document.form1;
	fm.sort.value = sort;
	fm.submit();
}



