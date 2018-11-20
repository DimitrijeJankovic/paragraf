function changeType(){
    var type = $('#tip > option:selected').val();
    
    if(type == 1){
        $("#pojedinacno").show();
        $("#grupno").hide();
    }else if (type == 2){
        $("#pojedinacno").hide();
        $("#grupno").show();
    }else{
        $("#pojedinacno").hide();
        $("#grupno").hide();
    }
}

function validateForm(){
    var type = $('#tip > option:selected').val();
    var form_ok = true;
    
    //if(type == 'Tip Polise'){
        //$("#tip").parent('div').parent('.form-group.row').addClass('error');
        //form_ok = false;
    //}
    
    return form_ok;
}

function init(){
    changeType();
    validateForm();
}

$(init);

var html = '<div class="container x"><div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Ime:</label><div class="col-sm-10"><input type="text" class="form-control" id="name" name="name[]" placeholder="Ime osiguranika"></div></div><div class="form-group row"><label for="surname"class="col-sm-2 col-form-label">Prezime:</label><div class="col-sm-10"><input type="text" class="form-control" id="surname" name="surname[]" placeholder="Prezime osiguranika"></div></div><div class="form-group row"><label for="email" class="col-sm-2 col-form-label">Email:</label><div class="col-sm-10"><input type="text" class="form-control" id="email" name="email[]" placeholder="Email osiguranika"></div></div><div class="form-group row"><label for="date" class="col-sm-2 col-form-label">Datum rodjenja:</label><div class="col-sm-10"><input type="date" class="form-control" id="date" name="date[]"placeholder="Datum rodjenja osiguranika"></div></div><button type="button" id="remove" class="btn btn-danger float-sm-right">Ukloni Osiguranika</button><br><br><br></div>';
var count = 1;

// Add rows to the form
$(document).ready(function(e){
   $("#add").click(function(e){
       $(html).insertBefore("#addBtn");
       count++;
   });
});

// Remove rows from the form
$(".container").on('click', '#remove', function(e){
   $(this).parent('div').remove();
   count--;
});