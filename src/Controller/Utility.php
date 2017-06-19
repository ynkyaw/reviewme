<?php

namespace App\Controller;



class Utility extends AppController
{

	public function GetYUIString($department,$employee)
	{
		$yuidata = "[";
		foreach ($department as $dept) {
			$template ="";


			$template=$template."{label: \"".trim($dept->departmentname)."\"";
			//{ label: "EMP1"},{ label: "EMp2"}
			$hasChild =false;
			$childString =  ",children:[";
			foreach ($employee as $emp) 
			{
				//echo $emp->departmentid;
				if($emp->departmentid==$dept->id)
				{
					$hasChild =true;
					$childString=$childString."{label: \"".$emp->name."\"},";
				}
			}
			$childString=substr_replace($childString,"]", strlen($childString)-1);
			if($hasChild){ 
				$yuidata=$yuidata.$template.$childString;
			 	$yuidata=$yuidata."},";
			}
		}
		$yuidata=substr_replace($yuidata,"", strlen($yuidata)-1);
		$yuidata=$yuidata."]";
		return $yuidata;
	}

	public function GetMenuYUIString($headermenu,$mymenu)
	{
		//echo "headermenu ".$headermenu;
		//echo "menu ".$mymenu;

		$yuidata = "[";
		foreach ($headermenu as $hmenu) 
		{
			//echo "headermenu ".$hmenu->id;
			$template ="";

			$template=$template."{label: \"".trim($hmenu->name)."\"";
			//{ label: "EMP1"},{ label: "EMp2"}
			$hasChild =false;
			$childString =  ",children:[";
			foreach ($mymenu as $mymenu1) 
			{
				if($mymenu1->headermenu_id==$hmenu->id)
				{
					//echo "equal at ".$mymenu1->headermenu_id;
					$hasChild =true;
					$childString=$childString."{label: \"".$mymenu1->name."\"},";
				}
			}

			$childString=substr_replace($childString,"]", strlen($childString)-1);
			if($hasChild){ 
				$yuidata=$yuidata.$template.$childString;
			 	$yuidata=$yuidata."},";
			}
		}
		$yuidata=substr_replace($yuidata,"", strlen($yuidata)-1);
		$yuidata=$yuidata."]";
		return $yuidata;
	}

	public function GetYUIString2($department,$employee)
	{
		$yuidata = "{\"result\":[";
		foreach ($department as $dept) {
			$template ="";

			$template=$template."{\"label\": \"".trim($dept->departmentname)."\"";
			//{ label: "EMP1"},{ label: "EMp2"}
			$hasChild =false;
			$childString =  ",\"children\":[";
			foreach ($employee as $emp) {
				//echo $emp->departmentid;
				if($emp->departmentid==$dept->id)
				{
					$hasChild =true;
					$childString=$childString."{\"label\": \"".$emp->name."\"},";
				}
			}
			$childString=substr_replace($childString,"]", strlen($childString)-1);
			if($hasChild){ 
				$yuidata=$yuidata.$template.$childString;
			 	$yuidata=$yuidata."},";
			}
		}
		$yuidata=substr_replace($yuidata,"", strlen($yuidata)-1);
		$yuidata=$yuidata."]}";
		return $yuidata;
	}

	public function GetYUIStringSelectedEmployee($department,$employee,$selectedemployee)
	{
		$yuidata = "[";
		foreach ($department as $dept) {
			$template ="";


			$template=$template."{label: \"".trim($dept->departmentname)."\"";
			//{ label: "EMP1"},{ label: "EMp2"}
			$hasChild =false;
			$childString =  "\n,children:[";
			$childIsSelect = false;
			$oneChildUnSelect = false;
			foreach ($employee as $emp) {
				//echo $emp->departmentid;
				
				if($emp->departmentid==$dept->id)
				{
					$hasChild =true;

					if(!$this->checkEmployeeInList($emp,$selectedemployee)){
						$childString=$childString."\n{label: \"".$emp->name."\"},\n";
						$oneChildUnSelect = true;
						//echo "Uncheck";
					}
					else
					{
						$childIsSelect = true;
						$childString=$childString."\n{label: \"".$emp->name."\", checked :\"checked\"},\n";
					}
				}
			}
			$childString=substr_replace($childString,"]", strlen($childString)-2);
			if($childIsSelect)
			{
			    $childString=$childString.",expanded:true";
				if($oneChildUnSelect)
					$childString=$childString.",checked:\"halfchecked\"";
				else
					$childString=$childString.",checked:\"checked\"";
			}
			if($hasChild){ 
				$yuidata=$yuidata.$template.$childString;
			 	$yuidata=$yuidata."},\n";
			}
		}
		$yuidata=substr_replace($yuidata,"", strlen($yuidata)-2);
		$yuidata=$yuidata."]";
		return $yuidata;
	}

	public function GetSelectedMenuYUIString($headermenu,$mymenu,$selectedmenu)
	{
		$yuidata = "[";
		foreach ($headermenu as $hmenu) 
		{
			$template ="";

			$template=$template."{label: \"".trim($hmenu->name)."\"";
			//{ label: "EMP1"},{ label: "EMp2"}
			$hasChild =false;
			$childString =  "\n,children:[";
			$childIsSelect = false;
			$oneChildUnSelect = false;
			foreach ($mymenu as $mymenu1) 
			{
				if($mymenu1->headermenu_id == $hmenu->id)
				{
					$hasChild =true;

					if(!$this->checkEmployeeInList($mymenu1,$selectedmenu))
					{
						$childString=$childString."\n{label: \"".$mymenu1->name."\"},\n";
						$oneChildUnSelect = true;
						//echo "Uncheck";
					}
					else
					{
						$childIsSelect = true;
						$childString=$childString."\n{label: \"".$mymenu1->name."\", checked :\"checked\"},\n";
					}
				}
			}

			$childString=substr_replace($childString,"]", strlen($childString)-2);
			if($childIsSelect)
			{
			    $childString=$childString.",expanded:true";
				if($oneChildUnSelect)
					$childString=$childString.",checked:\"halfchecked\"";
				else
					$childString=$childString.",checked:\"checked\"";
			}
			if($hasChild)
			{ 
				$yuidata=$yuidata.$template.$childString;
			 	$yuidata=$yuidata."},\n";
			}
		}

		$yuidata=substr_replace($yuidata,"", strlen($yuidata)-2);
		$yuidata=$yuidata."]";
		return $yuidata;
	}

	public function checkMenuInList($mymenu,$menus)
	{
		foreach ($menus as $sel) 
		{
			if($sel->id==$mymenu->id)
				return true;
		}
		
		return false;
	}

	public function checkEmployeeInList($emp,$employees)
	{
		foreach ($employees as $sel) {
			if($sel->id==$emp->id)
				return true;
		}
		return false;

	}

	public function GetJOSNForDataGrid($employee)
	{
		$JSONStr = "{\"employeeList\":[";

		foreach ($employee as $emp) 
		{
			$objStr = "{";
			$objStr = $objStr."\"id\": \"".$emp->id."\",";
      		$objStr = $objStr."\"name\": \"".trim($emp->name)."\",";
      		$objStr = $objStr."\"fimalyname\": \"".trim($emp->fimalyname)."\",";
      		$objStr = $objStr."\"department\": \"".trim($emp->department->departmentname)."\",";
      		$objStr = $objStr."\"jobtitle\": \"".trim($emp->jobposition->jobtitle)."\",";
      		$objStr = $objStr."\"rank\": \"".trim($emp->rank->rank)."\",";
      		$objStr = $objStr."\"dateofbirth\": \"".trim($emp->dateofbirth)."\"";
			$objStr = $objStr."},";
			$JSONStr =  $JSONStr.$objStr;
		}


		$JSONStr=substr_replace($JSONStr,"", strlen($JSONStr)-1);

		$JSONStr = $JSONStr . "]}";
		return $JSONStr;

	}

	public function GetYUIStringForQuestions($questions,$category,$subcategory)
	{
		$yuidata = "[";

		foreach ($category as $cat) 
		{
			$categorytemplate ="";
			//echo "Category".$cat->idate(format);

			$categorytemplate=$categorytemplate."{label: \"".trim($cat->questioncategoryname)."\"";
			//{ label: "EMP1"},{ label: "EMp2"}
			$hasChildcategory =false;
			$childStringcategory =  ",children:[";			
			
			//mine
			foreach($subcategory as $subcatg) 
			{
				if($subcatg->questioncategoryid==$cat->id)
				{
					//echo "is equal first step ";
					
					$subcategorytemplate = "{label: \"".trim($subcatg->name)."\"";
					$hasChildsubcategory=false;
					$hasChildcategory = true;
					$childStringsubcategory = ",children:[";

					foreach($questions as $question)
					{						
						//echo $emp->departmentid;
						if($question->questiontypeid==$cat->id && $question->subcategoryid==$subcatg->id)
						{	
							$hasChildsubcategory =true;
							$childStringsubcategory= $childStringsubcategory."{label: \"".$question->questionname."\"},";							
						}					
					}

					$childStringsubcategory = substr_replace($childStringsubcategory,"]", strlen($childStringsubcategory)-1);

					if($hasChildsubcategory)
					{
						$subcategorytemplate = $subcategorytemplate.$childStringsubcategory;
					}

					$subcategorytemplate = $subcategorytemplate."},";
					$childStringcategory = $childStringcategory.$subcategorytemplate;						
				}
			}

			$childStringcategory = substr_replace($childStringcategory,"]", strlen($childStringcategory)-1);

			if($hasChildcategory)
			{
				$categorytemplate = $categorytemplate.$childStringcategory;
			}	
			$yuidata = $yuidata.$categorytemplate;
			$yuidata = $yuidata."},";
		}
		
		$yuidata = substr_replace($yuidata,"", strlen($yuidata)-1);
		$yuidata = $yuidata."]";
		//echo "yui string ".$yuidata;
		//die();
		return $yuidata;
	}
}
?>