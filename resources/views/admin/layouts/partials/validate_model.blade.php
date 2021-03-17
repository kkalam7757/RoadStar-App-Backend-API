<script>
	$(function () {        

    $("#add_model").validate({
        rules: {
            country_name: {
                required: true,
            },
			country_id: {
                required: true,
            },
			state_name: {
                required: true,
            },
			state: {
                required: true,
            },
			state_id: {
                required: true,
            },
			location_name: {
                required: true,
            },
			location_id: {
                required: true,
            },
			sublocation_id: {
                required: true,
            },
			district_name: {
                required: true,
            },
			district_id: {
                required: true,
            },
			tehsil_name: {
                required: true,
            },
			tehsil_id: {
                required: true,
            },
			city_name: {
                required: true,
            },
			city_id: {
                required: true,
            },
			 company_name: {
                required: true,
            },
			micr: {
				required: true,
				minlength: 9,
			},
			ifsc_code: {
				required: true,
				minlength: 11,
			},
			bank_id: {
				required: true,				
			},
			bank_branch_name: {
				required: true,			
			},
			bank_name: {
                required: true,
            },
			bank_type_id: {
                required: true,
            },
			qualification_name: {
                required: true,
            },
			income_slab_name: {
                required: true
            },
			fromamount_name: {
                required: true,
            },
		   tomamount: {
                required: true,
            },
			segment_name: {
                required: true,
            },
			segment_id: {
                required: true,
            },
			industry_type_name: {
                required: true,
            },
			industry_type_id: {
                required: true,
            },
			industry_name: {
                required: true,
            },
			occupation_name: {
                required: true,
            },
			industry_id: {
                required: true,
            },
			code: {
                required: true,
            },
			name: {
                required: true,
            },
			kyc_type_id: {
                required: true,
            },
			pattern: {
                required: true,
            },
			name_prefix_name: {
                required: true,
            },
			name_suffix_name: {
                required: true,
            },
			religion_name: {
                required: true,
            },
			religion_id: {
                required: true,
            },
			caste_name: {
                required: true,
            },
			 pan_no: {
                required: true,
                minlength: 10
            },
			 service_tax: {
                required: true
            },
			 gst: {
                required: true
            },
			 CKYC_Code: {
                required: true
            },
			
		      email         : {
                        email     : true
                      },	 
			 
            action: "required"
        },
		
        messages: {
			country_name: {
                required: "Please Enter Country Name",
            },
			country_id: {
                required: "Please Select Country Name",
            },
			state: {
                required: "Please Select State Name",
            },
			state_name: {
                required: "Please Enter State Name",
            },
			state_id: {
                required: "Please Enter State Name",
            },
			district_name: {
                required: "Please Enter District Name",
            },
			district_id: {
                required: "Please Enter District Name",
            },
			tehsil_name: {
                required: "Please Enter Tehsil Name",
            },
			tehsil_id: {
                required: "Please Select Tehsil Name",
            },
			city_name: {
                required: "Please Enter City Name",
            },
			city_id: {
                required: "Please Enter City Name",
            },
			location_name: {
                required: "Please Enter location Name",
            },
			location_id: {
                required: "Please Enter location Name",
            },
			sublocation_id: {
                required: "Please Enter Sublocation Name",
            },
			 bank_name: {
                required: "Please Enter Bank Name",
            },
            company_name: {
                required: "Please Enter Company Name",
            },
			qualification_name: {
                required: "Please Enter Qualification",
            },
			income_slab_name: {
                required: "Please Enter IncomeSlab Name",
            },
			fromamount_name: {
                required: "Please Enter From Amount here",
            },
			tomamount: {
                required: "Please Enter To Amount here",
            },
			segment_name: {
                required: "Please Enter Segment Name",
            },
			segment_id: {
                required: "Please Select Segment Name",
            },
			industry_type_name: {
                required: "Please Enter Industry Type Name",
            },
			industry_type_id: {
                required: "Please Select Industry Name",
            },
			industry_name: {
                required: "Please Enter Industry Name",
            },
			occupation_name: {
                required: "Please Enter Occupation",
            },
			industry_id: {
                required: "Please Select Industry Name",
            },
			code: {
                required: "Please Enter Code",
            },
			name: {
                required: "Please Enter Name",
            },
			kyc_type_id: {
                required: "Please Select Kyc Type",
            },
			pattern: {
                required: "Please Enter Pattern",
            },
			name_prefix_name: {
                required: "Please Enter Prefix Name",
            },
			name_suffix_name: {
                required: "Please Enter Suffix Name",
            },
			religion_name: {
                required: "Please Enter Religion Name",
            },
			religion_id: {
                required: "Please Select Religion",
            },
			caste_name: {
                required: "Please Enter Caste Name",
            },
			micr: {
				required: "Please Enter MICR",
                minlength: "Your data must be at least 9 characters",
			},
			ifsc_code: {
				required: "Please Enter IFSC Code",
                minlength: "Your data must be at least 11 characters",
			},
			bank_id: {
				required: "Please Select Bank",			
			},
			bank_branch_name: {
				required: "Please Enter Bank Branch Name",			
			},
			bank_type_id: {
               required: "Please Select Bank",	
            },
			 pan_no: {
                required: "Please Enter pan no",
                minlength: "Your data must be at least 10 characters"
            },
			service_tax: {
                required: "Please Enter service tax",
				
            },
			gst: {
                required: "Please Enter gst Number"
            },
			CKYC_Code: {
                required: "Please Enter CKYC Code"
            },
            action: "Please Enter Company Name12"
        }
    });
	 $("#edit_model").validate({
         rules: {
            country_name: {
                required: true,
            },
			country_id: {
                required: true,
            },
			state_name: {
                required: true,
            },
			state_id:{
                required: true,
            },
			state: {
                required: true,
            },
			district_name: {
                required: true,
            },
			district_id: {
                required: true,
            },
			tehsil_name: {
                required: true,
            },
			tehsil_id: {
                required: true,
            },
			location_name: {
                required: true,
            },
			location_id: {
                required: true,
            },
			sublocation_id: {
                required: true,
            },
			city_name: {
                required: true,
            },
			city_id: {
                required: true,
            },
			 company_name: {
                required: true,
            },
			qualification_name: {
                required: true,
            },
			income_slab_name: {
                required: true
            },
			fromamount_name: {
                required: true
            },
			tomamount: {
                required: true
            },
			segment_name: {
                required: true,
            },
			segment_id: {
                required: true,
            },
			industry_type_name: {
                required: true,
            },
			industry_type_id: {
                required: true,
            },
			industry_name: {
                required: true,
            },
			occupation_name: {
                required: true,
            },
			industry_id: {
                required: true,
            },
			code: {
                required: true
            },
			name: {
                required: true
            },
			kyc_type_id: {
                required: true
            },
			pattern: {
                required: true,
            },
			name_prefix_name: {
                required: true,
            },
			name_suffix_name: {
                required: true,
            },
			religion_name: {
                required: true,
            },
			religion_id: {
                required: true,
            },
			caste_name: {
                required: true,
            },
			micr: {
				required: true,
				minlength: 9,
			},
			ifsc_code: {
				required: true,
                minlength: 11,
			},
			bank_id: {
				required: true,			
			},
			bank_branch_name: {
				required: true,			
			},
			bank_name: {
                required: true,
            },
			bank_type_id: {
               required: true,	
            },
			 pan_no: {
                required: true,
                minlength: 10
            },
			 service_tax: {
                required: true
            },
			 gst: {
                required: true
            },
			 CKYC_Code: {
                required: true
            },
			
		      email         : {
                        email     : true
                      },	 
			 
            action: "required"
        },
		
        messages: {
			country_name: {
                required: "Please Enter Country Name",
            },
			country_id: {
                required: "Please Select Country Name",
            },
			state_name: {
                required: "Please Enter State Name",
            },
			state_id: {
                required: "Please Select State Name",
            },
			state: {
                required: "Please Enter State Name",
            },
			district_name: {
                required: "Please Enter District Name",
            },
			district_id: {
                required: "Please Enter District Name",
            },
			tehsil_name: {
                required: "Please Enter Tehsil Name",
            },
			tehsil_id: {
                required: "Please Select Tehsil Name",
            },
			city_name: {
                required: "Please Enter City Name",
            },
			city_id: {
                required: "Please Enter City Name",
            },
			location_name: {
                required: "Please Enter location Name",
            },
            location_id: {
                required: "Please Enter location Name",
            },
			sublocation_id: {
                required: "Please Enter Sublocation Name",
            },			
            company_name: {
                required: "Please Enter Company Name",
            },			
			qualification_name: {
                required: "Please Enter Qualification",
            },
			income_slab_name: {
                required: "Please Enter IncomeSlab Name",
            },
			fromamount_name: {
                required: "Please Enter From Amount here",
            },
			tomamount: {
                required: "Please Enter To Amount here",
            },
			segment_name: {
                required: "Please Enter Segment Name",
            },
			segment_id: {
                required: "Please Select Segment Name",
            },
			industry_type_name: {
                required: "Please Enter Industry Type Name",
            },
		    industry_type_id: {
                required: "Please Select Industry Name",
            },
			industry_name: {
                required: "Please Enter Industry Name",
            },
			industry_id: {
                required: "Please Select Industry Name",
            },
			occupation_name: {
                required: "Please Enter Occupation",
            },
			code: {
                required: "Please Enter Code",
            },
			name: {
                required: "Please Enter Name",
            },
			kyc_type_id: {
                required: "Please Select Kyc Type",
            },
			pattern: {
                required: "Please Enter Pattern",
            },
			name_prefix_name: {
                required: "Please Enter Prefix Name",
            },
			name_suffix_name: {
                required: "Please Enter Suffix Name",
            },
			religion_name: {
                required: "Please Enter Religion Name",
            },
			religion_id: {
                required: "Please Select Religion",
            },
			caste_name: {
                required: "Please Enter Caste Name",
            },
			micr: {
				required: "Please Enter MICR",
                minlength: "Your data must be at least 9 characters",
			},
			ifsc_code: {
				required: "Please Enter IFSC CODE",
                minlength: "Your data must be at least 11 characters",
			},
			bank_id: {
				required: "Please Select Bank",			
			},
			bank_branch_name: {
				required: "Please Enter Bank Branch Name",			
			},
			 bank_name: {
                required: "Please Enter Bank Name",
            },
			bank_type_id: {
               required: "Please Select Bank",	
            },
			 pan_no: {
                required: "Please Enter pan no",
                minlength: "Your data must be at least 10 characters"
            },
			
			service_tax: {
                required: "Please Enter service tax"
            },
			gst: {
                required: "Please Enter gst Number"
            },
			CKYC_Code: {
                required: "Please Enter CKYC Code"
            },
            action: "Please Enter Company Name12"
        }
    });
});
	</script>