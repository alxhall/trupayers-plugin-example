document.addEventListener("DOMContentLoaded", function(){
    (function () {
        const $el = document.querySelector('.fetch-test-btn a');
        const $resultContainer = document.querySelector('.entry-content .result');

        if ($el) {
            $el.addEventListener('click', function(e) {
                const data = new FormData();

                data.append( 'action', 'trp_get_destinations' );
                data.append( 'nonce', trpjs.nonce );
                data.append( 'is_user_logged_in', trpjs.is_user_logged_in );
                data.append( 'user_id', trpjs.user_id );
                data.append( 'custom_prop', trpjs.custom_prop);

                fetch(trpjs.ajaxurl, {
                  method: "POST",
                  credentials: 'same-origin',
                  body: data
                })
                .then((response) => response.json())
                .then((data) => {
                  if (data) {
                    $resultContainer.innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
                    console.log(data);
                  }
                })
                .catch((error) => {
                  console.error(error);
                });

            } )
        }
    }());
});

// AJAX EXAMPLE
// (function( $ ) {
// 	'use strict';

//     $( window ).load(function() {

//         $(".fetch-test-btn a").click( function(e) {
//             e.preventDefault();

//             let nonce = trpjs.nonce;
//             let is_user_logged_in = trpjs.is_user_logged_in;
//             let custom_prop = trpjs.custom_prop;

//             console.log(is_user_logged_in);
//             console.log(custom_prop);

//             jQuery.ajax({
//                 type : "POST",
//                 dataType : "json",
//                 url : trpjs.ajaxurl,
//                 data : {
//                     action: "trp_get_destinations", 
//                     user_id : 999, 
//                     nonce: nonce
//                 },
//                 success: function(response) {

//                    if(response.code == 200) {
//                       console.log(response);
//                    }
//                    else {
//                       alert("Your call could not be made")
//                    }
//                 }
//              })   

//         })
//     });

// 	/**
// 	 * All of the code for your public-facing JavaScript source
// 	 * should reside in this file.
// 	 *
// 	 * Note: It has been assumed you will write jQuery code here, so the
// 	 * $ function reference has been prepared for usage within the scope
// 	 * of this function.
// 	 *
// 	 * This enables you to define handlers, for when the DOM is ready:
// 	 *
// 	 * $(function() {
// 	 *
// 	 * });
// 	 *
// 	 * When the window is loaded:
// 	 *
// 	 * $( window ).load(function() {
// 	 *
// 	 * });
// 	 *
// 	 * ...and/or other possibilities.
// 	 *
// 	 * Ideally, it is not considered best practise to attach more than a
// 	 * single DOM-ready or window-load handler for a particular page.
// 	 * Although scripts in the WordPress core, Plugins and Themes may be
// 	 * practising this, we should strive to set a better example in our own work.
// 	 */

// })( jQuery );
