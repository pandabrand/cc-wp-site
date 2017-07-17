var windowObjectReference = null; // g lobal variable

var makepopup = function (el) {
  event.preventDefault();
  if(windowObjectReference == null || windowObjectReference.closed) {
    windowObjectReference = window.open(el.attr('href'), "_target", "width=600, height=350");
  } else {
    windowObjectReference.focus();
  }
};
