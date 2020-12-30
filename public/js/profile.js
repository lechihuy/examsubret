/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 13);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/_form.js":
/*!******************************************!*\
  !*** ./resources/js/components/_form.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("var _this = this;\n\nwindow.Form = function (_selector) {\n  _this.form = $(_selector);\n  _this.alert = $(document).find(\"*[form=\\\"\".concat(_selector, \"\\\"]\"));\n};\n\nForm.prototype.getAction = function () {\n  return _this.form.attr('action');\n};\n\nForm.prototype.getData = function () {\n  return _this.form.serializeArray();\n};\n\nForm.prototype.showAlert = function (_message, _statusCode) {\n  var _index = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;\n\n  _this.alert.eq(_index).removeClass('d-none').removeClass('alert-danger alert-success').addClass(\"alert-\".concat(_statusCode == 200 ? 'success' : 'danger')).html(_message);\n};\n\nForm.prototype.hideAlert = function () {\n  _this.alert.removeClass('alert-danger alert-success').addClass('d-none').html('');\n};\n\nForm.prototype.redirectToIfAvailable = function (_res) {\n  if (_res.redirect_to == 'RELOAD') {\n    window.location.reload();\n  } else if (_res.redirect_to) {\n    window.location.href = _res.redirect_to;\n  }\n};//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY29tcG9uZW50cy9fZm9ybS5qcz8yM2UyIl0sIm5hbWVzIjpbIndpbmRvdyIsIkZvcm0iLCJfc2VsZWN0b3IiLCJmb3JtIiwiJCIsImFsZXJ0IiwiZG9jdW1lbnQiLCJmaW5kIiwicHJvdG90eXBlIiwiZ2V0QWN0aW9uIiwiYXR0ciIsImdldERhdGEiLCJzZXJpYWxpemVBcnJheSIsInNob3dBbGVydCIsIl9tZXNzYWdlIiwiX3N0YXR1c0NvZGUiLCJfaW5kZXgiLCJlcSIsInJlbW92ZUNsYXNzIiwiYWRkQ2xhc3MiLCJodG1sIiwiaGlkZUFsZXJ0IiwicmVkaXJlY3RUb0lmQXZhaWxhYmxlIiwiX3JlcyIsInJlZGlyZWN0X3RvIiwibG9jYXRpb24iLCJyZWxvYWQiLCJocmVmIl0sIm1hcHBpbmdzIjoiOztBQUFBQSxNQUFNLENBQUNDLElBQVAsR0FBYyxVQUFBQyxTQUFTLEVBQUk7QUFDdkIsT0FBSSxDQUFDQyxJQUFMLEdBQVlDLENBQUMsQ0FBQ0YsU0FBRCxDQUFiO0FBQ0EsT0FBSSxDQUFDRyxLQUFMLEdBQWFELENBQUMsQ0FBQ0UsUUFBRCxDQUFELENBQVlDLElBQVosb0JBQTRCTCxTQUE1QixTQUFiO0FBQ0gsQ0FIRDs7QUFLQUQsSUFBSSxDQUFDTyxTQUFMLENBQWVDLFNBQWYsR0FBMkIsWUFBTTtBQUM3QixTQUFPLEtBQUksQ0FBQ04sSUFBTCxDQUFVTyxJQUFWLENBQWUsUUFBZixDQUFQO0FBQ0gsQ0FGRDs7QUFJQVQsSUFBSSxDQUFDTyxTQUFMLENBQWVHLE9BQWYsR0FBeUIsWUFBTTtBQUMzQixTQUFPLEtBQUksQ0FBQ1IsSUFBTCxDQUFVUyxjQUFWLEVBQVA7QUFDSCxDQUZEOztBQUlBWCxJQUFJLENBQUNPLFNBQUwsQ0FBZUssU0FBZixHQUEyQixVQUFDQyxRQUFELEVBQVdDLFdBQVgsRUFBdUM7QUFBQSxNQUFmQyxNQUFlLHVFQUFOLENBQU07O0FBQzlELE9BQUksQ0FBQ1gsS0FBTCxDQUFXWSxFQUFYLENBQWNELE1BQWQsRUFDS0UsV0FETCxDQUNpQixRQURqQixFQUVLQSxXQUZMLENBRWlCLDRCQUZqQixFQUdLQyxRQUhMLGlCQUd1QkosV0FBVyxJQUFJLEdBQWYsR0FBcUIsU0FBckIsR0FBaUMsUUFIeEQsR0FJS0ssSUFKTCxDQUlVTixRQUpWO0FBS0gsQ0FORDs7QUFRQWIsSUFBSSxDQUFDTyxTQUFMLENBQWVhLFNBQWYsR0FBMkIsWUFBTTtBQUM3QixPQUFJLENBQUNoQixLQUFMLENBQ0thLFdBREwsQ0FDaUIsNEJBRGpCLEVBRUtDLFFBRkwsQ0FFYyxRQUZkLEVBRXdCQyxJQUZ4QixDQUU2QixFQUY3QjtBQUdILENBSkQ7O0FBTUFuQixJQUFJLENBQUNPLFNBQUwsQ0FBZWMscUJBQWYsR0FBdUMsVUFBQ0MsSUFBRCxFQUFVO0FBQzdDLE1BQUlBLElBQUksQ0FBQ0MsV0FBTCxJQUFvQixRQUF4QixFQUFrQztBQUM5QnhCLFVBQU0sQ0FBQ3lCLFFBQVAsQ0FBZ0JDLE1BQWhCO0FBQ0gsR0FGRCxNQUVPLElBQUlILElBQUksQ0FBQ0MsV0FBVCxFQUFzQjtBQUN6QnhCLFVBQU0sQ0FBQ3lCLFFBQVAsQ0FBZ0JFLElBQWhCLEdBQXVCSixJQUFJLENBQUNDLFdBQTVCO0FBQ0g7QUFDSixDQU5EIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2NvbXBvbmVudHMvX2Zvcm0uanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJ3aW5kb3cuRm9ybSA9IF9zZWxlY3RvciA9PiB7XG4gICAgdGhpcy5mb3JtID0gJChfc2VsZWN0b3IpO1xuICAgIHRoaXMuYWxlcnQgPSAkKGRvY3VtZW50KS5maW5kKGAqW2Zvcm09XCIke19zZWxlY3Rvcn1cIl1gKTtcbn1cblxuRm9ybS5wcm90b3R5cGUuZ2V0QWN0aW9uID0gKCkgPT4ge1xuICAgIHJldHVybiB0aGlzLmZvcm0uYXR0cignYWN0aW9uJyk7XG59XG5cbkZvcm0ucHJvdG90eXBlLmdldERhdGEgPSAoKSA9PiB7XG4gICAgcmV0dXJuIHRoaXMuZm9ybS5zZXJpYWxpemVBcnJheSgpO1xufVxuXG5Gb3JtLnByb3RvdHlwZS5zaG93QWxlcnQgPSAoX21lc3NhZ2UsIF9zdGF0dXNDb2RlLCBfaW5kZXggPSAwKSA9PiB7XG4gICAgdGhpcy5hbGVydC5lcShfaW5kZXgpXG4gICAgICAgIC5yZW1vdmVDbGFzcygnZC1ub25lJylcbiAgICAgICAgLnJlbW92ZUNsYXNzKCdhbGVydC1kYW5nZXIgYWxlcnQtc3VjY2VzcycpXG4gICAgICAgIC5hZGRDbGFzcyhgYWxlcnQtJHtfc3RhdHVzQ29kZSA9PSAyMDAgPyAnc3VjY2VzcycgOiAnZGFuZ2VyJ31gKVxuICAgICAgICAuaHRtbChfbWVzc2FnZSk7XG59XG5cbkZvcm0ucHJvdG90eXBlLmhpZGVBbGVydCA9ICgpID0+IHtcbiAgICB0aGlzLmFsZXJ0XG4gICAgICAgIC5yZW1vdmVDbGFzcygnYWxlcnQtZGFuZ2VyIGFsZXJ0LXN1Y2Nlc3MnKVxuICAgICAgICAuYWRkQ2xhc3MoJ2Qtbm9uZScpLmh0bWwoJycpO1xufVxuXG5Gb3JtLnByb3RvdHlwZS5yZWRpcmVjdFRvSWZBdmFpbGFibGUgPSAoX3JlcykgPT4ge1xuICAgIGlmIChfcmVzLnJlZGlyZWN0X3RvID09ICdSRUxPQUQnKSB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbi5yZWxvYWQoKTtcbiAgICB9IGVsc2UgaWYgKF9yZXMucmVkaXJlY3RfdG8pIHtcbiAgICAgICAgd2luZG93LmxvY2F0aW9uLmhyZWYgPSBfcmVzLnJlZGlyZWN0X3RvO1xuICAgIH1cbn0iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/components/_form.js\n");

/***/ }),

/***/ "./resources/js/profile.js":
/*!*********************************!*\
  !*** ./resources/js/profile.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("__webpack_require__(/*! ./components/_form */ \"./resources/js/components/_form.js\"); // Update profile\n\n\n$('.btn-update-profile').on('click', function () {\n  var indexBtn = $('.btn-update-profile').index($(this));\n  var form = new Form('#form-update-profile');\n  var avatar = $('input[name=avatar]')[0].files[0];\n  form.hideAlert();\n  $('#form-update-profile').ajaxSubmit({\n    url: form.getAction(),\n    method: 'POST',\n    contentType: false,\n    processData: false,\n    data: {\n      _method: 'PUT'\n    },\n    success: function success(res, textStatus, xhr) {\n      form.showAlert(res.message, xhr.status, indexBtn);\n      form.redirectToIfAvailable(res);\n    },\n    error: function error(err) {\n      form.showAlert(err.responseJSON.message, err.status, indexBtn);\n    }\n  }); // $.ajax({\n  //     url: form.getAction(),\n  //     method: 'PUT',\n  //     data: {\n  //         fullname: 1,\n  //         'avatar': avatar\n  //     },\n  //     processData: false,\n  //     success: function(res, textStatus, xhr) {\n  //         form.showAlert(res.message, xhr.status, indexBtn);\n  //         form.redirectToIfAvailable(res);\n  //     }, error: function(err) {\n  //         form.showAlert(err.responseJSON.message, err.status, indexBtn);\n  //     }\n  // });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcHJvZmlsZS5qcz8wZDI0Il0sIm5hbWVzIjpbInJlcXVpcmUiLCIkIiwib24iLCJpbmRleEJ0biIsImluZGV4IiwiZm9ybSIsIkZvcm0iLCJhdmF0YXIiLCJmaWxlcyIsImhpZGVBbGVydCIsImFqYXhTdWJtaXQiLCJ1cmwiLCJnZXRBY3Rpb24iLCJtZXRob2QiLCJjb250ZW50VHlwZSIsInByb2Nlc3NEYXRhIiwiZGF0YSIsIl9tZXRob2QiLCJzdWNjZXNzIiwicmVzIiwidGV4dFN0YXR1cyIsInhociIsInNob3dBbGVydCIsIm1lc3NhZ2UiLCJzdGF0dXMiLCJyZWRpcmVjdFRvSWZBdmFpbGFibGUiLCJlcnJvciIsImVyciIsInJlc3BvbnNlSlNPTiJdLCJtYXBwaW5ncyI6IkFBQUFBLG1CQUFPLENBQUMsOERBQUQsQ0FBUCxDLENBRUE7OztBQUNBQyxDQUFDLENBQUMscUJBQUQsQ0FBRCxDQUF5QkMsRUFBekIsQ0FBNEIsT0FBNUIsRUFBcUMsWUFBVztBQUM1QyxNQUFNQyxRQUFRLEdBQUdGLENBQUMsQ0FBQyxxQkFBRCxDQUFELENBQXlCRyxLQUF6QixDQUErQkgsQ0FBQyxDQUFDLElBQUQsQ0FBaEMsQ0FBakI7QUFDQSxNQUFJSSxJQUFJLEdBQUcsSUFBSUMsSUFBSixDQUFTLHNCQUFULENBQVg7QUFFQSxNQUFJQyxNQUFNLEdBQUdOLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCLENBQXhCLEVBQTJCTyxLQUEzQixDQUFpQyxDQUFqQyxDQUFiO0FBR0FILE1BQUksQ0FBQ0ksU0FBTDtBQUNBUixHQUFDLENBQUMsc0JBQUQsQ0FBRCxDQUEwQlMsVUFBMUIsQ0FBcUM7QUFDakNDLE9BQUcsRUFBRU4sSUFBSSxDQUFDTyxTQUFMLEVBRDRCO0FBRWpDQyxVQUFNLEVBQUUsTUFGeUI7QUFHakNDLGVBQVcsRUFBRSxLQUhvQjtBQUlqQ0MsZUFBVyxFQUFFLEtBSm9CO0FBS2pDQyxRQUFJLEVBQUU7QUFDRkMsYUFBTyxFQUFFO0FBRFAsS0FMMkI7QUFRakNDLFdBQU8sRUFBRSxpQkFBU0MsR0FBVCxFQUFjQyxVQUFkLEVBQTBCQyxHQUExQixFQUErQjtBQUNwQ2hCLFVBQUksQ0FBQ2lCLFNBQUwsQ0FBZUgsR0FBRyxDQUFDSSxPQUFuQixFQUE0QkYsR0FBRyxDQUFDRyxNQUFoQyxFQUF3Q3JCLFFBQXhDO0FBQ0FFLFVBQUksQ0FBQ29CLHFCQUFMLENBQTJCTixHQUEzQjtBQUNILEtBWGdDO0FBVzlCTyxTQUFLLEVBQUUsZUFBU0MsR0FBVCxFQUFjO0FBQ3BCdEIsVUFBSSxDQUFDaUIsU0FBTCxDQUFlSyxHQUFHLENBQUNDLFlBQUosQ0FBaUJMLE9BQWhDLEVBQXlDSSxHQUFHLENBQUNILE1BQTdDLEVBQXFEckIsUUFBckQ7QUFDSDtBQWJnQyxHQUFyQyxFQVI0QyxDQXdCNUM7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0gsQ0F2Q0QiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcHJvZmlsZS5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbInJlcXVpcmUoJy4vY29tcG9uZW50cy9fZm9ybScpXG5cbi8vIFVwZGF0ZSBwcm9maWxlXG4kKCcuYnRuLXVwZGF0ZS1wcm9maWxlJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgY29uc3QgaW5kZXhCdG4gPSAkKCcuYnRuLXVwZGF0ZS1wcm9maWxlJykuaW5kZXgoJCh0aGlzKSk7XG4gICAgbGV0IGZvcm0gPSBuZXcgRm9ybSgnI2Zvcm0tdXBkYXRlLXByb2ZpbGUnKTtcblxuICAgIGxldCBhdmF0YXIgPSAkKCdpbnB1dFtuYW1lPWF2YXRhcl0nKVswXS5maWxlc1swXTtcblxuXG4gICAgZm9ybS5oaWRlQWxlcnQoKTtcbiAgICAkKCcjZm9ybS11cGRhdGUtcHJvZmlsZScpLmFqYXhTdWJtaXQoe1xuICAgICAgICB1cmw6IGZvcm0uZ2V0QWN0aW9uKCksXG4gICAgICAgIG1ldGhvZDogJ1BPU1QnLFxuICAgICAgICBjb250ZW50VHlwZTogZmFsc2UsXG4gICAgICAgIHByb2Nlc3NEYXRhOiBmYWxzZSxcbiAgICAgICAgZGF0YToge1xuICAgICAgICAgICAgX21ldGhvZDogJ1BVVCcsXG4gICAgICAgIH0sXG4gICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlcywgdGV4dFN0YXR1cywgeGhyKSB7XG4gICAgICAgICAgICBmb3JtLnNob3dBbGVydChyZXMubWVzc2FnZSwgeGhyLnN0YXR1cywgaW5kZXhCdG4pO1xuICAgICAgICAgICAgZm9ybS5yZWRpcmVjdFRvSWZBdmFpbGFibGUocmVzKTtcbiAgICAgICAgfSwgZXJyb3I6IGZ1bmN0aW9uKGVycikge1xuICAgICAgICAgICAgZm9ybS5zaG93QWxlcnQoZXJyLnJlc3BvbnNlSlNPTi5tZXNzYWdlLCBlcnIuc3RhdHVzLCBpbmRleEJ0bik7XG4gICAgICAgIH1cbiAgICB9KTtcblxuICAgIC8vICQuYWpheCh7XG4gICAgLy8gICAgIHVybDogZm9ybS5nZXRBY3Rpb24oKSxcbiAgICAvLyAgICAgbWV0aG9kOiAnUFVUJyxcbiAgICAvLyAgICAgZGF0YToge1xuICAgIC8vICAgICAgICAgZnVsbG5hbWU6IDEsXG4gICAgLy8gICAgICAgICAnYXZhdGFyJzogYXZhdGFyXG4gICAgLy8gICAgIH0sXG4gICAgLy8gICAgIHByb2Nlc3NEYXRhOiBmYWxzZSxcbiAgICAvLyAgICAgc3VjY2VzczogZnVuY3Rpb24ocmVzLCB0ZXh0U3RhdHVzLCB4aHIpIHtcbiAgICAvLyAgICAgICAgIGZvcm0uc2hvd0FsZXJ0KHJlcy5tZXNzYWdlLCB4aHIuc3RhdHVzLCBpbmRleEJ0bik7XG4gICAgLy8gICAgICAgICBmb3JtLnJlZGlyZWN0VG9JZkF2YWlsYWJsZShyZXMpO1xuICAgIC8vICAgICB9LCBlcnJvcjogZnVuY3Rpb24oZXJyKSB7XG4gICAgLy8gICAgICAgICBmb3JtLnNob3dBbGVydChlcnIucmVzcG9uc2VKU09OLm1lc3NhZ2UsIGVyci5zdGF0dXMsIGluZGV4QnRuKTtcbiAgICAvLyAgICAgfVxuICAgIC8vIH0pO1xufSkiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/profile.js\n");

/***/ }),

/***/ 13:
/*!***************************************!*\
  !*** multi ./resources/js/profile.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Volumes/Data/Dev/examsubret/resources/js/profile.js */"./resources/js/profile.js");


/***/ })

/******/ });