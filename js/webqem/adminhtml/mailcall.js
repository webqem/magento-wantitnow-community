/**
 * Webqem Mailcall
 *
 * @category    Webqem
 * @package     Webqem_Mailcall
 * @copyright   Copyright (c) 2012 webqem (http://www.webqem.com)
 * @author      webqem
 */

jQuery(function(){
    var baseUrl                     = top.location.href.split('index.php');
    var baseMediaUrl                = baseUrl[0]+"media/wantitnow/";
    var serviceTypes                = "wantitnow,wantitnow_twilight".split(',');
    var serviceCount                = serviceTypes.length;
    var serviceTypesTitles          = "Want It Now, Want It Now Twilight".split(',');
    var xmlNodePrefix               = "carriers_webqemmailcall,carriers_webqemwantitnowtwilight".split(',');
    var displaySelectLogoElements   = (xmlNodePrefix[0]+'_display_logos,'+xmlNodePrefix[1]+'_display_logos').split(',');
    var useFixedCostElements       = (xmlNodePrefix[0]+'_usefixedcost,'+xmlNodePrefix[1]+'_usefixedcost').split(',');

    /*
     * DISPLAY LOGOS
     */

    function changeLogoImg(logoName, logoContainer, logoTitle){

        var logoImg = '<img src="'+baseMediaUrl+logoName+'.png" alt="'+logoTitle+'">';
        logoContainer.html(logoImg);
    }
    // Create listener for logo change:
    var displayLogoSelectList = "";
    for(var x=0; x<serviceCount; x++) {
        var strPrefix = ",";
        if( x == 0 ) { strPrefix = ""; }
        displayLogoSelectList = displayLogoSelectList+strPrefix+'#'+displaySelectLogoElements[x];
    }

    jQuery(displayLogoSelectList).change(function(){
        var displayLogoSelectId = jQuery(this).attr('id');
        var elIndex = displaySelectLogoElements.indexOf(displayLogoSelectId);
        changeLogoImg(jQuery(this).val(), jQuery('#'+serviceTypes[elIndex]+'_logo_overview'), serviceTypesTitles[elIndex]);
    });

    //Display logos in the context of the service being displayed:
    for(var x=0; x<serviceCount; x++){
        var displayLogoId = serviceTypes[x]+"_logo_overview";
        var displayLogoSelectId = "#"+displaySelectLogoElements[x];
        // Create container to hold logo:
        jQuery(displayLogoSelectId).after('<p id="'+displayLogoId+'"></p>');
        // Initialise Logo:
        jQuery(displayLogoSelectId).change();
    }

    // Want It Now:
    //var displayLogosSelect_win=jQuery('#carriers_webqemmailcall_display_logos');
    //var displayLogoId_win = "wantitnow_logo_overview";
    //displayLogosSelect_win.after('<p id="'+displayLogoId_win+'"></p>');
    //var logoOverview_win=jQuery('#'+displayLogoId_win);

    // Want It Now Twilight:
    //var displayLogosSelect_twilight=jQuery('#carriers_webqemwantitnowtwilight_wintwilightdisplay_logos');
    //var displayLogoId_twilight = "wantitnow_twilight_logo_overview";
    //displayLogosSelect_twilight.after('<p id="'+displayLogoId_twilight+'"></p>');;
    //var logoOverview_twilight=jQuery('#'+displayLogoId_twilight);

    // Initialise Logos:
    //changeLogoImg('win');
    //changeLogoImg('twilight');

    // Create listeners for logos:
    //displayLogosSelect_win.change(function(){
    //    changeLogoImg('win');
    //});
    //displayLogosSelect_twilight.change(function(){
    //    changeLogoImg('twilight');
    //});

    /*
     * FIXED COST DYNAMIC FIELDS
     */

    function changeFixedFields(el){
        var fieldId             = el.attr('id');
        var elIndex             = useFixedCostElements.indexOf(fieldId);
        var selectedVal         = el.val();
        var selectedDisabled    = el.attr('disabled');
        if( selectedVal == 0 ){
            jQuery('#'+xmlNodePrefix[elIndex]+'_withinkms').attr('disabled',true);
            jQuery('#'+xmlNodePrefix[elIndex]+'_fixedcost').attr('disabled',true);
            jQuery('#'+xmlNodePrefix[elIndex]+'_display_wantitnow').attr('disabled',true);
        } else {
            if(!selectedDisabled){
                jQuery('#'+xmlNodePrefix[elIndex]+'_withinkms').attr('disabled',false);
                jQuery('#'+xmlNodePrefix[elIndex]+'_fixedcost').attr('disabled',false);
                jQuery('#'+xmlNodePrefix[elIndex]+'_display_wantitnow').attr('disabled',false);
            }

        }
    }
    // Create listener for fixed cost field change:
    var useFixedCostList = "";
    for(var x=0; x<serviceCount; x++) {
        var strPrefix = ",";
        if( x == 0 ) { strPrefix = ""; }
        useFixedCostList = useFixedCostList+strPrefix+'#'+useFixedCostElements[x];
    }
    jQuery(useFixedCostList).change(function(){
        changeFixedFields(jQuery(this));
    });
    // Initialise fields
    for(var x=0; x<serviceCount; x++)   {
        jQuery('#'+useFixedCostElements[x]).change();
    }

    /*
     * READY TIME DYNAMIC FIELDS
     */
    
    var mailcallTable=jQuery('#carriers_webqemmailcall');
    var checkReadyTime=jQuery('#carriers_webqemmailcall_check_readytime');
    var readyTime=mailcallTable.find("[type='time']");
    //console.log(jQuery('#row_carriers_webqemmailcall_readytime select'));
    readyTime.eq(2).find('option').remove();
    jQuery('<option value="00">00</option>').appendTo(readyTime.eq(2));

    var defaultVal=new Array();
    defaultVal[checkReadyTime.val()]=new Array(readyTime.eq(0).val(),readyTime.eq(1).val());
    defaultVal[(checkReadyTime.val()==1)?2:1]=new Array('00','00');
    
    checkReadyTime.change(function(){
        
        readyTime.eq(0).find('option').remove();
        readyTime.eq(1).find('option').remove();
        if(jQuery(this).val()==2){
            for(var i=0;i<=3;i++){
                var val='0'+i;
                var selected=defaultVal[2][0]==val?' selected':'';
                jQuery('<option value="'+val+'"'+selected+'>'+val+'</option>').appendTo(readyTime.eq(0));
            }
            for(var i=0;i<=30;i=i+30){
                var val=i<10?'0'+i:i;
                var selected=defaultVal[2][1]==val?' selected':'';
                jQuery('<option value="'+val+'"'+selected+'>'+val+'</option>').appendTo(readyTime.eq(1));
            }
        }else{
            
            for(var i=0;i<=23;i++){
                var val=i<10?'0'+i:i;   
                var selected=defaultVal[1][0]==val?' selected':'';
                jQuery('<option value="'+val+'"'+selected+'>'+val+'</option>').appendTo(readyTime.eq(0));
            }
            for(var i=0;i<=59;i++){
                var val=i<10?'0'+i:i;
                var selected=defaultVal[1][1]==val?' selected':'';
                jQuery('<option value="'+val+'"'+selected+'>'+val+'</option>').appendTo(readyTime.eq(1));
            }
        }
    });

    //function changeReadytime(){}

//    var flatRate=jQuery('#carriers_flatrate_active');
//    var mailcallFlatrate=jQuery('#carriers_webqemmailcall_flatrate');
//    
//    var selectedVal=flatRate.find("option:selected").val();
//    changeMailcallFlateRate(selectedVal);
//    
//    function changeFlateRate(curVal){
//        for(var i=0;i<flatRate.find("option").length;i++){
//            if(i==curVal){
//                flatRate.get(0).options[i].selected = false;
//            }else{
//                flatRate.get(0).options[i].selected = true;  
//            }
//        }
//    }
//    flatRate.change(function(){
//        var selectedVal=jQuery(this).find("option:selected").val();
//        changeMailcallFlateRate(selectedVal);
//    });
//    
//    function changeMailcallFlateRate(curVal){
//        for(var i=0;i<mailcallFlatrate.find("option").length;i++){
//            if(i==curVal){
//                mailcallFlatrate.get(0).options[i].selected = false;  
//            }else{
//                mailcallFlatrate.get(0).options[i].selected = true;  
//            }
//        }
//    }
//    
//    mailcallFlatrate.change(function(){
//        var selectedVal=jQuery(this).find("option:selected").val();
//        changeFlateRate(selectedVal);
//    });
});