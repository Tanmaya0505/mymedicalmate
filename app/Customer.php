<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Customer extends Model

{

    protected $fillable = ['account_id', 'first_name', 'last_name', 'email', 'phone', 'password','email_verified_at', 'meta', 'status', 'restricted_reason', 'online_status', 'admin_status','pincode','is_profile_setup','name_of_store','booking_type','discount'];

    public function getFullNameAttribute()
	{
	    return "{$this->first_name} {$this->last_name}";
	}

    public function accountType(){

    	return $this->belongsTo('App\AccountType', 'account_id');

    }

    public function referal(){

      return $this->hasOne('App\ReferalBonus', 'user_id');

    }

    

//    public function customerData() {

//        return $this->hasMany('App\AssistantBoyBooking', 'customer_id');

//    }

//    

   public function assistantData(){

   	return $this->hasOne('App\AssistantBoyBooking', 'assistant_boy_id')->whereNotIN('booking_status',[4,5]);

   }

   public function firstchilds(){

   		return $this->hasMany('App\ReferalBonus', 'ref_id');

   }

   public function relatedarea(){

    return $this->hasMany('App\VendorRelatedPincode', 'vendor_id');

   }

}

