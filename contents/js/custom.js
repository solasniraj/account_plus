
          var debitCreditDifference="";
          var DebitTotal="";
          var creditTotal="";
          var dateToday = new Date(); 
          var baseUrl='http://localhost/account_plus/';
          var output="";
          var allInsertItemsinVouture=[];
          var objectToStroCurrentData;
          var incrementCounterForItem=0;
          var viewToDisplayInTable ='';



          function  whenJournalTypeIsSelected(selectedType)
          {

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

      
            function numberWithCommas(x) {
              var parts = x.toString().split(".");
              parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              return parts.join(".");
            }

            function numberWithOutCommas(x)
            {    
                 if(x.toString().length <= 3)
                 {
          
                  return  parseInt(x);
                 }
                 else
                 { 
                  var withoutComma=x.replace(/[^0-9]/g, '');
                  return parseInt(withoutComma);
                 }
          


            }


            function checkDiffernceBetDebitAndCredit($debitAmount,$creditAmount)
            {
             if($debitAmount == $creditAmount)
             {
              debitCreditDifference=0.0;
              activateCommentAndSummerField("activate");
              $("#creditGreater").val(0.0);
              $("#debitGreater").val(0.0);
            }
            else  if($debitAmount >$creditAmount)
            {

              debitCreditDifference=$debitAmount -$creditAmount;
              $("#debitGreater").val(debitCreditDifference);
              $("#creditGreater").val(0.0);
              activateCommentAndSummerField("adctivate");

            }
            else
            {
              debitCreditDifference=$creditAmount -$debitAmount;
              $("#debitGreater").val(0.0);
              $("#creditGreater").val(debitCreditDifference);
              activateCommentAndSummerField("adctivate");
            }

          }


          function activateCommentAndSummerField(type)
          {

            if(type=="activate")
            {

              $("#comment,#summery").attr("disabled", false); 
              $("#submitTheForm").prop('disabled', false);
            }
            else
            {
             $("#comment,#summery").attr("disabled", true); 
             $("#submitTheForm").prop('disabled', true);

           }
          }

          function InsertIntoTheOurArray(objectToInsertArray)
          {

           allInsertItemsinVouture.push(objectToInsertArray);
           console.log('push is succesfully');
           viewTheItemsInArray();
            


          }

          function viewTheItemsInArray()
          {
            if(allInsertItemsinVouture.length >0)
            {

            for (i = 0; i<allInsertItemsinVouture.length; i++) 
               {
                  // console.log(allInsertItemsinVouture[i]);
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
                  var indexNumber=objestToLoop.indexNumber;

           var myCustomViewToEnter ='<tr>' +
           '<td>' + pCode + '</td>' +
           '<td>' + program + '</td>' +
           '<td>' + subLedger + '</td>' +
           '<td>' + ledgerType + '</td>' +
           '<td>' + donar + '</td>' + 
           '<td colspan="2">' + description + '</td>' +
           '<td>' + debitAmount + '</td>' +
           '<td>' + 0.00 + '</td>' +
           '<td>' + chequeNo + '</td>' +
           '<td colspan="2" style="width:200px" ><button type="text" class="btn btn-success btn-sm">Edit</button> / <button type="text" onClick="delteItemFromArray(' + indexNumber +')' + '"' + 'class="btn btn-danger btn-sm">Delete</button></td></tr>';
        
              var viewToDisplayInTable= viewToDisplayInTable + myCustomViewToEnter;
                
               }
      
              console.log("loop is terminated");
              $("#workingWithObjectData").html(viewToDisplayInTable);
              viewToDisplayInTable= "";
              myCustomViewToEnter="";
              return true;
            }
            else 
            {
              console.log("array is empty");
            }

          }




         function delteItemFromArray(index)
         {

           if (index > -1) 
           {
            $("#workingWithObjectData").html("");
 
            allInsertItemsinVouture.splice(index, 1); 
            if(viewTheItemsInArray())
             {
              console.log("item is deleted");
             }
             else {
              console.log('item is not delted');
              }

           } 
           else 
           {
            alert("error in process");
           }              

         }























          $(document).ready(function ()  
          {
           activateCommentAndSummerField("deactivate");
           $("#submitCurrentData").click(function(event)
           {

            var view;
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
           return false;
          }
          else if((debitAmount && (creditAmount == null || creditAmount == ""))) 
          {
           msg='';
           $('#errorMessages').html(msg);
           // view='<tr>' +
           // '<td>' + pCode + '</td>' +
           // '<td>' + program + '</td>' +
           // '<td>' + subLedger + '</td>' +
           // '<td>' + ledgerType + '</td>' +
           // '<td>' + donar + '</td>' +
           // '<td colspan="2">' + description + '</td>' +
           // '<td>' + debitAmount + '</td>' +
           // '<td>' + 0.00 + '</td>' +
           // '<td>' + chequeNo + '</td>' +
           // '<td colspan="2" style="width:200px" ><button type="text" class="btn btn-success btn-sm">Edit</button> / <button type="text" class="btn btn-danger btn-sm">Delete</button></td></tr>';
          
            var a = numberWithOutCommas($("#totalDebit").text());
            DebitTotal = a + numberWithOutCommas(debitAmount);
            var displayDebitTotal=numberWithCommas(DebitTotal);
            $("#totalDebit").html(displayDebitTotal); 
            // $("table tbody#lastId").prepend(view);
            var debitInsertValue=numberWithOutCommas(debitAmount);
            creditInsertValue="";
            objectToStroCurrentData={indexNumber:incrementCounterForItem,pCode:pCode, programName:program, program_id:program_id, subLedgerName:subLedger ,subLedger_id:subLedger_id, donarName:donar, donar_id:donar_id, ledgerType:ledgerType, donar:donar_id, description:description, debitAmount:debitInsertValue, creditAmount:creditInsertValue, chequeNo:chequeNo};
            incrementCounterForItem = incrementCounterForItem +1;
            console.log(objectToStroCurrentData);

            InsertIntoTheOurArray(objectToStroCurrentData);

            description = $('#description').val("");
            debitAmount = $('#debitAmount').val("");
            creditAmount = $('#creditAmount').val("");
            chequeNo = $('#chequeNo').val("");
            checkDiffernceBetDebitAndCredit(DebitTotal,creditTotal);


             }

             else if((creditAmount && (debitAmount == null || debitAmount == ""))) 
             {
               msg='';
               // $('#errorMessages').html(msg);
               // view='<tr>' +
               // '<td>' + pCode + '</td>' +
               // '<td>' + program + '</td>' +
               // '<td>' + subLedger + '</td>' +
               // '<td>' + ledgerType + '</td>' +
               // '<td>' + donar + '</td>' +
               // '<td colspan="2">' + description + '</td>' +
               // '<td>' + 0.00 + '</td>' +
               // '<td>' + creditAmount + '</td>' +
               // '<td>' + chequeNo + '</td>' +
               // '<td colspan="2" style="width:200px" ><button type="text" class="btn btn-success btn-sm">Edit</button> / <button type="text" class="btn btn-danger btn-sm">Delete</button></td></tr>';
               
               var a = numberWithOutCommas($("#totalCredit").text());
               creditTotal = a + numberWithOutCommas(creditAmount);
               var displayCreditTotal=numberWithCommas(creditAmount);
               $("#totalCredit").html(displayCreditTotal); 
               // $("table tbody#lastId").prepend(view);
               var creditInsertValue=numberWithOutCommas(creditAmount);
               debitInsertValue="";
                objectToStroCurrentData={indexNumber:incrementCounterForItem,pCode:pCode, programName:program, program_id:program_id, subLedgerName:subLedger ,subLedger_id:subLedger_id, donarName:donar, donar_id:donar_id, ledgerType:ledgerType, donar:donar_id, description:description, debitAmount:debitInsertValue, creditAmount:creditInsertValue, chequeNo:chequeNo};
               incrementCounterForItem = incrementCounterForItem +1;
               console.log(objectToStroCurrentData);

               InsertIntoTheOurArray(objectToStroCurrentData);
               description = $('#description').val("");
               debitAmount = $('#debitAmount').val("");
               creditAmount = $('#creditAmount').val("");
               chequeNo = $('#chequeNo').val("");
               checkDiffernceBetDebitAndCredit(DebitTotal,creditTotal)

             }
             else 
             {     

              var  msg= '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Plese Enter Either Debit Amount OR Credit Amount</div>';
              $('#errorMessages').html(msg);
              return false;
            }

          });


            
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

