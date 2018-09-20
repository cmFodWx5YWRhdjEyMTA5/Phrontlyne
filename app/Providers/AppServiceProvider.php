<?php

namespace Phrontlyne\Providers;
use Phrontlyne\Models\Company;
use Phrontlyne\Models\Policy;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $company = Company::get()->first();
        view()->share('company', $company);

        //if(Auth::check()) 
        //{
       // dd(Auth::user()->getRole());
        // if(Auth::user()->getRole() == 'Doctor')
        // {
        $today =        Carbon::now()->format('Y-m-d').'%';
        $notifications = Policy::where('created_on', 'like', $today)->orderBy('created_on', 'DESC')->get();
        view()->share('notifications', $notifications);
        //}
        //}
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
