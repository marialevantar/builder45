function print_today() {
  // ***********************************************
  // AUTHOR: WWW.CGISCRIPT.NET, LLC
  // URL: http://www.cgiscript.net
  // Use the script, just leave this message intact.
  // Download your FREE CGI/Perl Scripts today!
  // ( http://www.cgiscript.net/scripts.htm )
  // ***********************************************
  var now = new Date();
  var months = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
  var date = ((now.getDate()<10) ? "0" : "")+ now.getDate();
  function fourdigits(number) {
    return (number < 1000) ? number + 1900 : number;
  }
  var today =  months[now.getMonth()] + " " + date + ", " + (fourdigits(now.getYear()));
  return today;
}

// from http://www.mediacollege.com/internet/javascript/number/round.html
function roundNumber(number,decimals) {
  var decimals = 0;
  var newString;// The new rounded number
  decimals = Number(decimals);
  if (decimals < 1) {
    newString = (Math.round(number)).toString();
  } else {
    var numString = number.toString();
    if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
      numString += ".";// give it one at the end
    }
    var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
    var d1 = Number(numString.substring(cutoff,cutoff+1));// The value of the last decimal place that we'll end up with
    var d2 = Number(numString.substring(cutoff+1,cutoff+2));// The next decimal, after the last one we want
    if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
      if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
        while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
          if (d1 != ".") {
            cutoff -= 1;
            d1 = Number(numString.substring(cutoff,cutoff+1));
          } else {
            cutoff -= 1;
          }
        }
      }
      d1 += 1;
    }
    if (d1 == 10) {
      numString = numString.substring(0, numString.lastIndexOf("."));
      var roundedNum = Number(numString) + 1;
      newString = roundedNum.toString() + '.';
    } else {
      newString = numString.substring(0,cutoff) + d1.toString();
    }
  }
  if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
    newString += "";
  }
  var decs = (newString.substring(newString.lastIndexOf(".")+1)).length;
  for(var i=0;i<decimals-decs;i++) newString += "0";
  //var newNumber = Number(newString);// make it a number if you like
  return newString; // Output the result to the form field (change for your purposes)
}

function update_total() {
  var total = 0;
  $('.price').each(function(i){
    price = $(this).html().replace("Rs ","");
    if (!isNaN(price)) total += Number(price);
  });

  total = roundNumber(total,2);

  $('#subtotal').html("Rs "+total);
  $('#total').html("Rs "+total);
  $('#totaltext').val(total);

  update_balance();
}

function update_balance() {
  var due = $("#total").html().replace("$","") - $("#paid").val().replace("$","");
  due = roundNumber(due,2);

  $('.due').html("$"+due);
}

function update_price() {
  var row = $(this).parents('.item-row');
  var price = row.find('.totalvalue').val().replace("$","") * row.find('.qty').val();
  price = roundNumber(price,2);
  isNaN(price) ? row.find('.price').html("N/A") : row.find('.price').html("Rs "+price);

  update_total();
}

function update_total_value() {
  var row = $(this).parents('.item-row');
  var price = parseFloat(row.find('.cost').val()) + parseFloat(row.find('.tax').val());
  price = roundNumber(price,2);
  isNaN(price) ? row.find('.totalvalue').html(row.find('.cost').val()) : row.find('.totalvalue').html(price);

  var totalvalue = row.find('.totalvalue').val().replace("$","") * row.find('.qty').val();
  totalvalue = roundNumber(totalvalue,2);
  isNaN(totalvalue) ? row.find('.price').html("N/A") : row.find('.price').html("Rs "+totalvalue);

  update_total();
}


function bind() {
  $(".cost").blur(update_total_value);
  $(".tax").blur(update_total_value);
  $(".totalvalue").blur(update_price);
  $(".qty").blur(update_price);
}



$(document).ready(function() {

  $('input').click(function(){
    $(this).select();
  });

  $("#paid").blur(update_balance);

  $("#addrow").click(function(){
      var sku= $("#sku").val();
      var siteurl = $("#siteurl").val();
     $.ajax({
    type: "POST",
    url: siteurl,
    dataType: 'json',
    data: {"sku":sku},
    success: function(data){
        var itemId=data.boutique_item_id;
        var itemName=data.boutique_item_name;
        var itemDesc=data.boutique_item_desc;
        var itemHSN=data.boutique_item_hsn;

        var unitPrice=data.boutique_item_unit_price;
        var maxQantity = data.boutique_item_total_remaining;
        if(data.boutique_tax_rate){
          var taxPrice = roundNumber(data.boutique_item_unit_price*data.boutique_tax_rate/100,2);
        }
        else{
          var taxPrice = 0;
        } 

        var totalPrice = roundNumber(parseFloat(unitPrice) + parseFloat(taxPrice),2);
        $("#sku").val('');
      
        //alert(data.value2);
        if( mysessionvar == 21 || mysessionvar == 30){
        $(".item-row:last").after('<tr class="item-row"><td class="item-name"><div class="delete-wpr"><input type="hidden" name="boutique_item_id[]" value="'+itemId+'"><textarea name="boutique_sale_item_name[]">'+itemName+'</textarea><a class="delete" href="javascript:void(0);" title="Remove row">X</a></div></td><td class="boutique_sale_item_code"><textarea name="boutique_sale_item_hsn[]">'+itemHSN+'</textarea></td><td class="description"><textarea name="boutique_sale_item_desc[]">'+itemDesc+'</textarea></td><td><textarea name="boutique_sale_item_unitprice[]" class="cost">'+unitPrice+'</textarea></td><td><textarea name="boutique_sale_item_tax[]" class="tax">'+taxPrice+'</textarea></td><td><textarea name="boutique_sale_item_totalunitprice[]" class="totalvalue">'+totalPrice+'</textarea></td><td><textarea name="boutique_item_total_quantity[]" class="qty" max="'+maxQantity+'">1</textarea></td><td><span class="price">Rs '+totalPrice+'</span></td></tr>');
        }
        else{
            $(".item-row:last").after('<tr class="item-row"><td class="item-name"><div class="delete-wpr"><input type="hidden" name="boutique_item_id[]" value="'+itemId+'"><textarea name="boutique_sale_item_name[]">'+itemName+'</textarea><a class="delete" href="javascript:void(0);" title="Remove row">X</a></div></td><td class="description"><textarea name="boutique_sale_item_desc[]">'+itemDesc+'</textarea></td><td><textarea name="boutique_sale_item_unitprice[]" class="cost">'+unitPrice+'</textarea></td><td><textarea name="boutique_sale_item_tax[]" class="tax">'+taxPrice+'</textarea></td><td><textarea name="boutique_sale_item_totalunitprice[]" class="totalvalue">'+totalPrice+'</textarea></td><td><textarea name="boutique_item_total_quantity[]" class="qty" max="'+maxQantity+'">1</textarea></td><td><span class="price">Rs '+totalPrice+'</span></td></tr>');
          }

        $("#total").html("Rs "+ (parseFloat(totalPrice)+parseFloat($("#total").html().replace("Rs ",""))));
        $("#totaltext").val($("#total").html().replace("Rs ",""));
        if ($(".delete").length > 0) $(".delete").show();
          bind();
        }
 });




  });


$("#addcrow").click(function(){
     if( mysessionvar == 21 || mysessionvar == 30){
     $(".item-row:last").after('<tr class="item-row"><td class="item-name"><div class="delete-wpr"><input type="hidden" name="boutique_item_id[]" value="0"><textarea name="boutique_sale_item_name[]"></textarea><a class="delete" href="javascript:void(0);" title="Remove row">X</a></div></td><td class="boutique_sale_item_hsn"><textarea name="boutique_sale_item_hsn[]"></textarea></td><td class="description"><textarea name="boutique_sale_item_desc[]"></textarea></td><td><textarea name="boutique_sale_item_unitprice[]" class="cost"></textarea></td><td><textarea name="boutique_sale_item_tax[]" class="tax"></textarea></td><td><textarea name="boutique_sale_item_totalunitprice[]" class="totalvalue"></textarea></td><td><textarea name="boutique_item_total_quantity[]" class="qty">1</textarea></td><td><span class="price"></span></td></tr>');
     }
     else{
      $(".item-row:last").after('<tr class="item-row"><td class="item-name"><div class="delete-wpr"><input type="hidden" name="boutique_item_id[]" value="0"><textarea name="boutique_sale_item_name[]"></textarea><a class="delete" href="javascript:void(0);" title="Remove row">X</a></div></td><td class="description"><textarea name="boutique_sale_item_desc[]"></textarea></td><td><textarea name="boutique_sale_item_unitprice[]" class="cost"></textarea></td><td><textarea name="boutique_sale_item_tax[]" class="tax"></textarea></td><td><textarea name="boutique_sale_item_totalunitprice[]" class="totalvalue"></textarea></td><td><textarea name="boutique_item_total_quantity[]" class="qty">1</textarea></td><td><span class="price"></span></td></tr>');
      }
     bind();
 });

  bind();

  $(document).on("click", "a.delete" , function() {
    $(this).parents('.item-row').remove();
    update_total();
    if ($(".delete").length < 2) $(".delete").hide();
  });


  $("#cancel-logo").click(function(){
    $("#logo").removeClass('edit');
  });
  $("#delete-logo").click(function(){
    $("#logo").remove();
  });
  $("#change-logo").click(function(){
    $("#logo").addClass('edit');
    $("#imageloc").val($("#image").attr('src'));
    $("#image").select();
  });
  $("#save-logo").click(function(){
    $("#image").attr('src',$("#imageloc").val());
    $("#logo").removeClass('edit');
  });

  $("#date").val(print_today());


  $(":input").keypress(function(event){
    if (event.which == '10' || event.which == '13') {
        event.preventDefault();
    }
});
  
});

