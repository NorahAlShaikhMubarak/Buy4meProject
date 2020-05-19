/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function validate_contact()
{
    
    var name = document.contact.name.value;
    var email = document.contact.email.value;
    var valid=true;
    
    if(name == "")
    {
        valid=false;
        ename.style.visibility = "visible";        
    }
    else
        {
            ename.style.visibility = "hidden";
        }
    
    if(email == "")
    {
        valid=false;
        eemail.style.visibility = "visible";
    }
    else
        {
            eemail.style.visibility = "hidden";
        } 
    
    if(valid)
        {
            return true;
        }
    else
        {
            return false;
        }
}



function validate_login()
{
    var uid = document.login.uid.value;
    var pwd = document.login.pwd.value;
    var valid=true;
     if(uid == "")
    {
        valid=false;
        ename.style.visibility = "visible";        
    }
    else
    {
            ename.style.visibility = "hidden";
    }
    
    if(pwd == "")
    {
        valid=false;
        epwd.style.visibility = "visible";
    }
    else
    {
            epwd.style.visibility = "hidden";
    }
    if(valid)
    {
            return true;
    }
    else
    {
            return false;
    }
}


