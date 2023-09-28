<?php

use App\Customer;
use App\Helpers\CustomerHelper;
use App\Configuration;

if (!function_exists('profileStatus')) {

    /**
     * ProfileStatus
     *
     * @return void
     */
    function profileStatus() {
        $validate = false;
        $data = Customer::where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        // $decode_data = json_decode($data->meta, true);
        // unset($decode_data['whatsapp']);
        // unset($decode_data['restricted_reason']);
        // unset($decode_data['referance_list']);
        // if(!isset($decode_data['is_bike']) || empty($decode_data['is_bike']))
        // {
        //     unset($decode_data['is_bike']);
        //     unset($decode_data['vehicle_number']);
        //     unset($decode_data['km_range']);
        // }
        // if (isset($decode_data['payment_information']))
        // {
        //     if ($decode_data['payment_information'] == 'Check')
        //     {
        //         unset($decode_data['account_holder_name']);
        //         unset($decode_data['account_number']);
        //         unset($decode_data['ifsc_code']);
        //         unset($decode_data['branch_name']);
        //         unset($decode_data['upi_id']);
        //     }

        //     if($decode_data['payment_information'] == 'Account Transfer')
        //     {
        //         unset($decode_data['account_holder_name']);
        //         unset($decode_data['account_number']);
        //         unset($decode_data['ifsc_code']);
        //         unset($decode_data['branch_name']);
        //     }

        //     if($decode_data['payment_information'] == 'UPI Transfer'){
        //         unset($decode_data['upi_id']);
        //     }
        // }
       // echo "<pre>";
       // print_r($decode_data); exit;
        // foreach ($decode_data as $key=>$value) {
        //     if (empty($value)) {
        //         $validate = true;
        //     }
        // }
        return $data->is_profile_setup ==0 ? true : false; //$validate;
    }

}

if (!function_exists('accountPrefix')) {

    /**
     * AccountPrefix
     *
     * @return void
     */
    function accountPrefix() {
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        return $account_prefix;
    }

}

if (!function_exists('viewForm')) {

    /**
     * ViewForm
     *
     * @param  mixed $config
     * @return Form Elements
     */
    function viewForm($config = [], $value = [], $upath = '',$userdata = []) {
        $html = '';
        $user_type = accountPrefix();
        $is_admin = @Auth::user()->user_role;
        $userconfig = [];
        $pickup_pincode = [];
        $min = '';
        $max = "";
        $activeradio = '';
        $activebtnradio = '';


        $path = $upath ?? $user_type.'/';

        
        //dd($value);
        $leveltitle = \Lang::get('leveltitle');
        $referance_list = [];
        if($user_type=='assistant' || $upath=='assistant/'){
            $userconfig = CustomerHelper::configData('assistant_config');
            $referance_list = isset($value['referance_list']) ? json_decode($value['referance_list'],1) : [];
            $pickup_pincode = explode(',',$userconfig['list_of_pincode']);
        }
        if($user_type=='vendor' || $upath=='vendor/'){
            $assistantconfig = CustomerHelper::configData('vendor_config');
            $pickup_pincode = explode(',',$assistantconfig['list_of_pincode']);
        }
        if($user_type=='delivery-boy' || $upath=='delivery-boy/'){
            $assistantconfig = CustomerHelper::configData('deliveryboy_config');
            $pickup_pincode = explode(',',$assistantconfig['list_of_pincode']);
        }
        //dd($userconfig);
        foreach ($config as $group_node) {
            if (isset($group_node->node_code) &&  $group_node->node_code=='day_charges') {
                $min = @$userconfig['min_day_charge'];
                $max = @$userconfig['max_day_charge'];
            }
            if (isset($group_node->node_code) &&  $group_node->node_code=='night_charges') {
                $min = @$userconfig['min_night_charge'];
                $max = @$userconfig['max_night_charge'];
            }
            if (isset($group_node->node_code) &&  $group_node->node_code=='hourly_charges') {
                $min = @$userconfig['min_hourly_charge'];
                $max = @$userconfig['max_hourly_charge'];
            }



            if (isset($group_node->node_type) &&  $group_node->node_type=='fieldset') {
                $html .= '<div class="fieldset row ' . $group_node->node_comment->label_1 . '">';
                $html .= '<div class="datashow row ">';
                
                $html .= '</div>';
                $html .= '<div class="datahide row">';
            }else
            if (isset($group_node->node_type) && $group_node->node_type=='/fieldset') {
                $html .= '</div>';
                $html .= '</div>';
            }else
            if(isset($group_node->node_type) &&  $group_node->node_type=='listing'){

                $html .= '<div class="row reflist col-md-12">';

                
                foreach($referance_list as $kkey => $vval){
                    $html .= '<ul class="list-group col-md-10 card ml-5">';
                    $html .= '<li class="list-group-item d-flex justify-content-between align-items-center border-0"> Referance No :'. ($kkey+1).'';
                    if($is_admin) {

                                          
                    $html .= '<span class=""><a class="btn btn-danger remvref" data-id="'.$kkey.'"href="javascript:void(0)">Remove</a></span>
                                            </li>';
                    }
                    foreach($vval as $refkey => $refval){
                        $html .= '<li class="list-group-item d-flex justify-content-between align-items-center border-0"> '. @$leveltitle[$refkey].'
                                             :
                                            <span class="">'.$refval.'</span>
                                            </li>';
                        }
                                            
                    $html .= '</ul>';                       
                }
                $html .= '</div>';

            }else
            if($group_node->node_type == 'button' || $group_node->node_type == 'submit'){

                if(!$is_admin){
                    $html .= '<div class="' . $group_node->node_comment->label_1 . '">';

                    if(isset($group_node->node_value) && $group_node->node_value=='SUBMIT & NEXT'){ //print_r($group_node->node_step);
                            if(@$userdata->is_profile_setup==1){
                            $html .= '<button class="btn btn-primary mt-4 mr-5 edittoshow" data-id="'.@$group_node->node_step.'"  type="button">Edit</button>';
                            }
                    }
                    $html .= '<button type="'. $group_node->node_type .'" data-id="'.@$group_node->node_step.'"   ';
                    if(isset($group_node->node_class)){
                        $html .= 'class="' . $group_node->node_class . '"';
                    }
                     $html .= '>';
                    if(isset($group_node->node_value)){
                        $html .= $group_node->node_value;
                    }
                    $html .='</button></div>';
                }else{
                    if($group_node->node_value == 'Add Referance'){
                        $html .= '<div class="' . $group_node->node_comment->label_1 . '"><button type="'. $group_node->node_type .'"';
                        if(isset($group_node->node_class)){
                            $html .= 'class="' . $group_node->node_class . '"';
                        }
                         $html .= '>';
                        if(isset($group_node->node_value)){
                            $html .= $group_node->node_value;
                        }
                        $html .='</button></div>';
                    }
                }

                            
            }else
            if (isset($group_node->node_comment->label_1)) {
                if(isset($value['is_bike']) && $value['is_bike']==1 && ($group_node->node_code=='per_km_harges' || $group_node->node_code=='km_range'|| $group_node->node_code=='vehicle_number' || $group_node->node_code=='dl_number' || $group_node->node_code=='identity_information' )){
                    $html .= '<div class="' . $group_node->node_comment->label_3 . '">';
                }else{
                    if($group_node->node_code=='partner_company' && $activebtnradio=='I m willing to new one'){
                        $html .= '<div class="' . $group_node->node_comment->label_1  . ' d-none ">';
                    }else{
                        $html .= '<div class="' . $group_node->node_comment->label_1 . '">';
                    }
                }
                
                if (isset($group_node->node_comment->label_2)) {
                    
                    // if(isset($value['dob']) && $value['dob']!='' && !$is_admin && $group_node->node_code=='dob'){
                    //     $html .= '<div class="' . $group_node->node_comment->label_2 . '">' .
                    //             '<div class="controls disabled">';
                    // }else{
                        $html .= '<div class="' . $group_node->node_comment->label_2 . '">' .
                                '<div class="controls">';
                   // }
                    if (isset($group_node->node_label)) {
                        $html .= '<label>' . $group_node->node_label . '</label>';
                        if(@$userdata->is_profile_setup==1){
                            if(isset($group_node->node_step) && $group_node->node_step==1 && isset($value[$group_node->node_code])){
                                if($group_node->node_type=='checkbox' && $group_node->node_code=='partner_company' && isset($value[$group_node->node_code])){
                                    if(is_array($value[$group_node->node_code])){ 
                                    $html .= '<div class="steponeshow">' . @implode(',',$value[$group_node->node_code]) . '</div>';
                                    }else{ 
                                    $html .= '<div class="steponeshow">' . @$value[$group_node->node_code] . '</div>';  
                                    }
                                }else{   
                                    $html .= '<div class="steponeshow">' . $value[$group_node->node_code] . '</div>';
                                }
                            }
                            if(isset($group_node->node_step) && $group_node->node_step==2){
                                if($group_node->node_type=='checkbox' && $group_node->node_code=='available' && isset($value[$group_node->node_code])){
                                    if(is_array($value[$group_node->node_code])){
                                    $html .= '<div class="steptwoshow">' . @implode(',',$value[$group_node->node_code]) . '</div>';
                                    }else{
                                    $html .= '<div class="steptwoshow">' . @$value[$group_node->node_code] . '</div>';  
                                    }
                                }else if($group_node->node_code=='is_bike' && isset($value[$group_node->node_code])){
                                    $html .= '<div class="steptwoshow">' . ($value[$group_node->node_code]==1 ? 'Yes' : 'No' ) . '</div>';
                                }else if($group_node->node_type!='file'  && isset($value[$group_node->node_code]) && !is_array($value[$group_node->node_code])) {

                                    $html .= '<div class="steptwoshow">' . @$value[$group_node->node_code] . '</div>';
                                }
                            }
                        }
                    }
                    if(isset($value['dob']) && $value['dob']!='' && !$is_admin && $group_node->node_code=='dob'){
                        $html .= '<div class="dob_box steponehide disabled">';
                    }
                    if (isset($group_node->node_heading)) {
                        $html .= '<'.$group_node->node_type.'>' . $group_node->node_heading . '</'.$group_node->node_type.'>';
                    }
                        /**
                         * Text box
                         */
                        if (isset($group_node->node_type) && in_array($group_node->node_type, Config::get('constants.nodeType'))) {
                            if($group_node->node_type == 'text' || $group_node->node_type == 'email' || $group_node->node_type == 'number' || $group_node->node_type == 'file'){
                                $html .= '<input type="' . $group_node->node_type . '" ';
                            } elseif($group_node->node_type == 'textarea'){
                                $html .= '<textarea ';
                            } elseif($group_node->node_type == 'select'){
                                $html .= '<select ';
                                if(isset($group_node->node_selectable) && $group_node->node_selectable=='multiple' ){
                                    $html .= ' multiple ';
                                }
                            } elseif($group_node->node_type == 'checkbox'){
                                if(@$userdata->is_profile_setup==1 && $group_node->node_is_editable==0 && isset($value[$group_node->node_code])){
                                    $html .= '<div class="disabled"   >';
                                }else{
                                    $html .= '<div class=""   >';
                                }
                                
                                if(isset($group_node->options) && is_array($group_node->options)){

                                    foreach ($group_node->options as $key=>$group_options){
                                        $keyy = $group_options->option_value;
                                        $html .= '<div ';
                                        if(isset($group_node->node_div_class)){
                                            $html .= 'class="'. $group_node->node_div_class .'"';
                                        }
                                        $html.= '><input   type="'. $group_node->node_type .'" ';
                                        if($group_node->node_code!='is_bike'){
                                            $html.=' minchecked="1" ';
                                        }
                                        if($group_node->node_code=='dl_number' || $group_node->node_code=='vehicle_number'){
                                            $html.='data-validation-callback-callback="demo_callback_function" ';
                                        }
                                        
                                        if(isset($group_node->node_value, $value[$group_node->node_code]) && !empty($value[$group_node->node_code]) && is_array($value[$group_node->node_code]) && in_array($keyy, $value[$group_node->node_code])){
                                            $html .= $group_options->option_value .' checked ';
                                        } else if(isset($group_node->node_value, $value[$group_node->node_code]) && $value[$group_node->node_code] &&  !is_array($value[$group_node->node_code]) ) {
                                            $html .= $group_options->option_value.' checked ';
                                        }
                                        $html .= 'value="' . $group_options->option_value . '"';
                                            if(isset($group_options->option_id)){
                                                $html .= 'id="'. $group_options->option_id .'" ';
                                            }else{
                                                $html .= 'id="'. $group_options->option_value .'" ';
                                            }
                                        if(isset($group_node->node_code)){
                                            $html .= 'name="' . $group_node->node_code;
                                            if(isset($group_node->node_isarray) && $group_node->node_isarray){
                                                $html .= '[]';
                                            }
                                            $html .= '"';
                                        }
                                        if(isset($group_node->node_class)){
                                            $html .= 'class="' . $group_node->node_class . '"';
                                        }
                                        $html .= '>';
                                        if(isset($group_options->option_label)){

                                            if(isset($group_options->option_id)){
                                                $html .= '<label for="' . $group_options->option_id . '">'. $group_options->option_label .'</label>';
                                            }else{
                                                $html .= '<label for="' . $group_options->option_value . '">'. $group_options->option_label .'</label>';
                                            }
                                        }
                                        $html .= '</div>';
                                    }
                                }
                            } elseif($group_node->node_type == 'radio'){
                                if(@$userdata->is_profile_setup==1 && $group_node->node_is_editable==0 && isset($value[$group_node->node_code])){
                                    $html .= '<div class="disabled"   >';
                                }else{
                                    $html .= '<div class=""   >';
                                }
                                
                                if(isset($group_node->options) && is_array($group_node->options)){

                                    foreach ($group_node->options as $key=>$group_options){
                                        $keyy = $group_options->option_value;
                                        $html .= '<div ';
                                        if(isset($group_node->node_div_class)){
                                            $html .= 'class="'. $group_node->node_div_class .'"';
                                        }
                                        $html.= '>';
                                        
                                        if(isset($group_node->node_value, $value[$group_node->node_code]) && $value[$group_node->node_code] &&  !is_array($value[$group_node->node_code]) ) {
                                            if($keyy==$value[$group_node->node_code]){
                                                $activeradio = ' active ';
                                                $activebtnradio = $keyy;
                                            }else{
                                                $activeradio = '  ';
                                                //$activebtnradio = $keyy;
                                            }
                                            
                                        }

                                        if(isset($group_options->option_label)){

                                            if(isset($group_options->option_id)){
                                                $html .= '<label class="btn btn-primary '.$activeradio.' " for="' . $group_options->option_id . '">'. $group_options->option_label;
                                            }else{ 
                                                $html .= '<label class="btn btn-primary '.$activeradio.' " for="' . $group_options->option_value . '">'. $group_options->option_label;
                                            }
                                        }
                                        $html.='<input style="height:0px"  type="'. $group_node->node_type .'" ';
                                        if($group_node->node_code!='is_bike'){
                                            $html.=' minchecked="1" ';
                                        }
                                        if($group_node->node_code=='dl_number' || $group_node->node_code=='vehicle_number' || $group_node->node_code=='identity_information'){
                                            $html.='data-validation-callback-callback="demo_callback_function" ';
                                        }
                                        
                                        if(isset($group_node->node_value, $value[$group_node->node_code]) && !empty($value[$group_node->node_code]) && is_array($value[$group_node->node_code]) && in_array($keyy, $value[$group_node->node_code])){
                                            $html .= ' checked ';
                                        } else if(isset($group_node->node_value, $value[$group_node->node_code]) && $value[$group_node->node_code] &&  !is_array($value[$group_node->node_code]) ) {
                                            $html .= ' checked ';
                                        }
                                        $html .= 'value="' . $group_options->option_value . '"';
                                            if(isset($group_options->option_id)){
                                                $html .= 'id="'. $group_options->option_id .'" ';
                                            }else{
                                                $html .= 'id="'. $group_options->option_value .'" ';
                                            }
                                        if(isset($group_node->node_code)){
                                            $html .= 'name="' . $group_node->node_code;
                                            if(isset($group_node->node_isarray) && $group_node->node_isarray){
                                                $html .= '[]';
                                            }
                                            $html .= '"';
                                        }
                                        if(isset($group_node->node_class)){
                                            $html .= 'class="' . $group_node->node_class . '"';
                                        }
                                        $html .= '>';
                                        if(isset($group_options->option_label)){

                                            if(isset($group_options->option_id)){
                                                $html .= '</label>';
                                            }else{
                                                $html .= '</label>';
                                            }
                                        }
                                        $html .= '</div>';
                                    }
                                }
                            
                            
                            } elseif($group_node->node_type == 'button'){
                                //$html .= '<button type="'. $group_node->node_type .'"';
                            }

                            /*
                             * Element property and value
                             */
                            if(!in_array($group_node->node_type,['checkbox','radio'])){
                                if (isset($group_node->required) && $group_node->required) {
                                    $html .= 'required ';
                                }
                                if (isset($group_node->disabled)) {
                                    $html .= 'disabled="" ';
                                }
                                if(isset($group_node->node_value) && $group_node->node_type !='textarea' && $group_node->node_type !='select'&& $group_node->node_type !='button'){
                                    $code_value = !empty($value[$group_node->node_code]) ? $value[$group_node->node_code] : $group_node->node_value;
                                    if(isset($group_node->node_required) && $group_node->node_type == 'file' && empty($code_value)){
                                        $html .= 'required data-validation-required-message="' . $group_node->node_required . '" ';
                                    }
                                    $html .= 'value="' . $code_value . '" ';

                                }
                                if(isset($group_node->node_code) && $group_node->node_type =='select'){
                                            $html .= 'name="' . $group_node->node_code;
                                            if(isset($group_node->node_isarray) && $group_node->node_isarray){
                                                $html .= '[]';
                                            }
                                            $html .= '"';
                                }else{
                                    if(isset($group_node->node_code)){
                                        $html .= 'name="' . $group_node->node_code . '" ';
                                    }
                                }
                                if($user_type=='assistant'){
                                    if(isset($group_node->node_min)){
                                        $html .= 'min="' . ($min ?? $group_node->node_min) . '" ';
                                    }
                                    if(isset($group_node->node_max)){
                                        $html .= 'max="' . ($max ?? $group_node->node_max) . '" ';
                                    }

                                }
                                if(isset($group_node->node_class)){
                                    if(@$userdata->is_profile_setup==1 && isset($group_node->node_is_editable) && $group_node->node_is_editable==0 && !$is_admin){
                                        if(@$code_value){
                                        $html .= 'class="' . $group_node->node_class . ' disabled " ';;
                                        }else{
                                            $html .= 'class="' . $group_node->node_class . '" ';;  
                                        }

                                    }else{
                                            $html .= 'class="' . $group_node->node_class . '" ';;
                                    }


                                     
                                }
                                if(isset($group_node->node_id)){
                                    $html .= 'id="' . $group_node->node_id . '" ';
                                }
                                if(isset($group_node->node_readonly) && $group_node->node_readonly && $code_value){
                                    $html .= 'readonly ';
                                }

                                
                                if(isset($group_node->node_placeholder) && !empty($group_node->node_placeholder)){
                                    $html .= 'placeholder="' . $group_node->node_placeholder . '" ';
                                }
                                if(isset($group_node->node_maxlength)){
                                    $html .= 'maxlength="' . $group_node->node_maxlength . '" ';
                                }
                                if(isset($group_node->node_required) && !empty($group_node->node_required) && $group_node->node_type != 'file'){
                                    $html .= 'data-validation-required-message="' . $group_node->node_required . '"';
                                }
                            }
                            /*
                             * End element property and value
                             */

                            

                            if($group_node->node_type == 'text' || $group_node->node_type == 'email' || $group_node->node_type == 'number' || $group_node->node_type == 'file'){
                                $html .= '/>';
                                if($group_node->node_type == 'file' && $code_value){
                                   $html .='<img src="' . asset($path.$code_value) . '" height ="50px" width="50px"/>'; 
                                }

                            } elseif($group_node->node_type == 'textarea'){
                                $html .= '>';
                                if(isset($group_node->node_value)){
                                    $codetextrea_value = !empty($value[$group_node->node_code]) ? $value[$group_node->node_code] : $group_node->node_value;
                                    $html .= $codetextrea_value;
                                }
                                $html .= '</textarea>';
                            } elseif($group_node->node_type == 'select'){
                                
                                $html .= '>';
                                if(isset($group_node->options) && is_array($group_node->options)){
                                    if($group_node->node_code == 'list_of_pincodes'){

                                        $new_option = $group_node->options[0];
                                        
                                        $group_node->options = [];
                                        
                                        foreach($pickup_pincode as $kep => $pinn){
                                            
                                            $new_options = new $new_option;
                                            $new_options->option_value = $pinn;
                                            $new_options->option_label = $pinn;
                                            $new_options->sequence = $kep;
                                            $group_node->options[$kep]=  $new_options;
                                            reset($new_options);
                                        }
                                        
                                    }
                                    
                                    foreach ($group_node->options as $key=>$group_options){
                                        $html .= '<option';
                                        if(isset($group_node->node_value, $value[$group_node->node_code]) && !is_array($value[$group_node->node_code]) && $value[$group_node->node_code] == $group_options->option_value){
                                            $html .= ' selected';
                                            
                                        }
                                        if($group_node->node_code == 'list_of_pincodes' && !is_array(@$value[$group_node->node_code])){

                                            $selected_values = explode(',', @$value[$group_node->node_code]);
                                            if(in_array($group_options->option_value,$selected_values)){
                                                $html .= ' selected';
                                            }

                                        }
                                        $html .= ' value="'. $group_options->option_value .'">';
                                        if(isset($group_options->option_label)){
                                           $html .=$group_options->option_label;
                                        }
                                        $html .='</option>';
                                    }
                                }
                                $html .='</select>';
                            } elseif($group_node->node_type == 'checkbox'){
                                $html .='</div>';
                            } elseif($group_node->node_type == 'radio'){
                                $html .='</div>';
                            
                            }  elseif($group_node->node_type == 'button'){
                                // $html .= '>';
                                // if(isset($group_node->node_value)){
                                //     $html .= $group_node->node_value;
                                // }
                                // $html .='</button>';
                            }
                        }
                        if(isset($group_node->node_note)){
                            $html .='<i class="fal fa-info-circle"></i> <small style="display: inline-block; font-style: italic;" class="form-text text-muted">'. $group_node->node_note .'</small>';
                        }
                    $html .= '</div>' .
                            '</div>';
                            if(isset($value['dob']) && $value['dob']!='' && !$is_admin && $group_node->node_code=='dob'){
                                            $html .= '</div>';
                                }
                }
                $html .= '</div>';
            }
        }
        //dd($html);
        return $html;
    }

}

if(!function_exists('fields')){
    function fields($fields){
        $data = [];
        foreach($fields as $field){
            array_push($data, $field['node_code']);
        }
        return $data;
    }
}

if(!function_exists('userfirstname')){
    function userfirstname($words){
        if($words){
            $acronym='';
            foreach(explode(' ', $words) as $word){
                $acronym .= mb_substr($word, 0, 1, 'utf-8').'.';
            } 
            return trim($acronym,'.');
        }
    }
}

if(!function_exists('getAdminConfig')){
    function getAdminConfig($fields){
        $data = [];
        //dd($fields);
        foreach($fields['configs'] as $field){
            $data[$field['node_code']]= $field['node_value'];
        }
        return $data;
    }
}
