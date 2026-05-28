var drExports;!function(){"use strict";var e={n:function(t){var i=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(i,{a:i}),i},d:function(t,i){for(var r in i)e.o(i,r)&&!e.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:i[r]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},nc:void 0},t=window.wp.element,i=window.wp.i18n;const r=(0,t.createContext)();function n({children:e}){const[n,o]=(0,t.useState)({loading:!1,selectedOption:"",showMsg:!0,importStart:!1,importSuccess:!1,pns:!1,recipes:[],recipeCount:0,recipesToList:[],list:10,currentPage:1,recipesToImport:[],deleteRecipes:!1,recipeFields:[],importPluginFields:[],importCSVFileID:"",importCSVFileName:"",importCSVFileURL:"",importCSVFileSize:"",CSVFileHeaders:[],CSVFields:[],isCSV:!1,deleteCSV:!1}),a={recipeTitle:{value:"recipeTitle",label:(0,i.__)("Recipe Title","delicious-recipes"),section:"Post Info"},postContent:{value:"postContent",label:(0,i.__)("Post Content","delicious-recipes"),section:"Post Info"},postExcerpt:{value:"postExcerpt",label:(0,i.__)("Post Excerpt","delicious-recipes"),section:"Post Info"},featuredImage:{value:"featuredImage",label:(0,i.__)("Featured Image","delicious-recipes"),section:"Post Info"},recipeAuthor:{value:"recipeAuthor",label:(0,i.__)("Recipe Author","delicious-recipes"),section:"Post Info"},recipeAuthorEmail:{value:"recipeAuthorEmail",label:(0,i.__)("Recipe Author Email","delicious-recipes"),section:"Post Info"},commnetStatus:{value:"commnetStatus",label:(0,i.__)("Comment Status","delicious-recipes"),section:"Post Info"},recipeSubtitle:{value:"recipeSubtitle",label:(0,i.__)("Recipe Subtitle","delicious-recipes"),section:"Recipe Info"},recipeDescription:{value:"recipeDescription",label:(0,i.__)("Recipe Description","delicious-recipes"),section:"Recipe Info"},difficultyLevel:{value:"difficultyLevel",label:(0,i.__)("Difficulty Level","delicious-recipes"),section:"Recipe Info"},prepTime:{value:"prepTime",label:(0,i.__)("Prep Time","delicious-recipes"),section:"Recipe Info"},cookTime:{value:"cookTime",label:(0,i.__)("Cook Time","delicious-recipes"),section:"Recipe Info"},restTime:{value:"restTime",label:(0,i.__)("Rest Time","delicious-recipes"),section:"Recipe Info"},cookingTemp:{value:"cookingTemp",label:(0,i.__)("Cooking Temperature","delicious-recipes"),section:"Recipe Info"},recipeCalories:{value:"recipeCalories",label:(0,i.__)("Recipe Calories","delicious-recipes"),section:"Recipe Info"},bestSeason:{value:"bestSeason",label:(0,i.__)("Best Season","delicious-recipes"),section:"Recipe Info"},estimatedCost:{value:"estimatedCost",label:(0,i.__)("Estimated Cost","delicious-recipes"),section:"Recipe Info"},noOfServings:{value:"noOfServings",label:(0,i.__)("Number of Servings","delicious-recipes"),section:"Ingredients"},ingredientTitle:{value:"ingredientTitle",label:(0,i.__)("Ingredient Title","delicious-recipes"),section:"Ingredients"},ingredients:{value:"ingredients",label:(0,i.__)("Ingredients","delicious-recipes"),section:"Ingredients"},instructionTitle:{value:"instructionTitle",label:(0,i.__)("Instruction Title","delicious-recipes"),section:"Instructions"},instructions:{value:"instructions",label:(0,i.__)("Instructions","delicious-recipes"),section:"Instructions"},imageGallery:{value:"imageGallery",label:(0,i.__)("Image Gallery","delicious-recipes"),section:"Gallery"},videoGallery:{value:"videoGallery",label:(0,i.__)("Video Gallery","delicious-recipes"),section:"Gallery"},servingSize:{value:"servingSize",label:(0,i.__)("Serving Size","delicious-recipes"),section:"Nutrition"},calories:{value:"calories",label:(0,i.__)("Calories","delicious-recipes"),section:"Nutrition"},totalFat:{value:"totalFat",label:(0,i.__)("Total Fat","delicious-recipes"),section:"Nutrition"},saturatedFat:{value:"saturatedFat",label:(0,i.__)("Saturated Fat","delicious-recipes"),section:"Nutrition"},transFat:{value:"transFat",label:(0,i.__)("Trans Fat","delicious-recipes"),section:"Nutrition"},cholesterol:{value:"cholesterol",label:(0,i.__)("Cholesterol","delicious-recipes"),section:"Nutrition"},sodium:{value:"sodium",label:(0,i.__)("Sodium","delicious-recipes"),section:"Nutrition"},potassium:{value:"potassium",label:(0,i.__)("Potassium","delicious-recipes"),section:"Nutrition"},totalCarbohydrate:{value:"totalCarbohydrate",label:(0,i.__)("Total Carbohydrate","delicious-recipes"),section:"Nutrition"},dietaryFiber:{value:"dietaryFiber",label:(0,i.__)("Dietary Fiber","delicious-recipes"),section:"Nutrition"},sugars:{value:"sugars",label:(0,i.__)("Sugars","delicious-recipes"),section:"Nutrition"},protein:{value:"protein",label:(0,i.__)("Protein","delicious-recipes"),section:"Nutrition"},vitaminA:{value:"vitaminA",label:(0,i.__)("Vitamin A","delicious-recipes"),section:"Nutrition"},vitaminC:{value:"vitaminC",label:(0,i.__)("Vitamin C","delicious-recipes"),section:"Nutrition"},vitaminD:{value:"vitaminD",label:(0,i.__)("Vitamin D","delicious-recipes"),section:"Nutrition"},vitaminE:{value:"vitaminE",label:(0,i.__)("Vitamin E","delicious-recipes"),section:"Nutrition"},vitaminK:{value:"vitaminK",label:(0,i.__)("Vitamin K","delicious-recipes"),section:"Nutrition"},vitaminB6:{value:"vitaminB6",label:(0,i.__)("Vitamin B6","delicious-recipes"),section:"Nutrition"},vitaminB12:{value:"vitaminB12",label:(0,i.__)("Vitamin B12","delicious-recipes"),section:"Nutrition"},calcium:{value:"calcium",label:(0,i.__)("Calcium","delicious-recipes"),section:"Nutrition"},iron:{value:"iron",label:(0,i.__)("Iron","delicious-recipes"),section:"Nutrition"},thiamin:{value:"thiamin",label:(0,i.__)("Thiamin","delicious-recipes"),section:"Nutrition"},riboflavin:{value:"riboflavin",label:(0,i.__)("Riboflavin","delicious-recipes"),section:"Nutrition"},niacin:{value:"niacin",label:(0,i.__)("Niacin","delicious-recipes"),section:"Nutrition"},folate:{value:"folate",label:(0,i.__)("Folate","delicious-recipes"),section:"Nutrition"},biotin:{value:"biotin",label:(0,i.__)("Biotin","delicious-recipes"),section:"Nutrition"},pantothenicAcid:{value:"pantothenicAcid",label:(0,i.__)("Pantothenic Acid","delicious-recipes"),section:"Nutrition"},phosphorus:{value:"phosphorus",label:(0,i.__)("Phosphorus","delicious-recipes"),section:"Nutrition"},iodine:{value:"iodine",label:(0,i.__)("Iodine","delicious-recipes"),section:"Nutrition"},magnesium:{value:"magnesium",label:(0,i.__)("Magnesium","delicious-recipes"),section:"Nutrition"},zinc:{value:"zinc",label:(0,i.__)("Zinc","delicious-recipes"),section:"Nutrition"},selenium:{value:"selenium",label:(0,i.__)("Selenium","delicious-recipes"),section:"Nutrition"},copper:{value:"copper",label:(0,i.__)("Copper","delicious-recipes"),section:"Nutrition"},manganese:{value:"manganese",label:(0,i.__)("Manganese","delicious-recipes"),section:"Nutrition"},chromium:{value:"chromium",label:(0,i.__)("Chromium","delicious-recipes"),section:"Nutrition"},molybdenum:{value:"molybdenum",label:(0,i.__)("Molybdenum","delicious-recipes"),section:"Nutrition"},chloride:{value:"chloride",label:(0,i.__)("Chloride","delicious-recipes"),section:"Nutrition"},recipeNotes:{value:"recipeNotes",label:(0,i.__)("Recipe Notes","delicious-recipes"),section:"Notes"},faqTitle:{value:"faqTitle",label:(0,i.__)("FAQ Title","delicious-recipes"),section:"FAQs"},recipeFAQs:{value:"recipeFAQs",label:(0,i.__)("Recipe FAQs","delicious-recipes"),section:"FAQs"},equipmentsTitle:{value:"equipmentsTitle",label:(0,i.__)("Equipment Title","delicious-recipes"),section:"Equipment"},recipeEquipments:{value:"recipeEquipments",label:(0,i.__)("Recipe Equipment","delicious-recipes"),section:"Equipment"},extendedContent:{value:"extendedContent",label:(0,i.__)("Extended Content","delicious-recipes"),section:"Extended Content"}},l={"recipe-course":(0,i.__)("Recipe Courses","delicious-recipes"),"recipe-cuisine":(0,i.__)("Recipe Cuisines","delicious-recipes"),"recipe-cooking-method":(0,i.__)("Recipe Cooking Methods","delicious-recipes"),"recipe-key":(0,i.__)("Recipe Keys","delicious-recipes"),"recipe-tag":(0,i.__)("Recipe Tags","delicious-recipes"),"recipe-badge":(0,i.__)("Recipe Badges","delicious-recipes"),"recipe-dietary":(0,i.__)("Recipe Dietaries","delicious-recipes"),recipe_keywords:(0,i.__)("Recipe Keywords","delicious-recipes")},{recipes:s,list:c,currentPage:p,recipesToList:u}=n;return s?.length>0&&0===u.length&&o({...n,recipesToList:s.slice((p-1)*c,p*c)}),React.createElement(r.Provider,{value:{globalState:n,setGlobalState:o,recipe_metadata:a,wpd_fields:l}},e)}function o(){return(0,t.useContext)(r)}function a(e,t,i,r,n,o,a){try{var l=e[o](a),s=l.value}catch(e){return void i(e)}l.done?t(s):Promise.resolve(s).then(r,n)}function l(e){return function(){var t=this,i=arguments;return new Promise(function(r,n){var o=e.apply(t,i);function l(e){a(o,r,n,l,s,"next",e)}function s(e){a(o,r,n,l,s,"throw",e)}l(void 0)})}}var s=window.wp.apiFetch,c=e.n(s),p=window.React,u=e.n(p),d="-ms-",m="-moz-",h="-webkit-",f="comm",g="rule",b="decl",v="@keyframes",E=Math.abs,C=String.fromCharCode,R=Object.assign;function x(e){return e.trim()}function _(e,t){return(e=t.exec(e))?e[0]:e}function w(e,t,i){return e.replace(t,i)}function y(e,t,i){return e.indexOf(t,i)}function k(e,t){return 0|e.charCodeAt(t)}function S(e,t,i){return e.slice(t,i)}function T(e){return e.length}function F(e){return e.length}function I(e,t){return t.push(e),e}function D(e,t){return e.filter(function(e){return!_(e,t)})}var N,L,P=1,V=1,M=0,$=0,A=0,B="";function O(e,t,i,r,n,o,a,l){return{value:e,root:t,parent:i,type:r,props:n,children:o,line:P,column:V,length:a,return:"",siblings:l}}function H(e,t){return R(O("",null,null,"",null,null,0,e.siblings),e,{length:-e.length},t)}function j(e){for(;e.root;)e=H(e.root,{children:[e]});I(e,e.siblings)}function z(){return A=$>0?k(B,--$):0,V--,10===A&&(V=1,P--),A}function G(){return A=$<M?k(B,$++):0,V++,10===A&&(V=1,P++),A}function W(){return k(B,$)}function Z(){return $}function q(e,t){return S(B,e,t)}function J(e){switch(e){case 0:case 9:case 10:case 13:case 32:return 5;case 33:case 43:case 44:case 47:case 62:case 64:case 126:case 59:case 123:case 125:return 4;case 58:return 3;case 34:case 39:case 40:case 91:return 2;case 41:case 93:return 1}return 0}function U(e){return x(q($-1,K(91===e?e+2:40===e?e+1:e)))}function Y(e){for(;(A=W())&&A<33;)G();return J(e)>2||J(A)>3?"":" "}function Q(e,t){for(;--t&&G()&&!(A<48||A>102||A>57&&A<65||A>70&&A<97););return q(e,Z()+(t<6&&32==W()&&32==G()))}function K(e){for(;G();)switch(A){case e:return $;case 34:case 39:34!==e&&39!==e&&K(A);break;case 40:41===e&&K(e);break;case 92:G()}return $}function X(e,t){for(;G()&&e+A!==57&&(e+A!==84||47!==W()););return"/*"+q(t,$-1)+"*"+C(47===e?e:G())}function ee(e){for(;!J(W());)G();return q(e,$)}function te(e,t){for(var i="",r=0;r<e.length;r++)i+=t(e[r],r,e,t)||"";return i}function ie(e,t,i,r){switch(e.type){case"@layer":if(e.children.length)break;case"@import":case"@namespace":case b:return e.return=e.return||e.value;case f:return"";case v:return e.return=e.value+"{"+te(e.children,r)+"}";case g:if(!T(e.value=e.props.join(",")))return""}return T(i=te(e.children,r))?e.return=e.value+"{"+i+"}":""}function re(e,t,i){switch(function(e,t){return 45^k(e,0)?(((t<<2^k(e,0))<<2^k(e,1))<<2^k(e,2))<<2^k(e,3):0}(e,t)){case 5103:return h+"print-"+e+e;case 5737:case 4201:case 3177:case 3433:case 1641:case 4457:case 2921:case 5572:case 6356:case 5844:case 3191:case 6645:case 3005:case 4215:case 6389:case 5109:case 5365:case 5621:case 3829:case 6391:case 5879:case 5623:case 6135:case 4599:return h+e+e;case 4855:return h+e.replace("add","source-over").replace("substract","source-out").replace("intersect","source-in").replace("exclude","xor")+e;case 4789:return m+e+e;case 5349:case 4246:case 4810:case 6968:case 2756:return h+e+m+e+d+e+e;case 5936:switch(k(e,t+11)){case 114:return h+e+d+w(e,/[svh]\w+-[tblr]{2}/,"tb")+e;case 108:return h+e+d+w(e,/[svh]\w+-[tblr]{2}/,"tb-rl")+e;case 45:return h+e+d+w(e,/[svh]\w+-[tblr]{2}/,"lr")+e}case 6828:case 4268:case 2903:return h+e+d+e+e;case 6165:return h+e+d+"flex-"+e+e;case 5187:return h+e+w(e,/(\w+).+(:[^]+)/,h+"box-$1$2"+d+"flex-$1$2")+e;case 5443:return h+e+d+"flex-item-"+w(e,/flex-|-self/g,"")+(_(e,/flex-|baseline/)?"":d+"grid-row-"+w(e,/flex-|-self/g,""))+e;case 4675:return h+e+d+"flex-line-pack"+w(e,/align-content|flex-|-self/g,"")+e;case 5548:return h+e+d+w(e,"shrink","negative")+e;case 5292:return h+e+d+w(e,"basis","preferred-size")+e;case 6060:return h+"box-"+w(e,"-grow","")+h+e+d+w(e,"grow","positive")+e;case 4554:return h+w(e,/([^-])(transform)/g,"$1"+h+"$2")+e;case 6187:return w(w(w(e,/(zoom-|grab)/,h+"$1"),/(image-set)/,h+"$1"),e,"")+e;case 5495:case 3959:return w(e,/(image-set\([^]*)/,h+"$1$`$1");case 4968:return w(w(e,/(.+:)(flex-)?(.*)/,h+"box-pack:$3"+d+"flex-pack:$3"),/space-between/,"justify")+h+e+e;case 4200:if(!_(e,/flex-|baseline/))return d+"grid-column-align"+S(e,t)+e;break;case 2592:case 3360:return d+w(e,"template-","")+e;case 4384:case 3616:return i&&i.some(function(e,i){return t=i,_(e.props,/grid-\w+-end/)})?~y(e+(i=i[t].value),"span",0)?e:d+w(e,"-start","")+e+d+"grid-row-span:"+(~y(i,"span",0)?_(i,/\d+/):+_(i,/\d+/)-+_(e,/\d+/))+";":d+w(e,"-start","")+e;case 4896:case 4128:return i&&i.some(function(e){return _(e.props,/grid-\w+-start/)})?e:d+w(w(e,"-end","-span"),"span ","")+e;case 4095:case 3583:case 4068:case 2532:return w(e,/(.+)-inline(.+)/,h+"$1$2")+e;case 8116:case 7059:case 5753:case 5535:case 5445:case 5701:case 4933:case 4677:case 5533:case 5789:case 5021:case 4765:if(T(e)-1-t>6)switch(k(e,t+1)){case 109:if(45!==k(e,t+4))break;case 102:return w(e,/(.+:)(.+)-([^]+)/,"$1"+h+"$2-$3$1"+m+(108==k(e,t+3)?"$3":"$2-$3"))+e;case 115:return~y(e,"stretch",0)?re(w(e,"stretch","fill-available"),t,i)+e:e}break;case 5152:case 5920:return w(e,/(.+?):(\d+)(\s*\/\s*(span)?\s*(\d+))?(.*)/,function(t,i,r,n,o,a,l){return d+i+":"+r+l+(n?d+i+"-span:"+(o?a:+a-+r)+l:"")+e});case 4949:if(121===k(e,t+6))return w(e,":",":"+h)+e;break;case 6444:switch(k(e,45===k(e,14)?18:11)){case 120:return w(e,/(.+:)([^;\s!]+)(;|(\s+)?!.+)?/,"$1"+h+(45===k(e,14)?"inline-":"")+"box$3$1"+h+"$2$3$1"+d+"$2box$3")+e;case 100:return w(e,":",":"+d)+e}break;case 5719:case 2647:case 2135:case 3927:case 2391:return w(e,"scroll-","scroll-snap-")+e}return e}function ne(e,t,i,r){if(e.length>-1&&!e.return)switch(e.type){case b:return void(e.return=re(e.value,e.length,i));case v:return te([H(e,{value:w(e.value,"@","@"+h)})],r);case g:if(e.length)return function(e,t){return e.map(t).join("")}(i=e.props,function(t){switch(_(t,r=/(::plac\w+|:read-\w+)/)){case":read-only":case":read-write":j(H(e,{props:[w(t,/:(read-\w+)/,":-moz-$1")]})),j(H(e,{props:[t]})),R(e,{props:D(i,r)});break;case"::placeholder":j(H(e,{props:[w(t,/:(plac\w+)/,":"+h+"input-$1")]})),j(H(e,{props:[w(t,/:(plac\w+)/,":-moz-$1")]})),j(H(e,{props:[w(t,/:(plac\w+)/,d+"input-$1")]})),j(H(e,{props:[t]})),R(e,{props:D(i,r)})}return""})}}function oe(e){return function(e){return B="",e}(ae("",null,null,null,[""],e=function(e){return P=V=1,M=T(B=e),$=0,[]}(e),0,[0],e))}function ae(e,t,i,r,n,o,a,l,s){for(var c=0,p=0,u=a,d=0,m=0,h=0,f=1,g=1,b=1,v=0,R="",x=n,_=o,F=r,D=R;g;)switch(h=v,v=G()){case 40:if(108!=h&&58==k(D,u-1)){-1!=y(D+=w(U(v),"&","&\f"),"&\f",E(c?l[c-1]:0))&&(b=-1);break}case 34:case 39:case 91:D+=U(v);break;case 9:case 10:case 13:case 32:D+=Y(h);break;case 92:D+=Q(Z()-1,7);continue;case 47:switch(W()){case 42:case 47:I(se(X(G(),Z()),t,i,s),s),5!=J(h||1)&&5!=J(W()||1)||!T(D)||" "===S(D,-1,void 0)||(D+=" ");break;default:D+="/"}break;case 123*f:l[c++]=T(D)*b;case 125*f:case 59:case 0:switch(v){case 0:case 125:g=0;case 59+p:-1==b&&(D=w(D,/\f/g,"")),m>0&&(T(D)-u||0===f&&47===h)&&I(m>32?ce(D+";",r,i,u-1,s):ce(w(D," ","")+";",r,i,u-2,s),s);break;case 59:D+=";";default:if(I(F=le(D,t,i,c,p,n,l,R,x=[],_=[],u,o),o),123===v)if(0===p)ae(D,t,F,F,x,o,u,l,_);else{switch(d){case 99:if(110===k(D,3))break;case 108:if(97===k(D,2))break;default:p=0;case 100:case 109:case 115:}p?ae(e,F,F,r&&I(le(e,F,F,0,0,n,l,R,n,x=[],u,_),_),n,_,u,l,r?x:_):ae(D,F,F,F,[""],_,0,l,_)}}c=p=m=0,f=b=1,R=D="",u=a;break;case 58:u=1+T(D),m=h;default:if(f<1)if(123==v)--f;else if(125==v&&0==f++&&125==z())continue;switch(D+=C(v),v*f){case 38:b=p>0?1:(D+="\f",-1);break;case 44:l[c++]=(T(D)-1)*b,b=1;break;case 64:45===W()&&(D+=U(G())),d=W(),p=u=T(R=D+=ee(Z())),v++;break;case 45:45===h&&2==T(D)&&(f=0)}}return o}function le(e,t,i,r,n,o,a,l,s,c,p,u){for(var d=n-1,m=0===n?o:[""],h=F(m),f=0,b=0,v=0;f<r;++f)for(var C=0,R=S(e,d+1,d=E(b=a[f])),_=e;C<h;++C)(_=x(b>0?m[C]+" "+R:w(R,/&\f/g,m[C])))&&(s[v++]=_);return O(e,t,i,0===n?g:l,s,c,p,u)}function se(e,t,i,r){return O(e,t,i,f,C(A),S(e,2,-2),0,r)}function ce(e,t,i,r,n){return O(e,t,i,b,S(e,0,r),S(e,r+1,-1),r,n)}const pe="undefined"!=typeof process&&void 0!==process.env&&(process.env.REACT_APP_SC_ATTR||process.env.SC_ATTR)||"data-styled",ue="active",de="data-styled-version",me="6.4.0",he="/*!sc*/\n",fe="undefined"!=typeof window&&"undefined"!=typeof document;function ge(e){if("undefined"!=typeof process&&void 0!==process.env){const t=process.env[e];if(void 0!==t&&""!==t)return"false"!==t}}const be=Boolean("boolean"==typeof SC_DISABLE_SPEEDY?SC_DISABLE_SPEEDY:null!==(L=null!==(N=ge("REACT_APP_SC_DISABLE_SPEEDY"))&&void 0!==N?N:ge("SC_DISABLE_SPEEDY"))&&void 0!==L?L:"undefined"==typeof process||void 0===process.env||!1);function ve(e,...t){return new Error(`An error occurred. See https://github.com/styled-components/styled-components/blob/main/packages/styled-components/src/utils/errors.md#${e} for more information.${t.length>0?` Args: ${t.join(", ")}`:""}`)}let Ee=new Map,Ce=new Map,Re=1;const xe=e=>{if(Ee.has(e))return Ee.get(e);for(;Ce.has(Re);)Re++;const t=Re++;return Ee.set(e,t),Ce.set(t,e),t},_e=e=>Ce.get(e),we=(e,t)=>{Re=t+1,Ee.set(e,t),Ce.set(t,e)},ye=(new Set,Object.freeze([])),ke=Object.freeze({});const Se=/[!"#$%&'()*+,./:;<=>?@[\\\]^`{|}~-]+/g,Te=/(^-|-$)/g;function Fe(e){return e.replace(Se,"-").replace(Te,"")}const Ie=/(a)(d)/gi,De=e=>String.fromCharCode(e+(e>25?39:97));function Ne(e){let t,i="";for(t=Math.abs(e);t>52;t=t/52|0)i=De(t%52)+i;return(De(t%52)+i).replace(Ie,"$1-$2")}const Le=5381,Pe=(e,t)=>{let i=t.length;for(;i;)e=33*e^t.charCodeAt(--i);return e},Ve=e=>Pe(Le,e);function Me(e){return"string"==typeof e&&!0}function $e(e){return Me(e)?`styled.${e}`:`Styled(${function(e){return e.displayName||e.name||"Component"}(e)})`}const Ae=Symbol.for("react.memo"),Be=Symbol.for("react.forward_ref"),Oe={contextType:!0,defaultProps:!0,displayName:!0,getDerivedStateFromError:!0,getDerivedStateFromProps:!0,propTypes:!0,type:!0},He={name:!0,length:!0,prototype:!0,caller:!0,callee:!0,arguments:!0,arity:!0},je={$$typeof:!0,compare:!0,defaultProps:!0,displayName:!0,propTypes:!0,type:!0},ze={[Be]:{$$typeof:!0,render:!0,defaultProps:!0,displayName:!0,propTypes:!0},[Ae]:je};function Ge(e){return("type"in(t=e)&&t.type.$$typeof)===Ae?je:"$$typeof"in e?ze[e.$$typeof]:Oe;var t}const We=Object.defineProperty,Ze=Object.getOwnPropertyNames,qe=Object.getOwnPropertySymbols,Je=Object.getOwnPropertyDescriptor,Ue=Object.getPrototypeOf,Ye=Object.prototype;function Qe(e,t,i){if("string"!=typeof t){const r=Ue(t);r&&r!==Ye&&Qe(e,r,i);const n=Ze(t).concat(qe(t)),o=Ge(e),a=Ge(t);for(let r=0;r<n.length;++r){const l=n[r];if(!(l in He||i&&i[l]||a&&l in a||o&&l in o)){const i=Je(t,l);try{We(e,l,i)}catch(e){}}}}return e}function Ke(e){return"function"==typeof e}function Xe(e){return"object"==typeof e&&"styledComponentId"in e}function et(e,t){return e&&t?e+" "+t:e||t||""}function tt(e,t){return e.join(t||"")}function it(e){return null!==e&&"object"==typeof e&&e.constructor.name===Object.name&&!("props"in e&&e.$$typeof)}function rt(e,t,i=!1){if(!i&&!it(e)&&!Array.isArray(e))return t;if(Array.isArray(t))for(let i=0;i<t.length;i++)e[i]=rt(e[i],t[i]);else if(it(t))for(const i in t)e[i]=rt(e[i],t[i]);return e}function nt(e,t){Object.defineProperty(e,"toString",{value:t})}const ot=class{constructor(e){this.groupSizes=new Uint32Array(512),this.length=512,this.tag=e,this._cGroup=0,this._cIndex=0}indexOfGroup(e){if(e===this._cGroup)return this._cIndex;let t=this._cIndex;if(e>this._cGroup)for(let i=this._cGroup;i<e;i++)t+=this.groupSizes[i];else for(let i=this._cGroup-1;i>=e;i--)t-=this.groupSizes[i];return this._cGroup=e,this._cIndex=t,t}insertRules(e,t){if(e>=this.groupSizes.length){const t=this.groupSizes,i=t.length;let r=i;for(;e>=r;)if(r<<=1,r<0)throw ve(16,`${e}`);this.groupSizes=new Uint32Array(r),this.groupSizes.set(t),this.length=r;for(let e=i;e<r;e++)this.groupSizes[e]=0}let i=this.indexOfGroup(e+1),r=0;for(let n=0,o=t.length;n<o;n++)this.tag.insertRule(i,t[n])&&(this.groupSizes[e]++,i++,r++);r>0&&this._cGroup>e&&(this._cIndex+=r)}clearGroup(e){if(e<this.length){const t=this.groupSizes[e],i=this.indexOfGroup(e),r=i+t;this.groupSizes[e]=0;for(let e=i;e<r;e++)this.tag.deleteRule(i);t>0&&this._cGroup>e&&(this._cIndex-=t)}}getGroup(e){let t="";if(e>=this.length||0===this.groupSizes[e])return t;const i=this.groupSizes[e],r=this.indexOfGroup(e),n=r+i;for(let e=r;e<n;e++)t+=this.tag.getRule(e)+he;return t}},at=`style[${pe}][${de}="${me}"]`,lt=new RegExp(`^${pe}\\.g(\\d+)\\[id="([\\w\\d-]+)"\\].*?"([^"]*)`),st=e=>"undefined"!=typeof ShadowRoot&&e instanceof ShadowRoot||"host"in e&&11===e.nodeType,ct=e=>{if(!e)return document;if(st(e))return e;if("getRootNode"in e){const t=e.getRootNode();if(st(t))return t}return document},pt=(e,t,i)=>{const r=i.split(",");let n;for(let i=0,o=r.length;i<o;i++)(n=r[i])&&e.registerName(t,n)},ut=(e,t)=>{var i;const r=(null!==(i=t.textContent)&&void 0!==i?i:"").split(he),n=[];for(let t=0,i=r.length;t<i;t++){const i=r[t].trim();if(!i)continue;const o=i.match(lt);if(o){const t=0|parseInt(o[1],10),i=o[2];0!==t&&(we(i,t),pt(e,i,o[3]),e.getTag().insertRules(t,n)),n.length=0}else n.push(i)}},dt=e=>{const t=ct(e.options.target).querySelectorAll(at);for(let i=0,r=t.length;i<r;i++){const r=t[i];r&&r.getAttribute(pe)!==ue&&(ut(e,r),r.parentNode&&r.parentNode.removeChild(r))}};let mt=!1;const ht=(t,i)=>{const r=document.head,n=t||r,o=document.createElement("style"),a=(e=>{const t=Array.from(e.querySelectorAll(`style[${pe}]`));return t[t.length-1]})(n),l=void 0!==a?a.nextSibling:null;o.setAttribute(pe,ue),o.setAttribute(de,me);const s=i||function(){if(!1!==mt)return mt;if("undefined"!=typeof document){const e=document.head.querySelector('meta[property="csp-nonce"]');if(e)return mt=e.nonce||e.getAttribute("content")||void 0;const t=document.head.querySelector('meta[name="sc-nonce"]');if(t)return mt=t.getAttribute("content")||void 0}return mt=e.nc}();return s&&o.setAttribute("nonce",s),n.insertBefore(o,l),o},ft=class{constructor(e,t){this.element=ht(e,t),this.element.appendChild(document.createTextNode("")),this.sheet=(e=>{var t;if(e.sheet)return e.sheet;const i=null!==(t=e.getRootNode().styleSheets)&&void 0!==t?t:document.styleSheets;for(let t=0,r=i.length;t<r;t++){const r=i[t];if(r.ownerNode===e)return r}throw ve(17)})(this.element),this.length=0}insertRule(e,t){try{return this.sheet.insertRule(t,e),this.length++,!0}catch(e){return!1}}deleteRule(e){this.sheet.deleteRule(e),this.length--}getRule(e){const t=this.sheet.cssRules[e];return t&&t.cssText?t.cssText:""}},gt=class{constructor(e,t){this.element=ht(e,t),this.nodes=this.element.childNodes,this.length=0}insertRule(e,t){if(e<=this.length&&e>=0){const i=document.createTextNode(t);return this.element.insertBefore(i,this.nodes[e]||null),this.length++,!0}return!1}deleteRule(e){this.element.removeChild(this.nodes[e]),this.length--}getRule(e){return e<this.length?this.nodes[e].textContent:""}};let bt=fe;const vt={isServer:!fe,useCSSOMInjection:!be};class Et{static registerId(e){return xe(e)}constructor(e=ke,t={},i){this.options=Object.assign(Object.assign({},vt),e),this.gs=t,this.keyframeIds=new Set,this.names=new Map(i),this.server=!!e.isServer,!this.server&&fe&&bt&&(bt=!1,dt(this)),nt(this,()=>(e=>{const t=e.getTag(),{length:i}=t;let r="";for(let n=0;n<i;n++){const i=_e(n);if(void 0===i)continue;const o=e.names.get(i);if(void 0===o||!o.size)continue;const a=t.getGroup(n);if(0===a.length)continue;const l=pe+".g"+n+'[id="'+i+'"]';let s="";for(const e of o)e.length>0&&(s+=e+",");r+=a+l+'{content:"'+s+'"}'+he}return r})(this))}rehydrate(){!this.server&&fe&&dt(this)}reconstructWithOptions(e,t=!0){const i=new Et(Object.assign(Object.assign({},this.options),e),this.gs,t&&this.names||void 0);return i.keyframeIds=new Set(this.keyframeIds),!this.server&&fe&&e.target!==this.options.target&&ct(this.options.target)!==ct(e.target)&&dt(i),i}allocateGSInstance(e){return this.gs[e]=(this.gs[e]||0)+1}getTag(){return this.tag||(this.tag=(e=(({useCSSOMInjection:e,target:t,nonce:i})=>e?new ft(t,i):new gt(t,i))(this.options),new ot(e)));var e}hasNameForId(e,t){var i,r;return null!==(r=null===(i=this.names.get(e))||void 0===i?void 0:i.has(t))&&void 0!==r&&r}registerName(e,t){xe(e),e.startsWith("sc-keyframes-")&&this.keyframeIds.add(e);const i=this.names.get(e);i?i.add(t):this.names.set(e,new Set([t]))}insertRules(e,t,i){this.registerName(e,t),this.getTag().insertRules(xe(e),i)}clearNames(e){this.names.has(e)&&this.names.get(e).clear()}clearRules(e){this.getTag().clearGroup(xe(e)),this.clearNames(e)}clearTag(){this.tag=void 0}}const Ct=new WeakSet,Rt={animationIterationCount:1,aspectRatio:1,borderImageOutset:1,borderImageSlice:1,borderImageWidth:1,columnCount:1,columns:1,flex:1,flexGrow:1,flexShrink:1,gridRow:1,gridRowEnd:1,gridRowSpan:1,gridRowStart:1,gridColumn:1,gridColumnEnd:1,gridColumnSpan:1,gridColumnStart:1,fontWeight:1,lineHeight:1,opacity:1,order:1,orphans:1,scale:1,tabSize:1,widows:1,zIndex:1,zoom:1,WebkitLineClamp:1,fillOpacity:1,floodOpacity:1,stopOpacity:1,strokeDasharray:1,strokeDashoffset:1,strokeMiterlimit:1,strokeOpacity:1,strokeWidth:1};function xt(e,t){return null==t||"boolean"==typeof t||""===t?"":"number"!=typeof t||0===t||e in Rt||e.startsWith("--")?String(t).trim():t+"px"}const _t=e=>e>="A"&&e<="Z";function wt(e){let t="";for(let i=0;i<e.length;i++){const r=e[i];if(1===i&&"-"===r&&"-"===e[0])return e;_t(r)?t+="-"+r.toLowerCase():t+=r}return t.startsWith("ms-")?"-"+t:t}const yt=Symbol.for("sc-keyframes");function kt(e){return Ke(e)&&!(e.prototype&&e.prototype.isReactComponent)}const St=e=>null==e||!1===e||""===e,Tt=Symbol.for("react.client.reference");function Ft(e){return e.$$typeof===Tt}const It=e=>{const t=[];for(const i in e){const r=e[i];e.hasOwnProperty(i)&&!St(r)&&(Array.isArray(r)&&Ct.has(r)||Ke(r)?t.push(wt(i)+":",r,";"):it(r)?t.push(i+" {",...It(r),"}"):t.push(wt(i)+": "+xt(i,r)+";"))}return t};function Dt(e,t,i,r,n=[]){if(St(e))return n;const o=typeof e;if("string"===o)return n.push(e),n;if("function"===o)return Ft(e)?n:kt(e)&&t?Dt(e(t),t,i,r,n):(n.push(e),n);if(Array.isArray(e)){for(let o=0;o<e.length;o++)Dt(e[o],t,i,r,n);return n}if(Xe(e))return n.push(`.${e.styledComponentId}`),n;if(function(e){return"object"==typeof e&&null!==e&&yt in e}(e))return i?(e.inject(i,r),n.push(e.getName(r))):n.push(e),n;if(Ft(e))return n;if(it(e)){const t=It(e);for(let e=0;e<t.length;e++)n.push(t[e]);return n}return n.push(e.toString()),n}const Nt=Ve(me);class Lt{constructor(e,t,i){this.rules=e,this.componentId=t,this.baseHash=Pe(Nt,t),this.baseStyle=i,Et.registerId(t)}generateAndInjectStyles(e,t,i){let r=this.baseStyle?this.baseStyle.generateAndInjectStyles(e,t,i):"";{let n="";for(let r=0;r<this.rules.length;r++){const o=this.rules[r];if("string"==typeof o)n+=o;else if(o)if(kt(o)){const r=o(e);"string"==typeof r?n+=r:null!=r&&!1!==r&&(n+=tt(Dt(r,e,t,i)))}else n+=tt(Dt(o,e,t,i))}if(n){this.dynamicNameCache||(this.dynamicNameCache=new Map);const e=i.hash?i.hash+n:n;let o=this.dynamicNameCache.get(e);if(!o){if(o=Ne(Pe(Pe(this.baseHash,i.hash),n)>>>0),this.dynamicNameCache.size>=200){const e=this.dynamicNameCache.keys().next().value;void 0!==e&&this.dynamicNameCache.delete(e)}this.dynamicNameCache.set(e,o)}if(!t.hasNameForId(this.componentId,o)){const e=i(n,"."+o,void 0,this.componentId);t.insertRules(this.componentId,o,e)}r=et(r,o)}}return r}}const Pt=/&/g,Vt=47;function Mt(e,t){let i=0;for(;--t>=0&&92===e.charCodeAt(t);)i++;return!(1&~i)}function $t(e){const t=e.length;let i="",r=0,n=0,o=0,a=!1,l=!1;for(let s=0;s<t;s++){const c=e.charCodeAt(s);if(0!==o||a||c!==Vt||42!==e.charCodeAt(s+1))if(a)42===c&&e.charCodeAt(s+1)===Vt&&(a=!1,s++);else if(34!==c&&39!==c||Mt(e,s)){if(0===o)if(123===c)n++;else if(125===c){if(n--,n<0){l=!0;let i=s+1;for(;i<t;){const t=e.charCodeAt(i);if(59===t||10===t)break;i++}i<t&&59===e.charCodeAt(i)&&i++,n=0,s=i-1,r=i;continue}0===n&&(i+=e.substring(r,s+1),r=s+1)}else 59===c&&0===n&&(i+=e.substring(r,s+1),r=s+1)}else 0===o?o=c:o===c&&(o=0);else a=!0,s++}return l||0!==n||0!==o?(r<t&&0===n&&0===o&&(i+=e.substring(r)),i):e}function At(e,t){for(let i=0;i<e.length;i++){const r=e[i];if("rule"===r.type){r.value=t+" "+r.value,r.value=r.value.replaceAll(",",","+t+" ");const e=r.props,i=[];for(let r=0;r<e.length;r++)i[r]=t+" "+e[r];r.props=i}Array.isArray(r.children)&&"@keyframes"!==r.type&&(r.children=At(r.children,t))}return e}const Bt=new Et,Ot=function({options:e=ke,plugins:t=ye}=ke){let i,r,n;const o=(e,t,n)=>n.startsWith(r)&&n.endsWith(r)&&n.replaceAll(r,"").length>0?`.${i}`:e,a=t.slice();a.push(e=>{e.type===g&&e.value.includes("&")&&(n||(n=new RegExp(`\\${r}\\b`,"g")),e.props[0]=e.props[0].replace(Pt,r).replace(n,o))}),e.prefix&&a.push(ne),a.push(ie);let l=[];const s=(u=a.concat((m=e=>l.push(e),function(e){e.root||(e=e.return)&&m(e)})),d=F(u),function(e,t,i,r){for(var n="",o=0;o<d;o++)n+=u[o](e,t,i,r)||"";return n}),c=(t,o="",a="",c="&")=>{i=c,r=o,n=void 0;const p=function(e){const t=-1!==e.indexOf("//"),i=-1!==e.indexOf("}");if(!t&&!i)return e;if(!t)return $t(e);const r=e.length;let n="",o=0,a=0,l=0,s=0,c=0,p=!1;for(;a<r;){const t=e.charCodeAt(a);if(34!==t&&39!==t||Mt(e,a))if(0===l)if(t===Vt&&a+1<r&&42===e.charCodeAt(a+1)){for(a+=2;a+1<r&&(42!==e.charCodeAt(a)||e.charCodeAt(a+1)!==Vt);)a++;a+=2}else if(40!==t)if(41!==t)if(s>0)a++;else if(42===t&&a+1<r&&e.charCodeAt(a+1)===Vt)n+=e.substring(o,a),a+=2,o=a,p=!0;else if(t===Vt&&a+1<r&&e.charCodeAt(a+1)===Vt){for(n+=e.substring(o,a);a<r&&10!==e.charCodeAt(a);)a++;o=a,p=!0}else 123===t?c++:125===t&&c--,a++;else s>0&&s--,a++;else s++,a++;else a++;else 0===l?l=t:l===t&&(l=0),a++}return p?(o<r&&(n+=e.substring(o)),0===c?n:$t(n)):0===c?e:$t(e)}(t);let u=oe(a||o?a+" "+o+" { "+p+" }":p);return e.namespace&&(u=At(u,e.namespace)),l=[],te(u,s),l},p=e;var u,d,m;let h=Le;for(let e=0;e<t.length;e++)t[e].name||ve(15),h=Pe(h,t[e].name);return(null==p?void 0:p.namespace)&&(h=Pe(h,p.namespace)),(null==p?void 0:p.prefix)&&(h=Pe(h,"p")),c.hash=h!==Le?h.toString():"",c}(),Ht=u().createContext({shouldForwardProp:void 0,styleSheet:Bt,stylis:Ot,stylisPlugins:void 0});Ht.Consumer;const jt=u().createContext(void 0);jt.Consumer;const zt=Object.prototype.hasOwnProperty,Gt={};function Wt(e,t){const i="string"!=typeof e?"sc":Fe(e);Gt[i]=(Gt[i]||0)+1;const r=i+"-"+function(e){return Ne(Ve(e)>>>0)}(me+i+Gt[i]);return t?t+"-"+r:r}function Zt(e,t,i){const r=Xe(e),n=e,o=!Me(e),{attrs:a=ye,componentId:l=Wt(t.displayName,t.parentComponentId),displayName:s=$e(e)}=t,c=t.displayName&&t.componentId?Fe(t.displayName)+"-"+t.componentId:t.componentId||l,d=r&&n.attrs?n.attrs.concat(a).filter(Boolean):a;let{shouldForwardProp:m}=t;if(r&&n.shouldForwardProp){const e=n.shouldForwardProp;if(t.shouldForwardProp){const i=t.shouldForwardProp;m=(t,r)=>e(t,r)&&i(t,r)}else m=e}const h=new Lt(i,c,r?n.componentStyle:void 0);function f(e,t){return function(e,t,i){const{attrs:r,componentStyle:n,defaultProps:o,foldedComponentIds:a,styledComponentId:l,target:s}=e,c=u().useContext(jt),d=u().useContext(Ht),m=e.shouldForwardProp||d.shouldForwardProp,h=function(e,t,i=ke){return e.theme!==i.theme&&e.theme||t||i.theme}(t,c,o)||ke;let f,g;{const e=u().useRef(null),i=e.current;if(null!==i&&i[1]===h&&i[2]===d.styleSheet&&i[3]===d.stylis&&i[7]===n&&function(e,t,i){const r=e,n=t;let o=0;for(const e in n)if(zt.call(n,e)&&(o++,r[e]!==n[e]))return!1;return o===i}(i[0],t,i[4]))f=i[5],g=i[6];else{f=function(e,t,i){const r=Object.assign(Object.assign({},t),{className:void 0,theme:i}),n=e.length>1;for(let i=0;i<e.length;i++){const o=e[i],a=Ke(o)?o(n?Object.assign({},r):r):o;for(const e in a)"className"===e?r.className=et(r.className,a[e]):"style"===e?r.style=Object.assign(Object.assign({},r.style),a[e]):e in t&&void 0===t[e]||(r[e]=a[e])}return"className"in t&&"string"==typeof t.className&&(r.className=et(r.className,t.className)),r}(r,t,h),g=function(e,t,i,r){return e.generateAndInjectStyles(t,i,r)}(n,f,d.styleSheet,d.stylis);let i=0;for(const e in t)zt.call(t,e)&&i++;e.current=[t,h,d.styleSheet,d.stylis,i,f,g,n]}}const b=f.as||s,v=function(e,t,i,r){const n={};for(const o in e)void 0===e[o]||"$"===o[0]||"as"===o||"theme"===o&&e.theme===i||("forwardedAs"===o?n.as=e.forwardedAs:r&&!r(o,t)||(n[o]=e[o]));return n}(f,b,h,m);let E=et(a,l);return g&&(E+=" "+g),f.className&&(E+=" "+f.className),v[Me(b)&&b.includes("-")?"class":"className"]=E,i&&(v.ref=i),(0,p.createElement)(b,v)}(g,e,t)}f.displayName=s;let g=u().forwardRef(f);return g.attrs=d,g.componentStyle=h,g.displayName=s,g.shouldForwardProp=m,g.foldedComponentIds=r?et(n.foldedComponentIds,n.styledComponentId):"",g.styledComponentId=c,g.target=r?n.target:e,Object.defineProperty(g,"defaultProps",{get(){return this._foldedDefaultProps},set(e){this._foldedDefaultProps=r?function(e,...t){for(const i of t)rt(e,i,!0);return e}({},n.defaultProps,e):e}}),nt(g,()=>`.${g.styledComponentId}`),o&&Qe(g,e,{attrs:!0,componentStyle:!0,displayName:!0,foldedComponentIds:!0,shouldForwardProp:!0,styledComponentId:!0,target:!0}),g}var qt=new Set(["a","abbr","address","area","article","aside","audio","b","bdi","bdo","blockquote","body","button","br","canvas","caption","cite","code","col","colgroup","data","datalist","dd","del","details","dfn","dialog","div","dl","dt","em","embed","fieldset","figcaption","figure","footer","form","h1","h2","h3","h4","h5","h6","header","hgroup","hr","html","i","iframe","img","input","ins","kbd","label","legend","li","main","map","mark","menu","meter","nav","object","ol","optgroup","option","output","p","picture","pre","progress","q","rp","rt","ruby","s","samp","search","section","select","slot","small","span","strong","sub","summary","sup","table","tbody","td","template","textarea","tfoot","th","thead","time","tr","u","ul","var","video","wbr","circle","clipPath","defs","ellipse","feBlend","feColorMatrix","feComponentTransfer","feComposite","feConvolveMatrix","feDiffuseLighting","feDisplacementMap","feDistantLight","feDropShadow","feFlood","feFuncA","feFuncB","feFuncG","feFuncR","feGaussianBlur","feImage","feMerge","feMergeNode","feMorphology","feOffset","fePointLight","feSpecularLighting","feSpotLight","feTile","feTurbulence","filter","foreignObject","g","image","line","linearGradient","marker","mask","path","pattern","polygon","polyline","radialGradient","rect","stop","svg","switch","symbol","text","textPath","tspan","use"]);function Jt(e,t){const i=[e[0]];for(let r=0,n=t.length;r<n;r+=1)i.push(t[r],e[r+1]);return i}const Ut=e=>(Ct.add(e),e);function Yt(e,t,i=ke){if(!t)throw ve(1,t);const r=(r,...n)=>e(t,i,function(e,...t){if(Ke(e)||it(e))return Ut(Dt(Jt(ye,[e,...t])));const i=e;return 0===t.length&&1===i.length&&"string"==typeof i[0]?Dt(i):Ut(Dt(Jt(i,t)))}(r,...n));return r.attrs=r=>Yt(e,t,Object.assign(Object.assign({},i),{attrs:Array.prototype.concat(i.attrs,r).filter(Boolean)})),r.withConfig=r=>Yt(e,t,Object.assign(Object.assign({},i),r)),r}const Qt=e=>Yt(Zt,e),Kt=Qt;qt.forEach(e=>{Kt[e]=Qt(e)});const Xt=Kt.div`
    display: flex;
    gap: 16px;
`,ei=Kt.div`
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
`,ti=Kt.div`
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
`;var ii=({icon:e,title:t,description:i,...r})=>React.createElement(Xt,r,e&&React.createElement(ei,null,React.createElement("span",{className:"icon-box-icon"},e)),React.createElement(ti,null,t&&React.createElement("span",{className:"icon-box-title"},t),i&&React.createElement("span",{className:"icon-box-description"},i)));const ri=Kt.div`
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
`,ni=Kt.div``,oi=Kt.div`
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
`,ai=Kt.div`
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
`,li=Kt.div`
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
`;var si=({options:e,onChange:t,selected:i})=>React.createElement(ri,null,e.map(e=>{const{id:r,image:n,title:o,description:a}=e;return React.createElement(ni,{key:r},React.createElement(oi,{onClick:()=>t(r),isActive:i&&i===r},React.createElement(ai,null,n),React.createElement(li,null,React.createElement("span",{className:"import-option-title"},o),React.createElement("span",{className:"import-option-description"},a))))}));const ci=Kt.button`
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
`,pi=Kt.span`
    display: inline-flex;
    align-items: center;
    font-size: 24px;
    svg{
        width: 1em;
        height: 1em;
    }
`;var ui=({label:e,children:t,prevIcon:i,nextIcon:r,...n})=>React.createElement(ci,n,i&&React.createElement(pi,null,i),t||e,r&&React.createElement(pi,null,r)),di=window.wp.components;const mi=Kt.div.attrs(({hasDismissButton:e,status:t,...i})=>i)`
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

    ${e=>e?.hasDismissButton&&"\n        padding-right: 36px;\n    "}

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
`,hi=Kt.span`
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
`,fi=Kt.button`
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
`;var gi=({status:e,title:i,message:r,onDismiss:n})=>{const o=(0,t.useRef)(null);return React.createElement(mi,{ref:o,status:e,hasDismissButton:n},React.createElement("span",{className:"notification-icon"},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M9.99979 7.50019V10.8335M9.99979 14.1669H10.0081M8.84589 3.24329L1.99182 15.0821C1.61165 15.7388 1.42156 16.0671 1.44966 16.3366C1.47416 16.5716 1.5973 16.7852 1.78844 16.9242C2.00757 17.0835 2.38695 17.0835 3.14572 17.0835H16.8539C17.6126 17.0835 17.992 17.0835 18.2111 16.9242C18.4023 16.7852 18.5254 16.5716 18.5499 16.3366C18.578 16.0671 18.3879 15.7388 18.0078 15.0821L11.1537 3.24329C10.7749 2.58899 10.5855 2.26184 10.3384 2.15196C10.1228 2.05612 9.87676 2.05612 9.66121 2.15196C9.4141 2.26184 9.2247 2.58899 8.84589 3.24329Z",stroke:"currentColor",strokeWidth:"1.66667",strokeLinecap:"round",strokeLinejoin:"round"}))),React.createElement("span",{className:"notification-msg"},i&&React.createElement(hi,null,i),r||React.createElement(di.Spinner,{style:{color:"var(--primary-color)"}})),n&&React.createElement(fi,{type:"button",onClick:()=>{o.current.style.opacity="0",setTimeout(()=>{n(!1)},300)}},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M15 5L5 15M5 5L15 15",stroke:"currentColor",strokeWidth:"1.66667",strokeLinecap:"round",strokeLinejoin:"round"}))))};const bi=Kt.div`
    max-width: 1000px;
    width: 100%;
    margin: 0 auto;
    padding: 0 15px;
`;var vi=({children:e})=>React.createElement(bi,null,e);const Ei=Kt.ul`
    display: flex;
    justify-content: space-between;
    position: relative;
    list-style: none;
    padding: 0;
    margin: 0 0 32px;
    z-index: 1;
`,Ci=Kt.li`
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
`,Ri=Kt.span`
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
        mask: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fillRule='evenodd' clipRule='evenodd' d='M12 21.5998C17.302 21.5998 21.6 17.3017 21.6 11.9998C21.6 6.69787 17.302 2.3998 12 2.3998C6.69812 2.3998 2.40005 6.69787 2.40005 11.9998C2.40005 17.3017 6.69812 21.5998 12 21.5998ZM12 23.1998C18.1856 23.1998 23.2 18.1854 23.2 11.9998C23.2 5.81422 18.1856 0.799805 12 0.799805C5.81446 0.799805 0.800049 5.81422 0.800049 11.9998C0.800049 18.1854 5.81446 23.1998 12 23.1998Z' fill='%232DB68D'/%3E%3Cpath d='M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z' fill='%232DB68D'/%3E%3C/svg%3E");
        -webkit-mask: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fillRule='evenodd' clipRule='evenodd' d='M12 21.5998C17.302 21.5998 21.6 17.3017 21.6 11.9998C21.6 6.69787 17.302 2.3998 12 2.3998C6.69812 2.3998 2.40005 6.69787 2.40005 11.9998C2.40005 17.3017 6.69812 21.5998 12 21.5998ZM12 23.1998C18.1856 23.1998 23.2 18.1854 23.2 11.9998C23.2 5.81422 18.1856 0.799805 12 0.799805C5.81446 0.799805 0.800049 5.81422 0.800049 11.9998C0.800049 18.1854 5.81446 23.1998 12 23.1998Z' fill='%232DB68D'/%3E%3Cpath d='M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z' fill='%232DB68D'/%3E%3C/svg%3E");
        mask-repeat: no-repeat;
        -webkit-mask-repeat: no-repeat;
        mask-size: 100%;
        -webkit-mask-size: 100%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        ${e=>e.completed&&"\n            mask: url(\"data:image/svg+xml,%3Csvg width='17' height='15' viewBox='0 0 17 15' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fillRule='evenodd' clipRule='evenodd' d='M14.7951 0.85322L5.24843 10.0666L2.71509 7.35989C2.24843 6.91989 1.51509 6.89322 0.981761 7.26655C0.461761 7.65322 0.315094 8.33322 0.635094 8.87989L3.63509 13.7599C3.92843 14.2132 4.43509 14.4932 5.00843 14.4932C5.55509 14.4932 6.07509 14.2132 6.36843 13.7599C6.84843 13.1332 16.0084 2.21322 16.0084 2.21322C17.2084 0.986553 15.7551 -0.0934461 14.7951 0.839887V0.85322Z' fill='white'/%3E%3C/svg%3E%0A\");\n            -webkit-mask: url(\"data:image/svg+xml,%3Csvg width='17' height='15' viewBox='0 0 17 15' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fillRule='evenodd' clipRule='evenodd' d='M14.7951 0.85322L5.24843 10.0666L2.71509 7.35989C2.24843 6.91989 1.51509 6.89322 0.981761 7.26655C0.461761 7.65322 0.315094 8.33322 0.635094 8.87989L3.63509 13.7599C3.92843 14.2132 4.43509 14.4932 5.00843 14.4932C5.55509 14.4932 6.07509 14.2132 6.36843 13.7599C6.84843 13.1332 16.0084 2.21322 16.0084 2.21322C17.2084 0.986553 15.7551 -0.0934461 14.7951 0.839887V0.85322Z' fill='white'/%3E%3C/svg%3E%0A\");\n            mask-repeat: no-repeat;\n            -webkit-mask-repeat: no-repeat;\n            mask-size: 16px 16px;\n            -webkit-mask-size: 16px 16px;\n            mask-position: center;\n            -webkit-mask-position: center;\n        "}
    }
    ${e=>e.current&&"\n        background-color: #2DB68D2E;\n        color: #2DB68D;\n    "}
    ${e=>e.completed&&"\n        background-color: #2DB68D;\n        color: #ffffff;\n    "}
`,xi=Kt.div`
    padding: 32px 0;
    background-color: #f0f0f1;
    position: sticky;
    bottom: 0;
    z-index: 11;
    > div{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
`,_i=Kt.div`
    display: flex;
    flex-direction: column;
    gap: 32px;
    .import-recipe-image{
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
    }
`;var wi=({steps:e=[]})=>{const{globalState:r,setGlobalState:n,globalState:{recipesToImport:a,pns:l}}=o(),[s,c]=(0,t.useState)({current:0,completed:[]}),p=(0,t.useRef)(null),d=()=>{p.current.style.cssText="opacity: 0; transform: translateY(20px)",setTimeout(()=>{p.current.style.cssText="opacity: 1; transform: translateY(0px);transition: all .3s ease;"},30)},m=()=>e[s.current].component;return u().createElement("div",null,u().createElement(vi,null,u().createElement(Ei,null,e.map(({id:e,label:t},i)=>{const r=s?.current===i,n=s?.completed.includes(i);return u().createElement(Ci,{current:r||n},u().createElement(Ri,{current:r,completed:n}),t)})),u().createElement(_i,{ref:p},u().createElement(m,null))),s.current<e.length-1&&u().createElement(xi,null,u().createElement(vi,null,u().createElement(ui,{variant:"ghost",prevIcon:u().createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},u().createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"})),onClick:()=>{0!==s.current?(c({...s,current:s.current-1,completed:s.completed.filter(e=>e!==s.current-1)}),d()):n({...r,importStart:!1})}},(0,i.__)("Back","delicious-recipes")),u().createElement(ui,{onClick:()=>{s.current!==e.length-1&&(c({...s,current:s.current+1,completed:[...s.completed,s.current]}),d(),n({...r,pns:s.current+1!==e.length-1}))},disabled:!a.length>0,label:(0,i.__)("Proceed to Next Step","delicious-recipes")}))))};const yi=Kt.div`
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
`,ki=Kt.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
    position: sticky;
    top: 0;
    background-color: #fff;
`,Si=Kt.table`
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
`,Ti=Kt.header`
    margin: 0;
    padding: 20px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-size: 14px;
    border-bottom: 1px solid #EDEEEE;
`,Fi=Kt.footer`
    margin: 0;
    padding: 16px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-size: 14px;
    border-top: 1px solid #EDEEEE;
`,Ii=Kt.div`
    label{
        margin: 0;
        display: flex;
        align-items: center;
        font-size: inherit;
        gap: 16px;
    }
`,Di=Kt.div`
    input[type="search"]{
        padding: 8px 16px 8px 44px;
        font-size: 16px;
        line-height: 1.5;
        border: 1px solid #EDEEEE;
        box-shadow: 0px 1px 2px 0px #1018280D;
        border-radius: 4px;
        background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M17.5 17.5L14.5834 14.5833M16.6667 9.58333C16.6667 13.4954 13.4954 16.6667 9.58333 16.6667C5.67132 16.6667 2.5 13.4954 2.5 9.58333C2.5 5.67132 5.67132 2.5 9.58333 2.5C13.4954 2.5 16.6667 5.67132 16.6667 9.58333Z' stroke='%23505556' strokeWidth='1.66667' strokeLinecap='round' strokeLinejoin='round'/%3E%3C/svg%3E%0A");
        background-repeat: no-repeat;
        background-size: 20px;
        background-position: left 16px center;
    }
`,Ni=Kt.div`
    font-weight: 500;
`,Li=Kt.div`
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
`,Pi=({children:e,...t})=>React.createElement(Si,t,e);Pi.Header=({children:e})=>React.createElement(Ti,null,e),Pi.Footer=({children:e})=>React.createElement(Fi,null,e),Pi.Length=({value:e,onChange:t})=>{const r=[{value:10,label:(0,i.__)("10","delicious-recipes")},{value:25,label:(0,i.__)("25","delicious-recipes")},{value:50,label:(0,i.__)("50","delicious-recipes")},{value:100,label:(0,i.__)("100","delicious-recipes")},{value:"show-all",label:(0,i.__)("Show All","delicious-recipes")}];return React.createElement(Ii,null,React.createElement("label",null,(0,i.__)("Show","delicious-recipes"),React.createElement("select",{onChange:e=>t(e.target.value),value:e,name:"table-length",id:"table-length"},r.map(({value:e,label:t})=>React.createElement("option",{key:`table_length_${e}`,value:e},t))),(0,i.__)("Entries","delicious-recipes")))},Pi.Filter=({value:e,onChange:t})=>React.createElement(Di,null,React.createElement("label",{htmlFor:"table-filter"},React.createElement("input",{type:"search",name:"import-filter",onChange:e=>t(e),value:e,id:"table-filter",placeholder:"Search"}))),Pi.Info=({length:e,total:t,currentPage:r})=>{if("show-all"===(e=0===t?"show-all":e))return React.createElement(Ni,null,(0,i.__)("Showing","delicious-recipes")," ",t," ",(0,i.__)("entries","delicious-recipes"));const n=(r-1)*e+1,o=Math.min(r*e,t);return React.createElement(Ni,null,(0,i.__)("Showing","delicious-recipes")," ",n," ",(0,i.__)("-","delicious-recipes")," ",o," ",(0,i.__)("of","delicious-recipes")," ",t," ",(0,i.__)("entries","delicious-recipes"))},Pi.Title=({children:e})=>React.createElement(ki,null,e),Pi.Paginate=({length:e,total:t,currentPage:i,setCurrentPage:r})=>{if(0===t)return;if("show-all"===e)return;const n=Math.ceil(t/e),o=Array.from({length:n},(e,t)=>t+1),a=Math.ceil(n/2);let l=!1,s=!1;return React.createElement(Li,null,React.createElement("ul",null,React.createElement("li",null,React.createElement("a",{href:"#",className:1===i?"disabled":"",onClick:()=>1!==i&&r(i-1)},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",null,React.createElement("path",{d:"M15.8334 9.99984H4.16675M4.16675 9.99984L10.0001 15.8332M4.16675 9.99984L10.0001 4.1665",stroke:"currentColor",strokeWidth:"1.67",strokeLinecap:"round",strokeLinejoin:"round"}))))),n>5?o.map((e,t)=>{if(i<a){if((1===i?i+1:i)===e||(2===i?i+1:1)===e||n-1===e||n===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===i?"current":"",onClick:()=>r(e)},e));if(!l&&e>i+1&&e<n-1)return l=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}else if(i>a){if((i===n?i-1:i)===e||(i===n-1?i-1:n)===e||1===e||2===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===i?"current":"",onClick:()=>r(e)},e));if(!s&&(3===e||e<i-1))return s=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}else if(i===a){if(i===e||i-1===e||i+1===e||1===e||n===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===i?"current":"",onClick:()=>r(e)},e));if(!l&&e<i-1)return l=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."));if(!s&&e>i+1&&e<n)return s=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}}):o.map((e,t)=>React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===i?"current":"",onClick:()=>r(e)},e))),React.createElement("li",null,React.createElement("a",{href:"#",className:i===n?"disabled":"",onClick:()=>i!==n&&r(i+1)},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M4.16675 9.99984H15.8334M15.8334 9.99984L10.0001 4.1665M15.8334 9.99984L10.0001 15.8332",stroke:"currentColor",strokeWidth:"1.67",strokeLinecap:"round",strokeLinejoin:"round"}))))))},Pi.Container=({children:e,...t})=>React.createElement(yi,t,e),Pi.THead=({children:e,rest:t})=>React.createElement("thead",t,e),Pi.TBody=({children:e,...t})=>React.createElement("tbody",t,e),Pi.TFoot=({children:e,...t})=>React.createElement("tfoot",t,e),Pi.Tr=({items:e,children:t,...i})=>e?e.map(e=>React.createElement("tr",i,e)):React.createElement("tr",i,t),Pi.Th=({items:e,children:t,...i})=>e?e.map(e=>React.createElement("th",i,e)):React.createElement("th",i,t),Pi.Td=({items:e,children:t,...i})=>e?e.map(e=>React.createElement("td",i,e)):React.createElement("td",i,t);var Vi=Pi;function Mi(){return Mi=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var i=arguments[t];for(var r in i)({}).hasOwnProperty.call(i,r)&&(e[r]=i[r])}return e},Mi.apply(null,arguments)}const $i=Kt.div`
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
                ${e=>e.bulk?"\n                    content: url(\"data:image/svg+xml,%3Csvg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M2.91663 7H11.0833' stroke='%232DB68D' strokeWidth='2' strokeLinecap='round' strokeLinejoin='round'/%3E%3C/svg%3E%0A\");\n                ":"\n                    content: url(\"data:image/svg+xml,%3Csvg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11.6667 3.5L5.25004 9.91667L2.33337 7' stroke='%232DB68D' strokeWidth='2' strokeLinecap='round' strokeLinejoin='round'/%3E%3C/svg%3E%0A\");\n                "}
            }
        }
    }
`,Ai=e=>React.createElement($i,{bulk:e?.bulk},React.createElement("input",Mi({type:"checkbox"},e)));Ai.Bulk=e=>React.createElement(Ai,Mi({bulk:!0},e));var Bi=Ai,Oi=()=>{const{globalState:e,setGlobalState:r,globalState:{recipes:n,selectedOption:a,recipeCount:l,recipesToList:s,list:c,currentPage:p,recipesToImport:u,deleteRecipes:d}}=o(),[m,h]=(0,t.useState)({selectedRecipes:u,localInput:"",debouncedInput:"",filteredRecipes:s,filteredRecipeList:c,filteredRecipeCount:l}),{selectedRecipes:f,localInput:g,debouncedInput:b,filteredRecipes:v,filteredRecipeList:E,filteredRecipeCount:C}=m;let R="";return"cooked"===a?R="Cooked":"wp-recipe-maker"===a&&(R="WP Recipe Maker"),(0,t.useEffect)(()=>{const e=setTimeout(()=>{h({...m,debouncedInput:g})},500);return()=>{clearTimeout(e)}},[g]),(0,t.useEffect)(()=>{let e=s,t=c,i=l;b&&(e=n.filter(e=>e.post_title.toLowerCase().includes(b.toLowerCase())),t=e.length>0||g.length>0?"show-all":c,i=e.length>0?e.length:g.length>0?0:i),h({...m,filteredRecipes:e,filteredRecipeList:t,filteredRecipeCount:i})},[b]),React.createElement(React.Fragment,null,React.createElement(Vi.Container,null,React.createElement(Vi.Header,null,React.createElement(Vi.Length,{value:E,onChange:t=>{h({...m,filteredRecipeList:t,filteredRecipes:"show-all"===t?n:n.slice(0,t)}),r({...e,currentPage:1,list:t,recipesToList:"show-all"===t?n:n.slice(0,t),recipesToImport:[]})}}),React.createElement(Vi.Filter,{value:g,onChange:e=>{h({...m,localInput:e.target.value})}})),React.createElement(Vi,{striped:!0,bordered:!0},React.createElement(Vi.THead,null,React.createElement(Vi.Tr,null,React.createElement(Vi.Th,null,React.createElement(Bi.Bulk,{checked:u.length===v.length,onChange:t=>{r({...e,recipesToImport:t.target.checked?v.map(e=>({id:e.ID,post_title:e.post_title,thumbnail_url:e.thumbnail_url,author:e.author,post_date:e.post_date,post_status:e.post_status})):[]})}})),React.createElement(Vi.Th,{style:{width:"135px"}},(0,i.__)("Featured Image")),React.createElement(Vi.Th,null,(0,i.__)("Recipe Title")),React.createElement(Vi.Th,null,(0,i.__)("Author")),React.createElement(Vi.Th,null,(0,i.__)("Date Published")))),React.createElement(Vi.TBody,null,""!==g&&0===v.length&&React.createElement(Vi.Tr,null,React.createElement(Vi.Td,{colSpan:"5"},React.createElement(gi,{status:"error",message:(0,i.__)("No recipes found.","delicious-recipes")}))),f?.map((t,i)=>{const o=n.find(e=>e.ID===t.id);return React.createElement(Vi.Tr,{key:i},React.createElement(Vi.Td,null,React.createElement(Bi,{checked:f.some(e=>e.id===o.ID),onChange:t=>{r({...e,recipesToImport:t.target.checked?[...f,{id:o.ID,post_title:o.post_title,thumbnail_url:o.thumbnail_url,author:o.author,post_date:o.post_date,post_status:o.post_status}]:f.filter(e=>e.id!==o.ID)})}})),React.createElement(Vi.Td,null,o.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:o.thumbnail_url,alt:o.post_title})),React.createElement(Vi.Td,null,React.createElement("strong",null,o.post_title),"publish"!==o.post_status&&React.createElement("span",{className:" wpd-ml-1 dr-badge"},o.post_status)),React.createElement(Vi.Td,null,o.author),React.createElement(Vi.Td,null,o.post_date))}),f.length>0&&React.createElement(Vi.Tr,null,React.createElement(Vi.Td,{colSpan:"5"},React.createElement(gi,{message:(0,i.__)("Selected recipes listed above.","delicious-recipes")}))),v?.filter(e=>!f.some(t=>t.id===e.ID)).map((t,i)=>React.createElement(Vi.Tr,{key:i},React.createElement(Vi.Td,null,React.createElement(Bi,{checked:u.some(e=>e.id===t.ID),onChange:i=>{r({...e,recipesToImport:i.target.checked?[...u,{id:t.ID,post_title:t.post_title,thumbnail_url:t.thumbnail_url,author:t.author,post_date:t.post_date,post_status:t.post_status}]:u.filter(e=>e.id!==t.ID)})}})),React.createElement(Vi.Td,null,t.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:t.thumbnail_url,alt:t.post_title})),React.createElement(Vi.Td,null,React.createElement("strong",null,t.post_title),"publish"!==t.post_status&&React.createElement("span",{className:" wpd-ml-1 dr-badge"},t.post_status)),React.createElement(Vi.Td,null,t.author),React.createElement(Vi.Td,null,t.post_date))))),React.createElement(Vi.Footer,null,React.createElement(Vi.Info,{length:E,total:C,currentPage:p}),React.createElement(Vi.Paginate,{length:E,total:C,currentPage:p,setCurrentPage:t=>{r({...e,currentPage:t,recipesToImport:[],recipesToList:n.slice((t-1)*E,t*E)})}}))),React.createElement("label",null,React.createElement(Bi,{checked:d,onChange:t=>{r({...e,deleteRecipes:!!t.target.checked})}}),(0,i.__)("Delete the recipes from ","delicious-recipes"),React.createElement("strong",null,R),(0,i.__)(" after a successful import.","delicious-recipes")))},Hi=({children:e,onClick:t,label:i,description:r,small:n})=>{const o=n?" small":"";return React.createElement("div",{className:`wpdelicious-dropzone-container${o}`},React.createElement("div",{className:"wpdelicious-dropzone",onClick:t},React.createElement("span",{className:"upload-icon"},React.createElement("svg",{width:"36",height:"36",viewBox:"0 0 36 36",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M11.9999 24L17.9999 18M17.9999 18L23.9999 24M17.9999 18V31.5M29.9999 25.1143C31.8322 23.6011 32.9999 21.3119 32.9999 18.75C32.9999 14.1937 29.3063 10.5 24.7499 10.5C24.4222 10.5 24.1155 10.329 23.9491 10.0466C21.993 6.72725 18.3816 4.5 14.2499 4.5C8.03674 4.5 2.99994 9.5368 2.99994 15.75C2.99994 18.8492 4.25311 21.6556 6.28036 23.6903",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))),i&&React.createElement("label",null,i),!n&&r&&React.createElement("span",{className:"wpdelicious-supported-files"},r)),e)};const ji=Kt.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
`,zi=Kt.div`
    height: 1px;
    border-bottom: 1px solid #E5EEEE;
`,Gi=Kt.div`
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    button {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }
`,Wi=Kt.button`
    cursor: pointer;
    &:hover {
        svg {
            path {
                stroke: #FF0000;
            }
        }
    }
`;var Zi=({})=>{const{globalState:e,setGlobalState:t,globalState:{recipes:r,importCSVFileName:n,importCSVFileURL:a,importCSVFileSize:s,deleteCSV:p}}=o(),u=function(){var i=l(function*(i){const r=yield c()({path:`/deliciousrecipe/v1/get_csv_data?file=${i.id}`});let n=r?.data?.recipes;t({...e,recipes:n,recipesToImport:n,importCSVFileID:i.id,importCSVFileName:i.filename,importCSVFileURL:i.url,importCSVFileSize:i.filesizeHumanReadable,CSVFileHeaders:r?.data?.headers})});return function(_x){return i.apply(this,arguments)}}();return React.createElement(React.Fragment,null,React.createElement(pr,null,React.createElement(ji,null,(0,i.__)("CSV File Upload")),React.createElement("a",{href:"https://wpdelicious.com/docs/import-recipes-from-csv-file/",target:"_blank",rel:"noreferrer",download:!0},(0,i.__)("Learn how to format your CSV file for import.","delicious-recipes")),React.createElement(Hi,{onClick:()=>{return t=["text/csv"],e&&e.close(),(e=wp.media.frames.file_frame=wp.media({title:(0,i.__)("Choose CSV File","delicious-recipes"),button:{text:(0,i.__)("Add CSV File","delicious-recipes")},library:{type:t},multiple:!1})).on("select",function(){e.state().get("selection").map(function(e,r){e=e.toJSON(),-1!==t.indexOf(e.mime)?u(e):alert((0,i.__)("Please select a valid CSV file.","delicious-recipes"))})}),void e.open();var e,t},label:(0,i.__)("Choose File to upload"),description:(0,i.__)("Supported file types .csv")}),React.createElement(zi,null),a?React.createElement(React.Fragment,null,React.createElement(Gi,null,React.createElement(ii,{icon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 16 16",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M9.33329 1.51265V4.26634C9.33329 4.63971 9.33329 4.82639 9.40595 4.969C9.46987 5.09444 9.57186 5.19643 9.6973 5.26035C9.83991 5.33301 10.0266 5.33301 10.4 5.33301H13.1537M13.3333 6.65849V11.4663C13.3333 12.5864 13.3333 13.1465 13.1153 13.5743C12.9236 13.9506 12.6176 14.2566 12.2413 14.4484C11.8134 14.6663 11.2534 14.6663 10.1333 14.6663H5.86663C4.74652 14.6663 4.18647 14.6663 3.75864 14.4484C3.38232 14.2566 3.07636 13.9506 2.88461 13.5743C2.66663 13.1465 2.66663 12.5864 2.66663 11.4663V4.53301C2.66663 3.4129 2.66663 2.85285 2.88461 2.42503C3.07636 2.0487 3.38232 1.74274 3.75864 1.55099C4.18647 1.33301 4.74652 1.33301 5.86663 1.33301H8.00781C8.49699 1.33301 8.74158 1.33301 8.97176 1.38827C9.17583 1.43726 9.37092 1.51807 9.54986 1.62773C9.7517 1.75141 9.92465 1.92436 10.2706 2.27027L12.396 4.39575C12.7419 4.74165 12.9149 4.9146 13.0386 5.11644C13.1482 5.29538 13.229 5.49047 13.278 5.69454C13.3333 5.92472 13.3333 6.16931 13.3333 6.65849Z",stroke:"#2DB68D",strokeWidth:"1.33333",strokeLinecap:"round",strokeLinejoin:"round"})),title:`${n}`,description:s}),React.createElement(Wi,{type:"button",onClick:()=>{t({...e,recipes:[],recipesToImport:[],importCSVFileID:null,importCSVFileName:null,importCSVFileURL:null,importCSVFileSize:null,CSVFileHeaders:[]})}},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",{opacity:"0.5"},React.createElement("path",{d:"M13.3333 5.00033V4.33366C13.3333 3.40024 13.3333 2.93353 13.1517 2.57701C12.9919 2.2634 12.7369 2.00844 12.4233 1.84865C12.0668 1.66699 11.6001 1.66699 10.6667 1.66699H9.33333C8.39991 1.66699 7.9332 1.66699 7.57668 1.84865C7.26308 2.00844 7.00811 2.2634 6.84832 2.57701C6.66667 2.93353 6.66667 3.40024 6.66667 4.33366V5.00033M8.33333 9.58366V13.7503M11.6667 9.58366V13.7503M2.5 5.00033H17.5M15.8333 5.00033V14.3337C15.8333 15.7338 15.8333 16.4339 15.5608 16.9686C15.3212 17.439 14.9387 17.8215 14.4683 18.0612C13.9335 18.3337 13.2335 18.3337 11.8333 18.3337H8.16667C6.76654 18.3337 6.06647 18.3337 5.53169 18.0612C5.06129 17.8215 4.67883 17.439 4.43915 16.9686C4.16667 16.4339 4.16667 15.7338 4.16667 14.3337V5.00033",stroke:"#505556",strokeWidth:"1.66667",strokeLinecap:"round",strokeLinejoin:"round"}))))),r?.length>0&&React.createElement(gi,{status:"success",message:(0,i.__)(`File processed successfully. ${r.length} recipes found.`)})):React.createElement(gi,{status:"warning",message:(0,i.__)("Please upload or choose CSV file to proceed with the import.","delicious-recipes")})),React.createElement("label",null,React.createElement(Bi,{checked:p,onChange:i=>{t({...e,deleteCSV:!!i.target.checked})}}),(0,i.__)("Delete the CSV file after a successful import.","delicious-recipes")))},qi=()=>{const{globalState:e,setGlobalState:t,recipe_metadata:r,wpd_fields:n,globalState:{recipeFields:a,importPluginFields:l,CSVFileHeaders:s,CSVFields:c,isCSV:p}}=o();return React.createElement(Vi.Container,null,React.createElement(Vi.Header,null,React.createElement(Vi.Title,null,(0,i.__)("Map Recipes Fields","delicious-recipes"))),React.createElement(Vi,{striped:!0,bordered:!0},React.createElement(Vi.THead,null,React.createElement(Vi.Tr,null,React.createElement(Vi.Th,null,(0,i.__)("Plugin Fields","delicious-recipes")),React.createElement(Vi.Th,null,(0,i.__)("Map With","delicious-recipes")))),React.createElement(Vi.TBody,null,Object.keys(n)?.map((r,o)=>React.createElement(Vi.Tr,{key:o},React.createElement(Vi.Td,null,React.createElement("strong",null,n[r])),React.createElement(Vi.Td,null,React.createElement("select",{value:a[r]?a[r]:"",onChange:i=>{let o={...a};"recipe_keywords"===n[r]?o[r]={type:"keywords",value:""===i.target.value?"":i.target.value}:o[r]=""===i.target.value?"":i.target.value,t({...e,recipeFields:o})}},React.createElement("option",{value:""},(0,i.__)("Select Field","delicious-recipes")),(p?s:l)?.map((e,t)=>React.createElement("option",{key:t,value:e},e))))))),p&&React.createElement(React.Fragment,null,React.createElement(Vi.THead,null,React.createElement(Vi.Tr,null,React.createElement(Vi.Th,null,(0,i.__)("CSV Fields","delicious-recipes")),React.createElement(Vi.Th,null,(0,i.__)("Map With","delicious-recipes")))),React.createElement(Vi.TBody,null,Object.keys(r)?.map((n,o)=>React.createElement(Vi.Tr,{key:o},React.createElement(Vi.Td,null,React.createElement("strong",null,r[n].label)),React.createElement(Vi.Td,null,React.createElement("select",{value:c[n]?c[n]:"",onChange:i=>{let r={...c};r[n]=""===i.target.value?"":i.target.value,t({...e,CSVFields:r})}},React.createElement("option",{value:""},(0,i.__)("Select Field","delicious-recipes")),s?.map((e,t)=>React.createElement("option",{key:t,value:e},e))))))))))};const Ji=Kt.div`
    padding: 24px;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 24px;
    ${e=>e.starter&&"\n        padding: 32px;\n    "}
`,Ui=Kt.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
`,Yi=Kt.div`
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
`;var Qi=()=>{const{globalState:{recipes:e,recipeFields:r,recipesToImport:n},wpd_fields:a}=o(),[l,s]=(0,t.useState)(!1);return React.createElement(Ji,null,React.createElement(Ui,null,(0,i.__)("Recipes to Import")),React.createElement(Vi.Container,null,React.createElement(Vi,{bordered:!0,striped:!0},React.createElement(Vi.THead,null,React.createElement(Vi.Tr,null,React.createElement(Vi.Th,null,"Featured Image"),React.createElement(Vi.Th,null,"Recipe Title"))),React.createElement(Vi.TBody,null,n?.slice(0,l?n.length:3).map((t,i)=>{const r=e.find(e=>e.ID===t.id);return React.createElement(Vi.Tr,{key:i},React.createElement(Vi.Td,null,r.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:r.thumbnail_url,alt:r.post_title})),React.createElement(Vi.Td,null,React.createElement("strong",null,r.post_title)))})),n?.length>3&&!l&&React.createElement(Vi.TFoot,null,React.createElement(Vi.Tr,null,React.createElement(Vi.Td,{colSpan:"2",style:{textAlign:"center"}},React.createElement(ui,{label:"View All",variant:"ghost",onClick:()=>{s(!0)},nextIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 9L12 15L18 9",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))})))),l&&React.createElement(Vi.TFoot,null,React.createElement(Vi.Tr,null,React.createElement(Vi.Td,{colSpan:"2",style:{textAlign:"center"}},React.createElement(ui,{label:"View Less",variant:"ghost",onClick:()=>s(!1),nextIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 15L12 9L18 15",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))})))))),React.createElement(Yi,null,React.createElement(Ui,null,(0,i.__)("Fields Mapped:","delicious-recipes")),Object.keys(r)?.map((e,t)=>r[e]?React.createElement("ul",{key:t},React.createElement("li",null,React.createElement("span",{className:"label"},a[e],":"),React.createElement("span",{className:"value"},r[e]))):null)))};const Ki=Kt.div`
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #344054;
`,Xi=Kt.div`
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
`;var er=({progress:e=0})=>(e=Math.floor(e),React.createElement(Ki,null,React.createElement(Xi,null,React.createElement("span",{className:"progressbar-progress",style:{width:`${e}%`}})),e,"%"));const tr=Kt.div`
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
`,ir=Kt.div`
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
`;var rr=({items:e=[]})=>(console.log(e),React.createElement(tr,null,e.map(e=>React.createElement(ir,{status:e.status},e.name))));const nr=Kt.div`
    padding: 32px 24px;
    background-color: #ffffff;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    text-align: center;
    max-width: 576px;
    margin: 0 auto;
`,or=Kt.div`
    margin: 0 0 16px;
    svg{
        width: 69px;
        height: 69px;
        vertical-align: top;
    }
`,ar=Kt.div`
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
`;var lr=({icon:e,title:t,text:i,children:r,...n})=>React.createElement(nr,n,React.createElement(or,null,e),React.createElement(ar,null,React.createElement("h5",null,t),React.createElement("p",null,i)),r),sr=()=>{const{globalState:{recipes:e,selectedOption:r,recipesToImport:n,recipeFields:a,deleteRecipes:s,importCSVFileID:p,CSVFileHeaders:u,CSVFields:d,isCSV:m,deleteCSV:h}}=o(),[f,g]=(0,t.useState)({progress:0,finalImportRecipes:m?[]:n.map(e=>({name:e.post_title,status:"pending"})),importProcessDone:!1,importProcessMessage:""}),b=[],v=[],{progress:E,importProcessDone:C,importProcessMessage:R,finalImportRecipes:x}=f;return Object.keys(a).map((e,t)=>{a[e]&&b.push({to:e,from:a[e]})}),(0,t.useEffect)(()=>{let t=!0;if(m){const i=function(){var i=l(function*(){for(let i=0;i<e.length;i++){const n=yield c()({path:`/deliciousrecipe/v1/import_recipes?selectedOption=${r}`,method:"POST",data:{recipe:JSON.stringify(e[i]),CSVFileHeaders:JSON.stringify(u),CSVFields:JSON.stringify(d),recipeFields:JSON.stringify(b)}});if(!n.status){g({...f,importProcessDone:!0,importProcessMessage:"failure"}),t=!1;break}g(t=>({...t,progress:(i+1)/e.length*100,finalImportRecipes:[...t.finalImportRecipes,{name:n.recipe,status:"success"}]}))}t&&(h?c()({path:`/deliciousrecipe/v1/delete_csv?selectedOption=${r}`,method:"POST",data:{CSV_id:p}}).then(e=>{e.status?g({...f,importProcessDone:!0,importProcessMessage:"success"}):g({...f,importProcessDone:!0,importProcessMessage:"failure"})}):g({...f,importProcessDone:!0,importProcessMessage:"success"}))});return function(){return i.apply(this,arguments)}}();i()}else{c()({path:"/deliciousrecipe/v1/import_recipe_fields",method:"POST",data:{recipe_fields:JSON.stringify(b),selected_option:JSON.stringify(r),posts:JSON.stringify(n)}}).then(t=>{t.status?(v.push(t.data),g({...f,progress:10}),e()):g({...f,importProcessDone:!0,importProcessMessage:"failure"})});const e=function(){var e=l(function*(){for(let e=0;e<n.length;e++){if(!(yield c()({path:`/deliciousrecipe/v1/import_recipes?selectedOption=${r}`,method:"POST",data:{recipe_id:JSON.stringify(n[e].id),imported_fields:JSON.stringify(v)}})).status){g({...f,importProcessDone:!0,importProcessMessage:"failure"}),t=!1;break}g({...f,progress:(e+1)/n.length*100,finalImportRecipes:x.map((t,i)=>i<=e?{...t,status:"success"}:t)})}t&&(s?c()({path:`/deliciousrecipe/v1/delete_recipes?selectedOption=${r}`,method:"POST",data:{recipe_ids:JSON.stringify(n.map(e=>e.id))}}).then(e=>{e.status?g({...f,importProcessDone:!0,importProcessMessage:"success"}):g({...f,importProcessDone:!0,importProcessMessage:"failure"})}):g({...f,importProcessDone:!0,importProcessMessage:"success"}))});return function(){return e.apply(this,arguments)}}()}},[]),React.createElement(vi,null,!C&&React.createElement(pr,null,React.createElement(ii,{icon:React.createElement("svg",{width:"25",height:"25",viewBox:"0 0 25 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M24.6519 2.82855L21.8928 0.301686C21.6981 0.124223 21.3786 0 21.1158 0H5.91263C5.50735 0 5.17996 0.328305 5.17996 0.734497V4.31332H1.27206C0.57095 4.31332 0 4.88514 0 5.58858V8.61777C0 9.32121 0.57095 9.89303 1.27206 9.89303H5.17996V24.265C5.17996 24.6712 5.50735 25 5.91263 25H24.2673C24.6726 25 25 24.6712 25 24.265V3.62072C25 3.34171 24.8575 3.01686 24.6519 2.82855ZM1.27206 8.95692C1.0852 8.95692 0.932847 8.80459 0.932847 8.61777V5.58858C0.932847 5.40126 1.0852 5.24894 1.27206 5.24894H5.17996H6.11232H8.08648C8.48979 5.24894 8.81915 4.91916 8.81915 4.51444V3.16179C8.86451 3.17362 8.9153 3.19925 8.96164 3.24608L9.91322 4.20043L10.8466 5.13556L12.5703 6.86385C12.6339 6.92793 12.6703 7.01321 12.6703 7.10293C12.6703 7.19363 12.6339 7.27891 12.5703 7.343L11.7981 8.11644L11.3322 8.58424L10.8663 9.05206L8.96263 10.9603C8.91727 11.0071 8.86747 11.0308 8.82014 11.0416V9.69191C8.82014 9.28719 8.49078 8.95692 8.08747 8.95692H6.1133H5.18095H1.27206ZM24.0667 24.0644H6.11182V9.89254H7.88581V11.1565C7.88581 11.504 8.12543 11.9038 8.52727 11.9698C8.59679 11.9822 8.6668 11.9876 8.73829 11.9876C9.07258 11.9876 9.38566 11.8579 9.62134 11.6213L12.1827 9.05156H21.2538V8.11594H13.1156L13.2275 8.00404C13.4691 7.76348 13.6022 7.44257 13.6022 7.10194C13.6022 6.76131 13.4691 6.44139 13.2295 6.20083L12.165 5.13507H21.2538V4.19994H11.2331L9.62282 2.58602C9.33685 2.29715 8.92664 2.16751 8.52677 2.23455C8.12543 2.30109 7.88532 2.70088 7.88532 3.04791V4.31332H6.11133V0.935128H21.1128C21.1523 0.936114 21.2361 0.969634 21.2642 0.99231L24.0183 3.51474C24.0376 3.53692 24.0637 3.59657 24.0667 3.62072V24.0644Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 12.0317H8.92583V12.9674H21.253V12.0317Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 15.9478H8.92583V16.8829H21.253V15.9478Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 19.8633H8.92583V20.7989H21.253V19.8633Z",fill:"currentColor"})),title:(0,i.__)("Importing Recipes"),description:(0,i.__)("Please do not close this tab during the import process.")}),React.createElement(er,{progress:E}),React.createElement(rr,{items:x})),C&&"success"===R&&React.createElement(lr,{icon:React.createElement("svg",{width:"70",height:"69",viewBox:"0 0 70 69",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",fill:"#F2FBF8"}),React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",stroke:"#2DB68D",strokeWidth:"1.38"}),React.createElement("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M47.1637 21.748L28.8214 39.4498L23.954 34.2494C23.0574 33.404 21.6484 33.3528 20.6237 34.0701C19.6246 34.813 19.3428 36.1195 19.9576 37.1698L25.7216 46.5459C26.2852 47.4169 27.2587 47.9549 28.3602 47.9549C29.4106 47.9549 30.4097 47.4169 30.9732 46.5459C31.8955 45.3419 49.4949 24.361 49.4949 24.361C51.8005 22.0041 49.0081 19.9291 47.1637 21.7223V21.748Z",fill:"#2DB68D"})),title:(0,i.__)("Your Recipes are imported successfully!"),text:(0,i.__)("All the imported recipes are saved as drafts. You can make the necessary changes and publish them.")},React.createElement(dr,{style:{flexDirection:"column"}},React.createElement(ui,{label:(0,i.__)("View all Recipes"),onClick:()=>{window.open("/wp-admin/edit.php?post_type=recipe","_blank")}}),React.createElement(ui,{variant:"ghost",label:(0,i.__)("Back to Dashboard"),prevIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"})),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}))),C&&"failure"===R&&React.createElement(lr,{icon:React.createElement("svg",{width:"70",height:"69",viewBox:"0 0 70 69",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",fill:"#FFE9E9"}),React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",stroke:"#FF4949",strokeWidth:"1.38"}),React.createElement("path",{d:"M37.0557 34.4683L48.6513 22.8727C48.8805 22.6051 49.0002 22.2609 48.9866 21.9089C48.973 21.5568 48.8271 21.2229 48.578 20.9738C48.3289 20.7247 47.9949 20.5787 47.6429 20.5651C47.2909 20.5516 46.9467 20.6713 46.6791 20.9004L35.0835 32.4961L23.4878 20.8865C23.2245 20.6231 22.8672 20.4751 22.4947 20.4751C22.1222 20.4751 21.765 20.6231 21.5016 20.8865C21.2382 21.1498 21.0903 21.5071 21.0903 21.8796C21.0903 22.2521 21.2382 22.6093 21.5016 22.8727L33.1112 34.4683L21.5016 46.0639C21.3552 46.1893 21.2363 46.3436 21.1523 46.5172C21.0684 46.6907 21.0212 46.8797 21.0137 47.0724C21.0063 47.265 21.0388 47.4571 21.1091 47.6366C21.1794 47.8161 21.2861 47.9791 21.4224 48.1154C21.5587 48.2517 21.7217 48.3584 21.9012 48.4287C22.0807 48.499 22.2728 48.5315 22.4654 48.5241C22.6581 48.5166 22.8471 48.4694 23.0206 48.3855C23.1942 48.3015 23.3485 48.1826 23.4739 48.0362L35.0835 36.4405L46.6791 48.0362C46.9467 48.2653 47.2909 48.3851 47.6429 48.3715C47.9949 48.3579 48.3289 48.2119 48.578 47.9628C48.8271 47.7137 48.973 47.3798 48.9866 47.0278C49.0002 46.6757 48.8805 46.3315 48.6513 46.0639L37.0557 34.4683Z",fill:"#FF4949"})),title:(0,i.__)("Import Unsuccessful"),text:(0,i.__)("Please try importing your recipes again. If the problem persists, contact our support team for assistance.")},React.createElement(dr,{style:{flexDirection:"column"}},React.createElement(ui,{label:(0,i.__)("Try Import Again"),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}),React.createElement(ui,{variant:"ghost",label:(0,i.__)("Back to Dashboard"),prevIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"})),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}))))};const{pluginUrl:cr}=dr_import||{},pr=Kt.div`
    padding: 24px;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 24px;
    ${e=>e.starter&&"\n        padding: 32px;\n    "}
`,ur=Kt.div`
    padding: 64px 0;
`,dr=Kt.div`
    text-align: center;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 12px;
`,mr=Kt.h2`
    font-size: 32px;
    line-height: 1.3;
    font-weight: 600;
    margin: 0 0 32px;
    text-align: center;
`,hr=[{id:"cooked",image:React.createElement("img",{src:`${cr}/assets/images/import-recipes/cooked.png`}),title:(0,i.__)("Cooked"),description:(0,i.__)("Import all recipes from Cooked plugin.")},{id:"wp-recipe-maker",image:React.createElement("img",{src:`${cr}/assets/images/import-recipes/wp-recipe-maker.png`}),title:(0,i.__)("WP Recipe Maker"),description:(0,i.__)("Import all recipes from WP Recipe Maker plugin.")},{id:"csv",image:React.createElement("img",{src:`${cr}/assets/images/import-recipes/csv-import.png`}),title:(0,i.__)("CSV Import"),description:(0,i.__)("Import recipes from CSV file.")},{id:"tasty-recipes",image:React.createElement("img",{src:`${cr}/assets/images/import-recipes/tasty-recipes.jpg`}),title:(0,i.__)("Tasty Recipes"),description:(0,i.__)("Import all recipes from Tasty Recipes plugin.")}];var fr=()=>{const{globalState:e,setGlobalState:r,globalState:{importStart:n,selectedOption:a,recipeCount:s,list:p,isCSV:u}}=o(),[d,m]=(0,t.useState)("");(0,t.useEffect)(()=>{a&&!u&&h(a)},[a]);const h=function(){var t=l(function*(t){r({...e,loading:!0});const[i,n]=yield Promise.all([c()({path:`/deliciousrecipe/v1/get_import_plugin_terms?selectedOption=${t}`}),c()({path:`/deliciousrecipe/v1/get_import_recipes?selectedOption=${t}`})]);n.success?r({...e,importPluginFields:i?.data||[],recipes:n?.data||[],recipeCount:n?.data?.length||0,recipesToList:n?.data?.slice(0,p)||[],loading:!1}):m(n.data)});return function(_x){return t.apply(this,arguments)}}(),f=u||a&&s>0,g=a&&s<1&&!u;return React.createElement(ur,null,n?React.createElement(vi,null,React.createElement(mr,null,(0,i.__)("Import Recipes","delicious-recipes")),React.createElement(wi,{steps:[{id:"recipes-import",label:u?(0,i.__)("CSV File Upload","delicious-recipes"):(0,i.__)("Recipes to Import","delicious-recipes"),component:u?React.createElement(Zi,null):React.createElement(Oi,null)},{id:"fields-mapping",label:(0,i.__)("Fields Mapping","delicious-recipes"),component:React.createElement(qi,null)},...u?[]:[{id:"summary",label:(0,i.__)("Summary","delicious-recipes"),component:React.createElement(Qi,null)}],{id:"import-process",label:(0,i.__)("Import Process","delicious-recipes"),component:React.createElement(sr,null)}]})):React.createElement(vi,null,React.createElement(pr,{starter:!0},React.createElement(ii,{icon:React.createElement("svg",{width:"25",height:"25",viewBox:"0 0 25 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M24.6519 2.82855L21.8928 0.301686C21.6981 0.124223 21.3786 0 21.1158 0H5.91263C5.50735 0 5.17996 0.328305 5.17996 0.734497V4.31332H1.27206C0.57095 4.31332 0 4.88514 0 5.58858V8.61777C0 9.32121 0.57095 9.89303 1.27206 9.89303H5.17996V24.265C5.17996 24.6712 5.50735 25 5.91263 25H24.2673C24.6726 25 25 24.6712 25 24.265V3.62072C25 3.34171 24.8575 3.01686 24.6519 2.82855ZM1.27206 8.95692C1.0852 8.95692 0.932847 8.80459 0.932847 8.61777V5.58858C0.932847 5.40126 1.0852 5.24894 1.27206 5.24894H5.17996H6.11232H8.08648C8.48979 5.24894 8.81915 4.91916 8.81915 4.51444V3.16179C8.86451 3.17362 8.9153 3.19925 8.96164 3.24608L9.91322 4.20043L10.8466 5.13556L12.5703 6.86385C12.6339 6.92793 12.6703 7.01321 12.6703 7.10293C12.6703 7.19363 12.6339 7.27891 12.5703 7.343L11.7981 8.11644L11.3322 8.58424L10.8663 9.05206L8.96263 10.9603C8.91727 11.0071 8.86747 11.0308 8.82014 11.0416V9.69191C8.82014 9.28719 8.49078 8.95692 8.08747 8.95692H6.1133H5.18095H1.27206ZM24.0667 24.0644H6.11182V9.89254H7.88581V11.1565C7.88581 11.504 8.12543 11.9038 8.52727 11.9698C8.59679 11.9822 8.6668 11.9876 8.73829 11.9876C9.07258 11.9876 9.38566 11.8579 9.62134 11.6213L12.1827 9.05156H21.2538V8.11594H13.1156L13.2275 8.00404C13.4691 7.76348 13.6022 7.44257 13.6022 7.10194C13.6022 6.76131 13.4691 6.44139 13.2295 6.20083L12.165 5.13507H21.2538V4.19994H11.2331L9.62282 2.58602C9.33685 2.29715 8.92664 2.16751 8.52677 2.23455C8.12543 2.30109 7.88532 2.70088 7.88532 3.04791V4.31332H6.11133V0.935128H21.1128C21.1523 0.936114 21.2361 0.969634 21.2642 0.99231L24.0183 3.51474C24.0376 3.53692 24.0637 3.59657 24.0667 3.62072V24.0644Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 12.0317H8.92583V12.9674H21.253V12.0317Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 15.9478H8.92583V16.8829H21.253V15.9478Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 19.8633H8.92583V20.7989H21.253V19.8633Z",fill:"currentColor"})),title:(0,i.__)("Import Recipes","delicious-recipes"),description:(0,i.__)("Select from the options below to import your recipes.","delicious-recipes")}),React.createElement(si,{options:hr,selected:a,onChange:t=>r({...e,selectedOption:t,isCSV:"csv"===t})}),f&&React.createElement(gi,{key:"warning",onDismiss:()=>r({...e,showMsg:!1}),status:"warning",message:(0,i.__)("We recommend taking a full backup of your site before proceeding with the import. Alternatively, you can also create a staging site and import the recipes.","delicious-recipes")}),g&&React.createElement(gi,{key:"error",status:"error",message:d}),React.createElement(dr,null,React.createElement(ui,{type:"button",disabled:!(u||a&&s>=1),label:(0,i.__)("Proceed to Next Step","delicious-recipes"),onClick:()=>r({...e,importStart:!0})})))))};const{pluginUrl:gr}=dr_import||{};var br=({pageTitle:e})=>React.createElement("header",{className:"wpdelicious-setting-header border-bottom-1 top-2 flex items-center gap-1"},React.createElement("div",{className:"wpdelicious-logo"},React.createElement("img",{src:gr?`${gr}assets/images/Delicious-Recipes.png`:""})),e&&React.createElement("span",{className:"dr-page-name"},e));let vr=document.getElementById("delicious-recipe-import"),Er=vr.dataset.restNonce;(0,t.createRoot)(vr).render(React.createElement(n,null,React.createElement(br,null),React.createElement(fr,{rest_nonce:Er}))),(drExports=void 0===drExports?{}:drExports).import={}}();