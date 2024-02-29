(() => {
    if(window.IS_LOAD_SNAP_APP) return;

    (() => {
        const CAFE24_APP = (() => {
                const CAFE24_APP = {
                        apps: {},
                        getApp: function(appName) {
                            let checker;
                            if(!this.apps.hasOwnProperty(appName)) {
                                checker = window[appName];
                                if("object" == typeof checker) {
                                    this.apps[appName] = checker;
                                }
                            }
                            return this.apps[appName] || null;
                        },
                        getAppProperty: function(appName, property) {
                            let checker = this.getApp(appName);
                            return checker && property && checker.hasOwnProperty(property) && checker[property] || null;
                        }
                      },
                      commonApp = CAFE24_APP.getAppProperty("CAPP_ASYNC_METHODS", "AppCommon") || {},
                      memberApp = CAFE24_APP.getAppProperty("CAPP_ASYNC_METHODS", "member") || null,
                      base = {
                          isComplete: false,
                          commonInfo: null,
                          orderHistory: CAFE24_APP.getAppProperty("CAPP_ASYNC_METHODS", "OrderHistoryTab") || {},
                          shopNo: (() => {
                              return CAFE24_APP.getAppProperty("CAFE24", "SDE_SHOP_NUM") || 1;
                          })(),
                          page: (() => {
                              return CAFE24_APP.getAppProperty("CAPP_ASYNC_METHODS", "EC_PATH_ROLE");
                          })(),
                          deviceType: (() => {
                              return CAFE24_APP.getAppProperty("CAFE24", "MOBILE_DEVICE") && "mobile" || "pc";
                          })(),
                          isLogin: (() => {
                              return CAFE24_APP.getAppProperty("CAPP_ASYNC_METHODS", "IS_LOGIN");
                          })(),
                          isMobile: (() => {
                              return CAFE24_APP.getAppProperty("CAFE24", "MOBILE_DEVICE");
                          })(),
                          pages: {
                            MAIN:                   "MAIN",
                            PRODUCT_LIST:           "PRODUCT_LIST",
                            PRODUCT_DETAIL:         "PRODUCT_DETAIL",
                            PRODUCT_SEARCH:         "PRODUCT_SEARCH",
                            ORDER_BASKET:           "ORDER_BASKET",
                            MEMBER_LOGIN:           "MEMBER_LOGIN",
                            MEMBER_AGREEMENT:       "MEMBER_AGREEMENT",
                            MEMBER_JOIN:            "MEMBER_JOIN",
                            MEMBER_MODIFY:          "MEMBER_MODIFY",
                            MEMBER_JOINRESULT:      "MEMBER_JOINRESULT",
                            ORDER_ORDERRESULT:      "ORDER_ORDERRESULT",
                            BOARD_PRODUCT_LIST:     "BOARD_PRODUCT_LIST",
                            BOARD_FREE_LIST:        "BOARD_FREE_LIST",
                            MYSHOP_BOARDLIST:       "MYSHOP_BOARDLIST",
                            ORDER_ORDERFORM:        "ORDER_ORDERFORM",
                            MYSHOP_MAIN:            "MYSHOP_MAIN",
                            MYSHOP_COUPON_COUPON:   "MYSHOP_COUPON_COUPON",
                            MYSHOP_ORDER_LIST:      "MYSHOP_ORDER_LIST",
                            MYSHOP_ORDER_DETAIL:    "MYSHOP_ORDER_DETAIL"
                          },
                          load: () => {
                            let memberInfo,
                                cartInfo,
                                orderInfo,
                                page = base.page;

                            return new Promise(resolve => {
                                const isLoadCAPP = () => {
                                        return 'complete' == CAPP_ASYNC_METHODS.STATUS;
                                      },
                                      isLoadMember = () => {
                                        if(!base.isLogin) return true;

                                        memberInfo      = memberApp.getData() || {};
                                        return Boolean(memberInfo.member_id);
                                      },
                                      init = () => {
                                        if(base.isLogin) {
                                            base.memberInfo = {
                                                userId:     memberInfo.member_id    || null,
                                                userName:   memberInfo.name         || null,
                                                groupName:  memberInfo.group_name   || null,
                                                email:      memberInfo.email        || null
                                            };
                                        }
                                        if(base.pages.ORDER_BASKET == page) {
                                            cartInfo            = commonApp.hasOwnProperty("getCartInfo") && commonApp.getCartInfo() || {};
                                            base.basketPrice    = cartInfo.basket_price || "";
                                        } else if(base.pages.ORDER_ORDERRESULT == page) {
                                            orderInfo = CAFE24_APP.getAppProperty("CAFE24", "FRONT_EXTERNAL_SCRIPT_VARIABLE_DATA") || {};
                                            if(orderInfo.order_id && commonApp.hasOwnProperty("getOrderDetailInfo")) base.orderPromise = commonApp.getOrderDetailInfo(base.shopNo, orderInfo.order_id);
                                        }

                                        base.commonInfo = commonApp;

                                        resolve(base);
                                      };
                               
                                let loadChecker = setInterval(() => {
                                    if(!isLoadCAPP() || !isLoadMember()) return;
           
                                    clearInterval(loadChecker);
                                    delete loadChecker;
           
                                    return init();
                                }, 100);
                            });
                          }
                      };

                return base;
              })(),
              SNAP_APP = (function() {
                    const getArgumentArray = [].slice,
                        getArrayValid = function(array) {
                            return Array.isArray(array) && array.filter(val => val);
                        },
                        prependElementFn = (() => {
                            return function(parent, node) {
                                return parent instanceof Element ? parent.prepend(node) : parent.childElementCount ? parent.firstChild.before(node) : appendElementFn.call(parent, node);
                            };
                        })(),
                        appendElementFn = Node.prototype.appendChild,
                        prependElement = function(parent) {
                          let nodes   = getArrayValid(getArgumentArray.call(arguments).slice(1)),
                              func    = prependElementFn.bind(null, parent);
                          nodes.forEach(func);
                          return parent;
                        },
                        appendElement = function(parent) {
                          let nodes   = getArrayValid(getArgumentArray.call(arguments).slice(1)),
                              func    = appendElementFn.bind(parent);
                          nodes.forEach(func);
                          return parent;
                        },
                        beforeElement = function(target) {
                          let nodes   = getArrayValid(getArgumentArray.call(arguments).slice(1));
                          target.before(...nodes);
                          return target;
                        },
                        afterElement = function(target) {
                          let nodes   = getArrayValid(getArgumentArray.call(arguments).slice(1));
                          target.after(...nodes);
                          return target;
                        },
                        fetchJson = async function(url) {
                          return fetch(url).then(response => response.json());
                        };
 
                  return {
                      storeInfo: {
                          store_name:     "ckdcos",
                          solution:       "cafe24",
                          useSolutions:   null,
                          check_apikey:  ""
                      },
                      fitKey:         "",
                      reviewKey:      "cs",
                      qKey:           "",
                      isS:            false,
                      elementMakers:  {},
                      checkPages:   [CAFE24_APP.pages.MAIN, CAFE24_APP.pages.PRODUCT_LIST, CAFE24_APP.pages.PRODUCT_DETAIL],
                      pushUsePages: [CAFE24_APP.pages.ORDER_ORDERFORM, CAFE24_APP.pages.MYSHOP_COUPON_COUPON],
                      boardPages:   [CAFE24_APP.pages.BOARD_PRODUCT_LIST, CAFE24_APP.pages.BOARD_FREE_LIST],
                      isUseSolution: function(solutions) {
                          if(!this.isValidClass(solutions)) return false;
 
                          return this.toArray(solutions).some(function(solution) {
                              return SNAP_APP.storeInfo.useSolutions.indexOf(solution) !== -1;
                          });
                      },
                      setStoreInfo: function() {
                          fetchJson(`https://cdn.snapfit.co.kr/script/ckdcos.com/info.json?${new Date().getTime()}`)
                              .then(response => {
                                  const callback    = function(detail) {
                                    try {
                                        if(detail) SNAP_APP.storeInfo.detail = detail;
                                        SNAP_APP.insertPageScript();
                                    } catch(e) {
                                        console.error(e);
                                    }
                                  };
                                  let version     = response.hasOwnProperty("version")    && response.version     || 0,
                                      s           = response.hasOwnProperty("s")          && response.s           || {},
                                      tester      = response.hasOwnProperty("tester")     && response.tester      || [],
                                      boardType   = response.hasOwnProperty("boardType")  && response.boardType   || [],
                                      subPath     = "",
                                      path        = "",
                                      type        = "live",
                                      info,
                                      deviceType,
                                      solution,
                                      page,
                                      useScript,
                                      error;
     
                                  if(SNAP_APP.isTest(s, tester)) {
                                      type    = "test";
                                      subPath = "_test";
                                      console.log("SNAP 스크립트 테스트 모드");
                                  }
                                  info        = response.hasOwnProperty(type)       && response[type]                     || {};
                                  page        = info.hasOwnProperty("page")         && info.page                          || [];
                                  deviceType  = info.hasOwnProperty("platform")     && info.platform                      || [];
                                  solution    = CAFE24_APP.deviceType in deviceType && deviceType[CAFE24_APP.deviceType]  || [];
                                  useScript   = solution.length !== 0 && page.indexOf(CAFE24_APP.page) !== -1;
                                  deviceType  = Object.keys(deviceType);

                                  // 후기게시판 페이지일 경우, qna 제외
                                  if (this.boardPages.includes(CAFE24_APP.page) && boardType.length) {
                                      let boardCode = /board_no=(\w+)/.exec(location.href) || /board\/[^\/]+\/(\w+)/.exec(location.href);

                                      useScript = boardCode && boardType.includes(decodeURIComponent(boardCode[1] || ""));
                                  }
     
                                  SNAP_APP.sLog(useScript, deviceType, solution, page);

                                  if(!useScript) return;
                                  SNAP_APP.storeInfo.useSolutions = solution;
     
                                  path        = `https://cdn.snapfit.co.kr/script/ckdcos.com/${CAFE24_APP.deviceType}/${CAFE24_APP.page}`;
                                  version     = `.json?${version}`;
     
                                  if(subPath) {
                                      error = fetchJson.bind(null, path + version);
                                      path += subPath;
                                  }
                                  fetchJson(path + version)
                                      .then(callback)
                                      .catch(reason => typeof error == 'function' && error().then(callback));
                              });
                      },
                      getPageType: function() {
                        let pages = CAFE24_APP.pages || {};
                          switch(CAFE24_APP.page) {
                            case pages.MAIN:
                                return "sq_main_page";
                            case pages.PRODUCT_LIST:
                                return "sq_product_list_page";
                            case pages.PRODUCT_DETAIL:
                                return "sq_detail_page";
                            case pages.PRODUCT_SEARCH:
                                return "sq_search_page";
                            case pages.ORDER_BASKET:
                                return "sq_basket_page";
                            case pages.MEMBER_LOGIN:
                                return "sq_login_page";
                            case pages.MEMBER_AGREEMENT:
                                return "sq_join_first_page";
                            case pages.MEMBER_JOIN:
                            case pages.MEMBER_MODIFY:
                                return "sq_join_page";
                            case pages.MEMBER_JOINRESULT:
                                return "sq_join_complete_page";
                            case pages.ORDER_ORDERRESULT:
                                return "sq_order_result_page";
                            case pages.BOARD_PRODUCT_LIST:
                            case pages.BOARD_FREE_LIST:
                            case pages.MYSHOP_BOARDLIST:
                            case pages.MYSHOP_MAIN:
                                return "sq_cookie_page";
                            case pages.ORDER_ORDERFORM:
                                return "sq_order_page";
                            case pages.MYSHOP_COUPON_COUPON:
                                return "sq_mycoupon_page";
                          }
                          return null;
                      },
                      insertPageScript: function() {
                          let page        = CAFE24_APP.page,
                              detailInfo  = this.storeInfo.detail,
                              usePush     = false,
                              useReview   = false,
                              useQ        = false,
                              header,
                              footer;
                          if(!page) return;
 
                          header = this.makeCommonHeader();
                          if (!header) return;
 
                          usePush   = SNAP_APP.isUseSolution("push");
                          useReview = SNAP_APP.isUseSolution("review");
                          useQ      = SNAP_APP.isUseSolution("q");

                          if (usePush || useReview) {
                              footer = this.makePushBottom();
                              this.appendPushPageScript(header, footer);
                          }
                          footer = footer || document.createDocumentFragment();

                          (usePush || useQ) && appendElement(footer, this.makeQBottom());
                          SNAP_APP.isUseSolution("check") && this.storeInfo.check_apikey && appendElement(footer, this.makeCheckBottom());
 
                          if(detailInfo) {
                              if(useReview && detailInfo.review) {
                                  appendElement(header, this.makeElement('style', {}, '.snapreview_hidden {height: 0 !important; visibility: hidden !important; margin: 0 !important; padding: 0 !important; overflow: hidden !important; flex: unset !important;}'));
                                  appendElement(footer, this.makeReviewBottom());
                              }
                              SNAP_APP.isUseSolution("fit") && detailInfo.fit && appendElement(footer, this.makeFitBottom());

                              useQ && detailInfo.q && appendElement(footer, this.appendQPageScript());
                          }
 
                          appendElement(document.head, header);
                          appendElement(document.body, footer);
                      },
                      makeCommonHeader: function() {
                          let header      = SNAP_APP.findElement("#sfsnapfit_store_id"),
                              storeName;
                          if(header) return null;
             
                          storeName   = this.storeInfo.store_name;
                          header      = document.createDocumentFragment();
                          appendElement(
                              header,
                              this.makeElement("span", {id: "solutiontype"}, this.storeInfo.solution),
                              this.makeElement("span", {id: "sfsnapfit_store_id"}, storeName),
                              appendElement(
                                  this.makeElement("div", {style: "display: none;"}),
                                  this.makeElement("input", {id: "sf_draw_type", type: "hidden", value: CAFE24_APP.deviceType}),
                                  this.makeElement("input", {id: "sf_store_name", type: "hidden", value: storeName})
                              )
                          );
 
                          CAFE24_APP.isLogin && appendElement(
                              header,
                              appendElement(
                                  this.makeElement("div", {style: "display: none;"}),
                                  this.makeElement("span", {id: "sf_user_name", class: "xans-member-var-id", style: "display: none;"}, CAFE24_APP.memberInfo.userId),
                                  this.makeElement("span", {id: "sf_group_name", class: "xans-member-var-group_name", style: "display: none;"}, CAFE24_APP.memberInfo.groupName),
                                  this.makeElement("span", {id: "sf_member_name", class: "xans-member-var-name", style: "display: none;"}, CAFE24_APP.memberInfo.userName)
                              )
                          );
               
                          return header;
                      },
                      makeReviewBottom: function() {
                          let review        = this.storeInfo.detail.review,
                              tags          = review.widgets || {},
                              headStyle     = {},
                              dependent     = review["dependent"],
                              independent   = review["independent"],
                              footer,
                              onLoad,
                              script;
                          if(!review) return null;
 
                          dependent && Object.keys(dependent).length && SNAP_APP.objectEach(dependent, function(v, k, o) {
                              if(["single_page_review"].indexOf(k) !== -1) return;
                              tags[`${k}_dependent`] = v;
                              delete o[k];
                          });
                          independent && Object.keys(independent).length && SNAP_APP.objectEach(independent, function(v, k, o) {
                              if(["review_count", "see_more", "review_write_btn"].indexOf(k) !== -1) return;
                              tags[`${k}_independent`] = v;
                              delete o[k];
                          });
                          Object.keys(tags).length && SNAP_APP.objectEach(tags, function(v, k) {
                              let target  = v.position,
                                  attrs   = {
                                      class: "snap_widget"
                                  },
                                  tag     = 'span',
                                  text,
                                  insertType,
                                  callback = (element) => element;
 
                              if(k.indexOf("review_count") === 0) {
                                  attrs.class   = "snap_review_count noset";
                                  text          = "0";
                                  callback      = SNAP_APP.addTextContent.bind(null, target.add_text_selector);
                              } else if(k.indexOf("avg_score") === 0) {
                                  attrs.class = "snap_review_avg_score noset";
                              } else if(k.indexOf("writeable_review_count") === 0) {
                                  attrs.class = "snap_writeable_review_count";
                              } else if(k.indexOf("add_image") === 0) {
                                  if (!v.etc) return;

                                  tag   = "img";
                                  attrs = {
                                    class   : "bestPhotoReviewImg",
                                    src     : v.etc,
                                    style   : v.style?.join("; ")
                                  }
                              } else if (k == 2) {
                                  attrs.class = "";
                                  attrs.id    = "snapreview_itemlist";
                              } else if (k.indexOf("css_style") === 0) {
                                  headStyle[k.replace("css_style_", "")] = v;
                                  return;
                              } else {
                                  tag         = 'div';
                                  attrs.id    = k;
                              }
 
                              if("append"         == target.type) insertType = appendElement;
                              else if("prepend"   == target.type) insertType = prependElement;
                              else if("after"     == target.type) insertType = afterElement;
                              else if("before"    == target.type) insertType = beforeElement;
                              else return;
 
                              // 텍스트 지움, 리뷰 개수 앞/뒤 텍스트 추가 세팅
                              target.hide_selector && SNAP_APP.setTexts(SNAP_APP.findElement(target.hide_selector.join(", ")));

                              target = SNAP_APP.findElement(target.selector);
                              target && getArgumentArray.call(target).map(function(t) {
                                  insertType(t, callback(SNAP_APP.makeElement(tag, attrs, text)));
                              });
                          });
                          delete review.widgets;

                          // CSS 스타일 세팅
                          this.setReviewHeadStyle(headStyle);

                          // 비종속 구매후기 버튼 세팅
                          independent && independent["review_write_btn"] && this.setReviewWriteButtons(independent["review_write_btn"]);
                          // 종속 리뷰 새창으로 노출 버튼 세팅
                          dependent && dependent["single_page_review"] && this.setReviewSinglePage(dependent["single_page_review"]);
 
                          onLoad = function onloadsnapscript(storeName, review) {
                              let snapInstance    = new snapSolution(storeName),
                                  independent     = review["independent"],
                                  reviewCount,
                                  seeMore,
                                  onLoad;
                              review["dependent"] && snapInstance.loadScript("review_dependent");
                              if(!independent) return;
 
                              if(independent["see_more"] || independent["review_count"]) {
                                  seeMore     = independent["see_more"];
                                  reviewCount = independent["review_count"];
                                  onLoad = function() {
                                      if("object" != typeof snapinstanceindependent) return;
                                      
                                      "object" == typeof reviewCount && "function" == typeof snapinstanceindependent.addReviewCountTags     && snapinstanceindependent.addReviewCountTags(reviewCount.position.item_selector, reviewCount.position.data_selector, reviewCount.position.selector);
                                      seeMore                        && "function" == typeof snapinstanceindependent.catchMoreItemReviewCnt && snapinstanceindependent.catchMoreItemReviewCnt();
                                      
                                      "object" == typeof reviewCount && seeMore || "function" == typeof snapinstanceindependent.request_snap_review_cnt && snapinstanceindependent.request_snap_review_cnt();
                                  }
                              }
                              snapInstance.loadScript("review_independent", onLoad);
                          };
                          script = this.makeElement("script", {
                              async:      "1",
                              type:       "text/javascript",
                              src:        `//sfre-sr${SNAP_APP.reviewKey}-service.snapfit.co.kr/js/snap_combine_script.js`,
                              defer:      "true",
                              charset:    "utf-8",
                              onload:     `onloadsnapscript('${this.storeInfo.store_name}', ${JSON.stringify(review)});`
                          });
                          script.addEventListener('load', function() {
                              SNAP_APP.hiddenElements(review.hiddens);
                              document.querySelectorAll("table.snapreview_hidden, .snapreview_hidden table").forEach(ele => ele.setAttribute("hidden", ""));
                          });
                          footer = document.createDocumentFragment();
                          return appendElement(
                              footer,
                              this.makeElement("script", null, onLoad.toString()),
                              script
                          );
                      },
                      makeQBottom: function() {
                          let footer = SNAP_APP.findElement("#sf_isdetail_page");
                          if (footer) return null;

                          let mobileUrl = CAFE24_APP.isMobile && "_m_frame" || "";

                          footer = document.createDocumentFragment();
                          return appendElement(
                              footer,
                              this.makeElement("div", {id: "sf_isdetail_page", style: "display: none;"}, "1"),
                              this.makeElement("script", {async: "1", defer: "true", type: "text/javascript", src: `//snapfit.co.kr/js/sf_init_snapq_detail${mobileUrl}.js`, charset: "utf-8"})
                          );
                      },
                      appendQPageScript: function() {
                          // 큐 당일배송 스크립트 삽입
                          let q      = SNAP_APP.storeInfo.detail.q,
                              footer;
                          if(!q) return null;
 
                          Object.keys(q).length && SNAP_APP.objectEach(q, function(v, k) {
                              let target  = v.position,
                                  tag     = 'div',
                                  attrs   = {},
                                  insertType;
                             
                              if(k.indexOf("today_delivery") === 0) {
                                  attrs.id = "snapc_today_delivery_frame";
                              } else return;

                              if (v.style?.length) {
                                  attrs.style = v.style.join("; ");
                              }
 
                              if("append" == target.type)        insertType = appendElement;
                              else if("prepend" == target.type)  insertType = prependElement;
                              else if("after" == target.type)    insertType = afterElement;
                              else if("before" == target.type)   insertType = beforeElement;
                              else return;
 
                              target = SNAP_APP.findElement(target.selector);
                              target && getArgumentArray.call(target).map(function(t) {
                                  insertType(t, SNAP_APP.makeElement(tag, attrs));
                              });
                          });
                          footer = document.createDocumentFragment();
                          return appendElement(
                              footer,
                              this.makeElement("script", {
                                  async:      "1",
                                  type:       "text/javascript",
                                  src:        `//${SNAP_APP.qKey}snapfit.co.kr/js/sf_init_snapq_today_delivery.js`,
                                  defer:      "true",
                                  charset:    "utf-8",
                              })
                          );
                      },
                      makeCheckBottom: function() {
                          let footer        = SNAP_APP.findElement("#sc_audit_page"),
                              page          = CAFE24_APP.page,
                              storeInfo     = this.storeInfo,
                              deviceType    = CAFE24_APP.deviceType,
                              pageType;

                          if (footer || !this.checkPages.includes(page)) return null;
                          
                          if (deviceType.indexOf("mo") > -1) {
                              deviceType = "MO";
                          }

                          pageType = `${deviceType}_${page.replace("PRODUCT_", "")}`;

                          footer = document.createDocumentFragment();
                          return appendElement(
                              footer,
                              this.makeElement("div", {id: "sc_audit_page", style: "display: none"}, "1"),
                              this.makeElement("script", {
                                src     : "//cdn.snapfit.co.kr/snapcheck/script/audit.min.js",
                                onload  : `INIT_SNAP_AUDIT({apiKey: "${storeInfo.check_apikey}", apiServer: "https://devsnapcheck-api.snapfit.co.kr", hosting: "${(storeInfo.solution).toUpperCase()}", type: "${pageType.toUpperCase()}"})`
                              })
                          );
                      },
                      makePushBottom: function() {
                          let footer  = SNAP_APP.findElement("#spm_page_type"),
                              page    = SNAP_APP.getPageType();
                          if(footer || !page) return null;

                          if (this.pushUsePages.includes(CAFE24_APP.page) && !SNAP_APP.isUseSolution("push")) return null;
 
                          footer = document.createDocumentFragment();
                          appendElement(
                              footer,
                              this.makeElement("div", {id: "spm_page_type", style: "display: none;"}, page),
                              this.makeElement("script", {async: "1", type: "text/javascript", src: "//cdn.snapfit.co.kr/js/spm_f_common.js", charset: "utf-8"}),
                              this.makeElement("div", {id: "spm_banner_main"})
                          );
                         
                          return footer;
                      },
                      appendPushPageScript: function(header, footer) {
                          let page    = CAFE24_APP.page,
                              script;
 
                          if(CAFE24_APP.pages.ORDER_BASKET == page) {
                              appendElement(
                                  footer,
                                  appendElement(
                                      this.makeElement("div", {id: "spm_cafe_basket_wrap", style: "display: none;"}),
                                      this.makeElement("input", {id: "sf_basket_total_price", type: "hidden", value: CAFE24_APP.basketPrice})
                                  )
                              );
                          } else if(CAFE24_APP.pages.ORDER_ORDERRESULT == page) {
                              script = this.makeElement('script', {type: 'text/javascript', src: '//cdn.snapfit.co.kr/js/push/order.js', charset: 'utf-8'});
                              script.addEventListener('load', function() {
                                  let footer = document.createDocumentFragment();
                                  appendElement(footer, SNAP_APP.makeElement('script', null, 'snapPushOrderInstance.sendOrderStatistics();'));
 
                                  if(CAFE24_APP.orderPromise) {
                                      CAFE24_APP.orderPromise.then(function(orderInfo) {
                                          let total,
                                              totalSalePrice = 0;
                                          orderInfo   = orderInfo[0];
                                          total       = orderInfo.actual_order_amount;
                                          SNAP_APP.objectEach(orderInfo.items, function(item) {
                                              let salePrice   = Number(item.additional_discount_price) + Number(item.app_item_discount_amount) + Number(item.coupon_discount_price);
                                              totalSalePrice += salePrice;
                                              prependElement(
                                                  footer,
                                                  SNAP_APP.makeElement(
                                                      'script',
                                                      null,
                                                      `snapPushOrderInstance.addOrderItem(
                                                          "${item.product_no}",
                                                          "${item.product_price}",
                                                          "${item.quantity}",
                                                          "",
                                                          "${salePrice}"
                                                          "0"
                                                      )`
                                                  )
                                              );
                                          });
                                          prependElement(
                                              footer,
                                              SNAP_APP.makeElement(
                                                  'script',
                                                  null,
                                                  `
                                                      snapPushOrderInstance.orderNo = '${orderInfo.order_id}';
                                                      snapPushOrderInstance.setPayPrice('${total.total_amount_due}');
                                                      snapPushOrderInstance.setUseMileage('${total.points_spent_amount}');
                                                      snapPushOrderInstance.setCouponDiscount('${total.coupon_discount_price}');
                                                      snapPushOrderInstance.setTotalPrice('${total.order_price_amount}');
                                                      snapPushOrderInstance.setTotalDiscount('${totalSalePrice}');
                                                      snapPushOrderInstance.groupName = '${CAFE24_APP.groupName}';
                                                  `
                                              )
                                          );
                                      });
                                  }
 
                                  appendElement(document.body, footer);
                              });
                              appendElement(header, script);
                          }
                      },
                      makeFitBottom: function() {
                          let fit     = SNAP_APP.storeInfo.detail.fit,
                              footer;
                          if(!fit) return null;
 
                          Object.keys(fit).length && SNAP_APP.objectEach(fit, function(v, k) {
                              let target  = v.position,
                                  tag     = 'div',
                                  attrs   = {},
                                  insertType;
                             
                              if(k.indexOf("main_popup_call_btn") === 0) {
                                  attrs.id = "sfsnapfit_main_popup_call_btn";
                              } else if(k.indexOf("option_widget") === 0) {
                                  attrs.id = "sfsnapfit_option_widget";
                              } else if(k.indexOf("main") === 0) {
                                  attrs.id = "sfsnapfit_main";
                              } else return;

                              if (v.style?.length) {
                                  attrs.style = v.style.join("; ");
                              }
 
                              if("append" == target.type)        insertType = appendElement;
                              else if("prepend" == target.type)  insertType = prependElement;
                              else if("after" == target.type)    insertType = afterElement;
                              else if("before" == target.type)   insertType = beforeElement;
                              else return;
 
                              target = SNAP_APP.findElement(target.selector);
                              target && getArgumentArray.call(target).map(function(t) {
                                  insertType(t, SNAP_APP.makeElement(tag, attrs));
                              });
                          });
                          footer = document.createDocumentFragment();
                          return appendElement(
                              footer,
                              this.makeElement("script", {
                                  async:      "1",
                                  type:       "text/javascript",
                                  src:        `//${SNAP_APP.fitKey}snapfit.co.kr/js/sf_init_snapfit_detail.js`,
                                  defer:      "true",
                                  charset:    "utf-8",
                              })
                          );
                      },
                      isTest: function(s, tester) {
                          if(!CAFE24_APP.isLogin) return false;
                          let users     = [CAFE24_APP.memberInfo.userId, CAFE24_APP.memberInfo.email].filter(val => val),
                              result    = false;
                          if(!users.length) return false;

                          for(const userId of users) {
                              if(s.hasOwnProperty(userId)) {
                                  SNAP_APP.setSnapKey(s[userId]["type"] || 0);
                                  SNAP_APP.isS = true;
                                  if(s[userId]["test"]) {
                                      tester.push(userId)
                                      result = true;
                                  };
                                  break;
                              }
                          }

                          return result || users.reduce((res, userId) => {
                              return res || tester.indexOf(userId) !== -1
                          }, false);
                      },
                      sLog: function(useScript, deviceType, solution, page) {
                          if(!SNAP_APP.isS || !CAFE24_APP.isLogin) return;

                          const userId  = CAFE24_APP.memberInfo.userId,
                                email   = CAFE24_APP.memberInfo.email;

                          console.groupCollapsed(`SNAP 스크립트`);
                          console.log(`* 사내 계정 로그인 확인`);
                          console.log(` > 로그인 계정 : ${userId}`);
                          email && console.log(` > 이메일 : ${email}`);
                          console.log(`스크립트 로드 여부 : ${useScript}`);
                          console.groupCollapsed(`허용 정보`);
                          console.log(`디바이스 : ${deviceType.join(', ')}`);
                          console.log(`솔루션 : ${solution.join(', ')}`);
                          console.log(`페이지 : ${page.join(', ')}`);
                          console.groupEnd();
                          console.groupCollapsed(`접속 정보`);
                          console.log(`접속 디바이스 : ${CAFE24_APP.deviceType}`);
                          console.log(`접속 페이지 : ${CAFE24_APP.page}`);
                          console.groupEnd();
                          console.groupEnd();
                      },
                      setReviewWriteButtons: async function(tags) {
                        let writeBtn        = tags.position,
                            shopNo          = SNAP_APP.shopNo,
                            parents         = SNAP_APP.findElement(writeBtn.item_selector),
                            orderInfo       = null;
                        
                        if (!parents) return;

                        // 주문내역 상세 파라미터
                        let hStartDate      = CAFE24_APP.orderHistory.getUrlParam("history_start_date"),
                            hEndDate        = CAFE24_APP.orderHistory.getUrlParam("history_end_date"),
                            hOrderStatus    = CAFE24_APP.orderHistory.getUrlParam("order_status"),
                            hPage           = CAFE24_APP.orderHistory.getUrlParam("page"),
                            hCount          = CAFE24_APP.orderHistory.getUrlParam("count");

                        // 리뷰 작성 버튼 품목번호에 맞춰 세팅
                        const processOrder = function (items) {
                            let dom = SNAP_APP.findElement(writeBtn.item_selector);
                            SNAP_APP.objectEach(items, (item, key, obj) => {
                                let targetElement = dom[key].querySelector(writeBtn.selector);

                                if (!targetElement) return;

                                // 기존 타솔루션 클래스/이벤트 존재 시 삭제
                                let targetClasses = SNAP_APP.getClass(targetElement).filter(v => v.startsWith("crema"));
                                if (targetClasses.length) {
                                    targetClasses.forEach(className => SNAP_APP.removeClass(targetElement, className));

                                    let originTargetElement = targetElement;
                                    targetElement = originTargetElement.cloneNode(true);

                                    originTargetElement.parentNode.replaceChild(targetElement, originTargetElement);
                                }

                                SNAP_APP.setAttributes(targetElement, {
                                    "href"          : "#",
                                    "data-detail"   : `ord_item_code=${item.order_item_code}`
                                });
                                SNAP_APP.addClass(targetElement, "snap_review_write_btn");

                                delete obj[key];
                            });
                        };

                        // 주문 내역 상세 조회 페이지인 경우, 주문번호로 데이터 조회
                        if (CAFE24_APP.page == CAFE24_APP.pages.MYSHOP_ORDER_DETAIL) {
                            let orderId = CAFE24_APP.orderHistory.getUrlParam("order_id");
                            if (!orderId) return;

                            let orderDetail = await CAFE24_APP.commonInfo.getOrderDetailInfo(shopNo, orderId);
                            if (!getArrayValid(orderDetail).length) return;

                            orderInfo = orderDetail[0]["items"] || {};
                        } else {
                            orderInfo = await CAFE24_APP.commonInfo.getOrderItemList(hStartDate, hEndDate, hOrderStatus, hPage, hCount);
                        }

                        // 구매후기 버튼 세팅 함수 실행
                        processOrder(orderInfo);
                      },
                      setReviewSinglePage: function(tags) {
                        let target  = tags.position,
                            targetElement = SNAP_APP.findElement(target.selector);

                        if (!targetElement) return;

                        targetElement.forEach(element => {
                            SNAP_APP.addClass(element, "sf_review_rd_bRtCn");
                            SNAP_APP.setAttributes(element, {"href": "#"});
                            element.removeAttribute("onclick");
    
                            // 리뷰 개수 사용 여부 체크
                            if (Number(target.is_use)) {
                                let insertType = `${target.type}Element`,
                                    subElement = SNAP_APP.addTextContent(target.add_text_selector, SNAP_APP.makeElement("span", {class: "snap_review_count noset"}, "0"));
                                
                                target.hide_selector && SNAP_APP.setTexts(SNAP_APP.findElement(target.hide_selector.join(", ")));

                                eval(insertType)(element, subElement);
                            }
                        });
                        
                      },
                      getReviewHeadStyleType: function(target, type) {
                          if (target.search(/(review_score|review_count)/) < 0) return;

                          let reviewCountType   = type == "dependent" ? ":not([snap_item_id])" : "[snap_item_id]",
                              className         = target.indexOf("review_score") > -1 ? "snap_review_avg_score" : `snap_review_count${reviewCountType}`,
                              etcStyle          = target.replace(/(review_score|review_count)/, ""),
                              subClass          = etcStyle.replace("_", "::") || "";

                          return `.${className}${subClass}`;
                      },
                      setReviewHeadStyle: function(styles) {
                          if (!Object.keys(styles).length) return;

                          let innerStyle = [];
                          SNAP_APP.objectEach(styles, (value, type) => {
                              SNAP_APP.objectEach(value, (data, tag) => {
                                  let className = this.getReviewHeadStyleType(tag, type);
    
                                  if (!(className && data.length)) return;
    
                                  innerStyle.push(`${className} {${data.join("; ")}}`);
                              });
                          });

                          innerStyle.length && appendElement(document.head, SNAP_APP.makeElement("style", {}, innerStyle.join("\n")));
                      },
                      getReviewHeadStyleType: function(target, type) {
                          if (target.search(/(review_score|review_count)/) < 0) return;

                          let reviewCountType   = type == "dependent" ? ":not([snap_item_id])" : "[snap_item_id]",
                              className         = target.indexOf("review_score") > -1 ? "snap_review_avg_score" : `snap_review_count${reviewCountType}`,
                              etcStyle          = target.replace(/(review_score|review_count)/, ""),
                              subClass          = etcStyle.replace("_", "::") || "";

                          return `.${className}${subClass}`;
                      },
                      setReviewHeadStyle: function(styles) {
                          if (!Object.keys(styles).length) return;

                          let innerStyle = [];
                          SNAP_APP.objectEach(styles, (value, type) => {
                              SNAP_APP.objectEach(value, (data, tag) => {
                                  let className = this.getReviewHeadStyleType(tag, type);
    
                                  if (!(className && data.length)) return;
    
                                  innerStyle.push(`${className} {${data.join("; ")}}`);
                              });
                          });

                          innerStyle.length && appendElement(document.head, SNAP_APP.makeElement("style", {}, innerStyle.join("\n")));
                      },
                      setSnapKey: function(key) {
                          if(1 == key) {
                              this.fitKey     = "fitqa.";
                              this.reviewKey  = "qal";
                          } else if(2 == key) {
                              this.fitKey     = "fitqa2.";
                              this.reviewKey  = "qal2";
                              this.qKey       = "test2.";
                          }
                      },
                      hiddenElements: function(hiddens) {
                          if(!hiddens || !Array.isArray(hiddens)) return;
                          let element = document.querySelectorAll(hiddens.join(', '));
                          getArgumentArray.call(element).map(function(e) {
                              SNAP_APP.addClass(e, "snapreview_hidden");
                          });
                      },
                      findElement: function(selector) {
                          selector = selector && document.querySelectorAll(selector) || [];
                          return selector.length && selector || null;
                      },
                      makeElement: function(tag, attrs, text) {
                          let element, base;
                          if(!this.elementMakers.hasOwnProperty(tag)) {
                              base = document.createElement(tag);
                              this.elementMakers[tag] = function() {
                                  return base.cloneNode();
                              }
                          }
                          element = this.elementMakers[tag]();
                          (attrs || text) && this.setAttributes(element, attrs, text);
                          return element;
                      },
                      addTextContent: function(texts, element) {
                          if (!texts) return element;

                          let baseElement = document.createDocumentFragment();
                          return appendElement(
                              baseElement,
                              SNAP_APP.makeElement("span", {}, texts.before || ""),
                              element,
                              SNAP_APP.makeElement("span", {}, texts.after || "")
                          );
                      },
                      setTexts: function(element, text) {
                          if (!element) return;
                          getArgumentArray.call(element).map(function(e) {
                              e.innerHTML = text || "";
                          });
                      },
                      setAttributes: function(element, attrs, text) {
                          if(!element) return;
                          attrs = attrs || {};
                          this.objectEach(attrs, function(v, k) {
                              element.setAttribute(k, v);
                          })
                          if(text && "string" == typeof text) element.textContent = text;
                      },
                      toArray: function(value) {
                          return Array.isArray(value) && value || [value];
                      },
                      isValidElement: function(element) {
                          return element && "function" === typeof element.getAttribute;
                      },
                      isValidClass: function(classes) {
                          return Array.isArray(classes) || "string" == typeof classes;
                      },
                      isValidParameter: function(element, classes) {
                          return this.isValidClass(classes) && this.isValidElement(element);
                      },
                      arrayUnique: function(array) {
                          return Array.isArray(array) && array.filter(function(v, i, array) {
                              return array.indexOf(v) === i && array.indexOf(v, i + 1) === -1;
                          }) || array;
                      },
                      getClass: function(element) {
                          if(!this.isValidElement(element)) return;
                          let classes = element.getAttribute('class') || "";
                          return classes.split(" ").filter(function(v) {
                              return v;
                          });
                      },
                      setClass: function(element, classes) {
                          if(!this.isValidParameter(element, classes)) return element;
                          classes = this.toArray(classes);
                          element.setAttribute('class', classes.join(" "));
                          return element;
                      },
                      addClass: function(element, classes) {
                          if(!this.isValidParameter(element, classes)) return element;
                          classes = this.toArray(classes);
 
                          let old = this.getClass(element);
                          classes.map(function(v) {
                              old.push(v);
                          });
                          return this.setClass(element, this.arrayUnique(old));
                      },
                      removeClass: function(element, className) {
                          if(!this.isValidParameter(element, className)) return element;
                          let classes = this.getClass(element).filter(function(v) {
                              return v != className;
                          });
                          return this.setClass(element, classes);
                      },
                      objectEach: function(obj, callback) {
                          if("object" != typeof obj || "function" != typeof callback) return;
                          let key, res;
                          for(key in obj) {
                              res = callback(obj[key], key, obj);
                              if(true === res) continue;
                              else if(false === res) break;
                          }
                      }
                  };
              })();

        CAFE24_APP.load().then(SNAP_APP.setStoreInfo.bind(SNAP_APP));
        window.IS_LOAD_SNAP_APP = true;
    })();
})();