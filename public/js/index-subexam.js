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
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/index-subexam.js":
/*!***************************************!*\
  !*** ./resources/js/index-subexam.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === \"undefined\" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === \"number\") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError(\"Invalid attempt to iterate non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it[\"return\"] != null) it[\"return\"](); } finally { if (didErr) throw err; } } }; }\n\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\n\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\n\nfunction setupDepartmentSelectors() {\n  $('select[name=department_id]').select2();\n}\n\nfunction setupMajorSelectors() {\n  var department = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;\n  $('select[name=major_id]').select2({\n    \"language\": {\n      \"noResults\": function noResults() {\n        return 'Không tìm thấy kết quả.';\n      }\n    }\n  });\n\n  if (department) {\n    var departmentId = department.val();\n    var major = department.parents('form').find('select[name=major_id]');\n    major.find('option').remove();\n    major.val('');\n    major.trigger('change');\n    $.ajax({\n      type: 'GET',\n      url: route('data.majors') + '?department_id=' + departmentId\n    }).then(function (data) {\n      major.append(new Option('Tất cả', 'all', true, true));\n      data.forEach(function (item, index) {\n        major.append(new Option(\"[\".concat(item.code, \"] \").concat(item.name), item.id, true, true));\n      });\n      major.trigger('change');\n    });\n  }\n}\n\nfunction setupSubjectSelectors() {\n  var department = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;\n  $('select[name=subject_id]').select2({\n    \"language\": {\n      \"noResults\": function noResults() {\n        return 'Không tìm thấy kết quả.';\n      }\n    }\n  });\n\n  if (department) {\n    var departmentId = department.val();\n    var subject = department.parents('form').find('select[name=subject_id]');\n    subject.find('option').remove();\n    subject.val('');\n    subject.trigger('change');\n    $.ajax({\n      type: 'GET',\n      url: route('data.subjects') + '?department_id=' + departmentId\n    }).then(function (data) {\n      subject.append(new Option('Tất cả', 'all', true, true));\n      data.forEach(function (item, index) {\n        subject.append(new Option(\"[\".concat(item.code, \"] \").concat(item.name), item.id, true, true));\n      });\n      subject.trigger('change');\n    });\n  }\n}\n\n$(document).on('select2:select', 'select[name=department_id]', function () {\n  setupMajorSelectors($(this));\n  setupSubjectSelectors($(this));\n});\n$('#form-filter .btn-search').on('click', function () {\n  var form = new Form('#form-filter');\n  var formData = form.getData();\n  formData.forEach(function (item, key) {\n    if (item.name == 'exam_forms') {\n      delete formData[key];\n    }\n  });\n  var exam_forms = $('#form-filter input[for=exam_forms]:checked').map(function (key, item) {\n    return $(item).val();\n  }).get();\n\n  if (exam_forms.indexOf('all') > -1) {\n    exam_forms = 'all';\n  } else {\n    exam_forms = exam_forms.join();\n  }\n\n  formData.push({\n    name: 'exam_forms',\n    value: exam_forms\n  });\n  formData.push({\n    name: 'k',\n    value: $('input[name=k]').val()\n  });\n  var queries = {};\n  formData.forEach(function (item) {\n    if (Array.isArray(item.value)) {\n      queries[item.name] = item.value.join(',');\n    } else {\n      queries[item.name] = item.value;\n    }\n  });\n  window.location.href = '?' + $.param(queries);\n});\nsetupDepartmentSelectors();\nsetupMajorSelectors();\nsetupSubjectSelectors();\n$('select[name=teacher_id]').select2();\n$('select[name=class]').select2();\n$('.btn-search').on('click', function () {\n  var k = $('input[name=k]').val();\n  var url = $(this).attr('action');\n  location.href = query_url(url, 'k', k);\n});\n$('input[name=k]').on('keyup', function (e) {\n  if (e.key == 'Enter') {\n    var k = $('input[name=k]').val();\n    var url = $(this).attr('action');\n    location.href = query_url(url, 'k', k);\n  }\n}); // Save selected items\n\nif (Cookies.get('subexam_selected_items') != '' && Cookies.get('subexam_selected_items') !== undefined) {\n  var subexamSelectedItems = Cookies.get('subexam_selected_items').split(',');\n  var checked = 0;\n\n  var _iterator = _createForOfIteratorHelper(subexamSelectedItems),\n      _step;\n\n  try {\n    for (_iterator.s(); !(_step = _iterator.n()).done;) {\n      item = _step.value;\n      $(\".check-row[data-id=\".concat(item, \"]\")).prop('checked', true);\n    }\n  } catch (err) {\n    _iterator.e(err);\n  } finally {\n    _iterator.f();\n  }\n\n  $('.check-row').each(function (key, item) {\n    if (subexamSelectedItems.includes($(item).data('id').toString())) {\n      $(item).prop('checked', true);\n      checked++;\n    }\n  });\n\n  if (checked == $('.check-row').length) {\n    $('.check-all').prop('checked', true);\n  }\n\n  $('#save-selected-item-switcher .counter').html(subexamSelectedItems.length);\n}\n\nif (Cookies.get('subexam_save_selected_items_mode') !== undefined) {\n  $('#save-selected-item-mode').prop('checked', Cookies.get('subexam_save_selected_items_mode') === 'true');\n}\n\nif (Cookies.get('subexam_save_selected_items_mode') === 'true') {\n  $('#save-selected-item-switcher .label-counter').removeClass('d-none');\n} else {\n  $('#save-selected-item-switcher .label-counter').addClass('d-none');\n}\n\n$('#save-selected-item-mode').on('change', function () {\n  var mode = $(this).prop('checked');\n  Cookies.set(\"subexam_save_selected_items_mode\", mode);\n\n  if (Cookies.get('subexam_save_selected_items_mode') === 'true') {\n    $('#save-selected-item-switcher .label-counter').removeClass('d-none');\n    Cookies.set('subexam_selected_items', '');\n  } else {\n    $('#save-selected-item-switcher .label-counter').addClass('d-none');\n    Cookies.remove('subexam_selected_items');\n  }\n\n  $('#save-selected-item-switcher .counter').html('0');\n});\n$('.check-row').on('change', function () {\n  if (Cookies.get('subexam_save_selected_items_mode') === 'true') {\n    var _checked = $(this).prop('checked');\n\n    var _subexamSelectedItems = Cookies.get('subexam_selected_items') != '' ? Cookies.get('subexam_selected_items').split(',') : [];\n\n    var id = $(this).data('id').toString();\n\n    if (_checked && !_subexamSelectedItems.includes(id)) {\n      _subexamSelectedItems.push(id);\n    } else if (!_checked && _subexamSelectedItems.includes(id)) {\n      _subexamSelectedItems.splice(_subexamSelectedItems.indexOf(id), 1);\n    }\n\n    Cookies.set('subexam_selected_items', _subexamSelectedItems.join(','));\n    $('#save-selected-item-switcher .counter').html(_subexamSelectedItems.length);\n  }\n}); // Export table\n\n$(document).on('click', '.btn-print', function () {\n  $('#printer').remove();\n  var url = $(this).attr('action');\n  var selected = null;\n\n  if (Cookies.get('subexam_save_selected_items_mode') === 'true') {\n    selected = Cookies.get('subexam_selected_items');\n  } else {\n    var _$$map$get$join;\n\n    selected = (_$$map$get$join = $('.check-row:checked').map(function (key, item) {\n      return $(item).data('id');\n    }).get().join(',')) !== null && _$$map$get$join !== void 0 ? _$$map$get$join : '';\n  }\n\n  $('body').append(\"\\n        <iframe id=\\\"printer\\\" class=\\\"d-none\\\" src=\\\"\".concat(query_url(url, 'selected', selected), \"\\\"></iframe>\\n    \"));\n  $('#printer').get(0).contentWindow.print();\n});\n$(document).on('click', '.btn-excel', function () {\n  var url = $(this).attr('action');\n  var selected = null;\n\n  if (Cookies.get('subexam_save_selected_items_mode') === 'true') {\n    selected = Cookies.get('subexam_selected_items');\n  } else {\n    var _$$map$get$join2;\n\n    selected = (_$$map$get$join2 = $('.check-row:checked').map(function (key, item) {\n      return $(item).data('id');\n    }).get().join(',')) !== null && _$$map$get$join2 !== void 0 ? _$$map$get$join2 : '';\n  }\n\n  window.location = query_url(url, 'selected', selected);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvaW5kZXgtc3ViZXhhbS5qcz9kOWY2Il0sIm5hbWVzIjpbInNldHVwRGVwYXJ0bWVudFNlbGVjdG9ycyIsIiQiLCJzZWxlY3QyIiwic2V0dXBNYWpvclNlbGVjdG9ycyIsImRlcGFydG1lbnQiLCJkZXBhcnRtZW50SWQiLCJ2YWwiLCJtYWpvciIsInBhcmVudHMiLCJmaW5kIiwicmVtb3ZlIiwidHJpZ2dlciIsImFqYXgiLCJ0eXBlIiwidXJsIiwicm91dGUiLCJ0aGVuIiwiZGF0YSIsImFwcGVuZCIsIk9wdGlvbiIsImZvckVhY2giLCJpdGVtIiwiaW5kZXgiLCJjb2RlIiwibmFtZSIsImlkIiwic2V0dXBTdWJqZWN0U2VsZWN0b3JzIiwic3ViamVjdCIsImRvY3VtZW50Iiwib24iLCJmb3JtIiwiRm9ybSIsImZvcm1EYXRhIiwiZ2V0RGF0YSIsImtleSIsImV4YW1fZm9ybXMiLCJtYXAiLCJnZXQiLCJpbmRleE9mIiwiam9pbiIsInB1c2giLCJ2YWx1ZSIsInF1ZXJpZXMiLCJBcnJheSIsImlzQXJyYXkiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsImhyZWYiLCJwYXJhbSIsImsiLCJhdHRyIiwicXVlcnlfdXJsIiwiZSIsIkNvb2tpZXMiLCJ1bmRlZmluZWQiLCJzdWJleGFtU2VsZWN0ZWRJdGVtcyIsInNwbGl0IiwiY2hlY2tlZCIsInByb3AiLCJlYWNoIiwiaW5jbHVkZXMiLCJ0b1N0cmluZyIsImxlbmd0aCIsImh0bWwiLCJyZW1vdmVDbGFzcyIsImFkZENsYXNzIiwibW9kZSIsInNldCIsInNwbGljZSIsInNlbGVjdGVkIiwiY29udGVudFdpbmRvdyIsInByaW50Il0sIm1hcHBpbmdzIjoiOzs7Ozs7QUFDQSxTQUFTQSx3QkFBVCxHQUFvQztBQUNoQ0MsR0FBQyxDQUFDLDRCQUFELENBQUQsQ0FBZ0NDLE9BQWhDO0FBQ0g7O0FBRUQsU0FBU0MsbUJBQVQsR0FBZ0Q7QUFBQSxNQUFuQkMsVUFBbUIsdUVBQU4s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RUFBTSxVQUFOLEVBQWtCdUQsUUFBbEIsQ0FEeEQ7QUFJQXBFLEdBQUMsQ0FBQyxVQUFELENBQUQsQ0FBY29DLEdBQWQsQ0FBa0IsQ0FBbEIsRUFBcUJpQyxhQUFyQixDQUFtQ0MsS0FBbkM7QUFDSCxDQW5CRDtBQXFCQXRFLENBQUMsQ0FBQzJCLFFBQUQsQ0FBRCxDQUFZQyxFQUFaLENBQWUsT0FBZixFQUF3QixZQUF4QixFQUFzQyxZQUFXO0FBQzdDLE1BQUlmLEdBQUcsR0FBR2IsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRaUQsSUFBUixDQUFhLFFBQWIsQ0FBVjtBQUNBLE1BQUltQixRQUFRLEdBQUcsSUFBZjs7QUFFQSxNQUFJaEIsT0FBTyxDQUFDaEIsR0FBUixDQUFZLGtDQUFaLE1BQW9ELE1BQXhELEVBQWdFO0FBQzVEZ0MsWUFBUSxHQUFHaEIsT0FBTyxDQUFDaEIsR0FBUixDQUFZLHdCQUFaLENBQVg7QUFDSCxHQUZELE1BRU87QUFBQTs7QUFDSGdDLFlBQVEsdUJBQUdwRSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3Qm1DLEdBQXhCLENBQTRCLFVBQVNGLEdBQVQsRUFBY2IsSUFBZCxFQUFvQjtBQUN2RCxhQUFPcEIsQ0FBQyxDQUFDb0IsSUFBRCxDQUFELENBQVFKLElBQVIsQ0FBYSxJQUFiLENBQVA7QUFDSCxLQUZVLEVBRVJvQixHQUZRLEdBRUZFLElBRkUsQ0FFRyxHQUZILENBQUgsK0RBRWMsRUFGdEI7QUFHSDs7QUFFRE0sUUFBTSxDQUFDQyxRQUFQLEdBQWtCSyxTQUFTLENBQUNyQyxHQUFELEVBQU0sVUFBTixFQUFrQnVELFFBQWxCLENBQTNCO0FBQ0gsQ0FiRCIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy9pbmRleC1zdWJleGFtLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiXG5mdW5jdGlvbiBzZXR1cERlcGFydG1lbnRTZWxlY3RvcnMoKSB7XG4gICAgJCgnc2VsZWN0W25hbWU9ZGVwYXJ0bWVudF9pZF0nKS5zZWxlY3QyKCk7XG59XG5cbmZ1bmN0aW9uIHNldHVwTWFqb3JTZWxlY3RvcnMoZGVwYXJ0bWVudCA9IG51bGwpIHtcblxuICAgICQoJ3NlbGVjdFtuYW1lPW1ham9yX2lkXScpLnNlbGVjdDIoe1xuICAgICAgICBcImxhbmd1YWdlXCI6IHtcbiAgICAgICAgICAgIFwibm9SZXN1bHRzXCI6IGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgcmV0dXJuICdLaMO0bmcgdMOsbSB0aOG6pXkga+G6v3QgcXXhuqMuJztcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSxcbiAgICB9KVxuXG4gICAgaWYgKGRlcGFydG1lbnQpIHtcbiAgICAgICAgbGV0IGRlcGFydG1lbnRJZCA9IGRlcGFydG1lbnQudmFsKClcblxuICAgICAgICBsZXQgbWFqb3IgPSBkZXBhcnRtZW50LnBhcmVudHMoJ2Zvcm0nKS5maW5kKCdzZWxlY3RbbmFtZT1tYWpvcl9pZF0nKVxuICAgICAgICBtYWpvci5maW5kKCdvcHRpb24nKS5yZW1vdmUoKVxuICAgICAgICBtYWpvci52YWwoJycpXG4gICAgICAgIG1ham9yLnRyaWdnZXIoJ2NoYW5nZScpO1xuXG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB0eXBlOiAnR0VUJyxcbiAgICAgICAgICAgIHVybDogcm91dGUoJ2RhdGEubWFqb3JzJykgKyAnP2RlcGFydG1lbnRfaWQ9JyArIGRlcGFydG1lbnRJZFxuICAgICAgICB9KS50aGVuKGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICBtYWpvci5hcHBlbmQobmV3IE9wdGlvbignVOG6pXQgY+G6oycsICdhbGwnLCB0cnVlLCB0cnVlKSlcblxuICAgICAgICAgICAgZGF0YS5mb3JFYWNoKGZ1bmN0aW9uKGl0ZW0sIGluZGV4KSB7ICAgICAgICAgICAgICAgIFxuICAgICAgICAgICAgICAgIG1ham9yLmFwcGVuZChuZXcgT3B0aW9uKGBbJHtpdGVtLmNvZGV9XSAke2l0ZW0ubmFtZX1gLCBpdGVtLmlkLCB0cnVlLCB0cnVlKSlcbiAgICAgICAgICAgIH0pXG5cbiAgICAgICAgICAgIG1ham9yLnRyaWdnZXIoJ2NoYW5nZScpXG4gICAgICAgIH0pO1xuICAgIH1cbn1cblxuZnVuY3Rpb24gc2V0dXBTdWJqZWN0U2VsZWN0b3JzKGRlcGFydG1lbnQgPSBudWxsKSB7XG4gICAgJCgnc2VsZWN0W25hbWU9c3ViamVjdF9pZF0nKS5zZWxlY3QyKHtcbiAgICAgICAgXCJsYW5ndWFnZVwiOiB7XG4gICAgICAgICAgICBcIm5vUmVzdWx0c1wiOiBmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgIHJldHVybiAnS2jDtG5nIHTDrG0gdGjhuqV5IGvhur90IHF14bqjLic7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0sXG4gICAgfSlcblxuICAgIGlmIChkZXBhcnRtZW50KSB7XG4gICAgICAgIGxldCBkZXBhcnRtZW50SWQgPSBkZXBhcnRtZW50LnZhbCgpXG5cbiAgICAgICAgbGV0IHN1YmplY3QgPSBkZXBhcnRtZW50LnBhcmVudHMoJ2Zvcm0nKS5maW5kKCdzZWxlY3RbbmFtZT1zdWJqZWN0X2lkXScpXG4gICAgICAgIHN1YmplY3QuZmluZCgnb3B0aW9uJykucmVtb3ZlKClcbiAgICAgICAgc3ViamVjdC52YWwoJycpXG4gICAgICAgIHN1YmplY3QudHJpZ2dlcignY2hhbmdlJyk7XG5cbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHR5cGU6ICdHRVQnLFxuICAgICAgICAgICAgdXJsOiByb3V0ZSgnZGF0YS5zdWJqZWN0cycpICsgJz9kZXBhcnRtZW50X2lkPScgKyBkZXBhcnRtZW50SWRcbiAgICAgICAgfSkudGhlbihmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgICAgc3ViamVjdC5hcHBlbmQobmV3IE9wdGlvbignVOG6pXQgY+G6oycsICdhbGwnLCB0cnVlLCB0cnVlKSlcblxuICAgICAgICAgICAgZGF0YS5mb3JFYWNoKGZ1bmN0aW9uKGl0ZW0sIGluZGV4KSB7XG4gICAgICAgICAgICAgICAgc3ViamVjdC5hcHBlbmQobmV3IE9wdGlvbihgWyR7aXRlbS5jb2RlfV0gJHtpdGVtLm5hbWV9YCwgaXRlbS5pZCwgdHJ1ZSwgdHJ1ZSkpXG4gICAgICAgICAgICB9KVxuXG4gICAgICAgICAgICBzdWJqZWN0LnRyaWdnZXIoJ2NoYW5nZScpXG4gICAgICAgIH0pO1xuICAgIH1cbn1cblxuJChkb2N1bWVudCkub24oJ3NlbGVjdDI6c2VsZWN0JywgJ3NlbGVjdFtuYW1lPWRlcGFydG1lbnRfaWRdJywgZnVuY3Rpb24oKSB7XG4gICAgc2V0dXBNYWpvclNlbGVjdG9ycygkKHRoaXMpKVxuICAgIHNldHVwU3ViamVjdFNlbGVjdG9ycygkKHRoaXMpKVxufSlcblxuJCgnI2Zvcm0tZmlsdGVyIC5idG4tc2VhcmNoJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgbGV0IGZvcm0gPSBuZXcgRm9ybSgnI2Zvcm0tZmlsdGVyJylcbiAgICBsZXQgZm9ybURhdGEgPSBmb3JtLmdldERhdGEoKVxuXG4gICAgZm9ybURhdGEuZm9yRWFjaChmdW5jdGlvbihpdGVtLCBrZXkpIHtcbiAgICAgICAgaWYgKGl0ZW0ubmFtZSA9PSAnZXhhbV9mb3JtcycpIHtcbiAgICAgICAgICAgIGRlbGV0ZSBmb3JtRGF0YVtrZXldXG4gICAgICAgIH1cbiAgICB9KVxuXG4gICAgbGV0IGV4YW1fZm9ybXMgPSAkKCcjZm9ybS1maWx0ZXIgaW5wdXRbZm9yPWV4YW1fZm9ybXNdOmNoZWNrZWQnKS5tYXAoZnVuY3Rpb24oa2V5LCBpdGVtKSB7XG4gICAgICAgIHJldHVybiAkKGl0ZW0pLnZhbCgpXG4gICAgfSkuZ2V0KClcblxuICAgIGlmIChleGFtX2Zvcm1zLmluZGV4T2YoJ2FsbCcpID4gLTEpIHtcbiAgICAgICAgZXhhbV9mb3JtcyA9ICdhbGwnXG4gICAgfSBlbHNlIHtcbiAgICAgICAgZXhhbV9mb3JtcyA9IGV4YW1fZm9ybXMuam9pbigpXG4gICAgfVxuXG4gICAgZm9ybURhdGEucHVzaCh7XG4gICAgICAgIG5hbWU6ICdleGFtX2Zvcm1zJyxcbiAgICAgICAgdmFsdWU6IGV4YW1fZm9ybXNcbiAgICB9KVxuXG4gICAgZm9ybURhdGEucHVzaCh7XG4gICAgICAgIG5hbWU6ICdrJyxcbiAgICAgICAgdmFsdWU6ICQoJ2lucHV0W25hbWU9a10nKS52YWwoKVxuICAgIH0pXG5cbiAgICBsZXQgcXVlcmllcyA9IHt9O1xuICAgIFxuICAgIGZvcm1EYXRhLmZvckVhY2goZnVuY3Rpb24oaXRlbSkge1xuICAgICAgICBpZiAoQXJyYXkuaXNBcnJheShpdGVtLnZhbHVlKSkge1xuICAgICAgICAgICAgcXVlcmllc1tpdGVtLm5hbWVdID0gaXRlbS52YWx1ZS5qb2luKCcsJylcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHF1ZXJpZXNbaXRlbS5uYW1lXSA9IGl0ZW0udmFsdWVcbiAgICAgICAgfVxuICAgIH0pXG5cbiAgICB3aW5kb3cubG9jYXRpb24uaHJlZiA9ICc/JyArICQucGFyYW0ocXVlcmllcylcbn0pXG5cbnNldHVwRGVwYXJ0bWVudFNlbGVjdG9ycygpXG5zZXR1cE1ham9yU2VsZWN0b3JzKClcbnNldHVwU3ViamVjdFNlbGVjdG9ycygpXG4kKCdzZWxlY3RbbmFtZT10ZWFjaGVyX2lkXScpLnNlbGVjdDIoKVxuJCgnc2VsZWN0W25hbWU9Y2xhc3NdJykuc2VsZWN0MigpXG5cbiQoJy5idG4tc2VhcmNoJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgbGV0IGsgPSAkKCdpbnB1dFtuYW1lPWtdJykudmFsKCk7XG4gICAgbGV0IHVybCA9ICQodGhpcykuYXR0cignYWN0aW9uJyk7XG5cbiAgICBsb2NhdGlvbi5ocmVmID0gcXVlcnlfdXJsKHVybCwgJ2snLCBrKTtcbn0pXG5cbiQoJ2lucHV0W25hbWU9a10nKS5vbigna2V5dXAnLCBmdW5jdGlvbihlKSB7XG4gICAgaWYgKGUua2V5ID09ICdFbnRlcicpIHtcbiAgICAgICAgbGV0IGsgPSAkKCdpbnB1dFtuYW1lPWtdJykudmFsKCk7XG4gICAgICAgIGxldCB1cmwgPSAkKHRoaXMpLmF0dHIoJ2FjdGlvbicpO1xuXG4gICAgICAgIGxvY2F0aW9uLmhyZWYgPSBxdWVyeV91cmwodXJsLCAnaycsIGspO1xuICAgIH1cbn0pXG5cbi8vIFNhdmUgc2VsZWN0ZWQgaXRlbXNcbmlmIChDb29raWVzLmdldCgnc3ViZXhhbV9zZWxlY3RlZF9pdGVtcycpICE9ICcnICYmIENvb2tpZXMuZ2V0KCdzdWJleGFtX3NlbGVjdGVkX2l0ZW1zJykgIT09IHVuZGVmaW5lZCkge1xuICAgIGxldCBzdWJleGFtU2VsZWN0ZWRJdGVtcyA9IENvb2tpZXMuZ2V0KCdzdWJleGFtX3NlbGVjdGVkX2l0ZW1zJykuc3BsaXQoJywnKTtcbiAgICBsZXQgY2hlY2tlZCA9IDA7XG5cbiAgICBmb3IgKGl0ZW0gb2Ygc3ViZXhhbVNlbGVjdGVkSXRlbXMpIHtcbiAgICAgICAgJChgLmNoZWNrLXJvd1tkYXRhLWlkPSR7aXRlbX1dYCkucHJvcCgnY2hlY2tlZCcsIHRydWUpO1xuICAgIH1cblxuICAgICQoJy5jaGVjay1yb3cnKS5lYWNoKGZ1bmN0aW9uKGtleSwgaXRlbSkge1xuICAgICAgICBpZiAoc3ViZXhhbVNlbGVjdGVkSXRlbXMuaW5jbHVkZXMoJChpdGVtKS5kYXRhKCdpZCcpLnRvU3RyaW5nKCkpKSB7XG4gICAgICAgICAgICAkKGl0ZW0pLnByb3AoJ2NoZWNrZWQnLCB0cnVlKTtcbiAgICAgICAgICAgIGNoZWNrZWQrKztcbiAgICAgICAgfVxuICAgIH0pO1xuXG4gICAgaWYgKGNoZWNrZWQgPT0gJCgnLmNoZWNrLXJvdycpLmxlbmd0aCkge1xuICAgICAgICAkKCcuY2hlY2stYWxsJykucHJvcCgnY2hlY2tlZCcsIHRydWUpO1xuICAgIH1cblxuICAgICQoJyNzYXZlLXNlbGVjdGVkLWl0ZW0tc3dpdGNoZXIgLmNvdW50ZXInKS5odG1sKHN1YmV4YW1TZWxlY3RlZEl0ZW1zLmxlbmd0aCk7XG59XG5cbmlmIChDb29raWVzLmdldCgnc3ViZXhhbV9zYXZlX3NlbGVjdGVkX2l0ZW1zX21vZGUnKSAhPT0gdW5kZWZpbmVkKSB7XG4gICAgJCgnI3NhdmUtc2VsZWN0ZWQtaXRlbS1tb2RlJykucHJvcCgnY2hlY2tlZCcsIENvb2tpZXMuZ2V0KCdzdWJleGFtX3NhdmVfc2VsZWN0ZWRfaXRlbXNfbW9kZScpID09PSAndHJ1ZScpXG59XG5cbmlmIChDb29raWVzLmdldCgnc3ViZXhhbV9zYXZlX3NlbGVjdGVkX2l0ZW1zX21vZGUnKSA9PT0gJ3RydWUnKSB7XG4gICAgJCgnI3NhdmUtc2VsZWN0ZWQtaXRlbS1zd2l0Y2hlciAubGFiZWwtY291bnRlcicpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbn0gZWxzZSB7XG4gICAgJCgnI3NhdmUtc2VsZWN0ZWQtaXRlbS1zd2l0Y2hlciAubGFiZWwtY291bnRlcicpLmFkZENsYXNzKCdkLW5vbmUnKTtcbn1cblxuJCgnI3NhdmUtc2VsZWN0ZWQtaXRlbS1tb2RlJykub24oJ2NoYW5nZScsIGZ1bmN0aW9uKCkge1xuICAgIGxldCBtb2RlID0gJCh0aGlzKS5wcm9wKCdjaGVja2VkJyk7XG4gICAgQ29va2llcy5zZXQoYHN1YmV4YW1fc2F2ZV9zZWxlY3RlZF9pdGVtc19tb2RlYCwgbW9kZSlcblxuICAgIGlmIChDb29raWVzLmdldCgnc3ViZXhhbV9zYXZlX3NlbGVjdGVkX2l0ZW1zX21vZGUnKSA9PT0gJ3RydWUnKSB7XG4gICAgICAgICQoJyNzYXZlLXNlbGVjdGVkLWl0ZW0tc3dpdGNoZXIgLmxhYmVsLWNvdW50ZXInKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG4gICAgICAgIENvb2tpZXMuc2V0KCdzdWJleGFtX3NlbGVjdGVkX2l0ZW1zJywgJycpO1xuICAgIH0gZWxzZSB7XG4gICAgICAgICQoJyNzYXZlLXNlbGVjdGVkLWl0ZW0tc3dpdGNoZXIgLmxhYmVsLWNvdW50ZXInKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgICAgIENvb2tpZXMucmVtb3ZlKCdzdWJleGFtX3NlbGVjdGVkX2l0ZW1zJyk7XG4gICAgfVxuXG4gICAgJCgnI3NhdmUtc2VsZWN0ZWQtaXRlbS1zd2l0Y2hlciAuY291bnRlcicpLmh0bWwoJzAnKTtcbn0pO1xuXG4kKCcuY2hlY2stcm93Jykub24oJ2NoYW5nZScsIGZ1bmN0aW9uKCkge1xuICAgIGlmIChDb29raWVzLmdldCgnc3ViZXhhbV9zYXZlX3NlbGVjdGVkX2l0ZW1zX21vZGUnKSA9PT0gJ3RydWUnKSB7XG4gICAgICAgIGxldCBjaGVja2VkID0gJCh0aGlzKS5wcm9wKCdjaGVja2VkJyk7XG4gICAgICAgIGxldCBzdWJleGFtU2VsZWN0ZWRJdGVtcyA9IENvb2tpZXMuZ2V0KCdzdWJleGFtX3NlbGVjdGVkX2l0ZW1zJykgIT0gJycgXG4gICAgICAgICAgICA/IENvb2tpZXMuZ2V0KCdzdWJleGFtX3NlbGVjdGVkX2l0ZW1zJykuc3BsaXQoJywnKVxuICAgICAgICAgICAgOiBbXTtcbiAgICAgICAgbGV0IGlkID0gJCh0aGlzKS5kYXRhKCdpZCcpLnRvU3RyaW5nKCk7XG5cbiAgICAgICAgaWYgKGNoZWNrZWQgJiYgISBzdWJleGFtU2VsZWN0ZWRJdGVtcy5pbmNsdWRlcyhpZCkpIHtcbiAgICAgICAgICAgIHN1YmV4YW1TZWxlY3RlZEl0ZW1zLnB1c2goaWQpO1xuICAgICAgICB9IGVsc2UgaWYgKCEgY2hlY2tlZCAmJiBzdWJleGFtU2VsZWN0ZWRJdGVtcy5pbmNsdWRlcyhpZCkpIHtcbiAgICAgICAgICAgIHN1YmV4YW1TZWxlY3RlZEl0ZW1zLnNwbGljZShzdWJleGFtU2VsZWN0ZWRJdGVtcy5pbmRleE9mKGlkKSwgMSk7XG4gICAgICAgIH1cbiAgICBcbiAgICAgICAgQ29va2llcy5zZXQoJ3N1YmV4YW1fc2VsZWN0ZWRfaXRlbXMnLCBzdWJleGFtU2VsZWN0ZWRJdGVtcy5qb2luKCcsJykpO1xuXG4gICAgICAgICQoJyNzYXZlLXNlbGVjdGVkLWl0ZW0tc3dpdGNoZXIgLmNvdW50ZXInKS5odG1sKHN1YmV4YW1TZWxlY3RlZEl0ZW1zLmxlbmd0aCk7XG4gICAgfVxufSlcblxuLy8gRXhwb3J0IHRhYmxlXG4kKGRvY3VtZW50KS5vbignY2xpY2snLCAnLmJ0bi1wcmludCcsIGZ1bmN0aW9uKCkge1xuICAgICQoJyNwcmludGVyJykucmVtb3ZlKCk7XG5cbiAgICBsZXQgdXJsID0gJCh0aGlzKS5hdHRyKCdhY3Rpb24nKTtcbiAgICBsZXQgc2VsZWN0ZWQgPSBudWxsO1xuXG4gICAgaWYgKENvb2tpZXMuZ2V0KCdzdWJleGFtX3NhdmVfc2VsZWN0ZWRfaXRlbXNfbW9kZScpID09PSAndHJ1ZScpIHtcbiAgICAgICAgc2VsZWN0ZWQgPSBDb29raWVzLmdldCgnc3ViZXhhbV9zZWxlY3RlZF9pdGVtcycpXG4gICAgfSBlbHNlIHtcbiAgICAgICAgc2VsZWN0ZWQgPSAkKCcuY2hlY2stcm93OmNoZWNrZWQnKS5tYXAoZnVuY3Rpb24oa2V5LCBpdGVtKSB7XG4gICAgICAgICAgICByZXR1cm4gJChpdGVtKS5kYXRhKCdpZCcpO1xuICAgICAgICB9KS5nZXQoKS5qb2luKCcsJykgPz8gJyc7XG4gICAgfVxuXG4gICAgJCgnYm9keScpLmFwcGVuZChgXG4gICAgICAgIDxpZnJhbWUgaWQ9XCJwcmludGVyXCIgY2xhc3M9XCJkLW5vbmVcIiBzcmM9XCIke3F1ZXJ5X3VybCh1cmwsICdzZWxlY3RlZCcsIHNlbGVjdGVkKX1cIj48L2lmcmFtZT5cbiAgICBgKVxuXG4gICAgJCgnI3ByaW50ZXInKS5nZXQoMCkuY29udGVudFdpbmRvdy5wcmludCgpXG59KVxuXG4kKGRvY3VtZW50KS5vbignY2xpY2snLCAnLmJ0bi1leGNlbCcsIGZ1bmN0aW9uKCkge1xuICAgIGxldCB1cmwgPSAkKHRoaXMpLmF0dHIoJ2FjdGlvbicpO1xuICAgIGxldCBzZWxlY3RlZCA9IG51bGw7XG5cbiAgICBpZiAoQ29va2llcy5nZXQoJ3N1YmV4YW1fc2F2ZV9zZWxlY3RlZF9pdGVtc19tb2RlJykgPT09ICd0cnVlJykge1xuICAgICAgICBzZWxlY3RlZCA9IENvb2tpZXMuZ2V0KCdzdWJleGFtX3NlbGVjdGVkX2l0ZW1zJylcbiAgICB9IGVsc2Uge1xuICAgICAgICBzZWxlY3RlZCA9ICQoJy5jaGVjay1yb3c6Y2hlY2tlZCcpLm1hcChmdW5jdGlvbihrZXksIGl0ZW0pIHtcbiAgICAgICAgICAgIHJldHVybiAkKGl0ZW0pLmRhdGEoJ2lkJyk7XG4gICAgICAgIH0pLmdldCgpLmpvaW4oJywnKSA/PyAnJztcbiAgICB9XG5cbiAgICB3aW5kb3cubG9jYXRpb24gPSBxdWVyeV91cmwodXJsLCAnc2VsZWN0ZWQnLCBzZWxlY3RlZCk7XG59KSJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/index-subexam.js\n");

/***/ }),

/***/ 11:
/*!*********************************************!*\
  !*** multi ./resources/js/index-subexam.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Volumes/Data/Dev/examsubret/resources/js/index-subexam.js */"./resources/js/index-subexam.js");


/***/ })

/******/ });