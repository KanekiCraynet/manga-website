var ce={};(function(e){(function(){var t={not_string:/[^s]/,not_bool:/[^t]/,not_type:/[^T]/,not_primitive:/[^v]/,number:/[diefg]/,numeric_arg:/[bcdiefguxX]/,json:/[j]/,not_json:/[^j]/,text:/^[^\x25]+/,modulo:/^\x25{2}/,placeholder:/^\x25(?:([1-9]\d*)\$|\(([^)]+)\))?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-gijostTuvxX])/,key:/^([a-z_][a-z_\d]*)/i,key_access:/^\.([a-z_][a-z_\d]*)/i,index_access:/^\[(\d+)\]/,sign:/^[+-]/};function r(o){return i(a(o),arguments)}function n(o,d){return r.apply(null,[o].concat(d||[]))}function i(o,d){var l=1,g=o.length,c,x="",_,b,f,T,O,F,R,u;for(_=0;_<g;_++)if(typeof o[_]=="string")x+=o[_];else if(typeof o[_]=="object"){if(f=o[_],f.keys)for(c=d[l],b=0;b<f.keys.length;b++){if(c==null)throw new Error(r('[sprintf] Cannot access property "%s" of undefined value "%s"',f.keys[b],f.keys[b-1]));c=c[f.keys[b]]}else f.param_no?c=d[f.param_no]:c=d[l++];if(t.not_type.test(f.type)&&t.not_primitive.test(f.type)&&c instanceof Function&&(c=c()),t.numeric_arg.test(f.type)&&typeof c!="number"&&isNaN(c))throw new TypeError(r("[sprintf] expecting number but found %T",c));switch(t.number.test(f.type)&&(R=c>=0),f.type){case"b":c=parseInt(c,10).toString(2);break;case"c":c=String.fromCharCode(parseInt(c,10));break;case"d":case"i":c=parseInt(c,10);break;case"j":c=JSON.stringify(c,null,f.width?parseInt(f.width):0);break;case"e":c=f.precision?parseFloat(c).toExponential(f.precision):parseFloat(c).toExponential();break;case"f":c=f.precision?parseFloat(c).toFixed(f.precision):parseFloat(c);break;case"g":c=f.precision?String(Number(c.toPrecision(f.precision))):parseFloat(c);break;case"o":c=(parseInt(c,10)>>>0).toString(8);break;case"s":c=String(c),c=f.precision?c.substring(0,f.precision):c;break;case"t":c=String(!!c),c=f.precision?c.substring(0,f.precision):c;break;case"T":c=Object.prototype.toString.call(c).slice(8,-1).toLowerCase(),c=f.precision?c.substring(0,f.precision):c;break;case"u":c=parseInt(c,10)>>>0;break;case"v":c=c.valueOf(),c=f.precision?c.substring(0,f.precision):c;break;case"x":c=(parseInt(c,10)>>>0).toString(16);break;case"X":c=(parseInt(c,10)>>>0).toString(16).toUpperCase();break}t.json.test(f.type)?x+=c:(t.number.test(f.type)&&(!R||f.sign)?(u=R?"+":"-",c=c.toString().replace(t.sign,"")):u="",O=f.pad_char?f.pad_char==="0"?"0":f.pad_char.charAt(1):" ",F=f.width-(u+c).length,T=f.width&&F>0?O.repeat(F):"",x+=f.align?u+c+T:O==="0"?u+T+c:T+u+c)}return x}var s=Object.create(null);function a(o){if(s[o])return s[o];for(var d=o,l,g=[],c=0;d;){if((l=t.text.exec(d))!==null)g.push(l[0]);else if((l=t.modulo.exec(d))!==null)g.push("%");else if((l=t.placeholder.exec(d))!==null){if(l[2]){c|=1;var x=[],_=l[2],b=[];if((b=t.key.exec(_))!==null)for(x.push(b[1]);(_=_.substring(b[0].length))!=="";)if((b=t.key_access.exec(_))!==null)x.push(b[1]);else if((b=t.index_access.exec(_))!==null)x.push(b[1]);else throw new SyntaxError("[sprintf] failed to parse named argument key");else throw new SyntaxError("[sprintf] failed to parse named argument key");l[2]=x}else c|=2;if(c===3)throw new Error("[sprintf] mixing positional and named placeholders is not (yet) supported");g.push({placeholder:l[0],param_no:l[1],keys:l[2],sign:l[3],pad_char:l[4],align:l[5],width:l[6],precision:l[7],type:l[8]})}else throw new SyntaxError("[sprintf] unexpected placeholder");d=d.substring(l[0].length)}return s[o]=g}e.sprintf=r,e.vsprintf=n,typeof window<"u"&&(window.sprintf=r,window.vsprintf=n)})()})(ce);var H,B,S,Y;H={"(":9,"!":8,"*":7,"/":7,"%":7,"+":6,"-":6,"<":5,"<=":5,">":5,">=":5,"==":4,"!=":4,"&&":3,"||":2,"?":1,"?:":1};B=["(","?"];S={")":["("],":":["?","?:"]};Y=/<=|>=|==|!=|&&|\|\||\?:|\(|!|\*|\/|%|\+|-|<|>|\?|\)|:/;function oe(e){for(var t=[],r=[],n,i,s,a;n=e.match(Y);){for(i=n[0],s=e.substr(0,n.index).trim(),s&&t.push(s);a=r.pop();){if(S[i]){if(S[i][0]===a){i=S[i][1]||i;break}}else if(B.indexOf(a)>=0||H[a]<H[i]){r.push(a);break}t.push(a)}S[i]||r.push(i),e=e.substr(n.index+i.length)}return e=e.trim(),e&&t.push(e),t.concat(r.reverse())}var ue={"!":function(e){return!e},"*":function(e,t){return e*t},"/":function(e,t){return e/t},"%":function(e,t){return e%t},"+":function(e,t){return e+t},"-":function(e,t){return e-t},"<":function(e,t){return e<t},"<=":function(e,t){return e<=t},">":function(e,t){return e>t},">=":function(e,t){return e>=t},"==":function(e,t){return e===t},"!=":function(e,t){return e!==t},"&&":function(e,t){return e&&t},"||":function(e,t){return e||t},"?:":function(e,t,r){if(e)throw t;return r}};function le(e,t){var r=[],n,i,s,a,o,d;for(n=0;n<e.length;n++){if(o=e[n],a=ue[o],a){for(i=a.length,s=Array(i);i--;)s[i]=r.pop();try{d=a.apply(null,s)}catch(l){return l}}else t.hasOwnProperty(o)?d=t[o]:d=+o;r.push(d)}return r[0]}function de(e){var t=oe(e);return function(r){return le(t,r)}}function fe(e){var t=de(e);return function(r){return+t({n:r})}}var C={contextDelimiter:"",onMissingKey:null};function pe(e){var t,r,n;for(t=e.split(";"),r=0;r<t.length;r++)if(n=t[r].trim(),n.indexOf("plural=")===0)return n.substr(7)}function I(e,t){var r;this.data=e,this.pluralForms={},this.options={};for(r in C)this.options[r]=t!==void 0&&r in t?t[r]:C[r]}I.prototype.getPluralForm=function(e,t){var r=this.pluralForms[e],n,i,s;return r||(n=this.data[e][""],s=n["Plural-Forms"]||n["plural-forms"]||n.plural_forms,typeof s!="function"&&(i=pe(n["Plural-Forms"]||n["plural-forms"]||n.plural_forms),s=fe(i)),r=this.pluralForms[e]=s),r(t)};I.prototype.dcnpgettext=function(e,t,r,n,i){var s,a,o;return i===void 0?s=0:s=this.getPluralForm(e,i),a=r,t&&(a=t+this.options.contextDelimiter+r),o=this.data[e][a],o&&o[s]?o[s]:(this.options.onMissingKey&&this.options.onMissingKey(r,e),s===0?r:n)};const $={"":{plural_forms(e){return e===1?0:1}}},he=/^i18n\.(n?gettext|has_translation)(_|$)/,ge=(e,t,r)=>{const n=new I({}),i=new Set,s=()=>{i.forEach(u=>u())},a=u=>(i.add(u),()=>i.delete(u)),o=(u="default")=>n.data[u],d=(u,p="default")=>{var h;n.data[p]={...n.data[p],...u},n.data[p][""]={...$[""],...(h=n.data[p])==null?void 0:h[""]},delete n.pluralForms[p]},l=(u,p)=>{d(u,p),s()},g=(u,p="default")=>{var h;n.data[p]={...n.data[p],...u,"":{...$[""],...(h=n.data[p])==null?void 0:h[""],...u==null?void 0:u[""]}},delete n.pluralForms[p],s()},c=(u,p)=>{n.data={},n.pluralForms={},l(u,p)},x=(u="default",p,h,w,m)=>(n.data[u]||d(void 0,u),n.dcnpgettext(u,p,h,w,m)),_=(u="default")=>u,b=(u,p)=>{let h=x(p,void 0,u);return r?(h=r.applyFilters("i18n.gettext",h,u,p),r.applyFilters("i18n.gettext_"+_(p),h,u,p)):h},f=(u,p,h)=>{let w=x(h,p,u);return r?(w=r.applyFilters("i18n.gettext_with_context",w,u,p,h),r.applyFilters("i18n.gettext_with_context_"+_(h),w,u,p,h)):w},T=(u,p,h,w)=>{let m=x(w,void 0,u,p,h);return r?(m=r.applyFilters("i18n.ngettext",m,u,p,h,w),r.applyFilters("i18n.ngettext_"+_(w),m,u,p,h,w)):m},O=(u,p,h,w,m)=>{let A=x(m,w,u,p,h);return r?(A=r.applyFilters("i18n.ngettext_with_context",A,u,p,h,w,m),r.applyFilters("i18n.ngettext_with_context_"+_(m),A,u,p,h,w,m)):A},F=()=>f("ltr","text direction")==="rtl",R=(u,p,h)=>{var A,U;const w=p?p+""+u:u;let m=!!((U=(A=n.data)==null?void 0:A[h??"default"])!=null&&U[w]);return r&&(m=r.applyFilters("i18n.has_translation",m,u,p,h),m=r.applyFilters("i18n.has_translation_"+_(h),m,u,p,h)),m};if(e&&l(e,t),r){const u=p=>{he.test(p)&&s()};r.addAction("hookAdded","core/i18n",u),r.addAction("hookRemoved","core/i18n",u)}return{getLocaleData:o,setLocaleData:l,addLocaleData:g,resetLocaleData:c,subscribe:a,__:b,_x:f,_n:T,_nx:O,isRTL:F,hasTranslation:R}};function W(e){return typeof e!="string"||e===""?(console.error("The namespace must be a non-empty string."),!1):/^[a-zA-Z][a-zA-Z0-9_.\-\/]*$/.test(e)?!0:(console.error("The namespace can only contain numbers, letters, dashes, periods, underscores and slashes."),!1)}function M(e){return typeof e!="string"||e===""?(console.error("The hook name must be a non-empty string."),!1):/^__/.test(e)?(console.error("The hook name cannot begin with `__`."),!1):/^[a-zA-Z][a-zA-Z0-9_.-]*$/.test(e)?!0:(console.error("The hook name can only contain numbers, letters, dashes, periods and underscores."),!1)}function z(e,t){return function(n,i,s,a=10){const o=e[t];if(!M(n)||!W(i))return;if(typeof s!="function"){console.error("The hook callback must be a function.");return}if(typeof a!="number"){console.error("If specified, the hook priority must be a number.");return}const d={callback:s,priority:a,namespace:i};if(o[n]){const l=o[n].handlers;let g;for(g=l.length;g>0&&!(a>=l[g-1].priority);g--);g===l.length?l[g]=d:l.splice(g,0,d),o.__current.forEach(c=>{c.name===n&&c.currentIndex>=g&&c.currentIndex++})}else o[n]={handlers:[d],runs:0};n!=="hookAdded"&&e.doAction("hookAdded",n,i,s,a)}}function P(e,t,r=!1){return function(i,s){const a=e[t];if(!M(i)||!r&&!W(s))return;if(!a[i])return 0;let o=0;if(r)o=a[i].handlers.length,a[i]={runs:a[i].runs,handlers:[]};else{const d=a[i].handlers;for(let l=d.length-1;l>=0;l--)d[l].namespace===s&&(d.splice(l,1),o++,a.__current.forEach(g=>{g.name===i&&g.currentIndex>=l&&g.currentIndex--}))}return i!=="hookRemoved"&&e.doAction("hookRemoved",i,s),o}}function Q(e,t){return function(n,i){const s=e[t];return typeof i<"u"?n in s&&s[n].handlers.some(a=>a.namespace===i):n in s}}function q(e,t,r=!1){return function(i,...s){const a=e[t];a[i]||(a[i]={handlers:[],runs:0}),a[i].runs++;const o=a[i].handlers;if(!o||!o.length)return r?s[0]:void 0;const d={name:i,currentIndex:0};for(a.__current.push(d);d.currentIndex<o.length;){const g=o[d.currentIndex].callback.apply(null,s);r&&(s[0]=g),d.currentIndex++}if(a.__current.pop(),r)return s[0]}}function J(e,t){return function(){var s;var n;const i=e[t];return(n=(s=i.__current[i.__current.length-1])==null?void 0:s.name)!==null&&n!==void 0?n:null}}function K(e,t){return function(n){const i=e[t];return typeof n>"u"?typeof i.__current[0]<"u":i.__current[0]?n===i.__current[0].name:!1}}function X(e,t){return function(n){const i=e[t];if(M(n))return i[n]&&i[n].runs?i[n].runs:0}}class ye{constructor(){this.actions=Object.create(null),this.actions.__current=[],this.filters=Object.create(null),this.filters.__current=[],this.addAction=z(this,"actions"),this.addFilter=z(this,"filters"),this.removeAction=P(this,"actions"),this.removeFilter=P(this,"filters"),this.hasAction=Q(this,"actions"),this.hasFilter=Q(this,"filters"),this.removeAllActions=P(this,"actions",!0),this.removeAllFilters=P(this,"filters",!0),this.doAction=q(this,"actions"),this.applyFilters=q(this,"filters",!0),this.currentAction=J(this,"actions"),this.currentFilter=J(this,"filters"),this.doingAction=K(this,"actions"),this.doingFilter=K(this,"filters"),this.didAction=X(this,"actions"),this.didFilter=X(this,"filters")}}function _e(){return new ye}const we=_e(),y=ge(void 0,void 0,we);y.getLocaleData.bind(y);y.setLocaleData.bind(y);y.resetLocaleData.bind(y);y.subscribe.bind(y);const j=y.__.bind(y);y._x.bind(y);y._n.bind(y);y._nx.bind(y);y.isRTL.bind(y);y.hasTranslation.bind(y);function me(e){const t=(r,n)=>{const{headers:i={}}=r;for(const s in i)if(s.toLowerCase()==="x-wp-nonce"&&i[s]===t.nonce)return n(r);return n({...r,headers:{...i,"X-WP-Nonce":t.nonce}})};return t.nonce=e,t}const ee=(e,t)=>{let r=e.path,n,i;return typeof e.namespace=="string"&&typeof e.endpoint=="string"&&(n=e.namespace.replace(/^\/|\/$/g,""),i=e.endpoint.replace(/^\//,""),i?r=n+"/"+i:r=n),delete e.namespace,delete e.endpoint,t({...e,path:r})},be=e=>(t,r)=>ee(t,n=>{let i=n.url,s=n.path,a;return typeof s=="string"&&(a=e,e.indexOf("?")!==-1&&(s=s.replace("?","&")),s=s.replace(/^\//,""),typeof a=="string"&&a.indexOf("?")!==-1&&(s=s.replace("?","&")),i=a+s),r({...n,url:i})});function ve(e){let t;try{t=new URL(e,"http://example.com").search.substring(1)}catch{}if(t)return t}function xe(e){let t="";const r=Object.entries(e);let n;for(;n=r.shift();){let[i,s]=n;if(Array.isArray(s)||s&&s.constructor===Object){const o=Object.entries(s).reverse();for(const[d,l]of o)r.unshift([`${i}[${d}]`,l])}else s!==void 0&&(s===null&&(s=""),t+="&"+[i,s].map(encodeURIComponent).join("="))}return t.substr(1)}function Ae(e){try{return decodeURIComponent(e)}catch{return e}}function Ee(e,t,r){const n=t.length,i=n-1;for(let s=0;s<n;s++){let a=t[s];!a&&Array.isArray(e)&&(a=e.length.toString()),a=["__proto__","constructor","prototype"].includes(a)?a.toUpperCase():a;const o=!isNaN(Number(t[s+1]));e[a]=s===i?r:e[a]||(o?[]:{}),Array.isArray(e[a])&&!o&&(e[a]={...e[a]}),e=e[a]}}function D(e){return(ve(e)||"").replace(/\+/g,"%20").split("&").reduce((t,r)=>{const[n,i=""]=r.split("=").filter(Boolean).map(Ae);if(n){const s=n.replace(/\]/g,"").split("[");Ee(t,s,i)}return t},Object.create(null))}function E(e="",t){if(!t||!Object.keys(t).length)return e;let r=e;const n=e.indexOf("?");return n!==-1&&(t=Object.assign(D(e),t),r=r.substr(0,n)),r+"?"+xe(t)}function Te(e,t){return D(e)[t]}function k(e,t){return Te(e,t)!==void 0}function G(e){const t=e.split("?"),r=t[1],n=t[0];return r?n+"?"+r.split("&").map(i=>i.split("=")).map(i=>i.map(decodeURIComponent)).sort((i,s)=>i[0].localeCompare(s[0])).map(i=>i.map(encodeURIComponent)).map(i=>i.join("=")).join("&"):n}function Oe(e){const t=Object.fromEntries(Object.entries(e).map(([r,n])=>[G(r),n]));return(r,n)=>{const{parse:i=!0}=r;let s=r.path;if(!s&&r.url){const{rest_route:d,...l}=D(r.url);typeof d=="string"&&(s=E(d,l))}if(typeof s!="string")return n(r);const a=r.method||"GET",o=G(s);if(a==="GET"&&t[o]){const d=t[o];return delete t[o],N(d,!!i)}else if(a==="OPTIONS"&&t[a]&&t[a][o]){const d=t[a][o];return delete t[a][o],N(d,!!i)}return n(r)}}function N(e,t){return Promise.resolve(t?e.body:new window.Response(JSON.stringify(e.body),{status:200,statusText:"OK",headers:e.headers}))}const Fe=({path:e,url:t,...r},n)=>({...r,url:t&&E(t,n),path:e&&E(e,n)}),Z=e=>e.json?e.json():Promise.reject(e),Re=e=>{if(!e)return{};const t=e.match(/<([^>]+)>; rel="next"/);return t?{next:t[1]}:{}},V=e=>{const{next:t}=Re(e.headers.get("link"));return t},Se=e=>{const t=!!e.path&&e.path.indexOf("per_page=-1")!==-1,r=!!e.url&&e.url.indexOf("per_page=-1")!==-1;return t||r},te=async(e,t)=>{if(e.parse===!1||!Se(e))return t(e);const r=await v({...Fe(e,{per_page:100}),parse:!1}),n=await Z(r);if(!Array.isArray(n))return n;let i=V(r);if(!i)return n;let s=[].concat(n);for(;i;){const a=await v({...e,path:void 0,url:i,parse:!1}),o=await Z(a);s=s.concat(o),i=V(a)}return s},Pe=new Set(["PATCH","PUT","DELETE"]),ke="GET",je=(e,t)=>{const{method:r=ke}=e;return Pe.has(r.toUpperCase())&&(e={...e,headers:{...e.headers,"X-HTTP-Method-Override":r,"Content-Type":"application/json"},method:"POST"}),t(e)},He=(e,t)=>(typeof e.url=="string"&&!k(e.url,"_locale")&&(e.url=E(e.url,{_locale:"user"})),typeof e.path=="string"&&!k(e.path,"_locale")&&(e.path=E(e.path,{_locale:"user"})),t(e)),Ie=(e,t=!0)=>t?e.status===204?null:e.json?e.json():Promise.reject(e):e,Me=e=>{const t={code:"invalid_json",message:j("The response is not a valid JSON response.")};if(!e||!e.json)throw t;return e.json().catch(()=>{throw t})},re=(e,t=!0)=>Promise.resolve(Ie(e,t)).catch(r=>L(r,t));function L(e,t=!0){if(!t)throw e;return Me(e).then(r=>{const n={code:"unknown_error",message:j("An unknown error occurred.")};throw r||n})}function De(e){const t=!!e.method&&e.method==="POST";return(!!e.path&&e.path.indexOf("/wp/v2/media")!==-1||!!e.url&&e.url.indexOf("/wp/v2/media")!==-1)&&t}const Le=(e,t)=>{if(!De(e))return t(e);let r=0;const n=5,i=s=>(r++,t({path:`/wp/v2/media/${s}/post-process`,method:"POST",data:{action:"create-image-subsizes"},parse:!1}).catch(()=>r<n?i(s):(t({path:`/wp/v2/media/${s}?force=true`,method:"DELETE"}),Promise.reject())));return t({...e,parse:!1}).catch(s=>{const a=s.headers.get("x-wp-upload-attachment-id");return s.status>=500&&s.status<600&&a?i(a).catch(()=>e.parse!==!1?Promise.reject({code:"post_process",message:j("Media upload failed. If this is a photo or a large image, please scale it down and try again.")}):Promise.reject(s)):L(s,e.parse)}).then(s=>re(s,e.parse))},Ue=e=>(t,r)=>(typeof t.url=="string"&&!k(t.url,"wp_theme_preview")&&(t.url=E(t.url,{wp_theme_preview:e})),typeof t.path=="string"&&!k(t.path,"wp_theme_preview")&&(t.path=E(t.path,{wp_theme_preview:e})),r(t)),Ce={Accept:"application/json, */*;q=0.1"},$e={credentials:"include"},ne=[He,ee,je,te];function ze(e){ne.unshift(e)}const ie=e=>{if(e.status>=200&&e.status<300)return e;throw e},Qe=e=>{const{url:t,path:r,data:n,parse:i=!0,...s}=e;let{body:a,headers:o}=e;return o={...Ce,...o},n&&(a=JSON.stringify(n),o["Content-Type"]="application/json"),window.fetch(t||r||window.location.href,{...$e,...s,body:a,headers:o}).then(l=>Promise.resolve(l).then(ie).catch(g=>L(g,i)).then(g=>re(g,i)),l=>{throw l&&l.name==="AbortError"?l:{code:"fetch_error",message:j("You are probably offline.")}})};let se=Qe;function qe(e){se=e}function v(e){return ne.reduceRight((r,n)=>i=>n(i,r),se)(e).catch(r=>r.code!=="rest_cookie_invalid_nonce"?Promise.reject(r):window.fetch(v.nonceEndpoint).then(ie).then(n=>n.text()).then(n=>(v.nonceMiddleware.nonce=n,v(e))))}v.use=ze;v.setFetchHandler=qe;v.createNonceMiddleware=me;v.createPreloadingMiddleware=Oe;v.createRootURLMiddleware=be;v.fetchAllMiddleware=te;v.mediaUploadMiddleware=Le;v.createThemePreviewMiddleware=Ue;const ae=v;ae.use(v.createNonceMiddleware(wp_rest_nonce));ae.use(v.createRootURLMiddleware(tukutema_rest));export{ae as f};
