function topFunction() {
    $(document).scrollTop(0);
}
window.onscroll = function () {

    $(document).scrollTop() > 100 ? $("#back-to-top").show() : $("#back-to-top").hide();
};

$(document).ready(function(){
    //$('')
    $("#topnav-hamburger-icon").click(function(){
        var e = document.documentElement.clientWidth;
        767 < e && document.querySelector(".hamburger-icon").classList.toggle("open"),
            "vertical" === document.documentElement.getAttribute("data-layout") &&
                (e < 1025 && 767 < e
                    ? (document.body.classList.remove("vertical-sidebar-enable"),
                      "sm" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "") : document.documentElement.setAttribute("data-sidebar-size", "sm"))
                    : 1025 < e
                    ? (document.body.classList.remove("vertical-sidebar-enable"),
                      "lg" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm") : document.documentElement.setAttribute("data-sidebar-size", "lg"))
                    : e <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg")));
    });

    $(".vertical-overlay").click( function(){
        document.body.classList.remove("vertical-sidebar-enable");
    });

    $("#light-dark-mode").click( function(){
        $('html').attr("data-layout-mode") == "dark" ? $('html').attr("data-layout-mode", "light") : $('html').attr("data-layout-mode", "dark");  
    });

    $("#gofullscreen").click(  function (e) {
        e.preventDefault(),
            document.body.classList.toggle("fullscreen-enable"),
            document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement
                ? document.cancelFullScreen
                    ? document.cancelFullScreen()
                    : document.mozCancelFullScreen
                    ? document.mozCancelFullScreen()
                    : document.webkitCancelFullScreen && document.webkitCancelFullScreen()
                : document.documentElement.requestFullscreen
                ? document.documentElement.requestFullscreen()
                : document.documentElement.mozRequestFullScreen
                ? document.documentElement.mozRequestFullScreen()
                : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    });
    //$('#scrollbar').fadeTo( "slow", 0 );
    $element__ = $('.nav-link[href="'+location.href+'"]');
    $element__.closest('.menu-dropdown').addClass('show');
    $element__.addClass('active');

    $('.delete_from_list,.delete_from_show').click(function (e) {
        e.preventDefault();
        var form = $(this).parent('form');
        swal.fire({
            title: '<strong>Vous êtes sûre ?</strong>',
            text: "de vouloir supprimer définitivement ce élément!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OUI',
            cancelButtonText: 'NON',
            padding: '2em'
        }).then(function (result) {
            if (result.value) {
                swal.fire(
                    'Supprimer !',
                    'Ce élément a été supprimer avec succès',
                    'success'
                );
                form.submit();
            }
        });
    });

});





/**
 * load date/time picker 
 * @view : string 
 **/

function getdate(format = "d-m-Y", dt=null){

    if( dt == null )
        dt = new Date();

    var y = dt.getFullYear();
    var m = dt.getMonth() + 1;
    var d = dt.getDate();
    var h = dt.getHours();
    var i = dt.getMinutes();

    d = d < 10 ? "0"+d : d;
    m = m < 10 ? "0"+m : m;
    h = h < 10 ? "0"+h : h;
    i = i < 10 ? "0"+i : i;

    return format.replace('Y', y)
                 .replace('m', m)
                 .replace('d', d)
                 .replace('H', h)
                 .replace('i', i);
}

function applyDateTimePicker(view = ""){

    view = view ? view+" " : "";

    prmsDefaultDateTime = {
        format:'d-m-Y H:i',
        mask: '__-__-____ __:__',
        step:5,
        language: 'fr',
    };

    prmsDefaultDate = {
        timepicker:false,
        format:'d-m-Y',
        mask: '__-__-____',
        language: 'fr',
    };

    prmsDefaultTime = {
        datepicker:false,
        format:'H:i',
        mask: '__:__',
        step:5,
        language: 'fr',
    };

    $.datetimepicker.setLocale('fr');
    
    $(`${view}.datetime.default-empty`).datetimepicker( prmsDefaultDateTime );

    prmsDefaultDateTime.value = getdate('d-m-Y H:i');
    $(`${view}.datetime:not(.default-empty)`).datetimepicker( prmsDefaultDateTime );
    
    $(`${view}.date.default-empty`).datetimepicker( prmsDefaultDate );
    
    prmsDefaultDate.value = getdate('d-m-Y');
    $(`${view}.date:not(.default-empty)`).datetimepicker( prmsDefaultDate );
    
    $(`${view}.time.default-empty`).datetimepicker( prmsDefaultTime );

    prmsDefaultTime.value = getdate('H:i');
    $(`${view}.time:not(.default-empty)`).datetimepicker( prmsDefaultTime );
}

function applyDate(selector_, empty=true){
    $(selector_).datetimepicker({
        timepicker:false,
        format:'d-m-Y',
        value: empty ? '' : getdate('d-m-Y'),
        language: 'fr',
    });
}

function applyDateflat(selector_, empty=true){
    $(selector_).flatpickr({
        dateFormat: "d-m-Y",
    });
}

function applyDateTime(selector_, empty=true){
    $(selector_).datetimepicker({
        format:'d-m-Y H:i',
        step:5,
        value: empty ? '' : getdate('d-m-Y H:i'),
        language: 'fr',
    });
}

function applyTime(selector_, empty=true){
    $(selector_).datetimepicker({
        datepicker:false,
        format:'H:i',
        step:5,
        value: empty ? '' : getdate('H:i'),
        language: 'fr',
    });
}
/*
async function loadSelect(prms){

    var cnfg = {
        load: false,
        link: "#",
        filter: '',
        selector: "",
        fieldVal: "id",
        fieldText: "",
        fieldLabel: "",
        selected: 0,
        defaultoptions: [],
        callback: null
    };

    $.extend(cnfg, prms);
    
    if( ! $(cnfg.selector).length )
        return;
    
    let options = cnfg.defaultoptions;

    if (typeof cnfg.filter === 'function') {
        cnfg.filter = cnfg.filter();
    }

    var filter_ = cnfg.filter;
    if( cnfg.selected || cnfg.load ){
        if( cnfg.selected )
            filter_ += "&filter[id][operation]==&filter[id][value]=" + cnfg.selected;

        await $.ajax({
            url: cnfg.link+'?forAction=loadSelect&' + filter_, /*encodeURIComponent(query),
            type: 'GET',
            success: function(result) {
                options = cnfg.defaultoptions.concat(result);
                if( cnfg.callback ){
                    cnfg.callback(options);
                }
            }
        });
    }

    $select = $(cnfg.selector).selectize({
        valueField: cnfg.fieldVal ? cnfg.fieldVal : 'id',
        searchField: cnfg.fieldLabel ? cnfg.fieldLabel : "text",
        labelField: cnfg.fieldLabel ? cnfg.fieldLabel : "text",
        options: options,
        create: false,
        copyClassesToDropdown: true,
        load: function(query, callback) {
            if (!query.length) return callback();

            filter_ = cnfg.filter ;
            
            if( cnfg.fieldText.search(',') > 0 ){           
                condtn = 'and';
                $.each( cnfg.fieldText.split(','), function(i,f){ 
                    filter_ += "&filter["+f+"][value]=" + query +"&filter["+f+"][andor]="+condtn;
                    condtn = 'or';
                });
            }else{
                filter_ += "&filter["+cnfg.fieldText+"][value]=" + query;
            }

            $.ajax({
                url: cnfg.link+'?forAction=loadSelect&' + filter_, /*encodeURIComponent(query),
                type: 'GET',
                error: function() {
                    callback();
                },
                success: function(result) {
                    options = cnfg.defaultoptions.concat(result);
                    callback(options);
                    if( cnfg.callback ){
                        cnfg.callback(options);
                    }
                }
            });
        }
    });

    $select[0].selectize.setValue(cnfg.selected);
}*/

 
    $.fn.jtCalendar = function( options ) {

        var jtcToday = new Date();
 
        var settings = $.extend({
            // These are the defaults.
            mode: "day", // day, week, month, year
            date: new Date(), // now
            lang: 'fr',
            title: '',
            ajaxlink: '',
            ajaxparams:{},
            classes:{
                'danger': 'danger',
                'success': 'success',
                'warning': 'warning',
                'secondary': 'secondary',
                'primary': 'primary',
            },
        }, options );

        let $that = $(this);


        var jtcTrans = {
            'fr': {
                'months' :[
                    'Janvier',
                    'Février',
                    'Mars',
                    'Avril' ,
                    'Mai',
                    'Juin'  ,
                    'Juillet',
                    'Août',
                    'Septembre' ,
                    'Octobre'   ,
                    'Novembre',
                    'Décembre'
                ],
                // les jours :
                'days' : [
                    'Dim',
                    'Lun',
                    'Mar', 
                    'Mer',
                    'Jeu',
                    'Ven',
                    'Sam', 
                ],
                'day': 'Par Jour',
                'week': 'Semaine',
            }
        };

        settings.trans = jtcTrans[ settings.lang ];

        async function loadData(){
            if( !settings.ajaxlink )
                return;

            $data = await $.ajax({
                url: settings.ajaxlink, /*encodeURIComponent(query),*/
                data: $.extend({
                    mode: settings.mode, // day, week, month, year
                    from: getdate('Y-m-d', settings.from),
                    to: getdate('Y-m-d', settings.to),
                }, settings.ajaxparams ),
                type: 'GET',
                success: function(result) {
                    return result;
                }
            });


            $.each( $data, function(k, d){
                $html_ = `<a class="jtc-rdv btn btn-md mb-2 d-block btn-soft-${ settings.classes[d.etat] } fw-semibold">${ d.patient ? d.patient.nom + ' ' + d.patient.prenom : '' }</a>`;
                //

                //console.log(('.jtc-td-' + getdate( settings.format, new Date(d.date)) ), d);

                $('.jtc-td-' + getdate( settings.format, new Date(d.date)) ).append( $html_ );

            });
        }


        function getAllDaysInMonth(year, month) {
          const date = new Date(year, month, 1);

          const dates = [];

          while (date.getMonth() === month) {
            dates.push(new Date(date));
            date.setDate(date.getDate() + 1);
          }

          return dates;
        }

        function getAllDaysInWeek(cur) {
            var week= new Array(); 
            // Starting Monday not Sunday
            var curdt = new Date(cur);
            curdt.setDate((curdt.getDate() - curdt.getDay() +1));
            for (var i = 0; i < 7; i++) {
                week.push(
                    new Date(curdt)
                ); 
                curdt.setDate(curdt.getDate() +1);
            }
            return week; 
        }


        async function jtcInit() {

            
            jtcMake();
            if( settings.mode == 'day' ){
                settings.title = settings.trans.days[ settings.date.getDay() ] +' '+ settings.date.getDate() + ' ' + settings.trans.months[ settings.date.getMonth() ] + ' ' + settings.date.getFullYear() ;
            }
            else if( settings.mode == 'week' ){
                settings.title = settings.trans.days[ settings.from.getDay() ] +' '+ settings.from.getDate() + ' -> ';
                settings.title += settings.trans.days[ settings.to.getDay() ] +' '+ settings.to.getDate() + ' ';
                settings.title += settings.trans.months[ settings.date.getMonth() ] + ' ' + settings.date.getFullYear() ;
            }
            $('#jtc-title').text( settings.title );
            $('#jtc-mode').text( settings.trans[ settings.mode ] );
            await loadData();
        }

        
        function jtcMake() {

            $that.html('');

            var html = `
                <div class="row">
                    <div class="col-md-2">
                        <div class="btn-group">
                            <button type="button" class="jtc-prev-btn btn btn-info"><span class="ri-arrow-left-s-line"></span></button>
                            <button type="button" class="jtc-next-btn btn btn-info"><span class="ri-arrow-right-s-line"></span></button>
                        </div>
                        <button type="button" class="jtc-today-btn btn btn-info">today</button>
                    </div>
                    <div class="col-md-8">
                        <h3 class="jtc-toolbar-title text-center" id="jtc-title">${ settings.title }</h3>
                    </div>
                    <div class="col-md-2">
                        <div class="btn-group float-end" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button id="jtc-mode" type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    ...
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="jtc-mode">
                                    <li><a class="jtc-change-mode dropdown-item" href="#" data-mode="day">${ settings.trans.day }</a></li>
                                    <li><a class="jtc-change-mode dropdown-item" href="#" data-mode="week">${ settings.trans.week }</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <table class="mt-4 table table-td-hover table-border align-middle border">
                <thead>
                </thead>

                <tbody>`;

            if( settings.mode == 'day' ){

                settings.format = 'H';
                settings.from = settings.date;
                settings.to = settings.date;

                html += `<tr>`;
                for (var i = 7; i <= 12; i++) {
                     html += `<th class="jtc-th jtc-th-day jtc-th-${(i<10?'0':'')+i} bg-soft-info">${i}:00</th>`;
                }
                html += `</tr>`;

                html += `<tr>`;
                for (var i = 7; i <= 12; i++) {
                     html += `<td class="jtc-td jtc-td-day jtc-td-${(i<10?'0':'')+i} ${ i == jtcToday.getHours() ? 'active' : '' }"></td>`;
                }
                html += `</tr>`;

                html += `<tr>`;
                for (var i = 13; i <= 18; i++) {
                     html += `<th class="jtc-th jtc-th-day jtc-th-${i} bg-soft-info">${i}:00</th>`;
                }
                html += `</tr>`;

                html += `<tr>`;
                for (var i = 13; i <= 18; i++) {
                     html += `<td class="jtc-td jtc-td-day jtc-td-${i} ${ i == jtcToday.getHours() ? 'active' : '' }"></td>`;
                }
                html += `</tr>`;

            }else if( settings.mode == 'week' ){

                settings.format = 'd';

                html += `<tr>`;
                for (var i = 1; i <= 6; i++) {
                     html += `<th class="jtc-th jtc-th-day jtc-th-0${i} bg-soft-info">${ settings.trans.days[i] }</th>`;
                }
                html += `</tr>`;

                html += `<tr>`;

                var week = getAllDaysInWeek(settings.date);

                settings.from = week[0];
                settings.to = week[week.length-1];

                for (var i = 0; i < 6; i++) {
                    d = week[i].getDate();
                    html += `<td class="jtc-td jtc-td-day jtc-td-${(d<10?'0':'')+d} ${ week[i].toString() == jtcToday.toString() ? 'active' : '' }"><span class="jtc-label rounded">${(d<10?'0':'')+d}</span></td>`;
                }
                
                html += `</tr>`;

            }

            html += `</tbody>`;
            html += `</table>`;

            $that.html(html);
        }


        /*var monthName = trans_global.mois[d.getMonth()];
        var dayName = trans_global.jours[d.getDay()]; 

        var dt = new Date();
        var y = dt.getFullYear();
        var m = dt.getMonth() + 1;
        var d = dt.getDate();
        var h = dt.getHours();*/

        jtcInit();


        /*var jtcday = [
            'morning' : {
                '07'
            }
        ];*/

        //this.html('');

        $(document)
        .off('click', '.jtc-change-mode')
        .on('click', '.jtc-change-mode', function(e){
            e.preventDefault();

            settings.mode = $(this).data('mode');
            jtcInit();
        })
        .off('click', '.jtc-today-btn')
        .on('click', '.jtc-today-btn', function(){
            settings.date = new Date();
            jtcInit();
        })
        .off('click', '.jtc-prev-btn')
        .on('click', '.jtc-prev-btn', function(){

            if( settings.mode == 'day' ){
                settings.date.setDate( settings.date.getDate() - 1 );
            }
            else if( settings.mode == 'week' ){
                settings.date.setDate( settings.date.getDate() - 7 );
            }

            jtcInit();
        })
        .off('click', '.jtc-next-btn')
        .on('click', '.jtc-next-btn', function(){

            if( settings.mode == 'day' ){
                settings.date.setDate( settings.date.getDate() + 1 );
            }
            else if( settings.mode == 'week' ){
                settings.date.setDate( settings.date.getDate() + 7 );
            }
            
            jtcInit();
        });
 
    };
 