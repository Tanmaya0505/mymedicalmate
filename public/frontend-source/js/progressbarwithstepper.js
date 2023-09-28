$(document).ready(function () {
     $( "#form .fieldset" ).hide();
     $( "#form .fieldset:eq(0)" ).show();
    var currentGfgStep, nextGfgStep, previousGfgStep;
    var opacity;
    var current = 1;
    var steps = $(".fieldset").length;
  
    setProgressBar(current);
    
    $("#add_referance_form .required").jqBootstrapValidation({
        preventSubmit: true,
        submitSuccess: function($form, event){  
        event.preventDefault();
            $.ajax({
                type: "POST",
                url:  "/assistant/add-referance",
                data: $("#add_referance_form").serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('.xhr-loading').css({'display':'block'});
                },
                success: function (data) {
                    if (data.code === 200) {
                        $('#add_referance').modal('hide');
                        $('#add_referance_form')[0].reset()
                        var html = '';
                        $.each(data.data,function(index,item){
                            html += '<ul class="list-group col-md-10 card ml-5">';
                            html += '<li class="list-group-item d-flex justify-content-between align-items-center border-0"> Referance No :'+ (index+1)+'\
                                             <span class=""><a class="btn btn-danger  remvref" data-id="'+index+'" href="javascript:void(0)">Remove</a></span>\
                                            </li>';
                            $.each(item,function(ind,itm){
                                html += '<li class="list-group-item d-flex justify-content-between align-items-center border-0"> '+ data.ref_title[ind]+'\
                                             :<span class="">'+itm+'</span>\
                                            </li>';
                            });
                            html += '</ul>';
                            $('.reflist').html(html);

                        })
                    } else {
                       console.log(data);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    $('#staticBackdrop').unblock();
                    console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
                } 
            }); 
        } 
    });

    $(".next-step").click(function () { 
        // var id = $(this).data('id');
        // alert(id);
        // if(id==1){
        //   $('.steponehide').hide(); 
        //   $('.steponeshow').show(); 
        // }
        // if(id==2){
        //   $('.steptwohide').hide(); 
        //   $('.steptwoshow').show(); 
        // }
        // if(id==3){
        //   $('.stepthreehide').hide(); 
        //   $('.stepthreeshow').show(); 
        // }
        currentGfgStep = $(this).closest('.fieldset');
        nextGfgStep = $(this).closest('.fieldset').next();
        if(currentGfgStep.hasClass('first_el') && $('.first_el').length > 0){
            $(".second_el .required").jqBootstrapValidation("destroy");
            $(".third_el .required").jqBootstrapValidation("destroy");
            $(".first_el .required").jqBootstrapValidation({
            preventSubmit: true,
            submitSuccess: function($form, event){  
            event.preventDefault();
                 if(currentGfgStep && nextGfgStep){
                        NextStep(currentGfgStep,nextGfgStep,2);
                        return false;
                    }else{

                    }
            } 

            });
        }else
        if(currentGfgStep.hasClass('second_el') && $('.second_el').length > 0){
            $(".first_el .required").jqBootstrapValidation("destroy");
            $(".second_el .required").jqBootstrapValidation("destroy");
            console.log($(document).find(".second_el .required"));
            $(document).find(".second_el .required").jqBootstrapValidation({
            preventSubmit: true,
            submitSuccess: function($form, event){
                    if(currentGfgStep && nextGfgStep.hasClass('third_el')){
                        event.preventDefault();
                        NextStep(currentGfgStep,nextGfgStep,3);
                        return false;
                    }else{
                        //$( "#form" ).submit();
                    }
            } 

            });
        }else
        if(currentGfgStep.hasClass('third_el') && $('.third_el').length > 0){
            $(".first_el .required").jqBootstrapValidation("destroy");
            $(".second_el .required").jqBootstrapValidation("destroy");
            $(".third_el .required").jqBootstrapValidation({
            preventSubmit: true,
            submitSuccess: function($form, event){  
                //$('#form').submit();
            } 

            });
        }


           
        
    });


     // $(".last-step").click(function () {
     //    var currentGfgStep = $(this).closest('.fieldset');
     //    var nextGfgStep = $(this).closest('.fieldset').next();
     //    alert(currentGfgStep.attr('class'));
     //     $(".first_el .required").jqBootstrapValidation("destroy");
     //     $(".second_el .required").jqBootstrapValidation();
     // });
        
    function NextStep(currentGfgStep,nextGfgStep,nostep){   
        //currentGfgStep = $(this).closest('.fieldset');
        //.closest('.a')
        //nextGfgStep = $(this).closest('.fieldset').next();
        console.log(currentGfgStep);
        console.log(nextGfgStep);
            //alert($("fieldset")
            //.index(nextGfgStep));
        $("#progressbar li").eq($(".fieldset")
            .index(nextGfgStep)).addClass("active");
        // $( "#form .fieldset" ).addClass( "d-md-none");
        // $( "#form .fieldset" ).eq($(".fieldset")
        //     .index(nextGfgStep)).removeClass( "d-md-none");
  
        nextGfgStep.show();
        currentGfgStep.animate({ opacity: 0 }, {
            step: function (now) {
                opacity = 1 - now;
  
                currentGfgStep.css({
                    'display': 'none',
                    'position': 'relative'
                });
                nextGfgStep.css({ 'opacity': opacity });
            },
            duration: 500
        });
        current = nostep;
        console.log(nostep);
        setProgressBar(nostep);

    }
    //});
  
    $(".previous-step").click(function () {
  
        currentGfgStep = $(this).closest('.fieldset');
        previousGfgStep = $(this).closest('.fieldset').prev();
  
        $("#progressbar li").eq($(".fieldset")
            .index(currentGfgStep)).removeClass("active");
        // $( "#form .fieldset" ).addClass( "d-md-none");
        // $( "#form .fieldset" ).eq($(".fieldset")
        //     .index(nextGfgStep)).removeClass( "d-md-none");
  
        previousGfgStep.show();
  
        currentGfgStep.animate({ opacity: 0 }, {
            step: function (now) {
                opacity = 1 - now;
  
                currentGfgStep.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previousGfgStep.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(--current);
    });
  
    function setProgressBar(currentStep) {
        var percent = parseFloat(100 / steps) * current;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }
  
    // $(".submit").click(function () {
    //     return false;
    // })
});