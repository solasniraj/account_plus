
$(document).ready(function ()  
{
 activateCommentAndSummerField("deactivate");
 $('input.formatComma').keyup(function(e) {
  var price = $(this).val();
  var regex = /^[0-9.,]+$/;
  if(this.value!='-')
    while(isNaN(this.value))
      this.value = this.value.split('').reverse().join('').replace(/[\D]/i,'')
    .split('').reverse().join('');

    if(regex.test(price))
    {
     $(this).val(function(index, value)
     {
      value = value.replace(/,/g,'');
      return numberWithCommas(value);
    });
   }

 })
 .on("cut copy paste",function(e){
  e.preventDefault();
});


 $( function() {
  $( "#datepicker" ).datepicker({
   maxDate: dateToday

 });
} );

});

