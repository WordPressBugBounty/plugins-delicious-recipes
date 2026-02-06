var drExports;!function(){"use strict";var e={n:function(t){var r=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(r,{a:r}),r},d:function(t,r){for(var n in r)e.o(r,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:r[n]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},nc:void 0},t=window.wp.element,r=window.wp.i18n;const n=(0,t.createContext)();function i({children:e}){const[i,a]=(0,t.useState)({loading:!1,selectedOption:"",showMsg:!0,importStart:!1,importSuccess:!1,pns:!1,recipes:[],recipeCount:0,recipesToList:[],list:10,currentPage:1,recipesToImport:[],deleteRecipes:!1,recipeFields:[],importPluginFields:[],importCSVFileID:"",importCSVFileName:"",importCSVFileURL:"",importCSVFileSize:"",CSVFileHeaders:[],CSVFields:[],isCSV:!1,deleteCSV:!1}),o={recipeTitle:{value:"recipeTitle",label:(0,r.__)("Recipe Title","delicious-recipes"),section:"Post Info"},postContent:{value:"postContent",label:(0,r.__)("Post Content","delicious-recipes"),section:"Post Info"},postExcerpt:{value:"postExcerpt",label:(0,r.__)("Post Excerpt","delicious-recipes"),section:"Post Info"},featuredImage:{value:"featuredImage",label:(0,r.__)("Featured Image","delicious-recipes"),section:"Post Info"},recipeAuthor:{value:"recipeAuthor",label:(0,r.__)("Recipe Author","delicious-recipes"),section:"Post Info"},recipeAuthorEmail:{value:"recipeAuthorEmail",label:(0,r.__)("Recipe Author Email","delicious-recipes"),section:"Post Info"},commnetStatus:{value:"commnetStatus",label:(0,r.__)("Comment Status","delicious-recipes"),section:"Post Info"},recipeSubtitle:{value:"recipeSubtitle",label:(0,r.__)("Recipe Subtitle","delicious-recipes"),section:"Recipe Info"},recipeDescription:{value:"recipeDescription",label:(0,r.__)("Recipe Description","delicious-recipes"),section:"Recipe Info"},difficultyLevel:{value:"difficultyLevel",label:(0,r.__)("Difficulty Level","delicious-recipes"),section:"Recipe Info"},prepTime:{value:"prepTime",label:(0,r.__)("Prep Time","delicious-recipes"),section:"Recipe Info"},cookTime:{value:"cookTime",label:(0,r.__)("Cook Time","delicious-recipes"),section:"Recipe Info"},restTime:{value:"restTime",label:(0,r.__)("Rest Time","delicious-recipes"),section:"Recipe Info"},cookingTemp:{value:"cookingTemp",label:(0,r.__)("Cooking Temperature","delicious-recipes"),section:"Recipe Info"},recipeCalories:{value:"recipeCalories",label:(0,r.__)("Recipe Calories","delicious-recipes"),section:"Recipe Info"},bestSeason:{value:"bestSeason",label:(0,r.__)("Best Season","delicious-recipes"),section:"Recipe Info"},estimatedCost:{value:"estimatedCost",label:(0,r.__)("Estimated Cost","delicious-recipes"),section:"Recipe Info"},noOfServings:{value:"noOfServings",label:(0,r.__)("Number of Servings","delicious-recipes"),section:"Ingredients"},ingredientTitle:{value:"ingredientTitle",label:(0,r.__)("Ingredient Title","delicious-recipes"),section:"Ingredients"},ingredients:{value:"ingredients",label:(0,r.__)("Ingredients","delicious-recipes"),section:"Ingredients"},instructionTitle:{value:"instructionTitle",label:(0,r.__)("Instruction Title","delicious-recipes"),section:"Instructions"},instructions:{value:"instructions",label:(0,r.__)("Instructions","delicious-recipes"),section:"Instructions"},imageGallery:{value:"imageGallery",label:(0,r.__)("Image Gallery","delicious-recipes"),section:"Gallery"},videoGallery:{value:"videoGallery",label:(0,r.__)("Video Gallery","delicious-recipes"),section:"Gallery"},servingSize:{value:"servingSize",label:(0,r.__)("Serving Size","delicious-recipes"),section:"Nutrition"},calories:{value:"calories",label:(0,r.__)("Calories","delicious-recipes"),section:"Nutrition"},totalFat:{value:"totalFat",label:(0,r.__)("Total Fat","delicious-recipes"),section:"Nutrition"},saturatedFat:{value:"saturatedFat",label:(0,r.__)("Saturated Fat","delicious-recipes"),section:"Nutrition"},transFat:{value:"transFat",label:(0,r.__)("Trans Fat","delicious-recipes"),section:"Nutrition"},cholesterol:{value:"cholesterol",label:(0,r.__)("Cholesterol","delicious-recipes"),section:"Nutrition"},sodium:{value:"sodium",label:(0,r.__)("Sodium","delicious-recipes"),section:"Nutrition"},potassium:{value:"potassium",label:(0,r.__)("Potassium","delicious-recipes"),section:"Nutrition"},totalCarbohydrate:{value:"totalCarbohydrate",label:(0,r.__)("Total Carbohydrate","delicious-recipes"),section:"Nutrition"},dietaryFiber:{value:"dietaryFiber",label:(0,r.__)("Dietary Fiber","delicious-recipes"),section:"Nutrition"},sugars:{value:"sugars",label:(0,r.__)("Sugars","delicious-recipes"),section:"Nutrition"},protein:{value:"protein",label:(0,r.__)("Protein","delicious-recipes"),section:"Nutrition"},vitaminA:{value:"vitaminA",label:(0,r.__)("Vitamin A","delicious-recipes"),section:"Nutrition"},vitaminC:{value:"vitaminC",label:(0,r.__)("Vitamin C","delicious-recipes"),section:"Nutrition"},vitaminD:{value:"vitaminD",label:(0,r.__)("Vitamin D","delicious-recipes"),section:"Nutrition"},vitaminE:{value:"vitaminE",label:(0,r.__)("Vitamin E","delicious-recipes"),section:"Nutrition"},vitaminK:{value:"vitaminK",label:(0,r.__)("Vitamin K","delicious-recipes"),section:"Nutrition"},vitaminB6:{value:"vitaminB6",label:(0,r.__)("Vitamin B6","delicious-recipes"),section:"Nutrition"},vitaminB12:{value:"vitaminB12",label:(0,r.__)("Vitamin B12","delicious-recipes"),section:"Nutrition"},calcium:{value:"calcium",label:(0,r.__)("Calcium","delicious-recipes"),section:"Nutrition"},iron:{value:"iron",label:(0,r.__)("Iron","delicious-recipes"),section:"Nutrition"},thiamin:{value:"thiamin",label:(0,r.__)("Thiamin","delicious-recipes"),section:"Nutrition"},riboflavin:{value:"riboflavin",label:(0,r.__)("Riboflavin","delicious-recipes"),section:"Nutrition"},niacin:{value:"niacin",label:(0,r.__)("Niacin","delicious-recipes"),section:"Nutrition"},folate:{value:"folate",label:(0,r.__)("Folate","delicious-recipes"),section:"Nutrition"},biotin:{value:"biotin",label:(0,r.__)("Biotin","delicious-recipes"),section:"Nutrition"},pantothenicAcid:{value:"pantothenicAcid",label:(0,r.__)("Pantothenic Acid","delicious-recipes"),section:"Nutrition"},phosphorus:{value:"phosphorus",label:(0,r.__)("Phosphorus","delicious-recipes"),section:"Nutrition"},iodine:{value:"iodine",label:(0,r.__)("Iodine","delicious-recipes"),section:"Nutrition"},magnesium:{value:"magnesium",label:(0,r.__)("Magnesium","delicious-recipes"),section:"Nutrition"},zinc:{value:"zinc",label:(0,r.__)("Zinc","delicious-recipes"),section:"Nutrition"},selenium:{value:"selenium",label:(0,r.__)("Selenium","delicious-recipes"),section:"Nutrition"},copper:{value:"copper",label:(0,r.__)("Copper","delicious-recipes"),section:"Nutrition"},manganese:{value:"manganese",label:(0,r.__)("Manganese","delicious-recipes"),section:"Nutrition"},chromium:{value:"chromium",label:(0,r.__)("Chromium","delicious-recipes"),section:"Nutrition"},molybdenum:{value:"molybdenum",label:(0,r.__)("Molybdenum","delicious-recipes"),section:"Nutrition"},chloride:{value:"chloride",label:(0,r.__)("Chloride","delicious-recipes"),section:"Nutrition"},recipeNotes:{value:"recipeNotes",label:(0,r.__)("Recipe Notes","delicious-recipes"),section:"Notes"},faqTitle:{value:"faqTitle",label:(0,r.__)("FAQ Title","delicious-recipes"),section:"FAQs"},recipeFAQs:{value:"recipeFAQs",label:(0,r.__)("Recipe FAQs","delicious-recipes"),section:"FAQs"},equipmentsTitle:{value:"equipmentsTitle",label:(0,r.__)("Equipment Title","delicious-recipes"),section:"Equipment"},recipeEquipments:{value:"recipeEquipments",label:(0,r.__)("Recipe Equipment","delicious-recipes"),section:"Equipment"},extendedContent:{value:"extendedContent",label:(0,r.__)("Extended Content","delicious-recipes"),section:"Extended Content"}},c={"recipe-course":(0,r.__)("Recipe Courses","delicious-recipes"),"recipe-cuisine":(0,r.__)("Recipe Cuisines","delicious-recipes"),"recipe-cooking-method":(0,r.__)("Recipe Cooking Methods","delicious-recipes"),"recipe-key":(0,r.__)("Recipe Keys","delicious-recipes"),"recipe-tag":(0,r.__)("Recipe Tags","delicious-recipes"),"recipe-badge":(0,r.__)("Recipe Badges","delicious-recipes"),"recipe-dietary":(0,r.__)("Recipe Dietaries","delicious-recipes"),recipe_keywords:(0,r.__)("Recipe Keywords","delicious-recipes")},{recipes:l,list:s,currentPage:p,recipesToList:u}=i;return l?.length>0&&0===u.length&&a({...i,recipesToList:l.slice((p-1)*s,p*s)}),React.createElement(n.Provider,{value:{globalState:i,setGlobalState:a,recipe_metadata:o,wpd_fields:c}},e)}function a(){return(0,t.useContext)(n)}function o(e,t,r,n,i,a,o){try{var c=e[a](o),l=c.value}catch(e){return void r(e)}c.done?t(l):Promise.resolve(l).then(n,i)}function c(e){return function(){var t=this,r=arguments;return new Promise(function(n,i){var a=e.apply(t,r);function c(e){o(a,n,i,c,l,"next",e)}function l(e){o(a,n,i,c,l,"throw",e)}c(void 0)})}}var l=window.wp.apiFetch,s=e.n(l),p=function(){return p=Object.assign||function(e){for(var t,r=1,n=arguments.length;r<n;r++)for(var i in t=arguments[r])Object.prototype.hasOwnProperty.call(t,i)&&(e[i]=t[i]);return e},p.apply(this,arguments)};function u(e,t,r){if(r||2===arguments.length)for(var n,i=0,a=t.length;i<a;i++)!n&&i in t||(n||(n=Array.prototype.slice.call(t,0,i)),n[i]=t[i]);return e.concat(n||Array.prototype.slice.call(t))}Object.create,Object.create,"function"==typeof SuppressedError&&SuppressedError;var d=window.React,m=e.n(d),h="-ms-",f="-moz-",g="-webkit-",v="comm",b="rule",E="decl",C="@keyframes",R=Math.abs,_=String.fromCharCode,x=Object.assign;function w(e){return e.trim()}function y(e,t){return(e=t.exec(e))?e[0]:e}function k(e,t,r){return e.replace(t,r)}function S(e,t,r){return e.indexOf(t,r)}function I(e,t){return 0|e.charCodeAt(t)}function T(e,t,r){return e.slice(t,r)}function F(e){return e.length}function D(e){return e.length}function L(e,t){return t.push(e),e}function P(e,t){return e.filter(function(e){return!y(e,t)})}var N=1,A=1,V=0,M=0,B=0,O="";function $(e,t,r,n,i,a,o,c){return{value:e,root:t,parent:r,type:n,props:i,children:a,line:N,column:A,length:o,return:"",siblings:c}}function H(e,t){return x($("",null,null,"",null,null,0,e.siblings),e,{length:-e.length},t)}function j(e){for(;e.root;)e=H(e.root,{children:[e]});L(e,e.siblings)}function z(){return B=M>0?I(O,--M):0,A--,10===B&&(A=1,N--),B}function G(){return B=M<V?I(O,M++):0,A++,10===B&&(A=1,N++),B}function W(){return I(O,M)}function Z(){return M}function q(e,t){return T(O,e,t)}function Y(e){switch(e){case 0:case 9:case 10:case 13:case 32:return 5;case 33:case 43:case 44:case 47:case 62:case 64:case 126:case 59:case 123:case 125:return 4;case 58:return 3;case 34:case 39:case 40:case 91:return 2;case 41:case 93:return 1}return 0}function J(e){return w(q(M-1,K(91===e?e+2:40===e?e+1:e)))}function U(e){for(;(B=W())&&B<33;)G();return Y(e)>2||Y(B)>3?"":" "}function Q(e,t){for(;--t&&G()&&!(B<48||B>102||B>57&&B<65||B>70&&B<97););return q(e,Z()+(t<6&&32==W()&&32==G()))}function K(e){for(;G();)switch(B){case e:return M;case 34:case 39:34!==e&&39!==e&&K(B);break;case 40:41===e&&K(e);break;case 92:G()}return M}function X(e,t){for(;G()&&e+B!==57&&(e+B!==84||47!==W()););return"/*"+q(t,M-1)+"*"+_(47===e?e:G())}function ee(e){for(;!Y(W());)G();return q(e,M)}function te(e,t){for(var r="",n=0;n<e.length;n++)r+=t(e[n],n,e,t)||"";return r}function re(e,t,r,n){switch(e.type){case"@layer":if(e.children.length)break;case"@import":case"@namespace":case E:return e.return=e.return||e.value;case v:return"";case C:return e.return=e.value+"{"+te(e.children,n)+"}";case b:if(!F(e.value=e.props.join(",")))return""}return F(r=te(e.children,n))?e.return=e.value+"{"+r+"}":""}function ne(e,t,r){switch(function(e,t){return 45^I(e,0)?(((t<<2^I(e,0))<<2^I(e,1))<<2^I(e,2))<<2^I(e,3):0}(e,t)){case 5103:return g+"print-"+e+e;case 5737:case 4201:case 3177:case 3433:case 1641:case 4457:case 2921:case 5572:case 6356:case 5844:case 3191:case 6645:case 3005:case 4215:case 6389:case 5109:case 5365:case 5621:case 3829:case 6391:case 5879:case 5623:case 6135:case 4599:return g+e+e;case 4855:return g+e.replace("add","source-over").replace("substract","source-out").replace("intersect","source-in").replace("exclude","xor")+e;case 4789:return f+e+e;case 5349:case 4246:case 4810:case 6968:case 2756:return g+e+f+e+h+e+e;case 5936:switch(I(e,t+11)){case 114:return g+e+h+k(e,/[svh]\w+-[tblr]{2}/,"tb")+e;case 108:return g+e+h+k(e,/[svh]\w+-[tblr]{2}/,"tb-rl")+e;case 45:return g+e+h+k(e,/[svh]\w+-[tblr]{2}/,"lr")+e}case 6828:case 4268:case 2903:return g+e+h+e+e;case 6165:return g+e+h+"flex-"+e+e;case 5187:return g+e+k(e,/(\w+).+(:[^]+)/,g+"box-$1$2"+h+"flex-$1$2")+e;case 5443:return g+e+h+"flex-item-"+k(e,/flex-|-self/g,"")+(y(e,/flex-|baseline/)?"":h+"grid-row-"+k(e,/flex-|-self/g,""))+e;case 4675:return g+e+h+"flex-line-pack"+k(e,/align-content|flex-|-self/g,"")+e;case 5548:return g+e+h+k(e,"shrink","negative")+e;case 5292:return g+e+h+k(e,"basis","preferred-size")+e;case 6060:return g+"box-"+k(e,"-grow","")+g+e+h+k(e,"grow","positive")+e;case 4554:return g+k(e,/([^-])(transform)/g,"$1"+g+"$2")+e;case 6187:return k(k(k(e,/(zoom-|grab)/,g+"$1"),/(image-set)/,g+"$1"),e,"")+e;case 5495:case 3959:return k(e,/(image-set\([^]*)/,g+"$1$`$1");case 4968:return k(k(e,/(.+:)(flex-)?(.*)/,g+"box-pack:$3"+h+"flex-pack:$3"),/space-between/,"justify")+g+e+e;case 4200:if(!y(e,/flex-|baseline/))return h+"grid-column-align"+T(e,t)+e;break;case 2592:case 3360:return h+k(e,"template-","")+e;case 4384:case 3616:return r&&r.some(function(e,r){return t=r,y(e.props,/grid-\w+-end/)})?~S(e+(r=r[t].value),"span",0)?e:h+k(e,"-start","")+e+h+"grid-row-span:"+(~S(r,"span",0)?y(r,/\d+/):+y(r,/\d+/)-+y(e,/\d+/))+";":h+k(e,"-start","")+e;case 4896:case 4128:return r&&r.some(function(e){return y(e.props,/grid-\w+-start/)})?e:h+k(k(e,"-end","-span"),"span ","")+e;case 4095:case 3583:case 4068:case 2532:return k(e,/(.+)-inline(.+)/,g+"$1$2")+e;case 8116:case 7059:case 5753:case 5535:case 5445:case 5701:case 4933:case 4677:case 5533:case 5789:case 5021:case 4765:if(F(e)-1-t>6)switch(I(e,t+1)){case 109:if(45!==I(e,t+4))break;case 102:return k(e,/(.+:)(.+)-([^]+)/,"$1"+g+"$2-$3$1"+f+(108==I(e,t+3)?"$3":"$2-$3"))+e;case 115:return~S(e,"stretch",0)?ne(k(e,"stretch","fill-available"),t,r)+e:e}break;case 5152:case 5920:return k(e,/(.+?):(\d+)(\s*\/\s*(span)?\s*(\d+))?(.*)/,function(t,r,n,i,a,o,c){return h+r+":"+n+c+(i?h+r+"-span:"+(a?o:+o-+n)+c:"")+e});case 4949:if(121===I(e,t+6))return k(e,":",":"+g)+e;break;case 6444:switch(I(e,45===I(e,14)?18:11)){case 120:return k(e,/(.+:)([^;\s!]+)(;|(\s+)?!.+)?/,"$1"+g+(45===I(e,14)?"inline-":"")+"box$3$1"+g+"$2$3$1"+h+"$2box$3")+e;case 100:return k(e,":",":"+h)+e}break;case 5719:case 2647:case 2135:case 3927:case 2391:return k(e,"scroll-","scroll-snap-")+e}return e}function ie(e,t,r,n){if(e.length>-1&&!e.return)switch(e.type){case E:return void(e.return=ne(e.value,e.length,r));case C:return te([H(e,{value:k(e.value,"@","@"+g)})],n);case b:if(e.length)return function(e,t){return e.map(t).join("")}(r=e.props,function(t){switch(y(t,n=/(::plac\w+|:read-\w+)/)){case":read-only":case":read-write":j(H(e,{props:[k(t,/:(read-\w+)/,":-moz-$1")]})),j(H(e,{props:[t]})),x(e,{props:P(r,n)});break;case"::placeholder":j(H(e,{props:[k(t,/:(plac\w+)/,":"+g+"input-$1")]})),j(H(e,{props:[k(t,/:(plac\w+)/,":-moz-$1")]})),j(H(e,{props:[k(t,/:(plac\w+)/,h+"input-$1")]})),j(H(e,{props:[t]})),x(e,{props:P(r,n)})}return""})}}function ae(e){return function(e){return O="",e}(oe("",null,null,null,[""],e=function(e){return N=A=1,V=F(O=e),M=0,[]}(e),0,[0],e))}function oe(e,t,r,n,i,a,o,c,l){for(var s=0,p=0,u=o,d=0,m=0,h=0,f=1,g=1,v=1,b=0,E="",C=i,x=a,w=n,y=E;g;)switch(h=b,b=G()){case 40:if(108!=h&&58==I(y,u-1)){-1!=S(y+=k(J(b),"&","&\f"),"&\f",R(s?c[s-1]:0))&&(v=-1);break}case 34:case 39:case 91:y+=J(b);break;case 9:case 10:case 13:case 32:y+=U(h);break;case 92:y+=Q(Z()-1,7);continue;case 47:switch(W()){case 42:case 47:L(le(X(G(),Z()),t,r,l),l),5!=Y(h||1)&&5!=Y(W()||1)||!F(y)||" "===T(y,-1,void 0)||(y+=" ");break;default:y+="/"}break;case 123*f:c[s++]=F(y)*v;case 125*f:case 59:case 0:switch(b){case 0:case 125:g=0;case 59+p:-1==v&&(y=k(y,/\f/g,"")),m>0&&(F(y)-u||0===f&&47===h)&&L(m>32?se(y+";",n,r,u-1,l):se(k(y," ","")+";",n,r,u-2,l),l);break;case 59:y+=";";default:if(L(w=ce(y,t,r,s,p,i,c,E,C=[],x=[],u,a),a),123===b)if(0===p)oe(y,t,w,w,C,a,u,c,x);else{switch(d){case 99:if(110===I(y,3))break;case 108:if(97===I(y,2))break;default:p=0;case 100:case 109:case 115:}p?oe(e,w,w,n&&L(ce(e,w,w,0,0,i,c,E,i,C=[],u,x),x),i,x,u,c,n?C:x):oe(y,w,w,w,[""],x,0,c,x)}}s=p=m=0,f=v=1,E=y="",u=o;break;case 58:u=1+F(y),m=h;default:if(f<1)if(123==b)--f;else if(125==b&&0==f++&&125==z())continue;switch(y+=_(b),b*f){case 38:v=p>0?1:(y+="\f",-1);break;case 44:c[s++]=(F(y)-1)*v,v=1;break;case 64:45===W()&&(y+=J(G())),d=W(),p=u=F(E=y+=ee(Z())),b++;break;case 45:45===h&&2==F(y)&&(f=0)}}return a}function ce(e,t,r,n,i,a,o,c,l,s,p,u){for(var d=i-1,m=0===i?a:[""],h=D(m),f=0,g=0,v=0;f<n;++f)for(var E=0,C=T(e,d+1,d=R(g=o[f])),_=e;E<h;++E)(_=w(g>0?m[E]+" "+C:k(C,/&\f/g,m[E])))&&(l[v++]=_);return $(e,t,r,0===i?b:c,l,s,p,u)}function le(e,t,r,n){return $(e,t,r,v,_(B),T(e,2,-2),0,n)}function se(e,t,r,n,i){return $(e,t,r,E,T(e,0,n),T(e,n+1,-1),n,i)}var pe={animationIterationCount:1,aspectRatio:1,borderImageOutset:1,borderImageSlice:1,borderImageWidth:1,boxFlex:1,boxFlexGroup:1,boxOrdinalGroup:1,columnCount:1,columns:1,flex:1,flexGrow:1,flexPositive:1,flexShrink:1,flexNegative:1,flexOrder:1,gridRow:1,gridRowEnd:1,gridRowSpan:1,gridRowStart:1,gridColumn:1,gridColumnEnd:1,gridColumnSpan:1,gridColumnStart:1,msGridRow:1,msGridRowSpan:1,msGridColumn:1,msGridColumnSpan:1,fontWeight:1,lineHeight:1,opacity:1,order:1,orphans:1,scale:1,tabSize:1,widows:1,zIndex:1,zoom:1,WebkitLineClamp:1,fillOpacity:1,floodOpacity:1,stopOpacity:1,strokeDasharray:1,strokeDashoffset:1,strokeMiterlimit:1,strokeOpacity:1,strokeWidth:1},ue="undefined"!=typeof process&&void 0!==process.env&&(process.env.REACT_APP_SC_ATTR||process.env.SC_ATTR)||"data-styled",de="active",me="data-styled-version",he="6.3.8",fe="/*!sc*/\n",ge="undefined"!=typeof window&&"undefined"!=typeof document,ve=void 0===m().createContext,be=Boolean("boolean"==typeof SC_DISABLE_SPEEDY?SC_DISABLE_SPEEDY:"undefined"!=typeof process&&void 0!==process.env&&void 0!==process.env.REACT_APP_SC_DISABLE_SPEEDY&&""!==process.env.REACT_APP_SC_DISABLE_SPEEDY?"false"!==process.env.REACT_APP_SC_DISABLE_SPEEDY&&process.env.REACT_APP_SC_DISABLE_SPEEDY:"undefined"!=typeof process&&void 0!==process.env&&void 0!==process.env.SC_DISABLE_SPEEDY&&""!==process.env.SC_DISABLE_SPEEDY&&"false"!==process.env.SC_DISABLE_SPEEDY&&process.env.SC_DISABLE_SPEEDY),Ee=(new Set,Object.freeze([])),Ce=Object.freeze({});var Re=new Set(["a","abbr","address","area","article","aside","audio","b","bdi","bdo","blockquote","body","button","br","canvas","caption","cite","code","col","colgroup","data","datalist","dd","del","details","dfn","dialog","div","dl","dt","em","embed","fieldset","figcaption","figure","footer","form","h1","h2","h3","h4","h5","h6","header","hgroup","hr","html","i","iframe","img","input","ins","kbd","label","legend","li","main","map","mark","menu","meter","nav","object","ol","optgroup","option","output","p","picture","pre","progress","q","rp","rt","ruby","s","samp","search","section","select","slot","small","span","strong","sub","summary","sup","table","tbody","td","template","textarea","tfoot","th","thead","time","tr","u","ul","var","video","wbr","circle","clipPath","defs","ellipse","feBlend","feColorMatrix","feComponentTransfer","feComposite","feConvolveMatrix","feDiffuseLighting","feDisplacementMap","feDistantLight","feDropShadow","feFlood","feFuncA","feFuncB","feFuncG","feFuncR","feGaussianBlur","feImage","feMerge","feMergeNode","feMorphology","feOffset","fePointLight","feSpecularLighting","feSpotLight","feTile","feTurbulence","filter","foreignObject","g","image","line","linearGradient","marker","mask","path","pattern","polygon","polyline","radialGradient","rect","stop","svg","switch","symbol","text","textPath","tspan","use"]),_e=/[!"#$%&'()*+,./:;<=>?@[\\\]^`{|}~-]+/g,xe=/(^-|-$)/g;function we(e){return e.replace(_e,"-").replace(xe,"")}var ye=/(a)(d)/gi,ke=function(e){return String.fromCharCode(e+(e>25?39:97))};function Se(e){var t,r="";for(t=Math.abs(e);t>52;t=t/52|0)r=ke(t%52)+r;return(ke(t%52)+r).replace(ye,"$1-$2")}var Ie,Te=function(e,t){for(var r=t.length;r;)e=33*e^t.charCodeAt(--r);return e},Fe=function(e){return Te(5381,e)};function De(e){return Se(Fe(e)>>>0)}function Le(e){return"string"==typeof e&&!0}var Pe="function"==typeof Symbol&&Symbol.for,Ne=Pe?Symbol.for("react.memo"):60115,Ae=Pe?Symbol.for("react.forward_ref"):60112,Ve={childContextTypes:!0,contextType:!0,contextTypes:!0,defaultProps:!0,displayName:!0,getDefaultProps:!0,getDerivedStateFromError:!0,getDerivedStateFromProps:!0,mixins:!0,propTypes:!0,type:!0},Me={name:!0,length:!0,prototype:!0,caller:!0,callee:!0,arguments:!0,arity:!0},Be={$$typeof:!0,compare:!0,defaultProps:!0,displayName:!0,propTypes:!0,type:!0},Oe=((Ie={})[Ae]={$$typeof:!0,render:!0,defaultProps:!0,displayName:!0,propTypes:!0},Ie[Ne]=Be,Ie);function $e(e){return("type"in(t=e)&&t.type.$$typeof)===Ne?Be:"$$typeof"in e?Oe[e.$$typeof]:Ve;var t}var He=Object.defineProperty,je=Object.getOwnPropertyNames,ze=Object.getOwnPropertySymbols,Ge=Object.getOwnPropertyDescriptor,We=Object.getPrototypeOf,Ze=Object.prototype;function qe(e,t,r){if("string"!=typeof t){if(Ze){var n=We(t);n&&n!==Ze&&qe(e,n,r)}var i=je(t);ze&&(i=i.concat(ze(t)));for(var a=$e(e),o=$e(t),c=0;c<i.length;++c){var l=i[c];if(!(l in Me||r&&r[l]||o&&l in o||a&&l in a)){var s=Ge(t,l);try{He(e,l,s)}catch(e){}}}}return e}function Ye(e){return"function"==typeof e}function Je(e){return"object"==typeof e&&"styledComponentId"in e}function Ue(e,t){return e&&t?"".concat(e," ").concat(t):e||t||""}function Qe(e,t){if(0===e.length)return"";for(var r=e[0],n=1;n<e.length;n++)r+=t?t+e[n]:e[n];return r}function Ke(e){return null!==e&&"object"==typeof e&&e.constructor.name===Object.name&&!("props"in e&&e.$$typeof)}function Xe(e,t,r){if(void 0===r&&(r=!1),!r&&!Ke(e)&&!Array.isArray(e))return t;if(Array.isArray(t))for(var n=0;n<t.length;n++)e[n]=Xe(e[n],t[n]);else if(Ke(t))for(var n in t)e[n]=Xe(e[n],t[n]);return e}function et(e,t){Object.defineProperty(e,"toString",{value:t})}function tt(e){for(var t=[],r=1;r<arguments.length;r++)t[r-1]=arguments[r];return new Error("An error occurred. See https://github.com/styled-components/styled-components/blob/main/packages/styled-components/src/utils/errors.md#".concat(e," for more information.").concat(t.length>0?" Args: ".concat(t.join(", ")):""))}var rt=function(){function e(e){this.groupSizes=new Uint32Array(512),this.length=512,this.tag=e}return e.prototype.indexOfGroup=function(e){for(var t=0,r=0;r<e;r++)t+=this.groupSizes[r];return t},e.prototype.insertRules=function(e,t){if(e>=this.groupSizes.length){for(var r=this.groupSizes,n=r.length,i=n;e>=i;)if((i<<=1)<0)throw tt(16,"".concat(e));this.groupSizes=new Uint32Array(i),this.groupSizes.set(r),this.length=i;for(var a=n;a<i;a++)this.groupSizes[a]=0}for(var o=this.indexOfGroup(e+1),c=(a=0,t.length);a<c;a++)this.tag.insertRule(o,t[a])&&(this.groupSizes[e]++,o++)},e.prototype.clearGroup=function(e){if(e<this.length){var t=this.groupSizes[e],r=this.indexOfGroup(e),n=r+t;this.groupSizes[e]=0;for(var i=r;i<n;i++)this.tag.deleteRule(r)}},e.prototype.getGroup=function(e){var t="";if(e>=this.length||0===this.groupSizes[e])return t;for(var r=this.groupSizes[e],n=this.indexOfGroup(e),i=n+r,a=n;a<i;a++)t+="".concat(this.tag.getRule(a)).concat(fe);return t},e}(),nt=new Map,it=new Map,at=1,ot=function(e){if(nt.has(e))return nt.get(e);for(;it.has(at);)at++;var t=at++;return nt.set(e,t),it.set(t,e),t},ct=function(e,t){at=t+1,nt.set(e,t),it.set(t,e)},lt="style[".concat(ue,"][").concat(me,'="').concat(he,'"]'),st=new RegExp("^".concat(ue,'\\.g(\\d+)\\[id="([\\w\\d-]+)"\\].*?"([^"]*)')),pt=function(e,t,r){for(var n,i=r.split(","),a=0,o=i.length;a<o;a++)(n=i[a])&&e.registerName(t,n)},ut=function(e,t){for(var r,n=(null!==(r=t.textContent)&&void 0!==r?r:"").split(fe),i=[],a=0,o=n.length;a<o;a++){var c=n[a].trim();if(c){var l=c.match(st);if(l){var s=0|parseInt(l[1],10),p=l[2];0!==s&&(ct(p,s),pt(e,p,l[3]),e.getTag().insertRules(s,i)),i.length=0}else i.push(c)}}},dt=function(e){for(var t=document.querySelectorAll(lt),r=0,n=t.length;r<n;r++){var i=t[r];i&&i.getAttribute(ue)!==de&&(ut(e,i),i.parentNode&&i.parentNode.removeChild(i))}};function mt(){return e.nc}var ht=function(e){var t=document.head,r=e||t,n=document.createElement("style"),i=function(e){var t=Array.from(e.querySelectorAll("style[".concat(ue,"]")));return t[t.length-1]}(r),a=void 0!==i?i.nextSibling:null;n.setAttribute(ue,de),n.setAttribute(me,he);var o=mt();return o&&n.setAttribute("nonce",o),r.insertBefore(n,a),n},ft=function(){function e(e){this.element=ht(e),this.element.appendChild(document.createTextNode("")),this.sheet=function(e){if(e.sheet)return e.sheet;for(var t=document.styleSheets,r=0,n=t.length;r<n;r++){var i=t[r];if(i.ownerNode===e)return i}throw tt(17)}(this.element),this.length=0}return e.prototype.insertRule=function(e,t){try{return this.sheet.insertRule(t,e),this.length++,!0}catch(e){return!1}},e.prototype.deleteRule=function(e){this.sheet.deleteRule(e),this.length--},e.prototype.getRule=function(e){var t=this.sheet.cssRules[e];return t&&t.cssText?t.cssText:""},e}(),gt=function(){function e(e){this.element=ht(e),this.nodes=this.element.childNodes,this.length=0}return e.prototype.insertRule=function(e,t){if(e<=this.length&&e>=0){var r=document.createTextNode(t);return this.element.insertBefore(r,this.nodes[e]||null),this.length++,!0}return!1},e.prototype.deleteRule=function(e){this.element.removeChild(this.nodes[e]),this.length--},e.prototype.getRule=function(e){return e<this.length?this.nodes[e].textContent:""},e}(),vt=function(){function e(e){this.rules=[],this.length=0}return e.prototype.insertRule=function(e,t){return e<=this.length&&(this.rules.splice(e,0,t),this.length++,!0)},e.prototype.deleteRule=function(e){this.rules.splice(e,1),this.length--},e.prototype.getRule=function(e){return e<this.length?this.rules[e]:""},e}(),bt=ge,Et={isServer:!ge,useCSSOMInjection:!be},Ct=function(){function e(e,t,r){void 0===e&&(e=Ce),void 0===t&&(t={});var n=this;this.options=p(p({},Et),e),this.gs=t,this.names=new Map(r),this.server=!!e.isServer,!this.server&&ge&&bt&&(bt=!1,dt(this)),et(this,function(){return function(e){for(var t=e.getTag(),r=t.length,n="",i=function(r){var i=function(e){return it.get(e)}(r);if(void 0===i)return"continue";var a=e.names.get(i),o=t.getGroup(r);if(void 0===a||!a.size||0===o.length)return"continue";var c="".concat(ue,".g").concat(r,'[id="').concat(i,'"]'),l="";void 0!==a&&a.forEach(function(e){e.length>0&&(l+="".concat(e,","))}),n+="".concat(o).concat(c,'{content:"').concat(l,'"}').concat(fe)},a=0;a<r;a++)i(a);return n}(n)})}return e.registerId=function(e){return ot(e)},e.prototype.rehydrate=function(){!this.server&&ge&&dt(this)},e.prototype.reconstructWithOptions=function(t,r){return void 0===r&&(r=!0),new e(p(p({},this.options),t),this.gs,r&&this.names||void 0)},e.prototype.allocateGSInstance=function(e){return this.gs[e]=(this.gs[e]||0)+1},e.prototype.getTag=function(){return this.tag||(this.tag=(e=function(e){var t=e.useCSSOMInjection,r=e.target;return e.isServer?new vt(r):t?new ft(r):new gt(r)}(this.options),new rt(e)));var e},e.prototype.hasNameForId=function(e,t){return this.names.has(e)&&this.names.get(e).has(t)},e.prototype.registerName=function(e,t){if(ot(e),this.names.has(e))this.names.get(e).add(t);else{var r=new Set;r.add(t),this.names.set(e,r)}},e.prototype.insertRules=function(e,t,r){this.registerName(e,t),this.getTag().insertRules(ot(e),r)},e.prototype.clearNames=function(e){this.names.has(e)&&this.names.get(e).clear()},e.prototype.clearRules=function(e){this.getTag().clearGroup(ot(e)),this.clearNames(e)},e.prototype.clearTag=function(){this.tag=void 0},e}(),Rt=/&/g,_t=47;function xt(e){if(-1===e.indexOf("}"))return!1;for(var t=e.length,r=0,n=0,i=!1,a=0;a<t;a++){var o=e.charCodeAt(a);if(0!==n||i||o!==_t||42!==e.charCodeAt(a+1))if(i)42===o&&e.charCodeAt(a+1)===_t&&(i=!1,a++);else if(34!==o&&39!==o||0!==a&&92===e.charCodeAt(a-1)){if(0===n)if(123===o)r++;else if(125===o&&--r<0)return!0}else 0===n?n=o:n===o&&(n=0);else i=!0,a++}return 0!==r||0!==n}function wt(e,t){return e.map(function(e){return"rule"===e.type&&(e.value="".concat(t," ").concat(e.value),e.value=e.value.replaceAll(",",",".concat(t," ")),e.props=e.props.map(function(e){return"".concat(t," ").concat(e)})),Array.isArray(e.children)&&"@keyframes"!==e.type&&(e.children=wt(e.children,t)),e})}function yt(e){var t,r,n,i=void 0===e?Ce:e,a=i.options,o=void 0===a?Ce:a,c=i.plugins,l=void 0===c?Ee:c,s=function(e,n,i){return i.startsWith(r)&&i.endsWith(r)&&i.replaceAll(r,"").length>0?".".concat(t):e},p=l.slice();p.push(function(e){e.type===b&&e.value.includes("&")&&(e.props[0]=e.props[0].replace(Rt,r).replace(n,s))}),o.prefix&&p.push(ie),p.push(re);var u=function(e,i,a,c){void 0===i&&(i=""),void 0===a&&(a=""),void 0===c&&(c="&"),t=c,r=i,n=new RegExp("\\".concat(r,"\\b"),"g");var l=function(e){if(!xt(e))return e;for(var t=e.length,r="",n=0,i=0,a=0,o=!1,c=0;c<t;c++){var l=e.charCodeAt(c);if(0!==a||o||l!==_t||42!==e.charCodeAt(c+1))if(o)42===l&&e.charCodeAt(c+1)===_t&&(o=!1,c++);else if(34!==l&&39!==l||0!==c&&92===e.charCodeAt(c-1)){if(0===a)if(123===l)i++;else if(125===l){if(--i<0){for(var s=c+1;s<t;){var p=e.charCodeAt(s);if(59===p||10===p)break;s++}s<t&&59===e.charCodeAt(s)&&s++,i=0,c=s-1,n=s;continue}0===i&&(r+=e.substring(n,c+1),n=c+1)}else 59===l&&0===i&&(r+=e.substring(n,c+1),n=c+1)}else 0===a?a=l:a===l&&(a=0);else o=!0,c++}if(n<t){var u=e.substring(n);xt(u)||(r+=u)}return r}(function(e){if(-1===e.indexOf("//"))return e;for(var t=e.length,r=[],n=0,i=0,a=0,o=0;i<t;){var c=e.charCodeAt(i);if(34!==c&&39!==c||0!==i&&92===e.charCodeAt(i-1))if(0===a)if(40===c&&i>=3&&108==(32|e.charCodeAt(i-1))&&114==(32|e.charCodeAt(i-2))&&117==(32|e.charCodeAt(i-3)))o=1,i++;else if(o>0)41===c?o--:40===c&&o++,i++;else if(c===_t&&i+1<t&&e.charCodeAt(i+1)===_t){for(i>n&&r.push(e.substring(n,i));i<t&&10!==e.charCodeAt(i);)i++;n=i}else i++;else i++;else 0===a?a=c:a===c&&(a=0),i++}return 0===n?e:(n<t&&r.push(e.substring(n)),r.join(""))}(e)),s=ae(a||i?"".concat(a," ").concat(i," { ").concat(l," }"):l);o.namespace&&(s=wt(s,o.namespace));var u,d,m,h=[];return te(s,(u=p.concat((m=function(e){return h.push(e)},function(e){e.root||(e=e.return)&&m(e)})),d=D(u),function(e,t,r,n){for(var i="",a=0;a<d;a++)i+=u[a](e,t,r,n)||"";return i})),h};return u.hash=l.length?l.reduce(function(e,t){return t.name||tt(15),Te(e,t.name)},5381).toString():"",u}var kt=new Ct,St=yt(),It={shouldForwardProp:void 0,styleSheet:kt,stylis:St},Tt=ve?{Provider:function(e){return e.children},Consumer:function(e){return(0,e.children)(It)}}:m().createContext(It),Ft=(Tt.Consumer,ve?{Provider:function(e){return e.children},Consumer:function(e){return(0,e.children)(void 0)}}:m().createContext(void 0));function Dt(){return ve?It:m().useContext(Tt)}function Lt(e){if(ve||!m().useMemo)return e.children;var t=Dt().styleSheet,r=m().useMemo(function(){var r=t;return e.sheet?r=e.sheet:e.target&&(r=r.reconstructWithOptions({target:e.target},!1)),e.disableCSSOMInjection&&(r=r.reconstructWithOptions({useCSSOMInjection:!1})),r},[e.disableCSSOMInjection,e.sheet,e.target,t]),n=m().useMemo(function(){return yt({options:{namespace:e.namespace,prefix:e.enableVendorPrefixes},plugins:e.stylisPlugins})},[e.enableVendorPrefixes,e.namespace,e.stylisPlugins]),i=m().useMemo(function(){return{shouldForwardProp:e.shouldForwardProp,styleSheet:r,stylis:n}},[e.shouldForwardProp,r,n]);return m().createElement(Tt.Provider,{value:i},m().createElement(Ft.Provider,{value:n},e.children))}var Pt=function(){function e(e,t){var r=this;this.inject=function(e,t){void 0===t&&(t=St);var n=r.name+t.hash;e.hasNameForId(r.id,n)||e.insertRules(r.id,n,t(r.rules,n,"@keyframes"))},this.name=e,this.id="sc-keyframes-".concat(e),this.rules=t,et(this,function(){throw tt(12,String(r.name))})}return e.prototype.getName=function(e){return void 0===e&&(e=St),this.name+e.hash},e}();function Nt(e,t){return null==t||"boolean"==typeof t||""===t?"":"number"!=typeof t||0===t||e in pe||e.startsWith("--")?String(t).trim():"".concat(t,"px")}var At=function(e){return e>="A"&&e<="Z"};function Vt(e){for(var t="",r=0;r<e.length;r++){var n=e[r];if(1===r&&"-"===n&&"-"===e[0])return e;At(n)?t+="-"+n.toLowerCase():t+=n}return t.startsWith("ms-")?"-"+t:t}var Mt=function(e){return null==e||!1===e||""===e},Bt=function(e){var t=[];for(var r in e){var n=e[r];e.hasOwnProperty(r)&&!Mt(n)&&(Array.isArray(n)&&n.isCss||Ye(n)?t.push("".concat(Vt(r),":"),n,";"):Ke(n)?t.push.apply(t,u(u(["".concat(r," {")],Bt(n),!1),["}"],!1)):t.push("".concat(Vt(r),": ").concat(Nt(r,n),";")))}return t};function Ot(e,t,r,n){return Mt(e)?[]:Je(e)?[".".concat(e.styledComponentId)]:Ye(e)?!Ye(i=e)||i.prototype&&i.prototype.isReactComponent||!t?[e]:Ot(e(t),t,r,n):e instanceof Pt?r?(e.inject(r,n),[e.getName(n)]):[e]:Ke(e)?Bt(e):Array.isArray(e)?Array.prototype.concat.apply(Ee,e.map(function(e){return Ot(e,t,r,n)})):[e.toString()];var i}function $t(e){for(var t=0;t<e.length;t+=1){var r=e[t];if(Ye(r)&&!Je(r))return!1}return!0}var Ht=Fe(he),jt=function(){function e(e,t,r){this.rules=e,this.staticRulesId="",this.isStatic=(void 0===r||r.isStatic)&&$t(e),this.componentId=t,this.baseHash=Te(Ht,t),this.baseStyle=r,Ct.registerId(t)}return e.prototype.generateAndInjectStyles=function(e,t,r){var n=this.baseStyle?this.baseStyle.generateAndInjectStyles(e,t,r).className:"";if(this.isStatic&&!r.hash)if(this.staticRulesId&&t.hasNameForId(this.componentId,this.staticRulesId))n=Ue(n,this.staticRulesId);else{var i=Qe(Ot(this.rules,e,t,r)),a=Se(Te(this.baseHash,i)>>>0);if(!t.hasNameForId(this.componentId,a)){var o=r(i,".".concat(a),void 0,this.componentId);t.insertRules(this.componentId,a,o)}n=Ue(n,a),this.staticRulesId=a}else{for(var c=Te(this.baseHash,r.hash),l="",s=0;s<this.rules.length;s++){var p=this.rules[s];if("string"==typeof p)l+=p;else if(p){var u=Qe(Ot(p,e,t,r));c=Te(c,u+s),l+=u}}if(l){var d=Se(c>>>0);if(!t.hasNameForId(this.componentId,d)){var m=r(l,".".concat(d),void 0,this.componentId);t.insertRules(this.componentId,d,m)}n=Ue(n,d)}}return{className:n,css:"undefined"==typeof window?t.getTag().getGroup(ot(this.componentId)):""}},e}(),zt=ve?{Provider:function(e){return e.children},Consumer:function(e){return(0,e.children)(void 0)}}:m().createContext(void 0);zt.Consumer;var Gt={};function Wt(e,t,r){var n=Je(e),i=e,a=!Le(e),o=t.attrs,c=void 0===o?Ee:o,l=t.componentId,s=void 0===l?function(e,t){var r="string"!=typeof e?"sc":we(e);Gt[r]=(Gt[r]||0)+1;var n="".concat(r,"-").concat(De(he+r+Gt[r]));return t?"".concat(t,"-").concat(n):n}(t.displayName,t.parentComponentId):l,u=t.displayName,h=void 0===u?function(e){return Le(e)?"styled.".concat(e):"Styled(".concat(function(e){return e.displayName||e.name||"Component"}(e),")")}(e):u,f=t.displayName&&t.componentId?"".concat(we(t.displayName),"-").concat(t.componentId):t.componentId||s,g=n&&i.attrs?i.attrs.concat(c).filter(Boolean):c,v=t.shouldForwardProp;if(n&&i.shouldForwardProp){var b=i.shouldForwardProp;if(t.shouldForwardProp){var E=t.shouldForwardProp;v=function(e,t){return b(e,t)&&E(e,t)}}else v=b}var C=new jt(r,f,n?i.componentStyle:void 0);function R(e,t){return function(e,t,r){var n=e.attrs,i=e.componentStyle,a=e.defaultProps,o=e.foldedComponentIds,c=e.styledComponentId,l=e.target,s=ve?void 0:m().useContext(zt),u=Dt(),h=e.shouldForwardProp||u.shouldForwardProp,f=function(e,t,r){return void 0===r&&(r=Ce),e.theme!==r.theme&&e.theme||t||r.theme}(t,s,a)||Ce,g=function(e,t,r){for(var n,i=p(p({},t),{className:void 0,theme:r}),a=0;a<e.length;a+=1){var o=Ye(n=e[a])?n(i):n;for(var c in o)"className"===c?i.className=Ue(i.className,o[c]):"style"===c?i.style=p(p({},i.style),o[c]):i[c]=o[c]}return"className"in t&&"string"==typeof t.className&&(i.className=Ue(i.className,t.className)),i}(n,t,f),v=g.as||l,b={};for(var E in g)void 0===g[E]||"$"===E[0]||"as"===E||"theme"===E&&g.theme===f||("forwardedAs"===E?b.as=g.forwardedAs:h&&!h(E,v)||(b[E]=g[E]));var C=function(e,t){var r=Dt();return e.generateAndInjectStyles(t,r.styleSheet,r.stylis)}(i,g),R=C.className,_=C.css,x=Ue(o,c);R&&(x+=" "+R),g.className&&(x+=" "+g.className),b[Le(v)&&!Re.has(v)?"class":"className"]=x,r&&(b.ref=r);var w=(0,d.createElement)(v,b);return ve&&_?m().createElement(m().Fragment,null,m().createElement("style",{precedence:"styled-components",href:"sc-".concat(c,"-").concat(R),children:_}),w):w}(_,e,t)}R.displayName=h;var _=m().forwardRef(R);return _.attrs=g,_.componentStyle=C,_.displayName=h,_.shouldForwardProp=v,_.foldedComponentIds=n?Ue(i.foldedComponentIds,i.styledComponentId):"",_.styledComponentId=f,_.target=n?i.target:e,Object.defineProperty(_,"defaultProps",{get:function(){return this._foldedDefaultProps},set:function(e){this._foldedDefaultProps=n?function(e){for(var t=[],r=1;r<arguments.length;r++)t[r-1]=arguments[r];for(var n=0,i=t;n<i.length;n++)Xe(e,i[n],!0);return e}({},i.defaultProps,e):e}}),et(_,function(){return".".concat(_.styledComponentId)}),a&&qe(_,e,{attrs:!0,componentStyle:!0,displayName:!0,foldedComponentIds:!0,shouldForwardProp:!0,styledComponentId:!0,target:!0}),_}function Zt(e,t){for(var r=[e[0]],n=0,i=t.length;n<i;n+=1)r.push(t[n],e[n+1]);return r}new Set;var qt=function(e){return Object.assign(e,{isCss:!0})};function Yt(e){for(var t=[],r=1;r<arguments.length;r++)t[r-1]=arguments[r];if(Ye(e)||Ke(e))return qt(Ot(Zt(Ee,u([e],t,!0))));var n=e;return 0===t.length&&1===n.length&&"string"==typeof n[0]?Ot(n):qt(Ot(Zt(n,t)))}function Jt(e,t,r){if(void 0===r&&(r=Ce),!t)throw tt(1,t);var n=function(n){for(var i=[],a=1;a<arguments.length;a++)i[a-1]=arguments[a];return e(t,r,Yt.apply(void 0,u([n],i,!1)))};return n.attrs=function(n){return Jt(e,t,p(p({},r),{attrs:Array.prototype.concat(r.attrs,n).filter(Boolean)}))},n.withConfig=function(n){return Jt(e,t,p(p({},r),n))},n}var Ut=function(e){return Jt(Wt,e)},Qt=Ut;Re.forEach(function(e){Qt[e]=Ut(e)}),function(){function e(e,t){this.rules=e,this.componentId=t,this.isStatic=$t(e),Ct.registerId(this.componentId+1)}e.prototype.createStyles=function(e,t,r,n){var i=n(Qe(Ot(this.rules,t,r,n)),""),a=this.componentId+e;r.insertRules(a,a,i)},e.prototype.removeStyles=function(e,t){t.clearRules(this.componentId+e)},e.prototype.renderStyles=function(e,t,r,n){e>2&&Ct.registerId(this.componentId+e);var i=this.componentId+e;this.isStatic?r.hasNameForId(i,i)||this.createStyles(e,t,r,n):(this.removeStyles(e,r),this.createStyles(e,t,r,n))}}(),function(){function e(){var e=this;this._emitSheetCSS=function(){var t=e.instance.toString();if(!t)return"";var r=mt(),n=Qe([r&&'nonce="'.concat(r,'"'),"".concat(ue,'="true"'),"".concat(me,'="').concat(he,'"')].filter(Boolean)," ");return"<style ".concat(n,">").concat(t,"</style>")},this.getStyleTags=function(){if(e.sealed)throw tt(2);return e._emitSheetCSS()},this.getStyleElement=function(){var t;if(e.sealed)throw tt(2);var r=e.instance.toString();if(!r)return[];var n=((t={})[ue]="",t[me]=he,t.dangerouslySetInnerHTML={__html:r},t),i=mt();return i&&(n.nonce=i),[m().createElement("style",p({},n,{key:"sc-0-0"}))]},this.seal=function(){e.sealed=!0},this.instance=new Ct({isServer:!0}),this.sealed=!1}e.prototype.collectStyles=function(e){if(this.sealed)throw tt(2);return m().createElement(Lt,{sheet:this.instance},e)},e.prototype.interleaveWithNodeStream=function(e){throw tt(3)}}(),"__sc-".concat(ue,"__");const Kt=Qt.div`
    display: flex;
    gap: 16px;
`,Xt=Qt.div`
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
`,er=Qt.div`
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
`;var tr=({icon:e,title:t,description:r,...n})=>React.createElement(Kt,n,e&&React.createElement(Xt,null,React.createElement("span",{className:"icon-box-icon"},e)),React.createElement(er,null,t&&React.createElement("span",{className:"icon-box-title"},t),r&&React.createElement("span",{className:"icon-box-description"},r)));const rr=Qt.div`
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
`,nr=Qt.div``,ir=Qt.div`
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
`,ar=Qt.div`
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
`,or=Qt.div`
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
`;var cr=({options:e,onChange:t,selected:r})=>React.createElement(rr,null,e.map(e=>{const{id:n,image:i,title:a,description:o}=e;return React.createElement(nr,{key:n},React.createElement(ir,{onClick:()=>t(n),isActive:r&&r===n},React.createElement(ar,null,i),React.createElement(or,null,React.createElement("span",{className:"import-option-title"},a),React.createElement("span",{className:"import-option-description"},o))))}));const lr=Qt.button`
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
`,sr=Qt.span`
    display: inline-flex;
    align-items: center;
    font-size: 24px;
    svg{
        width: 1em;
        height: 1em;
    }
`;var pr=({label:e,children:t,prevIcon:r,nextIcon:n,...i})=>React.createElement(lr,i,r&&React.createElement(sr,null,r),t||e,n&&React.createElement(sr,null,n)),ur=window.wp.components;const dr=Qt.div.attrs(({hasDismissButton:e,status:t,...r})=>r)`
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
`,mr=Qt.span`
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
`,hr=Qt.button`
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
`;var fr=({status:e,title:r,message:n,onDismiss:i})=>{const a=(0,t.useRef)(null);return React.createElement(dr,{ref:a,status:e,hasDismissButton:i},React.createElement("span",{className:"notification-icon"},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M9.99979 7.50019V10.8335M9.99979 14.1669H10.0081M8.84589 3.24329L1.99182 15.0821C1.61165 15.7388 1.42156 16.0671 1.44966 16.3366C1.47416 16.5716 1.5973 16.7852 1.78844 16.9242C2.00757 17.0835 2.38695 17.0835 3.14572 17.0835H16.8539C17.6126 17.0835 17.992 17.0835 18.2111 16.9242C18.4023 16.7852 18.5254 16.5716 18.5499 16.3366C18.578 16.0671 18.3879 15.7388 18.0078 15.0821L11.1537 3.24329C10.7749 2.58899 10.5855 2.26184 10.3384 2.15196C10.1228 2.05612 9.87676 2.05612 9.66121 2.15196C9.4141 2.26184 9.2247 2.58899 8.84589 3.24329Z",stroke:"currentColor",strokeWidth:"1.66667",strokeLinecap:"round",strokeLinejoin:"round"}))),React.createElement("span",{className:"notification-msg"},r&&React.createElement(mr,null,r),n||React.createElement(ur.Spinner,{style:{color:"var(--primary-color)"}})),i&&React.createElement(hr,{type:"button",onClick:()=>{a.current.style.opacity="0",setTimeout(()=>{i(!1)},300)}},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M15 5L5 15M5 5L15 15",stroke:"currentColor",strokeWidth:"1.66667",strokeLinecap:"round",strokeLinejoin:"round"}))))};const gr=Qt.div`
    max-width: 1000px;
    width: 100%;
    margin: 0 auto;
    padding: 0 15px;
`;var vr=({children:e})=>React.createElement(gr,null,e);const br=Qt.ul`
    display: flex;
    justify-content: space-between;
    position: relative;
    list-style: none;
    padding: 0;
    margin: 0 0 32px;
    z-index: 1;
`,Er=Qt.li`
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
`,Cr=Qt.span`
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
`,Rr=Qt.div`
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
`,_r=Qt.div`
    display: flex;
    flex-direction: column;
    gap: 32px;
    .import-recipe-image{
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
    }
`;var xr=({steps:e=[]})=>{const{globalState:n,setGlobalState:i,globalState:{recipesToImport:o,pns:c}}=a(),[l,s]=(0,t.useState)({current:0,completed:[]}),p=(0,t.useRef)(null),u=()=>{p.current.style.cssText="opacity: 0; transform: translateY(20px)",setTimeout(()=>{p.current.style.cssText="opacity: 1; transform: translateY(0px);transition: all .3s ease;"},30)},d=()=>e[l.current].component;return m().createElement("div",null,m().createElement(vr,null,m().createElement(br,null,e.map(({id:e,label:t},r)=>{const n=l?.current===r,i=l?.completed.includes(r);return m().createElement(Er,{current:n||i},m().createElement(Cr,{current:n,completed:i}),t)})),m().createElement(_r,{ref:p},m().createElement(d,null))),l.current<e.length-1&&m().createElement(Rr,null,m().createElement(vr,null,m().createElement(pr,{variant:"ghost",prevIcon:m().createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},m().createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"})),onClick:()=>{0!==l.current?(s({...l,current:l.current-1,completed:l.completed.filter(e=>e!==l.current-1)}),u()):i({...n,importStart:!1})}},(0,r.__)("Back","delicious-recipes")),m().createElement(pr,{onClick:()=>{l.current!==e.length-1&&(s({...l,current:l.current+1,completed:[...l.completed,l.current]}),u(),i({...n,pns:l.current+1!==e.length-1}))},disabled:!o.length>0,label:(0,r.__)("Proceed to Next Step","delicious-recipes")}))))};const wr=Qt.div`
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
`,yr=Qt.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
    position: sticky;
    top: 0;
    background-color: #fff;
`,kr=Qt.table`
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
`,Sr=Qt.header`
    margin: 0;
    padding: 20px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-size: 14px;
    border-bottom: 1px solid #EDEEEE;
`,Ir=Qt.footer`
    margin: 0;
    padding: 16px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-size: 14px;
    border-top: 1px solid #EDEEEE;
`,Tr=Qt.div`
    label{
        margin: 0;
        display: flex;
        align-items: center;
        font-size: inherit;
        gap: 16px;
    }
`,Fr=Qt.div`
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
`,Dr=Qt.div`
    font-weight: 500;
`,Lr=Qt.div`
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
`,Pr=({children:e,...t})=>React.createElement(kr,t,e);Pr.Header=({children:e})=>React.createElement(Sr,null,e),Pr.Footer=({children:e})=>React.createElement(Ir,null,e),Pr.Length=({value:e,onChange:t})=>{const n=[{value:10,label:(0,r.__)("10","delicious-recipes")},{value:25,label:(0,r.__)("25","delicious-recipes")},{value:50,label:(0,r.__)("50","delicious-recipes")},{value:100,label:(0,r.__)("100","delicious-recipes")},{value:"show-all",label:(0,r.__)("Show All","delicious-recipes")}];return React.createElement(Tr,null,React.createElement("label",null,(0,r.__)("Show","delicious-recipes"),React.createElement("select",{onChange:e=>t(e.target.value),value:e,name:"table-length",id:"table-length"},n.map(({value:e,label:t})=>React.createElement("option",{key:`table_length_${e}`,value:e},t))),(0,r.__)("Entries","delicious-recipes")))},Pr.Filter=({value:e,onChange:t})=>React.createElement(Fr,null,React.createElement("label",{htmlFor:"table-filter"},React.createElement("input",{type:"search",name:"import-filter",onChange:e=>t(e),value:e,id:"table-filter",placeholder:"Search"}))),Pr.Info=({length:e,total:t,currentPage:n})=>{if("show-all"===(e=0===t?"show-all":e))return React.createElement(Dr,null,(0,r.__)("Showing","delicious-recipes")," ",t," ",(0,r.__)("entries","delicious-recipes"));const i=(n-1)*e+1,a=Math.min(n*e,t);return React.createElement(Dr,null,(0,r.__)("Showing","delicious-recipes")," ",i," ",(0,r.__)("-","delicious-recipes")," ",a," ",(0,r.__)("of","delicious-recipes")," ",t," ",(0,r.__)("entries","delicious-recipes"))},Pr.Title=({children:e})=>React.createElement(yr,null,e),Pr.Paginate=({length:e,total:t,currentPage:r,setCurrentPage:n})=>{if(0===t)return;if("show-all"===e)return;const i=Math.ceil(t/e),a=Array.from({length:i},(e,t)=>t+1),o=Math.ceil(i/2);let c=!1,l=!1;return React.createElement(Lr,null,React.createElement("ul",null,React.createElement("li",null,React.createElement("a",{href:"#",className:1===r?"disabled":"",onClick:()=>1!==r&&n(r-1)},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",null,React.createElement("path",{d:"M15.8334 9.99984H4.16675M4.16675 9.99984L10.0001 15.8332M4.16675 9.99984L10.0001 4.1665",stroke:"currentColor",strokeWidth:"1.67",strokeLinecap:"round",strokeLinejoin:"round"}))))),i>5?a.map((e,t)=>{if(r<o){if((1===r?r+1:r)===e||(2===r?r+1:1)===e||i-1===e||i===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===r?"current":"",onClick:()=>n(e)},e));if(!c&&e>r+1&&e<i-1)return c=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}else if(r>o){if((r===i?r-1:r)===e||(r===i-1?r-1:i)===e||1===e||2===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===r?"current":"",onClick:()=>n(e)},e));if(!l&&(3===e||e<r-1))return l=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}else if(r===o){if(r===e||r-1===e||r+1===e||1===e||i===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===r?"current":"",onClick:()=>n(e)},e));if(!c&&e<r-1)return c=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."));if(!l&&e>r+1&&e<i)return l=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}}):a.map((e,t)=>React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===r?"current":"",onClick:()=>n(e)},e))),React.createElement("li",null,React.createElement("a",{href:"#",className:r===i?"disabled":"",onClick:()=>r!==i&&n(r+1)},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M4.16675 9.99984H15.8334M15.8334 9.99984L10.0001 4.1665M15.8334 9.99984L10.0001 15.8332",stroke:"currentColor",strokeWidth:"1.67",strokeLinecap:"round",strokeLinejoin:"round"}))))))},Pr.Container=({children:e,...t})=>React.createElement(wr,t,e),Pr.THead=({children:e,rest:t})=>React.createElement("thead",t,e),Pr.TBody=({children:e,...t})=>React.createElement("tbody",t,e),Pr.TFoot=({children:e,...t})=>React.createElement("tfoot",t,e),Pr.Tr=({items:e,children:t,...r})=>e?e.map(e=>React.createElement("tr",r,e)):React.createElement("tr",r,t),Pr.Th=({items:e,children:t,...r})=>e?e.map(e=>React.createElement("th",r,e)):React.createElement("th",r,t),Pr.Td=({items:e,children:t,...r})=>e?e.map(e=>React.createElement("td",r,e)):React.createElement("td",r,t);var Nr=Pr;function Ar(){return Ar=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)({}).hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},Ar.apply(null,arguments)}const Vr=Qt.div`
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
`,Mr=e=>React.createElement(Vr,{bulk:e?.bulk},React.createElement("input",Ar({type:"checkbox"},e)));Mr.Bulk=e=>React.createElement(Mr,Ar({bulk:!0},e));var Br=Mr,Or=()=>{const{globalState:e,setGlobalState:n,globalState:{recipes:i,selectedOption:o,recipeCount:c,recipesToList:l,list:s,currentPage:p,recipesToImport:u,deleteRecipes:d}}=a(),[m,h]=(0,t.useState)({selectedRecipes:u,localInput:"",debouncedInput:"",filteredRecipes:l,filteredRecipeList:s,filteredRecipeCount:c}),{selectedRecipes:f,localInput:g,debouncedInput:v,filteredRecipes:b,filteredRecipeList:E,filteredRecipeCount:C}=m;let R="";return"cooked"===o?R="Cooked":"wp-recipe-maker"===o&&(R="WP Recipe Maker"),(0,t.useEffect)(()=>{const e=setTimeout(()=>{h({...m,debouncedInput:g})},500);return()=>{clearTimeout(e)}},[g]),(0,t.useEffect)(()=>{let e=l,t=s,r=c;v&&(e=i.filter(e=>e.post_title.toLowerCase().includes(v.toLowerCase())),t=e.length>0||g.length>0?"show-all":s,r=e.length>0?e.length:g.length>0?0:r),h({...m,filteredRecipes:e,filteredRecipeList:t,filteredRecipeCount:r})},[v]),React.createElement(React.Fragment,null,React.createElement(Nr.Container,null,React.createElement(Nr.Header,null,React.createElement(Nr.Length,{value:E,onChange:t=>{h({...m,filteredRecipeList:t,filteredRecipes:"show-all"===t?i:i.slice(0,t)}),n({...e,currentPage:1,list:t,recipesToList:"show-all"===t?i:i.slice(0,t),recipesToImport:[]})}}),React.createElement(Nr.Filter,{value:g,onChange:e=>{h({...m,localInput:e.target.value})}})),React.createElement(Nr,{striped:!0,bordered:!0},React.createElement(Nr.THead,null,React.createElement(Nr.Tr,null,React.createElement(Nr.Th,null,React.createElement(Br.Bulk,{checked:u.length===b.length,onChange:t=>{n({...e,recipesToImport:t.target.checked?b.map(e=>({id:e.ID,post_title:e.post_title,thumbnail_url:e.thumbnail_url,author:e.author,post_date:e.post_date,post_status:e.post_status})):[]})}})),React.createElement(Nr.Th,{style:{width:"135px"}},(0,r.__)("Featured Image")),React.createElement(Nr.Th,null,(0,r.__)("Recipe Title")),React.createElement(Nr.Th,null,(0,r.__)("Author")),React.createElement(Nr.Th,null,(0,r.__)("Date Published")))),React.createElement(Nr.TBody,null,""!==g&&0===b.length&&React.createElement(Nr.Tr,null,React.createElement(Nr.Td,{colSpan:"5"},React.createElement(fr,{status:"error",message:(0,r.__)("No recipes found.","delicious-recipes")}))),f?.map((t,r)=>{const a=i.find(e=>e.ID===t.id);return React.createElement(Nr.Tr,{key:r},React.createElement(Nr.Td,null,React.createElement(Br,{checked:f.some(e=>e.id===a.ID),onChange:t=>{n({...e,recipesToImport:t.target.checked?[...f,{id:a.ID,post_title:a.post_title,thumbnail_url:a.thumbnail_url,author:a.author,post_date:a.post_date,post_status:a.post_status}]:f.filter(e=>e.id!==a.ID)})}})),React.createElement(Nr.Td,null,a.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:a.thumbnail_url,alt:a.post_title})),React.createElement(Nr.Td,null,React.createElement("strong",null,a.post_title),"publish"!==a.post_status&&React.createElement("span",{className:" wpd-ml-1 dr-badge"},a.post_status)),React.createElement(Nr.Td,null,a.author),React.createElement(Nr.Td,null,a.post_date))}),f.length>0&&React.createElement(Nr.Tr,null,React.createElement(Nr.Td,{colSpan:"5"},React.createElement(fr,{message:(0,r.__)("Selected recipes listed above.","delicious-recipes")}))),b?.filter(e=>!f.some(t=>t.id===e.ID)).map((t,r)=>React.createElement(Nr.Tr,{key:r},React.createElement(Nr.Td,null,React.createElement(Br,{checked:u.some(e=>e.id===t.ID),onChange:r=>{n({...e,recipesToImport:r.target.checked?[...u,{id:t.ID,post_title:t.post_title,thumbnail_url:t.thumbnail_url,author:t.author,post_date:t.post_date,post_status:t.post_status}]:u.filter(e=>e.id!==t.ID)})}})),React.createElement(Nr.Td,null,t.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:t.thumbnail_url,alt:t.post_title})),React.createElement(Nr.Td,null,React.createElement("strong",null,t.post_title),"publish"!==t.post_status&&React.createElement("span",{className:" wpd-ml-1 dr-badge"},t.post_status)),React.createElement(Nr.Td,null,t.author),React.createElement(Nr.Td,null,t.post_date))))),React.createElement(Nr.Footer,null,React.createElement(Nr.Info,{length:E,total:C,currentPage:p}),React.createElement(Nr.Paginate,{length:E,total:C,currentPage:p,setCurrentPage:t=>{n({...e,currentPage:t,recipesToImport:[],recipesToList:i.slice((t-1)*E,t*E)})}}))),React.createElement("label",null,React.createElement(Br,{checked:d,onChange:t=>{n({...e,deleteRecipes:!!t.target.checked})}}),(0,r.__)("Delete the recipes from ","delicious-recipes"),React.createElement("strong",null,R),(0,r.__)(" after a successful import.","delicious-recipes")))},$r=({children:e,onClick:t,label:r,description:n,small:i})=>{const a=i?" small":"";return React.createElement("div",{className:`wpdelicious-dropzone-container${a}`},React.createElement("div",{className:"wpdelicious-dropzone",onClick:t},React.createElement("span",{className:"upload-icon"},React.createElement("svg",{width:"36",height:"36",viewBox:"0 0 36 36",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M11.9999 24L17.9999 18M17.9999 18L23.9999 24M17.9999 18V31.5M29.9999 25.1143C31.8322 23.6011 32.9999 21.3119 32.9999 18.75C32.9999 14.1937 29.3063 10.5 24.7499 10.5C24.4222 10.5 24.1155 10.329 23.9491 10.0466C21.993 6.72725 18.3816 4.5 14.2499 4.5C8.03674 4.5 2.99994 9.5368 2.99994 15.75C2.99994 18.8492 4.25311 21.6556 6.28036 23.6903",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))),r&&React.createElement("label",null,r),!i&&n&&React.createElement("span",{className:"wpdelicious-supported-files"},n)),e)};const Hr=Qt.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
`,jr=Qt.div`
    height: 1px;
    border-bottom: 1px solid #E5EEEE;
`,zr=Qt.div`
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
`,Gr=Qt.button`
    cursor: pointer;
    &:hover {
        svg {
            path {
                stroke: #FF0000;
            }
        }
    }
`;var Wr=({})=>{const{globalState:e,setGlobalState:t,globalState:{recipes:n,importCSVFileName:i,importCSVFileURL:o,importCSVFileSize:l,deleteCSV:p}}=a(),u=function(){var r=c(function*(r){const n=yield s()({path:`/deliciousrecipe/v1/get_csv_data?file=${r.id}`});let i=n?.data?.recipes;t({...e,recipes:i,recipesToImport:i,importCSVFileID:r.id,importCSVFileName:r.filename,importCSVFileURL:r.url,importCSVFileSize:r.filesizeHumanReadable,CSVFileHeaders:n?.data?.headers})});return function(_x){return r.apply(this,arguments)}}();return React.createElement(React.Fragment,null,React.createElement(pn,null,React.createElement(Hr,null,(0,r.__)("CSV File Upload")),React.createElement("a",{href:"https://wpdelicious.com/docs/import-recipes-from-csv-file/",target:"_blank",rel:"noreferrer",download:!0},(0,r.__)("Learn how to format your CSV file for import.","delicious-recipes")),React.createElement($r,{onClick:()=>{return t=["text/csv"],e&&e.close(),(e=wp.media.frames.file_frame=wp.media({title:(0,r.__)("Choose CSV File","delicious-recipes"),button:{text:(0,r.__)("Add CSV File","delicious-recipes")},library:{type:t},multiple:!1})).on("select",function(){e.state().get("selection").map(function(e,n){e=e.toJSON(),-1!==t.indexOf(e.mime)?u(e):alert((0,r.__)("Please select a valid CSV file.","delicious-recipes"))})}),void e.open();var e,t},label:(0,r.__)("Choose File to upload"),description:(0,r.__)("Supported file types .csv")}),React.createElement(jr,null),o?React.createElement(React.Fragment,null,React.createElement(zr,null,React.createElement(tr,{icon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 16 16",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M9.33329 1.51265V4.26634C9.33329 4.63971 9.33329 4.82639 9.40595 4.969C9.46987 5.09444 9.57186 5.19643 9.6973 5.26035C9.83991 5.33301 10.0266 5.33301 10.4 5.33301H13.1537M13.3333 6.65849V11.4663C13.3333 12.5864 13.3333 13.1465 13.1153 13.5743C12.9236 13.9506 12.6176 14.2566 12.2413 14.4484C11.8134 14.6663 11.2534 14.6663 10.1333 14.6663H5.86663C4.74652 14.6663 4.18647 14.6663 3.75864 14.4484C3.38232 14.2566 3.07636 13.9506 2.88461 13.5743C2.66663 13.1465 2.66663 12.5864 2.66663 11.4663V4.53301C2.66663 3.4129 2.66663 2.85285 2.88461 2.42503C3.07636 2.0487 3.38232 1.74274 3.75864 1.55099C4.18647 1.33301 4.74652 1.33301 5.86663 1.33301H8.00781C8.49699 1.33301 8.74158 1.33301 8.97176 1.38827C9.17583 1.43726 9.37092 1.51807 9.54986 1.62773C9.7517 1.75141 9.92465 1.92436 10.2706 2.27027L12.396 4.39575C12.7419 4.74165 12.9149 4.9146 13.0386 5.11644C13.1482 5.29538 13.229 5.49047 13.278 5.69454C13.3333 5.92472 13.3333 6.16931 13.3333 6.65849Z",stroke:"#2DB68D",strokeWidth:"1.33333",strokeLinecap:"round",strokeLinejoin:"round"})),title:`${i}`,description:l}),React.createElement(Gr,{type:"button",onClick:()=>{t({...e,recipes:[],recipesToImport:[],importCSVFileID:null,importCSVFileName:null,importCSVFileURL:null,importCSVFileSize:null,CSVFileHeaders:[]})}},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",{opacity:"0.5"},React.createElement("path",{d:"M13.3333 5.00033V4.33366C13.3333 3.40024 13.3333 2.93353 13.1517 2.57701C12.9919 2.2634 12.7369 2.00844 12.4233 1.84865C12.0668 1.66699 11.6001 1.66699 10.6667 1.66699H9.33333C8.39991 1.66699 7.9332 1.66699 7.57668 1.84865C7.26308 2.00844 7.00811 2.2634 6.84832 2.57701C6.66667 2.93353 6.66667 3.40024 6.66667 4.33366V5.00033M8.33333 9.58366V13.7503M11.6667 9.58366V13.7503M2.5 5.00033H17.5M15.8333 5.00033V14.3337C15.8333 15.7338 15.8333 16.4339 15.5608 16.9686C15.3212 17.439 14.9387 17.8215 14.4683 18.0612C13.9335 18.3337 13.2335 18.3337 11.8333 18.3337H8.16667C6.76654 18.3337 6.06647 18.3337 5.53169 18.0612C5.06129 17.8215 4.67883 17.439 4.43915 16.9686C4.16667 16.4339 4.16667 15.7338 4.16667 14.3337V5.00033",stroke:"#505556",strokeWidth:"1.66667",strokeLinecap:"round",strokeLinejoin:"round"}))))),n?.length>0&&React.createElement(fr,{status:"success",message:(0,r.__)(`File processed successfully. ${n.length} recipes found.`)})):React.createElement(fr,{status:"warning",message:(0,r.__)("Please upload or choose CSV file to proceed with the import.","delicious-recipes")})),React.createElement("label",null,React.createElement(Br,{checked:p,onChange:r=>{t({...e,deleteCSV:!!r.target.checked})}}),(0,r.__)("Delete the CSV file after a successful import.","delicious-recipes")))},Zr=()=>{const{globalState:e,setGlobalState:t,recipe_metadata:n,wpd_fields:i,globalState:{recipeFields:o,importPluginFields:c,CSVFileHeaders:l,CSVFields:s,isCSV:p}}=a();return React.createElement(Nr.Container,null,React.createElement(Nr.Header,null,React.createElement(Nr.Title,null,(0,r.__)("Map Recipes Fields","delicious-recipes"))),React.createElement(Nr,{striped:!0,bordered:!0},React.createElement(Nr.THead,null,React.createElement(Nr.Tr,null,React.createElement(Nr.Th,null,(0,r.__)("Plugin Fields","delicious-recipes")),React.createElement(Nr.Th,null,(0,r.__)("Map With","delicious-recipes")))),React.createElement(Nr.TBody,null,Object.keys(i)?.map((n,a)=>React.createElement(Nr.Tr,{key:a},React.createElement(Nr.Td,null,React.createElement("strong",null,i[n])),React.createElement(Nr.Td,null,React.createElement("select",{value:o[n]?o[n]:"",onChange:r=>{let a={...o};"recipe_keywords"===i[n]?a[n]={type:"keywords",value:""===r.target.value?"":r.target.value}:a[n]=""===r.target.value?"":r.target.value,t({...e,recipeFields:a})}},React.createElement("option",{value:""},(0,r.__)("Select Field","delicious-recipes")),(p?l:c)?.map((e,t)=>React.createElement("option",{key:t,value:e},e))))))),p&&React.createElement(React.Fragment,null,React.createElement(Nr.THead,null,React.createElement(Nr.Tr,null,React.createElement(Nr.Th,null,(0,r.__)("CSV Fields","delicious-recipes")),React.createElement(Nr.Th,null,(0,r.__)("Map With","delicious-recipes")))),React.createElement(Nr.TBody,null,Object.keys(n)?.map((i,a)=>React.createElement(Nr.Tr,{key:a},React.createElement(Nr.Td,null,React.createElement("strong",null,n[i].label)),React.createElement(Nr.Td,null,React.createElement("select",{value:s[i]?s[i]:"",onChange:r=>{let n={...s};n[i]=""===r.target.value?"":r.target.value,t({...e,CSVFields:n})}},React.createElement("option",{value:""},(0,r.__)("Select Field","delicious-recipes")),l?.map((e,t)=>React.createElement("option",{key:t,value:e},e))))))))))};const qr=Qt.div`
    padding: 24px;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 24px;
    ${e=>e.starter&&"\n        padding: 32px;\n    "}
`,Yr=Qt.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
`,Jr=Qt.div`
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
`;var Ur=()=>{const{globalState:{recipes:e,recipeFields:n,recipesToImport:i},wpd_fields:o}=a(),[c,l]=(0,t.useState)(!1);return React.createElement(qr,null,React.createElement(Yr,null,(0,r.__)("Recipes to Import")),React.createElement(Nr.Container,null,React.createElement(Nr,{bordered:!0,striped:!0},React.createElement(Nr.THead,null,React.createElement(Nr.Tr,null,React.createElement(Nr.Th,null,"Featured Image"),React.createElement(Nr.Th,null,"Recipe Title"))),React.createElement(Nr.TBody,null,i?.slice(0,c?i.length:3).map((t,r)=>{const n=e.find(e=>e.ID===t.id);return React.createElement(Nr.Tr,{key:r},React.createElement(Nr.Td,null,n.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:n.thumbnail_url,alt:n.post_title})),React.createElement(Nr.Td,null,React.createElement("strong",null,n.post_title)))})),i?.length>3&&!c&&React.createElement(Nr.TFoot,null,React.createElement(Nr.Tr,null,React.createElement(Nr.Td,{colSpan:"2",style:{textAlign:"center"}},React.createElement(pr,{label:"View All",variant:"ghost",onClick:()=>{l(!0)},nextIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 9L12 15L18 9",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))})))),c&&React.createElement(Nr.TFoot,null,React.createElement(Nr.Tr,null,React.createElement(Nr.Td,{colSpan:"2",style:{textAlign:"center"}},React.createElement(pr,{label:"View Less",variant:"ghost",onClick:()=>l(!1),nextIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 15L12 9L18 15",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))})))))),React.createElement(Jr,null,React.createElement(Yr,null,(0,r.__)("Fields Mapped:","delicious-recipes")),Object.keys(n)?.map((e,t)=>n[e]?React.createElement("ul",{key:t},React.createElement("li",null,React.createElement("span",{className:"label"},o[e],":"),React.createElement("span",{className:"value"},n[e]))):null)))};const Qr=Qt.div`
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #344054;
`,Kr=Qt.div`
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
`;var Xr=({progress:e=0})=>(e=Math.floor(e),React.createElement(Qr,null,React.createElement(Kr,null,React.createElement("span",{className:"progressbar-progress",style:{width:`${e}%`}})),e,"%"));const en=Qt.div`
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
`,tn=Qt.div`
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
`;var rn=({items:e=[]})=>(console.log(e),React.createElement(en,null,e.map(e=>React.createElement(tn,{status:e.status},e.name))));const nn=Qt.div`
    padding: 32px 24px;
    background-color: #ffffff;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    text-align: center;
    max-width: 576px;
    margin: 0 auto;
`,an=Qt.div`
    margin: 0 0 16px;
    svg{
        width: 69px;
        height: 69px;
        vertical-align: top;
    }
`,on=Qt.div`
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
`;var cn=({icon:e,title:t,text:r,children:n,...i})=>React.createElement(nn,i,React.createElement(an,null,e),React.createElement(on,null,React.createElement("h5",null,t),React.createElement("p",null,r)),n),ln=()=>{const{globalState:{recipes:e,selectedOption:n,recipesToImport:i,recipeFields:o,deleteRecipes:l,importCSVFileID:p,CSVFileHeaders:u,CSVFields:d,isCSV:m,deleteCSV:h}}=a(),[f,g]=(0,t.useState)({progress:0,finalImportRecipes:m?[]:i.map(e=>({name:e.post_title,status:"pending"})),importProcessDone:!1,importProcessMessage:""}),v=[],b=[],{progress:E,importProcessDone:C,importProcessMessage:R,finalImportRecipes:_}=f;return Object.keys(o).map((e,t)=>{o[e]&&v.push({to:e,from:o[e]})}),(0,t.useEffect)(()=>{let t=!0;if(m){const r=function(){var r=c(function*(){for(let r=0;r<e.length;r++){const i=yield s()({path:`/deliciousrecipe/v1/import_recipes?selectedOption=${n}`,method:"POST",data:{recipe:JSON.stringify(e[r]),CSVFileHeaders:JSON.stringify(u),CSVFields:JSON.stringify(d),recipeFields:JSON.stringify(v)}});if(!i.status){g({...f,importProcessDone:!0,importProcessMessage:"failure"}),t=!1;break}g(t=>({...t,progress:(r+1)/e.length*100,finalImportRecipes:[...t.finalImportRecipes,{name:i.recipe,status:"success"}]}))}t&&(h?s()({path:`/deliciousrecipe/v1/delete_csv?selectedOption=${n}`,method:"POST",data:{CSV_id:p}}).then(e=>{e.status?g({...f,importProcessDone:!0,importProcessMessage:"success"}):g({...f,importProcessDone:!0,importProcessMessage:"failure"})}):g({...f,importProcessDone:!0,importProcessMessage:"success"}))});return function(){return r.apply(this,arguments)}}();r()}else{s()({path:"/deliciousrecipe/v1/import_recipe_fields",method:"POST",data:{recipe_fields:JSON.stringify(v),selected_option:JSON.stringify(n),posts:JSON.stringify(i)}}).then(t=>{t.status?(b.push(t.data),g({...f,progress:10}),e()):g({...f,importProcessDone:!0,importProcessMessage:"failure"})});const e=function(){var e=c(function*(){for(let e=0;e<i.length;e++){if(!(yield s()({path:`/deliciousrecipe/v1/import_recipes?selectedOption=${n}`,method:"POST",data:{recipe_id:JSON.stringify(i[e].id),imported_fields:JSON.stringify(b)}})).status){g({...f,importProcessDone:!0,importProcessMessage:"failure"}),t=!1;break}g({...f,progress:(e+1)/i.length*100,finalImportRecipes:_.map((t,r)=>r<=e?{...t,status:"success"}:t)})}t&&(l?s()({path:`/deliciousrecipe/v1/delete_recipes?selectedOption=${n}`,method:"POST",data:{recipe_ids:JSON.stringify(i.map(e=>e.id))}}).then(e=>{e.status?g({...f,importProcessDone:!0,importProcessMessage:"success"}):g({...f,importProcessDone:!0,importProcessMessage:"failure"})}):g({...f,importProcessDone:!0,importProcessMessage:"success"}))});return function(){return e.apply(this,arguments)}}()}},[]),React.createElement(vr,null,!C&&React.createElement(pn,null,React.createElement(tr,{icon:React.createElement("svg",{width:"25",height:"25",viewBox:"0 0 25 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M24.6519 2.82855L21.8928 0.301686C21.6981 0.124223 21.3786 0 21.1158 0H5.91263C5.50735 0 5.17996 0.328305 5.17996 0.734497V4.31332H1.27206C0.57095 4.31332 0 4.88514 0 5.58858V8.61777C0 9.32121 0.57095 9.89303 1.27206 9.89303H5.17996V24.265C5.17996 24.6712 5.50735 25 5.91263 25H24.2673C24.6726 25 25 24.6712 25 24.265V3.62072C25 3.34171 24.8575 3.01686 24.6519 2.82855ZM1.27206 8.95692C1.0852 8.95692 0.932847 8.80459 0.932847 8.61777V5.58858C0.932847 5.40126 1.0852 5.24894 1.27206 5.24894H5.17996H6.11232H8.08648C8.48979 5.24894 8.81915 4.91916 8.81915 4.51444V3.16179C8.86451 3.17362 8.9153 3.19925 8.96164 3.24608L9.91322 4.20043L10.8466 5.13556L12.5703 6.86385C12.6339 6.92793 12.6703 7.01321 12.6703 7.10293C12.6703 7.19363 12.6339 7.27891 12.5703 7.343L11.7981 8.11644L11.3322 8.58424L10.8663 9.05206L8.96263 10.9603C8.91727 11.0071 8.86747 11.0308 8.82014 11.0416V9.69191C8.82014 9.28719 8.49078 8.95692 8.08747 8.95692H6.1133H5.18095H1.27206ZM24.0667 24.0644H6.11182V9.89254H7.88581V11.1565C7.88581 11.504 8.12543 11.9038 8.52727 11.9698C8.59679 11.9822 8.6668 11.9876 8.73829 11.9876C9.07258 11.9876 9.38566 11.8579 9.62134 11.6213L12.1827 9.05156H21.2538V8.11594H13.1156L13.2275 8.00404C13.4691 7.76348 13.6022 7.44257 13.6022 7.10194C13.6022 6.76131 13.4691 6.44139 13.2295 6.20083L12.165 5.13507H21.2538V4.19994H11.2331L9.62282 2.58602C9.33685 2.29715 8.92664 2.16751 8.52677 2.23455C8.12543 2.30109 7.88532 2.70088 7.88532 3.04791V4.31332H6.11133V0.935128H21.1128C21.1523 0.936114 21.2361 0.969634 21.2642 0.99231L24.0183 3.51474C24.0376 3.53692 24.0637 3.59657 24.0667 3.62072V24.0644Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 12.0317H8.92583V12.9674H21.253V12.0317Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 15.9478H8.92583V16.8829H21.253V15.9478Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 19.8633H8.92583V20.7989H21.253V19.8633Z",fill:"currentColor"})),title:(0,r.__)("Importing Recipes"),description:(0,r.__)("Please do not close this tab during the import process.")}),React.createElement(Xr,{progress:E}),React.createElement(rn,{items:_})),C&&"success"===R&&React.createElement(cn,{icon:React.createElement("svg",{width:"70",height:"69",viewBox:"0 0 70 69",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",fill:"#F2FBF8"}),React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",stroke:"#2DB68D",strokeWidth:"1.38"}),React.createElement("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M47.1637 21.748L28.8214 39.4498L23.954 34.2494C23.0574 33.404 21.6484 33.3528 20.6237 34.0701C19.6246 34.813 19.3428 36.1195 19.9576 37.1698L25.7216 46.5459C26.2852 47.4169 27.2587 47.9549 28.3602 47.9549C29.4106 47.9549 30.4097 47.4169 30.9732 46.5459C31.8955 45.3419 49.4949 24.361 49.4949 24.361C51.8005 22.0041 49.0081 19.9291 47.1637 21.7223V21.748Z",fill:"#2DB68D"})),title:(0,r.__)("Your Recipes are imported successfully!"),text:(0,r.__)("All the imported recipes are saved as drafts. You can make the necessary changes and publish them.")},React.createElement(dn,{style:{flexDirection:"column"}},React.createElement(pr,{label:(0,r.__)("View all Recipes"),onClick:()=>{window.open("/wp-admin/edit.php?post_type=recipe","_blank")}}),React.createElement(pr,{variant:"ghost",label:(0,r.__)("Back to Dashboard"),prevIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"})),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}))),C&&"failure"===R&&React.createElement(cn,{icon:React.createElement("svg",{width:"70",height:"69",viewBox:"0 0 70 69",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",fill:"#FFE9E9"}),React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",stroke:"#FF4949",strokeWidth:"1.38"}),React.createElement("path",{d:"M37.0557 34.4683L48.6513 22.8727C48.8805 22.6051 49.0002 22.2609 48.9866 21.9089C48.973 21.5568 48.8271 21.2229 48.578 20.9738C48.3289 20.7247 47.9949 20.5787 47.6429 20.5651C47.2909 20.5516 46.9467 20.6713 46.6791 20.9004L35.0835 32.4961L23.4878 20.8865C23.2245 20.6231 22.8672 20.4751 22.4947 20.4751C22.1222 20.4751 21.765 20.6231 21.5016 20.8865C21.2382 21.1498 21.0903 21.5071 21.0903 21.8796C21.0903 22.2521 21.2382 22.6093 21.5016 22.8727L33.1112 34.4683L21.5016 46.0639C21.3552 46.1893 21.2363 46.3436 21.1523 46.5172C21.0684 46.6907 21.0212 46.8797 21.0137 47.0724C21.0063 47.265 21.0388 47.4571 21.1091 47.6366C21.1794 47.8161 21.2861 47.9791 21.4224 48.1154C21.5587 48.2517 21.7217 48.3584 21.9012 48.4287C22.0807 48.499 22.2728 48.5315 22.4654 48.5241C22.6581 48.5166 22.8471 48.4694 23.0206 48.3855C23.1942 48.3015 23.3485 48.1826 23.4739 48.0362L35.0835 36.4405L46.6791 48.0362C46.9467 48.2653 47.2909 48.3851 47.6429 48.3715C47.9949 48.3579 48.3289 48.2119 48.578 47.9628C48.8271 47.7137 48.973 47.3798 48.9866 47.0278C49.0002 46.6757 48.8805 46.3315 48.6513 46.0639L37.0557 34.4683Z",fill:"#FF4949"})),title:(0,r.__)("Import Unsuccessful"),text:(0,r.__)("Please try importing your recipes again. If the problem persists, contact our support team for assistance.")},React.createElement(dn,{style:{flexDirection:"column"}},React.createElement(pr,{label:(0,r.__)("Try Import Again"),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}),React.createElement(pr,{variant:"ghost",label:(0,r.__)("Back to Dashboard"),prevIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"})),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}))))};const{pluginUrl:sn}=dr_import||{},pn=Qt.div`
    padding: 24px;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 24px;
    ${e=>e.starter&&"\n        padding: 32px;\n    "}
`,un=Qt.div`
    padding: 64px 0;
`,dn=Qt.div`
    text-align: center;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 12px;
`,mn=Qt.h2`
    font-size: 32px;
    line-height: 1.3;
    font-weight: 600;
    margin: 0 0 32px;
    text-align: center;
`,hn=[{id:"cooked",image:React.createElement("img",{src:`${sn}/assets/images/import-recipes/cooked.png`}),title:(0,r.__)("Cooked"),description:(0,r.__)("Import all recipes from Cooked plugin.")},{id:"wp-recipe-maker",image:React.createElement("img",{src:`${sn}/assets/images/import-recipes/wp-recipe-maker.png`}),title:(0,r.__)("WP Recipe Maker"),description:(0,r.__)("Import all recipes from WP Recipe Maker plugin.")},{id:"csv",image:React.createElement("img",{src:`${sn}/assets/images/import-recipes/csv-import.png`}),title:(0,r.__)("CSV Import"),description:(0,r.__)("Import recipes from CSV file.")},{id:"tasty-recipes",image:React.createElement("img",{src:`${sn}/assets/images/import-recipes/tasty-recipes.jpg`}),title:(0,r.__)("Tasty Recipes"),description:(0,r.__)("Import all recipes from Tasty Recipes plugin.")}];var fn=()=>{const{globalState:e,setGlobalState:n,globalState:{importStart:i,selectedOption:o,recipeCount:l,list:p,isCSV:u}}=a(),[d,m]=(0,t.useState)("");(0,t.useEffect)(()=>{o&&!u&&h(o)},[o]);const h=function(){var t=c(function*(t){n({...e,loading:!0});const[r,i]=yield Promise.all([s()({path:`/deliciousrecipe/v1/get_import_plugin_terms?selectedOption=${t}`}),s()({path:`/deliciousrecipe/v1/get_import_recipes?selectedOption=${t}`})]);i.success?n({...e,importPluginFields:r?.data||[],recipes:i?.data||[],recipeCount:i?.data?.length||0,recipesToList:i?.data?.slice(0,p)||[],loading:!1}):m(i.data)});return function(_x){return t.apply(this,arguments)}}(),f=u||o&&l>0,g=o&&l<1&&!u;return React.createElement(un,null,i?React.createElement(vr,null,React.createElement(mn,null,(0,r.__)("Import Recipes","delicious-recipes")),React.createElement(xr,{steps:[{id:"recipes-import",label:u?(0,r.__)("CSV File Upload","delicious-recipes"):(0,r.__)("Recipes to Import","delicious-recipes"),component:u?React.createElement(Wr,null):React.createElement(Or,null)},{id:"fields-mapping",label:(0,r.__)("Fields Mapping","delicious-recipes"),component:React.createElement(Zr,null)},...u?[]:[{id:"summary",label:(0,r.__)("Summary","delicious-recipes"),component:React.createElement(Ur,null)}],{id:"import-process",label:(0,r.__)("Import Process","delicious-recipes"),component:React.createElement(ln,null)}]})):React.createElement(vr,null,React.createElement(pn,{starter:!0},React.createElement(tr,{icon:React.createElement("svg",{width:"25",height:"25",viewBox:"0 0 25 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M24.6519 2.82855L21.8928 0.301686C21.6981 0.124223 21.3786 0 21.1158 0H5.91263C5.50735 0 5.17996 0.328305 5.17996 0.734497V4.31332H1.27206C0.57095 4.31332 0 4.88514 0 5.58858V8.61777C0 9.32121 0.57095 9.89303 1.27206 9.89303H5.17996V24.265C5.17996 24.6712 5.50735 25 5.91263 25H24.2673C24.6726 25 25 24.6712 25 24.265V3.62072C25 3.34171 24.8575 3.01686 24.6519 2.82855ZM1.27206 8.95692C1.0852 8.95692 0.932847 8.80459 0.932847 8.61777V5.58858C0.932847 5.40126 1.0852 5.24894 1.27206 5.24894H5.17996H6.11232H8.08648C8.48979 5.24894 8.81915 4.91916 8.81915 4.51444V3.16179C8.86451 3.17362 8.9153 3.19925 8.96164 3.24608L9.91322 4.20043L10.8466 5.13556L12.5703 6.86385C12.6339 6.92793 12.6703 7.01321 12.6703 7.10293C12.6703 7.19363 12.6339 7.27891 12.5703 7.343L11.7981 8.11644L11.3322 8.58424L10.8663 9.05206L8.96263 10.9603C8.91727 11.0071 8.86747 11.0308 8.82014 11.0416V9.69191C8.82014 9.28719 8.49078 8.95692 8.08747 8.95692H6.1133H5.18095H1.27206ZM24.0667 24.0644H6.11182V9.89254H7.88581V11.1565C7.88581 11.504 8.12543 11.9038 8.52727 11.9698C8.59679 11.9822 8.6668 11.9876 8.73829 11.9876C9.07258 11.9876 9.38566 11.8579 9.62134 11.6213L12.1827 9.05156H21.2538V8.11594H13.1156L13.2275 8.00404C13.4691 7.76348 13.6022 7.44257 13.6022 7.10194C13.6022 6.76131 13.4691 6.44139 13.2295 6.20083L12.165 5.13507H21.2538V4.19994H11.2331L9.62282 2.58602C9.33685 2.29715 8.92664 2.16751 8.52677 2.23455C8.12543 2.30109 7.88532 2.70088 7.88532 3.04791V4.31332H6.11133V0.935128H21.1128C21.1523 0.936114 21.2361 0.969634 21.2642 0.99231L24.0183 3.51474C24.0376 3.53692 24.0637 3.59657 24.0667 3.62072V24.0644Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 12.0317H8.92583V12.9674H21.253V12.0317Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 15.9478H8.92583V16.8829H21.253V15.9478Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 19.8633H8.92583V20.7989H21.253V19.8633Z",fill:"currentColor"})),title:(0,r.__)("Import Recipes","delicious-recipes"),description:(0,r.__)("Select from the options below to import your recipes.","delicious-recipes")}),React.createElement(cr,{options:hn,selected:o,onChange:t=>n({...e,selectedOption:t,isCSV:"csv"===t})}),f&&React.createElement(fr,{key:"warning",onDismiss:()=>n({...e,showMsg:!1}),status:"warning",message:(0,r.__)("We recommend taking a full backup of your site before proceeding with the import. Alternatively, you can also create a staging site and import the recipes.","delicious-recipes")}),g&&React.createElement(fr,{key:"error",status:"error",message:d}),React.createElement(dn,null,React.createElement(pr,{type:"button",disabled:!(u||o&&l>=1),label:(0,r.__)("Proceed to Next Step","delicious-recipes"),onClick:()=>n({...e,importStart:!0})})))))};const{pluginUrl:gn}=dr_import||{};var vn=({pageTitle:e})=>React.createElement("header",{className:"wpdelicious-setting-header border-bottom-1 top-2 flex items-center gap-1"},React.createElement("div",{className:"wpdelicious-logo"},React.createElement("img",{src:gn?`${gn}assets/images/Delicious-Recipes.png`:""})),e&&React.createElement("span",{className:"dr-page-name"},e));let bn=document.getElementById("delicious-recipe-import"),En=bn.dataset.restNonce;(0,t.createRoot)(bn).render(React.createElement(i,null,React.createElement(vn,null),React.createElement(fn,{rest_nonce:En}))),(drExports=void 0===drExports?{}:drExports).import={}}();