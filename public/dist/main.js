import{r as p,o as u,c as _,a as e,t as r,F as d,p as i,b as g,d as l,e as m}from"./vendor.js";const h="/dist/logo.png";const v=(t,o)=>{const n=t.__vccOpts||t;for(const[s,c]of o)n[s]=c;return n},a=t=>(i("data-v-835d9813"),t=t(),g(),t),f=a(()=>e("img",{alt:"Vue logo",src:h,height:"40"},null,-1)),k=a(()=>e("p",null,[e("a",{href:"https://vitejs.dev/guide/features.html",target:"_blank"}," Vite Documentation "),l(" | "),e("a",{href:"https://v3.vuejs.org/",target:"_blank"},"Vue 3 Documentation")],-1)),V=a(()=>e("p",null,[l(" Edit "),e("code",null,"components/HelloWorld.vue"),l(" to test hot module replacement. ")],-1)),b={__name:"HelloWorld",props:{msg:String},setup(t){const o=p({count:0});return(n,s)=>(u(),_(d,null,[f,e("h1",null,"Vue "+r(t.msg),1),k,e("button",{type:"button",onClick:s[0]||(s[0]=c=>o.count++)}," count is: "+r(o.count),1),V],64))}},x=v(b,[["__scopeId","data-v-835d9813"]]);m(x).mount("#app");console.log("logging ...");