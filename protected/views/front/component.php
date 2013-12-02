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

    $('.get-popover-social').popover();               


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
            url: "<?php echo Yii::app()->baseUrl; ?>/node/step1",
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
                    var ubahstat = ubahstatus(splitStep1[8]);
                    var splitStatus = ubahstat.split("_");

                    $('#tombolTerimaKasih').attr('disabled','disabled');
                    $('#counter').val(splitStep1[0]);
                    $('#bantuHapus').attr('href', "<?php echo Yii::app()->baseUrl; ?>/node/hapus/order/"+splitStep1[0]+"/hash/"+splitStep1[2]+"/token/"+splitStep1[7]);
                    $('#tagihanStep2').text(splitStep1[2]);
                    $('#operatorStep2, #operatorStep3').text(splitStep1[3]+" "+splitStep1[1]);
                    $('#nomorStep2, #nomorStep3').text(splitStep1[4]);
                    $('#voucherStep2, #voucherStep3').text(splitStep1[5]);
                    $('#statusOrder').text(splitStatus[0]).attr('class', 'form-total-nominal '+splitStatus[1]);
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
        $.ajax({
            url: "<?php echo Yii::app()->baseUrl; ?>/node/step3",
            type: "post",
            data: { count: $('#counter').val() },
            beforeSend:function(){
                $('#statusOrder').html('<div class="loading"><img src="<?php echo Yii::app()->baseUrl; ?>/themes/sepanjang/img/load.gif" alt="Loading..." />');
            },
            success:function(data){
                var ubahstat = ubahstatus(data);
                var splitStatus = ubahstat.split("_");
                setTimeout(function(){
                    $('#statusOrder').empty();
                    $('#statusOrder').text(splitStatus[0]).attr('class', 'form-total-nominal '+splitStatus[1]);
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


    // proses cek order
    var cekOrder;
    $("#cekOrder-form").submit(function(event){
        
        if(cekOrder){
            cekOrder.abort();
        }
        
        var $form = $(this);
        var $inputs = $form.find("input");
        var serializedData = $form.serialize();
        var msgerror = 'Maaf, Terjadi kesalahan pada sistem, silahkan ulangi beberapa saat lagi.';
        var msgempty = 'Maaf, Data tidak ditemukan.';

        $inputs.prop("disabled", true);
        $('#tombolStatusOrder').button('loading');
        $('#tableResult, #msg-error').attr('style', 'display:none');

        cekOrder = $.ajax({
            url: "<?php echo Yii::app()->baseUrl; ?>/node/cekOrder",
            type: "post",
            data: serializedData
        });

        cekOrder.done(function (response, textStatus, jqXHR){

            $('#loading').html('<img src="<?php echo Yii::app()->baseUrl; ?>/themes/sepanjang/img/load.gif" alt="Loading..." />').attr('style', 'display:block');

            if(response == "error"){
                setTimeout(function(){
                    $('#msg-error').text(msgerror).attr('style', 'display:block');
                    $('#tombolStatusOrder').button('reset');
                    $inputs.prop("disabled", false);
                    $('#loading').attr('style', 'display:none');
                }, 1200);
            } else if (response == "empty"){
                setTimeout(function(){
                    $('#msg-error').text(msgempty).attr('style', 'display:block');
                    $('#tombolStatusOrder').button('reset');
                    $inputs.prop("disabled", false);
                    $('#loading').attr('style', 'display:none');
                }, 1200);
            }else{
                setTimeout(function(){
                    var splitStep1 = response.split("_");
                    var ubahstat = ubahstatus(splitStep1[7]);
                    var splitStatus = ubahstat.split("_");
                    $('#tanggalORder').text(splitStep1[0]);
                    $('#produkOrder').text(splitStep1[1]);
                    $('#providerOrder').text(splitStep1[2]);
                    $('#nominalOrder').text(splitStep1[2]+" "+splitStep1[3]);
                    $('#nomorOrder').text(splitStep1[4]);
                    $('#hargaOrder').text(splitStep1[5]);
                    $('#bank_'+splitStep1[6]).attr('style', 'display:block');
                    $('#statusOrder').text(splitStatus[0]).attr('class', 'form-total-nominal inline '+splitStatus[1]);
                    $('#counter').val(splitStep1[8]);
                    $('#tableResult').removeAttr('style').fadeIn(400, function(){
                        $('#loading').attr('style', 'display:none');
                        $('#tombolStatusOrder').button('reset');
                        $inputs.prop("disabled", false);
                    });
                }, 1500);
            }
        });

        cekOrder.fail(function (jqXHR, textStatus, errorThrown){
            $('#msg-error').text(msgerror).attr('style', 'display:block');
            $('#tombolStatusOrder').button('reset');
            $inputs.prop("disabled", false);
        });

        cekOrder.always(function () {
            //$inputs.prop("disabled", false);
        });

        event.preventDefault();
    });  

    
    // disabled "enter" form
    $("form").bind("keypress", function(e) {
        if (e.keyCode == 13) {
         return false;
        }
    });


    // replace status ke bahasa indonesia
    var ubahstatus = function(txt)
    {  
        if(txt == "waiting"){
            return "Belum Dibayar_text-info";
        }else if(txt == "proses"){
            return "Sedang Diproses_text-warning";
        }else if(txt == "sukses"){
            return "Telah Dikirim_text-success";
        }else if(txt == "refund"){
            return "Uang Dikembalikan_text-danger";
        }else if(txt == "expired"){
            return "Kadaluarsa!_text-danger";
        }else{
            return "-_-";
        }
    }


    // periksa status pembayaran
    $('#reStatus').click(function(){              
        $.ajax({
            url: "<?php echo Yii::app()->baseUrl; ?>/node/step3",
            type: "post",
            data: { count: $('#counter').val() },
            beforeSend:function(){
                $('#statusOrder').html('<div class="loading" style="display:inline-block;"><img src="<?php echo Yii::app()->baseUrl; ?>/themes/sepanjang/img/load.gif" alt="Loading..." />');
                $('#reload').attr('style', 'display:none');
            },
            success:function(data){
                var ubahstat = ubahstatus(data);
                var splitStatus = ubahstat.split("_");
                setTimeout(function(){
                    $('#statusOrder').empty();
                    $('#reload').attr('style', 'display:inline-block');
                    $('#statusOrder').text(splitStatus[0]).attr('class', 'form-total-nominal inline '+splitStatus[1]);
                }, 2000);
            },
            error:function(){
                $('#statusOrder').text('error');
            }
        });
    });


    // load jtable untuk halaman semua order
    $('#listAllOrder').jtable({
        title: ' ',
        actions: {
            listAction: '<?php echo Yii::app()->baseUrl; ?>/node/orderAll',
        },
        fields: {
            ord_id: {
                key: true,
                list: false
            },
            ord_date: {
                title: '<strong>Tanggal</strong>',
                width: '20%',
                
            },
            ord_dest: {
                title: '<strong>Nomor Tujuan</strong>',
                width: '17%'
            },
            opt_code: {
                title: '<strong>Produk</strong>',
                width: '17%'
            },
            ord_bayar: {
                title: '<strong>Jumlah Tagihan</strong>',
                width: '17%'
            },
            ord_bank: {
                title: '<strong>Bank Tujuan</strong>',
                width: '14%',
            },
            ord_status: {
                title: '<strong>Status</strong>',
                width: '17%',
                display: function(data){
                    var ubahstat = ubahstatus(data.record.ord_status);
                    var splitStatus = ubahstat.split("_");
                    var dataDiv = '<div class="inline tebal '+splitStatus[1]+'">'+splitStatus[0]+'</div> ';
                    return dataDiv;
                }
            }
        }
    });
    $('#listAllOrder').jtable('load');



    // menjalankan slider di halaman donasi
    $('.carousel').carousel({
        interval: 15000
    });

});