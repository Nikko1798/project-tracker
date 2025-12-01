import{F as p,d as f,aC as h,m as g,aD as C,a2 as o}from"./app-BMLRUz-u.js";function c(e){return e?e.flatMap(t=>t.type===p?c(t.children):[t]):[]}const w=f({name:"PrimitiveSlot",inheritAttrs:!1,setup(e,{attrs:t,slots:n}){return()=>{if(!n.default)return null;const r=c(n.default()),s=r.findIndex(l=>l.type!==h);if(s===-1)return r;const a=r[s];delete a.props?.ref;const d=a.props?g(t,a.props):t,i=C({...a,props:{}},d);return r.length===1?i:(r[s]=i,r)}}}),v=["area","img","input"],N=f({name:"Primitive",inheritAttrs:!1,props:{asChild:{type:Boolean,default:!1},as:{type:[String,Object],default:"div"}},setup(e,{attrs:t,slots:n}){const r=e.asChild?"template":e.as;return typeof r=="string"&&v.includes(r)?()=>o(r,t):r!=="template"?()=>o(e.as,t,{default:n.default}):()=>o(w,t,{default:n.default})}});/**
 * @license lucide-vue-next v0.468.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const S=e=>e.replace(/([a-z0-9])([A-Z])/g,"$1-$2").toLowerCase();/**
 * @license lucide-vue-next v0.468.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */var u={xmlns:"http://www.w3.org/2000/svg",width:24,height:24,viewBox:"0 0 24 24",fill:"none",stroke:"currentColor","stroke-width":2,"stroke-linecap":"round","stroke-linejoin":"round"};/**
 * @license lucide-vue-next v0.468.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const b=({size:e,strokeWidth:t=2,absoluteStrokeWidth:n,color:r,iconNode:s,name:a,class:d,...i},{slots:l})=>o("svg",{...u,width:e||u.width,height:e||u.height,stroke:r||u.stroke,"stroke-width":n?Number(t)*24/Number(e):t,class:["lucide",`lucide-${S(a??"icon")}`],...i},[...s.map(m=>o(...m)),...l.default?[l.default()]:[]]);/**
 * @license lucide-vue-next v0.468.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const P=(e,t)=>(n,{slots:r})=>o(b,{...n,iconNode:t,name:e},r);export{N as P,w as S,P as c,c as r};
