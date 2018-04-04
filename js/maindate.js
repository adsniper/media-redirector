$(document).ready(function() {

    var cb = function(start, end, label) {
        var dateperiod = start.format('DD.MM.YYYY') + '-' + end.format('DD.MM.YYYY');
        $('#datedat_interval').val(dateperiod);
        reloadPage();
    }
    
    var InitDates = UrlManager.getGETParam('d');
    var InitialDates = {};
    var doneDates = 0;
    if (InitDates !=""){
        var InitDatesArr = InitDates.split("-");
        if (InitDatesArr.length == 2){
            InitialDates.datefrom = InitDatesArr[0];
            InitialDates.dateto = InitDatesArr[1];
            doneDates = 1;
        }
    }
    if (InitDates == "" || doneDates!= 1){
        InitialDates.datefrom = moment().subtract(7, 'days').format('DD.MM.YYYY');
        InitialDates.dateto = moment().format('DD.MM.YYYY');
    }
        
    var optionSet = {
        "startDate": InitialDates.datefrom,
        "endDate": InitialDates.dateto,
        "showDropdowns": true,
        locale: {
            format: 'DD.MM.YYYY',
            applyLabel: 'Ок',
            fromLabel: 'From',
            toLabel: 'To',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    };
    
//    daysOfWeek: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт','Сб'],
//    monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],

    $('#datedat_interval').daterangepicker(optionSet, cb);
    
    var datep_today = moment().format('DD.MM.YYYY')+" - "+moment().format('DD.MM.YYYY');
    var datep_yest = moment().subtract(1, 'days').format('DD.MM.YYYY')+" - "+moment().subtract(1, 'days').format('DD.MM.YYYY');
    var datep_week = moment().subtract(7, 'days').format('DD.MM.YYYY')+" - "+moment().format('DD.MM.YYYY');
            
    var dateCompare = InitialDates.datefrom+"-"+InitialDates.dateto;
    console.log(dateCompare);
    console.log(datep_today);
    console.log(datep_yest);
    console.log(datep_week);
    switch(dateCompare){
        case datep_today:
            $("#periods_date a#p_today").addClass("act");
            break;
        case datep_yest:
            $("#periods_date a#p_yest").addClass("act");
            break;
        case datep_week:
            $("#periods_date a#p_week").addClass("act");
            break;
        default:
            break;
    }
    
//    if (){
//    }

});
