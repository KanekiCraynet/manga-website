import{f as q}from"./24f41c4f.js";const p=document.querySelector(".login-btn button.btn-block"),f=document.querySelector(".register-btn button.btn-block"),g=document.querySelector(".reset-btn button.btn-block"),k=document.querySelector(".reset-new-btn button.btn-block"),c=async(e,r,t,s=null)=>{const o=document.querySelector(`#${t}-error`),a=document.querySelector(`#${t}-success`),n=document.querySelector(`#${t}-loading`);try{n.style.display="block",o.style.display="none",n.style.display="block";const u=await(await fetch(ajax_url+"/"+t,{method:"POST",body:JSON.stringify({...r,nonce:lore_nonce}),headers:{"content-type":"application/json","x-wp-nonce":s||rest_nonce}})).json();u.status?t.match(/reset|setting/gi)?(a.style.display="block",a.textContent=u.message):redirect_after_login?location.href=redirect_after_login:location.href="/":(o.textContent=u.message,o.style.display="block")}catch(m){o.textContent=m.message,o.style.display="block"}finally{n.style.display="none"}};p&&p.addEventListener("click",async e=>{e.preventDefault();const r=document.querySelector("#email").value,t=document.querySelector("#password").value,s=!!document.querySelector("#remember").value;await c("user_login_custom",{user_login:r,user_pass:t,remember:s},"login")});f&&f.addEventListener("click",async e=>{e.preventDefault();const r=document.querySelector("#reg-email").value,t=document.querySelector("#reg-password").value,s=document.querySelector("#reg-username").value,o=document.querySelector("#reg-rep-password").value;if(!t||!o||t!==o){const a=document.querySelector("#register-error");a.textContent="Kata sandi itu wajib dan harus sama!",a.style.display="block";return}await c("user_register_custom",{user_login:r,user_pass:t,user_name:s},"register")});g&&g.addEventListener("click",async e=>{e.preventDefault();const r=document.querySelector("#reset-username").value;if(!r){const t=document.querySelector("#reset-error");t.textContent="Masukkan username atau email.",t.style.display="block";return}await c("user_reset_custom",{user_login:r},"reset")});k&&k.addEventListener("click",async e=>{e.preventDefault();const r=document.querySelector("#reset-new-password").value,t=document.querySelector("#reset-repeat-password").value;if(!r||!t||r!==t){const s=document.querySelector("#reset-new-error");s.textContent="Masukkan password baru dan ulangi.",s.style.display="block";return}await c("user_reset_custom",{new_pass:r,reset_key,reset_login},"reset-new")});const d=document.querySelectorAll("[data-kr-target]");d&&d.forEach(e=>{e.addEventListener("click",r=>{r.preventDefault();const t=r.target.dataset.krTarget;d.forEach(s=>{s.dataset.krTarget===t?document.querySelector(s.dataset.krTarget).style.display="block":document.querySelector(s.dataset.krTarget).style.display="none"})})});const S=document.querySelector(".user-setting-btn button");S&&S.addEventListener("click",async e=>{e.preventDefault();const r={display:document.querySelector("#input-display-name").value,email:document.querySelector("#input-email").value,password:document.querySelector("#input-current-password").value,newpass:document.querySelector("#input-new-password").value,repeat:document.querySelector("#input-repeat-password").value,user_id:document.querySelector('[name="user_id"]').value};if(console.log(r),r.newpass!==r.repeat){const t=document.querySelector("#user-setting-error");t.textContent="Password tidak sama.",t.style.display="block";return}await c("",r,"user-setting")});const l=document.getElementById("bookmark");l&&komik_id&&l.addEventListener("click",async e=>{if(e.preventDefault(),!is_user_logged_in){location.href=redirect_url;return}try{const r=e.target.dataset.bookmarked==="true"?"PUT":"POST",t=await q({path:"bookmark/"+komik_id,method:r});if(t.status)r==="PUT"?(l.innerHTML='<i class="fas fa-heart"></i> Bookmark',l.dataset.bookmarked=!1):(l.innerHTML='<i class="fas fa-heart"></i> Bookmarked',l.dataset.bookmarked=!0);else{alert(t.message);return}}catch(r){alert(r.message)}});const b=document.querySelector("#resetModal .modal-footer .btn-primary");if(b){const e=document.querySelector("#resetModal .alert.alert-danger"),r=document.querySelector("#resetModal .alert.alert-success"),t=document.querySelector("#resetModal .alert.alert-info"),s=document.querySelector("#resetModal .form-group");b.addEventListener("click",async o=>{o.preventDefault(),e.style.display="none",t.style.display="none",r.style.display="none";const a=document.querySelector("#resetbookmarkpassword").value;if(!a){e.textContent="Masukkan password!",e.style.display="block";return}s.style.display="none";try{t.textContent="Sedang reset bookmark...";const n=await q({path:"bookmark/reset",data:{password:a},method:"POST"});n.status?(r.textContent=n.message,r.style.display="block",setTimeout(()=>{location.reload()},2e3)):(e.textContent=n.message,e.style.display="block")}catch(n){e.textContent=n.message,e.style.display="block"}finally{t.style.display="none",s.style.display="block"}})}const i=()=>{try{const e=JSON.parse(localStorage.getItem("history_baca"));return e||[]}catch{return[]}},_=(e,r=null)=>{try{let t=r;t!==null&&(t=i());let s=-1;return t.find((a,n)=>a.id===e.id?(s=n,!0):!1)&&s!==-1&&t.splice(s,1),t.unshift(e),localStorage.setItem("history_baca",JSON.stringify(t))}catch(t){console.log(t)}};typeof is_chapter_page<"u"&&typeof save_history_read<"u"&&_(save_history_read,i());if(typeof is_komik_page<"u"){const e=i();e&&e.length&&e.forEach(r=>{const t=document.querySelector(`.komik_info-chapters .komik_info-chapters-item[data-visited="${r.id}"]`);console.log(t,r),t&&t.classList.add("visited")})}if(typeof is_history_page<"u"){const e=i();if(e&&e.length){const r=document.querySelector("template#history-item"),t=document.querySelector("#history_wrapper");for(const s of e){const o=r.content.cloneNode(!0);if(!o)break;o.querySelector(".chapter-link-item").textContent=s.title,o.querySelector(".chapter-link-item").setAttribute("href",s.link),o.querySelector(".chapter-link-time").textContent=new Date(s.added).toLocaleDateString("id-ID"),t.append(o)}}}const y=document.querySelector(".user-navigation-avatar");if(y){let e=!1;y.addEventListener("click",r=>{e=!e,r.target.classList.toggle("show",e)}),addEventListener("click",r=>{r.target.closest(".user-navigation")||(e=!1,y.classList.toggle("show",e))})}
