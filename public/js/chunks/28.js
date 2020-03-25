(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[28],{

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/auth/NewCompany.vue?vue&type=template&id=8e6da4ec&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/auth/NewCompany.vue?vue&type=template&id=8e6da4ec& ***!
  \*****************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass:
        "h-screen flex w-full bg-img vx-row no-gutter items-center justify-center",
      attrs: { id: "page-login" }
    },
    [
      _c(
        "div",
        {
          staticClass: "vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4"
        },
        [
          _c("vx-card", [
            _c(
              "div",
              {
                staticClass: "full-page-bg-color",
                attrs: { slot: "no-body" },
                slot: "no-body"
              },
              [
                _c(
                  "div",
                  {
                    staticClass: "vx-row no-gutter justify-center items-center"
                  },
                  [
                    _c(
                      "div",
                      { staticClass: "vx-col hidden lg:block lg:w-1/2" },
                      [
                        _c("img", {
                          staticClass: "mx-auto",
                          attrs: {
                            src: __webpack_require__(/*! @assets/images/pages/login.png */ "./resources/assets/images/pages/login.png"),
                            alt: "login"
                          }
                        })
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass:
                          "vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg"
                      },
                      [
                        _c("div", { staticClass: "p-8 login-tabs-container" }, [
                          _c("div", { staticClass: "vx-card__title mb-4" }, [
                            _c("h4", { staticClass: "mb-4" }, [
                              _vm._v(_vm._s(_vm.$t("suggestCompanyTitle")))
                            ]),
                            _vm._v(" "),
                            _c("p", [
                              _vm._v(
                                _vm._s(_vm.$t("suggestCompanyDescription"))
                              )
                            ])
                          ]),
                          _vm._v(" "),
                          _c(
                            "div",
                            [
                              _c(
                                "vs-select",
                                {
                                  staticClass: "w-full select-large",
                                  attrs: { label: _vm.$t("companyType") },
                                  model: {
                                    value: _vm.role,
                                    callback: function($$v) {
                                      _vm.role = $$v
                                    },
                                    expression: "role"
                                  }
                                },
                                _vm._l(_vm.roles, function(item, index) {
                                  return _c("vs-select-item", {
                                    key: index,
                                    staticClass: "w-full",
                                    attrs: { value: item, text: item }
                                  })
                                }),
                                1
                              ),
                              _vm._v(" "),
                              _c("vs-input", {
                                staticClass: "w-full",
                                attrs: {
                                  name: "last_name",
                                  "icon-no-border": "",
                                  icon: "icon icon-user",
                                  "icon-pack": "feather",
                                  "label-placeholder": _vm.$t("company")
                                },
                                model: {
                                  value: _vm.last_name,
                                  callback: function($$v) {
                                    _vm.last_name = $$v
                                  },
                                  expression: "last_name"
                                }
                              }),
                              _vm._v(" "),
                              _c("vs-input", {
                                staticClass: "w-full",
                                attrs: {
                                  name: "email",
                                  "icon-no-border": "",
                                  icon: "icon icon-user",
                                  "icon-pack": "feather",
                                  "label-placeholder": _vm.$t("email")
                                },
                                model: {
                                  value: _vm.email,
                                  callback: function($$v) {
                                    _vm.email = $$v
                                  },
                                  expression: "email"
                                }
                              }),
                              _vm._v(" "),
                              _c("vs-input", {
                                staticClass: "w-full mt-6",
                                attrs: {
                                  type: "password",
                                  name: "password",
                                  "icon-no-border": "",
                                  icon: "icon icon-lock",
                                  "icon-pack": "feather",
                                  "label-placeholder": _vm.$t("password")
                                },
                                model: {
                                  value: _vm.password,
                                  callback: function($$v) {
                                    _vm.password = $$v
                                  },
                                  expression: "password"
                                }
                              }),
                              _vm._v(" "),
                              _c("vs-input", {
                                staticClass: "w-full mt-6",
                                attrs: {
                                  type: "password",
                                  name: "password_confirmation",
                                  "icon-no-border": "",
                                  icon: "icon icon-lock",
                                  "icon-pack": "feather",
                                  "label-placeholder": _vm.$t(
                                    "passwordConfirmation"
                                  )
                                },
                                model: {
                                  value: _vm.password_confirmation,
                                  callback: function($$v) {
                                    _vm.password_confirmation = $$v
                                  },
                                  expression: "password_confirmation"
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "vs-button",
                                {
                                  attrs: {
                                    type: "border",
                                    to: { name: "auth.login" }
                                  }
                                },
                                [_vm._v(_vm._s(_vm.$t("gotoLogin")))]
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-button",
                                {
                                  staticClass: "float-right",
                                  on: { click: _vm.register }
                                },
                                [_vm._v(_vm._s(_vm.$t("register")))]
                              )
                            ],
                            1
                          )
                        ])
                      ]
                    )
                  ]
                )
              ]
            )
          ])
        ],
        1
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/assets/images/pages/login.png":
/*!*************************************************!*\
  !*** ./resources/assets/images/pages/login.png ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/login.png?d814adb752d2d047b8292d6de603025f";

/***/ }),

/***/ "./resources/js/src/views/auth/NewCompany.vue":
/*!****************************************************!*\
  !*** ./resources/js/src/views/auth/NewCompany.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _NewCompany_vue_vue_type_template_id_8e6da4ec___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./NewCompany.vue?vue&type=template&id=8e6da4ec& */ "./resources/js/src/views/auth/NewCompany.vue?vue&type=template&id=8e6da4ec&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");

var script = {}


/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  script,
  _NewCompany_vue_vue_type_template_id_8e6da4ec___WEBPACK_IMPORTED_MODULE_0__["render"],
  _NewCompany_vue_vue_type_template_id_8e6da4ec___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/auth/NewCompany.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/auth/NewCompany.vue?vue&type=template&id=8e6da4ec&":
/*!***********************************************************************************!*\
  !*** ./resources/js/src/views/auth/NewCompany.vue?vue&type=template&id=8e6da4ec& ***!
  \***********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NewCompany_vue_vue_type_template_id_8e6da4ec___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./NewCompany.vue?vue&type=template&id=8e6da4ec& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/auth/NewCompany.vue?vue&type=template&id=8e6da4ec&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NewCompany_vue_vue_type_template_id_8e6da4ec___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NewCompany_vue_vue_type_template_id_8e6da4ec___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);