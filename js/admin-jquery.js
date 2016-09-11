   /************************ vertical menu switchClass jquery process*********************/
   
  $(document).ready(function(){
      
      $('#menu a').mouseenter(function(){
        $(this).switchClass('style1','style2',300);  /*Eitar kaj ses hoenai */
      });

      $('#menu a').mouseleave(function(){
        $(this).switchClass('style2','style1',300);
      });

    });

