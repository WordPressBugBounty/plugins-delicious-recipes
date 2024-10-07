var drExports;!function(){var e={2833:function(e){e.exports=function(e,t,r,n){var a=r?r.call(n,e,t):void 0;if(void 0!==a)return!!a;if(e===t)return!0;if("object"!=typeof e||!e||"object"!=typeof t||!t)return!1;var i=Object.keys(e),o=Object.keys(t);if(i.length!==o.length)return!1;for(var c=Object.prototype.hasOwnProperty.bind(t),l=0;l<i.length;l++){var s=i[l];if(!c(s))return!1;var p=e[s],u=t[s];if(!1===(a=r?r.call(n,p,u,s):void 0)||void 0===a&&p!==u)return!1}return!0}}},t={};function r(n){var a=t[n];if(void 0!==a)return a.exports;var i=t[n]={exports:{}};return e[n](i,i.exports,r),i.exports}r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.nc=void 0,function(){"use strict";var e=window.wp.element,t=window.wp.i18n;const n=(0,e.createContext)();function a(r){let{children:a}=r;const[i,o]=(0,e.useState)({loading:!1,selectedOption:"",showMsg:!0,importStart:!1,importSuccess:!1,pns:!1,recipes:[],recipeCount:0,recipesToList:[],list:10,currentPage:1,recipesToImport:[],deleteRecipes:!1,recipeFields:[],importPluginFields:[]}),c={"recipe-course":(0,t.__)("Recipe Courses","delicious-recipes"),"recipe-cuisine":(0,t.__)("Recipe Cuisines","delicious-recipes"),"recipe-cooking-method":(0,t.__)("Recipe Cooking Methods","delicious-recipes"),"recipe-key":(0,t.__)("Recipe Keys","delicious-recipes"),"recipe-tag":(0,t.__)("Recipe Tags","delicious-recipes"),"recipe-badge":(0,t.__)("Recipe Badges","delicious-recipes"),"recipe-dietary":(0,t.__)("Recipe Dietaries","delicious-recipes"),recipe_keywords:(0,t.__)("Recipe Keywords","delicious-recipes")},{recipes:l,list:s,currentPage:p,recipesToList:u}=i;return l.length>0&&0===u.length&&o({...i,recipesToList:l.slice((p-1)*s,p*s)}),React.createElement(n.Provider,{value:{globalState:i,setGlobalState:o,wpd_fields:c}},a)}function i(){return(0,e.useContext)(n)}function o(e,t,r,n,a,i,o){try{var c=e[i](o),l=c.value}catch(e){return void r(e)}c.done?t(l):Promise.resolve(l).then(n,a)}function c(e){return function(){var t=this,r=arguments;return new Promise((function(n,a){var i=e.apply(t,r);function c(e){o(i,n,a,c,l,"next",e)}function l(e){o(i,n,a,c,l,"throw",e)}c(void 0)}))}}var l=window.wp.apiFetch,s=r.n(l),p=function(){return p=Object.assign||function(e){for(var t,r=1,n=arguments.length;r<n;r++)for(var a in t=arguments[r])Object.prototype.hasOwnProperty.call(t,a)&&(e[a]=t[a]);return e},p.apply(this,arguments)};function u(e,t,r){if(r||2===arguments.length)for(var n,a=0,i=t.length;a<i;a++)!n&&a in t||(n||(n=Array.prototype.slice.call(t,0,a)),n[a]=t[a]);return e.concat(n||Array.prototype.slice.call(t))}Object.create,Object.create,"function"==typeof SuppressedError&&SuppressedError;var d=window.React,m=r.n(d),h=r(2833),f=r.n(h),g="-ms-",v="-moz-",E="-webkit-",x="comm",w="rule",b="decl",y="@keyframes",R=Math.abs,C=String.fromCharCode,k=Object.assign;function _(e){return e.trim()}function S(e,t){return(e=t.exec(e))?e[0]:e}function D(e,t,r){return e.replace(t,r)}function I(e,t,r){return e.indexOf(t,r)}function T(e,t){return 0|e.charCodeAt(t)}function P(e,t,r){return e.slice(t,r)}function L(e){return e.length}function F(e){return e.length}function M(e,t){return t.push(e),e}function B(e,t){return e.filter((function(e){return!S(e,t)}))}var A=1,$=1,N=0,O=0,j=0,H="";function z(e,t,r,n,a,i,o,c){return{value:e,root:t,parent:r,type:n,props:a,children:i,line:A,column:$,length:o,return:"",siblings:c}}function V(e,t){return k(z("",null,null,"",null,null,0,e.siblings),e,{length:-e.length},t)}function Z(e){for(;e.root;)e=V(e.root,{children:[e]});M(e,e.siblings)}function G(){return j=O>0?T(H,--O):0,$--,10===j&&($=1,A--),j}function W(){return j=O<N?T(H,O++):0,$++,10===j&&($=1,A++),j}function Y(){return T(H,O)}function U(){return O}function q(e,t){return P(H,e,t)}function J(e){switch(e){case 0:case 9:case 10:case 13:case 32:return 5;case 33:case 43:case 44:case 47:case 62:case 64:case 126:case 59:case 123:case 125:return 4;case 58:return 3;case 34:case 39:case 40:case 91:return 2;case 41:case 93:return 1}return 0}function K(e){return _(q(O-1,ee(91===e?e+2:40===e?e+1:e)))}function Q(e){for(;(j=Y())&&j<33;)W();return J(e)>2||J(j)>3?"":" "}function X(e,t){for(;--t&&W()&&!(j<48||j>102||j>57&&j<65||j>70&&j<97););return q(e,U()+(t<6&&32==Y()&&32==W()))}function ee(e){for(;W();)switch(j){case e:return O;case 34:case 39:34!==e&&39!==e&&ee(j);break;case 40:41===e&&ee(e);break;case 92:W()}return O}function te(e,t){for(;W()&&e+j!==57&&(e+j!==84||47!==Y()););return"/*"+q(t,O-1)+"*"+C(47===e?e:W())}function re(e){for(;!J(Y());)W();return q(e,O)}function ne(e,t){for(var r="",n=0;n<e.length;n++)r+=t(e[n],n,e,t)||"";return r}function ae(e,t,r,n){switch(e.type){case"@layer":if(e.children.length)break;case"@import":case b:return e.return=e.return||e.value;case x:return"";case y:return e.return=e.value+"{"+ne(e.children,n)+"}";case w:if(!L(e.value=e.props.join(",")))return""}return L(r=ne(e.children,n))?e.return=e.value+"{"+r+"}":""}function ie(e,t,r){switch(function(e,t){return 45^T(e,0)?(((t<<2^T(e,0))<<2^T(e,1))<<2^T(e,2))<<2^T(e,3):0}(e,t)){case 5103:return E+"print-"+e+e;case 5737:case 4201:case 3177:case 3433:case 1641:case 4457:case 2921:case 5572:case 6356:case 5844:case 3191:case 6645:case 3005:case 6391:case 5879:case 5623:case 6135:case 4599:case 4855:case 4215:case 6389:case 5109:case 5365:case 5621:case 3829:return E+e+e;case 4789:return v+e+e;case 5349:case 4246:case 4810:case 6968:case 2756:return E+e+v+e+g+e+e;case 5936:switch(T(e,t+11)){case 114:return E+e+g+D(e,/[svh]\w+-[tblr]{2}/,"tb")+e;case 108:return E+e+g+D(e,/[svh]\w+-[tblr]{2}/,"tb-rl")+e;case 45:return E+e+g+D(e,/[svh]\w+-[tblr]{2}/,"lr")+e}case 6828:case 4268:case 2903:return E+e+g+e+e;case 6165:return E+e+g+"flex-"+e+e;case 5187:return E+e+D(e,/(\w+).+(:[^]+)/,E+"box-$1$2"+g+"flex-$1$2")+e;case 5443:return E+e+g+"flex-item-"+D(e,/flex-|-self/g,"")+(S(e,/flex-|baseline/)?"":g+"grid-row-"+D(e,/flex-|-self/g,""))+e;case 4675:return E+e+g+"flex-line-pack"+D(e,/align-content|flex-|-self/g,"")+e;case 5548:return E+e+g+D(e,"shrink","negative")+e;case 5292:return E+e+g+D(e,"basis","preferred-size")+e;case 6060:return E+"box-"+D(e,"-grow","")+E+e+g+D(e,"grow","positive")+e;case 4554:return E+D(e,/([^-])(transform)/g,"$1"+E+"$2")+e;case 6187:return D(D(D(e,/(zoom-|grab)/,E+"$1"),/(image-set)/,E+"$1"),e,"")+e;case 5495:case 3959:return D(e,/(image-set\([^]*)/,E+"$1$`$1");case 4968:return D(D(e,/(.+:)(flex-)?(.*)/,E+"box-pack:$3"+g+"flex-pack:$3"),/s.+-b[^;]+/,"justify")+E+e+e;case 4200:if(!S(e,/flex-|baseline/))return g+"grid-column-align"+P(e,t)+e;break;case 2592:case 3360:return g+D(e,"template-","")+e;case 4384:case 3616:return r&&r.some((function(e,r){return t=r,S(e.props,/grid-\w+-end/)}))?~I(e+(r=r[t].value),"span",0)?e:g+D(e,"-start","")+e+g+"grid-row-span:"+(~I(r,"span",0)?S(r,/\d+/):+S(r,/\d+/)-+S(e,/\d+/))+";":g+D(e,"-start","")+e;case 4896:case 4128:return r&&r.some((function(e){return S(e.props,/grid-\w+-start/)}))?e:g+D(D(e,"-end","-span"),"span ","")+e;case 4095:case 3583:case 4068:case 2532:return D(e,/(.+)-inline(.+)/,E+"$1$2")+e;case 8116:case 7059:case 5753:case 5535:case 5445:case 5701:case 4933:case 4677:case 5533:case 5789:case 5021:case 4765:if(L(e)-1-t>6)switch(T(e,t+1)){case 109:if(45!==T(e,t+4))break;case 102:return D(e,/(.+:)(.+)-([^]+)/,"$1"+E+"$2-$3$1"+v+(108==T(e,t+3)?"$3":"$2-$3"))+e;case 115:return~I(e,"stretch",0)?ie(D(e,"stretch","fill-available"),t,r)+e:e}break;case 5152:case 5920:return D(e,/(.+?):(\d+)(\s*\/\s*(span)?\s*(\d+))?(.*)/,(function(t,r,n,a,i,o,c){return g+r+":"+n+c+(a?g+r+"-span:"+(i?o:+o-+n)+c:"")+e}));case 4949:if(121===T(e,t+6))return D(e,":",":"+E)+e;break;case 6444:switch(T(e,45===T(e,14)?18:11)){case 120:return D(e,/(.+:)([^;\s!]+)(;|(\s+)?!.+)?/,"$1"+E+(45===T(e,14)?"inline-":"")+"box$3$1"+E+"$2$3$1"+g+"$2box$3")+e;case 100:return D(e,":",":"+g)+e}break;case 5719:case 2647:case 2135:case 3927:case 2391:return D(e,"scroll-","scroll-snap-")+e}return e}function oe(e,t,r,n){if(e.length>-1&&!e.return)switch(e.type){case b:return void(e.return=ie(e.value,e.length,r));case y:return ne([V(e,{value:D(e.value,"@","@"+E)})],n);case w:if(e.length)return function(e,t){return e.map(t).join("")}(r=e.props,(function(t){switch(S(t,n=/(::plac\w+|:read-\w+)/)){case":read-only":case":read-write":Z(V(e,{props:[D(t,/:(read-\w+)/,":-moz-$1")]})),Z(V(e,{props:[t]})),k(e,{props:B(r,n)});break;case"::placeholder":Z(V(e,{props:[D(t,/:(plac\w+)/,":"+E+"input-$1")]})),Z(V(e,{props:[D(t,/:(plac\w+)/,":-moz-$1")]})),Z(V(e,{props:[D(t,/:(plac\w+)/,g+"input-$1")]})),Z(V(e,{props:[t]})),k(e,{props:B(r,n)})}return""}))}}function ce(e){return function(e){return H="",e}(le("",null,null,null,[""],e=function(e){return A=$=1,N=L(H=e),O=0,[]}(e),0,[0],e))}function le(e,t,r,n,a,i,o,c,l){for(var s=0,p=0,u=o,d=0,m=0,h=0,f=1,g=1,v=1,E=0,x="",w=a,b=i,y=n,k=x;g;)switch(h=E,E=W()){case 40:if(108!=h&&58==T(k,u-1)){-1!=I(k+=D(K(E),"&","&\f"),"&\f",R(s?c[s-1]:0))&&(v=-1);break}case 34:case 39:case 91:k+=K(E);break;case 9:case 10:case 13:case 32:k+=Q(h);break;case 92:k+=X(U()-1,7);continue;case 47:switch(Y()){case 42:case 47:M(pe(te(W(),U()),t,r,l),l);break;default:k+="/"}break;case 123*f:c[s++]=L(k)*v;case 125*f:case 59:case 0:switch(E){case 0:case 125:g=0;case 59+p:-1==v&&(k=D(k,/\f/g,"")),m>0&&L(k)-u&&M(m>32?ue(k+";",n,r,u-1,l):ue(D(k," ","")+";",n,r,u-2,l),l);break;case 59:k+=";";default:if(M(y=se(k,t,r,s,p,a,c,x,w=[],b=[],u,i),i),123===E)if(0===p)le(k,t,y,y,w,i,u,c,b);else switch(99===d&&110===T(k,3)?100:d){case 100:case 108:case 109:case 115:le(e,y,y,n&&M(se(e,y,y,0,0,a,c,x,a,w=[],u,b),b),a,b,u,c,n?w:b);break;default:le(k,y,y,y,[""],b,0,c,b)}}s=p=m=0,f=v=1,x=k="",u=o;break;case 58:u=1+L(k),m=h;default:if(f<1)if(123==E)--f;else if(125==E&&0==f++&&125==G())continue;switch(k+=C(E),E*f){case 38:v=p>0?1:(k+="\f",-1);break;case 44:c[s++]=(L(k)-1)*v,v=1;break;case 64:45===Y()&&(k+=K(W())),d=Y(),p=u=L(x=k+=re(U())),E++;break;case 45:45===h&&2==L(k)&&(f=0)}}return i}function se(e,t,r,n,a,i,o,c,l,s,p,u){for(var d=a-1,m=0===a?i:[""],h=F(m),f=0,g=0,v=0;f<n;++f)for(var E=0,x=P(e,d+1,d=R(g=o[f])),b=e;E<h;++E)(b=_(g>0?m[E]+" "+x:D(x,/&\f/g,m[E])))&&(l[v++]=b);return z(e,t,r,0===a?w:c,l,s,p,u)}function pe(e,t,r,n){return z(e,t,r,x,C(j),P(e,2,-2),0,n)}function ue(e,t,r,n,a){return z(e,t,r,b,P(e,0,n),P(e,n+1,-1),n,a)}var de={animationIterationCount:1,aspectRatio:1,borderImageOutset:1,borderImageSlice:1,borderImageWidth:1,boxFlex:1,boxFlexGroup:1,boxOrdinalGroup:1,columnCount:1,columns:1,flex:1,flexGrow:1,flexPositive:1,flexShrink:1,flexNegative:1,flexOrder:1,gridRow:1,gridRowEnd:1,gridRowSpan:1,gridRowStart:1,gridColumn:1,gridColumnEnd:1,gridColumnSpan:1,gridColumnStart:1,msGridRow:1,msGridRowSpan:1,msGridColumn:1,msGridColumnSpan:1,fontWeight:1,lineHeight:1,opacity:1,order:1,orphans:1,tabSize:1,widows:1,zIndex:1,zoom:1,WebkitLineClamp:1,fillOpacity:1,floodOpacity:1,stopOpacity:1,strokeDasharray:1,strokeDashoffset:1,strokeMiterlimit:1,strokeOpacity:1,strokeWidth:1},me="undefined"!=typeof process&&void 0!==process.env&&(process.env.REACT_APP_SC_ATTR||process.env.SC_ATTR)||"data-styled",he="active",fe="data-styled-version",ge="6.1.13",ve="/*!sc*/\n",Ee="undefined"!=typeof window&&"HTMLElement"in window,xe=Boolean("boolean"==typeof SC_DISABLE_SPEEDY?SC_DISABLE_SPEEDY:"undefined"!=typeof process&&void 0!==process.env&&void 0!==process.env.REACT_APP_SC_DISABLE_SPEEDY&&""!==process.env.REACT_APP_SC_DISABLE_SPEEDY?"false"!==process.env.REACT_APP_SC_DISABLE_SPEEDY&&process.env.REACT_APP_SC_DISABLE_SPEEDY:"undefined"!=typeof process&&void 0!==process.env&&void 0!==process.env.SC_DISABLE_SPEEDY&&""!==process.env.SC_DISABLE_SPEEDY&&"false"!==process.env.SC_DISABLE_SPEEDY&&process.env.SC_DISABLE_SPEEDY),we=(new Set,Object.freeze([])),be=Object.freeze({});var ye=new Set(["a","abbr","address","area","article","aside","audio","b","base","bdi","bdo","big","blockquote","body","br","button","canvas","caption","cite","code","col","colgroup","data","datalist","dd","del","details","dfn","dialog","div","dl","dt","em","embed","fieldset","figcaption","figure","footer","form","h1","h2","h3","h4","h5","h6","header","hgroup","hr","html","i","iframe","img","input","ins","kbd","keygen","label","legend","li","link","main","map","mark","menu","menuitem","meta","meter","nav","noscript","object","ol","optgroup","option","output","p","param","picture","pre","progress","q","rp","rt","ruby","s","samp","script","section","select","small","source","span","strong","style","sub","summary","sup","table","tbody","td","textarea","tfoot","th","thead","time","tr","track","u","ul","use","var","video","wbr","circle","clipPath","defs","ellipse","foreignObject","g","image","line","linearGradient","marker","mask","path","pattern","polygon","polyline","radialGradient","rect","stop","svg","text","tspan"]),Re=/[!"#$%&'()*+,./:;<=>?@[\\\]^`{|}~-]+/g,Ce=/(^-|-$)/g;function ke(e){return e.replace(Re,"-").replace(Ce,"")}var _e=/(a)(d)/gi,Se=function(e){return String.fromCharCode(e+(e>25?39:97))};function De(e){var t,r="";for(t=Math.abs(e);t>52;t=t/52|0)r=Se(t%52)+r;return(Se(t%52)+r).replace(_e,"$1-$2")}var Ie,Te=function(e,t){for(var r=t.length;r;)e=33*e^t.charCodeAt(--r);return e},Pe=function(e){return Te(5381,e)};function Le(e){return"string"==typeof e&&!0}var Fe="function"==typeof Symbol&&Symbol.for,Me=Fe?Symbol.for("react.memo"):60115,Be=Fe?Symbol.for("react.forward_ref"):60112,Ae={childContextTypes:!0,contextType:!0,contextTypes:!0,defaultProps:!0,displayName:!0,getDefaultProps:!0,getDerivedStateFromError:!0,getDerivedStateFromProps:!0,mixins:!0,propTypes:!0,type:!0},$e={name:!0,length:!0,prototype:!0,caller:!0,callee:!0,arguments:!0,arity:!0},Ne={$$typeof:!0,compare:!0,defaultProps:!0,displayName:!0,propTypes:!0,type:!0},Oe=((Ie={})[Be]={$$typeof:!0,render:!0,defaultProps:!0,displayName:!0,propTypes:!0},Ie[Me]=Ne,Ie);function je(e){return("type"in(t=e)&&t.type.$$typeof)===Me?Ne:"$$typeof"in e?Oe[e.$$typeof]:Ae;var t}var He=Object.defineProperty,ze=Object.getOwnPropertyNames,Ve=Object.getOwnPropertySymbols,Ze=Object.getOwnPropertyDescriptor,Ge=Object.getPrototypeOf,We=Object.prototype;function Ye(e,t,r){if("string"!=typeof t){if(We){var n=Ge(t);n&&n!==We&&Ye(e,n,r)}var a=ze(t);Ve&&(a=a.concat(Ve(t)));for(var i=je(e),o=je(t),c=0;c<a.length;++c){var l=a[c];if(!(l in $e||r&&r[l]||o&&l in o||i&&l in i)){var s=Ze(t,l);try{He(e,l,s)}catch(e){}}}}return e}function Ue(e){return"function"==typeof e}function qe(e){return"object"==typeof e&&"styledComponentId"in e}function Je(e,t){return e&&t?"".concat(e," ").concat(t):e||t||""}function Ke(e,t){if(0===e.length)return"";for(var r=e[0],n=1;n<e.length;n++)r+=t?t+e[n]:e[n];return r}function Qe(e){return null!==e&&"object"==typeof e&&e.constructor.name===Object.name&&!("props"in e&&e.$$typeof)}function Xe(e,t,r){if(void 0===r&&(r=!1),!r&&!Qe(e)&&!Array.isArray(e))return t;if(Array.isArray(t))for(var n=0;n<t.length;n++)e[n]=Xe(e[n],t[n]);else if(Qe(t))for(var n in t)e[n]=Xe(e[n],t[n]);return e}function et(e,t){Object.defineProperty(e,"toString",{value:t})}function tt(e){for(var t=[],r=1;r<arguments.length;r++)t[r-1]=arguments[r];return new Error("An error occurred. See https://github.com/styled-components/styled-components/blob/main/packages/styled-components/src/utils/errors.md#".concat(e," for more information.").concat(t.length>0?" Args: ".concat(t.join(", ")):""))}var rt=function(){function e(e){this.groupSizes=new Uint32Array(512),this.length=512,this.tag=e}return e.prototype.indexOfGroup=function(e){for(var t=0,r=0;r<e;r++)t+=this.groupSizes[r];return t},e.prototype.insertRules=function(e,t){if(e>=this.groupSizes.length){for(var r=this.groupSizes,n=r.length,a=n;e>=a;)if((a<<=1)<0)throw tt(16,"".concat(e));this.groupSizes=new Uint32Array(a),this.groupSizes.set(r),this.length=a;for(var i=n;i<a;i++)this.groupSizes[i]=0}for(var o=this.indexOfGroup(e+1),c=(i=0,t.length);i<c;i++)this.tag.insertRule(o,t[i])&&(this.groupSizes[e]++,o++)},e.prototype.clearGroup=function(e){if(e<this.length){var t=this.groupSizes[e],r=this.indexOfGroup(e),n=r+t;this.groupSizes[e]=0;for(var a=r;a<n;a++)this.tag.deleteRule(r)}},e.prototype.getGroup=function(e){var t="";if(e>=this.length||0===this.groupSizes[e])return t;for(var r=this.groupSizes[e],n=this.indexOfGroup(e),a=n+r,i=n;i<a;i++)t+="".concat(this.tag.getRule(i)).concat(ve);return t},e}(),nt=new Map,at=new Map,it=1,ot=function(e){if(nt.has(e))return nt.get(e);for(;at.has(it);)it++;var t=it++;return nt.set(e,t),at.set(t,e),t},ct=function(e,t){it=t+1,nt.set(e,t),at.set(t,e)},lt="style[".concat(me,"][").concat(fe,'="').concat(ge,'"]'),st=new RegExp("^".concat(me,'\\.g(\\d+)\\[id="([\\w\\d-]+)"\\].*?"([^"]*)')),pt=function(e,t,r){for(var n,a=r.split(","),i=0,o=a.length;i<o;i++)(n=a[i])&&e.registerName(t,n)},ut=function(e,t){for(var r,n=(null!==(r=t.textContent)&&void 0!==r?r:"").split(ve),a=[],i=0,o=n.length;i<o;i++){var c=n[i].trim();if(c){var l=c.match(st);if(l){var s=0|parseInt(l[1],10),p=l[2];0!==s&&(ct(p,s),pt(e,p,l[3]),e.getTag().insertRules(s,a)),a.length=0}else a.push(c)}}},dt=function(e){for(var t=document.querySelectorAll(lt),r=0,n=t.length;r<n;r++){var a=t[r];a&&a.getAttribute(me)!==he&&(ut(e,a),a.parentNode&&a.parentNode.removeChild(a))}};function mt(){return r.nc}var ht=function(e){var t=document.head,r=e||t,n=document.createElement("style"),a=function(e){var t=Array.from(e.querySelectorAll("style[".concat(me,"]")));return t[t.length-1]}(r),i=void 0!==a?a.nextSibling:null;n.setAttribute(me,he),n.setAttribute(fe,ge);var o=mt();return o&&n.setAttribute("nonce",o),r.insertBefore(n,i),n},ft=function(){function e(e){this.element=ht(e),this.element.appendChild(document.createTextNode("")),this.sheet=function(e){if(e.sheet)return e.sheet;for(var t=document.styleSheets,r=0,n=t.length;r<n;r++){var a=t[r];if(a.ownerNode===e)return a}throw tt(17)}(this.element),this.length=0}return e.prototype.insertRule=function(e,t){try{return this.sheet.insertRule(t,e),this.length++,!0}catch(e){return!1}},e.prototype.deleteRule=function(e){this.sheet.deleteRule(e),this.length--},e.prototype.getRule=function(e){var t=this.sheet.cssRules[e];return t&&t.cssText?t.cssText:""},e}(),gt=function(){function e(e){this.element=ht(e),this.nodes=this.element.childNodes,this.length=0}return e.prototype.insertRule=function(e,t){if(e<=this.length&&e>=0){var r=document.createTextNode(t);return this.element.insertBefore(r,this.nodes[e]||null),this.length++,!0}return!1},e.prototype.deleteRule=function(e){this.element.removeChild(this.nodes[e]),this.length--},e.prototype.getRule=function(e){return e<this.length?this.nodes[e].textContent:""},e}(),vt=function(){function e(e){this.rules=[],this.length=0}return e.prototype.insertRule=function(e,t){return e<=this.length&&(this.rules.splice(e,0,t),this.length++,!0)},e.prototype.deleteRule=function(e){this.rules.splice(e,1),this.length--},e.prototype.getRule=function(e){return e<this.length?this.rules[e]:""},e}(),Et=Ee,xt={isServer:!Ee,useCSSOMInjection:!xe},wt=function(){function e(e,t,r){void 0===e&&(e=be),void 0===t&&(t={});var n=this;this.options=p(p({},xt),e),this.gs=t,this.names=new Map(r),this.server=!!e.isServer,!this.server&&Ee&&Et&&(Et=!1,dt(this)),et(this,(function(){return function(e){for(var t=e.getTag(),r=t.length,n="",a=function(r){var a=function(e){return at.get(e)}(r);if(void 0===a)return"continue";var i=e.names.get(a),o=t.getGroup(r);if(void 0===i||!i.size||0===o.length)return"continue";var c="".concat(me,".g").concat(r,'[id="').concat(a,'"]'),l="";void 0!==i&&i.forEach((function(e){e.length>0&&(l+="".concat(e,","))})),n+="".concat(o).concat(c,'{content:"').concat(l,'"}').concat(ve)},i=0;i<r;i++)a(i);return n}(n)}))}return e.registerId=function(e){return ot(e)},e.prototype.rehydrate=function(){!this.server&&Ee&&dt(this)},e.prototype.reconstructWithOptions=function(t,r){return void 0===r&&(r=!0),new e(p(p({},this.options),t),this.gs,r&&this.names||void 0)},e.prototype.allocateGSInstance=function(e){return this.gs[e]=(this.gs[e]||0)+1},e.prototype.getTag=function(){return this.tag||(this.tag=(e=function(e){var t=e.useCSSOMInjection,r=e.target;return e.isServer?new vt(r):t?new ft(r):new gt(r)}(this.options),new rt(e)));var e},e.prototype.hasNameForId=function(e,t){return this.names.has(e)&&this.names.get(e).has(t)},e.prototype.registerName=function(e,t){if(ot(e),this.names.has(e))this.names.get(e).add(t);else{var r=new Set;r.add(t),this.names.set(e,r)}},e.prototype.insertRules=function(e,t,r){this.registerName(e,t),this.getTag().insertRules(ot(e),r)},e.prototype.clearNames=function(e){this.names.has(e)&&this.names.get(e).clear()},e.prototype.clearRules=function(e){this.getTag().clearGroup(ot(e)),this.clearNames(e)},e.prototype.clearTag=function(){this.tag=void 0},e}(),bt=/&/g,yt=/^\s*\/\/.*$/gm;function Rt(e,t){return e.map((function(e){return"rule"===e.type&&(e.value="".concat(t," ").concat(e.value),e.value=e.value.replaceAll(",",",".concat(t," ")),e.props=e.props.map((function(e){return"".concat(t," ").concat(e)}))),Array.isArray(e.children)&&"@keyframes"!==e.type&&(e.children=Rt(e.children,t)),e}))}function Ct(e){var t,r,n,a=void 0===e?be:e,i=a.options,o=void 0===i?be:i,c=a.plugins,l=void 0===c?we:c,s=function(e,n,a){return a.startsWith(r)&&a.endsWith(r)&&a.replaceAll(r,"").length>0?".".concat(t):e},p=l.slice();p.push((function(e){e.type===w&&e.value.includes("&")&&(e.props[0]=e.props[0].replace(bt,r).replace(n,s))})),o.prefix&&p.push(oe),p.push(ae);var u=function(e,a,i,c){void 0===a&&(a=""),void 0===i&&(i=""),void 0===c&&(c="&"),t=c,r=a,n=new RegExp("\\".concat(r,"\\b"),"g");var l=e.replace(yt,""),s=ce(i||a?"".concat(i," ").concat(a," { ").concat(l," }"):l);o.namespace&&(s=Rt(s,o.namespace));var u,d,m,h=[];return ne(s,(u=p.concat((m=function(e){return h.push(e)},function(e){e.root||(e=e.return)&&m(e)})),d=F(u),function(e,t,r,n){for(var a="",i=0;i<d;i++)a+=u[i](e,t,r,n)||"";return a})),h};return u.hash=l.length?l.reduce((function(e,t){return t.name||tt(15),Te(e,t.name)}),5381).toString():"",u}var kt=new wt,_t=Ct(),St=m().createContext({shouldForwardProp:void 0,styleSheet:kt,stylis:_t}),Dt=(St.Consumer,m().createContext(void 0));function It(){return(0,d.useContext)(St)}function Tt(e){var t=(0,d.useState)(e.stylisPlugins),r=t[0],n=t[1],a=It().styleSheet,i=(0,d.useMemo)((function(){var t=a;return e.sheet?t=e.sheet:e.target&&(t=t.reconstructWithOptions({target:e.target},!1)),e.disableCSSOMInjection&&(t=t.reconstructWithOptions({useCSSOMInjection:!1})),t}),[e.disableCSSOMInjection,e.sheet,e.target,a]),o=(0,d.useMemo)((function(){return Ct({options:{namespace:e.namespace,prefix:e.enableVendorPrefixes},plugins:r})}),[e.enableVendorPrefixes,e.namespace,r]);(0,d.useEffect)((function(){f()(r,e.stylisPlugins)||n(e.stylisPlugins)}),[e.stylisPlugins]);var c=(0,d.useMemo)((function(){return{shouldForwardProp:e.shouldForwardProp,styleSheet:i,stylis:o}}),[e.shouldForwardProp,i,o]);return m().createElement(St.Provider,{value:c},m().createElement(Dt.Provider,{value:o},e.children))}var Pt=function(){function e(e,t){var r=this;this.inject=function(e,t){void 0===t&&(t=_t);var n=r.name+t.hash;e.hasNameForId(r.id,n)||e.insertRules(r.id,n,t(r.rules,n,"@keyframes"))},this.name=e,this.id="sc-keyframes-".concat(e),this.rules=t,et(this,(function(){throw tt(12,String(r.name))}))}return e.prototype.getName=function(e){return void 0===e&&(e=_t),this.name+e.hash},e}(),Lt=function(e){return e>="A"&&e<="Z"};function Ft(e){for(var t="",r=0;r<e.length;r++){var n=e[r];if(1===r&&"-"===n&&"-"===e[0])return e;Lt(n)?t+="-"+n.toLowerCase():t+=n}return t.startsWith("ms-")?"-"+t:t}var Mt=function(e){return null==e||!1===e||""===e},Bt=function(e){var t,r,n=[];for(var a in e){var i=e[a];e.hasOwnProperty(a)&&!Mt(i)&&(Array.isArray(i)&&i.isCss||Ue(i)?n.push("".concat(Ft(a),":"),i,";"):Qe(i)?n.push.apply(n,u(u(["".concat(a," {")],Bt(i),!1),["}"],!1)):n.push("".concat(Ft(a),": ").concat((t=a,null==(r=i)||"boolean"==typeof r||""===r?"":"number"!=typeof r||0===r||t in de||t.startsWith("--")?String(r).trim():"".concat(r,"px")),";")))}return n};function At(e,t,r,n){return Mt(e)?[]:qe(e)?[".".concat(e.styledComponentId)]:Ue(e)?!Ue(a=e)||a.prototype&&a.prototype.isReactComponent||!t?[e]:At(e(t),t,r,n):e instanceof Pt?r?(e.inject(r,n),[e.getName(n)]):[e]:Qe(e)?Bt(e):Array.isArray(e)?Array.prototype.concat.apply(we,e.map((function(e){return At(e,t,r,n)}))):[e.toString()];var a}function $t(e){for(var t=0;t<e.length;t+=1){var r=e[t];if(Ue(r)&&!qe(r))return!1}return!0}var Nt=Pe(ge),Ot=function(){function e(e,t,r){this.rules=e,this.staticRulesId="",this.isStatic=(void 0===r||r.isStatic)&&$t(e),this.componentId=t,this.baseHash=Te(Nt,t),this.baseStyle=r,wt.registerId(t)}return e.prototype.generateAndInjectStyles=function(e,t,r){var n=this.baseStyle?this.baseStyle.generateAndInjectStyles(e,t,r):"";if(this.isStatic&&!r.hash)if(this.staticRulesId&&t.hasNameForId(this.componentId,this.staticRulesId))n=Je(n,this.staticRulesId);else{var a=Ke(At(this.rules,e,t,r)),i=De(Te(this.baseHash,a)>>>0);if(!t.hasNameForId(this.componentId,i)){var o=r(a,".".concat(i),void 0,this.componentId);t.insertRules(this.componentId,i,o)}n=Je(n,i),this.staticRulesId=i}else{for(var c=Te(this.baseHash,r.hash),l="",s=0;s<this.rules.length;s++){var p=this.rules[s];if("string"==typeof p)l+=p;else if(p){var u=Ke(At(p,e,t,r));c=Te(c,u+s),l+=u}}if(l){var d=De(c>>>0);t.hasNameForId(this.componentId,d)||t.insertRules(this.componentId,d,r(l,".".concat(d),void 0,this.componentId)),n=Je(n,d)}}return n},e}(),jt=m().createContext(void 0);jt.Consumer;var Ht={};function zt(e,t,r){var n=qe(e),a=e,i=!Le(e),o=t.attrs,c=void 0===o?we:o,l=t.componentId,s=void 0===l?function(e,t){var r="string"!=typeof e?"sc":ke(e);Ht[r]=(Ht[r]||0)+1;var n="".concat(r,"-").concat(function(e){return De(Pe(e)>>>0)}(ge+r+Ht[r]));return t?"".concat(t,"-").concat(n):n}(t.displayName,t.parentComponentId):l,u=t.displayName,h=void 0===u?function(e){return Le(e)?"styled.".concat(e):"Styled(".concat(function(e){return e.displayName||e.name||"Component"}(e),")")}(e):u,f=t.displayName&&t.componentId?"".concat(ke(t.displayName),"-").concat(t.componentId):t.componentId||s,g=n&&a.attrs?a.attrs.concat(c).filter(Boolean):c,v=t.shouldForwardProp;if(n&&a.shouldForwardProp){var E=a.shouldForwardProp;if(t.shouldForwardProp){var x=t.shouldForwardProp;v=function(e,t){return E(e,t)&&x(e,t)}}else v=E}var w=new Ot(r,f,n?a.componentStyle:void 0);function b(e,t){return function(e,t,r){var n=e.attrs,a=e.componentStyle,i=e.defaultProps,o=e.foldedComponentIds,c=e.styledComponentId,l=e.target,s=m().useContext(jt),u=It(),h=e.shouldForwardProp||u.shouldForwardProp,f=function(e,t,r){return void 0===r&&(r=be),e.theme!==r.theme&&e.theme||t||r.theme}(t,s,i)||be,g=function(e,t,r){for(var n,a=p(p({},t),{className:void 0,theme:r}),i=0;i<e.length;i+=1){var o=Ue(n=e[i])?n(a):n;for(var c in o)a[c]="className"===c?Je(a[c],o[c]):"style"===c?p(p({},a[c]),o[c]):o[c]}return t.className&&(a.className=Je(a.className,t.className)),a}(n,t,f),v=g.as||l,E={};for(var x in g)void 0===g[x]||"$"===x[0]||"as"===x||"theme"===x&&g.theme===f||("forwardedAs"===x?E.as=g.forwardedAs:h&&!h(x,v)||(E[x]=g[x]));var w=function(e,t){var r=It();return e.generateAndInjectStyles(t,r.styleSheet,r.stylis)}(a,g),b=Je(o,c);return w&&(b+=" "+w),g.className&&(b+=" "+g.className),E[Le(v)&&!ye.has(v)?"class":"className"]=b,E.ref=r,(0,d.createElement)(v,E)}(y,e,t)}b.displayName=h;var y=m().forwardRef(b);return y.attrs=g,y.componentStyle=w,y.displayName=h,y.shouldForwardProp=v,y.foldedComponentIds=n?Je(a.foldedComponentIds,a.styledComponentId):"",y.styledComponentId=f,y.target=n?a.target:e,Object.defineProperty(y,"defaultProps",{get:function(){return this._foldedDefaultProps},set:function(e){this._foldedDefaultProps=n?function(e){for(var t=[],r=1;r<arguments.length;r++)t[r-1]=arguments[r];for(var n=0,a=t;n<a.length;n++)Xe(e,a[n],!0);return e}({},a.defaultProps,e):e}}),et(y,(function(){return".".concat(y.styledComponentId)})),i&&Ye(y,e,{attrs:!0,componentStyle:!0,displayName:!0,foldedComponentIds:!0,shouldForwardProp:!0,styledComponentId:!0,target:!0}),y}function Vt(e,t){for(var r=[e[0]],n=0,a=t.length;n<a;n+=1)r.push(t[n],e[n+1]);return r}new Set;var Zt=function(e){return Object.assign(e,{isCss:!0})};function Gt(e){for(var t=[],r=1;r<arguments.length;r++)t[r-1]=arguments[r];if(Ue(e)||Qe(e))return Zt(At(Vt(we,u([e],t,!0))));var n=e;return 0===t.length&&1===n.length&&"string"==typeof n[0]?At(n):Zt(At(Vt(n,t)))}function Wt(e,t,r){if(void 0===r&&(r=be),!t)throw tt(1,t);var n=function(n){for(var a=[],i=1;i<arguments.length;i++)a[i-1]=arguments[i];return e(t,r,Gt.apply(void 0,u([n],a,!1)))};return n.attrs=function(n){return Wt(e,t,p(p({},r),{attrs:Array.prototype.concat(r.attrs,n).filter(Boolean)}))},n.withConfig=function(n){return Wt(e,t,p(p({},r),n))},n}var Yt=function(e){return Wt(zt,e)},Ut=Yt;ye.forEach((function(e){Ut[e]=Yt(e)})),function(){function e(e,t){this.rules=e,this.componentId=t,this.isStatic=$t(e),wt.registerId(this.componentId+1)}e.prototype.createStyles=function(e,t,r,n){var a=n(Ke(At(this.rules,t,r,n)),""),i=this.componentId+e;r.insertRules(i,i,a)},e.prototype.removeStyles=function(e,t){t.clearRules(this.componentId+e)},e.prototype.renderStyles=function(e,t,r,n){e>2&&wt.registerId(this.componentId+e),this.removeStyles(e,r),this.createStyles(e,t,r,n)}}(),function(){function e(){var e=this;this._emitSheetCSS=function(){var t=e.instance.toString();if(!t)return"";var r=mt(),n=Ke([r&&'nonce="'.concat(r,'"'),"".concat(me,'="true"'),"".concat(fe,'="').concat(ge,'"')].filter(Boolean)," ");return"<style ".concat(n,">").concat(t,"</style>")},this.getStyleTags=function(){if(e.sealed)throw tt(2);return e._emitSheetCSS()},this.getStyleElement=function(){var t;if(e.sealed)throw tt(2);var r=e.instance.toString();if(!r)return[];var n=((t={})[me]="",t[fe]=ge,t.dangerouslySetInnerHTML={__html:r},t),a=mt();return a&&(n.nonce=a),[m().createElement("style",p({},n,{key:"sc-0-0"}))]},this.seal=function(){e.sealed=!0},this.instance=new wt({isServer:!0}),this.sealed=!1}e.prototype.collectStyles=function(e){if(this.sealed)throw tt(2);return m().createElement(Tt,{sheet:this.instance},e)},e.prototype.interleaveWithNodeStream=function(e){throw tt(3)}}(),"__sc-".concat(me,"__");const qt=Ut.div`
    display: flex;
    gap: 16px;
`,Jt=Ut.div`
    .icon-box-icon{
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 53px;
        height: 53px;
        border-radius: 50%;
        background-color: #F2FBF8;
        color: #2DB68D;
    }
`,Kt=Ut.div`
    display: flex;
    flex-direction: column;
    gap: 4px;
    .icon-box-title{
        font-size: 20px;
        line-height: 1.2;
        font-weight: 600;
        color: #212728;
    }
    .icon-box-description{
        font-size: 14px;
        line-height: 1.5;
        color: #505556;
    }
`;var Qt=e=>{let{icon:t,title:r,description:n}=e;return React.createElement(qt,null,t&&React.createElement(Jt,null,React.createElement("span",{className:"icon-box-icon"},t)),React.createElement(Kt,null,r&&React.createElement("span",{className:"icon-box-title"},r),n&&React.createElement("span",{className:"icon-box-description"},n)))};const Xt=Ut.div`
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
`,er=Ut.div``,tr=Ut.div`
    display: flex;
    gap: 12px;
    border: 1px solid #EDEEEE;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: all .3s ease;
    &:hover{
        border-color: #2DB68D;
    }
    ${e=>e.isActive&&"\n        border-color: #2DB68D;\n    "}
`,rr=Ut.div`
    border-radius: 8px;
    overflow: hidden;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    svg, img{
        width: 100%;
    }
`,nr=Ut.div`
    display: flex;
    flex-direction: column;
    gap: 4px;
    .import-option-title{
        font-size: 14px;
        line-height: 1.6;
        font-weight: 600;
        color: #212728;
    }
    .import-option-description{
        font-size: 14px;
        color: #505556;
    }
`;var ar=e=>{let{options:t,onChange:r,selected:n}=e;return React.createElement(Xt,null,t.map((e=>{const{id:t,image:a,title:i,description:o}=e;return React.createElement(er,null,React.createElement(tr,{onClick:()=>r(t),isActive:n&&n===t},React.createElement(rr,null,a),React.createElement(nr,null,React.createElement("span",{className:"import-option-title"},i),React.createElement("span",{className:"import-option-description"},o))))})))};const ir=Ut.button`
    display: inline-flex;
    align-items: center;
    gap: 4px;
    border: none;
    background-color: #2DB68D;
    padding: 12px;
    border-radius: 8px;
    font-size: 16px;
    line-height: 1.5
    font-weight: 500;
    color: #ffffff;
    cursor: pointer;
    transition: all .3s ease;
    &:hover{
        background-color: #238d6d;
    }
    ${e=>"ghost"==e.variant&&"\n        background: none;\n        color: #2DB68D;\n        &:hover{\n            background: #efefef;\n        }\n    "}
    &:disabled{
        filter: grayscale(1);
    }
`,or=Ut.span`
    display: inline-flex;
    align-items: center;
    font-size: 24px;
    svg{
        width: 1em;
        height: 1em;
    }
`;var cr=e=>{let{label:t,children:r,prevIcon:n,nextIcon:a,...i}=e;return React.createElement(ir,i,n&&React.createElement(or,null,n),r||t,a&&React.createElement(or,null,a))},lr=window.wp.components;const sr=Ut.div`
    padding: 16px;
    border-radius: 12px;
    border: 1px solid #cccccc;
    background-color: #efefef;
    font-size: 14px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-weight: 500;
    position: relative;
    transition: all .3s ease;

    ${e=>e.hasDismissButton&&"\n        padding-right: 36px;\n    "}

    ${e=>"warning"==e.status&&"\n        border-color: #FEC84B;\n        background-color: #FFFCF5;\n        color: #B54708;\n    "}
    ${e=>("error"==e.status||"danger"==e.status)&&"\n        border-color: #FF3C5F;\n        background-color: #FF3C5F14;\n        color: #FF3C5F;\n    "}

    .notification-icon{
        display: flex;
        svg{
            vertical-align: top;
            width: 20px;
            height: 20px;
        }
    }
`,pr=Ut.button`
    background: none;
    border: none;
    color: inherit;
    position: absolute;
    top: 16px;
    right: 16px;
    cursor: pointer;
    padding: 0;
    svg{
        width: 20px;
        height: 20px;
        vertical-align: top;
    }
`;var ur=t=>{let{status:r,message:n,onDismiss:a}=t;const i=(0,e.useRef)(null);return React.createElement(sr,{ref:i,status:r,hasDismissButton:a||!1},React.createElement("span",{className:"notification-icon"},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M9.99979 7.50019V10.8335M9.99979 14.1669H10.0081M8.84589 3.24329L1.99182 15.0821C1.61165 15.7388 1.42156 16.0671 1.44966 16.3366C1.47416 16.5716 1.5973 16.7852 1.78844 16.9242C2.00757 17.0835 2.38695 17.0835 3.14572 17.0835H16.8539C17.6126 17.0835 17.992 17.0835 18.2111 16.9242C18.4023 16.7852 18.5254 16.5716 18.5499 16.3366C18.578 16.0671 18.3879 15.7388 18.0078 15.0821L11.1537 3.24329C10.7749 2.58899 10.5855 2.26184 10.3384 2.15196C10.1228 2.05612 9.87676 2.05612 9.66121 2.15196C9.4141 2.26184 9.2247 2.58899 8.84589 3.24329Z",stroke:"currentColor","stroke-width":"1.66667","stroke-linecap":"round","stroke-linejoin":"round"}))),React.createElement("span",{className:"notification-msg"},n||React.createElement(lr.Spinner,{style:{color:"var(--primary-color)"}})),a&&React.createElement(pr,{type:"button",onClick:()=>{i.current.style.opacity="0",setTimeout((()=>{a(!1)}),300)}},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M15 5L5 15M5 5L15 15",stroke:"currentColor","stroke-width":"1.66667","stroke-linecap":"round","stroke-linejoin":"round"}))))};const dr=Ut.div`
    max-width: 1000px;
    width: 100%;
    margin: 0 auto;
    padding: 0 15px;
`;var mr=e=>{let{children:t}=e;return React.createElement(dr,null,t)};const hr=Ut.ul`
    display: flex;
    justify-content: space-between;
    position: relative;
    list-style: none;
    padding: 0;
    margin: 0 0 32px;
    z-index: 1;
`,fr=Ut.li`
    flex: 1;
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 14px;
    font-size: 14px;
    line-height: 1.7;
    font-weight: 600;
    position: relative;
    &:not(:first-of-type){
        &::before, &::after{
            content: "";
            width: 100%;
            height: 3px;
            background-color: #EDEEEE;
            position: absolute;
            top: 14.5px;
            left: -50%;
            z-index: -1;
            transition: all .3s ease;
        }
        &::after{
            width: 0;
            background-color: #2DB68D;
            ${e=>e.current&&"\n                width: 100%;\n            "}
        }
    }
`,gr=Ut.span`
    display: inline-block;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #ffffff;
    position: relative;
    color: #EDEEEE;
    &::before{
        content: "";
        width: 22.4px;
        height: 22.4px;
        background-color: currentColor;
        mask: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M12 21.5998C17.302 21.5998 21.6 17.3017 21.6 11.9998C21.6 6.69787 17.302 2.3998 12 2.3998C6.69812 2.3998 2.40005 6.69787 2.40005 11.9998C2.40005 17.3017 6.69812 21.5998 12 21.5998ZM12 23.1998C18.1856 23.1998 23.2 18.1854 23.2 11.9998C23.2 5.81422 18.1856 0.799805 12 0.799805C5.81446 0.799805 0.800049 5.81422 0.800049 11.9998C0.800049 18.1854 5.81446 23.1998 12 23.1998Z' fill='%232DB68D'/%3E%3Cpath d='M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z' fill='%232DB68D'/%3E%3C/svg%3E");
        -webkit-mask: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M12 21.5998C17.302 21.5998 21.6 17.3017 21.6 11.9998C21.6 6.69787 17.302 2.3998 12 2.3998C6.69812 2.3998 2.40005 6.69787 2.40005 11.9998C2.40005 17.3017 6.69812 21.5998 12 21.5998ZM12 23.1998C18.1856 23.1998 23.2 18.1854 23.2 11.9998C23.2 5.81422 18.1856 0.799805 12 0.799805C5.81446 0.799805 0.800049 5.81422 0.800049 11.9998C0.800049 18.1854 5.81446 23.1998 12 23.1998Z' fill='%232DB68D'/%3E%3Cpath d='M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z' fill='%232DB68D'/%3E%3C/svg%3E");
        mask-repeat: no-repeat;
        -webkit-mask-repeat: no-repeat;
        mask-size: 100%;
        -webkit-mask-size: 100%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        ${e=>e.completed&&"\n            mask: url(\"data:image/svg+xml,%3Csvg width='17' height='15' viewBox='0 0 17 15' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M14.7951 0.85322L5.24843 10.0666L2.71509 7.35989C2.24843 6.91989 1.51509 6.89322 0.981761 7.26655C0.461761 7.65322 0.315094 8.33322 0.635094 8.87989L3.63509 13.7599C3.92843 14.2132 4.43509 14.4932 5.00843 14.4932C5.55509 14.4932 6.07509 14.2132 6.36843 13.7599C6.84843 13.1332 16.0084 2.21322 16.0084 2.21322C17.2084 0.986553 15.7551 -0.0934461 14.7951 0.839887V0.85322Z' fill='white'/%3E%3C/svg%3E%0A\");\n            -webkit-mask: url(\"data:image/svg+xml,%3Csvg width='17' height='15' viewBox='0 0 17 15' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M14.7951 0.85322L5.24843 10.0666L2.71509 7.35989C2.24843 6.91989 1.51509 6.89322 0.981761 7.26655C0.461761 7.65322 0.315094 8.33322 0.635094 8.87989L3.63509 13.7599C3.92843 14.2132 4.43509 14.4932 5.00843 14.4932C5.55509 14.4932 6.07509 14.2132 6.36843 13.7599C6.84843 13.1332 16.0084 2.21322 16.0084 2.21322C17.2084 0.986553 15.7551 -0.0934461 14.7951 0.839887V0.85322Z' fill='white'/%3E%3C/svg%3E%0A\");\n            mask-repeat: no-repeat;\n            -webkit-mask-repeat: no-repeat;\n            mask-size: 16px 16px;\n            -webkit-mask-size: 16px 16px;\n            mask-position: center;\n            -webkit-mask-position: center;\n        "}
    }
    ${e=>e.current&&"\n        background-color: #2DB68D2E;\n        color: #2DB68D;\n    "}
    ${e=>e.completed&&"\n        background-color: #2DB68D;\n        color: #ffffff;\n    "}
`,vr=Ut.div`
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 32px 0;
`,Er=Ut.div`
    display: flex;
    flex-direction: column;
    gap: 32px;
    .import-recipe-image{
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
    }
`;var xr=r=>{let{steps:n=[]}=r;const{globalState:a,setGlobalState:o,globalState:{recipesToImport:c,pns:l}}=i(),[s,p]=(0,e.useState)({current:0,completed:[]}),u=(0,e.useRef)(null),d=()=>{u.current.style.cssText="opacity: 0; transform: translateY(20px)",setTimeout((()=>{u.current.style.cssText="opacity: 1; transform: translateY(0px);transition: all .3s ease;"}),30)},h=()=>n[s.current].component;return m().createElement("div",null,m().createElement(mr,null,m().createElement(hr,null,n.map(((e,t)=>{let{id:r,label:n}=e;const a=s?.current===t,i=s?.completed.includes(t);return m().createElement(fr,{current:a||i},m().createElement(gr,{current:a,completed:i}),n)}))),m().createElement(Er,{ref:u},m().createElement(h,null))),s.current<n.length-1&&m().createElement(mr,null,m().createElement(vr,null,m().createElement(cr,{variant:"ghost",prevIcon:m().createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},m().createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"})),onClick:()=>{0!==s.current&&(p({...s,current:s.current-1,completed:s.completed.filter((e=>e!==s.current-1))}),d())}},(0,t.__)("Back","delicious-recipes")),m().createElement(cr,{onClick:()=>{s.current!==n.length-1&&(p({...s,current:s.current+1,completed:[...s.completed,s.current]}),d(),o({...a,pns:s.current+1!==n.length-1}))},disabled:!c.length>0,label:(0,t.__)("Proceed to Next Step","delicious-recipes")}))))};const wr=Ut.div`
    border: 1px solid #EDEEEE;
    border-radius: 12px;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    background-color: #ffffff;
    overflow: hidden;
    select{
        padding: 8px 12px;
        font-size: 16px;
        line-height: 1.5;
        border: 1px solid #EDEEEE;
        box-shadow: 0px 1px 2px 0px #1018280D;
        border-radius: 4px;
        min-height: 40px;
        min-width: 132px;
        max-width: 100%;
        width: 100%;
    }
`,br=Ut.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
`,yr=Ut.table`
    font-size: 14px;
    line-height: 1.5;
    border-collapse: collapse;
    width: 100%;
    th, td{
        text-align: left;
        font-weight: normal;
        &:first-of-type{
            padding-left: 24px;
        }
        &:last-of-type{
            padding-right: 24px;
        }
    }
    th{
        padding: 12px;
    }
    td{
        padding: 14px 12px;
    }
    ${e=>e.striped&&"\n        tbody{\n            tr{\n                &:nth-of-type(odd){\n                    background-color: #F9F9F9;\n                }\n            }\n        }\n    "}
    ${e=>e.bordered&&"\n        thead{\n            tr{\n                &:last-of-type{\n                    border-bottom: 1px solid #EDEEEE;\n                }\n            }\n        }\n        tbody{\n            tr{\n                &:not(:last-of-type){\n                    border-bottom: 1px solid #EDEEEE;\n                }\n            }\n        }\n        tfoot{\n            tr{\n                &:first-of-type{\n                    border-top: 1px solid #EDEEEE;\n                }\n            }\n        }\n    "}
`,Rr=Ut.header`
    margin: 0;
    padding: 20px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-size: 14px;
    border-bottom: 1px solid #EDEEEE;
`,Cr=Ut.footer`
    margin: 0;
    padding: 16px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-size: 14px;
    border-top: 1px solid #EDEEEE;
`,kr=Ut.div`
    label{
        margin: 0;
        display: flex;
        align-items: center;
        font-size: inherit;
        gap: 16px;
    }
`,_r=Ut.div`
    input[type="search"]{
        padding: 8px 16px 8px 44px;
        font-size: 16px;
        line-height: 1.5;
        border: 1px solid #EDEEEE;
        box-shadow: 0px 1px 2px 0px #1018280D;
        border-radius: 4px;
        background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M17.5 17.5L14.5834 14.5833M16.6667 9.58333C16.6667 13.4954 13.4954 16.6667 9.58333 16.6667C5.67132 16.6667 2.5 13.4954 2.5 9.58333C2.5 5.67132 5.67132 2.5 9.58333 2.5C13.4954 2.5 16.6667 5.67132 16.6667 9.58333Z' stroke='%23505556' stroke-width='1.66667' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E%0A");
        background-repeat: no-repeat;
        background-size: 20px;
        background-position: left 16px center;
    }
`,Sr=Ut.div`
    font-weight: 500;
`,Dr=Ut.div`
    ul{
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        a{
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            line-height: 1.4;
            font-weight: 500;
            width: 40px;
            height: 40px;
            border: 1px solid #EDEEEE;
            color: inherit;
            text-decoration: none;
            transition: all .3s ease;
            &:hover, &.current{
                background-color: #F2FBF8;
            }
            &.current{
                color: #2DB68D;
            }
            &.disabled, &.current{
                pointer-events: none;
            }
            &.disabled{
                color: rgba(0,0,0, 0.2);
            }
        }
        svg{
            width: 20px;
            height: 20px;
        }
        li{
            &:not(:first-of-type){
                a{
                    border-left: none;
                }
            }
            &:first-of-type{
                a{
                    border-top-left-radius: 8px;
                    border-bottom-left-radius: 8px;
                }
            }
            &:last-of-type{
                a{
                    border-top-right-radius: 8px;
                    border-bottom-right-radius: 8px;
                }
            }
        }
    }
`,Ir=e=>{let{children:t,...r}=e;return React.createElement(yr,r,t)};Ir.Header=e=>{let{children:t}=e;return React.createElement(Rr,null,t)},Ir.Footer=e=>{let{children:t}=e;return React.createElement(Cr,null,t)},Ir.Length=e=>{let{value:r,onChange:n}=e;const a=[{value:10,label:(0,t.__)("10","delicious-recipes")},{value:25,label:(0,t.__)("25","delicious-recipes")},{value:50,label:(0,t.__)("50","delicious-recipes")},{value:100,label:(0,t.__)("100","delicious-recipes")},{value:"show-all",label:(0,t.__)("Show All","delicious-recipes")}];return React.createElement(kr,null,React.createElement("label",null,(0,t.__)("Show","delicious-recipes"),React.createElement("select",{onChange:e=>n(e.target.value),value:r,name:"table-length",id:"table-length"},a.map((e=>{let{value:t,label:r}=e;return React.createElement("option",{key:`table_length_${t}`,value:t},r)}))),(0,t.__)("Entries","delicious-recipes")))},Ir.Filter=e=>{let{value:t,onChange:r}=e;return React.createElement(_r,null,React.createElement("label",{htmlFor:"table-filter"},React.createElement("input",{type:"search",name:"import-filter",onChange:e=>r(e),value:t,id:"table-filter",placeholder:"Search"})))},Ir.Info=e=>{let{length:r,total:n,currentPage:a}=e;if(r=0===n?"show-all":r,"show-all"===r)return React.createElement(Sr,null,(0,t.__)("Showing","delicious-recipes")," ",n," ",(0,t.__)("entries","delicious-recipes"));const i=(a-1)*r+1,o=Math.min(a*r,n);return React.createElement(Sr,null,(0,t.__)("Showing","delicious-recipes")," ",i," ",(0,t.__)("-","delicious-recipes")," ",o," ",(0,t.__)("of","delicious-recipes")," ",n," ",(0,t.__)("entries","delicious-recipes"))},Ir.Title=e=>{let{children:t}=e;return React.createElement(br,null,t)},Ir.Paginate=e=>{let{length:t,total:r,currentPage:n,setCurrentPage:a}=e;if(0===r)return;if("show-all"===t)return;const i=Math.ceil(r/t),o=Array.from({length:i},((e,t)=>t+1)),c=Math.ceil(i/2);let l=!1,s=!1;return React.createElement(Dr,null,React.createElement("ul",null,React.createElement("li",null,React.createElement("a",{href:"#",className:1===n?"disabled":"",onClick:()=>1!==n&&a(n-1)},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",null,React.createElement("path",{d:"M15.8334 9.99984H4.16675M4.16675 9.99984L10.0001 15.8332M4.16675 9.99984L10.0001 4.1665",stroke:"currentColor","stroke-width":"1.67","stroke-linecap":"round","stroke-linejoin":"round"}))))),i>5?o.map(((e,t)=>{if(n<c){if((1===n?n+1:n)===e||(2===n?n+1:1)===e||i-1===e||i===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===n?"current":"",onClick:()=>a(e)},e));if(!l&&e>n+1&&e<i-1)return l=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}else if(n>c){if((n===i?n-1:n)===e||(n===i-1?n-1:i)===e||1===e||2===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===n?"current":"",onClick:()=>a(e)},e));if(!s&&(3===e||e<n-1))return s=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}else if(n===c){if(n===e||n-1===e||n+1===e||1===e||i===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===n?"current":"",onClick:()=>a(e)},e));if(!l&&e<n-1)return l=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."));if(!s&&e>n+1&&e<i)return s=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}})):o.map(((e,t)=>React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===n?"current":"",onClick:()=>a(e)},e)))),React.createElement("li",null,React.createElement("a",{href:"#",className:n===i?"disabled":"",onClick:()=>n!==i&&a(n+1)},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M4.16675 9.99984H15.8334M15.8334 9.99984L10.0001 4.1665M15.8334 9.99984L10.0001 15.8332",stroke:"currentColor","stroke-width":"1.67","stroke-linecap":"round","stroke-linejoin":"round"}))))))},Ir.Container=e=>{let{children:t,...r}=e;return React.createElement(wr,r,t)},Ir.THead=e=>{let{children:t,rest:r}=e;return React.createElement("thead",r,t)},Ir.TBody=e=>{let{children:t,...r}=e;return React.createElement("tbody",r,t)},Ir.TFoot=e=>{let{children:t,...r}=e;return React.createElement("tfoot",r,t)},Ir.Tr=e=>{let{items:t,children:r,...n}=e;return t?t.map((e=>React.createElement("tr",n,e))):React.createElement("tr",n,r)},Ir.Th=e=>{let{items:t,children:r,...n}=e;return t?t.map((e=>React.createElement("th",n,e))):React.createElement("th",n,r)},Ir.Td=e=>{let{items:t,children:r,...n}=e;return t?t.map((e=>React.createElement("td",n,e))):React.createElement("td",n,r)};var Tr=Ir;function Pr(){return Pr=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)({}).hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},Pr.apply(null,arguments)}const Lr=Ut.div`
    display: inline-flex;
    vertical-align: middle;
    margin: 0 8px 0 0;
    input[type="checkbox"]{
        width: 20px;
        height: 20px;
        border: 1px solid #505556;
        border-radius: 6px;
        margin: 0;
        vertical-align: top;
        &:checked{
            background-color: #F2FBF8;
            border-color: #2DB68D;
            &::before{
                width: 18px;
                height: 18px;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                ${e=>e.bulk?"\n                    content: url(\"data:image/svg+xml,%3Csvg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M2.91663 7H11.0833' stroke='%232DB68D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E%0A\");\n                ":"\n                    content: url(\"data:image/svg+xml,%3Csvg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11.6667 3.5L5.25004 9.91667L2.33337 7' stroke='%232DB68D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E%0A\");\n                "}
            }
        }
    }
`,Fr=e=>React.createElement(Lr,{bulk:e?.bulk},React.createElement("input",Pr({type:"checkbox"},e)));Fr.Bulk=e=>React.createElement(Fr,Pr({bulk:!0},e));var Mr=Fr,Br=()=>{const{globalState:r,setGlobalState:n,globalState:{recipes:a,selectedOption:o,recipeCount:c,recipesToList:l,list:s,currentPage:p,recipesToImport:u,deleteRecipes:d}}=i(),[m,h]=(0,e.useState)({selectedRecipes:u,localInput:"",debouncedInput:"",filteredRecipes:l,filteredRecipeList:s,filteredRecipeCount:c}),{selectedRecipes:f,localInput:g,debouncedInput:v,filteredRecipes:E,filteredRecipeList:x,filteredRecipeCount:w}=m;let b="";return b="cooked"===o&&"Cooked",(0,e.useEffect)((()=>{const e=setTimeout((()=>{h({...m,debouncedInput:g})}),500);return()=>{clearTimeout(e)}}),[g]),(0,e.useEffect)((()=>{let e=l,t=s,r=c;v&&(e=a.filter((e=>e.post_title.toLowerCase().includes(v.toLowerCase()))),t=e.length>0||g.length>0?"show-all":s,r=e.length>0?e.length:g.length>0?0:r),h({...m,filteredRecipes:e,filteredRecipeList:t,filteredRecipeCount:r})}),[v]),React.createElement(React.Fragment,null,React.createElement(Tr.Container,null,React.createElement(Tr.Header,null,React.createElement(Tr.Length,{value:x,onChange:e=>{h({...m,filteredRecipeList:e,filteredRecipes:"show-all"===e?a:a.slice(0,e)}),n({...r,currentPage:1,list:e,recipesToList:"show-all"===e?a:a.slice(0,e),recipesToImport:[]})}}),React.createElement(Tr.Filter,{value:g,onChange:e=>{h({...m,localInput:e.target.value})}})),React.createElement(Tr,{striped:!0,bordered:!0},React.createElement(Tr.THead,null,React.createElement(Tr.Tr,null,React.createElement(Tr.Th,null,React.createElement(Mr.Bulk,{checked:u.length===E.length,onChange:e=>{n({...r,recipesToImport:e.target.checked?E.map((e=>({id:e.ID,post_title:e.post_title,thumbnail_url:e.thumbnail_url,author:e.author,post_date:e.post_date,post_status:e.post_status}))):[]})}})),React.createElement(Tr.Th,{style:{width:"135px"}},(0,t.__)("Featured Image")),React.createElement(Tr.Th,null,(0,t.__)("Recipe Title")),React.createElement(Tr.Th,null,(0,t.__)("Author")),React.createElement(Tr.Th,null,(0,t.__)("Date Published")))),React.createElement(Tr.TBody,null,""!==g&&0===E.length&&React.createElement(Tr.Tr,null,React.createElement(Tr.Td,{colSpan:"5"},React.createElement(ur,{status:"error",message:(0,t.__)("No recipes found.","delicious-recipes")}))),f?.map(((e,t)=>{const i=a.find((t=>t.ID===e.id));return React.createElement(Tr.Tr,{key:t},React.createElement(Tr.Td,null,React.createElement(Mr,{checked:f.some((e=>e.id===i.ID)),onChange:e=>{n({...r,recipesToImport:e.target.checked?[...f,{id:i.ID,post_title:i.post_title,thumbnail_url:i.thumbnail_url,author:i.author,post_date:i.post_date,post_status:i.post_status}]:f.filter((e=>e.id!==i.ID))})}})),React.createElement(Tr.Td,null,i.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:i.thumbnail_url,alt:i.post_title})),React.createElement(Tr.Td,null,React.createElement("strong",null,i.post_title),"publish"!==i.post_status&&React.createElement("span",{className:" wpd-ml-1 dr-badge"},i.post_status)),React.createElement(Tr.Td,null,i.author),React.createElement(Tr.Td,null,i.post_date))})),f.length>0&&React.createElement(Tr.Tr,null,React.createElement(Tr.Td,{colSpan:"5"},React.createElement(ur,{message:(0,t.__)("Selected recipes listed above.","delicious-recipes")}))),E?.filter((e=>!f.some((t=>t.id===e.ID)))).map(((e,t)=>React.createElement(Tr.Tr,{key:t},React.createElement(Tr.Td,null,React.createElement(Mr,{checked:u.some((t=>t.id===e.ID)),onChange:t=>{n({...r,recipesToImport:t.target.checked?[...u,{id:e.ID,post_title:e.post_title,thumbnail_url:e.thumbnail_url,author:e.author,post_date:e.post_date,post_status:e.post_status}]:u.filter((t=>t.id!==e.ID))})}})),React.createElement(Tr.Td,null,e.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:e.thumbnail_url,alt:e.post_title})),React.createElement(Tr.Td,null,React.createElement("strong",null,e.post_title),"publish"!==e.post_status&&React.createElement("span",{className:" wpd-ml-1 dr-badge"},e.post_status)),React.createElement(Tr.Td,null,e.author),React.createElement(Tr.Td,null,e.post_date)))))),React.createElement(Tr.Footer,null,React.createElement(Tr.Info,{length:x,total:w,currentPage:p}),React.createElement(Tr.Paginate,{length:x,total:w,currentPage:p,setCurrentPage:e=>{n({...r,currentPage:e,recipesToImport:[],recipesToList:a.slice((e-1)*x,e*x)})}}))),React.createElement("label",null,React.createElement(Mr,{checked:d,onChange:e=>{n({...r,deleteRecipes:!!e.target.checked})}}),"Delete the recipes from ",React.createElement("strong",null,b)," after a successful import."))},Ar=()=>{const{globalState:e,setGlobalState:r,wpd_fields:n,globalState:{recipeFields:a,importPluginFields:o}}=i();return React.createElement(Tr.Container,null,React.createElement(Tr.Header,null,React.createElement(Tr.Title,null,(0,t.__)("Map Recipes Fields","delicious-recipes"))),React.createElement(Tr,{striped:!0,bordered:!0},React.createElement(Tr.THead,null,React.createElement(Tr.Tr,null,React.createElement(Tr.Th,null,(0,t.__)("Plugin Fields","delicious-recipes")),React.createElement(Tr.Th,null,(0,t.__)("Map With","delicious-recipes")))),React.createElement(Tr.TBody,null,Object.keys(n)?.map(((i,c)=>React.createElement(Tr.Tr,{key:c},React.createElement(Tr.Td,null,React.createElement("strong",null,n[i])),React.createElement(Tr.Td,null,React.createElement("select",{value:a[i]?a[i]:"",onChange:t=>{let o={...a};"recipe_keywords"===n[i]?o[i]={type:"keywords",value:""===t.target.value?"":t.target.value}:o[i]=""===t.target.value?"":t.target.value,r({...e,recipeFields:o})}},React.createElement("option",{value:""},(0,t.__)("Select Field","delicious-recipes")),o?.map(((e,t)=>React.createElement("option",{key:t,value:e},e)))))))))))};const $r=Ut.div`
    padding: 24px;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 24px;
    ${e=>e.starter&&"\n        padding: 32px;\n    "}
`,Nr=Ut.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
`,Or=Ut.div`
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: flex-start;
    ul{
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
        font-size: 14px;
        li{
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin: 0;
        }
        .label{
            font-weight: 600;
            min-width: 200px;
            flex-grow: 1;
        }
    }
`;var jr=()=>{const{globalState:{recipes:r,recipeFields:n,recipesToImport:a},wpd_fields:o}=i(),[c,l]=(0,e.useState)(!1);return React.createElement($r,null,React.createElement(Nr,null,(0,t.__)("Recipes to Import")),React.createElement(Tr.Container,null,React.createElement(Tr,{bordered:!0,striped:!0},React.createElement(Tr.THead,null,React.createElement(Tr.Tr,null,React.createElement(Tr.Th,null,"Featured Image"),React.createElement(Tr.Th,null,"Recipe Title"))),React.createElement(Tr.TBody,null,a?.slice(0,c?a.length:3).map(((e,t)=>{const n=r.find((t=>t.ID===e.id));return React.createElement(Tr.Tr,{key:t},React.createElement(Tr.Td,null,n.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:n.thumbnail_url,alt:n.post_title})),React.createElement(Tr.Td,null,React.createElement("strong",null,n.post_title)))}))),a?.length>3&&!c&&React.createElement(Tr.TFoot,null,React.createElement(Tr.Tr,null,React.createElement(Tr.Td,{colSpan:"2",style:{textAlign:"center"}},React.createElement(cr,{label:"View All",variant:"ghost",onClick:()=>{l(!0)},nextIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 9L12 15L18 9",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))})))),c&&React.createElement(Tr.TFoot,null,React.createElement(Tr.Tr,null,React.createElement(Tr.Td,{colSpan:"2",style:{textAlign:"center"}},React.createElement(cr,{label:"View Less",variant:"ghost",onClick:()=>l(!1),nextIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 15L12 9L18 15",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))})))))),React.createElement(Or,null,React.createElement(Nr,null,(0,t.__)("Fields Mapped:","delicious-recipes")),Object.keys(n)?.map(((e,t)=>n[e]?React.createElement("ul",{key:t},React.createElement("li",null,React.createElement("span",{className:"label"},o[e],":"),React.createElement("span",{className:"value"},n[e]))):null))))};const Hr=Ut.div`
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #344054;
`,zr=Ut.div`
    width: 100%;
    height: 8px;
    border-radius: 10px;
    background-color: #F2FBF8;
    position: relative;
    .progressbar-progress{
        position: absolute;
        height: 100%;
        width: 0%;
        top: 0;
        left: 0;
        background-color: #2DB68D;
        border-radius: 10px;
        transition: all .3s ease;
    }
`;var Vr=e=>{let{progress:t=0}=e;return t=Math.floor(t),React.createElement(Hr,null,React.createElement(zr,null,React.createElement("span",{className:"progressbar-progress",style:{width:`${t}%`}})),t,"%")};const Zr=Ut.div`
    display: flex;
    flex-direction: column;
    gap: 16px;
    overflow: auto;
    max-height: 184px;
    &::-webkit-scrollbar{
        width: 6px;
    }
    &::-webkit-scrollbar-track{
        background-color: #F2FBF8;
    }
    &::-webkit-scrollbar-thumb{
        background-color: #2DB68D;
    }
`,Gr=Ut.div`
    font-size: 14px;
    line-height: 1.5;
    padding-left: 32px;
    position: relative;
    @keyframes spin{
        0%{
            transform: rotate(0deg);
        }
        100%{
            transform: rotate(360deg);
        }
    }
    &::before{
        content: "";
        width: 20px;
        height: 20px;
        border-radius: 50%;
        position: absolute;
        top: 0;
        left: 2px;
    }
    ${e=>"pending"==e.status&&"\n        opacity: .5;\n        &::before{\n            border: 2px solid rgba(80, 85, 86, 0.3);\n            border-top-color: #505556;\n            animation: spin 1s infinite linear;\n        }\n    "}
    ${e=>"success"==e.status&&"\n        opacity: 1;\n        &::before{\n            background-image: url(\"data:image/svg+xml,%3Csvg width='20' height='21' viewBox='0 0 20 21' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 20.1875C4.477 20.1875 0 15.7105 0 10.1875C0 4.6645 4.477 0.1875 10 0.1875C15.523 0.1875 20 4.6645 20 10.1875C20 15.7105 15.523 20.1875 10 20.1875ZM9.003 14.1875L16.073 7.1165L14.659 5.7025L9.003 11.3595L6.174 8.5305L4.76 9.9445L9.003 14.1875Z' fill='%232DB68D'/%3E%3C/svg%3E%0A\");\n            background-repeat: no-repeat;\n            background-size: 100%;\n        }\n    "}
`;var Wr=e=>{let{items:t=[]}=e;return React.createElement(Zr,null,t.map((e=>React.createElement(Gr,{status:e.status},e.name))))};const Yr=Ut.div`
    padding: 32px 24px;
    background-color: #ffffff;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    text-align: center;
    max-width: 576px;
    margin: 0 auto;
`,Ur=Ut.div`
    margin: 0 0 16px;
    svg{
        width: 69px;
        height: 69px;
        vertical-align: top;
    }
`,qr=Ut.div`
    margin: 0 0 24px;
    h5{
        font-size: 24px;
        font-weight: 600;
        line-height: 1.2;
        margin: 0 0 8px;
    }
    p{
        margin: 0;
        font-size: 16px;
        line-height: 1.6;
        color: #505556;
    }
`;var Jr=e=>{let{icon:t,title:r,text:n,children:a}=e;return React.createElement(Yr,null,React.createElement(Ur,null,t),React.createElement(qr,null,React.createElement("h5",null,r),React.createElement("p",null,n)),a)},Kr=()=>{const{globalState:{selectedOption:r,recipesToImport:n,recipeFields:a,deleteRecipes:o}}=i(),[l,p]=(0,e.useState)({progress:0,finalImportRecipes:n.map((e=>({name:e.post_title,status:"pending"}))),importProcessDone:!1,importProcessMessage:""}),u=[],d=[],{progress:m,importProcessDone:h,importProcessMessage:f,finalImportRecipes:g}=l;return Object.keys(a).map(((e,t)=>{a[e]&&u.push({to:e,from:a[e]})})),(0,e.useEffect)((()=>{s()({path:"/deliciousrecipe/v1/import_recipe_fields",method:"POST",data:{recipe_fields:JSON.stringify(u)}}).then((t=>{t.status?(d.push(t.data),p({...l,progress:10}),e()):p({...l,importProcessDone:!0,importProcessMessage:"failure"})}));const e=function(){var e=c((function*(){let e=!0;for(let t=0;t<n.length;t++){const a=yield s()({path:`/deliciousrecipe/v1/import_recipes?selectedOption=${r}`,method:"POST",data:{recipe_id:JSON.stringify(n[t].id),imported_fields:JSON.stringify(d)}});if(!a.status){p({...l,importProcessDone:!0,importProcessMessage:"failure"}),e=!1;break}console.log(a.status),p({...l,progress:(t+1)/n.length*100,finalImportRecipes:g.map(((e,r)=>r<=t?{...e,status:"success"}:e))})}e&&(o?s()({path:`/deliciousrecipe/v1/delete_recipes?selectedOption=${r}`,method:"POST",data:{recipe_ids:JSON.stringify(n.map((e=>e.id)))}}).then((e=>{e.status?p({...l,importProcessDone:!0,importProcessMessage:"success"}):p({...l,importProcessDone:!0,importProcessMessage:"failure"})})):p({...l,importProcessDone:!0,importProcessMessage:"success"}))}));return function(){return e.apply(this,arguments)}}()}),[]),React.createElement(mr,null,!h&&React.createElement(Xr,null,React.createElement(Qt,{icon:React.createElement("svg",{width:"25",height:"25",viewBox:"0 0 25 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M24.6519 2.82855L21.8928 0.301686C21.6981 0.124223 21.3786 0 21.1158 0H5.91263C5.50735 0 5.17996 0.328305 5.17996 0.734497V4.31332H1.27206C0.57095 4.31332 0 4.88514 0 5.58858V8.61777C0 9.32121 0.57095 9.89303 1.27206 9.89303H5.17996V24.265C5.17996 24.6712 5.50735 25 5.91263 25H24.2673C24.6726 25 25 24.6712 25 24.265V3.62072C25 3.34171 24.8575 3.01686 24.6519 2.82855ZM1.27206 8.95692C1.0852 8.95692 0.932847 8.80459 0.932847 8.61777V5.58858C0.932847 5.40126 1.0852 5.24894 1.27206 5.24894H5.17996H6.11232H8.08648C8.48979 5.24894 8.81915 4.91916 8.81915 4.51444V3.16179C8.86451 3.17362 8.9153 3.19925 8.96164 3.24608L9.91322 4.20043L10.8466 5.13556L12.5703 6.86385C12.6339 6.92793 12.6703 7.01321 12.6703 7.10293C12.6703 7.19363 12.6339 7.27891 12.5703 7.343L11.7981 8.11644L11.3322 8.58424L10.8663 9.05206L8.96263 10.9603C8.91727 11.0071 8.86747 11.0308 8.82014 11.0416V9.69191C8.82014 9.28719 8.49078 8.95692 8.08747 8.95692H6.1133H5.18095H1.27206ZM24.0667 24.0644H6.11182V9.89254H7.88581V11.1565C7.88581 11.504 8.12543 11.9038 8.52727 11.9698C8.59679 11.9822 8.6668 11.9876 8.73829 11.9876C9.07258 11.9876 9.38566 11.8579 9.62134 11.6213L12.1827 9.05156H21.2538V8.11594H13.1156L13.2275 8.00404C13.4691 7.76348 13.6022 7.44257 13.6022 7.10194C13.6022 6.76131 13.4691 6.44139 13.2295 6.20083L12.165 5.13507H21.2538V4.19994H11.2331L9.62282 2.58602C9.33685 2.29715 8.92664 2.16751 8.52677 2.23455C8.12543 2.30109 7.88532 2.70088 7.88532 3.04791V4.31332H6.11133V0.935128H21.1128C21.1523 0.936114 21.2361 0.969634 21.2642 0.99231L24.0183 3.51474C24.0376 3.53692 24.0637 3.59657 24.0667 3.62072V24.0644Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 12.0317H8.92583V12.9674H21.253V12.0317Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 15.9478H8.92583V16.8829H21.253V15.9478Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 19.8633H8.92583V20.7989H21.253V19.8633Z",fill:"currentColor"})),title:(0,t.__)("Importing Recipes"),description:(0,t.__)("Please do not close this tab during the import process.")}),React.createElement(Vr,{progress:m}),React.createElement(Wr,{items:g})),h&&"success"===f&&React.createElement(Jr,{icon:React.createElement("svg",{width:"70",height:"69",viewBox:"0 0 70 69",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",fill:"#F2FBF8"}),React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",stroke:"#2DB68D","stroke-width":"1.38"}),React.createElement("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M47.1637 21.748L28.8214 39.4498L23.954 34.2494C23.0574 33.404 21.6484 33.3528 20.6237 34.0701C19.6246 34.813 19.3428 36.1195 19.9576 37.1698L25.7216 46.5459C26.2852 47.4169 27.2587 47.9549 28.3602 47.9549C29.4106 47.9549 30.4097 47.4169 30.9732 46.5459C31.8955 45.3419 49.4949 24.361 49.4949 24.361C51.8005 22.0041 49.0081 19.9291 47.1637 21.7223V21.748Z",fill:"#2DB68D"})),title:(0,t.__)("Your Recipes are imported successfully!"),text:(0,t.__)("All the imported recipes are saved as drafts. You can make the necessary changes and publish them.")},React.createElement(tn,{style:{flexDirection:"column"}},React.createElement(cr,{label:(0,t.__)("View all Recipes"),onClick:()=>{window.open("/wp-admin/edit.php?post_type=recipe","_blank")}}),React.createElement(cr,{variant:"ghost",label:(0,t.__)("Back to Dashboard"),prevIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"})),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}))),h&&"failure"===f&&React.createElement(Jr,{icon:React.createElement("svg",{width:"70",height:"69",viewBox:"0 0 70 69",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",fill:"#FFE9E9"}),React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",stroke:"#FF4949","stroke-width":"1.38"}),React.createElement("path",{d:"M37.0557 34.4683L48.6513 22.8727C48.8805 22.6051 49.0002 22.2609 48.9866 21.9089C48.973 21.5568 48.8271 21.2229 48.578 20.9738C48.3289 20.7247 47.9949 20.5787 47.6429 20.5651C47.2909 20.5516 46.9467 20.6713 46.6791 20.9004L35.0835 32.4961L23.4878 20.8865C23.2245 20.6231 22.8672 20.4751 22.4947 20.4751C22.1222 20.4751 21.765 20.6231 21.5016 20.8865C21.2382 21.1498 21.0903 21.5071 21.0903 21.8796C21.0903 22.2521 21.2382 22.6093 21.5016 22.8727L33.1112 34.4683L21.5016 46.0639C21.3552 46.1893 21.2363 46.3436 21.1523 46.5172C21.0684 46.6907 21.0212 46.8797 21.0137 47.0724C21.0063 47.265 21.0388 47.4571 21.1091 47.6366C21.1794 47.8161 21.2861 47.9791 21.4224 48.1154C21.5587 48.2517 21.7217 48.3584 21.9012 48.4287C22.0807 48.499 22.2728 48.5315 22.4654 48.5241C22.6581 48.5166 22.8471 48.4694 23.0206 48.3855C23.1942 48.3015 23.3485 48.1826 23.4739 48.0362L35.0835 36.4405L46.6791 48.0362C46.9467 48.2653 47.2909 48.3851 47.6429 48.3715C47.9949 48.3579 48.3289 48.2119 48.578 47.9628C48.8271 47.7137 48.973 47.3798 48.9866 47.0278C49.0002 46.6757 48.8805 46.3315 48.6513 46.0639L37.0557 34.4683Z",fill:"#FF4949"})),title:(0,t.__)("Import Unsuccessful"),text:(0,t.__)("Please try importing your recipes again. If the problem persists, contact our support team for assistance.")},React.createElement(tn,{style:{flexDirection:"column"}},React.createElement(cr,{label:(0,t.__)("Try Import Again"),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}),React.createElement(cr,{variant:"ghost",label:(0,t.__)("Back to Dashboard"),prevIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"})),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}))))};const{pluginUrl:Qr}=dr_import||{},Xr=Ut.div`
    padding: 24px;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 24px;
    ${e=>e.starter&&"\n        padding: 32px;\n    "}
`,en=Ut.div`
    padding: 64px 0;
`,tn=Ut.div`
    text-align: center;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 12px;
`,rn=Ut.h2`
    font-size: 32px;
    line-height: 1.3;
    font-weight: 600;
    margin: 0 0 32px;
    text-align: center;
`,nn=[{id:"cooked",image:React.createElement("img",{src:`${Qr}/assets/images/import-recipes/cooked.png`}),title:(0,t.__)("Cooked"),description:(0,t.__)("Import all recipes from Cooked plugin.")},{id:"wp-recipe-maker",image:React.createElement("img",{src:`${Qr}/assets/images/import-recipes/wp-recipe-maker.png`}),title:(0,t.__)("WP Recipe Maker"),description:(0,t.__)("Import all recipes from WP Recipe Maker plugin.")}];var an=()=>{const{globalState:r,setGlobalState:n,globalState:{importStart:a,selectedOption:o,recipeCount:l,list:p}}=i(),[u,d]=(0,e.useState)("");(0,e.useEffect)((()=>{o&&m(o)}),[o]);const m=function(){var e=c((function*(e){n({...r,loading:!0});const[t,a]=yield Promise.all([s()({path:`/deliciousrecipe/v1/get_import_plugin_terms?selectedOption=${e}`}),s()({path:`/deliciousrecipe/v1/get_import_recipes?selectedOption=${e}`})]);a.success?n({...r,importPluginFields:t?.data||[],recipes:a?.data||[],recipeCount:a?.data?.length||0,recipesToList:a?.data?.slice(0,p)||[],loading:!1}):(d(a.data),n({...r,importPluginFields:[],recipes:[],recipeCount:0,recipesToList:[],loading:!1}))}));return function(_x){return e.apply(this,arguments)}}();return React.createElement(en,null,a?React.createElement(mr,null,React.createElement(rn,null,(0,t.__)("Import Recipes","delicious-recipes")),React.createElement(xr,{steps:[{id:"recipes-import",label:(0,t.__)("Recipes to Import","delicious-recipes"),component:React.createElement(Br,null)},{id:"fields-mapping",label:(0,t.__)("Fields Mapping","delicious-recipes"),component:React.createElement(Ar,null)},{id:"summary",label:(0,t.__)("Summary","delicious-recipes"),component:React.createElement(jr,null)},{id:"import-process",label:(0,t.__)("Import Process","delicious-recipes"),component:React.createElement(Kr,null)}]})):React.createElement(mr,null,React.createElement(Xr,{starter:!0},React.createElement(Qt,{icon:React.createElement("svg",{width:"25",height:"25",viewBox:"0 0 25 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M24.6519 2.82855L21.8928 0.301686C21.6981 0.124223 21.3786 0 21.1158 0H5.91263C5.50735 0 5.17996 0.328305 5.17996 0.734497V4.31332H1.27206C0.57095 4.31332 0 4.88514 0 5.58858V8.61777C0 9.32121 0.57095 9.89303 1.27206 9.89303H5.17996V24.265C5.17996 24.6712 5.50735 25 5.91263 25H24.2673C24.6726 25 25 24.6712 25 24.265V3.62072C25 3.34171 24.8575 3.01686 24.6519 2.82855ZM1.27206 8.95692C1.0852 8.95692 0.932847 8.80459 0.932847 8.61777V5.58858C0.932847 5.40126 1.0852 5.24894 1.27206 5.24894H5.17996H6.11232H8.08648C8.48979 5.24894 8.81915 4.91916 8.81915 4.51444V3.16179C8.86451 3.17362 8.9153 3.19925 8.96164 3.24608L9.91322 4.20043L10.8466 5.13556L12.5703 6.86385C12.6339 6.92793 12.6703 7.01321 12.6703 7.10293C12.6703 7.19363 12.6339 7.27891 12.5703 7.343L11.7981 8.11644L11.3322 8.58424L10.8663 9.05206L8.96263 10.9603C8.91727 11.0071 8.86747 11.0308 8.82014 11.0416V9.69191C8.82014 9.28719 8.49078 8.95692 8.08747 8.95692H6.1133H5.18095H1.27206ZM24.0667 24.0644H6.11182V9.89254H7.88581V11.1565C7.88581 11.504 8.12543 11.9038 8.52727 11.9698C8.59679 11.9822 8.6668 11.9876 8.73829 11.9876C9.07258 11.9876 9.38566 11.8579 9.62134 11.6213L12.1827 9.05156H21.2538V8.11594H13.1156L13.2275 8.00404C13.4691 7.76348 13.6022 7.44257 13.6022 7.10194C13.6022 6.76131 13.4691 6.44139 13.2295 6.20083L12.165 5.13507H21.2538V4.19994H11.2331L9.62282 2.58602C9.33685 2.29715 8.92664 2.16751 8.52677 2.23455C8.12543 2.30109 7.88532 2.70088 7.88532 3.04791V4.31332H6.11133V0.935128H21.1128C21.1523 0.936114 21.2361 0.969634 21.2642 0.99231L24.0183 3.51474C24.0376 3.53692 24.0637 3.59657 24.0667 3.62072V24.0644Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 12.0317H8.92583V12.9674H21.253V12.0317Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 15.9478H8.92583V16.8829H21.253V15.9478Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 19.8633H8.92583V20.7989H21.253V19.8633Z",fill:"currentColor"})),title:(0,t.__)("Import Recipes","delicious-recipes"),description:(0,t.__)("Select from the options below to import your recipes.","delicious-recipes")}),React.createElement(ar,{options:nn,selected:o,onChange:e=>n({...r,selectedOption:e})}),o&&l>0&&React.createElement(ur,{key:"warning",status:"warning",message:(0,t.__)("We recommend taking a full backup of your site before proceeding with the import. Alternatively, you can also create a staging site and import the recipes.","delicious-recipes")}),o&&l<1&&React.createElement(ur,{key:"error",status:"error",message:u}),React.createElement(tn,null,React.createElement(cr,{type:"button",disabled:!o||l<1,label:(0,t.__)("Proceed to Next Step","delicious-recipes"),onClick:()=>n({...r,importStart:!0})})))))};const{pluginUrl:on}=dr_import||{};var cn=e=>{let{pageTitle:t}=e;return React.createElement("header",{className:"wpdelicious-setting-header border-bottom-1 top-2 flex items-center gap-1"},React.createElement("div",{className:"wpdelicious-logo"},React.createElement("img",{src:on?`${on}/assets/images/Delicious-Recipes.png`:""})),t&&React.createElement("span",{className:"dr-page-name"},t))};let ln=document.getElementById("delicious-recipe-import"),sn=ln.dataset.restNonce;(0,e.createRoot)(ln).render(React.createElement(a,null,React.createElement(cn,null),React.createElement(an,{rest_nonce:sn})))}(),(drExports=void 0===drExports?{}:drExports).import={}}();