<?php Header("Content-Type: application/x-javascript; charset=UTF-8"); ?>

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
    /* $('.navbar .dropdown').click(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(150).slideDown();
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp()
    }); */


    // proses tahap 1 (order)
    var step1;
    $("#step1-form").submit(function(event){
        
        if(step1){
            step1.abort();
        }
        
        var $form = $(this);
        var $inputs = $form.find("input, select");
        var serializedData = $form.serialize();
        var msgerror = 'Maaf, Terjadi kesalahan pada saat proses transaksi. Silahkan ulangi lagi';

        $inputs.prop("disabled", true);
        $('#tombolProses').button('loading');

        step1 = $.ajax({
            url: window.location.pathname+"/node/step1",
            type: "post",
            data: serializedData
        });

        step1.done(function (response, textStatus, jqXHR){
            if(response == "error1" || response == "error2" ){
                $('#errormsg').text(msgerror)
                $('#steperror').modal({
                    show : true,
                });
            }else{
                setTimeout(function(){

                    var splitStep1 = response.split("_");
                    $('#tombolTerimaKasih').attr('disabled','disabled');
                    $('#counter').val(splitStep1[0]);
                    $('#bantuHapus').attr('href', window.location.pathname+"node/hapus/order/"+splitStep1[0]+"/hash/"+splitStep1[2]+"/token/"+splitStep1[7]);
                    $('#tagihanStep2').text(splitStep1[2]);
                    $('#operatorStep2, #operatorStep3').text(splitStep1[3]+" "+splitStep1[1]);
                    $('#nomorStep2, #nomorStep3').text(splitStep1[4]);
                    $('#voucherStep2, #voucherStep3').text(splitStep1[5]);
                    $('#statusOrder').text(splitStep1[8]);
                    $('#bank_'+splitStep1[6]).attr('style', 'display:block');

                    $('#step-1').fadeOut(500, function(){
                        $('#step-2').fadeIn(600).attr('style', 'display:block');
                    });

                }, 3000);

                setTimeout(function(){
                    $('#tombolTerimaKasih').removeAttr('disabled');
                }, 20000);
            }
        });

        step1.fail(function (jqXHR, textStatus, errorThrown){
            $('#errormsg').text(msgerror)
            $('#steperror').modal({
                show : true,
            });
        });

        step1.always(function () {
            //$inputs.prop("disabled", false);
        });

        event.preventDefault();
    }); 


    // proses tahap 2 (menunggu pembayaran)
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


   // proses tahap 3 (periksa status pembayaran)
   $('#tombolCekStatus').click(function(){                     
        $('#tombolCekStatus').button('loading');
        $('#statusOrder').text('...');       
        $.ajax({
            url: window.location.pathname+"/node/step3",
            type: "post",
            data: { count: $('#counter').val() },
            beforeSend:function(){
                $('#statusOrder').html('<div class="loading"><img src="'+window.location.pathname+'/themes/sepanjang/img/load.gif" alt="Loading..." />');
            },
            success:function(data){
                setTimeout(function(){
                    $('#statusOrder').empty();
                    $('#statusOrder').text(data);
                    $('#tombolCekStatus').button('reset');
                }, 2000);
            },
            error:function(){
                $('#statusOrder').text('error');
            }
        });
   });


    // modal hapus order
    $('#hapusOrder').modal({
        show : false,
    });


    // filter input cuma angka
    $('#cariNo').keyup(function () {     
        this.value = this.value.replace(/[^0-9\.]/g,'');
        if(this.value.length >= 8){
            $('#tombolStatusOrder').removeAttr('disabled');
        }else{
            $('#tombolStatusOrder').attr('disabled','disabled');
        }
    });


    // contoh proses buat demo 
    $('#tombolStatusOrder').click(function(){
         $('#tombolStatusOrder').button('loading');
         var startTimeProses = new Date().getTime();
         var setTimerProses = setInterval(function(){
            $('#tableResult').fadeIn(400).removeAttr('style');
            $('#tombolStatusOrder').button('reset');
            if(new Date().getTime() - startTimeProses > 1000){
                clearInterval(setTimerProses);
                return;
            }
        }, 2000);
    });

});