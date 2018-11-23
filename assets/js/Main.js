var p_id = null;

var count = 1;
var html = '<div id="container'+count+'" class="container x"><div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Ime:</label><div class="col-sm-10"><input type="text" class="form-control" id="name" name="name[]" placeholder="Ime osiguranika"></div></div><div class="form-group row"><label for="surname"class="col-sm-2 col-form-label">Prezime:</label><div class="col-sm-10"><input type="text" class="form-control" id="surname" name="surname[]" placeholder="Prezime osiguranika"></div></div><div class="form-group row"><label for="email" class="col-sm-2 col-form-label">Email:</label><div class="col-sm-10"><input type="text" class="form-control" id="email" name="email[]" placeholder="Email osiguranika"></div></div><div class="form-group row"><label for="date" class="col-sm-2 col-form-label">Datum rodjenja:</label><div class="col-sm-10"><input type="date" class="form-control" id="date" name="date[]"placeholder="Datum rodjenja osiguranika"></div></div><button type="button" id="remove" class="btn btn-danger float-sm-right" onclick="x('+count+')">Ukloni Osiguranika</button><br><br><br></div>';


$(document).ready(function(){

    // for date
    var minDate = new Date();
    $("#from").datepicker({
        showAnim: 'drop',
        numberOfMonth: 1,
        minDate: minDate,
        dataFormat: 'dd/mm/yy',
        onClose: function(selectedDate){
            $('#to').datepicker("option", "minDate", selectedDate);
        }
    });

    $("#to").datepicker({
        showAnim: 'drop',
        numberOfMonth: 1,
        minDate: minDate,
        dataFormat: 'dd/mm/yy',
        onClose: function(selectedDate){
            $('#fore').datepicker("option", "minDate", selectedDate);

            var date1 = new Date($('#from').val());
            var date2 = new Date($('#to').val());

            var timeDiff = date2.getTime() - date1.getTime();

            var millSecInSec = 1000;
            var secInOneHover = 3600;
            var hInDay = 24;

            var daysDiff = timeDiff / (millSecInSec * secInOneHover * hInDay);

            $(".date").after( "<p>Vreme trajanje polise je: <b>" + daysDiff + " dana</b>!</p>" );

        }
    });

    // Add row to the form
    $("#addUser").click(function(e){
        $(html).insertBefore("#addBtn");
        count++;
        var html1 = '<div id="container'+count+'" class="container x"><div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Ime:</label><div class="col-sm-10"><input type="text" class="form-control" id="name" name="name[]" placeholder="Ime osiguranika"></div></div><div class="form-group row"><label for="surname"class="col-sm-2 col-form-label">Prezime:</label><div class="col-sm-10"><input type="text" class="form-control" id="surname" name="surname[]" placeholder="Prezime osiguranika"></div></div><div class="form-group row"><label for="email" class="col-sm-2 col-form-label">Email:</label><div class="col-sm-10"><input type="text" class="form-control" id="email" name="email[]" placeholder="Email osiguranika"></div></div><div class="form-group row"><label for="date" class="col-sm-2 col-form-label">Datum rodjenja:</label><div class="col-sm-10"><input type="date" class="form-control" id="date" name="date[]"placeholder="Datum rodjenja osiguranika"></div></div><button type="button" id="remove" class="btn btn-danger float-sm-right" onclick="x('+count+')">Ukloni Osiguranika</button><br><br><br></div>';
        html = html1;
    });


    // save users for user police
    $('#addUsers').click(function(){       
        $.ajax({  
             url:"form/police/users/"+p_id,  
             method:"POST",  
             data:$('#formUsers').serialize(),  
             success:function(response)  
             {  
                response = response.substring(0, response.indexOf('<'));
                res = JSON.parse(response)['data']['users'];

                var newUsers = '';
                
                $.each(res, function(key, value){
                    newUsers += '<tr class="tr'+p_id+' table-primary">';
                    newUsers += '<td>#</td>';
                    newUsers += '<td>' + value.name +' '+ value.surname + '</td>';
                    newUsers += '<td>' + value.email + '</td>';
                    newUsers += '<td>' + value.born + '</td>';
                    newUsers += '<tr>';
                });
        
                $('#table'+p_id).append(newUsers);

                $('#addO').modal('hide');
             }  
        }); 
   }); 








});

// remove row form row
function x(id){
    $("#container"+id).remove();
}

function getInsured(method, id){
    return $.ajax({
        url: 'paragraf/app/controllers/MainController.php',
        type: 'POST',
        data: {method: method, policie_id: id}
    });
}

function toggle(id){

    p_id = id;
    var policie_id = id;

    // show or hide table
    $('#row'+id).toggleClass("hideExtra");
    $('#main'+id).toggleClass("hideExtra");

    //get insureds users for given policie ID
    ajax = getInsured('getUsersForPolice', policie_id);
    ajax.done(processData);
    ajax.fail(function(){
        alert("Faild to get insured users!");
    });
}

function processData(response){
    response = response.substring(0, response.indexOf('<!'));
    res = JSON.parse(response)['data']['users'];

    var users = '';

    var exists = document.getElementsByClassName("tr"+p_id);
    
    if(exists.length == 0){
        $.each(res, function(key, value){
            users += '<tr class="tr'+p_id+'">';
            users += '<td>' + value.insured_id + '</td>';
            users += '<td>' + value.name + '</td>';
            users += '<td>' + value.insured_email + '</td>';
            users += '<td>' + value.born + '</td>';
            users += '<tr>';
        });

        $('#table'+p_id).append(users);
    }
    
}
