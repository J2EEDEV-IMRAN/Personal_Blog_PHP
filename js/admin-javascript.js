 /************************ category delete confirm box*********************/
   /* function deletepost(id)
    {
      var post_id=id.replace('post_','');
   var hr = new XMLHttpRequest();
    hr.open("REQUEST", 'delete.php', true);
      hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
        var htmloutput=hr.responseText;
       
      mess.innerHTML=htmloutput;
      }
    }
   hr.send('id='+id);
   document.body.removeChild(document.getElementById(id));
    }   EI ONGSO TA KAJE LAGATE PARINAI*/

   function customAlert()
   {
      this.render=function(dialog,id,page)
      {

            var winW=window.innerWidth;
            var winH=window.innerHeight;
            var dialogoverlay=document.getElementById('dialogoverlay');
            var dialogbox=document.getElementById('dialogbox');
            dialogoverlay.style.display='block';
            dialogoverlay.style.height=winH+'px';
            dialogbox.style.left=(winW/2)-(500/2)+'px';
            dialogbox.style.top='160px';
            dialogbox.style.display='block';
            document.getElementById('dialogheader').innerHTML='Acknowledge this message';
            document.getElementById('dialogbody').innerHTML=dialog;
            document.getElementById('dialogfooter').innerHTML='<a class="delet" onclick="Alert.yes()" href="'+page+'?id='+id+'">Yes</a>&nbsp;<button onclick="Alert.cancle()">Cancle</button>';
          
      }
      this.cancle=function(){
            document.getElementById('dialogoverlay').style.display='none';
            document.getElementById('dialogbox').style.display='none';
      }
      this.yes=function()
      {
        /*if(op=='delete_post')
        {
        deletepost(id,mess);
        }*/
            document.getElementById('dialogoverlay').style.display='none';
         document.getElementById('dialogbox').style.display='none';
      }
   }
   var Alert=new customAlert();




   /***********best process of adding event linstener**************/


  /* var e_category,cat_name;                    ei variable gula eikhetre sobsomy bire rakhtehobe 
   function  addListener()
   {
        e_category=document.getElementById('e_category');
        cat_name=document.getElementById('cat_name');
      

      
    
        /* document.getElementById('form1').addEventListener('click',show_empty,false); pore dakhbo*/
       /* document.getElementById('cat_name').addEventListener('keyup',check_category_name,false);
        document.getElementById('cat_name').addEventListener('blur',check_category_name_blur,false);
   }*/
   /*

   function show_empty()
   {
    if(cat_name.value=='')
      e_category.innerHTML='Category can ont be empty !';
       }

       pore dekhbo*/

  
  /***********(checking category name)**************/



   function check_category_name(elem,er)
   {
   var category=document.getElementById(elem).value;
   var e_category=document.getElementById(er);
   var hr = new XMLHttpRequest();
    hr.open("POST", 'javasctipt_category.php', true);
    hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
        var dataoutput = hr.responseText;
      e_category.innerHTML=dataoutput;
      }
    }
   hr.send('category='+category); 
   e_category.innerHTML = "requesting...";
   }
   function check_category_name_blur()
  {
    e_category.innerHTML='';
  }
  function check_category_name_click()
  {
    document.getElementById('e_category').innerHTML='Enter a tag';
  }


  /***********(checking category name)**************/


   function check_tag_name(elem,er)
   {
   var tag=document.getElementById(elem).value;
   var e_tag=document.getElementById(er);
   var hr = new XMLHttpRequest();
    hr.open("POST", 'javasctipt_tags.php', true);
    hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
        var dataoutput = hr.responseText;
      e_tag.innerHTML=dataoutput;
      }
    }
   hr.send('tag='+tag); 
   e_tag.innerHTML = "requesting...";
   }
   function check_tag_name_blur()
  {
    e_tag.innerHTML='';
  }
  function check_tag_name_click()
  {
    document.getElementById('e_tag').innerHTML='Enter a tag';
  }



  


   


