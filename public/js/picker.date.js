!function(e){"function"==typeof define&&define.amd?define(["./picker","jquery"],e):"object"==typeof exports?module.exports=e(require("./picker.js"),require("jquery")):e(Picker,jQuery)}(function(e,p){var t,g=e._;function i(t,i){function e(){return r.currentStyle?"rtl"==r.currentStyle.direction:"rtl"==getComputedStyle(t.$root[0]).direction}var a,n=this,r=t.$node[0],o=r.value,s=t.$node.data("value"),l=s||o,c=s?i.formatSubmit:i.format;n.settings=i,n.$node=t.$node,n.queue={min:"measure create",max:"measure create",now:"now create",select:"parse create validate",highlight:"parse navigate create validate",view:"parse create validate viewset",disable:"deactivate",enable:"activate"},n.item={},n.item.clear=null,n.item.disable=(i.disable||[]).slice(0),n.item.enable=-(!0===(a=n.item.disable)[0]?a.shift():-1),n.set("min",i.min).set("max",i.max).set("now"),l?n.set("select",l,{format:c,defaultValue:!0}):n.set("select",null).set("highlight",n.item.now),n.key={40:7,38:-7,39:function(){return e()?-1:1},37:function(){return e()?1:-1},go:function(e){var t=n.item.highlight,i=new Date(t.year,t.month,t.date+e);n.set("highlight",i,{interval:e}),this.render()}},t.on("render",function(){t.$root.find("."+i.klass.selectMonth).on("change",function(){var e=this.value;e&&(t.set("highlight",[t.get("view").year,e,t.get("highlight").date]),t.$root.find("."+i.klass.selectMonth).trigger("focus"))}),t.$root.find("."+i.klass.selectYear).on("change",function(){var e=this.value;e&&(t.set("highlight",[e,t.get("view").month,t.get("highlight").date]),t.$root.find("."+i.klass.selectYear).trigger("focus"))})},1).on("open",function(){var e="";n.disabled(n.get("now"))&&(e=":not(."+i.klass.buttonToday+")"),t.$root.find("button"+e+", select").attr("disabled",!1)},1).on("close",function(){t.$root.find("button, select").attr("disabled",!0)},1)}function a(e,t,i){var a=e.match(/[^\x00-\x7F]+|\w+/)[0];return i.mm||i.m||(i.m=t.indexOf(a)+1),a.length}function n(e){return e.match(/\w+/)[0].length}i.prototype.set=function(t,i,a){var n=this,e=n.item;return null===i?("clear"==t&&(t="select"),e[t]=i):(e["enable"==t?"disable":"flip"==t?"enable":t]=n.queue[t].split(" ").map(function(e){return i=n[e](t,i,a)}).pop(),"select"==t?n.set("highlight",e.select,a):"highlight"==t?n.set("view",e.highlight,a):t.match(/^(flip|min|max|disable|enable)$/)&&(e.select&&n.disabled(e.select)&&n.set("select",e.select,a),e.highlight&&n.disabled(e.highlight)&&n.set("highlight",e.highlight,a))),n},i.prototype.get=function(e){return this.item[e]},i.prototype.create=function(e,t,i){var a,n=this;return(t=void 0===t?e:t)==-1/0||t==1/0?a=t:t=p.isPlainObject(t)&&g.isInteger(t.pick)?t.obj:p.isArray(t)?(t=new Date(t[0],t[1],t[2]),g.isDate(t)?t:n.create().obj):g.isInteger(t)||g.isDate(t)?n.normalize(new Date(t),i):n.now(e,t,i),{year:a||t.getFullYear(),month:a||t.getMonth(),date:a||t.getDate(),day:a||t.getDay(),obj:a||t,pick:a||t.getTime()}},i.prototype.createRange=function(e,t){function i(e){return!0===e||p.isArray(e)||g.isDate(e)?a.create(e):e}var a=this;return g.isInteger(e)||(e=i(e)),g.isInteger(t)||(t=i(t)),g.isInteger(e)&&p.isPlainObject(t)?e=[t.year,t.month,t.date+e]:g.isInteger(t)&&p.isPlainObject(e)&&(t=[e.year,e.month,e.date+t]),{from:i(e),to:i(t)}},i.prototype.withinRange=function(e,t){return e=this.createRange(e.from,e.to),t.pick>=e.from.pick&&t.pick<=e.to.pick},i.prototype.overlapRanges=function(e,t){var i=this;return e=i.createRange(e.from,e.to),t=i.createRange(t.from,t.to),i.withinRange(e,t.from)||i.withinRange(e,t.to)||i.withinRange(t,e.from)||i.withinRange(t,e.to)},i.prototype.now=function(e,t,i){return t=new Date,i&&i.rel&&t.setDate(t.getDate()+i.rel),this.normalize(t,i)},i.prototype.navigate=function(e,t,i){var a,n,r,o,s=p.isArray(t),l=p.isPlainObject(t),c=this.item.view;if(s||l){for(o=l?(n=t.year,r=t.month,t.date):(n=+t[0],r=+t[1],+t[2]),i&&i.nav&&c&&c.month!==r&&(n=c.year,r=c.month),n=(a=new Date(n,r+(i&&i.nav?i.nav:0),1)).getFullYear(),r=a.getMonth();new Date(n,r,o).getMonth()!==r;)--o;t=[n,r,o]}return t},i.prototype.normalize=function(e){return e.setHours(0,0,0,0),e},i.prototype.measure=function(e,t){return g.isInteger(t)?t=this.now(e,t,{rel:t}):t?"string"==typeof t&&(t=this.parse(e,t)):t="min"==e?-1/0:1/0,t},i.prototype.viewset=function(e,t){return this.create([t.year,t.month,1])},i.prototype.validate=function(e,i,t){var a,n,r,o,s=this,l=i,c=t&&t.interval?t.interval:1,d=-1===s.item.enable,u=s.item.min,h=s.item.max,m=d&&s.item.disable.filter(function(e){var t;return p.isArray(e)&&((t=s.create(e).pick)<i.pick?a=!0:t>i.pick&&(n=!0)),g.isInteger(e)}).length;if((!t||!t.nav&&!t.defaultValue)&&(!d&&s.disabled(i)||d&&s.disabled(i)&&(m||a||n)||!d&&(i.pick<=u.pick||i.pick>=h.pick)))for(d&&!m&&(!n&&0<c||!a&&c<0)&&(c*=-1);s.disabled(i)&&(1<Math.abs(c)&&(i.month<l.month||i.month>l.month)&&(i=l,c=0<c?1:-1),i.pick<=u.pick?(r=!0,c=1,i=s.create([u.year,u.month,u.date+(i.pick===u.pick?0:-1)])):i.pick>=h.pick&&(o=!0,c=-1,i=s.create([h.year,h.month,h.date+(i.pick===h.pick?0:1)])),!r||!o);)i=s.create([i.year,i.month,i.date+c]);return i},i.prototype.disabled=function(t){var i=this,e=(e=i.item.disable.filter(function(e){return g.isInteger(e)?t.day===(i.settings.firstDay?e:e-1)%7:p.isArray(e)||g.isDate(e)?t.pick===i.create(e).pick:p.isPlainObject(e)?i.withinRange(e,t):void 0})).length&&!e.filter(function(e){return p.isArray(e)&&"inverted"==e[3]||p.isPlainObject(e)&&e.inverted}).length;return-1===i.item.enable?!e:e||t.pick<i.item.min.pick||t.pick>i.item.max.pick},i.prototype.parse=function(e,a,t){var n=this,r={};return a&&"string"==typeof a?(t&&t.format||((t=t||{}).format=n.settings.format),n.formats.toArray(t.format).map(function(e){var t=n.formats[e],i=t?g.trigger(t,n,[a,r]):e.replace(/^!/,"").length;t&&(r[e]=a.substr(0,i)),a=a.substr(i)}),[r.yyyy||r.yy,(r.mm||r.m)-1,r.dd||r.d]):a},i.prototype.formats={d:function(e,t){return e?g.digits(e):t.date},dd:function(e,t){return e?2:g.lead(t.date)},ddd:function(e,t){return e?n(e):this.settings.weekdaysShort[t.day]},dddd:function(e,t){return e?n(e):this.settings.weekdaysFull[t.day]},m:function(e,t){return e?g.digits(e):t.month+1},mm:function(e,t){return e?2:g.lead(t.month+1)},mmm:function(e,t){var i=this.settings.monthsShort;return e?a(e,i,t):i[t.month]},mmmm:function(e,t){var i=this.settings.monthsFull;return e?a(e,i,t):i[t.month]},yy:function(e,t){return e?2:(""+t.year).slice(2)},yyyy:function(e,t){return e?4:t.year},toArray:function(e){return e.split(/(d{1,4}|m{1,4}|y{4}|yy|!.)/g)},toString:function(e,t){var i=this;return i.formats.toArray(e).map(function(e){return g.trigger(i.formats[e],i,[0,t])||e.replace(/^!/,"")}).join("")}},i.prototype.isDateExact=function(e,t){return g.isInteger(e)&&g.isInteger(t)||"boolean"==typeof e&&"boolean"==typeof t?e===t:(g.isDate(e)||p.isArray(e))&&(g.isDate(t)||p.isArray(t))?this.create(e).pick===this.create(t).pick:!(!p.isPlainObject(e)||!p.isPlainObject(t))&&(this.isDateExact(e.from,t.from)&&this.isDateExact(e.to,t.to))},i.prototype.isDateOverlap=function(e,t){var i=this.settings.firstDay?1:0;return g.isInteger(e)&&(g.isDate(t)||p.isArray(t))?(e=e%7+i)===this.create(t).day+1:g.isInteger(t)&&(g.isDate(e)||p.isArray(e))?(t=t%7+i)===this.create(e).day+1:!(!p.isPlainObject(e)||!p.isPlainObject(t))&&this.overlapRanges(e,t)},i.prototype.flipEnable=function(e){var t=this.item;t.enable=e||(-1==t.enable?1:-1)},i.prototype.deactivate=function(e,t){var a=this,n=a.item.disable.slice(0);return"flip"==t?a.flipEnable():!1===t?(a.flipEnable(1),n=[]):!0===t?(a.flipEnable(-1),n=[]):t.map(function(e){for(var t,i=0;i<n.length;i+=1)if(a.isDateExact(e,n[i])){t=!0;break}t||(g.isInteger(e)||g.isDate(e)||p.isArray(e)||p.isPlainObject(e)&&e.from&&e.to)&&n.push(e)}),n},i.prototype.activate=function(e,t){var r=this,o=r.item.disable,s=o.length;return"flip"==t?r.flipEnable():!0===t?(r.flipEnable(1),o=[]):!1===t?(r.flipEnable(-1),o=[]):t.map(function(e){for(var t,i,a,n=0;n<s;n+=1){if(i=o[n],r.isDateExact(i,e)){a=!(t=o[n]=null);break}if(r.isDateOverlap(i,e)){p.isPlainObject(e)?(e.inverted=!0,t=e):p.isArray(e)?(t=e)[3]||t.push("inverted"):g.isDate(e)&&(t=[e.getFullYear(),e.getMonth(),e.getDate(),"inverted"]);break}}if(t)for(n=0;n<s;n+=1)if(r.isDateExact(o[n],e)){o[n]=null;break}if(a)for(n=0;n<s;n+=1)if(r.isDateOverlap(o[n],e)){o[n]=null;break}t&&o.push(t)}),o.filter(function(e){return null!=e})},i.prototype.nodes=function(l){function e(e){return g.node("div"," ",d.klass["nav"+(e?"Next":"Prev")]+(e&&h.year>=f.year&&h.month>=f.month||!e&&h.year<=p.year&&h.month<=p.month?" "+d.klass.navDisabled:""),"data-nav="+(e||-1)+" "+g.ariaAttr({role:"button",controls:c.$node[0].id+"_table"})+' title="'+(e?d.labelMonthNext:d.labelMonthPrev)+'"')}function t(){var t=d.showMonthsShort?d.monthsShort:d.monthsFull;return d.selectMonths?g.node("select",g.group({min:0,max:11,i:1,node:"option",item:function(e){return[t[e],0,"value="+e+(h.month==e?" selected":"")+(h.year==p.year&&e<p.month||h.year==f.year&&e>f.month?" disabled":"")]}}),d.klass.selectMonth,(l?"":"disabled")+" "+g.ariaAttr({controls:c.$node[0].id+"_table"})+' title="'+d.labelMonthSelect+'"'):g.node("div",t[h.month],d.klass.month)}function i(){var t=h.year,e=!0===d.selectYears?5:~~(d.selectYears/2);if(e){var i,a,n=p.year,r=f.year,o=t-e,s=t+e;return o<n&&(s+=n-o,o=n),r<s&&(o-=(a=s-r)<(i=o-n)?a:i,s=r),g.node("select",g.group({min:o,max:s,i:1,node:"option",item:function(e){return[e,0,"value="+e+(t==e?" selected":"")]}}),d.klass.selectYear,(l?"":"disabled")+" "+g.ariaAttr({controls:c.$node[0].id+"_table"})+' title="'+d.labelYearSelect+'"')}return g.node("div",t,d.klass.year)}var a,n,c=this,d=c.settings,r=c.item,o=r.now,s=r.select,u=r.highlight,h=r.view,m=r.disable,p=r.min,f=r.max,y=(a=(d.showWeekdaysFull?d.weekdaysFull:d.weekdaysShort).slice(0),n=d.weekdaysFull.slice(0),d.firstDay&&(a.push(a.shift()),n.push(n.shift())),g.node("thead",g.node("tr",g.group({min:0,max:6,i:1,node:"th",item:function(e){return[a[e],d.klass.weekdays,'scope=col title="'+n[e]+'"']}}))));return g.node("div",(d.selectYears?i()+t():t()+i())+e()+e(1),d.klass.header)+g.node("table",y+g.node("tbody",g.group({min:0,max:5,i:1,node:"tr",item:function(e){var t=d.firstDay&&0===c.create([h.year,h.month,1]).day?-7:0;return[g.group({min:7*e-h.day+t+1,max:function(){return this.min+7-1},i:1,node:"td",item:function(e){e=c.create([h.year,h.month,e+(d.firstDay?1:0)]);var t,i=s&&s.pick==e.pick,a=u&&u.pick==e.pick,n=m&&c.disabled(e)||e.pick<p.pick||e.pick>f.pick,r=g.trigger(c.formats.toString,c,[d.format,e]);return[g.node("div",e.date,((t=[d.klass.day]).push(h.month==e.month?d.klass.infocus:d.klass.outfocus),o.pick==e.pick&&t.push(d.klass.now),i&&t.push(d.klass.selected),a&&t.push(d.klass.highlighted),n&&t.push(d.klass.disabled),t.join(" ")),"data-pick="+e.pick+" "+g.ariaAttr({role:"gridcell",label:r,selected:!(!i||c.$node.val()!==r)||null,activedescendant:!!a||null,disabled:!!n||null})),"",g.ariaAttr({role:"presentation"})]}})]}})),d.klass.table,'id="'+c.$node[0].id+'_table" '+g.ariaAttr({role:"grid",controls:c.$node[0].id,readonly:!0}))+g.node("div",g.node("button",d.today,d.klass.buttonToday,"type=button data-pick="+o.pick+(l&&!c.disabled(o)?"":" disabled")+" "+g.ariaAttr({controls:c.$node[0].id}))+g.node("button",d.clear,d.klass.buttonClear,"type=button data-clear=1"+(l?"":" disabled")+" "+g.ariaAttr({controls:c.$node[0].id}))+g.node("button",d.close,d.klass.buttonClose,"type=button data-close=true "+(l?"":" disabled")+" "+g.ariaAttr({controls:c.$node[0].id})),d.klass.footer)},i.defaults={labelMonthNext:"Next month",labelMonthPrev:"Previous month",labelMonthSelect:"Select a month",labelYearSelect:"Select a year",monthsFull:["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],weekdaysFull:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],weekdaysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],today:"Hari ini",clear:"Hapus",close:"Tutup",closeOnSelect:!0,closeOnClear:!0,updateInput:!0,format:"d mmmm, yyyy",klass:{table:(t=e.klasses().picker+"__")+"table",header:t+"header",navPrev:t+"nav--prev",navNext:t+"nav--next",navDisabled:t+"nav--disabled",month:t+"month",year:t+"year",selectMonth:t+"select--month",selectYear:t+"select--year",weekdays:t+"weekday",day:t+"day",disabled:t+"day--disabled",selected:t+"day--selected",highlighted:t+"day--highlighted",now:t+"day--today",infocus:t+"day--infocus",outfocus:t+"day--outfocus",footer:t+"footer",buttonClear:t+"button--clear",buttonToday:t+"button--today",buttonClose:t+"button--close"}},e.extend("pickadate",i)});