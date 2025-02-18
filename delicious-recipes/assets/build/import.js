var drExports;!function(){var e={2833:function(e){e.exports=function(e,t,r,n){var i=r?r.call(n,e,t):void 0;if(void 0!==i)return!!i;if(e===t)return!0;if("object"!=typeof e||!e||"object"!=typeof t||!t)return!1;var a=Object.keys(e),o=Object.keys(t);if(a.length!==o.length)return!1;for(var l=Object.prototype.hasOwnProperty.bind(t),c=0;c<a.length;c++){var s=a[c];if(!l(s))return!1;var p=e[s],u=t[s];if(!1===(i=r?r.call(n,p,u,s):void 0)||void 0===i&&p!==u)return!1}return!0}}},t={};function r(n){var i=t[n];if(void 0!==i)return i.exports;var a=t[n]={exports:{}};return e[n](a,a.exports,r),a.exports}r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.nc=void 0,function(){"use strict";var e=window.wp.element,t=window.wp.i18n;const n=(0,e.createContext)();function i(r){let{children:i}=r;const[a,o]=(0,e.useState)({loading:!1,selectedOption:"",showMsg:!0,importStart:!1,importSuccess:!1,pns:!1,recipes:[],recipeCount:0,recipesToList:[],list:10,currentPage:1,recipesToImport:[],deleteRecipes:!1,recipeFields:[],importPluginFields:[],importCSVFileID:"",importCSVFileName:"",importCSVFileURL:"",importCSVFileSize:"",CSVFileHeaders:[],CSVFields:[],isCSV:!1,deleteCSV:!1}),l={recipeTitle:{value:"recipeTitle",label:(0,t.__)("Recipe Title","delicious-recipes"),section:"Post Info"},postContent:{value:"postContent",label:(0,t.__)("Post Content","delicious-recipes"),section:"Post Info"},postExcerpt:{value:"postExcerpt",label:(0,t.__)("Post Excerpt","delicious-recipes"),section:"Post Info"},featuredImage:{value:"featuredImage",label:(0,t.__)("Featured Image","delicious-recipes"),section:"Post Info"},recipeAuthor:{value:"recipeAuthor",label:(0,t.__)("Recipe Author","delicious-recipes"),section:"Post Info"},recipeAuthorEmail:{value:"recipeAuthorEmail",label:(0,t.__)("Recipe Author Email","delicious-recipes"),section:"Post Info"},commnetStatus:{value:"commnetStatus",label:(0,t.__)("Comment Status","delicious-recipes"),section:"Post Info"},recipeSubtitle:{value:"recipeSubtitle",label:(0,t.__)("Recipe Subtitle","delicious-recipes"),section:"Recipe Info"},recipeDescription:{value:"recipeDescription",label:(0,t.__)("Recipe Description","delicious-recipes"),section:"Recipe Info"},difficultyLevel:{value:"difficultyLevel",label:(0,t.__)("Difficulty Level","delicious-recipes"),section:"Recipe Info"},prepTime:{value:"prepTime",label:(0,t.__)("Prep Time","delicious-recipes"),section:"Recipe Info"},cookTime:{value:"cookTime",label:(0,t.__)("Cook Time","delicious-recipes"),section:"Recipe Info"},restTime:{value:"restTime",label:(0,t.__)("Rest Time","delicious-recipes"),section:"Recipe Info"},cookingTemp:{value:"cookingTemp",label:(0,t.__)("Cooking Temperature","delicious-recipes"),section:"Recipe Info"},recipeCalories:{value:"recipeCalories",label:(0,t.__)("Recipe Calories","delicious-recipes"),section:"Recipe Info"},bestSeason:{value:"bestSeason",label:(0,t.__)("Best Season","delicious-recipes"),section:"Recipe Info"},estimatedCost:{value:"estimatedCost",label:(0,t.__)("Estimated Cost","delicious-recipes"),section:"Recipe Info"},noOfServings:{value:"noOfServings",label:(0,t.__)("Number of Servings","delicious-recipes"),section:"Ingredients"},ingredientTitle:{value:"ingredientTitle",label:(0,t.__)("Ingredient Title","delicious-recipes"),section:"Ingredients"},ingredients:{value:"ingredients",label:(0,t.__)("Ingredients","delicious-recipes"),section:"Ingredients"},instructionTitle:{value:"instructionTitle",label:(0,t.__)("Instruction Title","delicious-recipes"),section:"Instructions"},instructions:{value:"instructions",label:(0,t.__)("Instructions","delicious-recipes"),section:"Instructions"},imageGallery:{value:"imageGallery",label:(0,t.__)("Image Gallery","delicious-recipes"),section:"Gallery"},videoGallery:{value:"videoGallery",label:(0,t.__)("Video Gallery","delicious-recipes"),section:"Gallery"},servingSize:{value:"servingSize",label:(0,t.__)("Serving Size","delicious-recipes"),section:"Nutrition"},calories:{value:"calories",label:(0,t.__)("Calories","delicious-recipes"),section:"Nutrition"},totalFat:{value:"totalFat",label:(0,t.__)("Total Fat","delicious-recipes"),section:"Nutrition"},saturatedFat:{value:"saturatedFat",label:(0,t.__)("Saturated Fat","delicious-recipes"),section:"Nutrition"},transFat:{value:"transFat",label:(0,t.__)("Trans Fat","delicious-recipes"),section:"Nutrition"},cholesterol:{value:"cholesterol",label:(0,t.__)("Cholesterol","delicious-recipes"),section:"Nutrition"},sodium:{value:"sodium",label:(0,t.__)("Sodium","delicious-recipes"),section:"Nutrition"},potassium:{value:"potassium",label:(0,t.__)("Potassium","delicious-recipes"),section:"Nutrition"},totalCarbohydrate:{value:"totalCarbohydrate",label:(0,t.__)("Total Carbohydrate","delicious-recipes"),section:"Nutrition"},dietaryFiber:{value:"dietaryFiber",label:(0,t.__)("Dietary Fiber","delicious-recipes"),section:"Nutrition"},sugars:{value:"sugars",label:(0,t.__)("Sugars","delicious-recipes"),section:"Nutrition"},protein:{value:"protein",label:(0,t.__)("Protein","delicious-recipes"),section:"Nutrition"},vitaminA:{value:"vitaminA",label:(0,t.__)("Vitamin A","delicious-recipes"),section:"Nutrition"},vitaminC:{value:"vitaminC",label:(0,t.__)("Vitamin C","delicious-recipes"),section:"Nutrition"},vitaminD:{value:"vitaminD",label:(0,t.__)("Vitamin D","delicious-recipes"),section:"Nutrition"},vitaminE:{value:"vitaminE",label:(0,t.__)("Vitamin E","delicious-recipes"),section:"Nutrition"},vitaminK:{value:"vitaminK",label:(0,t.__)("Vitamin K","delicious-recipes"),section:"Nutrition"},vitaminB6:{value:"vitaminB6",label:(0,t.__)("Vitamin B6","delicious-recipes"),section:"Nutrition"},vitaminB12:{value:"vitaminB12",label:(0,t.__)("Vitamin B12","delicious-recipes"),section:"Nutrition"},calcium:{value:"calcium",label:(0,t.__)("Calcium","delicious-recipes"),section:"Nutrition"},iron:{value:"iron",label:(0,t.__)("Iron","delicious-recipes"),section:"Nutrition"},thiamin:{value:"thiamin",label:(0,t.__)("Thiamin","delicious-recipes"),section:"Nutrition"},riboflavin:{value:"riboflavin",label:(0,t.__)("Riboflavin","delicious-recipes"),section:"Nutrition"},niacin:{value:"niacin",label:(0,t.__)("Niacin","delicious-recipes"),section:"Nutrition"},folate:{value:"folate",label:(0,t.__)("Folate","delicious-recipes"),section:"Nutrition"},biotin:{value:"biotin",label:(0,t.__)("Biotin","delicious-recipes"),section:"Nutrition"},pantothenicAcid:{value:"pantothenicAcid",label:(0,t.__)("Pantothenic Acid","delicious-recipes"),section:"Nutrition"},phosphorus:{value:"phosphorus",label:(0,t.__)("Phosphorus","delicious-recipes"),section:"Nutrition"},iodine:{value:"iodine",label:(0,t.__)("Iodine","delicious-recipes"),section:"Nutrition"},magnesium:{value:"magnesium",label:(0,t.__)("Magnesium","delicious-recipes"),section:"Nutrition"},zinc:{value:"zinc",label:(0,t.__)("Zinc","delicious-recipes"),section:"Nutrition"},selenium:{value:"selenium",label:(0,t.__)("Selenium","delicious-recipes"),section:"Nutrition"},copper:{value:"copper",label:(0,t.__)("Copper","delicious-recipes"),section:"Nutrition"},manganese:{value:"manganese",label:(0,t.__)("Manganese","delicious-recipes"),section:"Nutrition"},chromium:{value:"chromium",label:(0,t.__)("Chromium","delicious-recipes"),section:"Nutrition"},molybdenum:{value:"molybdenum",label:(0,t.__)("Molybdenum","delicious-recipes"),section:"Nutrition"},chloride:{value:"chloride",label:(0,t.__)("Chloride","delicious-recipes"),section:"Nutrition"},recipeNotes:{value:"recipeNotes",label:(0,t.__)("Recipe Notes","delicious-recipes"),section:"Notes"},faqTitle:{value:"faqTitle",label:(0,t.__)("FAQ Title","delicious-recipes"),section:"FAQs"},recipeFAQs:{value:"recipeFAQs",label:(0,t.__)("Recipe FAQs","delicious-recipes"),section:"FAQs"},equipmentsTitle:{value:"equipmentsTitle",label:(0,t.__)("Equipments Title","delicious-recipes"),section:"Equipment"},recipeEquipments:{value:"recipeEquipments",label:(0,t.__)("Recipe Equipments","delicious-recipes"),section:"Equipment"},extendedContent:{value:"extendedContent",label:(0,t.__)("Extended Content","delicious-recipes"),section:"Extended Content"}},c={"recipe-course":(0,t.__)("Recipe Courses","delicious-recipes"),"recipe-cuisine":(0,t.__)("Recipe Cuisines","delicious-recipes"),"recipe-cooking-method":(0,t.__)("Recipe Cooking Methods","delicious-recipes"),"recipe-key":(0,t.__)("Recipe Keys","delicious-recipes"),"recipe-tag":(0,t.__)("Recipe Tags","delicious-recipes"),"recipe-badge":(0,t.__)("Recipe Badges","delicious-recipes"),"recipe-dietary":(0,t.__)("Recipe Dietaries","delicious-recipes"),recipe_keywords:(0,t.__)("Recipe Keywords","delicious-recipes")},{recipes:s,list:p,currentPage:u,recipesToList:d}=a;return s?.length>0&&0===d.length&&o({...a,recipesToList:s.slice((u-1)*p,u*p)}),React.createElement(n.Provider,{value:{globalState:a,setGlobalState:o,recipe_metadata:l,wpd_fields:c}},i)}function a(){return(0,e.useContext)(n)}function o(e,t,r,n,i,a,o){try{var l=e[a](o),c=l.value}catch(e){return void r(e)}l.done?t(c):Promise.resolve(c).then(n,i)}function l(e){return function(){var t=this,r=arguments;return new Promise((function(n,i){var a=e.apply(t,r);function l(e){o(a,n,i,l,c,"next",e)}function c(e){o(a,n,i,l,c,"throw",e)}l(void 0)}))}}var c=window.wp.apiFetch,s=r.n(c),p=function(){return p=Object.assign||function(e){for(var t,r=1,n=arguments.length;r<n;r++)for(var i in t=arguments[r])Object.prototype.hasOwnProperty.call(t,i)&&(e[i]=t[i]);return e},p.apply(this,arguments)};function u(e,t,r){if(r||2===arguments.length)for(var n,i=0,a=t.length;i<a;i++)!n&&i in t||(n||(n=Array.prototype.slice.call(t,0,i)),n[i]=t[i]);return e.concat(n||Array.prototype.slice.call(t))}Object.create,Object.create,"function"==typeof SuppressedError&&SuppressedError;var d=window.React,m=r.n(d),h=r(2833),f=r.n(h),g="-ms-",v="-moz-",b="-webkit-",E="comm",R="rule",C="decl",_="@keyframes",x=Math.abs,y=String.fromCharCode,w=Object.assign;function k(e){return e.trim()}function S(e,t){return(e=t.exec(e))?e[0]:e}function I(e,t,r){return e.replace(t,r)}function T(e,t,r){return e.indexOf(t,r)}function D(e,t){return 0|e.charCodeAt(t)}function F(e,t,r){return e.slice(t,r)}function L(e){return e.length}function P(e){return e.length}function N(e,t){return t.push(e),e}function V(e,t){return e.filter((function(e){return!S(e,t)}))}var M=1,A=1,B=0,O=0,$=0,H="";function j(e,t,r,n,i,a,o,l){return{value:e,root:t,parent:r,type:n,props:i,children:a,line:M,column:A,length:o,return:"",siblings:l}}function z(e,t){return w(j("",null,null,"",null,null,0,e.siblings),e,{length:-e.length},t)}function W(e){for(;e.root;)e=z(e.root,{children:[e]});N(e,e.siblings)}function G(){return $=O>0?D(H,--O):0,A--,10===$&&(A=1,M--),$}function Z(){return $=O<B?D(H,O++):0,A++,10===$&&(A=1,M++),$}function q(){return D(H,O)}function Y(){return O}function J(e,t){return F(H,e,t)}function U(e){switch(e){case 0:case 9:case 10:case 13:case 32:return 5;case 33:case 43:case 44:case 47:case 62:case 64:case 126:case 59:case 123:case 125:return 4;case 58:return 3;case 34:case 39:case 40:case 91:return 2;case 41:case 93:return 1}return 0}function Q(e){return k(J(O-1,ee(91===e?e+2:40===e?e+1:e)))}function K(e){for(;($=q())&&$<33;)Z();return U(e)>2||U($)>3?"":" "}function X(e,t){for(;--t&&Z()&&!($<48||$>102||$>57&&$<65||$>70&&$<97););return J(e,Y()+(t<6&&32==q()&&32==Z()))}function ee(e){for(;Z();)switch($){case e:return O;case 34:case 39:34!==e&&39!==e&&ee($);break;case 40:41===e&&ee(e);break;case 92:Z()}return O}function te(e,t){for(;Z()&&e+$!==57&&(e+$!==84||47!==q()););return"/*"+J(t,O-1)+"*"+y(47===e?e:Z())}function re(e){for(;!U(q());)Z();return J(e,O)}function ne(e,t){for(var r="",n=0;n<e.length;n++)r+=t(e[n],n,e,t)||"";return r}function ie(e,t,r,n){switch(e.type){case"@layer":if(e.children.length)break;case"@import":case C:return e.return=e.return||e.value;case E:return"";case _:return e.return=e.value+"{"+ne(e.children,n)+"}";case R:if(!L(e.value=e.props.join(",")))return""}return L(r=ne(e.children,n))?e.return=e.value+"{"+r+"}":""}function ae(e,t,r){switch(function(e,t){return 45^D(e,0)?(((t<<2^D(e,0))<<2^D(e,1))<<2^D(e,2))<<2^D(e,3):0}(e,t)){case 5103:return b+"print-"+e+e;case 5737:case 4201:case 3177:case 3433:case 1641:case 4457:case 2921:case 5572:case 6356:case 5844:case 3191:case 6645:case 3005:case 6391:case 5879:case 5623:case 6135:case 4599:case 4855:case 4215:case 6389:case 5109:case 5365:case 5621:case 3829:return b+e+e;case 4789:return v+e+e;case 5349:case 4246:case 4810:case 6968:case 2756:return b+e+v+e+g+e+e;case 5936:switch(D(e,t+11)){case 114:return b+e+g+I(e,/[svh]\w+-[tblr]{2}/,"tb")+e;case 108:return b+e+g+I(e,/[svh]\w+-[tblr]{2}/,"tb-rl")+e;case 45:return b+e+g+I(e,/[svh]\w+-[tblr]{2}/,"lr")+e}case 6828:case 4268:case 2903:return b+e+g+e+e;case 6165:return b+e+g+"flex-"+e+e;case 5187:return b+e+I(e,/(\w+).+(:[^]+)/,b+"box-$1$2"+g+"flex-$1$2")+e;case 5443:return b+e+g+"flex-item-"+I(e,/flex-|-self/g,"")+(S(e,/flex-|baseline/)?"":g+"grid-row-"+I(e,/flex-|-self/g,""))+e;case 4675:return b+e+g+"flex-line-pack"+I(e,/align-content|flex-|-self/g,"")+e;case 5548:return b+e+g+I(e,"shrink","negative")+e;case 5292:return b+e+g+I(e,"basis","preferred-size")+e;case 6060:return b+"box-"+I(e,"-grow","")+b+e+g+I(e,"grow","positive")+e;case 4554:return b+I(e,/([^-])(transform)/g,"$1"+b+"$2")+e;case 6187:return I(I(I(e,/(zoom-|grab)/,b+"$1"),/(image-set)/,b+"$1"),e,"")+e;case 5495:case 3959:return I(e,/(image-set\([^]*)/,b+"$1$`$1");case 4968:return I(I(e,/(.+:)(flex-)?(.*)/,b+"box-pack:$3"+g+"flex-pack:$3"),/s.+-b[^;]+/,"justify")+b+e+e;case 4200:if(!S(e,/flex-|baseline/))return g+"grid-column-align"+F(e,t)+e;break;case 2592:case 3360:return g+I(e,"template-","")+e;case 4384:case 3616:return r&&r.some((function(e,r){return t=r,S(e.props,/grid-\w+-end/)}))?~T(e+(r=r[t].value),"span",0)?e:g+I(e,"-start","")+e+g+"grid-row-span:"+(~T(r,"span",0)?S(r,/\d+/):+S(r,/\d+/)-+S(e,/\d+/))+";":g+I(e,"-start","")+e;case 4896:case 4128:return r&&r.some((function(e){return S(e.props,/grid-\w+-start/)}))?e:g+I(I(e,"-end","-span"),"span ","")+e;case 4095:case 3583:case 4068:case 2532:return I(e,/(.+)-inline(.+)/,b+"$1$2")+e;case 8116:case 7059:case 5753:case 5535:case 5445:case 5701:case 4933:case 4677:case 5533:case 5789:case 5021:case 4765:if(L(e)-1-t>6)switch(D(e,t+1)){case 109:if(45!==D(e,t+4))break;case 102:return I(e,/(.+:)(.+)-([^]+)/,"$1"+b+"$2-$3$1"+v+(108==D(e,t+3)?"$3":"$2-$3"))+e;case 115:return~T(e,"stretch",0)?ae(I(e,"stretch","fill-available"),t,r)+e:e}break;case 5152:case 5920:return I(e,/(.+?):(\d+)(\s*\/\s*(span)?\s*(\d+))?(.*)/,(function(t,r,n,i,a,o,l){return g+r+":"+n+l+(i?g+r+"-span:"+(a?o:+o-+n)+l:"")+e}));case 4949:if(121===D(e,t+6))return I(e,":",":"+b)+e;break;case 6444:switch(D(e,45===D(e,14)?18:11)){case 120:return I(e,/(.+:)([^;\s!]+)(;|(\s+)?!.+)?/,"$1"+b+(45===D(e,14)?"inline-":"")+"box$3$1"+b+"$2$3$1"+g+"$2box$3")+e;case 100:return I(e,":",":"+g)+e}break;case 5719:case 2647:case 2135:case 3927:case 2391:return I(e,"scroll-","scroll-snap-")+e}return e}function oe(e,t,r,n){if(e.length>-1&&!e.return)switch(e.type){case C:return void(e.return=ae(e.value,e.length,r));case _:return ne([z(e,{value:I(e.value,"@","@"+b)})],n);case R:if(e.length)return function(e,t){return e.map(t).join("")}(r=e.props,(function(t){switch(S(t,n=/(::plac\w+|:read-\w+)/)){case":read-only":case":read-write":W(z(e,{props:[I(t,/:(read-\w+)/,":-moz-$1")]})),W(z(e,{props:[t]})),w(e,{props:V(r,n)});break;case"::placeholder":W(z(e,{props:[I(t,/:(plac\w+)/,":"+b+"input-$1")]})),W(z(e,{props:[I(t,/:(plac\w+)/,":-moz-$1")]})),W(z(e,{props:[I(t,/:(plac\w+)/,g+"input-$1")]})),W(z(e,{props:[t]})),w(e,{props:V(r,n)})}return""}))}}function le(e){return function(e){return H="",e}(ce("",null,null,null,[""],e=function(e){return M=A=1,B=L(H=e),O=0,[]}(e),0,[0],e))}function ce(e,t,r,n,i,a,o,l,c){for(var s=0,p=0,u=o,d=0,m=0,h=0,f=1,g=1,v=1,b=0,E="",R=i,C=a,_=n,w=E;g;)switch(h=b,b=Z()){case 40:if(108!=h&&58==D(w,u-1)){-1!=T(w+=I(Q(b),"&","&\f"),"&\f",x(s?l[s-1]:0))&&(v=-1);break}case 34:case 39:case 91:w+=Q(b);break;case 9:case 10:case 13:case 32:w+=K(h);break;case 92:w+=X(Y()-1,7);continue;case 47:switch(q()){case 42:case 47:N(pe(te(Z(),Y()),t,r,c),c);break;default:w+="/"}break;case 123*f:l[s++]=L(w)*v;case 125*f:case 59:case 0:switch(b){case 0:case 125:g=0;case 59+p:-1==v&&(w=I(w,/\f/g,"")),m>0&&L(w)-u&&N(m>32?ue(w+";",n,r,u-1,c):ue(I(w," ","")+";",n,r,u-2,c),c);break;case 59:w+=";";default:if(N(_=se(w,t,r,s,p,i,l,E,R=[],C=[],u,a),a),123===b)if(0===p)ce(w,t,_,_,R,a,u,l,C);else switch(99===d&&110===D(w,3)?100:d){case 100:case 108:case 109:case 115:ce(e,_,_,n&&N(se(e,_,_,0,0,i,l,E,i,R=[],u,C),C),i,C,u,l,n?R:C);break;default:ce(w,_,_,_,[""],C,0,l,C)}}s=p=m=0,f=v=1,E=w="",u=o;break;case 58:u=1+L(w),m=h;default:if(f<1)if(123==b)--f;else if(125==b&&0==f++&&125==G())continue;switch(w+=y(b),b*f){case 38:v=p>0?1:(w+="\f",-1);break;case 44:l[s++]=(L(w)-1)*v,v=1;break;case 64:45===q()&&(w+=Q(Z())),d=q(),p=u=L(E=w+=re(Y())),b++;break;case 45:45===h&&2==L(w)&&(f=0)}}return a}function se(e,t,r,n,i,a,o,l,c,s,p,u){for(var d=i-1,m=0===i?a:[""],h=P(m),f=0,g=0,v=0;f<n;++f)for(var b=0,E=F(e,d+1,d=x(g=o[f])),C=e;b<h;++b)(C=k(g>0?m[b]+" "+E:I(E,/&\f/g,m[b])))&&(c[v++]=C);return j(e,t,r,0===i?R:l,c,s,p,u)}function pe(e,t,r,n){return j(e,t,r,E,y($),F(e,2,-2),0,n)}function ue(e,t,r,n,i){return j(e,t,r,C,F(e,0,n),F(e,n+1,-1),n,i)}var de={animationIterationCount:1,aspectRatio:1,borderImageOutset:1,borderImageSlice:1,borderImageWidth:1,boxFlex:1,boxFlexGroup:1,boxOrdinalGroup:1,columnCount:1,columns:1,flex:1,flexGrow:1,flexPositive:1,flexShrink:1,flexNegative:1,flexOrder:1,gridRow:1,gridRowEnd:1,gridRowSpan:1,gridRowStart:1,gridColumn:1,gridColumnEnd:1,gridColumnSpan:1,gridColumnStart:1,msGridRow:1,msGridRowSpan:1,msGridColumn:1,msGridColumnSpan:1,fontWeight:1,lineHeight:1,opacity:1,order:1,orphans:1,tabSize:1,widows:1,zIndex:1,zoom:1,WebkitLineClamp:1,fillOpacity:1,floodOpacity:1,stopOpacity:1,strokeDasharray:1,strokeDashoffset:1,strokeMiterlimit:1,strokeOpacity:1,strokeWidth:1},me="undefined"!=typeof process&&void 0!==process.env&&(process.env.REACT_APP_SC_ATTR||process.env.SC_ATTR)||"data-styled",he="active",fe="data-styled-version",ge="6.1.15",ve="/*!sc*/\n",be="undefined"!=typeof window&&"HTMLElement"in window,Ee=Boolean("boolean"==typeof SC_DISABLE_SPEEDY?SC_DISABLE_SPEEDY:"undefined"!=typeof process&&void 0!==process.env&&void 0!==process.env.REACT_APP_SC_DISABLE_SPEEDY&&""!==process.env.REACT_APP_SC_DISABLE_SPEEDY?"false"!==process.env.REACT_APP_SC_DISABLE_SPEEDY&&process.env.REACT_APP_SC_DISABLE_SPEEDY:"undefined"!=typeof process&&void 0!==process.env&&void 0!==process.env.SC_DISABLE_SPEEDY&&""!==process.env.SC_DISABLE_SPEEDY&&"false"!==process.env.SC_DISABLE_SPEEDY&&process.env.SC_DISABLE_SPEEDY),Re=(new Set,Object.freeze([])),Ce=Object.freeze({});var _e=new Set(["a","abbr","address","area","article","aside","audio","b","base","bdi","bdo","big","blockquote","body","br","button","canvas","caption","cite","code","col","colgroup","data","datalist","dd","del","details","dfn","dialog","div","dl","dt","em","embed","fieldset","figcaption","figure","footer","form","h1","h2","h3","h4","h5","h6","header","hgroup","hr","html","i","iframe","img","input","ins","kbd","keygen","label","legend","li","link","main","map","mark","menu","menuitem","meta","meter","nav","noscript","object","ol","optgroup","option","output","p","param","picture","pre","progress","q","rp","rt","ruby","s","samp","script","section","select","small","source","span","strong","style","sub","summary","sup","table","tbody","td","textarea","tfoot","th","thead","time","tr","track","u","ul","use","var","video","wbr","circle","clipPath","defs","ellipse","foreignObject","g","image","line","linearGradient","marker","mask","path","pattern","polygon","polyline","radialGradient","rect","stop","svg","text","tspan"]),xe=/[!"#$%&'()*+,./:;<=>?@[\\\]^`{|}~-]+/g,ye=/(^-|-$)/g;function we(e){return e.replace(xe,"-").replace(ye,"")}var ke=/(a)(d)/gi,Se=function(e){return String.fromCharCode(e+(e>25?39:97))};function Ie(e){var t,r="";for(t=Math.abs(e);t>52;t=t/52|0)r=Se(t%52)+r;return(Se(t%52)+r).replace(ke,"$1-$2")}var Te,De=function(e,t){for(var r=t.length;r;)e=33*e^t.charCodeAt(--r);return e},Fe=function(e){return De(5381,e)};function Le(e){return"string"==typeof e&&!0}var Pe="function"==typeof Symbol&&Symbol.for,Ne=Pe?Symbol.for("react.memo"):60115,Ve=Pe?Symbol.for("react.forward_ref"):60112,Me={childContextTypes:!0,contextType:!0,contextTypes:!0,defaultProps:!0,displayName:!0,getDefaultProps:!0,getDerivedStateFromError:!0,getDerivedStateFromProps:!0,mixins:!0,propTypes:!0,type:!0},Ae={name:!0,length:!0,prototype:!0,caller:!0,callee:!0,arguments:!0,arity:!0},Be={$$typeof:!0,compare:!0,defaultProps:!0,displayName:!0,propTypes:!0,type:!0},Oe=((Te={})[Ve]={$$typeof:!0,render:!0,defaultProps:!0,displayName:!0,propTypes:!0},Te[Ne]=Be,Te);function $e(e){return("type"in(t=e)&&t.type.$$typeof)===Ne?Be:"$$typeof"in e?Oe[e.$$typeof]:Me;var t}var He=Object.defineProperty,je=Object.getOwnPropertyNames,ze=Object.getOwnPropertySymbols,We=Object.getOwnPropertyDescriptor,Ge=Object.getPrototypeOf,Ze=Object.prototype;function qe(e,t,r){if("string"!=typeof t){if(Ze){var n=Ge(t);n&&n!==Ze&&qe(e,n,r)}var i=je(t);ze&&(i=i.concat(ze(t)));for(var a=$e(e),o=$e(t),l=0;l<i.length;++l){var c=i[l];if(!(c in Ae||r&&r[c]||o&&c in o||a&&c in a)){var s=We(t,c);try{He(e,c,s)}catch(e){}}}}return e}function Ye(e){return"function"==typeof e}function Je(e){return"object"==typeof e&&"styledComponentId"in e}function Ue(e,t){return e&&t?"".concat(e," ").concat(t):e||t||""}function Qe(e,t){if(0===e.length)return"";for(var r=e[0],n=1;n<e.length;n++)r+=t?t+e[n]:e[n];return r}function Ke(e){return null!==e&&"object"==typeof e&&e.constructor.name===Object.name&&!("props"in e&&e.$$typeof)}function Xe(e,t,r){if(void 0===r&&(r=!1),!r&&!Ke(e)&&!Array.isArray(e))return t;if(Array.isArray(t))for(var n=0;n<t.length;n++)e[n]=Xe(e[n],t[n]);else if(Ke(t))for(var n in t)e[n]=Xe(e[n],t[n]);return e}function et(e,t){Object.defineProperty(e,"toString",{value:t})}function tt(e){for(var t=[],r=1;r<arguments.length;r++)t[r-1]=arguments[r];return new Error("An error occurred. See https://github.com/styled-components/styled-components/blob/main/packages/styled-components/src/utils/errors.md#".concat(e," for more information.").concat(t.length>0?" Args: ".concat(t.join(", ")):""))}var rt=function(){function e(e){this.groupSizes=new Uint32Array(512),this.length=512,this.tag=e}return e.prototype.indexOfGroup=function(e){for(var t=0,r=0;r<e;r++)t+=this.groupSizes[r];return t},e.prototype.insertRules=function(e,t){if(e>=this.groupSizes.length){for(var r=this.groupSizes,n=r.length,i=n;e>=i;)if((i<<=1)<0)throw tt(16,"".concat(e));this.groupSizes=new Uint32Array(i),this.groupSizes.set(r),this.length=i;for(var a=n;a<i;a++)this.groupSizes[a]=0}for(var o=this.indexOfGroup(e+1),l=(a=0,t.length);a<l;a++)this.tag.insertRule(o,t[a])&&(this.groupSizes[e]++,o++)},e.prototype.clearGroup=function(e){if(e<this.length){var t=this.groupSizes[e],r=this.indexOfGroup(e),n=r+t;this.groupSizes[e]=0;for(var i=r;i<n;i++)this.tag.deleteRule(r)}},e.prototype.getGroup=function(e){var t="";if(e>=this.length||0===this.groupSizes[e])return t;for(var r=this.groupSizes[e],n=this.indexOfGroup(e),i=n+r,a=n;a<i;a++)t+="".concat(this.tag.getRule(a)).concat(ve);return t},e}(),nt=new Map,it=new Map,at=1,ot=function(e){if(nt.has(e))return nt.get(e);for(;it.has(at);)at++;var t=at++;return nt.set(e,t),it.set(t,e),t},lt=function(e,t){at=t+1,nt.set(e,t),it.set(t,e)},ct="style[".concat(me,"][").concat(fe,'="').concat(ge,'"]'),st=new RegExp("^".concat(me,'\\.g(\\d+)\\[id="([\\w\\d-]+)"\\].*?"([^"]*)')),pt=function(e,t,r){for(var n,i=r.split(","),a=0,o=i.length;a<o;a++)(n=i[a])&&e.registerName(t,n)},ut=function(e,t){for(var r,n=(null!==(r=t.textContent)&&void 0!==r?r:"").split(ve),i=[],a=0,o=n.length;a<o;a++){var l=n[a].trim();if(l){var c=l.match(st);if(c){var s=0|parseInt(c[1],10),p=c[2];0!==s&&(lt(p,s),pt(e,p,c[3]),e.getTag().insertRules(s,i)),i.length=0}else i.push(l)}}},dt=function(e){for(var t=document.querySelectorAll(ct),r=0,n=t.length;r<n;r++){var i=t[r];i&&i.getAttribute(me)!==he&&(ut(e,i),i.parentNode&&i.parentNode.removeChild(i))}};function mt(){return r.nc}var ht=function(e){var t=document.head,r=e||t,n=document.createElement("style"),i=function(e){var t=Array.from(e.querySelectorAll("style[".concat(me,"]")));return t[t.length-1]}(r),a=void 0!==i?i.nextSibling:null;n.setAttribute(me,he),n.setAttribute(fe,ge);var o=mt();return o&&n.setAttribute("nonce",o),r.insertBefore(n,a),n},ft=function(){function e(e){this.element=ht(e),this.element.appendChild(document.createTextNode("")),this.sheet=function(e){if(e.sheet)return e.sheet;for(var t=document.styleSheets,r=0,n=t.length;r<n;r++){var i=t[r];if(i.ownerNode===e)return i}throw tt(17)}(this.element),this.length=0}return e.prototype.insertRule=function(e,t){try{return this.sheet.insertRule(t,e),this.length++,!0}catch(e){return!1}},e.prototype.deleteRule=function(e){this.sheet.deleteRule(e),this.length--},e.prototype.getRule=function(e){var t=this.sheet.cssRules[e];return t&&t.cssText?t.cssText:""},e}(),gt=function(){function e(e){this.element=ht(e),this.nodes=this.element.childNodes,this.length=0}return e.prototype.insertRule=function(e,t){if(e<=this.length&&e>=0){var r=document.createTextNode(t);return this.element.insertBefore(r,this.nodes[e]||null),this.length++,!0}return!1},e.prototype.deleteRule=function(e){this.element.removeChild(this.nodes[e]),this.length--},e.prototype.getRule=function(e){return e<this.length?this.nodes[e].textContent:""},e}(),vt=function(){function e(e){this.rules=[],this.length=0}return e.prototype.insertRule=function(e,t){return e<=this.length&&(this.rules.splice(e,0,t),this.length++,!0)},e.prototype.deleteRule=function(e){this.rules.splice(e,1),this.length--},e.prototype.getRule=function(e){return e<this.length?this.rules[e]:""},e}(),bt=be,Et={isServer:!be,useCSSOMInjection:!Ee},Rt=function(){function e(e,t,r){void 0===e&&(e=Ce),void 0===t&&(t={});var n=this;this.options=p(p({},Et),e),this.gs=t,this.names=new Map(r),this.server=!!e.isServer,!this.server&&be&&bt&&(bt=!1,dt(this)),et(this,(function(){return function(e){for(var t=e.getTag(),r=t.length,n="",i=function(r){var i=function(e){return it.get(e)}(r);if(void 0===i)return"continue";var a=e.names.get(i),o=t.getGroup(r);if(void 0===a||!a.size||0===o.length)return"continue";var l="".concat(me,".g").concat(r,'[id="').concat(i,'"]'),c="";void 0!==a&&a.forEach((function(e){e.length>0&&(c+="".concat(e,","))})),n+="".concat(o).concat(l,'{content:"').concat(c,'"}').concat(ve)},a=0;a<r;a++)i(a);return n}(n)}))}return e.registerId=function(e){return ot(e)},e.prototype.rehydrate=function(){!this.server&&be&&dt(this)},e.prototype.reconstructWithOptions=function(t,r){return void 0===r&&(r=!0),new e(p(p({},this.options),t),this.gs,r&&this.names||void 0)},e.prototype.allocateGSInstance=function(e){return this.gs[e]=(this.gs[e]||0)+1},e.prototype.getTag=function(){return this.tag||(this.tag=(e=function(e){var t=e.useCSSOMInjection,r=e.target;return e.isServer?new vt(r):t?new ft(r):new gt(r)}(this.options),new rt(e)));var e},e.prototype.hasNameForId=function(e,t){return this.names.has(e)&&this.names.get(e).has(t)},e.prototype.registerName=function(e,t){if(ot(e),this.names.has(e))this.names.get(e).add(t);else{var r=new Set;r.add(t),this.names.set(e,r)}},e.prototype.insertRules=function(e,t,r){this.registerName(e,t),this.getTag().insertRules(ot(e),r)},e.prototype.clearNames=function(e){this.names.has(e)&&this.names.get(e).clear()},e.prototype.clearRules=function(e){this.getTag().clearGroup(ot(e)),this.clearNames(e)},e.prototype.clearTag=function(){this.tag=void 0},e}(),Ct=/&/g,_t=/^\s*\/\/.*$/gm;function xt(e,t){return e.map((function(e){return"rule"===e.type&&(e.value="".concat(t," ").concat(e.value),e.value=e.value.replaceAll(",",",".concat(t," ")),e.props=e.props.map((function(e){return"".concat(t," ").concat(e)}))),Array.isArray(e.children)&&"@keyframes"!==e.type&&(e.children=xt(e.children,t)),e}))}function yt(e){var t,r,n,i=void 0===e?Ce:e,a=i.options,o=void 0===a?Ce:a,l=i.plugins,c=void 0===l?Re:l,s=function(e,n,i){return i.startsWith(r)&&i.endsWith(r)&&i.replaceAll(r,"").length>0?".".concat(t):e},p=c.slice();p.push((function(e){e.type===R&&e.value.includes("&")&&(e.props[0]=e.props[0].replace(Ct,r).replace(n,s))})),o.prefix&&p.push(oe),p.push(ie);var u=function(e,i,a,l){void 0===i&&(i=""),void 0===a&&(a=""),void 0===l&&(l="&"),t=l,r=i,n=new RegExp("\\".concat(r,"\\b"),"g");var c=e.replace(_t,""),s=le(a||i?"".concat(a," ").concat(i," { ").concat(c," }"):c);o.namespace&&(s=xt(s,o.namespace));var u,d,m,h=[];return ne(s,(u=p.concat((m=function(e){return h.push(e)},function(e){e.root||(e=e.return)&&m(e)})),d=P(u),function(e,t,r,n){for(var i="",a=0;a<d;a++)i+=u[a](e,t,r,n)||"";return i})),h};return u.hash=c.length?c.reduce((function(e,t){return t.name||tt(15),De(e,t.name)}),5381).toString():"",u}var wt=new Rt,kt=yt(),St=m().createContext({shouldForwardProp:void 0,styleSheet:wt,stylis:kt}),It=(St.Consumer,m().createContext(void 0));function Tt(){return(0,d.useContext)(St)}function Dt(e){var t=(0,d.useState)(e.stylisPlugins),r=t[0],n=t[1],i=Tt().styleSheet,a=(0,d.useMemo)((function(){var t=i;return e.sheet?t=e.sheet:e.target&&(t=t.reconstructWithOptions({target:e.target},!1)),e.disableCSSOMInjection&&(t=t.reconstructWithOptions({useCSSOMInjection:!1})),t}),[e.disableCSSOMInjection,e.sheet,e.target,i]),o=(0,d.useMemo)((function(){return yt({options:{namespace:e.namespace,prefix:e.enableVendorPrefixes},plugins:r})}),[e.enableVendorPrefixes,e.namespace,r]);(0,d.useEffect)((function(){f()(r,e.stylisPlugins)||n(e.stylisPlugins)}),[e.stylisPlugins]);var l=(0,d.useMemo)((function(){return{shouldForwardProp:e.shouldForwardProp,styleSheet:a,stylis:o}}),[e.shouldForwardProp,a,o]);return m().createElement(St.Provider,{value:l},m().createElement(It.Provider,{value:o},e.children))}var Ft=function(){function e(e,t){var r=this;this.inject=function(e,t){void 0===t&&(t=kt);var n=r.name+t.hash;e.hasNameForId(r.id,n)||e.insertRules(r.id,n,t(r.rules,n,"@keyframes"))},this.name=e,this.id="sc-keyframes-".concat(e),this.rules=t,et(this,(function(){throw tt(12,String(r.name))}))}return e.prototype.getName=function(e){return void 0===e&&(e=kt),this.name+e.hash},e}(),Lt=function(e){return e>="A"&&e<="Z"};function Pt(e){for(var t="",r=0;r<e.length;r++){var n=e[r];if(1===r&&"-"===n&&"-"===e[0])return e;Lt(n)?t+="-"+n.toLowerCase():t+=n}return t.startsWith("ms-")?"-"+t:t}var Nt=function(e){return null==e||!1===e||""===e},Vt=function(e){var t,r,n=[];for(var i in e){var a=e[i];e.hasOwnProperty(i)&&!Nt(a)&&(Array.isArray(a)&&a.isCss||Ye(a)?n.push("".concat(Pt(i),":"),a,";"):Ke(a)?n.push.apply(n,u(u(["".concat(i," {")],Vt(a),!1),["}"],!1)):n.push("".concat(Pt(i),": ").concat((t=i,null==(r=a)||"boolean"==typeof r||""===r?"":"number"!=typeof r||0===r||t in de||t.startsWith("--")?String(r).trim():"".concat(r,"px")),";")))}return n};function Mt(e,t,r,n){return Nt(e)?[]:Je(e)?[".".concat(e.styledComponentId)]:Ye(e)?!Ye(i=e)||i.prototype&&i.prototype.isReactComponent||!t?[e]:Mt(e(t),t,r,n):e instanceof Ft?r?(e.inject(r,n),[e.getName(n)]):[e]:Ke(e)?Vt(e):Array.isArray(e)?Array.prototype.concat.apply(Re,e.map((function(e){return Mt(e,t,r,n)}))):[e.toString()];var i}function At(e){for(var t=0;t<e.length;t+=1){var r=e[t];if(Ye(r)&&!Je(r))return!1}return!0}var Bt=Fe(ge),Ot=function(){function e(e,t,r){this.rules=e,this.staticRulesId="",this.isStatic=(void 0===r||r.isStatic)&&At(e),this.componentId=t,this.baseHash=De(Bt,t),this.baseStyle=r,Rt.registerId(t)}return e.prototype.generateAndInjectStyles=function(e,t,r){var n=this.baseStyle?this.baseStyle.generateAndInjectStyles(e,t,r):"";if(this.isStatic&&!r.hash)if(this.staticRulesId&&t.hasNameForId(this.componentId,this.staticRulesId))n=Ue(n,this.staticRulesId);else{var i=Qe(Mt(this.rules,e,t,r)),a=Ie(De(this.baseHash,i)>>>0);if(!t.hasNameForId(this.componentId,a)){var o=r(i,".".concat(a),void 0,this.componentId);t.insertRules(this.componentId,a,o)}n=Ue(n,a),this.staticRulesId=a}else{for(var l=De(this.baseHash,r.hash),c="",s=0;s<this.rules.length;s++){var p=this.rules[s];if("string"==typeof p)c+=p;else if(p){var u=Qe(Mt(p,e,t,r));l=De(l,u+s),c+=u}}if(c){var d=Ie(l>>>0);t.hasNameForId(this.componentId,d)||t.insertRules(this.componentId,d,r(c,".".concat(d),void 0,this.componentId)),n=Ue(n,d)}}return n},e}(),$t=m().createContext(void 0);$t.Consumer;var Ht={};function jt(e,t,r){var n=Je(e),i=e,a=!Le(e),o=t.attrs,l=void 0===o?Re:o,c=t.componentId,s=void 0===c?function(e,t){var r="string"!=typeof e?"sc":we(e);Ht[r]=(Ht[r]||0)+1;var n="".concat(r,"-").concat(function(e){return Ie(Fe(e)>>>0)}(ge+r+Ht[r]));return t?"".concat(t,"-").concat(n):n}(t.displayName,t.parentComponentId):c,u=t.displayName,h=void 0===u?function(e){return Le(e)?"styled.".concat(e):"Styled(".concat(function(e){return e.displayName||e.name||"Component"}(e),")")}(e):u,f=t.displayName&&t.componentId?"".concat(we(t.displayName),"-").concat(t.componentId):t.componentId||s,g=n&&i.attrs?i.attrs.concat(l).filter(Boolean):l,v=t.shouldForwardProp;if(n&&i.shouldForwardProp){var b=i.shouldForwardProp;if(t.shouldForwardProp){var E=t.shouldForwardProp;v=function(e,t){return b(e,t)&&E(e,t)}}else v=b}var R=new Ot(r,f,n?i.componentStyle:void 0);function C(e,t){return function(e,t,r){var n=e.attrs,i=e.componentStyle,a=e.defaultProps,o=e.foldedComponentIds,l=e.styledComponentId,c=e.target,s=m().useContext($t),u=Tt(),h=e.shouldForwardProp||u.shouldForwardProp,f=function(e,t,r){return void 0===r&&(r=Ce),e.theme!==r.theme&&e.theme||t||r.theme}(t,s,a)||Ce,g=function(e,t,r){for(var n,i=p(p({},t),{className:void 0,theme:r}),a=0;a<e.length;a+=1){var o=Ye(n=e[a])?n(i):n;for(var l in o)i[l]="className"===l?Ue(i[l],o[l]):"style"===l?p(p({},i[l]),o[l]):o[l]}return t.className&&(i.className=Ue(i.className,t.className)),i}(n,t,f),v=g.as||c,b={};for(var E in g)void 0===g[E]||"$"===E[0]||"as"===E||"theme"===E&&g.theme===f||("forwardedAs"===E?b.as=g.forwardedAs:h&&!h(E,v)||(b[E]=g[E]));var R=function(e,t){var r=Tt();return e.generateAndInjectStyles(t,r.styleSheet,r.stylis)}(i,g),C=Ue(o,l);return R&&(C+=" "+R),g.className&&(C+=" "+g.className),b[Le(v)&&!_e.has(v)?"class":"className"]=C,r&&(b.ref=r),(0,d.createElement)(v,b)}(_,e,t)}C.displayName=h;var _=m().forwardRef(C);return _.attrs=g,_.componentStyle=R,_.displayName=h,_.shouldForwardProp=v,_.foldedComponentIds=n?Ue(i.foldedComponentIds,i.styledComponentId):"",_.styledComponentId=f,_.target=n?i.target:e,Object.defineProperty(_,"defaultProps",{get:function(){return this._foldedDefaultProps},set:function(e){this._foldedDefaultProps=n?function(e){for(var t=[],r=1;r<arguments.length;r++)t[r-1]=arguments[r];for(var n=0,i=t;n<i.length;n++)Xe(e,i[n],!0);return e}({},i.defaultProps,e):e}}),et(_,(function(){return".".concat(_.styledComponentId)})),a&&qe(_,e,{attrs:!0,componentStyle:!0,displayName:!0,foldedComponentIds:!0,shouldForwardProp:!0,styledComponentId:!0,target:!0}),_}function zt(e,t){for(var r=[e[0]],n=0,i=t.length;n<i;n+=1)r.push(t[n],e[n+1]);return r}new Set;var Wt=function(e){return Object.assign(e,{isCss:!0})};function Gt(e){for(var t=[],r=1;r<arguments.length;r++)t[r-1]=arguments[r];if(Ye(e)||Ke(e))return Wt(Mt(zt(Re,u([e],t,!0))));var n=e;return 0===t.length&&1===n.length&&"string"==typeof n[0]?Mt(n):Wt(Mt(zt(n,t)))}function Zt(e,t,r){if(void 0===r&&(r=Ce),!t)throw tt(1,t);var n=function(n){for(var i=[],a=1;a<arguments.length;a++)i[a-1]=arguments[a];return e(t,r,Gt.apply(void 0,u([n],i,!1)))};return n.attrs=function(n){return Zt(e,t,p(p({},r),{attrs:Array.prototype.concat(r.attrs,n).filter(Boolean)}))},n.withConfig=function(n){return Zt(e,t,p(p({},r),n))},n}var qt=function(e){return Zt(jt,e)},Yt=qt;_e.forEach((function(e){Yt[e]=qt(e)})),function(){function e(e,t){this.rules=e,this.componentId=t,this.isStatic=At(e),Rt.registerId(this.componentId+1)}e.prototype.createStyles=function(e,t,r,n){var i=n(Qe(Mt(this.rules,t,r,n)),""),a=this.componentId+e;r.insertRules(a,a,i)},e.prototype.removeStyles=function(e,t){t.clearRules(this.componentId+e)},e.prototype.renderStyles=function(e,t,r,n){e>2&&Rt.registerId(this.componentId+e),this.removeStyles(e,r),this.createStyles(e,t,r,n)}}(),function(){function e(){var e=this;this._emitSheetCSS=function(){var t=e.instance.toString();if(!t)return"";var r=mt(),n=Qe([r&&'nonce="'.concat(r,'"'),"".concat(me,'="true"'),"".concat(fe,'="').concat(ge,'"')].filter(Boolean)," ");return"<style ".concat(n,">").concat(t,"</style>")},this.getStyleTags=function(){if(e.sealed)throw tt(2);return e._emitSheetCSS()},this.getStyleElement=function(){var t;if(e.sealed)throw tt(2);var r=e.instance.toString();if(!r)return[];var n=((t={})[me]="",t[fe]=ge,t.dangerouslySetInnerHTML={__html:r},t),i=mt();return i&&(n.nonce=i),[m().createElement("style",p({},n,{key:"sc-0-0"}))]},this.seal=function(){e.sealed=!0},this.instance=new Rt({isServer:!0}),this.sealed=!1}e.prototype.collectStyles=function(e){if(this.sealed)throw tt(2);return m().createElement(Dt,{sheet:this.instance},e)},e.prototype.interleaveWithNodeStream=function(e){throw tt(3)}}(),"__sc-".concat(me,"__");const Jt=Yt.div`
    display: flex;
    gap: 16px;
`,Ut=Yt.div`
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
`,Qt=Yt.div`
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
`;var Kt=e=>{let{icon:t,title:r,description:n,...i}=e;return React.createElement(Jt,i,t&&React.createElement(Ut,null,React.createElement("span",{className:"icon-box-icon"},t)),React.createElement(Qt,null,r&&React.createElement("span",{className:"icon-box-title"},r),n&&React.createElement("span",{className:"icon-box-description"},n)))};const Xt=Yt.div`
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
`,er=Yt.div``,tr=Yt.div`
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
`,rr=Yt.div`
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
`,nr=Yt.div`
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
`;var ir=e=>{let{options:t,onChange:r,selected:n}=e;return React.createElement(Xt,null,t.map((e=>{const{id:t,image:i,title:a,description:o}=e;return React.createElement(er,{key:t},React.createElement(tr,{onClick:()=>r(t),isActive:n&&n===t},React.createElement(rr,null,i),React.createElement(nr,null,React.createElement("span",{className:"import-option-title"},a),React.createElement("span",{className:"import-option-description"},o))))})))};const ar=Yt.button`
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
`,or=Yt.span`
    display: inline-flex;
    align-items: center;
    font-size: 24px;
    svg{
        width: 1em;
        height: 1em;
    }
`;var lr=e=>{let{label:t,children:r,prevIcon:n,nextIcon:i,...a}=e;return React.createElement(ar,a,n&&React.createElement(or,null,n),r||t,i&&React.createElement(or,null,i))},cr=window.wp.components;const sr=Yt.div.attrs((e=>{let{hasDismissButton:t,status:r,...n}=e;return n}))`
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
`,pr=Yt.span`
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
`,ur=Yt.button`
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
`;var dr=t=>{let{status:r,title:n,message:i,onDismiss:a}=t;const o=(0,e.useRef)(null);return React.createElement(sr,{ref:o,status:r,hasDismissButton:a},React.createElement("span",{className:"notification-icon"},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M9.99979 7.50019V10.8335M9.99979 14.1669H10.0081M8.84589 3.24329L1.99182 15.0821C1.61165 15.7388 1.42156 16.0671 1.44966 16.3366C1.47416 16.5716 1.5973 16.7852 1.78844 16.9242C2.00757 17.0835 2.38695 17.0835 3.14572 17.0835H16.8539C17.6126 17.0835 17.992 17.0835 18.2111 16.9242C18.4023 16.7852 18.5254 16.5716 18.5499 16.3366C18.578 16.0671 18.3879 15.7388 18.0078 15.0821L11.1537 3.24329C10.7749 2.58899 10.5855 2.26184 10.3384 2.15196C10.1228 2.05612 9.87676 2.05612 9.66121 2.15196C9.4141 2.26184 9.2247 2.58899 8.84589 3.24329Z",stroke:"currentColor",strokeWidth:"1.66667",strokeLinecap:"round",strokeLinejoin:"round"}))),React.createElement("span",{className:"notification-msg"},n&&React.createElement(pr,null,n),i||React.createElement(cr.Spinner,{style:{color:"var(--primary-color)"}})),a&&React.createElement(ur,{type:"button",onClick:()=>{o.current.style.opacity="0",setTimeout((()=>{a(!1)}),300)}},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M15 5L5 15M5 5L15 15",stroke:"currentColor",strokeWidth:"1.66667",strokeLinecap:"round",strokeLinejoin:"round"}))))};const mr=Yt.div`
    max-width: 1000px;
    width: 100%;
    margin: 0 auto;
    padding: 0 15px;
`;var hr=e=>{let{children:t}=e;return React.createElement(mr,null,t)};const fr=Yt.ul`
    display: flex;
    justify-content: space-between;
    position: relative;
    list-style: none;
    padding: 0;
    margin: 0 0 32px;
    z-index: 1;
`,gr=Yt.li`
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
`,vr=Yt.span`
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
`,br=Yt.div`
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
`,Er=Yt.div`
    display: flex;
    flex-direction: column;
    gap: 32px;
    .import-recipe-image{
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
    }
`;var Rr=r=>{let{steps:n=[]}=r;const{globalState:i,setGlobalState:o,globalState:{recipesToImport:l,pns:c}}=a(),[s,p]=(0,e.useState)({current:0,completed:[]}),u=(0,e.useRef)(null),d=()=>{u.current.style.cssText="opacity: 0; transform: translateY(20px)",setTimeout((()=>{u.current.style.cssText="opacity: 1; transform: translateY(0px);transition: all .3s ease;"}),30)},h=()=>n[s.current].component;return m().createElement("div",null,m().createElement(hr,null,m().createElement(fr,null,n.map(((e,t)=>{let{id:r,label:n}=e;const i=s?.current===t,a=s?.completed.includes(t);return m().createElement(gr,{current:i||a},m().createElement(vr,{current:i,completed:a}),n)}))),m().createElement(Er,{ref:u},m().createElement(h,null))),s.current<n.length-1&&m().createElement(br,null,m().createElement(hr,null,m().createElement(lr,{variant:"ghost",prevIcon:m().createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},m().createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"})),onClick:()=>{0!==s.current?(p({...s,current:s.current-1,completed:s.completed.filter((e=>e!==s.current-1))}),d()):o({...i,importStart:!1})}},(0,t.__)("Back","delicious-recipes")),m().createElement(lr,{onClick:()=>{s.current!==n.length-1&&(p({...s,current:s.current+1,completed:[...s.completed,s.current]}),d(),o({...i,pns:s.current+1!==n.length-1}))},disabled:!l.length>0,label:(0,t.__)("Proceed to Next Step","delicious-recipes")}))))};const Cr=Yt.div`
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
`,_r=Yt.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
    position: sticky;
    top: 0;
    background-color: #fff;
`,xr=Yt.table`
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
`,yr=Yt.header`
    margin: 0;
    padding: 20px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-size: 14px;
    border-bottom: 1px solid #EDEEEE;
`,wr=Yt.footer`
    margin: 0;
    padding: 16px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-size: 14px;
    border-top: 1px solid #EDEEEE;
`,kr=Yt.div`
    label{
        margin: 0;
        display: flex;
        align-items: center;
        font-size: inherit;
        gap: 16px;
    }
`,Sr=Yt.div`
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
`,Ir=Yt.div`
    font-weight: 500;
`,Tr=Yt.div`
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
`,Dr=e=>{let{children:t,...r}=e;return React.createElement(xr,r,t)};Dr.Header=e=>{let{children:t}=e;return React.createElement(yr,null,t)},Dr.Footer=e=>{let{children:t}=e;return React.createElement(wr,null,t)},Dr.Length=e=>{let{value:r,onChange:n}=e;const i=[{value:10,label:(0,t.__)("10","delicious-recipes")},{value:25,label:(0,t.__)("25","delicious-recipes")},{value:50,label:(0,t.__)("50","delicious-recipes")},{value:100,label:(0,t.__)("100","delicious-recipes")},{value:"show-all",label:(0,t.__)("Show All","delicious-recipes")}];return React.createElement(kr,null,React.createElement("label",null,(0,t.__)("Show","delicious-recipes"),React.createElement("select",{onChange:e=>n(e.target.value),value:r,name:"table-length",id:"table-length"},i.map((e=>{let{value:t,label:r}=e;return React.createElement("option",{key:`table_length_${t}`,value:t},r)}))),(0,t.__)("Entries","delicious-recipes")))},Dr.Filter=e=>{let{value:t,onChange:r}=e;return React.createElement(Sr,null,React.createElement("label",{htmlFor:"table-filter"},React.createElement("input",{type:"search",name:"import-filter",onChange:e=>r(e),value:t,id:"table-filter",placeholder:"Search"})))},Dr.Info=e=>{let{length:r,total:n,currentPage:i}=e;if(r=0===n?"show-all":r,"show-all"===r)return React.createElement(Ir,null,(0,t.__)("Showing","delicious-recipes")," ",n," ",(0,t.__)("entries","delicious-recipes"));const a=(i-1)*r+1,o=Math.min(i*r,n);return React.createElement(Ir,null,(0,t.__)("Showing","delicious-recipes")," ",a," ",(0,t.__)("-","delicious-recipes")," ",o," ",(0,t.__)("of","delicious-recipes")," ",n," ",(0,t.__)("entries","delicious-recipes"))},Dr.Title=e=>{let{children:t}=e;return React.createElement(_r,null,t)},Dr.Paginate=e=>{let{length:t,total:r,currentPage:n,setCurrentPage:i}=e;if(0===r)return;if("show-all"===t)return;const a=Math.ceil(r/t),o=Array.from({length:a},((e,t)=>t+1)),l=Math.ceil(a/2);let c=!1,s=!1;return React.createElement(Tr,null,React.createElement("ul",null,React.createElement("li",null,React.createElement("a",{href:"#",className:1===n?"disabled":"",onClick:()=>1!==n&&i(n-1)},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",null,React.createElement("path",{d:"M15.8334 9.99984H4.16675M4.16675 9.99984L10.0001 15.8332M4.16675 9.99984L10.0001 4.1665",stroke:"currentColor",strokeWidth:"1.67",strokeLinecap:"round",strokeLinejoin:"round"}))))),a>5?o.map(((e,t)=>{if(n<l){if((1===n?n+1:n)===e||(2===n?n+1:1)===e||a-1===e||a===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===n?"current":"",onClick:()=>i(e)},e));if(!c&&e>n+1&&e<a-1)return c=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}else if(n>l){if((n===a?n-1:n)===e||(n===a-1?n-1:a)===e||1===e||2===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===n?"current":"",onClick:()=>i(e)},e));if(!s&&(3===e||e<n-1))return s=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}else if(n===l){if(n===e||n-1===e||n+1===e||1===e||a===e)return React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===n?"current":"",onClick:()=>i(e)},e));if(!c&&e<n-1)return c=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."));if(!s&&e>n+1&&e<a)return s=!0,React.createElement("li",{key:t},React.createElement("a",{href:"#",onClick:e=>e.preventDefault()},"..."))}})):o.map(((e,t)=>React.createElement("li",{key:t},React.createElement("a",{href:"#",className:e===n?"current":"",onClick:()=>i(e)},e)))),React.createElement("li",null,React.createElement("a",{href:"#",className:n===a?"disabled":"",onClick:()=>n!==a&&i(n+1)},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M4.16675 9.99984H15.8334M15.8334 9.99984L10.0001 4.1665M15.8334 9.99984L10.0001 15.8332",stroke:"currentColor",strokeWidth:"1.67",strokeLinecap:"round",strokeLinejoin:"round"}))))))},Dr.Container=e=>{let{children:t,...r}=e;return React.createElement(Cr,r,t)},Dr.THead=e=>{let{children:t,rest:r}=e;return React.createElement("thead",r,t)},Dr.TBody=e=>{let{children:t,...r}=e;return React.createElement("tbody",r,t)},Dr.TFoot=e=>{let{children:t,...r}=e;return React.createElement("tfoot",r,t)},Dr.Tr=e=>{let{items:t,children:r,...n}=e;return t?t.map((e=>React.createElement("tr",n,e))):React.createElement("tr",n,r)},Dr.Th=e=>{let{items:t,children:r,...n}=e;return t?t.map((e=>React.createElement("th",n,e))):React.createElement("th",n,r)},Dr.Td=e=>{let{items:t,children:r,...n}=e;return t?t.map((e=>React.createElement("td",n,e))):React.createElement("td",n,r)};var Fr=Dr;function Lr(){return Lr=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)({}).hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},Lr.apply(null,arguments)}const Pr=Yt.div`
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
`,Nr=e=>React.createElement(Pr,{bulk:e?.bulk},React.createElement("input",Lr({type:"checkbox"},e)));Nr.Bulk=e=>React.createElement(Nr,Lr({bulk:!0},e));var Vr=Nr,Mr=()=>{const{globalState:r,setGlobalState:n,globalState:{recipes:i,selectedOption:o,recipeCount:l,recipesToList:c,list:s,currentPage:p,recipesToImport:u,deleteRecipes:d}}=a(),[m,h]=(0,e.useState)({selectedRecipes:u,localInput:"",debouncedInput:"",filteredRecipes:c,filteredRecipeList:s,filteredRecipeCount:l}),{selectedRecipes:f,localInput:g,debouncedInput:v,filteredRecipes:b,filteredRecipeList:E,filteredRecipeCount:R}=m;let C="";return"cooked"===o?C="Cooked":"wp-recipe-maker"===o&&(C="WP Recipe Maker"),(0,e.useEffect)((()=>{const e=setTimeout((()=>{h({...m,debouncedInput:g})}),500);return()=>{clearTimeout(e)}}),[g]),(0,e.useEffect)((()=>{let e=c,t=s,r=l;v&&(e=i.filter((e=>e.post_title.toLowerCase().includes(v.toLowerCase()))),t=e.length>0||g.length>0?"show-all":s,r=e.length>0?e.length:g.length>0?0:r),h({...m,filteredRecipes:e,filteredRecipeList:t,filteredRecipeCount:r})}),[v]),React.createElement(React.Fragment,null,React.createElement(Fr.Container,null,React.createElement(Fr.Header,null,React.createElement(Fr.Length,{value:E,onChange:e=>{h({...m,filteredRecipeList:e,filteredRecipes:"show-all"===e?i:i.slice(0,e)}),n({...r,currentPage:1,list:e,recipesToList:"show-all"===e?i:i.slice(0,e),recipesToImport:[]})}}),React.createElement(Fr.Filter,{value:g,onChange:e=>{h({...m,localInput:e.target.value})}})),React.createElement(Fr,{striped:!0,bordered:!0},React.createElement(Fr.THead,null,React.createElement(Fr.Tr,null,React.createElement(Fr.Th,null,React.createElement(Vr.Bulk,{checked:u.length===b.length,onChange:e=>{n({...r,recipesToImport:e.target.checked?b.map((e=>({id:e.ID,post_title:e.post_title,thumbnail_url:e.thumbnail_url,author:e.author,post_date:e.post_date,post_status:e.post_status}))):[]})}})),React.createElement(Fr.Th,{style:{width:"135px"}},(0,t.__)("Featured Image")),React.createElement(Fr.Th,null,(0,t.__)("Recipe Title")),React.createElement(Fr.Th,null,(0,t.__)("Author")),React.createElement(Fr.Th,null,(0,t.__)("Date Published")))),React.createElement(Fr.TBody,null,""!==g&&0===b.length&&React.createElement(Fr.Tr,null,React.createElement(Fr.Td,{colSpan:"5"},React.createElement(dr,{status:"error",message:(0,t.__)("No recipes found.","delicious-recipes")}))),f?.map(((e,t)=>{const a=i.find((t=>t.ID===e.id));return React.createElement(Fr.Tr,{key:t},React.createElement(Fr.Td,null,React.createElement(Vr,{checked:f.some((e=>e.id===a.ID)),onChange:e=>{n({...r,recipesToImport:e.target.checked?[...f,{id:a.ID,post_title:a.post_title,thumbnail_url:a.thumbnail_url,author:a.author,post_date:a.post_date,post_status:a.post_status}]:f.filter((e=>e.id!==a.ID))})}})),React.createElement(Fr.Td,null,a.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:a.thumbnail_url,alt:a.post_title})),React.createElement(Fr.Td,null,React.createElement("strong",null,a.post_title),"publish"!==a.post_status&&React.createElement("span",{className:" wpd-ml-1 dr-badge"},a.post_status)),React.createElement(Fr.Td,null,a.author),React.createElement(Fr.Td,null,a.post_date))})),f.length>0&&React.createElement(Fr.Tr,null,React.createElement(Fr.Td,{colSpan:"5"},React.createElement(dr,{message:(0,t.__)("Selected recipes listed above.","delicious-recipes")}))),b?.filter((e=>!f.some((t=>t.id===e.ID)))).map(((e,t)=>React.createElement(Fr.Tr,{key:t},React.createElement(Fr.Td,null,React.createElement(Vr,{checked:u.some((t=>t.id===e.ID)),onChange:t=>{n({...r,recipesToImport:t.target.checked?[...u,{id:e.ID,post_title:e.post_title,thumbnail_url:e.thumbnail_url,author:e.author,post_date:e.post_date,post_status:e.post_status}]:u.filter((t=>t.id!==e.ID))})}})),React.createElement(Fr.Td,null,e.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:e.thumbnail_url,alt:e.post_title})),React.createElement(Fr.Td,null,React.createElement("strong",null,e.post_title),"publish"!==e.post_status&&React.createElement("span",{className:" wpd-ml-1 dr-badge"},e.post_status)),React.createElement(Fr.Td,null,e.author),React.createElement(Fr.Td,null,e.post_date)))))),React.createElement(Fr.Footer,null,React.createElement(Fr.Info,{length:E,total:R,currentPage:p}),React.createElement(Fr.Paginate,{length:E,total:R,currentPage:p,setCurrentPage:e=>{n({...r,currentPage:e,recipesToImport:[],recipesToList:i.slice((e-1)*E,e*E)})}}))),React.createElement("label",null,React.createElement(Vr,{checked:d,onChange:e=>{n({...r,deleteRecipes:!!e.target.checked})}}),(0,t.__)("Delete the recipes from ","delicious-recipes"),React.createElement("strong",null,C),(0,t.__)(" after a successful import.","delicious-recipes")))},Ar=e=>{let{children:t,onClick:r,label:n,description:i,small:a}=e;const o=a?" small":"";return React.createElement("div",{className:`wpdelicious-dropzone-container${o}`},React.createElement("div",{className:"wpdelicious-dropzone",onClick:r},React.createElement("span",{className:"upload-icon"},React.createElement("svg",{width:"36",height:"36",viewBox:"0 0 36 36",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M11.9999 24L17.9999 18M17.9999 18L23.9999 24M17.9999 18V31.5M29.9999 25.1143C31.8322 23.6011 32.9999 21.3119 32.9999 18.75C32.9999 14.1937 29.3063 10.5 24.7499 10.5C24.4222 10.5 24.1155 10.329 23.9491 10.0466C21.993 6.72725 18.3816 4.5 14.2499 4.5C8.03674 4.5 2.99994 9.5368 2.99994 15.75C2.99994 18.8492 4.25311 21.6556 6.28036 23.6903",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))),n&&React.createElement("label",null,n),!a&&i&&React.createElement("span",{className:"wpdelicious-supported-files"},i)),t)};const Br=Yt.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
`,Or=Yt.div`
    height: 1px;
    border-bottom: 1px solid #E5EEEE;
`,$r=Yt.div`
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
`,Hr=Yt.button`
    cursor: pointer;
    &:hover {
        svg {
            path {
                stroke: #FF0000;
            }
        }
    }
`;var jr=e=>{let{}=e;const{globalState:r,setGlobalState:n,globalState:{recipes:i,importCSVFileName:o,importCSVFileURL:c,importCSVFileSize:p,deleteCSV:u}}=a(),d=function(){var e=l((function*(e){const t=yield s()({path:`/deliciousrecipe/v1/get_csv_data?file=${e.id}`});let i=t?.data?.recipes;n({...r,recipes:i,recipesToImport:i,importCSVFileID:e.id,importCSVFileName:e.filename,importCSVFileURL:e.url,importCSVFileSize:e.filesizeHumanReadable,CSVFileHeaders:t?.data?.headers})}));return function(_x){return e.apply(this,arguments)}}();return React.createElement(React.Fragment,null,React.createElement(ln,null,React.createElement(Br,null,(0,t.__)("CSV File Upload")),React.createElement("a",{href:"https://wpdelicious.com/docs/import-recipes-from-csv-file/",target:"_blank",rel:"noreferrer",download:!0},(0,t.__)("Learn how to format your CSV file for import.","delicious-recipes")),React.createElement(Ar,{onClick:()=>{return e&&e.close(),(e=wp.media.frames.file_frame=wp.media({title:(0,t.__)("Choose CSV File","delicious-recipes"),button:{text:(0,t.__)("Add CSV File","delicious-recipes")},library:{type:["text/csv"]},multiple:!1})).on("select",(function(){e.state().get("selection").map((function(e,t){e=e.toJSON(),d(e)}))})),void e.open();var e},label:(0,t.__)("Choose File to upload"),description:(0,t.__)("Supported file types .csv")}),React.createElement(Or,null),c?React.createElement(React.Fragment,null,React.createElement($r,null,React.createElement(Kt,{icon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 16 16",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M9.33329 1.51265V4.26634C9.33329 4.63971 9.33329 4.82639 9.40595 4.969C9.46987 5.09444 9.57186 5.19643 9.6973 5.26035C9.83991 5.33301 10.0266 5.33301 10.4 5.33301H13.1537M13.3333 6.65849V11.4663C13.3333 12.5864 13.3333 13.1465 13.1153 13.5743C12.9236 13.9506 12.6176 14.2566 12.2413 14.4484C11.8134 14.6663 11.2534 14.6663 10.1333 14.6663H5.86663C4.74652 14.6663 4.18647 14.6663 3.75864 14.4484C3.38232 14.2566 3.07636 13.9506 2.88461 13.5743C2.66663 13.1465 2.66663 12.5864 2.66663 11.4663V4.53301C2.66663 3.4129 2.66663 2.85285 2.88461 2.42503C3.07636 2.0487 3.38232 1.74274 3.75864 1.55099C4.18647 1.33301 4.74652 1.33301 5.86663 1.33301H8.00781C8.49699 1.33301 8.74158 1.33301 8.97176 1.38827C9.17583 1.43726 9.37092 1.51807 9.54986 1.62773C9.7517 1.75141 9.92465 1.92436 10.2706 2.27027L12.396 4.39575C12.7419 4.74165 12.9149 4.9146 13.0386 5.11644C13.1482 5.29538 13.229 5.49047 13.278 5.69454C13.3333 5.92472 13.3333 6.16931 13.3333 6.65849Z",stroke:"#2DB68D",strokeWidth:"1.33333",strokeLinecap:"round",strokeLinejoin:"round"})),title:`${o}`,description:p}),React.createElement(Hr,{type:"button",onClick:()=>{n({...r,recipes:[],recipesToImport:[],importCSVFileID:null,importCSVFileName:null,importCSVFileURL:null,importCSVFileSize:null,CSVFileHeaders:[]})}},React.createElement("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",{opacity:"0.5"},React.createElement("path",{d:"M13.3333 5.00033V4.33366C13.3333 3.40024 13.3333 2.93353 13.1517 2.57701C12.9919 2.2634 12.7369 2.00844 12.4233 1.84865C12.0668 1.66699 11.6001 1.66699 10.6667 1.66699H9.33333C8.39991 1.66699 7.9332 1.66699 7.57668 1.84865C7.26308 2.00844 7.00811 2.2634 6.84832 2.57701C6.66667 2.93353 6.66667 3.40024 6.66667 4.33366V5.00033M8.33333 9.58366V13.7503M11.6667 9.58366V13.7503M2.5 5.00033H17.5M15.8333 5.00033V14.3337C15.8333 15.7338 15.8333 16.4339 15.5608 16.9686C15.3212 17.439 14.9387 17.8215 14.4683 18.0612C13.9335 18.3337 13.2335 18.3337 11.8333 18.3337H8.16667C6.76654 18.3337 6.06647 18.3337 5.53169 18.0612C5.06129 17.8215 4.67883 17.439 4.43915 16.9686C4.16667 16.4339 4.16667 15.7338 4.16667 14.3337V5.00033",stroke:"#505556",strokeWidth:"1.66667",strokeLinecap:"round",strokeLinejoin:"round"}))))),i?.length>0&&React.createElement(dr,{status:"success",message:(0,t.__)(`File processed successfully. ${i.length} recipes found.`)})):React.createElement(dr,{status:"warning",message:(0,t.__)("Please upload or choose CSV file to proceed with the import.","delicious-recipes")})),React.createElement("label",null,React.createElement(Vr,{checked:u,onChange:e=>{n({...r,deleteCSV:!!e.target.checked})}}),(0,t.__)("Delete the CSV file after a successful import.","delicious-recipes")))},zr=()=>{const{globalState:e,setGlobalState:r,recipe_metadata:n,wpd_fields:i,globalState:{recipeFields:o,importPluginFields:l,CSVFileHeaders:c,CSVFields:s,isCSV:p}}=a();return React.createElement(Fr.Container,null,React.createElement(Fr.Header,null,React.createElement(Fr.Title,null,(0,t.__)("Map Recipes Fields","delicious-recipes"))),React.createElement(Fr,{striped:!0,bordered:!0},React.createElement(Fr.THead,null,React.createElement(Fr.Tr,null,React.createElement(Fr.Th,null,(0,t.__)("Plugin Fields","delicious-recipes")),React.createElement(Fr.Th,null,(0,t.__)("Map With","delicious-recipes")))),React.createElement(Fr.TBody,null,Object.keys(i)?.map(((n,a)=>React.createElement(Fr.Tr,{key:a},React.createElement(Fr.Td,null,React.createElement("strong",null,i[n])),React.createElement(Fr.Td,null,React.createElement("select",{value:o[n]?o[n]:"",onChange:t=>{let a={...o};"recipe_keywords"===i[n]?a[n]={type:"keywords",value:""===t.target.value?"":t.target.value}:a[n]=""===t.target.value?"":t.target.value,r({...e,recipeFields:a})}},React.createElement("option",{value:""},(0,t.__)("Select Field","delicious-recipes")),(p?c:l)?.map(((e,t)=>React.createElement("option",{key:t,value:e},e))))))))),p&&React.createElement(React.Fragment,null,React.createElement(Fr.THead,null,React.createElement(Fr.Tr,null,React.createElement(Fr.Th,null,(0,t.__)("CSV Fields","delicious-recipes")),React.createElement(Fr.Th,null,(0,t.__)("Map With","delicious-recipes")))),React.createElement(Fr.TBody,null,Object.keys(n)?.map(((i,a)=>React.createElement(Fr.Tr,{key:a},React.createElement(Fr.Td,null,React.createElement("strong",null,n[i].label)),React.createElement(Fr.Td,null,React.createElement("select",{value:s[i]?s[i]:"",onChange:t=>{let n={...s};n[i]=""===t.target.value?"":t.target.value,r({...e,CSVFields:n})}},React.createElement("option",{value:""},(0,t.__)("Select Field","delicious-recipes")),c?.map(((e,t)=>React.createElement("option",{key:t,value:e},e))))))))))))};const Wr=Yt.div`
    padding: 24px;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 24px;
    ${e=>e.starter&&"\n        padding: 32px;\n    "}
`,Gr=Yt.span`
    display: block;
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
`,Zr=Yt.div`
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
`;var qr=()=>{const{globalState:{recipes:r,recipeFields:n,recipesToImport:i},wpd_fields:o}=a(),[l,c]=(0,e.useState)(!1);return React.createElement(Wr,null,React.createElement(Gr,null,(0,t.__)("Recipes to Import")),React.createElement(Fr.Container,null,React.createElement(Fr,{bordered:!0,striped:!0},React.createElement(Fr.THead,null,React.createElement(Fr.Tr,null,React.createElement(Fr.Th,null,"Featured Image"),React.createElement(Fr.Th,null,"Recipe Title"))),React.createElement(Fr.TBody,null,i?.slice(0,l?i.length:3).map(((e,t)=>{const n=r.find((t=>t.ID===e.id));return React.createElement(Fr.Tr,{key:t},React.createElement(Fr.Td,null,n.thumbnail_url&&React.createElement("img",{className:"import-recipe-image",src:n.thumbnail_url,alt:n.post_title})),React.createElement(Fr.Td,null,React.createElement("strong",null,n.post_title)))}))),i?.length>3&&!l&&React.createElement(Fr.TFoot,null,React.createElement(Fr.Tr,null,React.createElement(Fr.Td,{colSpan:"2",style:{textAlign:"center"}},React.createElement(lr,{label:"View All",variant:"ghost",onClick:()=>{c(!0)},nextIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 9L12 15L18 9",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))})))),l&&React.createElement(Fr.TFoot,null,React.createElement(Fr.Tr,null,React.createElement(Fr.Td,{colSpan:"2",style:{textAlign:"center"}},React.createElement(lr,{label:"View Less",variant:"ghost",onClick:()=>c(!1),nextIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 15L12 9L18 15",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"}))})))))),React.createElement(Zr,null,React.createElement(Gr,null,(0,t.__)("Fields Mapped:","delicious-recipes")),Object.keys(n)?.map(((e,t)=>n[e]?React.createElement("ul",{key:t},React.createElement("li",null,React.createElement("span",{className:"label"},o[e],":"),React.createElement("span",{className:"value"},n[e]))):null))))};const Yr=Yt.div`
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #344054;
`,Jr=Yt.div`
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
`;var Ur=e=>{let{progress:t=0}=e;return t=Math.floor(t),React.createElement(Yr,null,React.createElement(Jr,null,React.createElement("span",{className:"progressbar-progress",style:{width:`${t}%`}})),t,"%")};const Qr=Yt.div`
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
`,Kr=Yt.div`
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
`;var Xr=e=>{let{items:t=[]}=e;return console.log(t),React.createElement(Qr,null,t.map((e=>React.createElement(Kr,{status:e.status},e.name))))};const en=Yt.div`
    padding: 32px 24px;
    background-color: #ffffff;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    text-align: center;
    max-width: 576px;
    margin: 0 auto;
`,tn=Yt.div`
    margin: 0 0 16px;
    svg{
        width: 69px;
        height: 69px;
        vertical-align: top;
    }
`,rn=Yt.div`
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
`;var nn=e=>{let{icon:t,title:r,text:n,children:i,...a}=e;return React.createElement(en,a,React.createElement(tn,null,t),React.createElement(rn,null,React.createElement("h5",null,r),React.createElement("p",null,n)),i)},an=()=>{const{globalState:{recipes:r,selectedOption:n,recipesToImport:i,recipeFields:o,deleteRecipes:c,importCSVFileID:p,CSVFileHeaders:u,CSVFields:d,isCSV:m,deleteCSV:h}}=a(),[f,g]=(0,e.useState)({progress:0,finalImportRecipes:m?[]:i.map((e=>({name:e.post_title,status:"pending"}))),importProcessDone:!1,importProcessMessage:""}),v=[],b=[],{progress:E,importProcessDone:R,importProcessMessage:C,finalImportRecipes:_}=f;return Object.keys(o).map(((e,t)=>{o[e]&&v.push({to:e,from:o[e]})})),(0,e.useEffect)((()=>{let e=!0;if(m){const t=function(){var t=l((function*(){for(let t=0;t<r.length;t++){const i=yield s()({path:`/deliciousrecipe/v1/import_recipes?selectedOption=${n}`,method:"POST",data:{recipe:JSON.stringify(r[t]),CSVFileHeaders:JSON.stringify(u),CSVFields:JSON.stringify(d),recipeFields:JSON.stringify(v)}});if(!i.status){g({...f,importProcessDone:!0,importProcessMessage:"failure"}),e=!1;break}g((e=>({...e,progress:(t+1)/r.length*100,finalImportRecipes:[...e.finalImportRecipes,{name:i.recipe,status:"success"}]})))}e&&(h?s()({path:`/deliciousrecipe/v1/delete_csv?selectedOption=${n}`,method:"POST",data:{CSV_id:p}}).then((e=>{e.status?g({...f,importProcessDone:!0,importProcessMessage:"success"}):g({...f,importProcessDone:!0,importProcessMessage:"failure"})})):g({...f,importProcessDone:!0,importProcessMessage:"success"}))}));return function(){return t.apply(this,arguments)}}();t()}else{s()({path:"/deliciousrecipe/v1/import_recipe_fields",method:"POST",data:{recipe_fields:JSON.stringify(v),selected_option:JSON.stringify(n),posts:JSON.stringify(i)}}).then((e=>{e.status?(b.push(e.data),g({...f,progress:10}),t()):g({...f,importProcessDone:!0,importProcessMessage:"failure"})}));const t=function(){var t=l((function*(){for(let t=0;t<i.length;t++){if(!(yield s()({path:`/deliciousrecipe/v1/import_recipes?selectedOption=${n}`,method:"POST",data:{recipe_id:JSON.stringify(i[t].id),imported_fields:JSON.stringify(b)}})).status){g({...f,importProcessDone:!0,importProcessMessage:"failure"}),e=!1;break}g({...f,progress:(t+1)/i.length*100,finalImportRecipes:_.map(((e,r)=>r<=t?{...e,status:"success"}:e))})}e&&(c?s()({path:`/deliciousrecipe/v1/delete_recipes?selectedOption=${n}`,method:"POST",data:{recipe_ids:JSON.stringify(i.map((e=>e.id)))}}).then((e=>{e.status?g({...f,importProcessDone:!0,importProcessMessage:"success"}):g({...f,importProcessDone:!0,importProcessMessage:"failure"})})):g({...f,importProcessDone:!0,importProcessMessage:"success"}))}));return function(){return t.apply(this,arguments)}}()}}),[]),React.createElement(hr,null,!R&&React.createElement(ln,null,React.createElement(Kt,{icon:React.createElement("svg",{width:"25",height:"25",viewBox:"0 0 25 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M24.6519 2.82855L21.8928 0.301686C21.6981 0.124223 21.3786 0 21.1158 0H5.91263C5.50735 0 5.17996 0.328305 5.17996 0.734497V4.31332H1.27206C0.57095 4.31332 0 4.88514 0 5.58858V8.61777C0 9.32121 0.57095 9.89303 1.27206 9.89303H5.17996V24.265C5.17996 24.6712 5.50735 25 5.91263 25H24.2673C24.6726 25 25 24.6712 25 24.265V3.62072C25 3.34171 24.8575 3.01686 24.6519 2.82855ZM1.27206 8.95692C1.0852 8.95692 0.932847 8.80459 0.932847 8.61777V5.58858C0.932847 5.40126 1.0852 5.24894 1.27206 5.24894H5.17996H6.11232H8.08648C8.48979 5.24894 8.81915 4.91916 8.81915 4.51444V3.16179C8.86451 3.17362 8.9153 3.19925 8.96164 3.24608L9.91322 4.20043L10.8466 5.13556L12.5703 6.86385C12.6339 6.92793 12.6703 7.01321 12.6703 7.10293C12.6703 7.19363 12.6339 7.27891 12.5703 7.343L11.7981 8.11644L11.3322 8.58424L10.8663 9.05206L8.96263 10.9603C8.91727 11.0071 8.86747 11.0308 8.82014 11.0416V9.69191C8.82014 9.28719 8.49078 8.95692 8.08747 8.95692H6.1133H5.18095H1.27206ZM24.0667 24.0644H6.11182V9.89254H7.88581V11.1565C7.88581 11.504 8.12543 11.9038 8.52727 11.9698C8.59679 11.9822 8.6668 11.9876 8.73829 11.9876C9.07258 11.9876 9.38566 11.8579 9.62134 11.6213L12.1827 9.05156H21.2538V8.11594H13.1156L13.2275 8.00404C13.4691 7.76348 13.6022 7.44257 13.6022 7.10194C13.6022 6.76131 13.4691 6.44139 13.2295 6.20083L12.165 5.13507H21.2538V4.19994H11.2331L9.62282 2.58602C9.33685 2.29715 8.92664 2.16751 8.52677 2.23455C8.12543 2.30109 7.88532 2.70088 7.88532 3.04791V4.31332H6.11133V0.935128H21.1128C21.1523 0.936114 21.2361 0.969634 21.2642 0.99231L24.0183 3.51474C24.0376 3.53692 24.0637 3.59657 24.0667 3.62072V24.0644Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 12.0317H8.92583V12.9674H21.253V12.0317Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 15.9478H8.92583V16.8829H21.253V15.9478Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 19.8633H8.92583V20.7989H21.253V19.8633Z",fill:"currentColor"})),title:(0,t.__)("Importing Recipes"),description:(0,t.__)("Please do not close this tab during the import process.")}),React.createElement(Ur,{progress:E}),React.createElement(Xr,{items:_})),R&&"success"===C&&React.createElement(nn,{icon:React.createElement("svg",{width:"70",height:"69",viewBox:"0 0 70 69",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",fill:"#F2FBF8"}),React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",stroke:"#2DB68D",strokeWidth:"1.38"}),React.createElement("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M47.1637 21.748L28.8214 39.4498L23.954 34.2494C23.0574 33.404 21.6484 33.3528 20.6237 34.0701C19.6246 34.813 19.3428 36.1195 19.9576 37.1698L25.7216 46.5459C26.2852 47.4169 27.2587 47.9549 28.3602 47.9549C29.4106 47.9549 30.4097 47.4169 30.9732 46.5459C31.8955 45.3419 49.4949 24.361 49.4949 24.361C51.8005 22.0041 49.0081 19.9291 47.1637 21.7223V21.748Z",fill:"#2DB68D"})),title:(0,t.__)("Your Recipes are imported successfully!"),text:(0,t.__)("All the imported recipes are saved as drafts. You can make the necessary changes and publish them.")},React.createElement(sn,{style:{flexDirection:"column"}},React.createElement(lr,{label:(0,t.__)("View all Recipes"),onClick:()=>{window.open("/wp-admin/edit.php?post_type=recipe","_blank")}}),React.createElement(lr,{variant:"ghost",label:(0,t.__)("Back to Dashboard"),prevIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"})),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}))),R&&"failure"===C&&React.createElement(nn,{icon:React.createElement("svg",{width:"70",height:"69",viewBox:"0 0 70 69",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",fill:"#FFE9E9"}),React.createElement("rect",{x:"1.19",y:"0.69",width:"67.62",height:"67.62",rx:"33.81",stroke:"#FF4949",strokeWidth:"1.38"}),React.createElement("path",{d:"M37.0557 34.4683L48.6513 22.8727C48.8805 22.6051 49.0002 22.2609 48.9866 21.9089C48.973 21.5568 48.8271 21.2229 48.578 20.9738C48.3289 20.7247 47.9949 20.5787 47.6429 20.5651C47.2909 20.5516 46.9467 20.6713 46.6791 20.9004L35.0835 32.4961L23.4878 20.8865C23.2245 20.6231 22.8672 20.4751 22.4947 20.4751C22.1222 20.4751 21.765 20.6231 21.5016 20.8865C21.2382 21.1498 21.0903 21.5071 21.0903 21.8796C21.0903 22.2521 21.2382 22.6093 21.5016 22.8727L33.1112 34.4683L21.5016 46.0639C21.3552 46.1893 21.2363 46.3436 21.1523 46.5172C21.0684 46.6907 21.0212 46.8797 21.0137 47.0724C21.0063 47.265 21.0388 47.4571 21.1091 47.6366C21.1794 47.8161 21.2861 47.9791 21.4224 48.1154C21.5587 48.2517 21.7217 48.3584 21.9012 48.4287C22.0807 48.499 22.2728 48.5315 22.4654 48.5241C22.6581 48.5166 22.8471 48.4694 23.0206 48.3855C23.1942 48.3015 23.3485 48.1826 23.4739 48.0362L35.0835 36.4405L46.6791 48.0362C46.9467 48.2653 47.2909 48.3851 47.6429 48.3715C47.9949 48.3579 48.3289 48.2119 48.578 47.9628C48.8271 47.7137 48.973 47.3798 48.9866 47.0278C49.0002 46.6757 48.8805 46.3315 48.6513 46.0639L37.0557 34.4683Z",fill:"#FF4949"})),title:(0,t.__)("Import Unsuccessful"),text:(0,t.__)("Please try importing your recipes again. If the problem persists, contact our support team for assistance.")},React.createElement(sn,{style:{flexDirection:"column"}},React.createElement(lr,{label:(0,t.__)("Try Import Again"),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}),React.createElement(lr,{variant:"ghost",label:(0,t.__)("Back to Dashboard"),prevIcon:React.createElement("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M6 8L2 12M2 12L6 16M2 12H22",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"})),onClick:()=>{window.location.href="/wp-admin/admin.php?page=delicious_recipes_import_recipes"}}))))};const{pluginUrl:on}=dr_import||{},ln=Yt.div`
    padding: 24px;
    box-shadow: 0px 4px 12px 0px #1D0D0D0A;
    border-radius: 16px;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 24px;
    ${e=>e.starter&&"\n        padding: 32px;\n    "}
`,cn=Yt.div`
    padding: 64px 0;
`,sn=Yt.div`
    text-align: center;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 12px;
`,pn=Yt.h2`
    font-size: 32px;
    line-height: 1.3;
    font-weight: 600;
    margin: 0 0 32px;
    text-align: center;
`,un=[{id:"cooked",image:React.createElement("img",{src:`${on}/assets/images/import-recipes/cooked.png`}),title:(0,t.__)("Cooked"),description:(0,t.__)("Import all recipes from Cooked plugin.")},{id:"wp-recipe-maker",image:React.createElement("img",{src:`${on}/assets/images/import-recipes/wp-recipe-maker.png`}),title:(0,t.__)("WP Recipe Maker"),description:(0,t.__)("Import all recipes from WP Recipe Maker plugin.")},{id:"csv",image:React.createElement("img",{src:`${on}/assets/images/import-recipes/csv-import.png`}),title:(0,t.__)("CSV Import"),description:(0,t.__)("Import recipes from CSV file.")},{id:"tasty-recipes",image:React.createElement("img",{src:`${on}/assets/images/import-recipes/tasty-recipes.jpg`}),title:(0,t.__)("Tasty Recipes"),description:(0,t.__)("Import all recipes from Tasty Recipes plugin.")}];var dn=()=>{const{globalState:r,setGlobalState:n,globalState:{importStart:i,selectedOption:o,recipeCount:c,list:p,isCSV:u}}=a(),[d,m]=(0,e.useState)("");(0,e.useEffect)((()=>{o&&!u&&h(o)}),[o]);const h=function(){var e=l((function*(e){n({...r,loading:!0});const[t,i]=yield Promise.all([s()({path:`/deliciousrecipe/v1/get_import_plugin_terms?selectedOption=${e}`}),s()({path:`/deliciousrecipe/v1/get_import_recipes?selectedOption=${e}`})]);i.success?n({...r,importPluginFields:t?.data||[],recipes:i?.data||[],recipeCount:i?.data?.length||0,recipesToList:i?.data?.slice(0,p)||[],loading:!1}):m(i.data)}));return function(_x){return e.apply(this,arguments)}}(),f=u||o&&c>0,g=o&&c<1&&!u;return React.createElement(cn,null,i?React.createElement(hr,null,React.createElement(pn,null,(0,t.__)("Import Recipes","delicious-recipes")),React.createElement(Rr,{steps:[{id:"recipes-import",label:u?(0,t.__)("CSV File Upload","delicious-recipes"):(0,t.__)("Recipes to Import","delicious-recipes"),component:u?React.createElement(jr,null):React.createElement(Mr,null)},{id:"fields-mapping",label:(0,t.__)("Fields Mapping","delicious-recipes"),component:React.createElement(zr,null)},...u?[]:[{id:"summary",label:(0,t.__)("Summary","delicious-recipes"),component:React.createElement(qr,null)}],{id:"import-process",label:(0,t.__)("Import Process","delicious-recipes"),component:React.createElement(an,null)}]})):React.createElement(hr,null,React.createElement(ln,{starter:!0},React.createElement(Kt,{icon:React.createElement("svg",{width:"25",height:"25",viewBox:"0 0 25 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M24.6519 2.82855L21.8928 0.301686C21.6981 0.124223 21.3786 0 21.1158 0H5.91263C5.50735 0 5.17996 0.328305 5.17996 0.734497V4.31332H1.27206C0.57095 4.31332 0 4.88514 0 5.58858V8.61777C0 9.32121 0.57095 9.89303 1.27206 9.89303H5.17996V24.265C5.17996 24.6712 5.50735 25 5.91263 25H24.2673C24.6726 25 25 24.6712 25 24.265V3.62072C25 3.34171 24.8575 3.01686 24.6519 2.82855ZM1.27206 8.95692C1.0852 8.95692 0.932847 8.80459 0.932847 8.61777V5.58858C0.932847 5.40126 1.0852 5.24894 1.27206 5.24894H5.17996H6.11232H8.08648C8.48979 5.24894 8.81915 4.91916 8.81915 4.51444V3.16179C8.86451 3.17362 8.9153 3.19925 8.96164 3.24608L9.91322 4.20043L10.8466 5.13556L12.5703 6.86385C12.6339 6.92793 12.6703 7.01321 12.6703 7.10293C12.6703 7.19363 12.6339 7.27891 12.5703 7.343L11.7981 8.11644L11.3322 8.58424L10.8663 9.05206L8.96263 10.9603C8.91727 11.0071 8.86747 11.0308 8.82014 11.0416V9.69191C8.82014 9.28719 8.49078 8.95692 8.08747 8.95692H6.1133H5.18095H1.27206ZM24.0667 24.0644H6.11182V9.89254H7.88581V11.1565C7.88581 11.504 8.12543 11.9038 8.52727 11.9698C8.59679 11.9822 8.6668 11.9876 8.73829 11.9876C9.07258 11.9876 9.38566 11.8579 9.62134 11.6213L12.1827 9.05156H21.2538V8.11594H13.1156L13.2275 8.00404C13.4691 7.76348 13.6022 7.44257 13.6022 7.10194C13.6022 6.76131 13.4691 6.44139 13.2295 6.20083L12.165 5.13507H21.2538V4.19994H11.2331L9.62282 2.58602C9.33685 2.29715 8.92664 2.16751 8.52677 2.23455C8.12543 2.30109 7.88532 2.70088 7.88532 3.04791V4.31332H6.11133V0.935128H21.1128C21.1523 0.936114 21.2361 0.969634 21.2642 0.99231L24.0183 3.51474C24.0376 3.53692 24.0637 3.59657 24.0667 3.62072V24.0644Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 12.0317H8.92583V12.9674H21.253V12.0317Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 15.9478H8.92583V16.8829H21.253V15.9478Z",fill:"currentColor"}),React.createElement("path",{d:"M21.253 19.8633H8.92583V20.7989H21.253V19.8633Z",fill:"currentColor"})),title:(0,t.__)("Import Recipes","delicious-recipes"),description:(0,t.__)("Select from the options below to import your recipes.","delicious-recipes")}),React.createElement(ir,{options:un,selected:o,onChange:e=>n({...r,selectedOption:e,isCSV:"csv"===e})}),f&&React.createElement(dr,{key:"warning",onDismiss:()=>n({...r,showMsg:!1}),status:"warning",message:(0,t.__)("We recommend taking a full backup of your site before proceeding with the import. Alternatively, you can also create a staging site and import the recipes.","delicious-recipes")}),g&&React.createElement(dr,{key:"error",status:"error",message:d}),React.createElement(sn,null,React.createElement(lr,{type:"button",disabled:!(u||o&&c>=1),label:(0,t.__)("Proceed to Next Step","delicious-recipes"),onClick:()=>n({...r,importStart:!0})})))))};const{pluginUrl:mn}=dr_import||{};var hn=e=>{let{pageTitle:t}=e;return React.createElement("header",{className:"wpdelicious-setting-header border-bottom-1 top-2 flex items-center gap-1"},React.createElement("div",{className:"wpdelicious-logo"},React.createElement("img",{src:mn?`${mn}assets/images/Delicious-Recipes.png`:""})),t&&React.createElement("span",{className:"dr-page-name"},t))};let fn=document.getElementById("delicious-recipe-import"),gn=fn.dataset.restNonce;(0,e.createRoot)(fn).render(React.createElement(i,null,React.createElement(hn,null),React.createElement(dn,{rest_nonce:gn})))}(),(drExports=void 0===drExports?{}:drExports).import={}}();