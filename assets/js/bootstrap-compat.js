/* =========================================================================
   Bootstrap 3 → Bootstrap 5 Compatibility JS
   1. Maps BS3 data-* attributes to BS5 data-bs-* attributes
   2. Replaces bootbox.confirm with a BS5 native modal implementation
   ========================================================================= */

(function () {
  'use strict';

  /* --- 1. Data attribute shim: data-toggle → data-bs-toggle, etc. --- */
  function mapDataAttributes() {
    var map = {
      'data-toggle':  'data-bs-toggle',
      'data-target':  'data-bs-target',
      'data-dismiss': 'data-bs-dismiss',
      'data-spy':     'data-bs-spy',
      'data-slide':   'data-bs-slide',
      'data-ride':    'data-bs-ride',
      'data-interval':'data-bs-interval',
      'data-delay':   'data-bs-delay'
    };
    Object.keys(map).forEach(function (oldAttr) {
      var newAttr = map[oldAttr];
      document.querySelectorAll('[' + oldAttr + ']').forEach(function (el) {
        if (!el.hasAttribute(newAttr)) {
          el.setAttribute(newAttr, el.getAttribute(oldAttr));
        }
      });
    });
  }

  /* Run on DOM ready and after any AJAX content insertion */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mapDataAttributes);
  } else {
    mapDataAttributes();
  }

  /* --- 2. bootbox.confirm replacement using Bootstrap 5 Modal API --- */
  window.bootbox = window.bootbox || {};

  window.bootbox.confirm = function (message, callback) {
    // Build modal HTML
    var modalHtml =
      '<div class="modal fade" tabindex="-1" aria-hidden="true">' +
      '  <div class="modal-dialog modal-dialog-centered">' +
      '    <div class="modal-content">' +
      '      <div class="modal-body text-center py-4">' +
      '        <p class="mb-0" style="font-size: 0.95rem;">' + message + '</p>' +
      '      </div>' +
      '      <div class="modal-footer justify-content-center border-top-0 pt-0">' +
      '        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>' +
      '        <button type="button" class="btn btn-danger px-4" data-bb-confirm="ok">OK</button>' +
      '      </div>' +
      '    </div>' +
      '  </div>' +
      '</div>';

    var wrapper = document.createElement('div');
    wrapper.innerHTML = modalHtml;
    var modalEl = wrapper.firstElementChild;
    document.body.appendChild(modalEl);

    var bsModal = new bootstrap.Modal(modalEl);
    var done = false;

    function finish(result) {
      if (done) return;
      done = true;
      bsModal.hide();
      if (typeof callback === 'function') callback(result);
    }

    modalEl.querySelector('[data-bb-confirm="ok"]').addEventListener('click', function () {
      finish(true);
    });
    modalEl.addEventListener('hidden.bs.modal', function () {
      if (!done) finish(false);
      modalEl.remove();
    });

    bsModal.show();
    return false;
  };

  /* bootbox.alert for completeness (used in some CI apps) */
  window.bootbox.alert = function (message, callback) {
    var modalHtml =
      '<div class="modal fade" tabindex="-1" aria-hidden="true">' +
      '  <div class="modal-dialog modal-dialog-centered">' +
      '    <div class="modal-content">' +
      '      <div class="modal-body text-center py-4">' +
      '        <p class="mb-0" style="font-size: 0.95rem;">' + message + '</p>' +
      '      </div>' +
      '      <div class="modal-footer justify-content-center border-top-0 pt-0">' +
      '        <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">OK</button>' +
      '      </div>' +
      '    </div>' +
      '  </div>' +
      '</div>';

    var wrapper = document.createElement('div');
    wrapper.innerHTML = modalHtml;
    var modalEl = wrapper.firstElementChild;
    document.body.appendChild(modalEl);

    var bsModal = new bootstrap.Modal(modalEl);
    modalEl.addEventListener('hidden.bs.modal', function () {
      if (typeof callback === 'function') callback();
      modalEl.remove();
    });
    bsModal.show();
  };
})();
