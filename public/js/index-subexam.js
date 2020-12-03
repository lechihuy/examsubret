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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/index-subexam.js":
/*!***************************************!*\
  !*** ./resources/js/index-subexam.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("$(document).on('click', '#btn-switch-status-items', function () {\n  var status = $(this).attr('status');\n  var form = new Form('#modal-confirm');\n  form.hideAlert();\n  $.ajax({\n    url: $('meta[name=switch-status-post-list-route]').attr('content'),\n    method: 'PUT',\n    data: {\n      ids: selectedItems,\n      status: status\n    },\n    success: function success(res, textStatus, xhr) {\n      form.showAlert(res.message, xhr.status);\n      form.redirectToIfAvailable(res);\n    },\n    error: function error(err) {\n      form.showAlert(err.responseJSON.message);\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvaW5kZXgtc3ViZXhhbS5qcz9kOWY2Il0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsIm9uIiwic3RhdHVzIiwiYXR0ciIsImZvcm0iLCJGb3JtIiwiaGlkZUFsZXJ0IiwiYWpheCIsInVybCIsIm1ldGhvZCIsImRhdGEiLCJpZHMiLCJzZWxlY3RlZEl0ZW1zIiwic3VjY2VzcyIsInJlcyIsInRleHRTdGF0dXMiLCJ4aHIiLCJzaG93QWxlcnQiLCJtZXNzYWdlIiwicmVkaXJlY3RUb0lmQXZhaWxhYmxlIiwiZXJyb3IiLCJlcnIiLCJyZXNwb25zZUpTT04iXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUNDLFFBQUQsQ0FBRCxDQUFZQyxFQUFaLENBQWUsT0FBZixFQUF3QiwwQkFBeEIsRUFBb0QsWUFBVztBQUMzRCxNQUFJQyxNQUFNLEdBQUdILENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUksSUFBUixDQUFhLFFBQWIsQ0FBYjtBQUNBLE1BQUlDLElBQUksR0FBRyxJQUFJQyxJQUFKLENBQVMsZ0JBQVQsQ0FBWDtBQUVBRCxNQUFJLENBQUNFLFNBQUw7QUFFQVAsR0FBQyxDQUFDUSxJQUFGLENBQU87QUFDSEMsT0FBRyxFQUFFVCxDQUFDLENBQUMsMENBQUQsQ0FBRCxDQUE4Q0ksSUFBOUMsQ0FBbUQsU0FBbkQsQ0FERjtBQUVITSxVQUFNLEVBQUUsS0FGTDtBQUdIQyxRQUFJLEVBQUU7QUFDRkMsU0FBRyxFQUFFQyxhQURIO0FBRUZWLFlBQU0sRUFBRUE7QUFGTixLQUhIO0FBTUFXLFdBQU8sRUFBRSxpQkFBU0MsR0FBVCxFQUFjQyxVQUFkLEVBQTBCQyxHQUExQixFQUErQjtBQUN2Q1osVUFBSSxDQUFDYSxTQUFMLENBQWVILEdBQUcsQ0FBQ0ksT0FBbkIsRUFBNEJGLEdBQUcsQ0FBQ2QsTUFBaEM7QUFDQUUsVUFBSSxDQUFDZSxxQkFBTCxDQUEyQkwsR0FBM0I7QUFDSCxLQVRFO0FBU0FNLFNBQUssRUFBRSxlQUFTQyxHQUFULEVBQWM7QUFDcEJqQixVQUFJLENBQUNhLFNBQUwsQ0FBZUksR0FBRyxDQUFDQyxZQUFKLENBQWlCSixPQUFoQztBQUNIO0FBWEUsR0FBUDtBQWFILENBbkJEIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2luZGV4LXN1YmV4YW0uanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIkKGRvY3VtZW50KS5vbignY2xpY2snLCAnI2J0bi1zd2l0Y2gtc3RhdHVzLWl0ZW1zJywgZnVuY3Rpb24oKSB7XG4gICAgbGV0IHN0YXR1cyA9ICQodGhpcykuYXR0cignc3RhdHVzJyk7XG4gICAgbGV0IGZvcm0gPSBuZXcgRm9ybSgnI21vZGFsLWNvbmZpcm0nKTtcblxuICAgIGZvcm0uaGlkZUFsZXJ0KCk7XG5cbiAgICAkLmFqYXgoe1xuICAgICAgICB1cmw6ICQoJ21ldGFbbmFtZT1zd2l0Y2gtc3RhdHVzLXBvc3QtbGlzdC1yb3V0ZV0nKS5hdHRyKCdjb250ZW50JyksXG4gICAgICAgIG1ldGhvZDogJ1BVVCcsXG4gICAgICAgIGRhdGE6IHtcbiAgICAgICAgICAgIGlkczogc2VsZWN0ZWRJdGVtcyxcbiAgICAgICAgICAgIHN0YXR1czogc3RhdHVzXG4gICAgICAgIH0sIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlcywgdGV4dFN0YXR1cywgeGhyKSB7XG4gICAgICAgICAgICBmb3JtLnNob3dBbGVydChyZXMubWVzc2FnZSwgeGhyLnN0YXR1cyk7XG4gICAgICAgICAgICBmb3JtLnJlZGlyZWN0VG9JZkF2YWlsYWJsZShyZXMpO1xuICAgICAgICB9LCBlcnJvcjogZnVuY3Rpb24oZXJyKSB7XG4gICAgICAgICAgICBmb3JtLnNob3dBbGVydChlcnIucmVzcG9uc2VKU09OLm1lc3NhZ2UpO1xuICAgICAgICB9XG4gICAgfSk7XG59KTsiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/index-subexam.js\n");

/***/ }),

/***/ 2:
/*!*********************************************!*\
  !*** multi ./resources/js/index-subexam.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Volumes/Data/Dev/examsubret/resources/js/index-subexam.js */"./resources/js/index-subexam.js");


/***/ })

/******/ });