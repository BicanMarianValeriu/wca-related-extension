(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/RelatedEntries"],{

/***/ "./src/js/RelatedEntries.js":
/*!**********************************!*\
  !*** ./src/js/RelatedEntries.js ***!
  \**********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_helpers_assertThisInitialized__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/helpers/assertThisInitialized */ "./node_modules/@babel/runtime/helpers/assertThisInitialized.js");
/* harmony import */ var _babel_runtime_helpers_assertThisInitialized__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_assertThisInitialized__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _babel_runtime_helpers_get__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @babel/runtime/helpers/get */ "./node_modules/@babel/runtime/helpers/get.js");
/* harmony import */ var _babel_runtime_helpers_get__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_get__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @babel/runtime/helpers/inherits */ "./node_modules/@babel/runtime/helpers/inherits.js");
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @babel/runtime/helpers/possibleConstructorReturn */ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js");
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @babel/runtime/helpers/getPrototypeOf */ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js");
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_8__);










function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_8___default()(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_8___default()(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_7___default()(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

/**
 * RelatedEntries JS Plugin
 * @author 		Bican Marian Valeriu
 * @license 	https://www.wecodeart.com/
 * @uses		Component Class
 * @uses		Template Class
 */
/* harmony default export */ __webpack_exports__["default"] = ((function (wecodeart) {
  var Component = wecodeart.Component,
      Template = wecodeart.Template;

  var isEven = function isEven(value) {
    if (value % 2 == 0) return true;else return false;
  }; // Add Related Template


  Template.addTemplate('related-post', function (entry) {
    var title = entry.title,
        link = entry.link,
        dateOpts = entry.date_gmt,
        imageURL = entry.featured_media.url,
        _entry$author = entry.author,
        name = _entry$author.name,
        avatar = _entry$author.avatar,
        _entry$options = entry.options,
        options = _entry$options === void 0 ? {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    } : _entry$options,
        _entry$lang = entry.lang,
        lang = _entry$lang === void 0 ? document.documentElement.getAttribute('lang') || 'en-US' : _entry$lang;
    var date = new Date(dateOpts);
    var attrMatcher = /(?:class *= *[\'\"]{0,1})((?:[\w -](?!\w+=|\/))+)[\'\"]*/gi;
    var postHTML = document.createElement('article');
    postHTML.className = 'related-posts__item related-post related-post--js col-12 col-md-6';
    postHTML.style.backgroundImage = "url('".concat(imageURL, "')");
    postHTML.innerHTML = "\n\t\t\t<a href=\"".concat(link, "\" class=\"related-post__body position-relative d-block p-3 p-md-4\">\n\t\t\t\t<h4 class=\"related-post__title font-weight-bold mb-1 text-truncate\">").concat(title.rendered, "</h4>\n\t\t\t\t<p class=\"related-post__date mb-2 text-primary\">\n\t\t\t\t\t<i class=\"fal fa-clock me-2\"></i>\n\t\t\t\t\t<time class=\"text-muted\" datetime=\"").concat(dateOpts, "\">").concat(date.toLocaleDateString(lang, options), "</time>\n\t\t\t\t</p>\n\t\t\t\t<p class=\"related-post__author mb-0\">\n\t\t\t\t\t").concat(avatar.replace(attrMatcher, 'class="related-post__avatar rounded-circle d-inline-block mr-2"'), "\n\t\t\t\t\t<span class=\"font-weight-bold text-dark\">by ").concat(name, "</span>\n\t\t\t\t</p>\n\t\t\t</a> \n\t\t");
    return postHTML;
  }); // Set Defaults

  var pluginDefaults = {
    path: '/wp/v2/posts',
    postId: 0,
    query: {
      amount: 4
    },
    template: 'related-post',
    observer: {
      root: null,
      rootMargin: '0px',
      threshold: 0
    },
    afterFetching: function afterFetching(data, options) {
      var Template = wecodeart.Template;
      var element = options.element,
          template = options.template,
          _options$classes = options.classes,
          loaded = _options$classes.loaded,
          loading = _options$classes.loading;

      var hideIfEven = function hideIfEven(e) {
        return e.classList.add('d-none');
      };

      element.classList.remove(loading);
      data.map(function (e, i) {
        return element.querySelector('.row').children[i].replaceWith(Template.render(template, e));
      });

      if (isEven(data.length)) {
        element.querySelectorAll('.related-post:not(.related-post--js)').forEach(hideIfEven);
      }

      element.classList.add(loaded);
    },
    classes: {
      loading: 'js--is-loading',
      loaded: 'js--loaded'
    }
  };
  /**
   * @class
   */

  var RelatedEntries = /*#__PURE__*/function (_Component) {
    _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_6___default()(RelatedEntries, _Component);

    var _super = _createSuper(RelatedEntries);

    /**
     * Construct Animate instance
     * @constructor
     * @param {Element} el
     * @param {Object} options
     */
    function RelatedEntries(el, options) {
      var _this;

      _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_2___default()(this, RelatedEntries);

      _this = _super.call(this, RelatedEntries, el, options);
      _this.el.RelatedEntries = _babel_runtime_helpers_assertThisInitialized__WEBPACK_IMPORTED_MODULE_4___default()(_this);
      /**
       * Options for the animation
       * @member RelatedEntries#options
       */

      _this.options = Object.assign({}, RelatedEntries.defaults, {
        element: _this.el
      }, options);

      RelatedEntries._elements.push(_babel_runtime_helpers_assertThisInitialized__WEBPACK_IMPORTED_MODULE_4___default()(_this));

      _this._setupEventHandlers();

      return _this;
    }

    _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_3___default()(RelatedEntries, [{
      key: "destroy",

      /**
       * Teardown component
       */
      value: function destroy() {
        if (RelatedEntries.getInstance(this.el)) {
          this._removeEventHandlers();

          var index = RelatedEntries._elements.indexOf(this);

          RelatedEntries._elements.splice(index, 1);

          this.el.RelatedEntries = undefined;
        }
      }
    }, {
      key: "_removeClasses",
      value: function _removeClasses() {
        // IE 11 bug (can't remove multiple classes in one line)
        this.el.classList.remove(this.options.classes.loaded);
      }
      /**
       * Setup Events
       */

    }, {
      key: "_setupEventHandlers",
      value: function _setupEventHandlers() {
        var _this2 = this;

        var _this$options = this.options,
            postId = _this$options.postId,
            afterFetching = _this$options.afterFetching,
            loading = _this$options.classes.loading,
            query = _this$options.query,
            observer = _this$options.observer;
        var theObserver = new IntersectionObserver(function (el) {
          if (el.shift().isIntersecting) {
            _this2.el.classList.add(loading);

            RelatedEntries.get({
              postId: postId,
              query: query
            }).then(function (d) {
              return afterFetching(d, _this2.options);
            }).catch(function (e) {
              return console.warn(e);
            });
            theObserver.unobserve(_this2.el);
          }
        }, observer);
        theObserver.observe(this.el);
      }
      /**
       * Remove Event Handlers
       */

    }, {
      key: "_removeEventHandlers",
      value: function _removeEventHandlers() {
        if (RelatedEntries.getInstance(this.el)) {// DO stuff
        }

        ;
      }
      /**
       * Retrieves events for a date range
       *
       * @param {object} options
       */

    }], [{
      key: "init",
      value: function init(els, options) {
        return _babel_runtime_helpers_get__WEBPACK_IMPORTED_MODULE_5___default()(_babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_8___default()(RelatedEntries), "init", this).call(this, this, els, options);
      }
      /**
       * Get Instance
       */

    }, {
      key: "getInstance",
      value: function getInstance(el) {
        var domElem = el.jquery ? el[0] : el;
        return domElem.RelatedEntries;
      }
    }, {
      key: "get",
      value: function () {
        var _get2 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(_ref) {
          var postId, data, _wp, apiFetch, addQueryArgs, path;

          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
            while (1) {
              switch (_context.prev = _context.next) {
                case 0:
                  postId = _ref.postId, data = _ref.query;
                  _wp = wp, apiFetch = _wp.apiFetch, addQueryArgs = _wp.url.addQueryArgs;
                  path = RelatedEntries.defaults.path;
                  _context.next = 5;
                  return apiFetch({
                    path: addQueryArgs("".concat(path, "/").concat(postId, "/related"), data)
                  });

                case 5:
                  return _context.abrupt("return", _context.sent);

                case 6:
                case "end":
                  return _context.stop();
              }
            }
          }, _callee);
        }));

        function get(_x) {
          return _get2.apply(this, arguments);
        }

        return get;
      }()
    }, {
      key: "defaults",
      get: function get() {
        return pluginDefaults;
      }
    }]);

    return RelatedEntries;
  }(Component);
  /**
   * @static
   * @memberof RelatedEntries
   */


  RelatedEntries._elements = [];
  wecodeart.plugins.RelatedEntries = RelatedEntries;
}).apply(undefined, [window.wecodeart]));

/***/ })

}]);
//# sourceMappingURL=RelatedEntries.js.map