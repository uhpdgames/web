!function(e,t,o){"use strict";var i,n,s,a,r,l,c,h,u,d,p,m,f,v,g,b,w,y,C,x,A,k,T,M,L,D,O,H,z,E,P,S,B,I,F,R,X=[],N=-1,W=e(t),Y=e(o),j=!("placeholder"in t.createElement("input")),q=((L=e("<p>")[0]).style.cssText="pointer-events:auto",!L.style.pointerEvents),_=!1,U=e(),Q="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==",Z=(ne("transformOrigin"),ne("transition")),K="transitionend webkitTransitionEnd oTransitionEnd otransitionend",G=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.msRequestAnimationFrame||function(e){return window.setTimeout(e,1e3/60)},V={},J=new Image,$=new Image,ee={single:!1,beforeShow:null,afterClose:null,loop:!0,thumb:null,thumbs:!0,thumbAttr:"data-src",captionTmpl:'<div class="title">{title}</div><div class="counter">({currentImageIdx}/{totalImagesCount})</div>',autoplay:!1,time:3e3,history:!1,hideFlash:!0,zoomable:!0,rotatable:!0,wheelNextPrev:!0,keys:{close:[27,88,67],prev:[37,80],next:[39,78]}},te=e('<div id="pbOverlay">').append(y=e('<input type="checkbox" id="pbThumbsToggler" checked hidden>'),A=e('<div class="pbLoader"><b></b><b></b><b></b></div>'),b=e('<div id="pbPrevBtn" class="prevNext"><b></b></div>').on("click",re),w=e('<div id="pbNextBtn" class="prevNext"><b></b></div>').on("click",re),M=e('<div class="pbWrapper">').append(v=e("<img>"),g=e('<div class="pbVideo">')),e('<div id="pbCloseBtn">').on("click",be)[0],k=e('<div id="pbAutoplayBtn">').append(e('<div class="pbProgress">')),C=e('<div id="pbCaption">').append('<label for="pbThumbsToggler" title="Show/hide thumbnails"></label>','<button title="Rotate right" class="rotateBtn">&#10227;</button>',x=e('<div class="pbCaptionText">'),T=e("<div>").addClass("pbThumbs")));function oe(o){document.body.contains(te[0])&&!o||(q&&te.hide(),W.on("touchstart.testMouse",function(){W.off("touchstart.testMouse"),_=!0,te.addClass("mobile")}),k.off().on("click",m.toggle),T.off().on("click","a",d.click),j&&te.addClass("msie"),te.off().on("click","img",function(e){e.stopPropagation()}),e(t.body).append(te),p=t.documentElement)}function ie(e,t,o){var i,n={transform:"translateX(25%)",transition:".2s",opacity:0};1==t?i=h:-1==t&&(n.transform="translateX(-25%)",i=u),i&&(v.css(n),setTimeout(function(){f(i)},200)),y.prop("checked",1==o)}function ne(e){var o,i=t.createElement("p").style,n=["ms","O","Moz","Webkit"];if(""==i[e])return e;for(e=e.charAt(0).toUpperCase()+e.slice(1),o=n.length;o--;)if(""==i[n[o]+e])return n[o]+e}function se(t){var o=t.keyCode,i=s.keys;return e.inArray(o,i.close)>=0&&be()||e.inArray(o,i.next)>=0&&!s.single&&le(u)||e.inArray(o,i.prev)>=0&&!s.single&&le(h)||!0}function ae(e,t,o){1==o?le(u):-1==o&&le(h)}function re(){return le("pbPrevBtn"==this.id?h:u),!1}function le(e){if(!s.loop&&(N==X.length-1&&e==u||0==N&&e==h))return;f(e)}function ce(){var e;x.off(K).removeClass("change"),s.captionTmpl&&(e=s.captionTmpl.replace(/{title}/g,X[N][1]).replace(/{currentImageIdx}/g,N+1).replace(/{totalImagesCount}/g,X.length),x.html(e))}e.fn.photobox=function(t,o,s){return oe(),this.each(function(){var a=e(this).data("_photobox");return a?("destroy"===t&&a.destroy(),this):("string"!=typeof t&&(t="a"),"prepareDOM"===t?(oe(!0),this):(o=e.extend({},ee,o||{}),n=new i(o,this,t),e(this).data("_photobox",n),void(n.callback=s)))})},(i=function(o,i,n){this.options=e.extend({},o),this.target=n,this.selector=e(i||t),this.thumbsList=null;var s=this.imageLinksFilter(this.selector.find(n));this.imageLinks=s[0],this.images=s[1],this.init()}).prototype={init:function(){this.DOM=this.DOM(),this.DOM.rotateBtn.toggleClass("show",this.options.rotatable),this.observerTimeout=null,this.events.binding.call(this)},DOM:function(){var e={};return e.scope=te,e.rotateBtn=e.scope.find(".rotateBtn"),e},observeDOM:(D=o.MutationObserver||o.WebKitMutationObserver,O=o.addEventListener,function(t,o){if(D){var i=this;new D(function(e,t){(e[0].addedNodes.length||e[0].removedNodes.length)&&o(i)}).observe(t,{childList:!0,subtree:!0})}else O&&(t.addEventListener("DOMNodeInserted",e.proxy(o,i),!1),t.addEventListener("DOMNodeRemoved",e.proxy(o,i),!1))}),open:function(t){var o=e.inArray(t,this.imageLinks);return-1!=o&&(s=this.options,X=this.images,a=this.imageLinks,n=this,this.setup(1),te.on(K,function(){te.off(K).addClass("on"),f(o,!0)}).addClass("show"),j&&te.trigger("MSTransitionEnd"),!1)},imageLinksFilter:function(t){var o,i=this,n=[],s={};return[t.filter(function(t){var a,r=e(this),l="";return s.content=r[0].getAttribute("title")||"",i.options.thumb&&(a=r.find(i.options.thumb)[0]),i.options.thumb&&a||(a=r.find("img")[0]),a&&(o=a.getAttribute("data-pb-captionlink"),l=a.getAttribute(i.options.thumbAttr)||a.getAttribute("src"),s.content=a.getAttribute("alt")||a.getAttribute("title")||""),o&&(2==(o=o.split("[")).length?(s.linkText=o[0],s.linkHref=o[1].slice(0,-1)):(s.linkText=o,s.linkHref=o),s.content+=' <a href="'+s.linkHref+'">'+s.linkText+"</a>"),n.push([r[0].href,s.content,l]),!0}),n]},setup:function(t){var o,i,n,a=t?"on":"off";s.thumbs&&(_||T[a]("mouseenter.photobox",d.calc)[a]("mousemove.photobox",d.move)),t?(v.css({transition:"0s"}).removeAttr("style"),te.show(),T.html(this.thumbsList).trigger("mouseenter.photobox"),s.thumbs?te.addClass("thumbs"):(y.prop("checked",!1),te.removeClass("thumbs")),this.images.length<2||s.single?te.removeClass("thumbs hasArrows hasCounter hasAutoplay"):(te.addClass("hasArrows hasCounter"),s.time>1e3?(te.addClass("hasAutoplay"),s.autoplay?m.progress.start():m.pause()):te.removeClass("hasAutoplay")),s.hideFlash&&e("iframe, object, embed").css("visibility","hidden")):Y.off("resize.photobox"),W.off("keydown.photobox")[a]({"keydown.photobox":se}),_&&(te.removeClass("hasArrows"),M[a]("swipe",ie)),s.zoomable&&(te[a]({"mousewheel.photobox":e.proxy(this.events.callbacks.onScrollZoom,this)}),j||T[a]({"mousewheel.photobox":ve})),!s.single&&s.wheelNextPrev&&te[a]({"mousewheel.photobox":(o=ae,i=1e3,n=!1,function(){n||(o.call(),n=!0,setTimeout(function(){n=!1},i))})})},destroy:function(){s=this.options,this.selector.off("click.photobox",this.target).removeData("_photobox"),be()},events:{binding:function(){var t=this;this.selector.one("mouseenter.photobox",this.target,function(e){t.thumbsList=d.generate.apply(t)}),this.selector.on("click.photobox",this.target,function(e){e.preventDefault(),t.open(this)}),j||1!=this.selector[0].nodeType||this.observeDOM(this.selector[0],e.proxy(this.events.callbacks.onDOMchanges,this)),this.DOM.rotateBtn.on("click",this.events.callbacks.onRotateBtnClick)},callbacks:{onDOMchanges:function(){var e=this;clearTimeout(this.observerTimeout),e.observerTimeout=setTimeout(function(){var t,o=e.imageLinksFilter(e.selector.find(e.target)),i=0;if(e.imageLinks.length!=o[0].length){if(e.imageLinks=o[0],e.images=o[1],n&&e.selector==n.selector)for(X=e.images,a=e.imageLinks,t=X.length;t--;)X[t][0]==r&&!0;e.thumbsList=d.generate.apply(e),T.html(e.thumbsList),e.images.length&&r&&e.options.thumbs&&(-1==(i=e.thumbsList.find('a[href="'+r+'"]').eq(0).parent().index())&&(i=0),d.changeActive(i,0))}},50)},onRotateBtnClick:function(){var e=v.data("rotation")||0,t=v.data("zoom")||1;e+=90,v.removeClass("zoomable").addClass("rotating"),v.css("transform","rotate("+e+"deg) scale("+t+")").data("rotation",e).on(K,function(){v.addClass("zoomable").removeClass("rotating")})},onScrollZoom:function(e,t,o){if(o)return!1;var i=this;if("video"==c){var n=g.data("zoom")||1;if((n+=t/10)<.5)return!1;g.data("zoom",n).css({width:624*n,height:351*n})}else G(function(){var e,o=v.data("zoom")||1,n=v.data("rotation")||0,s=v.data("position")||"50% 50%",a=v[0].getBoundingClientRect();(o+=t/10)<.1&&(o=.1),v.data("zoom",o),e="scale("+o+") rotate("+n+"deg)",a.height>p.clientHeight||a.width>p.clientWidth?(W.on("mousemove.photobox",i.events.callbacks.onMouseMoveimageReposition),e+=" translate("+s+")"):W.off("mousemove.photobox"),v.css({transform:e})});return!1},onMouseMoveimageReposition:function(e){G(function(){var t,o=(e.clientY/p.clientHeight*100-50)/1.5,i=(e.clientX/p.clientWidth*100-50)/1.5,n=v.data("rotation")||0,s=n/90%4||0,a=v.data("zoom")||1;t=1==s||3==s?o.toFixed(2)+"%, "+-i.toFixed(2)+"%":i.toFixed(2)+"%, "+o.toFixed(2)+"%",v.data("position",t),v[0].style.transform="rotate("+n+"deg) scale("+a+") translate("+t+")"})}}}},P=0,S=0,B=0,I=0,F=null,d={generate:function(){var t,o,i,n,s,a=e("<ul>"),r=[],l=this.imageLinks.length;for(s=0;s<l;s++)i=this.imageLinks[s],(o=this.images[s][2])&&(t=this.images[s][1],n=i.rel?" class='"+i.rel+"'":"",r.push("<li"+n+'><a href="'+i.href+'"><img src="'+o+'"  title="'+t+'" /></a></li>'));return a.html(r.join("")),a},click:function(t){t.preventDefault(),U.removeClass("active"),U=e(this).parent().addClass("active");var o=e(this.parentNode).index();return f(o,0,1)},changeActiveTimeout:null,changeActive:function(e,t,o){s.thumbs&&(U.index(),U.removeClass("active"),U=T.find("li").eq(e).addClass("active"),!o&&U[0]&&(clearTimeout(this.changeActiveTimeout),this.changeActiveTimeout=setTimeout(function(){var e=U[0].offsetLeft+U[0].clientWidth/2-p.clientWidth/2;t?T.delay(800):T.stop(),T.animate({scrollLeft:e},500,"swing")},200)))},calc:function(e){return z=T[0],P=z.clientWidth,S=z.scrollWidth,H=.15*P,B=T.offset().left,I=e.pageX-H-B,E=I/(P-2*H)*(S-P),T.animate({scrollLeft:E},200),clearTimeout(F),F=setTimeout(function(){F=null},200),this},move:function(e){if(!F){var t,o=e.pageX-H-B;o<0&&(o=0),t=o/(P-2*H)*(S-P),G(function(){z.scrollLeft=t})}}},m={autoPlayTimer:!1,play:function(){m.autoPlayTimer=setTimeout(function(){f(u)},s.time),m.progress.start(),k.removeClass("play"),m.setTitle("Click to stop autoplay"),s.autoplay=!0},pause:function(){clearTimeout(m.autoPlayTimer),m.progress.reset(),k.addClass("play"),m.setTitle("Click to resume autoplay"),s.autoplay=!1},progress:{reset:function(){k.find("div").removeAttr("style"),setTimeout(function(){k.removeClass("playing")},200)},start:function(){j||k.find("div").css(Z,s.time+"ms"),k.addClass("playing")}},setTitle:function(e){e&&k.prop("title",e+" (every "+s.time/1e3+" seconds)")},toggle:function(e){e.stopPropagation(),m[s.autoplay?"pause":"play"]()}},f=function(t,o,i){if(!R){var n,p,f;if(R=setTimeout(function(){R=null},150),W.off("mousemove.photobox"),(!t||t<0)&&(t=0),s.loop||(w.toggleClass("pbHide",t==X.length-1),b.toggleClass("pbHide",0==t)),"function"==typeof s.beforeShow&&s.beforeShow(a[t]),te.removeClass("error"),N>=0&&te.addClass(t>N?"next":"prev"),l=N,N=n=t,r=X[n][0],h=(N||(s.loop?X.length:0))-1,u=(N+1)%X.length||(s.loop?0:-1),ge(),g.empty(),V.onerror=null,v.add(g).data("zoom",1),"video"==(c="video"==a[t].rel?"video":"image"))g.html((p=X[N][0],f=e("<a>").prop("href",X[N][0])[0].search?"&":"?",p+=f+"vq=hd720&wmode=opaque",e("<iframe>").prop({scrolling:"no",frameborder:0,allowTransparency:!0,src:p}).attr({webkitAllowFullScreen:!0,mozallowfullscreen:!0,allowFullScreen:!0}))).addClass("pbHide"),me(o);else{var y=setTimeout(function(){te.addClass("pbLoading")},50);j&&te.addClass("pbHide"),s.autoplay&&m.progress.reset(),(V=new Image).onload=function(){V.onload=null,h>=0&&(J.src=X[h][0]),u>=0&&($.src=X[u][0]),clearTimeout(y),me(o)},V.onerror=pe,V.src=r}x.on(K,ce).addClass("change"),(o||j)&&ce(),d.changeActive(t,o,i),de.save()}};var he,ue,de={save:function(){"pushState"in window.history&&decodeURIComponent(window.location.hash.slice(1))!=r&&s.history&&window.history.pushState("photobox",t.title+"-"+X[N][1],window.location.pathname+window.location.search+"#"+encodeURIComponent(r))},load:function(){if(s&&!s.history)return!1;var t=decodeURIComponent(window.location.hash.slice(1));!t&&te.hasClass("show")&&be(),e('a[href="'+t+'"]').trigger("click.photobox")},clear:function(){s.history&&"pushState"in window.history&&window.history.pushState("photobox",t.title,window.location.pathname+window.location.search)}};function pe(){te.addClass("error"),v[0].src=Q,V.onerror=null}function me(t){var o,i;function n(){M.removeAttr("style"),clearTimeout(i),te.removeClass("video"),"video"==c?(v.attr("src",Q),o.off(K).css({transition:"none"}),g.addClass("prepare"),te.addClass("video")):v.replaceWith(v=e('<img src="'+r+'" class="prepare">')),setTimeout(function(){te.removeClass("pbHide next prev"),v.add(g).removeAttr("style").removeClass("prepare").on(K,fe),j&&fe()},50)}i=setTimeout(n,2e3),A.fadeOut(300,function(){te.removeClass("pbLoading"),A.removeAttr("style")}),te.addClass("pbHide"),v.add(g).removeClass("zoomable"),t||"video"!=a[l].rel?o=v:(o=g,v.addClass("prepare")),t||j?n():o.on(K,n)}function fe(){v.add(g).off(K).addClass("zoomable"),"video"==c?g.removeClass("pbHide"):k&&s.autoplay&&m.play(),n&&"function"==typeof n.callback&&n.callback(a[N])}function ve(e,t){e.preventDefault(),e.stopPropagation();var o,i=n.thumbsList;i.css("height",i[0].clientHeight+10*t),o=C[0].clientHeight/2,M[0].style.cssText="margin-top: -"+o+"px; padding: "+o+"px 0;",T.hide().show(0)}function ge(){clearTimeout(m.autoPlayTimer),W.off("mousemove.photobox"),V.onload=function(){},V.src=J.src=$.src=r}function be(){if(!te.hasClass("show"))return!1;function t(){""!=te[0].className&&(te.removeClass("show pbHide error pbLoading"),v.removeAttr("class").removeAttr("style").off().data("zoom",1),v[0].src=Q,C.find(".title").empty(),q&&setTimeout(function(){te.hide()},200),s.hideFlash&&e("iframe, object, embed").css("visibility","visible"))}ge(),g.find("iframe").prop("src","").empty(),i.prototype.setup(),de.clear(),te.removeClass("on video").addClass("pbHide"),N=-1,v.on(K,t),j&&t(),setTimeout(function(){n=null},1e3),setTimeout(t,500),"function"==typeof s.afterClose&&s.afterClose(te)}window.onpopstate=(he=window.onpopstate,function(e){he&&he.apply(this,arguments),"photobox"==e.state&&de.load()}),e.event.special.swipe={setup:function(){e(this).bind("touchstart",e.event.special.swipe.handler)},teardown:function(){e(this).unbind("touchstart",e.event.special.swipe.handler)},handler:function(t){var o,i,n=[].slice.call(arguments,1),s=t.originalEvent.touches,a=0,r=0,l=this;function c(){l.removeEventListener("touchmove",h),o=i=null}function h(s){s.preventDefault();var h=o-s.touches[0].pageX,u=i-s.touches[0].pageY;return Math.abs(h)>=20?(c(),a=h>0?-1:1):Math.abs(u)>=20&&(c(),r=u>0?1:-1),t.type="swipe",n.unshift(t,a,r),(e.event.dispatch||e.event.handle).apply(l,n)}t=e.event.fix(t),1==s.length?(o=s[0].pageX,i=s[0].pageY,this.addEventListener("touchmove",h,!1)):s.length}},ue=function(e){function t(t){var a=t||window.event,r=l.call(arguments,1),c=0,u=0,d=0,p=0,m=0,f=0;if((t=e.event.fix(a)).type="mousewheel","detail"in a&&(d=-1*a.detail),"wheelDelta"in a&&(d=a.wheelDelta),"wheelDeltaY"in a&&(d=a.wheelDeltaY),"wheelDeltaX"in a&&(u=-1*a.wheelDeltaX),"axis"in a&&a.axis===a.HORIZONTAL_AXIS&&(u=-1*d,d=0),c=0===d?u:d,"deltaY"in a&&(c=d=-1*a.deltaY),"deltaX"in a&&(u=a.deltaX,0===d&&(c=-1*u)),0!==d||0!==u){if(1===a.deltaMode){var v=e.data(this,"mousewheel-line-height");c*=v,d*=v,u*=v}else if(2===a.deltaMode){var g=e.data(this,"mousewheel-page-height");c*=g,d*=g,u*=g}if(p=Math.max(Math.abs(d),Math.abs(u)),(!s||s>p)&&(s=p,i(a,p)&&(s/=40)),i(a,p)&&(c/=40,u/=40,d/=40),c=Math[c>=1?"floor":"ceil"](c/s),u=Math[u>=1?"floor":"ceil"](u/s),d=Math[d>=1?"floor":"ceil"](d/s),h.settings.normalizeOffset&&this.getBoundingClientRect){var b=this.getBoundingClientRect();m=t.clientX-b.left,f=t.clientY-b.top}return t.deltaX=u,t.deltaY=d,t.deltaFactor=s,t.offsetX=m,t.offsetY=f,t.deltaMode=0,r.unshift(t,c,u,d),n&&clearTimeout(n),n=setTimeout(o,200),(e.event.dispatch||e.event.handle).apply(this,r)}}function o(){s=null}function i(e,t){return h.settings.adjustOldDeltas&&"mousewheel"===e.type&&t%120==0}var n,s,a=["wheel","mousewheel","DOMMouseScroll","MozMousePixelScroll"],r="onwheel"in document||document.documentMode>=9?["wheel"]:["mousewheel","DomMouseScroll","MozMousePixelScroll"],l=Array.prototype.slice;if(e.event.fixHooks)for(var c=a.length;c;)e.event.fixHooks[a[--c]]=e.event.mouseHooks;var h=e.event.special.mousewheel={version:"3.1.11",setup:function(){if(this.addEventListener)for(var o=r.length;o;)this.addEventListener(r[--o],t,!1);else this.onmousewheel=t;e.data(this,"mousewheel-line-height",h.getLineHeight(this)),e.data(this,"mousewheel-page-height",h.getPageHeight(this))},teardown:function(){if(this.removeEventListener)for(var o=r.length;o;)this.removeEventListener(r[--o],t,!1);else this.onmousewheel=null;e.removeData(this,"mousewheel-line-height"),e.removeData(this,"mousewheel-page-height")},getLineHeight:function(t){var o=e(t)["offsetParent"in e.fn?"offsetParent":"parent"]();return o.length||(o=e("body")),parseInt(o.css("fontSize"),10)},getPageHeight:function(t){return e(t).height()},settings:{adjustOldDeltas:!0,normalizeOffset:!0}};e.fn.extend({mousewheel:function(e){return e?this.bind("mousewheel",e):this.trigger("mousewheel")},unmousewheel:function(e){return this.unbind("mousewheel",e)}})},"function"==typeof define&&define.amd?define(["jquery"],ue):"object"==typeof exports?module.exports=ue:ue(jQuery),window._photobox={DOM:{overlay:te},close:be,history:de,defaults:ee}}(jQuery,document,window);