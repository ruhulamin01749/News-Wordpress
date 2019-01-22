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

var mt_current=0
var mt_clipwidth=0

function mt_changeticker(){
mt_crosstick.style.clip="rect(0px 0px auto 0px)"
mt_crosstick.innerHTML=mt_contents[mt_current]
mt_highlight()
}

function mt_highlight(){
var mt_msgwidth=mt_crosstick.offsetWidth
if (mt_clipwidth<mt_msgwidth){
mt_clipwidth+=mt_speed
mt_crosstick.style.clip="rect(0px "+mt_clipwidth+"px auto 0px)"
mt_begin=setTimeout("mt_highlight()",20)
}
else{
mt_clipwidth=0
clearTimeout(mt_begin)
if (mt_current==mt_contents.length-1) mt_current=0
else mt_current++
setTimeout("mt_changeticker()",mt_delay)
}
}

function mt_start(){
mt_crosstick=document.getElementById? document.getElementById("mt_spancontant") : document.all.mt_spancontant
mt_crosstickParent=mt_crosstick.parentNode? mt_crosstick.parentNode : mt_crosstick.parentElement
if (parseInt(mt_crosstick.offsetHeight)>0)
mt_crosstickParent.style.height=mt_crosstick.offsetHeight+'px'
else
setTimeout("mt_crosstickParent.style.height=mt_crosstick.offsetHeight+'px'",100) //delay for Mozilla's sake
mt_changeticker()
}