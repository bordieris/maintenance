<?php

/*
 * Maintenance Application Routes
 */
Route::group(array('prefix'=>Config::get('maintenance::prefix'), 'namespace'=>'Stevebauman\Maintenance'), function(){

        /*
         * Authentication Routes
         */
        include('routes/auth.php');
        
        /*
         * Registration Routes
         */
        include('routes/register.php');
        
        /*
         * Permission Routes (not allowed redirect)
         */
        include('routes/permission.php');
        
        /*
         * Public Work Order Management Routes
         */
        include('routes/public.php');
        
        /*
         * Main Application Controller Group
         * 
         * Filters:
         * 
         * Auth         - Only Allows logged in users
         * Permission   - Only Allows users with correct permissions
         */
	Route::group(array('namespace'=>'Controllers', 'before'=>'maintenance.auth|maintenance.permission'), function(){
            
                /*
                 * Dashboard Routes
                 */
                 include('routes/dashboard.php');
                 
                /*
                 * Work Order Routes
                 */
		include('routes/work-order.php');
                
                /*
                 * Asset Routes
                 */
                include('routes/asset.php');
                
                /*
                 * Inventory Routes
                 */
                include('routes/inventory.php');
                
                /*
                 * Attachment Routes (used for all attachments throughout the application)
                 */
                include('routes/attachment.php');
                
                /*
                 * Location Routes
                 */
                include('routes/location.php');
		
                /*
                 * Metric Routes
                 */
                include('routes/metric.php');
                
                /*
                 * Administration Route Group
                 */
                Route::group(array('prefix'=>'admin', 'namespace'=>'Admin'), function(){
                    
                    /*
                     * Amdministration Routes
                     */
                    include('routes/admin.php');
                    
                });
                
	});
        
        /*
         * API Route Group
         */
	Route::group(array('prefix'=>'api', 'namespace'=>'Apis'), function(){
            
            /*
             * API Routes
             */
            include('routes/api.php');
            
	});
	
	
	
}); /* End Maintenance Routes */