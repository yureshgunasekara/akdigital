function _arrayLikeToArray(arr, len) {
   if (len == null || len > arr.length) len = arr.length;
   for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i];
   return arr2;
}
function _arrayWithoutHoles(arr) {
   if (Array.isArray(arr)) return _arrayLikeToArray(arr);
}
function _iterableToArray(iter) {
   if (
      (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null) ||
      iter["@@iterator"] != null
   )
      return Array.from(iter);
}
function _nonIterableSpread() {
   throw new TypeError(
      "Invalid attempt to spread non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
   );
}
function _toConsumableArray(arr) {
   return (
      _arrayWithoutHoles(arr) ||
      _iterableToArray(arr) ||
      _unsupportedIterableToArray(arr) ||
      _nonIterableSpread()
   );
}
function _unsupportedIterableToArray(o, minLen) {
   if (!o) return;
   if (typeof o === "string") return _arrayLikeToArray(o, minLen);
   var n = Object.prototype.toString.call(o).slice(8, -1);
   if (n === "Object" && o.constructor) n = o.constructor.name;
   if (n === "Map" || n === "Set") return Array.from(n);
   if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))
      return _arrayLikeToArray(o, minLen);
}
(function () {
   var triggers = document.querySelectorAll("[data-dialog-target]");
   var dialogs = document.querySelectorAll("[data-dialog]");
   var backdrops = document.querySelectorAll("[data-dialog-backdrop]");
   var closeTriggers = document.querySelectorAll("[data-dialog-close]");
   if (triggers && dialogs && backdrops) {
      Array.from(triggers).forEach(function (trigger) {
         return Array.from(dialogs).forEach(function (dialog) {
            return Array.from(backdrops).forEach(function (backdrop) {
               if (
                  trigger.dataset.dialogTarget === dialog.dataset.dialog &&
                  backdrop.dataset.dialogBackdrop === dialog.dataset.dialog
               ) {
                  var _dialog_classList, _dialog_classList1;
                  var mountDialog = function mountDialog() {
                     var _dialog_classList, _dialog_classList1;
                     isDialogOpen = true;
                     backdrop.classList.toggle("pointer-events-none");
                     backdrop.classList.toggle("hidden");
                     (_dialog_classList = dialog.classList).remove.apply(
                        _dialog_classList,
                        _toConsumableArray(unmountClasses)
                     );
                     (_dialog_classList1 = dialog.classList).add.apply(
                        _dialog_classList1,
                        _toConsumableArray(mountClasses)
                     );
                  };
                  var unmountDialog = function unmountDialog() {
                     var _dialog_classList, _dialog_classList1;
                     isDialogOpen = false;
                     backdrop.classList.toggle("pointer-events-none");
                     backdrop.classList.toggle("hidden");
                     (_dialog_classList = dialog.classList).remove.apply(
                        _dialog_classList,
                        _toConsumableArray(mountClasses)
                     );
                     (_dialog_classList1 = dialog.classList).add.apply(
                        _dialog_classList1,
                        _toConsumableArray(unmountClasses)
                     );
                  };
                  var mountValue =
                     dialog.dataset.dialogMount || "block translate-y-0";
                  var unmountValue =
                     dialog.dataset.dialogUnmount ||
                     "hidden -translate-y-14";
                  var transitionValue =
                     dialog.dataset.dialogTransition ||
                     "transition-all duration-300";
                  var mountClasses = mountValue.split(" ");
                  var unmountClasses = unmountValue.split(" ");
                  var transitionClasses = transitionValue.split(" ");
                  var isDialogOpen = false;
                  (_dialog_classList = dialog.classList).add.apply(
                     _dialog_classList,
                     _toConsumableArray(unmountClasses)
                  );
                  if (!backdrop.hasAttribute("tabindex"))
                     backdrop.setAttribute("tabindex", 0);
                  if (transitionValue !== "false")
                     (_dialog_classList1 = dialog.classList).add.apply(
                        _dialog_classList1,
                        _toConsumableArray(transitionClasses)
                     );
                  if (
                     dialog.className.includes(unmountValue) &&
                     !backdrop.className.includes(
                        "pointer-events-none hidden"
                     )
                  ) {
                     backdrop.classList.add("pointer-events-none");
                     backdrop.classList.add("hidden");
                  }
                  trigger.addEventListener("click", function () {
                     return dialog.className.includes(unmountValue)
                        ? mountDialog()
                        : unmountDialog();
                  });
                  backdrop.addEventListener("click", function (param) {
                     var target = param.target;
                     var _target_dataset, _target_dataset1;
                     if (
                        (target === null || target === void 0
                           ? void 0
                           : (_target_dataset = target.dataset) === null ||
                             _target_dataset === void 0
                           ? void 0
                           : _target_dataset.dialogBackdrop) &&
                        (target === null || target === void 0
                           ? void 0
                           : (_target_dataset1 = target.dataset) === null ||
                             _target_dataset1 === void 0
                           ? void 0
                           : _target_dataset1.dialogBackdropClose)
                     )
                        unmountDialog();
                  });
                  document.addEventListener("keyup", function (param) {
                     var key = param.key;
                     return key === "Escape" && isDialogOpen
                        ? unmountDialog()
                        : null;
                  });
                  Array.from(closeTriggers).forEach(function (close) {
                     return close.addEventListener("click", function () {
                        return isDialogOpen ? unmountDialog() : null;
                     });
                  });
               }
            });
         });
      });
   }
})();
