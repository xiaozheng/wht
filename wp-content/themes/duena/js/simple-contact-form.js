/**
 *     Simple contact form
 *     Copyright (C) 2011 - 2013 www.gopiplus.com
 *     http://www.gopiplus.com/work/2010/07/18/simple-contact-form/
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

var http_req = false;
function gcfPOSTRequest(url, parameters) {
  http_req = false;
  if (window.XMLHttpRequest) { // Mozilla, Safari,...
	 http_req = new XMLHttpRequest();
	 if (http_req.overrideMimeType) {
		// set type accordingly to anticipated content type
		//http_req.overrideMimeType('text/xml');
		http_req.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		http_req = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   http_req = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!http_req) {
	 alert('Cannot create XMLHTTP instance');
	 return false;
  }
  //alert(parameters);
  http_req.onreadystatechange = gcfContents;
  http_req.open('POST', url, true);
  http_req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http_req.setRequestHeader("Content-length", parameters.length);
  http_req.setRequestHeader("Connection", "close");
  http_req.send(parameters);
}

function gcfContents() 
{
  //alert(http_req.responseText);
  if (http_req.readyState == 4) 
  {
	 if (http_req.status == 200) 
	 {
		//alert(http_req.responseText);
		if(http_req.responseText == "Invalid security code.")
		{
			alert(http_req.responseText);
			result = http_req.responseText;
			document.getElementById('gcf_alertmessage').innerHTML = result;
			document.getElementById("gcf_captcha").value = "";
		}
		else if(http_req.responseText == "Refresh the page and try again.")
		{
			alert(http_req.responseText);
			result = http_req.responseText;
			document.getElementById('gcf_alertmessage').innerHTML = result;
			document.getElementById("gcf_captcha").value = "";
		}
		else
		{
			alert(http_req.responseText);
			result = http_req.responseText;
			document.getElementById('gcf_alertmessage').innerHTML = result;   
			document.getElementById("gcf_email").value = "";
			document.getElementById("gcf_name").value = "";
			document.getElementById("gcf_message").value = "";
			document.getElementById("gcf_captcha").value = "";
		}
	 } 
	 else 
	 {
		alert('There was a problem with the request.');
	 }
  }
}

function gcf_submit1(obj,url) 
{
	
	alert(url);
	_e=document.getElementById("gcf_email");
	_n=document.getElementById("gcf_name");
	_m=document.getElementById("gcf_message");
	/*_c=document.getElementById("gcf_captcha");*/
	
	if(_n.value=="")
	{
		alert("Please enter the name 请输入姓名");
		_n.focus();
		return false;    
	}
	else if(_e.value=="")
	{
		alert("Please enter the email address 请输入邮箱");
		_e.focus();
		return false;    
	}
	else if(_e.value!="" && (_e.value.indexOf("@",0)==-1 || _e.value.indexOf(".",0)==-1))
	{
		alert("Please enter valid email 请输入有效邮箱")
		_e.focus();
		_e.select();
		return false;
	} 
	else if(_m.value=="")
	{
		alert("Please enter your message 请输入留言");
		_m.focus();
		return false;    
	}
	/*else if(_c.value=="")
	{
		alert("security code");
		_c.focus();
		return false;    
	}
*/
	document.getElementById('gcf_alertmessage').innerHTML = "Sending..."; 
	
	var str = "gcf_name=" + encodeURI( document.getElementById("gcf_name").value ) + "&gcf_email=" + encodeURI( document.getElementById("gcf_email").value ) + "&gcf_message=" + encodeURI( document.getElementById("gcf_message").value ) );
				 
	gcfPOSTRequest(url+'simple-contact-save.php', str);
}
