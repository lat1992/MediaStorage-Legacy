# jOverlay

Create your content and style it as you want, jOverlay will hide it and wrapt it into an overlay!

### Dependencies
jQuery >= 1.9.1

### Installation
After jQuery include jquery.jOverlay.js
```html
<script src="../src/jquery.jOverlay.js"></script>
```
Also include the basic stylesheet rules of jOverlay
```html
<link rel="stylesheet" href="../src/jOverlay.css">
```

That's all! Select your trigger and inizialize the jOverlay, for example:
```javascript
$(function() {
  $(".btn").jOverlay();
});
```
### Optional options
You can override some default options:
KEY: DEFAULT VALUE
```javascript
containerClass: "page-overlay", // Custom jOverlay container
closeTriggerClass: "close-overlay", // Custom close trigger
clickToClose: false, // Click wherever to close jOverlay
onBeforeOpen: function() {}, // Function triggered before jOverlay open
onAfterClose: function() {} // Function triggered after jOverlay close
```