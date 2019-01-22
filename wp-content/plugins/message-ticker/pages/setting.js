/**
 *     message ticker
 *     Copyright (C) 2011 - 2014 www.gopiplus.com
 *     http://www.gopiplus.com/work/2010/07/18/message-ticker/
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
 
function mt_submit()
{
	if(document.form_mt.mt_text.value=="")
	{
		alert("Please enter the text.")
		document.form_mt.mt_text.focus();
		return false;
	}
	else if(document.form_mt.mt_status.value=="")
	{
		alert("Please select the display status.")
		document.form_mt.mt_status.focus();
		return false;
	}
	else if(document.form_mt.mt_order.value=="")
	{
		alert("Please enter the display order, only number.")
		document.form_mt.mt_order.focus();
		return false;
	}
	else if(isNaN(document.form_mt.mt_order.value))
	{
		alert("Please enter the display order, only number.")
		document.form_mt.mt_order.focus();
		return false;
	}
	else if(document.form_mt.mt_group.value == "" || document.form_mt.mt_group.value == "Select")
	{
		alert("Please select the message group.")
		document.form_mt.mt_group.focus();
		return false;
	}
	_mt_escapeVal(document.form_mt.mt_text,'<br>');
}

function mt_delete(id)
{
	if(confirm("Do you want to delete this record?"))
	{
		document.frm_mt_display.action="options-general.php?page=message-ticker&ac=del&did="+id;
		document.frm_mt_display.submit();
	}
}	

function mt_redirect()
{
	window.location = "options-general.php?page=message-ticker";
}

function mt_help()
{
	window.open("http://www.gopiplus.com/work/2010/07/18/message-ticker/");
}

function _mt_escapeVal(textarea,replaceWith)
{
	textarea.value = escape(textarea.value) //encode textarea strings carriage returns
	for(i=0; i<textarea.value.length; i++)
	{
		//loop through string, replacing carriage return encoding with HTML break tag
		if(textarea.value.indexOf("%0D%0A") > -1)
		{
			//Windows encodes returns as \r\n hex
			textarea.value=textarea.value.replace("%0D%0A",replaceWith)
		}
		else if(textarea.value.indexOf("%0A") > -1)
		{
			//Unix encodes returns as \n hex
			textarea.value=textarea.value.replace("%0A",replaceWith)
		}
		else if(textarea.value.indexOf("%0D") > -1)
		{
			//Macintosh encodes returns as \r hex
			textarea.value=textarea.value.replace("%0D",replaceWith)
		}
	}
	textarea.value=unescape(textarea.value) //unescape all other encoded characters
}