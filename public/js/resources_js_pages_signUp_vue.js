"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_pages_signUp_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/signUp.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/signUp.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Router__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Router */ "./resources/js/Router/index.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "signUp",
  data: function data() {
    return {
      name: null,
      lastName: null,
      email: null,
      password: null,
      validName: null,
      passwordConfirm: null,
      validLastName: '',
      validEmail: '',
      validPassword: '',
      validPasswordConfirm: '',
      error: false,
      errorMessage: []
    };
  },
  watch: {
    // name() {
    //     this.error = false
    //     this.validName = this.name !== ''
    // },
    //
    // lastName() {
    //     this.error = false
    //     this.validLastName =  this.lastName !== ''
    // },
    //
    lastName: function lastName(val) {
      if (this.errorMessage.last_name) {
        console.log(999);
        if (val) {
          delete this.errorMessage.last_name;
        }
      }
    },
    email: function email(val) {
      if (this.errorMessage.email) {
        console.log(999);
        if (val) {
          delete this.errorMessage.email;
        }
      } else {
        this.error = false;
        this.validEmail = this.email.length > 4;
      }
    },
    password: function password() {
      this.error = false;
      this.validPassword = this.password.length > 4 && this.password.length < 20;
    },
    passwordConfirm: function passwordConfirm() {
      this.error = false;
      this.validPasswordConfirm = this.password === this.passwordConfirm && this.passwordConfirm !== '';
    }
  },
  methods: {
    signUp: function signUp() {
      var _this = this;
      var data = {
        first_name: this.name,
        last_name: this.lastName,
        email: this.email,
        password: this.password,
        passwordConfirm: this.passwordConfirm
      };
      axios.post('api/signUp', data).then(function (response) {
        if (response.status === 201 && response.data.success) {
          _this.$router.push({
            path: '/login'
          });
        }
      })["catch"](function (err) {
        console.log(err.response.data.errors, 9999);
        _this.error = true;
        _this.errorMessage = err.response.data.errors;
        console.log(err.response.data.message);
      });
      console.log();
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/signUp.vue?vue&type=template&id=5e44f03e&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/signUp.vue?vue&type=template&id=5e44f03e&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("b-container", [_c("b-form", {
    staticClass: "w-50 ms-auto me-auto",
    on: {
      submit: function submit($event) {
        $event.stopPropagation();
        $event.preventDefault();
        return _vm.signUp.apply(null, arguments);
      }
    }
  }, [_c("label", {
    attrs: {
      "for": "name-user"
    }
  }, [_vm._v("Name")]), _vm._v(" "), _c("b-form-input", {
    attrs: {
      type: "text",
      id: "name-user"
    },
    model: {
      value: _vm.name,
      callback: function callback($$v) {
        _vm.name = $$v;
      },
      expression: "name"
    }
  }), _vm._v(" "), _c("b-form-invalid-feedback", {
    attrs: {
      type: "text",
      state: _vm.validName
    }
  }, [_vm._v("\n           The filed is required...\n        ")]), _vm._v(" "), _c("b-form-valid-feedback", {
    attrs: {
      state: _vm.validName === true
    }
  }, [_vm._v("\n            Looks Good.\n        ")]), _vm._v(" "), _c("label", {
    attrs: {
      "for": "last_name"
    }
  }, [_vm._v("Last Name")]), _vm._v(" "), _c("b-form-input", {
    attrs: {
      id: "last_name"
    },
    model: {
      value: _vm.lastName,
      callback: function callback($$v) {
        _vm.lastName = $$v;
      },
      expression: "lastName"
    }
  }), _vm._v(" "), _vm.errorMessage.last_name ? _c("div", {
    staticClass: "text-danger mt-3"
  }, [_vm._v("\n            " + _vm._s(_vm.errorMessage.last_name[0]) + "\n        ")]) : _vm._e(), _vm._v(" "), !_vm.errorMessage.last_name ? _c("b-form-valid-feedback", {
    attrs: {
      state: _vm.validPassword === true
    }
  }, [_vm._v("\n            Looks Good.\n        ")]) : _vm._e(), _vm._v(" "), _c("label", {
    attrs: {
      "for": "feedback-user"
    }
  }, [_vm._v("Email")]), _vm._v(" "), _c("b-form-input", {
    attrs: {
      type: "email",
      id: "feedback-user"
    },
    model: {
      value: _vm.email,
      callback: function callback($$v) {
        _vm.email = $$v;
      },
      expression: "email"
    }
  }), _vm._v(" "), _vm.errorMessage.email ? _c("div", {
    staticClass: "text-danger mt-3"
  }, [_vm._v("\n            " + _vm._s(_vm.errorMessage.email[0]) + "\n        ")]) : _vm._e(), _vm._v(" "), _c("b-form-valid-feedback", {
    attrs: {
      state: _vm.validEmail === true
    }
  }, [_vm._v("\n            Looks Good.\n        ")]), _vm._v(" "), _c("label", {
    attrs: {
      "for": "text-password"
    }
  }, [_vm._v("Password")]), _vm._v(" "), _c("b-form-input", {
    attrs: {
      type: "password",
      id: "text-password",
      "aria-describedby": "password-help-block"
    },
    model: {
      value: _vm.password,
      callback: function callback($$v) {
        _vm.password = $$v;
      },
      expression: "password"
    }
  }), _vm._v(" "), _c("b-form-invalid-feedback", {
    attrs: {
      state: _vm.validPassword
    }
  }, [_vm._v("\n            Your user ID must be 5-12 characters long.\n        ")]), _vm._v(" "), _c("b-form-valid-feedback", {
    attrs: {
      state: _vm.validPassword === true
    }
  }, [_vm._v("\n            Looks Good.\n        ")]), _vm._v(" "), _vm.password ? _c("div", [_c("label", {
    attrs: {
      "for": "passwordConfirm"
    }
  }, [_vm._v("Confirm Password")]), _vm._v(" "), _c("b-form-input", {
    attrs: {
      type: "password",
      id: "passwordConfirm",
      "aria-describedby": "password-help-block"
    },
    model: {
      value: _vm.passwordConfirm,
      callback: function callback($$v) {
        _vm.passwordConfirm = $$v;
      },
      expression: "passwordConfirm"
    }
  }), _vm._v(" "), _c("b-form-invalid-feedback", {
    attrs: {
      state: _vm.validPasswordConfirm
    }
  }, [_vm._v("\n                your password confirmation must be same as password\n            ")]), _vm._v(" "), _c("b-form-valid-feedback", {
    attrs: {
      state: _vm.validPasswordConfirm === true
    }
  }, [_vm._v("\n                Looks Good.\n            ")])], 1) : _vm._e(), _vm._v(" "), _c("b-button", {
    staticClass: "mt-2",
    attrs: {
      type: "submit",
      variant: "success"
    }
  }, [_vm._v("Button")])], 1)], 1);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/pages/signUp.vue":
/*!***************************************!*\
  !*** ./resources/js/pages/signUp.vue ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _signUp_vue_vue_type_template_id_5e44f03e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./signUp.vue?vue&type=template&id=5e44f03e&scoped=true& */ "./resources/js/pages/signUp.vue?vue&type=template&id=5e44f03e&scoped=true&");
/* harmony import */ var _signUp_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./signUp.vue?vue&type=script&lang=js& */ "./resources/js/pages/signUp.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _signUp_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _signUp_vue_vue_type_template_id_5e44f03e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _signUp_vue_vue_type_template_id_5e44f03e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "5e44f03e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/signUp.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/pages/signUp.vue?vue&type=script&lang=js&":
/*!****************************************************************!*\
  !*** ./resources/js/pages/signUp.vue?vue&type=script&lang=js& ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_signUp_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./signUp.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/signUp.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_signUp_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/signUp.vue?vue&type=template&id=5e44f03e&scoped=true&":
/*!**********************************************************************************!*\
  !*** ./resources/js/pages/signUp.vue?vue&type=template&id=5e44f03e&scoped=true& ***!
  \**********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_signUp_vue_vue_type_template_id_5e44f03e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_signUp_vue_vue_type_template_id_5e44f03e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_signUp_vue_vue_type_template_id_5e44f03e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./signUp.vue?vue&type=template&id=5e44f03e&scoped=true& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/signUp.vue?vue&type=template&id=5e44f03e&scoped=true&");


/***/ })

}]);