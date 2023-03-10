/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@babel/runtime/helpers/assertThisInitialized.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/assertThisInitialized.js ***!
  \**********************************************************************/
/***/ ((module) => {

function _assertThisInitialized(self) {
  if (self === void 0) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return self;
}

module.exports = _assertThisInitialized, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/asyncToGenerator.js ***!
  \*****************************************************************/
/***/ ((module) => {

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
  try {
    var info = gen[key](arg);
    var value = info.value;
  } catch (error) {
    reject(error);
    return;
  }

  if (info.done) {
    resolve(value);
  } else {
    Promise.resolve(value).then(_next, _throw);
  }
}

function _asyncToGenerator(fn) {
  return function () {
    var self = this,
        args = arguments;
    return new Promise(function (resolve, reject) {
      var gen = fn.apply(self, args);

      function _next(value) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
      }

      function _throw(err) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
      }

      _next(undefined);
    });
  };
}

module.exports = _asyncToGenerator, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/createClass.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/createClass.js ***!
  \************************************************************/
/***/ ((module) => {

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  Object.defineProperty(Constructor, "prototype", {
    writable: false
  });
  return Constructor;
}

module.exports = _createClass, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/defineProperty.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/defineProperty.js ***!
  \***************************************************************/
/***/ ((module) => {

function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}

module.exports = _defineProperty, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/extends.js":
/*!********************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/extends.js ***!
  \********************************************************/
/***/ ((module) => {

function _extends() {
  module.exports = _extends = Object.assign ? Object.assign.bind() : function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports;
  return _extends.apply(this, arguments);
}

module.exports = _extends, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/inheritsLoose.js":
/*!**************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/inheritsLoose.js ***!
  \**************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var setPrototypeOf = __webpack_require__(/*! ./setPrototypeOf.js */ "./node_modules/@babel/runtime/helpers/setPrototypeOf.js");

function _inheritsLoose(subClass, superClass) {
  subClass.prototype = Object.create(superClass.prototype);
  subClass.prototype.constructor = subClass;
  setPrototypeOf(subClass, superClass);
}

module.exports = _inheritsLoose, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/regeneratorRuntime.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/regeneratorRuntime.js ***!
  \*******************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var _typeof = (__webpack_require__(/*! ./typeof.js */ "./node_modules/@babel/runtime/helpers/typeof.js")["default"]);

function _regeneratorRuntime() {
  "use strict";
  /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */

  module.exports = _regeneratorRuntime = function _regeneratorRuntime() {
    return exports;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports;
  var exports = {},
      Op = Object.prototype,
      hasOwn = Op.hasOwnProperty,
      $Symbol = "function" == typeof Symbol ? Symbol : {},
      iteratorSymbol = $Symbol.iterator || "@@iterator",
      asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator",
      toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  function define(obj, key, value) {
    return Object.defineProperty(obj, key, {
      value: value,
      enumerable: !0,
      configurable: !0,
      writable: !0
    }), obj[key];
  }

  try {
    define({}, "");
  } catch (err) {
    define = function define(obj, key, value) {
      return obj[key] = value;
    };
  }

  function wrap(innerFn, outerFn, self, tryLocsList) {
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator,
        generator = Object.create(protoGenerator.prototype),
        context = new Context(tryLocsList || []);
    return generator._invoke = function (innerFn, self, context) {
      var state = "suspendedStart";
      return function (method, arg) {
        if ("executing" === state) throw new Error("Generator is already running");

        if ("completed" === state) {
          if ("throw" === method) throw arg;
          return doneResult();
        }

        for (context.method = method, context.arg = arg;;) {
          var delegate = context.delegate;

          if (delegate) {
            var delegateResult = maybeInvokeDelegate(delegate, context);

            if (delegateResult) {
              if (delegateResult === ContinueSentinel) continue;
              return delegateResult;
            }
          }

          if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) {
            if ("suspendedStart" === state) throw state = "completed", context.arg;
            context.dispatchException(context.arg);
          } else "return" === context.method && context.abrupt("return", context.arg);
          state = "executing";
          var record = tryCatch(innerFn, self, context);

          if ("normal" === record.type) {
            if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue;
            return {
              value: record.arg,
              done: context.done
            };
          }

          "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg);
        }
      };
    }(innerFn, self, context), generator;
  }

  function tryCatch(fn, obj, arg) {
    try {
      return {
        type: "normal",
        arg: fn.call(obj, arg)
      };
    } catch (err) {
      return {
        type: "throw",
        arg: err
      };
    }
  }

  exports.wrap = wrap;
  var ContinueSentinel = {};

  function Generator() {}

  function GeneratorFunction() {}

  function GeneratorFunctionPrototype() {}

  var IteratorPrototype = {};
  define(IteratorPrototype, iteratorSymbol, function () {
    return this;
  });
  var getProto = Object.getPrototypeOf,
      NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype);
  var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype);

  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function (method) {
      define(prototype, method, function (arg) {
        return this._invoke(method, arg);
      });
    });
  }

  function AsyncIterator(generator, PromiseImpl) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);

      if ("throw" !== record.type) {
        var result = record.arg,
            value = result.value;
        return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) {
          invoke("next", value, resolve, reject);
        }, function (err) {
          invoke("throw", err, resolve, reject);
        }) : PromiseImpl.resolve(value).then(function (unwrapped) {
          result.value = unwrapped, resolve(result);
        }, function (error) {
          return invoke("throw", error, resolve, reject);
        });
      }

      reject(record.arg);
    }

    var previousPromise;

    this._invoke = function (method, arg) {
      function callInvokeWithMethodAndArg() {
        return new PromiseImpl(function (resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg();
    };
  }

  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];

    if (undefined === method) {
      if (context.delegate = null, "throw" === context.method) {
        if (delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method)) return ContinueSentinel;
        context.method = "throw", context.arg = new TypeError("The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);
    if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel;
    var info = record.arg;
    return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel);
  }

  function pushTryEntry(locs) {
    var entry = {
      tryLoc: locs[0]
    };
    1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal", delete record.arg, entry.completion = record;
  }

  function Context(tryLocsList) {
    this.tryEntries = [{
      tryLoc: "root"
    }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0);
  }

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) return iteratorMethod.call(iterable);
      if ("function" == typeof iterable.next) return iterable;

      if (!isNaN(iterable.length)) {
        var i = -1,
            next = function next() {
          for (; ++i < iterable.length;) {
            if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next;
          }

          return next.value = undefined, next.done = !0, next;
        };

        return next.next = next;
      }
    }

    return {
      next: doneResult
    };
  }

  function doneResult() {
    return {
      value: undefined,
      done: !0
    };
  }

  return GeneratorFunction.prototype = GeneratorFunctionPrototype, define(Gp, "constructor", GeneratorFunctionPrototype), define(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) {
    var ctor = "function" == typeof genFun && genFun.constructor;
    return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name));
  }, exports.mark = function (genFun) {
    return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun;
  }, exports.awrap = function (arg) {
    return {
      __await: arg
    };
  }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () {
    return this;
  }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) {
    void 0 === PromiseImpl && (PromiseImpl = Promise);
    var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl);
    return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) {
      return result.done ? result.value : iter.next();
    });
  }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () {
    return this;
  }), define(Gp, "toString", function () {
    return "[object Generator]";
  }), exports.keys = function (object) {
    var keys = [];

    for (var key in object) {
      keys.push(key);
    }

    return keys.reverse(), function next() {
      for (; keys.length;) {
        var key = keys.pop();
        if (key in object) return next.value = key, next.done = !1, next;
      }

      return next.done = !0, next;
    };
  }, exports.values = values, Context.prototype = {
    constructor: Context,
    reset: function reset(skipTempReset) {
      if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) {
        "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined);
      }
    },
    stop: function stop() {
      this.done = !0;
      var rootRecord = this.tryEntries[0].completion;
      if ("throw" === rootRecord.type) throw rootRecord.arg;
      return this.rval;
    },
    dispatchException: function dispatchException(exception) {
      if (this.done) throw exception;
      var context = this;

      function handle(loc, caught) {
        return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i],
            record = entry.completion;
        if ("root" === entry.tryLoc) return handle("end");

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc"),
              hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0);
            if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc);
          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0);
          } else {
            if (!hasFinally) throw new Error("try statement without catch or finally");
            if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc);
          }
        }
      }
    },
    abrupt: function abrupt(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];

        if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null);
      var record = finallyEntry ? finallyEntry.completion : {};
      return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record);
    },
    complete: function complete(record, afterLoc) {
      if ("throw" === record.type) throw record.arg;
      return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel;
    },
    finish: function finish(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel;
      }
    },
    "catch": function _catch(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];

        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;

          if ("throw" === record.type) {
            var thrown = record.arg;
            resetTryEntry(entry);
          }

          return thrown;
        }
      }

      throw new Error("illegal catch attempt");
    },
    delegateYield: function delegateYield(iterable, resultName, nextLoc) {
      return this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      }, "next" === this.method && (this.arg = undefined), ContinueSentinel;
    }
  }, exports;
}

module.exports = _regeneratorRuntime, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/setPrototypeOf.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/setPrototypeOf.js ***!
  \***************************************************************/
/***/ ((module) => {

function _setPrototypeOf(o, p) {
  module.exports = _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports;
  return _setPrototypeOf(o, p);
}

module.exports = _setPrototypeOf, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/typeof.js":
/*!*******************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/typeof.js ***!
  \*******************************************************/
/***/ ((module) => {

function _typeof(obj) {
  "@babel/helpers - typeof";

  return (module.exports = _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) {
    return typeof obj;
  } : function (obj) {
    return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports), _typeof(obj);
}

module.exports = _typeof, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "./node_modules/@babel/runtime/regenerator/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

// TODO(Babel 8): Remove this file.

var runtime = __webpack_require__(/*! ../helpers/regeneratorRuntime */ "./node_modules/@babel/runtime/helpers/regeneratorRuntime.js")();
module.exports = runtime;

// Copied from https://github.com/facebook/regenerator/blob/main/packages/runtime/runtime.js#L736=
try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  if (typeof globalThis === "object") {
    globalThis.regeneratorRuntime = runtime;
  } else {
    Function("r", "regeneratorRuntime = r")(runtime);
  }
}


/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/error.js":
/*!***********************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/error.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.createError = exports.Error = void 0;
// NOTE: Do not edit this file. This code is auto-generated. Contact the
// Twilio SDK Team for more information.
/* tslint:disable:max-classes-per-file */
var globalScope = __webpack_require__.g.window || __webpack_require__.g;
/**
 * Description of an error that was encountered while connecting to
 * or playing back a live stream.
 */
var Error = /** @class */ (function (_super) {
    __extends(Error, _super);
    /**
     * @private
     */
    function Error(code, message, explanation) {
        var _this = _super.call(this, message) || this;
        Object.setPrototypeOf(_this, Error.prototype);
        _this._code = code;
        _this._explanation = explanation;
        _this._message = message;
        return _this;
    }
    Object.defineProperty(Error.prototype, "code", {
        /**
         * A code representing the error.
         */
        get: function () {
            return this._code;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Error.prototype, "explanation", {
        /**
         * A message providing more details about the error.
         */
        get: function () {
            return this._explanation;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Error.prototype, "message", {
        /**
         * A message describing the error.
         */
        get: function () {
            return this._message;
        },
        enumerable: false,
        configurable: true
    });
    /**
     * @private
     */
    Error.prototype.toJSON = function () {
        var json = {
            code: this._code,
            message: this._message,
        };
        if (this._explanation) {
            json.explanation = this._explanation;
        }
        return json;
    };
    return Error;
}(globalScope.Error));
exports.Error = Error;
(function (Error) {
    /**
     * Twilio was unable to validate your Access Token
     */
    var AccessTokenInvalidError = /** @class */ (function (_super) {
        __extends(AccessTokenInvalidError, _super);
        /**
         * @private
         */
        function AccessTokenInvalidError(explanation) {
            return _super.call(this, 20101, 'Twilio was unable to validate your Access Token', explanation) || this;
        }
        return AccessTokenInvalidError;
    }(Error));
    Error.AccessTokenInvalidError = AccessTokenInvalidError;
    /**
     * An error occurred playing back media content
     */
    var PlaybackMediaError = /** @class */ (function (_super) {
        __extends(PlaybackMediaError, _super);
        /**
         * @private
         */
        function PlaybackMediaError(explanation) {
            return _super.call(this, 56000, 'An error occurred playing back media content', explanation) || this;
        }
        return PlaybackMediaError;
    }(Error));
    Error.PlaybackMediaError = PlaybackMediaError;
    /**
     * A network resource is not authorized
     */
    var PlaybackAuthorizationError = /** @class */ (function (_super) {
        __extends(PlaybackAuthorizationError, _super);
        /**
         * @private
         */
        function PlaybackAuthorizationError(explanation) {
            return _super.call(this, 56001, 'A network resource is not authorized', explanation) || this;
        }
        return PlaybackAuthorizationError;
    }(Error));
    Error.PlaybackAuthorizationError = PlaybackAuthorizationError;
    /**
     * Data or input is invalid
     */
    var PlaybackInvalidDataError = /** @class */ (function (_super) {
        __extends(PlaybackInvalidDataError, _super);
        /**
         * @private
         */
        function PlaybackInvalidDataError(explanation) {
            return _super.call(this, 56002, 'Data or input is invalid', explanation) || this;
        }
        return PlaybackInvalidDataError;
    }(Error));
    Error.PlaybackInvalidDataError = PlaybackInvalidDataError;
    /**
     * A method parameter is invalid
     */
    var PlaybackInvalidParameterError = /** @class */ (function (_super) {
        __extends(PlaybackInvalidParameterError, _super);
        /**
         * @private
         */
        function PlaybackInvalidParameterError(explanation) {
            return _super.call(this, 56003, 'A method parameter is invalid', explanation) || this;
        }
        return PlaybackInvalidParameterError;
    }(Error));
    Error.PlaybackInvalidParameterError = PlaybackInvalidParameterError;
    /**
     * The Player or an internal object is in an invalid state
     */
    var PlaybackInvalidStateError = /** @class */ (function (_super) {
        __extends(PlaybackInvalidStateError, _super);
        /**
         * @private
         */
        function PlaybackInvalidStateError(explanation) {
            return _super.call(this, 56004, 'The Player or an internal object is in an invalid state', explanation) || this;
        }
        return PlaybackInvalidStateError;
    }(Error));
    Error.PlaybackInvalidStateError = PlaybackInvalidStateError;
    /**
     * A network error occurred
     */
    var PlaybackNetworkError = /** @class */ (function (_super) {
        __extends(PlaybackNetworkError, _super);
        /**
         * @private
         */
        function PlaybackNetworkError(explanation) {
            return _super.call(this, 56005, 'A network error occurred', explanation) || this;
        }
        return PlaybackNetworkError;
    }(Error));
    Error.PlaybackNetworkError = PlaybackNetworkError;
    /**
     * A network I/O error occurred
     */
    var PlaybackNetworkIOError = /** @class */ (function (_super) {
        __extends(PlaybackNetworkIOError, _super);
        /**
         * @private
         */
        function PlaybackNetworkIOError(explanation) {
            return _super.call(this, 56006, 'A network I/O error occurred', explanation) || this;
        }
        return PlaybackNetworkIOError;
    }(Error));
    Error.PlaybackNetworkIOError = PlaybackNetworkIOError;
    /**
     * The stream is not available
     */
    var PlaybackStreamNotAvailableError = /** @class */ (function (_super) {
        __extends(PlaybackStreamNotAvailableError, _super);
        /**
         * @private
         */
        function PlaybackStreamNotAvailableError(explanation) {
            return _super.call(this, 56007, 'The stream is not available', explanation) || this;
        }
        return PlaybackStreamNotAvailableError;
    }(Error));
    Error.PlaybackStreamNotAvailableError = PlaybackStreamNotAvailableError;
    /**
     * The current-viewers limit was reached
     */
    var PlaybackTooManyStreamingRequestsError = /** @class */ (function (_super) {
        __extends(PlaybackTooManyStreamingRequestsError, _super);
        /**
         * @private
         */
        function PlaybackTooManyStreamingRequestsError(explanation) {
            return _super.call(this, 56008, 'The current-viewers limit was reached', explanation) || this;
        }
        return PlaybackTooManyStreamingRequestsError;
    }(Error));
    Error.PlaybackTooManyStreamingRequestsError = PlaybackTooManyStreamingRequestsError;
    /**
     * A method or feature is not supported
     */
    var PlaybackNotSupportedError = /** @class */ (function (_super) {
        __extends(PlaybackNotSupportedError, _super);
        /**
         * @private
         */
        function PlaybackNotSupportedError(explanation) {
            return _super.call(this, 56009, 'A method or feature is not supported', explanation) || this;
        }
        return PlaybackNotSupportedError;
    }(Error));
    Error.PlaybackNotSupportedError = PlaybackNotSupportedError;
    /**
     * There is no source for the Player to play
     */
    var PlaybackNoSourceError = /** @class */ (function (_super) {
        __extends(PlaybackNoSourceError, _super);
        /**
         * @private
         */
        function PlaybackNoSourceError(explanation) {
            return _super.call(this, 56010, 'There is no source for the Player to play', explanation) || this;
        }
        return PlaybackNoSourceError;
    }(Error));
    Error.PlaybackNoSourceError = PlaybackNoSourceError;
    /**
     * The Player timed out performing an operation
     */
    var PlaybackTimeoutError = /** @class */ (function (_super) {
        __extends(PlaybackTimeoutError, _super);
        /**
         * @private
         */
        function PlaybackTimeoutError(explanation) {
            return _super.call(this, 56011, 'The Player timed out performing an operation', explanation) || this;
        }
        return PlaybackTimeoutError;
    }(Error));
    Error.PlaybackTimeoutError = PlaybackTimeoutError;
    var ErrorCode;
    (function (ErrorCode) {
        /**
         * Twilio was unable to validate your Access Token
         */
        ErrorCode[ErrorCode["ACCESS_TOKEN_INVALID"] = 20101] = "ACCESS_TOKEN_INVALID";
        /**
         * An error occurred playing back media content
         */
        ErrorCode[ErrorCode["PLAYBACK_MEDIA"] = 56000] = "PLAYBACK_MEDIA";
        /**
         * A network resource is not authorized
         */
        ErrorCode[ErrorCode["PLAYBACK_AUTHORIZATION"] = 56001] = "PLAYBACK_AUTHORIZATION";
        /**
         * Data or input is invalid
         */
        ErrorCode[ErrorCode["PLAYBACK_INVALID_DATA"] = 56002] = "PLAYBACK_INVALID_DATA";
        /**
         * A method parameter is invalid
         */
        ErrorCode[ErrorCode["PLAYBACK_INVALID_PARAMETER"] = 56003] = "PLAYBACK_INVALID_PARAMETER";
        /**
         * The Player or an internal object is in an invalid state
         */
        ErrorCode[ErrorCode["PLAYBACK_INVALID_STATE"] = 56004] = "PLAYBACK_INVALID_STATE";
        /**
         * A network error occurred
         */
        ErrorCode[ErrorCode["PLAYBACK_NETWORK"] = 56005] = "PLAYBACK_NETWORK";
        /**
         * A network I/O error occurred
         */
        ErrorCode[ErrorCode["PLAYBACK_NETWORK_IO"] = 56006] = "PLAYBACK_NETWORK_IO";
        /**
         * The stream is not available
         */
        ErrorCode[ErrorCode["PLAYBACK_STREAM_NOT_AVAILABLE"] = 56007] = "PLAYBACK_STREAM_NOT_AVAILABLE";
        /**
         * The current-viewers limit was reached
         */
        ErrorCode[ErrorCode["PLAYBACK_TOO_MANY_STREAMING_REQUESTS"] = 56008] = "PLAYBACK_TOO_MANY_STREAMING_REQUESTS";
        /**
         * A method or feature is not supported
         */
        ErrorCode[ErrorCode["PLAYBACK_NOT_SUPPORTED"] = 56009] = "PLAYBACK_NOT_SUPPORTED";
        /**
         * There is no source for the Player to play
         */
        ErrorCode[ErrorCode["PLAYBACK_NO_SOURCE"] = 56010] = "PLAYBACK_NO_SOURCE";
        /**
         * The Player timed out performing an operation
         */
        ErrorCode[ErrorCode["PLAYBACK_TIMEOUT"] = 56011] = "PLAYBACK_TIMEOUT";
    })(ErrorCode = Error.ErrorCode || (Error.ErrorCode = {}));
})(Error = exports.Error || (exports.Error = {}));
exports.Error = Error;
var ErrorsByCode = {
    20101: Error.AccessTokenInvalidError,
    56000: Error.PlaybackMediaError,
    56001: Error.PlaybackAuthorizationError,
    56002: Error.PlaybackInvalidDataError,
    56003: Error.PlaybackInvalidParameterError,
    56004: Error.PlaybackInvalidStateError,
    56005: Error.PlaybackNetworkError,
    56006: Error.PlaybackNetworkIOError,
    56007: Error.PlaybackStreamNotAvailableError,
    56008: Error.PlaybackTooManyStreamingRequestsError,
    56009: Error.PlaybackNotSupportedError,
    56010: Error.PlaybackNoSourceError,
    56011: Error.PlaybackTimeoutError,
};
/**
 * @private
 */
function createError(code, message, explanation) {
    message = message || 'Unknown error';
    explanation = explanation || '';
    return ErrorsByCode[code] ? new ErrorsByCode[code](explanation) : new Error(code, message, explanation);
}
exports.createError = createError;
//# sourceMappingURL=error.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/eventobservers/index.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/eventobservers/index.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.PlayerPositionObserver = exports.PlaybackUrlEventObserver = exports.LiveLatencyEventObserver = void 0;
var livelatency_1 = __webpack_require__(/*! ./livelatency */ "./node_modules/@twilio/live-player-sdk/es5/eventobservers/livelatency.js");
Object.defineProperty(exports, "LiveLatencyEventObserver", ({ enumerable: true, get: function () { return livelatency_1.LiveLatencyEventObserver; } }));
var playbackurl_1 = __webpack_require__(/*! ./playbackurl */ "./node_modules/@twilio/live-player-sdk/es5/eventobservers/playbackurl.js");
Object.defineProperty(exports, "PlaybackUrlEventObserver", ({ enumerable: true, get: function () { return playbackurl_1.PlaybackUrlEventObserver; } }));
var playerposition_1 = __webpack_require__(/*! ./playerposition */ "./node_modules/@twilio/live-player-sdk/es5/eventobservers/playerposition.js");
Object.defineProperty(exports, "PlayerPositionObserver", ({ enumerable: true, get: function () { return playerposition_1.PlayerPositionObserver; } }));
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/eventobservers/livelatency.js":
/*!********************************************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/eventobservers/livelatency.js ***!
  \********************************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.LiveLatencyEventObserver = void 0;
var events_1 = __webpack_require__(/*! events */ "./node_modules/events/events.js");
var MAX_PLAYBACK_RATE = 1.05;
var DEFAULT_PLAYBACK_RATE = 1;
// All units are in seconds
var SEEK_BUFFER = 3;
var MIN_LATENCY_PLAYBACK_INCREASE_THRESHOLD = 3;
var MAX_LATENCY_PLAYBACK_INCREASE_THRESHOLD = 5;
/**
 * [[LiveLatencyEventObserver]] listens to player events and monitor live latency values.
 * This observer will then emit events when certain thresholds are detected.
 * @private
 */
var LiveLatencyEventObserver = /** @class */ (function (_super) {
    __extends(LiveLatencyEventObserver, _super);
    /**
     * @private
     */
    function LiveLatencyEventObserver(vendorPlayer, telemetry, isHighLatencyReductionEnabled) {
        var _this = _super.call(this) || this;
        _this._active = false;
        _this._increasePlaybackRate = function () {
            _this._active = true;
            _this._vendorPlayer.setPlaybackRate(MAX_PLAYBACK_RATE);
            _this.emit(LiveLatencyEventObserver.Event.IncreasePlaybackRate);
        };
        _this._revertHighLatencyReduction = function () {
            _this._active = false;
            _this._vendorPlayer.setPlaybackRate(DEFAULT_PLAYBACK_RATE);
            _this.emit(LiveLatencyEventObserver.Event.HighLatencyReductionReverted);
        };
        _this._seekAhead = function () {
            _this._active = true;
            _this._vendorPlayer.setPlaybackRate(DEFAULT_PLAYBACK_RATE);
            var newPosition = _this._vendorPlayer.getPosition() + _this._vendorPlayer.getBufferDuration() - SEEK_BUFFER;
            _this._vendorPlayer.seekTo(newPosition);
            _this.emit(LiveLatencyEventObserver.Event.SeekAhead);
        };
        _this._isHighLatencyReductionEnabled = isHighLatencyReductionEnabled;
        _this._telemetry = telemetry;
        _this._vendorPlayer = vendorPlayer;
        _this._telemetry.subscribe(_this._increasePlaybackRate, function (telemetryData) {
            var _a = telemetryData, name = _a.name, playerLiveLatency = _a.playerLiveLatency;
            return _this._shouldApplyHighLatencyReduction(name, playerLiveLatency)
                && playerLiveLatency < MAX_LATENCY_PLAYBACK_INCREASE_THRESHOLD
                && _this._vendorPlayer.getPlaybackRate() < MAX_PLAYBACK_RATE;
        });
        _this._telemetry.subscribe(_this._seekAhead, function (telemetryData) {
            var _a = telemetryData, name = _a.name, playerLiveLatency = _a.playerLiveLatency;
            return _this._shouldApplyHighLatencyReduction(name, playerLiveLatency)
                && playerLiveLatency >= MAX_LATENCY_PLAYBACK_INCREASE_THRESHOLD
                && _this._vendorPlayer.getBufferDuration() >= MAX_LATENCY_PLAYBACK_INCREASE_THRESHOLD;
        });
        _this._telemetry.subscribe(_this._revertHighLatencyReduction, function (telemetryData) {
            var _a = telemetryData, name = _a.name, playerLiveLatency = _a.playerLiveLatency;
            return _this._active && name === 'summary'
                && playerLiveLatency <= MIN_LATENCY_PLAYBACK_INCREASE_THRESHOLD;
        });
        return _this;
    }
    LiveLatencyEventObserver.prototype.release = function () {
        // NOTE(csantos): This event observer cannot be reused. So release all listeners attached to it.
        this.removeAllListeners(LiveLatencyEventObserver.Event.HighLatencyReductionReverted);
        this.removeAllListeners(LiveLatencyEventObserver.Event.IncreasePlaybackRate);
        this.removeAllListeners(LiveLatencyEventObserver.Event.SeekAhead);
        this._telemetry.unsubscribe(this._increasePlaybackRate);
        this._telemetry.unsubscribe(this._seekAhead);
        this._telemetry.unsubscribe(this._revertHighLatencyReduction);
    };
    LiveLatencyEventObserver.prototype._shouldApplyHighLatencyReduction = function (name, playerLiveLatency) {
        return this._isHighLatencyReductionEnabled && name === 'summary'
            && playerLiveLatency > MIN_LATENCY_PLAYBACK_INCREASE_THRESHOLD
            && this._vendorPlayer.getBufferDuration() >= MIN_LATENCY_PLAYBACK_INCREASE_THRESHOLD;
    };
    return LiveLatencyEventObserver;
}(events_1.EventEmitter));
exports.LiveLatencyEventObserver = LiveLatencyEventObserver;
/**
 * @private
 */
(function (LiveLatencyEventObserver) {
    /**
     * @private
     */
    var Event;
    (function (Event) {
        Event["HighLatencyReductionReverted"] = "high-latency-reduction-reverted";
        Event["IncreasePlaybackRate"] = "increase-playback-rate";
        Event["SeekAhead"] = "seek-ahead";
    })(Event = LiveLatencyEventObserver.Event || (LiveLatencyEventObserver.Event = {}));
})(LiveLatencyEventObserver = exports.LiveLatencyEventObserver || (exports.LiveLatencyEventObserver = {}));
exports.LiveLatencyEventObserver = LiveLatencyEventObserver;
//# sourceMappingURL=livelatency.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/eventobservers/playbackurl.js":
/*!********************************************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/eventobservers/playbackurl.js ***!
  \********************************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.PlaybackUrlEventObserver = void 0;
var events_1 = __webpack_require__(/*! events */ "./node_modules/events/events.js");
var backoff_1 = __webpack_require__(/*! backoff */ "./node_modules/backoff/index.js");
var amazon_ivs_player_1 = __webpack_require__(/*! amazon-ivs-player */ "./node_modules/amazon-ivs-player/dist/index.js");
var BACKOFF_TIMEOUT_MS = 16000;
var BACKOFF_CONFIG = {
    factor: 1.50,
    initialDelay: 1000,
    maxDelay: 8000,
    randomisationFactor: 0.5,
};
var RETRYABLE_ERRORS = {
    404: amazon_ivs_player_1.ErrorType.NOT_AVAILABLE
};
/**
 * [[PlaybackUrlEventObserver]] listens to the vendor player errors after loading the playback url.
 * The observer will then re-emit the events or retry loading the playback url base on the retry policy.
 * @private
 */
var PlaybackUrlEventObserver = /** @class */ (function (_super) {
    __extends(PlaybackUrlEventObserver, _super);
    function PlaybackUrlEventObserver(vendorPlayer, playbackUrl, options) {
        var _this = _super.call(this) || this;
        _this._onError = function (error) {
            var type = RETRYABLE_ERRORS[error.code];
            var isRetryable = !!_this._timer && !!type && type === error.type;
            var hasTimedOut = !!_this._startTime && Date.now() - _this._startTime >= BACKOFF_TIMEOUT_MS;
            if (isRetryable && hasTimedOut) {
                _this._timerDone();
                _this.emit(amazon_ivs_player_1.PlayerEventType.ERROR, error);
                return;
            }
            if (isRetryable) {
                if (!_this._startTime) {
                    _this._startTime = Date.now();
                }
                _this._timer.backoff();
                return;
            }
            // Not retryable. We bubble up.
            _this.emit(amazon_ivs_player_1.PlayerEventType.ERROR, error);
        };
        _this._onRetry = function () {
            _this._vendorPlayer.load(_this._playbackUrl);
        };
        _this._timerDone = function () {
            _this._clearTimer();
            _this._vendorPlayer.removeEventListener(amazon_ivs_player_1.PlayerState.READY, _this._timerDone);
        };
        options = options || {};
        _this._playbackUrl = playbackUrl;
        _this._vendorPlayer = vendorPlayer;
        _this._vendorPlayer.addEventListener(amazon_ivs_player_1.PlayerEventType.ERROR, _this._onError);
        _this._vendorPlayer.addEventListener(amazon_ivs_player_1.PlayerState.READY, _this._timerDone);
        _this._timer = (options.exponentialBackoff || backoff_1.exponential)(BACKOFF_CONFIG);
        _this._timer.on('ready', _this._onRetry);
        return _this;
    }
    PlaybackUrlEventObserver.prototype.release = function () {
        this._clearTimer();
        this.removeAllListeners(amazon_ivs_player_1.PlayerEventType.ERROR);
        this._vendorPlayer.removeEventListener(amazon_ivs_player_1.PlayerState.READY, this._timerDone);
        this._vendorPlayer.removeEventListener(amazon_ivs_player_1.PlayerEventType.ERROR, this._onError);
    };
    PlaybackUrlEventObserver.prototype._clearTimer = function () {
        if (this._timer) {
            this._timer.reset();
            this._timer.removeAllListeners('ready');
            this._timer = null;
        }
    };
    return PlaybackUrlEventObserver;
}(events_1.EventEmitter));
exports.PlaybackUrlEventObserver = PlaybackUrlEventObserver;
//# sourceMappingURL=playbackurl.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/eventobservers/playerposition.js":
/*!***********************************************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/eventobservers/playerposition.js ***!
  \***********************************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.PlayerPositionObserver = void 0;
var events_1 = __webpack_require__(/*! events */ "./node_modules/events/events.js");
var PLAYER_POSITION_SAME_COUNT = 3;
/**
 * [[PlayerPositionObserver]] monitors the [[Player]]'s position while it is
 * in the [[Player.State.Playing]] state, and raises an event if it is the same
 * for the last PLAYER_POSITION_SAME_COUNT continuous samples. This is required
 * when running in Firefox because the [[Player]] does not transition to the
 * [[Player.State.Ended]] state after the MediaProcessor is ended.
 * @private
 */
var PlayerPositionObserver = /** @class */ (function (_super) {
    __extends(PlayerPositionObserver, _super);
    /**
     * @private
     */
    function PlayerPositionObserver(vendorPlayer, telemetry) {
        var _this = _super.call(this) || this;
        _this._onSummary = function (data) {
            var summary = data;
            _this._playerPositions.push(summary.playerPosition);
            _this._playerPositions.splice(0, Number(_this._playerPositions.length > PLAYER_POSITION_SAME_COUNT));
            if (_this._playerPositions.length === PLAYER_POSITION_SAME_COUNT
                && new Set(_this._playerPositions).size === 1) {
                _this._telemetry.unsubscribe(_this._onSummary);
                _this.emit(PlayerPositionObserver.Event.PlayerPositionSame);
            }
        };
        _this._playerPositions = [];
        _this._telemetry = telemetry;
        _this._vendorPlayer = vendorPlayer;
        _this._telemetry.subscribe(_this._onSummary, function (_a) {
            var name = _a.name, type = _a.type;
            return type === 'playback-quality'
                && name === 'summary'
                && _this._vendorPlayer.getState() === 'Playing';
        });
        return _this;
    }
    PlayerPositionObserver.prototype.release = function () {
        this.removeAllListeners(PlayerPositionObserver.Event.PlayerPositionSame);
    };
    return PlayerPositionObserver;
}(events_1.EventEmitter));
exports.PlayerPositionObserver = PlayerPositionObserver;
/**
 * @private
 */
(function (PlayerPositionObserver) {
    /**
     * @private
     */
    var Event;
    (function (Event) {
        Event["PlayerPositionSame"] = "player-position-same";
    })(Event = PlayerPositionObserver.Event || (PlayerPositionObserver.Event = {}));
})(PlayerPositionObserver = exports.PlayerPositionObserver || (exports.PlayerPositionObserver = {}));
exports.PlayerPositionObserver = PlayerPositionObserver;
//# sourceMappingURL=playerposition.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/grant.js":
/*!***********************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/grant.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.getPlaybackGrant = void 0;
var error_1 = __webpack_require__(/*! ./error */ "./node_modules/@twilio/live-player-sdk/es5/error.js");
var util_1 = __webpack_require__(/*! ./util */ "./node_modules/@twilio/live-player-sdk/es5/util.js");
var AccessTokenInvalidError = error_1.Error.AccessTokenInvalidError;
/**
 * Decode the given access token and return the playback grant.
 * @private
 */
function getPlaybackGrant(token) {
    var playbackUrl;
    var streamerSid;
    var requestCredentials;
    try {
        var playbackGrant = JSON.parse(util_1.decodeBase64Str(token.split('.')[1])).grants.player;
        playbackUrl = playbackGrant.playbackUrl;
        streamerSid = playbackGrant.playerStreamerSid;
        requestCredentials = playbackGrant.requestCredentials;
        if (!playbackUrl || !streamerSid || (typeof requestCredentials === 'string'
            && !['omit', 'same-origin', 'include'].includes(requestCredentials))) {
            throw null;
        }
    }
    catch (_a) {
        throw new AccessTokenInvalidError();
    }
    return {
        playbackUrl: playbackUrl,
        requestCredentials: requestCredentials,
        streamerSid: streamerSid,
    };
}
exports.getPlaybackGrant = getPlaybackGrant;
//# sourceMappingURL=grant.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/index.js":
/*!***********************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/index.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Player = void 0;
var mediaplayer_1 = __webpack_require__(/*! ./mediaplayer */ "./node_modules/@twilio/live-player-sdk/es5/mediaplayer.js");
var player_1 = __webpack_require__(/*! ./player */ "./node_modules/@twilio/live-player-sdk/es5/player.js");
Object.defineProperty(exports, "Player", ({ enumerable: true, get: function () { return player_1.Player; } }));
player_1.setDerivedPlayer(mediaplayer_1.MediaPlayer);
player_1.setIsPlayerSupported(mediaplayer_1.isSupported);
window.Twilio = window.Twilio || {};
window.Twilio.Live = window.Twilio.Live || { Player: player_1.Player };
window.Twilio.Live.Player = window.Twilio.Live.Player || player_1.Player;
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/mediaplayer.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/mediaplayer.js ***!
  \*****************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.MediaPlayer = exports.isSupported = void 0;
// TODO(mmalavalli): Ensure only the vendor sdk version is exported, and not the rest of the package.json fields.
var dependencies = (__webpack_require__(/*! ../package.json */ "./node_modules/@twilio/live-player-sdk/package.json").dependencies);
var amazon_ivs_player_1 = __webpack_require__(/*! amazon-ivs-player */ "./node_modules/amazon-ivs-player/dist/index.js");
var error_1 = __webpack_require__(/*! ./error */ "./node_modules/@twilio/live-player-sdk/es5/error.js");
var player_1 = __webpack_require__(/*! ./player */ "./node_modules/@twilio/live-player-sdk/es5/player.js");
var eventobservers_1 = __webpack_require__(/*! ./eventobservers */ "./node_modules/@twilio/live-player-sdk/es5/eventobservers/index.js");
var ErrorCode = player_1.Player.Error.ErrorCode;
var PLAYBACK_QUALITY_SUMMARY_PUBLISH_INTERVAL_MS = 3000;
var IVS_ERRORS = new Map();
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.GENERIC, ErrorCode.PLAYBACK_MEDIA);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.AUTHORIZATION, ErrorCode.PLAYBACK_AUTHORIZATION);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.INVALID_DATA, ErrorCode.PLAYBACK_INVALID_DATA);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.INVALID_PARAMETER, ErrorCode.PLAYBACK_INVALID_PARAMETER);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.INVALID_STATE, ErrorCode.PLAYBACK_INVALID_STATE);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.NETWORK, ErrorCode.PLAYBACK_NETWORK);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.NETWORK_IO, ErrorCode.PLAYBACK_NETWORK_IO);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.NOT_AVAILABLE, ErrorCode.PLAYBACK_STREAM_NOT_AVAILABLE);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.NOT_SUPPORTED, ErrorCode.PLAYBACK_NOT_SUPPORTED);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.NO_SOURCE, ErrorCode.PLAYBACK_NO_SOURCE);
IVS_ERRORS.set(amazon_ivs_player_1.ErrorType.TIMEOUT, ErrorCode.PLAYBACK_TIMEOUT);
var createMediaPlayerWithInternalAPIs = function (config) {
    return amazon_ivs_player_1.create(config);
};
var vendorPlayerVersion = dependencies['amazon-ivs-player'];
/**
 * Whether the SDK supports the browser. The SDK only supports browsers which are
 * capable of running WebAssembly (WASM).
 */
exports.isSupported = amazon_ivs_player_1.isPlayerSupported;
var MediaPlayer = /** @class */ (function (_super) {
    __extends(MediaPlayer, _super);
    function MediaPlayer(playbackUrl, streamerSid, options) {
        return _super.call(this, playbackUrl, streamerSid, createMediaPlayerWithInternalAPIs, __assign(__assign({}, options), { vendorPlayerVersion: vendorPlayerVersion })) || this;
    }
    MediaPlayer.prototype._getState = function () {
        var _a;
        return (_a = {},
            _a[amazon_ivs_player_1.PlayerState.BUFFERING] = player_1.Player.State.Buffering,
            _a[amazon_ivs_player_1.PlayerState.ENDED] = player_1.Player.State.Ended,
            _a[amazon_ivs_player_1.PlayerState.IDLE] = player_1.Player.State.Idle,
            _a[amazon_ivs_player_1.PlayerState.PLAYING] = player_1.Player.State.Playing,
            _a[amazon_ivs_player_1.PlayerState.READY] = player_1.Player.State.Ready,
            _a)[this._vendorPlayer.getState()];
    };
    MediaPlayer.prototype._reemitVendorPlayerEvents = function () {
        var _this = this;
        var getPlaybackQualitySummary = function () { return ({
            name: 'summary',
            playerLiveLatency: _this._vendorPlayer.getLiveLatency(),
            playerPosition: _this._vendorPlayer.getPosition(),
            playerStats: _this.stats,
            playerStreamerSid: _this._streamerSid,
            playerVolume: _this._vendorPlayer.getVolume(),
            timestamp: Date.now(),
            type: 'playback-quality',
        }); };
        var _a = player_1.Player.telemetry.publishPeriodically(getPlaybackQualitySummary, PLAYBACK_QUALITY_SUMMARY_PUBLISH_INTERVAL_MS), startPublishingPlaybackQualitySummary = _a.start, stopPublishingPlaybackQualitySummary = _a.stop;
        var previousState = this.state;
        var onState = function () {
            var state = _this.state;
            _this.emit(player_1.Player.Event.StateChanged, state);
            var stateChanged = {
                from: previousState,
                name: 'changed',
                playerStreamerSid: _this._streamerSid,
                timestamp: Date.now(),
                to: state,
                type: 'playback-state',
            };
            player_1.Player.telemetry.publish(stateChanged);
            previousState = state;
            if (state === player_1.Player.State.Buffering || state === player_1.Player.State.Playing) {
                startPublishingPlaybackQualitySummary();
            }
            else {
                stopPublishingPlaybackQualitySummary();
            }
            if (state === player_1.Player.State.Ended) {
                _this._release();
            }
        };
        Object.values(amazon_ivs_player_1.PlayerState).forEach(function (state) {
            return _this._vendorPlayer.addEventListener(state, onState);
        });
        var previousQuality = this.quality;
        var onQualityChanged = function () {
            var quality = _this.quality;
            _this.emit(player_1.Player.Event.QualityChanged, quality);
            var qualityChanged = {
                from: previousQuality,
                name: 'quality-changed',
                playerLiveLatency: _this._vendorPlayer.getLiveLatency(),
                playerPosition: _this._vendorPlayer.getPosition(),
                playerStreamerSid: _this._streamerSid,
                playerVolume: _this._vendorPlayer.getVolume(),
                timestamp: Date.now(),
                to: quality,
                type: 'playback-quality',
            };
            player_1.Player.telemetry.publish(qualityChanged);
            previousQuality = quality;
        };
        this._vendorPlayer.addEventListener(amazon_ivs_player_1.PlayerEventType.QUALITY_CHANGED, onQualityChanged);
        var previousDuration = this.duration;
        var onDurationChanged = function (duration) {
            _this.emit(player_1.Player.Event.DurationChanged, duration);
            var durationChanged = {
                from: previousDuration,
                name: 'duration-changed',
                playerLiveLatency: _this._vendorPlayer.getLiveLatency(),
                playerPosition: _this._vendorPlayer.getPosition(),
                playerStreamerSid: _this._streamerSid,
                playerVolume: _this._vendorPlayer.getVolume(),
                timestamp: Date.now(),
                to: duration,
                type: 'playback-quality',
            };
            player_1.Player.telemetry.publish(durationChanged);
            previousDuration = duration;
        };
        this._vendorPlayer.addEventListener(amazon_ivs_player_1.PlayerEventType.DURATION_CHANGED, onDurationChanged);
        var onTextMetadataCue = function (textCue) {
            _this.emit(player_1.Player.Event.TimedMetadataReceived, {
                metadata: textCue.text,
                time: textCue.startTime,
            });
            var timedMetadataReceived = {
                name: 'received',
                playerStreamerSid: _this._streamerSid,
                timedMetadataTime: textCue.startTime,
                timestamp: Date.now(),
                type: 'timed-metadata',
            };
            player_1.Player.telemetry.publish(timedMetadataReceived);
        };
        this._vendorPlayer.addEventListener(amazon_ivs_player_1.PlayerEventType.TEXT_METADATA_CUE, onTextMetadataCue);
        var onRebuffering = function () {
            _this.emit(player_1.Player.Event.Rebuffering);
            var rebuffering = {
                name: 'rebuffering',
                playerPosition: _this._vendorPlayer.getPosition(),
                playerState: _this._getState(),
                playerStreamerSid: _this._streamerSid,
                timestamp: Date.now(),
                type: 'playback',
            };
            player_1.Player.telemetry.publish(rebuffering);
        };
        this._vendorPlayer.addEventListener(amazon_ivs_player_1.PlayerEventType.REBUFFERING, onRebuffering);
        var onError = function (_a) {
            var code = _a.code, message = _a.message, source = _a.source, type = _a.type;
            _this._disconnect();
            var errorExplanation = code + " - " + message + " - " + source;
            var error = error_1.createError(IVS_ERRORS.get(type), message, errorExplanation);
            _this._emitPlaybackError(error);
        };
        if (!this._playbackUrlEventObserver) {
            this._playbackUrlEventObserver = new eventobservers_1.PlaybackUrlEventObserver(this._vendorPlayer, this._playbackUrl);
        }
        this._playbackUrlEventObserver.on(amazon_ivs_player_1.PlayerEventType.ERROR, onError);
        var onVolumeChanged = function (level) { return _this.emit(player_1.Player.Event.VolumeChanged, level); };
        this._vendorPlayer.addEventListener(amazon_ivs_player_1.PlayerEventType.VOLUME_CHANGED, onVolumeChanged);
        var onSeekCompleted = function (position) {
            _this.emit(player_1.Player.Event.SeekCompleted, position);
            var seekCompleted = {
                name: 'seek-completed',
                playerPosition: _this._vendorPlayer.getPosition(),
                playerState: _this._getState(),
                playerStreamerSid: _this._streamerSid,
                timestamp: Date.now(),
                type: 'playback',
            };
            player_1.Player.telemetry.publish(seekCompleted);
        };
        this._vendorPlayer.addEventListener(amazon_ivs_player_1.PlayerEventType.SEEK_COMPLETED, onSeekCompleted);
        return function () {
            stopPublishingPlaybackQualitySummary();
            Object.values(amazon_ivs_player_1.PlayerState).forEach(function (state) {
                return _this._vendorPlayer.removeEventListener(state, onState);
            });
            _this._vendorPlayer.removeEventListener(amazon_ivs_player_1.PlayerEventType.QUALITY_CHANGED, onQualityChanged);
            _this._vendorPlayer.removeEventListener(amazon_ivs_player_1.PlayerEventType.DURATION_CHANGED, onDurationChanged);
            _this._vendorPlayer.removeEventListener(amazon_ivs_player_1.PlayerEventType.TEXT_METADATA_CUE, onTextMetadataCue);
            _this._vendorPlayer.removeEventListener(amazon_ivs_player_1.PlayerEventType.REBUFFERING, onRebuffering);
            _this._vendorPlayer.removeEventListener(amazon_ivs_player_1.PlayerEventType.VOLUME_CHANGED, onVolumeChanged);
            _this._vendorPlayer.removeEventListener(amazon_ivs_player_1.PlayerEventType.SEEK_COMPLETED, onSeekCompleted);
            if (_this._playbackUrlEventObserver) {
                _this._playbackUrlEventObserver.release();
            }
        };
    };
    return MediaPlayer;
}(player_1.Player));
exports.MediaPlayer = MediaPlayer;
//# sourceMappingURL=mediaplayer.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/player.js":
/*!************************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/player.js ***!
  \************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Player = exports.setIsPlayerSupported = exports.setDerivedPlayer = void 0;
// TODO(mmalavalli): Ensure only the version is exported, and not the rest of the package.json fields.
var sdkVersion = (__webpack_require__(/*! ../package.json */ "./node_modules/@twilio/live-player-sdk/package.json").version);
var events_1 = __webpack_require__(/*! events */ "./node_modules/events/events.js");
var grant_1 = __webpack_require__(/*! ./grant */ "./node_modules/@twilio/live-player-sdk/es5/grant.js");
var eventobservers_1 = __webpack_require__(/*! ./eventobservers */ "./node_modules/@twilio/live-player-sdk/es5/eventobservers/index.js");
var error_1 = __webpack_require__(/*! ./error */ "./node_modules/@twilio/live-player-sdk/es5/error.js");
var TelemetryExports = __webpack_require__(/*! ./telemetry */ "./node_modules/@twilio/live-player-sdk/es5/telemetry.js");
// NOTE(mmalavalli): This represents the class derived from Player that
// actually consumes the vendor sdk. For unit tests, this can be set to
// a mock class using setDerivedPlayer().
var DerivedPlayer;
/**
 * @private
 */
function setDerivedPlayer(Class) {
    if (typeof DerivedPlayer === 'undefined') {
        DerivedPlayer = Class;
    }
}
exports.setDerivedPlayer = setDerivedPlayer;
// NOTE(csantos): Represents whether HighLatencyReduction is enabled
// for all Player instances.
var isHighLatencyReductionEnabled = true;
// NOTE(mmalavalli): This represents whether the browser is supported
// by the vendor sdk. For unit tests, this can be set to a mock value
// using setIsPlayerSupported().
var isPlayerSupported;
/**
 * @private
 */
function setIsPlayerSupported(value) {
    if (typeof isPlayerSupported === 'undefined') {
        isPlayerSupported = value;
    }
}
exports.setIsPlayerSupported = setIsPlayerSupported;
// NOTE(mmalavalli): This represents the Telemetry logger for all the
// Player instances.
var telemetry = new TelemetryExports.Telemetry();
/**
 * A [[Player]] controls the playback of a live stream.
 */
var Player = /** @class */ (function (_super) {
    __extends(Player, _super);
    function Player(playbackUrl, streamerSid, createVendorPlayer, options) {
        var _this = _super.call(this) || this;
        _this._onVideoSizeChanged = function () {
            _this.emit(Player.Event.VideoSizeChanged, _this.videoSize);
            var videoSizeChanged = {
                from: _this._previousVideoSize,
                name: 'video-size-changed',
                playerLiveLatency: _this._vendorPlayer.getLiveLatency(),
                playerPosition: _this._vendorPlayer.getPosition(),
                playerStreamerSid: _this._streamerSid,
                playerVolume: _this._vendorPlayer.getVolume(),
                timestamp: Date.now(),
                to: _this.videoSize,
                type: 'playback-quality',
            };
            telemetry.publish(videoSizeChanged);
            _this._previousVideoSize = __assign({}, _this.videoSize);
        };
        var playerWasmAssetsPath = options.playerWasmAssetsPath, _a = options.rebufferToLive, rebufferToLive = _a === void 0 ? true : _a, requestCredentials = options.requestCredentials, vendorPlayerVersion = options.vendorPlayerVersion;
        var suffix = vendorPlayerVersion.replace(/\./g, '-');
        _this._disconnected = false;
        _this._playbackUrl = playbackUrl;
        _this._streamerSid = streamerSid;
        _this._vendorPlayer = createVendorPlayer({
            wasmBinary: playerWasmAssetsPath + "/twilio-live-player-wasmworker-" + suffix + ".min.wasm",
            wasmWorker: playerWasmAssetsPath + "/twilio-live-player-wasmworker-" + suffix + ".min.js",
        });
        // NOTE(mmalavalli): Configuring the default HTMLVideoElement for inline
        // playback on iOS Safari.
        var videoElement = _this._vendorPlayer.getHTMLVideoElement();
        videoElement.playsInline = true;
        _this._vendorPlayer.setLogLevel(Player.logLevel);
        vendorPlayers.add(_this._vendorPlayer);
        _this._vendorPlayer.setRebufferToLive(rebufferToLive);
        _this.videoElement.addEventListener('resize', _this._onVideoSizeChanged);
        _this._previousVideoSize = __assign({}, _this.videoSize);
        _this._stopRemittingVendorPlayerEvents = _this._reemitVendorPlayerEvents();
        if (requestCredentials) {
            _this._vendorPlayer.setRequestCredentials(requestCredentials);
        }
        _this._vendorPlayer.load(playbackUrl);
        _this._liveLatencyEventObserver = new eventobservers_1.LiveLatencyEventObserver(_this._vendorPlayer, telemetry, isHighLatencyReductionEnabled);
        _this._playerPositionObserver = new eventobservers_1.PlayerPositionObserver(_this._vendorPlayer, telemetry);
        _this._playerPositionObserver.once(eventobservers_1.PlayerPositionObserver.Event.PlayerPositionSame, function () { return _this._disconnect(); });
        _this._handleLiveLatencyEvents();
        return _this;
    }
    Object.defineProperty(Player, "isHighLatencyReductionEnabled", {
        /**
         * Whether high latency reduction is enabled for all Player instances.
         * This is set to `true` by default.
         * When set to `true`, the Player SDK will periodiocally inspect `player.liveLatency`
         * and perform the following when high latency is observed:
         *
         *   1. If the live latency is between 3 and 5 seconds, the Player will increase
         * the playback rate to a value that should not be perceptible to a user.
         * The increased playback rate will allow the Player to catch up to the live source,
         * and will be reverted once the live latency drops below 3 seconds.
         * Application of this strategy may result in audio pitch distortion.
         *
         *   2. If the live latency is greater than or equal to 5 seconds,
         * the Player will seek ahead to near the end of the Player's buffered content.
         * The user will notice skips in the media content when this strategy is applied.
         */
        get: function () {
            return isHighLatencyReductionEnabled;
        },
        /**
         * Sets whether high latency reduction is enabled for all Player instances.
         * When set to `true`, the Player SDK will periodiocally inspect `player.liveLatency`
         * and perform the following when high latency is observed:
         *
         *   1. If the live latency is between 3 and 5 seconds, the Player will increase
         * the playback rate to a value that should not be perceptible to a user.
         * The increased playback rate will allow the Player to catch up to the live source,
         * and will be reverted once the live latency drops below 3 seconds.
         * Application of this strategy may result in audio pitch distortion.
         *
         *   2. If the live latency is greater than or equal to 5 seconds,
         * the Player will seek ahead to near the end of the Player's buffered content.
         * The user will notice skips in the media content when this strategy is applied.
         */
        set: function (isEnabled) {
            isHighLatencyReductionEnabled = isEnabled;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player, "isSupported", {
        /**
         * Whether the SDK supports the browser. The SDK only supports
         * browsers which are capable of running WebAssembly (WASM).
         */
        get: function () {
            return isPlayerSupported;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player, "logLevel", {
        /**
         * The SDK's log level.
         */
        get: function () {
            return logLevel;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player, "telemetry", {
        /**
         * A [[Telemetry]] provides facilities for subscribing to event
         * and metric data collected by the SDK.
         */
        get: function () {
            return telemetry;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player, "version", {
        /**
         * The SDK version.
         */
        get: function () {
            return sdkVersion;
        },
        enumerable: false,
        configurable: true
    });
    /**
     * Connect to a live stream.
     * @throws [[Player.Error]] or TypeError
     * @param token The access token used to connect to the live stream
     * @param options The options for creating a [[Player]]
     */
    Player.connect = function (token, options) {
        return __awaiter(this, void 0, void 0, function () {
            var connecting, _a, playbackUrl, playerStreamerSid, requestCredentials, connected, connectionError;
            return __generator(this, function (_b) {
                connecting = {
                    name: 'connecting',
                    playerStreamerSid: '',
                    timestamp: Date.now(),
                    type: 'connection',
                };
                telemetry.publish(connecting);
                try {
                    _a = grant_1.getPlaybackGrant(token), playbackUrl = _a.playbackUrl, playerStreamerSid = _a.streamerSid, requestCredentials = _a.requestCredentials;
                    connected = {
                        name: 'connected',
                        playerStreamerSid: playerStreamerSid,
                        requestCredentials: requestCredentials,
                        timestamp: Date.now(),
                        type: 'connection',
                    };
                    telemetry.publish(connected);
                    return [2 /*return*/, new DerivedPlayer(playbackUrl, playerStreamerSid, __assign(__assign({}, options), { requestCredentials: requestCredentials }))];
                }
                catch (error) {
                    connectionError = {
                        name: 'error',
                        playerError: error,
                        playerStreamerSid: '',
                        timestamp: Date.now(),
                        type: 'connection',
                    };
                    telemetry.publish(connectionError);
                    throw error;
                }
                return [2 /*return*/];
            });
        });
    };
    /**
     * Set the SDK's log level.
     */
    Player.setLogLevel = function (level) {
        logLevel = level;
        var vendorPlayerLogLevel = level === Player.LogLevel.Off
            ? Player.LogLevel.Error : level;
        vendorPlayers.forEach(function (vendorPlayer) {
            return vendorPlayer.setLogLevel(vendorPlayerLogLevel);
        });
    };
    Object.defineProperty(Player.prototype, "availableQualities", {
        /**
         * Array of available [[Quality]] objects from the loaded source, or empty if
         * none are currently available. The qualities will be available after the
         * [[Player]] transitions to the [[State.Ready]] state. Note that this set will
         * contain only qualities capable of being played on the current device and not
         * all those present in the source stream.
         */
        get: function () {
            return this._vendorPlayer.getQualities().map(function (_a) {
                var bitrate = _a.bitrate, codecs = _a.codecs, height = _a.height, name = _a.name, width = _a.width;
                return ({
                    bitrate: bitrate,
                    codecs: codecs,
                    height: height,
                    name: name,
                    width: width,
                });
            });
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "duration", {
        /**
         * The playback duration in seconds. The duration is `Infinity`
         * if the media is a live stream. A [[Player.Event.DurationChanged]] is emitted
         * whenever the playback duration changes.
         */
        get: function () {
            return this._vendorPlayer.getDuration();
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "isMuted", {
        /**
         * Whether the [[Player]] is muted. You can also mute the [[Player]] by setting
         * it to true, or unmute by setting it to false. Updating this property has no
         * effect once the [[Player]] transitions to the [[Player.State.Ended]] state.
         */
        get: function () {
            return this._vendorPlayer.isMuted();
        },
        set: function (shouldMute) {
            this._vendorPlayer.setMuted(shouldMute);
            var playback = {
                name: shouldMute ? 'muted' : 'unmuted',
                playerPosition: this._vendorPlayer.getPosition(),
                playerState: this._getState(),
                playerStreamerSid: this._streamerSid,
                timestamp: Date.now(),
                type: 'playback',
            };
            telemetry.publish(playback);
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "liveLatency", {
        /**
         * For a live stream, the latency to the source in seconds.
         */
        get: function () {
            return this._vendorPlayer.getLiveLatency();
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "position", {
        /**
         * The playback position in seconds.
         */
        get: function () {
            return this._vendorPlayer.getPosition();
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "quality", {
        /**
         * The current quality of the [[Player]]'s live stream. You
         * can also change the quality of the live stream by setting
         * a new [[Player.Quality]] from [[Player.availableQualities]].
         * The [[Player]] will emit a [[Player.Event.QualityChanged]] event.
         */
        get: function () {
            var _a = this._vendorPlayer.getQuality(), bitrate = _a.bitrate, codecs = _a.codecs, height = _a.height, name = _a.name, width = _a.width;
            return {
                bitrate: bitrate,
                codecs: codecs,
                height: height,
                name: name,
                width: width,
            };
        },
        set: function (newQuality) {
            var vendorPlayerQuality = this._vendorPlayer.getQualities().find(function (quality) {
                return quality.name === newQuality.name;
            });
            if (vendorPlayerQuality) {
                var oldQuality = this.quality;
                this._vendorPlayer.setQuality(vendorPlayerQuality);
                var qualitySet = {
                    from: oldQuality,
                    name: 'quality-set',
                    playerLiveLatency: this._vendorPlayer.getLiveLatency(),
                    playerPosition: this._vendorPlayer.getPosition(),
                    playerStreamerSid: this._streamerSid,
                    playerVolume: this._vendorPlayer.getVolume(),
                    timestamp: Date.now(),
                    to: newQuality,
                    type: 'playback-quality',
                };
                Player.telemetry.publish(qualitySet);
            }
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "state", {
        /**
         * The [[Player]] state. Soon after a successful connection to a live stream,
         * the [[Player]] is in the [[Player.State.Idle]] state while it is preparing
         * the playback. Then it transitions to the [[Player.State.Ready]] state.
         */
        get: function () {
            return this._disconnected ? Player.State.Ended : this._getState();
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "stats", {
        /**
         * The media statistics of the [[Player]]'s live stream.
         */
        get: function () {
            return {
                videoBitrate: this._vendorPlayer.getVideoBitRate() || 0,
                videoFramesDecoded: this._vendorPlayer.getDecodedFrames() || 0,
                videoFramesDropped: this._vendorPlayer.getDroppedFrames() || 0,
            };
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "streamerSid", {
        /**
         * The SID of the [PlayerStreamer](https://www.twilio.com/docs/live/playerstreamers)
         * which the [[Player]] is connected to.
         */
        get: function () {
            return this._streamerSid;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "videoElement", {
        /**
         * The HTMLVideoElement used to play back the live stream.
         */
        get: function () {
            return this._vendorPlayer.getHTMLVideoElement();
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "videoSize", {
        /**
         * The [[Player]]'s video size.
         */
        get: function () {
            var _a = this.videoElement, height = _a.videoHeight, width = _a.videoWidth;
            return { height: height, width: width };
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Player.prototype, "volume", {
        /**
         * The [[Player]]'s volume level in the range [0.0, 1.0].
         */
        get: function () {
            return this._vendorPlayer.getVolume();
        },
        enumerable: false,
        configurable: true
    });
    /**
     * Set an HTMLVideoElement to play back the live stream. For iOS browsers,
     * please enable inline playback before attaching the HTMLVideoElement.
     * @example
     * ```
     * const videoElement = document.querySelector('div#container > video');
     * videoElement.playsInline = true;
     * player.attach(videoElement);
     * ```
     * @param videoElement The HTMLVideoElement to be used to play back the live stream
     */
    Player.prototype.attach = function (videoElement) {
        this.videoElement.removeEventListener('resize', this._onVideoSizeChanged);
        this._vendorPlayer.attachHTMLVideoElement(videoElement);
        videoElement.addEventListener('resize', this._onVideoSizeChanged);
        return this;
    };
    /**
     * Disconnect from the live stream. The [[Player]] will transition to the terminal
     * [[Player.State.Ended]] state, release all resources related to the playback of the
     * live stream, and stop emitting events.
     */
    Player.prototype.disconnect = function () {
        if (!this._disconnect()) {
            return this;
        }
        var disconnected = {
            name: 'disconnected',
            playerStreamerSid: this._streamerSid,
            timestamp: Date.now(),
            type: 'connection',
        };
        telemetry.publish(disconnected);
        return this;
    };
    /**
     * Pause the [[Player]]'s live stream. The [[Player]] transitions
     * to the [[Player.State.Idle]] state.
     */
    Player.prototype.pause = function () {
        this._vendorPlayer.pause();
        var paused = {
            name: 'paused',
            playerPosition: this._vendorPlayer.getPosition(),
            playerState: this._getState(),
            playerStreamerSid: this._streamerSid,
            timestamp: Date.now(),
            type: 'playback',
        };
        telemetry.publish(paused);
        return this;
    };
    /**
     * Start the playback of the [[Player]]'s live stream. The [[Player]]
     * may transition to the [[Player.State.Buffering]] state if it is buffering
     * media for playback, and will finally transition to the [[Player.State.Playing]]
     * state.
     *
     * Calling this method before [[Player.state]] transitions to [[Player.State.Ready]]
     * will not have any effect.
     */
    Player.prototype.play = function () {
        this._vendorPlayer.play();
        var played = {
            name: 'played',
            playerPosition: this._vendorPlayer.getPosition(),
            playerState: this._getState(),
            playerStreamerSid: this._streamerSid,
            timestamp: Date.now(),
            type: 'playback',
        };
        telemetry.publish(played);
        return this;
    };
    /**
     * Instruct the Player to seek to a specified time in the stream and begins
     * playing media in that position. The player state might change to buffering
     * if there is not enough buffered content in the specified position. This method is
     * asynchronous and a [[Player.Event.SeekCompleted]] is emitted upon completion.
     * This is only supported for recorded media and will emit a [[Player.Error]] if invoked on a live media.
     * @throws [[Player.Error]]
     * @param position
     */
    Player.prototype.seekTo = function (position) {
        // NOTE(csantos): We only support seeking for VOD/Recorded media.
        // A media is considered VOD (Video on Demand) if the playlist is tagged as VOD.
        // If VOD tag exists, the player duration is Finite, otherwise Infinity.
        var duration = this._vendorPlayer.getDuration();
        var isVOD = typeof duration === 'number' && isFinite(duration) && duration > 0;
        if (!isVOD) {
            var error = new Player.Error.PlaybackNotSupportedError();
            this._emitPlaybackError(error);
            throw error;
        }
        if (position < 0 || position > this._vendorPlayer.getDuration() || typeof position !== 'number') {
            var error = new Player.Error.PlaybackInvalidParameterError('position must be in the range [0, player.duration]');
            this._emitPlaybackError(error);
            throw error;
        }
        if (position === this._vendorPlayer.getDuration()) {
            // NOTE(csantos): Move near the end to get the ended event
            position = this._vendorPlayer.getDuration() - 1;
        }
        var currentPosition = this._vendorPlayer.getPosition();
        this._vendorPlayer.seekTo(position);
        var seekToData = {
            from: currentPosition,
            name: 'seek-to',
            playerPosition: this._vendorPlayer.getPosition(),
            playerState: this._getState(),
            playerStreamerSid: this._streamerSid,
            timestamp: Date.now(),
            to: position,
            type: 'playback',
        };
        telemetry.publish(seekToData);
        return this;
    };
    /**
     * Set the [[Player]]'s volume level in the range [0.0, 1.0]. The [[Player.volume]]
     * property will be updated asynchronously and a [[Player.Event.VolumeChanged]] is emitted
     * with the updated volume. A [[Player.Error]] will be emitted for any invalid parameters.
     * @throws [[Player.Error]]
     * @param level
     */
    Player.prototype.setVolume = function (level) {
        if (level < 0 || level > 1 || typeof level !== 'number') {
            var error = new Player.Error.PlaybackInvalidParameterError('Volume must be in the range [0, 1]');
            this._emitPlaybackError(error);
            throw error;
        }
        var previousLevel = this._vendorPlayer.getVolume();
        this._vendorPlayer.setVolume(level);
        var volumeSet = {
            from: previousLevel,
            name: 'volume-set',
            playerPosition: this._vendorPlayer.getPosition(),
            playerState: this._getState(),
            playerStreamerSid: this._streamerSid,
            timestamp: Date.now(),
            to: level,
            type: 'playback',
        };
        telemetry.publish(volumeSet);
        return this;
    };
    Player.prototype._disconnect = function () {
        if (this._disconnected) {
            return false;
        }
        this._disconnected = true;
        this.emit(Player.Event.StateChanged, this.state);
        this._release();
        return true;
    };
    Player.prototype._emitPlaybackError = function (error) {
        this.emit(Player.Event.Error, error);
        var playbackError = {
            name: 'error',
            playerError: error,
            playerPosition: this._vendorPlayer.getPosition(),
            playerState: this._getState(),
            playerStreamerSid: this._streamerSid,
            timestamp: Date.now(),
            type: 'playback',
        };
        telemetry.publish(playbackError);
        return this;
    };
    Player.prototype._release = function () {
        this._liveLatencyEventObserver.release();
        this._playerPositionObserver.release();
        this.videoElement.removeEventListener('resize', this._onVideoSizeChanged);
        this._stopRemittingVendorPlayerEvents();
        this._vendorPlayer.delete();
        vendorPlayers.delete(this._vendorPlayer);
        return this;
    };
    Player.prototype._handleLiveLatencyEvents = function () {
        var _this = this;
        var getData = function (name) { return ({
            name: name,
            playerLiveLatency: _this._vendorPlayer.getLiveLatency(),
            playerPosition: _this._vendorPlayer.getPosition(),
            playerStreamerSid: _this._streamerSid,
            playerVolume: _this._vendorPlayer.getVolume(),
            timestamp: Date.now(),
            type: 'playback-quality',
        }); };
        this._liveLatencyEventObserver.on(eventobservers_1.LiveLatencyEventObserver.Event.HighLatencyReductionReverted, function () { return telemetry.publish(getData('high-latency-reduction-reverted')); });
        this._liveLatencyEventObserver.on(eventobservers_1.LiveLatencyEventObserver.Event.IncreasePlaybackRate, function () { return telemetry.publish(getData('increase-playback-rate')); });
        this._liveLatencyEventObserver.on(eventobservers_1.LiveLatencyEventObserver.Event.SeekAhead, function () { return telemetry.publish(getData('seek-ahead')); });
    };
    return Player;
}(events_1.EventEmitter));
exports.Player = Player;
(function (Player) {
    /**
     * Description of an error that was encountered while connecting to
     * or playing back a live stream.
     */
    Player.Error = error_1.Error;
    /**
     * [[Player]] events.
     */
    var Event;
    (function (Event) {
        /**
         * The [[Player.duration]] property has changed.
         */
        Event["DurationChanged"] = "durationChanged";
        /**
         * The [[Player]] encountered an error while playing back the live stream.
         * The playback is stopped and the [[Player]] transitions to the [[Player.State.Ended]]
         * state.
         */
        Event["Error"] = "error";
        /**
         * The [[Player]]'s playback quality changed.
         */
        Event["QualityChanged"] = "qualityChanged";
        /**
         * The [[Player]] is rebuffering from a previous [[State.Playing]] state.
         */
        Event["Rebuffering"] = "rebuffering";
        /**
         * The player seeked to a given position (as requested by [[Player.seekTo]]).
         */
        Event["SeekCompleted"] = "seekCompleted";
        /**
         * The [[Player]]'s state changed.
         */
        Event["StateChanged"] = "stateChanged";
        /**
         * The [[Player]] received a [[TimedMetadata]] in the live stream.
         */
        Event["TimedMetadataReceived"] = "timedMetadataReceived";
        /**
         * The [[Player]]'s video size changed.
         */
        Event["VideoSizeChanged"] = "videoSizeChanged";
        /**
         * The [[Player]]'s volume level changed.
         */
        Event["VolumeChanged"] = "volumeChanged";
    })(Event = Player.Event || (Player.Event = {}));
    /**
     * Available log levels for the [[Player]].
     */
    var LogLevel;
    (function (LogLevel) {
        LogLevel["Debug"] = "debug";
        LogLevel["Error"] = "error";
        LogLevel["Info"] = "info";
        LogLevel["Off"] = "off";
        LogLevel["Warn"] = "warn";
    })(LogLevel = Player.LogLevel || (Player.LogLevel = {}));
    /**
     * [[Player]] states.
     */
    var State;
    (function (State) {
        /**
         * The [[Player]] is buffering.
         */
        State["Buffering"] = "buffering";
        /**
         * The [[Player]] has ended the playback of the live stream.
         */
        State["Ended"] = "ended";
        /**
         * The [[Player]] is idle.
         */
        State["Idle"] = "idle";
        /**
         * The [[Player]] is playing back the live stream.
         */
        State["Playing"] = "playing";
        /**
         * The [[Player]] is ready to play back the live stream.
         */
        State["Ready"] = "ready";
    })(State = Player.State || (Player.State = {}));
    /**
     * A [[Telemetry]] provides facilities for subscribing to event
     * and metric data published by the SDK.
     */
    Player.Telemetry = TelemetryExports.Telemetry;
})(Player = exports.Player || (exports.Player = {}));
exports.Player = Player;
// NOTE(mmalavalli): This represents the current log level of the SDK
// and is accessed by Player.logLevel and set by Player.setLogLevel().
var logLevel = Player.LogLevel.Error;
// NOTE(mmalavalli): This contains the VendorPlayer instances created so
// far. Whenever Player.logLevel is updated, the log levels of the VendorPlayer
// instances are updated as well.
var vendorPlayers = new Set();
//# sourceMappingURL=player.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/telemetry.js":
/*!***************************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/telemetry.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Telemetry = void 0;
/**
 * A [[Telemetry]] provides facilities for subscribing to event
 * and metric data collected by the SDK.
 */
var Telemetry = /** @class */ (function () {
    /**
     * @private
     */
    function Telemetry() {
        this._subscribersToPredicates = new Map();
    }
    /**
     * @private
     */
    Telemetry.prototype.publish = function (data) {
        this._subscribersToPredicates.forEach(function (predicate, subscriber) {
            if (predicate(data)) {
                subscriber(data);
            }
        });
        return this;
    };
    /**
     * @private
     */
    Telemetry.prototype.publishPeriodically = function (getData, periodMs) {
        var _this = this;
        var stop = function () {
            if (interval !== null) {
                clearInterval(interval);
                interval = null;
            }
        };
        var start = function () {
            if (interval === null) {
                interval = setInterval(function () { return _this.publish(getData()); }, periodMs);
            }
        };
        var interval = null;
        return { start: start, stop: stop };
    };
    /**
     * Subscribe to the published [[Telemetry.Data]] objects that satisfy the given
     * [[Telemetry.Predicate]]. If no [[Telemetry.Predicate]] is provided, all
     * [[Telemetry.Data]] objects will be subscribed to.
     * @param subscriber Consumer of the published [[Telemetry.Data]] objects
     * @param predicate The filter applied to the published [[Telemetry.Data]] objects
     */
    Telemetry.prototype.subscribe = function (subscriber, predicate) {
        this._subscribersToPredicates.set(subscriber, predicate || (function () { return true; }));
        return this;
    };
    /**
     * Unsubscribe from the [[Telemetry.Data]] objects.
     * @param subscriber Consumer of the published [[Telemetry.Data]] objects
     */
    Telemetry.prototype.unsubscribe = function (subscriber) {
        this._subscribersToPredicates.delete(subscriber);
        return this;
    };
    return Telemetry;
}());
exports.Telemetry = Telemetry;
//# sourceMappingURL=telemetry.js.map

/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/es5/util.js":
/*!**********************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/es5/util.js ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.decodeBase64Str = void 0;
var safe_buffer_1 = __webpack_require__(/*! safe-buffer */ "./node_modules/safe-buffer/index.js");
/**
 * @private
 * Decodes a base64 string. This is a more robust implementation of window.atob
 * which should be able to handle unicode problems using node buffers.
 */
function decodeBase64Str(base64Str) {
    return safe_buffer_1.Buffer.from(base64Str, 'base64').toString();
}
exports.decodeBase64Str = decodeBase64Str;
//# sourceMappingURL=util.js.map

/***/ }),

/***/ "./node_modules/amazon-ivs-player/dist/index.js":
/*!******************************************************!*\
  !*** ./node_modules/amazon-ivs-player/dist/index.js ***!
  \******************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/*!
 * Amazon Interactive Video Service (IVS) Player for Web v1.7.0
 * Copyright Amazon.com, Inc. or its affiliates. All Rights Reserved.
 * License at https://player.live-video.net/LICENSE.txt
 */
module.exports=function(e){var t={};function i(n){if(t[n])return t[n].exports;var r=t[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,i),r.l=!0,r.exports}return i.m=e,i.c=t,i.d=function(e,t,n){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(i.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)i.d(n,r,function(t){return e[t]}.bind(null,r));return n},i.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="",i(i.s=40)}([function(e,t){e.exports=__webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/@babel/runtime/helpers/defineProperty.js")},function(e,t,i){"use strict";i.d(t,"c",(function(){return o})),i.d(t,"d",(function(){return s})),i.d(t,"f",(function(){return a})),i.d(t,"a",(function(){return u})),i.d(t,"i",(function(){return c})),i.d(t,"e",(function(){return d})),i.d(t,"h",(function(){return h})),i.d(t,"g",(function(){return l})),i.d(t,"b",(function(){return f}));var n=i(7),r=i(4);function o(e){return"number"==typeof e.webkitDecodedFrameCount?e.webkitDecodedFrameCount:"function"==typeof e.getVideoPlaybackQuality?e.getVideoPlaybackQuality().totalVideoFrames:"number"==typeof e.mozDecodedFrames?e.mozDecodedFrames:-1}function s(e){return"number"==typeof e.webkitDroppedFrameCount?e.webkitDroppedFrameCount:"function"==typeof e.getVideoPlaybackQuality?e.getVideoPlaybackQuality().droppedVideoFrames:-1}function a(e,t){for(var i=0;i<t.length;i++)console.info(e,"start: ",t.start(i),", end: ",t.end(i))}function u(e,t,i){for(var n=0;n<e.length;n++){var r=e.start(n),o=e.end(n);if(!(o<=t)){if(r-i>t)break;for(var s=n+1;s<e.length&&!(e.start(s)-o>i);s++)o=e.end(s);for(var a=n-1;a>=0&&!(r-e.end(a)>i);a--)r=e.start(a);return{start:Math.min(r,t),end:o}}}return{start:t,end:t}}function c(e,t){var i=u(e.buffered,e.currentTime,t).end,n=e.currentTime,r=i-n;return!(e.ended||e.duration-n<t)&&r<t}function d(e,t,i){void 0===i&&(i=r.d);var n=u(e,t,i).end-t>i;if(e.length>1||!n)for(var o=0;o<e.length;o++){var s=e.start(o),a=e.end(o);if(t<s&&a-s>i)return s+i}return n?t+i:t}function h(e,t,i){return e.addEventListener(t,i),function(){e.removeEventListener(t,i)}}function l(e){if(e.src){var t=e.src;n.b(e),e.load(),URL.revokeObjectURL(t)}}function f(e,t){var i=e.playbackRate,n=e.src;n&&URL.revokeObjectURL(n),e.src=t,e.playbackRate=i}},function(e,t){e.exports=__webpack_require__(/*! @babel/runtime/helpers/assertThisInitialized */ "./node_modules/@babel/runtime/helpers/assertThisInitialized.js")},function(e,t,i){"use strict";var n;i.d(t,"a",(function(){return n})),function(e){e.INITIALIZED="PlayerInitialized",e.QUALITY_CHANGED="PlayerQualityChanged",e.DURATION_CHANGED="PlayerDurationChanged",e.VOLUME_CHANGED="PlayerVolumeChanged",e.MUTED_CHANGED="PlayerMutedChanged",e.PLAYBACK_RATE_CHANGED="PlayerPlaybackRateChanged",e.REBUFFERING="PlayerRebuffering",e.AUDIO_BLOCKED="PlayerAudioBlocked",e.PLAYBACK_BLOCKED="PlayerPlaybackBlocked",e.ERROR="PlayerError",e.RECOVERABLE_ERROR="PlayerRecoverableError",e.ANALYTICS_EVENT="PlayerAnalyticsEvent",e.TIME_UPDATE="PlayerTimeUpdate",e.BUFFER_UPDATE="PlayerBufferUpdate",e.SEEK_COMPLETED="PlayerSeekCompleted",e.SESSION_DATA="PlayerSessionData",e.STATE_CHANGED="PlayerStateChanged",e.WORKER_ERROR="PlayerWorkerError",e.METADATA="PlayerMetadata",e.TEXT_CUE="PlayerTextCue",e.TEXT_METADATA_CUE="PlayerTextMetadataCue",e.AD_CUE="PlayerAdCue",e.STREAM_SOURCE_CUE="PlayerStreamSourceCue",e.NETWORK_UNAVAILABLE="PlayerNetworkUnavailable",e.SEGMENT_METADATA="PlayerSegmentMetadata"}(n||(n={}))},function(e,t,i){"use strict";i.d(t,"d",(function(){return n})),i.d(t,"b",(function(){return r})),i.d(t,"a",(function(){return o})),i.d(t,"c",(function(){return s}));var n=.1,r=1<<30,o=12e4,s=3e3},function(e,t,i){"use strict";i.d(t,"e",(function(){return n})),i.d(t,"f",(function(){return r})),i.d(t,"d",(function(){return o})),i.d(t,"c",(function(){return s})),i.d(t,"a",(function(){return a})),i.d(t,"g",(function(){return u})),i.d(t,"b",(function(){return c}));var n=2,r=4,o=3,s=1,a=101,u=102,c=404},function(e,t){e.exports=__webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js")},function(e,t,i){"use strict";function n(e){try{return JSON.parse(e)}catch(t){return console.error("Failed JSON parse:",e),{}}}function r(e,t){for(var i in t)Object.prototype.hasOwnProperty.call(t,i)&&(e[i]=t[i]);return e}function o(e){return""===e.codecs||"undefined"==typeof MediaSource||MediaSource.isTypeSupported('video/mp4;codecs="'+e.codecs+'"')}function s(e,t){var i=[],n=[];return e.forEach((function(e){t(e)?i.push(e):n.push(e)})),{supported:i,unsupported:n}}function a(e){var t,i;return void 0!==e.hidden?(t="hidden",i="visibilitychange"):void 0!==e.msHidden?(t="msHidden",i="msvisibilitychange"):void 0!==e.webkitHidden&&(t="webkitHidden",i="webkitvisibilitychange"),{hidden:t,visibilityChange:i}}function u(e,t,i){return Math.min(i,Math.max(t,e))}function c(e){e.removeAttribute("src")}function d(e){var t=window.location,i=document.createElement("a");return i.href=e,i.hostname===t.hostname&&i.port===t.port&&i.protocol===t.protocol}i.d(t,"h",(function(){return n})),i.d(t,"g",(function(){return r})),i.d(t,"c",(function(){return o})),i.d(t,"d",(function(){return s})),i.d(t,"e",(function(){return a})),i.d(t,"a",(function(){return u})),i.d(t,"b",(function(){return c})),i.d(t,"f",(function(){return d}))},function(e,t,i){"use strict";var n;i.d(t,"a",(function(){return n})),function(e){e.IDLE="Idle",e.READY="Ready",e.BUFFERING="Buffering",e.PLAYING="Playing",e.ENDED="Ended"}(n||(n={}))},function(e,t){e.exports=__webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js")},function(e,t){e.exports=__webpack_require__(/*! @babel/runtime/helpers/inheritsLoose */ "./node_modules/@babel/runtime/helpers/inheritsLoose.js")},function(e,t,i){"use strict";var n,r;i.d(t,"a",(function(){return n})),i.d(t,"b",(function(){return r})),function(e){e.ID3="MetaID3",e.CAPTION="MetaCaption"}(n||(n={})),function(e){e.METADATA_ID="metadata.live-video.net",e.INBAND_METADATA_ID="inband.metadata.live-video.net"}(r||(r={}))},function(e,t,i){"use strict";i.d(t,"a",(function(){return d}));var n=i(36),r=i(19),o=/^(\d+)\.(\d+)\.(\d+)[+|-]?(.*)?$/,s=/^(\d+)\.(\d+)[+|-]?(.*)?$/,a=/^(\d+)$/,u={chrome:!1,chromecast:!1,domain:"",family:"",firefox:!1,host:"",major:-1,minor:-1,msEdgeLegacy:!1,msEdgeChromium:!1,msIE:!1,name:"",opera:!1,osName:"",osVersion:"",patch:-1,safari:!1,url:"",userAgent:"",mobile:!1,supportsDataChannels:!1,supportsWebTransport:!1,supportsMSEInWorkers:!1},c=null;function d(){if(c)return c;if("undefined"==typeof window||"undefined"==typeof navigator)return c=u;var e,t,i=n.getParser(navigator.userAgent),d=(e=String(i.getBrowserVersion()),t=o.exec(e)||s.exec(e)||a.exec(e)||[],{major:parseInt(t[1],10)||0,minor:parseInt(t[2],10)||0,patch:parseInt(t[3],10)||0}),h=i.getEngine();return c={chrome:i.some(["chrome"]),chromecast:navigator.userAgent.toLowerCase().indexOf("crkey")>-1,domain:window.location.host.split(".").slice(-2).join("."),family:i.getBrowserName().toLowerCase(),firefox:i.some(["firefox"]),host:window.location.host,major:d.major,minor:d.minor,msEdgeLegacy:i.some(["microsoft edge"])&&"Blink"!==h.name,msEdgeChromium:i.some(["microsoft edge"])&&"Blink"===h.name,msIE:i.some(["internet explorer"]),name:navigator.appVersion,opera:i.some(["opera"]),osName:i.getOSName(),osVersion:String(i.getOSVersion()),patch:d.patch,safari:i.some(["safari"]),url:window.location.href,userAgent:navigator.userAgent,mobile:!(!i.some(["mobile"])&&!i.some(["tablet"])),supportsDataChannels:"RTCPeerConnection"in window,supportsWebTransport:"WebTransport"in window,supportsMSEInWorkers:r.a.isSupportedInWorker()}}},function(e,t,i){"use strict";i.d(t,"a",(function(){return n}));var n=function(){function e(){}var t=e.prototype;return t.addTrack=function(e){},t.bufferDuration=function(){return 0},t.buffered=function(){return{start:0,end:0}},t.captureGesture=function(){},t.configure=function(e){},t.decodedFrames=function(){return 0},t.delete=function(){},t.droppedFrames=function(){return 0},t.endOfStream=function(){},t.enqueue=function(e){},t.framerate=function(){return 0},t.getCurrentTime=function(){return 0},t.getDisplayHeight=function(){return 0},t.getDisplayWidth=function(){return 0},t.getPlaybackRate=function(){return 0},t.getVolume=function(){return 0},t.invoke=function(e){this[e.name].call(this,e.arg)},t.isMuted=function(){return!1},t.onSourceDurationChanged=function(e){},t.pause=function(){},t.play=function(){},t.reinit=function(){},t.remove=function(e){},t.seekTo=function(e){},t.setMuted=function(e){},t.setPlaybackRate=function(e){},t.setTimestampOffset=function(e){},t.setVolume=function(e){},t.changeSrc=function(e){},e}()},function(e,t,i){"use strict";var n;i.d(t,"a",(function(){return n})),function(e){e.AVAILABLE="RemotePlayerAvailable",e.UNAVAILABLE="RemotePlayerUnavailable",e.SESSION_STARTED="RemotePlayerSessionStarted",e.SESSION_ENDED="RemotePlayerSessionEnded"}(n||(n={}))},function(e,t,i){"use strict";(function(e){var n=i(37),r=i.n(n),o="undefined"!=typeof self?self:"undefined"!=typeof window?window:void 0!==e?e:void 0;t.a=o.Promise||r.a}).call(this,i(26))},function(e,t,i){"use strict";i.d(t,"a",(function(){return r})),i.d(t,"b",(function(){return o}));var n=i(12);function r(){return"undefined"!=typeof MediaSource}function o(){var e=Object(n.a)();if("Windows"!==e.osName||!e.chrome&&!e.firefox&&!e.msEdgeChromium)return Promise.resolve(!1);if(r()){if("mediaCapabilities"in navigator){return navigator.mediaCapabilities.decodingInfo({type:"media-source",video:{contentType:'video/mp4;codecs="vp09.00.41.08"',width:1920,height:1080,bitrate:8e6,framerate:60}}).then((function(e){return e.supported&&e.smooth}))}return Promise.resolve(MediaSource.isTypeSupported('video/mp4;codecs="vp09.00.10.08"'))}return Promise.resolve(!1)}},function(e,t,i){"use strict";i.d(t,"c",(function(){return Te})),i.d(t,"e",(function(){return Ce})),i.d(t,"d",(function(){return Pe})),i.d(t,"b",(function(){return Ae})),i.d(t,"a",(function(){return Me}));var n=i(0),r=i.n(n),o=i(12),s=i(3),a=null,u=null;function c(e){var t=e.type===s.a.ANALYTICS_EVENT,i=e.arg&&"video_error"===e.arg.name;if(t&&i){if(!a&&!u){var n=document.createElement("canvas");try{var r=n.getContext("webgl")||n.getContext("experimental-webgl");if(r&&"getExtension"in r){var o=r.getExtension("WEBGL_debug_renderer_info");o&&"getParameter"in r&&(a=r.getParameter(o.UNMASKED_RENDERER_WEBGL),u=r.getParameter(o.UNMASKED_VENDOR_WEBGL))}}catch(e){}}e.arg.properties.gl_renderer=a,e.arg.properties.gl_vendor=u}return e}var d=function(){function e(){var t=this;r()(this,"batteryManager",void 0),this.processor=this.processor.bind(this),e.isSupported()&&window.navigator.getBattery().then((function(e){t.batteryManager=e}))}return e.isSupported=function(){return window&&window.navigator&&!!window.navigator.getBattery},e.prototype.processor=function(e){var t=e.type===s.a.ANALYTICS_EVENT,i=e.arg&&"minute-watched"===e.arg.name;return t&&i&&this.batteryManager&&(e.arg.properties.battery_percent=this.batteryManager.level),e},e}(),h=i(16),l=i(5),f={keySystem:"org.w3.clearkey",uuid:"1077efec-c0b2-4d02-ace3-3c1e52e2fb4b"},m={keySystem:"com.apple.fps.2_0",certUrl:"https://fp-keyos-twitch.licensekeyserver.com/cert/a17fd33d3843df9b17679ccf50a419b2.der",licenseUrl:"https://fp-keyos-twitch.licensekeyserver.com/getkey",uuid:"94CE86FB-07FF-4F43-ADB8-93D2FA968CA2"},p={keySystem:"com.microsoft.playready",licenseUrl:"https://pr-keyos-twitch.licensekeyserver.com/core/rightsmanager.asmx",uuid:"9a04f079-9840-4286-ab92-e65be0885f95"},v={keySystem:"com.widevine.alpha",licenseUrl:"https://wv-keyos-twitch.licensekeyserver.com",uuid:"edef8ba9-79d6-4ace-a3c8-27dcd51d21ed"},y={CLEARKEY:f,FAIRPLAY:m,PLAYREADY:p,WIDEVINE:v},g={"com.widevine.alpha":v,"com.microsoft.playready":p,"com.apple.fps.2_0":m,"org.w3.clearkey":f},E=l.e,S=l.f,k={NO_CDM_SUPPORT:{value:S,message:"Your browser does not support any DRM Content Decryption Modules"},SESSION_UPDATE:{value:S,message:"There was an issue while updating DRM License"},LICENSE_REQUEST:{value:E,message:"Error while requesting DRM license"},KEY_SESSION_CREATION:{value:S,message:"Error creating key session"},KEY_SESSION_INTERNAL:{value:S,message:"Encryption key not usable because of internal error in CDM"},NO_PSSH_FOUND:{value:S,message:"Unable to find valid CDM support on media"},AUTH_XML_REQUEST:{value:E,message:"Request for AuthXML failed"},CERT_REQUEST:{value:E,message:"Request for DRM certificate failed"}};function b(e,t){var i;if("undefined"==typeof Symbol||null==e[Symbol.iterator]){if(Array.isArray(e)||(i=function(e,t){if(!e)return;if("string"==typeof e)return T(e,t);var i=Object.prototype.toString.call(e).slice(8,-1);"Object"===i&&e.constructor&&(i=e.constructor.name);if("Map"===i||"Set"===i)return Array.from(e);if("Arguments"===i||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i))return T(e,t)}(e))||t&&e&&"number"==typeof e.length){i&&(e=i);var n=0;return function(){return n>=e.length?{done:!0}:{done:!1,value:e[n++]}}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}return(i=e[Symbol.iterator]()).next.bind(i)}function T(e,t){(null==t||t>e.length)&&(t=e.length);for(var i=0,n=new Array(t);i<t;i++)n[i]=e[i];return n}function C(e){return window.WebKitMediaKeys&&"function"==typeof window.WebKitMediaKeys.isTypeSupported&&window.WebKitMediaKeys.isTypeSupported(y.FAIRPLAY.keySystem)?y.FAIRPLAY.uuid:"function"==typeof navigator.requestMediaKeySystemAccess?e.safari?"":e.msIE||e.msEdgeLegacy?y.PLAYREADY.uuid:y.WIDEVINE.uuid:""}function P(e,t){if((e=A(e))===(t=A(t)))return!0;if(e.byteLength!==t.byteLength)return!1;for(var i=new DataView(e),n=new DataView(t),r=0;r<i.byteLength;r++)if(i.getUint8(r)!==n.getUint8(r))return!1;return!0}function A(e){return e instanceof Uint8Array||e instanceof Uint16Array?e.buffer:e}function M(e){return function(e){var t=[];return e.forEach((function(e){Object.keys(y).forEach((function(i){var n=y[i];n.uuid===e&&t.push(n)}))})),t}(function(e){if(null===e)return[];var t=new DataView(e.buffer||e),i=[],n=0;for(;;){var r=void 0;if(n>=t.buffer.byteLength)break;var o=t.getUint32(n),s=n+o;if(n+=4,t.getUint32(n)===w("pssh")){n+=4;var a=t.getUint8(n);if(0===a||1===a){n++,n+=3,r="";for(var u=0;u<4;u++)r+=_(t.getUint8(n+u));n+=4,r+="-";for(var c=0;c<2;c++)r+=_(t.getUint8(n+c));n+=2,r+="-";for(var d=0;d<2;d++)r+=_(t.getUint8(n+d));n+=2,r+="-";for(var h=0;h<2;h++)r+=_(t.getUint8(n+h));n+=2,r+="-";for(var l=0;l<6;l++)r+=_(t.getUint8(n+l));n+=6,r=r.toLowerCase(),n+=4,i.push(r),n=s}else n=s}else n=s}return i}(e))}function D(e,t){return new Promise((function(i,n){var r=new XMLHttpRequest;for(var o in r.open(t.method,e,!0),t.headers)Object.prototype.hasOwnProperty.call(t.headers,o)&&r.setRequestHeader(o,t.headers[o]);r.responseType=t.responseType,r.onload=function(){200===r.status&&i(r.response)},r.onloadend=function(){n(r.status)},r.send(t.body)}))}function L(e){var t=R(I(JSON.parse(String.fromCharCode.apply(null,e)).sinf[0]),"schi");return function(e){for(var t,i="",n=b(e);!(t=n()).done;){var r=t.value;i+=_(r)}return i}(R(t,"tenc").subarray(8,24))}function R(e,t){for(var i=new DataView(e.buffer,e.byteOffset,e.byteLength),n=w(t),r=0;r<e.byteLength;){var o=i.getUint32(r);if(i.getUint32(r+4)===n)return e.subarray(r+8,r+o);r+=o}return new Uint8Array(e)}function w(e){return(e.charCodeAt(0)<<24)+(e.charCodeAt(1)<<16)+(e.charCodeAt(2)<<8)+e.charCodeAt(3)}function _(e){var t=e.toString(16);return 1===t.length?"0"+t:t}function I(e){for(var t=atob(e),i=t.length,n=new Uint8Array(i),r=0;r<i;r++)n[r]=t.charCodeAt(r);return n}function O(e){return decodeURIComponent(e.replace(/\+/g," "))}var V=i(11),N=i(14),U=i(8),x=i(9),B=i.n(x),H=i(6),j=i.n(H);function F(e){var t=null;if(e.getElementsByTagName("Challenge").length>0&&e.getElementsByTagName("Challenge")[0]){var i=e.getElementsByTagName("Challenge")[0].childNodes[0].nodeValue;i&&(t=atob(i))}return t}function G(e){for(var t={},i=e.getElementsByTagName("name"),n=e.getElementsByTagName("value"),r=0;r<i.length;r++)t[i[r].childNodes[0].nodeValue]=n[r].childNodes[0].nodeValue;return t}function W(e){var t=String.fromCharCode.apply(null,new Uint16Array(e)),i=(new DOMParser).parseFromString(t,"application/xml");return{headers:G(i),body:F(i)}}function Q(e,t){var i;if("undefined"==typeof Symbol||null==e[Symbol.iterator]){if(Array.isArray(e)||(i=function(e,t){if(!e)return;if("string"==typeof e)return K(e,t);var i=Object.prototype.toString.call(e).slice(8,-1);"Object"===i&&e.constructor&&(i=e.constructor.name);if("Map"===i||"Set"===i)return Array.from(e);if("Arguments"===i||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i))return K(e,t)}(e))||t&&e&&"number"==typeof e.length){i&&(e=i);var n=0;return function(){return n>=e.length?{done:!0}:{done:!1,value:e[n++]}}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}return(i=e[Symbol.iterator]()).next.bind(i)}function K(e,t){(null==t||t>e.length)&&(t=e.length);for(var i=0,n=new Array(t);i<t;i++)n[i]=e[i];return n}var q=[{initDataTypes:["cenc"],audioCapabilities:[{contentType:'audio/mp4;codecs="mp4a.40.2"'}],videoCapabilities:[{robustness:"SW_SECURE_CRYPTO",contentType:'video/mp4;codecs="avc1.42E01E"'}]}],Y=function(){function e(e){var t=this;r()(this,"video",void 0),r()(this,"listener",void 0),r()(this,"cdmSupport",void 0),r()(this,"selectedCDM",void 0),r()(this,"mediaKeys",void 0),r()(this,"pendingSessions",void 0),r()(this,"sessions",void 0),r()(this,"authXml",void 0),this.video=e.video,this.listener=e.listener,this.cdmSupport=null,this.selectedCDM=null,this.mediaKeys=void 0,this.pendingSessions=[],this.reset(),this.video.addEventListener("encrypted",(function(e){return t.handleEncrypted(e)})),this.video.addEventListener("webkitneedkey",(function(e){return t.handleWebKitEncrypted(e)}))}var t=e.prototype;return t.configure=function(e){var t=this;if(!this.authXml){var i=new URL(e),n=i.pathname.split("/"),r=n[n.length-1].split(".")[0],o=function(e){var t=new URL(e).searchParams,i={};return t.forEach((function(e,t){i[O(t)]=e?O(e):""})),i}(e),s=o.token,a=o.sig,u="https://"+i.host+"/api/authxml/"+r+"?token="+encodeURIComponent(s)+"&sig="+a;this.authXml=D(u,{method:"GET",responseType:"text"}).catch((function(e){t.handleError(Object.assign({code:e},k.AUTH_XML_REQUEST))}))}},t.reset=function(){this.authXml=null,this.sessions=[]},t.isProtected=function(){return null!==this.authXml},t.handleError=function(e){this.listener.onSinkError({value:e.value||l.f,code:e.code||0,message:e.message||""})},t.hasSession=function(e){for(var t,i=Q(this.sessions);!(t=i()).done;){var n=t.value;if(n.initData&&P(n.initData,e))return!0}return!1},t.createKeySystemSupportChain=function(){if(null===this.cdmSupport||0===this.cdmSupport.length)return Promise.reject(k.NO_PSSH_FOUND);var e=Promise.reject();return this.cdmSupport.forEach((function(t){e=e.catch((function(){return navigator.requestMediaKeySystemAccess(t.keySystem,q)}))})),e=e.catch((function(){return Promise.reject(k.NO_CDM_SUPPORT)}))},t.handleEncrypted=function(){var e=B()(j.a.mark((function e(t){var i,n;return j.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(!this.hasSession(t.initData)){e.next=2;break}return e.abrupt("return");case 2:if(this.sessions.push(t),"sinf"!==t.initDataType){e.next=6;break}return this.handleWebKitEncrypted(t),e.abrupt("return");case 6:if(null===this.cdmSupport&&(this.cdmSupport=M(t.initData)),void 0!==this.mediaKeys){e.next=24;break}return this.mediaKeys=null,e.prev=9,e.next=12,this.createKeySystemSupportChain();case 12:return i=e.sent,this.selectedCDM=g[i.keySystem],e.next=16,i.createMediaKeys();case 16:return n=e.sent,e.next=19,this.setMediaKeys(n);case 19:e.next=24;break;case 21:e.prev=21,e.t0=e.catch(9),this.handleError(e.t0);case 24:this.addSession(t);case 25:case"end":return e.stop()}}),e,this,[[9,21]])})));return function(t){return e.apply(this,arguments)}}(),t.setMediaKeys=function(e){var t=this;return this.mediaKeys=e,this.pendingSessions.forEach((function(e){return t.createSessionRequest(e)})),this.pendingSessions=[],this.video.setMediaKeys(this.mediaKeys)},t.addSession=function(e){var t=this;this.mediaKeys?this.createSessionRequest(e).catch((function(){t.handleError(k.KEY_SESSION_CREATION)})):this.pendingSessions.push(e)},t.createSessionRequest=function(e){var t=this,i=e.initDataType,n=e.initData,r=this.mediaKeys.createSession();return r.addEventListener("message",(function(e){return t.handleMessage(e)})),r.addEventListener("keystatuseschange",(function(e){return t.handleKeyStatusesChange(e,n)})),r.generateRequest(i,n)},t.handleKeyStatusesChange=function(e,t){var i=this,n=e.target,r=!1;n.keyStatuses.forEach((function(e){switch(e){case"expired":r=!0;break;case"internal-error":i.handleError(k.KEY_SESSION_INTERNAL)}})),r&&n.close().then((function(){return i.removeSession(t)}))},t.removeSession=function(e){for(var t=0;t<this.sessions.length;t++){if(this.sessions[t].initData===e)return void this.sessions.splice(t,1)}},t.handleMessage=function(){var e=B()(j.a.mark((function e(t){var i,n,r=this;return j.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return i=t.target,e.next=3,this.generateLicense(t.message);case 3:n=e.sent,i.update(n).catch((function(){r.handleError(k.SESSION_UPDATE)}));case 5:case"end":return e.stop()}}),e,this)})));return function(t){return e.apply(this,arguments)}}(),t.generateLicense=function(){var e=B()(j.a.mark((function e(t){var i,n,r,o;return j.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(this.selectedCDM!==y.CLEARKEY){e.next=7;break}return i=JSON.parse((new TextDecoder).decode(t)),n=i.kids.map((function(e){return{kty:"oct",alg:"A128KW",kid:e,k:e}})),r=(new TextEncoder).encode(JSON.stringify({keys:n})),e.abrupt("return",Promise.resolve(r));case 7:if(!this.authXml){e.next=14;break}return e.next=10,this.authXml;case 10:return o=e.sent,e.abrupt("return",this.requestLicense(t,o));case 14:this.handleError(k.AUTH_XML_REQUEST);case 15:case"end":return e.stop()}}),e,this)})));return function(t){return e.apply(this,arguments)}}(),t.requestLicense=function(){var e=B()(j.a.mark((function e(t,i){var n,r,o=this;return j.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n={method:"POST",responseType:"arraybuffer",body:t,headers:{customdata:i,"Content-Type":"application/octet-stream"}},this.selectedCDM===y.PLAYREADY&&(r=W(t),n.body=r.body,n.headers=Object.assign(n.headers,r.headers)),e.abrupt("return",D(this.selectedCDM.licenseUrl,n).catch((function(){o.handleError(Object.assign({code:status},k.LICENSE_REQUEST))})));case 3:case"end":return e.stop()}}),e,this)})));return function(t,i){return e.apply(this,arguments)}}(),t.handleWebKitEncrypted=function(){var e=B()(j.a.mark((function e(t){var i,n=this;return j.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return this.selectedCDM=y.FAIRPLAY,e.prev=1,e.next=4,D(y.FAIRPLAY.certUrl,{method:"GET",responseType:"arraybuffer",headers:{Pragma:"Cache-Control: no-cache","Cache-Control":"max-age=0"}});case 4:i=e.sent,this.setupWebKitMediaKeys(t,i).catch((function(e){return n.handleError(e)})),e.next=11;break;case 8:e.prev=8,e.t0=e.catch(1),this.handleError(Object.assign({code:e.t0},k.CERT_REQUEST));case 11:case"end":return e.stop()}}),e,this,[[1,8]])})));return function(t){return e.apply(this,arguments)}}(),t.setupWebKitMediaKeys=function(e,t){var i=this;this.video.webkitKeys||this.video.webkitSetMediaKeys(new window.WebKitMediaKeys(y.FAIRPLAY.keySystem));var n=L(e.initData),r=this.video.webkitKeys.createSession("video/mp4",e.initData);return r.contentId=n,new Promise((function(e,o){if(i.video.webkitKeys||o("Issue setting fairplay media keys"),!r)return o("Could not create key session");r.addEventListener("webkitkeymessage",(function(e){var r=e.target;"certificate"===String.fromCharCode.apply(null,e.message)?r.update(new Uint8Array(t)):i.getWebkitLicense(e.message,n).then((function(e){var t=e.trim();"<ckc>"===t.substr(0,5)&&"</ckc>"===t.substr(-6)&&(t=t.slice(5,-6)),r.update(I(t))})).catch(o)})),r.addEventListener("webkitkeyadded",e),r.addEventListener("webkitkeyerror",o)}))},t.getWebkitLicense=function(e,t){return this.authXml?this.authXml.then((function(i){var n;return D(y.FAIRPLAY.licenseUrl,{method:"POST",body:"spc="+(n=e,btoa(String.fromCharCode.apply(null,new Uint16Array(n)))+"&assetId=")+t,responseType:"text",headers:{"Content-Type":"application/x-www-form-urlencoded",customdata:i}}).catch((function(e){return Promise.reject(Object.assign({code:e},k.LICENSE_REQUEST))}))})):Promise.reject(k.AUTH_XML_REQUEST)},e}(),J=i(24),z=i(2),X=i.n(z),Z=i(10),$=i.n(Z),ee=i(13),te=function(e){function t(t){var i;return i=e.call(this)||this,r()(X()(i),"video",void 0),i.video=t,i}$()(t,e);var i=t.prototype;return i.seekTo=function(e){this.video.currentTime=e},i.setPlaybackRate=function(e){this.video.playbackRate=e},i.setVolume=function(e){this.video.volume=e},i.getVolume=function(){return this.video.volume},i.isMuted=function(){return this.video.muted},i.setMuted=function(e){this.video.muted=e},i.getPlaybackRate=function(){return this.video.playbackRate},t}(ee.a),ie=i(1),ne=function(){function e(e,t){r()(this,"muted",void 0),r()(this,"video",void 0),r()(this,"listener",void 0),r()(this,"unsubscribes",[]),r()(this,"expectingMutedChanged",!1),r()(this,"expectingVolumeChanged",!1),r()(this,"expectedRateChange",void 0),this.video=e,this.listener=t,this.muted=e.muted,this.unsubscribes.push(Object(ie.h)(e,"volumechange",this.volumeChange.bind(this))),this.unsubscribes.push(Object(ie.h)(e,"ratechange",this.rateChange.bind(this)))}var t=e.prototype;return t.volumeChange=function(){var e=!this.expectingVolumeChanged;this.expectingMutedChanged=!1,this.expectingVolumeChanged=!1;var t=this.video.muted;this.muted!==t?(this.muted=t,this.listener.onSinkMutedChanged(t)):this.listener.onSinkVolumeChanged(this.video.volume,e)},t.rateChange=function(){this.video.playbackRate!==this.expectedRateChange&&this.listener.onSinkPlaybackRateChanged(this.video.playbackRate)},t.unsubscribe=function(){this.unsubscribes.forEach((function(e){return e()}))},t.onConfigure=function(){this.expectingVolumeChanged&&(this.listener.onSinkVolumeChanged(this.video.volume,!1),this.expectingVolumeChanged=!1),this.expectingMutedChanged&&(this.muted=this.video.muted,this.listener.onSinkMutedChanged(this.video.muted),this.expectingMutedChanged=!1),this.expectedRateChange=void 0},t.trackRPC=function(e){var t=e.name,i=e.arg;"setVolume"===t&&this.video.volume!==i?this.expectingVolumeChanged=!0:"setMuted"===t&&this.video.muted!==i?this.expectingMutedChanged=!0:"setPlaybackRate"===t&&this.video.playbackRate!==i&&(this.expectedRateChange=i)},e}(),re=i(15),oe=function(e){function t(t,i){var n;return n=e.call(this)||this,r()(X()(n),"paused",!0),r()(X()(n),"listener",void 0),r()(X()(n),"video",void 0),r()(X()(n),"unsubscribers",void 0),r()(X()(n),"lastVolumeChangeEvent",void 0),n.video=t,n.listener=i,n.paused=!0,n.unsubscribers=[],n.addListener("volumechange",n.recordMuteChange.bind(X()(n))),n.recordMuteChange(),n}$()(t,e);var i=t.prototype;return i.pause=function(){this.paused=!0,this.video.pause()},i.setPlaybackRate=function(e){this.video.playbackRate=e},i.delete=function(){this.unsubscribers.forEach((function(e){return e()}))},i.addListener=function(e,t,i){void 0===i&&(i=this.video),this.unsubscribers.push(Object(ie.h)(i,e,t))},i.recordMuteChange=function(){this.lastVolumeChangeEvent={time:this.video.currentTime,muted:this.video.muted}},i.checkStopped=function(e){return!this.video.paused||this.video.ended||this.video.error||this.paused||this.listener.onSinkStop(e||this.unmuteAutopause()),!1},i.unmuteAutopause=function(){var e=this.lastVolumeChangeEvent;return!this.video.muted&&!e.muted&&this.video.currentTime===e.time},t}(ee.a),se=i(4),ae=function(e){function t(t,i){var n;return n=e.call(this,t,i)||this,r()(X()(n),"onSinkIdle",void 0),r()(X()(n),"intervalId",void 0),r()(X()(n),"idle",void 0),r()(X()(n),"lastPlayhead",void 0),r()(X()(n),"lastBufferEnd",void 0),r()(X()(n),"fps",void 0),r()(X()(n),"lastDecodedFrames",void 0),r()(X()(n),"lastTimeUpdate",void 0),r()(X()(n),"idleTimeout",void 0),r()(X()(n),"playAttempt",!1),r()(X()(n),"seeking",!1),r()(X()(n),"audioBufferList",void 0),r()(X()(n),"awaitingAutoplayCompletion",!1),n.intervalId=0,n.idle=!0,n.lastPlayhead=0,n.lastBufferEnd=0,n.fps=0,n.lastDecodedFrames=0,n.lastTimeUpdate=performance.now(),n.idleTimeout=-1,n.audioBufferList=[],n.addListener("play",(function(){return n.onVideoPlay()})),n.addListener("pause",(function(){return n.onVideoPause()})),n.addListener("timeupdate",(function(){return n.onVideoTimeUpdate()})),n.addListener("ended",(function(){return n.onVideoEnded()})),n.addListener("error",(function(){return n.onVideoError()})),n.addListener("playing",(function(){return n.onVideoPlaying()})),n.addListener("seeking",(function(){return n.onVideoSeeking()})),n}$()(t,e);var i=t.prototype;return i.delete=function(){e.prototype.delete.call(this),this.audioBufferList=[],clearInterval(this.intervalId)},i.play=function(){this.paused=!1;for(var e=this.video.buffered,t=0,i=0;i<e.length;i++){var n=e.start(i);if(this.video.currentTime<=n){t=n;break}}this.video.currentTime<t&&(console.warn("Moving to buffered region",t,this.video.currentTime),this.listener.onSinkGapJump(t-this.video.currentTime),this.seekTo(t)),this.playInternal()},i.endOfStream=function(){this.idle=!1,clearTimeout(this.idleTimeout),this.idleTimeout=-1},i.framerate=function(){return this.fps},i.seekTo=function(e){this.video.seekable.length&&e!==this.video.currentTime&&(this.seeking=!0,this.video.currentTime=e)},i.addSourceBuffer=function(e,t){(t.indexOf("mp4a")>-1||t.indexOf("opus")>-1)&&(this.audioBufferList=[e])},i.clearSourceBuffers=function(){this.audioBufferList=[]},i.onIdle=function(){var e;this.listener.onSinkIdle(),null==(e=this.onSinkIdle)||e.call(this)},i.onVideoPlay=function(){var e=this;this.playAttempt?(this.lastPlayhead=this.video.currentTime,clearInterval(this.intervalId),this.intervalId=self.setInterval((function(){return e.heartbeat()}),se.c)):(this.pause(),this.listener.play()),this.playAttempt=!1},i.onVideoPause=function(){this.awaitingAutoplayCompletion||(this.checkStopped(!1),clearInterval(this.intervalId))},i.onVideoTimeUpdate=function(){clearTimeout(this.idleTimeout),this.idleTimeout=-1;var e=Object(ie.c)(this.video),t=performance.now();this.fps=1e3*Math.max(e-this.lastDecodedFrames,0)/(t-this.lastTimeUpdate),this.lastDecodedFrames=e,this.lastTimeUpdate=t,this.listener.onSinkTimeUpdate();var i=Object(ie.a)(this.video.buffered,this.video.currentTime,se.d);this.checkBufferUpdate(i),this.updateIdle(i)},i.onVideoEnded=function(){this.listener.onSinkEnded()},i.onVideoPlaying=function(){this.video.paused||this.listener.onSinkPlaying(this.paused)},i.onVideoSeeking=function(){this.seeking?this.seeking=!1:this.listener.seekTo(this.video.currentTime)},i.onVideoError=function(){var e=this.video.error,t=e.code,i=e.message,n=void 0===i?"":i;this.listener.onSinkError({value:t,code:t,message:n})},i.heartbeat=function(){var e=Object(ie.a)(this.video.buffered,this.video.currentTime,se.d);if(this.video.paused)clearInterval(this.intervalId);else if(this.video.currentTime===this.lastPlayhead){var t=Object(ie.e)(this.video.buffered,this.video.currentTime,se.d);t!==this.video.currentTime&&(this.audioBufferList.map((function(e){Object(ie.f)("Audio Buffer",e.buffered)})),Object(ie.f)("<video> Buffer",this.video.buffered),console.warn("jumping "+(t-this.video.currentTime)+"s gap, current position "+this.video.currentTime+", new position "+t),this.listener.onSinkGapJump(t-this.video.currentTime),this.seekTo(t)),this.updateIdle(e,t===this.video.currentTime)}else this.checkBufferUpdate(e),this.lastPlayhead=this.video.currentTime;this.videoDisplaySizeUpdate()},i.videoDisplaySizeUpdate=function(){var e=this.video.clientWidth*window.devicePixelRatio,t=this.video.clientHeight*window.devicePixelRatio;this.listener.onSinkVideoDisplaySizeChanged(e,t)},i.checkBufferUpdate=function(e){var t=e.end;t!==this.lastBufferEnd&&(this.lastBufferEnd=t,this.listener.onSinkBufferUpdate())},i.updateIdle=function(e,t){var i=this,n=e.end;if(void 0===t&&(t=!1),this.video.paused)this.idle=!0;else{var r=[n].concat(this.audioBufferList.map((function(e){return Object(ie.a)(e.buffered,i.video.currentTime,se.d).end}))),o=Math.max.apply(null,r),s=this.video.buffered.length,a=s>0?this.video.buffered.end(s-1):n,u=o-this.video.currentTime<se.d||t&&n>a;u&&!this.idle&&(console.warn("playhead",this.video.currentTime,"max buffer",o,"max played",a),clearTimeout(this.idleTimeout),this.idleTimeout=self.setTimeout((function(){return i.onBufferingTimeout()}),se.a),this.onIdle()),this.idle=u}},i.onBufferingTimeout=function(){clearTimeout(this.idleTimeout),this.idleTimeout=-1,this.listener.onSinkError({value:l.a,code:l.a,message:"Buffering timeout"})},i.playInternal=function(){var e=this;this.playAttempt=!0,this.awaitingAutoplayCompletion=!0,re.a.resolve(this.video.play()).then((function(){e.awaitingAutoplayCompletion=!1})).catch((function(){e.playAttempt=!1,e.checkStopped(!0)}))},t}(oe),ue=function(e){function t(t,i){var n;return(n=e.call(this)||this).listener=t,n.video=i,r()(X()(n),"playbackMonitor",void 0),r()(X()(n),"controlsObserver",void 0),n.playbackMonitor=new ae(i,t),n.observeControlsChange(),n}$()(t,e);var i=t.prototype;return i.configure=function(e){var t=e.path;this.video.src||(this.video.src=t)},i.invoke=function(e){this[e.name].call(this,e.arg)},i.play=function(){this.playbackMonitor.play()},i.pause=function(){this.playbackMonitor.pause()},i.seekTo=function(e){this.playbackMonitor.seekTo(e)},i.endOfStream=function(){this.playbackMonitor.endOfStream()},i.setVolume=function(e){this.video.volume!==e&&(this.video.volume=e)},i.getVolume=function(){return this.video.volume},i.isMuted=function(){return this.video.muted},i.setMuted=function(e){this.video.muted!==e&&(this.video.muted=e)},i.getDisplayWidth=function(){return this.video.clientWidth},i.getDisplayHeight=function(){return this.video.clientHeight},i.setPlaybackRate=function(e){this.playbackMonitor.setPlaybackRate(e)},i.getPlaybackRate=function(){return this.video.playbackRate},i.getCurrentTime=function(){return this.video.currentTime},i.buffered=function(){return Object(ie.a)(this.video.buffered,this.video.currentTime,se.d)},i.bufferDuration=function(){var e=this.buffered(),t=e.start;return e.end-Math.max(t,this.video.currentTime)},i.decodedFrames=function(){return Object(ie.c)(this.video)},i.droppedFrames=function(){return Object(ie.d)(this.video)},i.framerate=function(){return this.playbackMonitor.framerate()},i.captureGesture=function(){this.playbackMonitor.play(),this.playbackMonitor.pause()},i.changeSrc=function(e){Object(ie.b)(this.video,e)},i.delete=function(){var e;this.playbackMonitor.delete(),Object(ie.g)(this.video),null==(e=this.controlsObserver)||e.disconnect()},i.observeControlsChange=function(){var e=this.listener,t=this.video;try{(this.controlsObserver=new MutationObserver((function(){e.onSinkControlsChanged(t.controls)}))).observe(t,{attributeFilter:["controls"]}),e.onSinkControlsChanged(t.controls)}catch(e){}},t}(ee.a),ce=i(38),de=i.n(ce);var he,le=i(19),fe=function(){function e(e,t){this.listener=e,this.video=t,r()(this,"playbackMonitor",void 0),r()(this,"controlsObserver",void 0),r()(this,"mseSink",void 0),r()(this,"awaitSink",void 0),this.playbackMonitor=new ae(t,e),this.observeControlsChange(),this.awaitSink=void 0,Object(ie.h)(t,"error",this.onVideoError.bind(this))}var t=e.prototype;return t.invoke=function(e){var t=this.awaitSink,i=this.mseSink;t&&i?["enqueue","addTrack","setTimestampOffset"].includes(e.name)?this.invokeAsync(e):this.invokeSync(e):t?this.invokeAsync(e):i&&this.invokeSync(e)},t.configure=function(e){var t=this,i=e.trackID,n=e.codec,r=e.isProtected,o=this.awaitSink;if(!this.mseSink&&!o){var s=le.a.create(this.onMediaSourceEnded.bind(this),this.onMediaSourceError.bind(this));this.awaitSink=new re.a((function(e,i){s.sink.then((function(i){t.handleCreateSuccess(i),e()})).catch((function(e){t.handleCreateError(e),i()}))})),this.changeSrc(s.objectURL)}this.isContentProtectionChanging(r)&&!this.awaitSink&&(this.awaitSink=new re.a((function(e,i){t.deferUntilIdle().then((function(){var e=le.a.create(t.onMediaSourceEnded.bind(t),t.onMediaSourceError.bind(t));return t.changeSrc(e.objectURL),e.sink})).then((function(i){t.destroyMSESink(),t.handleCreateSuccess(i),t.play(),e()})).catch((function(e){t.handleCreateError(e),i()}))}))),this.invoke({name:"addTrack",arg:de()({},me,{trackID:i,codec:n,isProtected:r})})},t.addTrack=function(e){var t=e.trackID,i=e.codec,n=e.isProtected,r=this.mseSink;try{var o=r.addTrack(t,i,n);o&&this.playbackMonitor.addSourceBuffer(o,i)}catch(e){this.handleCreateError(e)}},t.enqueue=function(e){var t=e.trackID,i=e.buffer;this.mseSink.append(t,i)},t.endOfStream=function(){var e=this;this.mseSink.scheduleUpdate().then((function(){return e.playbackMonitor.endOfStream()}))},t.setTimestampOffset=function(e){var t=e.trackID,i=e.offset;this.mseSink.setTimestampOffset(t,i)},t.onSourceDurationChanged=function(e){var t=this.mseSink,i=this.video,n=t.duration,r=function(e,t,i){var n=e;return e===1/0||e===se.b?i?n=1/0:i||(n=se.b):e!==t&&(n=e),n}(e,n,i.controls);r!==n&&t.setDuration(r)},t.play=function(){var e=this;this.mseSink.scheduleUpdate().then((function(){return e.playbackMonitor.play()}))},t.pause=function(){var e=this;this.mseSink.scheduleUpdate().then((function(){return e.playbackMonitor.pause()}))},t.remove=function(e){var t=e.start,i=e.end;this.mseSink.remove(t,i)},t.seekTo=function(e){var t=this.mseSink,i=this.playbackMonitor,n=this.video,r=Object(ie.a)(n.buffered,n.currentTime,se.d),o=r.start,s=r.end;e>=o&&e<s?t.scheduleUpdate().then((function(){return i.seekTo(e)})):i.seekTo(e)},t.setVolume=function(e){this.video.volume!==e&&(this.video.volume=e)},t.getVolume=function(){return this.video.volume},t.isMuted=function(){return this.video.muted},t.setMuted=function(e){this.video.muted!==e&&(this.video.muted=e)},t.getDisplayWidth=function(){return this.video.clientWidth},t.getDisplayHeight=function(){return this.video.clientHeight},t.setPlaybackRate=function(e){this.playbackMonitor.setPlaybackRate(e)},t.getPlaybackRate=function(){return this.video.playbackRate},t.getCurrentTime=function(){return this.video.currentTime},t.buffered=function(){return Object(ie.a)(this.video.buffered,this.video.currentTime,se.d)},t.bufferDuration=function(){var e=this.buffered(),t=e.start;return e.end-Math.max(t,this.video.currentTime)},t.decodedFrames=function(){return Object(ie.c)(this.video)},t.droppedFrames=function(){return Object(ie.d)(this.video)},t.framerate=function(){return this.playbackMonitor.framerate()},t.captureGesture=function(){this.playbackMonitor.play(),this.playbackMonitor.pause()},t.changeSrc=function(e){Object(ie.b)(this.video,e)},t.delete=function(){var e;this.playbackMonitor.delete(),null==(e=this.controlsObserver)||e.disconnect(),this.destroyMSESink(),Object(ie.g)(this.video)},t.invokeSync=function(e){this[e.name].call(this,e.arg)},t.invokeAsync=function(e){var t=this;this.awaitSink.then((function(){return t.invokeSync(e)})).catch((function(){}))},t.onMediaSourceEnded=function(){this.video.load(),this.listener.onSinkReset()},t.destroyMSESink=function(){var e=this,t=function(){e.mseSink&&e.mseSink.destroy(),e.awaitSink=void 0,e.mseSink=void 0};this.mseSink?t():this.awaitSink&&this.awaitSink.then((function(){return t()})),this.playbackMonitor&&this.playbackMonitor.clearSourceBuffers()},t.isContentProtectionChanging=function(e){var t=this.awaitSink,i=this.mseSink;if(!i||t)return!1;var n=i.bufferProperties;return!!n.length&&n.some((function(t){return t.isProtected!==e}))},t.deferUntilIdle=function(){var e=this,t=this.mseSink,i=this.playbackMonitor;return new re.a((function(n){t&&!e.video.paused?i.onSinkIdle=function(){i.onSinkIdle=void 0,n()}:n()}))},t.handleCreateSuccess=function(e){this.mseSink=e,this.awaitSink=void 0,this.onSourceDurationChanged(se.b),this.mseSink.setLiveSeekableRange(0,se.b)},t.handleCreateError=function(e){this.listener.onSinkError({value:l.f,code:l.f,message:e.toString()})},t.onMediaSourceError=function(e,t,i,n){var r={value:e,code:t,message:i};n?this.listener.onSinkError(r):this.listener.onSinkRecoverableError(r)},t.onVideoError=function(){this.destroyMSESink()},t.observeControlsChange=function(){var e=this,t=this.video;try{(this.controlsObserver=new MutationObserver((function(){e.invoke({name:"onSourceDurationChanged",arg:t.duration})}))).observe(t,{attributeFilter:["controls"]})}catch(e){}},e}(),me={trackID:0,codec:"",mode:"mse",isProtected:!1,path:""},pe=i(7),ve=function(e){function t(t,i){var n;n=e.call(this,i,t)||this,r()(X()(n),"fps",void 0),r()(X()(n),"intervalId",void 0),r()(X()(n),"bufferingTimeoutId",void 0),r()(X()(n),"attemptingToPlay",void 0),r()(X()(n),"hasPlayedSrc",void 0),r()(X()(n),"hasReloadedOnDecodeError",void 0),r()(X()(n),"unsubscribersForTrackEvents",void 0),n.fps=0,n.intervalId=-1,n.bufferingTimeoutId=-1,n.attemptingToPlay=!1,n.hasPlayedSrc=!1,n.hasReloadedOnDecodeError=!1,n.unsubscribersForTrackEvents=[],n.addListener("waiting",(function(){return n.onVideoWaiting()}),n.video),n.addListener("timeupdate",(function(){return n.onVideoTimeUpdate()}),n.video),n.addListener("durationchange",(function(){return n.onVideoDurationChange()}),n.video),n.addListener("error",(function(){return n.onVideoError()}),n.video),n.addListener("play",(function(){return n.onVideoPlay()}),n.video),n.addListener("pause",(function(){return n.onVideoPause()}),n.video),n.addListener("ended",(function(){return n.onVideoEnded()}),n.video),n.addListener("playing",(function(){return n.onVideoPlaying()}),n.video);var o=Object(pe.e)(document).visibilityChange;return n.addListener(o,(function(){return n.onVisibilityChange()}),document),n}$()(t,e);var i=t.prototype;return i.invoke=function(e){this[e.name].call(this,e.arg)},i.configure=function(e){var t=e.path;this.handleTrackEvents(),this.hasReloadedOnDecodeError=!1,this.hasPlayedSrc=!1,this.video.src=t},i.play=function(){var e=this,t=this.video.buffered;if(t.length>0){var i=t.start(t.length-1),n=t.end(t.length-1);this.video.duration===1/0&&(n<this.video.currentTime||this.video.currentTime<i)&&(this.listener.onSinkGapJump(i-this.video.currentTime),console.warn("Moving to buffered region"),this.video.currentTime=i)}this.paused=!1,this.attemptingToPlay=!0,Promise.resolve(this.video.play()).then((function(){e.attemptingToPlay=!1,e.hasPlayedSrc=!0})).catch((function(){e.attemptingToPlay=!1,e.checkStopped(!0)}))},i.pause=function(){e.prototype.pause.call(this),clearTimeout(this.intervalId)},i.seekTo=function(e){this.video.currentTime=e},i.setVolume=function(e){this.video.volume=e},i.getVolume=function(){return this.video.volume},i.buffered=function(){return Object(ie.a)(this.video.buffered,this.video.currentTime,se.d)},i.decodedFrames=function(){return Object(ie.c)(this.video)},i.droppedFrames=function(){return Object(ie.d)(this.video)},i.framerate=function(){return this.fps},i.delete=function(){e.prototype.delete.call(this),this.removeTrackListeners(),this.video.src="",this.video.load()},i.isMuted=function(){return this.video.muted},i.setMuted=function(e){this.video.muted=e},i.getDisplayWidth=function(){return this.video.clientWidth},i.getDisplayHeight=function(){return this.video.clientHeight},i.getPlaybackRate=function(){return this.video.playbackRate},i.getCurrentTime=function(){return this.video.currentTime},i.bufferDuration=function(){var e=this.buffered(),t=e.start;return e.end-Math.max(t,this.video.currentTime)},i.captureGesture=function(){Promise.resolve(this.video.play()).catch((function(){})),this.video.pause()},i.addTrackListener=function(e,t,i){this.unsubscribersForTrackEvents.push(Object(ie.h)(i,e,t))},i.removeTrackListeners=function(){this.unsubscribersForTrackEvents.forEach((function(e){return e()}))},i.checkTracksStatus=function(){for(var e=this.video.textTracks,t=0;t<e.length;t++){var i=e[t];"metadata"===i.kind&&"disabled"===i.mode&&(i.mode="hidden")}},i.handleCueChange=function(e,t){var i=this,n=0;this.addTrackListener("cuechange",(function(){for(var r,o,s=null!=(r=null==(o=e.cues)?void 0:o.length)?r:0;n<s;n++){var a=e.cues[n],u=a.startTime,c=a.endTime,d=a.type,h=a.value;if("org.id3"===d&&h&&("TXXX"===h.key&&"segmentmetadata"!==h.info||"PRIV"===h.key&&h.info===V.b.METADATA_ID||"PRIV"===h.key&&h.info===V.b.INBAND_METADATA_ID)){var l=new(window.WebKitDataCue||window.DataCue)(u,c,"");l.value="PRIV"===h.key?new TextDecoder("utf-8").decode(h.data):h.data||"",l.info=h.info||"",l.owner=h.info||"",i.addTrackListener("enter",(function(e){var t=e.target;i.listener.onPassthroughSinkMetadata(t.startTime,t.endTime,t.value,t.info,t.owner)}),l),t.addCue(l)}}}),e)},i.handleTrackEvents=function(){var e=this;if(this.removeTrackListeners(),void 0!==window.DataCue||void 0!==window.WebKitDataCue){this.addTrackListener("change",(function(){e.checkTracksStatus()}),this.video.textTracks);var t=this.video.addTextTrack("metadata","passthrough");this.addTrackListener("addtrack",(function(i){var n=i.track;"metadata"===n.kind&&"disabled"===n.mode&&(n.mode="hidden",e.handleCueChange(n,t))}),this.video.textTracks)}},i.onVideoWaiting=function(){var e=this;if(Object(ie.a)(this.video.buffered,this.video.currentTime,se.d).end-this.video.currentTime<se.d){this.listener.onSinkIdle(),clearTimeout(this.bufferingTimeoutId),this.bufferingTimeoutId=self.setTimeout((function(){e.listener.onSinkError({value:l.a,code:l.a,message:"Buffering timeout"})}),se.a);var t=Object(ie.h)(this.video,"timeupdate",(function(){t(),clearTimeout(e.bufferingTimeoutId)}))}var i=Object(ie.h)(this.video,"timeupdate",(function(){4===e.video.readyState&&(i(),e.onVideoPlaying())}))},i.onVideoTimeUpdate=function(){var e=this.listener,t=this.video;e.onSinkTimeUpdate(),e.onSinkVideoDisplaySizeChanged(t.clientWidth*self.devicePixelRatio,t.clientHeight*self.devicePixelRatio)},i.onVideoDurationChange=function(){this.listener.onSinkDurationChanged(this.video.duration)},i.onVideoError=function(){var e=this.video.error,t=this.video.error,i=t.code,n=t.message,r=void 0===n?"":n,o=-1!==this.video.src.indexOf(".m3u8");if(i===l.f&&!this.hasPlayedSrc&&o)return clearTimeout(this.bufferingTimeoutId),void this.listener.onSinkError({value:l.b,code:l.b,message:r});e.code!==l.d||this.hasReloadedOnDecodeError?this.listener.onSinkError({value:i,code:i,message:r}):this.hasReloadedOnDecodeError||(this.hasReloadedOnDecodeError=!0,console.warn("Reload video element on MEDIA_ERR_DECODE 3"),this.video.load())},i.onVideoPlay=function(){var e=this,t=this.video.currentTime;clearTimeout(this.intervalId),this.intervalId=self.setTimeout((function(){return e.heartbeat(t)}),se.c)},i.onVideoPause=function(){clearTimeout(this.intervalId),this.attemptingToPlay||this.checkStopped(!1)},i.onVideoEnded=function(){this.listener.onSinkEnded()},i.onVideoPlaying=function(){this.listener.onSinkPlaying(this.paused),this.trackFPS(Object(ie.c)(this.video),performance.now()),this.trackBufferUpdate(Object(ie.a)(this.video.buffered,this.video.currentTime,se.d).end)},i.onVisibilityChange=function(){var e=Object(pe.e)(document).hidden;document[e]&&(this.hasReloadedOnDecodeError=!1)},i.heartbeat=function(e){var t=this,i=this.video.currentTime;if(i===e){if(Object(ie.i)(this.video,se.d))return void this.listener.onSinkIdle();var n=Object(ie.e)(this.video.buffered,i,se.d);n!==i&&(console.warn("jumping "+(n-i)+"s gap"),this.listener.onSinkGapJump(n-this.video.currentTime),this.video.currentTime=n,i=this.video.currentTime)}this.intervalId=self.setTimeout((function(){return t.heartbeat(i)}),se.c)},i.trackFPS=function(e,t){var i=this,n=Object(ie.c)(this.video),r=performance.now();this.fps=(n-e)/(r-t)*1e3;var o=Object(ie.h)(this.video,"timeupdate",(function(){o(),i.trackFPS(n,r)}))},i.trackBufferUpdate=function(e){var t=this,i=this.buffered().end;i!==e&&this.listener.onSinkBufferUpdate();var n=Object(ie.h)(this.video,"timeupdate",(function(){n(),t.trackBufferUpdate(i)}))},t}(oe),ye=function(){function e(e,t,i){this.listener=e,r()(this,"video",void 0),r()(this,"drmManager",void 0),r()(this,"codecs",void 0),r()(this,"sink",void 0),r()(this,"observer",void 0),r()(this,"remoteDevicesListener",void 0),this.video=i||document.createElement("video"),this.listener=e,this.drmManager=new Y({video:this.video,listener:e}),this.codecs=Object.create(null),this.sink=new te(this.video),t&&(this.remoteDevicesListener=J.a.lookForRemotePlaybackDevices(this.listener)),this.observer=new ne(this.video,e)}var t=e.prototype;return t.delete=function(){this.reset(),this.remoteDevicesListener&&this.remoteDevicesListener.then((function(e){return J.a.stopLookingForRemotePlaybackDevices(e)}))},t.configure=function(e){var t=e.mode,i=e.codec,n=e.trackID;this.sink instanceof te&&(this.sink="chromecast"===t?new J.a(this.listener):"passthrough"===t?new ve(this.listener,this.video):"mse-worker"===t?new ue(this.listener,this.video):new fe(this.listener,this.video)),i?this.codecs[n]=i:e.codec=this.codecs[n],this.sink.configure(e);var r=e.path,o=e.isProtected;r&&o&&this.drmManager.configure(r),this.observer.onConfigure()},t.applyRPC=function(e){this.observer.trackRPC(e),this.sink.invoke(e)},t.getCurrentSink=function(){return this.sink},t.reset=function(){this.sink.delete(),this.drmManager.reset(),this.sink=new te(this.video),this.listener.onSinkTimeUpdate(),this.listener.onSinkBufferUpdate()},t.videoElement=function(){return this.video},t.isProtected=function(){return this.drmManager.isProtected()},t.captureGesture=function(){this.video.played.length||this.sink.captureGesture()},t.destroy=function(){this.observer.unsubscribe(),this.delete()},t.isLowLatencyCapable=function(){return this.sink instanceof fe},e}(),ge=i(23),Ee=function(){function e(){r()(this,"emitter",void 0),this.emitter=new ge.EventEmitter}var t=e.prototype;return t.on=function(e,t){this.emitter.on(String(e),t)},t.removeListener=function(e,t){this.emitter.removeListener(String(e),t)},t.emit=function(e){for(var t,i=arguments.length,n=new Array(i>1?i-1:0),r=1;r<i;r++)n[r-1]=arguments[r];(t=this.emitter).emit.apply(t,[String(e)].concat(n))},t.removeAllListeners=function(){this.emitter.removeAllListeners()},e}();!function(e){e[e.STATE_CHANGED=0]="STATE_CHANGED",e[e.CONFIGURE=1]="CONFIGURE",e[e.RESET=2]="RESET",e[e.ADD_CUE=3]="ADD_CUE",e[e.GET_DECODE_INFO=4]="GET_DECODE_INFO",e[e.MEDIA_SINK_RPC=5]="MEDIA_SINK_RPC",e[e.GET_EXPERIMENTS=6]="GET_EXPERIMENTS",e[e.LOG_MESSAGE=7]="LOG_MESSAGE",e[e.DATA_CHANNEL_CREATE=8]="DATA_CHANNEL_CREATE",e[e.DATA_CHANNEL_CLOSE=9]="DATA_CHANNEL_CLOSE",e[e.DATA_CHANNEL_SEND=10]="DATA_CHANNEL_SEND",e[e.RTC_SET_REMOTE_DESCRIPTION=11]="RTC_SET_REMOTE_DESCRIPTION",e[e.PROPERTY_CHANGED=12]="PROPERTY_CHANGED",e[e.DESTROY=13]="DESTROY"}(he||(he={}));var Se=function(){function e(t,i){var n=this;r()(this,"worker",void 0),r()(this,"id",void 0),r()(this,"emitter",void 0),r()(this,"seekTime",void 0),r()(this,"paused",void 0),r()(this,"isLoaded",void 0),r()(this,"autoPlayOptions",void 0),r()(this,"mediaSinkManager",void 0),r()(this,"experiments",void 0),r()(this,"enableRemoteSearch",void 0),r()(this,"isQualitySupported",void 0),r()(this,"onvisibilitychange",void 0),r()(this,"onmessage",void 0),r()(this,"onOnline",void 0),r()(this,"onOffline",void 0),r()(this,"pauseHiddenSilentTab",void 0),r()(this,"state",void 0),r()(this,"workerMessageProcessors",void 0),this.worker=i,this.id=e.instanceId++,this.emitter=new Ee,this.seekTime=null,this.paused=!0,this.isLoaded=!1,this.autoPlayOptions=null,this.isQualitySupported=t.isQualitySupported||pe.c,this.onvisibilitychange=function(){return n.onVisibilityChange()},this.onmessage=function(e){return n.onWorkerMessage(e)},this.onOnline=function(){return n.postMessage("onOnline")},this.onOffline=function(){return n.postMessage("onOffline")},this.enableRemoteSearch=t.enableRemoteSearch||!1;var s=Object(o.a)();if(this.pauseHiddenSilentTab=s.chrome&&63===s.major||s.opera,this.mediaSinkManager=new ye(this,this.enableRemoteSearch),this.experiments=null,this.workerMessageProcessors=[c],d.isSupported()){var a=new d;this.workerMessageProcessors.push(a.processor)}this.state={averageBitrate:0,bandwidthEstimate:0,looping:!1,autoQualityMode:!0,volume:1,liveLatency:0,liveLowLatencyEnabled:!0,liveLowLatency:!1,statistics:{}},this.resetState(),this.attachHandlers(),this.postMessage("create",[{mseSupported:Object(h.a)(),keySystem:void 0!==t.keySystem?t.keySystem:C(s),browserContext:s,codecs:e.isVP9Supported()?["vp09"]:[],testOnly:t.testOnly,playerFramework:t.playerFramework,buildDistId:"npm"}])}e.isVP9Supported=function(){return Object(h.a)()&&MediaSource.isTypeSupported('video/mp4;codecs="vp09.00.10.08"')};var t=e.prototype;return t.delete=function(){var e=this,t=Object(pe.e)(document).visibilityChange;document.removeEventListener(t,this.onvisibilitychange),window.removeEventListener("online",this.onOnline),window.removeEventListener("offline",this.onOffline),this.emitter.removeAllListeners(),this.emitter.on(he.DESTROY,(function(){e.mediaSinkManager.destroy(),e.emitter.removeAllListeners(),e.worker.removeEventListener("message",e.onmessage)})),this.postMessage("delete")},t.attachHTMLVideoElement=function(e){this.mediaSinkManager&&this.mediaSinkManager.destroy(),this.mediaSinkManager=new ye(this,this.enableRemoteSearch,e),this.processVideoElementAttributes(e)},t.getHTMLVideoElement=function(){return this.mediaSinkManager.videoElement()},t.load=function(e,t){void 0===t&&(t=""),this.postMessage("load",[e,t]),this.autoPlayOptions&&this.postMessage("playIntent")},t.play=function(){this.postMessage("playIntent"),this.mediaSinkManager.captureGesture(),this.paused=!1,this.attemptPlay()},t.setAutoplay=function(e){this.autoPlayOptions=e?{attemptMutedRetry:!0}:null},t.setAutoPlayOptions=function(e){this.autoPlayOptions=e},t.getExperiments=function(){return this.experiments},t.setExperiment=function(e,t){this.setExperimentData({id:e,assignment:t,version:0,type:""})},t.setExperimentData=function(e){this.postMessage("setExperiment",[e])},t.pause=function(){this.paused=!0,this.postMessage("pause")},t.isPaused=function(){return this.paused},t.seekTo=function(e){this.seekTime=e,this.postMessage("seekTo",[e])},t.isSeeking=function(){return null!==this.seekTime},t.isAutoplay=function(){return!!this.autoPlayOptions},t.getDuration=function(){return this.state.duration},t.getStartOffset=function(){return this.state.startOffset||0},t.getPosition=function(){return null===this.seekTime?this.mediaSinkManager.getCurrentSink().getCurrentTime():this.seekTime},t.getBuffered=function(){return this.mediaSinkManager.getCurrentSink().buffered()},t.getBufferDuration=function(){return this.state.bufferedPosition-this.getPosition()},t.getState=function(){return this.state.state},t.getVideoWidth=function(){return this.mediaSinkManager.videoElement().videoWidth},t.getVideoHeight=function(){return this.mediaSinkManager.videoElement().videoHeight},t.getVideoFrameRate=function(){return this.state.statistics.framerate},t.getVideoBitRate=function(){return this.state.statistics.bitrate},t.getAverageBitrate=function(){return this.state.averageBitrate},t.getBandwidthEstimate=function(){return this.state.bandwidthEstimate},t.getPath=function(){return this.state.path},t.getProtocol=function(){return this.state.protocol},t.getVersion=function(){return"1.7.0"},t.isLiveLowLatency=function(){return this.state.liveLowLatencyEnabled&&this.state.liveLowLatency},t.isLooping=function(){return this.state.looping},t.setLogLevel=function(e){this.postMessage("setLogLevel",[e])},t.setLooping=function(e){this.state.looping=e,this.postMessage("setLooping",[e])},t.isMuted=function(){return this.mediaSinkManager.getCurrentSink().isMuted()},t.setMuted=function(e){this.mediaSinkManager.getCurrentSink().setMuted(e)},t.setVolume=function(e){this.state.volume=e,this.postMessage("setVolume",[this.state.volume])},t.getVolume=function(){return this.state.volume},t.getQuality=function(){return this.state.quality},t.setQuality=function(e,t){void 0===t&&(t=!1),this.mediaSinkManager.videoElement().controls||(this.postMessage("setQuality",[e,t]),this.state.autoQualityMode=!1)},t.getQualities=function(){return this.state.qualities},t.setAuthToken=function(e){this.postMessage("setAuthToken",[e])},t.isAutoQualityMode=function(){return this.state.autoQualityMode},t.setAutoQualityMode=function(e){this.state.autoQualityMode=e,this.postMessage("setAutoQualityMode",[e])},t.setAutoInitialBitrate=function(e){this.postMessage("setAutoInitialBitrate",[e])},t.setAutoMaxQuality=function(e){this.postMessage("setAutoMaxQuality",[e])},t.setAutoMaxBitrate=function(e){this.postMessage("setAutoMaxBitrate",[e])},t.setAutoMaxVideoSize=function(e,t){this.postMessage("setAutoMaxVideoSize",[e,t])},t.setAutoViewportSize=function(e,t){this.postMessage("setAutoViewportSize",[e,t])},t.getPlaybackRate=function(){return this.mediaSinkManager.getCurrentSink().getPlaybackRate()},t.setPlaybackRate=function(e){return this.mediaSinkManager.getCurrentSink().setPlaybackRate(e)},t.setClientId=function(e){this.postMessage("setClientId",[e])},t.setDeviceId=function(e){this.postMessage("setDeviceId",[e])},t.setLiveSpeedUpRate=function(e){this.postMessage("setLiveSpeedUpRate",[e])},t.setPlayerType=function(e){this.postMessage("setPlayerType",[e])},t.setLiveMaxLatency=function(e){this.postMessage("setLiveMaxLatency",[e])},t.setLiveLowLatencyEnabled=function(e){this.state.liveLowLatencyEnabled=e,this.postMessage("setLiveLowLatencyEnabled",[e])},t.setRebufferToLive=function(e){this.postMessage("setRebufferToLive",[e])},t.setVisible=function(e){this.postMessage("setVisible",[e])},t.setInitialBufferDuration=function(e){this.postMessage("setInitialBufferDuration",[e])},t.addEventListener=function(e,t){this.emitter.on(e,t)},t.removeEventListener=function(e,t){this.emitter.removeListener(e,t)},t.getDroppedFrames=function(){return this.state.statistics.droppedFrames},t.getDecodedFrames=function(){return this.state.statistics.decodedFrames},t.getDisplayWidth=function(){return this.mediaSinkManager.getCurrentSink().getDisplayWidth()},t.getDisplayHeight=function(){return this.mediaSinkManager.getCurrentSink().getDisplayHeight()},t.getSessionId=function(){return this.state.sessionId},t.getSessionData=function(){return this.state.sessionData},t.getLiveLatency=function(){return this.state.liveLatency},t.isProtected=function(){return this.mediaSinkManager.isProtected()},t.startRemotePlayback=function(){this.postMessage("startRemotePlayback")},t.endRemotePlayback=function(){this.postMessage("endRemotePlayback")},t.setPlatformName=function(e){this.postMessage("setPlatformName",[e])},t.setRequestCredentials=function(e){this.postMessage("setRequestCredentials",[e])},t.onSinkTimeUpdate=function(){var e=this.mediaSinkManager.getCurrentSink();null===this.seekTime&&(this.postMessage("onClientSinkUpdate",[{currentTime:e.getCurrentTime(),decodedFrames:e.decodedFrames(),droppedFrames:e.droppedFrames(),framerate:e.framerate(),bufferDuration:e.bufferDuration(),displayHeight:e.getDisplayHeight(),displayWidth:e.getDisplayWidth()}]),this.emitter.emit(s.a.TIME_UPDATE,e.getCurrentTime()))},t.onSinkBufferUpdate=function(){this.emitter.emit(s.a.BUFFER_UPDATE)},t.onSinkDurationChanged=function(e){this.postMessage("onClientSinkDurationChanged",[e])},t.onSinkEnded=function(){this.postMessage("onClientSinkEnded")},t.onSinkIdle=function(){this.postMessage("onClientSinkIdle")},t.onSinkPlaying=function(e){this.postMessage("onClientSinkPlaying"),e&&this.play()},t.onSinkStop=function(e){var t,i,n=Object(pe.e)(document).hidden;if(document[n])this.postMessage("pause");else if(e){if(!this.isMuted()&&(null==(t=null==(i=this.autoPlayOptions)?void 0:i.attemptMutedRetry)||t))return this.setMuted(!0),this.mediaSinkManager.getCurrentSink().play(),void this.emitter.emit(s.a.AUDIO_BLOCKED);this.pause(),this.emitter.emit(s.a.PLAYBACK_BLOCKED)}else this.pause()},t.onSinkReset=function(){this.postMessage("onClientSinkReset")},t.onSinkError=function(e){var t=e.value,i=e.code,n=e.message;this.postMessage("onClientSinkError",[t,i,n])},t.onSinkRecoverableError=function(e){var t=e.value,i=e.code,n=e.message;this.postMessage("onClientSinkRecoverableError",[t,i,n])},t.onSinkVideoDisplaySizeChanged=function(e,t){this.setAutoViewportSize(e,t)},t.onSinkVolumeChanged=function(e,t){this.mediaSinkManager.videoElement().controls&&t&&this.setVolume(e),this.emitter.emit(s.a.VOLUME_CHANGED,this.state.volume)},t.onSinkMutedChanged=function(e){this.postMessage("setMuted",[e]),this.emitter.emit(s.a.MUTED_CHANGED)},t.onSinkPlaybackRateChanged=function(e){this.postMessage("setPlaybackRate",[e])},t.onPassthroughSinkMetadata=function(e,t,i,n,r){this.emitter.emit(s.a.TEXT_METADATA_CUE,{description:n,endTime:t,startTime:e,text:i,owner:r,type:"TextMetadataCue"})},t.onSinkControlsChanged=function(e){this.postMessage("setControls",[e])},t.onSinkGapJump=function(e){this.postMessage("onClientSinkGapJump",[e])},t.onRemoteDevice=function(e){this.emitter.emit(e?N.a.AVAILABLE:N.a.UNAVAILABLE)},t.onRemoteReconnect=function(){this.startRemotePlayback()},t.onSessionError=function(){var e=l.c;this.postMessage("onClientSinkError",[e,0,"Chromecast session error"])},t.onLoadMediaError=function(){var e=l.c;this.postMessage("onClientSinkError",[e,0,"Chromecast load media failed"])},t.onUserCancel=function(){this.endRemotePlayback(),this.emitter.emit(N.a.SESSION_ENDED)},t.onSessionStop=function(){this.endRemotePlayback(),this.emitter.emit(N.a.SESSION_ENDED)},t.onSessionStarted=function(e){this.emitter.emit(N.a.SESSION_STARTED,e)},t.attemptPlay=function(){var e=Object(pe.e)(document).hidden;!document[e]&&this.isLoaded&&this.postMessage("play")},t.postMessage=function(e,t,i){void 0===i&&(i=[]),this.worker.postMessage({id:this.id,funcName:e,args:t},i)},t.resetState=function(){Object(pe.g)(this.state,{state:U.a.IDLE,quality:{name:"",group:"",codecs:"",bitrate:0,width:0,height:0,framerate:0},qualities:[],duration:0,startOffset:0,sessionData:{},volume:1,statistics:{bitrate:0,framerate:0,droppedFrames:0,decodeFrames:0,renderedFrames:0}}),this.emitter.emit(s.a.DURATION_CHANGED,0),this.seekTime=null,this.isLoaded=!1},t.attachHandlers=function(){var e=this;this.worker.addEventListener("message",this.onmessage);var t=Object(pe.e)(document).visibilityChange;document.addEventListener(t,this.onvisibilitychange),window.addEventListener("online",this.onOnline),window.addEventListener("offline",this.onOffline);var i=this.emitter;i.on(s.a.VOLUME_CHANGED,(function(){return e.onVolumeChanged()})),i.on(s.a.MUTED_CHANGED,(function(){return e.onMutedChanged()})),i.on(s.a.SEEK_COMPLETED,(function(){return e.onSeekCompleted()})),i.on(s.a.ERROR,(function(){return e.onError()})),i.on(s.a.SESSION_DATA,(function(t){return e.onSessionData(t)})),i.on(he.STATE_CHANGED,(function(t){return e.onStateChanged(t)})),i.on(he.MEDIA_SINK_RPC,(function(t){return e.mediaSinkManager.applyRPC(t)})),i.on(he.CONFIGURE,(function(t){return e.mediaSinkManager.configure(t)})),i.on(he.RESET,(function(){return e.mediaSinkManager.reset()})),i.on(V.a.ID3,(function(t){return e.onID3(t)})),i.on(he.GET_EXPERIMENTS,(function(t){e.experiments=t})),i.on(he.PROPERTY_CHANGED,(function(t){var i=t.key,n=t.value;e.state[i]=n})),i.on(he.LOG_MESSAGE,(function(e){var t=e.level,i=e.message;return console[t](i)}))},t.onVolumeChanged=function(){var e=Object(pe.e)(document).hidden;this.pauseHiddenSilentTab&&document[e]&&0===this.getVolume()&&this.postMessage("pause")},t.onMutedChanged=function(){var e=Object(pe.e)(document).hidden;this.pauseHiddenSilentTab&&document[e]&&this.isMuted()&&this.postMessage("pause")},t.onSeekCompleted=function(){this.seekTime=null},t.onError=function(){this.paused=!0},t.onStateChanged=function(e){var t=this;switch(e){case U.a.READY:var i=Object(pe.d)(this.state.qualities,this.isQualitySupported);this.state.qualities=i.supported,i.unsupported.forEach((function(e){return t.postMessage("removeQuality",[e])})),this.isLoaded=!0,this.autoPlayOptions&&this.play(),this.paused||this.attemptPlay();break;case U.a.ENDED:this.paused=!0}this.emitter.emit(s.a.STATE_CHANGED,e),this.emitter.emit(e)},t.onID3=function(e){var t=this;e.forEach((function(e){if("TXXX"===e.id&&"segmentmetadata"===e.desc&&e.info.length){var i=Object(pe.h)(e.info[0]);if(Object.prototype.hasOwnProperty.call(i,"stream_offset")){var n=Number(i.stream_offset);isNaN(n)||(t.state.startOffset=n-t.getPosition())}}}))},t.onVisibilityChange=function(){var e=Object(pe.e)(document).hidden;this.paused||document[e]||this.attemptPlay(),this.pauseHiddenSilentTab&&!this.paused&&document[e]&&(this.isMuted()||0===this.getVolume())&&this.postMessage("pause"),Object(o.a)().firefox||this.postMessage("setVisible",[!document[e]])},t.onSessionData=function(e){Object(pe.g)(this.state,e)},t.onWorkerMessage=function(e){var t=e.data;if(t&&t.id===this.id){var i=this.workerMessageProcessors.reduce((function(e,t){return t(e)}),t),n=i.type,r=i.arg;void 0!==t.arg?this.emitter.emit(n,r):this.emitter.emit(n)}},t.processVideoElementAttributes=function(e){if(e.hasAttribute("autoplay")&&(e.removeAttribute("autoplay"),this.setAutoplay(!0)),e.hasAttribute("playbackRate")){var t=parseFloat(e.getAttribute("playbackRate"));if(!isNaN(t)){var i=Object(pe.a)(t,.25,2);this.setPlaybackRate(i)}e.removeAttribute("playbackRate")}if(e.hasAttribute("src")){var n=e.src;Object(pe.b)(e),this.load(n)}if(e.hasAttribute("loop")&&(e.removeAttribute("loop"),this.setLooping(!0)),e.hasAttribute("muted")&&(e.removeAttribute("muted"),this.setMuted(!0)),e.hasAttribute("volume")){var r=parseFloat(e.getAttribute("volume"));isNaN(r)||this.setVolume(Object(pe.a)(r,0,1)),e.removeAttribute("volume")}},e}();r()(Se,"instanceId",0);var ke=i(18),be=function(){function e(e){var t=this;r()(this,"workerPort",void 0),r()(this,"emitter",void 0),r()(this,"messageQueue",void 0),this.workerPort={postMessage:this.postMessageFromWorker.bind(this),onmessage:function(){}},this.emitter=new ge.EventEmitter,this.messageQueue=new ke.a,this.loadScript(e,(function(e){return t.applyWorkerEnv(e)}))}var t=e.prototype;return t.postMessage=function(e){this.messageQueue?this.messageQueue.push(e):this.postMessageToWorker(e)},t.addEventListener=function(e,t){this.emitter.on(e,t)},t.removeEventListener=function(e,t){this.emitter.off(e,t)},t.onmessage=function(){},t.onmessageerror=function(){},t.onerror=function(){},t.terminate=function(){},t.dispatchEvent=function(){return!0},t.loadScript=function(e,t){var i=this,n=new XMLHttpRequest;n.open("GET",e),n.addEventListener("load",(function(){n.status>=200&&n.status<400?t(n.response):i.emitter.emit("error",new Error(n.statusText))})),n.addEventListener("error",(function(e){i.emitter.emit("error",e)})),n.send()},t.applyWorkerEnv=function(e){try{Function("self","messageHandler",e)(window,this.workerPort)}catch(e){return void this.emitter.emit("error",e)}for(;!this.messageQueue.empty();)this.postMessageToWorker(this.messageQueue.pop());this.messageQueue=null},t.postMessageFromWorker=function(e){var t=this;setTimeout((function(){t.emitter.emit("message",{data:e})}),0)},t.postMessageToWorker=function(e){var t=this;setTimeout((function(){t.workerPort.onmessage({data:e})}),0)},e}();function Te(e,t,i){var n;return void 0===i&&(i=!1),(n=Object(o.a)().msIE?new be(e):Object(pe.f)(e)?new Worker(e):new Worker(URL.createObjectURL(new Blob(["importScripts('"+e+"')"])))).postMessage({wasmBinaryUrl:t,showWorkerLogs:i}),n}var Ce="undefined"!=typeof window&&"object"==typeof window.WebAssembly&&"function"==typeof window.WebAssembly.instantiate,Pe=Ce;function Ae(e){var t=e.asmWorker,i=e.wasmWorker,n=e.wasmBinary;if(!Pe&&!t)throw new Error("WebAssembly is not supported by the browser. This is required for playback.");var r=Te(Pe?i:t,n,e.showWorkerLog);return new Me(e,r)}var Me=function(){function e(e,t){r()(this,"core",void 0),this.core=new Se(e,t)}var t=e.prototype;return t.addEventListener=function(e,t){this.checkCore()&&this.core.addEventListener(e,t)},t.attachHTMLVideoElement=function(e){this.checkCore()&&this.core.attachHTMLVideoElement(e)},t.delete=function(){this.checkCore()&&(this.core.delete(),this.core=null)},t.endRemotePlayback=function(){this.checkCore()&&this.core.endRemotePlayback()},t.isAutoplay=function(){if(this.checkCore())return this.core.isAutoplay()},t.isAutoQualityMode=function(){if(this.checkCore())return this.core.isAutoQualityMode()},t.getAverageBitrate=function(){if(this.checkCore())return this.core.getAverageBitrate()},t.getBandwidthEstimate=function(){if(this.checkCore())return this.core.getBandwidthEstimate()},t.getBufferDuration=function(){if(this.checkCore())return this.core.getBufferDuration()},t.getBuffered=function(){if(this.checkCore())return this.core.getBuffered()},t.getDecodedFrames=function(){if(this.checkCore())return this.core.getDecodedFrames()},t.getDisplayHeight=function(){if(this.checkCore())return this.core.getDisplayHeight()},t.getDisplayWidth=function(){if(this.checkCore())return this.core.getDisplayWidth()},t.getDroppedFrames=function(){if(this.checkCore())return this.core.getDroppedFrames()},t.getDuration=function(){if(this.checkCore())return this.core.getDuration()},t.getExperiments=function(){if(this.checkCore())return this.core.getExperiments()},t.getHTMLVideoElement=function(){if(this.checkCore())return this.core.getHTMLVideoElement()},t.getLiveLatency=function(){if(this.checkCore())return this.core.getLiveLatency()},t.getPath=function(){if(this.checkCore())return this.core.getPath()},t.getProtocol=function(){if(this.checkCore())return this.core.getProtocol()},t.getPlaybackRate=function(){if(this.checkCore())return this.core.getPlaybackRate()},t.getPosition=function(){if(this.checkCore())return this.core.getPosition()},t.getQualities=function(){if(this.checkCore())return this.core.getQualities()},t.getQuality=function(){if(this.checkCore())return this.core.getQuality()},t.getSessionData=function(){if(this.checkCore())return this.core.getSessionData()},t.getSessionId=function(){if(this.checkCore())return this.core.getSessionId()},t.getStartOffset=function(){if(this.checkCore())return this.core.getStartOffset()},t.getState=function(){if(this.checkCore())return this.core.getState()},t.getVersion=function(){if(this.checkCore())return this.core.getVersion()},t.getVideoBitRate=function(){if(this.checkCore())return this.core.getVideoBitRate()},t.getVideoFrameRate=function(){if(this.checkCore())return this.core.getVideoFrameRate()},t.getVideoHeight=function(){if(this.checkCore())return this.core.getVideoHeight()},t.getVideoWidth=function(){if(this.checkCore())return this.core.getVideoWidth()},t.getVolume=function(){if(this.checkCore())return this.core.getVolume()},t.isLiveLowLatency=function(){if(this.checkCore())return this.core.isLiveLowLatency()},t.isLooping=function(){if(this.checkCore())return this.core.isLooping()},t.isMuted=function(){if(this.checkCore())return this.core.isMuted()},t.isPaused=function(){if(this.checkCore())return this.core.isPaused()},t.isProtected=function(){if(this.checkCore())return this.core.isProtected()},t.isSeeking=function(){if(this.checkCore())return this.core.isSeeking()},t.load=function(e,t){if(void 0===t&&(t=""),this.checkCore())return this.core.load(e,t)},t.pause=function(){this.checkCore()&&this.core.pause()},t.play=function(){this.checkCore()&&this.core.play()},t.removeEventListener=function(e,t){this.checkCore()&&this.core.removeEventListener(e,t)},t.seekTo=function(e){this.checkCore()&&this.core.seekTo(e)},t.setAuthToken=function(e){this.checkCore()&&this.core.setAuthToken(e)},t.setAutoInitialBitrate=function(e){this.checkCore()&&this.core.setAutoInitialBitrate(e)},t.setAutoMaxQuality=function(e){this.checkCore()&&this.core.setAutoMaxQuality(e)},t.setAutoMaxBitrate=function(e){this.checkCore()&&this.core.setAutoMaxBitrate(e)},t.setAutoMaxVideoSize=function(e,t){this.checkCore()&&this.core.setAutoMaxVideoSize(e,t)},t.setAutoplay=function(e){this.checkCore()&&this.core.setAutoplay(e)},t.setAutoPlayOptions=function(e){this.checkCore()&&this.core.setAutoPlayOptions(e)},t.setAutoQualityMode=function(e){this.checkCore()&&this.core.setAutoQualityMode(e)},t.setAutoViewportSize=function(e,t){this.checkCore()&&this.core.setAutoViewportSize(e,t)},t.setClientId=function(e){this.checkCore()&&this.core.setClientId(e)},t.setDeviceId=function(e){this.checkCore()&&this.core.setDeviceId(e)},t.setExperiment=function(e,t){this.checkCore()&&this.core.setExperiment(e,t)},t.setExperimentData=function(e){this.core.setExperimentData(e)},t.setInitialBufferDuration=function(e){this.checkCore()&&this.core.setInitialBufferDuration(e)},t.setLiveLowLatencyEnabled=function(e){this.checkCore()&&this.core.setLiveLowLatencyEnabled(e)},t.setLiveMaxLatency=function(e){this.checkCore()&&this.core.setLiveMaxLatency(e)},t.setLiveSpeedUpRate=function(e){this.checkCore()&&this.core.setLiveSpeedUpRate(e)},t.setLogLevel=function(e){this.checkCore()&&this.core.setLogLevel(e)},t.setLooping=function(e){this.checkCore()&&this.core.setLooping(e)},t.setMuted=function(e){this.checkCore()&&this.core.setMuted(e)},t.setPlaybackRate=function(e){this.checkCore()&&this.core.setPlaybackRate(e)},t.setPlayerType=function(e){this.checkCore()&&this.core.setPlayerType(e)},t.setQuality=function(e,t){void 0===t&&(t=!1),this.checkCore()&&this.core.setQuality(e,t)},t.setRebufferToLive=function(e){this.checkCore()&&this.core.setRebufferToLive(e)},t.setVisible=function(e){this.checkCore()&&this.core.setVisible(e)},t.setVolume=function(e){this.checkCore()&&this.core.setVolume(e)},t.startRemotePlayback=function(){this.checkCore()&&this.core.startRemotePlayback()},t.setPlatformName=function(e){this.checkCore()&&this.core.setPlatformName(e)},t.setRequestCredentials=function(e){this.checkCore()&&this.core.setRequestCredentials(e)},t.checkCore=function(){return!!this.core||(console.warn("Method called on deleted player instance."),!1)},e}();r()(Me,"isVP9Supported",Se.isVP9Supported)},function(e,t,i){"use strict";i.d(t,"a",(function(){return o}));var n=i(0),r=i.n(n),o=function(){function e(){r()(this,"buffer",void 0),r()(this,"head",void 0),r()(this,"tail",void 0),this.buffer=[],this.head=0,this.tail=0}var t=e.prototype;return t.push=function(e){this.tail===this.buffer.length?this.buffer.push(e):this.buffer[this.tail]=e,this.tail++},t.pop=function(){var e=this.buffer[this.head];return this.buffer[this.head]=null,this.head++,this.empty()&&(this.head=0,this.tail=0),e},t.size=function(){return this.tail-this.head},t.empty=function(){return this.head>=this.tail},e}()},function(e,t,i){"use strict";i.d(t,"a",(function(){return h}));var n=i(22),r=i.n(n),o=i(0),s=i.n(o),a=i(5),u=i(18),c=i(1),d=function(){function e(e,t,i,n){this.rawCodec=t,this.isProtected=i,this.onError=n,s()(this,"pending",void 0),s()(this,"unsubscribers",[]),s()(this,"srcBuf",void 0),s()(this,"blocked",!1),this.srcBuf=e,this.pending=new u.a,this.unsubscribers.push(Object(c.h)(e,"updateend",this.process.bind(this)))}var t=e.prototype;return t.abort=function(){this.schedule((function(e){e.abort()}))},t.appendBuffer=function(e){this.schedule((function(t){try{t.appendBuffer(e)}catch(e){if("QuotaExceededError"!==e.name)throw e;var i=t.buffered,n=i.start(0),r=i.end(i.length-1),o=(n+r)/2;t.remove(o,r)}}))},t.setTimestampOffset=function(e){this.schedule((function(t){t.timestampOffset=e}))},t.remove=function(e,t){this.schedule((function(i){var n=i.buffered;if(n.length){var r=Math.max(e,n.start(0)),o=Math.min(t,n.end(n.length-1));r<o&&i.remove(r,o)}}))},t.block=function(){var e=this;return new Promise((function(t){e.schedule((function(){e.blocked=!0,t()}))}))},t.unblock=function(){this.blocked=!1,this.process()},t.destroy=function(){this.pending=new u.a,this.unsubscribers.forEach((function(e){return e()})),this.srcBuf=void 0},t.schedule=function(e){this.pending.empty()&&this.canProcess()?this.safeExecute(e):(this.pending.push(e),this.process())},t.safeExecute=function(e){try{e(this.srcBuf)}catch(e){this.onError(e,!1)}},t.process=function(){for(;!this.pending.empty()&&this.canProcess();)this.safeExecute(this.pending.pop())},t.canProcess=function(){return this.srcBuf&&!this.srcBuf.updating&&!this.blocked},r()(e,[{key:"buffer",get:function(){return this.srcBuf}},{key:"codec",get:function(){return this.rawCodec}},{key:"timestampOffset",get:function(){return this.buffer?this.buffer.timestampOffset:0}}]),e}(),h=function(){function e(e,t,i){this.mediaSource=e,this.onEnded=t,this.onError=i,s()(this,"sourceBuffers",Object.create(null)),s()(this,"unsubscribers",[]),this.unsubscribers.push(Object(c.h)(e,"sourceended",this.onEnded))}e.isSupported=function(){return void 0!==self.MediaSource},e.isSupportedInWorker=function(){return e.isSupported()&&MediaSource.canConstructInDedicatedWorker},e.create=function(t,i){var n=new MediaSource,r=new Promise((function(r,o){var s=Object(c.h)(n,"sourceopen",(function(){"open"===n.readyState?(r(new e(n,t,i)),s()):o("The MediaSource was closed upon opening")}))}));return{objectURL:URL.createObjectURL(n),sink:r}};var t=e.prototype;return t.addTrack=function(e,t,i){var n=this.mediaSource,r=this.sourceBuffers;if(r[e])return r[e].buffer;try{var o=n.addSourceBuffer("video/mp4;"+t);return r[e]=new d(o,t,i,this.handleError.bind(this)),o}catch(e){this.handleError(e,"open"===n.readyState)}return null},t.append=function(e,t){var i;null==(i=this.sourceBuffers[e])||i.appendBuffer(t)},t.remove=function(e,t){for(var i=this.sourceBuffers,n=0,r=Object.keys(i);n<r.length;n++){i[r[n]].remove(e,t)}},t.setTimestampOffset=function(e,t){var i=this.sourceBuffers[e];i&&(i.abort(),i.setTimestampOffset(t))},t.setDuration=function(e){var t=this;this.scheduleUpdate((function(){return t.mediaSource.duration=e})).catch((function(e){return t.handleError(e,!1)}))},t.setLiveSeekableRange=function(e,t){var i=this;this.scheduleUpdate((function(){return i.mediaSource.setLiveSeekableRange(e,t)})).catch((function(e){return i.handleError(e,!1)}))},t.scheduleUpdate=function(e){var t=this;void 0===e&&(e=l);var i=Object.keys(this.sourceBuffers).map((function(e){return t.sourceBuffers[e]}));return Promise.all(i.map((function(e){return e.block()}))).then(e).then((function(){return i.forEach((function(e){return e.unblock()}))}))},t.destroy=function(){this.destroySourceBuffers(),this.unsubscribers.forEach((function(e){return e()})),this.unsubscribers=[]},t.handleError=function(e,t){var i=e.code||a.g,n=a.g;"NotSupportedError"===e.name&&(n=i=a.f),this.onError(n,i,e.message,t)},t.destroySourceBuffers=function(){for(var e=this.mediaSource,t=e.sourceBuffers,i=0;i<t.length;i++)try{e.removeSourceBuffer(t[i])}catch(e){this.handleError(e,!1)}for(var n=0,r=Object.keys(this.sourceBuffers);n<r.length;n++){var o=r[n];this.sourceBuffers[o].destroy()}this.sourceBuffers=Object.create(null)},r()(e,[{key:"duration",get:function(){return this.mediaSource.duration}},{key:"bufferProperties",get:function(){var e=this.sourceBuffers;return Object.keys(e).map((function(t){var i=e[t];return{trackID:Number(t),codec:i.codec,mode:"mse",path:"",isProtected:i.isProtected}}))}}]),e}(),l=function(){}},function(e,t){},function(e,t,i){"use strict";var n,r;i.d(t,"b",(function(){return n})),i.d(t,"a",(function(){return r})),function(e){e.GENERIC="Error",e.NOT_SUPPORTED="ErrorNotSupported",e.NO_SOURCE="ErrorNoSource",e.INVALID_DATA="ErrorInvalidData",e.INVALID_STATE="ErrorInvalidState",e.INVALID_PARAMETER="ErrorInvalidParameter",e.TIMEOUT="ErrorTimeout",e.NETWORK="ErrorNetwork",e.NETWORK_IO="ErrorNetworkIO",e.AUTHORIZATION="ErrorAuthorization",e.NOT_AVAILABLE="ErrorNotAvailable"}(n||(n={})),function(e){e[e.GEOBLOCKED=1]="GEOBLOCKED",e[e.UNSUPPORTED_DEVICE=2]="UNSUPPORTED_DEVICE",e[e.ANONYMIZER_BLOCKED=3]="ANONYMIZER_BLOCKED",e[e.CELLULAR_NETWORK_PROHIBITED=4]="CELLULAR_NETWORK_PROHIBITED",e[e.UNAUTHORIZATION_ENTITLEMENTS=5]="UNAUTHORIZATION_ENTITLEMENTS",e[e.VOD_RESTRICTED=6]="VOD_RESTRICTED"}(r||(r={}))},function(e,t){e.exports=__webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js")},function(e,t){e.exports=__webpack_require__(/*! events */ "./node_modules/events/events.js")},function(e,t,i){"use strict";(function(e){i.d(t,"a",(function(){return p}));var n=i(9),r=i.n(n),o=i(2),s=i.n(o),a=i(10),u=i.n(a),c=i(0),d=i.n(c),h=i(6),l=i.n(h),f=i(12),m=i(13),p=function(t){function i(e){var n;return n=t.call(this)||this,d()(s()(n),"remotePlayer",void 0),d()(s()(n),"remotePlayerController",void 0),d()(s()(n),"listener",void 0),d()(s()(n),"seekTime",void 0),d()(s()(n),"currentDuration",void 0),n.listener=e,n.currentDuration=0,i.prepareCastContext().then((function(){n.remotePlayer=new cast.framework.RemotePlayer,n.remotePlayerController=new cast.framework.RemotePlayerController(n.remotePlayer)})).catch((function(){n.listener.onSessionError()})),n}u()(i,t),i.canCast=function(){return Object(f.a)().chrome},i.stopLookingForRemotePlaybackDevices=function(e){window.cast&&window.cast.framework&&cast.framework.CastContext.getInstance().removeEventListener(cast.framework.CastContextEventType.CAST_STATE_CHANGED,e)},i.lookForRemotePlaybackDevices=function(){var e=r()(l.a.mark((function e(t){var n,r;return l.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,i.prepareCastContext();case 3:return n=e.sent,r=function(e){switch(e.castState){case cast.framework.CastState.NO_DEVICES_AVAILABLE:break;case cast.framework.CastState.NOT_CONNECTED:t.onRemoteDevice(!0);break;case cast.framework.CastState.CONNECTED:var i=n.getCurrentSession();i&&i.getSessionState()===cast.framework.SessionState.SESSION_RESUMED&&t.onRemoteReconnect()}},n.addEventListener(cast.framework.CastContextEventType.CAST_STATE_CHANGED,r),n.setOptions({receiverApplicationId:"B3DCF968",autoJoinPolicy:chrome.cast.AutoJoinPolicy.TAB_AND_ORIGIN_SCOPED}),e.abrupt("return",r);case 10:e.prev=10,e.t0=e.catch(0),t.onRemoteDevice(!1);case 13:case"end":return e.stop()}}),e,null,[[0,10]])})));return function(t){return e.apply(this,arguments)}}(),i.prepareCastContext=function(){var t=r()(l.a.mark((function t(){return l.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(!window.cast||!window.cast.framework){t.next=2;break}return t.abrupt("return",Promise.resolve(cast.framework.CastContext.getInstance()));case 2:return t.abrupt("return",new Promise((function(t,i){if(e.__onGCastApiAvailable=function(e){e?t(cast.framework.CastContext.getInstance()):i()},!document.getElementById("pc-chromecast-sender")){var n=document.createElement("script");n.id="pc-chromecast-sender",n.onerror=function(){document.body.removeChild(n),e.__onGCastApiAvailable=function(){},i()},n.async=!0,n.src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1",document.body.appendChild(n)}})));case 3:case"end":return t.stop()}}),t)})));return function(){return t.apply(this,arguments)}}();var n=i.prototype;return n.configure=function(){var e=r()(l.a.mark((function e(t){var n,r,o,s,a,u;return l.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=t.path,e.prev=1,e.next=4,i.prepareCastContext();case 4:if(r=e.sent,o=r.getCurrentSession()){e.next=13;break}return e.next=9,r.requestSession();case 9:o=r.getCurrentSession(),this.setupRemotePlayerListeners(o),e.next=14;break;case 13:o.getSessionState()===cast.framework.SessionState.SESSION_RESUMED&&this.setupRemotePlayerListeners(o);case 14:return(s=new chrome.cast.media.MediaInfo(n,"")).streamType=chrome.cast.media.StreamType.BUFFERED,a=new chrome.cast.media.GenericMediaMetadata,s.metadata=a,s.customData={analytics:{chromecast_sender:"player-core",platform:"web"}},this.remotePlayerController.stop(),u=new chrome.cast.media.LoadRequest(s),this.seekTime>0&&(u.currentTime=this.seekTime,this.seekTime=0),this.currentDuration=0,e.next=25,o.loadMedia(u);case 25:e.next=30;break;case 27:return e.prev=27,e.t0=e.catch(1),e.abrupt("return",this.handleError(e.t0));case 30:case"end":return e.stop()}}),e,this,[[1,27]])})));return function(t){return e.apply(this,arguments)}}(),n.stopMedia=function(){var e=r()(l.a.mark((function e(t){var n,r;return l.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return void 0===t&&(t=!0),e.next=3,i.prepareCastContext();case 3:n=e.sent,(r=n.getCurrentSession())&&r.getSessionState()!==cast.framework.SessionState.SESSION_RESUMED&&r.endSession(t);case 6:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),n.invoke=function(e){this[e.name].call(this,e.arg)},n.play=function(){this.remotePlayer&&this.remotePlayer.isPaused&&this.remotePlayerController.playOrPause()},n.pause=function(){this.remotePlayer&&!this.remotePlayer.isPaused&&this.remotePlayerController.playOrPause()},n.seekTo=function(e){this.remotePlayer&&(this.remotePlayer.playerState!==chrome.cast.media.PlayerState.IDLE?(this.remotePlayer.currentTime=e,this.remotePlayerController.seek()):this.seekTime=e)},n.getCurrentTime=function(){return this.remotePlayer?this.remotePlayer.currentTime:0},n.delete=function(){this.remotePlayer&&this.stopMedia()},n.setMuted=function(e){this.remotePlayer&&e!==this.remotePlayer.isMuted&&this.remotePlayerController.muteOrUnmute()},n.isMuted=function(){return!!this.remotePlayer&&this.remotePlayer.isMuted},n.setVolume=function(e){this.remotePlayer&&(this.remotePlayer.volumeLevel=e,this.remotePlayerController.setVolumeLevel())},n.getVolume=function(){return this.remotePlayer?this.remotePlayer.volumeLevel:0},n.getDevice=function(){var e=r()(l.a.mark((function e(){var t,n;return l.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,i.prepareCastContext();case 2:if(t=e.sent,!(n=t.getCurrentSession())){e.next=6;break}return e.abrupt("return",n.getCastDevice().friendlyName);case 6:case"end":return e.stop()}}),e)})));return function(){return e.apply(this,arguments)}}(),n.setupRemotePlayerListeners=function(e){var t=this,i=function(){var i=r()(l.a.mark((function i(){var n,r;return l.a.wrap((function(i){for(;;)switch(i.prev=i.next){case 0:(n=e.getMediaSession())&&(r=n.media,0===t.currentDuration&&null===r.duration&&(t.currentDuration=1/0,t.listener.onSinkDurationChanged(t.currentDuration)),t.listener.onSinkTimeUpdate());case 2:case"end":return i.stop()}}),i)})));return function(){return i.apply(this,arguments)}}(),n=function(){switch(t.remotePlayer.playerState){case chrome.cast.media.PlayerState.BUFFERING:t.listener.onSinkIdle();break;case chrome.cast.media.PlayerState.PLAYING:t.listener.onSinkPlaying(!1);break;case chrome.cast.media.PlayerState.IDLE:var i=e.getMediaSession();i&&i.idleReason===chrome.cast.media.IdleReason.FINISHED&&t.listener.onSinkEnded()}},o=function(){t.listener.onSinkVolumeChanged(t.remotePlayer.volumeLevel,!0)},s=function(){t.listener.onSinkMutedChanged(t.remotePlayer.isMuted)},a=function(){0!==t.remotePlayer.duration&&(t.currentDuration=t.remotePlayer.duration,t.listener.onSinkDurationChanged(t.currentDuration))},u=function(){t.remotePlayerController.removeEventListener(cast.framework.RemotePlayerEventType.CURRENT_TIME_CHANGED,i),t.remotePlayerController.removeEventListener(cast.framework.RemotePlayerEventType.PLAYER_STATE_CHANGED,n),t.remotePlayerController.removeEventListener(cast.framework.RemotePlayerEventType.VOLUME_LEVEL_CHANGED,o),t.remotePlayerController.removeEventListener(cast.framework.RemotePlayerEventType.IS_MUTED_CHANGED,s),t.remotePlayerController.removeEventListener(cast.framework.RemotePlayerEventType.DURATION_CHANGED,a),t.listener.onSessionStop()};e.addEventListener(cast.framework.SessionEventType.MEDIA_SESSION,(function(){t.remotePlayerController.addEventListener(cast.framework.RemotePlayerEventType.CURRENT_TIME_CHANGED,i),t.remotePlayerController.addEventListener(cast.framework.RemotePlayerEventType.PLAYER_STATE_CHANGED,n),t.remotePlayerController.addEventListener(cast.framework.RemotePlayerEventType.VOLUME_LEVEL_CHANGED,o),t.remotePlayerController.addEventListener(cast.framework.RemotePlayerEventType.IS_MUTED_CHANGED,s),t.remotePlayerController.addEventListener(cast.framework.RemotePlayerEventType.DURATION_CHANGED,a),t.listener.onSessionStarted(e.getCastDevice().friendlyName)}));var c=e.getSessionObj();c.addUpdateListener((function(){c.status===chrome.cast.SessionStatus.STOPPED&&u()})),c.addMediaListener(u)},n.handleError=function(e){if(chrome.cast)switch(e){case chrome.cast.ErrorCode.SESSION_ERROR:this.listener.onSessionError();break;case chrome.cast.ErrorCode.RECEIVER_UNAVAILABLE:this.listener.onRemoteDevice(!1);break;case chrome.cast.ErrorCode.LOAD_MEDIA_FAILED:this.listener.onLoadMediaError();break;case chrome.cast.ErrorCode.CANCEL:this.listener.onUserCancel();break;default:this.listener.onSinkError({value:1,code:0,message:"Error requesting chromecast session"})}else this.listener.onSinkError({value:1,code:0,message:"Error loading chromecast SDK"})},i}(m.a)}).call(this,i(26))},function(e,t){},function(e,t){var i;i=function(){return this}();try{i=i||new Function("return this")()}catch(e){"object"==typeof window&&(i=window)}e.exports=i},function(e,t,i){"use strict";var n;i.d(t,"a",(function(){return n})),function(e){e.UNKNOWN="Unspecified",e.FILE="File",e.SEGMENT="Segment",e.SOURCE="Source",e.DECODER="Decode",e.RENDERER="Render",e.MASTER_PLAYLIST="MasterPlaylist",e.MEDIA_PLAYLIST="MediaPlaylist"}(n||(n={}))},function(e,t){},function(e,t){},function(e,t){},function(e,t){},function(e,t,i){"use strict";var n;i.d(t,"a",(function(){return n})),function(e){e.DEBUG="debug",e.INFO="info",e.WARN="warn",e.ERROR="error"}(n||(n={}))},function(e,t,i){"use strict";i.d(t,"a",(function(){return o}));var n=i(3),r=i(8);function o(e){if(void 0===e||"function"!=typeof e.getTech){throw{message:"videojs not available, Amazon IVS Quality Plugin not registered",code:1}}if(!e.getPlugin("enableIVSQualityPlugin")){var t=e.getComponent("MenuButton"),i=e.getComponent("MenuItem"),o=e.extend(i,{constructor:function(e,t){var n=t.quality;i.call(this,e,{selectable:!0,label:n.name}),this.quality=n},handleClick:function(e){i.prototype.handleClick.call(this,e);var t=this.player().getIVSPlayer();"auto"===this.quality.group?t.setAutoQualityMode(!0):t.setQuality(this.quality)}}),s=e.extend(t,{constructor:function(e){t.call(this,e,{}),this.controlText("Quality")},createItems:function(){var e=this.player(),t=e.getIVSPlayer(),i=[],r=new o(e,{quality:{group:"auto",name:"Auto"}});r.selected(t.isAutoQualityMode()),r.on("click",this._clickHandler.bind(this,r)),r.on("tap",this._clickHandler.bind(this,r)),i.push(r);var s=t.getQuality(),a=t.getQualities();a&&a.length>0&&a.forEach(function(n){var r=new o(e,{quality:n});r.on("click",this._clickHandler.bind(this,r)),r.on("tap",this._clickHandler.bind(this,r)),t.isAutoQualityMode()||r.selected(s.group===n.group),i.push(r)}.bind(this));return t.addEventListener(n.a.QUALITY_CHANGED,(function(e){i.forEach((function(i){!t.isAutoQualityMode()&&e&&i&&i.quality&&i.selected(e.group===i.quality.group)}))})),i},buildCSSClass:function(){return"vjs-icon-hd vjs-icon-placeholder "+t.prototype.buildCSSClass.call(this)},_clickHandler:function(e){this.items.forEach((function(t){t!==e&&t.selected(!1)}))}});e.registerComponent("QualityMenuButton",s),(e.registerPlugin||e.plugin)("enableIVSQualityPlugin",(function(){var e=this;e.getIVSPlayer().addEventListener(r.a.READY,(function(){var t=e.controlBar.getChild("QualityMenuButton");t&&(t.dispose(),e.controlBar.removeChild(t)),e.controlBar.addChild("QualityMenuButton")}))}))}}},function(e,t){},function(e,t,i){"use strict";i.d(t,"a",(function(){return l}));var n,r,o,s=i(21),a=i(11),u=i(3),c=i(8),d=i(17);!function(e){e.DURATION_CHANGE="durationchange",e.ENDED="ended",e.ERROR="error",e.LOADED_METADATA="loadedmetadata",e.LOADSTART="loadstart",e.PAUSE="pause",e.PLAY="play",e.PLAYING="playing",e.RATE_CHANGE="ratechange",e.SEEKED="seeked",e.SEEKING="seeking",e.TIME_UPDATE="timeupdate",e.VOLUME_CHANGE="volumechange",e.WAITING="waiting"}(n||(n={})),function(e){e[e.HAVE_NOTHING=0]="HAVE_NOTHING",e[e.HAVE_METADATA=1]="HAVE_METADATA",e[e.HAVE_CURRENT_DATA=2]="HAVE_CURRENT_DATA",e[e.HAVE_FUTURE_DATA=3]="HAVE_FUTURE_DATA",e[e.HAVE_ENOUGH_DATA=4]="HAVE_ENOUGH_DATA"}(o||(o={}));var h=((r={})[c.a.IDLE]=1,r[c.a.READY]=1,r[c.a.BUFFERING]=2,r[c.a.PLAYING]=2,r[c.a.ENDED]=1,r);function l(e,t){if(void 0===e||"function"!=typeof e.getTech){throw{message:"videojs not available, AmazonIVS tech not registered",code:1}}if(!d.d){throw{message:"WebAssembly support is required for AmazonIVS tech",code:2}}if(!e.getTech("AmazonIVS")){var i=e.getTech("Tech"),r=e.extend(i,{constructor:function(n,r){this._readyState=o.HAVE_NOTHING,this._defaultPlaybackRate=1,t.playerFramework={name:"videojs",version:e.VERSION},this._mediaPlayer=Object(d.b)(t),this._mediaPlayer.setAutoplay(!0===n.autoplay),this._attachVideojsListeners(),this._mediaPlayer.addEventListener(u.a.METADATA,this._onCaptionEvent.bind(this)),this.featuresProgressEvents=!0,this.featuresTimeupdateEvents=!0,this.featuresPlaybackRate=!0,this.featuresFullscreenResize=!0,this.featuresVolumeControl=!0,this.featuresMuteControl=!0,this.featuresNativeTextTracks=!1,i.call(this,n,r),window.vttjs&&window.vttjs.restore(),this.triggerReady(),setTimeout(function(){this.options_.loop&&this._mediaPlayer.setLooping(!0),this.options_.muted&&this._mediaPlayer.setMuted(!0)}.bind(this),0)},dispose:function(){this._mediaPlayer.delete()},setPreload:function(){},autoplay:function(e){if("boolean"!=typeof e)return this._mediaPlayer.autoplay;this.setAutoplay(e)},setAutoplay:function(e){this._mediaPlayer.setAutoplay(e)},preload:function(){},load:function(){},readyState:function(){return this._readyState},networkState:function(){if(!this._mediaPlayer)return 0;if(!this._mediaPlayer.getHTMLVideoElement().src)return 3;var e=this._mediaPlayer.getState();return h[e]},ended:function(){return this._mediaPlayer.getState()===c.a.ENDED},seekable:function(){return e.createTimeRange(0,this._mediaPlayer.getDuration())},play:function(){this._mediaPlayer.play(),this.trigger(n.PLAY)},pause:function(){this._mediaPlayer.pause()},setCurrentTime:function(e){this._mediaPlayer.getHTMLVideoElement().src&&(this._mediaPlayer.seekTo(e),this.trigger(n.SEEKING))},controls:function(){return!1},setControls:function(){return!1},muted:function(){return this._mediaPlayer.isMuted()},setMuted:function(e){this._mediaPlayer.setMuted(e)},volume:function(){return this._mediaPlayer.getVolume()},setVolume:function(e){this._mediaPlayer.setVolume(e)},defaultPlaybackRate:function(e){if(!e)return this._defaultPlaybackRate;this._defaultPlaybackRate=e},playbackRate:function(){return this._mediaPlayer.getPlaybackRate()},setPlaybackRate:function(e){this._mediaPlayer.setPlaybackRate(e)},paused:function(){return this._mediaPlayer.isPaused()},duration:function(){return this._mediaPlayer.getDuration()},currentTime:function(){return this._mediaPlayer.getPosition()},createEl:function(){var e=this._mediaPlayer.getHTMLVideoElement();e.setAttribute("class","vjs-tech"),void 0!==this.options_.disablePictureInPicture&&(e.disablePictureInPicture=this.options_.disablePictureInPicture),["preload","poster"].forEach(function(t){this.options_[t]&&e.setAttribute(t,this.options_[t])}.bind(this)),this.options_.playsinline&&(e.setAttribute("webkit-playsinline",""),e.setAttribute("playsinline",""));var t=document.createElement("div");return t.appendChild(e),t},src:function(e){this.trigger(n.LOADSTART),this._captionTrack&&(this.textTracks().removeTrack(this._captionTrack),this._captionTrack=null),e&&this._mediaPlayer.load(e)},addEventListener:function(e,t){this._mediaPlayer.addEventListener(e,t)},removeEventListener:function(e,t){this._mediaPlayer.removeEventListener(e,t)},getMediaPlayerAPI:function(){return this._mediaPlayer},supportsFullScreen:function(){return!0},enterFullScreen:function(){var e=this._mediaPlayer.getHTMLVideoElement();(e.requestFullscreen||e.webkitRequestFullscreen||e.mozRequestFullScreen||e.msRequestFullscreen||e.webkitEnterFullscreen||function(){console.error("Fullscreen API is not available")}).call(e)},exitFullScreen:function(){(document.exitFullScreen||document.webkitExitFullscreen||document.mozCancelFullScreen||document.msExitFullscreen||function(){console.error("Exitscreen API is not available")}).call(document)},requestPictureInPicture:function(){return this._mediaPlayer.getHTMLVideoElement().requestPictureInPicture()},setDisablePictureInPicture:function(e){this._mediaPlayer.getHTMLVideoElement().disablePictureInPicture=e},disablePictureInPicture:function(){return this._mediaPlayer.getHTMLVideoElement().disablePictureInPicture},_onCaptionEvent:function(e){if("text/json"===e.type){var t=JSON.parse(e.data);if(t.caption){var i=t.caption;this._captionTrack||(this._captionTrack=this.addTextTrack("captions",i.format),this._currentCue=null),this._currentCue&&this._captionTrack.removeCue(this._currentCue);var n=this._mediaPlayer.getHTMLVideoElement(),r=window.VTTCue||window.vttjs.VTTCue;r?(this._currentCue=new r(n.currentTime,n.currentTime+2,i.text),this._captionTrack.addCue(this._currentCue)):console.warn("No VTTCue implementation available, caption may not be available")}}},_attachVideojsListeners:function(){this._mediaPlayer.addEventListener(c.a.READY,function(){this._readyState=o.HAVE_METADATA,this.trigger(n.LOADED_METADATA)}.bind(this)),this._mediaPlayer.addEventListener(c.a.IDLE,function(){this._readyState=o.HAVE_NOTHING,this.trigger(n.PAUSE)}.bind(this)),this._mediaPlayer.addEventListener(c.a.PLAYING,function(){this._readyState<=o.HAVE_CURRENT_DATA&&(this._readyState=o.HAVE_FUTURE_DATA),this.trigger(n.PLAY),this.trigger(n.PLAYING)}.bind(this)),this._mediaPlayer.addEventListener(c.a.ENDED,function(){this._readyState=o.HAVE_NOTHING,this.trigger(n.ENDED)}.bind(this)),this._mediaPlayer.addEventListener(c.a.BUFFERING,function(){this._readyState=o.HAVE_CURRENT_DATA}.bind(this)),this._mediaPlayer.addEventListener(u.a.REBUFFERING,function(){this._readyState=o.HAVE_CURRENT_DATA,this.trigger(n.WAITING)}.bind(this)),this._mediaPlayer.addEventListener(u.a.TIME_UPDATE,function(){this.trigger(n.TIME_UPDATE)}.bind(this)),this._mediaPlayer.addEventListener(u.a.VOLUME_CHANGED,function(){this.trigger(n.VOLUME_CHANGE)}.bind(this)),this._mediaPlayer.addEventListener(u.a.MUTED_CHANGED,function(){this.trigger(n.VOLUME_CHANGE)}.bind(this)),this._mediaPlayer.addEventListener(u.a.ERROR,function(){this.trigger(n.ERROR)}.bind(this)),this._mediaPlayer.addEventListener(u.a.DURATION_CHANGED,function(){this.trigger(n.DURATION_CHANGE)}.bind(this)),this._mediaPlayer.addEventListener(u.a.SEEK_COMPLETED,function(){this.trigger(n.SEEKED)}.bind(this)),this._mediaPlayer.addEventListener(u.a.PLAYBACK_RATE_CHANGED,function(){this.trigger(n.RATE_CHANGE)}.bind(this))},techName:"AmazonIVS"});r.supportsFullScreen=function(){return!0},r.isSupported=function(){return-1===(navigator.appVersion||"").toLowerCase().indexOf("rv:11")},r.canPlayType=function(e){return"string"==typeof e&&e.length>0&&(e.indexOf("application/x-mpegURL")>-1?"undefined"!=typeof MediaSource&&MediaSource.isTypeSupported('video/mp4; codecs="avc1.42E01E,mp4a.40.2"'):""!==document.createElement("video").canPlayType(e))},r.canPlaySource=function(){return!0},e.registerTech("AmazonIVS",r);var l=e.registerPlugin||e.plugin;l("getIVSEvents",(function(){return{PlayerEventType:u.a,MetadataEventType:a.a,PlayerState:c.a,ErrorType:s.b}})),l("getIVSPlayer",(function(){return this.tech(!0).getMediaPlayerAPI()}))}}},function(e,t){e.exports=__webpack_require__(/*! bowser */ "./node_modules/bowser/es5.js")},function(e,t){e.exports=__webpack_require__(/*! promise-polyfill */ "./node_modules/promise-polyfill/src/index.js")},function(e,t){e.exports=__webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/extends.js")},,function(e,t,i){e.exports=i(41)},function(e,t,i){"use strict";i.r(t);var n=i(17);i.d(t,"createWorker",(function(){return n.c})),i.d(t,"isWasmSupported",(function(){return n.e})),i.d(t,"isPlayerSupported",(function(){return n.d})),i.d(t,"create",(function(){return n.b})),i.d(t,"MediaPlayer",(function(){return n.a}));var r=i(27);i.d(t,"ErrorSource",(function(){return r.a}));var o=i(21);i.d(t,"ErrorType",(function(){return o.b})),i.d(t,"AuthorizationError",(function(){return o.a}));var s=i(11);i.d(t,"MetadataEventType",(function(){return s.a})),i.d(t,"MetadataID3Type",(function(){return s.b}));var a=i(28);for(var u in a)["default","LogLevel","registerIVSTech","VideoJSEvents","VideoJSIVSTech","VideoJSError","registerIVSQualityPlugin","VideoJSQualityPlugin","isVP9Supported","createWorker","isWasmSupported","isPlayerSupported","create","MediaPlayer","ErrorSource","ErrorType","AuthorizationError","MetadataEventType","MetadataID3Type"].indexOf(u)<0&&function(e){i.d(t,e,(function(){return a[e]}))}(u);var c=i(3);i.d(t,"PlayerEventType",(function(){return c.a}));var d=i(8);i.d(t,"PlayerState",(function(){return d.a}));var h=i(29);for(var u in h)["default","LogLevel","registerIVSTech","VideoJSEvents","VideoJSIVSTech","VideoJSError","registerIVSQualityPlugin","VideoJSQualityPlugin","isVP9Supported","createWorker","isWasmSupported","isPlayerSupported","create","MediaPlayer","ErrorSource","ErrorType","AuthorizationError","MetadataEventType","MetadataID3Type","PlayerEventType","PlayerState"].indexOf(u)<0&&function(e){i.d(t,e,(function(){return h[e]}))}(u);var l=i(25);for(var u in l)["default","LogLevel","registerIVSTech","VideoJSEvents","VideoJSIVSTech","VideoJSError","registerIVSQualityPlugin","VideoJSQualityPlugin","isVP9Supported","createWorker","isWasmSupported","isPlayerSupported","create","MediaPlayer","ErrorSource","ErrorType","AuthorizationError","MetadataEventType","MetadataID3Type","PlayerEventType","PlayerState"].indexOf(u)<0&&function(e){i.d(t,e,(function(){return l[e]}))}(u);var f=i(30);for(var u in f)["default","LogLevel","registerIVSTech","VideoJSEvents","VideoJSIVSTech","VideoJSError","registerIVSQualityPlugin","VideoJSQualityPlugin","isVP9Supported","createWorker","isWasmSupported","isPlayerSupported","create","MediaPlayer","ErrorSource","ErrorType","AuthorizationError","MetadataEventType","MetadataID3Type","PlayerEventType","PlayerState"].indexOf(u)<0&&function(e){i.d(t,e,(function(){return f[e]}))}(u);var m=i(31);for(var u in m)["default","LogLevel","registerIVSTech","VideoJSEvents","VideoJSIVSTech","VideoJSError","registerIVSQualityPlugin","VideoJSQualityPlugin","isVP9Supported","createWorker","isWasmSupported","isPlayerSupported","create","MediaPlayer","ErrorSource","ErrorType","AuthorizationError","MetadataEventType","MetadataID3Type","PlayerEventType","PlayerState"].indexOf(u)<0&&function(e){i.d(t,e,(function(){return m[e]}))}(u);var p=i(32);i.d(t,"LogLevel",(function(){return p.a}));var v=i(35);i.d(t,"registerIVSTech",(function(){return v.a}));var y=i(20);i.d(t,"VideoJSEvents",(function(){return y.VideoJSEvents})),i.d(t,"VideoJSIVSTech",(function(){return y.VideoJSIVSTech})),i.d(t,"VideoJSError",(function(){return y.VideoJSError}));var g=i(33);i.d(t,"registerIVSQualityPlugin",(function(){return g.a}));var E=i(34);i.d(t,"VideoJSQualityPlugin",(function(){return E.VideoJSQualityPlugin}));var S=i(16);i.d(t,"isVP9Supported",(function(){return S.b}));var k=i(14);i.d(t,"RemotePlayerEvent",(function(){return k.a}))}]);

/***/ }),

/***/ "./node_modules/backoff/index.js":
/*!***************************************!*\
  !*** ./node_modules/backoff/index.js ***!
  \***************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

//      Copyright (c) 2012 Mathieu Turcotte
//      Licensed under the MIT license.

var Backoff = __webpack_require__(/*! ./lib/backoff */ "./node_modules/backoff/lib/backoff.js");
var ExponentialBackoffStrategy = __webpack_require__(/*! ./lib/strategy/exponential */ "./node_modules/backoff/lib/strategy/exponential.js");
var FibonacciBackoffStrategy = __webpack_require__(/*! ./lib/strategy/fibonacci */ "./node_modules/backoff/lib/strategy/fibonacci.js");
var FunctionCall = __webpack_require__(/*! ./lib/function_call.js */ "./node_modules/backoff/lib/function_call.js");

module.exports.Backoff = Backoff;
module.exports.FunctionCall = FunctionCall;
module.exports.FibonacciStrategy = FibonacciBackoffStrategy;
module.exports.ExponentialStrategy = ExponentialBackoffStrategy;

// Constructs a Fibonacci backoff.
module.exports.fibonacci = function(options) {
    return new Backoff(new FibonacciBackoffStrategy(options));
};

// Constructs an exponential backoff.
module.exports.exponential = function(options) {
    return new Backoff(new ExponentialBackoffStrategy(options));
};

// Constructs a FunctionCall for the given function and arguments.
module.exports.call = function(fn, vargs, callback) {
    var args = Array.prototype.slice.call(arguments);
    fn = args[0];
    vargs = args.slice(1, args.length - 1);
    callback = args[args.length - 1];
    return new FunctionCall(fn, vargs, callback);
};


/***/ }),

/***/ "./node_modules/backoff/lib/backoff.js":
/*!*********************************************!*\
  !*** ./node_modules/backoff/lib/backoff.js ***!
  \*********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

//      Copyright (c) 2012 Mathieu Turcotte
//      Licensed under the MIT license.

var events = __webpack_require__(/*! events */ "./node_modules/events/events.js");
var precond = __webpack_require__(/*! precond */ "./node_modules/precond/index.js");
var util = __webpack_require__(/*! util */ "./node_modules/util/util.js");

// A class to hold the state of a backoff operation. Accepts a backoff strategy
// to generate the backoff delays.
function Backoff(backoffStrategy) {
    events.EventEmitter.call(this);

    this.backoffStrategy_ = backoffStrategy;
    this.maxNumberOfRetry_ = -1;
    this.backoffNumber_ = 0;
    this.backoffDelay_ = 0;
    this.timeoutID_ = -1;

    this.handlers = {
        backoff: this.onBackoff_.bind(this)
    };
}
util.inherits(Backoff, events.EventEmitter);

// Sets a limit, greater than 0, on the maximum number of backoffs. A 'fail'
// event will be emitted when the limit is reached.
Backoff.prototype.failAfter = function(maxNumberOfRetry) {
    precond.checkArgument(maxNumberOfRetry > 0,
        'Expected a maximum number of retry greater than 0 but got %s.',
        maxNumberOfRetry);

    this.maxNumberOfRetry_ = maxNumberOfRetry;
};

// Starts a backoff operation. Accepts an optional parameter to let the
// listeners know why the backoff operation was started.
Backoff.prototype.backoff = function(err) {
    precond.checkState(this.timeoutID_ === -1, 'Backoff in progress.');

    if (this.backoffNumber_ === this.maxNumberOfRetry_) {
        this.emit('fail', err);
        this.reset();
    } else {
        this.backoffDelay_ = this.backoffStrategy_.next();
        this.timeoutID_ = setTimeout(this.handlers.backoff, this.backoffDelay_);
        this.emit('backoff', this.backoffNumber_, this.backoffDelay_, err);
    }
};

// Handles the backoff timeout completion.
Backoff.prototype.onBackoff_ = function() {
    this.timeoutID_ = -1;
    this.emit('ready', this.backoffNumber_, this.backoffDelay_);
    this.backoffNumber_++;
};

// Stops any backoff operation and resets the backoff delay to its inital value.
Backoff.prototype.reset = function() {
    this.backoffNumber_ = 0;
    this.backoffStrategy_.reset();
    clearTimeout(this.timeoutID_);
    this.timeoutID_ = -1;
};

module.exports = Backoff;


/***/ }),

/***/ "./node_modules/backoff/lib/function_call.js":
/*!***************************************************!*\
  !*** ./node_modules/backoff/lib/function_call.js ***!
  \***************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

//      Copyright (c) 2012 Mathieu Turcotte
//      Licensed under the MIT license.

var events = __webpack_require__(/*! events */ "./node_modules/events/events.js");
var precond = __webpack_require__(/*! precond */ "./node_modules/precond/index.js");
var util = __webpack_require__(/*! util */ "./node_modules/util/util.js");

var Backoff = __webpack_require__(/*! ./backoff */ "./node_modules/backoff/lib/backoff.js");
var FibonacciBackoffStrategy = __webpack_require__(/*! ./strategy/fibonacci */ "./node_modules/backoff/lib/strategy/fibonacci.js");

// Wraps a function to be called in a backoff loop.
function FunctionCall(fn, args, callback) {
    events.EventEmitter.call(this);

    precond.checkIsFunction(fn, 'Expected fn to be a function.');
    precond.checkIsArray(args, 'Expected args to be an array.');
    precond.checkIsFunction(callback, 'Expected callback to be a function.');

    this.function_ = fn;
    this.arguments_ = args;
    this.callback_ = callback;
    this.lastResult_ = [];
    this.numRetries_ = 0;

    this.backoff_ = null;
    this.strategy_ = null;
    this.failAfter_ = -1;
    this.retryPredicate_ = FunctionCall.DEFAULT_RETRY_PREDICATE_;

    this.state_ = FunctionCall.State_.PENDING;
}
util.inherits(FunctionCall, events.EventEmitter);

// States in which the call can be.
FunctionCall.State_ = {
    // Call isn't started yet.
    PENDING: 0,
    // Call is in progress.
    RUNNING: 1,
    // Call completed successfully which means that either the wrapped function
    // returned successfully or the maximal number of backoffs was reached.
    COMPLETED: 2,
    // The call was aborted.
    ABORTED: 3
};

// The default retry predicate which considers any error as retriable.
FunctionCall.DEFAULT_RETRY_PREDICATE_ = function(err) {
  return true;
};

// Checks whether the call is pending.
FunctionCall.prototype.isPending = function() {
    return this.state_ == FunctionCall.State_.PENDING;
};

// Checks whether the call is in progress.
FunctionCall.prototype.isRunning = function() {
    return this.state_ == FunctionCall.State_.RUNNING;
};

// Checks whether the call is completed.
FunctionCall.prototype.isCompleted = function() {
    return this.state_ == FunctionCall.State_.COMPLETED;
};

// Checks whether the call is aborted.
FunctionCall.prototype.isAborted = function() {
    return this.state_ == FunctionCall.State_.ABORTED;
};

// Sets the backoff strategy to use. Can only be called before the call is
// started otherwise an exception will be thrown.
FunctionCall.prototype.setStrategy = function(strategy) {
    precond.checkState(this.isPending(), 'FunctionCall in progress.');
    this.strategy_ = strategy;
    return this; // Return this for chaining.
};

// Sets the predicate which will be used to determine whether the errors
// returned from the wrapped function should be retried or not, e.g. a
// network error would be retriable while a type error would stop the
// function call.
FunctionCall.prototype.retryIf = function(retryPredicate) {
    precond.checkState(this.isPending(), 'FunctionCall in progress.');
    this.retryPredicate_ = retryPredicate;
    return this;
};

// Returns all intermediary results returned by the wrapped function since
// the initial call.
FunctionCall.prototype.getLastResult = function() {
    return this.lastResult_.concat();
};

// Returns the number of times the wrapped function call was retried.
FunctionCall.prototype.getNumRetries = function() {
    return this.numRetries_;
};

// Sets the backoff limit.
FunctionCall.prototype.failAfter = function(maxNumberOfRetry) {
    precond.checkState(this.isPending(), 'FunctionCall in progress.');
    this.failAfter_ = maxNumberOfRetry;
    return this; // Return this for chaining.
};

// Aborts the call.
FunctionCall.prototype.abort = function() {
    if (this.isCompleted() || this.isAborted()) {
      return;
    }

    if (this.isRunning()) {
        this.backoff_.reset();
    }

    this.state_ = FunctionCall.State_.ABORTED;
    this.lastResult_ = [new Error('Backoff aborted.')];
    this.emit('abort');
    this.doCallback_();
};

// Initiates the call to the wrapped function. Accepts an optional factory
// function used to create the backoff instance; used when testing.
FunctionCall.prototype.start = function(backoffFactory) {
    precond.checkState(!this.isAborted(), 'FunctionCall is aborted.');
    precond.checkState(this.isPending(), 'FunctionCall already started.');

    var strategy = this.strategy_ || new FibonacciBackoffStrategy();

    this.backoff_ = backoffFactory ?
        backoffFactory(strategy) :
        new Backoff(strategy);

    this.backoff_.on('ready', this.doCall_.bind(this, true /* isRetry */));
    this.backoff_.on('fail', this.doCallback_.bind(this));
    this.backoff_.on('backoff', this.handleBackoff_.bind(this));

    if (this.failAfter_ > 0) {
        this.backoff_.failAfter(this.failAfter_);
    }

    this.state_ = FunctionCall.State_.RUNNING;
    this.doCall_(false /* isRetry */);
};

// Calls the wrapped function.
FunctionCall.prototype.doCall_ = function(isRetry) {
    if (isRetry) {
        this.numRetries_++;
    }
    var eventArgs = ['call'].concat(this.arguments_);
    events.EventEmitter.prototype.emit.apply(this, eventArgs);
    var callback = this.handleFunctionCallback_.bind(this);
    this.function_.apply(null, this.arguments_.concat(callback));
};

// Calls the wrapped function's callback with the last result returned by the
// wrapped function.
FunctionCall.prototype.doCallback_ = function() {
    this.callback_.apply(null, this.lastResult_);
};

// Handles wrapped function's completion. This method acts as a replacement
// for the original callback function.
FunctionCall.prototype.handleFunctionCallback_ = function() {
    if (this.isAborted()) {
        return;
    }

    var args = Array.prototype.slice.call(arguments);
    this.lastResult_ = args; // Save last callback arguments.
    events.EventEmitter.prototype.emit.apply(this, ['callback'].concat(args));

    var err = args[0];
    if (err && this.retryPredicate_(err)) {
        this.backoff_.backoff(err);
    } else {
        this.state_ = FunctionCall.State_.COMPLETED;
        this.doCallback_();
    }
};

// Handles the backoff event by reemitting it.
FunctionCall.prototype.handleBackoff_ = function(number, delay, err) {
    this.emit('backoff', number, delay, err);
};

module.exports = FunctionCall;


/***/ }),

/***/ "./node_modules/backoff/lib/strategy/exponential.js":
/*!**********************************************************!*\
  !*** ./node_modules/backoff/lib/strategy/exponential.js ***!
  \**********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

//      Copyright (c) 2012 Mathieu Turcotte
//      Licensed under the MIT license.

var util = __webpack_require__(/*! util */ "./node_modules/util/util.js");
var precond = __webpack_require__(/*! precond */ "./node_modules/precond/index.js");

var BackoffStrategy = __webpack_require__(/*! ./strategy */ "./node_modules/backoff/lib/strategy/strategy.js");

// Exponential backoff strategy.
function ExponentialBackoffStrategy(options) {
    BackoffStrategy.call(this, options);
    this.backoffDelay_ = 0;
    this.nextBackoffDelay_ = this.getInitialDelay();
    this.factor_ = ExponentialBackoffStrategy.DEFAULT_FACTOR;

    if (options && options.factor !== undefined) {
        precond.checkArgument(options.factor > 1,
            'Exponential factor should be greater than 1 but got %s.',
            options.factor);
        this.factor_ = options.factor;
    }
}
util.inherits(ExponentialBackoffStrategy, BackoffStrategy);

// Default multiplication factor used to compute the next backoff delay from
// the current one. The value can be overridden by passing a custom factor as
// part of the options.
ExponentialBackoffStrategy.DEFAULT_FACTOR = 2;

ExponentialBackoffStrategy.prototype.next_ = function() {
    this.backoffDelay_ = Math.min(this.nextBackoffDelay_, this.getMaxDelay());
    this.nextBackoffDelay_ = this.backoffDelay_ * this.factor_;
    return this.backoffDelay_;
};

ExponentialBackoffStrategy.prototype.reset_ = function() {
    this.backoffDelay_ = 0;
    this.nextBackoffDelay_ = this.getInitialDelay();
};

module.exports = ExponentialBackoffStrategy;


/***/ }),

/***/ "./node_modules/backoff/lib/strategy/fibonacci.js":
/*!********************************************************!*\
  !*** ./node_modules/backoff/lib/strategy/fibonacci.js ***!
  \********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

//      Copyright (c) 2012 Mathieu Turcotte
//      Licensed under the MIT license.

var util = __webpack_require__(/*! util */ "./node_modules/util/util.js");

var BackoffStrategy = __webpack_require__(/*! ./strategy */ "./node_modules/backoff/lib/strategy/strategy.js");

// Fibonacci backoff strategy.
function FibonacciBackoffStrategy(options) {
    BackoffStrategy.call(this, options);
    this.backoffDelay_ = 0;
    this.nextBackoffDelay_ = this.getInitialDelay();
}
util.inherits(FibonacciBackoffStrategy, BackoffStrategy);

FibonacciBackoffStrategy.prototype.next_ = function() {
    var backoffDelay = Math.min(this.nextBackoffDelay_, this.getMaxDelay());
    this.nextBackoffDelay_ += this.backoffDelay_;
    this.backoffDelay_ = backoffDelay;
    return backoffDelay;
};

FibonacciBackoffStrategy.prototype.reset_ = function() {
    this.nextBackoffDelay_ = this.getInitialDelay();
    this.backoffDelay_ = 0;
};

module.exports = FibonacciBackoffStrategy;


/***/ }),

/***/ "./node_modules/backoff/lib/strategy/strategy.js":
/*!*******************************************************!*\
  !*** ./node_modules/backoff/lib/strategy/strategy.js ***!
  \*******************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

//      Copyright (c) 2012 Mathieu Turcotte
//      Licensed under the MIT license.

var events = __webpack_require__(/*! events */ "./node_modules/events/events.js");
var util = __webpack_require__(/*! util */ "./node_modules/util/util.js");

function isDef(value) {
    return value !== undefined && value !== null;
}

// Abstract class defining the skeleton for the backoff strategies. Accepts an
// object holding the options for the backoff strategy:
//
//  * `randomisationFactor`: The randomisation factor which must be between 0
//     and 1 where 1 equates to a randomization factor of 100% and 0 to no
//     randomization.
//  * `initialDelay`: The backoff initial delay in milliseconds.
//  * `maxDelay`: The backoff maximal delay in milliseconds.
function BackoffStrategy(options) {
    options = options || {};

    if (isDef(options.initialDelay) && options.initialDelay < 1) {
        throw new Error('The initial timeout must be greater than 0.');
    } else if (isDef(options.maxDelay) && options.maxDelay < 1) {
        throw new Error('The maximal timeout must be greater than 0.');
    }

    this.initialDelay_ = options.initialDelay || 100;
    this.maxDelay_ = options.maxDelay || 10000;

    if (this.maxDelay_ <= this.initialDelay_) {
        throw new Error('The maximal backoff delay must be ' +
                        'greater than the initial backoff delay.');
    }

    if (isDef(options.randomisationFactor) &&
        (options.randomisationFactor < 0 || options.randomisationFactor > 1)) {
        throw new Error('The randomisation factor must be between 0 and 1.');
    }

    this.randomisationFactor_ = options.randomisationFactor || 0;
}

// Gets the maximal backoff delay.
BackoffStrategy.prototype.getMaxDelay = function() {
    return this.maxDelay_;
};

// Gets the initial backoff delay.
BackoffStrategy.prototype.getInitialDelay = function() {
    return this.initialDelay_;
};

// Template method that computes and returns the next backoff delay in
// milliseconds.
BackoffStrategy.prototype.next = function() {
    var backoffDelay = this.next_();
    var randomisationMultiple = 1 + Math.random() * this.randomisationFactor_;
    var randomizedDelay = Math.round(backoffDelay * randomisationMultiple);
    return randomizedDelay;
};

// Computes and returns the next backoff delay. Intended to be overridden by
// subclasses.
BackoffStrategy.prototype.next_ = function() {
    throw new Error('BackoffStrategy.next_() unimplemented.');
};

// Template method that resets the backoff delay to its initial value.
BackoffStrategy.prototype.reset = function() {
    this.reset_();
};

// Resets the backoff delay to its initial value. Intended to be overridden by
// subclasses.
BackoffStrategy.prototype.reset_ = function() {
    throw new Error('BackoffStrategy.reset_() unimplemented.');
};

module.exports = BackoffStrategy;


/***/ }),

/***/ "./node_modules/base64-js/index.js":
/*!*****************************************!*\
  !*** ./node_modules/base64-js/index.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


exports.byteLength = byteLength
exports.toByteArray = toByteArray
exports.fromByteArray = fromByteArray

var lookup = []
var revLookup = []
var Arr = typeof Uint8Array !== 'undefined' ? Uint8Array : Array

var code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/'
for (var i = 0, len = code.length; i < len; ++i) {
  lookup[i] = code[i]
  revLookup[code.charCodeAt(i)] = i
}

// Support decoding URL-safe base64 strings, as Node.js does.
// See: https://en.wikipedia.org/wiki/Base64#URL_applications
revLookup['-'.charCodeAt(0)] = 62
revLookup['_'.charCodeAt(0)] = 63

function getLens (b64) {
  var len = b64.length

  if (len % 4 > 0) {
    throw new Error('Invalid string. Length must be a multiple of 4')
  }

  // Trim off extra bytes after placeholder bytes are found
  // See: https://github.com/beatgammit/base64-js/issues/42
  var validLen = b64.indexOf('=')
  if (validLen === -1) validLen = len

  var placeHoldersLen = validLen === len
    ? 0
    : 4 - (validLen % 4)

  return [validLen, placeHoldersLen]
}

// base64 is 4/3 + up to two characters of the original data
function byteLength (b64) {
  var lens = getLens(b64)
  var validLen = lens[0]
  var placeHoldersLen = lens[1]
  return ((validLen + placeHoldersLen) * 3 / 4) - placeHoldersLen
}

function _byteLength (b64, validLen, placeHoldersLen) {
  return ((validLen + placeHoldersLen) * 3 / 4) - placeHoldersLen
}

function toByteArray (b64) {
  var tmp
  var lens = getLens(b64)
  var validLen = lens[0]
  var placeHoldersLen = lens[1]

  var arr = new Arr(_byteLength(b64, validLen, placeHoldersLen))

  var curByte = 0

  // if there are placeholders, only get up to the last complete 4 chars
  var len = placeHoldersLen > 0
    ? validLen - 4
    : validLen

  var i
  for (i = 0; i < len; i += 4) {
    tmp =
      (revLookup[b64.charCodeAt(i)] << 18) |
      (revLookup[b64.charCodeAt(i + 1)] << 12) |
      (revLookup[b64.charCodeAt(i + 2)] << 6) |
      revLookup[b64.charCodeAt(i + 3)]
    arr[curByte++] = (tmp >> 16) & 0xFF
    arr[curByte++] = (tmp >> 8) & 0xFF
    arr[curByte++] = tmp & 0xFF
  }

  if (placeHoldersLen === 2) {
    tmp =
      (revLookup[b64.charCodeAt(i)] << 2) |
      (revLookup[b64.charCodeAt(i + 1)] >> 4)
    arr[curByte++] = tmp & 0xFF
  }

  if (placeHoldersLen === 1) {
    tmp =
      (revLookup[b64.charCodeAt(i)] << 10) |
      (revLookup[b64.charCodeAt(i + 1)] << 4) |
      (revLookup[b64.charCodeAt(i + 2)] >> 2)
    arr[curByte++] = (tmp >> 8) & 0xFF
    arr[curByte++] = tmp & 0xFF
  }

  return arr
}

function tripletToBase64 (num) {
  return lookup[num >> 18 & 0x3F] +
    lookup[num >> 12 & 0x3F] +
    lookup[num >> 6 & 0x3F] +
    lookup[num & 0x3F]
}

function encodeChunk (uint8, start, end) {
  var tmp
  var output = []
  for (var i = start; i < end; i += 3) {
    tmp =
      ((uint8[i] << 16) & 0xFF0000) +
      ((uint8[i + 1] << 8) & 0xFF00) +
      (uint8[i + 2] & 0xFF)
    output.push(tripletToBase64(tmp))
  }
  return output.join('')
}

function fromByteArray (uint8) {
  var tmp
  var len = uint8.length
  var extraBytes = len % 3 // if we have 1 byte left, pad 2 bytes
  var parts = []
  var maxChunkLength = 16383 // must be multiple of 3

  // go through the array every three bytes, we'll deal with trailing stuff later
  for (var i = 0, len2 = len - extraBytes; i < len2; i += maxChunkLength) {
    parts.push(encodeChunk(uint8, i, (i + maxChunkLength) > len2 ? len2 : (i + maxChunkLength)))
  }

  // pad the end with zeros, but make sure to not forget the extra bytes
  if (extraBytes === 1) {
    tmp = uint8[len - 1]
    parts.push(
      lookup[tmp >> 2] +
      lookup[(tmp << 4) & 0x3F] +
      '=='
    )
  } else if (extraBytes === 2) {
    tmp = (uint8[len - 2] << 8) + uint8[len - 1]
    parts.push(
      lookup[tmp >> 10] +
      lookup[(tmp >> 4) & 0x3F] +
      lookup[(tmp << 2) & 0x3F] +
      '='
    )
  }

  return parts.join('')
}


/***/ }),

/***/ "./node_modules/bowser/es5.js":
/*!************************************!*\
  !*** ./node_modules/bowser/es5.js ***!
  \************************************/
/***/ (function(module) {

!function(e,t){ true?module.exports=t():0}(this,(function(){return function(e){var t={};function r(n){if(t[n])return t[n].exports;var i=t[n]={i:n,l:!1,exports:{}};return e[n].call(i.exports,i,i.exports,r),i.l=!0,i.exports}return r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var i in e)r.d(n,i,function(t){return e[t]}.bind(null,i));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=90)}({17:function(e,t,r){"use strict";t.__esModule=!0,t.default=void 0;var n=r(18),i=function(){function e(){}return e.getFirstMatch=function(e,t){var r=t.match(e);return r&&r.length>0&&r[1]||""},e.getSecondMatch=function(e,t){var r=t.match(e);return r&&r.length>1&&r[2]||""},e.matchAndReturnConst=function(e,t,r){if(e.test(t))return r},e.getWindowsVersionName=function(e){switch(e){case"NT":return"NT";case"XP":return"XP";case"NT 5.0":return"2000";case"NT 5.1":return"XP";case"NT 5.2":return"2003";case"NT 6.0":return"Vista";case"NT 6.1":return"7";case"NT 6.2":return"8";case"NT 6.3":return"8.1";case"NT 10.0":return"10";default:return}},e.getMacOSVersionName=function(e){var t=e.split(".").splice(0,2).map((function(e){return parseInt(e,10)||0}));if(t.push(0),10===t[0])switch(t[1]){case 5:return"Leopard";case 6:return"Snow Leopard";case 7:return"Lion";case 8:return"Mountain Lion";case 9:return"Mavericks";case 10:return"Yosemite";case 11:return"El Capitan";case 12:return"Sierra";case 13:return"High Sierra";case 14:return"Mojave";case 15:return"Catalina";default:return}},e.getAndroidVersionName=function(e){var t=e.split(".").splice(0,2).map((function(e){return parseInt(e,10)||0}));if(t.push(0),!(1===t[0]&&t[1]<5))return 1===t[0]&&t[1]<6?"Cupcake":1===t[0]&&t[1]>=6?"Donut":2===t[0]&&t[1]<2?"Eclair":2===t[0]&&2===t[1]?"Froyo":2===t[0]&&t[1]>2?"Gingerbread":3===t[0]?"Honeycomb":4===t[0]&&t[1]<1?"Ice Cream Sandwich":4===t[0]&&t[1]<4?"Jelly Bean":4===t[0]&&t[1]>=4?"KitKat":5===t[0]?"Lollipop":6===t[0]?"Marshmallow":7===t[0]?"Nougat":8===t[0]?"Oreo":9===t[0]?"Pie":void 0},e.getVersionPrecision=function(e){return e.split(".").length},e.compareVersions=function(t,r,n){void 0===n&&(n=!1);var i=e.getVersionPrecision(t),s=e.getVersionPrecision(r),a=Math.max(i,s),o=0,u=e.map([t,r],(function(t){var r=a-e.getVersionPrecision(t),n=t+new Array(r+1).join(".0");return e.map(n.split("."),(function(e){return new Array(20-e.length).join("0")+e})).reverse()}));for(n&&(o=a-Math.min(i,s)),a-=1;a>=o;){if(u[0][a]>u[1][a])return 1;if(u[0][a]===u[1][a]){if(a===o)return 0;a-=1}else if(u[0][a]<u[1][a])return-1}},e.map=function(e,t){var r,n=[];if(Array.prototype.map)return Array.prototype.map.call(e,t);for(r=0;r<e.length;r+=1)n.push(t(e[r]));return n},e.find=function(e,t){var r,n;if(Array.prototype.find)return Array.prototype.find.call(e,t);for(r=0,n=e.length;r<n;r+=1){var i=e[r];if(t(i,r))return i}},e.assign=function(e){for(var t,r,n=e,i=arguments.length,s=new Array(i>1?i-1:0),a=1;a<i;a++)s[a-1]=arguments[a];if(Object.assign)return Object.assign.apply(Object,[e].concat(s));var o=function(){var e=s[t];"object"==typeof e&&null!==e&&Object.keys(e).forEach((function(t){n[t]=e[t]}))};for(t=0,r=s.length;t<r;t+=1)o();return e},e.getBrowserAlias=function(e){return n.BROWSER_ALIASES_MAP[e]},e.getBrowserTypeByAlias=function(e){return n.BROWSER_MAP[e]||""},e}();t.default=i,e.exports=t.default},18:function(e,t,r){"use strict";t.__esModule=!0,t.ENGINE_MAP=t.OS_MAP=t.PLATFORMS_MAP=t.BROWSER_MAP=t.BROWSER_ALIASES_MAP=void 0;t.BROWSER_ALIASES_MAP={"Amazon Silk":"amazon_silk","Android Browser":"android",Bada:"bada",BlackBerry:"blackberry",Chrome:"chrome",Chromium:"chromium",Electron:"electron",Epiphany:"epiphany",Firefox:"firefox",Focus:"focus",Generic:"generic","Google Search":"google_search",Googlebot:"googlebot","Internet Explorer":"ie","K-Meleon":"k_meleon",Maxthon:"maxthon","Microsoft Edge":"edge","MZ Browser":"mz","NAVER Whale Browser":"naver",Opera:"opera","Opera Coast":"opera_coast",PhantomJS:"phantomjs",Puffin:"puffin",QupZilla:"qupzilla",QQ:"qq",QQLite:"qqlite",Safari:"safari",Sailfish:"sailfish","Samsung Internet for Android":"samsung_internet",SeaMonkey:"seamonkey",Sleipnir:"sleipnir",Swing:"swing",Tizen:"tizen","UC Browser":"uc",Vivaldi:"vivaldi","WebOS Browser":"webos",WeChat:"wechat","Yandex Browser":"yandex",Roku:"roku"};t.BROWSER_MAP={amazon_silk:"Amazon Silk",android:"Android Browser",bada:"Bada",blackberry:"BlackBerry",chrome:"Chrome",chromium:"Chromium",electron:"Electron",epiphany:"Epiphany",firefox:"Firefox",focus:"Focus",generic:"Generic",googlebot:"Googlebot",google_search:"Google Search",ie:"Internet Explorer",k_meleon:"K-Meleon",maxthon:"Maxthon",edge:"Microsoft Edge",mz:"MZ Browser",naver:"NAVER Whale Browser",opera:"Opera",opera_coast:"Opera Coast",phantomjs:"PhantomJS",puffin:"Puffin",qupzilla:"QupZilla",qq:"QQ Browser",qqlite:"QQ Browser Lite",safari:"Safari",sailfish:"Sailfish",samsung_internet:"Samsung Internet for Android",seamonkey:"SeaMonkey",sleipnir:"Sleipnir",swing:"Swing",tizen:"Tizen",uc:"UC Browser",vivaldi:"Vivaldi",webos:"WebOS Browser",wechat:"WeChat",yandex:"Yandex Browser"};t.PLATFORMS_MAP={tablet:"tablet",mobile:"mobile",desktop:"desktop",tv:"tv"};t.OS_MAP={WindowsPhone:"Windows Phone",Windows:"Windows",MacOS:"macOS",iOS:"iOS",Android:"Android",WebOS:"WebOS",BlackBerry:"BlackBerry",Bada:"Bada",Tizen:"Tizen",Linux:"Linux",ChromeOS:"Chrome OS",PlayStation4:"PlayStation 4",Roku:"Roku"};t.ENGINE_MAP={EdgeHTML:"EdgeHTML",Blink:"Blink",Trident:"Trident",Presto:"Presto",Gecko:"Gecko",WebKit:"WebKit"}},90:function(e,t,r){"use strict";t.__esModule=!0,t.default=void 0;var n,i=(n=r(91))&&n.__esModule?n:{default:n},s=r(18);function a(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var o=function(){function e(){}var t,r,n;return e.getParser=function(e,t){if(void 0===t&&(t=!1),"string"!=typeof e)throw new Error("UserAgent should be a string");return new i.default(e,t)},e.parse=function(e){return new i.default(e).getResult()},t=e,n=[{key:"BROWSER_MAP",get:function(){return s.BROWSER_MAP}},{key:"ENGINE_MAP",get:function(){return s.ENGINE_MAP}},{key:"OS_MAP",get:function(){return s.OS_MAP}},{key:"PLATFORMS_MAP",get:function(){return s.PLATFORMS_MAP}}],(r=null)&&a(t.prototype,r),n&&a(t,n),e}();t.default=o,e.exports=t.default},91:function(e,t,r){"use strict";t.__esModule=!0,t.default=void 0;var n=u(r(92)),i=u(r(93)),s=u(r(94)),a=u(r(95)),o=u(r(17));function u(e){return e&&e.__esModule?e:{default:e}}var d=function(){function e(e,t){if(void 0===t&&(t=!1),null==e||""===e)throw new Error("UserAgent parameter can't be empty");this._ua=e,this.parsedResult={},!0!==t&&this.parse()}var t=e.prototype;return t.getUA=function(){return this._ua},t.test=function(e){return e.test(this._ua)},t.parseBrowser=function(){var e=this;this.parsedResult.browser={};var t=o.default.find(n.default,(function(t){if("function"==typeof t.test)return t.test(e);if(t.test instanceof Array)return t.test.some((function(t){return e.test(t)}));throw new Error("Browser's test function is not valid")}));return t&&(this.parsedResult.browser=t.describe(this.getUA())),this.parsedResult.browser},t.getBrowser=function(){return this.parsedResult.browser?this.parsedResult.browser:this.parseBrowser()},t.getBrowserName=function(e){return e?String(this.getBrowser().name).toLowerCase()||"":this.getBrowser().name||""},t.getBrowserVersion=function(){return this.getBrowser().version},t.getOS=function(){return this.parsedResult.os?this.parsedResult.os:this.parseOS()},t.parseOS=function(){var e=this;this.parsedResult.os={};var t=o.default.find(i.default,(function(t){if("function"==typeof t.test)return t.test(e);if(t.test instanceof Array)return t.test.some((function(t){return e.test(t)}));throw new Error("Browser's test function is not valid")}));return t&&(this.parsedResult.os=t.describe(this.getUA())),this.parsedResult.os},t.getOSName=function(e){var t=this.getOS().name;return e?String(t).toLowerCase()||"":t||""},t.getOSVersion=function(){return this.getOS().version},t.getPlatform=function(){return this.parsedResult.platform?this.parsedResult.platform:this.parsePlatform()},t.getPlatformType=function(e){void 0===e&&(e=!1);var t=this.getPlatform().type;return e?String(t).toLowerCase()||"":t||""},t.parsePlatform=function(){var e=this;this.parsedResult.platform={};var t=o.default.find(s.default,(function(t){if("function"==typeof t.test)return t.test(e);if(t.test instanceof Array)return t.test.some((function(t){return e.test(t)}));throw new Error("Browser's test function is not valid")}));return t&&(this.parsedResult.platform=t.describe(this.getUA())),this.parsedResult.platform},t.getEngine=function(){return this.parsedResult.engine?this.parsedResult.engine:this.parseEngine()},t.getEngineName=function(e){return e?String(this.getEngine().name).toLowerCase()||"":this.getEngine().name||""},t.parseEngine=function(){var e=this;this.parsedResult.engine={};var t=o.default.find(a.default,(function(t){if("function"==typeof t.test)return t.test(e);if(t.test instanceof Array)return t.test.some((function(t){return e.test(t)}));throw new Error("Browser's test function is not valid")}));return t&&(this.parsedResult.engine=t.describe(this.getUA())),this.parsedResult.engine},t.parse=function(){return this.parseBrowser(),this.parseOS(),this.parsePlatform(),this.parseEngine(),this},t.getResult=function(){return o.default.assign({},this.parsedResult)},t.satisfies=function(e){var t=this,r={},n=0,i={},s=0;if(Object.keys(e).forEach((function(t){var a=e[t];"string"==typeof a?(i[t]=a,s+=1):"object"==typeof a&&(r[t]=a,n+=1)})),n>0){var a=Object.keys(r),u=o.default.find(a,(function(e){return t.isOS(e)}));if(u){var d=this.satisfies(r[u]);if(void 0!==d)return d}var c=o.default.find(a,(function(e){return t.isPlatform(e)}));if(c){var f=this.satisfies(r[c]);if(void 0!==f)return f}}if(s>0){var l=Object.keys(i),h=o.default.find(l,(function(e){return t.isBrowser(e,!0)}));if(void 0!==h)return this.compareVersion(i[h])}},t.isBrowser=function(e,t){void 0===t&&(t=!1);var r=this.getBrowserName().toLowerCase(),n=e.toLowerCase(),i=o.default.getBrowserTypeByAlias(n);return t&&i&&(n=i.toLowerCase()),n===r},t.compareVersion=function(e){var t=[0],r=e,n=!1,i=this.getBrowserVersion();if("string"==typeof i)return">"===e[0]||"<"===e[0]?(r=e.substr(1),"="===e[1]?(n=!0,r=e.substr(2)):t=[],">"===e[0]?t.push(1):t.push(-1)):"="===e[0]?r=e.substr(1):"~"===e[0]&&(n=!0,r=e.substr(1)),t.indexOf(o.default.compareVersions(i,r,n))>-1},t.isOS=function(e){return this.getOSName(!0)===String(e).toLowerCase()},t.isPlatform=function(e){return this.getPlatformType(!0)===String(e).toLowerCase()},t.isEngine=function(e){return this.getEngineName(!0)===String(e).toLowerCase()},t.is=function(e,t){return void 0===t&&(t=!1),this.isBrowser(e,t)||this.isOS(e)||this.isPlatform(e)},t.some=function(e){var t=this;return void 0===e&&(e=[]),e.some((function(e){return t.is(e)}))},e}();t.default=d,e.exports=t.default},92:function(e,t,r){"use strict";t.__esModule=!0,t.default=void 0;var n,i=(n=r(17))&&n.__esModule?n:{default:n};var s=/version\/(\d+(\.?_?\d+)+)/i,a=[{test:[/googlebot/i],describe:function(e){var t={name:"Googlebot"},r=i.default.getFirstMatch(/googlebot\/(\d+(\.\d+))/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/opera/i],describe:function(e){var t={name:"Opera"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:opera)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/opr\/|opios/i],describe:function(e){var t={name:"Opera"},r=i.default.getFirstMatch(/(?:opr|opios)[\s/](\S+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/SamsungBrowser/i],describe:function(e){var t={name:"Samsung Internet for Android"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:SamsungBrowser)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/Whale/i],describe:function(e){var t={name:"NAVER Whale Browser"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:whale)[\s/](\d+(?:\.\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/MZBrowser/i],describe:function(e){var t={name:"MZ Browser"},r=i.default.getFirstMatch(/(?:MZBrowser)[\s/](\d+(?:\.\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/focus/i],describe:function(e){var t={name:"Focus"},r=i.default.getFirstMatch(/(?:focus)[\s/](\d+(?:\.\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/swing/i],describe:function(e){var t={name:"Swing"},r=i.default.getFirstMatch(/(?:swing)[\s/](\d+(?:\.\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/coast/i],describe:function(e){var t={name:"Opera Coast"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:coast)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/opt\/\d+(?:.?_?\d+)+/i],describe:function(e){var t={name:"Opera Touch"},r=i.default.getFirstMatch(/(?:opt)[\s/](\d+(\.?_?\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/yabrowser/i],describe:function(e){var t={name:"Yandex Browser"},r=i.default.getFirstMatch(/(?:yabrowser)[\s/](\d+(\.?_?\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/ucbrowser/i],describe:function(e){var t={name:"UC Browser"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:ucbrowser)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/Maxthon|mxios/i],describe:function(e){var t={name:"Maxthon"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:Maxthon|mxios)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/epiphany/i],describe:function(e){var t={name:"Epiphany"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:epiphany)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/puffin/i],describe:function(e){var t={name:"Puffin"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:puffin)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/sleipnir/i],describe:function(e){var t={name:"Sleipnir"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:sleipnir)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/k-meleon/i],describe:function(e){var t={name:"K-Meleon"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/(?:k-meleon)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/micromessenger/i],describe:function(e){var t={name:"WeChat"},r=i.default.getFirstMatch(/(?:micromessenger)[\s/](\d+(\.?_?\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/qqbrowser/i],describe:function(e){var t={name:/qqbrowserlite/i.test(e)?"QQ Browser Lite":"QQ Browser"},r=i.default.getFirstMatch(/(?:qqbrowserlite|qqbrowser)[/](\d+(\.?_?\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/msie|trident/i],describe:function(e){var t={name:"Internet Explorer"},r=i.default.getFirstMatch(/(?:msie |rv:)(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/\sedg\//i],describe:function(e){var t={name:"Microsoft Edge"},r=i.default.getFirstMatch(/\sedg\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/edg([ea]|ios)/i],describe:function(e){var t={name:"Microsoft Edge"},r=i.default.getSecondMatch(/edg([ea]|ios)\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/vivaldi/i],describe:function(e){var t={name:"Vivaldi"},r=i.default.getFirstMatch(/vivaldi\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/seamonkey/i],describe:function(e){var t={name:"SeaMonkey"},r=i.default.getFirstMatch(/seamonkey\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/sailfish/i],describe:function(e){var t={name:"Sailfish"},r=i.default.getFirstMatch(/sailfish\s?browser\/(\d+(\.\d+)?)/i,e);return r&&(t.version=r),t}},{test:[/silk/i],describe:function(e){var t={name:"Amazon Silk"},r=i.default.getFirstMatch(/silk\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/phantom/i],describe:function(e){var t={name:"PhantomJS"},r=i.default.getFirstMatch(/phantomjs\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/slimerjs/i],describe:function(e){var t={name:"SlimerJS"},r=i.default.getFirstMatch(/slimerjs\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/blackberry|\bbb\d+/i,/rim\stablet/i],describe:function(e){var t={name:"BlackBerry"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/blackberry[\d]+\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/(web|hpw)[o0]s/i],describe:function(e){var t={name:"WebOS Browser"},r=i.default.getFirstMatch(s,e)||i.default.getFirstMatch(/w(?:eb)?[o0]sbrowser\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/bada/i],describe:function(e){var t={name:"Bada"},r=i.default.getFirstMatch(/dolfin\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/tizen/i],describe:function(e){var t={name:"Tizen"},r=i.default.getFirstMatch(/(?:tizen\s?)?browser\/(\d+(\.?_?\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/qupzilla/i],describe:function(e){var t={name:"QupZilla"},r=i.default.getFirstMatch(/(?:qupzilla)[\s/](\d+(\.?_?\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/firefox|iceweasel|fxios/i],describe:function(e){var t={name:"Firefox"},r=i.default.getFirstMatch(/(?:firefox|iceweasel|fxios)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/electron/i],describe:function(e){var t={name:"Electron"},r=i.default.getFirstMatch(/(?:electron)\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/MiuiBrowser/i],describe:function(e){var t={name:"Miui"},r=i.default.getFirstMatch(/(?:MiuiBrowser)[\s/](\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/chromium/i],describe:function(e){var t={name:"Chromium"},r=i.default.getFirstMatch(/(?:chromium)[\s/](\d+(\.?_?\d+)+)/i,e)||i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/chrome|crios|crmo/i],describe:function(e){var t={name:"Chrome"},r=i.default.getFirstMatch(/(?:chrome|crios|crmo)\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/GSA/i],describe:function(e){var t={name:"Google Search"},r=i.default.getFirstMatch(/(?:GSA)\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:function(e){var t=!e.test(/like android/i),r=e.test(/android/i);return t&&r},describe:function(e){var t={name:"Android Browser"},r=i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/playstation 4/i],describe:function(e){var t={name:"PlayStation 4"},r=i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/safari|applewebkit/i],describe:function(e){var t={name:"Safari"},r=i.default.getFirstMatch(s,e);return r&&(t.version=r),t}},{test:[/.*/i],describe:function(e){var t=-1!==e.search("\\(")?/^(.*)\/(.*)[ \t]\((.*)/:/^(.*)\/(.*) /;return{name:i.default.getFirstMatch(t,e),version:i.default.getSecondMatch(t,e)}}}];t.default=a,e.exports=t.default},93:function(e,t,r){"use strict";t.__esModule=!0,t.default=void 0;var n,i=(n=r(17))&&n.__esModule?n:{default:n},s=r(18);var a=[{test:[/Roku\/DVP/],describe:function(e){var t=i.default.getFirstMatch(/Roku\/DVP-(\d+\.\d+)/i,e);return{name:s.OS_MAP.Roku,version:t}}},{test:[/windows phone/i],describe:function(e){var t=i.default.getFirstMatch(/windows phone (?:os)?\s?(\d+(\.\d+)*)/i,e);return{name:s.OS_MAP.WindowsPhone,version:t}}},{test:[/windows /i],describe:function(e){var t=i.default.getFirstMatch(/Windows ((NT|XP)( \d\d?.\d)?)/i,e),r=i.default.getWindowsVersionName(t);return{name:s.OS_MAP.Windows,version:t,versionName:r}}},{test:[/Macintosh(.*?) FxiOS(.*?)\//],describe:function(e){var t={name:s.OS_MAP.iOS},r=i.default.getSecondMatch(/(Version\/)(\d[\d.]+)/,e);return r&&(t.version=r),t}},{test:[/macintosh/i],describe:function(e){var t=i.default.getFirstMatch(/mac os x (\d+(\.?_?\d+)+)/i,e).replace(/[_\s]/g,"."),r=i.default.getMacOSVersionName(t),n={name:s.OS_MAP.MacOS,version:t};return r&&(n.versionName=r),n}},{test:[/(ipod|iphone|ipad)/i],describe:function(e){var t=i.default.getFirstMatch(/os (\d+([_\s]\d+)*) like mac os x/i,e).replace(/[_\s]/g,".");return{name:s.OS_MAP.iOS,version:t}}},{test:function(e){var t=!e.test(/like android/i),r=e.test(/android/i);return t&&r},describe:function(e){var t=i.default.getFirstMatch(/android[\s/-](\d+(\.\d+)*)/i,e),r=i.default.getAndroidVersionName(t),n={name:s.OS_MAP.Android,version:t};return r&&(n.versionName=r),n}},{test:[/(web|hpw)[o0]s/i],describe:function(e){var t=i.default.getFirstMatch(/(?:web|hpw)[o0]s\/(\d+(\.\d+)*)/i,e),r={name:s.OS_MAP.WebOS};return t&&t.length&&(r.version=t),r}},{test:[/blackberry|\bbb\d+/i,/rim\stablet/i],describe:function(e){var t=i.default.getFirstMatch(/rim\stablet\sos\s(\d+(\.\d+)*)/i,e)||i.default.getFirstMatch(/blackberry\d+\/(\d+([_\s]\d+)*)/i,e)||i.default.getFirstMatch(/\bbb(\d+)/i,e);return{name:s.OS_MAP.BlackBerry,version:t}}},{test:[/bada/i],describe:function(e){var t=i.default.getFirstMatch(/bada\/(\d+(\.\d+)*)/i,e);return{name:s.OS_MAP.Bada,version:t}}},{test:[/tizen/i],describe:function(e){var t=i.default.getFirstMatch(/tizen[/\s](\d+(\.\d+)*)/i,e);return{name:s.OS_MAP.Tizen,version:t}}},{test:[/linux/i],describe:function(){return{name:s.OS_MAP.Linux}}},{test:[/CrOS/],describe:function(){return{name:s.OS_MAP.ChromeOS}}},{test:[/PlayStation 4/],describe:function(e){var t=i.default.getFirstMatch(/PlayStation 4[/\s](\d+(\.\d+)*)/i,e);return{name:s.OS_MAP.PlayStation4,version:t}}}];t.default=a,e.exports=t.default},94:function(e,t,r){"use strict";t.__esModule=!0,t.default=void 0;var n,i=(n=r(17))&&n.__esModule?n:{default:n},s=r(18);var a=[{test:[/googlebot/i],describe:function(){return{type:"bot",vendor:"Google"}}},{test:[/huawei/i],describe:function(e){var t=i.default.getFirstMatch(/(can-l01)/i,e)&&"Nova",r={type:s.PLATFORMS_MAP.mobile,vendor:"Huawei"};return t&&(r.model=t),r}},{test:[/nexus\s*(?:7|8|9|10).*/i],describe:function(){return{type:s.PLATFORMS_MAP.tablet,vendor:"Nexus"}}},{test:[/ipad/i],describe:function(){return{type:s.PLATFORMS_MAP.tablet,vendor:"Apple",model:"iPad"}}},{test:[/Macintosh(.*?) FxiOS(.*?)\//],describe:function(){return{type:s.PLATFORMS_MAP.tablet,vendor:"Apple",model:"iPad"}}},{test:[/kftt build/i],describe:function(){return{type:s.PLATFORMS_MAP.tablet,vendor:"Amazon",model:"Kindle Fire HD 7"}}},{test:[/silk/i],describe:function(){return{type:s.PLATFORMS_MAP.tablet,vendor:"Amazon"}}},{test:[/tablet(?! pc)/i],describe:function(){return{type:s.PLATFORMS_MAP.tablet}}},{test:function(e){var t=e.test(/ipod|iphone/i),r=e.test(/like (ipod|iphone)/i);return t&&!r},describe:function(e){var t=i.default.getFirstMatch(/(ipod|iphone)/i,e);return{type:s.PLATFORMS_MAP.mobile,vendor:"Apple",model:t}}},{test:[/nexus\s*[0-6].*/i,/galaxy nexus/i],describe:function(){return{type:s.PLATFORMS_MAP.mobile,vendor:"Nexus"}}},{test:[/[^-]mobi/i],describe:function(){return{type:s.PLATFORMS_MAP.mobile}}},{test:function(e){return"blackberry"===e.getBrowserName(!0)},describe:function(){return{type:s.PLATFORMS_MAP.mobile,vendor:"BlackBerry"}}},{test:function(e){return"bada"===e.getBrowserName(!0)},describe:function(){return{type:s.PLATFORMS_MAP.mobile}}},{test:function(e){return"windows phone"===e.getBrowserName()},describe:function(){return{type:s.PLATFORMS_MAP.mobile,vendor:"Microsoft"}}},{test:function(e){var t=Number(String(e.getOSVersion()).split(".")[0]);return"android"===e.getOSName(!0)&&t>=3},describe:function(){return{type:s.PLATFORMS_MAP.tablet}}},{test:function(e){return"android"===e.getOSName(!0)},describe:function(){return{type:s.PLATFORMS_MAP.mobile}}},{test:function(e){return"macos"===e.getOSName(!0)},describe:function(){return{type:s.PLATFORMS_MAP.desktop,vendor:"Apple"}}},{test:function(e){return"windows"===e.getOSName(!0)},describe:function(){return{type:s.PLATFORMS_MAP.desktop}}},{test:function(e){return"linux"===e.getOSName(!0)},describe:function(){return{type:s.PLATFORMS_MAP.desktop}}},{test:function(e){return"playstation 4"===e.getOSName(!0)},describe:function(){return{type:s.PLATFORMS_MAP.tv}}},{test:function(e){return"roku"===e.getOSName(!0)},describe:function(){return{type:s.PLATFORMS_MAP.tv}}}];t.default=a,e.exports=t.default},95:function(e,t,r){"use strict";t.__esModule=!0,t.default=void 0;var n,i=(n=r(17))&&n.__esModule?n:{default:n},s=r(18);var a=[{test:function(e){return"microsoft edge"===e.getBrowserName(!0)},describe:function(e){if(/\sedg\//i.test(e))return{name:s.ENGINE_MAP.Blink};var t=i.default.getFirstMatch(/edge\/(\d+(\.?_?\d+)+)/i,e);return{name:s.ENGINE_MAP.EdgeHTML,version:t}}},{test:[/trident/i],describe:function(e){var t={name:s.ENGINE_MAP.Trident},r=i.default.getFirstMatch(/trident\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:function(e){return e.test(/presto/i)},describe:function(e){var t={name:s.ENGINE_MAP.Presto},r=i.default.getFirstMatch(/presto\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:function(e){var t=e.test(/gecko/i),r=e.test(/like gecko/i);return t&&!r},describe:function(e){var t={name:s.ENGINE_MAP.Gecko},r=i.default.getFirstMatch(/gecko\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}},{test:[/(apple)?webkit\/537\.36/i],describe:function(){return{name:s.ENGINE_MAP.Blink}}},{test:[/(apple)?webkit/i],describe:function(e){var t={name:s.ENGINE_MAP.WebKit},r=i.default.getFirstMatch(/webkit\/(\d+(\.?_?\d+)+)/i,e);return r&&(t.version=r),t}}];t.default=a,e.exports=t.default}})}));

/***/ }),

/***/ "./node_modules/buffer/index.js":
/*!**************************************!*\
  !*** ./node_modules/buffer/index.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
/*!
 * The buffer module from node.js, for the browser.
 *
 * @author   Feross Aboukhadijeh <http://feross.org>
 * @license  MIT
 */
/* eslint-disable no-proto */



var base64 = __webpack_require__(/*! base64-js */ "./node_modules/base64-js/index.js")
var ieee754 = __webpack_require__(/*! ieee754 */ "./node_modules/ieee754/index.js")
var isArray = __webpack_require__(/*! isarray */ "./node_modules/isarray/index.js")

exports.Buffer = Buffer
exports.SlowBuffer = SlowBuffer
exports.INSPECT_MAX_BYTES = 50

/**
 * If `Buffer.TYPED_ARRAY_SUPPORT`:
 *   === true    Use Uint8Array implementation (fastest)
 *   === false   Use Object implementation (most compatible, even IE6)
 *
 * Browsers that support typed arrays are IE 10+, Firefox 4+, Chrome 7+, Safari 5.1+,
 * Opera 11.6+, iOS 4.2+.
 *
 * Due to various browser bugs, sometimes the Object implementation will be used even
 * when the browser supports typed arrays.
 *
 * Note:
 *
 *   - Firefox 4-29 lacks support for adding new properties to `Uint8Array` instances,
 *     See: https://bugzilla.mozilla.org/show_bug.cgi?id=695438.
 *
 *   - Chrome 9-10 is missing the `TypedArray.prototype.subarray` function.
 *
 *   - IE10 has a broken `TypedArray.prototype.subarray` function which returns arrays of
 *     incorrect length in some situations.

 * We detect these buggy browsers and set `Buffer.TYPED_ARRAY_SUPPORT` to `false` so they
 * get the Object implementation, which is slower but behaves correctly.
 */
Buffer.TYPED_ARRAY_SUPPORT = __webpack_require__.g.TYPED_ARRAY_SUPPORT !== undefined
  ? __webpack_require__.g.TYPED_ARRAY_SUPPORT
  : typedArraySupport()

/*
 * Export kMaxLength after typed array support is determined.
 */
exports.kMaxLength = kMaxLength()

function typedArraySupport () {
  try {
    var arr = new Uint8Array(1)
    arr.__proto__ = {__proto__: Uint8Array.prototype, foo: function () { return 42 }}
    return arr.foo() === 42 && // typed array instances can be augmented
        typeof arr.subarray === 'function' && // chrome 9-10 lack `subarray`
        arr.subarray(1, 1).byteLength === 0 // ie10 has broken `subarray`
  } catch (e) {
    return false
  }
}

function kMaxLength () {
  return Buffer.TYPED_ARRAY_SUPPORT
    ? 0x7fffffff
    : 0x3fffffff
}

function createBuffer (that, length) {
  if (kMaxLength() < length) {
    throw new RangeError('Invalid typed array length')
  }
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    // Return an augmented `Uint8Array` instance, for best performance
    that = new Uint8Array(length)
    that.__proto__ = Buffer.prototype
  } else {
    // Fallback: Return an object instance of the Buffer class
    if (that === null) {
      that = new Buffer(length)
    }
    that.length = length
  }

  return that
}

/**
 * The Buffer constructor returns instances of `Uint8Array` that have their
 * prototype changed to `Buffer.prototype`. Furthermore, `Buffer` is a subclass of
 * `Uint8Array`, so the returned instances will have all the node `Buffer` methods
 * and the `Uint8Array` methods. Square bracket notation works as expected -- it
 * returns a single octet.
 *
 * The `Uint8Array` prototype remains unmodified.
 */

function Buffer (arg, encodingOrOffset, length) {
  if (!Buffer.TYPED_ARRAY_SUPPORT && !(this instanceof Buffer)) {
    return new Buffer(arg, encodingOrOffset, length)
  }

  // Common case.
  if (typeof arg === 'number') {
    if (typeof encodingOrOffset === 'string') {
      throw new Error(
        'If encoding is specified then the first argument must be a string'
      )
    }
    return allocUnsafe(this, arg)
  }
  return from(this, arg, encodingOrOffset, length)
}

Buffer.poolSize = 8192 // not used by this implementation

// TODO: Legacy, not needed anymore. Remove in next major version.
Buffer._augment = function (arr) {
  arr.__proto__ = Buffer.prototype
  return arr
}

function from (that, value, encodingOrOffset, length) {
  if (typeof value === 'number') {
    throw new TypeError('"value" argument must not be a number')
  }

  if (typeof ArrayBuffer !== 'undefined' && value instanceof ArrayBuffer) {
    return fromArrayBuffer(that, value, encodingOrOffset, length)
  }

  if (typeof value === 'string') {
    return fromString(that, value, encodingOrOffset)
  }

  return fromObject(that, value)
}

/**
 * Functionally equivalent to Buffer(arg, encoding) but throws a TypeError
 * if value is a number.
 * Buffer.from(str[, encoding])
 * Buffer.from(array)
 * Buffer.from(buffer)
 * Buffer.from(arrayBuffer[, byteOffset[, length]])
 **/
Buffer.from = function (value, encodingOrOffset, length) {
  return from(null, value, encodingOrOffset, length)
}

if (Buffer.TYPED_ARRAY_SUPPORT) {
  Buffer.prototype.__proto__ = Uint8Array.prototype
  Buffer.__proto__ = Uint8Array
  if (typeof Symbol !== 'undefined' && Symbol.species &&
      Buffer[Symbol.species] === Buffer) {
    // Fix subarray() in ES2016. See: https://github.com/feross/buffer/pull/97
    Object.defineProperty(Buffer, Symbol.species, {
      value: null,
      configurable: true
    })
  }
}

function assertSize (size) {
  if (typeof size !== 'number') {
    throw new TypeError('"size" argument must be a number')
  } else if (size < 0) {
    throw new RangeError('"size" argument must not be negative')
  }
}

function alloc (that, size, fill, encoding) {
  assertSize(size)
  if (size <= 0) {
    return createBuffer(that, size)
  }
  if (fill !== undefined) {
    // Only pay attention to encoding if it's a string. This
    // prevents accidentally sending in a number that would
    // be interpretted as a start offset.
    return typeof encoding === 'string'
      ? createBuffer(that, size).fill(fill, encoding)
      : createBuffer(that, size).fill(fill)
  }
  return createBuffer(that, size)
}

/**
 * Creates a new filled Buffer instance.
 * alloc(size[, fill[, encoding]])
 **/
Buffer.alloc = function (size, fill, encoding) {
  return alloc(null, size, fill, encoding)
}

function allocUnsafe (that, size) {
  assertSize(size)
  that = createBuffer(that, size < 0 ? 0 : checked(size) | 0)
  if (!Buffer.TYPED_ARRAY_SUPPORT) {
    for (var i = 0; i < size; ++i) {
      that[i] = 0
    }
  }
  return that
}

/**
 * Equivalent to Buffer(num), by default creates a non-zero-filled Buffer instance.
 * */
Buffer.allocUnsafe = function (size) {
  return allocUnsafe(null, size)
}
/**
 * Equivalent to SlowBuffer(num), by default creates a non-zero-filled Buffer instance.
 */
Buffer.allocUnsafeSlow = function (size) {
  return allocUnsafe(null, size)
}

function fromString (that, string, encoding) {
  if (typeof encoding !== 'string' || encoding === '') {
    encoding = 'utf8'
  }

  if (!Buffer.isEncoding(encoding)) {
    throw new TypeError('"encoding" must be a valid string encoding')
  }

  var length = byteLength(string, encoding) | 0
  that = createBuffer(that, length)

  var actual = that.write(string, encoding)

  if (actual !== length) {
    // Writing a hex string, for example, that contains invalid characters will
    // cause everything after the first invalid character to be ignored. (e.g.
    // 'abxxcd' will be treated as 'ab')
    that = that.slice(0, actual)
  }

  return that
}

function fromArrayLike (that, array) {
  var length = array.length < 0 ? 0 : checked(array.length) | 0
  that = createBuffer(that, length)
  for (var i = 0; i < length; i += 1) {
    that[i] = array[i] & 255
  }
  return that
}

function fromArrayBuffer (that, array, byteOffset, length) {
  array.byteLength // this throws if `array` is not a valid ArrayBuffer

  if (byteOffset < 0 || array.byteLength < byteOffset) {
    throw new RangeError('\'offset\' is out of bounds')
  }

  if (array.byteLength < byteOffset + (length || 0)) {
    throw new RangeError('\'length\' is out of bounds')
  }

  if (byteOffset === undefined && length === undefined) {
    array = new Uint8Array(array)
  } else if (length === undefined) {
    array = new Uint8Array(array, byteOffset)
  } else {
    array = new Uint8Array(array, byteOffset, length)
  }

  if (Buffer.TYPED_ARRAY_SUPPORT) {
    // Return an augmented `Uint8Array` instance, for best performance
    that = array
    that.__proto__ = Buffer.prototype
  } else {
    // Fallback: Return an object instance of the Buffer class
    that = fromArrayLike(that, array)
  }
  return that
}

function fromObject (that, obj) {
  if (Buffer.isBuffer(obj)) {
    var len = checked(obj.length) | 0
    that = createBuffer(that, len)

    if (that.length === 0) {
      return that
    }

    obj.copy(that, 0, 0, len)
    return that
  }

  if (obj) {
    if ((typeof ArrayBuffer !== 'undefined' &&
        obj.buffer instanceof ArrayBuffer) || 'length' in obj) {
      if (typeof obj.length !== 'number' || isnan(obj.length)) {
        return createBuffer(that, 0)
      }
      return fromArrayLike(that, obj)
    }

    if (obj.type === 'Buffer' && isArray(obj.data)) {
      return fromArrayLike(that, obj.data)
    }
  }

  throw new TypeError('First argument must be a string, Buffer, ArrayBuffer, Array, or array-like object.')
}

function checked (length) {
  // Note: cannot use `length < kMaxLength()` here because that fails when
  // length is NaN (which is otherwise coerced to zero.)
  if (length >= kMaxLength()) {
    throw new RangeError('Attempt to allocate Buffer larger than maximum ' +
                         'size: 0x' + kMaxLength().toString(16) + ' bytes')
  }
  return length | 0
}

function SlowBuffer (length) {
  if (+length != length) { // eslint-disable-line eqeqeq
    length = 0
  }
  return Buffer.alloc(+length)
}

Buffer.isBuffer = function isBuffer (b) {
  return !!(b != null && b._isBuffer)
}

Buffer.compare = function compare (a, b) {
  if (!Buffer.isBuffer(a) || !Buffer.isBuffer(b)) {
    throw new TypeError('Arguments must be Buffers')
  }

  if (a === b) return 0

  var x = a.length
  var y = b.length

  for (var i = 0, len = Math.min(x, y); i < len; ++i) {
    if (a[i] !== b[i]) {
      x = a[i]
      y = b[i]
      break
    }
  }

  if (x < y) return -1
  if (y < x) return 1
  return 0
}

Buffer.isEncoding = function isEncoding (encoding) {
  switch (String(encoding).toLowerCase()) {
    case 'hex':
    case 'utf8':
    case 'utf-8':
    case 'ascii':
    case 'latin1':
    case 'binary':
    case 'base64':
    case 'ucs2':
    case 'ucs-2':
    case 'utf16le':
    case 'utf-16le':
      return true
    default:
      return false
  }
}

Buffer.concat = function concat (list, length) {
  if (!isArray(list)) {
    throw new TypeError('"list" argument must be an Array of Buffers')
  }

  if (list.length === 0) {
    return Buffer.alloc(0)
  }

  var i
  if (length === undefined) {
    length = 0
    for (i = 0; i < list.length; ++i) {
      length += list[i].length
    }
  }

  var buffer = Buffer.allocUnsafe(length)
  var pos = 0
  for (i = 0; i < list.length; ++i) {
    var buf = list[i]
    if (!Buffer.isBuffer(buf)) {
      throw new TypeError('"list" argument must be an Array of Buffers')
    }
    buf.copy(buffer, pos)
    pos += buf.length
  }
  return buffer
}

function byteLength (string, encoding) {
  if (Buffer.isBuffer(string)) {
    return string.length
  }
  if (typeof ArrayBuffer !== 'undefined' && typeof ArrayBuffer.isView === 'function' &&
      (ArrayBuffer.isView(string) || string instanceof ArrayBuffer)) {
    return string.byteLength
  }
  if (typeof string !== 'string') {
    string = '' + string
  }

  var len = string.length
  if (len === 0) return 0

  // Use a for loop to avoid recursion
  var loweredCase = false
  for (;;) {
    switch (encoding) {
      case 'ascii':
      case 'latin1':
      case 'binary':
        return len
      case 'utf8':
      case 'utf-8':
      case undefined:
        return utf8ToBytes(string).length
      case 'ucs2':
      case 'ucs-2':
      case 'utf16le':
      case 'utf-16le':
        return len * 2
      case 'hex':
        return len >>> 1
      case 'base64':
        return base64ToBytes(string).length
      default:
        if (loweredCase) return utf8ToBytes(string).length // assume utf8
        encoding = ('' + encoding).toLowerCase()
        loweredCase = true
    }
  }
}
Buffer.byteLength = byteLength

function slowToString (encoding, start, end) {
  var loweredCase = false

  // No need to verify that "this.length <= MAX_UINT32" since it's a read-only
  // property of a typed array.

  // This behaves neither like String nor Uint8Array in that we set start/end
  // to their upper/lower bounds if the value passed is out of range.
  // undefined is handled specially as per ECMA-262 6th Edition,
  // Section 13.3.3.7 Runtime Semantics: KeyedBindingInitialization.
  if (start === undefined || start < 0) {
    start = 0
  }
  // Return early if start > this.length. Done here to prevent potential uint32
  // coercion fail below.
  if (start > this.length) {
    return ''
  }

  if (end === undefined || end > this.length) {
    end = this.length
  }

  if (end <= 0) {
    return ''
  }

  // Force coersion to uint32. This will also coerce falsey/NaN values to 0.
  end >>>= 0
  start >>>= 0

  if (end <= start) {
    return ''
  }

  if (!encoding) encoding = 'utf8'

  while (true) {
    switch (encoding) {
      case 'hex':
        return hexSlice(this, start, end)

      case 'utf8':
      case 'utf-8':
        return utf8Slice(this, start, end)

      case 'ascii':
        return asciiSlice(this, start, end)

      case 'latin1':
      case 'binary':
        return latin1Slice(this, start, end)

      case 'base64':
        return base64Slice(this, start, end)

      case 'ucs2':
      case 'ucs-2':
      case 'utf16le':
      case 'utf-16le':
        return utf16leSlice(this, start, end)

      default:
        if (loweredCase) throw new TypeError('Unknown encoding: ' + encoding)
        encoding = (encoding + '').toLowerCase()
        loweredCase = true
    }
  }
}

// The property is used by `Buffer.isBuffer` and `is-buffer` (in Safari 5-7) to detect
// Buffer instances.
Buffer.prototype._isBuffer = true

function swap (b, n, m) {
  var i = b[n]
  b[n] = b[m]
  b[m] = i
}

Buffer.prototype.swap16 = function swap16 () {
  var len = this.length
  if (len % 2 !== 0) {
    throw new RangeError('Buffer size must be a multiple of 16-bits')
  }
  for (var i = 0; i < len; i += 2) {
    swap(this, i, i + 1)
  }
  return this
}

Buffer.prototype.swap32 = function swap32 () {
  var len = this.length
  if (len % 4 !== 0) {
    throw new RangeError('Buffer size must be a multiple of 32-bits')
  }
  for (var i = 0; i < len; i += 4) {
    swap(this, i, i + 3)
    swap(this, i + 1, i + 2)
  }
  return this
}

Buffer.prototype.swap64 = function swap64 () {
  var len = this.length
  if (len % 8 !== 0) {
    throw new RangeError('Buffer size must be a multiple of 64-bits')
  }
  for (var i = 0; i < len; i += 8) {
    swap(this, i, i + 7)
    swap(this, i + 1, i + 6)
    swap(this, i + 2, i + 5)
    swap(this, i + 3, i + 4)
  }
  return this
}

Buffer.prototype.toString = function toString () {
  var length = this.length | 0
  if (length === 0) return ''
  if (arguments.length === 0) return utf8Slice(this, 0, length)
  return slowToString.apply(this, arguments)
}

Buffer.prototype.equals = function equals (b) {
  if (!Buffer.isBuffer(b)) throw new TypeError('Argument must be a Buffer')
  if (this === b) return true
  return Buffer.compare(this, b) === 0
}

Buffer.prototype.inspect = function inspect () {
  var str = ''
  var max = exports.INSPECT_MAX_BYTES
  if (this.length > 0) {
    str = this.toString('hex', 0, max).match(/.{2}/g).join(' ')
    if (this.length > max) str += ' ... '
  }
  return '<Buffer ' + str + '>'
}

Buffer.prototype.compare = function compare (target, start, end, thisStart, thisEnd) {
  if (!Buffer.isBuffer(target)) {
    throw new TypeError('Argument must be a Buffer')
  }

  if (start === undefined) {
    start = 0
  }
  if (end === undefined) {
    end = target ? target.length : 0
  }
  if (thisStart === undefined) {
    thisStart = 0
  }
  if (thisEnd === undefined) {
    thisEnd = this.length
  }

  if (start < 0 || end > target.length || thisStart < 0 || thisEnd > this.length) {
    throw new RangeError('out of range index')
  }

  if (thisStart >= thisEnd && start >= end) {
    return 0
  }
  if (thisStart >= thisEnd) {
    return -1
  }
  if (start >= end) {
    return 1
  }

  start >>>= 0
  end >>>= 0
  thisStart >>>= 0
  thisEnd >>>= 0

  if (this === target) return 0

  var x = thisEnd - thisStart
  var y = end - start
  var len = Math.min(x, y)

  var thisCopy = this.slice(thisStart, thisEnd)
  var targetCopy = target.slice(start, end)

  for (var i = 0; i < len; ++i) {
    if (thisCopy[i] !== targetCopy[i]) {
      x = thisCopy[i]
      y = targetCopy[i]
      break
    }
  }

  if (x < y) return -1
  if (y < x) return 1
  return 0
}

// Finds either the first index of `val` in `buffer` at offset >= `byteOffset`,
// OR the last index of `val` in `buffer` at offset <= `byteOffset`.
//
// Arguments:
// - buffer - a Buffer to search
// - val - a string, Buffer, or number
// - byteOffset - an index into `buffer`; will be clamped to an int32
// - encoding - an optional encoding, relevant is val is a string
// - dir - true for indexOf, false for lastIndexOf
function bidirectionalIndexOf (buffer, val, byteOffset, encoding, dir) {
  // Empty buffer means no match
  if (buffer.length === 0) return -1

  // Normalize byteOffset
  if (typeof byteOffset === 'string') {
    encoding = byteOffset
    byteOffset = 0
  } else if (byteOffset > 0x7fffffff) {
    byteOffset = 0x7fffffff
  } else if (byteOffset < -0x80000000) {
    byteOffset = -0x80000000
  }
  byteOffset = +byteOffset  // Coerce to Number.
  if (isNaN(byteOffset)) {
    // byteOffset: it it's undefined, null, NaN, "foo", etc, search whole buffer
    byteOffset = dir ? 0 : (buffer.length - 1)
  }

  // Normalize byteOffset: negative offsets start from the end of the buffer
  if (byteOffset < 0) byteOffset = buffer.length + byteOffset
  if (byteOffset >= buffer.length) {
    if (dir) return -1
    else byteOffset = buffer.length - 1
  } else if (byteOffset < 0) {
    if (dir) byteOffset = 0
    else return -1
  }

  // Normalize val
  if (typeof val === 'string') {
    val = Buffer.from(val, encoding)
  }

  // Finally, search either indexOf (if dir is true) or lastIndexOf
  if (Buffer.isBuffer(val)) {
    // Special case: looking for empty string/buffer always fails
    if (val.length === 0) {
      return -1
    }
    return arrayIndexOf(buffer, val, byteOffset, encoding, dir)
  } else if (typeof val === 'number') {
    val = val & 0xFF // Search for a byte value [0-255]
    if (Buffer.TYPED_ARRAY_SUPPORT &&
        typeof Uint8Array.prototype.indexOf === 'function') {
      if (dir) {
        return Uint8Array.prototype.indexOf.call(buffer, val, byteOffset)
      } else {
        return Uint8Array.prototype.lastIndexOf.call(buffer, val, byteOffset)
      }
    }
    return arrayIndexOf(buffer, [ val ], byteOffset, encoding, dir)
  }

  throw new TypeError('val must be string, number or Buffer')
}

function arrayIndexOf (arr, val, byteOffset, encoding, dir) {
  var indexSize = 1
  var arrLength = arr.length
  var valLength = val.length

  if (encoding !== undefined) {
    encoding = String(encoding).toLowerCase()
    if (encoding === 'ucs2' || encoding === 'ucs-2' ||
        encoding === 'utf16le' || encoding === 'utf-16le') {
      if (arr.length < 2 || val.length < 2) {
        return -1
      }
      indexSize = 2
      arrLength /= 2
      valLength /= 2
      byteOffset /= 2
    }
  }

  function read (buf, i) {
    if (indexSize === 1) {
      return buf[i]
    } else {
      return buf.readUInt16BE(i * indexSize)
    }
  }

  var i
  if (dir) {
    var foundIndex = -1
    for (i = byteOffset; i < arrLength; i++) {
      if (read(arr, i) === read(val, foundIndex === -1 ? 0 : i - foundIndex)) {
        if (foundIndex === -1) foundIndex = i
        if (i - foundIndex + 1 === valLength) return foundIndex * indexSize
      } else {
        if (foundIndex !== -1) i -= i - foundIndex
        foundIndex = -1
      }
    }
  } else {
    if (byteOffset + valLength > arrLength) byteOffset = arrLength - valLength
    for (i = byteOffset; i >= 0; i--) {
      var found = true
      for (var j = 0; j < valLength; j++) {
        if (read(arr, i + j) !== read(val, j)) {
          found = false
          break
        }
      }
      if (found) return i
    }
  }

  return -1
}

Buffer.prototype.includes = function includes (val, byteOffset, encoding) {
  return this.indexOf(val, byteOffset, encoding) !== -1
}

Buffer.prototype.indexOf = function indexOf (val, byteOffset, encoding) {
  return bidirectionalIndexOf(this, val, byteOffset, encoding, true)
}

Buffer.prototype.lastIndexOf = function lastIndexOf (val, byteOffset, encoding) {
  return bidirectionalIndexOf(this, val, byteOffset, encoding, false)
}

function hexWrite (buf, string, offset, length) {
  offset = Number(offset) || 0
  var remaining = buf.length - offset
  if (!length) {
    length = remaining
  } else {
    length = Number(length)
    if (length > remaining) {
      length = remaining
    }
  }

  // must be an even number of digits
  var strLen = string.length
  if (strLen % 2 !== 0) throw new TypeError('Invalid hex string')

  if (length > strLen / 2) {
    length = strLen / 2
  }
  for (var i = 0; i < length; ++i) {
    var parsed = parseInt(string.substr(i * 2, 2), 16)
    if (isNaN(parsed)) return i
    buf[offset + i] = parsed
  }
  return i
}

function utf8Write (buf, string, offset, length) {
  return blitBuffer(utf8ToBytes(string, buf.length - offset), buf, offset, length)
}

function asciiWrite (buf, string, offset, length) {
  return blitBuffer(asciiToBytes(string), buf, offset, length)
}

function latin1Write (buf, string, offset, length) {
  return asciiWrite(buf, string, offset, length)
}

function base64Write (buf, string, offset, length) {
  return blitBuffer(base64ToBytes(string), buf, offset, length)
}

function ucs2Write (buf, string, offset, length) {
  return blitBuffer(utf16leToBytes(string, buf.length - offset), buf, offset, length)
}

Buffer.prototype.write = function write (string, offset, length, encoding) {
  // Buffer#write(string)
  if (offset === undefined) {
    encoding = 'utf8'
    length = this.length
    offset = 0
  // Buffer#write(string, encoding)
  } else if (length === undefined && typeof offset === 'string') {
    encoding = offset
    length = this.length
    offset = 0
  // Buffer#write(string, offset[, length][, encoding])
  } else if (isFinite(offset)) {
    offset = offset | 0
    if (isFinite(length)) {
      length = length | 0
      if (encoding === undefined) encoding = 'utf8'
    } else {
      encoding = length
      length = undefined
    }
  // legacy write(string, encoding, offset, length) - remove in v0.13
  } else {
    throw new Error(
      'Buffer.write(string, encoding, offset[, length]) is no longer supported'
    )
  }

  var remaining = this.length - offset
  if (length === undefined || length > remaining) length = remaining

  if ((string.length > 0 && (length < 0 || offset < 0)) || offset > this.length) {
    throw new RangeError('Attempt to write outside buffer bounds')
  }

  if (!encoding) encoding = 'utf8'

  var loweredCase = false
  for (;;) {
    switch (encoding) {
      case 'hex':
        return hexWrite(this, string, offset, length)

      case 'utf8':
      case 'utf-8':
        return utf8Write(this, string, offset, length)

      case 'ascii':
        return asciiWrite(this, string, offset, length)

      case 'latin1':
      case 'binary':
        return latin1Write(this, string, offset, length)

      case 'base64':
        // Warning: maxLength not taken into account in base64Write
        return base64Write(this, string, offset, length)

      case 'ucs2':
      case 'ucs-2':
      case 'utf16le':
      case 'utf-16le':
        return ucs2Write(this, string, offset, length)

      default:
        if (loweredCase) throw new TypeError('Unknown encoding: ' + encoding)
        encoding = ('' + encoding).toLowerCase()
        loweredCase = true
    }
  }
}

Buffer.prototype.toJSON = function toJSON () {
  return {
    type: 'Buffer',
    data: Array.prototype.slice.call(this._arr || this, 0)
  }
}

function base64Slice (buf, start, end) {
  if (start === 0 && end === buf.length) {
    return base64.fromByteArray(buf)
  } else {
    return base64.fromByteArray(buf.slice(start, end))
  }
}

function utf8Slice (buf, start, end) {
  end = Math.min(buf.length, end)
  var res = []

  var i = start
  while (i < end) {
    var firstByte = buf[i]
    var codePoint = null
    var bytesPerSequence = (firstByte > 0xEF) ? 4
      : (firstByte > 0xDF) ? 3
      : (firstByte > 0xBF) ? 2
      : 1

    if (i + bytesPerSequence <= end) {
      var secondByte, thirdByte, fourthByte, tempCodePoint

      switch (bytesPerSequence) {
        case 1:
          if (firstByte < 0x80) {
            codePoint = firstByte
          }
          break
        case 2:
          secondByte = buf[i + 1]
          if ((secondByte & 0xC0) === 0x80) {
            tempCodePoint = (firstByte & 0x1F) << 0x6 | (secondByte & 0x3F)
            if (tempCodePoint > 0x7F) {
              codePoint = tempCodePoint
            }
          }
          break
        case 3:
          secondByte = buf[i + 1]
          thirdByte = buf[i + 2]
          if ((secondByte & 0xC0) === 0x80 && (thirdByte & 0xC0) === 0x80) {
            tempCodePoint = (firstByte & 0xF) << 0xC | (secondByte & 0x3F) << 0x6 | (thirdByte & 0x3F)
            if (tempCodePoint > 0x7FF && (tempCodePoint < 0xD800 || tempCodePoint > 0xDFFF)) {
              codePoint = tempCodePoint
            }
          }
          break
        case 4:
          secondByte = buf[i + 1]
          thirdByte = buf[i + 2]
          fourthByte = buf[i + 3]
          if ((secondByte & 0xC0) === 0x80 && (thirdByte & 0xC0) === 0x80 && (fourthByte & 0xC0) === 0x80) {
            tempCodePoint = (firstByte & 0xF) << 0x12 | (secondByte & 0x3F) << 0xC | (thirdByte & 0x3F) << 0x6 | (fourthByte & 0x3F)
            if (tempCodePoint > 0xFFFF && tempCodePoint < 0x110000) {
              codePoint = tempCodePoint
            }
          }
      }
    }

    if (codePoint === null) {
      // we did not generate a valid codePoint so insert a
      // replacement char (U+FFFD) and advance only 1 byte
      codePoint = 0xFFFD
      bytesPerSequence = 1
    } else if (codePoint > 0xFFFF) {
      // encode to utf16 (surrogate pair dance)
      codePoint -= 0x10000
      res.push(codePoint >>> 10 & 0x3FF | 0xD800)
      codePoint = 0xDC00 | codePoint & 0x3FF
    }

    res.push(codePoint)
    i += bytesPerSequence
  }

  return decodeCodePointsArray(res)
}

// Based on http://stackoverflow.com/a/22747272/680742, the browser with
// the lowest limit is Chrome, with 0x10000 args.
// We go 1 magnitude less, for safety
var MAX_ARGUMENTS_LENGTH = 0x1000

function decodeCodePointsArray (codePoints) {
  var len = codePoints.length
  if (len <= MAX_ARGUMENTS_LENGTH) {
    return String.fromCharCode.apply(String, codePoints) // avoid extra slice()
  }

  // Decode in chunks to avoid "call stack size exceeded".
  var res = ''
  var i = 0
  while (i < len) {
    res += String.fromCharCode.apply(
      String,
      codePoints.slice(i, i += MAX_ARGUMENTS_LENGTH)
    )
  }
  return res
}

function asciiSlice (buf, start, end) {
  var ret = ''
  end = Math.min(buf.length, end)

  for (var i = start; i < end; ++i) {
    ret += String.fromCharCode(buf[i] & 0x7F)
  }
  return ret
}

function latin1Slice (buf, start, end) {
  var ret = ''
  end = Math.min(buf.length, end)

  for (var i = start; i < end; ++i) {
    ret += String.fromCharCode(buf[i])
  }
  return ret
}

function hexSlice (buf, start, end) {
  var len = buf.length

  if (!start || start < 0) start = 0
  if (!end || end < 0 || end > len) end = len

  var out = ''
  for (var i = start; i < end; ++i) {
    out += toHex(buf[i])
  }
  return out
}

function utf16leSlice (buf, start, end) {
  var bytes = buf.slice(start, end)
  var res = ''
  for (var i = 0; i < bytes.length; i += 2) {
    res += String.fromCharCode(bytes[i] + bytes[i + 1] * 256)
  }
  return res
}

Buffer.prototype.slice = function slice (start, end) {
  var len = this.length
  start = ~~start
  end = end === undefined ? len : ~~end

  if (start < 0) {
    start += len
    if (start < 0) start = 0
  } else if (start > len) {
    start = len
  }

  if (end < 0) {
    end += len
    if (end < 0) end = 0
  } else if (end > len) {
    end = len
  }

  if (end < start) end = start

  var newBuf
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    newBuf = this.subarray(start, end)
    newBuf.__proto__ = Buffer.prototype
  } else {
    var sliceLen = end - start
    newBuf = new Buffer(sliceLen, undefined)
    for (var i = 0; i < sliceLen; ++i) {
      newBuf[i] = this[i + start]
    }
  }

  return newBuf
}

/*
 * Need to make sure that buffer isn't trying to write out of bounds.
 */
function checkOffset (offset, ext, length) {
  if ((offset % 1) !== 0 || offset < 0) throw new RangeError('offset is not uint')
  if (offset + ext > length) throw new RangeError('Trying to access beyond buffer length')
}

Buffer.prototype.readUIntLE = function readUIntLE (offset, byteLength, noAssert) {
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) checkOffset(offset, byteLength, this.length)

  var val = this[offset]
  var mul = 1
  var i = 0
  while (++i < byteLength && (mul *= 0x100)) {
    val += this[offset + i] * mul
  }

  return val
}

Buffer.prototype.readUIntBE = function readUIntBE (offset, byteLength, noAssert) {
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) {
    checkOffset(offset, byteLength, this.length)
  }

  var val = this[offset + --byteLength]
  var mul = 1
  while (byteLength > 0 && (mul *= 0x100)) {
    val += this[offset + --byteLength] * mul
  }

  return val
}

Buffer.prototype.readUInt8 = function readUInt8 (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 1, this.length)
  return this[offset]
}

Buffer.prototype.readUInt16LE = function readUInt16LE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 2, this.length)
  return this[offset] | (this[offset + 1] << 8)
}

Buffer.prototype.readUInt16BE = function readUInt16BE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 2, this.length)
  return (this[offset] << 8) | this[offset + 1]
}

Buffer.prototype.readUInt32LE = function readUInt32LE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)

  return ((this[offset]) |
      (this[offset + 1] << 8) |
      (this[offset + 2] << 16)) +
      (this[offset + 3] * 0x1000000)
}

Buffer.prototype.readUInt32BE = function readUInt32BE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)

  return (this[offset] * 0x1000000) +
    ((this[offset + 1] << 16) |
    (this[offset + 2] << 8) |
    this[offset + 3])
}

Buffer.prototype.readIntLE = function readIntLE (offset, byteLength, noAssert) {
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) checkOffset(offset, byteLength, this.length)

  var val = this[offset]
  var mul = 1
  var i = 0
  while (++i < byteLength && (mul *= 0x100)) {
    val += this[offset + i] * mul
  }
  mul *= 0x80

  if (val >= mul) val -= Math.pow(2, 8 * byteLength)

  return val
}

Buffer.prototype.readIntBE = function readIntBE (offset, byteLength, noAssert) {
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) checkOffset(offset, byteLength, this.length)

  var i = byteLength
  var mul = 1
  var val = this[offset + --i]
  while (i > 0 && (mul *= 0x100)) {
    val += this[offset + --i] * mul
  }
  mul *= 0x80

  if (val >= mul) val -= Math.pow(2, 8 * byteLength)

  return val
}

Buffer.prototype.readInt8 = function readInt8 (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 1, this.length)
  if (!(this[offset] & 0x80)) return (this[offset])
  return ((0xff - this[offset] + 1) * -1)
}

Buffer.prototype.readInt16LE = function readInt16LE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 2, this.length)
  var val = this[offset] | (this[offset + 1] << 8)
  return (val & 0x8000) ? val | 0xFFFF0000 : val
}

Buffer.prototype.readInt16BE = function readInt16BE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 2, this.length)
  var val = this[offset + 1] | (this[offset] << 8)
  return (val & 0x8000) ? val | 0xFFFF0000 : val
}

Buffer.prototype.readInt32LE = function readInt32LE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)

  return (this[offset]) |
    (this[offset + 1] << 8) |
    (this[offset + 2] << 16) |
    (this[offset + 3] << 24)
}

Buffer.prototype.readInt32BE = function readInt32BE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)

  return (this[offset] << 24) |
    (this[offset + 1] << 16) |
    (this[offset + 2] << 8) |
    (this[offset + 3])
}

Buffer.prototype.readFloatLE = function readFloatLE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)
  return ieee754.read(this, offset, true, 23, 4)
}

Buffer.prototype.readFloatBE = function readFloatBE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)
  return ieee754.read(this, offset, false, 23, 4)
}

Buffer.prototype.readDoubleLE = function readDoubleLE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 8, this.length)
  return ieee754.read(this, offset, true, 52, 8)
}

Buffer.prototype.readDoubleBE = function readDoubleBE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 8, this.length)
  return ieee754.read(this, offset, false, 52, 8)
}

function checkInt (buf, value, offset, ext, max, min) {
  if (!Buffer.isBuffer(buf)) throw new TypeError('"buffer" argument must be a Buffer instance')
  if (value > max || value < min) throw new RangeError('"value" argument is out of bounds')
  if (offset + ext > buf.length) throw new RangeError('Index out of range')
}

Buffer.prototype.writeUIntLE = function writeUIntLE (value, offset, byteLength, noAssert) {
  value = +value
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) {
    var maxBytes = Math.pow(2, 8 * byteLength) - 1
    checkInt(this, value, offset, byteLength, maxBytes, 0)
  }

  var mul = 1
  var i = 0
  this[offset] = value & 0xFF
  while (++i < byteLength && (mul *= 0x100)) {
    this[offset + i] = (value / mul) & 0xFF
  }

  return offset + byteLength
}

Buffer.prototype.writeUIntBE = function writeUIntBE (value, offset, byteLength, noAssert) {
  value = +value
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) {
    var maxBytes = Math.pow(2, 8 * byteLength) - 1
    checkInt(this, value, offset, byteLength, maxBytes, 0)
  }

  var i = byteLength - 1
  var mul = 1
  this[offset + i] = value & 0xFF
  while (--i >= 0 && (mul *= 0x100)) {
    this[offset + i] = (value / mul) & 0xFF
  }

  return offset + byteLength
}

Buffer.prototype.writeUInt8 = function writeUInt8 (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 1, 0xff, 0)
  if (!Buffer.TYPED_ARRAY_SUPPORT) value = Math.floor(value)
  this[offset] = (value & 0xff)
  return offset + 1
}

function objectWriteUInt16 (buf, value, offset, littleEndian) {
  if (value < 0) value = 0xffff + value + 1
  for (var i = 0, j = Math.min(buf.length - offset, 2); i < j; ++i) {
    buf[offset + i] = (value & (0xff << (8 * (littleEndian ? i : 1 - i)))) >>>
      (littleEndian ? i : 1 - i) * 8
  }
}

Buffer.prototype.writeUInt16LE = function writeUInt16LE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 2, 0xffff, 0)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value & 0xff)
    this[offset + 1] = (value >>> 8)
  } else {
    objectWriteUInt16(this, value, offset, true)
  }
  return offset + 2
}

Buffer.prototype.writeUInt16BE = function writeUInt16BE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 2, 0xffff, 0)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value >>> 8)
    this[offset + 1] = (value & 0xff)
  } else {
    objectWriteUInt16(this, value, offset, false)
  }
  return offset + 2
}

function objectWriteUInt32 (buf, value, offset, littleEndian) {
  if (value < 0) value = 0xffffffff + value + 1
  for (var i = 0, j = Math.min(buf.length - offset, 4); i < j; ++i) {
    buf[offset + i] = (value >>> (littleEndian ? i : 3 - i) * 8) & 0xff
  }
}

Buffer.prototype.writeUInt32LE = function writeUInt32LE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 4, 0xffffffff, 0)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset + 3] = (value >>> 24)
    this[offset + 2] = (value >>> 16)
    this[offset + 1] = (value >>> 8)
    this[offset] = (value & 0xff)
  } else {
    objectWriteUInt32(this, value, offset, true)
  }
  return offset + 4
}

Buffer.prototype.writeUInt32BE = function writeUInt32BE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 4, 0xffffffff, 0)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value >>> 24)
    this[offset + 1] = (value >>> 16)
    this[offset + 2] = (value >>> 8)
    this[offset + 3] = (value & 0xff)
  } else {
    objectWriteUInt32(this, value, offset, false)
  }
  return offset + 4
}

Buffer.prototype.writeIntLE = function writeIntLE (value, offset, byteLength, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) {
    var limit = Math.pow(2, 8 * byteLength - 1)

    checkInt(this, value, offset, byteLength, limit - 1, -limit)
  }

  var i = 0
  var mul = 1
  var sub = 0
  this[offset] = value & 0xFF
  while (++i < byteLength && (mul *= 0x100)) {
    if (value < 0 && sub === 0 && this[offset + i - 1] !== 0) {
      sub = 1
    }
    this[offset + i] = ((value / mul) >> 0) - sub & 0xFF
  }

  return offset + byteLength
}

Buffer.prototype.writeIntBE = function writeIntBE (value, offset, byteLength, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) {
    var limit = Math.pow(2, 8 * byteLength - 1)

    checkInt(this, value, offset, byteLength, limit - 1, -limit)
  }

  var i = byteLength - 1
  var mul = 1
  var sub = 0
  this[offset + i] = value & 0xFF
  while (--i >= 0 && (mul *= 0x100)) {
    if (value < 0 && sub === 0 && this[offset + i + 1] !== 0) {
      sub = 1
    }
    this[offset + i] = ((value / mul) >> 0) - sub & 0xFF
  }

  return offset + byteLength
}

Buffer.prototype.writeInt8 = function writeInt8 (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 1, 0x7f, -0x80)
  if (!Buffer.TYPED_ARRAY_SUPPORT) value = Math.floor(value)
  if (value < 0) value = 0xff + value + 1
  this[offset] = (value & 0xff)
  return offset + 1
}

Buffer.prototype.writeInt16LE = function writeInt16LE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 2, 0x7fff, -0x8000)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value & 0xff)
    this[offset + 1] = (value >>> 8)
  } else {
    objectWriteUInt16(this, value, offset, true)
  }
  return offset + 2
}

Buffer.prototype.writeInt16BE = function writeInt16BE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 2, 0x7fff, -0x8000)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value >>> 8)
    this[offset + 1] = (value & 0xff)
  } else {
    objectWriteUInt16(this, value, offset, false)
  }
  return offset + 2
}

Buffer.prototype.writeInt32LE = function writeInt32LE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 4, 0x7fffffff, -0x80000000)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value & 0xff)
    this[offset + 1] = (value >>> 8)
    this[offset + 2] = (value >>> 16)
    this[offset + 3] = (value >>> 24)
  } else {
    objectWriteUInt32(this, value, offset, true)
  }
  return offset + 4
}

Buffer.prototype.writeInt32BE = function writeInt32BE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 4, 0x7fffffff, -0x80000000)
  if (value < 0) value = 0xffffffff + value + 1
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value >>> 24)
    this[offset + 1] = (value >>> 16)
    this[offset + 2] = (value >>> 8)
    this[offset + 3] = (value & 0xff)
  } else {
    objectWriteUInt32(this, value, offset, false)
  }
  return offset + 4
}

function checkIEEE754 (buf, value, offset, ext, max, min) {
  if (offset + ext > buf.length) throw new RangeError('Index out of range')
  if (offset < 0) throw new RangeError('Index out of range')
}

function writeFloat (buf, value, offset, littleEndian, noAssert) {
  if (!noAssert) {
    checkIEEE754(buf, value, offset, 4, 3.4028234663852886e+38, -3.4028234663852886e+38)
  }
  ieee754.write(buf, value, offset, littleEndian, 23, 4)
  return offset + 4
}

Buffer.prototype.writeFloatLE = function writeFloatLE (value, offset, noAssert) {
  return writeFloat(this, value, offset, true, noAssert)
}

Buffer.prototype.writeFloatBE = function writeFloatBE (value, offset, noAssert) {
  return writeFloat(this, value, offset, false, noAssert)
}

function writeDouble (buf, value, offset, littleEndian, noAssert) {
  if (!noAssert) {
    checkIEEE754(buf, value, offset, 8, 1.7976931348623157E+308, -1.7976931348623157E+308)
  }
  ieee754.write(buf, value, offset, littleEndian, 52, 8)
  return offset + 8
}

Buffer.prototype.writeDoubleLE = function writeDoubleLE (value, offset, noAssert) {
  return writeDouble(this, value, offset, true, noAssert)
}

Buffer.prototype.writeDoubleBE = function writeDoubleBE (value, offset, noAssert) {
  return writeDouble(this, value, offset, false, noAssert)
}

// copy(targetBuffer, targetStart=0, sourceStart=0, sourceEnd=buffer.length)
Buffer.prototype.copy = function copy (target, targetStart, start, end) {
  if (!start) start = 0
  if (!end && end !== 0) end = this.length
  if (targetStart >= target.length) targetStart = target.length
  if (!targetStart) targetStart = 0
  if (end > 0 && end < start) end = start

  // Copy 0 bytes; we're done
  if (end === start) return 0
  if (target.length === 0 || this.length === 0) return 0

  // Fatal error conditions
  if (targetStart < 0) {
    throw new RangeError('targetStart out of bounds')
  }
  if (start < 0 || start >= this.length) throw new RangeError('sourceStart out of bounds')
  if (end < 0) throw new RangeError('sourceEnd out of bounds')

  // Are we oob?
  if (end > this.length) end = this.length
  if (target.length - targetStart < end - start) {
    end = target.length - targetStart + start
  }

  var len = end - start
  var i

  if (this === target && start < targetStart && targetStart < end) {
    // descending copy from end
    for (i = len - 1; i >= 0; --i) {
      target[i + targetStart] = this[i + start]
    }
  } else if (len < 1000 || !Buffer.TYPED_ARRAY_SUPPORT) {
    // ascending copy from start
    for (i = 0; i < len; ++i) {
      target[i + targetStart] = this[i + start]
    }
  } else {
    Uint8Array.prototype.set.call(
      target,
      this.subarray(start, start + len),
      targetStart
    )
  }

  return len
}

// Usage:
//    buffer.fill(number[, offset[, end]])
//    buffer.fill(buffer[, offset[, end]])
//    buffer.fill(string[, offset[, end]][, encoding])
Buffer.prototype.fill = function fill (val, start, end, encoding) {
  // Handle string cases:
  if (typeof val === 'string') {
    if (typeof start === 'string') {
      encoding = start
      start = 0
      end = this.length
    } else if (typeof end === 'string') {
      encoding = end
      end = this.length
    }
    if (val.length === 1) {
      var code = val.charCodeAt(0)
      if (code < 256) {
        val = code
      }
    }
    if (encoding !== undefined && typeof encoding !== 'string') {
      throw new TypeError('encoding must be a string')
    }
    if (typeof encoding === 'string' && !Buffer.isEncoding(encoding)) {
      throw new TypeError('Unknown encoding: ' + encoding)
    }
  } else if (typeof val === 'number') {
    val = val & 255
  }

  // Invalid ranges are not set to a default, so can range check early.
  if (start < 0 || this.length < start || this.length < end) {
    throw new RangeError('Out of range index')
  }

  if (end <= start) {
    return this
  }

  start = start >>> 0
  end = end === undefined ? this.length : end >>> 0

  if (!val) val = 0

  var i
  if (typeof val === 'number') {
    for (i = start; i < end; ++i) {
      this[i] = val
    }
  } else {
    var bytes = Buffer.isBuffer(val)
      ? val
      : utf8ToBytes(new Buffer(val, encoding).toString())
    var len = bytes.length
    for (i = 0; i < end - start; ++i) {
      this[i + start] = bytes[i % len]
    }
  }

  return this
}

// HELPER FUNCTIONS
// ================

var INVALID_BASE64_RE = /[^+\/0-9A-Za-z-_]/g

function base64clean (str) {
  // Node strips out invalid characters like \n and \t from the string, base64-js does not
  str = stringtrim(str).replace(INVALID_BASE64_RE, '')
  // Node converts strings with length < 2 to ''
  if (str.length < 2) return ''
  // Node allows for non-padded base64 strings (missing trailing ===), base64-js does not
  while (str.length % 4 !== 0) {
    str = str + '='
  }
  return str
}

function stringtrim (str) {
  if (str.trim) return str.trim()
  return str.replace(/^\s+|\s+$/g, '')
}

function toHex (n) {
  if (n < 16) return '0' + n.toString(16)
  return n.toString(16)
}

function utf8ToBytes (string, units) {
  units = units || Infinity
  var codePoint
  var length = string.length
  var leadSurrogate = null
  var bytes = []

  for (var i = 0; i < length; ++i) {
    codePoint = string.charCodeAt(i)

    // is surrogate component
    if (codePoint > 0xD7FF && codePoint < 0xE000) {
      // last char was a lead
      if (!leadSurrogate) {
        // no lead yet
        if (codePoint > 0xDBFF) {
          // unexpected trail
          if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD)
          continue
        } else if (i + 1 === length) {
          // unpaired lead
          if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD)
          continue
        }

        // valid lead
        leadSurrogate = codePoint

        continue
      }

      // 2 leads in a row
      if (codePoint < 0xDC00) {
        if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD)
        leadSurrogate = codePoint
        continue
      }

      // valid surrogate pair
      codePoint = (leadSurrogate - 0xD800 << 10 | codePoint - 0xDC00) + 0x10000
    } else if (leadSurrogate) {
      // valid bmp char, but last char was a lead
      if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD)
    }

    leadSurrogate = null

    // encode utf8
    if (codePoint < 0x80) {
      if ((units -= 1) < 0) break
      bytes.push(codePoint)
    } else if (codePoint < 0x800) {
      if ((units -= 2) < 0) break
      bytes.push(
        codePoint >> 0x6 | 0xC0,
        codePoint & 0x3F | 0x80
      )
    } else if (codePoint < 0x10000) {
      if ((units -= 3) < 0) break
      bytes.push(
        codePoint >> 0xC | 0xE0,
        codePoint >> 0x6 & 0x3F | 0x80,
        codePoint & 0x3F | 0x80
      )
    } else if (codePoint < 0x110000) {
      if ((units -= 4) < 0) break
      bytes.push(
        codePoint >> 0x12 | 0xF0,
        codePoint >> 0xC & 0x3F | 0x80,
        codePoint >> 0x6 & 0x3F | 0x80,
        codePoint & 0x3F | 0x80
      )
    } else {
      throw new Error('Invalid code point')
    }
  }

  return bytes
}

function asciiToBytes (str) {
  var byteArray = []
  for (var i = 0; i < str.length; ++i) {
    // Node's code seems to be doing this and not & 0x7F..
    byteArray.push(str.charCodeAt(i) & 0xFF)
  }
  return byteArray
}

function utf16leToBytes (str, units) {
  var c, hi, lo
  var byteArray = []
  for (var i = 0; i < str.length; ++i) {
    if ((units -= 2) < 0) break

    c = str.charCodeAt(i)
    hi = c >> 8
    lo = c % 256
    byteArray.push(lo)
    byteArray.push(hi)
  }

  return byteArray
}

function base64ToBytes (str) {
  return base64.toByteArray(base64clean(str))
}

function blitBuffer (src, dst, offset, length) {
  for (var i = 0; i < length; ++i) {
    if ((i + offset >= dst.length) || (i >= src.length)) break
    dst[i + offset] = src[i]
  }
  return i
}

function isnan (val) {
  return val !== val // eslint-disable-line no-self-compare
}


/***/ }),

/***/ "./node_modules/events/events.js":
/*!***************************************!*\
  !*** ./node_modules/events/events.js ***!
  \***************************************/
/***/ ((module) => {

"use strict";
// Copyright Joyent, Inc. and other Node contributors.
//
// Permission is hereby granted, free of charge, to any person obtaining a
// copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to permit
// persons to whom the Software is furnished to do so, subject to the
// following conditions:
//
// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
// OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
// NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
// DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
// OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
// USE OR OTHER DEALINGS IN THE SOFTWARE.



var R = typeof Reflect === 'object' ? Reflect : null
var ReflectApply = R && typeof R.apply === 'function'
  ? R.apply
  : function ReflectApply(target, receiver, args) {
    return Function.prototype.apply.call(target, receiver, args);
  }

var ReflectOwnKeys
if (R && typeof R.ownKeys === 'function') {
  ReflectOwnKeys = R.ownKeys
} else if (Object.getOwnPropertySymbols) {
  ReflectOwnKeys = function ReflectOwnKeys(target) {
    return Object.getOwnPropertyNames(target)
      .concat(Object.getOwnPropertySymbols(target));
  };
} else {
  ReflectOwnKeys = function ReflectOwnKeys(target) {
    return Object.getOwnPropertyNames(target);
  };
}

function ProcessEmitWarning(warning) {
  if (console && console.warn) console.warn(warning);
}

var NumberIsNaN = Number.isNaN || function NumberIsNaN(value) {
  return value !== value;
}

function EventEmitter() {
  EventEmitter.init.call(this);
}
module.exports = EventEmitter;
module.exports.once = once;

// Backwards-compat with node 0.10.x
EventEmitter.EventEmitter = EventEmitter;

EventEmitter.prototype._events = undefined;
EventEmitter.prototype._eventsCount = 0;
EventEmitter.prototype._maxListeners = undefined;

// By default EventEmitters will print a warning if more than 10 listeners are
// added to it. This is a useful default which helps finding memory leaks.
var defaultMaxListeners = 10;

function checkListener(listener) {
  if (typeof listener !== 'function') {
    throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof listener);
  }
}

Object.defineProperty(EventEmitter, 'defaultMaxListeners', {
  enumerable: true,
  get: function() {
    return defaultMaxListeners;
  },
  set: function(arg) {
    if (typeof arg !== 'number' || arg < 0 || NumberIsNaN(arg)) {
      throw new RangeError('The value of "defaultMaxListeners" is out of range. It must be a non-negative number. Received ' + arg + '.');
    }
    defaultMaxListeners = arg;
  }
});

EventEmitter.init = function() {

  if (this._events === undefined ||
      this._events === Object.getPrototypeOf(this)._events) {
    this._events = Object.create(null);
    this._eventsCount = 0;
  }

  this._maxListeners = this._maxListeners || undefined;
};

// Obviously not all Emitters should be limited to 10. This function allows
// that to be increased. Set to zero for unlimited.
EventEmitter.prototype.setMaxListeners = function setMaxListeners(n) {
  if (typeof n !== 'number' || n < 0 || NumberIsNaN(n)) {
    throw new RangeError('The value of "n" is out of range. It must be a non-negative number. Received ' + n + '.');
  }
  this._maxListeners = n;
  return this;
};

function _getMaxListeners(that) {
  if (that._maxListeners === undefined)
    return EventEmitter.defaultMaxListeners;
  return that._maxListeners;
}

EventEmitter.prototype.getMaxListeners = function getMaxListeners() {
  return _getMaxListeners(this);
};

EventEmitter.prototype.emit = function emit(type) {
  var args = [];
  for (var i = 1; i < arguments.length; i++) args.push(arguments[i]);
  var doError = (type === 'error');

  var events = this._events;
  if (events !== undefined)
    doError = (doError && events.error === undefined);
  else if (!doError)
    return false;

  // If there is no 'error' event listener then throw.
  if (doError) {
    var er;
    if (args.length > 0)
      er = args[0];
    if (er instanceof Error) {
      // Note: The comments on the `throw` lines are intentional, they show
      // up in Node's output if this results in an unhandled exception.
      throw er; // Unhandled 'error' event
    }
    // At least give some kind of context to the user
    var err = new Error('Unhandled error.' + (er ? ' (' + er.message + ')' : ''));
    err.context = er;
    throw err; // Unhandled 'error' event
  }

  var handler = events[type];

  if (handler === undefined)
    return false;

  if (typeof handler === 'function') {
    ReflectApply(handler, this, args);
  } else {
    var len = handler.length;
    var listeners = arrayClone(handler, len);
    for (var i = 0; i < len; ++i)
      ReflectApply(listeners[i], this, args);
  }

  return true;
};

function _addListener(target, type, listener, prepend) {
  var m;
  var events;
  var existing;

  checkListener(listener);

  events = target._events;
  if (events === undefined) {
    events = target._events = Object.create(null);
    target._eventsCount = 0;
  } else {
    // To avoid recursion in the case that type === "newListener"! Before
    // adding it to the listeners, first emit "newListener".
    if (events.newListener !== undefined) {
      target.emit('newListener', type,
                  listener.listener ? listener.listener : listener);

      // Re-assign `events` because a newListener handler could have caused the
      // this._events to be assigned to a new object
      events = target._events;
    }
    existing = events[type];
  }

  if (existing === undefined) {
    // Optimize the case of one listener. Don't need the extra array object.
    existing = events[type] = listener;
    ++target._eventsCount;
  } else {
    if (typeof existing === 'function') {
      // Adding the second element, need to change to array.
      existing = events[type] =
        prepend ? [listener, existing] : [existing, listener];
      // If we've already got an array, just append.
    } else if (prepend) {
      existing.unshift(listener);
    } else {
      existing.push(listener);
    }

    // Check for listener leak
    m = _getMaxListeners(target);
    if (m > 0 && existing.length > m && !existing.warned) {
      existing.warned = true;
      // No error code for this since it is a Warning
      // eslint-disable-next-line no-restricted-syntax
      var w = new Error('Possible EventEmitter memory leak detected. ' +
                          existing.length + ' ' + String(type) + ' listeners ' +
                          'added. Use emitter.setMaxListeners() to ' +
                          'increase limit');
      w.name = 'MaxListenersExceededWarning';
      w.emitter = target;
      w.type = type;
      w.count = existing.length;
      ProcessEmitWarning(w);
    }
  }

  return target;
}

EventEmitter.prototype.addListener = function addListener(type, listener) {
  return _addListener(this, type, listener, false);
};

EventEmitter.prototype.on = EventEmitter.prototype.addListener;

EventEmitter.prototype.prependListener =
    function prependListener(type, listener) {
      return _addListener(this, type, listener, true);
    };

function onceWrapper() {
  if (!this.fired) {
    this.target.removeListener(this.type, this.wrapFn);
    this.fired = true;
    if (arguments.length === 0)
      return this.listener.call(this.target);
    return this.listener.apply(this.target, arguments);
  }
}

function _onceWrap(target, type, listener) {
  var state = { fired: false, wrapFn: undefined, target: target, type: type, listener: listener };
  var wrapped = onceWrapper.bind(state);
  wrapped.listener = listener;
  state.wrapFn = wrapped;
  return wrapped;
}

EventEmitter.prototype.once = function once(type, listener) {
  checkListener(listener);
  this.on(type, _onceWrap(this, type, listener));
  return this;
};

EventEmitter.prototype.prependOnceListener =
    function prependOnceListener(type, listener) {
      checkListener(listener);
      this.prependListener(type, _onceWrap(this, type, listener));
      return this;
    };

// Emits a 'removeListener' event if and only if the listener was removed.
EventEmitter.prototype.removeListener =
    function removeListener(type, listener) {
      var list, events, position, i, originalListener;

      checkListener(listener);

      events = this._events;
      if (events === undefined)
        return this;

      list = events[type];
      if (list === undefined)
        return this;

      if (list === listener || list.listener === listener) {
        if (--this._eventsCount === 0)
          this._events = Object.create(null);
        else {
          delete events[type];
          if (events.removeListener)
            this.emit('removeListener', type, list.listener || listener);
        }
      } else if (typeof list !== 'function') {
        position = -1;

        for (i = list.length - 1; i >= 0; i--) {
          if (list[i] === listener || list[i].listener === listener) {
            originalListener = list[i].listener;
            position = i;
            break;
          }
        }

        if (position < 0)
          return this;

        if (position === 0)
          list.shift();
        else {
          spliceOne(list, position);
        }

        if (list.length === 1)
          events[type] = list[0];

        if (events.removeListener !== undefined)
          this.emit('removeListener', type, originalListener || listener);
      }

      return this;
    };

EventEmitter.prototype.off = EventEmitter.prototype.removeListener;

EventEmitter.prototype.removeAllListeners =
    function removeAllListeners(type) {
      var listeners, events, i;

      events = this._events;
      if (events === undefined)
        return this;

      // not listening for removeListener, no need to emit
      if (events.removeListener === undefined) {
        if (arguments.length === 0) {
          this._events = Object.create(null);
          this._eventsCount = 0;
        } else if (events[type] !== undefined) {
          if (--this._eventsCount === 0)
            this._events = Object.create(null);
          else
            delete events[type];
        }
        return this;
      }

      // emit removeListener for all listeners on all events
      if (arguments.length === 0) {
        var keys = Object.keys(events);
        var key;
        for (i = 0; i < keys.length; ++i) {
          key = keys[i];
          if (key === 'removeListener') continue;
          this.removeAllListeners(key);
        }
        this.removeAllListeners('removeListener');
        this._events = Object.create(null);
        this._eventsCount = 0;
        return this;
      }

      listeners = events[type];

      if (typeof listeners === 'function') {
        this.removeListener(type, listeners);
      } else if (listeners !== undefined) {
        // LIFO order
        for (i = listeners.length - 1; i >= 0; i--) {
          this.removeListener(type, listeners[i]);
        }
      }

      return this;
    };

function _listeners(target, type, unwrap) {
  var events = target._events;

  if (events === undefined)
    return [];

  var evlistener = events[type];
  if (evlistener === undefined)
    return [];

  if (typeof evlistener === 'function')
    return unwrap ? [evlistener.listener || evlistener] : [evlistener];

  return unwrap ?
    unwrapListeners(evlistener) : arrayClone(evlistener, evlistener.length);
}

EventEmitter.prototype.listeners = function listeners(type) {
  return _listeners(this, type, true);
};

EventEmitter.prototype.rawListeners = function rawListeners(type) {
  return _listeners(this, type, false);
};

EventEmitter.listenerCount = function(emitter, type) {
  if (typeof emitter.listenerCount === 'function') {
    return emitter.listenerCount(type);
  } else {
    return listenerCount.call(emitter, type);
  }
};

EventEmitter.prototype.listenerCount = listenerCount;
function listenerCount(type) {
  var events = this._events;

  if (events !== undefined) {
    var evlistener = events[type];

    if (typeof evlistener === 'function') {
      return 1;
    } else if (evlistener !== undefined) {
      return evlistener.length;
    }
  }

  return 0;
}

EventEmitter.prototype.eventNames = function eventNames() {
  return this._eventsCount > 0 ? ReflectOwnKeys(this._events) : [];
};

function arrayClone(arr, n) {
  var copy = new Array(n);
  for (var i = 0; i < n; ++i)
    copy[i] = arr[i];
  return copy;
}

function spliceOne(list, index) {
  for (; index + 1 < list.length; index++)
    list[index] = list[index + 1];
  list.pop();
}

function unwrapListeners(arr) {
  var ret = new Array(arr.length);
  for (var i = 0; i < ret.length; ++i) {
    ret[i] = arr[i].listener || arr[i];
  }
  return ret;
}

function once(emitter, name) {
  return new Promise(function (resolve, reject) {
    function errorListener(err) {
      emitter.removeListener(name, resolver);
      reject(err);
    }

    function resolver() {
      if (typeof emitter.removeListener === 'function') {
        emitter.removeListener('error', errorListener);
      }
      resolve([].slice.call(arguments));
    };

    eventTargetAgnosticAddListener(emitter, name, resolver, { once: true });
    if (name !== 'error') {
      addErrorHandlerIfEventEmitter(emitter, errorListener, { once: true });
    }
  });
}

function addErrorHandlerIfEventEmitter(emitter, handler, flags) {
  if (typeof emitter.on === 'function') {
    eventTargetAgnosticAddListener(emitter, 'error', handler, flags);
  }
}

function eventTargetAgnosticAddListener(emitter, name, listener, flags) {
  if (typeof emitter.on === 'function') {
    if (flags.once) {
      emitter.once(name, listener);
    } else {
      emitter.on(name, listener);
    }
  } else if (typeof emitter.addEventListener === 'function') {
    // EventTarget does not have `error` event semantics like Node
    // EventEmitters, we do not listen for `error` events here.
    emitter.addEventListener(name, function wrapListener(arg) {
      // IE does not have builtin `{ once: true }` support so we
      // have to do it manually.
      if (flags.once) {
        emitter.removeEventListener(name, wrapListener);
      }
      listener(arg);
    });
  } else {
    throw new TypeError('The "emitter" argument must be of type EventEmitter. Received type ' + typeof emitter);
  }
}


/***/ }),

/***/ "./node_modules/ieee754/index.js":
/*!***************************************!*\
  !*** ./node_modules/ieee754/index.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, exports) => {

/*! ieee754. BSD-3-Clause License. Feross Aboukhadijeh <https://feross.org/opensource> */
exports.read = function (buffer, offset, isLE, mLen, nBytes) {
  var e, m
  var eLen = (nBytes * 8) - mLen - 1
  var eMax = (1 << eLen) - 1
  var eBias = eMax >> 1
  var nBits = -7
  var i = isLE ? (nBytes - 1) : 0
  var d = isLE ? -1 : 1
  var s = buffer[offset + i]

  i += d

  e = s & ((1 << (-nBits)) - 1)
  s >>= (-nBits)
  nBits += eLen
  for (; nBits > 0; e = (e * 256) + buffer[offset + i], i += d, nBits -= 8) {}

  m = e & ((1 << (-nBits)) - 1)
  e >>= (-nBits)
  nBits += mLen
  for (; nBits > 0; m = (m * 256) + buffer[offset + i], i += d, nBits -= 8) {}

  if (e === 0) {
    e = 1 - eBias
  } else if (e === eMax) {
    return m ? NaN : ((s ? -1 : 1) * Infinity)
  } else {
    m = m + Math.pow(2, mLen)
    e = e - eBias
  }
  return (s ? -1 : 1) * m * Math.pow(2, e - mLen)
}

exports.write = function (buffer, value, offset, isLE, mLen, nBytes) {
  var e, m, c
  var eLen = (nBytes * 8) - mLen - 1
  var eMax = (1 << eLen) - 1
  var eBias = eMax >> 1
  var rt = (mLen === 23 ? Math.pow(2, -24) - Math.pow(2, -77) : 0)
  var i = isLE ? 0 : (nBytes - 1)
  var d = isLE ? 1 : -1
  var s = value < 0 || (value === 0 && 1 / value < 0) ? 1 : 0

  value = Math.abs(value)

  if (isNaN(value) || value === Infinity) {
    m = isNaN(value) ? 1 : 0
    e = eMax
  } else {
    e = Math.floor(Math.log(value) / Math.LN2)
    if (value * (c = Math.pow(2, -e)) < 1) {
      e--
      c *= 2
    }
    if (e + eBias >= 1) {
      value += rt / c
    } else {
      value += rt * Math.pow(2, 1 - eBias)
    }
    if (value * c >= 2) {
      e++
      c /= 2
    }

    if (e + eBias >= eMax) {
      m = 0
      e = eMax
    } else if (e + eBias >= 1) {
      m = ((value * c) - 1) * Math.pow(2, mLen)
      e = e + eBias
    } else {
      m = value * Math.pow(2, eBias - 1) * Math.pow(2, mLen)
      e = 0
    }
  }

  for (; mLen >= 8; buffer[offset + i] = m & 0xff, i += d, m /= 256, mLen -= 8) {}

  e = (e << mLen) | m
  eLen += mLen
  for (; eLen > 0; buffer[offset + i] = e & 0xff, i += d, e /= 256, eLen -= 8) {}

  buffer[offset + i - d] |= s * 128
}


/***/ }),

/***/ "./node_modules/isarray/index.js":
/*!***************************************!*\
  !*** ./node_modules/isarray/index.js ***!
  \***************************************/
/***/ ((module) => {

var toString = {}.toString;

module.exports = Array.isArray || function (arr) {
  return toString.call(arr) == '[object Array]';
};


/***/ }),

/***/ "./node_modules/precond/index.js":
/*!***************************************!*\
  !*** ./node_modules/precond/index.js ***!
  \***************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/*
 * Copyright (c) 2012 Mathieu Turcotte
 * Licensed under the MIT license.
 */

module.exports = __webpack_require__(/*! ./lib/checks */ "./node_modules/precond/lib/checks.js");

/***/ }),

/***/ "./node_modules/precond/lib/checks.js":
/*!********************************************!*\
  !*** ./node_modules/precond/lib/checks.js ***!
  \********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/*
 * Copyright (c) 2012 Mathieu Turcotte
 * Licensed under the MIT license.
 */

var util = __webpack_require__(/*! util */ "./node_modules/util/util.js");

var errors = module.exports = __webpack_require__(/*! ./errors */ "./node_modules/precond/lib/errors.js");

function failCheck(ExceptionConstructor, callee, messageFormat, formatArgs) {
    messageFormat = messageFormat || '';
    var message = util.format.apply(this, [messageFormat].concat(formatArgs));
    var error = new ExceptionConstructor(message);
    Error.captureStackTrace(error, callee);
    throw error;
}

function failArgumentCheck(callee, message, formatArgs) {
    failCheck(errors.IllegalArgumentError, callee, message, formatArgs);
}

function failStateCheck(callee, message, formatArgs) {
    failCheck(errors.IllegalStateError, callee, message, formatArgs);
}

module.exports.checkArgument = function(value, message) {
    if (!value) {
        failArgumentCheck(arguments.callee, message,
            Array.prototype.slice.call(arguments, 2));
    }
};

module.exports.checkState = function(value, message) {
    if (!value) {
        failStateCheck(arguments.callee, message,
            Array.prototype.slice.call(arguments, 2));
    }
};

module.exports.checkIsDef = function(value, message) {
    if (value !== undefined) {
        return value;
    }

    failArgumentCheck(arguments.callee, message ||
        'Expected value to be defined but was undefined.',
        Array.prototype.slice.call(arguments, 2));
};

module.exports.checkIsDefAndNotNull = function(value, message) {
    // Note that undefined == null.
    if (value != null) {
        return value;
    }

    failArgumentCheck(arguments.callee, message ||
        'Expected value to be defined and not null but got "' +
        typeOf(value) + '".', Array.prototype.slice.call(arguments, 2));
};

// Fixed version of the typeOf operator which returns 'null' for null values
// and 'array' for arrays.
function typeOf(value) {
    var s = typeof value;
    if (s == 'object') {
        if (!value) {
            return 'null';
        } else if (value instanceof Array) {
            return 'array';
        }
    }
    return s;
}

function typeCheck(expect) {
    return function(value, message) {
        var type = typeOf(value);

        if (type == expect) {
            return value;
        }

        failArgumentCheck(arguments.callee, message ||
            'Expected "' + expect + '" but got "' + type + '".',
            Array.prototype.slice.call(arguments, 2));
    };
}

module.exports.checkIsString = typeCheck('string');
module.exports.checkIsArray = typeCheck('array');
module.exports.checkIsNumber = typeCheck('number');
module.exports.checkIsBoolean = typeCheck('boolean');
module.exports.checkIsFunction = typeCheck('function');
module.exports.checkIsObject = typeCheck('object');


/***/ }),

/***/ "./node_modules/precond/lib/errors.js":
/*!********************************************!*\
  !*** ./node_modules/precond/lib/errors.js ***!
  \********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/*
 * Copyright (c) 2012 Mathieu Turcotte
 * Licensed under the MIT license.
 */

var util = __webpack_require__(/*! util */ "./node_modules/util/util.js");

function IllegalArgumentError(message) {
    Error.call(this, message);
    this.message = message;
}
util.inherits(IllegalArgumentError, Error);

IllegalArgumentError.prototype.name = 'IllegalArgumentError';

function IllegalStateError(message) {
    Error.call(this, message);
    this.message = message;
}
util.inherits(IllegalStateError, Error);

IllegalStateError.prototype.name = 'IllegalStateError';

module.exports.IllegalStateError = IllegalStateError;
module.exports.IllegalArgumentError = IllegalArgumentError;

/***/ }),

/***/ "./node_modules/process/browser.js":
/*!*****************************************!*\
  !*** ./node_modules/process/browser.js ***!
  \*****************************************/
/***/ ((module) => {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ }),

/***/ "./node_modules/promise-polyfill/src/allSettled.js":
/*!*********************************************************!*\
  !*** ./node_modules/promise-polyfill/src/allSettled.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function allSettled(arr) {
  var P = this;
  return new P(function(resolve, reject) {
    if (!(arr && typeof arr.length !== 'undefined')) {
      return reject(
        new TypeError(
          typeof arr +
            ' ' +
            arr +
            ' is not iterable(cannot read property Symbol(Symbol.iterator))'
        )
      );
    }
    var args = Array.prototype.slice.call(arr);
    if (args.length === 0) return resolve([]);
    var remaining = args.length;

    function res(i, val) {
      if (val && (typeof val === 'object' || typeof val === 'function')) {
        var then = val.then;
        if (typeof then === 'function') {
          then.call(
            val,
            function(val) {
              res(i, val);
            },
            function(e) {
              args[i] = { status: 'rejected', reason: e };
              if (--remaining === 0) {
                resolve(args);
              }
            }
          );
          return;
        }
      }
      args[i] = { status: 'fulfilled', value: val };
      if (--remaining === 0) {
        resolve(args);
      }
    }

    for (var i = 0; i < args.length; i++) {
      res(i, args[i]);
    }
  });
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (allSettled);


/***/ }),

/***/ "./node_modules/promise-polyfill/src/finally.js":
/*!******************************************************!*\
  !*** ./node_modules/promise-polyfill/src/finally.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/**
 * @this {Promise}
 */
function finallyConstructor(callback) {
  var constructor = this.constructor;
  return this.then(
    function(value) {
      // @ts-ignore
      return constructor.resolve(callback()).then(function() {
        return value;
      });
    },
    function(reason) {
      // @ts-ignore
      return constructor.resolve(callback()).then(function() {
        // @ts-ignore
        return constructor.reject(reason);
      });
    }
  );
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (finallyConstructor);


/***/ }),

/***/ "./node_modules/promise-polyfill/src/index.js":
/*!****************************************************!*\
  !*** ./node_modules/promise-polyfill/src/index.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _finally__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./finally */ "./node_modules/promise-polyfill/src/finally.js");
/* harmony import */ var _allSettled__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./allSettled */ "./node_modules/promise-polyfill/src/allSettled.js");



// Store setTimeout reference so promise-polyfill will be unaffected by
// other code modifying setTimeout (like sinon.useFakeTimers())
var setTimeoutFunc = setTimeout;

function isArray(x) {
  return Boolean(x && typeof x.length !== 'undefined');
}

function noop() {}

// Polyfill for Function.prototype.bind
function bind(fn, thisArg) {
  return function() {
    fn.apply(thisArg, arguments);
  };
}

/**
 * @constructor
 * @param {Function} fn
 */
function Promise(fn) {
  if (!(this instanceof Promise))
    throw new TypeError('Promises must be constructed via new');
  if (typeof fn !== 'function') throw new TypeError('not a function');
  /** @type {!number} */
  this._state = 0;
  /** @type {!boolean} */
  this._handled = false;
  /** @type {Promise|undefined} */
  this._value = undefined;
  /** @type {!Array<!Function>} */
  this._deferreds = [];

  doResolve(fn, this);
}

function handle(self, deferred) {
  while (self._state === 3) {
    self = self._value;
  }
  if (self._state === 0) {
    self._deferreds.push(deferred);
    return;
  }
  self._handled = true;
  Promise._immediateFn(function() {
    var cb = self._state === 1 ? deferred.onFulfilled : deferred.onRejected;
    if (cb === null) {
      (self._state === 1 ? resolve : reject)(deferred.promise, self._value);
      return;
    }
    var ret;
    try {
      ret = cb(self._value);
    } catch (e) {
      reject(deferred.promise, e);
      return;
    }
    resolve(deferred.promise, ret);
  });
}

function resolve(self, newValue) {
  try {
    // Promise Resolution Procedure: https://github.com/promises-aplus/promises-spec#the-promise-resolution-procedure
    if (newValue === self)
      throw new TypeError('A promise cannot be resolved with itself.');
    if (
      newValue &&
      (typeof newValue === 'object' || typeof newValue === 'function')
    ) {
      var then = newValue.then;
      if (newValue instanceof Promise) {
        self._state = 3;
        self._value = newValue;
        finale(self);
        return;
      } else if (typeof then === 'function') {
        doResolve(bind(then, newValue), self);
        return;
      }
    }
    self._state = 1;
    self._value = newValue;
    finale(self);
  } catch (e) {
    reject(self, e);
  }
}

function reject(self, newValue) {
  self._state = 2;
  self._value = newValue;
  finale(self);
}

function finale(self) {
  if (self._state === 2 && self._deferreds.length === 0) {
    Promise._immediateFn(function() {
      if (!self._handled) {
        Promise._unhandledRejectionFn(self._value);
      }
    });
  }

  for (var i = 0, len = self._deferreds.length; i < len; i++) {
    handle(self, self._deferreds[i]);
  }
  self._deferreds = null;
}

/**
 * @constructor
 */
function Handler(onFulfilled, onRejected, promise) {
  this.onFulfilled = typeof onFulfilled === 'function' ? onFulfilled : null;
  this.onRejected = typeof onRejected === 'function' ? onRejected : null;
  this.promise = promise;
}

/**
 * Take a potentially misbehaving resolver function and make sure
 * onFulfilled and onRejected are only called once.
 *
 * Makes no guarantees about asynchrony.
 */
function doResolve(fn, self) {
  var done = false;
  try {
    fn(
      function(value) {
        if (done) return;
        done = true;
        resolve(self, value);
      },
      function(reason) {
        if (done) return;
        done = true;
        reject(self, reason);
      }
    );
  } catch (ex) {
    if (done) return;
    done = true;
    reject(self, ex);
  }
}

Promise.prototype['catch'] = function(onRejected) {
  return this.then(null, onRejected);
};

Promise.prototype.then = function(onFulfilled, onRejected) {
  // @ts-ignore
  var prom = new this.constructor(noop);

  handle(this, new Handler(onFulfilled, onRejected, prom));
  return prom;
};

Promise.prototype['finally'] = _finally__WEBPACK_IMPORTED_MODULE_0__["default"];

Promise.all = function(arr) {
  return new Promise(function(resolve, reject) {
    if (!isArray(arr)) {
      return reject(new TypeError('Promise.all accepts an array'));
    }

    var args = Array.prototype.slice.call(arr);
    if (args.length === 0) return resolve([]);
    var remaining = args.length;

    function res(i, val) {
      try {
        if (val && (typeof val === 'object' || typeof val === 'function')) {
          var then = val.then;
          if (typeof then === 'function') {
            then.call(
              val,
              function(val) {
                res(i, val);
              },
              reject
            );
            return;
          }
        }
        args[i] = val;
        if (--remaining === 0) {
          resolve(args);
        }
      } catch (ex) {
        reject(ex);
      }
    }

    for (var i = 0; i < args.length; i++) {
      res(i, args[i]);
    }
  });
};

Promise.allSettled = _allSettled__WEBPACK_IMPORTED_MODULE_1__["default"];

Promise.resolve = function(value) {
  if (value && typeof value === 'object' && value.constructor === Promise) {
    return value;
  }

  return new Promise(function(resolve) {
    resolve(value);
  });
};

Promise.reject = function(value) {
  return new Promise(function(resolve, reject) {
    reject(value);
  });
};

Promise.race = function(arr) {
  return new Promise(function(resolve, reject) {
    if (!isArray(arr)) {
      return reject(new TypeError('Promise.race accepts an array'));
    }

    for (var i = 0, len = arr.length; i < len; i++) {
      Promise.resolve(arr[i]).then(resolve, reject);
    }
  });
};

// Use polyfill for setImmediate for performance gains
Promise._immediateFn =
  // @ts-ignore
  (typeof setImmediate === 'function' &&
    function(fn) {
      // @ts-ignore
      setImmediate(fn);
    }) ||
  function(fn) {
    setTimeoutFunc(fn, 0);
  };

Promise._unhandledRejectionFn = function _unhandledRejectionFn(err) {
  if (typeof console !== 'undefined' && console) {
    console.warn('Possible Unhandled Promise Rejection:', err); // eslint-disable-line no-console
  }
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Promise);


/***/ }),

/***/ "./node_modules/safe-buffer/index.js":
/*!*******************************************!*\
  !*** ./node_modules/safe-buffer/index.js ***!
  \*******************************************/
/***/ ((module, exports, __webpack_require__) => {

/*! safe-buffer. MIT License. Feross Aboukhadijeh <https://feross.org/opensource> */
/* eslint-disable node/no-deprecated-api */
var buffer = __webpack_require__(/*! buffer */ "./node_modules/buffer/index.js")
var Buffer = buffer.Buffer

// alternative to using Object.keys for old browsers
function copyProps (src, dst) {
  for (var key in src) {
    dst[key] = src[key]
  }
}
if (Buffer.from && Buffer.alloc && Buffer.allocUnsafe && Buffer.allocUnsafeSlow) {
  module.exports = buffer
} else {
  // Copy properties from require('buffer')
  copyProps(buffer, exports)
  exports.Buffer = SafeBuffer
}

function SafeBuffer (arg, encodingOrOffset, length) {
  return Buffer(arg, encodingOrOffset, length)
}

SafeBuffer.prototype = Object.create(Buffer.prototype)

// Copy static methods from Buffer
copyProps(Buffer, SafeBuffer)

SafeBuffer.from = function (arg, encodingOrOffset, length) {
  if (typeof arg === 'number') {
    throw new TypeError('Argument must not be a number')
  }
  return Buffer(arg, encodingOrOffset, length)
}

SafeBuffer.alloc = function (size, fill, encoding) {
  if (typeof size !== 'number') {
    throw new TypeError('Argument must be a number')
  }
  var buf = Buffer(size)
  if (fill !== undefined) {
    if (typeof encoding === 'string') {
      buf.fill(fill, encoding)
    } else {
      buf.fill(fill)
    }
  } else {
    buf.fill(0)
  }
  return buf
}

SafeBuffer.allocUnsafe = function (size) {
  if (typeof size !== 'number') {
    throw new TypeError('Argument must be a number')
  }
  return Buffer(size)
}

SafeBuffer.allocUnsafeSlow = function (size) {
  if (typeof size !== 'number') {
    throw new TypeError('Argument must be a number')
  }
  return buffer.SlowBuffer(size)
}


/***/ }),

/***/ "./node_modules/util/node_modules/inherits/inherits_browser.js":
/*!*********************************************************************!*\
  !*** ./node_modules/util/node_modules/inherits/inherits_browser.js ***!
  \*********************************************************************/
/***/ ((module) => {

if (typeof Object.create === 'function') {
  // implementation from standard node.js 'util' module
  module.exports = function inherits(ctor, superCtor) {
    ctor.super_ = superCtor
    ctor.prototype = Object.create(superCtor.prototype, {
      constructor: {
        value: ctor,
        enumerable: false,
        writable: true,
        configurable: true
      }
    });
  };
} else {
  // old school shim for old browsers
  module.exports = function inherits(ctor, superCtor) {
    ctor.super_ = superCtor
    var TempCtor = function () {}
    TempCtor.prototype = superCtor.prototype
    ctor.prototype = new TempCtor()
    ctor.prototype.constructor = ctor
  }
}


/***/ }),

/***/ "./node_modules/util/support/isBufferBrowser.js":
/*!******************************************************!*\
  !*** ./node_modules/util/support/isBufferBrowser.js ***!
  \******************************************************/
/***/ ((module) => {

module.exports = function isBuffer(arg) {
  return arg && typeof arg === 'object'
    && typeof arg.copy === 'function'
    && typeof arg.fill === 'function'
    && typeof arg.readUInt8 === 'function';
}

/***/ }),

/***/ "./node_modules/util/util.js":
/*!***********************************!*\
  !*** ./node_modules/util/util.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

/* provided dependency */ var process = __webpack_require__(/*! process/browser.js */ "./node_modules/process/browser.js");
// Copyright Joyent, Inc. and other Node contributors.
//
// Permission is hereby granted, free of charge, to any person obtaining a
// copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to permit
// persons to whom the Software is furnished to do so, subject to the
// following conditions:
//
// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
// OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
// NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
// DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
// OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
// USE OR OTHER DEALINGS IN THE SOFTWARE.

var getOwnPropertyDescriptors = Object.getOwnPropertyDescriptors ||
  function getOwnPropertyDescriptors(obj) {
    var keys = Object.keys(obj);
    var descriptors = {};
    for (var i = 0; i < keys.length; i++) {
      descriptors[keys[i]] = Object.getOwnPropertyDescriptor(obj, keys[i]);
    }
    return descriptors;
  };

var formatRegExp = /%[sdj%]/g;
exports.format = function(f) {
  if (!isString(f)) {
    var objects = [];
    for (var i = 0; i < arguments.length; i++) {
      objects.push(inspect(arguments[i]));
    }
    return objects.join(' ');
  }

  var i = 1;
  var args = arguments;
  var len = args.length;
  var str = String(f).replace(formatRegExp, function(x) {
    if (x === '%%') return '%';
    if (i >= len) return x;
    switch (x) {
      case '%s': return String(args[i++]);
      case '%d': return Number(args[i++]);
      case '%j':
        try {
          return JSON.stringify(args[i++]);
        } catch (_) {
          return '[Circular]';
        }
      default:
        return x;
    }
  });
  for (var x = args[i]; i < len; x = args[++i]) {
    if (isNull(x) || !isObject(x)) {
      str += ' ' + x;
    } else {
      str += ' ' + inspect(x);
    }
  }
  return str;
};


// Mark that a method should not be used.
// Returns a modified function which warns once by default.
// If --no-deprecation is set, then it is a no-op.
exports.deprecate = function(fn, msg) {
  if (typeof process !== 'undefined' && process.noDeprecation === true) {
    return fn;
  }

  // Allow for deprecating things in the process of starting up.
  if (typeof process === 'undefined') {
    return function() {
      return exports.deprecate(fn, msg).apply(this, arguments);
    };
  }

  var warned = false;
  function deprecated() {
    if (!warned) {
      if (process.throwDeprecation) {
        throw new Error(msg);
      } else if (process.traceDeprecation) {
        console.trace(msg);
      } else {
        console.error(msg);
      }
      warned = true;
    }
    return fn.apply(this, arguments);
  }

  return deprecated;
};


var debugs = {};
var debugEnviron;
exports.debuglog = function(set) {
  if (isUndefined(debugEnviron))
    debugEnviron = process.env.NODE_DEBUG || '';
  set = set.toUpperCase();
  if (!debugs[set]) {
    if (new RegExp('\\b' + set + '\\b', 'i').test(debugEnviron)) {
      var pid = process.pid;
      debugs[set] = function() {
        var msg = exports.format.apply(exports, arguments);
        console.error('%s %d: %s', set, pid, msg);
      };
    } else {
      debugs[set] = function() {};
    }
  }
  return debugs[set];
};


/**
 * Echos the value of a value. Trys to print the value out
 * in the best way possible given the different types.
 *
 * @param {Object} obj The object to print out.
 * @param {Object} opts Optional options object that alters the output.
 */
/* legacy: obj, showHidden, depth, colors*/
function inspect(obj, opts) {
  // default options
  var ctx = {
    seen: [],
    stylize: stylizeNoColor
  };
  // legacy...
  if (arguments.length >= 3) ctx.depth = arguments[2];
  if (arguments.length >= 4) ctx.colors = arguments[3];
  if (isBoolean(opts)) {
    // legacy...
    ctx.showHidden = opts;
  } else if (opts) {
    // got an "options" object
    exports._extend(ctx, opts);
  }
  // set default options
  if (isUndefined(ctx.showHidden)) ctx.showHidden = false;
  if (isUndefined(ctx.depth)) ctx.depth = 2;
  if (isUndefined(ctx.colors)) ctx.colors = false;
  if (isUndefined(ctx.customInspect)) ctx.customInspect = true;
  if (ctx.colors) ctx.stylize = stylizeWithColor;
  return formatValue(ctx, obj, ctx.depth);
}
exports.inspect = inspect;


// http://en.wikipedia.org/wiki/ANSI_escape_code#graphics
inspect.colors = {
  'bold' : [1, 22],
  'italic' : [3, 23],
  'underline' : [4, 24],
  'inverse' : [7, 27],
  'white' : [37, 39],
  'grey' : [90, 39],
  'black' : [30, 39],
  'blue' : [34, 39],
  'cyan' : [36, 39],
  'green' : [32, 39],
  'magenta' : [35, 39],
  'red' : [31, 39],
  'yellow' : [33, 39]
};

// Don't use 'blue' not visible on cmd.exe
inspect.styles = {
  'special': 'cyan',
  'number': 'yellow',
  'boolean': 'yellow',
  'undefined': 'grey',
  'null': 'bold',
  'string': 'green',
  'date': 'magenta',
  // "name": intentionally not styling
  'regexp': 'red'
};


function stylizeWithColor(str, styleType) {
  var style = inspect.styles[styleType];

  if (style) {
    return '\u001b[' + inspect.colors[style][0] + 'm' + str +
           '\u001b[' + inspect.colors[style][1] + 'm';
  } else {
    return str;
  }
}


function stylizeNoColor(str, styleType) {
  return str;
}


function arrayToHash(array) {
  var hash = {};

  array.forEach(function(val, idx) {
    hash[val] = true;
  });

  return hash;
}


function formatValue(ctx, value, recurseTimes) {
  // Provide a hook for user-specified inspect functions.
  // Check that value is an object with an inspect function on it
  if (ctx.customInspect &&
      value &&
      isFunction(value.inspect) &&
      // Filter out the util module, it's inspect function is special
      value.inspect !== exports.inspect &&
      // Also filter out any prototype objects using the circular check.
      !(value.constructor && value.constructor.prototype === value)) {
    var ret = value.inspect(recurseTimes, ctx);
    if (!isString(ret)) {
      ret = formatValue(ctx, ret, recurseTimes);
    }
    return ret;
  }

  // Primitive types cannot have properties
  var primitive = formatPrimitive(ctx, value);
  if (primitive) {
    return primitive;
  }

  // Look up the keys of the object.
  var keys = Object.keys(value);
  var visibleKeys = arrayToHash(keys);

  if (ctx.showHidden) {
    keys = Object.getOwnPropertyNames(value);
  }

  // IE doesn't make error fields non-enumerable
  // http://msdn.microsoft.com/en-us/library/ie/dww52sbt(v=vs.94).aspx
  if (isError(value)
      && (keys.indexOf('message') >= 0 || keys.indexOf('description') >= 0)) {
    return formatError(value);
  }

  // Some type of object without properties can be shortcutted.
  if (keys.length === 0) {
    if (isFunction(value)) {
      var name = value.name ? ': ' + value.name : '';
      return ctx.stylize('[Function' + name + ']', 'special');
    }
    if (isRegExp(value)) {
      return ctx.stylize(RegExp.prototype.toString.call(value), 'regexp');
    }
    if (isDate(value)) {
      return ctx.stylize(Date.prototype.toString.call(value), 'date');
    }
    if (isError(value)) {
      return formatError(value);
    }
  }

  var base = '', array = false, braces = ['{', '}'];

  // Make Array say that they are Array
  if (isArray(value)) {
    array = true;
    braces = ['[', ']'];
  }

  // Make functions say that they are functions
  if (isFunction(value)) {
    var n = value.name ? ': ' + value.name : '';
    base = ' [Function' + n + ']';
  }

  // Make RegExps say that they are RegExps
  if (isRegExp(value)) {
    base = ' ' + RegExp.prototype.toString.call(value);
  }

  // Make dates with properties first say the date
  if (isDate(value)) {
    base = ' ' + Date.prototype.toUTCString.call(value);
  }

  // Make error with message first say the error
  if (isError(value)) {
    base = ' ' + formatError(value);
  }

  if (keys.length === 0 && (!array || value.length == 0)) {
    return braces[0] + base + braces[1];
  }

  if (recurseTimes < 0) {
    if (isRegExp(value)) {
      return ctx.stylize(RegExp.prototype.toString.call(value), 'regexp');
    } else {
      return ctx.stylize('[Object]', 'special');
    }
  }

  ctx.seen.push(value);

  var output;
  if (array) {
    output = formatArray(ctx, value, recurseTimes, visibleKeys, keys);
  } else {
    output = keys.map(function(key) {
      return formatProperty(ctx, value, recurseTimes, visibleKeys, key, array);
    });
  }

  ctx.seen.pop();

  return reduceToSingleString(output, base, braces);
}


function formatPrimitive(ctx, value) {
  if (isUndefined(value))
    return ctx.stylize('undefined', 'undefined');
  if (isString(value)) {
    var simple = '\'' + JSON.stringify(value).replace(/^"|"$/g, '')
                                             .replace(/'/g, "\\'")
                                             .replace(/\\"/g, '"') + '\'';
    return ctx.stylize(simple, 'string');
  }
  if (isNumber(value))
    return ctx.stylize('' + value, 'number');
  if (isBoolean(value))
    return ctx.stylize('' + value, 'boolean');
  // For some reason typeof null is "object", so special case here.
  if (isNull(value))
    return ctx.stylize('null', 'null');
}


function formatError(value) {
  return '[' + Error.prototype.toString.call(value) + ']';
}


function formatArray(ctx, value, recurseTimes, visibleKeys, keys) {
  var output = [];
  for (var i = 0, l = value.length; i < l; ++i) {
    if (hasOwnProperty(value, String(i))) {
      output.push(formatProperty(ctx, value, recurseTimes, visibleKeys,
          String(i), true));
    } else {
      output.push('');
    }
  }
  keys.forEach(function(key) {
    if (!key.match(/^\d+$/)) {
      output.push(formatProperty(ctx, value, recurseTimes, visibleKeys,
          key, true));
    }
  });
  return output;
}


function formatProperty(ctx, value, recurseTimes, visibleKeys, key, array) {
  var name, str, desc;
  desc = Object.getOwnPropertyDescriptor(value, key) || { value: value[key] };
  if (desc.get) {
    if (desc.set) {
      str = ctx.stylize('[Getter/Setter]', 'special');
    } else {
      str = ctx.stylize('[Getter]', 'special');
    }
  } else {
    if (desc.set) {
      str = ctx.stylize('[Setter]', 'special');
    }
  }
  if (!hasOwnProperty(visibleKeys, key)) {
    name = '[' + key + ']';
  }
  if (!str) {
    if (ctx.seen.indexOf(desc.value) < 0) {
      if (isNull(recurseTimes)) {
        str = formatValue(ctx, desc.value, null);
      } else {
        str = formatValue(ctx, desc.value, recurseTimes - 1);
      }
      if (str.indexOf('\n') > -1) {
        if (array) {
          str = str.split('\n').map(function(line) {
            return '  ' + line;
          }).join('\n').substr(2);
        } else {
          str = '\n' + str.split('\n').map(function(line) {
            return '   ' + line;
          }).join('\n');
        }
      }
    } else {
      str = ctx.stylize('[Circular]', 'special');
    }
  }
  if (isUndefined(name)) {
    if (array && key.match(/^\d+$/)) {
      return str;
    }
    name = JSON.stringify('' + key);
    if (name.match(/^"([a-zA-Z_][a-zA-Z_0-9]*)"$/)) {
      name = name.substr(1, name.length - 2);
      name = ctx.stylize(name, 'name');
    } else {
      name = name.replace(/'/g, "\\'")
                 .replace(/\\"/g, '"')
                 .replace(/(^"|"$)/g, "'");
      name = ctx.stylize(name, 'string');
    }
  }

  return name + ': ' + str;
}


function reduceToSingleString(output, base, braces) {
  var numLinesEst = 0;
  var length = output.reduce(function(prev, cur) {
    numLinesEst++;
    if (cur.indexOf('\n') >= 0) numLinesEst++;
    return prev + cur.replace(/\u001b\[\d\d?m/g, '').length + 1;
  }, 0);

  if (length > 60) {
    return braces[0] +
           (base === '' ? '' : base + '\n ') +
           ' ' +
           output.join(',\n  ') +
           ' ' +
           braces[1];
  }

  return braces[0] + base + ' ' + output.join(', ') + ' ' + braces[1];
}


// NOTE: These type checking functions intentionally don't use `instanceof`
// because it is fragile and can be easily faked with `Object.create()`.
function isArray(ar) {
  return Array.isArray(ar);
}
exports.isArray = isArray;

function isBoolean(arg) {
  return typeof arg === 'boolean';
}
exports.isBoolean = isBoolean;

function isNull(arg) {
  return arg === null;
}
exports.isNull = isNull;

function isNullOrUndefined(arg) {
  return arg == null;
}
exports.isNullOrUndefined = isNullOrUndefined;

function isNumber(arg) {
  return typeof arg === 'number';
}
exports.isNumber = isNumber;

function isString(arg) {
  return typeof arg === 'string';
}
exports.isString = isString;

function isSymbol(arg) {
  return typeof arg === 'symbol';
}
exports.isSymbol = isSymbol;

function isUndefined(arg) {
  return arg === void 0;
}
exports.isUndefined = isUndefined;

function isRegExp(re) {
  return isObject(re) && objectToString(re) === '[object RegExp]';
}
exports.isRegExp = isRegExp;

function isObject(arg) {
  return typeof arg === 'object' && arg !== null;
}
exports.isObject = isObject;

function isDate(d) {
  return isObject(d) && objectToString(d) === '[object Date]';
}
exports.isDate = isDate;

function isError(e) {
  return isObject(e) &&
      (objectToString(e) === '[object Error]' || e instanceof Error);
}
exports.isError = isError;

function isFunction(arg) {
  return typeof arg === 'function';
}
exports.isFunction = isFunction;

function isPrimitive(arg) {
  return arg === null ||
         typeof arg === 'boolean' ||
         typeof arg === 'number' ||
         typeof arg === 'string' ||
         typeof arg === 'symbol' ||  // ES6 symbol
         typeof arg === 'undefined';
}
exports.isPrimitive = isPrimitive;

exports.isBuffer = __webpack_require__(/*! ./support/isBuffer */ "./node_modules/util/support/isBufferBrowser.js");

function objectToString(o) {
  return Object.prototype.toString.call(o);
}


function pad(n) {
  return n < 10 ? '0' + n.toString(10) : n.toString(10);
}


var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
              'Oct', 'Nov', 'Dec'];

// 26 Feb 16:19:34
function timestamp() {
  var d = new Date();
  var time = [pad(d.getHours()),
              pad(d.getMinutes()),
              pad(d.getSeconds())].join(':');
  return [d.getDate(), months[d.getMonth()], time].join(' ');
}


// log is just a thin wrapper to console.log that prepends a timestamp
exports.log = function() {
  console.log('%s - %s', timestamp(), exports.format.apply(exports, arguments));
};


/**
 * Inherit the prototype methods from one constructor into another.
 *
 * The Function.prototype.inherits from lang.js rewritten as a standalone
 * function (not on Function.prototype). NOTE: If this file is to be loaded
 * during bootstrapping this function needs to be rewritten using some native
 * functions as prototype setup using normal JavaScript does not work as
 * expected during bootstrapping (see mirror.js in r114903).
 *
 * @param {function} ctor Constructor function which needs to inherit the
 *     prototype.
 * @param {function} superCtor Constructor function to inherit prototype from.
 */
exports.inherits = __webpack_require__(/*! inherits */ "./node_modules/util/node_modules/inherits/inherits_browser.js");

exports._extend = function(origin, add) {
  // Don't do anything if add isn't an object
  if (!add || !isObject(add)) return origin;

  var keys = Object.keys(add);
  var i = keys.length;
  while (i--) {
    origin[keys[i]] = add[keys[i]];
  }
  return origin;
};

function hasOwnProperty(obj, prop) {
  return Object.prototype.hasOwnProperty.call(obj, prop);
}

var kCustomPromisifiedSymbol = typeof Symbol !== 'undefined' ? Symbol('util.promisify.custom') : undefined;

exports.promisify = function promisify(original) {
  if (typeof original !== 'function')
    throw new TypeError('The "original" argument must be of type Function');

  if (kCustomPromisifiedSymbol && original[kCustomPromisifiedSymbol]) {
    var fn = original[kCustomPromisifiedSymbol];
    if (typeof fn !== 'function') {
      throw new TypeError('The "util.promisify.custom" argument must be of type Function');
    }
    Object.defineProperty(fn, kCustomPromisifiedSymbol, {
      value: fn, enumerable: false, writable: false, configurable: true
    });
    return fn;
  }

  function fn() {
    var promiseResolve, promiseReject;
    var promise = new Promise(function (resolve, reject) {
      promiseResolve = resolve;
      promiseReject = reject;
    });

    var args = [];
    for (var i = 0; i < arguments.length; i++) {
      args.push(arguments[i]);
    }
    args.push(function (err, value) {
      if (err) {
        promiseReject(err);
      } else {
        promiseResolve(value);
      }
    });

    try {
      original.apply(this, args);
    } catch (err) {
      promiseReject(err);
    }

    return promise;
  }

  Object.setPrototypeOf(fn, Object.getPrototypeOf(original));

  if (kCustomPromisifiedSymbol) Object.defineProperty(fn, kCustomPromisifiedSymbol, {
    value: fn, enumerable: false, writable: false, configurable: true
  });
  return Object.defineProperties(
    fn,
    getOwnPropertyDescriptors(original)
  );
}

exports.promisify.custom = kCustomPromisifiedSymbol

function callbackifyOnRejected(reason, cb) {
  // `!reason` guard inspired by bluebird (Ref: https://goo.gl/t5IS6M).
  // Because `null` is a special error value in callbacks which means "no error
  // occurred", we error-wrap so the callback consumer can distinguish between
  // "the promise rejected with null" or "the promise fulfilled with undefined".
  if (!reason) {
    var newReason = new Error('Promise was rejected with a falsy value');
    newReason.reason = reason;
    reason = newReason;
  }
  return cb(reason);
}

function callbackify(original) {
  if (typeof original !== 'function') {
    throw new TypeError('The "original" argument must be of type Function');
  }

  // We DO NOT return the promise as it gives the user a false sense that
  // the promise is actually somehow related to the callback's execution
  // and that the callback throwing will reject the promise.
  function callbackified() {
    var args = [];
    for (var i = 0; i < arguments.length; i++) {
      args.push(arguments[i]);
    }

    var maybeCb = args.pop();
    if (typeof maybeCb !== 'function') {
      throw new TypeError('The last argument must be of type Function');
    }
    var self = this;
    var cb = function() {
      return maybeCb.apply(self, arguments);
    };
    // In true node style we process the callback on `nextTick` with all the
    // implications (stack, `uncaughtException`, `async_hooks`)
    original.apply(this, args)
      .then(function(ret) { process.nextTick(cb, null, ret) },
            function(rej) { process.nextTick(callbackifyOnRejected, rej, cb) });
  }

  Object.setPrototypeOf(callbackified, Object.getPrototypeOf(original));
  Object.defineProperties(callbackified,
                          getOwnPropertyDescriptors(original));
  return callbackified;
}
exports.callbackify = callbackify;


/***/ }),

/***/ "./node_modules/@twilio/live-player-sdk/package.json":
/*!***********************************************************!*\
  !*** ./node_modules/@twilio/live-player-sdk/package.json ***!
  \***********************************************************/
/***/ ((module) => {

"use strict";
module.exports = JSON.parse('{"name":"@twilio/live-player-sdk","title":"Twilio Live Player SDK","description":"Twilio Live Player JavaScript Library","version":"1.0.2","homepage":"https://github.com/twilio/twilio-live-player.js#readme","author":"Manjesh Malavalli <mmalavalli@twilio.com>","contributors":["Charlemegne Santos <csantos@twilio.com>","Joyce Ma <joma@twilio.com>"],"keywords":["twilio","webrtc","library","javascript","player","live","streaming"],"repository":{"type":"git","url":"git+https://github.com/twilio/twilio-live-player.js.git"},"engines":{"node":">=14"},"license":"BSD-3-Clause","main":"./es5/index.js","types":"./es5/index.d.ts","scripts":{"build":"npm-run-all clean lint build:es5 build:js build:js-min build:js-assets docs","build:js":"rimraf ./dist/build && node ./scripts/build.js ./LICENSE.md ./dist/build/twilio-live-player.js","build:js-min":"uglifyjs ./dist/build/twilio-live-player.js -o ./dist/build/twilio-live-player.min.js --comments \\"/^! twilio-live-player.js/\\" -b beautify=false,ascii_only=true","build:js-assets":"npm-run-all build:js-assets:copy build:js-assets:rename","build:js-assets:copy":"copy-assets node_modules/amazon-ivs-player/dist/assets dist/build --allowRegex=\\"^amazon-ivs-wasmworker\\"","build:js-assets:rename":"renamer --chain scripts/renameassets.mjs dist/build/amazon-ivs-wasmworker.*","build:quickstart":"npm-run-all build:quickstart-sdk build:quickstart-assets","build:quickstart-assets":"copy-assets dist/build quickstart --allowRegex=\\"^twilio-live-player-wasmworker\\"","build:quickstart-sdk":"copy-assets dist/build quickstart --allowRegex=\\"^twilio-live-player.js\\"","quickstart":"node quickstart/server.js","build:es5":"rimraf ./es5 && tsc","docs":"rimraf ./dist/docs/$npm_config_subfolder && typedoc --out ./dist/docs/$npm_config_subfolder","clean":"rimraf ./dist ./es5 ./coverage ./.nyc_output quickstart/*.min.* quickstart/twilio-live-player.js","lint":"tslint -c ./tslint.json --project ./tsconfig.json -t stylish","test":"npm-run-all lint build test:unit test:integration","test:unit":"rimraf ./coverage ./.nyc_output && nyc mocha -r ts-node/register ./tests/unit/index.ts","test:integration":"rimraf dist/build/twilio-live-player-wasmworker-* && npm run build:js-assets && karma start","release":"release","package":"./scripts/package.sh"},"dependencies":{"@types/backoff":"2.5.2","amazon-ivs-player":"1.7.0","backoff":"2.5.0","safe-buffer":"5.2.1"},"devDependencies":{"@types/mocha":"^8.2.1","@types/node":"14.14.31","@types/sinon":"^9.0.10","browserify":"^17.0.0","copy-assets":"^1.0.3","express":"^4.17.1","karma":"^6.1.1","karma-chrome-launcher":"^3.1.0","karma-env-preprocessor":"^0.1.1","karma-firefox-launcher":"^2.1.0","karma-mocha":"^2.0.1","karma-spec-reporter":"0.0.32","karma-typescript":"^5.4.0","mocha":"^8.3.0","npm-run-all":"^4.1.5","nyc":"^15.1.0","renamer":"^3.0.1","sinon":"^9.2.4","ts-node":"^9.1.1","tsify":"^5.0.2","tslint":"^6.1.3","twilio":"^3.64.0","twilio-release-tool":"^1.0.2","twilio-video":"^2.13.1","typedoc":"0.20.28","typedoc-plugin-as-member-of":"^1.0.2","typescript":"4.1.5","vinyl-fs":"^3.0.3","vinyl-source-stream":"^2.0.0"}}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!******************************************!*\
  !*** ./resources/js/twilioLivePlayer.js ***!
  \******************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @twilio/live-player-sdk */ "./node_modules/@twilio/live-player-sdk/es5/index.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return generator._invoke = function (innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; }(innerFn, self, context), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; this._invoke = function (method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, "throw" === context.method) { if (delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method)) return ContinueSentinel; context.method = "throw", context.arg = new TypeError("The iterator does not provide a 'throw' method"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, define(Gp, "constructor", GeneratorFunctionPrototype), define(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (object) { var keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



function runLivePlayer() {
  return _runLivePlayer.apply(this, arguments);
}

function _runLivePlayer() {
  _runLivePlayer = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
    var _getAccessToken, _getAccessToken3, _window$location, host, protocol, getAccessToken, _getAccessToken2, _getAccessToken2$data, _getAccessToken$data, pg_access_token, player, videoDiv;

    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            if (!_twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__.Player.isSupported) {
              _context.next = 23;
              break;
            }

            /* Load your application */
            _window$location = window.location, host = _window$location.host, protocol = _window$location.protocol;
            _context.next = 4;
            return fetch("".concat(protocol, "//").concat(host, "/api/generate-playback-grants"));

          case 4:
            getAccessToken = _context.sent;
            _context.next = 7;
            return getAccessToken.json();

          case 7:
            getAccessToken = _context.sent;
            console.log(getAccessToken);

            if (!(((_getAccessToken = getAccessToken) === null || _getAccessToken === void 0 ? void 0 : _getAccessToken.status) !== "success")) {
              _context.next = 13;
              break;
            }

            alert("Error getting access token");
            console.log((_getAccessToken2 = getAccessToken) === null || _getAccessToken2 === void 0 ? void 0 : (_getAccessToken2$data = _getAccessToken2.data) === null || _getAccessToken2$data === void 0 ? void 0 : _getAccessToken2$data.message);
            return _context.abrupt("return");

          case 13:
            _getAccessToken$data = (_getAccessToken3 = getAccessToken) === null || _getAccessToken3 === void 0 ? void 0 : _getAccessToken3.data, pg_access_token = _getAccessToken$data.pg_access_token; // Join a live stream.

            _context.next = 16;
            return _twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__.Player.connect(pg_access_token, {
              playerWasmAssetsPath: "".concat(protocol, "//").concat(host, "/js/twilio/live-player")
            });

          case 16:
            player = _context.sent;
            // // Call this method after the Player transitions to the Player.State.Ready state.
            // player.play();
            // // Pause playback.
            // player.pause();
            // // Mute audio.
            // player.isMuted = true;
            // // Unmute audio.
            // player.isMuted = false;
            // // Set volume.
            // player.setVolume(0.5);
            player.on(_twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__.Player.Event.VolumeChanged, function () {
              if (player.isMuted) {
                /* Show the unmute button */
              } else {
                /* Hide the unmute button */
              }
            });
            player.on(_twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__.Player.Event.StateChanged, function (state) {
              switch (state) {
                case _twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__.Player.State.Buffering:
                /**
                 * The player is buffering content.
                 */

                case _twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__.Player.State.Ended:
                /**
                 * The stream has ended.
                 */

                case _twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__.Player.State.Idle:
                /**
                 * The player has successfully authenticated and is loading the stream. This
                 * state is also reached as a result of calling player.pause().
                 */

                case _twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__.Player.State.Playing:
                /**
                 * The player is now playing a stream. This state occurs as a result of calling
                 * player.play().
                 */

                case _twilio_live_player_sdk__WEBPACK_IMPORTED_MODULE_0__.Player.State.Ready:
                  /**
                   * The player is ready to play back the stream.
                   */
                  player.play();
                  playerStarted = true;
              }
            }); // assumes there's a div on the page called "videoDiv"
            // where an HTML Video Element can be attached

            videoDiv = document.getElementById("twilio-video-player"); // attach the video data into a div on the page

            videoDiv.appendChild(player.videoElement);
            _context.next = 23;
            break;

          case 23:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));
  return _runLivePlayer.apply(this, arguments);
}

runLivePlayer();
})();

/******/ })()
;