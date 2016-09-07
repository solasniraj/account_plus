
  var debitCreditDifference="";
  var debitTotal=0;
  var creditTotal=0;
  var dateToday = new Date();
  var output="";
  var allInsertItemsinVouture=[];
  var objectToStroCurrentData;
  var incrementCounterForItem=0;
  var viewToDisplayInTable ='';
  var myCustomViewToEnter= '';
  var AddToJournalList=true;
  var edittheJournalItems=false;
  var reqiureTotriggerwhenUpdateisDone='';



  function  whenJournalTypeIsSelected(selectedType)
  {
   reqiureTotriggerwhenUpdateisDone=selectedType;
    var index = selectedType.selectedIndex;      
    var typeValue= selectedType.options[index].value;  
    $.ajax({
      type: "POST",
      url: baseUrl +"transaction/getProgrammListForCurrentChartName",
      data: {charClassId:typeValue},
      success: function (msg)
      {

        $('#programsList').html(msg);
      },
      error: function()
      {

        console.log("error occur");

      }
    });

  }


  function  whenProgramIsSelected(selectedType)
  {

    var index = selectedType.selectedIndex;      
    var cId= selectedType.options[index].value; 
    var pId=selectedType.options[index].getAttribute("programmId");

    $.ajax({
      type: "POST",
      url: baseUrl +"transaction/getProgrammcodeForCurrentId",
      data: {chartId:cId},
      success: function (msg)
      {

        $('#programmCode').html(msg);

      },
      error: function()
      {

        console.log("error occur");

      }
    });

    $.ajax({
      type: "POST",
      url: baseUrl +"transaction/getSubledgerForCurrentProgramId",
      data: {programmId:pId},
      success: function (msg)
      {

        $('#subLedgerList').html(msg);
        if(msg.length >34)
        {

          $('#ledgerType').html('<option value="1">1</option><option value="">2</option><option value="">3</option>');

        }
        else 
        {
          $('#ledgerType').html('<option value=""></option>');

        }

      },
      error: function()
      {

        console.log("error occur");

      }
    });


    $.ajax({
      type: "POST",
      url: baseUrl +"transaction/getDonarListForCurrentProgramId",
      data: {programmId:pId},
      success: function (msg)
      {

        $('#donerList').html(msg);
      },
      error: function()
      {

        console.log("error occur");

      }
    });

  }


  function numberWithCommas(x)
  {

    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }

  function numberWithOutCommas(x)
  {    
    if(x.toString().length <= 3)
    {

      return  parseInt(x);
      console.log("retunr as it");
    }
    else
    { 
      var withoutComma=x.replace(/[^0-9]/g, '');
      return parseInt(withoutComma);
    }

  }


  function checkDiffernceBetDebitAndCredit()
  {
      // console.log(debitTotal);
      // console.log(creditTotal);
      var d=numberWithOutCommas(debitTotal);
      var b=numberWithOutCommas(creditTotal);
      if(d == b)
      {
        debitCreditDifference=0;
        activateCommentAndSummerField("activate");
        $("#creditGreater").val(0);
        $("#debitGreater").val(0);
      //  console.log("both is same");
      }
      else  if(d > b)
      {

        debitCreditDifference=numberWithCommas(d - b);
        $("#debitGreater").val(debitCreditDifference);
        $("#creditGreater").val(0);
    // console.log("debit is greater");
    activateCommentAndSummerField("notActivate");

  }
  else
  {
    debitCreditDifference=numberWithCommas(b -d);
    $("#debitGreater").val(0.0);
    $("#creditGreater").val(debitCreditDifference);
    activateCommentAndSummerField("adctivate");

  }

  }


  function activateCommentAndSummerField(type)
  {

    if(type=="activate")
    {

     $("#comment,#summary").attr("disabled", false); 
     $("#submitTheForm").prop('disabled', false);
   }
   else
   {
     $("#comment,#summary").attr("disabled", true); 
     $("#submitTheForm").prop('disabled', true);

   }
  }

  function  ProcessDataandInsertIntoArray(index)
  {
  
    var program = document.getElementById("programsList").options[document.getElementById("programsList").selectedIndex].text;
    var subLedger = document.getElementById("subLedgerList").options[document.getElementById("subLedgerList").selectedIndex].text;
    var ledgerType = document.getElementById("ledgerType").options[document.getElementById("ledgerType").selectedIndex].value;
    var donar = document.getElementById("donerList").options[document.getElementById("donerList").selectedIndex].text;
    var description = $('#description').val();
    var debitAmount = $('#debitAmount').val();
    var creditAmount = $('#creditAmount').val();
    var chequeNo = $('#chequeNo').val();
    var pCode= $("#pCode").val();

    var program_id=document.getElementById("programsList").options[document.getElementById("programsList").selectedIndex].value;
    var subLedger_id = document.getElementById("subLedgerList").options[document.getElementById("subLedgerList").selectedIndex].value;
    var donar_id = document.getElementById("donerList").options[document.getElementById("donerList").selectedIndex].value;

    if( (program == null || program == "")  || (description == null || description == "") || (pCode == null || pCode == ""))
    {

     var  msg= '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Plese Enter Necessary Fields</div>';
     $('#errorMessages').html(msg);
      hideMessages();
     return false;

   }
   else
   {
    var  msg='';
    $('#errorMessages').html(msg);

  }


  if(debitAmount && creditAmount)
  {

   var  msg= '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Either Debit Amount OR Credit Amount is required</div>';
   $('#errorMessages').html(msg);
    hideMessages();
   return false;
  }
  else if((debitAmount && (creditAmount == null || creditAmount == ""))) 
  {

    var debitInsertValue=debitAmount;
    creditInsertValue=0;
    objectToStroCurrentData=
    {

      indexNumber:incrementCounterForItem,
      pCode:pCode, 
      programName:program,
      program_id:program_id,
      subLedgerName:subLedger,
      subLedger_id:subLedger_id, 
      donarName:donar, 
      donar_id:donar_id,
      ledgerType:ledgerType,
      description:description,
      debitAmount:debitInsertValue,
      creditAmount:creditInsertValue,
      chequeNo:chequeNo

    };
    incrementCounterForItem++;
    if(typeof(index) == 'undefined' || index === null)
    { 
      allInsertItemsinVouture.push(objectToStroCurrentData);
      console.log(allInsertItemsinVouture);
      viewTheItemsInArray();
      var  msg= '<div class="alert alert-success fade in text-center text-justified"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Transaction Added succesfully</div>';
      $('#errorMessages').html(msg);
      hideMessages();
    }
    else 
    {   
      allInsertItemsinVouture.splice(index, 1,objectToStroCurrentData);
      console.log(allInsertItemsinVouture);
      viewTheItemsInArray();

      var  msg= '<div class="alert alert-success fade in text-center text-justified"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Transaction updated succesfully</div>';
      $('#errorMessages').html(msg);
       hideMessages();
    }


    description = $('#description').val("");
    debitAmount = $('#debitAmount').val("");
    creditAmount = $('#creditAmount').val("");
    chequeNo = $('#chequeNo').val("");
    objectToStroCurrentData={};


  }

  else if((creditAmount && (debitAmount == null || debitAmount == ""))) 
  {


    var creditInsertValue=creditAmount;
    debitInsertValue=0;
    objectToStroCurrentData=
    {

      indexNumber:incrementCounterForItem,
      pCode:pCode, 
      programName:program,
      program_id:program_id,
      subLedgerName:subLedger,
      subLedger_id:subLedger_id, 
      donarName:donar, 
      donar_id:donar_id,
      ledgerType:ledgerType,
      description:description,
      debitAmount:debitInsertValue,
      creditAmount:creditInsertValue,
      chequeNo:chequeNo

    };

    incrementCounterForItem++;
    if(typeof(index) == 'undefined' || index === null)
    { 
      allInsertItemsinVouture.push(objectToStroCurrentData);
      console.log(allInsertItemsinVouture);
      viewTheItemsInArray();
        var  msg= '<div class="alert alert-success fade in text-center text-justified"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Transaction Added succesfully</div>';
      $('#errorMessages').html(msg);
       hideMessages();
    }
    else 
    {   
      allInsertItemsinVouture.splice(index, 1,objectToStroCurrentData);
      console.log(allInsertItemsinVouture);
      viewTheItemsInArray();
      var  msg= '<div class="alert alert-success fade in text-center text-justified"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Transaction updated succesfully</div>';
      $('#errorMessages').html(msg);
       hideMessages();
    }

    description = $('#description').val("");
    debitAmount = $('#debitAmount').val("");
    creditAmount = $('#creditAmount').val("");
    chequeNo = $('#chequeNo').val("");

  }
  else 
  {     

    var  msg= '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Plese Enter Either Debit Amount OR Credit Amount</div>';
    $('#errorMessages').html(msg);
    hideMessages();
    return false;
  }

  }



  function viewTheItemsInArray()
  {
    if(allInsertItemsinVouture.length >0)
    {
     viewToDisplayInTable="";
     myCustomViewToEnter="";
     for (var i = 0; i<allInsertItemsinVouture.length; i++) 
     {

      var objestToLoop = allInsertItemsinVouture[i];
      var pCode = objestToLoop.pCode;
      var program=objestToLoop.programName;
      var program_id=objestToLoop.program_id;
      var subLedger=objestToLoop.subLedgerName;
      if(subLedger)
        { }
      else 
      {

        subLedger='';
      }

      var subLedger_id=objestToLoop.subLedger_id;

      if(subLedger_id)
        { }
      else 
        { subLedger_id='';  

    }

    var donar=objestToLoop.donarName;
    var donar_id=objestToLoop.doner_id;

    if(donar)
      { }
    else
    {
      donar='';

    }

    if(donar_id)
      { }
    else 
    {
      donar_id='';
    }


    var ledgerType=objestToLoop.ledgerType;

    if(ledgerType)
      { }
    else 
    {
      ledgerType ='';
    }
    var description =objestToLoop.description;
    var chequeNo=objestToLoop.chequeNo;

    if(chequeNo)
      { }
    else 
    {
      chequeNo='';

    }
    var debitAmount=objestToLoop.debitAmount;
    if(debitAmount)
      { }
    else 
    {
      debitAmount=0;
    }

    var creditAmount=objestToLoop.creditAmount;
    if(creditAmount)
      { }
    else 
    {
      creditAmount=0;

    }


    myCustomViewToEnter ='<tr>' +
    '<td>' + pCode + '</td>' +
    '<td>' + program + '</td>' +
    '<td>' + subLedger + '</td>' +
    '<td>' + ledgerType + '</td>' +
    '<td>' + donar + '</td>' + 
    '<td colspan="2">' + description + '</td>' +
    '<td>' + debitAmount + '</td>' +
    '<td>' + creditAmount + '</td>' +
    '<td>' + chequeNo + '</td>' +
    '<td colspan="2" style="width:200px" ><span type="text" onClick="editItmInTheArray(' + i +')' + '"' + 'class="btn btn-success btn-sm" style="">Edit</span> / <span type="text" onClick="delteItemFromArray(' + i +')' + '"' + 'class="btn btn-danger btn-sm">Delete</span></td></tr>';

    viewToDisplayInTable= viewToDisplayInTable + myCustomViewToEnter;            
    debitTotal = numberWithCommas(numberWithOutCommas(debitTotal) + numberWithOutCommas(debitAmount));
    creditTotal = numberWithCommas(numberWithOutCommas(creditTotal) + numberWithOutCommas(creditAmount));



  }   


  $("#workingWithObjectData").html(viewToDisplayInTable);
  $("#totalDebit").html(debitTotal);
  $("#totalCredit").html(creditTotal);
  checkDiffernceBetDebitAndCredit();
  viewToDisplayInTable="";
  myCustomViewToEnter="";
  debitTotal=0;
  creditTotal=0;


  }
  else 
  {
   viewToDisplayInTable="";
   myCustomViewToEnter="";
   $("#workingWithObjectData").html("");
   debitTotal=0;
   creditTotal=0;
   $("#totalDebit").html(debitTotal);
   $("#totalCredit").html(creditTotal);
   debitCreditDifference=0;
   activateCommentAndSummerField("activate");
   $("#creditGreater").val(0);
   $("#debitGreater").val(0);
  }

  }




  function delteItemFromArray(index)
  {
    var confirmUser=confirm("!!Are you sure to Delete this transaction");
    if(confirmUser)
    {
         allInsertItemsinVouture.splice(index, 1);
         console.log("item is delted at idex"+ index);
        viewToDisplayInTable="";
        myCustomViewToEnter="";
        $("#workingWithObjectData").html("");
        viewTheItemsInArray();
      }  

    }



    function editItmInTheArray(index)
    {

      var objectAtPaticularIndex = allInsertItemsinVouture[index];
      console.log(objectAtPaticularIndex);
      pCode = objectAtPaticularIndex.pCode;
      $('#programmCode').html('<input type="text" id="pCode" class="form-control" value="' + pCode +'"' + 'readonly />');
      program=objectAtPaticularIndex.programName;
      program_id=objectAtPaticularIndex.program_id;
      $('#programsList').html('<option  value="'+ program_id +'">' + program + '</option>');
      subLedger=objectAtPaticularIndex.subLedgerName;
      subLedger_id=objectAtPaticularIndex.subLedger_id;
      if(subLedger && subLedger_id)
      {
       $('#subLedgerList').html('<option  value="'+ subLedger_id +'">' + subLedger + '</option>');
     }
     else 
     {
      $('#subLedgerList').html('<option  value=""></option>');
    }


    donar=objectAtPaticularIndex.donarName;
    donar_id=objectAtPaticularIndex.donar_id;

    if(donar && donar_id)
    {
     console.log(donar);
     $('#donerList').html('<option  value="'+ donar_id +'">' + donar + '</option>');

   }
   else 
   {
    $('#donerList').html('<option  value=""></option>');
  }

  ledgerType=objectAtPaticularIndex.ledgerType;

  if(ledgerType)
  {
    $('#ledgerType').html('<option  value="'+ ledgerType +'">' + ledgerType + '</option>');
  }
  else 
  {
    $('#ledgerType').html('<option  value=""></option>');
  }
  description =objectAtPaticularIndex.description;
  $('#description').val(description);
  chequeNo=objectAtPaticularIndex.chequeNo;
  if(chequeNo)
  { 

    $('#chequeNo').val(chequeNo);

  }
  else 
  {
    chequeNo='';
    console.log("chequeNo is set to empty");

  }
  var debitAmount=objectAtPaticularIndex.debitAmount;
  if(debitAmount)
  { 
   $('#debitAmount').val(debitAmount);
   $('#creditAmount').val('');
  }
  else 
  {
    debitAmount='';
    console.log('debitAmount is set to emtpy');
  }

  var creditAmount=objectAtPaticularIndex.creditAmount;
  if(creditAmount)
  {

    $('#creditAmount').val(creditAmount);
     $('#debitAmount').val('');

  }
  else 
  {
    creditAmount='';
    console.log('creditAmout is set to empty');

  }

  $("#toggleButton").html('<span   onClick="updateTheItemInTheArray(' + index +')' + '"' + 'class="btn btn-success "   style=" padding:5px;margin:5px;width:70px;font-size:18px;">Update</span></td>');

  }



  function updateTheItemInTheArray(index)
  {

   ProcessDataandInsertIntoArray(index);
   $("#toggleButton").html('<span   onClick=" ProcessDataandInsertIntoArray()" class="btn btn-success "   style=" padding:5px;margin:5px;width:70px;font-size:18px;">Add</span></td>');
    whenJournalTypeIsSelected(reqiureTotriggerwhenUpdateisDone);

   }

   function hideMessages() {
   
  }
 
 
 
 
$(document).ready(function ()  
{   
    $('#glTrans').submit(function() {
       
    if ($.trim($("#journalNo").val()) === "" || $.trim($("#datepicker").val()) === "" || $.trim($("#journalType").val()) === "" || $.trim($("#comment").val()) === ""|| $.trim($("#summary").val()) === "") {
       var  msg= '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error !</strong> Plese fill all fields properly</div>';
    $('#errorMessages').html(msg);
    hideMessages();
    return false;
    }else{
       
        var JSONObject = JSON.stringify(allInsertItemsinVouture);
        var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "mydata").attr("id", "myDataInp").val(JSONObject);
$('#glTrans').append($(input));
       $('#glTrans').submit();
    }
});
    
    
    
    
    
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

});

 $( function() {
  $( "#datepicker" ).datepicker({
   maxDate: dateToday,
  dateFormat: 'mm/dd/yy' , 
  timeFormat: 'hh:mm tt',
   dateonly:true

 });
} );