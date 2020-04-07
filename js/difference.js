var first;
var second;

function difference(id) {
	
	if(first == undefined) {
		
		first = id;
		document.getElementById("div"+id).classList.add("active");
		
	} else {
		
		document.getElementById("div"+first).classList.remove("active");
		
		second = id;

		if(first != second) {
				
			calcu(first, second);

		}
		
		first = undefined;
		
	}
	
}

function calcu(a, b) {
	
	var fi = document.getElementById(a).innerHTML;
	var se = document.getElementById(b).innerHTML;
	
	var dif = fi - se;
	
	var max = document.getElementById("max").value;
	
	var fi_top = max - fi;
	var pos_fi_left = document.getElementById(a).getBoundingClientRect().left + pageXOffset;
	
	var se_top = max - se;
	var pos_se_left = document.getElementById(b).getBoundingClientRect().left + pageXOffset;
	
	document.getElementById("difference").style.top = middel(fi_top, se_top) - 50;
	document.getElementById("difference").style.left = middel(pos_fi_left, pos_se_left);
	document.getElementById("difference_inner").style.opacity = 1;
	
	document.getElementById("pol").innerHTML = '<polyline id="dif" points="' + pos_fi_left + ',' + fi_top + ' ' + pos_se_left + ',' + se_top + '" stroke-linecap="round" stroke-dasharray="50" title="Test" fill="none" stroke-width="3">';
	
	if(dif > 0) {
		
		document.getElementById("dif").style.stroke = "red"
		document.getElementById("difference_inner").innerHTML = "- " + dif + "€"
		
	} else {
		
		document.getElementById("dif").style.stroke = "green"
		document.getElementById("difference_inner").innerHTML = "+ " + dif * -1 + "€"
		
		
	}
	
}

function middel(a, b) {
	
	return (a + b) / 2;
	
}