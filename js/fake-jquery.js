/**
 * http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
 */
(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)