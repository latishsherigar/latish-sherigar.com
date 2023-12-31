function refreshData(){var e;document.getElementById("div_api_download").style.visibility="visible",document.getElementById("divResults").style.visibility="hidden";var t=new Date,n=t.getDate();t.getHours()>=18&&(n+=1),n=""+n;var i=t.getMonth()+1,s=""+t.getFullYear();1==n.length&&(n="0"+n),1==(""+i).length&&(i="0"+i);var o=n+"-"+i+"-"+s;document.getElementById("radioDistrictCode").checked?e="https://cdn-api.co-vin.in/api/v2/appointment/sessions/calendarByDistrict?district_id="+document.getElementById("districtList").value+"&date="+o:e="https://cdn-api.co-vin.in/api/v2/appointment/sessions/calendarByPin?pincode="+document.getElementById("pincode").value+"&date="+o;$.get(e,function(e,t){process_cowinapi_result(e)}).done(function(){}).fail(function(e,t){console.log("data - "+e),console.log("textStatus - "+t),document.getElementById("divResults").innerHTML="<center><h2>An error has occured. Please try again after sometime.</h2></center>",display_results_window()}).always(function(){})}function displayStates(){$.get("https://cdn-api.co-vin.in/api/v2/admin/location/states",function(e,t){for(var n=e.states,i=0;i<n.length;i++)$("#stateNameList").append('<option value="'+n[i].state_id+'">'+n[i].state_name+"</option>")}).done(function(){}).fail(function(e,t){console.log("data - "+e),console.log("textStatus - "+t),document.getElementById("divResults").innerHTML="<center><h2>An error has occured. Please try again after sometime.</h2></center>",display_results_window()})}function stateDropDownValueChange(){document.getElementById("radioDistrictCode").checked=!0,getdistricts()}function pincodeValueChange(){document.getElementById("radioPinCode").checked=!0}function getdistricts(){var e="https://cdn-api.co-vin.in/api/v2/admin/location/districts/"+document.getElementById("stateNameList").value;$.get(e,function(e,t){var n=e.districts;$("#districtList").empty(),$("#districtList").append('<option value=""></option>');for(var i=0;i<n.length;i++)$("#districtList").append('<option value="'+n[i].district_id+'">'+n[i].district_name+"</option>")}).done(function(){}).fail(function(e,t){console.log("data - "+e),console.log("textStatus - "+t),document.getElementById("divResults").innerHTML="<center><h2>An error has occured. Please try again after sometime.</h2></center>",display_results_window()})}function filterByFeeType(e){return document.getElementById("feetypeFree").checked&&!document.getElementById("feetypePaid").checked?"Free"==e.fee_type||""==e.fee_type:!document.getElementById("feetypeFree").checked&&document.getElementById("feetypePaid").checked?"Paid"==e.fee_type||""==e.fee_type:document.getElementById("feetypeFree").checked&&document.getElementById("feetypePaid").checked?e.fee_type==e.fee_type||""==e.fee_type:document.getElementById("feetypeFree").checked||document.getElementById("feetypePaid").checked?void 0:e.fee_type==e.fee_type||""==e.fee_type}function filterCenterSessionsByAgeGroup(e){var t=0;document.getElementById("age_18_45").checked&&!document.getElementById("age_45plus").checked&&(t=18),!document.getElementById("age_18_45").checked&&document.getElementById("age_45plus").checked&&(t=45);for(var n=0;n<e.sessions.length;++n){if(0!=t)e.sessions[n].min_age_limit!=t&&(console.log("min age - deleting session  - "+e.sessions[n]),e.sessions[n].session_id="")}return e}function filterCenterSessionsByAvalability(e){for(var t=0;t<e.sessions.length;++t){0==e.sessions[t].available_capacity&&(console.log("deleting session - "+e.sessions[t]),e.sessions[t].session_id="")}return e}function process_cowinapi_result(e){var t=e.centers;t=t.filter(filterByFeeType);var n="<table id='centers'><th>Center</th>";console.log("centers: "+t.length);for(var i=!1,s=0;s<t.length;++s){var o=t[s];o=filterCenterSessionsByAvalability(o=filterCenterSessionsByAgeGroup(o));for(var d=!1,c="",a=0,l=0;l<o.sessions.length;++l)if(""!=o.sessions[l].session_id){d=!0,i=!0,++a;var r=o.sessions[l];c=c+"<td><br/><center>"+r.date+"<br/><br/>"+r.available_capacity+" </center><br/></td>"}for(;a<8;)c+="<td><center>------------</center></td>",++a;d&&(n=n+"<tr><td><center><b>"+o.name+"</b> - "+o.block_name+","+o.pincode+"</center></td>"+c+"</tr>")}i?n+="</table>":n="<br/><center><h1>Nothing available now :( </center> <h2>",document.getElementById("divResults").innerHTML=n,display_results_window()}function display_results_window(){document.getElementById("div_api_download").style.visibility="hidden",document.getElementById("divResults").style.visibility="visible"}$(document).ready(function(){console.log("ready!"),displayStates(),document.getElementById("divResults").style.visibility="hidden",document.getElementById("div_api_download").style.visibility="hidden"});