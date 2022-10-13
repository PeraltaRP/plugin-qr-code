jQuery(document).ready(function () {

    jQuery("#accordion-wp").accordion();


    jQuery("#tags").autocomplete({
     source: availablePosts,
     select: function (event, ui) {
        AutoCompleteSelectHandler(event, ui)
    }
     });


});
function AutoCompleteSelectHandler(event, ui)
{               
   
}

// function pegarId(e) {
//     alert(e.target.value);
// }
function onClick($this) {
    var val = $this.previousElementSibling.value;

    
    if(val == ''){
        console.log('no input');
    }else{
       console.log(val);
    }
  }
