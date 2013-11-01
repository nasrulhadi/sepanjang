$(document).ready(function(){
    
    // select voucher
    $('.form-input-voucher').change(function(){
        var value = $('.form-input-voucher').val();
        if(value != ""){
            $('.form-input-provider').fadeIn(600).attr('style', 'display:block');
        }else{
            $('.form-input-provider, .form-input-nominal').fadeOut(500);
            $('.form-input-nomor, .form-input-bank, #tombolProses').attr('disabled','disabled').removeAttr("checked");
            $('.form-input-nomor, .form-input-terakhir').val('').html('');
        }
    });


    // select provider
    $('.form-input-provider').change(function(){
        var value = $('.form-input-providers').val();
        if(value != ""){
            $('.form-input-nominal').fadeIn(600).attr('style', 'display:block');
        }else{
            $('.form-input-nominal').fadeOut(500);
            $('.form-input-nomor, .form-input-bank, #tombolProses').attr('disabled','disabled').removeAttr("checked");
            $('.form-input-nomor, .form-input-terakhir').val('').html('');
        }
    });


    // select nominal
    $('.form-input-nominal').change(function(){
        var value = $('.form-input-nominals').val();
        if(value != "empty"){
            $('.form-input-nomor').removeAttr('disabled').focus();
        }else{
            $('.form-input-nomor, .form-input-bank, #tombolProses').attr('disabled','disabled').removeAttr("checked");
            $('.form-input-nomor, .form-input-terakhir').val('').html('');
        }
    });


    // random warna tombol proses
    Array.prototype.random = function (length) {
        return this[Math.floor((Math.random()*length))];
    }
    var colorBase = ['btn btn-success|#5cb85c', 'btn btn-primary|#428bca', 'btn btn-info|#5bc0de', 'btn btn-warning|#f0ad4e', 'btn btn-danger|#d9534f'];
    var colorSplit = colorBase.random(colorBase.length);
    var splitNow = colorSplit.split("|");
    $('#tombolProses, #tombolTerimaKasih, #tombolCekStatus').attr('class', splitNow[0]);
    $('.form-color-random').attr('style', "color:"+splitNow[1]);


    // validasi input nomor angka
    $('#nomor').keyup(function () {     
        this.value = this.value.replace(/[^0-9\.]/g,'');
        if(this.value.length >= 8){
            $('.form-input-terakhir').html('Terakhir, ');
            $('.form-input-bank').removeAttr('disabled');
        }else{
            $('.form-input-bank, #tombolProses').attr('disabled','disabled').removeAttr("checked");
        }
    });


    // aktifkan tombol proses
    $('.form-input-bank').change(function () {
        $('#tombolProses').removeAttr('disabled');
    });


    // popover informasi gambar backgroud
    $('.get-popover-bg').popover();


    // popover copyright
    $('.get-popover-copy').popover({
        placement : 'top',
        content : '<p><?php echo json_decode(Options::GetOptions("company_info"))->{"value"}; ?></p>',
        trigger : 'hover',
        delay: { show: 300, hide: 100 },
        container : 'body',
        html : true
    });               


    // dropdown navbar
    $('.navbar .dropdown').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(150).slideDown();
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp()
    });


    // contoh proses demo 
    $('#tombolProses').click(function(){
       $('#tombolProses').button('loading');
       var startTimeProses = new Date().getTime();
       var setTimerProses = setInterval(function(){
        $('#step-1').fadeOut(500, function(){
            $('#step-2').fadeIn(600).attr('style', 'display:block');
        });
        if(new Date().getTime() - startTimeProses > 2000){
            clearInterval(setTimerProses);
            return;
        }
    }, 3000);
   });

    $('#tombolTerimaKasih').click(function(){                     
       $('#tombolTerimaKasih').button('loading');
       var startTimeCek = new Date().getTime();
       var setTimerCek = setInterval(function(){
        $('#step-2').fadeOut(500, function(){
            $('#step-3').fadeIn(600).attr('style', 'display:block');   
            $('#step-2').attr('style', 'display:none');                             
        });

        if(new Date().getTime() - startTimeCek > 2000){
            clearInterval(setTimerCek);
            return;
        }

    }, 2000);
   });


    // modal hapus order
    $('#hapusOrder').modal({
        show : false,
    });

});