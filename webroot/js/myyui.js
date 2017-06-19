
function buildQuestionTree(treename,data,selectctrlid = null){

//alert(data);


YUI().use("gallery-yui3treeview-ng", function(Y) {
                var treeview = new Y.CheckBoxTreeView({
                        startCollapsed: true,
                        toggleOnLabelClick: false,
                        children: data
                });
                treeview.render("#"+treename);

                treeview.on("nodeclick", function(e) {
                    //var node = e.treenode;
                    var nodestr = e.treenode+"";
                    var nodeid = nodestr.substring(nodestr.indexOf('[')+1,nodestr.indexOf(']'));
                    var childnode = document.getElementById(nodeid);
                    var parentele = childnode.parentElement;
                    for(var i =0;i< parentele.childNodes.length;i++)
                    {
                        if(parentele.childNodes[i].id==nodeid)
                            ;//do nothing
                        else
                            parentele.childNodes[i].className+= " yui3-treenode-collapsed";
                        //alert(parentele.childNodes[i].className);
                    }
                });

                treeview.after("check", function(e) {
                    
                    var node = e.treenode,
                        checked_roots = "",
                        checked_paths = "";
                    
                        if(node.get("isLeaf"))
                        {
                            if(node.get("checked")==30)
                                if(selectctrlid==null)
                                    checkLeaf(node.get("label"));
                                else
                                    checkLeaf(node.get("label"),selectctrlid);
                            else
                                if(selectctrlid==null)
                                    uncheckLeaf(node.get("label"));
                                else
                                    uncheckLeaf(node.get("label"),selectctrlid);
                        }
                        else
                        {                            
                            var key = node.get("label");

                            for (var i = data.length - 1; i >= 0; i--) 
                            {
                                var currNode = data[i].label;
                                if(key==currNode)
                                {
                                    var curNode = data[i];
                                    for(var l = curNode.children.length-1; l>=0 ; l--)
                                    {
                                        var  lastchild =  curNode.children[l];
                                        if(lastchild.children != undefined)
                                        {
                                            for(var m = lastchild.children.length-1; m>=0; m--)
                                            {
                                                if(node.get("checked")==30)
                                                    if(selectctrlid == null)
                                                        checkLeaf(lastchild.children[m].label);
                                                    else
                                                        checkLeaf(lastchild.children[m].label,selectctrlid);
                                                else
                                                    if(selectctrlid==null)
                                                        uncheckLeaf(lastchild.children[m].label);
                                                    else
                                                        uncheckLeaf(lastchild.children[m].label,selectctrlid);
                                            
                                            }
                                        }                                          
                                    }                                    
                                }
                                else
                                {
                                    var firstchild= data[i];
                                    if(firstchild.children != undefined)
                                    {
                                        for (var j = firstchild.children.length - 1; j >= 0; j--) 
                                        {
                                            var child = firstchild.children[j];
                                            if(key==child.label)
                                            {
                                                if(child.children != undefined)
                                                {
                                                    for (var k = child.children.length - 1; k >= 0; k--) 
                                                    {  
                                                        if(node.get("checked")==30)
                                                            if(selectctrlid==null)
                                                                checkLeaf(child.children[k].label);
                                                            else
                                                                checkLeaf(child.children[k].label,selectctrlid);                                                   
                                                        else
                                                            if(selectctrlid==null)
                                                                uncheckLeaf(child.children[k].label);
                                                            else
                                                                uncheckLeaf(child.children[k].label,selectctrlid);

                                                    }
                                                }                                                
                                            }
                                        }
                                    }
                                }
                            }
                        }
                });
            });
}

function buildEmployeeTree(treename,data,selectctrlid = null){

//alert(data);


YUI().use("gallery-yui3treeview-ng", function(Y) {
                var treeview = new Y.CheckBoxTreeView({
                        startCollapsed: true,
                        toggleOnLabelClick: false,
                        children: data
                });
                treeview.render("#"+treename);

                treeview.on("nodeclick", function(e) {
                    var nodestr = e.treenode+"";
                    var nodeid = nodestr.substring(nodestr.indexOf('[')+1,nodestr.indexOf(']'));
                    var childnode = document.getElementById(nodeid);
                    var parentele = childnode.parentElement;
                    for(var i =0;i< parentele.childNodes.length;i++)
                    {
                        if(parentele.childNodes[i].id==nodeid)
                            ;//do nothing
                        else
                            parentele.childNodes[i].className+= " yui3-treenode-collapsed";
                        //alert(parentele.childNodes[i].className);
                    }
                });

                treeview.after("check", function(e) {
                    
                    var node = e.treenode,
                        checked_roots = "",
                        checked_paths = "";
                    
                        if(node.get("isLeaf"))
                        {
                            if(node.get("checked")==30)
                                if(selectctrlid==null)
                                    checkLeaf(node.get("label"));
                                else
                                    checkLeaf(node.get("label"),selectctrlid);
                            else
                                if(selectctrlid==null)
                                    uncheckLeaf(node.get("label"));
                                else
                                    uncheckLeaf(node.get("label"),selectctrlid);
                        }
                        else
                        {                            
                            var key = node.get("label");

                            for (var i = data.length - 1; i >= 0; i--) 
                            {
                                var currNode = data[i].label;
                                if(key==currNode)
                                {
                                    var curNode = data[i];
                                    for(var l = curNode.children.length-1; l>=0 ; l--)
                                    {
                                        var  lastchild =  curNode.children[l];
                                        // if(lastchild.children != undefined)
                                        // {
                                            // for(var m = lastchild.children.length-1; m>=0; m--)
                                            // {
                                                if(node.get("checked")==30)
                                                    if(selectctrlid == null)
                                                        checkLeaf(lastchild.label);
                                                    else
                                                        checkLeaf(lastchild.label,selectctrlid);
                                                else
                                                    if(selectctrlid==null)
                                                        uncheckLeaf(lastchild.label);
                                                    else
                                                        uncheckLeaf(lastchild.label,selectctrlid);
                                            
                                            //}
                                        //}                                          
                                    }                                    
                                }
                                else
                                {
                                    var firstchild= data[i];
                                    if(firstchild.children != undefined)
                                    {
                                        for (var j = firstchild.children.length - 1; j >= 0; j--) 
                                        {
                                            var child = firstchild.children[j];
                                            if(key==child.label)
                                            {
                                                if(child.children != undefined)
                                                {
                                                    for (var k = child.children.length - 1; k >= 0; k--) 
                                                    {  
                                                        if(node.get("checked")==30)
                                                            if(selectctrlid==null)
                                                                checkLeaf(child.children[k].label);
                                                            else
                                                                checkLeaf(child.children[k].label,selectctrlid);                                                   
                                                        else
                                                            if(selectctrlid==null)
                                                                uncheckLeaf(child.children[k].label);
                                                            else
                                                                uncheckLeaf(child.children[k].label,selectctrlid);

                                                    }
                                                }                                                
                                            }
                                        }
                                    }
                                }
                            }
                        }
                });
            });
}

function buildMenuTree(treename,data,selectctrlid = null)
{ 
    YUI().use("gallery-yui3treeview-ng", function(Y) 
    {
        var treeview = new Y.CheckBoxTreeView({
                startCollapsed: true,
                toggleOnLabelClick: false,
                children: data
        });
        treeview.render("#"+treename);

        treeview.on("nodeclick", function(e) {
            //var node = e.treenode;
            var nodestr = e.treenode+"";
            var nodeid = nodestr.substring(nodestr.indexOf('[')+1,nodestr.indexOf(']'));
            var childnode = document.getElementById(nodeid);
            var parentele = childnode.parentElement;
            for(var i =0;i< parentele.childNodes.length;i++)
            {
                if(parentele.childNodes[i].id==nodeid)
                    ;//do nothing
                else
                    parentele.childNodes[i].className+= " yui3-treenode-collapsed";
                //alert(parentele.childNodes[i].className);
            }
        });

        treeview.after("check", function(e) 
        {                    
            var node = e.treenode,
                checked_roots = "",
                checked_paths = "";
            
                if(node.get("isLeaf"))
                {
                    if(node.get("checked")==30)
                        if(selectctrlid==null)
                            checkLeaf(node.get("label"));
                        else
                            checkLeaf(node.get("label"),selectctrlid);
                    else
                        if(selectctrlid==null)
                            uncheckLeaf(node.get("label"));
                        else
                            uncheckLeaf(node.get("label"),selectctrlid);
                }
                else
                {                            
                    var key = node.get("label");

                    for (var i = data.length - 1; i >= 0; i--) 
                    {
                        var currNode = data[i].label;
                        if(key==currNode)
                        {
                            var curNode = data[i];
                            for(var l = curNode.children.length-1; l>=0 ; l--)
                            {
                                var  lastchild =  curNode.children[l];
                                if(node.get("checked")==30)
                                    if(selectctrlid == null)
                                        checkLeaf(lastchild.label);
                                    else
                                        checkLeaf(lastchild.label,selectctrlid);
                                else
                                    if(selectctrlid==null)
                                        uncheckLeaf(lastchild.label);
                                    else
                                        uncheckLeaf(lastchild.label,selectctrlid);
                            }                                    
                        }
                        else
                        {
                            var firstchild= data[i];
                            if(firstchild.children != undefined)
                            {
                                for (var j = firstchild.children.length - 1; j >= 0; j--) 
                                {
                                    var child = firstchild.children[j];
                                    if(key==child.label)
                                    {
                                        if(child.children != undefined)
                                        {
                                            for (var k = child.children.length - 1; k >= 0; k--) 
                                            {  
                                                if(node.get("checked")==30)
                                                    if(selectctrlid==null)
                                                        checkLeaf(child.children[k].label);
                                                    else
                                                        checkLeaf(child.children[k].label,selectctrlid);                                                   
                                                else
                                                    if(selectctrlid==null)
                                                        uncheckLeaf(child.children[k].label);
                                                    else
                                                        uncheckLeaf(child.children[k].label,selectctrlid);

                                            }
                                        }                                                
                                    }
                                }
                            }
                        }
                    }
                }
            });
        });
}