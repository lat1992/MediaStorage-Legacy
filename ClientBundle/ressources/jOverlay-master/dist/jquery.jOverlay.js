/*
 *  jOverlay - v1.1.2
 *  Create your content and than wrap it into an overlay
 *  https://github.com/Giulico
 *
 *  Made by Giulio Collesei
 *  Under MIT License
 */
;(function ( $, window, document, undefined ) {

  "use strict";

    var pluginName = "jOverlay",
        defaults = {
          containerClass: "page-overlay",
          closeTriggerClass: "close-overlay",
          clickToClose: false,
          onBeforeOpen: function() {},
          onAfterClose: function() {}
        };

    // The actual plugin constructor
    function JOverlay ( element, options ) {
        this.element = element;
        this.settings = $.extend( {}, defaults, options );
        this._defaults = defaults;
        this._options = options;
        this._name = pluginName;
        this.init();
    }

    // Avoid jOverlay.prototype conflicts
    $.extend(JOverlay.prototype, {
        init: function () {

            // Estraggo il target oppure avviso l'utonto che l'elemento non ha un target
            if( this.element.hash && $(this.element.hash).length ) {
              var myInstance = this,
                  myTarget = myInstance.element.hash;

              //Nascondo il target con javascript per sicurezza
              $(myTarget).css({display: "none"});

              myInstance.open(myTarget);

            } else {
              console.warn("Your link href doen\'t target an existing ID element" + "\n" + this.element);
            }
        },
        open: function (selector) {

          var myInstance = this;

          // Funzione chiamata prima di aprire l'Overlay
          myInstance.settings.onBeforeOpen();
          // Creo l'overlay e scopro il contenuto
          $(selector).wrap("<div class='" + myInstance.settings.containerClass + "'></div>").show();

          //Aggiungo l'evento click on overlay to close
          if ( myInstance.settings.clickToClose ) {
            $("." + myInstance.settings.containerClass).click(function(event) {
              event.preventDefault();
              myInstance.close();
            });
          }

          // Creo e ci appendo il bottone di chiusura dell'overlay
          if(myInstance._options && "closeTriggerClass" in myInstance._options) {
            // Close Trigger Personalizzato
            $("." + myInstance.settings.closeTriggerClass)
              .clone()
              .show()
              .on({
                click: function(event) {
                  event.preventDefault();
                  myInstance.close(selector);
                }
              })
              .appendTo("." + myInstance.settings.containerClass);
          } else {
            $("<a>X</a>")
              .addClass("close-overlay")
              .attr("href","#")
              .on({
                click: function(event) {
                  event.preventDefault();
                  myInstance.close(selector);
                }
              })
              .appendTo("." + myInstance.settings.containerClass)
              .show();
          }
          // Una volta aggiunto il bottone di chiusura, faccio il fade in dell'ovelay
          $("."+myInstance.settings.containerClass).fadeIn();
        },
        close : function(selector) {

          var myInstance = this;

          $("."+myInstance.settings.containerClass).fadeOut("fast", function () {
            // dopo il fade out
            $("."+myInstance.settings.containerClass).find("."+myInstance.settings.closeTriggerClass).remove();
            $(selector).unwrap().hide();

            // Funzione chiamata dopo la chiusura della overlay
            myInstance.settings.onAfterClose();
          });
        }
    });

    // preventing against multiple instantiations
    $.fn[ pluginName ] = function ( options ) {
        return this.each(function() {
            new JOverlay( this, options );
        });
    };

})( jQuery, window, document );