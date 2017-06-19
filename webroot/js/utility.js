function IsMe(data)
{

    alert("This is me"+data);
}

function CreateNewCategoryDiv(data)
{
    //alert(data);
    
    var content = "<div id=\"newcategory_"+data.id+"\" class=\"panel panel-primary\" ";
    content += "style=\"background-color: transparent;background-color: transparent;border-width: 0px;margin-bottom: 10px;\">";

        content +="<div class=\"panel-heading\" style=\"background-color: transparent;border-bottom-width: 0px;\">";
            content += "<div class=\"row\">";
                content += "<div class=\"col-sm-10\">";
                    content += "<a herf=\"#\" style=\"color: Black;\" data-toggle=\"collapse\" data-target=\"#demo"+ data.id +"\">";
                    content +=  data.title +"</a>";
                    //content += "<i class=\"fa fa-close\" style=\"color: black;padding-left: 10px;\"></i>";
                content += "</div>";
                content += "<div class=\"col-sm-2\" style=\"text-align: right;\">";
                    content+= "<a href=\"#\" style=\"color: black;\" onclick=\"RemoveDiv('newcategory_"+data.id+"',"+data.id+")\">";
                    content+= "<i class=\"fa fa-close\" style=\"font-size:1.5em;\"></i></a>";
                content+= "</div>";
            content+="</div>";
        content +="</div>";


        content += "<div id=\"demo"+ data.id +"\" class=\"panel-collapse collapse\">";
            content+= "<div class=\"panel-body\">";

                    content+="<div class=\"row\">";
                        content+="<div class=\"col-sm-6\">";
                            content+="<div class=\"row\">";
                                content+="<div class=\"col-sm-4\" style=\"line-height: 2.5em;\">";
                                    content+= "<label for=\"txtTitle\"> Title</label>";
                                content+="</div>";
                                content+="<div class=\"col-sm-8\">";
                                    content+="<input type=\"text\" class=\"form-control\" id=\"txtTitle\" value=\""+data.title+"\" />";
                                content+="</div>";
                            content+="</div>";
                            content+="<div class=\"row\">";
                                content+="<div class=\"col-sm-4\" style=\"line-height: 2.5em;\">";
                                    content+="<label for=\"txtTitle\"> Description</label>";
                                content+="</div>";
                                content+="<div class=\"col-sm-8\">";
                                    content+="<input type=\"text\" class=\"form-control\" id=\"txtDescription\"  value=\""+data.description+"\" />";
                                content+="</div>";
                            content+="</div>";
                        content+="</div>";

                        content+="<div class=\"col-sm-6\">";
                            content+="<div class=\"row\">";
                                content+="<div class=\"col-sm-4\" style=\"line-height: 2.5em;\">";
                                    content+="<label for=\"Reviewer\"> Reviewers </label>";
                                content+="</div>";
                                content+="<div class=\"col-sm-8\">";
                                    content+="<select multiple style=\"width: 99%;padding-right: 15px;\" >"
                                    var employeeList = data.employee;
                                    for (var i = employeeList.length - 1; i >= 0; i--) {
                                        content+="<option value=\""+ employeeList[i].id +"\">"+ employeeList[i].name+"</option>"; 
                                    }
                                    content+="</select>";
                                 content+="</div>";
                            content+="</div>";
                        content+="</div>";
                    content+="</div>";

                    content+="<div class=\"row\">";
                        content+="<div class=\"col-sm-12\">";
                            content+="<hr/>";
                        content+="</div>";
                    content+="</div>";

                    content+="<div class=\"row\">";
                        content+="<div class=\"col-sm-12\">";
                            content+="<div class=\"row\">";
                                content+="<div class=\"col-sm-12\">";
                                    content+="<label>Questions</label>";
                                content+="</div>";
                            content+="</div>";
                            content+="<div class=\"row\">";
                                content+="<div class=\"col-sm-12\">";
                                     content+="<select multiple style=\"width: 99%;padding-right: 15px;\" >"
                                    var questionList = data.question;
                                    for (var i = questionList.length - 1; i >= 0; i--) {
                                        content+="<option value=\""+ questionList[i].id +"\">"+ questionList[i].questionname+"</option>"; 
                                    }
                                    content+="</select>";
                                content+="</div>";
                            content+="</div>";
                        content+="</div>";
                    content+="</div>";

            content+="</div>";
        content+="</div>";
    content+="</div>";
    //alert(content);
    var container = document.getElementById('CategoryContainer');
    container.innerHTML += content;
}




