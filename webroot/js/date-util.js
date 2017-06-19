function hideDate(control)
{
	var yearName = control+"[year]";
	var monthName = control+"[month]";
	var dayName = control+"[day]";
	var selYear = document.getElementsByName(yearName)[0];
	var selMonth = document.getElementsByName(monthName)[0];
	var selDay = document.getElementsByName(dayName)[0];
	selYear.style.visibility = "hidden";
	selMonth.style.visibility = "hidden";
	selDay.style.visibility = "hidden";

}

function changeDate(val,control)
{
	if(val!=null){
		//alert("value is "+val);
		
		var yearName = control+"[year]";
		var monthName = control+"[month]";
		var dayName = control+"[day]";
		var selYear = document.getElementsByName(yearName)[0];
		var selMonth = document.getElementsByName(monthName)[0];
		var selDay = document.getElementsByName(dayName)[0];


		var year = val.substring(0,4);
		var month = val.substring(5,7);
		var day = val.substring(8,10);
		selYear.value = year;
		selMonth.value =month;
		selDay.value = day;
		// alert(year);
		// alert(month);
		// alert(day);

	}else
	{
		alert("val"+val);

	}

}

function setMyDate(ctrl,control)
{		
	var yearName = control+"[year]";
	var monthName = control+"[month]";
	var dayName = control+"[day]";
	var selYear = document.getElementsByName(yearName)[0];
	var selMonth = document.getElementsByName(monthName)[0];
	var selDay = document.getElementsByName(dayName)[0];


	var year = selYear.value;
	var month = selMonth.value;
	var day = selDay.value;
	document.getElementById(ctrl).value = year+'-'+month+'-'+day;
}