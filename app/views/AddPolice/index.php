<?php require_once 'app/views/_global/header.php'; ?>
<?php require_once 'app/views/_global/navbar.php'; ?>

<div  class="container">
    <div class="form">
        
        <form method="POST" action="<?php echo Configuration::BASE; ?>form/" class="form-horizontal form" onsubmit="return validateForm();">
    
            <div class="form-group row has-error">
                <label for="carrier" class="col-sm-2 col-form-label">Nosilac osiguranja:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="carrier" name="carrier" placeholder="Ime i Prezime" required>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="tel"class="col-sm-2 col-form-label">Telefon:</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="tel" name="tel" placeholder="Telefon nosioca osiguranja (+381601479990)" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email"class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="c_email" placeholder="Email nosioca osiguranja" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="from"class="col-sm-2 col-form-label">From:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="from" name="from" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="to"class="col-sm-2 col-form-label">To:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="to" name="to" required>
                </div>
            </div>
           
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="tip">Tip polise:</label>
                <div class="col-sm-10">
                    <select required onchange="changeType()" id="tip" name="tip" class="form-control">
                        <option selected disabled>Tip Polise</option>
                        <option value='1'>Pojedinacno</option>
                        <option value='2'>Grupno</option>
                    </select>
                </div>
            </div>
            
            <div id="pojedinacno">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Ime:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name_o" placeholder="Ime osiguranika">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname"class="col-sm-2 col-form-label">Prezime:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="surname" name="surname_o" placeholder="Prezime osiguranika">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email_o" placeholder="Email osiguranika">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label">Datum rodjenja:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date_o" placeholder="Datum rodjenja osiguranika">
                    </div>
                </div>
            </div>
            
            <div id="grupno">
                <div id="addBtn" class="container">
                    <div class="row">
                        <button type="button" id="add" class="btn btn-primary col-sm-12">Dodaj Osiguranika</button>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" id="add" class="btn btn-primary">Sacuvaj</button>

        </form>
        <?php if(isset($DATA['message'])): ?>
            <p><?php echo htmlspecialchars($DATA['message']); ?></p>
        <?php endif; ?>
    </div>
</div>




<?php require_once 'app/views/_global/footer.php'; ?>



























































    